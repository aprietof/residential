<?php
/*
Plugin Name: Eastpointe Residential Theme Customizations
Description: Customize current wordpress theme 
Author: Adrian Prieto
Version: 1.0
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

$plugin_directory = dirname( __FILE__ );

include $plugin_directory . '/lib/notifications.php';
include $plugin_directory . '/lib/functions.php';
require_once $plugin_directory . '/includes/new-metaboxes.php';


