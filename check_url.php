<?php
require_once 'wp-config.php';
global $wpdb;
$siteurl = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'siteurl'");
$home = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'home'");
echo "SITEURL: $siteurl\n";
echo "HOME: $home\n";
