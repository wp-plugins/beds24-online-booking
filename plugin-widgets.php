<h2>Booking Widgets</h2>
<div class="b24_section section-text">
<h3 class="b24_heading">Booking Widgets can be installed with a shortcode. </h3>
</div>
<p>Use shortcodes to add a booking widget to in a post, page or sidebar. Paste the shortcode where you want to display the widget. </p>    
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tbody>
<tr>
<th width="50%">Description</th>
<th>Shortcode</th>
</tr>
<tr>
<td width="50%">Booking button</td>
<td>[beds24-button]</td>
</tr>
<tr>
<td width="50%">Booking link</td>
<td>[beds24-link]</td>
</tr>
<tr>
<td width="50%">Booking box</td>
<td>[beds24-box]</td>
</tr>
</tbody>
</table>          
<div>
<h3>Customise the look of your widget to suit your website.</h3>
<table>
<?php
$options = array();
$options['iframe'] = 'iframe';
$options['window'] = 'same window';
$options['new'] = 'new window';
?>
<tr valign="top">
<td style="width: 160px; padding: 5px 5px 7px 5px;">Target:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_target" id="beds24_target">
<?php foreach ($options as $key => $val) { ?>
<option value ="<?php echo $key; ?>" <?php if(get_option('beds24_target') == $key) echo "selected"; ?>><?php echo $val; ?></option>
<?php } ?>
</select>
</td>
<td style="padding: 5px 5px 7px 5px;">
<span style="font-style: italic; color: gray;"> The target to open the booking form. "iframe" will open the booking page as an iframe on the same page. If you want the widget to open an embedded booking page on your website choose "iframe" and add the url of the target page href="http://www.myurl.com" to the shortcode.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Text colour:</td>
<td style="padding: 5px 5px 7px 5px;">
<input type="text" name="beds24_color" value="<?php echo get_option('beds24_color'); ?>" class="my-color-field" />
</td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Background Colour:</td>
<td style="padding: 5px 5px 7px 5px;">
<input type="text" name="beds24_bgcolor" value="<?php echo get_option('beds24_bgcolor'); ?>" class="my-color-field" />
</td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Padding:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_padding" id="beds24_padding">
<?php for($i = 0; $i <= 100; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_padding') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;"></span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;"></td>
<td colspan="2" style="padding: 5px 5px 7px 5px;">
<input type="submit" value="<?php _e('Save Changes') ?>" />
</td>
</tr>

</table>
    
<h3>Parameters</h3>
<p>Shortcodes can be customised. This can be useful if you use multiple widgets and want to style them individually. Change the values and enter the parameters into the shortcode. For a complete list of all parameters go to DOKUMENTATION.</p>
<p>Example:  [beds24-button href="http://www.myurl.com"] if you want a booking button opening you embedded booking page.</p>
<p>Example:  [beds24-box width="320"] sets the width of the booking box to 320px.</p>
<p>Example: [beds24-box roomid="6661"] will make a booking box for room 6661. </p>
<p>Example: [beds24-button text="Check Availability"] will change the text on the button to <i>Check Availability</i>. </p>
</div>
