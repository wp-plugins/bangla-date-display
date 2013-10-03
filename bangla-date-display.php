<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: A very simple, smart and easy to use plugin that allows you to show current bangla, english/gregorian and hijri date in bangla language anywhere in your site! Also available translation options to display post/page's time, date, comment count, dashboard and other numbers, archive calendar etc in bangla language.
Author: M.A. IMRAN
Version: 7.5
Author URI: http://facebook.com/imran2w
*/

#*********************************************************************
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# ( at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Online: http://www.gnu.org/licenses/gpl.txt

# *****************************************************************

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

echo bn_number(gmdate("g:i", time()+$offset));
}


function bddp_bn_day() {

$day = array( "Sat" => "শনিবার", "Sun" => "রবিবার", "Mon" => "সোমবার", "Tue" => "মঙ্গলবার", "Wed" => "বুধবার", "Thu" => "বৃহস্পতিবার", "Fri" => "শুক্রবার" );

$offset=6*60*60;
echo $day[gmdate("D", time()+$offset)];
}

function bddp_bangla_date_function() {

$bddp_option6 = get_option('bddp_option6');
if($bddp_option6 == "") { $bddp_option6 = "0"; }

$bn = new BanglaDate(time(), $bddp_option6);
$bdtday = $bn->get_day();
$bdtmy = $bn->get_month_year();

$day = sprintf( '%s', implode( ' ', $bdtday ) );
$month_year = sprintf( '%s', implode( ', ', $bdtmy ) );

$day_number = array( "১" => "১লা", "২" => "২রা", "৩" => "৩রা", "৪" => "৪ঠা", "৫" => "৫ই", "৬" => "৬ই", "৭" => "৭ই", "৮" => "৮ই", "৯" => "৯ই", "১০" => "১০ই", "১১" => "১১ই", "১২" => "১২ই", "১৩" => "১৩ই", "১৪" => "১৪ই", "১৫" => "১৫ই", "১৬" => "১৬ই", "১৭" => "১৭ই", "১৮" => "১৮ই", "১৯" => "১৯শে", "২০" => "২০শে", "২১" => "২১শে", "২২" => "২২শে", "২৩" => "২৩শে", "২৪" => "২৪শে", "২৫" => "২৫শে", "২৬" => "২৬শে", "২৭" => "২৭শে", "২৮" => "২৮শে", "২৯" => "২৯শে", "৩০" => "৩০শে", "৩১" => "৩১শে" );

echo $day_number[$day] . ' ' . $month_year . ' বঙ্গাব্দ';
}

function bddp_bn_season() {

$bn = new BanglaDate(time(), 0);
$bdtmonth = $bn->get_month();
$month = sprintf( '%s', implode( ' ', $bdtmonth ) );

if($month == "বৈশাখ" || $month == "জ্যৈষ্ঠ") { echo "গ্রীষ্মকাল"; }
elseif($month == "আষাঢ়" || $month == "শ্রাবণ") { echo "বর্ষাকাল"; }
elseif($month == "ভাদ্র" || $month == "আশ্বিন") { echo "শরৎকাল"; }
elseif($month == "কার্তিক" || $month == "অগ্রহায়ণ") { echo "হেমন্তকাল"; }
elseif($month == "পৌষ" || $month == "মাঘ") { echo "শীতকাল"; }
else { echo "বসন্তকাল"; }
}


function bn_number($number) {

$number= str_replace("0", "০", $number);
$number= str_replace("1", "১", $number);
$number= str_replace("2", "২", $number);
$number= str_replace("3", "৩", $number);
$number= str_replace("4", "৪", $number);
$number= str_replace("5", "৫", $number);
$number= str_replace("6", "৬", $number);
$number= str_replace("7", "৭", $number);
$number= str_replace("8", "৮", $number);
$number= str_replace("9", "৯", $number);

return $number;
}


function bddp_bn_en_date() {

$month = array( "1" => "জানুয়ারি", "2" => "ফেব্রুয়ারি", "3" => "মার্চ", "4" => "এপ্রিল", "5" => "মে", "6" => "জুন", "7" => "জুলাই", "8" => "আগস্ট", "9" => "সেপ্টেম্বর", "10" => "অক্টোবর", "11" => "নভেম্বর", "12" => "ডিসেম্বর" );

$day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" );

$offset=6*60*60;
echo $day_number[gmdate("j", time()+$offset)] . " " . $month[gmdate("n", time()+$offset)] . ", " . bn_number(gmdate("Y", time()+$offset)) . " ইং";
}

