<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: Displays Bangla, Gregorian and Hijri date in bangla language via widget and shortcode! Options for displaying post/page's time, date, comment count, archive calendar etc in Bangla language.
Author: M.A. IMRAN
Version: 8.0
Author URI: http://facebook.com/imran2w
*/

/*
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or ( at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA. Online: http://www.gnu.org/licenses/gpl.txt;
*/

// Bismillah...

  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) {
    $bddp_options = array(
        'cal_wgt' => '0',
        'trans_dt' => '0',
        'trans_cmnt' => '0',
        'trans_num' => '0',
        'trans_cal' => '0' );
   }


include "translator.php";
include "class.banglaDate.php";

function bddp_bangla_time() {

	$offset=6*60*60; //converting 6 hours to seconds.
	$hour = gmdate("G", time()+$offset);
	
	if ($hour >= 5 && $hour <= 5) { echo "ভোর "; }
	else if ($hour >= 6 && $hour <= 11) { echo "সকাল "; }
	else if ($hour >= 12 && $hour <= 14) { echo "দুপুর "; }
	else if ($hour >= 15 && $hour <= 17) { echo "বিকাল "; }
	else if ($hour >= 18 && $hour <= 19) { echo "সন্ধ্যা "; }
	else { echo "রাত "; }
	
	echo en_to_bn(gmdate("g:i", time()+$offset));
	}


function bddp_bn_day() { echo en_to_bn(gmdate("l", time()+6*60*60)); }

