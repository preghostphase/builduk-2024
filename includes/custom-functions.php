<?php

// Return the URL value of the vacancy page
function about_url()
{
    $page_url = get_field('about', 'option');
    echo $page_url;
}

function contact_url()
{
    $page_url = get_field('contact', 'option');
    echo $page_url;
}
