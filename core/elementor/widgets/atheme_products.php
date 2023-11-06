<?php

class aThemeProducts extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'atheme-products';
    }

    public function get_title()
    {
        return __('AT Products', 'text-domain');
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

        $this->end_controls_section();

    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="wpo-project-area-s2 section-padding">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="wpo-section-title">
                            <span>
                                <?= esc_html($settings['subtitle']) ?>
                            </span>
                            <h2>
                                <?= esc_html($settings['title']) ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <?php
                $args = array(
                    'post_type' => 'products',
                    'posts_per_page' => -1,
                );

                $products_query = new WP_Query($args);

                if ($products_query->have_posts()) {
                    ?>
                    <div class="row align-items-center">
                        <div style="padding-bottom: 100px !important;" class="project-wrapper">
                            <div class="container-fluid">
                                <div class="row project-slider">
                                    <?php
                                    while ($products_query->have_posts()) {
                                        $products_query->the_post();
                                        ?>
                                        <div class="col-lg-3">
                                            <div class="project-single">
                                                <div class="project-single-img">
                                                <a href="<?= bloginfo('wpurl') ?>">
                                                                <img src="<?= get_the_post_thumbnail_url() ?>"
                                                                    alt="<?= the_title(); ?>">
                                                                </a>
                                                </div>
                                                <div class="project-single-text">
                                                    <span><?= get_field('slogan') ?></span>
                                                    <a href="<?= the_permalink() ?>">
                                                        <h2><?= the_title(); ?></h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    wp_reset_postdata(); // Reset the post data
                } else {
                    // No products found
                }

                ?>
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