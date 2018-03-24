<?php



if( !function_exists('wpestate_estate_property_design_agent_details_intext_details') ):
function wpestate_estate_property_design_agent_details_intext_details($attributes,$content = null){
    global $post;
    global $propid;
    $return_string  =   '';
    $maxwidth       =   '';
    $margin         =   '';
    $image_no       =   '';
    $css_class      =   '';
    $detail='';
    $detail =$content;
    
    extract(shortcode_atts(array(
            'css'              =>   '',
    ), $attributes));
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );
    
    $agent_id       = intval( get_post_meta($propid, 'property_agent', true) );
    $author_id      = wpsestate_get_author($propid);
    
    $agent_single_details = array(
        'Name'          =>  'name',
        'Description'   =>  'description',
        'Main Image'    =>  'image',
        'Page Link'     =>  'page_link',
        'Agent Skype'   =>  'agent_skype',
        'Agent Phone'   =>  'agent_phone',
        'Agent Mobile'  =>  'agent_mobile',
        'Agent email'   =>  'agent_email',
        'Agent position'                =>  'agent_position',
        'Agent Facebook'                =>  'agent_facebook',
        'Agent Twitter'                 =>  'agent_twitter',
        'Agent Linkedin'                => 'agent_linkedin',
        'Agent Pinterest'               => 'agent_pinterest',
        'Agent Instagram'               => 'agent_instagram',
        'Agent Website'                 => 'agent_website',
        'Agent Category'                => 'property_category_agent', 
        'Agent action category'         => 'property_action_category_agent', 
        'Agent city category'           => 'property_city_agent',
        'Agent Area category'           => 'property_area_agent',
        'Agent County/State category'   => 'property_county_state_agent'
    );
    preg_match_all("/\{[^\}]*\}/", $detail, $matches);
    $return_string =    '<div class="wpestate_estate_property_design_agent_details_intext_details '.$css_class.'"> '; 

        
    foreach($matches[0] as $key=>$value){
       
        $element=    substr($value, 1);
        $element=    substr($element, 0, -1);
     
        if($element =='name'){
            $replace=get_the_title($agent_id);
        }else if($element =='description'){
            //$replace=get_the_content($agent_id);
            ob_start();
            $page_object = get_post( $agent_id );
            echo $page_object->post_content;
            $replace=  ob_get_contents();
            ob_end_clean();
            
        }else if($element =='image'){
            $thumb_id           = get_post_thumbnail_id($agent_id);
            $preview            = wp_get_attachment_image_src(get_post_thumbnail_id($agent_id), 'property_listings');
            $preview_img        = $preview[0];
            $replace            = '<img src="'.$preview_img.'" alt="'.get_the_title($agent_id).'">';
        }else if($element =='page_link'){
            $replace=get_the_permalink($agent_id);
        }else if($element =='property_category_agent' || $element =='property_action_category_agent' || $element =='property_city_agent' || $element =='property_area_agent' || $element =='property_county_state_agent'){
            $replace=  get_the_term_list($agent_id, $element, '', ', ', '') ;
        }else{
            $replace        =esc_html( get_post_meta($agent_id, $element, true) );
        }
            
     
        $detail=str_replace($value,$replace,$detail);
    }
    
    

    $return_string .=  do_shortcode( $detail ).'</div>'; 
    return $return_string;
    
    
    
    
}
endif;





if( !function_exists('wpestate_estate_property_design_gallery') ):
function wpestate_estate_property_design_gallery($attributes,$content = null){
    global $post;
    global $propid;
    $return_string  =   '';
    $maxwidth       =   '';
    $margin         =   '';
    $image_no       =   '';
    $css_class      =   '';

    extract(shortcode_atts(array(
            'css'              =>   '',
            'maxwidth'         =>   '200',
            'margin'           =>   '10',
            'image_no'         =>   '4'
    ), $attributes));
    
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );
    
 
   
    
    $counter_lightbox=0;
    $arguments      = array(
                'numberposts'       =>  $image_no,
                'post_type'         =>  'attachment',
                'posts_per_page'    =>  -1, 
                'post_mime_type'    =>  'image',
                'post_parent'       =>  $propid,
                'post_status'       =>  'any',            
                'orderby'           =>  'menu_order',
                'order'             =>  'ASC'
            );
    $post_attachments   = get_posts($arguments);
   
    $counter_lightbox++;  
    $return_string.='<ul class="wpestate_estate_property_design_gallery '.$css_class.'" style="margin:0px -'.$margin.'px;padding: 0px '.($margin/2).'px;">';
            $thumb_id           =   get_post_thumbnail_id($propid);
            $preview            =   wp_get_attachment_image_src($thumb_id, 'property_listings');
            $full_prty          =   wp_get_attachment_image_src($thumb_id, 'full');
            $return_string.= '<li class="" style="margin:0px '.($margin/2).'px '.$margin.'px '.($margin/2).'px;">
                            <a href="'.$full_prty[0].'"  title="'.get_post($thumb_id)->post_excerpt.'"  alt="'.get_post($thumb_id)->post_excerpt.'" rel="prettyPhoto" class="prettygalery" > 
                                <img class="lightbox_trigger" data-slider-no="'.$counter_lightbox.'"  src="'.$preview[0].'"  style="max-width:'.$maxwidth.'px;" />
                            </a>
                            </li>';
       
    foreach ($post_attachments as $attachment) {
            $counter_lightbox++;
            $preview            = wp_get_attachment_image_src($attachment->ID, 'property_listings');
            $full_prty          = wp_get_attachment_image_src($attachment->ID, 'full');

            $return_string.= '<li class="" style="margin:0px '.($margin/2).'px '.$margin.'px '.($margin/2).'px;">
                            <a href="'.$full_prty[0].'" rel="prettyPhoto" class="prettygalery"  title="'.$attachment->post_excerpt.'"  > 
                                <img  class="lightbox_trigger" data-slider-no="'.$counter_lightbox.'"  src="'.$preview[0].'" alt="'.$attachment->post_excerpt.'" style="max-width:'.$maxwidth.'px;" />
                            </a>
                            </li>';
                      
    }// end foreach
    $return_string.='</ul>';
    return $return_string;    
}
endif;





    



