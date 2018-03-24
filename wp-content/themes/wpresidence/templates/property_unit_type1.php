<?php
global $curent_fav;
global $currency;
global $where_currency;
global $show_compare;
global $show_compare_only;
global $show_remove_fav;
global $options;
global $isdashabord;
global $align;
global $align_class;
global $is_shortcode;
global $row_number_col;
global $is_col_md_12;
global $prop_unit;
global $property_unit_slider;
global $custom_unit_structure;
global $no_listins_per_row;
global $wpestate_uset_unit;
global $property_address;
global $property_adr_text;
global $prop_id;

$pinterest          =   '';
$previe             =   '';
$compare            =   '';
$extra              =   '';
$property_size      =   '';
$property_bathrooms =   '';
$property_rooms     =   '';
$measure_sys        =   '';



if($no_listins_per_row==3){
    $col_class  =   'col-md-6';
    $col_org    =   6;
}else{   
    $col_class  =   'col-md-4';
    $col_org    =   4;
}


if($options['content_class']=='col-md-12' && $show_remove_fav!=1){
    if($no_listins_per_row==3){
        $col_class  =   'col-md-4';
        $col_org    =   4;
    }else{
        $col_class  =   'col-md-3';
        $col_org    =   3;
    }
    
}
// if template is vertical
if($align=='col-md-12'){
    $col_class  =  'col-md-12';
    $col_org    =  12;
}



if(isset($is_shortcode) && $is_shortcode==1 ){
    $col_class='col-md-'.$row_number_col.' shortcode-col';
}

if(isset($is_col_md_12) && $is_col_md_12==1){
    $col_class  =   'col-md-6';
    $col_org    =   6;
}

$title          =   get_the_title();
$link           =   get_permalink();
$preview        =   array();
$preview[0]     =   '';
$favorite_class =   'icon-fav-off';
$fav_mes        =   __('add to favorites','wpestate');
if($curent_fav){
    if ( in_array ($post->ID,$curent_fav) ){
    $favorite_class =   'icon-fav-on';   
    $fav_mes        =   __('remove from favorites','wpestate');
    } 
}
if(isset($prop_unit) && $prop_unit=='list'){
   $col_class= 'col-md-12';
}

if( $property_unit_slider==1){
    $col_class.=' has_prop_slider ';
}

if($no_listins_per_row==4){
    $col_class.=' has_4per_row ';
}
$is_custom_desing=11;
?>  



