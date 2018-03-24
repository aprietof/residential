<?php
$adv_submit                 =   get_adv_search_link();
$args                       =   wpestate_get_select_arguments();
$action_select_list         =   wpestate_get_action_select_list($args);
$categ_select_list          =   wpestate_get_category_select_list($args);
$select_city_list           =   wpestate_get_city_select_list($args); 
$select_area_list           =   wpestate_get_area_select_list($args);
$select_county_state_list   =   wpestate_get_county_state_select_list($args);
$home_small_map_status      =   esc_html ( get_option('wp_estate_home_small_map','') );
$show_adv_search_map_close  =   esc_html ( get_option('wp_estate_show_adv_search_map_close','') );
$class                      =   'hidden';
$class_close                =   '';
$allowed_html               =   array();
?>


<div id="adv-search-header-mobile"> 
    <i class="fa fa-search"></i>  
    <?php _e('Advanced Search','wpestate');?> 
</div>   




<div class="adv-search-mobile"  id="adv-search-mobile"> 
   
    <form role="search" method="get"   action="<?php print esc_url($adv_submit); ?>" >
         
        <?php
        $adv_search_type        =   get_option('wp_estate_adv_search_type','');
      
        if ( $adv_search_type!==2 ){       
            $custom_advanced_search= get_option('wp_estate_custom_advanced_search','');
            $adv_search_what        =   get_option('wp_estate_adv_search_what','');
            
            if ( $custom_advanced_search == 'yes'){
                if ( $adv_search_type==6 || $adv_search_type==7 || $adv_search_type==8 || $adv_search_type==9 ){    
                    $adv6_taxonomy          =   get_option('wp_estate_adv6_taxonomy');
                
                    if ($adv6_taxonomy=='property_category'){
                        $search_field="categories";
                    }else if ($adv6_taxonomy=='property_action_category'){
                        $search_field="types";
                    }else if ($adv6_taxonomy=='property_city'){
                        $search_field="cities";
                    }else if ($adv6_taxonomy=='property_area'){
                        $search_field="areas";
                    }else if ($adv6_taxonomy=='property_county_state'){
                        $search_field="county / state";
                    }
                   
                    wpestate_show_search_field_tab_inject('mobile',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,'',$select_county_state_list);
                }
                
                foreach($adv_search_what as $key=>$search_field){
                    wpestate_show_search_field('mobile',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,$key,$select_county_state_list);
                }
            }else{
            $form = wpestate_show_search_field_classic_form('mobile',$action_select_list,$categ_select_list ,$select_city_list,$select_area_list);
            print $form;
        }
        
        $extended_search= get_option('wp_estate_show_adv_search_extended','');
        if($extended_search=='yes'){            
            show_extended_search('mobile');
        }
        ?>
      
        <?php 
        //if ( $adv_search_type==2) 
        } else {
        ?>
            <input type="text" id="adv_location_mobile" class="form-control" name="adv_location"  placeholder="<?php _e('Search State, City or Area','wpestate');?>" value="">      

            <input type="hidden" name="is2" value="1">
            <div class="dropdown form-control" >
                <div data-toggle="dropdown" id="adv_categ" class="filter_menu_trigger" data-value="<?php // echo  $adv_categ_value1;?>"> 
                    <?php 
                    echo  __('All Types','wpestate');
                    ?> 
                <span class="caret caret_filter"></span> </div>    
               
                <input type="hidden" name="filter_search_type[]" value="<?php if(isset($_GET['filter_search_type'][0])){echo  esc_attr( wp_kses($_GET['filter_search_type'][0], $allowed_html) );}?>">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_categ">
                    <?php print $categ_select_list;?>
                </ul>        
            </div> 

            <div class="dropdown form-control" >
                <div data-toggle="dropdown" id="adv_actions" class="filter_menu_trigger" data-value="<?php // ?>"> 
                    <?php _e('All Actions','wpestate');?> 
                    <span class="caret caret_filter"></span> </div>           
             
                <input type="hidden" name="filter_search_action[]" value="<?php if(isset($_GET['filter_search_action'][0])){echo esc_attr( wp_kses($_GET['filter_search_action'][0], $allowed_html) );}?>">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                    <?php print $action_select_list;?>
                </ul>        
            </div>
            
        <?php    
        

            $availableTags='';
            $args = array( 'hide_empty=0' );
            $terms = get_terms( 'property_city', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            $terms = get_terms( 'property_area', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            $terms = get_terms( 'property_county_state', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            print '<script type="text/javascript">
                       //<![CDATA[
                       jQuery(document).ready(function(){
                            var availableTags = ['.$availableTags.'];
                            jQuery("#adv_location_mobile").autocomplete({
                                source: availableTags
                            });
                       });
                       //]]>
                    </script>';
 

        }
        ?>
        
        <button class="wpresidence_button" id="advanced_submit_2_mobile"><?php _e('Search Properties','wpestate');?></button>
        <button class="wpresidence_button" id="showinpage_mobile"><?php _e('See first results here ','wpestate');?></button>
        
        
            <span id="results_mobile"> <?php _e('we found','wpestate')?> <span id="results_no_mobile">0</span> <?php _e('results','wpestate')?> </span>
    </form>   
</div>       