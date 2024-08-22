<footer class="footer">
	<div class="footer__main">

	<div class="footer__info">
		<div class="footer__info-logo">
			<img alt="" src="<?php echo get_field('theme_footer_logo', 'option'); ?>"/>
		</div>
		<p class="footer__info-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
		<div class="footer__info-copyright">© Switch Design Consultancy - <?php echo get_the_date('Y'); ?></div>
	</div>

	<div class="footer__links">
		<div class="footer__links-item">
			<h4>Useful links</h4>
			<?php switch_footer_links(); ?>
		</div>

		<div class="footer__links-item">
			<h4>Legal</h4>
			<?php switch_footer_legal_links(); ?>
		</div>
		
		<div class="footer__links-item">
			<h4>Contact</h4>
			<p>Have a query? Get in touch using the button below.</p>
			<a href="<?php echo esc_url(get_field('contact', 'option')); ?>" class="button button--white-hover">Get in touch</a>
		</div>
	</div>	


	
	</div>

	<div class="footer__blurb">
		<a target="_blank" href="https://www.weareswitch.com">Website by Switch</a>
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
