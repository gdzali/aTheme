<?php 

// Add a custom menu item to the admin menu
function add_custom_settings_menu() {
    add_menu_page(
        'Site Settings',
        'Site Settings',
        'manage_options',
        'custom-settings',
        'render_custom_settings_page'
    );
}

add_action('admin_menu', 'add_custom_settings_menu');

// Render the settings page
function render_custom_settings_page() {
    ?>
    <div class="wrap">
        <h1>Site Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('custom_settings_group');
            do_settings_sections('custom-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register and define settings
function register_custom_settings() {
    register_setting('custom_settings_group', 'elementor_enabled');
    register_setting('custom_settings_group', 'maintenance_mode');
    register_setting('custom_settings_group', 'disable_gutenberg');
    register_setting('custom_settings_group', 'email_address');
    register_setting('custom_settings_group', 'phone_number');
    register_setting('custom_settings_group', 'google_maps_url');
    register_setting('custom_settings_group', 'facebook_url');
    register_setting('custom_settings_group', 'instagram_url');
    register_setting('custom_settings_group', 'twitter_url');
    register_setting('custom_settings_group', 'linkedin_url');

    // Section 1
    add_settings_section(
        'section_1',
        'General Settings',
        'section_1_callback',
        'custom-settings'
    );

    add_settings_field(
        'elementor_enabled',
        'Elementor Enabled',
        'elementor_enabled_callback',
        'custom-settings',
        'section_1'
    );

    add_settings_field(
        'maintenance_mode',
        'Maintenance Mode',
        'maintenance_mode_callback',
        'custom-settings',
        'section_1'
    );
    
    add_settings_field(
        'disable_gutenberg',
        'Disable Gutenberg',
        'disable_gutenberg_callback',
        'custom-settings',
        'section_1'
    );

    // Section 2
    add_settings_section(
        'section_2',
        'Website Information',
        'section_2_callback',
        'custom-settings'
    );

    add_settings_field(
        'email_address',
        'E-Mail Address',
        'email_address_callback',
        'custom-settings',
        'section_2'
    );

    add_settings_field(
        'phone_number',
        'Phone Number',
        'phone_number_callback',
        'custom-settings',
        'section_2'
    );

    add_settings_field(
        'google_maps_url',
        'Google Maps URL',
        'google_maps_url_callback',
        'custom-settings',
        'section_2'
    );

    // Section 3
    add_settings_section(
        'section_3',
        'Social Media',
        'section_3_callback',
        'custom-settings'
    );

    add_settings_field(
        'facebook_url',
        'Facebook URL',
        'facebook_url_callback',
        'custom-settings',
        'section_3'
    );

    add_settings_field(
        'instagram_url',
        'Instagram URL',
        'instagram_url_callback',
        'custom-settings',
        'section_3'
    );

    add_settings_field(
        'twitter_url',
        'Twitter URL',
        'twitter_url_callback',
        'custom-settings',
        'section_3'
    );

    add_settings_field(
        'linkedin_url',
        'LinkedIn URL',
        'linkedin_url_callback',
        'custom-settings',
        'section_3'
    );
}

add_action('admin_init', 'register_custom_settings');

// Section 1 callback
function section_1_callback() {
    echo '<p>Configure General settings.</p>';
}

// Section 2 callback
function section_2_callback() {
    echo '<p>Configure Website Information settings.</p>';
}

// Section 3 callback
function section_3_callback() {
    echo '<p>Configure Social Media settings.</p>';
}

// Field callbacks
function elementor_enabled_callback() {
    $value = get_option('elementor_enabled', '');
    echo '<input type="checkbox" name="elementor_enabled" value="1" ' . checked(1, $value, false) . ' />';
}

function maintenance_mode_callback() {
    $value = get_option('maintenance_mode', '');
    echo '<input type="checkbox" name="maintenance_mode" value="1" ' . checked(1, $value, false) . ' />';
}

function disable_gutenberg_callback() {
    $value = get_option('disable_gutenberg', '');
    echo '<input type="checkbox" name="disable_gutenberg" value="1" ' . checked(1, $value, false) . ' />';
}

function email_address_callback() {
    $value = get_option('email_address', '');
    echo '<input type="text" name="email_address" value="' . esc_attr($value) . '" />';
}

function phone_number_callback() {
    $value = get_option('phone_number', '');
    echo '<input type="text" name="phone_number" value="' . esc_attr($value) . '" />';
}

function google_maps_url_callback() {
    $value = get_option('google_maps_url', '');
    echo '<input type="text" name="google_maps_url" value="' . esc_url($value) . '" />';
}

function facebook_url_callback() {
    $value = get_option('facebook_url', '');
    echo '<input type="text" name="facebook_url" value="' . esc_url($value) . '" />';
}

function instagram_url_callback() {
    $value = get_option('instagram_url', '');
    echo '<input type="text" name="instagram_url" value="' . esc_url($value) . '" />';
}

function twitter_url_callback() {
    $value = get_option('twitter_url', '');
    echo '<input type="text" name="twitter_url" value="' . esc_url($value) . '" />';
}

function linkedin_url_callback() {
    $value = get_option('linkedin_url', '');
    echo '<input type="text" name="linkedin_url" value="' . esc_url($value) . '" />';
}