if( !function_exists('wpestate_estate_property_design_intext_details') ):
function wpestate_estate_property_design_intext_details($attributes,$content=''){
    
    
    global $post;
    global $propid;
    $return_string='';
    $detail='';
    $detail =$content;
    $css = '';

    extract(shortcode_atts(array(
    'css' => ''
    ), $attributes));
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );
    

    $feature_list       =   esc_html( get_option('wp_estate_feature_list') );
    $feature_list_array =   explode( ',',$feature_list);
    $features_details   =   array();
    
    foreach($feature_list_array as $key => $value){
        $post_var_name      =   str_replace(' ','_', trim($value) );
        $input_name         =   wpestate_limit45(sanitize_title( $post_var_name ));
        $input_name         =   sanitize_key($input_name);
        $features_details[$value] =      $input_name;
    }
  
    
    
    
    preg_match_all("/\{[^\}]*\}/", $detail, $matches);
    //var_dump($matches[0]);   
    
    $return_string =    '<div class="wpestate_estate_property_design_intext_details '.$css_class.'"> '; 

        
    foreach($matches[0] as $key=>$value){
        // $element =   substr($value,  1);
        $element    =    substr($value, 1);
        $element    =    substr($element, 0, -1);
        //$return_string.=  $value.'/'.$element.'*';
        
        if(in_array ($element,$features_details) ){

            $get_value= intval(get_post_meta($propid,$element,true));
            if($get_value==1){
                $replace='yes';
            }else{
                $replace='no';
            }
        }else{
            if($element =='prop_id'){
                $replace=$propid;
            }else if($element =='prop_url'){
                $replace=get_permalink($propid);
            }else if($element =='favorite_action'){
                $current_user               = wp_get_current_user();
                $userID                     =   $current_user->ID;
                $user_option                =   'favorites'.$userID;
                $curent_fav                 =   get_option($user_option);
                $favorite_class             =   'isnotfavorite'; 
                $favorite_text              =   __('add to favorites','wpestate');
                if($curent_fav){
                    if ( in_array ($propid,$curent_fav) ){
                        $favorite_class =   'isfavorite';     
                        $favorite_text  =   __('favorite','wpestate');
                    } 
                }


                $replace='<span id="add_favorites" class="'.esc_html($favorite_class).'" data-postid="'.$propid.'">'.$favorite_text.'</span>';
            }else if($element =='property_status'){
                $replace= get_post_meta($propid,$element,true);
                if($replace=='normal'){
                    $replace='';
                }
            }else if($element =='page_views'){
                $replace='<span class="no_views dashboad-tooltip" data-original-title="'.__('Number of Page Views','wpestate').'"><i class="fa fa-eye-slash "></i>'.intval( get_post_meta($propid, 'wpestate_total_views', true) ).'</span>';
            }else if($element =='print_action'){
                $replace='<i class="fa fa-print" id="print_page" data-propid="'.$propid.'"></i>';
            }else if($element =='facebook_share'){
                $replace='<a href="http://www.facebook.com/sharer.php?u='.get_the_permalink($propid).'&amp;t='.urlencode(get_the_title($propid)).'" target="_blank" class="share_facebook"><i class="fa fa-facebook fa-2"></i></a>';
            }else if($element =='twiter_share'){
                $replace='<a href="http://twitter.com/home?status='.urlencode(get_the_title($propid).' '.get_the_permalink($propid)).'" class="share_tweet" target="_blank"><i class="fa fa-twitter fa-2"></i></a>';
            }else if($element =='google_share'){
                $replace='<a href="https://plus.google.com/share?url='.get_the_permalink($propid).'" onclick="javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" target="_blank" class="share_google"><i class="fa fa-google-plus fa-2"></i></a>';
            }else if($element =='pinterest_share'){
                
                if (has_post_thumbnail($propid)){
                    $pinterest = wp_get_attachment_image_src(get_post_thumbnail_id($propid),'property_full_map');
                }


                $replace='<a href="http://pinterest.com/pin/create/button/?url='.get_the_permalink($propid).'&amp;media='.esc_url($pinterest[0]).'&amp;description='.urlencode(get_the_title($propid)).'" target="_blank" class="share_pinterest"> <i class="fa fa-pinterest fa-2"></i> </a>'; 
            }else if($element=='title'){
               $replace=get_the_title($propid);
            }else if($element =='property_price'){
                $currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
                $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
                $replace = wpestate_show_price($propid,$currency,$where_currency,1);  
                
            }else if($element =='description'){
                $replace= estate_listing_content($propid);
            }else if($element =='property_category' || $element =='property_action_category' || $element =='property_city' || $element =='property_area' || $element =='property_county_state' ){
                $replace=  get_the_term_list($propid, $element, '', ', ', '') ;
            }else{
                $meta_value = get_post_meta($propid,$element,true);
                $replace = apply_filters( 'wpml_translate_single_string', $meta_value, 'wpestate', 'wp_estate_property_custom_s_'.$meta_value );
           
            
              //  $replace= get_post_meta($propid,$element,true);
            }
            
        }
      

        $detail=str_replace($value,$replace,$detail);
    }
    
    

    $return_string .=  do_shortcode( $detail ).'</div>'; 
    return $return_string;
}
endif;




if( !function_exists('wpestate_estate_property_design_related_listings') ):
function wpestate_estate_property_design_related_listings($attributes,$content = null){
    
    global $post;
    global $propid;
   
    $return_string =    '<div class="wpestate_estate_property_design_related_listings">'; 
    $return_string .=   wpestate_show_related_listings($propid);
    $return_string .=   '</div>'; 
    return $return_string;
}
endif;









if( !function_exists('wpestate_estate_property_design_agent_contact') ):
function wpestate_estate_property_design_agent_contact($attributes,$content = null){
    
    global $post;
    global $propid;
    global $prop_id;
    $css_class='';
    
    extract(shortcode_atts(array(
        'css' => '',
    ), $attributes));
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );

   
    
    
    $return_string ='<div class="wpestate_estate_property_design_agent  '.$css_class.'">'; 
    
    
    $agent_id   = intval( get_post_meta($propid, 'property_agent', true) );
    $prop_id    = $propid;  
    $author_id           =  wpsestate_get_author($propid);
    
    $contact_form_7_agent   =   stripslashes( ( get_option('wp_estate_contact_form_7_agent','') ) );
    $contact_form_7_contact =   stripslashes( ( get_option('wp_estate_contact_form_7_contact','') ) );
    if (function_exists('icl_translate') ){
        $contact_form_7_agent     =   icl_translate('wpestate','contact_form7_agent', $contact_form_7_agent ) ;
        $contact_form_7_contact   =   icl_translate('wpestate','contact_form7_contact', $contact_form_7_contact ) ;
    }
    
    
    $return_string .='<div class="agent_contanct_form">';
        
    $return_string .=' <h4 id="show_contact">'.__('Contact Me', 'wpestate').'</h4>';
  
    
    
                
    if ( $contact_form_7_agent==''){ 

        $return_string .='
        <div class="alert-box error">
          <div class="alert-message" id="alert-agent-contact"></div>
        </div> 


        <input name="contact_name" id="agent_contact_name" type="text"  placeholder="'. __('Your Name', 'wpestate').'" aria-required="true" class="form-control">
        <input type="text" name="email" class="form-control" id="agent_user_email" aria-required="true" placeholder="'.__('Your Email', 'wpestate').'" >
        <input type="text" name="phone"  class="form-control" id="agent_phone" placeholder="'.__('Your Phone', 'wpestate').'" >
        <textarea id="agent_comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" placeholder="'. __('Your Message', 'wpestate').'" ></textarea>	
        <input type="submit" class="wpresidence_button agent_submit_class"  id="agent_submit" value="'. __('Send Message', 'wpestate').'">

        <input name="prop_id" type="hidden"  id="agent_property_id" value="'.intval($propid).'">
        <input name="prop_id" type="hidden"  id="agent_id" value="'.intval($agent_id).'">
        <input type="hidden" name="contact_ajax_nonce" id="agent_property_ajax_nonce"  value="'. wp_create_nonce( 'ajax-property-contact' ).'" />';

       
    }else{
        ob_start();
        echo do_shortcode($contact_form_7_agent);
        $temp=  ob_get_contents();
        ob_end_clean();
        $return_string .=$temp;
    }
   
    $return_string .='</div>';
    $return_string .='</div>';
    return $return_string;
}
endif;




