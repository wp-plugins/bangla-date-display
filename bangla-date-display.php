<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: A very simple, smart and easy to use plugin that allows you to show current bangla, english/gregorian and hijri date in bangla language anywhere in your site! Also available translation options to display post/page's time, date, comment count, dashboard numbers, archive calendar etc in bangla language.
Author: M.A. IMRAN
Version: 7.4
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

$bangla_time = bn_number(gmdate("g:i", time()+$offset));

return $bangla_time;
}


function bddp_bn_day() {

$day = array( "Sat" => "শনিবার", "Sun" => "রবিবার", "Mon" => "সোমবার", "Tue" => "মঙ্গলবার", "Wed" => "বুধবার", "Thu" => "বৃহস্পতিবার", "Fri" => "শুক্রবার" );

$offset=6*60*60; //converting 6 hours to seconds.
$bangla_day = $day[gmdate("D", time()+$offset)];

return $bangla_day;
}

function bddp_bangla_date_function() {

$bn = new BanglaDate(time(), 0);
$bdtday = $bn->get_day();
$bdtmy = $bn->get_month_year();

$day_n = sprintf( '%s', implode( ' ', $bdtday ) );
$month_year = sprintf( '%s', implode( ', ', $bdtmy ) );

$day = $day_n;

if($day == "১") {$day = "১লা"; }
elseif($day == "২") {$day = "২রা";}
elseif($day == "৩") {$day = "৩রা";}
elseif($day == "৪") {$day = "৪ঠা";}
elseif($day == "৫") {$day = "৫ই";}
elseif($day == "৬") {$day = "৬ই";}
elseif($day == "৭") {$day = "৭ই";}
elseif($day == "৮") {$day = "৮ই";}
elseif($day == "৯") {$day = "৯ই";}
elseif($day == "১০") {$day = "১০ই";}
elseif($day == "১১") {$day = "১১ই";}
elseif($day == "১২") {$day = "১২ই";}
elseif($day == "১৩") {$day = "১৩ই";}
elseif($day == "১৪") {$day = "১৪ই";}
elseif($day == "১৫") {$day = "১৫ই";}
elseif($day == "১৬") {$day = "১৬ই";}
elseif($day == "১৭") {$day = "১৭ই";}
elseif($day == "১৮") {$day = "১৮ই";}
elseif($day == "১৯") {$day = "১৯শে";}
elseif($day == "২০") {$day = "২০শে";}
elseif($day == "২১") {$day = "২১শে";}
elseif($day == "২২") {$day = "২২শে";}
elseif($day == "২৩") {$day = "২৩শে";}
elseif($day == "২৪") {$day = "২৪শে";}
elseif($day == "২৫") {$day = "২৫শে";}
elseif($day == "২৬") {$day = "২৬শে";}
elseif($day == "২৭") {$day = "২৭শে";}
elseif($day == "২৮") {$day = "২৮শে";}
elseif($day == "২৯") {$day = "২৯শে";}
elseif($day == "৩০") {$day = "৩০শে";}
elseif($day == "৩১") {$day = "৩১শে";}

echo $day; echo ' '; echo $month_year; echo ' বঙ্গাব্দ';

}

function bddp_bn_season() {

$bn = new BanglaDate(time(), 0);
$bdtmonth = $bn->get_month();
$month = sprintf( '%s', implode( ' ', $bdtmonth ) );

if($month == "বৈশাখ") {$season = "গ্রীষ্মকাল"; }
elseif($month == "জ্যৈষ্ঠ") {$season = "গ্রীষ্মকাল";}
elseif($month == "আষাঢ়") {$season = "বর্ষাকাল";}
elseif($month == "শ্রাবণ") {$season = "বর্ষাকাল";}
elseif($month == "ভাদ্র") {$season = "শরৎকাল";}
elseif($month == "আশ্বিন") {$season = "শরৎকাল";}
elseif($month == "কার্তিক") {$season = "হেমন্তকাল";}
elseif($month == "অগ্রহায়ণ") {$season = "হেমন্তকাল";}
elseif($month == "পৌষ") {$season = "শীতকাল";}
elseif($month == "মাঘ") {$season = "শীতকাল";}
elseif($month == "ফাল্গুন") {$season = "বসন্তকাল";}
elseif($month == "চৈত্র") {$season = "বসন্তকাল";}

echo $season;

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

return $number;

}


