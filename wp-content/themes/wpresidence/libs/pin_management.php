<?php

if( !function_exists('wpestate_listing_pins_marker_creation') ):
    function wpestate_listing_pins_marker_creation($prop_selection=''){
        $counter                    =   0;
        $unit                       =   get_option('wp_estate_measure_sys','');
        $currency                   =   get_option('wp_estate_currency_symbol','');
        $where_currency             =   get_option('wp_estate_where_currency_symbol', '');
        $markers                    =   array();

        while($prop_selection->have_posts()): $prop_selection->the_post();

            $the_id      =   get_the_ID();
            ////////////////////////////////////// gathering data for markups
            $gmap_lat    =      floatval(get_post_meta($the_id, 'property_latitude', true));
            $gmap_long   =      floatval(get_post_meta($the_id, 'property_longitude', true));
           
            if($gmap_lat==0){
                $gmap_lat='';
            }
            
            if($gmap_long==0){
                $gmap_long='';
            }
                    
            $slug        =   array();
            $prop_type   =   array();
             
            $types       =   get_the_terms($the_id,'property_category' );
            $types_act   =   get_the_terms($the_id,'property_action_category' );
            
            $prop_type_name=array();
            if ( $types && ! is_wp_error( $types ) ) { 
                foreach ($types as $single_type) {
                    $prop_type[]      = $single_type->slug;
                    $prop_type_name[] = $single_type->name;
                    $slug             = $single_type->slug;
                    $parent_term      = $single_type->parent;

                }

                $single_first_type      = $prop_type[0]; 
                $single_first_type_pin  = $prop_type[0];
                if($parent_term!=0){
                    $single_first_type=$single_first_type.wpestate_add_parent_infobox($parent_term,'property_category');
                }
                $single_first_type_name= $prop_type_name[0]; 
            }else{
                $single_first_type        ='';
                $single_first_type_name   ='';
                $single_first_type_pin    ='';
            }


            ////////////////////////////////////// get property action
            $prop_action        =   array();
            $prop_action_name   =   array();
            if ( $types_act && ! is_wp_error( $types_act ) ) { 
                  foreach ($types_act as $single_type) {
                    $prop_action[]      =   $single_type->slug;
                    $prop_action_name[] =   $single_type->name;
                    $slug               =   $single_type->slug;
                    $parent_term        =   $single_type->parent;
                   }
            $single_first_action        = $prop_action[0];
            $single_first_action_pin    = $prop_action[0];

            if($parent_term!=0){
                $single_first_action=$single_first_action.wpestate_add_parent_infobox($parent_term,'property_action_category');
            }
            $single_first_action_name   = $prop_action_name[0];
            }else{
                $single_first_action        ='';
                $single_first_action_name   ='';
                $single_first_action_pin    ='';
            }

            // composing name of the pin
            if($single_first_action=='' || $single_first_action ==''){
                  $pin                   =  sanitize_key(wpestate_limit54($single_first_type_pin.$single_first_action_pin));
            }else{
                  $pin                   =  sanitize_key(wpestate_limit27($single_first_type_pin)).sanitize_key(wpestate_limit27($single_first_action_pin));
            }
            $counter++;

            
            //// get price
            $price              =   floatval    ( get_post_meta($the_id, 'property_price', true) );
            $price_label        =   esc_html    ( get_post_meta($the_id, 'property_label', true) );
            $price_label_before =   esc_html    ( get_post_meta($the_id, 'property_label_before', true) );
            $clean_price        =   floatval    ( get_post_meta($the_id, 'property_price', true) );
            if($price==0){
                $price=$price_label_before.''.$price_label;                        
            }else{
                $th_separator   = stripslashes ( get_option('wp_estate_prices_th_separator','') );
                $price = number_format($price,0,'.',$th_separator);
                if($where_currency=='before'){
                    $price=$currency.' '.$price;
                }else{
                    $price=$price.' '.$currency;
                }
                $price='<span class="infocur infocur_first">'.$price_label_before.'</span>'.$price.'<span class="infocur">'.$price_label.'</span>';
            }

            $rooms      =   get_post_meta($the_id, 'property_bedrooms', true);
            $bathrooms  =   get_post_meta($the_id, 'property_bathrooms', true);  
            $size       =   get_post_meta($the_id, 'property_size', true);  		
            if($size!=''){
               $size =  number_format(intval($size)) ;
            }
            
            $place_markers  =   array();
            $title_orig     =   get_the_title();
            $title_orig     =   str_replace('%','', $title_orig); 
            /* $title =  mb_substr( $title_orig,0,45); 
            if(mb_strlen($title_orig)>45){
                $title.= '...';   
            }
            */
           
            $place_markers[]    = rawurlencode ($title_orig);//0
           
            $place_markers[]    = $gmap_lat;//1
            $place_markers[]    = $gmap_long;//2
            $place_markers[]    = $counter;//3
            $place_markers[]    = rawurlencode ( get_the_post_thumbnail($the_id,'property_map1') );////4
            $place_markers[]    = rawurlencode ( $price); //5
            $place_markers[]    = rawurlencode ($single_first_type);//6
            $place_markers[]    = rawurlencode ($single_first_action);//7
            $place_markers[]    = rawurlencode ($pin);//8
            $place_markers[]    = rawurlencode (get_permalink());//9
            $place_markers[]    = $the_id;//10
            $place_markers[]    = $clean_price;//11
            $place_markers[]    = $rooms;//12
            $place_markers[]    = $bathrooms;//13
            $place_markers[]    = $size;//14
            $place_markers[]    = rawurlencode ( $single_first_type_name);//15
            $place_markers[]    = rawurlencode  ( $single_first_action_name);//16
      
                     
                  
                       
            //  print_r($place_markers);
            $markers[]=$place_markers;
        endwhile;   
        
        return $markers;
    }
