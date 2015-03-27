<?php

if($bddp_options['trans_dt'] == "1") {
    add_filter('date_i18n', 'en_to_bn', 10, 2);
}

if ( $bddp_options['trans_dt'] == "2" ) {
    add_filter('get_the_date', 'en_to_bn');
    add_filter('get_the_time', 'en_to_bn');
    add_filter('get_comment_date', 'en_to_bn');
    add_filter('get_comment_time', 'en_to_bn');
}

if ( $bddp_options['trans_cmnt'] == "1" ) {
    add_filter('comments_number', 'en_to_bn');
    add_filter('get_comment_count', 'en_to_bn');
}

if($bddp_options['trans_num'] == "1") {
    add_filter('number_format_i18n', 'en_to_bn', 10, 1);
}

if($bddp_options['trans_cal'] == "1") {
	add_filter('get_archives_link', 'bddp_en_to_bangla');
	add_filter('wp_list_categories', 'bddp_en_to_bangla');
	add_filter('get_calendar', 'bddp_get_calendar_filter', 10 , 2);

function bddp_get_calendar($initial = false, $echo = false) {
global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
$cache = array();
$key = md5( $m . $monthnum . $year );
if ( !is_array($cache) )
$cache = array();

// Quick check. If we have no posts at all, abort!
if ( !$posts ) {
$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
if ( !$gotsome ) {
$cache[ $key ] = '';
wp_cache_set( 'get_calendar', $cache, 'calendar' );
return;
}
}

if ( isset($_GET['w']) )
$w = ''.intval($_GET['w']);

// week_begins = 0 stands for Sunday
$week_begins = intval(get_option('start_of_week'));

// Let's figure out when we are
if ( !empty($monthnum) && !empty($year) ) {
$thismonth = ''.zeroise(intval($monthnum), 2);
$thisyear = ''.intval($year);
} elseif ( !empty($w) ) {
// We need to get the month from MySQL
$thisyear = ''.intval(substr($m, 0, 4));
$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
} elseif ( !empty($m) ) {
$thisyear = ''.intval(substr($m, 0, 4));
if ( strlen($m) < 6 )
	$thismonth = '01';
else
	$thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
} else {
$thisyear = gmdate('Y', current_time('timestamp'));
$thismonth = gmdate('m', current_time('timestamp'));
}
//$thismonth = ''.zeroise(intval($thismonth - 1), 2);
if ($thismonth == '0'){
$thismonth = 12;
$thisyear = intval($thisyear - 1);
}

$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
$last_day = date('t', $unixmonth);

// Get the next and previous month and year with at least one post
$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
FROM $wpdb->posts
WHERE post_date < '$thisyear-$thismonth-01'
AND post_type = 'post' AND post_status = 'publish'
ORDER BY post_date DESC
LIMIT 1");
$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
FROM $wpdb->posts
WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
AND post_type = 'post' AND post_status = 'publish'
ORDER BY post_date ASC
LIMIT 1");

/* translators: Calendar caption: 1: month name, 2: 4-digit year */
$calendar_caption = _x('%1$s %2$s', 'calendar caption');
$calendar_output = '<table id="wp-calendar">
<caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
<thead>
<tr>';

$myweek = array();

for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
}

foreach ( $myweek as $wd ) {
$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
$wd = esc_attr($wd);
$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
}

$calendar_output .= '
</tr>
</thead>

<tfoot>
<tr>';

if ( $previous ) {
$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month), date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year)))) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
} else {
$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
}

$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

if ( $next ) {
$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($next->month), date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) ) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
} else {
$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
}

$calendar_output .= '
</tr>
</tfoot>

<tbody>
<tr>';

// Get days with posts
$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
AND post_type = 'post' AND post_status = 'publish'
AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
if ( $dayswithposts ) {
foreach ( (array) $dayswithposts as $daywith ) {
$daywithpost[] = $daywith[0];
}
} else {
$daywithpost = array();
}

if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
$ak_title_separator = "\n";
else
$ak_title_separator = ', ';

$ak_titles_for_day = array();
$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
."FROM $wpdb->posts "
."WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' "
."AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' "
."AND post_type = 'post' AND post_status = 'publish'"
);
if ( $ak_post_titles ) {
foreach ( (array) $ak_post_titles as $ak_post_title ) {

	$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );

	if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
	$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
	if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
	$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
	else
	$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
}
}

// See how much we should pad in the beginning
$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
if ( 0 != $pad )
$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';

