<div class="wrap">
<h2><img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/icon4.png" alt=""> Bangla Date Display Plugin Settings</h2>

<?php if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { 
echo '<div id="message" class="updated"><p>'. __('Settings saved.') .'</p></div>'.PHP_EOL;
} ?>

<form method="post" action="options.php">
    <?php
settings_fields( 'bddp-settings-group' );

$bddp_option1 = get_option('bddp_option1');
$bddp_option2 = get_option('bddp_option2');

if($bddp_option1 == "Enabled") { $color1 = "green"; }
elseif($bddp_option1 == "") { $bddp_option1 = "Disabled"; $color1 = "red"; }

if($bddp_option2 == "Enabled") { $color2 = "green"; }
elseif($bddp_option2 == "") { $bddp_option2 = "Disabled"; $color2 = "red"; }
?>

<br/><div style="width: 60%; float: left;">
<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Translation Options</span></h3>
<div class="inside"><div><p align="justify">Want to translate/convert/display post/page's default (english) time, date & comment count, archive calendar etc in bangla language? Its very easy! Just Enable and Save Changes your options below...</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Translate post/page/comment area's time & date and comment count:</th>
        <td><input type="checkbox" name="bddp_option1" value="Enabled" <?php if(get_option('bddp_option1')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color1; ?>.png" alt=""> <font color="<?php echo $color1; ?>"><?php echo $bddp_option1; ?></font></td>
        </tr>
        <tr valign="top">
        <th scope="row">Translate default Archive Calendar:</th>
        <td><input type="checkbox" name="bddp_option2" value="Enabled" <?php if(get_option('bddp_option2')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/<?php echo $color2; ?>.png" alt=""> <font color="<?php echo $color2; ?>"><?php echo $bddp_option2; ?></font></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form></div>
<div style="background-color: white; color: red; text-align: justify; padding: 3px; margin: 3px; border: green solid 1px;"><b>Important!</b> If you are using any other plugin which converts time, date etc in bangla language then, please deactivate that plugin first before enabling any option. Otherwise two same functionality plugins may cause php fatal error.</div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
	<h3 class="hndle" style="padding:5px;"><span>Hijri Date Adjustment</span></h3>
<div class="inside"><div><p align="justify">Here you can adjust hijri date output. For example, if you want to minus two days, input 48 hours and Save Changes.</p>

<form method="post" action="options.php">
    <?php
settings_fields( 'bddp-settings-group' );

$bddp_option3 = get_option('bddp_option3');
if($bddp_option3 == "") { $bddp_option3 = "0"; }
?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Minus Hours:</th>
        <td>-<input type="text" name="bddp_option3" size="3" value="<?php echo $bddp_option3; ?>"></td><td> Status: -<?php echo $bddp_option3; if($bddp_option3 == "0") { echo " Hour"; }
elseif($bddp_option3 == "1") { echo " Hour"; }
else { echo " Hours"; } ?></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form></div>
</div></div>

<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
<h3 class="hndle" style="padding:5px;"><span>Some Screenshots</span></h3>
<div class="inside"><p align="center">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/post-date-time.png" alt="post">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/comment1.png" alt="">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/calendar_archive.png" alt="">
<img src="<?php echo WP_PLUGIN_URL; ?>/bangla-date-display/images/monthly_archive.png" alt="">
</p></div></div>

</div>
<?php echo bddp_sidebar(); ?>
</div>
