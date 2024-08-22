<?php
/*
 * Setup
 */

if (!function_exists('switch_setup')) {
    function switch_setup()
    {

        // Gutenberg Blocks
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('automatic-feed-links');

        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name' => __('Small', 'b4st'),
                    'shortName' => __('S', 'b4st'),
                    'size' => 14,
                    'slug' => 'small',
                ),
                array(
                    'name' => __('Normal', 'b4st'),
                    'shortName' => __('M', 'b4st'),
                    'size' => 16,
                    'slug' => 'normal',
                ),
                array(
                    'name' => __('Large', 'b4st'),
                    'shortName' => __('L', 'b4st'),
                    'size' => 22,
                    'slug' => 'large',
                ),
                array(
                    'name' => __('Huge', 'b4st'),
                    'shortName' => __('XL', 'b4st'),
                    'size' => 28,
                    'slug' => 'huge',
                ),
            )
        );

        update_option('thumbnail_size_w', 285); /* internal max-width of col-3 */
        update_option('small_size_w', 350); /* internal max-width of col-4 */
        update_option('medium_size_w', 730); /* internal max-width of col-8 */
        update_option('large_size_w', 1110); /* internal max-width of col-12 */

        // Adding the Open Graph in the Language Attributes
        function add_opengraph_doctype($output)
        {
            return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
        }
        add_filter('language_attributes', 'add_opengraph_doctype');

    }
}
add_action('init', 'switch_setup');
