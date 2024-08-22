<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="search">
	<div class="search__wrapper">
		<?php if (have_posts()): ?>
		<div class="search__listings">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('templates/parts/search-card'); ?>
			<?php endwhile; ?>
		</div>
		<?php else: ?>
		<div class="search__noresults user-content">
			<h2>No results for <?php echo get_search_query(); ?></h2>
			<h3>Sub message here</h3>
			<p>Maybe <a href="<?php about_url(); ?>">Link to a page</a></p>
		</div>
		<?php endif; ?>

		<?php if (get_previous_posts_link() || get_next_posts_link()): ?>
		<?php numeric_posts_nav(); ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
