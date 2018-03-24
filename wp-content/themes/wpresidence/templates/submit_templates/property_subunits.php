<?php

global $property_has_subunits;
global $property_subunits_list;
global $edit_id;
?>


<div class="submit_container">
    <div class="submit_container_header"><?php _e('Subunits','wpestate');?></div>
    
    <p class="full_form">
        <input type="hidden" name="property_has_subunits" value="">
        <input type="checkbox"  id="property_has_subunits" name="property_has_subunits" value="1" 
            <?php 
                if ($property_has_subunits == 1) {
                    print'checked="checked"';
                }
            ?>     
            />
        <label class="checklabel" for="property_has_subunits"><?php _e('Enable ','wpestate');?></label>
    </p>
            
            
    <p class="full_form">
        
        <label for="property_subunits_list"><?php _e('Select Subunits From the list: ','wpestate'); ?></label>
        <?php
       
            
           
            $current_user   =   wp_get_current_user();
            $userID         =   $current_user->ID;
            $post__not_in   =   array();
            $post__not_in[] =   $edit_id;
            $args = array(       
                        'post_type'                 =>  'estate_property',
                        'post_status'               => 'publish',
                        'nopaging'                  =>  'true',
                        'post__not_in'              =>  $post__not_in,
                        'cache_results'             =>  false,
                        'update_post_meta_cache'    =>  false,
                        'update_post_term_cache'    =>  false,
                        'author'                    =>  $userID,
                        'cache_results'             =>  false,
                        'update_post_meta_cache'    =>  false,
                        'update_post_term_cache'    =>  false,
                     
                );

           
            $recent_posts = new WP_Query($args);
            print '<select name="property_subunits_list[]"  style="height:350px;" id="property_subunits_list"  multiple="multiple">';
            while ($recent_posts->have_posts()): $recent_posts->the_post();
                 $theid=get_the_ID();
                 print '<option value="'.$theid.'" ';
                 if( is_array($property_subunits_list) && in_array($theid, $property_subunits_list) ){
                     print ' selected="selected" ';
                 }
                 print'>'.get_the_title().'</option>';
            endwhile;
            print '</select>';
        
          
        ?>
        
    </p>

  
</div>