<?php

add_action( 'admin_menu', 'bddp_admin' );

function bddp_admin() {
add_options_page( 'Bangla Date Display Plugin Options', 'Bangla Date Display',
'manage_options', 'bddp_admin_page', 'bddp_plugin_options' );
}

function bddp_plugin_options() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

echo '<div class="wrap">
<div id="message" class="updated fade">Thank you for using "Bangla Date Display" wordpress plugin!</div>
<br/><br/>
<b>General Usage:</b><br/>
<p>  Put this shortcode [bangla_date] in your blog post/page, sidebar or, anywhere else! where you want to show current bangla date.</p>
<br/><br/>
<div id="message" class="updated fade"><b>Credit:</b><br/>
<p>  Developer: <a href="http://facebook.com/imran2w">M.A. IMRAN</a></p><p>  E-Mail: imran2w@gmail.com</p>
</div><br/>';

echo '</div>';
}

?>