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
            'button_text',
            [
                'label' => __( 'Button Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Toggle Dark Mode', 'plugin-name' ),
                'placeholder' => __( 'Enter button text here', 'plugin-name' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <button id="dark-mode-toggle" class="darkmode-toggle"><?php echo esc_html( $settings['button_text'] ); ?></button>
        <?php
    }

    public function _content_template() {
        ?>
        <button id="dark-mode-toggle" class="darkmode-toggle">{{{ settings.button_text }}}</button>
        <?php
    }
}






