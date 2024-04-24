<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Pagereader_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'pagereader_widget';
    }

    public function get_title() {
        return 'Aveo WA - Page Reader TTS';
    }

    public function get_icon() {
        return 'fa-solid fa-book-open-reader';
    }

    public function get_style_depends() {
        // Register styles first (this method only registers, doesn't enqueue)
        wp_register_style('pagereader-widget', plugin_dir_url( __FILE__ ) . 'pagereader-widget.css');
        return ['pagereader-widget'];
    }

    // Ensure this function also returns an array
    public function get_script_depends() {
        // Register scripts first
        wp_register_script('pagereader-widget', plugin_dir_url( __FILE__ ) . 'pagereader-widget.js', ['jquery'], '1.0', true);
        return ['pagereader-widget'];
    }




}