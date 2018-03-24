<?php
global $property_unit_slider;
global $sale_line;
    
$prop_id        =   $post->ID;
$return_string  =   '';    
$thumb_id       =   get_post_thumbnail_id($prop_id);
$preview        =   wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_listings');
if($preview[0]==''){
    $preview[0]= get_template_directory_uri().'/img/defaults/default_property_featured.jpg';
}
$link           =   get_permalink();
$title          =   get_the_title();
$price          =   floatval( get_post_meta($prop_id, 'property_price', true) );
$price_label    =   '<span class="price_label">'.esc_html ( get_post_meta($prop_id, 'property_label', true) ).'</span>';
$price_label_before    =   '<span class="price_label price_label_before">'.esc_html ( get_post_meta($prop_id, 'property_label_before', true) ).'</span>';
$currency       =   esc_html( get_option('wp_estate_currency_symbol', '') );
$where_currency =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
$content        =   wpestate_strip_words( get_the_excerpt(),30).' ...';
$gmap_lat       =   esc_html( get_post_meta($prop_id, 'property_latitude', true));
$gmap_long      =   esc_html( get_post_meta($prop_id, 'property_longitude', true));
$prop_stat      =   esc_html( get_post_meta($prop_id, 'property_status', true) );

if (function_exists('icl_translate') ){
    $prop_stat     =   icl_translate('wpestate','wp_estate_property_status_sh_'.$prop_stat, $prop_stat ) ;                                      
}

$featured           =   intval  ( get_post_meta($prop_id, 'prop_featured', true) );
$agent_id           =   intval  ( get_post_meta($prop_id, 'property_agent', true) );
$thumb_id           =   get_post_thumbnail_id($agent_id);
$agent_face         =   wp_get_attachment_image_src($thumb_id, 'agent_picture_thumb');
$property_bathrooms =   get_post_meta($post->ID, 'property_bathrooms', true);
$property_rooms     =   get_post_meta($post->ID, 'property_bedrooms', true);
$property_size      =   get_post_meta($post->ID, 'property_size', true) ;
$measure_sys        =   esc_html(get_option('wp_estate_measure_sys', ''));

if ($agent_face[0]==''){
   $agent_face[0]= get_template_directory_uri().'/img/default-user_1.png';
}


$agent_posit    =   esc_html( get_post_meta($agent_id, 'agent_position', true) );
$agent_permalink=   get_permalink($agent_id);
$agent_phone    =   esc_html( get_post_meta($agent_id, 'agent_phone', true) );
$agent_mobile   =   esc_html( get_post_meta($agent_id, 'agent_mobile', true) );
$agent_email    =   esc_html( get_post_meta($agent_id, 'agent_email', true) );

if ($price != 0) {
    $price = wpestate_show_price($prop_id,$currency,$where_currency,1);  
}else{
    $price=$price_label_before.$price_label;
}

$current_user = wp_get_current_user();
$userID                     =   $current_user->ID;
$user_option                =   'favorites'.$userID;
$curent_fav                 =   get_option($user_option);
$favorite_class =   'icon-fav-off';
$fav_mes        =   __('add to favorites','wpestate');
if($curent_fav){
    if ( in_array ($post->ID,$curent_fav) ){
    $favorite_class =   'icon-fav-on';   
    $fav_mes        =   __('remove from favorites','wpestate');
    } 
}


