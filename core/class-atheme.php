<?php

class aTheme
{
    public function __construct()
    {
        $this->define_constants();
        $this->include_tax_post_type();
        $this->setup_theme();
        $this->add_filters();
        $this->add_actions();
    }

    private function add_filters()
    {
        add_filter('acf/settings/url', 'my_acf_settings_url');
        add_filter('wpcf7_autop_or_not', '__return_false');
        add_filter('get_the_archive_title', 'custom_Archive_title');
        if (ATHEME_DISABLE_GUTENBERG) {
            add_filter('use_block_editor_for_post', '__return_false', 10);
            add_filter('gutenberg_use_widgets_block_editor', '__return_false', 100);
            add_filter('use_block_editor_for_post_type', '__return_false', 10);
        }
    }

    private function add_actions()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_files'));
        add_action('get_header', 'maintenance_mode');
        add_action('wp_enqueue_scripts', 'so17687619_jquery_add_inline');
        add_action('after_setup_theme', 'wpse_setup_theme');
        add_action('init', 'create_header_menu');
        add_action('phpmailer_init', 'send_smtp_email');
        add_action('admin_enqueue_scripts', 'enqueue_admin_style');

    }

    private function define_constants()
    {
        if (!defined('ATHEME_VERSION_NUM'))
            define('ATHEME_VERSION_NUM', '2.0');

        if (!defined('ATHEME'))
            define('ATHEME', get_template());

        if (!defined('ATHEME_ELEMENTOR_ENABLED'))
            define('ATHEME_ELEMENTOR_ENABLED', checked(1, get_option('elementor_enabled', ''), false));

        if (!defined('ATHEME_DISABLE_GUTENBERG'))
            define('ATHEME_DISABLE_GUTENBERG', checked(1, get_option('disable_gutenberg', ''), false));

        if (!defined('ATHEME_MAINTENANCE'))
            define('ATHEME_MAINTENANCE', checked(1, get_option('maintenance_mode', ''), false));

        if (!defined('ATHEME_THEME_DIR'))
            define('ATHEME_THEME_DIR', get_template_directory());

        if (!defined('ATHEME_THEME_URL'))
            define('ATHEME_THEME_URL', get_template_directory_uri());

        if (!defined('ATHEME_THEME_URL_POST_TYPES'))
            define('ATHEME_THEME_URL_POST_TYPES', get_template_directory() . '/core/elixir/post-types');

        if (!defined('ATHEME_THEME_URL_TAXONOMY'))
            define('ATHEME_THEME_URL_TAXONOMY', get_template_directory_uri() . '/core/elixir/taxonomy');

        if (!defined('ATHEME_THEME_URL_JS'))
            define('ATHEME_THEME_URL_JS', get_template_directory() . '/core/assets/js');

        if (!defined('ATHEME_THEME_URL_CSS'))
            define('ATHEME_THEME_URL_CSS', get_template_directory() . '/core/assets/css');

        if (!defined('ATHEME_THEME_URL_IMG'))
            define('ATHEME_THEME_URL_IMG', get_template_directory_uri() . '/core/assets/image');

        if (!defined('ATHEME_THEME_START_FUNC'))
            define('ATHEME_THEME_START_FUNC', get_template_directory_uri() . '/core/elixir/functions.php');

        if (!defined('ATHEME_THEME_START_CUSTOM_FUNC'))
            define('ATHEME_THEME_START_CUSTOM_FUNC', get_template_directory_uri() . '/core/elixir/custom_func');

        if (ATHEME_ELEMENTOR_ENABLED) {
            if (!defined('ATHEME_THEME_START_ELEMENTOR'))
                define('ATHEME_THEME_START_ELEMENTOR', get_template_directory_uri() . '/core/elementor');

            if (!defined('ATHEME_THEME_START_ELEMENTOR_WIDGETS_DIR'))
                define('ATHEME_THEME_START_ELEMENTOR_WIDGETS_DIR', get_template_directory_uri() . '/core/elementor/widgets');

            require_once (ATHEME_THEME_DIR . '/core/elementor/widgets.php');
        }

        if (!defined('ATHEME_THEME_ADMIN'))
            define('ATHEME_THEME_ADMIN', get_template_directory() . '/core/admin/');

        if (ATHEME_THEME_ADMIN) {
            require_once (ATHEME_THEME_ADMIN . '/admin.php');
            function enqueue_admin_style()
            {
                wp_enqueue_style('admin-style', ATHEME_THEME_ADMIN . '/css/admin.css');
            }
        }

        require_once (ATHEME_THEME_DIR . '/core/must-install-plugins.php');
    }

    public function enqueue_custom_files()
    {
        // Enqueue all CSS files
        $css_files = glob(ATHEME_THEME_URL_CSS . '/*.css');
        foreach ($css_files as $css_file) {
            $handle = 'custom-style-' . basename($css_file, '.css');
            wp_enqueue_style($handle, get_template_directory_uri() . '/core/assets/css/' . basename($css_file));
        }

        // Enqueue all JS files
        $js_files = glob(ATHEME_THEME_URL_JS . '/*.js');
        foreach ($js_files as $js_file) {
            $handle = 'custom-script-' . basename($js_file, '.js');
            wp_enqueue_script($handle, get_template_directory_uri() . '/core/assets/js/' . basename($js_file), array(), null, true);
        }
    }

    private function include_tax_post_type()
    {
        $post_types = glob(ATHEME_THEME_URL_POST_TYPES . '/*.php');

        foreach ($post_types as $file) {
            if (file_exists($file)) {
                require_once $file;
            }
        }

        $taxonomy = glob(ATHEME_THEME_URL_TAXONOMY . '/*.php');

        foreach ($taxonomy as $file_tax) {
            if (file_exists($file_tax)) {
                require_once $file_tax;
            }
        }
    }

    private function setup_theme()
    {
        function maintenance_mode()
        {
            if (ATHEME_MAINTENANCE) {
                if (isset ($_GET['atheme_debug'])) {
                    if ($_GET['atheme_debug'] == 1) {
                    } else {
                        if (!current_user_can('edit_themes') || !is_user_logged_in()) {
                            $template = locate_template('maintenance.php');
                            load_template($template);
                            exit;
                        }
                    }
                }
            }
        }
        // Define path and URL to the ACF plugin.
        define('MY_ACF_PATH', get_stylesheet_directory() . '/core/acf/');
        define('MY_ACF_URL', get_stylesheet_directory_uri() . '/core/acf/');

        // Include the ACF plugin.
        include_once (MY_ACF_PATH . 'acf.php');

        // Customize the url setting to fix incorrect asset URLs.
        function my_acf_settings_url($url)
        {
            return MY_ACF_URL;
        }
        function so17687619_jquery_add_inline()
        {
            wp_add_inline_script('jquery-core', '$ = jQuery;');
        }

        function create_header_menu()
        {
            register_nav_menu('header_menu', __('Üst Menü'));
            register_nav_menu('footer_menu', __('Footer Menü 1'));
            register_nav_menu('footer_menu_2', __('Footer Menü 2'));
        }


        add_theme_support('post-thumbnails');

        function wpse_setup_theme()
        {
            add_theme_support('post-thumbnails');
            add_image_size('anasayfa_hizmetler', 355, 213, true);
            add_image_size('hizmetler_inner_image', 703, 703, false);
            add_image_size('gallery_thumb', 400, 400, false);
            add_image_size('archiving-thumb', 233, 233, false);
        }


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

        function custom_archive_title($title)
        {
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
        }

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

    }
}

?>