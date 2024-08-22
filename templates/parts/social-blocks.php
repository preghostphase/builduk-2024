<div class="social-block">
	<ul class="social-block__list">
		<?php if ( get_field('facebook', 'option') ): ?>
		<li class="social-block__list-item">
			<a href="<?php echo get_field('facebook', 'option'); ?>" target="_blank" rel="noopener" class="social-block__list-link">
				<?php load_inline_svg('facebook')?>
			</a>
		</li>
		<?php endif; ?>

		<?php if ( get_field('instagram', 'option') ): ?>
		<li class="social-block__list-item">
			<a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank" rel="noopener" class="social-block__list-link">
				<?php load_inline_svg('instagram')?>
			</a>
		</li>
		<?php endif; ?>

		<?php if ( get_field('twitter', 'option') ): ?>
		<li class="social-block__list-item">
			<a href="<?php echo get_field('twitter', 'option'); ?>" target="_blank" rel="noopener" class="social-block__list-link">
				<?php load_inline_svg('twitter')?>
			</a>
		</li>
		<?php endif; ?>

		<?php if ( get_field('linkedin', 'option') ): ?>
		<li class="social-block__list-item">
			<a href="<?php echo get_field('linkedin', 'option'); ?>" target="_blank" rel="noopener" class="social-block__list-link">
				<?php load_inline_svg('linkedin')?>
			</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
