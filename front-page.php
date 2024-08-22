<?php get_header(); ?>

<main id="primary">
	<section class="home-banner <?php echo get_field('center_content') ? 'home-banner--center-content' : ''; ?>">
		<div class="home-banner__wrapper">
			<div class="home-banner__content">
				<?php if(get_field('banner_title')) : ?>
					<h1 class="home-banner__content-title" data-aos="fade-up" data-aos-delay="200"><?php echo get_field('banner_title'); ?></h1>
				<?php endif; ?>
				<?php if(get_field('banner_button_text') && get_field('banner_button_link')) : ?>
					<a href="<?php echo esc_url(get_field('banner_button_link')); ?>" class="button" data-aos="fade-up" data-aos-delay="400"><?php echo get_field('banner_button_text'); ?></a>
				<?php endif; ?>
			</div>
			<figure class="home-banner__image">
				<picture>
					<source media="(orientation: portrait)" srcset="<?php the_field('banner_image_mobile'); ?>">
					<source media="(orientation: landscape)" srcset="<?php the_field('banner_image_desktop'); ?>">
					<img src="<?php the_field('banner_image_desktop'); ?>" alt="Tonic Talent: Hospitality & Catering Recruitment Agency UK">
				</picture>
			</figure>
		</div>
	</section>

	<?php
	// Introduction Block Setup
	$introText = get_field('introduction_text');
	$introImage = get_field('introduction_image');
	?>

	<?php if($introText || $introImage) : ?>
		<section class="home-intro">
			<div class="home-intro__wrapper">
				<?php if($introText) : ?>
					<div class="home-intro__text user-content user-content--white-text" data-aos="fade-up">
						<?php echo $introText; ?>
					</div>
				<?php endif; ?>
				<?php if($introImage) : ?>
					<div class="home-intro__image" data-aos="fade-up">
						<img alt="" src="<?php echo $introImage; ?>"/>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Call to Action Block Setup
	$ctaTitle = get_field('call_to_action_title');
	$ctaDescription = get_field('call_to_action_description');
	$ctaItem = get_field('call_to_action_item');
	?>

	<div class="home-cta">
		<div class="home-cta__wrapper user-content">
			<?php if($ctaTitle) : ?>
				<h2 class="home-cta__title" data-aos="fade-up"><?php echo $ctaTitle; ?></h2>
			<?php endif; ?>
			<?php if($ctaDescription) : ?>
				<p class="home-cta__description" data-aos="fade-up"><?php echo $ctaDescription; ?></p>
			<?php endif; ?>

			<?php if( have_rows('call_to_action_item') ): 
				$counter = 0;
				?>
				<div class="home-cta__grid">
				<?php while( have_rows('call_to_action_item') ): the_row(); 
					$title = get_sub_field('title');
					$image = get_sub_field('image');
					$url = get_sub_field('url');
				?>
					<a href="<?php echo esc_url($url); ?>" class="home-cta__grid-item" data-aos="fade-up"    data-aos-delay="<?php echo $counter; ?>00">
						<div class="home-cta__grid-item-image">
							<img alt="" src="<?php echo $image; ?>"/>
						</div>
						<div class="home-cta__grid-item-text">
							<h4><?php echo $title; ?></h4>
						</div>
					</a>

				<?php $counter++; ?>

				<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
	// Call to Action Block Setup
	$videoTitle = get_field('feature_video_title');
	$videoEmbed = get_field('feature_embedded_video_url');
	$videoMP4 = get_field('feature_video_mp4');
	$videoMOV = get_field('feature_video_mov');
	$videoPoster = get_field('feature_video_poster');
	?>

	<?php if($videoTitle || $videoMP4 || $videoMOV || $videoEmbed) : ?>
		<div class="home-video">
			<div class="home-video__wrapper">
				<?php if($videoTitle) : ?>
					<h2 class="home-video__title" data-aos="fade-up"><?php echo $videoTitle; ?></h2>
				<?php endif; ?>


				<?php if($videoEmbed) : ?>

					<a href="<?php echo esc_url($videoEmbed); ?>" target="_blank"  class="embedded-video" data-aos="fade-up">
						<div class="home-video__poster">
							<img alt="" src="<?php echo $videoPoster; ?>"/>
						</div>
					</a>

				<?php elseif ($videoMP4 && $videoMOV) :

				

				?>

				<a href="#resources-local-video-1" target="_blank"  class="local-video" data-aos="fade-up">
					<div class="home-video__poster">
						<img alt="" src="<?php echo $videoPoster; ?>"/>
					</div>
				</a>

				<?php if($videoMOV || $videoMP4) : ?>
					<div id="resources-local-video-1" class="local-video-popup mfp-hide">
						<video controls preload="auto">
							<source src="<?php echo $videoMP4; ?>" type="video/mp4">
							<source src="<?php echo $videoMOV; ?>" type="video/mov">
						</video>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			
			</div>
		</div>
	<?php endif; ?>

	<section class="home-news">
		<div class="home-news__wrapper">
			<div class="home-news__header">
				<h2 class="home-news__title" data-aos="fade-up">Latest News</h2>
				<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts' ))); ?>" class="button" data-aos="fade-up">View all</a>
			</div>
			<div class="home-news__items swiper-container">
				<div class="swiper-wrapper">
					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'post__not_in' => get_option('sticky_posts')
					);
					$latest_post = new WP_Query($args);
					?>
					<?php while ($latest_post->have_posts()) : $latest_post->the_post(); ?>
					<?php get_template_part('templates/parts/article-card'); ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>

