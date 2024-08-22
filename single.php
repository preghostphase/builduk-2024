<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="content">

	<?php // Check for any other post type than post ?>
	<?php if (get_post_type() === 'post') $userClasses = 'user-content clean-empty-tags-js'; ?>

	<article class="content__wrapper <?php echo $userClasses ?>">
		<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>

		<?php if (get_post_type() === 'post') : ?>
		<div class="post-meta">

			<p class="post-date">
				Posted: <span><?php the_date('jS F, Y'); ?></span>
			</p>
			<ul class="post-categories">
				<li>Categories:</li>
				<?php
				//get all the categories the post belongs to
				$categories = wp_get_post_categories(get_the_ID());
				foreach($categories as $c) :
				$cat = get_category($c);
				//make a list item containing a link to the category
				echo '<li><a class="" href="'.get_category_link(get_cat_ID($cat->name)).'">'.$cat->name.'</a></li>';
				endforeach;
				?>
			</ul>
		</div>
		<?php endif; ?>

		<?php the_content(); ?>

		<div class="post-meta">
			<a href="<?php echo esc_url(home_url('/news')); ?>" class="news__back button">Back to News Archive</a>
		</div>

		<?php endwhile; ?>
		<?php endif; ?>
	</article>

	<?php if (get_post_type() === 'post'): ?>
		<section class="post-related">
			<div class="post-related__wrapper">
				<div class="post-related__header">
					<h3 class="post-related__title">Related articles</h3>
					<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="button">
						View all
					</a>
				</div>
				<div class="post-related__items swiper-container">
					<div class="swiper-wrapper">
						<?php
							// Get the current post ID
							$current_post_id = get_queried_object_id();

							// Set up the arguments for WP_Query
							$args = array(
								'category__in'   => wp_get_post_categories($current_post_id),
								'posts_per_page' => 3,
								'orderby'        => 'rand',
								'post__not_in'   => array($current_post_id),
							);

							// Execute the query
							$related_articles = new WP_Query($args);

							// Loop through related posts
							if ($related_articles->have_posts()) :
								while ($related_articles->have_posts()) : $related_articles->the_post();
									// Set the variable to be passed to the template part
									$stickyDisabled = true;
									set_query_var('stickyDisabled', $stickyDisabled);

									// Include the template part for the article card
									get_template_part('templates/parts/article-card');
								endwhile;

								// Reset post data
								wp_reset_postdata();
							else :
								// Optional: Display a message if no related posts are found
								echo '<p>No related articles found.</p>';
							endif;

						?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>

<script>

</script>
