<?php if ( have_rows( 'page_builder' ) ): ?>
<div class="page-builder">
	<?php while ( have_rows( 'page_builder' ) ) : the_row(); ?>
	<?php get_template_part( 'templates/acf-modules/single_image' ); ?>
	<?php get_template_part( 'templates/acf-modules/text_block' ); ?>
	<?php get_template_part( 'templates/acf-modules/image_and_text' ); ?>
	<?php get_template_part( 'templates/acf-modules/video_block' ); ?>
	<?php get_template_part( 'templates/acf-modules/downloads_block' ); ?>
	<?php get_template_part( 'templates/acf-modules/call_to_action_block' ); ?>
	<?php get_template_part( 'templates/acf-modules/concertina_block' ); ?>
	<?php get_template_part( 'templates/acf-modules/team_members' ); ?>
	<?php endwhile; ?>
</div>
<?php endif; ?>