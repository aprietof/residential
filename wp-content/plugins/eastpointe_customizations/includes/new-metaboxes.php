<?php 

/* Register Open House Meta Box
------------------------------------------------------------------------------*/
function eapt_add_open_house_meta_box() {
  add_meta_box(
		'eapt_add_open_house_meta_box_html',
		'Open House',
		'eapt_add_open_house_meta_box_html',
		'estate_property',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'eapt_add_open_house_meta_box' );


/* Open House Meta Box HTML + JS (For Register Open House Meta Box function )
--------------------------------------------------------------------------------*/
function eapt_add_open_house_meta_box_html() {
  global $post;

  // Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'open_house_fields' );

  $open_house      = get_post_meta( $post->ID, 'open_house', true );
  $open_house_date = $open_house['date'];
  $open_house_from = $open_house['from'];
  $open_house_to   = $open_house['to'];
  
  // Enqueue jQuery UI CSS smoothness theme
  wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
?>
  <script>
    var $ = jQuery;
    $(document).ready(function(){

      // Add open house datepicker
      $('#open_house_date').datepicker({
        dateFormat : 'MM d, yy',
        minDate: 0,
      });

      // Clear open house date button fields on click
      $('#clearOpenHouseDate').click(function(event) {
        var confirmation = confirm("Are you sure you want to clear <Open House> fields?");
        event.preventDefault();
        if (confirmation) {
          $('#open_house_date').val('');
          $('#open_house_time_from').val('');
          $('#open_house_time_to').val('');
        } else {
          return
        }
      });
    });
  </script>

  <!-- Open House MetaBox -->
  <label style="min-width: 50px;display: inline-block;">Date:</label>
  <input id="open_house_date" type="text" name="open_house_date" placeholder="DD/MM/YY"
    value="<?php echo esc_textarea( $open_house_date ); ?>"  style="margin-top: 5px;"/>

  <?php 
  $time_options = array('6:00 AM','6:30 AM','7:00 AM','7:30 AM','8:00 AM','8:30 AM','9:00 AM',
    '9:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','1:00 PM',
    '1:30 PM','2:00 PM','2:30 PM','3:00 PM','3:30 PM','4:00 PM','4:30 PM','5:00 PM','5:30 PM',
    '6:00 PM','6:30 PM','7:00 PM','7:30 PM','8:00 PM','8:30 PM','9:00 PM','9:30 PM','10:0 PM',
  );
  ?>
  
  <div style="margin-top:10px;">
    <label style="min-width: 50px;display: inline-block;">From:</label>
    <select name="open_house_time_from" id="open_house_time_from" style="width: 62%">
      <option value="">Select Time</option>
      <?php 
        $output = '';
        for( $i = 0; $i < count($time_options); $i++ ) {
          $output .= '<option ' . ( $open_house_from == $time_options[$i] ? 'selected="selected"' : '' ) . '>' . $time_options[$i] . '</option>';
        }
        echo $output;
      ?>
    </select>
  </div>
  
  <div style="margin-top:10px;">
    <label style="min-width: 50px;display: inline-block;">To:</label>
    <select name="open_house_time_to" id="open_house_time_to" style="width: 62%">
      <option value="">Select Time</option>
      <?php 
        $output = '';
        for( $i = 0; $i < count($time_options); $i++ ) {
          $output .= '<option ' . ( $open_house_to == $time_options[$i] ? 'selected="selected"' : '' ) . '>' . $time_options[$i] . '</option>';
        }
        echo $output;
      ?>
    </select>
  </div>
  
  <button id="clearOpenHouseDate" class="button button-primary button-large" style="margin-top: 15px;margin-left: 78%;">Clear</button>
  <!-- End Open House MetaBox -->
<?php 
}


/* Save Open House Meta Box on Save or Update
------------------------------------------------------------------------------*/
function eapt_save_events_meta( $post_id, $post ) {

  $open_house_category_id = 95;
  
  // Verification
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

  // Check POST data field and nonce
	if ( ! isset( $_POST['open_house_date'] ) || ! wp_verify_nonce( $_POST['open_house_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}

	// Save into $events_meta array
	$events_meta['open_house']['date'] = esc_textarea( $_POST['open_house_date'] );
	$events_meta['open_house']['from'] = $events_meta['open_house']['date'] === '' ? '' : esc_textarea( $_POST['open_house_time_from'] );
  $events_meta['open_house']['to']   = $events_meta['open_house']['date'] === '' ? '' : esc_textarea( $_POST['open_house_time_to'] );
  
  // Add or Remove Open House Category
  if( $_POST['open_house_date'] && $_POST['open_house_time_from'] && $_POST['open_house_time_to'] ) {
    
    // Add Open House Category
    wp_set_post_terms( $post_id, array( $open_house_category_id ), 'property_category', true );

    // Add Open House Label
    update_post_meta( $post_id, 'property_status', 'Open House' );
  } else {

    // Clean all values
    $events_meta['open_house']['date'] = '';
	  $events_meta['open_house']['from'] = '';
    $events_meta['open_house']['to']   = '';

    // Remove Open House Category
    wp_remove_object_terms( $post_id, $open_house_category_id, 'property_category' );

    // Remove Open house label if is open house
    if(get_post_meta( $post_id, 'property_status', true ) == 'Open House' ) delete_post_meta( $post_id, 'property_status');
  }


	foreach ( $events_meta as $key => $value ) :

		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'eapt_save_events_meta', 10, 2 );