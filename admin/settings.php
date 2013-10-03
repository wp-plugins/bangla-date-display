<div class="wrap">
<h2><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/icon4.png" alt=""> Bangla Date Display Plugin Settings</h2>

<?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { 
echo '<div id="message" class="updated"><p>'. __('Settings saved.') .'</p></div>'.PHP_EOL;
} ?>

<form method="post" action="options.php">
    <?php
function rplc_symbol($symbol) {
  $symbol = str_replace('"', '&#34;', $symbol);
  return $symbol; }

settings_fields( 'bddp-settings-group' );

$bddp_option1 = get_option('bddp_option1');
$bddp_option2 = get_option('bddp_option2');
$bddp_option3 = get_option('bddp_option3');
$bddp_option4 = get_option('bddp_option4');
$bddp_option5 = get_option('bddp_option5');
$bddp_option6 = get_option('bddp_option6');
$bddp_option7 = get_option('bddp_option7');
$bddp_option8 = get_option('bddp_option8');
$bddp_option9 = get_option('bddp_option9');

if($bddp_option1 == "Enabled") { $color1 = "green"; }
elseif($bddp_option1 == "") { $bddp_option1 = "Disabled"; $color1 = "red"; }

if($bddp_option2 == "Enabled") { $color2 = "green"; }
elseif($bddp_option2 == "") { $bddp_option2 = "Disabled"; $color2 = "red"; }

if($bddp_option3 == "") { $bddp_option3 = "24"; }
if($bddp_option4 == "Enabled") { $color4 = "green"; }
elseif($bddp_option4 == "") { $bddp_option4 = "Disabled"; $color4 = "red"; }

if($bddp_option5 == "") { $bddp_option5 = "Asia/Dhaka"; }
if($bddp_option6 == "") { $bddp_option6 = "0"; }
?>

<br/><div style="width: 65%; float: left;">
<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Translation Options</span></h3>
<div class="inside"><div><p align="justify">Want to translate/convert/display post/page's default (english) time, date, comment count, dashboard numbers, archive calendar etc in bangla language? Its very easy! Just Enable and Save Changes your options below...</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Translate post/page/comment area's time & date and comment count:</th>
        <td><input type="checkbox" name="bddp_option1" value="Enabled" <?php if(get_option('bddp_option1')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color1; ?>.png" alt=""> <font color="<?php echo $color1; ?>"><?php echo $bddp_option1; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate default Archive Calendar:</th>
        <td><input type="checkbox" name="bddp_option2" value="Enabled" <?php if(get_option('bddp_option2')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color2; ?>.png" alt=""> <font color="<?php echo $color2; ?>"><?php echo $bddp_option2; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate dashboard and other numbers:</th>
        <td><input type="checkbox" name="bddp_option4" value="Enabled" <?php if(get_option('bddp_option4')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color4; ?>.png" alt=""> <font color="<?php echo $color4; ?>"><?php echo $bddp_option4; ?></font></td>
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
        <td><select name="bddp_option6">
<option value="6"<?php if($bddp_option6 == "6") { echo " selected"; } ?>>06:00 AM</option>
<option value="0"<?php if($bddp_option6 == "0") { echo " selected"; } ?>>12:00 AM</option>
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
        <th scope="row">Choose Time Zone:</th>
        <td><?php include "time_zones.php"; ?>
</td><td>Current Time Zone:<br/><span style="color: green;"><?php echo $bddp_option5; ?></span></td>
        </tr>
<hr size="1" width="90%" color="gray">
        <tr valign="top">
        <th scope="row">Minus Hours:</th>
        <td>-<input type="text" name="bddp_option3" size="3" value="<?php echo $bddp_option3; ?>"></td><td> Status: <span style="color: green;">-<?php echo $bddp_option3; if($bddp_option3 == "0") { echo " Hour"; }
elseif($bddp_option3 == "1") { echo " Hour"; }
else { echo " Hours"; } ?></span></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Widget Customization</span></h3>
<div class="inside"><div><p align="justify">Set your desired titles for available 3 widgets.</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Title for "<span style="color: green;">Bangla Date Display</span>" widget:</th>
        <td><input type="text" name="bddp_option7" value="<?php echo rplc_symbol(get_option('bddp_option7')); ?>">
</td>
        </tr>
        <tr valign="top">
        <th scope="row">Title for "<span style="color: green;">Monthly Calendar (Bangla)</span>" widget:</th>
        <td><input type="text" name="bddp_option8" value="<?php echo rplc_symbol(get_option('bddp_option8')); ?>">
</td>
        </tr>
        <tr valign="top">
        <th scope="row">Title for "<span style="color: green;">Monthly Calendar (Bangla + Gregorian)</span>" widget:</th>
        <td><input type="text" name="bddp_option9" value="<?php echo rplc_symbol(get_option('bddp_option9')); ?>">
</td>
        </tr>
    </table>
    <?php submit_button(); ?>
</div>
<div style="background-color: white; color: red; text-align: center; padding: 3px; margin: 3px; border: green solid 1px;"><b>Note:</b> Default titles will be used for empty fields.</div>
</div></div>

</form><div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
<h3 class="hndle" style="padding:5px;"><span>Some Screenshots</span></h3>
<div class="inside">    <table class="form-table">
        <tr valign="top"><td width="33%"><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/screenshot-1.png" alt="Widget-1"></td><td width="33%"><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/screenshot-2.png" alt="Widget-2"></td><td width="33%"><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/screenshot-3.png" alt="Widget-3"></td>
        </tr>
    </table>
<p align="center">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/post-date-time.png" alt="post">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/comment1.png" alt="">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/calendar_archive.png" alt="">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/monthly_archive.png" alt="">
</p></div></div>

</div>
<?php echo bddp_sidebar(); ?>
</div>