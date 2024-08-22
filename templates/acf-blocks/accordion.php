<?php

/**
 * Accordion block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Load values and assign defaults.
$accordion_data = get_field('accordion_entries');
?>

<?php if ($accordion_data): ?>

<div class="handorgel accordion">
	<?php foreach ($accordion_data as $entry): ?>
	<?php // Team member vars
	$title = $entry['accordion_title'];
	$content = $entry['accordion_content'];
	?>

	<h3 class="handorgel__header">
		<button class="handorgel__header__button">
			<?php echo $title ?>
			<?php load_inline_svg('down')?>
		</button>
	</h3>
	<div class="handorgel__content">
		<div class="handorgel__content__inner">
			<?php echo $content ?>
		</div>
	</div>
	<?php endforeach;  ?>
</div>

<?php endif; ?>
