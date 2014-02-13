<?php
/*
Plugin Name: Beds24 Online Booking
Plugin URI: http://www.beds24.com
Description: Beds24.com is a full featured online booking engine. The system is very flexible with many options for customization. The Beds24.com online booking system and channel manager is suitable for any type of accommodation such as hotels, motels, B&B's, hostels, vacation rentals, holiday homes and campgrounds as well as selling extras like tickets or tours. The plugin is free to use but you do need an account with Beds24.com. A free trial account is available <a href="http://www.beds24.com/join.html" target="_blank">here</a>
Version: 2.0.3
Author: Mark Kinchin
Author URI: http://www.beds24.com
License: GPL2 or later
*/
register_activation_hook(__FILE__,'beds24_booking_install'); 
register_deactivation_hook( __FILE__, 'beds24_booking_remove' );

add_filter('widget_text', 'do_shortcode', 11);

function beds24_booking_install() 
{
add_option("beds24_ownerid", '');
add_option("beds24_propid", '');
add_option("beds24_roomid", '');
add_option("beds24_height", 1600);
add_option("beds24_width", 800);
add_option("beds24_numdisplayed", -1);
add_option("beds24_hidecalendar", -1);
add_option("beds24_hideheader", -1);
add_option("beds24_hidefooter", -1);
add_option("beds24_advancedays", 7);
add_option("beds24_numnight", 1);
add_option("beds24_numadult", 2);
add_option("beds24_custom", '');
add_option("beds24_target", 'new');
add_option("beds24_color", '#dddddd');
add_option("beds24_bgcolor", '#444444');
add_option("beds24_padding", 10);
}

function beds24_booking_remove() 
{
delete_option('beds24_ownerid');
delete_option('beds24_propid');
delete_option('beds24_roomid');
delete_option('beds24_height');
delete_option('beds24_width');
delete_option('beds24_numdisplayed');
delete_option('beds24_hidecalendar');
delete_option('beds24_hideheader');
delete_option('beds24_hidefooter');
delete_option('beds24_advancedays');
delete_option('beds24_numnight');
delete_option('beds24_numadult');
delete_option('beds24_custom');
delete_option('beds24_target');
delete_option('beds24_color');
delete_option('beds24_bgcolor');
delete_option('beds24_padding');
}


function beds24_scripts()
{
if (!session_id())
    session_start();

wp_enqueue_script('jquery');

wp_enqueue_style('beds24', plugins_url( '/theme-files/beds24.css', __FILE__ ));
	
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

wp_enqueue_script( 'beds24-datepicker', plugins_url('/js/beds24-datepicker.js', __FILE__ ), array( 'jquery-ui-datepicker' ));
wp_localize_script('beds24-datepicker', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));
}

add_action( 'wp_enqueue_scripts', 'beds24_scripts' );

add_shortcode("beds24", "beds24_booking_page");
add_shortcode("beds24-link", "beds24_booking_page_link");
add_shortcode("beds24-button", "beds24_booking_page_button");
add_shortcode("beds24-box", "beds24_booking_page_box");
add_shortcode("beds24-searchbox", "beds24_booking_page_searchbox");
add_shortcode("beds24-embed", "beds24_booking_page_embed");
add_shortcode("beds24-landing", "beds24_booking_page_landing");


add_action( 'admin_enqueue_scripts', 'beds24_admin_scripts' );

