<?php
global $prop_selection;
global $options;
global $num;
global $args;
global $custom_advanced_search;
global $adv_search_what;
global $adv_search_how;
global $adv_search_label;
global $prop_unit_class;
global $show_compare_only;
global $property_unit_slider;
global $custom_post_type;
global $col_class;
global $custom_unit_structure;
global $no_listins_per_row;
global $wpestate_uset_unit;
global $included_ids;

$wpestate_uset_unit         =   intval ( get_option('wpestate_uset_unit','') );
$no_listins_per_row         =   intval( get_option('wp_estate_listings_per_row', '') );
$custom_unit_structure      =   get_option('wpestate_property_unit_structure');
$taxonmy                    =   get_query_var('taxonomy');
$term                       =   get_query_var( 'term' );
$property_unit_slider       =   get_option('wp_estate_prop_list_slider','');
$property_card_type         =   intval(get_option('wp_estate_unit_card_type'));
$property_card_type_string  =   '';
if($property_card_type==0){
    $property_card_type_string='';
}else{
    $property_card_type_string='_type'.$property_card_type;
}

if( is_tax() && $custom_post_type=='estate_agent'){
global $no_listins_per_row;
$no_listins_per_row       =   intval( get_option('wp_estate_agent_listings_per_row', '') );

$col_class=4;
if($options['content_class']=='col-md-12'){
    $col_class=3;
}

if($no_listins_per_row==3){
    $col_class  =   '6';
    $col_org    =   6;
    if($options['content_class']=='col-md-12'){
        $col_class  =   '4';
        $col_org    =   4;
    }
}else{   
    $col_class  =   '4';
    $col_org    =   4;
    if($options['content_class']=='col-md-12'){
        $col_class  =   '3';
        $col_org    =   3;
    }
}

}
    
?>

