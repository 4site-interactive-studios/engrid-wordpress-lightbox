<?php

/*
Plugin Name: 	4Site EN Donation Lightbox
Version: 		1.0
Description: 	Provides a lightbox via shortcode that displays an EN Donation lightbox
Author:         4Site Interactive Studios
Author URI:     https://www.4sitestudios.com
*/

// Enqueue the script URL on every page if the autoload is enabled
// This will support the use of <a> tags with the data-donation-lightbox attribute
add_action('wp_enqueue_scripts', function() {
	$settings = fsedl_get_settings();
	$script_url = (isset($atts['script'])) ? $atts['script'] : $settings['script'];
	$autoload = $settings['autoload'];

	if($autoload && $script_url) {
		wp_enqueue_script('fs-en-donation-lightbox', $script_url);
	}
});

// This is the shortcode that will automatically display the lightbox to every visitor
add_shortcode('en_donation_lightbox', function($atts, $content = '') {
	$settings = fsedl_get_settings();

	$script_url = (isset($atts['script'])) ? $atts['script'] : $settings['script'];
	$url = (isset($atts['url'])) ? $atts['url'] : $settings['url'];
	$title = (isset($atts['title'])) ? $atts['title'] : $settings['title'];
	$image = (isset($atts['image'])) ? $atts['image'] : $settings['image'];
	$logo = (isset($atts['logo'])) ? $atts['logo'] : $settings['logo'];
	$footer = (isset($atts['footer'])) ? $atts['footer'] : $settings['footer'];
	$paragraph = ($content) ? $content : $settings['paragraph'];

	if($script_url) {
		wp_enqueue_script('fs-en-donation-lightbox', $script_url);
	}

	ob_start();
	include 'shortcode_template.php';
	return ob_get_clean();
});

// Add our settings page
add_action('admin_menu', function() {
	$menu_slug = 'fs-en-donation-lightbox';

	add_menu_page(
		__('Settings', 'fsedl'),
		__('EN Donation Lightbox', 'fsedl'),
		'manage_options',
		$menu_slug,
		'fsedl_render_settings_page',
		'dashicons-money-alt'
	);

	add_submenu_page(
		$menu_slug,
		'Settings',
		'Settings',
		'manage_options',
		$menu_slug,
		'fsedl_render_settings_page'
	);
});

// Display the minimal admin settings page
function fsedl_render_settings_page() {
	$messages = [];

	$settings = fsedl_get_settings();
	if(is_array($_POST) && count($_POST)) {
		check_admin_referer('fsedl-settings');
		fsedl_set_settings($_POST);
		$messages[] = 'Updated default settings';
		$settings = fsedl_get_settings();
	}

	$url = $settings['url'];
	$title = $settings['title'];
	$paragraph = $settings['paragraph'];
	$script = $settings['script'];
	$image = $settings['image'];
	$logo = $settings['logo'];
	$footer = $settings['footer'];
	$autoload = $settings['autoload'];

	ob_start();
	include 'admin-settings-page.php';
	echo ob_get_clean();
}

// Helper function
function fsedl_get_settings() {
	$settings = get_transient('fsedl_settings');
	if(!$settings) {
		$settings = [
			'url' => '',
			'title' => '',
			'paragraph' => '',
			'script' => '',
			'image' => '',
			'logo' => '',
			'footer' => '',
			'autoload' => false
		];
	}
	return $settings;	
}

// Helper function
function fsedl_set_settings($settings) {
	// We are only interested in certain keys
	$pruned_settings = array_intersect_key($settings, array_flip(array('url', 'title', 'paragraph', 'script', 'image', 'logo', 'footer', 'autoload')));
	set_transient('fsedl_settings', $pruned_settings);
}