endif;





if( !function_exists('wpestate_listing_pins_on_demand') ):
    function wpestate_listing_pins_on_demand($args='',$jump=0){
        wp_suspend_cache_addition(true);
        global $keyword;
        set_time_limit (0);
        $counter=0;
      
        $cache                      =   get_option('wp_estate_cache','');
        $place_markers              =   array();
        $markers                    =   array();
        
        if( !empty($keyword) ){
            add_filter( 'posts_where', 'wpestate_title_filter', 10, 2 );
        }
        
        $prop_selection = new WP_Query($args);
        
        if( !empty($keyword) ){
            remove_filter( 'posts_where', 'wpestate_title_filter', 10, 2 );
        }
        wp_reset_query(); 


        $custom_advanced_search = get_option('wp_estate_custom_advanced_search','');
        $show_slider_price      = get_option('wp_estate_show_slider_price','');
        $has_slider             =   0; 


        $markers=wpestate_listing_pins_marker_creation($prop_selection);

        wp_suspend_cache_addition(false);
        wp_reset_query(); 
        $return_array= array();
        $return_array['markers']=$markers;
        $return_array['results']=$prop_selection->found_posts;

        return ($return_array);
    }
endif; // end   wpestate_listing_pins  



////////////////////////////////////////////////////////////////////////////////
/// google map functions - contact pin array creation
////////////////////////////////////////////////////////////////////////////////  

if( !function_exists('wpestate_contact_pin') ):
    function wpestate_contact_pin(){
            $place_markers=array();
            $company_name=esc_html(stripslashes( get_option('wp_estate_company_name','') ) );
            if($company_name==''){
                $company_name='Company Name';
            }

            $place_markers[0]    =   $company_name;
            $place_markers[1]    =   '';
            $place_markers[2]    =   '';
            $place_markers[3]    =   1;
            $place_markers[4]    =   esc_html(get_option('wp_estate_company_contact_image', '') );
            $place_markers[5]    =   '0';
            $place_markers[6]    =   'address';
            $place_markers[7]    =   'none';
            $place_markers[8]    =   '';
            return json_encode($place_markers);
    }    
endif; // end   wpestate_contact_pin  




if( !function_exists('wpestate_add_parent_infobox') ):
    function wpestate_add_parent_infobox($parent_term,$taxonomy){
        $parent_term = get_term_by( 'id', $parent_term, $taxonomy);
        if( isset($parent_term) ){
            if(  $parent_term->parent!=0){
                return  '.'.$parent_term->slug.wpestate_add_parent_infobox($parent_term->parent,$taxonomy); 
            }else{
                return '.'.$parent_term->slug;
            } 
        }


}   
endif;