if( !function_exists('wpestate_estate_property_design_agent') ):
function wpestate_estate_property_design_agent($attributes,$content = null){
    global $post;
    global $propid;
    global $prop_id;
    global $agent_urlc;
    global $link;
    extract(shortcode_atts(array(
    'css' => '',
    'columns'=> 'one column'
    ), $attributes));
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );

    if( $columns =="one column"){
        $css_class .=" property_desing_agent_one_col ";
    }
    $return_string ='<div class="wpestate_estate_property_design_agent '.$css_class.'">'; 
    
    
    $agent_id   = intval( get_post_meta($propid, 'property_agent', true) );
    $prop_id    = $propid;  
    $author_id           =  wpsestate_get_author($propid);
    ob_start();
    if ($agent_id!=0 && 'estate_agent' ===get_post_type ($agent_id) ){                        
         
           
            $thumb_id       = '';
            $preview_img    = '';
            $agent_skype    = '';
            $agent_phone    = '';
            $agent_mobile   = '';
            $agent_email    = '';
            $agent_pitch    = '';
            $link           = '';
            $name           = 'No agent';

       
            $thumb_id            = get_post_thumbnail_id($agent_id);
            $preview             = wp_get_attachment_image_src(get_post_thumbnail_id($agent_id), 'property_listings');
            $preview_img         = $preview[0];
            $agent_skype         = esc_html( get_post_meta($agent_id, 'agent_skype', true) );
            $agent_phone         = esc_html( get_post_meta($agent_id, 'agent_phone', true) );
            $agent_mobile        = esc_html( get_post_meta($agent_id, 'agent_mobile', true) );
            $agent_email         = esc_html( get_post_meta($agent_id, 'agent_email', true) );
            if($agent_email==''){
                $agent_email=$author_email;
            }
            $agent_pitch         = esc_html( get_post_meta($agent_id, 'agent_pitch', true) );

            $agent_posit        = esc_html( get_post_meta($agent_id, 'agent_position', true) );

            $agent_facebook      = esc_html( get_post_meta($agent_id, 'agent_facebook', true) );
            $agent_twitter       = esc_html( get_post_meta($agent_id, 'agent_twitter', true) );
            $agent_linkedin      = esc_html( get_post_meta($agent_id, 'agent_linkedin', true) );
            $agent_pinterest     = esc_html( get_post_meta($agent_id, 'agent_pinterest', true) );
            $agent_instagram     = esc_html( get_post_meta($agent_id, 'agent_instagram', true) );
            $agent_urlc          = esc_html( get_post_meta($agent_id, 'agent_website', true) );
            $link                = get_permalink($agent_id);
            $name                = get_the_title($agent_id);
  
    }   // end if !=0
    else{  
           
           if ( get_the_author_meta('user_level',$author_id) !=10){

                $preview_img    =   get_the_author_meta( 'custom_picture',$author_id  );
                if($preview_img==''){
                    $preview_img=get_template_directory_uri().'/img/default-user.png';
                }

                $agent_skype         = get_the_author_meta( 'skype' ,$author_id );
                $agent_phone         = get_the_author_meta( 'phone' ,$author_id );
                $agent_mobile        = get_the_author_meta( 'mobile' ,$author_id );
                $agent_email         = get_the_author_meta( 'user_email',$author_id  );
                $agent_pitch         = '';
                $agent_posit         = get_the_author_meta( 'title',$author_id  );
                $agent_facebook      = get_the_author_meta( 'facebook',$author_id  );
                $agent_twitter       = get_the_author_meta( 'twitter' ,$author_id );
                $agent_linkedin      = get_the_author_meta( 'linkedin',$author_id  );
                $agent_pinterest     = get_the_author_meta( 'pinterest',$author_id  );
                $agent_instagram     = get_the_author_meta( 'instagram' ,$author_id );
                $agent_urlc          = get_the_author_meta( 'website',$author_id  );
                $link                = '';
                $name                = get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name');;
            }
    }
    
   
    include( locate_template('templates/agentdetails.php'));
    
    $return_string .=  ob_get_contents();
    ob_end_clean();
    $return_string .='</div>';
    return $return_string;
    
}
endif;











if( !function_exists('wpestate_estate_property_slider_section') ):
function wpestate_estate_property_slider_section($attributes,$content = null){
    global $post;
    global $propid ;
    
    $return_string  ='';
    $detail         ='';
    $label          ='';
    
    extract(shortcode_atts(array(
        'css'       =>  '',
        'detail'    =>  'horizontal',
        'showmap'   =>  'no'
        ), $attributes));
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );

    
    
    if ( isset($attributes['detail']) ){
        $detail  = $attributes['detail'];
    }
    
    if($detail==='horizontal'){
        return '<div class="wpestate_estate_property_slider_section_wrapper '.$css_class.' ">'.wpestate_shortcode_listing_slider($propid,$showmap).'</div>';
    }else{
        return '<div class="wpestate_estate_property_slider_section_wrapper '.$css_class.'">'.wpestate_shortcode_listing_slider_vertical($propid,$showmap).'</div>';
    }
}
endif;







