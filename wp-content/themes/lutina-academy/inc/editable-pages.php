<?php
/**
 * Editable page content lives in native block attributes, so WordPress handles
 * permissions, autosaves, previews and revisions without a second save endpoint.
 */

function lutina_academy_page_schemas() {
    static $schemas;
    if ( null === $schemas ) {
        $schemas = json_decode( file_get_contents( __DIR__ . '/page-fields.json' ), true );
    }
    return $schemas;
}

function lutina_academy_content_default( $value ) {
    return strtr( $value, array(
        '{{theme_url}}' => get_template_directory_uri(),
        '{{home_url}}'  => untrailingslashit( home_url( '/' ) ),
    ) );
}

function lutina_academy_render_page_block( $type, $attributes ) {
    $schema = lutina_academy_page_schemas()[ $type ];
    $fields = isset( $attributes['fields'] ) && is_array( $attributes['fields'] ) ? $attributes['fields'] : array();
    $tokens = array(
        '{{home_url}}'  => esc_url( untrailingslashit( home_url( '/' ) ) ),
        '{{theme_url}}' => esc_url( get_template_directory_uri() ),
        '{{legal_url}}' => esc_url( lutina_academy_tokushoho_url() ),
        '{{year}}'      => esc_html( wp_date( 'Y' ) ),
        '{{page_title}}' => esc_html( get_the_title() ),
    );
    $rich_tags = array(
        'span'   => array( 'class' => true ),
        'br'     => array( 'class' => true ),
        'strong' => array(),
        'b'      => array(),
        'em'     => array(),
        'i'      => array(),
        'u'      => array(),
        's'      => array(),
        'a'      => array( 'href' => true, 'title' => true, 'target' => true, 'rel' => true ),
    );

    foreach ( $schema['fields'] as $field ) {
        $key = $field['key'];
        // An intentionally empty value must stay empty, rather than restore its default.
        $value = isset( $fields[ $key ] ) && is_string( $fields[ $key ] )
            ? $fields[ $key ] : lutina_academy_content_default( $field['default'] );
        switch ( $field['type'] ) {
            case 'rich':
                $html = wp_kses( $value, $rich_tags );
                break;
            case 'email':
                $value = sanitize_email( $value );
                $html = esc_html( $value );
                break;
            case 'textarea':
                $html = nl2br( esc_html( $value ) );
                break;
            default:
                $html = esc_html( $value );
        }
        $tokens[ '{{field:' . $key . '}}' ] = $html;
        $tokens[ '{{attr:' . $key . '}}' ] = in_array( $field['type'], array( 'url', 'image' ), true )
            ? esc_url( $value ) : esc_attr( $value );
        if ( 'email' === $key ) {
            $tokens['{{email_url}}'] = esc_url( 'mailto:' . $value );
        }
    }

    if ( 'home' === $type ) {
        ob_start();
        get_template_part( 'template-parts/faq' );
        $tokens['{{faq}}'] = ob_get_clean();
    }

    // strtr substitutes once; text entered by an editor cannot introduce template tokens.
    return strtr( file_get_contents( get_template_directory() . '/templates/' . $type . '.html' ), $tokens );
}

