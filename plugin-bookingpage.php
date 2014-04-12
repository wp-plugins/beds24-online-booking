<h2>Embedded Booking Page</h2>
<div class="b24_section section-text">
<h3 class="b24_heading">Customise and Install your Embedded Booking Page.</h3>
<p>These settings customise your embedded booking page. To change fonts and colours log into your Beds24 account and go to SETTINGS -> BOOKING PAGE -> PAGE DESIGN</p>
    
<p>Paste the shortcode into the page where you want to embed your booking page. </p>    
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tbody>
<tr>
<th width="50%">Description</th>
<th>Shortcode</th>
</tr>
<tr>
<td width="50%">embedded booking page</td>
<td>[beds24-embed]</td>
</tr>
</tbody>
</table>          
</div>
<div>
<table>
<tr valign="top">
<td style="width: 160px; padding: 5px 5px 7px 5px;">Beds24 Owner Id:</td>
<td style="padding: 5px 5px 7px 5px;">
<input name="beds24_ownerid" type="text" id="beds24_ownerid" size=6 maxlength=100 value="<?php echo get_option('beds24_ownerid'); ?>" /></td>
<td style="padding: 5px 5px 7px 5px;">
<span style="font-style: italic; color: gray;"> Enter your Beds24.com owner Id number to create an embedded booking page show all properties in your account. You will find this in the Beds24 control panel at SETTINGS -> ACCOUNT "Account Number" </span>
</td>
</tr>

<tr valign="top">
<td style="width: 160px; padding: 5px 5px 7px 5px;">Beds24 Property Id:</td>
<td style="padding: 5px 5px 7px 5px;">
<input name="beds24_propid" type="text" id="beds24_propid" size=6 maxlength=100 value="<?php echo get_option('beds24_propid'); ?>" /></td>
<td style="padding: 5px 5px 7px 5px;">
<span style="font-style: italic; color: gray;"> Enter your Beds24.com Property Id number to create an embedded booking page for this property only. You will find this in the Beds24 control panel at SETTINGS -> PROPERTIES.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Width:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_width" id="beds24_width">
<?php for($i = 200; $i < 1200; $i += 10) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_width') == $i) echo "selected"; ?>><?php echo $i; ?>px</option>
<?php } ?>
</select>
</td>
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
<td style="padding: 5px 5px 7px 5px;">Number of Dates Displayed:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_numdisplayed" id="beds24_numdisplayed">
<option value ="-1" <?php if(get_option('beds24_numdisplayed') == -1) echo "selected"; ?>>Default</option>
<?php for($i = 0; $i <= 14; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_numdisplayed') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Enter the number of date columns to display. Choose the number of columns to suit the width you have available.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Show Calendar:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_hidecalendar" id="beds24_hidecalendar">
<option value ="-1" <?php if(get_option('beds24_hidecalendar') == -1) echo "selected"; ?>>Default</option>
<option value ="1" <?php if(get_option('beds24_hidecalendar') == 1) echo "selected"; ?>>No</option>
<option value ="0" <?php if(get_option('beds24_hidecalendar') == 0) echo "selected"; ?>>Yes</option>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Show a monthly calendar on the booking page.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Show Header:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_hideheader" id="beds24_hideheader">
<option value ="-1" <?php if(get_option('beds24_hideheader') == -1) echo "selected"; ?>>Default</option>
<option value ="1" <?php if(get_option('beds24_hideheader') == 1) echo "selected"; ?>>No</option>
<option value ="0" <?php if(get_option('beds24_hideheader') == 0) echo "selected"; ?>>Yes</option>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Show the booking page header.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Show Footer:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_hidefooter" id="beds24_hidefooter">
<option value ="-1" <?php if(get_option('beds24_hidefooter') == -1) echo "selected"; ?>>Default</option>
<option value ="1" <?php if(get_option('beds24_hidefooter') == 1) echo "selected"; ?>>No</option>
<option value ="0" <?php if(get_option('beds24_hidefooter') == 0) echo "selected"; ?>>Yes</option>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Show the booking page footer.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Days in Advance:</td>
<td style="padding: 5px 5px 7px 5px;">
<select name="beds24_advancedays" id="beds24_advancedays">
<option value ="-1" <?php if(get_option('beds24_advancedays') == -1) echo "selected"; ?>>First Available</option>
<?php for($i = 0; $i <= 180; $i += 1) { ?>
<option value ="<?php echo $i; ?>" <?php if(get_option('beds24_advancedays') == $i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select></td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">This is the number of days ahead of the current date for the default checkin date. For example if you set it to one, the default date will always be tomorrow. This only applies the first time the page opens, once opened or re-opened it will remember the previously selected date.</span>
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
<td style="padding: 5px 5px 7px 5px;">Referer:</td>
<td style="padding: 5px 5px 7px 5px;">
<input type="text" name="beds24_referer" id="beds24_referer" value="<?php echo str_replace('"', "", get_option('beds24_referer')); ?>">
</td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Store this text as the referer for bookings originating here</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;">Custom URL Parameters:</td>
<td style="padding: 5px 5px 7px 5px;">
<input type="text" name="beds24_custom" id="beds24_custom" value="<?php echo str_replace('"', "", get_option('beds24_custom')); ?>">
</td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Add custom parameters to the booking page URL. See <a href="http://wiki.beds24.com/index.php?title=Page/widgetwebdesign" target="_blank">here</a> for more information.</span>
</td>
</tr>

<tr valign="top">
<td style="padding: 5px 5px 7px 5px;"></td>
<td colspan="2" style="padding: 5px 5px 7px 5px;">
<input type="submit" value="<?php _e('Save Changes') ?>" />
</td>
</tr>
</table>                     
</div>   