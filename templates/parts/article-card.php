<?php
	// Get list of categories for each post
	$the_cats = get_the_category();
	$links = array();
	foreach ($the_cats as $the_cat) {
		$links[] = $the_cat->slug;
	}
	$list = implode(' ', $links);

	// Get the passed variable
	$stickyDisabled = get_query_var('stickyDisabled', false); // Default to false if not set

?>

<article class="article-card <?php echo $list ?> swiper-slide" data-aos="fade-up">
	<a href="<?php the_permalink()?>" class="article-card__link" title="<?php the_title(); ?>">
		<?php if (has_post_thumbnail()): ?>
		<figure class="article-card__image">
			<p class="article-card__date"><?php the_date('d/m/y'); ?></p>
			<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image for article: <?php the_title(); ?>">
		</figure>
		<?php endif; ?>

		<div class="article-card__content">
		
			<h4 class="article-card__title">
				<span class="custom-title-js">
					<?php if (get_field('custom_title')): ?>
					<?php the_field('custom_title'); ?>
					<?php else: ?>
					<?php the_title(); ?>
					<?php endif; ?>
				</span>
			</h4>
	
			<?php if(is_sticky() && !$stickyDisabled) : ?>
				<div class="article-card__excerpt">
					<?php the_excerpt(); ?>
					<span class="button button--white-hover">Read more</button>
				</div>
			<?php endif; ?>
		</div>
	</a>
</article>