function wpestate_shortcode_listing_slider_vertical($propid,$showmap){
    $return_string  =   '';
    global $slider_size;
    $video_id       =   '';
    $video_thumb    =   '';
    $video_alone    =   0;
    $full_img       =   '';
    $arguments      = array(
                        'numberposts' => -1,
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'post_parent' => $propid,
                        'post_status' => null,
                        'exclude' => get_post_thumbnail_id($propid),
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );

    $post_attachments   = get_posts($arguments);
    $video_id           = esc_html( get_post_meta($propid, 'embed_video_id', true) );
    $video_type         = esc_html( get_post_meta($propid, 'embed_video_type', true) );
      
    $prop_stat = esc_html( get_post_meta($propid, 'property_status', true) );    
    if (function_exists('icl_translate') ){
        $prop_stat     =   icl_translate('wpestate','wp_estate_property_status_'.$prop_stat, $prop_stat ) ;                                      
    }
    $ribbon_class       = str_replace(' ', '-', $prop_stat);    
        
     
    if ($post_attachments || has_post_thumbnail($propid) || get_post_meta($propid, 'embed_video_id', true)) {
   
        $return_string.='
        <div id="carousel-listing" class="carousel slide post-carusel carouselvertical" data-ride="carousel" data-interval="false">';
       
        if($prop_stat!='normal'){
            $return_string.= '<div class="slider-property-status verticalstatus ribbon-wrapper-'.$ribbon_class.' '.$ribbon_class.'">' . $prop_stat . '</div>';
        }
     
        $indicators         ='';
        $round_indicators   ='';
        $slides             ='';
        $captions           ='';
        $counter            =0;
        $counter_lightbox   =0;
        $has_video          =0;
        if($video_id!=''){
            $has_video  =   1; 
            $counter    =   1;
            $videoitem  =   'videoitem';
            if ($slider_size    ==  'full'){
                $videoitem  =  'videoitem_full';
            }
          
            
            $indicators.='<li data-target="#carousel-listing"  data-video_data="'.$video_type.'" data-video_id="'.$video_id.'"  data-slide-to="0" class="active video_thumb_force">
                         <img src= "'.get_video_thumb($propid).'" alt="video_thumb" class="img-responsive"/>
                         <span class="estate_video_control"><i class="fa fa-play"></i> </span>
                         </li>'; 

            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="0" class="active"></li>';

            $slides .= '<div class="item active '.$videoitem.'">';

             if($video_type=='vimeo'){
                 $slides .= custom_vimdeo_video($video_id);
             }else{
                  $slides.= custom_youtube_video($video_id);
             }

             $slides   .= '</div>';
             $captions .= '<span data-slide-to="0" class="active" >'.__('Video','wpestate').'</span>';
        }

        if( has_post_thumbnail($propid) ){
            $counter++;
            $counter_lightbox++;
            $active='';
            if($counter==1 && $has_video!=1){
                $active=" active ";
            }else{
                $active=" ";
            }

            $post_thumbnail_id  = get_post_thumbnail_id($propid );
            $preview            = wp_get_attachment_image_src($post_thumbnail_id, 'slider_thumb');
            
            if ($slider_size=='full'){
                $full_img           = wp_get_attachment_image_src($post_thumbnail_id, 'listing_full_slider_1');
            }else{
                $full_img           = wp_get_attachment_image_src($post_thumbnail_id, 'listing_full_slider');
            }
          
            $full_prty          = wp_get_attachment_image_src($post_thumbnail_id, 'full');
            $attachment_meta    = wp_get_attachment($post_thumbnail_id);
    
            $indicators.= '<li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'">
                                <img  src="'.$preview[0].'"  alt="slider" />
                           </li>';

            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'" ></li>';
            $slides .= '<div class="item '.$active.' ">
                           <a href="'.$full_prty[0].'" title="'.get_post($post_thumbnail_id)->post_excerpt.'"  rel="prettyPhoto" class="prettygalery"> 
                                <img  src="'.$full_img[0].'" data-slider-no="'.$counter_lightbox.'" alt="'.$attachment_meta['alt'].'" class="img-responsive lightbox_trigger" />
                           </a>
                        </div>';

            $captions .= '<span data-slide-to="'.($counter-1).'" class="'.$active.'" >'. $attachment_meta['caption'].'</span>';

        }



        foreach ($post_attachments as $attachment) {
            $counter++;
            $counter_lightbox++;
            $active='';
            if($counter==1 && $has_video!=1){
                $active=" active ";
            }else{
                $active=" ";
            }

            $preview            = wp_get_attachment_image_src($attachment->ID, 'slider_thumb');
            if ($slider_size=='full'){
                $full_img           = wp_get_attachment_image_src($attachment->ID, 'listing_full_slider_1');
            }else{
                $full_img           = wp_get_attachment_image_src($attachment->ID, 'listing_full_slider');
            }
            $full_prty          = wp_get_attachment_image_src($attachment->ID, 'full');
            $attachment_meta    = wp_get_attachment($attachment->ID);

            $indicators.= ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'">
                                <img  src="'.$preview[0].'"  alt="slider" />
                            </li>';
            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'"></li>';

            $slides .= '<div class="item '.$active.'">
                        <a href="'.$full_prty[0].'" rel="prettyPhoto" class="prettygalery" title="'.$attachment_meta['caption'].'"  > 
                            <img  src="'.$full_img[0].'" data-slider-no="'.$counter_lightbox.'"  alt="'.$attachment_meta['alt'].'"  class="img-responsive lightbox_trigger" />
                         </a>
                        </div>';

            $captions .= '<span data-slide-to="'.($counter-1).'" class="'.$active.'">'. $attachment_meta['caption'].'</span>';                    
        }// end foreach
    
        $header_type                =   get_post_meta ( $propid, 'header_type', true);
        $global_header_type         =   get_option('wp_estate_header_type','');

 
        if ( $header_type == 0 ){ // global
            if ($global_header_type != 4){
                $gmap_lat                   =   esc_html( get_post_meta($propid, 'property_latitude', true));
                $gmap_long                  =   esc_html( get_post_meta($propid, 'property_longitude', true));
                $property_add_on            =   ' data-post_id="'.$propid.'" data-cur_lat="'.$gmap_lat.'" data-cur_long="'.$gmap_long.'" ';

                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_map" data-placement="bottom" data-original-title="'.__('Map','wpestate').'">  <i class="fa fa-map-marker"></i>        </div>';
                }

                $no_street=' no_stret ';
                if ( $showmap=='yes' && get_post_meta($propid, 'property_google_view', true) ==1){
                    $return_string.='  <div id="a"> <i class="fa fa-location-arrow"></i>    </div>';
                    $no_street='';
                }
                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_slider" data-placement="bottom" data-original-title="'.__('Image Gallery','wpestate').'" class="slideron '.$no_street.'"><i class="fa fa-picture-o"></i>         </div>
                    <div id="gmapzoomplus"  class="smallslidecontrol"><i class="fa fa-plus"></i> </div>
                    <div id="gmapzoomminus" class="smallslidecontrol"><i class="fa fa-minus"></i></div>';
                    $return_string.='<div id="googleMapSlider" '.$property_add_on.' ></div>';              
                }
            }

            
        }else{
            if($header_type!=5){
                $gmap_lat                   =   esc_html( get_post_meta($propid, 'property_latitude', true));
                $gmap_long                  =   esc_html( get_post_meta($propid, 'property_longitude', true));
                $property_add_on            =   ' data-post_id="'.$propid.'" data-cur_lat="'.$gmap_lat.'" data-cur_long="'.$gmap_long.'" ';
               
                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_map" data-placement="bottom" data-original-title="'.__('Map','wpestate').'">    <i class="fa fa-map-marker"></i>        </div>';
                }

                $no_street=' no_stret ';

                if (  $showmap=='yes' && get_post_meta($propid, 'property_google_view', true) ==1){
                    $return_string.= '  <div id="slider_enable_street" data-placement="bottom" data-original-title="'.__('Street View','wpestate').'"> <i class="fa fa-location-arrow"></i>    </div>';
                    $no_street  ='';
                }

                if($showmap=='yes'){    
                    $return_string.='<div id="slider_enable_slider" data-placement="bottom" data-original-title="'.__('Image Gallery','wpestate').'" class="slideron '.$no_street.'"> <i class="fa fa-picture-o"></i></div>
                    <div id="gmapzoomplus"  class="smallslidecontrol" ><i class="fa fa-plus"></i> </div>
                    <div id="gmapzoomminus" class="smallslidecontrol" ><i class="fa fa-minus"></i></div>';

                    $return_string.='<div id="googleMapSlider" '.$property_add_on.' ></div>'; 
                }

                
            }
                 
        }
    
       
   
    $return_string.='
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        '.$slides.'
    </div>

    <!-- Indicators -->    
    <!-- <div class="carusel-back"></div>  -->
    <ol  id="carousel-indicators-vertical">
        '.$indicators.'
    </ol>

    <!--
    <ol class="carousel-round-indicators">
       '.$round_indicators.'
    </ol> 
    -->

    <div class="caption-wrapper vertical-wrapper">   
        <div class="vertical-wrapper-back"></div>  
        '.$captions.'
     <!--   <div class="caption_control"></div> -->
    </div>  

    <!-- Controls -->
    <a class="left vertical carousel-control" href="#carousel-listing" data-slide="prev">
      <i class="fa fa-angle-left"></i>
    </a>
    <a class="right vertical carousel-control" href="#carousel-listing" data-slide="next">
      <i class="fa fa-angle-right"></i>
    </a>
    </div>';


    } // end if post_attachments
    
    return $return_string;
}





















