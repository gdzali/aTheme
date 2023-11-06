<?php

class aThemeAbout extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'atheme-about';
    }

    public function get_title()
    {
        return __('AT About', 'text-domain');
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
                'label' => __('Content', 'atheme'),
            ]
        );

        $this->add_control('title', [
            'label' => __('Title', 'atheme'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Slider Title', 'atheme'),
        ]);

        // Subtitle
        $this->add_control('subtitle', [
            'label' => __('Subtitle', 'atheme'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Slider Subtitle', 'atheme'),
        ]);

        $this->add_control('featured_text', [
            'label' => __('Featured Text', 'atheme'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Featured Text', 'atheme'),
        ]);

        // Description
        $this->add_control('description', [
            'label' => __('Description', 'atheme'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Slider Description', 'atheme'),
        ]);

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        ?>
        <div class="wpo-about-area-s2 section-padding">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="wpo-about-img">
                        <img src="<?= $settings['image']['url'] ?>" alt="<?= $settings['image']['alt'] ?>">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 colsm-12">
                    <div class="wpo-about-text">
                        <div class="wpo-about-title">
                            <span>
                                <?= esc_html($settings['title']) ?>
                            </span>
                            <h2>
                                <?= esc_html($settings['subtitle']) ?>
                            </h2>
                        </div>
                        <h5>
                            <?= esc_html($settings['featured_text']) ?>
                        </h5>
                        <p>
                            <?= esc_html($settings['description']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
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