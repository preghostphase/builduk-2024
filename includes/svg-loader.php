<?php

/**
 * Load an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return string The content of the SVG you want to load.
 *
 * https://enshrined.co.uk/2018/09/19/how-to-properly-include-inline-svgs-in-a-wordpress-theme/
 */

function load_inline_svg($filename)
{
    $svgString = "
	<div class='svg-wrapper' aria-hidden='true'>
		<svg>
			<use xlink:href='#$filename'></use>
		</svg>
	</div>
	";

    echo $svgString;
}
