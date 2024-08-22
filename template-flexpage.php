<?php
// Template Name: Flexpage
?>

<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary">
	<article class="content__wrapper user-content clean-empty-tags-js">
		<?php the_content(); ?>
        <?php echo get_template_part('templates/acf-modules/page_builder'); ?>
	</article>
</main>

<?php get_footer(); ?>