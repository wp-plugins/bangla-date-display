<?php

add_action('admin_menu', 'register_bddp_menu_page');
add_action( 'admin_init', 'register_bddp_settings' );
define( 'BDDP_DOMAIN', 'bangla-date-display' );

function register_bddp_menu_page() {

add_menu_page('Bangla Date Display', 'BN Date Display', 'add_users', __FILE__, 'bdd_plugin_menu', plugins_url('bangla-date-display/images/icon.png'));

add_submenu_page(__FILE__, __('Usage', BDDP_DOMAIN ), __('Usage', BDDP_DOMAIN ), 'add_users', __FILE__, 'bdd_plugin_menu');

add_submenu_page(__FILE__, 'Settings', 'Settings', 'manage_options', 'bddp_settings', 'bddp_settings_page');

add_submenu_page(__FILE__, 'Edit Calendar Style', 'Calendar Style', 'add_users', 'bddp_style_editor', 'bddp_style_editor_page');

add_submenu_page(__FILE__, 'Server Information', 'Server Information', 'add_users', 'bddp_server_info', 'bddp_server_info_menu');
}

function register_bddp_settings() {
register_setting( 'bddp-settings-group', 'bddp_options' );
}

include "admin/sidebar.php";

function bdd_plugin_menu() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
include "admin/usage.php";
}

function bddp_settings_page() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
include "admin/settings.php";
}

function bddp_style_editor_page() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
include "admin/style_edit.php";
}

function bddp_server_info_menu() {
if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
include "admin/server_info.php";
}

?>