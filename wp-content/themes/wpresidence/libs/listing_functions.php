<?php
///////////////////////////////////////////////////////////////////////////////////////////
// floor plans
///////////////////////////////////////////////////////////////////////////////////////////


if( !function_exists('estate_floor_plan') ):
    function estate_floor_plan($post_id){
        $unit               = esc_html( get_option('wp_estate_measure_sys', '') );
        
        $plan_title_array   = get_post_meta($post_id, 'plan_title', true);
        $plan_desc_array    = get_post_meta($post_id, 'plan_description', true) ;
        $plan_image_array   = get_post_meta($post_id, 'plan_image', true) ;
        $plan_size_array    = get_post_meta($post_id, 'plan_size', true) ;
        $plan_image_attach_array    = get_post_meta($post_id, 'plan_image_attach', true) ;
    
        $plan_rooms_array   = get_post_meta($post_id, 'plan_rooms', true) ;
        $plan_bath_array    = get_post_meta($post_id, 'plan_bath', true);
        $plan_price_array   = get_post_meta($post_id, 'plan_price', true) ;
        
        $currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
        $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
         
        $show= ' style="display:block"; ';
    
        if (is_array($plan_title_array)){        
            foreach ($plan_title_array as $key=> $plan_name) {

                if ( isset($plan_desc_array[$key])){
                    $plan_desc=$plan_desc_array[$key];
                }else{
                    $plan_desc='';
                }

                if ( isset($plan_image_attach_array[$key])){
                    $plan_image_attach=$plan_image_attach_array[$key];
                }else{
                    $plan_image_attach='';
                }

                if ( isset($plan_image_array[$key])){
                    $plan_img=$plan_image_array[$key];
                }else{
                    $plan_img='';
                }

                if ( isset($plan_size_array[$key]) && $plan_size_array[$key]!=''){
                    $plan_size=__('size:','wpestate').' '.$plan_size_array[$key].' '.$unit.'<sup>2</sup>';
                }else{
                    $plan_size='';
                }

                if ( isset($plan_rooms_array[$key]) && $plan_rooms_array[$key]!=''){
                    $plan_rooms= __('rooms: ','wpestate').' '.$plan_rooms_array[$key];
                }else{
                    $plan_rooms='';
                }

                if ( isset($plan_bath_array[$key]) && $plan_bath_array[$key]!=''){
                    $plan_bath=__('baths:','wpestate').' '.$plan_bath_array[$key];
                }else{
                    $plan_bath='';
                }
                $price='';
                if ( isset($plan_price_array[$key]) && $plan_price_array[$key]!=''){
                    $plan_price=$plan_price_array[$key];
                }else{
                    $plan_price='';
                }
                $full_img           = wp_get_attachment_image_src($plan_image_attach, 'full');

                print '
                <div class="front_plan_row">
                    <div class="floor_title">'.$plan_name.'</div>
                    <div class="floor_details">'.$plan_size.'</div>
                    <div class="floor_details">'.$plan_rooms.'</div>    
                    <div class="floor_details">'.$plan_bath.'</div> 
                    <div class="floor_details">';
                        if($plan_price!=''){
                            print  __('price: ','wpestate').' '.wpestate_show_price_floor($plan_price,$currency,$where_currency,1);
                        }
                        print'</div> 
                </div>
                <div class="front_plan_row_image" '.$show.'>
                    <div class="floor_image">
                        <a href="'.$full_img[0].'" rel="prettyPhoto" title="'.$plan_desc.'"><img src="'.$full_img[0].'"  alt="'.$plan_name.'"></a>
                    </div>
                    <div class="floor_description">'.$plan_desc.'</div>
                </div>';
                $show='';
            }
        }
    }
endif;



