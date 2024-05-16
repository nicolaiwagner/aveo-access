<?php
/*
 * Plugin Name:       Aveo Accessibility
 * Plugin URI:        https://aveo.dk/
 * Description:       Værktøj og widgets til at forbedre tilgængelighed på hjemmesider/webshops. Kontrolpanel og information til plugin kan findes som undermenu til Aveo Addons.
 * Version:           1.0.0
 * Author:            Aveo
 * Update URI:        https://aveo.dk/
 * Text Domain:       aveo-access
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
 }

 // Include admin settings
 include_once( plugin_dir_path( __FILE__ ) . 'admin-panel/admin-settings.php' );

 // Check if Elementor is active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'elementor/elementor.php' ) ) {

   //Include widgets 
   add_action( 'init', 'aveo_access_include_widgets');
   function aveo_access_include_widgets() {
      //Include categories 
      include_once( plugin_dir_path( __FILE__ ) . 'widgets/aveo_category.php' );

   }

   add_action( 'elementor/widgets/widgets_registered', 'aveo_access_register_custom_widgets');
   function aveo_access_register_custom_widgets( $widgets_manager) {
      require_once plugin_dir_path( __FILE__ ) . 'widgets/darkmode/darkmode-widget.php';
      require_once plugin_dir_path( __FILE__ ) . 'widgets/pagereader/pagereader-widget.php';
      require_once plugin_dir_path( __FILE__ ) . 'widgets/controltext/control-text-widget.php';
      $widgets_manager->register( new \Darkmode_Widget() );
      $widgets_manager->register( new \Pagereader_Widget() );
      $widgets_manager->register( new \Control_Text_Widget() );
   }


}



