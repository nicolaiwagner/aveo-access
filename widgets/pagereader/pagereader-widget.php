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
                'description' => __( 'Vælg mellem knap eller icon til at toggle tekstoplæser', 'aveo-access' ),
            ]
        );

        // Icon size control
        $this->add_control(
            'page_reader_icon_font_size',
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
                    '{{WRAPPER}} i#page-reader-toggle.pagereader-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} i#page-reader-toggle-off.page-reader-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        

        // Icon color control
        $this->add_control(
            'page_reader_icon_color',
            [
                'label' => __( 'Turn On TTS - Icon Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',  // Provide a default color
                'condition' => [
                    'toggle_type' => 'icon',
                ],
                'selectors' => [
                    '{{WRAPPER}} i#page-reader-toggle.pagereader-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );
        // TTS on Icon Color 
        
        $this->add_control(
            'page_reader_light_mode_icon_color',
            [
                'label' => __( 'Turn Off TTS - Icon Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff', // Default color for light mode icon
                'selectors' => [
                    '{{WRAPPER}} i#page-reader-toggle-off.page-reader-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'toggle_type' => 'icon',
                ],
            ]
        );

        
        

      

        // Button text field
        $this->add_control(
            'page_reader_button_text',
            [
                'label' => __( 'Button Text', 'aveo-access' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Toggle TTS', 'aveo-access' ),
                'placeholder' => __( 'Enter button text here', 'aveo-access' ),
                'condition' => [
                    'toggle_type' => 'button',
                ],
                'default' => 'Page Reader Button',
            ]
        );
        // Button size control
        $this->add_control(
            'page_reader_button_padding',
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
                    '{{WRAPPER}} #page-reader-toggle-button' => 'padding: {{VALUE}};',
                ],
                'condition' => [
                    'toggle_type' => 'button',
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
            'condition' => [
                'toggle_type' => 'button',
            ],
        ]
    );
            // Control typography for the button
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'page_reader_button_typography',
                'label' => __( 'Button Typography', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #page-reader-toggle-button',
                'condition' => [
                    'toggle_type' => 'button',
                ],
            ]
        );

        // Control text color for the button
        $this->add_control(
            'page_reader_button_text_color',
            [
                'label' => __('Button Text Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff', // Ensure default is a string
            ]
        );

        // Control text size 
        $this->add_control(
            'page_reader_button_text_size',
            [
                'label' => __( 'Button Text Size', 'aveo-access' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        // Control background color for the button
        $this->add_control(
            'page_reader_button_background_color',
            [
                'label' => __( 'Button Background Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Control border style for the button
        $this->add_control(
            'page_reader_button_border_type',
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
                    '{{WRAPPER}} #page-reader-toggle-button' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        //Control border style color for buttons
        $this->add_control(
            'page_reader_button_border_color',
            [
                'label' => __( 'Button Border Color', 'aveo-access' ),
                'type' => Controls_Manager::COLOR,
               'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // Control border radius for the button
        $this->add_control(
            'page_reader_button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'aveo-access' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Control box shadows for the button
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'page_reader_button_box_shadow',
                'label' => __( 'Button Box Shadows', 'aveo-access' ),
                'selector' => '{{WRAPPER}} #page-reader-toggle-button',
            ]
        );

        // Control padding (spacing) for the button
        $this->add_responsive_control(
            'page_reader_button_spacing',
            [
                'label' => __( 'Button Spacing', 'aveo-access' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #page-reader-toggle-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                ?>
                <button id="page-reader-toggle-button" class="pagereader-toggle"><?php echo esc_html($settings['page_reader_button_text']); ?></button>
                <?php
            } elseif ($settings['toggle_type'] === 'icon') {
                $light_mode_icon = 'fa-solid fa-book-open';  // Default icon for light mode
                ?>
                <i id="page-reader-toggle" class="pagereader-toggle fa-solid fa-book"></i>
                <i id="page-reader-toggle-off" class="page-reader-icon <?php echo esc_attr($light_mode_icon); ?>" style="display: none;"></i>
                <?php
            }
    
    
           
        } 
        
        
    
        public function _content_template() {
            ?>
            <#
            if (settings.toggle_type === 'button') {
            #>
                <button id="page-reader-toggle-button" class="pagereader-toggle">{{{ settings.page_reader_button_text }}}</button>
            <#
            } else if (settings.toggle_type === 'icon') {
            #>
                <i id="page-reader-toggle" class="pagereader-toggle fa-solid fa-book"></i>
            <#
            }
            #>
            <?php
        } 



}