<?php
global $property_unit_slider;
global $sale_line;
    
$prop_id        =   $post->ID;
$return_string  =   '';    
$thumb_id       =   get_post_thumbnail_id($prop_id);
$preview        =   wp_get_attachment_image_src(get_post_thumbnail_id(), 'listing_full_slider_1');
if($preview[0]==''){
    $preview[0]= get_template_directory_uri().'/img/defaults/default_property_featured.jpg';
}
$link           =   get_permalink();
$title          =   get_the_title();
$price          =   floatval( get_post_meta($prop_id, 'property_price', true) );
$price_label    =   esc_html ( get_post_meta($prop_id, 'property_label', true) );
$price_label_before    = esc_html ( get_post_meta($prop_id, 'property_label_before', true) );
$currency       =   esc_html( get_option('wp_estate_currency_symbol', '') );
$where_currency =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
$content        =   wpestate_strip_words( get_the_excerpt(),30).' ...';
$gmap_lat       =   esc_html( get_post_meta($prop_id, 'property_latitude', true));
$gmap_long      =   esc_html( get_post_meta($prop_id, 'property_longitude', true));
$prop_stat      =   esc_html( get_post_meta($prop_id, 'property_status', true) );

if (function_exists('icl_translate') ){
    $prop_stat     =   icl_translate('wpestate','wp_estate_property_status_sh_'.$prop_stat, $prop_stat ) ;                                      
}

$featured       =   intval  ( get_post_meta($prop_id, 'prop_featured', true) );
$agent_id       =   intval  ( get_post_meta($prop_id, 'property_agent', true) );
$thumb_id       =   get_post_thumbnail_id($agent_id);
$agent_face     =   wp_get_attachment_image_src($thumb_id, 'agent_picture_thumb');

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

$return_string.= '
    <div class="featured_property featured_property_type2">';
                $return_string .= '<div class="featured_img">';
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
                        $preview_att    =   wp_get_attachment_image_src($attachment->ID, 'listing_full_slider_1');
                            if($preview_att[0]==''){
                                $preview_att[0]= get_template_directory_uri().'/img/defaults/default_property_featured.jpg';
                            }

                        $slides     .= '<div class="item">
                                            <a href="'.$link.'"><img  src="'.$preview_att[0].'" alt="'.$title.'" class="img-responsive" /></a>
                                        </div>';

                    }// end foreach

                    $return_string .=  '
                    <div id="property_unit_featured_carousel_'.$prop_id.'" class="carousel slide  " data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">         
                            <div class="item active">    
                                <a href="'.$link.'"><img src="' . $preview[0] . '" data-original="' . $preview[0] . '" class="lazyload img-responsive" alt="featured image"/></a>     
                            </div>
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
         
            
            $return_string.= '<div class="places_cover" data-link="'.$link.'" ></div> <div class="featured_secondline" >';
            if ($agent_id!=''){
                $return_string.= '
                <div class="agent_face" style="background-image:url('.$agent_face[0].')">
                  
                </div>';
            }


            if($featured==1){
                $return_string .= '';
            }
            $return_string .= '<h2><a href="' . $link . '">';


            $return_string .= mb_substr( $title,0,27); 
            if(mb_strlen($title)>27){
                $return_string .= '...';   
            }

            $return_string.='</a></h2>
            <div class="sale_line">' . $sale_line . '</div>
            <div class="featured_prop_price">'.$price.' </div>


     </div>';

         $return_string .='
    </div>';

echo $return_string;