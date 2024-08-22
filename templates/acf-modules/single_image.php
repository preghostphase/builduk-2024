<?php if ( get_row_layout() == 'single_image' ) : ?>
<div class="page-builder-block" data-aos="fade-up">


	<div class="page-builder-block-wrapper <?php echo get_sub_field('full_width') ? 'page-builder-block-wrapper--full-width' : ''; ?>">
		<div class="single-image">
			<img alt="" src="<?php echo get_sub_field('single_image'); ?>"/>
			<?php if(get_sub_field('caption')) : ?>
				<div class="single-image__caption">
					<p class="single-image__caption-text"><?php echo get_sub_field('caption'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>


	
</div>
<?php endif; ?>