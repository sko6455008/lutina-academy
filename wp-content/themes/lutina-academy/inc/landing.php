<?php
/** Figma SP landing page. Native blocks keep saves, previews and revisions intact. */
function lutina_academy_is_landing() {
    return is_front_page() && has_block( 'lutina/landing', get_queried_object_id() );
}

function lutina_academy_register_landing_faq() {
    register_post_type( 'lutina_faq', array(
        'label' => 'LPのFAQ',
        'labels' => array( 'name' => 'LPのFAQ', 'singular_name' => 'FAQ', 'add_new_item' => 'FAQを追加', 'edit_item' => 'FAQを編集' ),
        'public' => false, 'show_ui' => true, 'show_in_rest' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array( 'title', 'editor', 'page-attributes', 'revisions' ),
    ) );
}
add_action( 'init', 'lutina_academy_register_landing_faq' );

function lutina_academy_install_landing() {
    if ( get_option( 'lutina_academy_landing_version' ) ) return;
    $page_id = (int) get_option( 'page_on_front' );
    $page = get_post( $page_id );
    if ( ! $page || 'page' !== $page->post_type ) return;

    // Keep the exact original content independently of the revision retention setting.
    add_option( 'lutina_academy_pre_landing_backup', array( 'page_id' => $page_id, 'content' => $page->post_content, 'date' => current_time( 'mysql' ) ), '', false );
    wp_save_post_revision( $page_id );
    $faqs = json_decode( file_get_contents( __DIR__ . '/landing-faq.json' ), true );
    foreach ( $faqs as $i => $faq ) {
        $existing = get_posts( array( 'post_type' => 'lutina_faq', 'post_status' => 'any', 'posts_per_page' => 1, 'meta_key' => '_lutina_import_key', 'meta_value' => 'figma-' . $i ) );
        if ( $existing ) continue;
        $id = wp_insert_post( wp_slash( array(
            'post_type' => 'lutina_faq', 'post_status' => 'publish',
            'post_title' => $faq['q'], 'post_content' => $faq['a'], 'menu_order' => $i + 1,
            'meta_input' => array( '_lutina_import_key' => 'figma-' . $i ),
        ) ), true );
        if ( is_wp_error( $id ) || ! $id ) return;
    }
    if ( ! has_block( 'lutina/landing', $page ) ) {
        $result = wp_update_post( wp_slash( array( 'ID' => $page_id, 'post_content' => lutina_academy_initial_page_content( 'landing' ) ) ), true );
        if ( is_wp_error( $result ) || ! $result ) return;
    }
    update_option( 'lutina_academy_landing_version', 1 );
}
add_action( 'init', 'lutina_academy_install_landing', 40 );
