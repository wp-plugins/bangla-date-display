<?php
/*
Plugin Name: Bangla Date Display
Plugin URI: http://i-onlinemedia.net/
Description: "Bangla Date Display" is a simple and easy to use plugin that allows you to show current bangla date anywhere in your blog!
Author: M.A. IMRAN
Version: 1.0
Author URI: http://facebook.com/imran2w
*/

function bangla_date_function() {
include_once 'class.banglaDate.php';
$bn = new BanglaDate(time(), 0);
$bdt = $bn->get_date();
$text = sprintf( 'আজ %s', implode( ' ', $bdt ) );
echo $text; echo ' বঙ্গাব্দ';

}

if(is_admin())
	include 'bddp_admin.php';

add_shortcode('bangla_date', 'bangla_date_function');

?>