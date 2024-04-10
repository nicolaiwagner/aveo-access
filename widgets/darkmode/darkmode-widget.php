<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Darkmode_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'darkmode_widget';
    }

    public function get_title() {
        return 'Dark Mode Toggle';
    }

    public function get_icon() {
        return 'eicon-adjust';
    }

    public function get_style_depends() {
        wp_enqueue_script( 'darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_style( 'darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.css' );
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'toggle_type',
            [
                'label' => __( 'Toggle Type', 'plugin-name' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'button' => __( 'Button', 'plugin-name' ),
                    'icon' => __( 'Icon', 'plugin-name' ),
                ],
                'default' => 'button',
                'description' => __( 'Choose between a button or an icon for the dark mode toggle.', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Toggle Dark Mode', 'plugin-name' ),
                'placeholder' => __( 'Enter button text here', 'plugin-name' ),
                'condition' => [
                    'toggle_type' => 'button',
                ],
            ]
        );

        //Color picker for dark mode background
        $this->add_control(
            'dark_mode_bg_color',
            [
                'label' => __( 'Dark Mode Background Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'background-color: {{VALUE}}; color: white;',
                ],
            ]
        );

        //Color picker for dark mode text
        $this->add_control(
            'dark_mode_header_color',
            [
                'label' => __( 'Dark Mode Header Text Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dark-mode-header, 
                    {{WRAPPER}} .dark-mode-header h1, 
                    {{WRAPPER}} .dark-mode-header h2, 
                    {{WRAPPER}} .dark-mode-header h3, 
                    {{WRAPPER}} .dark-mode-header h4, 
                    {{WRAPPER}} .dark-mode-header h5, 
                    {{WRAPPER}} .dark-mode-header h6' => 'color: {{VALUE}};',
                ],
            ]
        );

    

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['toggle_type'] === 'button') {
            ?>
            <button id="dark-mode-toggle" class="darkmode-toggle"><?php echo esc_html($settings['button_text']); ?></button>
            <?php
        } elseif ($settings['toggle_type'] === 'icon') {
            ?>
            <i id="dark-mode-toggle" class="darkmode-toggle eicon-adjust"></i>
            <?php
        }
        echo '<style>';
        if (!empty($settings['dark_mode_bg_color'])) {
            echo '
                .dark-mode-bg, .dark-mode-bg div, .dark-mode-bg header, .dark-mode-bg section, .dark-mode-bg article, .dark-mode-bg body, dark-mode-bg #e-con-inner {
                    background-color: ' . $settings['dark_mode_bg_color'] . ';
                    color: white; /* Ensure text readability */
                }
            ';
        }

        if (!empty($settings['dark_mode_header_color'])) {
            echo '
                .dark-mode-header, .dark-mode-header h1, .dark-mode-header h2, .dark-mode-header h3, .dark-mode-header h4, .dark-mode-header h5, .dark-mode-header h6 {
                    color: ' . $settings['dark_mode_header_color'] . ';
                }
            ';
        }
        echo '</style>';
    }

    public function _content_template() {
        ?>
        <#
        if (settings.toggle_type === 'button') {
        #>
            <button id="dark-mode-toggle" class="darkmode-toggle">{{{ settings.button_text }}}</button>
        <#
        } else if (settings.toggle_type === 'icon') {
        #>
            <i id="dark-mode-toggle" class="darkmode-toggle eicon-adjust"></i>
        <#
        }
        #>
        <?php
    }
}






