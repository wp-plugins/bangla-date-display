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
<div class="inside"><div><p align="justify">Want to translate/convert/display post/page's default (english) time, date, comment count, dashboard numbers, archive calendar etc in bangla language? Its very easy! Just Enable and Save Changes your options below...</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Translate post/page's time & date:</th>
        <td><input type="checkbox" name="bddp_options[trans_dt]" value="1" <?php if($bddp_options['trans_dt']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color1; ?>.png" alt=""> <font color="<?php echo $color1; ?>"><?php echo $trans_dt; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate comment date, time and comment count:</th>
        <td><input type="checkbox" name="bddp_options[trans_cmnt]" value="1" <?php if($bddp_options['trans_cmnt']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color2; ?>.png" alt=""> <font color="<?php echo $color2; ?>"><?php echo $trans_cmnt; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate dashboard and all other numbers:</th>
        <td><input type="checkbox" name="bddp_options[trans_num]" value="1" <?php if($bddp_options['trans_num']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color3; ?>.png" alt=""> <font color="<?php echo $color3; ?>"><?php echo $trans_num; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate default Archive Calendar:</th>
        <td><input type="checkbox" name="bddp_options[trans_cal]" value="1" <?php if($bddp_options['trans_cal']==1) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color4; ?>.png" alt=""> <font color="<?php echo $color4; ?>"><?php echo $trans_cal; ?></font></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
<div style="background-color: white; color: red; text-align: justify; padding: 3px; margin: 3px; border: green solid 1px;"><b>Important!</b> If you are using any other plugin which converts time, date etc in bangla language then, please deactivate that plugin first before enabling any option. Otherwise two same functionality plugins may cause php fatal error.</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Bangla Date Adjustment</span></h3>
<div class="inside"><div><p align="justify">Here you can select everyday when the bangla date will change.</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">When the date will change?</th>
        <td><select name="bddp_options[dt_change]">
<option value="6"<?php if($bddp_options['dt_change'] == "6") { echo " selected"; } ?>>06:00 AM</option>
<option value="0"<?php if($bddp_options['dt_change'] == "0") { echo " selected"; } ?>>12:00 AM</option>
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
<div class="inside"><div><p align="justify">Here you can set default time zone and adjust hijri date output. For example, if you want to minus two days, input 48 hours and Save Changes.</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Time Zone:</th>
        <td><?php include "time_zones.php"; ?>
</td><td>Current Time Zone:<br/><span style="color: green;"><?php echo $bddp_options['hijri_tz']; ?></span></td>
        </tr>
        <tr valign="top">
        <th scope="row">Minus Hours:</th>
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
        <th scope="row">Date separator:</th>
        <td><input type="radio" name="bddp_options[separator]" value=", "<?php if($bddp_options['separator'] == ", ") { echo " checked"; } ?>> Comma (,)</td><td><input type="radio" name="bddp_options[separator]" value=" "<?php if($bddp_options['separator'] == " ") { echo " checked"; } ?>> None (space)</td>
</tr>
        <tr valign="top">
        <th scope="row">Show ordinal suffix (১লা, ২রা, ৩রা...):</th>
        <td><input type="checkbox" name="bddp_options[ord_suffix]" value="1" <?php if($bddp_options['ord_suffix']==1) echo('checked="checked"'); ?>/></td><td></td>
        </tr>
        <tr valign="top">
        <th scope="row">Show last word (খ্রীষ্টাব্দ, বঙ্গাব্দ, হিজরী):</th>
        <td><input type="checkbox" name="bddp_options[last_word]" value="1" <?php if($bddp_options['last_word']==1) echo('checked="checked"'); ?>/></td><td></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Widget Customization</span></h3>
<div class="inside"><div><p align="left"><b>Choose items to show on "Bangla Date Display" widget:</b></p>

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
        <th scope="row">Title for "<span style="color: green;">Bangla Date Display</span>" widget:</th>
        <td><input type="text" name="bddp_options[wgt_title1]" value="<?php echo rplc_symbol($bddp_options['wgt_title1']); ?>">
</td>
        </tr>
        <tr valign="top">
        <th scope="row">Title for "<span style="color: green;">Monthly Calendar (Bangla)</span>" widget:</th>
        <td><input type="text" name="bddp_options[wgt_title2]" value="<?php echo rplc_symbol($bddp_options['wgt_title2']); ?>">
</td>
        </tr>
        <tr valign="top">
        <th scope="row">Title for "<span style="color: green;">Monthly Calendar (Bangla + Gregorian)</span>" widget:</th>
        <td><input type="text" name="bddp_options[wgt_title3]" value="<?php echo rplc_symbol($bddp_options['wgt_title3']); ?>">
</td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
<div style="background-color: white; color: red; text-align: center; padding: 3px; margin: 3px; border: green solid 1px;"><b>Note:</b> Default titles will be used for empty fields.</div>
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