///////////////////////////////////////////////////////////////////////////////////////////
// List features and ammenities
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('estate_listing_features') ):
function estate_listing_features($post_id,$col=3){
    $return_string='';    
    $counter            =   0;                          
    $feature_list_array =   array();
    $feature_list       =   esc_html( get_option('wp_estate_feature_list') );
    $feature_list_array =   explode( ',',$feature_list);
    $total_features     =   round( count( $feature_list_array )/2 );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
        
     $show_no_features= esc_html ( get_option('wp_estate_show_no_features','') );

         
             
        if($show_no_features!='no'){
            foreach($feature_list_array as $checker => $value){
                    $counter++;
                    $post_var_name  =   str_replace(' ','_', trim($value) );
                    $input_name     =   wpestate_limit45(sanitize_title( $post_var_name ));
                    $input_name     =   sanitize_key($input_name);
                         
                    
                    if (function_exists('icl_translate') ){
                        $value     =   icl_translate('wpestate','wp_estate_property_custom_amm_'.$value, $value ) ;                                      
                    }
                                        
                    if (esc_html( get_post_meta($post_id, $input_name, true) ) == 1) {
                         $return_string .= '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-check"></i>' . trim(stripslashes($value)) . '</div>';
                    }else{
                        $return_string  .=  '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-times"></i>' .  trim(stripslashes($value)) . '</div>';
                    }
              }
        }else{
             
            foreach($feature_list_array as $checker => $value){
                $post_var_name  =  str_replace(' ','_', trim($value) );
                $input_name     =   wpestate_limit45(sanitize_title( $post_var_name ));
                $input_name     =   sanitize_key($input_name);
                
                if (function_exists('icl_translate') ){
                    $value     =   icl_translate('wpestate','wp_estate_property_custom_amm_'.$value, $value ) ;                                      
                }
                      
                if ($input_name!='' && esc_html( get_post_meta($post_id, $input_name, true) ) == 1) {
                    $return_string .=  '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-check"></i>' .  trim(stripslashes($value))  . '</div>';
                }
            }
           
       }
    
    return $return_string;
}
endif; // end   estate_listing_features  



if( !function_exists('estate_listing_content') ):
function estate_listing_content($post_id){
    $content='';
    $args= array( 
        'post_type'         => 'estate_property',
        'post_status'       => 'publish',
        'p' => $post_id
    );
    $the_query = new WP_Query( $args);
   
    
       while ($the_query->have_posts()) : 
            $the_query->the_post(); 
            
            $content= get_the_content();
        endwhile;
        
        wp_reset_postdata();
    
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    
      
    $args = array(  'post_mime_type'    => 'application/pdf', 
                'post_type'         => 'attachment', 
                'numberposts'       => -1,
                'post_status'       => null, 
                'post_parent'       => $post_id 
        );

    $attachments = get_posts($args);

    if ($attachments) {

        $content.= '<div class="download_docs">'.__('Documents','wpestate').'</div>';
        foreach ( $attachments as $attachment ) {
            $content.= '<div class="document_down"><a href="'. wp_get_attachment_url($attachment->ID).'" target="_blank">'.$attachment->post_title.'<i class="fa fa-download"></i></a></div>';
        }
    }

    wp_reset_postdata();
    
  
    return $content;     
    
}
endif;




if( !function_exists('estate_listing_address') ):
function estate_listing_address($post_id,$col=3){
    
    $property_address   = esc_html( get_post_meta($post_id, 'property_address', true) );
    $property_city      = get_the_term_list($post_id, 'property_city', '', ', ', '');
    $property_area      = get_the_term_list($post_id, 'property_area', '', ', ', '');
    $property_county    = get_the_term_list($post_id, 'property_county_state', '', ', ', '') ;
    $property_zip       = esc_html(get_post_meta($post_id, 'property_zip', true) );
    $property_country   = esc_html(get_post_meta($post_id, 'property_country', true) );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    
    $return_string='';
    
    if ($property_address != ''){
        $return_string.='<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Address','wpestate').':</strong> ' . $property_address . '</div>'; 
    }
    if ($property_city != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('City','wpestate').':</strong> ' .$property_city. '</div>';  
    }  
    if ($property_area != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Area','wpestate').':</strong> ' .$property_area. '</div>';
    }    
    if ($property_county != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('State/County','wpestate').':</strong> ' . $property_county . '</div>'; 
    }
    if ($property_zip != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Zip','wpestate').':</strong> ' . $property_zip . '</div>';
    }  
    if ($property_country != '') {
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Country','wpestate').':</strong> ' . $property_country . '</div>'; 
    } 
    
    return  $return_string;
}
endif; // end   estate_listing_address  



