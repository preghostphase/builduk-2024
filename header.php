<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() . "/dist/images/favicon.png" ?>">

	<!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

	<?php wp_head(); ?>

	<style>
		:root {
			--theme-primary: <?php echo get_field( 'primary_colour', 'option' ); ?>;
			--theme-secondary: <?php echo get_field( 'secondary_colour', 'option' ); ?>;
		}
	</style>

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?php get_template_part('templates/parts/cookie-banner'); ?>

	<div class="hidden" hidden>
		<?php echo file_get_contents(get_template_directory() . "/dist/images/sprite.svg"); ?>
	</div>

	<button id="scrollToTop" class="scrollToTop hide"><?php load_inline_svg('up')?></button>

	<a class="skip-link screen-reader-text" href="#primary">Skip to contents</a>

	<?php
	$announcmentBarText = get_field( 'announcement_banner_text', 'option' ); 
	$announcmentBarUrl = get_field( 'announcement_banner_link', 'option' ); 
	$announcmentBarColour = get_field('announcement_bar_colour', 'option');
	$announcementNewTab = get_field('open_link_in_new_tab', 'option');
	?>

	<?php if($announcmentBarText) : ?>
		<section class="announcement" style="background-color: <?php echo $announcmentBarColour ? $announcmentBarColour : get_field( 'primary_colour', 'option' ); ?>">
			<div class="announcement__wrapper">
				<?php if($announcmentBarUrl && $announcmentBarText) : ?>
					<a class="announcement__link" href="<?php echo $announcmentBarUrl; ?>" <?php echo $announcementNewTab ? 'target="_blank"' : ''; ?>>
						<?php echo $announcmentBarText; ?>
						<?php load_inline_svg('right')?>
					</a>
				<?php elseif ($announcmentBarText && !$announcmentBarUrl) : ?>
					<div class="announcement__text">
						<?php echo $announcmentBarText; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<header class="header">
		<!-- Mobile headers -->
		<div class="wrapper-mobile">
			<a href="/" class="wrapper-mobile__logo" data-aos="fade-right">
				<img alt="" src="<?php echo get_field('theme_logo', 'option'); ?>"/>
			</a>
			<button class="wrapper-mobile__button" id="toggle-mobile-js" aria-controls="overlay" data-aos="left">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</button>
		</div>
		<nav class="menu-mobile" id="overlay-mobile-js" aria-expanded="false">
			<div class="menu-mobile__wrapper">
				<?php switch_top_nav_mobile()?>
				<?php get_template_part('templates/parts/social-blocks'); ?>
			</div>
		</nav>

		<!-- Desktop headers -->
		<div class="wrapper-desktop">
			<a href="/" class="wrapper-desktop__logo" data-aos="fade-right">
				<img alt="" src="<?php echo get_field('theme_logo', 'option'); ?>"/>
			</a>
			<nav class="menu-desktop" data-aos="fade-left">
				<?php switch_top_nav()?>
			</nav>
		</div>
	</header>
