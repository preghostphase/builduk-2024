<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="news">
	<div class="news__wrapper">

		<?php if ( get_post_type( get_the_ID() ) == 'post' ) : ?>

			<a href="<?php echo esc_url(home_url('/news')); ?>" class="news__back button">Back to News Archive</a>

			<?php get_template_part('templates/parts/blog-listings'); ?>

		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
