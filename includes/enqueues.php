<?php
/*
 * Enqueues
 */

if (!function_exists('switch_enqueues')) {
    function switch_enqueues()
    {
        // Register main stylesheet
        wp_enqueue_style('style-css',
            get_template_directory_uri() . '/dist/css/style.css',
            array(),
            filemtime(get_stylesheet_directory() . '/dist/css/style.css')
        );

        // Adding scripts file in the footer
        wp_enqueue_script('bundle-js',
            get_template_directory_uri() . '/dist/js/bundle.js',
            array('jquery'),
            filemtime(get_stylesheet_directory() . '/dist/js/bundle.js'),
            true
        );

		// Adding JQuery
		wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', 'jquery', '3.5.1', true);


		// Google Maps JS
		wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBvzxAID0YATXLYGrNMnIQXsJBvSkz8ZjM', NULL, '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'switch_enqueues', 100);
