<?php

$slide = $settings['slides'];

if ($settings['slides']) {
    foreach ($settings['slides'] as $slide_item) {
        $bg_image = $slide_item['bg_image']['url'];
        $title = esc_html($slide_item['title']);
        $subtitle = esc_html($slide_item['subtitle']);
        $btn_enabled = $slide_item['button_enabled'];
        $btn_link = $slide_item['button_link']['url'];
        $btn_text = $slide_item['button_text'];
    }
}