////////////////////////////////////////////////////////////////////////////////
/// google map functions - pin array creation
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('wpestate_listing_pins') ):
function wpestate_listing_pins($args='',$jump=0,$keyword='',$id_array=''){
    wp_suspend_cache_addition(true);
    set_time_limit (0);
   
    $place_markers=$markers     =   array();
    if  ( $args==''){
        $args = array(
            'post_type'                 =>  'estate_property',
            'post_status'               =>    'publish',
            'nopaging'                  =>    'true',
            'cache_results'             =>    false,
            'update_post_meta_cache'    =>    false,
            'update_post_term_cache'    =>    false,
           );	
    }

    
    if( intval($id_array)!=0 ){
        $args=  array(  'post_type'     => 'estate_property',
                        'p'           =>    $id_array
                );
        $prop_selection =   new WP_Query( $args);
    }else{
        if( !empty($keyword) ){
            add_filter( 'posts_where', 'wpestate_title_filter', 10, 2 );
        }
    
        $prop_selection = new WP_Query($args);

        if( !empty($keyword) ){
            remove_filter( 'posts_where', 'wpestate_title_filter', 10, 2 );
        }
    }
    
   
    
    wp_reset_query(); 


    $custom_advanced_search = get_option('wp_estate_custom_advanced_search','');
    $show_slider_price      = get_option('wp_estate_show_slider_price','');
    $has_slider         =   0; 


    $markers    =   wpestate_listing_pins_marker_creation($prop_selection);

    wp_suspend_cache_addition(false);
    wp_reset_query(); 
    if (get_option('wp_estate_readsys','')=='yes' && $jump==0){
        $path=estate_get_pin_file_path();
        file_put_contents($path, json_encode($markers)); 
    } else{

        return json_encode($markers);
    }
}
endif; // end   wpestate_listing_pins  


////////////////////////////////////////////////////////////////////////////////
/// google map functions - pin Images array creation
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('wpestate_pin_images') ):
 
function wpestate_pin_images(){
    $pins           =   array();
    $taxonomy       =   'property_action_category';
    $tax_terms      =   get_terms($taxonomy);
    $taxonomy_cat   =   'property_category';
    $categories     =   get_terms($taxonomy_cat);
    
    foreach ($tax_terms as $tax_term) {
        $name                    =  sanitize_key( wpestate_limit64('wp_estate_'.$tax_term->slug) );
        $limit54                 =  sanitize_key( wpestate_limit54($tax_term->slug));
        $pins[$limit54]          =  esc_html( get_option($name) ); 
    }
    
    foreach ($categories as $categ) {
        $name                           =   sanitize_key ( wpestate_limit64('wp_estate_'.$categ->slug) );
        $limit54                        =   sanitize_key(wpestate_limit54($categ->slug));
        $pins[$limit54]                 =   esc_html( get_option($name) );
    }
    

    foreach ($tax_terms as $tax_term) {
        foreach ($categories as $categ) {           
            $limit54                    =   sanitize_key ( wpestate_limit27($categ->slug)).sanitize_key(wpestate_limit27($tax_term->slug) );
            $name                       =   'wp_estate_'.$limit54;
            $pins[$limit54]              =   esc_html( get_option($name) ) ;  
        }
    }
    
    $name='wp_estate_idxpin';
    $pins['idxpin']=esc_html( get_option($name) );  
    
    $name='wp_estate_userpin';
    $pins['userpin']=esc_html( get_option($name) );  
    

    return json_encode($pins);
}
endif; // end   wpestate_pin_images 





if( !function_exists('wpestate_limit64') ): 
    function wpestate_limit64($stringtolimit){
        return mb_substr($stringtolimit,0,64);
    }
endif;


if( !function_exists('wpestate_limit54') ): 
    function wpestate_limit54($stringtolimit){
        return mb_substr($stringtolimit,0,54);
    }
endif;

if( !function_exists('wpestate_limit50') ): 
    function wpestate_limit50($stringtolimit){ // 14
        return mb_substr($stringtolimit,0,50);
    }
endif;

if( !function_exists('wpestate_limit45') ): 
    function wpestate_limit45($stringtolimit){ // 19
        return mb_substr($stringtolimit,0,45);
    }
endif;

if( !function_exists('wpestate_limit27') ): 
    function wpestate_limit27($stringtolimit){ // 27
        return mb_substr($stringtolimit,0,27);
    }
endif;

?>