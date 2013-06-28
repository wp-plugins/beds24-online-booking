<?php
/*
Plugin Name: Beds24 Online Booking
Plugin URI: http://www.beds24.com
Description: This plugin lets you accept commission free online bookings directly from your Wordpress website. Beds24.com is a full featured online booking engine. The system is very flexible with many options for customization. The plugin is free to use but you do need an account with Beds24.com. A free trial account is available at http://www.beds24.com/join.html . The Beds24.com online booking system and channel manager is suitable for any type of accommodation such as Hotels, Motels, B&B's, Hostels, Vacation Rentals, Holiday Homes and Campgrounds as well as selling extras like Tickets or Tours.
Version: 1.1
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
add_option("beds24_numdisplayed", 5, '', 'yes');
add_option("beds24_advancedays", 7, '', 'yes');
add_option("beds24_numnight", 1, '', 'yes');
add_option("beds24_numadult", 2, '', 'yes');
}

function beds24_booking_remove() 
{
delete_option('beds24_propid');
delete_option('beds24_height');
delete_option('beds24_width');
delete_option('beds24_numdisplayed');
delete_option('beds24_advancedays');
delete_option('beds24_numnight');
delete_option('beds24_numadult');
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
$str .= "&numdisplayed=".urlencode(get_option('beds24_numdisplayed'));
$str .= "&advancedays=".urlencode(get_option('beds24_advancedays'));
$str .= "&numnight=".urlencode(get_option('beds24_numnight'));
$str .= "&numadult=".urlencode(get_option('beds24_numadult'));
$str .= '" width="'.get_option('beds24_width').'" height="'.get_option('beds24_height').'" frameborder="0" style="max-width:100%;"></iframe>';
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
<input name="beds24_propid" type="text" id="beds24_propid" size=6 maxlength=100 value="<?php echo get_option('beds24_propid'); ?>" /></td>
<td style="padding: 5px 5px 7px 5px;">
<span style="font-style: italic; color: gray;"> Enter your Beds24.com Property Id Number. You will find this in the Beds24 control panel at SETTINGS >> PROPERTIES >> DESCRPTION.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Width:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_width" id="beds24_width">
<?php for($i = 200; $i < 1200; $i += 10) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_width') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Enter the width of the Embedded Booking Page in pixels.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Height:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_height" id="beds24_height">
<?php for($i = 400; $i < 3000; $i += 10) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_height') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Enter the height of the Embedded Booking Page in pixels. If you do not allow enough height the Embedded Booking Page will create a vertical scroll bar.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Dates Displayed:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_numdisplayed" id="beds24_numdisplayed">
<?php for($i = 0; $i <= 14; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_numdisplayed') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Enter the number of date columns to display. Choose the number of columns to suit the width you have available.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Days in Advance:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_advancedays" id="beds24_advancedays">
<?php for($i = 0; $i <= 180; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_advancedays') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">This is the number of days ahead of the current date for the default checkin date. For example if you set it to one, the default date will always be tomorrow.  shown when the page first opens. This only applies the first time the page opens, once opened or re-opened it will remember the previously selected date.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Number of Nights:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_numnight" id="beds24_numnight">
<?php for($i = 1; $i <= 7; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_numnight') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">This is the default setting for the booking duration.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Number of Guests:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_numadult" id="beds24_numadult">
<?php for($i = 1; $i <= 8; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_numadult') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">This is the default setting for the number of guests.</span>
</td>
</tr>
<tr valign="top">
<td style="padding: 5px 5px 7px 5px;"></td>
<td colspan="2" style="padding: 5px 5px 7px 5px;">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="beds24_propid,beds24_width,beds24_height,beds24_numdisplayed,beds24_advancedays,beds24_numnight,beds24_numadult" />
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