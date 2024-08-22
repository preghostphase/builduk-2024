<div class="page-content">
	<?php if(has_post_thumbnail()): ?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'thumbnail' ); ?>
	</div>
	<?php endif; ?>
	<h2 class="post-title">
		<a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<?php the_content(); ?>
</div>
