
<?php

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');
