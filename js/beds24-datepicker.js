jQuery(document).ready(function($) {
	$("#datepicker").datepicker({
	buttonImage: WPURLS.siteurl + '/wp-content/plugins/beds24-online-booking/theme-files/include/ic_calendar2.png',
	buttonImageOnly: true,
	changeMonth: true,
	changeYear: true,
	showOn: 'both',
				dateFormat: 'yy-mm-dd',
				beforeShow: readdatepicker, 
				onSelect: updatedatepicker, 

    });
	$( "#fdate_monthyear" ).change(function() {
		fdate_monthyear_changed();
	});
	
	if(document.getElementById("fdate_monthyear"))
		fdate_monthyear_changed ();
});

function readdatepicker() {
    jQuery('#datepicker').val(jQuery('#fdate_monthyear').val() + '-' + jQuery('#fdate_date').val());
    return {};
}

function updatedatepicker(date) {
	jQuery('#fdate_monthyear').val(date.substring(0, 7));
	fdate_monthyear_changed ();
	jQuery('#fdate_date').val(parseInt(date.substring(8),10));
}

function fdate_monthyear_changed () {
	var dd = jQuery('#fdate_date').val();
	var mm = jQuery('#fdate_monthyear').val();
	jQuery('#fdate_date').empty();
	var options = new Array();
	options [0] = 'Day';
	if (mm==0)
	{
		for (i=1; i<=31; i++)
		{
		options[i] = i;
		}
}
	else
	{
	year = parseInt(jQuery('#fdate_monthyear').val().substring(0, 4),10);
	month = parseInt(jQuery('#fdate_monthyear').val().substring(5, 7),10);
	var weekday=new Array(7);
	weekday[0]="Sun";
	weekday[1]="Mon";
	weekday[2]="Tue";
	weekday[3]="Wed";
	weekday[4]="Thu";
	weekday[5]="Fri";
	weekday[6]="Sat";
	for (i=1; i<=31; i++)
		{
		var d = new Date(year, month-1, i);	
		var n = d.getDay();
		options[i] = weekday[n] + ' ' + i;
		}
	}

		
	jQuery.each(options, function(value, key) {
  jQuery('#fdate_date').append(jQuery("<option></option>")
    .attr("value", value).text(key));
	});
	
		
	jQuery('#fdate_date').val(dd);

	
}