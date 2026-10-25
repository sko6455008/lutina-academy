<?php
/** Integration checks use a private test page and a temporary FAQ, never edit the live LP. */
if ( PHP_SAPI !== 'cli' ) exit;
require_once dirname( __DIR__, 4 ) . '/wp-load.php';
function lp_check( $ok, $label ) { if ( ! $ok ) throw new RuntimeException( $label ); echo "PASS: $label\n"; }
$page_id = 0;
$faq_id = 0;
$user = get_current_user_id();
try {
    $front_id = (int) get_option( 'page_on_front' );
    $front_content = get_post_field( 'post_content', $front_id );
    $front_html = do_blocks( $front_content );
    lp_check( has_block( 'lutina/landing', $front_id ), 'Front page uses the new editable LP block' );
    lp_check( (bool) get_option( 'lutina_academy_pre_landing_backup' ), 'Original front-page content has a durable backup' );
    lutina_academy_install_landing();
    lp_check( $front_content === get_post_field( 'post_content', $front_id ), 'Repeated initialization does not reset edits' );
    lp_check( 7 === substr_count( $front_html, 'href="https://lin.ee/Ub7dXw5"' ) && 6 === preg_match_all( '/class="lp-cta-label[^"]*">無料相談する/', $front_html ), 'Six free-consultation CTAs and the trial consultation link match the request' );
    lp_check( ! preg_match( '/\{\{[^}]+\}\}/', $front_html ), 'No unresolved template placeholders' );
    lp_check( str_contains( $front_html, 'media="(min-width: 900px)"' ) && str_contains( $front_html, 'fv-pc-v7.png' ) && str_contains( $front_html, 'fv-sp-v7.png' ), 'Responsive desktop and mobile FV artwork renders' );
    lp_check( ! str_contains( $front_html, 'lp-image-hero-cta' ), 'Artwork without a button has no invisible CTA hotspot' );
    lp_check( 10 === substr_count( $front_html, 'class="lp-faq-item"' ), 'All ten FAQ entries, including installment payments, are visible' );
    $admins = get_users( array( 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ) );
    wp_set_current_user( (int) $admins[0] );
    $page_id = wp_insert_post( wp_slash( array( 'post_type' => 'page', 'post_status' => 'private', 'post_title' => 'LP integration test', 'post_content' => lutina_academy_initial_page_content( 'landing' ) ) ), true );
    lp_check( ! is_wp_error( $page_id ), 'Temporary private page created' );
    wp_save_post_revision( $page_id );
    $blocks = parse_blocks( get_post_field( 'post_content', $page_id ) );
    $blocks[0]['attrs']['fields']['course_price'] = '598,000円';
    $blocks[0]['attrs']['fields']['trial_price'] = 'テスト体験料金';
    $blocks[0]['attrs']['fields']['academy_intro'] = 'テスト用のアカデミー説明';
    $blocks[0]['attrs']['fields']['hero_banner_pc'] = home_url( '/wp-content/uploads/test-lp.webp' );
    $blocks[0]['attrs']['fields']['teacher_message'] = 'テスト用の<strong>講師メッセージ</strong>';
    $request = new WP_REST_Request( 'POST', '/wp/v2/pages/' . $page_id );
    $request->set_param( 'content', serialize_blocks( $blocks ) );
    $result = rest_do_request( $request );
    lp_check( 200 === $result->get_status(), 'Native WordPress REST save works' );
    $saved = get_post_field( 'post_content', $page_id );
    $html = do_blocks( $saved );
    lp_check( str_contains( $html, 'テスト体験料金' ) && str_contains( $html, 'テスト用のアカデミー説明' ), 'Trial price and academy description persist through the native editor API' );
    $test_front = static function () use ( $page_id ) { return $page_id; };
    add_filter( 'pre_option_page_on_front', $test_front );
    try {
        $legal_html = lutina_academy_render_page_block( 'legal', array() );
        lp_check( str_contains( $legal_html, 'テスト体験料金' ) && str_contains( $legal_html, '598,000円' ), 'Legal disclosure follows saved LP trial and course prices' );
        lp_check( ! preg_match( '/\{\{[^}]+\}\}/', $legal_html ), 'Legal disclosure has no unresolved placeholders' );
    } finally {
        remove_filter( 'pre_option_page_on_front', $test_front );
    }
    lp_check( str_contains( $html, '598,000円' ) && str_contains( $html, '/test-lp.webp' ) && str_contains( $html, '<strong>講師メッセージ</strong>' ), 'Price, image and rich text changes persist and render' );
    lp_check( str_contains( $html, 'fv-sp-v7.png' ), 'Editing the desktop FV preserves the mobile artwork' );
    $blocks[0]['attrs']['fields']['course_price'] = 'プレビュー料金';
    $preview = new WP_REST_Request( 'POST', '/wp/v2/pages/' . $page_id . '/autosaves' );
    $preview->set_param( 'content', serialize_blocks( $blocks ) );
    $response = rest_do_request( $preview );
    $autosave = wp_get_post_autosave( $page_id, get_current_user_id() );
    lp_check( in_array( $response->get_status(), array(200,201), true ) && $autosave && str_contains( do_blocks( $autosave->post_content ), 'プレビュー料金' ) && $saved === get_post_field( 'post_content', $page_id ), 'Autosave preview leaves published content intact' );
    $faq_request = new WP_REST_Request( 'POST', '/wp/v2/lutina_faq' );
    $faq_request->set_param( 'title', 'テスト専用の質問' );
    $faq_request->set_param( 'content', 'テスト専用の回答' );
    $faq_request->set_param( 'status', 'publish' );
    $faq_request->set_param( 'menu_order', -10 );
    $faq_response = rest_do_request( $faq_request );
    lp_check( 201 === $faq_response->get_status(), 'FAQ can be created through the native editor API' );
    $faq_id = $faq_response->get_data()['id'];
    $with_faq = do_blocks( $saved );
    lp_check( strpos( $with_faq, 'テスト専用の質問' ) < strpos( $with_faq, '全くの初心者でも大丈夫ですか？' ) && str_contains( $with_faq, 'テスト専用の回答' ), 'FAQ content and manual order are respected' );
    wp_trash_post( $faq_id );
    lp_check( ! str_contains( do_blocks( $saved ), 'テスト専用の質問' ), 'Trashed FAQ is removed from the public page' );
    wp_set_current_user( 0 );
    lp_check( 401 === rest_do_request( $request )->get_status(), 'Anonymous content changes are rejected' );
    $unsafe = lutina_academy_render_page_block( 'landing', array( 'fields' => array( 'teacher_message' => '<script>alert(1)</script><strong onclick="alert(1)">safe</strong>', 'cta_url' => 'javascript:alert(1)', 'hero_banner_pc' => 'javascript:alert(1)' ) ) );
    lp_check( ! preg_match( '/<script|onclick=|javascript:/', $unsafe ), 'Rich copy and URLs are sanitized' );
    lp_check( $front_content === get_post_field( 'post_content', $front_id ), 'Live page is unchanged by integration checks' );
    echo "All landing-page integration checks passed.\n";
} finally {
    if ( $page_id && ! is_wp_error( $page_id ) ) wp_delete_post( $page_id, true );
    if ( $faq_id ) wp_delete_post( $faq_id, true );
    wp_set_current_user( $user );
}
