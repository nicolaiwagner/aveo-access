<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Control_Text_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'controltext_widget';
    }

    public function get_title() {
        return 'Aveo WA - Text size control';
    }

    public function get_icon() {
        return 'fa-solid fa-text-height';
    }

    public function get_style_depends() {
        // Register styles first (this method only registers, doesn't enqueue)
        wp_register_style('control-text-widget', plugin_dir_url( __FILE__ ) . 'control-text-widget.css');
        return ['control-text-widget'];
    }

    // Ensure this function also returns an array
    public function get_script_depends() {
        // Register scripts first
        wp_register_script('control-text-widget', plugin_dir_url( __FILE__ ) . 'control-text-widget.js', ['jquery'], '1.0', true);
        return ['control-text-widget'];
    }

    protected function _register_controls() {
        //Start content tab
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'aveo-access' ),
                
            ]
        );

        // Control if text or not
        $this->add_control(
            'text_size_toggle',
            [
                'label' => __( 'Vis eller skjul tekst', 'aveo-access' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Vis', 'aveo-access' ),
                'label_off' => __( 'Skjul', 'aveo-access' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Controll text for p tag
        $this->add_control(
            'text_size_label',
            [
                'label' => __( 'Tekst over toggle', 'aveo-access' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Ændre text størrelse',
            ]
        );

        // Control slider for text size label
        $this->add_control(
            'text_size_label-font-size',
            [
                'label' => __( 'Tekst størrelse over toggle', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} #text-size-label' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        // Control font family for text size label 
        $this->add_control(
            'text_size_label-font-family',
            [
                'label' => __( 'Font familie over toggle', 'aveo-access' ),
                'type' => Controls_Manager::FONT,
                'selectors' => [
                    '{{WRAPPER}} #text-size-label' => 'font-family: {{VALUE}};',
                ],
            ]
        );

        // divider for spacing between controls 
        $this->add_control(
            'divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        // Control size for button and icon
        $this->add_control(
            'button_size',
            [
                'label' => __( 'Størrelse på knapper og ikon', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Control spacing between buttons
        $this->add_control(
            'button_spacing',
            [
                'label' => __( 'Afstand mellem knapper', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Control button background color
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Baggrundsfarve på knapper', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Control button icon color
        $this->add_control(
            'button_icon_color',
            [
                'label' => __( 'Ikon farve på knapper', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Control border radius on buttons
        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border radius på knapper', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Control border size on buttons
        $this->add_control(
            'button_border_size',
            [
                'label' => __( 'Border størrelse på knapper', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Control border color on buttons
        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border farve på knapper', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-size-toggle' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        

       
 
        
        // END: Content tab
        $this->end_controls_section();

        }   


        protected function render() {
            $settings = $this->get_settings_for_display();
            $this->enqueue_scripts();
        
            // Begin output buffering to keep the code organized
            ob_start();
            ?>
            <div class="text-size-controls">
                <?php
                // Check if the label should be displayed based on the switcher control
                if ('yes' === $settings['text_size_toggle']) {
                    // The text label is displayed only if the switcher is set to 'yes'
                    ?>
                    <p id="text-size-label"><?php echo esc_html($settings['text_size_label'] ?: __('Ændre text størrelse', 'text-domain')); ?></p>
                    <?php
                }
                ?>
                <button id="decrease-text-size" class="text-size-toggle" aria-label="<?php echo esc_attr__('Decrease text size', 'text-domain'); ?>"><i class="fa fa-minus"></i></button>
                <button id="reset-text-size"  class="text-size-toggle" aria-label="<?php echo esc_attr__('Reset text size', 'text-domain'); ?>"><i class="fa fa-refresh"></i></button>
                <button id="increase-text-size" class="text-size-toggle" aria-label="<?php echo esc_attr__('Increase text size', 'text-domain'); ?>"><i class="fa fa-plus"></i></button>
            </div>
            <?php
            // End output buffering and flush output
            echo ob_get_clean();
        }
    
        public function _content_template() {
            ?>
            <div class="text-size-controls">
                <p id="text-size-label">{{{ settings.text_size_label }}}</p>
                <button class="text-size-toggle" id="decrease-text-size"  aria-label="{{{ settings.decrease_text_size_aria_label }}}">
                    <i class="fa fa-minus"></i>
                </button>
                <button class="text-size-toggle" id="reset-text-size"  aria-label="{{{ settings.reset_text_size_aria_label }}}">
                    <i class="fa fa-refresh"></i>
                </button>
                <button class="text-size-toggle" id="increase-text-size"  aria-label="{{{ settings.increase_text_size_aria_label }}}">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <?php
        }



}