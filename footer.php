<footer class="footer">
	<div class="footer__main">

	<div class="footer__social">
		<?php get_template_part('templates/parts/social-blocks'); ?>
	</div>

	<div class="footer__info">
		<div class="footer__info-top">
			<div class="footer__info-copyright">© BuildUK <?php echo get_the_date('Y'); ?></div>
			<?php switch_footer_links(); ?>
		</div>

		<p class="footer__info-description">Design. Brand. Digital. by <a target="_blank" href="https://www.weareswitch.com">Switch</a></p>
	</div>

	</div>
</footer>

<?php wp_footer(); ?>

<script>

$(window).on("load", function () {

$(".__animate").animateIn({
	offset: 100,
	modifier: "__animatein"
});

$(".__animateleft").animateIn({
	offset: 0,
	modifier: "__animatein"
});

$(".__animateright").animateIn({
	offset: 0,
	modifier: "__animatein"
});

$(".__animatefade").animateIn({
	offset: 0,
	modifier: "__animatein"
});
$(".__animatenow").animateIn({
	offset: 0,
	modifier: "__animatein"
});
});


</script>

</body>

</html>
