<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="content">

	<div class="content--contained content--two-column-sidebar">
		<div>
			<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
				<?php get_template_part('templates/parts/content' ); ?>
			<?php endwhile;  endif; ?>
		</div>
		<div>
			<?php get_sidebar(); ?>
		</div>
	</div>

</main>

<?php get_footer(); ?>

