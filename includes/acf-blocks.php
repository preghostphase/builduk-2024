<?php

function my_acf_init_block_types()
{
    // Check function exists and register custom blocks
    if (function_exists('acf_register_block_type')) {

        // register a team members block
        acf_register_block_type(array(
            'name' => 'team-members',
            'title' => 'Team Members (Custom)',
            'description' => 'A block for showing team members.',
            'render_template' => 'templates/acf-blocks/team-members.php',
            'category' => 'formatting',
            'icon' => 'admin-users',
            'keywords' => array('team', 'members', 'staff'),
            'enqueue_style' => get_template_directory_uri() . '/dist/css/blocks.css',
        ));

        acf_register_block_type(array(
            'name' => 'contact-buttons',
            'title' => 'Contact Buttons (Custom)',
            'description' => 'A block for contact details.',
            'render_template' => 'templates/acf-blocks/contact-buttons.php',
            'category' => 'formatting',
            'icon' => 'email',
            'keywords' => array('contact', 'email', 'telephone'),
            'enqueue_style' => get_template_directory_uri() . '/dist/css/blocks.css',
        ));

        acf_register_block_type(array(
            'name' => 'accordion',
            'title' => 'Accordion (Custom)',
            'description' => 'A block for creating an accordion.',
            'render_template' => 'templates/acf-blocks/accordion.php',
            'category' => 'formatting',
            'icon' => 'menu-alt3',
            'keywords' => array('accordion'),
            'enqueue_style' => get_template_directory_uri() . '/dist/css/blocks.css',
        ));

        acf_register_block_type(array(
            'name' => 'banner',
            'title' => __('Banner (Custom)'),
            'description' => __('A custom flexible banner block.'),
            'render_template' => 'templates/acf-blocks/banner-block.php',
            'category' => 'formatting',
            'icon' => 'format-image',
            'keywords' => array('banner'),
            'enqueue_style' => get_template_directory_uri() . '/dist/css/blocks.css',
        ));
    }
}
add_action('acf/init', 'my_acf_init_block_types');
