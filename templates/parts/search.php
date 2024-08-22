<form role="search" method="get" class="search" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
	<label class="screen-reader-text" for="s">Search for:</label>
	<input type="text" placeholder="Search" value="" name="s" id="s" />
	<button type="submit">
		<span class="screen-reader-text">Submit search</span>
		<?php load_inline_svg('search'); ?>
	</button>
</form>