function lutina_academy_register_page_blocks() {
    $script_path = get_template_directory() . '/page-editor.js';
    wp_register_script( 'lutina-page-editor', get_template_directory_uri() . '/page-editor.js',
        array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-data' ), filemtime( $script_path ), true );
    wp_register_style( 'lutina-page-editor', get_template_directory_uri() . '/page-editor.css',
        array(), filemtime( get_template_directory() . '/page-editor.css' ) );

    $schemas = lutina_academy_page_schemas();
    foreach ( $schemas as &$schema ) {
        foreach ( $schema['fields'] as &$field ) {
            $field['default'] = lutina_academy_content_default( $field['default'] );
        }
        unset( $field );
    }
    unset( $schema );
    wp_add_inline_script( 'lutina-page-editor', 'window.lutinaPageEditor = ' . wp_json_encode( array(
        'schemas' => $schemas,
        'faqUrl'  => admin_url( 'edit.php?post_type=qa' ),
    ) ) . ';', 'before' );

    foreach ( array( 'home', 'legal' ) as $type ) {
        register_block_type( 'lutina/' . $type, array(
            'api_version'     => 3,
            'attributes'      => array( 'fields' => array( 'type' => 'object', 'default' => array() ) ),
            'supports'        => array( 'html' => false, 'multiple' => false ),
            'editor_script'   => 'lutina-page-editor',
            'editor_style'    => 'lutina-page-editor',
            'render_callback' => static function ( $attributes ) use ( $type ) {
                return lutina_academy_render_page_block( $type, $attributes );
            },
        ) );
    }
}
add_action( 'init', 'lutina_academy_register_page_blocks' );

function lutina_academy_initial_page_content( $type ) {
    $fields = array();
    foreach ( lutina_academy_page_schemas()[ $type ]['fields'] as $field ) {
        $fields[ $field['key'] ] = lutina_academy_content_default( $field['default'] );
    }
    return serialize_block( array(
        'blockName'    => 'lutina/' . $type,
        'attrs'        => array( 'fields' => $fields ),
        'innerBlocks'  => array(),
        'innerHTML'    => '',
        'innerContent' => array(),
    ) );
}

function lutina_academy_setup_editable_pages() {
    if ( get_option( 'lutina_academy_editable_pages_version' ) ) {
        return;
    }

    $home_id = (int) get_option( 'page_on_front' );
    $home = $home_id ? get_post( $home_id ) : get_page_by_path( 'home' );
    $legal_id = (int) get_option( 'lutina_academy_tokushoho_page_id' );
    $legal = $legal_id ? get_post( $legal_id ) : get_page_by_path( 'tokushoho' );

    foreach ( array( 'home' => $home, 'legal' => $legal ) as $type => $page ) {
        $args = array();
        if ( ! $page ) {
            $args = array(
                'post_type' => 'page', 'post_status' => 'publish',
                'post_title' => 'home' === $type ? 'トップページ' : '特定商取引法に基づく表記',
                'post_name' => 'home' === $type ? 'home' : 'tokushoho',
                'post_content' => lutina_academy_initial_page_content( $type ),
            );
            $page_id = wp_insert_post( wp_slash( $args ), true );
        } else {
            $page_id = $page->ID;
            // Never replace content an editor has already entered.
            if ( '' === trim( $page->post_content ) ) {
                $page_id = wp_update_post( wp_slash( array(
                    'ID' => $page_id, 'post_content' => lutina_academy_initial_page_content( $type ),
                ) ), true );
            }
        }
        if ( is_wp_error( $page_id ) || ! $page_id ) {
            return;
        }
        // Keep the imported original available before the first editor change.
        wp_save_post_revision( $page_id );
        if ( 'home' === $type ) {
            update_option( 'lutina_academy_home_page_id', $page_id );
            update_option( 'page_on_front', $page_id );
            update_option( 'show_on_front', 'page' );
        } else {
            update_option( 'lutina_academy_tokushoho_page_id', $page_id );
            update_post_meta( $page_id, '_wp_page_template', 'page-tokushoho.php' );
        }
    }
    update_option( 'lutina_academy_editable_pages_version', 1 );
}
add_action( 'init', 'lutina_academy_setup_editable_pages', 30 );

function lutina_academy_page_editor_settings( $settings, $context ) {
    if ( ! empty( $context->post ) && ( has_block( 'lutina/home', $context->post ) || has_block( 'lutina/legal', $context->post ) ) ) {
        $settings['templateLock'] = 'all';
        $settings['canLockBlocks'] = false;
        $settings['codeEditingEnabled'] = false;
    }
    return $settings;
}
add_filter( 'block_editor_settings_all', 'lutina_academy_page_editor_settings', 10, 2 );
