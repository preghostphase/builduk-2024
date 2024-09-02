<?php 

// Remove stylesheet version and add version based on file modified date for cache purposes
function switch_correct_stylesheet_version( $src ) {

    if(str_starts_with($src, get_template_directory_uri())) {

        if ( strpos( $src, 'ver=' ) ) {
            $src = remove_query_arg( 'ver', $src );
        }

        $filename = get_stylesheet_directory() . str_replace(get_template_directory_uri(), '', $src);

        if (file_exists($filename)) {
            $filetime = filemtime($filename);
            $src = add_query_arg('ver', $filetime, $src);
        }
    }
    return $src;
}

add_filter( 'style_loader_src', 'switch_correct_stylesheet_version', 9999 );