<div class="news__articles">
	<?php // Loop through posts and exclude sticky
			while (have_posts()): the_post(); ?>
	<?php if (!is_sticky()) get_template_part('templates/parts/article-card'); ?>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
</div>

<?php if (get_previous_posts_link() || get_next_posts_link()): ?>
<div class="news__pagination">
	<?php numeric_posts_nav(); ?>
</div>
<?php endif; ?>
