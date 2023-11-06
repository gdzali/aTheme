<?php

class aThemeServices extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'atheme-services';
    }

    public function get_title()
    {
        return __('AT Services', 'text-domain');
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

        $this->start_controls_section(
            'slides_section',
            [
                'label' => __('Services', 'atheme'),
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Service Items', 'atheme'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __('Title', 'atheme'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Slide Title', 'atheme'),
                    ],
                    [
                        'name' => 'icon',
                        'label' => __('İcon', 'atheme'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('fa fa-solid', 'atheme'),
                    ],
                ],
                'default' => [
                    [
                        'title' => __('Service Item', 'atheme'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="wpo-service-section-s2">
            <div class="shape-1">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/scervice-shap-1.png" alt="">
            </div>
            <div class="container">
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
                if (!empty($settings['slides'])) {
                    ?>
                    <div class="scervice-wrap">
                        <div class="new-service-grid">
                            <?php
                            foreach ($settings['slides'] as $service_item) {
                                ?>
                                <div class="grid">
                                    <div class="scervice-item">
                                        <div class="scervice-item-img">
                                            <i class="<?= $service_item['icon'] ?>"></i>
                                        </div>
                                        <div class="scervice-item-text">
                                            <a href="#">
                                                <h2><?= esc_html($service_item['title']) ?></h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                }
                ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}