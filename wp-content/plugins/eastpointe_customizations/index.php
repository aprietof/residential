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

foreach ( glob( $plugin_directory . '/lib/*.php' ) as $function_filename ) {
  require_once $function_filename;
}

foreach ( glob( $plugin_directory . '/includes/*.php' ) as $function_filename ) {
  require_once $function_filename;
}


