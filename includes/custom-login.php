<?php

function custom_login()
{
    $url = get_template_directory_uri();
    $style = "<style type='text/css'>
		.login h1 a {
			/* logo styling */
			background-image: url('$url/dist/images/switch-white.png') !important;
			width: 200px !important;
			background-size: 200px auto !important;
		}
		/* Background color */
		body {  background: #000; }
		/* Login message */
		.login p.message {
			border-left: 4px solid #66c1be;
		}
		/* Form styling */
		.login form { background: #66c1be; }
		.login label { color: #ffffff; }
		.login input:focus {
			border-color: #191919;
			box-shadow: 0 0 0 1px #191919;
		}
		.login .button-primary {
			background: #3B9C99;
			border-color: #3B9C99;
			color: #ffffff;
			transition: all 0.3s ease;
		}
		.login .button-primary:hover {
			background: #297A78;
			border-color: #297A78;
			color: #ffffff;
		}
		.login .button.wp-hide-pw .dashicons {
			color: #66c1be;
		}
		.login #backtoblog a, .login #nav a {
			text-decoration: none;
			color: #66c1be;
			transition: all 0.3s ease;
		}
		.login #backtoblog a:hover,
		.login #backtoblog a:focus,
		.login #nav a:hover,
		.login #nav a:focus {
			text-decoration: none;
			color: #ffffff;
		}
	</style>";

    echo $style;
}

add_action('login_head', 'custom_login');
