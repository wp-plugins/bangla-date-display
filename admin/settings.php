<div class="wrap">
<h2><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/icon4.png" alt=""> Bangla Date Display Plugin Settings</h2>

<?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { echo '<div id="message" class="updated"><p>'. __('Settings saved successfully!.') .'</p></div>'.PHP_EOL; } ?>

<form method="post" action="options.php">
    <?php
function rplc_symbol($symbol) {
  $symbol = str_replace('"', '&#34;', $symbol);
  return $symbol; }

settings_fields( 'bddp-settings-group' );

  $bddp_options = get_option("bddp_options");
  if (!is_array($bddp_options)) {
    $bddp_options = array(
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


if ( $bddp_options['trans_dt'] == "1" ) { $trans_dt = "Enabled"; $color1 = "green"; }
elseif ( $bddp_options['trans_dt'] == "0" || $bddp_options['trans_dt'] == "" ) { $trans_dt = "Disabled"; $color1 = "red"; }

if ( $bddp_options['trans_cmnt'] == "1" ) { $trans_cmnt = "Enabled"; $color2 = "green"; }
elseif ( $bddp_options['trans_cmnt'] == "0" || $bddp_options['trans_cmnt'] == "" ) { $trans_cmnt = "Disabled"; $color2 = "red"; }

if ( $bddp_options['trans_num'] == "1" ) { $trans_num = "Enabled"; $color3 = "green"; }
elseif ( $bddp_options['trans_num'] == "0" || $bddp_options['trans_num'] == "" ) { $trans_num = "Disabled"; $color3 = "red"; }

if ( $bddp_options['trans_cal'] == "1" ) { $trans_cal = "Enabled"; $color4 = "green"; }
elseif ( $bddp_options['trans_cal'] == "0" || $bddp_options['trans_cal'] == "" ) { $trans_cal = "Disabled"; $color4 = "red"; }

?>

<br/><div style="width: 65%; float: left;">
<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Translation Options</span></h3>
<div class="inside"><div><p align="justify">Want to translate/convert/display post/page's default (english) time, date, comment count, dashboard numbers, archive calendar etc in bangla language? Its easy! Just Enable options and Save Changes below...</p>
    <table class="form-table">
        <tr valign="top">
        <td>Translate time & date:</td>
        <td><select name="bddp_options[trans_dt]">
<option value="0"<?php if($bddp_options['trans_dt'] == "0") { echo " selected"; } ?>>None</option>
<option value="1"<?php if($bddp_options['trans_dt'] == "1") { echo " selected"; } ?>>All Time/Date (Recomended)</option>
<option value="2"<?php if($bddp_options['trans_dt'] == "2") { echo " selected"; } ?>>Post, Page and Comment's Time/Date</option>
</select></td>
        </tr>
        </table>
	<table class="form-table">
        <tr valign="top">
        <td>Translate comment's count/number:</td>
        <td><input type="checkbox" name="bddp_options[trans_cmnt]" value="1" <?php if($bddp_options['trans_cmnt']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color2; ?>.png" alt=""> <font color="<?php echo $color2; ?>"><?php echo $trans_cmnt; ?></font></td>
        </tr>
        <tr valign="top">
        <td>Translate all numbers:</td>
        <td><input type="checkbox" name="bddp_options[trans_num]" value="1" <?php if($bddp_options['trans_num']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color3; ?>.png" alt=""> <font color="<?php echo $color3; ?>"><?php echo $trans_num; ?></font></td>
        </tr>
        <tr valign="top">
        <td>Translate Archive Calendar:</td>
        <td><input type="checkbox" name="bddp_options[trans_cal]" value="1" <?php if($bddp_options['trans_cal']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color4; ?>.png" alt=""> <font color="<?php echo $color4; ?>"><?php echo $trans_cal; ?></font></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
<div style="background-color: white; color: red; text-align: justify; padding: 3px; margin: 3px; border: green solid 1px;"><?php if($bddp_options['trans_dt'] == "2") { ?><b>Important Notice:</b> You have choosen "Post, Page and Comment's Date/Time" translation option. Now it will search and replace post/page/comment's all time & date's english/latin numbers with bangla. So that, some functions, such as human_time_diff() may not work properly or output may be incorrect! If you are using human_time_diff() or such function, <strong>we recommend you to enable "All Time/Date" translation option</strong><?php } ?>

<?php if($bddp_options['trans_dt'] == "1") { ?><b>Notice:</b> You have choosen "All Time/Date" translation option. Now it will translate all of wordpress time/date's in bangla including admin area. If you don't want translate time/date of admin area or just want to show post/page/comment's time/date in banga to site visitors, then you can enable "Post, Page and Comment's Time/Date" translation option.<?php } ?>

<?php if($bddp_options['trans_dt'] == "0") { ?><b>Important!</b> If you are using any other plugin which converts time, date etc in bangla language then, please deactivate that plugin first before enabling any option. Otherwise two same functionality plugins may cause errors.<?php } ?></div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Bangla Date Adjustment</span></h3>
<div class="inside"><div><p align="justify">Choose when everyday the date (single line bangla date only, not calendar widget) will change... 6 AM (morning) or 12 AM (midnight)</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">When the date will change?</th>
        <td><select name="bddp_options[dt_change]">
<option value="6"<?php if($bddp_options['dt_change'] == "6") { echo " selected"; } ?>>06:00 AM (Morning)</option>
<option value="0"<?php if($bddp_options['dt_change'] == "0") { echo " selected"; } ?>>12:00 AM (Midnight)</option>
</select>
</td>
        </tr>
        <tr valign="top">
        <th scope="row">Default Time Zone</th>
        <td><select name="" disabled>
<option value="" selected>Asia/Dhaka</option>
</select>
</td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Hijri Date Adjustment</span></h3>
<div class="inside"><div><p align="justify">Set default time zone for hijri date. You can minus time from current hijri date also. For example, if you want to minus two days, input 48 hours and Save Changes.</p>

    <table class="form-table">
        <tr valign="top">
        <td>Time Zone:</td>
        <td><?php include "time_zones.php"; ?>
</td><td>Status:<br/><span style="color: green;"><?php echo $bddp_options['hijri_tz']; ?></span></td>
        </tr>
        <tr valign="top">
        <td>Minus Hours:</td>
        <td>-<input type="text" name="bddp_options[hijri_adjust]" size="3" value="<?php echo $bddp_options['hijri_adjust']; ?>"></td><td> Status: <span style="color: green;">-<?php echo $bddp_options['hijri_adjust']; if($bddp_options['hijri_adjust'] == "0") { echo " Hour"; }
elseif($bddp_options['hijri_adjust'] == "1") { echo " Hour"; }
else { echo " Hours"; } ?></span></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Date Formatting</span></h3>
<div class="inside"><div><p align="justify">Choose Bangla/Gregorian/Hijri date output format.</p>

    <table class="form-table">
        <tr valign="top">
        <td>Date separator:</td>
        <td><input type="radio" name="bddp_options[separator]" value=", "<?php if($bddp_options['separator'] == ", ") { echo " checked"; } ?>> Comma (,)</td><td><input type="radio" name="bddp_options[separator]" value=" "<?php if($bddp_options['separator'] == " ") { echo " checked"; } ?>> None (space)</td>
</tr>
        <tr valign="top">
        <td>Show ordinal suffix (১লা, ২রা, ৩রা...):</td>
        <td><input type="checkbox" name="bddp_options[ord_suffix]" value="1" <?php if($bddp_options['ord_suffix']==1) echo('checked="checked"'); ?>/></td><td></td>
        </tr>
        <tr valign="top">
        <td>Show last word (খ্রীষ্টাব্দ, বঙ্গাব্দ, হিজরী):</td>
        <td><input type="checkbox" name="bddp_options[last_word]" value="1" <?php if($bddp_options['last_word']==1) echo('checked="checked"'); ?>/></td><td></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Widget Customization</span></h3>
<div class="inside"><div><p align="left"><b><u>Choose items to show on "Bangla Date Display" widget</u>:</b></p>

    <table class="form-table">
  <tr valign="top">
  <th scope="row">Day:</th><td><input type="checkbox" name="bddp_options[show_day]" value="1" <?php if($bddp_options['show_day']==1) echo('checked="checked"'); ?>/></td>
  </tr>
  <tr valign="top">
  <th scope="row">Time:</th><td><input type="checkbox" name="bddp_options[show_time]" value="1" <?php if($bddp_options['show_time']==1) echo('checked="checked"'); ?>/></td>
  </tr>
  <tr valign="top">
  <th scope="row">Gregorian Date:</th><td><input type="checkbox" name="bddp_options[show_en]" value="1" <?php if($bddp_options['show_en']==1) echo('checked="checked"'); ?>/></td>
  </tr>
  <tr valign="top">
  <th scope="row">Hijri Date:</th><td><input type="checkbox" name="bddp_options[show_hijri]" value="1" <?php if($bddp_options['show_hijri']==1) echo('checked="checked"'); ?>/></td>
  </tr>
  <tr valign="top">
  <th scope="row">Bangla Date:</th><td><input type="checkbox" name="bddp_options[show_bn]" value="1" <?php if($bddp_options['show_bn']==1) echo('checked="checked"'); ?>/></td>
  </tr>
  <tr valign="top">
  <th scope="row">Season Name:</th><td><input type="checkbox" name="bddp_options[show_season]" value="1" <?php if($bddp_options['show_season']==1) echo('checked="checked"'); ?>/></td>
  </tr>
</table>

<p align="left"><b><u>Enable/Disable Widgets</u>:</b></p>
    <table class="form-table">
        <tr valign="top">
        <td width="80%">Enable <span style="color: green;">Monthly Calendar (Bangla)</span> and <span style="color: green;">Monthly Calendar (Bangla+Gregorian)</span> widgets:<br/><span style="color: red;">(Additional JS and CSS files will be used)</span></td>
        <td width="20%"><input type="checkbox" name="bddp_options[cal_wgt]" value="1" <?php if($bddp_options['cal_wgt']==1) echo('checked="checked"'); ?>/></td>
        </tr>
</table>

<p align="justify"><b><u>Set widget titles</u>:</b></p>
    <table class="form-table">
        <tr valign="top">
        <td>Title for "<span style="color: green;">Bangla Date Display</span>" widget:</td>
        <td><input type="text" name="bddp_options[wgt_title1]" value="<?php echo rplc_symbol($bddp_options['wgt_title1']); ?>">
</td>
        </tr>
        <tr valign="top">
        <td>Title for "<span style="color: green;">Monthly Calendar (Bangla)</span>" widget:</td>
        <td><input type="text" name="bddp_options[wgt_title2]" value="<?php echo rplc_symbol($bddp_options['wgt_title2']); ?>">
</td>
        </tr>
        <tr valign="top">
        <td>Title for "<span style="color: green;">Monthly Calendar (Bangla + Gregorian)</span>" widget:</td>
        <td><input type="text" name="bddp_options[wgt_title3]" value="<?php echo rplc_symbol($bddp_options['wgt_title3']); ?>">
</td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

</form>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Reset Settings</span></h3>
<div class="inside"><div><p align="justify">Any problem? or, want to restore "Bangla Date Display" default settings? Just click on "Restore Default Settings" button below...</p>

<form method="post" action="options.php">

<?php settings_fields( 'bddp-settings-group' );
  $bddp_options = get_option("bddp_options"); ?>

<input type="hidden" name="bddp_options[trans_dt]" value="0">
<input type="hidden" name="bddp_options[trans_cmnt]" value="0">
<input type="hidden" name="bddp_options[trans_num]" value="0">
<input type="hidden" name="bddp_options[trans_cal]" value="0">
<input type="hidden" name="bddp_options[dt_change]" value="0">
<input type="hidden" name="bddp_options[ord_suffix]" value="1">
<input type="hidden" name="bddp_options[separator]" value=", ">
<input type="hidden" name="bddp_options[last_word]" value="1">
<input type="hidden" name="bddp_options[hijri_tz]" value="Asia/Dhaka">
<input type="hidden" name="bddp_options[hijri_adjust]" value="24">
<input type="hidden" name="bddp_options[cal_wgt]" value="0">
<input type="hidden" name="bddp_options[wgt_title1]" value="আজকের দিন-তারিখ">
<input type="hidden" name="bddp_options[wgt_title2]" value="বাংলা ক্যালেন্ডার">
<input type="hidden" name="bddp_options[wgt_title3]" value="বাংলা ক্যালেন্ডার">
<input type="hidden" name="bddp_options[show_day]" value="1">
<input type="hidden" name="bddp_options[show_time]" value="1">
<input type="hidden" name="bddp_options[show_en]" value="1">
<input type="hidden" name="bddp_options[show_hijri]" value="1">
<input type="hidden" name="bddp_options[show_bn]" value="1">
<input type="hidden" name="bddp_options[show_season]" value="1">

    <table class="form-table">
        <tr valign="top">
        <td style="text-align: center;"><input type="submit" value="Restore Default Settings"></td>
        </tr>
    </table>
</form></div>
</div></div>


</div>
<?php echo bddp_sidebar(); ?>
</div>