function bddp_bn_en_date() {

$month = array( "1" => "জানুয়ারি", "2" => "ফেব্রুয়ারি", "3" => "মার্চ", "4" => "এপ্রিল", "5" => "মে", "6" => "জুন", "7" => "জুলাই", "8" => "আগস্ট", "9" => "সেপ্টেম্বর", "10" => "অক্টবর", "11" => "নভেম্বর", "12" => "ডিসেম্বর" );

$day_number = array( "1" => "১লা", "2" => "২রা", "3" => "৩রা", "4" => "৪ঠা", "5" => "৫ই", "6" => "৬ই", "7" => "৭ই", "8" => "৮ই", "9" => "৯ই", "10" => "১০ই", "11" => "১১ই", "12" => "১২ই", "13" => "১৩ই", "14" => "১৪ই", "15" => "১৫ই", "16" => "১৬ই", "17" => "১৭ই", "18" => "১৮ই", "19" => "১৯শে", "20" => "২০শে", "21" => "২১শে", "22" => "২২শে", "23" => "২৩শে", "24" => "২৪শে", "25" => "২৫শে", "26" => "২৬শে", "27" => "২৭শে", "28" => "২৮শে", "29" => "২৯শে", "30" => "৩০শে", "31" => "৩১শে" );

$offset=6*60*60; //converting 6 hours to seconds.
$bangla_date = $day_number[gmdate("j", time()+$offset)] . " " . $month[gmdate("n", time()+$offset)] . ", " . bn_number(gmdate("Y", time()+$offset)) . " ইং";

return $bangla_date;

}

function bddp_bn_hijri_date() {

$bddp_option_f3 = get_option('bddp_option3');
if($bddp_option_f3 == "") { $bddp_option_f3 = "0"; }
$offset2 = $bddp_option_f3 * 60 * 60;

include "uCal.class.php";
$d = new uCal;

$Hday = $d->date("j", time()-$offset2);

if($Hday == "1") {$Hday = "১লা"; }
elseif($Hday == "2") {$Hday = "২রা";}
elseif($Hday == "3") {$Hday = "৩রা";}
elseif($Hday == "4") {$Hday = "৪ঠা";}
elseif($Hday == "5") {$Hday = "৫ই";}
elseif($Hday == "6") {$Hday = "৬ই";}
elseif($Hday == "7") {$Hday = "৭ই";}
elseif($Hday == "8") {$Hday = "৮ই";}
elseif($Hday == "9") {$Hday = "৯ই";}
elseif($Hday == "10") {$Hday = "১০ই";}
elseif($Hday == "11") {$Hday = "১১ই";}
elseif($Hday == "12") {$Hday = "১২ই";}
elseif($Hday == "13") {$Hday = "১৩ই";}
elseif($Hday == "14") {$Hday = "১৪ই";}
elseif($Hday == "15") {$Hday = "১৫ই";}
elseif($Hday == "16") {$Hday = "১৬ই";}
elseif($Hday == "17") {$Hday = "১৭ই";}
elseif($Hday == "18") {$Hday = "১৮ই";}
elseif($Hday == "19") {$Hday = "১৯শে";}
elseif($Hday == "20") {$Hday = "২০শে";}
elseif($Hday == "21") {$Hday = "২১শে";}
elseif($Hday == "22") {$Hday = "২২শে";}
elseif($Hday == "23") {$Hday = "২৩শে";}
elseif($Hday == "24") {$Hday = "২৪শে";}
elseif($Hday == "25") {$Hday = "২৫শে";}
elseif($Hday == "26") {$Hday = "২৬শে";}
elseif($Hday == "27") {$Hday = "২৭শে";}
elseif($Hday == "28") {$Hday = "২৮শে";}
elseif($Hday == "29") {$Hday = "২৯শে";}
elseif($Hday == "30") {$Hday = "৩০শে";}
elseif($Hday == "31") {$Hday = "৩১শে";}

$Hmonth = $d->date("M", time()-$offset2);

if($Hmonth == "Muh") {$Hmonth = "মহররম";}
elseif($Hmonth == "Saf") {$Hmonth = "সফর"; }
elseif($Hmonth == "Rb1") {$Hmonth = "রবিউল-আউয়াল";}
elseif($Hmonth == "Rb2") {$Hmonth = "রবিউস-সানি";}
elseif($Hmonth == "Jm1") {$Hmonth = "জমাদিউল-আউয়াল";}
elseif($Hmonth == "Jm2") {$Hmonth = "জমাদিউস-সানি";}
elseif($Hmonth == "Raj") {$Hmonth = "রজব";}
elseif($Hmonth == "Shb") {$Hmonth = "শাবান";}
elseif($Hmonth == "Rmd") {$Hmonth = "রমযান";}
elseif($Hmonth == "Shw") {$Hmonth = "শাওয়াল";}
elseif($Hmonth == "DhQ") {$Hmonth = "জিলক্বদ";}
elseif($Hmonth == "DhH") {$Hmonth = "জিলহজ্জ";}

$hijridate = $Hday . " " . $Hmonth . ", " . bn_number($d->date("Y", time()-$offset2)) . " হিজরী";
return $hijridate;
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
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'আজকের দিন-তারিখ' . $after_title; ?>
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
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'বাংলা ক্যালেন্ডার' . $after_title; ?>
<ul>
<?php echo do_shortcode('[bn_calendar]'); ?>
</ul>
<?php echo $after_widget; ?>
<?php
}

function widget_en_bn_calendar($args) {
extract($args);
?>
<?php echo $before_widget; ?>
<?php echo $before_title . 'বাংলা ক্যালেন্ডার' . $after_title; ?>
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
    add_filter('number_format_i18n', 'bddp_L2B', 10, 1);}

?>