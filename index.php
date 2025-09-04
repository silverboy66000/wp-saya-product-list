<?php
/*
Plugin Name: saya co product updater
Plugin URI: https://abolfazsamiei.ir
Description: به روز رسانی سریع محصولات سایا
Version: 1.0
Author: ابوالفضل سمیعی
Author URI: https://abolfazlsamiei.ir
License: MIT
Text Domain: none
*/
global $wpdb;

//------------- تعریف منو در پنل مدیریت
function saya_list_management_in_wpAdmin()
{
    add_menu_page(
        'محصولات سایا', // Title of the page
        'محصولات سایا', // Text to show on the menu link
        'manage_options',
        'saya_list_logs_menu',
        'saya_categories_list_wpAdmin',
        'dashicons-format-aside',
        3
    );

}
add_action( 'admin_menu', 'saya_list_management_in_wpAdmin' );

function saya_categories_list_wpAdmin() {
	include 'admin/index.php';
}


