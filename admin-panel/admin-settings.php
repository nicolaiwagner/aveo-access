<?php

add_action('admin_init', 'aveo_access_settings_init');
add_action('admin_menu', 'aveo_access_add_settings_menu', 60);

function aveo_access_add_settings_menu() {
    // include_once(ABSPATH . 'wp-admin/includes/plugin.php');
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
    echo __('', 'aveo-access');
}

function aveo_access_options_page() {
    ?>
    <style>
    .settings-content-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        width: 90%;
        text-align: start;
    }

    .settings-content-text {
        font-size: 20px;
    }

    .settings-widget-wrapper {
        display: flex;
        flex-direction: row;
        margin: 20px;
        padding: 14px;
        background-color: antiquewhite;
        width: 100%;
        gap: 20px;
    }

    .settings-widget-container {
        flex: 1;
        margin-inline: 20px;
    }

    .settings-widget-container p {
        font-size: 20px;
    }

    .settings-widget-container h2 {
        font-size: 26px;
    }
</style>
    <form action='options.php' method='post'>
        <?php settings_fields('aveoAccess'); ?>
        <?php do_settings_sections('aveoAccess'); ?>
        <div class="settings-content-wrapper">
            <p class="settings-content-text">
                Dette plugin er designet til at fremme webtilgængeligheden af Aveo's tekniske løsninger. Det er skabt for at understøtte arbejdsprocesserne og forenkle udviklingsopgaver.
                <br /><br />
                Aveo Accessibility indeholder en række tilgængeligheds Widgets, der kan implementeres for at forbedre tilgængeligheden for brugere med forskellige funktionsnedsættelser. Desuden tilbydes der adgang til PDF-filer, der indeholder vigtige oplysninger om retningslinjer, vejledninger og centrale fokusområder for at opnå optimal tilgængelighed.
                <br /><br />
                
                <p><a href="/wp-content/plugins/aveo-access/content/tjekliste-tilgængelighed.pdf" target="_blank">Tjekliste ved implementering af webtilgængelighed</a></p>
                <p><a href="/wp-content/plugins/aveo-access/content/aveowa-cheatsheet.pdf" target="_blank">Information omkring webtilgængelighed og fokuspunkter, guidelines, principper og "nice to know"</a></p>
                
                <br /><br />
                Nedenfor finder i navn på webtilgængeligheds widgets og en kort beskrivelse. Widgets kan findes i Elementor hvis plugin er aktiveret.
            </p>
            <div class="settings-widget-wrapper">
                <div class="settings-widget-container">
                    <h2>Aveo WA - Dark Mode Toggle</h2>
                    <p>
                        Denne widget gør det muligt at implementere mørkt tema på kundeløsninger. Widget kontrolpanelet giver mulighed for at brugerdefinere den tekniske løsning med udgangspunkt i løsningens designidentitet.
                        <br />
                        F.eks. bliver lyse grønne farver brugt på kundeløsningen, og det er muligt at style dark mode temaet efter mørkere grønne farver.
                    </p>
                </div>
                <div class="settings-widget-container">
                    <h2>Aveo WA - Page Reader TTS</h2>
                    <p>
                        Denne widget integrerer et TTSReader-script, som tilføjer en sideoplæser i bunden af websiden. Sideoplæseren scanner automatisk siden for overskrifter og paragrafer og læser indholdet op i kronologisk rækkefølge for brugeren. Dette gør websiden mere tilgængelig og brugervenlig, især for personer med synsbesvær eller læsevanskeligheder.
                    </p>
                </div>
                <div class="settings-widget-container">
                    <h2>Aveo WA - Text Size Control</h2>
                    <p>
                        Med denne widget kan brugeren nemt justere tekststørrelser på en hjemmeside. Det tilbyder muligheder for at gøre teksten større, mindre eller nulstille den til standardstørrelsen. Dette værktøj er designet til at forbedre læsbarheden og gøre indholdet mere tilgængeligt for alle brugere, uanset deres synsbehov.
                    </p>
                </div>
            </div>
        </div>
        <?php submit_button(); ?>
    </form>
    <?php
}