$daysinmonth = intval(date('t', $unixmonth));
for ( $day = 1; $day <= $daysinmonth; ++$day ) {
if ( isset($newrow) && $newrow )
$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
$newrow = false;

if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
$calendar_output .= '<td id="today">';
else
$calendar_output .= '<td>';

if ( in_array($day, $daywithpost) ) // any posts today?
	$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
else
$calendar_output .= $day;
$calendar_output .= '</td>';

if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
$newrow = true;
}

$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
if ( $pad != 0 && $pad != 7 )
$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';

$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

$cache[ $key ] = $calendar_output;
wp_cache_set( 'get_calendar', $cache, 'calendar' );

if ( $echo )
echo $calendar_output;
else
return $calendar_output;

}

function bddp_get_calendar_filter( $content ) {
  $output = bddp_get_calendar();
  echo bddp_en_to_bangla($output);
}

function geturls($string) {
        $regex = '/https?\:\/\/[^\" ]+/i';
        preg_match_all($regex, $string, $matches);
        return ($matches[0]);
}

function replace_matches($content,$match, $replace){
return str_replace($match, $replace, $content);
}

function get_quote($input){
preg_match_all('~([\'"])(.*?)\1~s', $input, $result);
return ($result[0]);
}

function bddp_en_to_bangla($content=''){

$months = array();
$months=array(
'January'   => 'জানুয়ারি',
'February'=> 'ফেব্রুয়ারি',
'March'=> 'মার্চ',
'April'=> 'এপ্রিল',
'May'=> 'মে',
'June'=> 'জুন',
'July'=> 'জুলাই',
'August'=> 'আগষ্ট',
'September'=> 'সেপ্টেম্বর',
'October'=> 'অক্টোবর',
'November'=> 'নভেম্বর',
'December'=> 'ডিসেম্বর',
'Jan'   => 'জানুয়ারি',
'Feb'=> 'ফেব্রুয়ারি',
'Mar'=> 'মার্চ',
'Apr'=> 'এপ্রিল',
'May'=> 'মে',
'Jun'=> 'জুন',
'Jul'=> 'জুলাই',
'Aug'=> 'আগষ্ট',
'Sep'=> 'সেপ্টেম্বর',
'Oct'=> 'অক্টোবর',
'Nov'=> 'নভেম্বর',
'Dec'=> 'ডিসেম্বর',
);

//$digits = array();
$digits=array(
'1'   => '১',
'2'=> '২',
'3'=> '৩',
'4'=> '৪',
'5'=> '৫',
'6'=> '৬',
'7'=> '৭',
'8'=> '৮',
'9'=> '৯',
'0'=> '০',
'am' => 'পূর্বাহ্ণ',
'pm' => 'অপরাহ্ণ',
'AM' => 'পূর্বাহ্ণ',
'PM' => 'অপরাহ্ণ'
);

$days = array();
$days=array(
'Sunday'   => 'রবিবার',
'Monday'=> 'সোমবার',
'Tuesday'=> 'মঙ্গলবার',
'Wednesday'=> 'বুধবার',
'Thursday'=> 'বৃহষ্পতিবার',
'Friday'=> 'শুক্রবার',
'Saturday'=> 'শনিবার',
'Sun'=> 'রবি',
'Mon'=> 'সোম',
'Tue'=> 'মঙ্গল',
'Wed'=> 'বুধ',
'Thu'=> 'বৃহ',
'Fri'=> 'শুক্র',
'Sat'=> 'শনি',
);

$calendardays = array();
$calendardays=array(
'<th title="Sunday" scope="col">S</th>'=> '<th title="Sunday" scope="col">রবি</th>',
'<th title="Monday" scope="col">M</th>'=> '<th title="Monday" scope="col">সোম</th>',
'<th title="Tuesday" scope="col">T</th>'=> '<th title="Tuesday" scope="col">মঙ্গল</th>',
'<th title="Wednesday" scope="col">W</th>'=> '<th title="Wednesday" scope="col">বুধ</th>',
'<th title="Thursday" scope="col">T</th>'=> '<th title="Thursday" scope="col">বৃহস্পতি</th>',
'<th title="Friday" scope="col">F</th>'=> '<th title="Friday" scope="col">শুক্র</th>',
'<th title="Saturday" scope="col">S</th>'=> '<th title="Saturday" scope="col">শনি</th>',
);

$converted = replace_matches($content, array_keys($digits), $digits);
$converted = replace_matches($converted, array_keys($days), $days);
$converted = replace_matches($converted, array_keys($months), $months);


$converted_urls = array();
$allurls = geturls($content);

foreach($allurls as $url) {
$converted_digits[] = replace_matches($url, array_keys($digits), $digits);
$converted_months[] = replace_matches($converted_digits, array_keys($months), $months);
$converted_days[] = replace_matches($converted_months, array_keys($days), $days);
$all_converted_url =  array_unique(array_merge($converted_digits,$converted_months,$converted_days));
}

$converted_exclude_links = replace_matches($converted, $all_converted_url, $allurls);


$converted_quotes = array();
$allquotes = get_quote($content);

foreach($allquotes as $quote) {
$qconverted_digits[] = replace_matches($quote, array_keys($digits), $digits);
$qconverted_months[] = replace_matches($qconverted_digits, array_keys($months), $months);
$qconverted_days[] = replace_matches($qconverted_months, array_keys($days), $days);
$all_converted_quotes = array_unique(array_merge($qconverted_digits,$qconverted_months,$qconverted_days));
}

$converted_exclude_links = replace_matches($converted, $all_converted_quotes, array_unique($allquotes));

return $converted_exclude_links;

}
}

