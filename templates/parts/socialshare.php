<div class="socialShare">
	<button class="socialShareToggle" type="button" name="button">Share</button>
	<div class="socialShareContent">
		<div>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" rel="noopener" target="_blank" class="socialicon socialicon--facebook"><span class="sr-only">Facebook</span><?php load_inline_svg('facebook')?></a>
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" rel="noopener" target="_blank" class="socialicon socialicon--linkedin"><span class="sr-only">LinkedIn</span><?php load_inline_svg('linkedin')?></a>
			<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" rel="noopener" target="_blank" class="socialicon socialicon--twitter"><span class="sr-only">Twitter</span><?php load_inline_svg('twitter')?></a>
		</div>
	</div>
</div>