function wpestate_shortcode_listing_slider($propid,$showmap){
    global $slider_size;
    $return_string  =   '';
    $video_id       =   '';
    $video_thumb    =   '';
    $video_alone    =   0;
    $counter_lightbox   =   0;
    $full_img       =   '';
    $arguments      = array(
                        'numberposts' => -1,
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'post_parent' => $propid,
                        'post_status' => null,
                        'exclude' => get_post_thumbnail_id($propid),
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );

    $post_attachments   = get_posts($arguments);

    $video_id           = esc_html( get_post_meta($propid, 'embed_video_id', true) );
    $video_type         = esc_html( get_post_meta($propid, 'embed_video_type', true) );

    $prop_stat = esc_html( get_post_meta($propid, 'property_status', true) );    
    if (function_exists('icl_translate') ){
        $prop_stat     =   icl_translate('wpestate','wp_estate_property_status_'.$prop_stat, $prop_stat ) ;                                      
    }
    $ribbon_class       = str_replace(' ', '-', $prop_stat);    
        
        
    if ($post_attachments || has_post_thumbnail($propid) || get_post_meta($propid, 'embed_video_id', true)) {   
        $return_string.='<div id="carousel-listing" class="carousel slide post-carusel" data-ride="carousel" data-interval="false">';
           
        if($prop_stat!='normal'){
            $return_string.= '<div class="slider-property-status ribbon-wrapper-'.$ribbon_class.' '.$ribbon_class.'">' . $prop_stat . '</div>';
        }
        
        $indicators='';
        $round_indicators='';
        $slides ='';
        $captions='';
        $counter=0;
        $has_video=0;
        
        if($video_id!=''){
            $has_video  =   1; 
            $counter    =   1;
            $videoitem  =   'videoitem';
            if ($slider_size    ==  'full'){
                $videoitem  =  'videoitem_full';
            }


            $indicators.='<li data-target="#carousel-listing"  data-video_data="'.$video_type.'" data-video_id="'.$video_id.'"  data-slide-to="0" class="active video_thumb_force">
                         <img src= "'.get_video_thumb($propid).'" alt="video_thumb" class="img-responsive"/>
                         <span class="estate_video_control"><i class="fa fa-play"></i> </span>
                         </li>'; 

            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="0" class="active"></li>';

            $slides .= '<div class="item active '.$videoitem.'">';

            if($video_type=='vimeo'){
                $slides .= custom_vimdeo_video($video_id);
            }else{
                $slides.= custom_youtube_video($video_id);
            }

            $slides   .= '</div>';
            $captions .= '<span data-slide-to="0" class="active" >'.__('Video','wpestate').'</span>';
        }

        if( has_post_thumbnail($propid) ){
            $counter++;
            $counter_lightbox++;
            $active='';
            if($counter==1 && $has_video!=1){
                $active=" active ";
            }else{
                $active=" ";
            }

            $post_thumbnail_id  = get_post_thumbnail_id( $propid );
            $preview            = wp_get_attachment_image_src($post_thumbnail_id, 'slider_thumb');

            if ($slider_size=='full'){
                $full_img           = wp_get_attachment_image_src($post_thumbnail_id, 'listing_full_slider_1');
            }else{
                $full_img           = wp_get_attachment_image_src($post_thumbnail_id, 'listing_full_slider');
            }

            $full_prty          = wp_get_attachment_image_src($post_thumbnail_id, 'full');
            $attachment_meta    = wp_get_attachment($post_thumbnail_id);

            $indicators.= '<li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'">
                                <img  src="'.$preview[0].'"  alt="slider" />
                           </li>';

            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'" ></li>';
            $slides .= '<div class="item '.$active.' ">
                           <a href="'.$full_prty[0].'" title="'.get_post($post_thumbnail_id)->post_excerpt.'"  rel="prettyPhoto" class="prettygalery"> 
                                <img  src="'.$full_img[0].'" data-slider-no="'.$counter_lightbox.'" alt="'.$attachment_meta['alt'].'" class="img-responsive lightbox_trigger" />
                           </a>
                        </div>';

            $captions .= '<span data-slide-to="'.($counter-1).'" class="'.$active.'" >'. $attachment_meta['caption'].'</span>';

        }



        foreach ($post_attachments as $attachment) {
            $counter++;
            $counter_lightbox++;
            $active='';
            if($counter==1 && $has_video!=1){
                $active=" active ";
            }else{
                $active=" ";
            }

            $preview            = wp_get_attachment_image_src($attachment->ID, 'slider_thumb');
            if ($slider_size=='full'){
                $full_img           = wp_get_attachment_image_src($attachment->ID, 'listing_full_slider_1');
            }else{
                $full_img           = wp_get_attachment_image_src($attachment->ID, 'listing_full_slider');
            }
            $full_prty          = wp_get_attachment_image_src($attachment->ID, 'full');
            $attachment_meta    = wp_get_attachment($attachment->ID);

            $indicators.= ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'">
                                <img  src="'.$preview[0].'"  alt="slider" />
                            </li>';
            $round_indicators   .=  ' <li data-target="#carousel-listing" data-slide-to="'.($counter-1).'" class="'. $active.'"></li>';

            $slides .= '<div class="item '.$active.'">
                        <a href="'.$full_prty[0].'" rel="prettyPhoto" class="prettygalery" title="'.$attachment_meta['caption'].'"  > 
                            <img  src="'.$full_img[0].'" data-slider-no="'.$counter_lightbox.'" alt="'.$attachment_meta['alt'].'" class="img-responsive lightbox_trigger" />
                         </a>
                        </div>';

            $captions .= '<span data-slide-to="'.($counter-1).'" class="'.$active.'"> '. $attachment_meta['caption'].'</span>';                    
        }// end foreach
          
        $header_type                =   get_post_meta ( $propid, 'header_type', true);
        $global_header_type         =   get_option('wp_estate_header_type','');

  
  
    if ( $header_type == 0 ){ // global
        if ($global_header_type != 4){
                $gmap_lat                   =   esc_html( get_post_meta($propid, 'property_latitude', true));
                $gmap_long                  =   esc_html( get_post_meta($propid, 'property_longitude', true));
                $property_add_on            =   ' data-post_id="'.$propid.'" data-cur_lat="'.$gmap_lat.'" data-cur_long="'.$gmap_long.'" ';
               
                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_map" data-placement="bottom" data-original-title="'.__('Map','wpestate').'">    <i class="fa fa-map-marker"></i>        </div>';
                }
                
                $no_street=' no_stret ';
                if ( $showmap=='yes' && get_post_meta($post->ID, 'property_google_view', true) ==1){
                    $return_string.= '  <div id="slider_enable_street" data-placement="bottom" data-original-title="'.__('Street View','wpestate').'" > <i class="fa fa-location-arrow"></i>    </div>';
                    $no_street='';
                }
                
                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_slider" data-placement="bottom" data-original-title="'.__('Image Gallery','wpestate').'" class="slideron '.$no_street.'"><i class="fa fa-picture-o"></i>         </div>';
                
                    $return_string.='<div id="gmapzoomplus"  class="smallslidecontrol"><i class="fa fa-plus"></i> </div>
                    <div id="gmapzoomminus" class="smallslidecontrol"><i class="fa fa-minus"></i></div>';
        
                    $return_string.='<div id="googleMapSlider" '.$property_add_on.' > </div>';
                }
                
                
        }
    }else{
        if($header_type!=5){
                $gmap_lat                   =   esc_html( get_post_meta($propid, 'property_latitude', true));
                $gmap_long                  =   esc_html( get_post_meta($propid, 'property_longitude', true));
                $property_add_on            =   ' data-post_id="'.$propid.'" data-cur_lat="'.$gmap_lat.'" data-cur_long="'.$gmap_long.'" ';
                if($showmap=='yes'){
                    $return_string.='<div id="slider_enable_map" data-placement="bottom" data-original-title="'.__('Map','wpestate').'">  <i class="fa fa-map-marker"></i>        </div>';
                }
                 
                $no_street=' no_stret ';
                if ($showmap=='yes' && get_post_meta($propid, 'property_google_view', true) ==1){
                    $return_string.= '  <div id="slider_enable_street" data-placement="bottom" data-original-title="'.__('Street View','wpestate').'" > <i class="fa fa-location-arrow"></i>    </div>';
                    $no_street='';
                }
                
                if($showmap=='yes'){
                    $return_string.='
                    <div id="slider_enable_slider" data-placement="bottom" data-original-title="'.__('Image Gallery','wpestate').'" class="slideron  '.$no_street.'"><i class="fa fa-picture-o"></i>         </div>

                    <div id="gmapzoomplus"  class="smallslidecontrol" ><i class="fa fa-plus"></i> </div>
                    <div id="gmapzoomminus" class="smallslidecontrol" ><i class="fa fa-minus"></i></div>';

                    $return_string.='<div id="googleMapSlider" '.$property_add_on.' ></div> ';
                }
                
               
              
        }
    }
       
     
    $return_string.='
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      '.$slides.'
    </div>

    <!-- Indicators -->    
    <div class="carusel-back"></div>  
    <ol class="carousel-indicators">
      '.$indicators.'
    </ol>

    <ol class="carousel-round-indicators">
       '.$round_indicators.'
    </ol> 

    <div class="caption-wrapper">   
        '.$captions.'
        <div class="caption_control"></div>
    </div>  

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-listing" data-slide="prev">
      <i class="fa fa-angle-left"></i>
    </a>
    <a class="right carousel-control" href="#carousel-listing" data-slide="next">
      <i class="fa fa-angle-right"></i>
    </a>
    </div>';


    } // end if post_attachments
    
    return $return_string;
}






