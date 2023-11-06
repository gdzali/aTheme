<?php

class aThemeSlider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'atheme-slider';
    }

    public function get_title()
    {
        return __('AT Slider', 'text-domain');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['atheme'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'slides_section',
            [
                'label' => __('Slides', 'at-slider-widget'),
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slide Items', 'at-slider-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __('Title', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Slide Title', 'at-slider-widget'),
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __('Subtitle', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Slide Subtitle', 'at-slider-widget'),
                    ],
                    [
                        'name' => 'description',
                        'label' => __('Description', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Slide Description', 'at-slider-widget'),
                    ],
                    [
                        'name' => 'button_enabled',
                        'label' => __('Enable Button', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'default' => 'yes',
                    ],
                    [
                        'name' => 'button_text',
                        'label' => __('Button Text', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Read More', 'at-slider-widget'),
                        'condition' => ['button_enabled' => 'yes'],
                    ],
                    [
                        'name' => 'button_link',
                        'label' => __('Button Link', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'default' => [
                            'url' => 'https://example.com',
                        ],
                        'condition' => ['button_enabled' => 'yes'],
                    ],
                    [
                        'name' => 'bg_image',
                        'label' => __('Background Image', 'at-slider-widget'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],

                ],
                'default' => [
                    [
                        'title' => __('Slide 1', 'at-slider-widget'),
                        'subtitle' => __('Subtitle 1', 'at-slider-widget'),
                        'description' => __('Description 1', 'at-slider-widget'),
                        'button_enabled' => 'yes',
                        'button_text' => __('Read More', 'at-slider-widget'),
                        'button_link' => [
                            'url' => 'https://example.com',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function get_event_post_options()
    {

        $options = [];

        $event_posts = get_posts([
            'post_type' => 'event',
            'numberposts' => -1,
        ]);

        if ($event_posts) {
            foreach ($event_posts as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        include('views/view_atheme_slider.php');
    }

    protected function get_custom_post_types_options()
    {
        $post_types = get_post_types(['public' => true], 'objects');
        $options = [];

        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }

        return $options;
    }


}