$return_string.= '
    <div class="featured_property featured_property_type3">
            <div class="featured_img">';

                $return_string .= '<div class="tag-wrapper">';
                    if($featured==1){
                        $return_string .= '<div class="featured_div">'.__('Featured','wpestate').'</div>';
                    }
                    if ($prop_stat != 'normal') {
                        $ribbon_class = str_replace(' ', '-', $prop_stat);
                        if (function_exists('icl_translate') ){
                            $prop_stat     =   icl_translate('wpestate','wp_estate_property_status'.$prop_stat, $prop_stat );
                        }
                        $return_string .= '<div class="ribbon-wrapper-default ribbon-wrapper-' . $ribbon_class . '"><div class="ribbon-inside ' . $ribbon_class . '">' . $prop_stat . '</div></div>';
                    } 
                    
                $return_string .= '</div>';
            
                if(  $property_unit_slider==1){

                    $arguments      = array(
                          'numberposts' => -1,
                          'post_type' => 'attachment',
                          'post_mime_type' => 'image',
                          'post_parent' => $prop_id,
                          'post_status' => null,
                          'exclude' => get_post_thumbnail_id($prop_id),
                          'orderby' => 'menu_order',
                          'order' => 'ASC'
                      );
                    $post_attachments   = get_posts($arguments);

                    $slides='';

                    $no_slides = 0;
                    foreach ($post_attachments as $attachment) { 
                        $no_slides++;
                        $preview_att    =   wp_get_attachment_image_src($attachment->ID, 'property_listings');
                            if($preview_att[0]==''){
                                $preview_att[0]= get_template_directory_uri().'/img/defaults/default_property_featured.jpg';
                            }

                        $slides     .= '<div class="item" style="background-image:url('.$preview_att[0].');"></div>';

                    }// end foreach

                    $return_string .=  '
                    <div id="property_unit_featured_carousel_'.$prop_id.'" class="carousel slide  " data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">         
                            <div class="item active" style="background-image:url(' . $preview[0] . ');"></div>
                            '.$slides.'
                        </div>
                        <a href="'.$link.'"> </a>';
                  
                        if( $no_slides >= 1){
                            $return_string .=  '<a class="left  carousel-control" href="#property_unit_featured_carousel_'.$prop_id.'" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            <a class="right  carousel-control" href="#property_unit_featured_carousel_'.$prop_id.'" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>';
                        }
                    $return_string .= '
                    </div>';
                }else{
                    $return_string .=  '<a href="' . $link . '"> <img src="' . $preview[0] . '" data-original="' . $preview[0] . '" class="lazyload img-responsive" alt="featured image"/></a>
                    <div class="listing-cover featured_cover" data-link="'.$link.'"></div>
                    <a href="'.$link.'"> <span class="listing-cover-plus">+</span></a>';
                }
            $return_string.= '</div>';
            $return_string.='';
            $return_string.= ' <div class="featured_secondline" data-link="'.$link.'">';
            
           

           
            $return_string .= '<h2><a href="' . $link . '">';
                $return_string .= mb_substr( $title,0,27); 
                if(mb_strlen($title)>27){
                    $return_string .= '...';   
                }
            $return_string.='</a></h2>';
            
            $return_string.='<div class="featured_prop_price">'.$price.' </div>';
            
            $return_string.='<div class="listing_details the_grid_view">
                    '.wpestate_strip_excerpt_by_char(get_the_excerpt(),70,$prop_id).'</div>';
            
            
            $return_string.='
            <div class="listing_actions">

                <div class="share_unit">
                    <a href="http://www.facebook.com/sharer.php?u='. esc_url($link).'&amp;t='.urlencode(get_the_title()).'" target="_blank" class="social_facebook"></a>
                    <a href="http://twitter.com/home?status='.urlencode(get_the_title().' '.$link).'" class="social_tweet" target="_blank"></a>
                    <a href="https://plus.google.com/share?url='.esc_url($link).'" onclick="javascript:window.open(this.href,"", \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" target="_blank" class="social_google"></a> 
                    <a href="http://pinterest.com/pin/create/button/?url='.esc_url($link).'&amp;media=';
                        if (isset( $pinterest[0])){            
                            $return_string.= esc_url($pinterest[0]); 
                        }
                    $return_string.='&amp;description='.urlencode(get_the_title()).'" target="_blank" class="social_pinterest"></a>
                </div>



                <span class="share_list"  data-original-title="'.__('share','wpestate').'" ></span>
                <span class="icon-fav '.esc_html($favorite_class).'" data-original-title="'. $fav_mes.'" data-postid="'.intval($post->ID).'"></span>

                
            </div>';
            
           $return_string.='<div class="property_listing_details">';
                    if($property_rooms!=''){
                        $return_string.='<span class="inforoom">'.$property_rooms.'</span>';
                    }

                    if($property_bathrooms!=''){
                        $return_string.='<span class="infobath">'.$property_bathrooms.'</span>';
                    }

                    if($property_size!=''){
                        $return_string.='<span class="infosize">'.$property_size.' '.$measure_sys.'<sup>2</sup></span>';
                    }
         $return_string.='</div>';
            
             
            
    
            $return_string.='</div>';

        $return_string .='
    </div>';

echo $return_string;