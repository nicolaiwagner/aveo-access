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
        // Register styles first (this method only registers, doesn't enqueue)
        wp_register_style('darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.css');
        return ['darkmode-widget'];
    }

    // Ensure this function also returns an array
    public function get_script_depends() {
        // Register scripts first
        wp_register_script('darkmode-widget', plugin_dir_url( __FILE__ ) . 'darkmode-widget.js', ['jquery'], '1.0', true);
        return ['darkmode-widget'];
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
                'description' => __( 'Vælg mellem knap eller icon til at toggle darkmode', 'aveo-access' ),
            ]
        );

        // Icon size control
        $this->add_control(
            'dark_mode_icon_font_size',
            [
                'label' => __( 'Icon Size', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'condition' => [
                    'toggle_type' => 'icon',
                ],
                'selectors' => [
                    '{{WRAPPER}} i#dark-mode-toggle-icon.darkmode-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} i#light-mode-toggle.light-mode-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        

        // Icon color control
        $this->add_control(
            'dark_mode_icon_color',
            [
                'label' => __( 'Icon Color for Darkmode', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',  // Provide a default color
                'condition' => [
                    'toggle_type' => 'icon',
                ],
                'selectors' => [
                    '{{WRAPPER}} i#dark-mode-toggle-icon.darkmode-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Light Mode Icon Color
        $this->add_control(
            'dark_mode_light_mode_icon_color',
            [
                'label' => __( 'Light Mode Icon Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff', // Default color for light mode icon
                'selectors' => [
                    '{{WRAPPER}} i#light-mode-toggle.light-mode-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'toggle_type' => 'icon',
                ],
            ]
        );

        
        

      

        // Button text field
        $this->add_control(
            'dark_mode_button_text',
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
            'dark_mode_button_padding',
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

        // Divider for controls
        $this->add_control(
            'dark_mode_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
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
                'description' => __( 'Ændre farven på bagerste HTML elementer på siden', 'aveo-access' ),
            ]
        );

        // Color picker for div element background
        $this->add_control(
            'dark_mode_div_bg_color',
            [
                'label' => __( 'Dark Mode Div Background Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
               'selectors' => [
                    'background-color: {{VALUE}};',
                ],
                'description' => __( 'Ændre baggrundsfarven på containers (div)', 'aveo-access' ),
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
                'description' => __( 'Ændre farven på overskrifter (h1, h2 etc.) ', 'aveo-access' ),
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
                'description' => __( 'Ændre farven på paragraf tekst på siden', 'aveo-access' ),
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
                'description' => __( 'Ændre farven på a tags', 'aveo-access' ),
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

        // Color picker for buttons
        $this->add_control(
            'dark_mode_button_color',
            [
                'label' => __( 'Dark Mode Button Color', 'aveo-access' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    'color: {{VALUE}};',
                ],
                'description' => __( 'Ændre baggrundsfarven på button element', 'aveo-access' ),
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
            'condition' => [
                'toggle_type' => 'button',
            ],
        ]
    );
            // Control typography for the button
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dark_mode_button_typography',
                'label' => __( 'Button Typography', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #dark-mode-toggle',
                'condition' => [
                    'toggle_type' => 'button',
                ],
            ]
        );

        // Control text color for the button
        $this->add_control(
            'dark_mode_button_text_color',
            [
                'label' => __('Button Text Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff', // Ensure default is a string
            ]
        );

        // Control text size 
        $this->add_control(
            'dark_mode_button_text_size',
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
            'dark_mode_button_background_color',
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
            'dark_mode_button_border_type',
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

        //Control border style color for buttons
        $this->add_control(
            'dark_mode_button_border_color',
            [
                'label' => __( 'Button Border Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
               'selectors' => [
                    '{{WRAPPER}} #dark-mode-toggle' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // Control border radius for the button
        $this->add_control(
            'dark_mode_button_border_radius',
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
                'name' => 'dark_mode_button_box_shadow',
                'label' => __( 'Button Box Shadows', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #dark-mode-toggle',
            ]
        );

        // Control padding (spacing) for the button
        $this->add_responsive_control(
            'dark_mode_button_spacing',
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



    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->enqueue_scripts();
    
        if ($settings['toggle_type'] === 'button') {
            echo '<button id="dark-mode-toggle" class="darkmode-toggle">' . esc_html($settings['dark_mode_button_text']) . '</button>';
        } elseif ($settings['toggle_type'] === 'icon') {
            $light_mode_icon = 'fa-regular fa-lightbulb';  // Default icon for light mode
            echo '<i id="dark-mode-toggle-icon" class="darkmode-toggle eicon-adjust"></i>';
            echo '<i id="light-mode-toggle" class="light-mode-icon ' . esc_attr($light_mode_icon) . '" style="display: none;"></i>';
        }
    
        echo '<style>';
        if (!empty($settings['dark_mode_bg_color'])) {
            echo '
                .dark-mode-bg, .dark-mode-bg header, .dark-mode-bg section, .dark-mode-bg article, .dark-mode-bg #elementor-menu-cart__main {
                    background-color: ' . $settings['dark_mode_bg_color'] . ' !important;
                }
            ';
        }
        if (!empty($settings['dark_mode_div_bg_color'])) {
            echo '
                div.dark-mode-div-bg, #e-con-inner.dark-mode-div-bg {
                    background-color: ' . $settings['dark_mode_div_bg_color'] . ' !important;
                    color: ' . $settings['dark_mode_paragraph_color'] . ' !important;
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
                p.dark-mode-paragraph, ul.dark-mode-paragraph {
                    color: ' . $settings['dark_mode_paragraph_color'] . ' !important;
                }
            ';
        }
        if (!empty($settings['dark_mode_a_color'])) {
            echo '
                a.dark-mode-link, svg.dark-mode-link  {
                    color: ' . $settings['dark_mode_a_color'] . ' !important;
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
        if (!empty($settings['dark_mode_button_color'])) {
            echo '
                button.dark-mode-button {
                    background-color: ' . $settings['dark_mode_button_color'] . ' !important;
                    color: ' . $settings['dark_mode_button_text_color'] . ' !important;
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
            <button id="dark-mode-toggle" class="darkmode-toggle">{{{ settings.dark_mode_button_text }}}</button>
        <#
        } else if (settings.toggle_type === 'icon') {
        #>
            <i id="dark-mode-toggle-icon" class="darkmode-toggle eicon-adjust"></i>
            <i id="light-mode-toggle" class="light-mode-icon fa-regular fa-lightbulb" style="display: none;"></i>
        <#
        }
        #>
        <?php
    }
    
}






