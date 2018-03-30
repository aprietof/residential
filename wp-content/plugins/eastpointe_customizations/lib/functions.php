<?php 

function eapt_load_admin_style() {
  wp_enqueue_style( 'eapt_admin_css', plugin_dir_url( __DIR__ ) . 'assets/css/admin.css' );
}
add_action( 'admin_head', 'eapt_load_admin_style' );