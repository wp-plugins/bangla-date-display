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
<br/>
<p><div style="font-size: medium; padding: 5px; text-align: center; color: red; background-color: green; font: SolaimanLipi;"><strong>বাংলা আমার মাতৃভাষা, বাংলা আমার অহংকার!</strong></div></p><br/>
<br/>
<b>General Usage:</b><br/>
<p>"Bangla Date Display" is a simple and easy to use wordpress plugin that allows you to show bangla date or english date in bangla language anywhere in your blog.</p>

<p> <b>Put these shortcodes in your blog post/page:</b><br/>

- Show bangla date from bangla calendar: <code><span style="color: #000000"><span style="color: #0000BB"> &#91;bangla_date&#93;</span></span></code><br/>

- Show english date in bangla language: <code><span style="color: #000000"><span style="color: #0000BB"> &#91;english_date&#93;</span></span></code><br/>

- Show name of the day: <code><span style="color: #000000"><span style="color: #0000BB"> &#91;bangla_day&#93;</span></span></code><br/>

- Show current time: <code><span style="color: #000000"><span style="color: #0000BB"> &#91;bangla_time&#93;</span></span></code><br/>
</p><p>
<b> Or, insert these php codes in your sidebar or any other template file where you want to show the current bangla date:</b><br/>

- Show bangla date from bangla calendar:<br/><code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;&#91;bangla_date&#93;&#39;&#41;; </span><span style="color: #0000BB">&#63;&#62;</span></span>
</code>
<br/>
- Show english date in bangla language:<br/><code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;&#91;english_date&#93;&#39;&#41;; </span><span style="color: #0000BB">&#63;&#62;</span></span>
</code>
<br/>
- Show name of the day:<br/><code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;&#91;bangla_day&#93;&#39;&#41;; </span><span style="color: #0000BB">&#63;&#62;</span></span>
</code>
<br/>
- Show name of the current season:<br/><code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;&#91;bangla_time&#93;&#39;&#41;; </span><span style="color: #0000BB">&#63;&#62;</span></span>
</code>
</p>
<br/><br/>
<div id="message" class="updated fade"><b>Credits:</b><br/>
<p>  Developer: <a href="http://facebook.com/imran2w">M.A. IMRAN</a></p><p>  E-Mail: imran2w@gmail.com</p>
<p>  Website: <a href="http://www.i-onlinemedia.net">www.i-onlinemedia.net</a></p>
<b>License:</b><br/>
<p align="justify">    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA</p>
</div>
<br/>';

echo '</div>';
}

?>