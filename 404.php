<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="errorpage">
	<div class="errorpage__wrapper user-content">
		<h2>Sorry, we couldn't find the page you were looking for.</h2>
		<a class="button" href="<?php echo esc_url(get_site_url()); ?>">Return to homepage</a>
	</div>
</main>

<?php get_footer(); ?>
