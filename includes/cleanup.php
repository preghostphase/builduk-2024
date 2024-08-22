<?php
/*
 * Cleanup
 */

// ------------------------------------------------------------------------------------------
// Less stuff in <head>
if (!function_exists('switch_cleanup_head')) {
    function switch_cleanup_head()
    {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('init', 'switch_cleanup_head');

// ------------------------------------------------------------------------------------------
// Show less info to users on failed login for security. (Will not let a valid username be known.)
if (!function_exists('show_less_login_info')) {
    function show_less_login_info()
    {
        return "<strong>ERROR</strong>: Stop guessing!";
    }
}
add_filter('login_errors', 'show_less_login_info');

// ------------------------------------------------------------------------------------------
// Do not generate and display WordPress version
if (!function_exists('switch_remove_generator')) {
    function switch_remove_generator()
    {
        return '';
    }
}
add_filter('the_generator', 'no_generator');

// ------------------------------------------------------------------------------------------
// Add company link to the WP Admin footer
function remove_footer_admin()
{
    echo 'Built by Switch';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// ------------------------------------------------------------------------------------------
// Remove welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// ------------------------------------------------------------------------------------------
// Security Headers
function security_headers()
{
    // stops pages from loading when they detect reflected cross-site scripting (XSS) attacks
    header('X-XSS-Protection: 1; mode=block');
    // this blocks the site being used in an iframe
    header('X-Frame-Options: SAMEORIGIN');
}
add_action('send_headers', 'security_headers');

// ------------------------------------------------------------------------------------------
// limit revisions on a page to save the DB
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 10);
}

// ------------------------------------------------------------------------------------------
// Disable emojis
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
