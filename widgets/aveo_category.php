<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action( 'elementor/elements/categories_registered', 'aveo_access_register_custom_category' );
function aveo_access_register_custom_category( $elements_manager ) {
    $elements_manager->add_category(
        'aveo access',
        [
            'title' => __( 'Aveo', 'aveo-access' ),
            'icon' => 'font', // You can use any eicon or font-awesome icon here
        ],
        1 // Position
    );
}