<article class="search-card">
	<a href="<?php the_permalink()?>" class="search-card__link" title="<?php the_title(); ?>">
		<div class="search-card__content">
			<h3 class="search-card__title custom-title-js">
				<?php if (get_field('custom_title')): ?>
				<?php the_field('custom_title'); ?>
				<?php else: ?>
				<?php the_title(); ?>
				<?php endif; ?>
			</h3>
			<div class="search-card__excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</a>
</article>
