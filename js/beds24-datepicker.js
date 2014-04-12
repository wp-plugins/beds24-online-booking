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
	var weekday = get_weekday();
	jQuery('#fdate_date').empty();
	var options = new Array();
	options [0] = weekday[7];
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
	for (i=1; i<=31; i++)
		{
		var d = new Date(year, month-1, i);	
		var n = d.getDay();
		options[i] = weekday[n] + ' ' + i;
		}
	}

	jQuery.each(options, function(value, key) {
	jQuery('#fdate_date').append(jQuery("<option></option>").attr("value", value).text(key));
	});
	jQuery('#fdate_date').val(dd);
}


function get_weekday() {
var weekday = new Array(8);
var lang = jQuery('#fdate_lang').val();
switch (lang) {
case "de":  //german
  weekday[0]="So";
  weekday[1]="Mo";
  weekday[2]="Di";
  weekday[3]="Mi";
  weekday[4]="Do";
  weekday[5]="Fr";
  weekday[6]="Sa";
  weekday[7]="Tag";
  break;
case "es":  //spanish
  weekday[0]="lun";
  weekday[1]="mar";
  weekday[2]="mié";
  weekday[3]="jue";
  weekday[4]="vie";
  weekday[5]="sáb ";
  weekday[6]="dom";
  weekday[7]="Dia";
  break;
case "fr":  //french
  weekday[0]="lun";
  weekday[1]="mar";
  weekday[2]="mer";
  weekday[3]="jeu";
  weekday[4]="ven";
  weekday[5]="sam ";
  weekday[6]="dim";
  weekday[7]="Jour";
  break;
case "it":  //italian
  weekday[0]="lun";
  weekday[1]="mar";
  weekday[2]="mer";
  weekday[3]="gio";
  weekday[4]="ven";
  weekday[5]="sab ";
  weekday[6]="dom";
  weekday[7]="Giorno";
  break;        
case "pt":  //portuges
  weekday[0]="seg";
  weekday[1]="ter";
  weekday[2]="qua";
  weekday[3]="qui";
  weekday[4]="sex";
  weekday[5]="sab ";
  weekday[6]="dom";
  weekday[7]="Dia";
  break;
default: //default english
  weekday[0]="Sun";
  weekday[1]="Mon";
  weekday[2]="Tue";
  weekday[3]="Wed";
  weekday[4]="Thu";
  weekday[5]="Fri";
  weekday[6]="Sat";
  weekday[7]="Day";
  break;
}
return weekday;  
}


