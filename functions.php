<?php

// Denny direct access
if (!defined('ABSPATH')) {
    exit;
}

// Uncomment as necessary
require get_template_directory() . '/includes/acf-options-page.php';
require get_template_directory() . '/includes/cleanup.php';
require get_template_directory() . '/includes/disable-comments.php';
require get_template_directory() . '/includes/enqueues.php';
require get_template_directory() . '/includes/navigation-menus.php';
require get_template_directory() . '/includes/setup.php';
require get_template_directory() . '/includes/svg-loader.php';
require get_template_directory() . '/includes/custom-excerpt.php';
require get_template_directory() . '/includes/blog-pagination.php';
require get_template_directory() . '/includes/custom-functions.php';

// TGM Register Required Plugins
require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';
require get_template_directory() . '/includes/tgm/tgm-plugins.php';

// Custom ACF blocks registration
require get_template_directory() . '/includes/acf-blocks.php';

// Custom Login Styling
require get_template_directory() . '/includes/custom-login.php';

// Custom post types
// require get_template_directory() . '/includes/cpt/events.php';
// require get_template_directory() . '/includes/cpt/locations.php';
require get_template_directory() . '/includes/cpt/members.php';
require get_template_directory() . '/includes/cpt/information.php';

// Google Maps
require get_template_directory() . '/includes/google-maps.php';

// Ajax Functions
require get_template_directory() . '/includes/ajax-functions.php';

// Stylesheet cache fixes
require get_template_directory() . '/includes/stylesheet-caching.php';
