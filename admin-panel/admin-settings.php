<?php

add_action('admin_init', 'aveo_access_settings_init');
add_action('admin_menu', 'aveo_access_add_settings_menu', 60);

function aveo_access_add_settings_menu() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('aveo-addons/aveo-addons.php')) {
        add_submenu_page(
            'aveo_addons_settings', // Parent slug from the other plugin
            'Aveo Accessibility Settings', // Page title
            'Aveo Accessibility ', // Menu title
            'manage_options', // Capability
            'aveo_access', // Menu slug
            'aveo_access_options_page' // Function to display the options page
        );
    } else {
        add_submenu_page(
            'options-general.php', 
            'Aveo Accessibility Settings', 
            'Aveo Accessibility', 
            'manage_options', 
            'aveo_access', 
            'aveo_access_options_page'
        );
    }
}

function aveo_access_settings_init() {
    // Register a new setting for your plugin
    register_setting('aveoAccess', 'aveo_access_settings');

    // Add a new section to your plugin settings page
    add_settings_section(
        'aveo_access_section',
        __('Aveo Accessibility Settings', 'aveo-access'),
        'aveo_access_settings_section_callback',
        'aveoAccess'
    );

    // Add a new field for the user to input a license
   /* add_settings_field(
        'aveo_access_text_field_license',
        __('License key', 'aveo-access'),
        'aveo_access_text_field_license_render',
        'aveoAccess',
        'aveo_access_section'
    );*/
}
/*
function aveo_access_text_field_license_render() {
    // Get the current value of the setting
    $options = get_option('aveo_access_settings');
    $isApproved = aveo_elementor_check_key($options['aveo_element_text_field_license_key'])['result'];
    ?>
    <input type='text' name='aveo_access_settings[aveo_element_text_field_license_key]'>
    <?php if ($isApproved) { ?>
        <p style="font-style: italic; color: darkgreen;">License key is valid</p>
    <?php } else { ?>
        <p style="font-style: italic; color: darkred;">License key is invalid</p>
    <?php } ?>
    <?php
}
*/
function aveo_access_settings_section_callback() {
    echo __('Test', 'aveo-access');
}

function aveo_access_options_page() {
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields('aveoAccess');
        do_settings_sections('aveoAccess');
        submit_button();
        ?>
    </form>
    <?php
}