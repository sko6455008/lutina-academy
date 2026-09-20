<?php
/** Run with PHP CLI, or wp eval-file. Creates and removes only its own private test page. */
if ( PHP_SAPI !== 'cli' ) {
    exit;
}
if ( ! defined( 'ABSPATH' ) ) {
    require dirname( __DIR__, 4 ) . '/wp-load.php';
}

function lutina_check( $condition, $message ) {
    if ( ! $condition ) {
        throw new RuntimeException( $message );
    }
    echo "PASS: $message\n";
}

$test_id = 0;
$original_user = get_current_user_id();
try {
    $home_id = (int) get_option( 'page_on_front' );
    $legal_id = (int) get_option( 'lutina_academy_tokushoho_page_id' );
    lutina_check( 'page' === get_option( 'show_on_front' ) && has_block( 'lutina/home', $home_id ), 'Top page uses editable WordPress content' );
    lutina_check( has_block( 'lutina/legal', $legal_id ), 'Legal page uses editable WordPress content' );

    $home_before = get_post_field( 'post_content', $home_id );
    $legal_before = get_post_field( 'post_content', $legal_id );
    lutina_academy_setup_editable_pages();
    lutina_check( $home_before === get_post_field( 'post_content', $home_id ) && $legal_before === get_post_field( 'post_content', $legal_id ), 'Initialization preserves existing page content' );

    $admins = get_users( array( 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ) );
    wp_set_current_user( (int) $admins[0] );
    $test_id = wp_insert_post( array(
        'post_type' => 'page', 'post_status' => 'private',
        'post_title' => 'Editable page integration test',
        'post_content' => wp_slash( lutina_academy_initial_page_content( 'legal' ) ),
    ) );
    lutina_check( (bool) $test_id, 'Private integration test page created' );
    wp_save_post_revision( $test_id );

    $blocks = parse_blocks( get_post_field( 'post_content', $test_id ) );
    $blocks[0]['attrs']['fields']['business'] = '保存確認：アカデミー';
    $blocks[0]['attrs']['fields']['hours'] = '13:00～21:00';
    $blocks[0]['attrs']['fields']['price_url'] = home_url( '/#courses' );
    $content = serialize_blocks( $blocks );
    $request = new WP_REST_Request( 'POST', '/wp/v2/pages/' . $test_id );
    $request->set_param( 'content', $content );
    $response = rest_do_request( $request );
    lutina_check( 200 === $response->get_status(), 'Native editor REST save succeeds for an authorized editor' );
    $saved = get_post_field( 'post_content', $test_id );
    lutina_check( $saved === $content, 'Edited field values persist without JSON or HTML corruption' );
    $rendered = do_blocks( $saved );
    lutina_check( str_contains( $rendered, '保存確認：アカデミー' ) && str_contains( $rendered, '13:00～21:00' ), 'Saved fields appear in the rendered page' );
    lutina_check( str_contains( $rendered, home_url( '/#courses' ) ), 'Edited course link is rendered' );

    $preview_blocks = $blocks;
    $preview_blocks[0]['attrs']['fields']['hours'] = 'プレビューのみ';
    $preview_request = new WP_REST_Request( 'POST', '/wp/v2/pages/' . $test_id . '/autosaves' );
    $preview_request->set_param( 'content', serialize_blocks( $preview_blocks ) );
    $preview_response = rest_do_request( $preview_request );
    lutina_check( in_array( $preview_response->get_status(), array( 200, 201 ), true ), 'Native editor autosave succeeds' );
    $autosave = wp_get_post_autosave( $test_id, get_current_user_id() );
    lutina_check( $autosave && str_contains( do_blocks( $autosave->post_content ), 'プレビューのみ' ) && get_post_field( 'post_content', $test_id ) === $saved, 'Preview content is stored separately from published content' );

    $revisions = wp_get_post_revisions( $test_id, array( 'order' => 'ASC' ) );
    $initial_revisions = array_filter( $revisions, static fn( $revision ) => ! str_contains( do_blocks( $revision->post_content ), '保存確認：アカデミー' ) && ! wp_is_post_autosave( $revision->ID ) );
    $first_revision = reset( $initial_revisions );
    lutina_check( $first_revision && count( $revisions ) >= 2, 'WordPress revisions retain earlier field values' );
    wp_restore_post_revision( $first_revision->ID );
    lutina_check( ! str_contains( do_blocks( get_post_field( 'post_content', $test_id ) ), '保存確認：アカデミー' ), 'Restoring a revision restores the previous field content' );

    wp_set_current_user( 0 );
    $denied = rest_do_request( $request );
    lutina_check( in_array( $denied->get_status(), array( 401, 403 ), true ), 'Unauthenticated edits are rejected' );

    $html = lutina_academy_render_page_block( 'legal', array( 'fields' => array(
        'business' => '<script>alert(1)</script>', 'price_url' => 'javascript:alert(1)', 'hours' => '',
    ) ) );
    lutina_check( ! str_contains( $html, '<script>' ) && ! str_contains( $html, 'javascript:' ), 'Text and URL fields are escaped safely' );
    lutina_check( ! str_contains( $html, '12:00～22:00' ), 'Intentionally empty fields remain empty' );

    $home_blocks = parse_blocks( $home_before );
    $home_blocks[0]['attrs']['fields']['hero_01'] = home_url( '/test-image.jpg' );
    $home_html = render_block( $home_blocks[0] );
    lutina_check( str_contains( $home_html, home_url( '/test-image.jpg' ) ), 'LP image edits render correctly' );
    lutina_check( substr_count( $home_html, 'class="faq-button ' ) === count( get_posts( array( 'post_type' => 'qa', 'numberposts' => -1 ) ) ), 'Existing Q&A records remain connected' );
    lutina_check( ! preg_match( '/\{\{(?:field|attr):/', $home_html ), 'All editable content placeholders resolve' );
    echo "All editable-page checks passed.\n";
} finally {
    if ( $test_id ) {
        wp_delete_post( $test_id, true );
    }
    wp_set_current_user( $original_user );
}
