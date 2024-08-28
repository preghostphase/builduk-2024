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


// Lighten colour
function lighten_color($color, $percent) {
    $color = str_replace('#', '', $color);
    $r = hexdec(substr($color, 0, 2));
    $g = hexdec(substr($color, 2, 2));
    $b = hexdec(substr($color, 4, 2));

    $r = round($r + ($percent / 100) * (255 - $r));
    $g = round($g + ($percent / 100) * (255 - $g));
    $b = round($b + ($percent / 100) * (255 - $b));

    return sprintf("#%02x%02x%02x", $r, $g, $b);
}
