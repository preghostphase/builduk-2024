<?php

// Register menus
register_nav_menus(
    array(
        'main-nav' => 'Main Menu', // Main nav in header
        'footer-links' => 'Useful Links', // Secondary nav in footer
        'footer-legal-links' => 'Legal', // Secondary nav in footer
    )
);

// The Top Menu
function switch_top_nav()
{
    wp_nav_menu(array(
        'container' => false, // Remove nav container
        'menu_id' => 'main-nav', // Adding custom nav id
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location' => 'main-nav', // Where it's located in the theme
        'depth' => 2, // Limit the depth of the nav
        'fallback_cb' => false, // Fallback function (see below)
    ));
}

function switch_top_nav_mobile()
{
    wp_nav_menu(array(
        'container' => false, // Remove nav container
        'menu_id' => 'main-nav-mobile', // Adding custom nav id
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location' => 'main-nav', // Where it's located in the theme
        'depth' => 2, // Limit the depth of the nav
        'fallback_cb' => false, // Fallback function (see below)
    ));
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}

// The Footer Menu
function switch_footer_links()
{
    wp_nav_menu(array(
        'container' => 'false', // Remove nav container
        'menu_id' => 'footer-links', // Adding custom nav id
        'menu_class' => 'menu', // Adding custom nav class
        'theme_location' => 'footer-links', // Where it's located in the theme
        'depth' => 0, // Limit the depth of the nav
        'fallback_cb' => '', // Fallback function
    ));
} /* End Footer Menu */

function switch_footer_legal_links()
{
    wp_nav_menu(array(
        'container' => 'false', // Remove nav container
        'menu_id' => 'footer-legal-links', // Adding custom nav id
        'menu_class' => 'menu', // Adding custom nav class
        'theme_location' => 'footer-legal-links', // Where it's located in the theme
        'depth' => 0, // Limit the depth of the nav
        'fallback_cb' => '', // Fallback function
    ));
} /* End Footer Menu */

// Header Fallback Menu
function switch_main_nav_fallback()
{
    wp_page_menu(array(
        'show_home' => true,
        'menu_class' => '', // Adding custom nav class
        'include' => '',
        'exclude' => '',
        'echo' => true,
        'link_before' => '', // Before each link
        'link_after' => '', // After each link
    ));
}

// Footer Fallback Menu
function switch_footer_links_fallback()
{
    /* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class($classes, $item)
{
    if ($item->current == 1 || $item->current_item_ancestor == true) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'required_active_nav_class', 10, 2);