if( !function_exists('estate_listing_address_print') ):
function estate_listing_address_print($post_id){
    
    $property_address   = esc_html( get_post_meta($post_id, 'property_address', true) );
    $property_city      = strip_tags (  get_the_term_list($post_id, 'property_city', '', ', ', '') );
    $property_area      = strip_tags ( get_the_term_list($post_id, 'property_area', '', ', ', '') );
    $property_county    = strip_tags ( get_the_term_list($post_id, 'property_county_state', '', ', ', '')) ;
    //$property_state     = esc_html(get_post_meta($post_id, 'property_state', true) );
    $property_zip       = esc_html(get_post_meta($post_id, 'property_zip', true) );
    //$property_state     = esc_html(get_post_meta($post_id, 'property_state', true) );
    
    $property_country   = esc_html(get_post_meta($post_id, 'property_country', true) );
    
    $return_string='';
    
    if ($property_address != ''){
        $return_string.='<div class="listing_detail col-md-4"><strong>'.__('Address','wpestate').':</strong> ' . $property_address . '</div>'; 
    }
    if ($property_city != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('City','wpestate').':</strong> ' .$property_city. '</div>';  
    }  
    if ($property_area != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Area','wpestate').':</strong> ' .$property_area. '</div>';
    }    
    if ($property_county != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('State/County','wpestate').':  </strong> ' . $property_county . '</div>'; 
    }
   /* if ($property_state != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('State','wpestate').':</strong> ' . $property_state . '</div>';
    }
    
    */ 
    if ($property_zip != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Zip','wpestate').':</strong> ' . $property_zip . '</div>';
    }  
    if ($property_country != '') {
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Country','wpestate').':</strong> ' . $property_country . '</div>'; 
    } 
    
    return  $return_string;
}
endif; // end   estate_listing_address  






if( !function_exists('estate_listing_details') ):
function estate_listing_details($post_id,$col=3){
  
    $currency       =   esc_html( get_option('wp_estate_currency_symbol', '') );
    $where_currency =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
    $measure_sys    =   esc_html ( get_option('wp_estate_measure_sys','') ); 
    $property_size  =   floatval( get_post_meta($post_id, 'property_size', true) );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    
    if ($property_size  != '') {
        $property_size  = wpestate_sizes_no_format($property_size) . ' '.$measure_sys.'<sup>2</sup>';
    }

    $property_lot_size = floatval( get_post_meta($post_id, 'property_lot_size', true) );

    if ($property_lot_size != '') {
        $property_lot_size = wpestate_sizes_no_format($property_lot_size) . ' '.$measure_sys.'<sup>2</sup>';
    }

    $property_rooms     = floatval ( get_post_meta($post_id, 'property_rooms', true) );
    $property_bedrooms  = floatval ( get_post_meta($post_id, 'property_bedrooms', true) );
    $property_bathrooms = floatval ( get_post_meta($post_id, 'property_bathrooms', true) );     
    $price              = floatval   ( get_post_meta($post_id, 'property_price', true) );
 
            
    if ($price != 0) {
        $price =wpestate_show_price($post_id,$currency,$where_currency,1);           
    }else{
        $price='';
    } 

    $return_string='';
    $return_string.='<div class="listing_detail col-md-'.$colmd.'" id="propertyid_display"><strong>'.__('Property Id ','wpestate'). ':</strong> '.$post_id.'</div>';
    if ($price !='' ){ 
        $return_string.='<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Price','wpestate'). ':</strong> '. $price.'</div>';
    }
    
    if ($property_size != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Property Size','wpestate').':</strong> ' . $property_size . '</div>';
    }               
    if ($property_lot_size != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Property Lot Size','wpestate').':</strong> ' . $property_lot_size . '</div>';
    }      
    if ($property_rooms != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Rooms','wpestate').':</strong> ' . $property_rooms . '</div>'; 
    }      
    if ($property_bedrooms != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Bedrooms','wpestate').':</strong> ' . $property_bedrooms . '</div>'; 
    }     
    if ($property_bathrooms != '')    {
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Bathrooms','wpestate').':</strong> ' . $property_bathrooms . '</div>'; 
    }      

    
    // Custom Fields 


    $i=0;
    $custom_fields = get_option( 'wp_estate_custom_fields', true); 
    if( !empty($custom_fields)){  
        while($i< count($custom_fields) ){
           $name =   $custom_fields[$i][0];
           $label=   $custom_fields[$i][1];
           $type =   $custom_fields[$i][2];
       //    $slug =   sanitize_key ( str_replace(' ','_',$name) );
           $slug         =   wpestate_limit45(sanitize_title( $name ));
           $slug         =   sanitize_key($slug);
            
           $value=esc_html(get_post_meta($post_id, $slug, true));
           if (function_exists('icl_translate') ){
                $label     =   icl_translate('wpestate','wp_estate_property_custom_'.$label, $label ) ;
                $value     =   icl_translate('wpestate','wp_estate_property_custom_'.$value, $value ) ;                                      
           }
                                   
           if($value!=''){
               $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.ucwords($label).':</strong> ' .$value. '</div>'; 
           }
           $i++;       
        }
    }

     //END Custom Fields 

         
         
    return $return_string;
}
endif; // end   estate_listing_details  

?>