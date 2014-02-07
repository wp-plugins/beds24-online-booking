<!-- This file can be modified and placed in your theme directory, The plugin will search for a file with this name there first and use it if it exists -->
<div class="B24-Room">
	<h2 class="B24-H2Room"><?php the_title(); ?></h2>
	<?php the_content(); ?>
	<div class="B24-RoompriceButton">
		<div class="B24-Roomprice">
		<?php beds24_roomprice(); ?>
		</div>
		<div class="B24-Bookbutton">
		<?php beds24_bookbutton(); ?>
		</div>
	</div>
</div>




