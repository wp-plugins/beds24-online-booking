<!-- This file can be modified and placed in your theme directory, The plugin will search for a file with this name there first and use it if it exists -->
<div class="B24-Property">
	<h1 class="B24-H1Property"><?php the_title(); ?></h1>
	<?php the_content(); ?>
	<div class="B24-ProppriceButton">
		<div class="B24-Propprice">
		€ <?php beds24_propprice(); ?>
		</div>
		<div class="B24-Bookbutton">
		<?php beds24_bookbutton(); ?>
		</div>
	</div>
</div>
