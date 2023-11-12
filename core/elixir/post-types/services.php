<?php 

function hizmetlerimiz_cpt_register()
{

    $labels = array(
        'name' => _x('Ürünlerimiz', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Ürünlerimiz', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Ürünlerimiz', 'text_domain'),
        'name_admin_bar' => __('Ürünlerimiz', 'text_domain'),
        'archives' => __('Ürünlerimiz Archives', 'text_domain'),
        'attributes' => __('Ürünlerimiz Attributes', 'text_domain'),
        'parent_item_colon' => __('Ürünlerimiz Item:', 'text_domain'),
        'all_items' => __('Tümü', 'text_domain'),
        'add_new_item' => __('Ekle', 'text_domain'),
        'add_new' => __('Ekle', 'text_domain'),
        'new_item' => __('Yeni', 'text_domain'),
        'edit_item' => __('Düzenle', 'text_domain'),
        'update_item' => __('Güncelle', 'text_domain'),
        'view_item' => __('Göster', 'text_domain'),
        'view_items' => __('Göster', 'text_domain'),
        'search_items' => __('Ara', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Uygulama görseli', 'text_domain'),
        'set_featured_image' => __('Uygulama görseli', 'text_domain'),
        'remove_featured_image' => __('Kaldır', 'text_domain'),
        'use_featured_image' => __('Uygulama görseli olarak kullan', 'text_domain'),
        'insert_into_item' => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list' => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list' => __('Filter items list', 'text_domain'),
    );
    $rewrite = array(
        'slug' => 'projects',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );
    $args = array(
        'label' => __('Ürünlerimiz', 'text_domain'),
        'description' => __('Ürünlerimiz Açıklaması', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'taxonomies' => array('post_tag'),
    );
    register_post_type('products', $args);

}
add_action('init', 'hizmetlerimiz_cpt_register', 0);

?>