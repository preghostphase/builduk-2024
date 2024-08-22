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
$id = 'team-members-' . $block['id'];
if( !empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Load values and assign defaults.
$team_members_data = get_field('team_members_block_data');
?>

<?php if ($team_members_data): ?>

<div id="<?php echo $id ?>" class="team-member">
	<div class="team-member__wrapper">
		<?php foreach ($team_members_data as $member): ?>
		<?php // Team member vars
		$image = $member['image'];
		$name = $member['name'];
		$role = $member['role'];
		$link = $member['page_link'];
		?>

		<?php if ($link): ?>
		<a href="<?php echo esc_url($link); ?>" class="team-member__single">
		<?php else: ?>
		<div class="team-member__single">
		<?php endif; ?>

				<div class="team-member__image">
					<?php echo wp_get_attachment_image(intval($image), 'full'); ?>
				</div>
				<p class="team-member__name"><?php echo $name; ?></p>
				<p class="team-member__role"><?php echo $role; ?></p>

		<?php if ($link): ?>
		</a>
		<?php else: ?>
		</div>
		<?php endif; ?>

	<?php endforeach;  ?>
</div>
</div>

<?php endif; ?>
