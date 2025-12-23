<?php
function lutina_academy_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'lutina-style', get_stylesheet_uri() );

    // Enqueue main script
    wp_enqueue_script( 'lutina-main', get_template_directory_uri() . '/main.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'lutina_academy_scripts' );

