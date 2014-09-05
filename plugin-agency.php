<h2>Agency Searchbox</h2>
<div class="b24_section section-text">
<p>The plugin can use posts or XML to display availabilty for multiple hotels or lodgings and allows search by the search criteria defined in the SETTINGS-> AGENCY section of Beds24.</p>
<p><strong>1.1 Agency Searchbox </strong></p>
<p>You can embed a searchbox into your Wordpress site. The searchbox will return your live availability. The results can be shown on the same or a different page or in a pop up.</p>
<p>Use shortcodes to add a searchbox in a post, page or sidebar.</p>
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tbody>
<tr>
<td>1</td>
<td width="50%">searchbox displaying the search results on the same page</td>
<td>[beds24-searchbox]</td>
</tr>
<tr>
<td></td>
<td width="50%">insert this code where you want the search results do display</td>
<td>[beds24-searchresult display="none"]</td>
</tr>
</tbody>
</table>
<br>
<br>
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tbody>
<tr>
<td>2</td>
<td width="50%">searchbox displaying the search results on a defined page page. If you want to show the results on another page add the url.</td>
<td>[beds24-searchbox href="http://mywebsite/wordpress/?page_id=xy"]</td>
</tr>
<tr>
<td></td>
<td width="50%">insert this code where you want the search results do display</td>
<td>[beds24-searchresult];</td>
</tr>
</tbody>
</table>
<p><strong>1.2 Search Criteria</strong></p>
<p>To set up the agency searchbox with your search criteria you need to modify the file /plugins/beds24-online-booking/theme-files/beds24-searchbox.php to use the search criteria you set up in Beds24 SETTINGS-> AGENCY -> SEARCH CRITERIA. There are comments in the file about the naming requirements for the select and checkbox elements. If you need assistance please contact us. </p>
<p><strong>2.1 XML Display</strong></p>
<p>By default the plugin uses the file plugins/beds24-online-booking/theme-files/ beds24-prop-xml.php to display the property results using the information returned by the search.This file can be customised to change the display of the information.</p>
<strong>2.2 Post Display</strong>
<br>
<p>As an alternative you can display the results using Wordpress posts for each property. Custom fields are used to connect posts to your Beds24 account.</p>
<ol>
<li>Add a custom field </li>
<li>As "Name" enter the phase: propid </li>
<li>As value entere the Beds24 property Id number for this lodging. You will find this in the Beds24 control panel at SETTINGS -> PROPERTIES -> DESCRPTION.</li>
<li>To add a booking widget to the post add a widget shortcode e.g. [beds24-button]</li>
</ol>
<p>The plugin will use file plugins/beds24-online-booking/theme-files/ beds24-prop-post.php isplay the property results using the information returned by the search.This file can be customised to change the display of the information. If the propid is not found in the custom field the XML Display will be used for that property. </p>
</div> 