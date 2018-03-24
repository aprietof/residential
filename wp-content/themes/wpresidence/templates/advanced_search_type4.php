<?php 
global $post;
global $adv_search_type;
$adv_search_what            =   get_option('wp_estate_adv_search_what','');
$show_adv_search_visible    =   get_option('wp_estate_show_adv_search_visible','');
$close_class                =   '';

if($show_adv_search_visible=='no'){
    $close_class='adv-search-1-close';
}

$extended_search    =   get_option('wp_estate_show_adv_search_extended','');
$extended_class     =   '';

if ($adv_search_type==2){
     $extended_class='adv_extended_class2';
}

if ( $extended_search =='yes' ){
    $extended_class='adv_extended_class';
    if($show_adv_search_visible=='no'){
        $close_class='adv-search-1-close-extended';
    }
       
}

?>

 


<div class="adv-search-1 <?php echo esc_html($close_class.' '.$extended_class);?>" id="adv-search-1" > 
    <div id="adv-search-header-1"> <?php _e('Advanced Search ','wpestate');?></div>   
    <form role="search" method="get"   action="<?php esc_url(print $adv_submit); ?>" >
        <?php
        if (function_exists('icl_translate') ){
            print do_action( 'wpml_add_language_form_field' );
        }
        ?>   
        
        
        <div class="adv4-holder">
            <?php
            $custom_advanced_search         =   get_option('wp_estate_custom_advanced_search','');
            $adv_search_fields_no_per_row   =   ( floatval( get_option('wp_estate_search_fields_no_per_row') ) );
            if ( $custom_advanced_search == 'yes'){
                foreach($adv_search_what as $key=>$search_field){
                    $search_col         =   3;
                    $search_col_price   =   6;
                    if($adv_search_fields_no_per_row==2){
                        $search_col         =   6;
                        $search_col_price   =   12;
                    }else  if($adv_search_fields_no_per_row==3){
                        $search_col         =   4;
                        $search_col_price   =   8;
                    }
                    
                    $search_col_submit = $search_col;
                    
                    if($search_field=='property price' &&  get_option('wp_estate_show_slider_price','')=='yes'){
                        $search_col=$search_col_price;
                    }
                   
                    print '<div class="col-md-'.$search_col.' '.str_replace(" ","_",$search_field).'">';
                    wpestate_show_search_field('mainform',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,$key,$select_county_state_list);
                    print '</div>';
                    
                }
              
                
                print '<div class="col-md-'.$search_col_submit.' '.str_replace(" ","_",$search_field).'">';
                print '<input name="submit" type="submit" class="wpresidence_button" id="advanced_submit_4" value="'.__('Search Properties','wpestate').'">';
                print '</div>';
            }else{
                $search_form = wpestate_show_search_field_classic_form('main',$action_select_list,$categ_select_list ,$select_city_list,$select_area_list);
                print $search_form;
                   
                 
                print '<div class="col-md-3">';
                print '<input name="submit" type="submit" class="wpresidence_button" id="advanced_submit_4" value="'.__('Search Properties','wpestate').'">';
                print '</div>';
            }

            if($extended_search=='yes'){
               show_extended_search('adv');
            }
            ?>
        </div>
       
        
            
        <?php if ($adv_search_type!=2) { ?>
        <div id="results">
            <?php _e('We found ','wpestate'); ?> <span id="results_no">0</span> <?php _e('results.','wpestate'); ?>  
            <span id="showinpage"> <?php _e('Do you want to load the results now ?','wpestate');?> </span>
        </div>
        <?php } ?>

    </form>   
       <div style="clear:both;"></div>
</div>  