<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Define constants
 *
 * @since 1.0
 */

if (!defined('ATHEME_VERSION_NUM'))
    define('ATHEME_VERSION_NUM', '2.0');

if (!defined('ATHEME'))
    define('ATHEME', get_template());

if (!defined('ATHEME_ELEMENTOR_ENABLED'))
    define('ATHEME_ELEMENTOR_ENABLED', true);

if (!defined('ATHEME_THEME_DIR'))
    define('ATHEME_THEME_DIR', get_template_directory());

if (!defined('ATHEME_THEME_URL'))
    define('ATHEME_THEME_URL', get_template_directory_uri());

if (!defined('ATHEME_THEME_URL_POST_TYPES'))
    define('ATHEME_THEME_URL', get_template_directory_uri() . '/core/elixir/post-types');

if (!defined('ATHEME_THEME_URL_TAXONOMY'))
    define('ATHEME_THEME_URL', get_template_directory_uri() . '/core/elixir/taxonomy');

if (!defined('ATHEME_THEME_URL_JS'))
    define('ATHEME_THEME_URL_JS', get_template_directory_uri() . '/core/assets/js');

if (!defined('ATHEME_THEME_URL_CSS'))
    define('ATHEME_THEME_URL_CSS', get_template_directory_uri() . '/core/assets/css');

if (!defined('ATHEME_THEME_URL_IMG'))
    define('ATHEME_THEME_URL_CSS', get_template_directory_uri() . '/core/assets/image');

if (!defined('ATHEME_THEME_START_FUNC'))
    define('ATHEME_THEME_START_FUNC', get_template_directory_uri() . '/core/elixir/functions.php');

if (!defined('ATHEME_THEME_START_CUSTOM_FUNC'))
    define('ATHEME_THEME_START_CUSTOM_FUNC', get_template_directory_uri() . '/core/elixir/custom_func');

if (ATHEME_ELEMENTOR_ENABLED) {
    if (!defined('ATHEME_THEME_START_ELEMENTOR'))
        define('ATHEME_THEME_START_ELEMENTOR', get_template_directory_uri() . '/core/elementor');

    if (!defined('ATHEME_THEME_START_ELEMENTOR_WIDGETS_DIR'))
        define('ATHEME_THEME_START_ELEMENTOR_WIDGETS_DIR', get_template_directory_uri() . '/core/elementor/widgets');

    require_once(ATHEME_THEME_DIR . '/core/elementor/widgets.php');
}


require_once(ATHEME_THEME_DIR . '/core/must-install-plugins.php');
require_once(ATHEME_THEME_DIR . '/core/elixir/widgets.php');

$post_types = glob(ATHEME_THEME_URL_POST_TYPES . '*.php');
$taxonomy = glob(ATHEME_THEME_URL_TAXONOMY . '*.php');
$custom_func = glob(ATHEME_THEME_START_CUSTOM_FUNC . '*.php');

foreach (array_combine($post_types, $taxonomy, ) as $file) {
    if (file_exists($file)) {
        require_once $file;
    }
}

function enqueue_files_from_folder() {

    // Enqueue all CSS files
    $css_files = glob(ATHEME_THEME_URL_CSS . '/*.css');
    foreach ($css_files as $css_file) {
        $handle = 'custom-style-' . basename($css_file, '.css');
        wp_enqueue_style($handle, get_template_directory_uri() . '/assets/css/' . basename($css_file));
    }

    // Enqueue all JS files
    $js_files = glob(ATHEME_THEME_URL_JS . '/*.js');
    foreach ($js_files as $js_file) {
        $handle = 'custom-script-' . basename($js_file, '.js');
        wp_enqueue_script($handle, get_template_directory_uri() . '/assets/js/' . basename($js_file), array(), null, true);
    }
}

add_action('wp_enqueue_scripts', 'enqueue_files_from_folder');

// Define path and URL to the ACF plugin.
define('MY_ACF_PATH', get_stylesheet_directory() . '/core/acf/');
define('MY_ACF_URL', get_stylesheet_directory_uri() . '/core/acf/');

// Include the ACF plugin.
include_once(MY_ACF_PATH . 'acf.php');
include_once(get_stylesheet_directory() . '/core/' . 'acf-default-fields.php');

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url($url)
{
    return MY_ACF_URL;
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/core/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');


function so17687619_jquery_add_inline()
{
    wp_add_inline_script('jquery-core', '$ = jQuery;');
}
add_action('wp_enqueue_scripts', 'so17687619_jquery_add_inline');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Tema Ayarları',
            'menu_title' => 'Tema Ayarları',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' => 'Alt Kısım Ayarları',
            'menu_title' => 'Alt Kısım Ayarları',
            'parent_slug' => 'theme-general-settings',
        )
    );
}

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('gutenberg_use_widgets_block_editor', '__return_false', 100);


// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function create_header_menu()
{
    register_nav_menu('header_menu', __('Üst Menü'));
    register_nav_menu('footer_menu', __('Footer Menü 1'));
    register_nav_menu('footer_menu_2', __('Footer Menü 2'));
}

add_action('init', 'create_header_menu');

add_theme_support('post-thumbnails');

function wpse_setup_theme()
{
    add_theme_support('post-thumbnails');
    add_image_size('anasayfa_hizmetler', 355, 213, true);
    add_image_size('hizmetler_inner_image', 703, 703, false);
    add_image_size('gallery_thumb', 400, 400, false);
    add_image_size('archiving-thumb', 233, 233, false);
}

add_action('after_setup_theme', 'wpse_setup_theme');

function get_excerpt($limit, $source = null)
{

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});


add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_HOST;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->Username = SMTP_USER;
    $phpmailer->Password = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_NAME;
}

add_filter('wpcf7_autop_or_not', '__return_false');

function maintenance_mode()
{
    if (isset($_GET['debug'])) {
        if ($_GET['debug'] == 1) {
            // code...
        } else {
            if (get_field('site_bakim_modu_aktif', 'option')) {
                if (!current_user_can('edit_themes') || !is_user_logged_in()) {
                    $template = locate_template('maintenance.php');
                    load_template($template);
                    exit;
                }
            }
        }
    }
}

add_action('get_header', 'maintenance_mode');


function enqueue_custom_styles()
{
    wp_enqueue_style('main-css', get_template_directory_uri() . '/core/assets/css/main.css', array(), '', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


function enqueue_custom_script()
{
    wp_enqueue_script('main-js', get_template_directory_uri() . '/core/assets/js/main.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_script');

?>