<?php
/**
 * Register new Elementor widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @param \Elementor\Core\Common\Modules\Finder\Categories_Manager $finder_categories_manager Elementor finder categories manager.
 * 
 * @return void
 */



function register_new_widgets($widgets_manager)
{

    require_once(__DIR__ . '/widgets/atheme_slider.php');
    require_once(__DIR__ . '/widgets/atheme_about.php');
    require_once(__DIR__ . '/widgets/atheme_products.php');
    require_once(__DIR__ . '/widgets/atheme_service.php');

    $widgets_manager->register(new \aThemeSlider());
    $widgets_manager->register(new \aThemeAbout());
    $widgets_manager->register(new \aThemeProducts());
    $widgets_manager->register(new \aThemeServices());

}
add_action('elementor/widgets/register', 'register_new_widgets');

?>