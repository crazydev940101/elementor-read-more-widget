<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Elementor_Read_More_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'read_more_widget';
    }

    public function get_title() {
        return esc_html__( 'Read More Widget', 'elementor-read-more-widget' );
    }

    public function get_icon() {
        return 'eicon-toggle'; // You can set any icon for your widget
    }

    public function get_categories() {
        return [ 'basic' ]; // You can customize the category
    }

    
    // Register widget controls
    protected function register_controls() {
        $this->start_controls_section(
            'read_more_section',
            [
                'label' => esc_html__( 'Read More Content', 'elementor-read-more-widget' ),
            ]
        );
    
        // Short content WYSIWYG field
        $this->add_control(
            'short_content',
            [
                'label' => __( 'Short Content', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'This is the short version of the content.' ),
            ]
        );
    
        // Long content WYSIWYG field
        $this->add_control(
            'long_content',
            [
                'label' => __( 'Long Content', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'This is the long version of the content that will be revealed when the user clicks "Read More".' ),
            ]
        );
    
        $this->end_controls_section();

        // Add toggle button controls
        $this->start_controls_section(
            'toggle_button_section',
            [
                'label' => esc_html__( 'Toggle Button', 'elementor-read-more-widget' ),
            ]
        );

        // Button Text (Read More/Read Less)
        $this->add_control(
            'read_more_text',
            [
                'label' => __( 'Read More Text', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'elementor-read-more-widget' ),
            ]
        );

        $this->add_control(
            'read_less_text',
            [
                'label' => __( 'Read Less Text', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read Less', 'elementor-read-more-widget' ),
            ]
        );

        // Button Normal Color
        $this->add_control(
            'button_color',
            [
                'label' => __( 'Button Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Background Color
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Color
        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Button Hover Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-toggle:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Background Color
        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Button Hover Background Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-toggle:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    
        // Add style controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style', 'elementor-read-more-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
    
        // Short Content Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_content_typography',
                'label' => __( 'Short Content Typography', 'elementor-read-more-widget' ),
                'selector' => '{{WRAPPER}} .short-content',
            ]
        );
    
        // Short Content Color
        $this->add_control(
            'short_content_color',
            [
                'label' => __( 'Short Content Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .short-content' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        // Long Content Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'long_content_typography',
                'label' => __( 'Long Content Typography', 'elementor-read-more-widget' ),
                'selector' => '{{WRAPPER}} .long-content',
            ]
        );
    
        // Long Content Color
        $this->add_control(
            'long_content_color',
            [
                'label' => __( 'Long Content Color', 'elementor-read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .long-content' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        // Toggle Button Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'toggle_button_typography',
                'label' => __( 'Toggle Button Typography', 'elementor-read-more-widget' ),
                'selector' => '{{WRAPPER}} .read-more-toggle',
            ]
        );
    
        $this->end_controls_section();
    }


    // Render widget output in the frontend
    protected function render() {
        $settings = $this->get_settings_for_display();
        $short_content = $settings['short_content'];
        $long_content = $settings['long_content'];
        $read_more_text = $settings['read_more_text'];
        $read_less_text = $settings['read_less_text'];
        
        echo '<div class="read-more-container">';
        
        // Apply styles inline for short content
        echo '<div class="short-content">' . wp_kses_post($short_content) . '</div>';
        
        // Apply styles inline for long content
        echo '<div class="long-content">' . wp_kses_post($long_content) . '</div>';
                
        // Toggle button
        echo '<a href="#" class="read-more-toggle" data-read-more="' . esc_attr($read_more_text) . '" data-read-less="' . esc_attr($read_less_text) . '">' . esc_html($read_more_text) . '</a>';

        echo '</div>';
    }

    // Render widget output in the editor (for Elementor preview)
    protected function content_template() {
        ?>
         <div class="read-more-container">
            <div class="short-content">{{{ settings.short_content }}}</div>
            <div class="long-content" style="display:none;">{{{ settings.long_content }}}</div>
            <a href="#" class="read-more-toggle" data-read-more="{{ settings.read_more_text }}" data-read-less="{{ settings.read_less_text }}">{{ settings.read_more_text }}</a>
        </div>
        <?php
    }
}