<div class="row">
    <?php get_template_part('templates/breadcrumbs'); ?>
    <div class=" <?php print esc_html($options['content_class']);?> ">
        
        <?php  
        if( is_page_template('advanced_search_results.php') ) {
            
            while (have_posts()) : the_post();
                if (esc_html( get_post_meta($post->ID, 'page_show_title', true) ) == 'yes') { ?>
                    <h1 class="entry-title title_prop"><?php the_title(); print " (".$num.")" ?></h1>                
                <?php } ?>
                <div class="single-content">
            
                <?php 
                the_content();
                $show_save_search            =   get_option('wp_estate_show_save_search','');
    
                if ($show_save_search=='yes' ){
                    if( is_user_logged_in() ){
                        print '<div class="search_unit_wrapper advanced_search_notice">';
                        print '<div class="search_param"><strong>'.__('Search Parameters: ','wpestate').'</strong>';
                            wpestate_show_search_params_new($included_ids,$args,$custom_advanced_search, $adv_search_what,$adv_search_how,$adv_search_label);
                        print'</div>';
                        print'</div>';


                        print '<div class="saved_search_wrapper"> <span id="save_search_notice">'.__('Save this Search?','wpestate').'</span>'; 
                        print '<input type="text" id="search_name" class="new_search_name" placeholder="'.__('Search name','wpestate').'">';
                        print '<button class="wpresidence_button" id="save_search_button">'.__('Save Search','wpestate').'</button>';
                        print  "<input type='hidden' id='search_args' value=' ";
                        print json_encode($args,JSON_HEX_TAG);
                        print "'>";
                        print  "<input type='hidden' id='meta_args' value=' ";
                        print json_encode($included_ids,JSON_HEX_TAG);
                        print "'>";
                        
                        print '<input type="hidden" name="save_search_nonce" id="save_search_nonce"  value="'. wp_create_nonce( 'save_search_nonce' ).'" />';
                        print '';
                        print '</div>';
                    }else{
                        print '<div class="vc_row wpb_row vc_row-fluid vc_row">
                                <div class="vc_col-sm-12 wpb_column vc_column_container vc_column">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_alert wpb_content_element vc_alert_rounded wpb_alert-info wpestate_message vc_message">
                                            <div class="messagebox_text"><p>'.__('Login to save search and and you will receive an email notification when new properties matching your search will be published.','wpestate').'</p>
                                        </div>
                                        </div>
                                    </div> 
                                </div> 
                        </div>';

                    }

                }

            
            ?>
        
            </div>
                            
        <?php endwhile; // end of the loop.  
         
        get_template_part('templates/property_list_filters_search');
         
        }else if( is_tax()) { 
            $page_tax   =   '';
            $term_data  =   get_term_by('slug', $term, $taxonmy);
            $place_id   =   $term_data->term_id;
            $term_meta  =   get_option( "taxonomy_$place_id");
       
          
            if(isset($term_meta['pagetax'])){
               $page_tax=$term_meta['pagetax'];           
            }
        
            if($page_tax!=''){
                $content_post = get_post($page_tax);
                    if(isset($content_post->post_content)){
                    $content = $content_post->post_content;
                    $content = apply_filters('the_content', $content);
                    echo '<div class="single-content">'.$content.'</div>';
                }
            }
            ?>
           
            <h1 class="entry-title title_prop"> 
                <?php 
                
                    if($custom_post_type!='estate_agent'){
                        _e('Properties listed in ','wpestate');
                        single_cat_title();
                    }else{
                        _e('Agents in ','wpestate');
                        single_cat_title();
                    }
                ?>
            </h1>
        
        
        <?php
       
        }else{
            while (have_posts()) : the_post(); ?>
                <?php 
                if (esc_html( get_post_meta($post->ID, 'page_show_title', true) ) == 'yes') { ?>
                    <h1 class="entry-title title_prop"><?php the_title(); ?></h1>
                <?php } 
                ?>
                <div class="single-content"><?php the_content();?></div>
            <?php 
            endwhile; // end of the loop.  
        }
        ?>  

              
        <!--Filters starts here-->     
        <?php    
        if($custom_post_type!='estate_agent'){
            get_template_part('templates/property_list_filters');
        }else{
            get_template_part('templates/taxonomy_agent_hidden_filters'); 
        }
        
        
        
        ?> 
        <!--Filters Ends here-->   
       
        <?php  get_template_part('templates/compare_list'); ?> 
        
        <!-- Listings starts here -->                   
        <?php  get_template_part('templates/spiner'); ?> 
        
        <?php if( $custom_post_type=='estate_agent'){?>
            <div id=" listing_ajax_container_agent_tax" class="<?php echo esc_html($prop_unit_class);?>"></div> 
        <?php } ?> 
             
        <div id="listing_ajax_container" class="<?php echo esc_html($prop_unit_class);?>"> 
        
            <?php
            global $tax_categ_picked;
            global $tax_action_picked;
            global $tax_city_picked;
            global $taxa_area_picked;
            ?>
            
            <input type="hidden" id="tax_categ_picked" value="<?php echo $tax_categ_picked;?>">
            <input type="hidden" id="tax_action_picked" value="<?php echo $tax_action_picked;?>">
            <input type="hidden" id="tax_city_picked" value="<?php echo $tax_city_picked;?>">
            <input type="hidden" id="taxa_area_picked" value="<?php echo $taxa_area_picked;?>">
            <?php
           

            $show_compare_only  =   'yes';
            $counter = 0;
            if( is_page_template('advanced_search_results.php') ) {
                $first=0;
                if ($prop_selection->have_posts()){    
                    while ($prop_selection->have_posts()): $prop_selection->the_post();
                        if( isset($_GET['is2']) && $_GET['is2']==1 && $first==0 ){
                            $gmap_lat    =   esc_html(get_post_meta($post->ID, 'property_latitude', true));
                            $gmap_long   =   esc_html(get_post_meta($post->ID, 'property_longitude', true));
                            if($gmap_lat!='' && $gmap_long!=''){
                                print '<span style="display:none" id="basepoint" data-lat="'.$gmap_lat.'" data-long="'.$gmap_long.'"></span>';
                                $first=1;
                            }
                        }

                        get_template_part('templates/property_unit'.$property_card_type_string);
                        
                        
                    endwhile;
                }else{   
                    print '<div class="bottom_sixty">';
                    _e('We didn\'t find any results. Please try again with different search parameters. ','wpestate');
                    print '</div>';
                }  
            }else{
                if( $prop_selection->have_posts() ){
                    
                    while ($prop_selection->have_posts()): $prop_selection->the_post(); 
                        if($custom_post_type!='estate_agent'){
                            get_template_part('templates/property_unit'.$property_card_type_string);
                        }else{
                            print '<div class="col-md-'.$col_class.' listing_wrapper">';
                                get_template_part('templates/agent_unit'); 
                            print '</div>';
                        }
                       
                    endwhile;
                }else{
                    if($custom_post_type!='estate_agent'){
                        print '<h4 class="nothing">'.__('There are no properties listed on this page at this moment. Please try again later. ','wpestate').'</h4>';
                    }else{
                        print '<h4 class="nothing">'.__('There are no agents listed on this page at this moment. Please try again later. ','wpestate').'</h4>';
                    }
                    
                    }
            }
           
            
            wp_reset_query();               
        ?>
        </div>
        <!-- Listings Ends  here --> 
        
        
        
        <?php kriesi_pagination($prop_selection->max_num_pages, $range =2); ?>       
        <div class="single-content">
            <?php   
                $property_list_second_content = get_post_meta($post->ID, 'property_list_second_content', true);
                echo do_shortcode($property_list_second_content);
            ?>
        </div>
    </div><!-- end 9col container-->
    
<?php  include(locate_template('sidebar.php')); ?>
</div>   