if( !function_exists('wpestate_estate_property_details_section') ):
function wpestate_estate_property_details_section($attributes,$content = null){
    global $post;
    global $propid ;
    
    $return_string  ='';
    $detail         ='';
    $label          ='';
    $css_class      ='';
   
   
    extract(shortcode_atts(array(
            'css'              =>   '',
            'detail'           =>   'none',
            'columns'         =>   '3'
    ), $attributes));
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );
    
 
   

    switch ($detail) {
        case 'Description':
            $return_string.=   estate_listing_content($propid);
            break;
        case  'Property Address':
            $return_string.=   estate_listing_address($propid,$columns);
            break;
         case  'Property Details':
            $return_string.=  estate_listing_details($propid,$columns);
            break;
        
        case  'Amenities and Features':
            $return_string.='<div class="wpestate_estate_property_details_section">'.   estate_listing_features($propid,$columns).'</div>';
            break;
        case  'Map':
            $return_string.=do_shortcode('[property_page_map propertyid="'.$propid.'" istab="1"][/property_page_map]'); 
            $return_string.='<script type="text/javascript">
                //<![CDATA[
                jQuery(document).ready(function(){
                    wpestate_map_shortcode_function();
                });
                //]]>
            </script>';
            
            break;
         case  'Virtual Tour':
            ob_start();
            wpestate_virtual_tour_details($propid);
            $return_string= ob_get_contents();
            ob_end_clean(); 
            break;
        case  'Walkscore':
            ob_start();
            wpestate_walkscore_details($propid);
            $return_string= ob_get_contents();
            ob_end_clean(); 
            break;
        case  'Floor Plans':
            ob_start();
            estate_floor_plan($propid);
            $return_string.=  ob_get_contents();
            ob_end_clean();
            break;
        case  'Page Views':
            $return_string.='<canvas id="myChart"></canvas>';
            $return_string.='<script type="text/javascript">
                //<![CDATA[
                    jQuery(document).ready(function(){
                         wpestate_show_stat_accordion(); 
                    });
               
                //]]>
            </script>';
            break;
    }
    
    return '<div class="wpestate_estate_property_details_section '.$css_class.'">'.$return_string.'</div>';
}
endif;








if( !function_exists('wpestate_estate_property_simple_detail') ):
function wpestate_estate_property_simple_detail($attributes,$content = null){
    global $post;
    global $propid ;
    
    $return_string  ='';
    $detail         ='';
    $label          ='';
    
    $feature_list       =   esc_html( get_option('wp_estate_feature_list') );
    $feature_list_array =   explode( ',',$feature_list);
    $features_details   =   array();
    
    foreach($feature_list_array as $key => $value){
        $post_var_name=  str_replace(' ','_', trim($value) );
        $input_name =   wpestate_limit45(sanitize_title( $post_var_name ));
        $input_name =   sanitize_key($input_name);
        $features_details[$value]=      $input_name;
    }
 
    $attributes = shortcode_atts( 
        array(
            'detail'           =>   'none',
            'label'            =>   'Label:',
           
        ), $attributes );
      

    
    if ( isset($attributes['detail']) ){
        $detail  = $attributes['detail'];
    }
    if ( isset($attributes['label']) ){
        $label  = $attributes['label'];
    }
    
    $return_string.='<div class="property_custom_detail_wrapper"><span class="property_custom_detail_label">'.$label.' </span>';
    if(in_array ($detail,$features_details) ){
        $get_value= intval(get_post_meta($propid,$detail,true));
        if($get_value==1){
            $return_string.='yes';
        }else{
            $return_string.='no';
        }
    }else{
        if($detail=='title'){
            $return_string.=get_the_title($propid);
        }else if($detail =='property_agent'){
             $return_string.=get_the_title(get_post_meta($propid,$detail,true));
        }else if($detail =='property_price'){
            $currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
            $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
            $return_string.= wpestate_show_price($propid,$currency,$where_currency,1);
                          
        }else if($detail =='description'){
            $return_string.= estate_listing_content($propid);
        }else if($detail=='property_status'){
            $status = get_post_meta($propid,$detail,true);
            if($status!='normal'){
                $return_string.=$status;
            }
        }else if( $detail=='property_lot_size' || $detail=='property_size' ){  
            $measure_sys    =   esc_html ( get_option('wp_estate_measure_sys','') ); 
            $return_string.= wpestate_sizes_no_format( get_post_meta($propid,$detail,true) ).' '.$measure_sys.'<sup>2</sup>';
        }else if($detail =='property_category' || $detail =='property_action_category' || $detail =='property_city' || $detail =='property_area' || $detail =='property_county_state' ){
            $return_string .=  get_the_term_list($propid, $detail, '', ', ', '') ;
        }else{
            $meta_value = get_post_meta($propid,$detail,true);
            $meta_value = apply_filters( 'wpml_translate_single_string', $meta_value, 'wpestate', 'wp_estate_property_custom_'.$meta_value );
            $return_string.=$meta_value;
            // $return_string.=get_post_meta($propid,$detail,true);
        }
        
    }
   
    
    $return_string.='</div>';
    return $return_string;
}
endif;









if( !function_exists('wpestate_property_page_design_acc') ):
function wpestate_property_page_design_acc($attributes,$content = null){
    global $post;
    global $propid ;
    $return_string='';
 
    $description        =   '';
    $property_address   =   '';
    $property_details   =   '';
    $amenities_features =   '';    
    $map                =   '';
    $virtual_tour       =   '';
    $walkscore          =   '';
    $floor_plans        =   '';
    $page_views         =   '';
    $style              =   1;
    
    
    extract(shortcode_atts(array(
            'css'                   =>   '',
            'description'           => __("Description","wpestate"),
            'property_address'      => __("Property Address","wpestate"),
            'property_details'      => __("Property Details","wpestate"),
            'amenities_features'    => __("Amenities and Features","wpestate"),
            'map'                   => __("Map","wpestate"),
            'virtual_tour'          => __("Virtual Tour","wpestate"),
            'walkscore'             => __("Walkscore","wpestate"),
            'floor_plans'           => __("Floor Plans","wpestate"),
            'page_views'            => __("Page Views","wpestate"),
            'style'                 => __("all open","wpestate")
    ), $attributes));
    
   
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),'', $attributes );
    
    $return_string.='<div class="'.$css_class.'">';
    $return_string.= estate_property_page_generated_acc($css_class,$propid,$style,$description,$property_address,$property_details,$amenities_features,$map,$virtual_tour,$walkscore,$floor_plans,$page_views);
    $return_string.='</div>';
  
    return $return_string;
}
endif;



