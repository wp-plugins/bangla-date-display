<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: "Bangla Date Display" is a simple and easy to use plugin that allows you to show current bangla date or english date in bangla language anywhere in your blog!
Author: M.A. IMRAN
Version: 2.0
Author URI: http://facebook.com/imran2w
*/

function bangla_date_function() {
include_once 'class.banglaDate.php';
$bn = new BanglaDate(time(), 0);
$bdt = $bn->get_date();
$text = sprintf( '%s', implode( ' ', $bdt ) );
echo $text; echo ' বঙ্গাব্দ';

}

function bn_number($number) {

/*

like this:

$number= str_replace("English Number", "Bengali Number", $number);

translate 0-9

*/

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


function bn_en_date() {

$month = array( "1" => "জানুয়ারি",
 "2" => "ফেব্রুয়ারি",
 "3" => "মার্চ", 
"4" => "এপ্রিল", 
"5" => "মে", 
"6" => "জুন", 
"7" => "জুলাই", 
"8" => "আগস্ট", 
"9" => "সেপ্টেম্বর", 
"10" => "অক্টবর",  
"11" => "নভেম্বর", 
"12" => "ডিসেম্বর" 
);

$bangla_date = bn_number(date("j")) . " " . $month[date("n")] . ", " . bn_number(date("Y")) . " ইং";

return $bangla_date;

}


function bn_day() {

$day = array( "Sat" => "শনিবার",
 "Sun" => "রবিবার",
 "Mon" => "সোমবার", 
"Tue" => "মঙ্গলবার", 
"Wed" => "বুধবার", 
"Thu" => "বৃহস্পতিবার", 
"Fri" => "শুক্রবার", );

$bangla_day = $day[date("D")];

return $bangla_day;
}


if(is_admin())
	include 'bddp_admin.php';

add_shortcode('bangla_date', 'bangla_date_function');
add_shortcode('english_date', 'bn_en_date');
add_shortcode('bangla_day', 'bn_day');

?>