function beds24_admin_scripts( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style('beds24-admin-css', plugins_url( '/css/beds24-admin.css', __FILE__ ));
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'beds24-admin', plugins_url('/js/beds24-admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}


function beds24_booking_page_link($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'link';
if (!isset($atts['padding'])) 
  $atts['padding'] = 0;
if (!isset($atts['text'])) 
  $atts['text'] = 'Book Now';
return beds24_booking_page($atts);
}

function beds24_booking_page_button($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'button';
if (!isset($atts['text'])) 
  $atts['text'] = 'Book Now';
if (!isset($atts['class'])) 
  $atts['class'] = 'beds24_bookbutton';
return beds24_booking_page($atts);
}

function beds24_booking_page_box($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'box';
if (!isset($atts['fontsize'])) 
  $atts['fontsize'] = '20';
return beds24_booking_page($atts);
}

function beds24_booking_page_searchbox($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'searchbox';
if (!isset($atts['fontsize'])) 
  $atts['fontsize'] = '20';
return beds24_booking_page($atts);
}

function beds24_booking_page_embed($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'embed';
if (!isset($atts['advancedays'])) 
  $atts['advancedays'] = '-1';
return beds24_booking_page($atts);
}

function beds24_booking_page_landing($atts)
{
if (!isset($atts['type'])) 
  $atts['type'] = 'embed';
if (!isset($atts['noselection'])) 
  $atts['noselection'] = true;
return beds24_booking_page($atts);
}

function beds24_booking_page($atts)
{
    
$postid = get_the_ID();

//ownerid
if (isset($atts['ownerid']))
	$ownerid = $atts['ownerid'];
else if (get_post_meta($ownerid, 'ownerid', true)>0)	
	$ownerid = get_post_meta($ownerid, 'ownerid', true); 
else 
	$ownerid = get_option('beds24_ownerid');

if ($ownerid > 0)
	$owner = '&amp;ownerid='.intval($ownerid);	
else if (isset($atts['ownerid']))
	$owner = '&amp;ownerid='.intval($atts['ownerid']);
else
	$owner = '';

//propid
if (isset($atts['propid']))
	$propid = $atts['propid'];
else if (get_post_meta($postid, 'propid', true)>0 && !isset($atts['ownerid']))	
	$propid = get_post_meta($postid, 'propid', true); 
else if (!isset($atts['ownerid']))
	$propid = get_option('beds24_propid');

if ($propid > 0)
	$prop = '&amp;propid='.intval($propid);	
else if (isset($atts['propid']))
	$prop = '&amp;propid='.intval($atts['propid']);
else
	$prop = '';
	
//roomid
if (isset($atts['roomid']))
	$roomid = $atts['roomid'];
else if (get_post_meta($postid, 'roomid', true)>0)	
	$roomid = get_post_meta($postid, 'roomid', true); 
else 
	$roomid = get_option('beds24_roomid');

if ($roomid > 0)
	$room = '&amp;roomid='.intval($roomid);	
else if (isset($atts['roomid']))
	$room = '&amp;roomid='.intval($atts['roomid']);
else
	$room = '';

//number of dates displayed
if (isset($atts['numdisplayed']))
	$numdisplayed = $atts['numdisplayed'];
else 
	$numdisplayed = get_option('beds24_numdisplayed');
if (isset($numdisplayed) && $numdisplayed!=-1)
	$urlnumdisplayed = "&amp;numdisplayed=".urlencode(intval($numdisplayed));
else
	$urldisplayed = '';

//show calendar
if (isset($atts['hidecalendar']))
	$hidecalendar = $atts['hidecalendar'];
else 
	$hidecalendar = get_option('beds24_hidecalendar');
if (isset($hidecalendar) && $hidecalendar!=-1)
	$urlhidecalendar = "&amp;hidecalendar=".urlencode($hidecalendar);
else
	$urlhidecalendar = '';

//show header
if (isset($atts['hideheader']))
	$hideheader = $atts['hideheader'];
else 
	$hideheader = get_option('beds24_hideheader');
if (isset($hideheader) && $hideheader!=-1)
	$urlhideheader = "&amp;hideheader=".urlencode($hideheader);
else
	$urlhideheader = '';

//show footer
if (isset($atts['hidefooter']))
	$hidefooter = $atts['hidefooter'];
else 
	$hidefooter = get_option('beds24_hidefooter');
if (isset($hidefooter) && $hidefooter!=-1)
	$urlhidefooter = "&amp;hidefooter=".urlencode($hidefooter);
else
	$urlhidefooter = '';

//checkin or show this many days from now
$checkin = false;
if (isset($_REQUEST['checkin']))
	$checkin = $_REQUEST['checkin'];
else if (isset($_REQUEST['fdate_date']) && isset($_REQUEST['fdate_monthyear']))	
	$checkin = date('Y-m-d', strtotime($_REQUEST['fdate_monthyear'].'-'.$_REQUEST['fdate_date']));
else if (isset($_SESSION['beds24-checkin']))
	{
	$checkin = $_SESSION['beds24-checkin'];
	}
else if (isset($atts['advancedays']))
	{
	$advancedays = $atts['advancedays'];
	if ($advancedays>=0)
	  $checkin = date('Y-m-d', strtotime('+'.$advancedays.' days'));
	}
else 
	{
	$advancedays = get_option('beds24_advancedays');
	if ($advancedays>=0)
	  $checkin = date('Y-m-d', strtotime('+'.$advancedays.' days'));
	}
	
	
$urlcheckin = '';
if ($checkin)
  {
  $checkin = date('Y-m-d', strtotime($checkin));
  if ($checkin < date('Y-m-d'))
    $checkin = date('Y-m-d');
  $_SESSION['beds24-checkin'] = $checkin;
  if (!isset($atts['noselection']))
    $urlcheckin = "&amp;checkin=".urlencode($checkin);
  }
	
//default number of nights
if (isset($_REQUEST['numnight']))
	$numnight = $_REQUEST['numnight'];
else if (isset($_SESSION['beds24-numnight']))
	$numnight = $_SESSION['beds24-numnight'];
else if (isset($atts['numnight']))
	$numnight = $atts['numnight'];
else 
	$numnight = get_option('beds24_numnight');
$_SESSION['beds24-numnight'] = $numnight;
if (isset($numnight) && !isset($atts['noselection']))
	$urlnumnight = "&amp;numnight=".urlencode(intval($numnight));
else
	$urlnumnight = '';
	
//number of guests
if (isset($_REQUEST['numadult']))
	$numadult = $_REQUEST['numadult'];
else if (isset($_SESSION['beds24-numadult']))
	$numadult = $_SESSION['beds24-numadult'];
else if (isset($atts['numadult']))
	$numadult = $atts['numadult'];
else 
	$numadult = get_option('beds24_numnight');
$_SESSION['beds24-numadult'] = $numadult;
if (isset($numadult) && !isset($atts['noselection']))
	$urlnumadult = "&amp;numadult=".urlencode(intval($numadult));
else
	$urlnumadult = '';

//width of target
$width = false;
if (isset($atts['width']))
  {
  $width = $atts['width'];
  }
else
  $width = get_option('beds24_width');

if ($width<100)
	$width = 800;
	
//height of target
if (isset($atts['height']))
	$height = $atts['height'];
else 
	$height = get_option('beds24_height');

if ($height<100)
	$height = 1600;

//type=link
//type=button
//type=box
//type=searchbox
//type=searchresult
//type=embed
if (isset($atts['type']))
	$type = $atts['type'];
else 
	$type = 'embed';
//	$type = get_option('beds24_type');

//target=iframe
//target=window
//target=new
if (isset($atts['target']))
	$target = $atts['target'];
else 
	$target = get_option('beds24_target');

if (isset($atts['display']))
	$display = $atts['display'];

$suffix = '_'.$ownerid.'_'.$propid.'_'.$roomid;
if (isset($atts['targetid']))
	{
	$targetid = $atts['targetid'];
//	$target = 'none';
	}
else if (isset($atts['id']))
	{
	$targetid = $atts['id'];
	}
else	
	$targetid = 'beds24target'.$suffix;
	
//widget text
if (isset($atts['text']))
	$text = htmlspecialchars($atts['text']);
else
	$text = 'Book Now';

//widget class
if (isset($atts['class']))
	$class = htmlspecialchars($atts['class']);
else
	$class = '';

//target url custom parameters
if (isset($atts['custom']))
	$custom = $atts['custom'];
else
	$custom = get_option('beds24_custom');
if (substr($custom,0,1) != '&')
  $custom = '&amp;'.$custom;

$style = 'cursor: pointer;';

//widget font size
if (isset($atts['fontsize']))
	$style .= 'font-size: '.$atts['fontsize'].';';

/*
//widget padding
if (isset($atts['padding']))
	$style .= 'padding: '.$atts['padding'].';';
*/
	
//widget color
if (isset($atts['color']))
	$style .= 'color: '.$atts['color'].';';
elseif (strlen(get_option('beds24_color')) >=3)
	$style .= 'color: '.get_option('beds24_color').';';;


//padding
if (isset($atts['padding']))
	$style .= 'padding: '.$atts['padding'].'px;';
else
	$style .= 'padding: '.get_option('beds24_padding').'px;';

$linkstyle = $style;

//widget background color
if (isset($atts['bgcolor']))
	$style .= 'background-color: '.$atts['bgcolor'].';';
elseif (strlen(get_option('beds24_bgcolor')) >=3)
	$style .= 'background-color: '.get_option('beds24_bgcolor').';';

	
$boxstyle = $style;
$buttonstyle = $style;

if (isset($atts['width']))
  $boxstyle .= 'max-width: '.$atts['width'].'px;';

$defaulthref = 'https://www.beds24.com/booking2.php';

//href target
if (isset($atts['href']))
	$href = $atts['href'];
else
	$href = $defaulthref;


$formurl = $href;
$url = $href.'?1'.$owner.$prop.$room.$urlnumdisplayed.$urlhideheader.$urlhidefooter.$urlhidecalendar.$urlcheckin.$urlnumnight.$urlnumadult.$custom;



$output = '';
$thistarget = '';
$onclick = '';
$linkclass = '';

if ($target == 'window')
	{
	if ($type != 'box')
	  {
	  if ($formurl == $defaulthref) //stay on same page
		$formurl = '';
	  }
	}
//else if ($target == 'none')
//	{
//	$formurl = '';
//	}
else if ($target == 'new')
	{
	$thistarget = ' target="_blank" ';
	}
else //iframe
	{
	if ($target != 'none')
		$target = 'iframe';
	$onclick = 'onclick="jQuery(\'#'.$targetid.'\').show();jQuery(\'#beds24book'.$suffix.'\').hide();return false;"';
	if ($type != 'embed')
		$display = 'none';
	}
	

if ($type == 'link')
	{
	$output .= '<a '.$thistarget.' class="'.$linkclass.$class.'" id="beds24book'.$suffix.'" style="'.$linkstyle.'" href="'.$url.'" '.$onclick.'>';
	$output .= htmlspecialchars($text);
	$output .= '</a>';
	}
else if ($type == 'button')
	{
	$output .= '<a '.$thistarget.' class="'.$linkclass.'" id="beds24book'.$suffix.'" style="text-decoration:none;" href="'.$url.'" '.$onclick.'>';
	$output .= '<button class="'.$class.'" style="'.$buttonstyle.'">'.htmlspecialchars($text).'</button>';
	$output .= '</a>';
	}
else if ($type == 'box' || $type == 'searchbox' || $type == 'searchresult')
	{
	if($type == 'box' || $type == 'searchbox')
	{
	if($type == 'box')
	  {
	  ob_start();
	  get_template_part('beds24-box');
	  $searchbox = ob_get_clean();
	  if (!$searchbox)
		{
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'theme-files/beds24-box.php');
		$searchbox .= ob_get_clean();
		}
	  }
	else if($type == 'searchbox')
	  {
	  ob_start();
	  get_template_part('beds24-searchbox');
	  $searchbox = ob_get_clean();
	  if (!$searchbox)
		{
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'theme-files/beds24-searchbox.php');
		$searchbox .= ob_get_clean();
		}
	  }
	  
	  
	$output .= '<div id="beds24'.$type.$suffix.'" style="'.$boxstyle.'" class="beds24'.$type.'">';
	$output .= '<form '.$thistarget.' id="beds24book'.$suffix.'" method="post" action="'.$formurl.'">';
	if ($ownerid > 0)
		$output .= '<input type="hidden" name="ownerid" value="'.$ownerid.'">';
	if ($propid > 0)
		$output .= '<input type="hidden" name="propid" value="'.$propid.'">';
	if ($roomid > 0)
		$output .= '<input type="hidden" name="roomid" value="'.$roomid.'">';
	if (isset($numdisplayed) && $numdisplayed!=-1)
		$output .= '<input type="hidden" name="numdisplayed" value="'.$numdisplayed.'">';
	if (isset($hidecalendar) && $hidecalendar!=-1)
		$output .= '<input type="hidden" name="hidecalendar" value="'.$hidecalendar.'">';
	if (isset($hideheader) && $hideheader!=-1)
		$output .= '<input type="hidden" name="hideheader" value="'.$hideheader.'">';
	if (isset($hidefooter) && $hidefooter!=-1)
		$output .= '<input type="hidden" name="hidefooter" value="'.$hidefooter.'">';
	
	
	$output .= $searchbox;
	$output .= '</form>';
	$output .= '</div>';

	$output .= '<script>jQuery(document).ready(function($) {';
	
	if ($_REQUEST['showmoredetails'] < 1)
		$output .= '$("#B24advancedsearch").hide();';
	
	$output .= '});</script>';
	}
	

	if($type == 'box')
	{
	
	}
	if($type == 'searchresult')
	{
	if (isset($_REQUEST['fdate_date']))
		{
//		if ($_REQUEST['fdate_monthyear'] < 1)
//			$_REQUEST['fdate_monthyear'] = date('Y-m');
//		if ($_REQUEST['fdate_date'] < 1)
//			$_REQUEST['fdate_date'] = date('d');
		
//		$checkin = date('Y-m-d', strtotime($_REQUEST['fdate_monthyear'].'-'.$_REQUEST['fdate_date']));
//		$numnight = intval($_REQUEST['numnight']);
//		$numadult = intval($_REQUEST['numadult']);

		
		$xmlurl = 'https://www.beds24.com/api/getavailabilities.xml';
		$postarray = array( 'ownerid' => $ownerid, 'checkin' => $checkin, 'numnight' => $numnight, 'numadult' => $numadult );

/*
		if (isset($_REQUEST['category1']))
			$postarray['category1'] = $_REQUEST['category1'];
		if (isset($_REQUEST['category2']))
			$postarray['category2'] = $_REQUEST['category2'];
		if (isset($_REQUEST['category3']))
			$postarray['category3'] = $_REQUEST['category3'];
		if (isset($_REQUEST['category4']))
			$postarray['category4'] = $_REQUEST['category4'];
*/

		$category = array();
		foreach ($_REQUEST as $key => $val)
			{
			if (substr($key,0,8) == 'category')
				{
				$cat = substr($key,8,1);
				if ($cat>=1 && $cat<=4)
					{
					if (strlen($key)>9)
						$val = substr($key,10);
					$val = intval($val);
					if ($val > 0)
						{
						if (isset($category[$cat]))
							$category[$cat] .= ',';
						$category[$cat] .= $val;	
						}
					}
				}
			}
			
		foreach ($category as $key => $val)
			{
			$postarray['category'.$key] = $val;			
			}
		
		$args = array(
			'method' => 'POST',
			'timeout' => 15,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => $postarray,
			'cookies' => array()
			);
		$response = wp_remote_post($xmlurl, $args);

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			$output .=  "Something went wrong: $error_message";
			return $output;
		} else {
			$result = new SimpleXMLElement($response['body']);
			$xmlowner = $result->owner;
			if (count($xmlowner->property)==0)
			{
			$output .= '<p class="b24_message">No results found</p>';
			}
			else
			{
			foreach ($xmlowner->property as $xmlproperty)
				{
				$propid = intval($xmlproperty['id']);
				$name = $xmlproperty['name'];
				$bestprice = $xmlproperty['bestPrice'];
				$bookurl = 'https://www.beds24.com/booking2.php?propid='.$propid.'&amp;checkin='.$checkin.'&amp;numadult='.$numadult.'&amp;numnight='.$numnight.$urlnumdisplayed.$urlhideheader.$urlhidefooter.$urlhidecalendar.$urlcheckin.$custom;
				$propoutput = false;

				$args = array('meta_key' => 'propid', 'meta_value'=> $propid);
				$mypropposts = get_posts( $args );
				foreach ($mypropposts as $post) 
					{

					
					$postoutput = false;
					setup_postdata($post);
					ob_start();
					get_template_part('beds24-prop-post');
					$postpoutput = ob_get_clean();

					if (!$propoutput)
						{
						ob_start();
						include( plugin_dir_path( __FILE__ ) . 'theme-files/beds24-prop-post.php');
						$postoutput = ob_get_clean();
						}
					$propoutput .= $postoutput;

					}

				if (!$propoutput)
					{
					ob_start();
					get_template_part('beds24-prop-xml');
					$propoutput = ob_get_clean();
					if (!$propoutput)
						{
						ob_start();
						include( plugin_dir_path( __FILE__ ) . 'theme-files/beds24-prop-xml.php');
						$propoutput = ob_get_clean();
						}	
					}
				$output .= $propoutput;
				}
			}
			}
		}
	}
	}//end box

