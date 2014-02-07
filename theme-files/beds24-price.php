<!-- This file can be modified and placed in your theme directory, The plugin will search for a file with this name there first and use it if it exists -->
<div class="B24-Pricerow">
	<h3 class="B24-H3Pricerow"><?php the_title(); ?></h3>
	<?php the_content();?>
	<div class="B24-PricerowButton">
		<div class="B24-Roompricerow">
		<?php beds24_roomprice();?>
		</div>
		<div class="B24-Bookbutton">
		<?php beds24_bookbutton();?>
		</div>
	</div>
</div>