if( !function_exists('estate_property_page_generated_acc') ):
function estate_property_page_generated_acc($css_class,$propid,$style,$description,$property_address,$property_details,$amenities_features,$map,$virtual_tour,$walkscore,$floor_plans,$page_views){
    $walkscore_api      =   esc_html ( get_option('wp_estate_walkscore_api','') );
    $show_graph_prop_page   = esc_html( get_option('wp_estate_show_graph_prop_page', '') );
    $random             =   rand(0,99999);
    $return             =   '';
    
    $expand             =   "true";
    $active_class       =   "";
    $active_class_tab   =   " in ";
    
    
    if( $style==__("all closed","wpestate")  ){        
        $expand             =   ' aria-expanded"false" ';
        $active_class       =   " collapsed ";
        $active_class_tab   =   " collapse ";
    }
   
    if(  $style==__("only first one opened","wpestate") ){
        $expand             =   "true";
        $active_class       =   "";
        $active_class_tab   =   " in ";
    }
    
    
    if($description!=''){
        $return.='   
        <div class="panel-group property-panel  " id="accordion_prop_description'.$random.'">
            <div class="panel panel-default">
               <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_description'.$random.'" href="#collapseDesc'.$random.'" class="'.$active_class.'">
                        <h4 class="panel-title">'.$description.'</h4>    
                    </a>
               </div>
               <div id="collapseDesc'.$random.'" class="panel-collapse collapse '.$active_class_tab.' ">
                 <div class="panel-body">';
                    $return.=   estate_listing_content($propid);
                    $return.= '   
                 </div>
               </div>
            </div>            
        </div>';
                    
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
                    
    }
    
    if($property_address!=''){
        $return.= '   
        <div class="panel-group property-panel" id="accordion_prop_addr'.$random.'">
            <div class="panel panel-default">
               <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_addr'.$random.'" href="#collapseTwo'.$random.'" class="'.$active_class.'">
                        <h4 class="panel-title">'.$property_address.'</h4>    
                    </a>
               </div>
               <div id="collapseTwo'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                 <div class="panel-body">
                    '.estate_listing_address($propid).'
                 </div>
               </div>
            </div>            
        </div>';
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }

    if($property_details!=''){
        $return.= '
        <div class="panel-group property-panel" id="accordion_prop_details'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_details'.$random.'" href="#collapseOne'.$random.'" class="'.$active_class.'">
                        <h4 class="panel-title"  id="prop_det">'.$property_details.'  </h4>
                    </a>
                </div>
                <div id="collapseOne'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                  <div class="panel-body">
                  '.estate_listing_details($propid).'
                  </div>
                </div>
            </div>
        </div>';
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    };

    if($amenities_features!=''){
        $return.= '
        <div class="panel-group property-panel" id="accordion_prop_features'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_features'.$random.'" href="#collapseThree'.$random.'" class="'.$active_class.'">
                       <h4 class="panel-title" id="prop_ame">'. $amenities_features.'</h4>
                    </a>
                </div>
                <div id="collapseThree'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                    <div class="panel-body">
                    '.estate_listing_features($propid).'
                    </div>
                </div>
            </div>
        </div> ';
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }


    if($map!=''){
        $tab_flag=1;
        if($style==__("all open","wpestate")){
             $tab_flag=2;
        }
        $return.='
        <div class="panel-group property-panel" id="accordion_prop_map'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_map'.$random.'" href="#collapsemap'.$random.'" class="shacctab '.$active_class.'">
                        <h4 class="panel-title" id="prop_ame">'.$map.'</h4>
                    </a>
                </div>
                <div id="collapsemap'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                  <div class="panel-body">'
                    .do_shortcode('[property_page_map propertyid="'.$propid.'" istab="'.$tab_flag.'"][/property_page_map]').
                  '</div>
                </div>
            </div>
        </div>';
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
      
    }

  
    if($virtual_tour!=''){
        $return.='
        <div class="panel-group property-panel" id="accordion_virtual_tour'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_virtual_tour'.$random.'" href="#collapseNine'.$random.'" class="'.$active_class.'">
                        <h4 class="panel-title" id="prop_ame">'.$virtual_tour.'</h4>
                    </a>
                </div>

                <div id="collapseNine'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                    <div class="panel-body">';
                        $temp='';
                        if ( $virtual_tour!=''){
                            ob_start();
                            wpestate_virtual_tour_details($propid);
                            $temp=ob_get_contents();
                            ob_end_clean();
                        }
                      $return.=$temp.'  
                    </div>
                </div>
            </div>
        </div>';  
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }




    $walkscore_api= esc_html ( get_option('wp_estate_walkscore_api','') );

    if($walkscore!=''){
        $return.='
        <div class="panel-group property-panel" id="accordion_walkscore'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_walkscore'.$random.'" href="#collapseFour'.$random.'" class="'.$active_class.'">
                        <h4 class="panel-title" id="prop_ame">'.$walkscore.'</h4>
                    </a>
                </div>

                <div id="collapseFour'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                    <div class="panel-body">';
                        $temp='';
                        if ( $walkscore_api!=''){
                            ob_start();
                            wpestate_walkscore_details($propid);
                            $temp=ob_get_contents();
                            ob_end_clean();
                        }
                      $return.=$temp.'  
                    </div>
                </div>
            </div>
        </div>';  
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }



       



    if ( $floor_plans!='' ){ 
        $return.='    
        <div class="panel-group property-panel" id="accordion_prop_floor_plans'.$random.'">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_floor_plans'.$random.'" href="#collapseflplan'.$random.'" class="'.$active_class.'">
                       <h4 class="panel-title" id="prop_floor">'.$floor_plans.'</h4>
                    </a>
                </div>

                <div id="collapseflplan'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                    <div class="panel-body">';
                        ob_start();
                        estate_floor_plan($propid);
                        $temp=  ob_get_contents();
                        ob_end_clean();
                    $return.=$temp.'   
                    </div>
                </div>
            </div>
        </div>';
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }


    if($page_views!=''){
        
        $return.='  
        <div class="panel-group property-panel accordion_prop_stat" id="accordion_prop_stat'.$random.'">
            <div class="panel panel-default">
               <div class="panel-heading">
                   <a data-toggle="collapse" '.$expand.' data-parent="#accordion_prop_stat'.$random.'" href="#collapseSeven'.$random.'" class="'.$active_class.' property_design_page_views">
                    <h4 class="panel-title">'.$page_views.'</h4>    
                   </a>
               </div>
               <div id="collapseSeven'.$random.'" class="panel-collapse collapse '.$active_class_tab.'">
                 <div class="panel-body">
                    <canvas id="myChart" style="min-height:400px;width:100%;"></canvas>
                 </div>
               </div>
            </div>            
        </div>';     
        if($style==__("all open","wpestate")){
            $return.='<script type="text/javascript">
                //<![CDATA[
                    jQuery(document).ready(function(){
                        wpestate_show_stat_accordion(); 
                    });
               
                //]]>
             </script>';
        }
        
        $return.='<script type="text/javascript">
                //<![CDATA[
                    jQuery(document).ready(function(){
                        jQuery("#accordion_prop_stat'.$random.'").on("shown.bs.collapse", function () {
                       
                        setTimeout(function(){   wpestate_show_stat_accordion(); }, 200);
                    });
                });
                //]]>
            </script>';
       
        if($style==__("only first one opened","wpestate")){
            $expand             =   ' aria-expanded"false" ';
            $active_class       =   " collapsed ";
            $active_class_tab   =   " collapse ";
        }
    }
    
    return $return;
    
}
endif;




