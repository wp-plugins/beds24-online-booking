<?php
/*
Plugin Name: Beds24 Online Booking
Plugin URI: http://www.beds24.com
Description: This plugin for the Beds24 online booking system lets you accept commission free online bookings directly from your Wordpress website. The plugin is free to use, but you need an account with Beds24.com. The Beds24.com online booking system and channel management is suitable for any type of accommodation such as B&B's, Hotels, Motels, Hostels, Vacation Rentals, Holiday Homes and Campgrounds.
Version: 1.0
Author: Mark Kinchin
Author URI: http://www.beds24.com
License: GPL2 or later
*/
register_activation_hook(__FILE__,'beds24_booking_install'); 
register_deactivation_hook( __FILE__, 'beds24_booking_remove' );

function beds24_booking_install() 
{
add_option("beds24_propid", '', '', 'yes');
add_option("beds24_height", 1600, '', 'yes');
add_option("beds24_width", 800, '', 'yes');
}

function beds24_booking_remove() 
{
delete_option('beds24_propid');
delete_option('beds24_height');
delete_option('beds24_width');
}

add_shortcode("beds24", "beds24_booking_page");

function beds24_booking_page($atts) 
{
$str = "";
$str .= "<iframe src=\"https://www.beds24.com/booking.php?type=3&propid=";
if(isset($atts['propid']) && $atts['propid'] != "")
	$str .= urlencode($atts['propid']);
else
	$str .= urlencode(get_option('beds24_propid'));
$str .= '" width="'.get_option('beds24_width').'" height="'.get_option('beds24_height').'" frameborder="0"></iframe>';
return $str;
}

if (is_admin()) 
{
add_action('admin_menu', 'beds24_menu');
function beds24_menu() 
{
add_options_page('Beds24 Online Booking', 'Beds24 Online Booking', 'administrator', 'beds24-admin-menu', 'beds24_admin_page');
}
}

function beds24_admin_page() 
{
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2>Beds24.com Embedded Booking Page</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<table>
<tr valign="top">
<td style="width: 160px; padding: 5px 5px 7px 5px;">Beds24 Property Id:</td>
<td style="padding: 5px 5px 7px 5px;">
<input name="beds24_propid" type="text" id="beds24_propid" size=6 maxlength=100 value="<?php echo get_option('beds24_propid'); ?>" />
<span style="font-style: italic; color: gray;"> Enter your Beds24.com Property Id.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Width:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_width" id="beds24_width">
<?php for($i = 200; $i < 1200; $i += 10) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_width') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select> <span style="font-style: italic; color: gray;">Identify the width and height available on your wordpress page and enter them here.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Height:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_height" id="beds24_height">
<?php for($i = 400; $i < 3000; $i += 10) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_height') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select>
</td>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;"></td>
<td style="padding: 5px 5px 7px 5px;">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="beds24_propid,beds24_width,beds24_height" />
<input type="submit" value="<?php _e('Save Changes') ?>" />
</td>
</tr>
</table>
</form>
</div>
<?php
}

class Beds24_Widget extends WP_Widget 
{
function Beds24_Widget() 
	{
	$widget_ops = array('classname' => 'Beds24_Widget', 'description' => 'Display a Beds24.com Widget. Choose from a booking calendar, booking box or booking button.' ); 
	$this->WP_Widget('Beds24_Widget', 'Beds24 Booking Widget', $widget_ops);   
	}
	
function form($instance) 
	{
	$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = $instance['title'];
	$widget_html = $instance['widget_html'];
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p style="font-size: 8pt; color: gray; font-style: italic;">Choose the widget to display from the Widget menu in your Beds24.com account. Copy and paste the code from the Beds24 menu to here.</p>
<p>
<div>Beds24 Widget Code:</div>
<textarea name="<?php echo $this->get_field_name('widget_html'); ?>" id="<?php echo $this->get_field_id('widget_html'); ?>">
<?php echo $widget_html; ?>
</textarea>
</p>

<?php
}
function update($new_instance, $old_instance) 
{
$instance = $old_instance;
$instance['title'] = $new_instance['title'];
$instance['widget_html'] = $new_instance['widget_html'];
return $instance;
}
function widget($args, $instance) 
{
extract($args, EXTR_SKIP);
echo $before_widget;
$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
if (!empty($title))
	echo $before_title . $title . $after_title;
// WIDGET CODE GOES HERE
echo $instance['widget_html'];
echo $after_widget;
}
}
add_action( 'widgets_init', create_function('', 'return register_widget("Beds24_Widget");') );
?>