function bddp_bangla_date_function() {

	$bddp_options = get_option("bddp_options");
	if (!is_array($bddp_options)) {
		$bddp_options = array( 'dt_change' => '0', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
	if ( $bddp_options['last_word'] == "1" ) { $last_word = " বঙ্গাব্দ"; }

$bn = new BanglaDate(time(), $bddp_options['dt_change']);
$bdtday = $bn->get_day();
$bdtmy = $bn->get_month_year();

$day = sprintf( '%s', implode( ' ', $bdtday ) );
$month_year = sprintf( '%s', implode( $bddp_options['separator'] , $bdtmy ) );

$day_number = array( "১" => "১লা", "২" => "২রা", "৩" => "৩রা", "৪" => "৪ঠা", "৫" => "৫ই", "৬" => "৬ই", "৭" => "৭ই", "৮" => "৮ই", "৯" => "৯ই", "১০" => "১০ই", "১১" => "১১ই", "১২" => "১২ই", "১৩" => "১৩ই", "১৪" => "১৪ই", "১৫" => "১৫ই", "১৬" => "১৬ই", "১৭" => "১৭ই", "১৮" => "১৮ই", "১৯" => "১৯শে", "২০" => "২০শে", "২১" => "২১শে", "২২" => "২২শে", "২৩" => "২৩শে", "২৪" => "২৪শে", "২৫" => "২৫শে", "২৬" => "২৬শে", "২৭" => "২৭শে", "২৮" => "২৮শে", "২৯" => "২৯শে", "৩০" => "৩০শে", "৩১" => "৩১শে" );

if ( $bddp_options['ord_suffix'] == "1" ) { echo $day_number[$day] . ' ' . $month_year . $last_word; }
elseif ( $bddp_options['ord_suffix'] == "" ) { echo $day . ' ' . $month_year . $last_word; }
}

function bddp_bn_season() {

$bn = new BanglaDate(time(), 0);
$bdtmonth = $bn->get_month();
$month = sprintf( '%s', implode( ' ', $bdtmonth ) );

if($month == "বৈশাখ" || $month == "জ্যৈষ্ঠ") { echo "গ্রীষ্মকাল"; }
elseif($month == "আষাঢ়" || $month == "শ্রাবণ") { echo "বর্ষাকাল"; }
elseif($month == "ভাদ্র" || $month == "আশ্বিন") { echo "শরৎকাল"; }
elseif($month == "কার্তিক" || $month == "অগ্রহায়ণ") { echo "হেমন্তকাল"; }
elseif($month == "পৌষ" || $month == "মাঘ") { echo "শীতকাল"; }
else { echo "বসন্তকাল"; }
}


function bddp_bn_en_date() {

  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) {
    $bddp_options = array( 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
if ( $bddp_options['last_word'] == "1" ) { $last_word = " ইং"; }

if ( $bddp_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }

elseif ( $bddp_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }

$offset=6*60*60;
echo $day_number[gmdate("j", time()+$offset)] . " " . en_to_bn(gmdate("F", time()+$offset)); echo $bddp_options['separator'] . en_to_bn(gmdate("Y", time()+$offset)) . $last_word;
}

function bddp_bn_hijri_date() {

  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) {
    $bddp_options = array( 'hijri_adjust' => '24', 'hijri_tz' => 'Asia/Dhaka', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1' ); }
if ( $bddp_options['last_word'] == "1" ) { $last_word = " হিজরী"; }

$offset2 = $bddp_options['hijri_adjust'] * 60 * 60;

include "uCal.class.php";
$d = new uCal;

$tz = date_default_timezone_set($bddp_options['hijri_tz']);

if ( $bddp_options['ord_suffix'] == "1" ) { $day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" ); }

elseif ( $bddp_options['ord_suffix'] == "" ) { $day_number = array( "1" => "১", "2" => "২", "3" => "৩", "4" => "৪", "5" => "৫", "6" => "৬", "7" => "৭", "8" => "৮", "9" => "৯", "10" => "১০", "11" => "১১", "12" => "১২", "13" => "১৩", "14" => "১৪", "15" => "১৫", "16" => "১৬", "17" => "১৭", "18" => "১৮", "19" => "১৯", "20" => "২০", "21" => "২১", "22" => "২২", "23" => "২৩", "24" => "২৪", "25" => "২৫", "26" => "২৬", "27" => "২৭", "28" => "২৮", "29" => "২৯", "30" => "৩০", "31" => "৩১" ); }

$month_name = array( "Muh" => "মুহাররম", "Saf" => "সফর", "Rb1" => "রবিউল-আউয়াল", "Rb2" => "রবিউস-সানি", "Jm1" => "জমাদিউল-আউয়াল", "Jm2" => "জমাদিউস-সানি", "Raj" => "রজব", "Shb" => "শাবান", "Rmd" => "রমযান", "Shw" => "শাওয়াল", "DhQ" => "জিলক্বদ", "DhH" => "জিলহজ্জ" );

echo $day_number[$d->date("j", time()-$offset2)] . " " . $month_name[$d->date("M", time()-$offset2)] . $bddp_options['separator'] . en_to_bn($d->date("Y", time()-$offset2)) . $last_word;
}


function bddp_header_content() {
?>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/bncalendar.inc.js"></script>
<style type="text/css">
<?php include "style.inc.css"; ?>
</style>
<?php }

function bddp_bn_calendar() {
?>

<script type="text/javascript">
document.write(BanglaMas());
</script>

<?php
}


function bddp_en_bn_calendar() {
?>

<script type="text/javascript">

var todaydate=new Date();
todaydate.setTime(todaydate.getTime() +(todaydate.getTimezoneOffset()+360)*60*1000); 
var curmonth=todaydate.getMonth()+1; //get current month (1-12)
var curyear=todaydate.getFullYear(); //get current year

document.write(buildCal(curmonth ,curyear, "bc_main", "bc_month", "bc_daysofweek", "bc_days", 1));
</script>

<?php
}

//==================Widget 01========================
function widget_bangla_date_display($args) {
extract($args);
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title1' => 'আজকের দিন-তারিখ', 'show_day' => '1', 'show_time' => '1', 'show_en' => '1', 'show_hijri' => '1', 'show_bn' => '1', 'show_season' => '1' ); }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_options['wgt_title1'] . $after_title; ?>
<ul>
<?php if ($bddp_options['show_day'] == "1" || $bddp_options['show_time'] == "1") { echo "<li>"; } ?><?php if ($bddp_options['show_day'] == "1") { echo do_shortcode('[bangla_day]'); }
if ($bddp_options['show_time'] == "1") { echo " ( "; echo do_shortcode('[bangla_time]'); echo " )"; } ?><?php if ($bddp_options['show_day'] == "1" || $bddp_options['show_time'] == "1") { echo "</li>"; } ?>

<?php if ($bddp_options['show_en'] == "1") { echo "<li>"; echo do_shortcode('[english_date]'); echo "</li>"; } ?>
<?php if ($bddp_options['show_hijri'] == "1") { echo "<li>"; echo do_shortcode('[hijri_date]'); echo "</li>"; } ?>

<?php if ($bddp_options['show_bn'] == "1" || $bddp_options['show_season'] == "1") { echo "<li>"; } ?><?php if ($bddp_options['show_bn'] == "1") { echo do_shortcode('[bangla_date]'); }
if ($bddp_options['show_season'] == "1") { echo " ( "; echo do_shortcode('[bangla_season]'); echo " )"; } ?><?php if ($bddp_options['show_bn'] == "1" || $bddp_options['show_season'] == "1") { echo "</li>"; } ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

  function widget_bddp_control() {
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title1' => 'আজকের দিন-তারিখ', 'show_day' => '1', 'show_time' => '1', 'show_en' => '1', 'show_hijri' => '1', 'show_bn' => '1', 'show_season' => '1' ); }

  if($_POST['widget_control_submit'])
  {
    $bddp_options['wgt_title1'] = htmlspecialchars($_POST['wgt_title1']);
    $bddp_options['show_day'] = htmlspecialchars($_POST['show_day']);
    $bddp_options['show_time'] = htmlspecialchars($_POST['show_time']);
    $bddp_options['show_en'] = htmlspecialchars($_POST['show_en']);
    $bddp_options['show_hijri'] = htmlspecialchars($_POST['show_hijri']);
    $bddp_options['show_bn'] = htmlspecialchars($_POST['show_bn']);
    $bddp_options['show_season'] = htmlspecialchars($_POST['show_season']);
    update_option("bddp_options", $bddp_options);
  }
?>

<p><table width="100%">
	<tr><td> <label for="wgt_title1">Title: </label></td>
    <td><input type="text" id="wgt_title1" name="wgt_title1" value="<?php echo $bddp_options['wgt_title1'];?>" /> </td></tr>

	<tr><td> <label for="show_day">Day: </label> </td>
    <td><input type="checkbox" id="show_day" name="show_day" value="1" <?php if($bddp_options['show_day']==1) echo('checked="checked"'); ?>/> </td></tr>

	<tr><td> <label for="show_time">Time: </label> </td>
    <td><input type="checkbox" id="show_time" name="show_time" value="1" <?php if($bddp_options['show_time']==1) echo('checked="checked"'); ?>/> </td></tr>

	<tr><td> <label for="show_en">Gregorian Date: </label> </td>
    <td><input type="checkbox" id="show_en" name="show_en" value="1" <?php if($bddp_options['show_en']==1) echo('checked="checked"'); ?>/></td></tr>

	<tr><td> <label for="show_hijri">Hijri Date: </label> </td>
    <td><input type="checkbox" id="show_hijri" name="show_hijri" value="1" <?php if($bddp_options['show_hijri']==1) echo('checked="checked"'); ?>/> </td></tr>

	<tr><td> <label for="show_bn">Bangla Date: </label> </td>
    <td><input type="checkbox" id="show_bn" name="show_bn" value="1" <?php if($bddp_options['show_bn']==1) echo('checked="checked"'); ?>/> </td></tr>

	<tr><td> <label for="show_season">Season Name: </label> </td>
    <td><input type="checkbox" id="show_season" name="show_season" value="1" <?php if($bddp_options['show_season']==1) echo('checked="checked"'); ?>/> </td></tr>
	</table>

    <input type="hidden" id="widget_control_submit"  name="widget_control_submit" value="1" />
  </p>
	<p><span style="color: gray;">Go to: Settings > <a href="<?php admin_url(); ?>options-general.php?page=bangla-date-display">Bangla Date Display</a> to change plugin settings.</span></p>
<?php
 }

//==================Widget 02====================
function widget_bn_calendar($args) {
extract($args);
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title2' => 'বাংলা ক্যালেন্ডার', 'cal_wgt' => '0' ); }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_options['wgt_title2'] . $after_title; ?>
<ul>
<?php if ($bddp_options['cal_wgt'] == "1") { echo do_shortcode('[bn_calendar]'); }
elseif ($bddp_options['cal_wgt'] == "0" || $bddp_options['cal_wgt'] == "") { echo '<p align="center"><span style="color: red;">Widget Disabled!</span><br/><span style="color: green;">Go to "Admin Panel > BN Date Display > Settings" to enable this widget.</span></p>'; } ?>
</ul>
<?php echo $after_widget; ?>
<?php
}


  function widget_bncal_control() {
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title2' => 'বাংলা পঞ্জিকা' ); }

  if($_POST['widget_control_submit'])
  {
    $bddp_options['wgt_title2'] = htmlspecialchars($_POST['wgt_title2']);
	$bddp_options['cal_wgt'] = htmlspecialchars($_POST['cal_wgt']);
    update_option("bddp_options", $bddp_options);
  }
?>


<p><table width="100%">
	<tr><td> <label for="wgt_title2">Title: </label></td>
    <td><input type="text" id="wgt_title2" name="wgt_title2" value="<?php echo $bddp_options['wgt_title2']; ?>" /> </td></tr>
	</table>

    <input type="hidden" id="cal_wgt"  name="cal_wgt" value="1" />
    <input type="hidden" id="widget_control_submit"  name="widget_control_submit" value="1" />
  </p>
	<p><span style="color: gray;">Go to: Settings > <a href="<?php admin_url(); ?>options-general.php?page=bangla-date-display">Bangla Date Display</a> to change plugin settings.</span></p>
<?php
 }

//===============Widget 03======================
function widget_en_bn_calendar($args) {
extract($args);
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title3' => 'বাংলা ক্যালেন্ডার', 'cal_wgt' => '0' ); }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_options['wgt_title3'] . $after_title; ?>
<ul>
<?php if ($bddp_options['cal_wgt'] == "1") { echo do_shortcode('[en_bn_calendar]'); }
elseif ($bddp_options['cal_wgt'] == "0" || $bddp_options['cal_wgt'] == "") { echo '<p align="center"><span style="color: red;">Widget Disabled!</span><br/><span style="color: green;">Go to "Admin Panel > BN Date Display > Settings" to enable this widget.</span></p>'; } ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

  function widget_ebcal_control() {
  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) { $bddp_options = array( 'wgt_title3' => 'বাংলা পঞ্জিকা' ); }

  if($_POST['widget_control_submit'])
  {
    $bddp_options['wgt_title3'] = htmlspecialchars($_POST['wgt_title3']);
	$bddp_options['cal_wgt'] = htmlspecialchars($_POST['cal_wgt']);
    update_option("bddp_options", $bddp_options);
  }
  
  	$other_options = get_option("bddp_options");
	if (!is_array($other_options)) {
	$other_options = array(
        'trans_dt' => '0',
        'trans_cmnt' => '0',
        'trans_num' => '0',
        'trans_cal' => '0',
        'dt_change' => '0',
        'ord_suffix' => '1',
        'separator' => ', ',
        'last_word' => '1',
        'hijri_tz' => 'Asia/Dhaka',
        'hijri_adjust' => '24',
        'cal_wgt' => '0',
        'wgt_title1' => 'আজকের দিন-তারিখ',
        'wgt_title2' => 'বাংলা ক্যালেন্ডার',
        'wgt_title3' => 'বাংলা ক্যালেন্ডার',
        'show_day' => '1',
        'show_time' => '1',
        'show_en' => '1',
        'show_hijri' => '1',
        'show_bn' => '1',
        'show_season' => '1' );
	}
?>


<p><table width="100%">
	<tr><td> <label for="wgt_title3">Title: </label></td>
    <td><input type="text" id="wgt_title3" name="wgt_title3" value="<?php echo $bddp_options['wgt_title3'];?>" /> </td></tr>
	</table>

    <input type="hidden" id="cal_wgt"  name="cal_wgt" value="1" />
    <input type="hidden" id="widget_control_submit"  name="widget_control_submit" value="1" />
  </p>
	<p><span style="color: gray;">Go to: Settings > <a href="<?php admin_url(); ?>options-general.php?page=bangla-date-display">Bangla Date Display</a> to change plugin settings.</span></p>
<?php
 }

//====================================
if ($bddp_options['cal_wgt'] == "1") { add_action('wp_head', 'bddp_header_content'); }

wp_register_sidebar_widget('bangla_date_display', 'Bangla Date Display', 'widget_bangla_date_display', array('description' => __('Displays Bangla, Gregorian & Hijri date, time, day name and season name.')));
wp_register_widget_control('bangla_date_display', 'Bangla Date Display', 'widget_bddp_control');
wp_register_sidebar_widget('monthly_calendar_bangla', 'Monthly Calendar (Bangla)', 'widget_bn_calendar', array('description' => __('Displays calendar of current bangla month.')));
wp_register_widget_control('monthly_calendar_bangla', 'Monthly Calendar (Bangla)', 'widget_bncal_control');
wp_register_sidebar_widget('monthly_calendar_bn_en', 'Monthly Calendar (Bangla + Gregorian)', 'widget_en_bn_calendar', array('description' => __('Displays calendar of current bangla+gregorian month.')));
wp_register_widget_control('monthly_calendar_bn_en', 'Monthly Calendar (Bangla + Gregorian)', 'widget_ebcal_control');

add_shortcode('bangla_time', 'bddp_bangla_time');
add_shortcode('bangla_day', 'bddp_bn_day');
add_shortcode('bangla_date', 'bddp_bangla_date_function');
add_shortcode('bangla_season', 'bddp_bn_season');
add_shortcode('english_date', 'bddp_bn_en_date');
add_shortcode('hijri_date', 'bddp_bn_hijri_date');
add_shortcode('bn_calendar', 'bddp_bn_calendar');
add_shortcode('en_bn_calendar', 'bddp_en_bn_calendar');

    if(is_admin())
    include 'bddp_admin.php';

?>