function wpestate_property_page_design_tab($attributes,$content = null){
    global $post;
    global $propid ;
    $return_string='';
 
    $description        =   '';
    $property_address   =   '';
    $property_details   =   '';
    $amenities_features =   '';    
    $map                =   '';
    $walkscore          =   '';
    $floor_plans        =   '';
    $page_views         =   '';
    

    $attributes = shortcode_atts( 
        array(
            'description'           =>__("Description","wpestate"),
            'property_address'      => __("Property Address","wpestate"),
            'property_details'      => __("Property Details","wpestate"),
            'amenities_features'    => __("Amenities and Features","wpestate"),
            'map'                   => __("Map","wpestate"),
            'virtual_tour'          => __("Virtual Tour","wpestate"),
            'walkscore'             => __("Walkscore","wpestate"),
            'floor_plans'           => __("Floor Plans","wpestate"),
            'page_views'            => __("Page Views","wpestate"),
        ), $attributes );
        
    if ( isset($attributes['description']) ){
       $description= $attributes['description'];
    }

    if ( isset($attributes['property_address']) ){
       $property_address=$attributes['property_address'];
    }
    
    if ( isset($attributes['property_details']) ){
        $property_details=$attributes['property_details'];
    }
    
    if ( isset($attributes['amenities_features']) ){
        $amenities_features=$attributes['amenities_features'];
    }
    
    if ( isset($attributes['map']) ){
        $map=$attributes['map'];
    }
    if ( isset($attributes['virtual_tour']) ){
        $virtual_tour=$attributes['virtual_tour'];
    }
    if ( isset($attributes['walkscore']) ){
        $walkscore=$attributes['walkscore'];
    }
    
    if ( isset($attributes['floor_plans']) ){
        $floor_plans=$attributes['floor_plans'];
    }
    
    if ( isset($attributes['page_views']) ){
        $page_views=$attributes['page_views'];
    }
     
    // $return_string.='//'.$propid.'//';
  
    $return_string.= estate_property_page_generated_tab($propid,$description,$property_address,$property_details,$amenities_features,$map,$virtual_tour,$walkscore,$floor_plans,$page_views);
 
    return $return_string;
}


if( !function_exists('estate_property_page_generated_tab') ):
function estate_property_page_generated_tab($propid,$description,$property_address,$property_details,$amenities_features,$map,$virtual_tour,$walkscore,$floor_plans,$page_views){
    $walkscore_api      =   esc_html ( get_option('wp_estate_walkscore_api','') );
    $show_graph_prop_page   = esc_html( get_option('wp_estate_show_graph_prop_page', '') );
    $random             =   rand(0,99999);
    $return             =   '<div role="tabpanel" id="tab_prpg"> <ul class="nav nav-tabs" role="tablist">';
    $active_class       =   " active ";
    $active_class_tab   =   " active ";
    
    if($description!=''){
        $return.='<li role="presentation" class="'.$active_class.'" >
        <a href="#description'.$random.'" aria-controls="description'.$random.'" role="tab" data-toggle="tab">
        '.$description.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($property_address!=''){
        $return.='<li role="presentation" class="'.$active_class.'">
        <a href="#address'.$random.'" aria-controls="address'.$random.'" role="tab" data-toggle="tab">
        '.$property_address.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($property_details!=''){
        $return.='<li role="presentation" class="'.$active_class.'">
        <a href="#details'.$random.'" aria-controls="details'.$random.'" role="tab" data-toggle="tab">
        '.$property_details.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($amenities_features!=''){
        $return.='<li role="presentation" class="'.$active_class.'">
        <a href="#features'.$random.'" aria-controls="features'.$random.'" role="tab" data-toggle="tab">
        '.$amenities_features.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($map!=''){
        $return.='<li role="presentation" class="shtabmap '.$active_class.'">
        <a href="#propmap'.$random.'" aria-controls="propmap'.$random.'" role="tab" data-toggle="tab">
        '.$map.'
        </a>
        </li>';
        $active_class= '';
    }
    
    
    if($virtual_tour!=''){
        $active_class= '';
        $return.='<li role="presentation" class="'.$active_class.'">
        <a href="#virtual_tour'.$random.'" aria-controls="virtual_tour'.$random.'" role="tab" data-toggle="tab">
        '.$virtual_tour.'
        </a>
        </li>';
        $active_class= '';
    }
    
    
    if($walkscore!=''){
        $active_class= '';
        $return.='<li role="presentation" class="'.$active_class.'">
        <a href="#walkscore'.$random.'" aria-controls="walkscore'.$random.'" role="tab" data-toggle="tab">
        '.$walkscore.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($floor_plans!=''){
        $return.='<li role="presentation" class=" '.$active_class.'" >
        <a href="#floor'.$random.'" aria-controls="floor'.$random.'" role="tab" data-toggle="tab">
        '.$floor_plans.'
        </a>
        </li>';
        $active_class= '';
    }
    
    if($page_views!=''){
        $return.='<li role="presentation" class="tabs_stats '.$active_class.'" data-listingid="'. intval($propid).'">
        <a href="#stats'.$random.'" aria-controls="stats'.$random.'" role="tab" data-toggle="tab">
        '.$page_views.'
        </a>
        </li>';
        $active_class= '';
    }
    
    $return .=' </ul>';
   
    ///////////////////////////////////////////////////////////////////////////
    
    $return .='<div class="tab-content">';
    if($description!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="description'.$random.'">';
        $return.=   estate_listing_content($propid);
        //$return.=    get_template_part ('/templates/download_pdf');
        $return.='</div>';
        $active_class_tab ='';
    }
    
    if($property_address!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="address'.$random.'">
        '.estate_listing_address($propid).'
        </div>';
        $active_class_tab ='';
    }
    
    if($property_details!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="details'.$random.'">
        '.estate_listing_details($propid).'  
        </div>';
        $active_class_tab ='';     
    }
    
    if($amenities_features!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="features'.$random.'">
        '.estate_listing_features($propid).'
        </div>';
        $active_class_tab ='';
    }
    
    if($map!=''){
        $return.='<div role="propmap" class="tab-pane   '.$active_class_tab.'" id="propmap'.$random.'">'
        .do_shortcode('[property_page_map propertyid="'.$propid.'" istab="1"][/property_page_map]').
        '</div>';
         
        $active_class_tab ='';
    }
    
    
    if($virtual_tour!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="virtual_tour'.$random.'">';
        if($virtual_tour!=''){
            ob_start();
            wpestate_virtual_tour_details($propid);
            $temp=  ob_get_contents();
            ob_end_clean();
            $return.=$temp;
        }
        $return.='</div>';
        $active_class_tab ='';
    }
    
    if($walkscore!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="walkscore'.$random.'">';
        if($walkscore_api!=''){
            ob_start();
            wpestate_walkscore_details($propid);
            $temp=  ob_get_contents();
            ob_end_clean();
            $return.=$temp;
        }
        $return.='</div>';
        $active_class_tab ='';
    }
    
    if($floor_plans!=''){
        $return.='<div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="floor'.$random.'">';
        
        ob_start();
       
        estate_floor_plan($propid);
        
        $temp=  ob_get_contents();
        ob_end_clean();
                
        $return.=$temp.'</div>';
        $active_class_tab ='';
    }
    
    if($page_views!=''){
        $return.='  <div role="tabpanel" class="tab-pane '.$active_class_tab.'" id="stats'.$random.'">
             <div class="panel-body">
                <canvas id="myChart"></canvas>
             </div>
        </div>';
        $active_class_tab ='';
    }
    
    $return.=' </div></div>';

    return $return;
}
endif;


if( !function_exists('wpestate_test_sh') ):
function wpestate_test_sh( $attributes,$content = null) {
    global $post;
    global $propid ;
    $return_string='das is cxx '.$post->ID.' das is good '.$propid ;
    return $return_string;
}
endif;
