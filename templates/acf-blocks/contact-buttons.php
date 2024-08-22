<?php

/**
 * Team Members Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-buttons-' . $block['id'];
if( !empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Load values and assign defaults.
$title = get_field('section_title');
$email = get_field('contact_email');
$linkedin = get_field('contact_linkedin');
$telephone = get_field('contact_telephone');
?>

<div id="<?php echo $id ?>" class="contact-buttons">
	<div class="contact-buttons__wrapper">
		<?php if ($title) : ?>
		<h4 class="contact-buttons__title"><?php echo $title; ?></h4>
		<?php endif; ?>

		<?php if ($email) : ?>
		<a href="mailto:<?php echo antispambot($email); ?>" class="button">
			<?php load_inline_svg('email')?> Email
		</a>
		<?php endif; ?>

		<?php if ($linkedin) : ?>
		<a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" title="LinkedIn Profile Link" class="button">
			<?php load_inline_svg('linkedin')?> LinkedIn
		</a>
		<?php endif; ?>

		<?php if ($telephone) : ?>
		<a href="tel:<?php echo $telephone; ?>" class="button">
			<?php load_inline_svg('phone')?> Phone: <?php echo $telephone; ?>
		</a>
		<?php endif; ?>
	</div>
</div>