<div class="<?php echo esc_html($col_class);?> listing_wrapper property_unit_type1" data-org="<?php echo esc_html($col_org);?>" data-listid="<?php echo intval($post->ID);?>" > 
    <div class="property_listing property_unit_type1 <?php if($wpestate_uset_unit==1) print 'property_listing_custom_design' ?> " data-link="<?php   if(  $property_unit_slider==0){ echo esc_url($link);}?>">
        
        <?php if ($wpestate_uset_unit==1){
            if ( isset($show_remove_fav) && $show_remove_fav==1 ) {
                print '<span class="icon-fav icon-fav-on-remove" data-postid="'.$post->ID.'"> '.$fav_mes.'</span>';
            }
  
         wpestate_build_unit_custom_structure($custom_unit_structure,$post->ID,$property_unit_slider);
            
        } else{
            if ( has_post_thumbnail() ){
                $arguments      = array(
                                        'numberposts' => -1,
                                        'post_type' => 'attachment',
                                        'post_mime_type' => 'image',
                                        'post_parent' => $post->ID,
                                        'post_status' => null,
                                        'exclude' => get_post_thumbnail_id(),
                                        'orderby' => 'menu_order',
                                        'order' => 'ASC'
                                    );
                $post_attachments   = get_posts($arguments);
                
                    
                $pinterest = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_full_map');
                $preview   = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_listings');
                $compare   = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider_thumb');
                $extra= array(
                    'data-original' =>  $preview[0],
                    'class'         =>  'lazyload img-responsive',    
                );


                $thumb_prop             =   get_the_post_thumbnail($post->ID, 'property_listings',$extra);

                if($thumb_prop ==''){
                    $thumb_prop_default =  get_template_directory_uri().'/img/defaults/default_property_listings.jpg';
                    $thumb_prop         =  '<img src="'.$thumb_prop_default.'" class="b-lazy img-responsive wp-post-image  lazy-hidden" alt="no thumb" />';   
                }


                $prop_stat              =   esc_html( get_post_meta($post->ID, 'property_status', true) );
                $featured               =   intval  ( get_post_meta($post->ID, 'prop_featured', true) );
                $property_rooms         =   get_post_meta($post->ID, 'property_bedrooms', true);
                if($property_rooms!=''){
                    $property_rooms=floatval($property_rooms);
                }

                $property_bathrooms     =   get_post_meta($post->ID, 'property_bathrooms', true) ;
                if($property_bathrooms!=''){
                    $property_bathrooms=floatval($property_bathrooms);
                }

                $property_size          =   get_post_meta($post->ID, 'property_size', true) ;
                if($property_size){
                    $property_size=wpestate_sizes_no_format(floatval($property_size));
                }

               $measure_sys            = esc_html ( get_option('wp_estate_measure_sys','') ); 

                print   '<div class="listing-unit-img-wrapper">';
                print   '<div class="prop_new_details"><div class="prop_new_details_back"></div>';
                
                print '</div>';    
                 
                print '<div class="listing_unit_price_wrapper">';
                    wpestate_show_price($post->ID,$currency,$where_currency);
                print '</div>';
           
        
                
                if(  $property_unit_slider==1){
                    //slider

                    $slides='';

                    $no_slides = 0;
                    foreach ($post_attachments as $attachment) { 
                        $no_slides++;
                        $preview    =   wp_get_attachment_image_src($attachment->ID, 'property_listings');

                        $slides     .= '<div class="item lazy-load-item">
                                            <a href="'.$link.'"><img  data-lazy-load-src="'.$preview[0].'" alt="'.$title.'" class="img-responsive" /></a>
                                        </div>';

                    }// end foreach
                    $unique_prop_id=uniqid();
                    print '
                    <div id="property_unit_carousel_'.$unique_prop_id.'" class="carousel property_unit_carousel slide " data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">         
                            <div class="item active">    
                                <a href="'.$link.'">'.$thumb_prop.'</a>     
                            </div>
                            '.$slides.'
                        </div>


                        <a href="'.$link.'"> </a>';

                        if( $no_slides>0){
                            print '<a class="left  carousel-control" href="#property_unit_carousel_'.$unique_prop_id.'" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            <a class="right  carousel-control" href="#property_unit_carousel_'.$unique_prop_id.'" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>';
                        }
                    print'
                    </div>';


                }else{
                    print   '<a href="'.$link.'">'.$thumb_prop.'</a>';
                  
                }
                print ' <span class="icon-fav '. esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($post->ID).'"></span>';
                 if ( isset($show_remove_fav) && $show_remove_fav==1 ) {
                    print '<span class="icon-fav icon-fav-on-remove" data-postid="'.$post->ID.'"> '.$fav_mes.'</span>';
               }
                if ($prop_stat != 'normal') {
                        $ribbon_class = str_replace(' ', '-', $prop_stat);
                        if (function_exists('icl_translate') ){
                            $prop_stat     =   icl_translate('wpestate','wp_estate_property_status'.$prop_stat, $prop_stat );
                        }
                          print'<div class="ribbon-wrapper-default ribbon-wrapper-' . $ribbon_class . '"><div class="ribbon-inside ' . $ribbon_class . '">' . $prop_stat . '</div></div>';
                    } 
                print   '</div>';

                
                print'<div class="tag-wrapper">';
                    if($featured==1){
                        print '<div class="featured_div">'.__('Featured','wpestate').'</div>';
                    }
                                       
                print   '</div>';
                
            
            }
            ?>
            <h4><a href="<?php echo esc_url($link); ?>">
                <?php
                    echo mb_substr( $title,0,44); 
                    if(mb_strlen($title)>44){
                        echo '...';   
                    } 
                 
                ?>
                </a> 
            </h4>
       
        
            <div class="property_address_type1_wrapper">
                <?php
                $property_city      =   get_the_term_list($post->ID, 'property_city', '', ', ', '') ;
                $property_area      =   get_the_term_list($post->ID, 'property_area', '', ', ', '');
                $property_address   =   get_post_meta($post->ID,'property_address',true);
                
                print '<i class="fa fa-map-marker" aria-hidden="true"></i>';
                if($property_address!=''){
                    print '<span class="property_address_type1">'.$property_address.', </span>';
                }
                if($property_area!=''){
                    print '<span class="property_area_type1">'.$property_area.', </span>';
                }
                
                if($property_city!=''){
                    print '<span class="property_city_type1">'.$property_city.'</span>';
                }
                
                ?>
            </div>
        
            <div class="property_categories_type1_wrapper">
                <?php
                $property_category   =  get_the_term_list($post->ID, 'property_category', '', ', ', '') ;
                $property_action     =  get_the_term_list($post->ID, 'property_action_category', '', ', ', '');   
                ?>
                
                <?php print '<span>'.__('Category','wpestate').':'.'</span>'.$property_category .' '.__('in','wpestate').' '.$property_action;?>
            </div>  
            
            <div class="property_details_type1_wrapper">
                <?php
                $property_size      =   get_post_meta($post->ID,'property_size',true);
                $property_rooms     =   get_post_meta($post->ID,'property_rooms',true);
                $property_bathrooms =   get_post_meta($post->ID,'property_bathrooms',true);
                $prop_id        =   $post->ID;  
                ?>
                <?php 
                    if($property_rooms!=''){
                        print ' <span class="property_details_type1_rooms">'.__('Rooms:','wpestate').'</span>'.'<span class="property_details_type1_value">'.$property_rooms.'</span>';
                    }

                    if($property_bathrooms!=''){
                        print '<span class="property_details_type1_baths">'.__('Baths:','wpestate').'</span>'.'<span class="property_details_type1_value">'.$property_bathrooms.'</span>';
                    }

                    if($property_size!=''){
                        print ' <span class="property_details_type1_size">'.__('Size:','wpestate').'</span>'.'<span class="property_details_type1_value">'.$property_size.' '.$measure_sys.'<sup>2</sup></span>';
                    }
                     if($prop_id !=''){
                        print ' <span class="property_details_type1_id">'.__('ID:','wpestate').'</span>'.'<span class="property_details_type1_value">'.$prop_id.'</span>';
                    }
                    
                  ?>           
         
           </div>
        
            <div class="property_location"> 
                   <?php 
                    $agent_id       =   intval  ( get_post_meta($post->ID, 'property_agent', true) );
                    $thumb_id       =   get_post_thumbnail_id($agent_id);
                    $agent_face     =   wp_get_attachment_image_src($thumb_id, 'agent_picture_thumb');

                    if ($agent_face[0]==''){
                       $agent_face[0]= get_template_directory_uri().'/img/default-user_1.png';
                    }
                    
                    ?>
                <div class="property_agent_wrapper">
                   
                    <?php if($agent_id!=0){
                             echo'<span>'. __('Agent','wpestate').':'.'</span>'.'<a href="' . get_permalink($agent_id) . '">' . get_the_title($agent_id) . '</a>';
                        }else{
                            echo '<span>'. __('Agent','wpestate').':'.'</span>'. get_the_author_meta( 'nicename',$post->post_author);
                        }
                    ?>
                </div>

                <?php if (!isset($show_compare) || $show_compare != 0) { ?>
                    <div class="listing_actions">
                    <div class="share_unit">
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($link); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social_facebook"></a>
                                <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title().' '.$link); ?>" class="social_tweet" target="_blank"></a>
                                <a href="https://plus.google.com/share?url=<?php echo esc_url($link); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" class="social_google"></a> 
                                <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($link); ?>&amp;media=<?php if (isset( $pinterest[0])){ echo esc_url($pinterest[0]); }?>&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social_pinterest"></a>
                    </div>
                        <span class="share_list"  data-original-title="<?php _e('share', 'wpestate'); ?>" ></span>
                    </div>
                </div>
                
                <?php
              
                }
              
                }// end if custom structure
              
                 ?>
    </div> 
    </div>
    
           
            

<?php
unset($pinterest);
unset($previe);
unset($compare);
unset($extra);
unset($property_size);
unset($property_bathrooms);
unset($property_rooms);
unset($measure_sys);
unset($col_class);
unset($col_org);
unset($link);
unset($preview);
unset($favorite_class);
unset($fav_mes);
unset($curent_fav);
unset($thumb_prop);
unset($prop_stat);
unset($featured);
unset($property_rooms);
unset($property_bathrooms);
unset($property_size);
unset($prop_stat);
unset($ribbon_class);
unset($property_city);
unset($property_area);
unset($show_remove_fav);
unset($title);
unset($align_class);
