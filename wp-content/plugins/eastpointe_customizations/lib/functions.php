<?php 

/* Register Admin Stylesheets
------------------------------------------------------------------------------*/
function eapt_load_admin_style() {
  wp_enqueue_style( 'eapt_admin_css', plugin_dir_url( __DIR__ ) . 'assets/css/admin.css' );
}
add_action( 'admin_head', 'eapt_load_admin_style' );


/* Change Post Status when added to sold ot rented categories
------------------------------------------------------------------------------*/
function eapt_change_post_status_on_sold_or_rented() {
  global $post;

  $post_id = $post->ID;
  $status = get_post_status( $post_id  );

  $sold   = has_term( 'sold', 'property_category', $post_id );
  $rented = has_term( 'rented', 'property_category', $post_id );

  if( $status == 'draft' && $sold ) {
    jp_notices_add_error('This property won\'t be published because is marked as <strong>SOLD</strong>, please uncheck the <strong>SOLD</strong> option from categories and then click <strong>PUBLISH</strong> if you wish to make it public.');
    return; 
  }

  if( $status == 'draft' && $rented ) {
    jp_notices_add_error('This property won\'t be published because is marked as <strong>RENTED</strong>, please uncheck the <strong>RENTED</strong> option from categories and then click <strong>PUBLISH</strong> if you wish to make it public.');
    return;
  }

  if( $sold || $rented ) {
    wp_update_post( array(
      'ID'    =>  $post_id,
      'post_status'   =>  'draft'
    ));
  }
}
add_action( 'save_post', 'eapt_change_post_status_on_sold_or_rented', 1, 2 );



