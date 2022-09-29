<?php

require_once get_template_directory() . '/core/must-install-plugins.php';

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/core/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/core/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );
include_once( get_stylesheet_directory() . '/core/' . 'acf-default-fields.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

/**
 * Register Custom Navigation Walker
 */
// function register_navwalker(){
// 	require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';
// }
// add_action( 'after_setup_theme', 'register_navwalker' );


// (Optional) Hide the ACF admin menu item.
// add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
// function my_acf_settings_show_admin( $show_admin ) {
//     return false;
// }

function so17687619_jquery_add_inline() {
    wp_add_inline_script( 'jquery-core', '$ = jQuery;' );
}
add_action( 'wp_enqueue_scripts', 'so17687619_jquery_add_inline' );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Tema Ayarları',
		'menu_title'	=> 'Tema Ayarları',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Alt Kısım Ayarları',
		'menu_title'	=> 'Alt Kısım Ayarları',
		'parent_slug'	=> 'theme-general-settings',
	));
}

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );


// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function create_header_menu() {
  register_nav_menu('header_menu',__( 'Üst Menü' ));
  register_nav_menu('footer_menu',__( 'Footer Menü 1' ));
  register_nav_menu('footer_menu_2',__( 'Footer Menü 2' ));
}

add_action( 'init', 'create_header_menu' );

function hizmetlerimiz_cpt_register() {

	$labels = array(
		'name'                  => _x( 'Hizmetlerimiz', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Hizmetlerimiz', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Hizmetlerimiz', 'text_domain' ),
		'name_admin_bar'        => __( 'Hizmetlerimiz', 'text_domain' ),
		'archives'              => __( 'Hizmetlerimiz Archives', 'text_domain' ),
		'attributes'            => __( 'Hizmetlerimiz Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Hizmetlerimiz Item:', 'text_domain' ),
		'all_items'             => __( 'Tümü', 'text_domain' ),
		'add_new_item'          => __( 'Ekle', 'text_domain' ),
		'add_new'               => __( 'Ekle', 'text_domain' ),
		'new_item'              => __( 'Yeni', 'text_domain' ),
		'edit_item'             => __( 'Düzenle', 'text_domain' ),
		'update_item'           => __( 'Güncelle', 'text_domain' ),
		'view_item'             => __( 'Göster', 'text_domain' ),
		'view_items'            => __( 'Göster', 'text_domain' ),
		'search_items'          => __( 'Ara', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Uygulama görseli', 'text_domain' ),
		'set_featured_image'    => __( 'Uygulama görseli', 'text_domain' ),
		'remove_featured_image' => __( 'Kaldır', 'text_domain' ),
		'use_featured_image'    => __( 'Uygulama görseli olarak kullan', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
  $rewrite = array(
		'slug'                  => 'hizmetlerimiz',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Hizmetlerimiz', 'text_domain' ),
		'description'           => __( 'Hizmetlerimiz Açıklaması', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
    'taxonomies' => array('post_tag'),
	);
	register_post_type( 'hizmetlerimiz', $args );

}
add_action( 'init', 'hizmetlerimiz_cpt_register', 0 );

add_theme_support( 'post-thumbnails' );

function wpse_setup_theme() {
   add_theme_support( 'post-thumbnails' );
   add_image_size( 'anasayfa_hizmetler', 355, 213, true );
   add_image_size( 'hizmetler_inner_image', 703, 703, false );
   add_image_size( 'gallery_thumb', 400, 400, false );
   add_image_size( 'archiving-thumb', 233, 233, false );
}

add_action( 'after_setup_theme', 'wpse_setup_theme' );

function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

add_filter( 'get_the_archive_title', function ($title) {
       if ( is_category() ) {
               $title = single_cat_title( '', false );
           } elseif ( is_tag() ) {
               $title = single_tag_title( '', false );
           } elseif ( is_author() ) {
               $title = '<span class="vcard">' . get_the_author() . '</span>' ;
           } elseif ( is_tax() ) { //for custom post types
               $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
           } elseif (is_post_type_archive()) {
               $title = post_type_archive_title( '', false );
           }
       return $title;
   });


   function clean_custom_menu($theme_location)
      {
          if ($theme_location && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
              $menu = get_term($locations[$theme_location], 'nav_menu');
              $menu_items = wp_get_nav_menu_items($menu->term_id);
              $menu_list .= '<ul class="nav">' . "\n";
              $count = 0;
              $submenu = false;
              foreach ($menu_items as $menu_item) {
                  $link = $menu_item->url;
                  $title = $menu_item->title;
                  if (!$menu_item->menu_item_parent) {
                      $parent_id = $menu_item->ID;
                      $menu_list .= '<li class="nav-item">' . "\n";
                      $menu_list .= '<a href="' . $link . '" class="nav-link">' . $title . '</a>' . "\n";
                  }
                  if ($parent_id == $menu_item->menu_item_parent) {
                      if (!$submenu) {
                          $submenu = true;
                          $menu_list .= '<ul class="nav-dropdown">' . "\n";
                      }
                      $menu_list .= '<li class="nav-dropdown-item">' . "\n";
                      $menu_list .= '<a href="' . $link . '"class="nav-dropdown-link">' . $title . '</a>' . "\n";
                      $menu_list .= '</li>' . "\n";
                      if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu) {
                          $menu_list .= '</ul>' . "\n";
                          $submenu = false;
                      }
                  }
                  if ($menu_items[$count + 1]->menu_item_parent != $parent_id) {
                      $menu_list .= '</li>' . "\n";
                      $submenu = false;
                  }
                  $count++;
              }
              $menu_list .= '</ul>' . "\n";
          } else {
              $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
          }
          echo $menu_list;
      }

      add_action( 'phpmailer_init', 'send_smtp_email' );
       function send_smtp_email( $phpmailer ) {
         $phpmailer->isSMTP();
         $phpmailer->Host       = SMTP_HOST;
         $phpmailer->SMTPAuth   = SMTP_AUTH;
         $phpmailer->Port       = SMTP_PORT;
         $phpmailer->Username   = SMTP_USER;
         $phpmailer->Password   = SMTP_PASS;
         $phpmailer->SMTPSecure = SMTP_SECURE;
         $phpmailer->From       = SMTP_FROM;
         $phpmailer->FromName   = SMTP_NAME;
       }



add_filter( 'wpcf7_autop_or_not', '__return_false' );

function maintenance_mode() {
  if ($_GET['debug'] == 1) {
    // code...
  } else {
    if (get_field('site_bakim_modu_aktif','option')) {
      if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
        $template = locate_template('maintenance.php');
        load_template( $template );
        exit;
      }
    }
  }
}

add_action('get_header', 'maintenance_mode');


?>
