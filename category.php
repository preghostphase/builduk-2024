<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="news">
	<div class="news__wrapper">

		<a href="<?php echo esc_url(home_url('/news')); ?>" class="news__back button">Back to News Archive</a>

		<?php get_template_part('templates/parts/blog-listings'); ?>
	</div>
</main>

<?php get_footer(); ?>