function bddp_bn_hijri_date() {

$bddp_option_f3 = get_option('bddp_option3');
if($bddp_option_f3 == "") { $bddp_option_f3 = "0"; }
$offset2 = $bddp_option_f3 * 60 * 60;

include "uCal.class.php";
$d = new uCal;

$bddp_option5 = get_option('bddp_option5');
if ($bddp_option5 == "") { $bddp_option5 = "Asia/Dhaka"; }
$tz = date_default_timezone_set($bddp_option5);

$day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" );

$month_name = array( "Muh" => "মহররম", "Saf" => "সফর", "Rb1" => "রবিউল-আউয়াল", "Rb2" => "রবিউস-সানি", "Jm1" => "জমাদিউল-আউয়াল", "Jm2" => "জমাদিউস-সানি", "Raj" => "রজব", "Shb" => "শাবান", "Rmd" => "রমযান", "Shw" => "শাওয়াল", "DhQ" => "জিলক্বদ", "DhH" => "জিলহজ্জ" );

echo $day_number[$d->date("j", time()-$offset2)] . " " . $month_name[$d->date("M", time()-$offset2)] . ", " . bn_number($d->date("Y", time()-$offset2)) . " হিজরী";
}


function bddp_header_content() {
?>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/bncalendar.inc.js"></script>
<?php include "style.inc.css";
}

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

function widget_bangla_date_display($args) {
extract($args);
$bddp_option7 = get_option('bddp_option7');
if($bddp_option7 == "") { $bddp_option7 = "আজকের দিন-তারিখ"; }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_option7 . $after_title; ?>
<ul>
<li><?php echo do_shortcode('[bangla_day]'); ?> ( <?php echo do_shortcode('[bangla_time]'); ?> )</li>
<li><?php echo do_shortcode('[english_date]'); ?></li>
<li><?php echo do_shortcode('[hijri_date]'); ?></li>
<li><?php echo do_shortcode('[bangla_date]'); ?> ( <?php echo do_shortcode('[bangla_season]'); ?> )</li>
</ul>
<?php echo $after_widget; ?>
<?php
}

function widget_bn_calendar($args) {
extract($args);
$bddp_option8 = get_option('bddp_option8');
if($bddp_option8 == "") { $bddp_option8 = "বাংলা ক্যালেন্ডার"; }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_option8 . $after_title; ?>
<ul>
<?php echo do_shortcode('[bn_calendar]'); ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

function widget_en_bn_calendar($args) {
extract($args);
$bddp_option9 = get_option('bddp_option9');
if($bddp_option9 == "") { $bddp_option9 = "বাংলা ক্যালেন্ডার"; }
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $bddp_option9 . $after_title; ?>
<ul>
<?php echo do_shortcode('[en_bn_calendar]'); ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

if(is_admin())
	include 'bddp_admin.php';

add_action('wp_head', 'bddp_header_content');

register_sidebar_widget('Bangla Date Display', 'widget_bangla_date_display');
register_sidebar_widget('Monthly Calendar (Bangla)', 'widget_bn_calendar');
register_sidebar_widget('Monthly Calendar (Bangla + Gregorian)', 'widget_en_bn_calendar');

add_shortcode('bangla_time', 'bddp_bangla_time');
add_shortcode('bangla_day', 'bddp_bn_day');
add_shortcode('bangla_date', 'bddp_bangla_date_function');
add_shortcode('bangla_season', 'bddp_bn_season');
add_shortcode('english_date', 'bddp_bn_en_date');
add_shortcode('hijri_date', 'bddp_bn_hijri_date');
add_shortcode('bn_calendar', 'bddp_bn_calendar');
add_shortcode('en_bn_calendar', 'bddp_en_bn_calendar');

include "translator.php";
$bddp_option_f1 = get_option('bddp_option1');
$bddp_option_f2 = get_option('bddp_option2');
$bddp_option_f4 = get_option('bddp_option4');

if($bddp_option_f1 == "Enabled") {
add_filter( 'comments_number', 'bddp_en_to_bangla' );
add_filter( 'get_comment_count', 'bddp_en_to_bangla' );
    add_filter('the_date', 'bddp_dtct');
    add_filter('the_time', 'bddp_dtct');
    add_filter('date_i18n', 'bddp_L2B', 10, 2);
    add_filter('get_comment_date', 'bddp_dtct');
    add_filter('get_comment_time', 'bddp_dtct');
}

if($bddp_option_f2 == "Enabled") {
add_filter( 'get_archives_link', 'bddp_en_to_bangla' );
add_filter( 'wp_list_categories', 'bddp_en_to_bangla' );
add_filter( 'get_calendar' , 'bddp_get_calendar_filter' , 10 , 2 );
}

if($bddp_option_f4 == "Enabled") {
    add_filter('number_format_i18n', 'bddp_L2B', 10, 1); }

?>