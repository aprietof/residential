<?php
global $price;
global $price_label_before;
global $price_label;
?>
<div class="lightbox_property_wrapper">
    
    <div class="lightbox_property_wrapper_level2">
        
        
       

        <div class="lightbox_property_content row">

            <div class="lightbox_property_slider col-md-10">
                <div  id="owl-demo" class="owl-carousel owl-theme">
                    
                    
                    
                    <?php
                    $featured_id        =   get_post_thumbnail_id($post->ID);
                    $full_img           =   wp_get_attachment_image_src($featured_id, 'listing_full_slider_1');
                    $attachment_meta    =   wp_get_attachment($featured_id);
                        
                    echo '<div class="item" style="background-image:url('.$full_img[0].')">';
                          
                            if(trim($attachment_meta['caption'])!=''){
                               echo '<div class="owl_caption"> '. $attachment_meta['caption'].'</div>'; 
                            }
                    echo'</div>';
                        
                        
                        
                    $arguments      = array(
                            'numberposts' => -1,
                            'post_type' => 'attachment',
                            'post_mime_type' => 'image',
                            'post_parent' => $post->ID,
                            'post_status' => null,
                            'exclude' => $featured_id,
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        );

                    $post_attachments   = get_posts($arguments);
                    foreach ($post_attachments as $attachment) {
                        

                        $full_img           = wp_get_attachment_image_src($attachment->ID, 'listing_full_slider_1');
                        $attachment_meta    = wp_get_attachment($attachment->ID);

                       echo '<div class="item" style="background-image:url('.$full_img[0].')">';
                          
                            if(trim($attachment_meta['caption'])!=''){
                                echo '<div class="owl_caption"> '. $attachment_meta['caption'].'</div>'; 
                            }
                        echo'</div>';

                    }
                    ?>
                </div>
            </div>

            <div class="lightbox_property_sidebar col-md-2">
                <div class="lightbox_property_header">
                    <h1 class="entry-title entry-prop"><?php the_title(); ?></h1>  
                </div>
                <h4 class="lightbox_enquire"><?php _e('Want to find out more?','wpestate');?></h4>
                <?php  get_template_part ('/templates/agent_area'); ?>
            </div>

        </div>


       
        <div class="lighbox-image-close">
                <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
    
    <div class="lighbox_overlay">
    </div>    
</div>