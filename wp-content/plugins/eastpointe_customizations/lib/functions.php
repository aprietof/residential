<?php 

/* Register Admin Stylesheets
------------------------------------------------------------------------------*/
function eapt_load_admin_style() {
  wp_enqueue_style( 'eapt_admin_css', plugin_dir_url( __DIR__ ) . 'assets/css/admin.css' );
}
add_action( 'admin_head', 'eapt_load_admin_style' );


/* Update Post Status/Labels on save.
------------------------------------------------------------------------------*/
function eapt_taxonomy_change_side_effects() {
  global $post;

  $post_id = $post->ID;
  $status = get_post_status( $post_id  );

  $sold   = has_term( 'sold', 'property_category', $post_id );
  $rented = has_term( 'rented', 'property_category', $post_id );
  $off_the_market = has_term( 'off-the-market', 'property_category', $post_id );
  $in_contract = has_term( 'in-contract', 'property_category', $post_id );

  if( $sold && $rented ) {

    // Display Error
    jp_notices_add_error('A label can\'t  be assigned to this property because <strong>SOLD</strong> and <strong>RENTED</strong> categories are both checked, please check only one of the two categories and try again.');

    // Update Label
    update_post_meta( $post_id, 'property_status', 'normal' );
    return;
  }

  if( $sold ) {
    // Update Label
    update_post_meta( $post_id, 'property_status', 'Sold' );
  }

  if( $rented ) {
    // Update Label
    update_post_meta( $post_id, 'property_status', 'Rented' );
  }

  if( $in_contract ) {
    // Update Label
    update_post_meta( $post_id, 'property_status', 'In Contract' );
  }

   if( $status === 'draft' && $off_the_market ) {

    // Update Label
    update_post_meta( $post_id, 'property_status', 'Of the Market' );

    // Display Error
    jp_notices_add_error('This property is no longer public because <strong>OFF THE MARKET</strong> category is checked, please uncheck <strong>OFF THE MARKET</strong> from categories and then click <strong>PUBLISH</strong> if you wish to make it public.');
    return;
  }

  if( $status !== 'draft' && $off_the_market ) {

    // Unpublish
    wp_update_post( array( 'ID' =>  $post_id, 'post_status' =>  'draft' ) );

    // Update Label
    update_post_meta( $post_id, 'property_status', 'Of the Market' );
  }
}
add_action( 'save_post', 'eapt_taxonomy_change_side_effects', 10, 2 );