function en_to_bn( $str )
{
    $enMonth = array ( 'lm1' => 'January',
                       'lm2' => 'February',
                       'lm3' => 'March',
                       'lm4' => 'April',
                       'lm5' => 'May',
                       'lm6' => 'June',
                       'lm7' => 'July',
                       'lm8' => 'August',
                       'lm9' => 'September',
                       'lm10'=> 'October',
                       'lm11'=> 'November',
                       'lm12'=> 'December',
                       'sm1' => 'Jan',
                       'sm2' => 'Feb',
                       'sm3' => 'Mar',
                       'sm4' => 'Apr',
                       'sm5' => 'May',
                       'sm6' => 'Jun',
                       'sm7' => 'Jul',
                       'sm8' => 'Aug',
                       'sm9' => 'Sep',
                       'sm10'=> 'Oct',
                       'sm11'=> 'Nov',
                       'sm12'=> 'Dec'
                       );

    $enWeeks = array ( 'ld1' => 'Saturday',
                       'ld2' => 'Sunday',
                       'ld3' => 'Monday',
                       'ld4' => 'Tuesday',
                       'ld5' => 'Wednesday',
                       'ld6' => 'Thursday',
                       'ld7' => 'Friday',
                       'sd1' => 'Sat',
                       'sd2' => 'Sun',
                       'sd3' => 'Mon',
                       'sd4' => 'Tue',
                       'sd5' => 'Wed',
                       'sd6' => 'Thu',
                       'sd7' => 'Fri'
                       );

    $bnMonth = array ( 'lm1' => 'জানুয়ারি',
                       'lm2' => 'ফেব্রুয়ারি',
                       'lm3' => 'মার্চ',
                       'lm4' => 'এপ্রিল',
                       'lm5' => 'মে',
                       'lm6' => 'জুন',
                       'lm7' => 'জুলাই',
                       'lm8' => 'আগস্ট',
                       'lm9' => 'সেপ্টেম্বর',
                       'lm10'=> 'অক্টোবর',
                       'lm11'=> 'নভেম্বর',
                       'lm12'=> 'ডিসেম্বর',
                       'sm1' => 'জানু',
                       'sm2' => 'ফেব্রু',
                       'sm3' => 'মার্চ',
                       'sm4' => 'এপ্রি',
                       'sm5' => 'মে',
                       'sm6' => 'জুন',
                       'sm7' => 'জুলা',
                       'sm8' => 'আগ',
                       'sm9' => 'সেপ্টে',
                       'sm10'=> 'অক্টো',
                       'sm11'=> 'নভে',
                       'sm12'=> 'ডিসে'
                       );

    $bnWeeks = array ( 'ld1' => 'শনিবার',
                       'ld2' => 'রবিবার',
                       'ld3' => 'সোমবার',
                       'ld4' => 'মঙ্গলবার',
                       'ld5' => 'বুধবার',
                       'ld6' => 'বৃহস্পতিবার',
                       'ld7' => 'শুক্রবার',
                       'sd1' => 'শনি',
                       'sd2' => 'রবি',
                       'sd3' => 'সোম',
                       'sd4' => 'মঙ্গল',
                       'sd5' => 'বুধ',
                       'sd6' => 'বৃহঃ',
                       'sd7' => 'শুক্র'
                       );

    $mergeA1 = array_merge( $enMonth, $enWeeks );
    $mergeA2 = array_merge( $bnMonth, $bnWeeks );

    array_push( $mergeA1, 'am', 'pm', 'st', 'th', 'nd', 'rd', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
    array_push( $mergeA2, 'পূর্বাহ্ণ', 'অপরাহ্ণ', '', '', '', '', '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );

    return str_ireplace( $mergeA1, $mergeA2, $str );
}

?>
