<?php

/**
 * Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'banner-block-' . $block['id'];
if( !empty($block['anchor'])) {
    $id = $block['anchor'];
}

$body = get_field('banner_body');
$image = get_field('banner_image');
$credit = get_field('banner_credit');

// group & sub fields for banner link
$link = get_field('banner_link');
$link_url = $link['banner_link_url'];
$link_text = $link['banner_link_text'];
?>

<?php if ($body): ?>
<section
id="<?php echo $id; ?>"
class="banner-block
<?php if($credit) echo 'banner-block--hasCredit '; ?>
<?php if($link_url && $link_text) echo 'banner-block--hasLink '; ?>
<?php if($body) echo 'banner-block--hasBody '; ?>
">
	<div class="banner-block__wrapper">
		<div class="banner-block__image">
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
		</div>
		<div class="banner-block__body">
			<h2><?php echo $body; ?></h2>
			<?php if ($link_url && $link_text): ?>
			<a href="<?php echo $link_url; ?>" class="banner-block__link button button--red button--animated">
				<?php echo $link_text; ?>
			</a>
			<?php endif; ?>
		</div>

		<?php if ($credit): ?>
		<div class="banner-block__credit">
			<p><?php echo $credit; ?></p>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>