if ($type=='embed' || $target=='iframe') //iframe
	{
	$output .= '<div id="'.$targetid.'">';
	$output .= '<iframe src ="'.$url.'" width="'.$width.'" height="'.$height.'" style="max-width:100%;border:none;overflow:auto;"><p><a href="'.$url.'">'.htmlspecialchars($text).'</a></p></iframe>';
	$output .= '</div>';
	if ($display == 'none')
		{
		$output .= '<script>jQuery(document).ready(function($) {jQuery("#'.$targetid.'").hide(); });</script>';
		}
	}
	
	
return $output;
}





if (is_admin()) 
{
add_action('admin_menu', 'beds24_menu');
function beds24_menu() 
{
add_options_page('Beds24', 'Beds24', 'administrator', 'beds24-admin-menu', 'beds24_admin_page');
}
}


//this makes the new control html
function beds24_admin_page() 
{
$url = plugins_url();
?><div id="b24_container" class="b24_wrap">
<div id="b24_header">
<div class="b24_logo">
<h2>Beds24 Online Booking System</h2>
</div>
<a target="#">
<div class="b24_icon-option"> </div>
</a>
<div class="clear"></div>
</div>
<div id="b24_main">
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="beds24_ownerid,beds24_propid,beds24_width,beds24_height,beds24_numdisplayed,beds24_hidecalendar,beds24_hideheader,beds24_hidefooter,beds24_advancedays,beds24_numnight,beds24_numadult,beds24_custom,beds24_target,beds24_color,beds24_bgcolor,beds24_padding" />

<div id="b24_of-nav">
<ul>
<li id="pn_bookingpage_li"> <a class="pn-view-a" href="#pn_bookingpage" title="Booking Page">Booking Page </a></li>
<li id="pn_widgets_li"> <a class="pn-view-a" href="#pn_widgets" title="Booking Widgets">Booking Widgets</a></li>
<li id="pn_agency_li"> <a class="pn-view-a" href="#pn_agency" title="Agency">Agency Searchbox</a></li>	
<li id="pn_documentation_li"> <a class="pn-view-a" href="#pn_documentation" title="Documentation">Documentation</a></li>
<li id="pn_about_li"> <a class="pn-view-a" href="#pn_about" title="About">About</a></li>
</ul>
</div>
<div id="b24_content">
<div class="b24_group" id="pn_bookingpage">
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
<td style="padding: 5px 5px 7px 5px;">Custom URL Parameters:</td>
<td style="padding: 5px 5px 7px 5px;">
<input type="text" name="beds24_custom" id="beds24_custom" value="<?php echo str_replace('"', "", get_option('beds24_custom')); ?>">
</td>
<td style="padding: 5px 5px 7px 5px;"> <span style="font-style: italic; color: gray;">Add custom parameters to the booking page URL. See <a href="http://wiki.beds24.com/index.php?title=Page/widgetwebdesign" target="_blank">here</span> for more information.
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
</div>	                  
<div class="b24_group" id="pn_widgets">
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
</div>

<div id="pn_agency" class="b24_group" style="display: block;">
<h2>Agency Searchbox</h2>
<div class="b24_section section-text">
<p>The plugin can use posts or XML to display availabilty for multiple hotels or lodgings and allows search by the search criteria defineds in the SETTINGS-> AGENCY section of Beds24.</p>
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
</div>
                                                                    
<div class="b24_group" id="pn_documentation">
<h2>Shortcodes</h2>
<div class="b24_section section-text">

<h3>Shortcodes</h3>
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tbody>
<tr>
<td width="50%">Embedded booking page</td>
<td>[beds24-embed]</td>
</tr>
<tr>
<td width="50%">Embedded booking page without preset guest selections</td>
<td>[beds24-landing]</td>
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
<tr>
<td width="50%">Agency searchbox</td>
<td>[beds24-searchbox]</td>
</tr>
<tr>
<td width="50%">Agency searchresults</td>
<td>[beds24-searchresults]</td>
</tr>
</tbody>
</table>
<h3>Parameters</h3>
<p>Shortcodes can be customised. Change the values and enter the parameters into the shortcode.</p>
<tbody>
<table width="900" cellspacing="0" cellpadding="2" border="1">
<tr>
<th width="50%">Description</th>
<th>Values</th>
</tr>
<tr>
<td width="50%">widget for a group of properties <br>(exchange 1 with your Beds24 id)</td>
<td>ownerid="1"</td>
</tr>
<tr>
<td width="50%">widget for a property <br>(exchange 1 with your Beds24 id)</td>
<td>propid="1"</td>
</tr>
<tr>
<td width="50%">widget for a room <br>(exchange 1 with your Beds24 id)</td>
<td>roomid="1"</td>
</tr>
<tr>
<td width="50%">number of dates displayed</td>
<td>numdisplayed="7"</td>
</tr>
<tr>
<td width="50%">hide or show calendar</td>
<td>hidecalendar="no"</td>
</tr>
<tr>
<td width="50%">hide or show header</td>
<td>hideheader="yes"</td>
</tr>
<tr>
<td width="50%">hide or show footer</td>
<td>hidefooter="yes"</td>
</tr>
<tr>
<td width="50%">checkin/show this many days from now (1 is tomorrow)</td>
<td>advancedays="1"</td>
</tr>
<tr>
<td width="50%">default number of nights selected</td>
<td>numnight="2"</td>
</tr>
<tr>
<td width="50%">default number of guests selected</td>
<td>numdult="2"</td>
</tr>
<tr>
<td width="50%">width of target in pixels</td>
<td>width="800"</td>
</tr>
<tr>
<td width="50%">height of target in pixels</td>
<td>height="1000"</td>
</tr>
<tr>
<td width="50%">padding in pixels</td>
<td>padding="10"</td>
</tr>
<tr>
<td width="50%">font color (hex code)</td>
<td>color="#000000"</td>
</tr>
<tr>
<td width="50%">background color (hex code)</td>
<td>bgcolor="#ffffff"</td>
</tr>
<tr>
<td width="50%">font size (pixels)</td>
<td>font-size="14"</td>
</tr>
<tr>
<td width="50%">if you want the widget to open an embedded booking page on oyur website enter the url of the page</td>
<td>href="http://www.myurl.com"</td> 
</tr>
<tr>
<td width="50%">open booking page in a new window</td>
<td>target="new"</td>
</tr>
<tr>
<td width="50%">open booking page in a the same window</td>
<td>target="window"</td>
</tr>
<tr>
<td width="50%">open booking page in iframe on the same page</td>
<td>target="iframe"</td>
</tr>
<tr>
<td width="50%">freetext for modification of url parameters</td>
<td>custom=""</td>
</tr>
<tr>
<td width="50%">html id of the target</td>
<td>targetid="freetext"</td>
</tr>
<tr>
<td width="50%">text of the booking link or button</td>
<td>text="Book Now"</td>
</tr>
<tr>
<td width="50%">add a class of your theme to a widget</td>
<td>class="name"</td>
</tr>
<tr>
<td width="50%">type of widget (link, button, box, searchbox, searchresult, embed)</td>
<td>type="link"</td>
</tr>
<tr>
<td width="50%">do not set checkin, number of nights or guests in the iframe parameters so they can be set by a widget redirecting from another page</td>
<td>noselection="true"</td>
</tr>
</tbody>
</table>
</div>   
</div>	



<div class="b24_group" id="pn_about">
<h2>About</h2>

<div class="b24_section section-text">
<div>
<?php include('plugin-instructions.php'); ?>
</div>
</div>
</div>	


</div>
<div class="clear"></div>

</div>

<div class="b24_save_bar_top">

                

</div>

</form>
</div>

<div>
<?php include('plugin-adminfooter.php'); ?>
</div>

<?php
}









class Beds24_Widget extends WP_Widget 
{
function Beds24_Widget() 
	{
	$widget_ops = array('classname' => 'Beds24_Widget', 'description' => 'Display a Beds24.com Widget. ' ); 
	$this->WP_Widget('Beds24_Widget', 'Beds24 Booking Widget', $widget_ops);   
	}
	
function form($instance)
	{
	$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = $instance['title'];
	$widget_html = $instance['widget_html'];
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p style="font-size: 8pt; color: gray; font-style: italic;">Enter the widget shortcode. Alternatively choose the widget to display from the widget menu in your Beds24.com account and copy and paste the code here.</p>
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
echo do_shortcode($instance['widget_html']);
echo $after_widget;
}
}
add_action( 'widgets_init', create_function('', 'return register_widget("Beds24_Widget");') );
?>