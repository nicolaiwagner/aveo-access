<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Darkmode_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'darkmode_widget';
    }

    public function get_title() {
        return 'Aveo WA - Dark Mode Toggle';
    }

    public function get_icon() {
        return 'eicon-adjust';
    }

    public function get_style_depends() {
        wp_enqueue_script( 'darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_style( 'darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.css' );
    }

    protected function _register_controls() {
        //Start content tab
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'aveo-access' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        // Toggle type icon/button
        $this->add_control(
            'toggle_type',
            [
                'label' => __( 'Toggle Type', 'aveo-access' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'button' => __( 'Button', 'aveo-access' ),
                    'icon' => __( 'Icon', 'aveo-access' ),
                ],
                'default' => 'button',
                'description' => __( 'Choose between a button or an icon for the dark mode toggle.', 'aveo-access' ),
            ]
        );

      

        // Button text field
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'aveo-access' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Toggle Dark Mode', 'aveo-access' ),
                'placeholder' => __( 'Enter button text here', 'aveo-access' ),
                'condition' => [
                    'toggle_type' => 'button',
                ],
                'default' => 'Darkmode',
            ]
        );
        // Button size control
        $this->add_control(
            'button_padding',
            [
                'label' => __( 'Button Size', 'aveo-access' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '5px 10px'  => __( 'Extra Small', 'aveo-access' ),
                    '8px 16px'  => __( 'Small', 'aveo-access' ),
                    '10px 20px' => __( 'Medium', 'aveo-access' ),
                    '15px 30px' => __( 'Large', 'aveo-access' ),
                    '20px 40px' => __( 'Extra Large', 'aveo-access' ),
                ],
                'default' => '10px 20px',
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'padding: {{VALUE}};',
                ],
                'condition' => [
                    'toggle_type' => 'button',
                ],
            ]
        );
        
        
        

        //Color picker for dark mode background
        $this->add_control(
            'dark_mode_bg_color',
            [
                'label' => __( 'Dark Mode Background Color', 'aveo-access' ),
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
                'label' => __( 'Dark Mode Header Text Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'color: {{VALUE}};',
                ],
            ]
        );

        //Color picker for paragraph text
        $this->add_control(
            'dark_mode_paragraph_color',
            [
                'label' => __( 'Dark Mode Paragraph Text Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'color: {{VALUE}}; ',
                ],
            ]
        );

        //Color picker for a tags
        $this->add_control(
            'dark_mode_a_color',
            [
                'label' => __( 'Dark Mode A Tag Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'color: {{VALUE}};',
                ],
            ]
        );

        // Color picker for span tags 
        $this->add_control(
            'dark_mode_span_color',
            [
                'label' => __( 'Dark Mode Span Tag Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'color: {{VALUE}};',
                ],
            ]
        ); 

        
   
        // END: Content tab
        $this->end_controls_section();
    

    // START: Style tab
    $this->start_controls_section(
        'section_style',
        [
            'label' => __( 'Style', 'aveo-access' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
            // Control typography for the button
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Button Typography', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #dark-mode-toggle',
                'condition' => [
                    'toggle_type' => 'button',
                ],
            ]
        );

        // Control text color for the button
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Button Text Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Control text size 
        $this->add_control(
            'button_text_size',
            [
                'label' => __( 'Button Text Size', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        // Control background color for the button
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Control border style for the button
        $this->add_control(
            'button_border_type',
            [
                'label' => __( 'Button Border Type', 'aveo-access' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'aveo-access' ),
                    'solid' => __( 'Solid', 'aveo-access' ),
                    'dotted' => __( 'Dotted', 'aveo-access' ),
                    'dashed' => __( 'Dashed', 'aveo-access' ),
                    'double' => __( 'Double', 'aveo-access' ),
                    'groove' => __( 'Groove', 'aveo-access' ),
                    'ridge' => __( 'Ridge', 'aveo-access' ),
                    'inset' => __( 'Inset', 'aveo-access' ),
                    'outset' => __( 'Outset', 'aveo-access' ),
                ],
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        // Control border radius for the button
        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'aveo-access' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Control box shadows for the button
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => __( 'Button Box Shadows', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #dark-mode-toggle',
            ]
        );

        // Control padding (spacing) for the button
        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => __( 'Button Spacing', 'aveo-access' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


            
        // END: Style tab
        $this->end_controls_section();

        }                  
                
    
//.dark-mode-bg, div.dark-mode-bg, .dark-mode-bg header, .dark-mode-bg section, .dark-mode-bg article, dark-mode-bg ul




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
                .dark-mode-bg, .dark-mode-bg div, .dark-mode-bg header, .dark-mode-bg section, .dark-mode-bg article {
                    background-color: ' . $settings['dark_mode_bg_color'] . ';
                    
                }
            ';
        }

        if (!empty($settings['dark_mode_header_color'])) {
            echo '
                h1.dark-mode-header, h2.dark-mode-header, h3.dark-mode-header, h4.dark-mode-header, h5.dark-mode-header, h6.dark-mode-header {
                    color: ' . $settings['dark_mode_header_color'] . ' !important;
                }
            ';
        }
        if (!empty($settings['dark_mode_paragraph_color'])) {
            echo '
                p.dark-mode-paragraph {
                    color: ' . $settings['dark_mode_paragraph_color'] . ' !important;
                    
                }
            ';
        }
        if (!empty($settings['dark_mode_a_color'])) {
            echo '
                a.dark-mode-link  {
                    color: ' . $settings['dark_mode_a_color'] . ' !important;
                    background-color: ' . $settings['dark_mode_bg_color'] . ' !important;
                }
            ';
        }
        if (!empty($settings['dark_mode_span_color'])) {
            echo '
                span.dark-mode-span {
                    color: ' . $settings['dark_mode_span_color'] . ' !important;
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






