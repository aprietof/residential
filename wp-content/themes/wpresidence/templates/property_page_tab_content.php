<?php
global $property_adr_text;
global $property_details_text;
global $property_features_text;
global $feature_list_array;
global $use_floor_plans;
global $property_description_text;
global $post;
$walkscore_api                  =   esc_html ( get_option('wp_estate_walkscore_api','') );
$show_graph_prop_page           =   esc_html( get_option('wp_estate_show_graph_prop_page', '') );
$virtual_tour                   =   get_post_meta($post->ID, 'embed_virtual_tour', true);
?>
<div role="tabpanel" id="tab_prpg">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#description" aria-controls="description" role="tab" data-toggle="tab">
        <?php 
            if($property_description_text!=''){
                echo esc_html($property_description_text);
            }else{
                _e('Description','wpestate');
            }
        ?>
        </a>
        
    </li>
    
    <li role="presentation">
        <a href="#address" aria-controls="address" role="tab" data-toggle="tab">
            <?php 
                if($property_adr_text!=''){
                    echo esc_html($property_adr_text);
                } else{
                    _e('Property Address','wpestate');
                }
            ?>
        </a>
    </li>
    
    <li role="presentation">
        <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
            <?php                      
                if($property_details_text=='') {
                    print __('Property Details', 'wpestate');
                }else{
                    print  $property_details_text;
                }
            ?>
        </a>
    </li>
    <?php
    if ( count( $feature_list_array )!= 0 && count($feature_list_array)!=1 ){ ?>
        <li role="presentation">
            <a href="#features" aria-controls="features" role="tab" data-toggle="tab">
               <?php
                    if($property_features_text ==''){
                        print __('Amenities and Features', 'wpestate');
                    }else{
                        print $property_features_text;
                    }
                ?>
            </a>
        </li>
    <?php } ?>
    
    <?php
    $prpg_slider_type_status= esc_html ( get_option('wp_estate_global_prpg_slider_type','') ); 
    $local_pgpr_slider_type_status  =   get_post_meta($post->ID, 'local_pgpr_slider_type', true);
    
    if( ($local_pgpr_slider_type_status=='global' && $prpg_slider_type_status == 'full width header') ||
            $local_pgpr_slider_type_status=='full width header' ){
    ?>
       <li role="presentation" id="propmaptrigger">
            <a href="#propmap" aria-controls="propmap" role="tab" data-toggle="tab">
                <?php _e('Map','wpestate');?>
            </a>
        </li>
    <?php } ?>
        
        
    <?php if($virtual_tour!=''){?>   
        <li role="presentation">
            <a href="#virtual_tour" aria-controls="virtual_tour" role="tab" data-toggle="tab">
                <?php _e('Virtual Tour','wpestate');?>
            </a>
        </li>
    <?php } ?>    
    
    <?php if($walkscore_api!=''){?>
        <li role="presentation">
            <a href="#walkscore" aria-controls="walkscore" role="tab" data-toggle="tab">
                <?php _e('Walkscore','wpestate');?>
            </a>
        </li>
    <?php } ?>
        
    <?php 
    $yelp_api_id            = get_option('wp_estate_yelp_api_id','');
    $yelp_api_secret        = get_option('wp_estate_yelp_api_secret','');
    $yelp_api_token         = get_option('wp_estate_yelp_api_token','');
    $yelp_api_token_secret  = get_option('wp_estate_yelp_api_token_secret','');


    if($yelp_api_id!=='' && $yelp_api_secret!=='' &&  $yelp_api_token!=='' &&  $yelp_api_token_secret!=='' ){ ?>
        <li role="presentation">
        <a href="#yelp" aria-controls="yelp" role="tab" data-toggle="tab">
                <?php _e('What\'s Nearby','wpestate');?>
            </a>
        </li>
    <?php
    }
    ?>    
        
        
    
    <?php if ( $use_floor_plans==1 ){  ?>
    <li role="presentation">
        <a href="#floor" aria-controls="floor" role="tab" data-toggle="tab">
            <?php _e('Floor Plans','wpestate');?>
        </a>
    </li>
    <?php } ?>
    
    <?php if($show_graph_prop_page=='yes'){?>
    <li role="presentation" class="tabs_stats" data-listingid="<?php echo intval($post->ID);?>">
        <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">
            <?php _e('Page Views','wpestate');?>
        </a>
    </li>
    <?php }?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="description">
        <?php 
            $content = get_the_content();
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);

            if($content!=''){                            
                print $content;     
            }

            get_template_part ('/templates/download_pdf');
        ?>      
    </div>

    <div role="tabpanel" class="tab-pane" id="address">
        <?php print estate_listing_address($post->ID); ?>
    </div>
      
    <div role="tabpanel" class="tab-pane" id="details">
        <?php print estate_listing_details($post->ID);?>  
    </div>
      
    <div role="tabpanel" class="tab-pane" id="features">
        <?php print estate_listing_features($post->ID); ?>
    </div>  
    
    <?php
    $prpg_slider_type_status= esc_html ( get_option('wp_estate_global_prpg_slider_type','') );        
    if( ($local_pgpr_slider_type_status == 'global' && $prpg_slider_type_status == 'full width header') ||
        $local_pgpr_slider_type_status  == 'full width header' ){
    ?>
    <div role="propmap" class="tab-pane" id="propmap">
        <?php print do_shortcode('[property_page_map propertyid="'.$post->ID.'" istab="1"][/property_page_map]') ?>
    </div> 
    <?php } ?>  
    
    <?php if($virtual_tour!=''){?>
        <div role="tabpanel" class="tab-pane" id="virtual_tour">
            <?php wpestate_virtual_tour_details($post->ID); ?>
        </div>
    <?php } ?> 
      
    <?php if($walkscore_api!=''){?>
        <div role="tabpanel" class="tab-pane" id="walkscore">
            <?php wpestate_walkscore_details($post->ID); ?>
        </div>
    <?php } ?> 
      
    
      
    <?php  if($yelp_api_id!=='' && $yelp_api_secret!=='' &&  $yelp_api_token!=='' &&  $yelp_api_token_secret!=='' ){ ?> 
        <div role="tabpanel" class="tab-pane" id="yelp">
            <?php wpestate_yelp_details($post->ID); ?>
        </div>
    <?php } ?> 
      
    <?php if ( $use_floor_plans==1 ){  ?>
        <div role="tabpanel" class="tab-pane" id="floor">
            <?php print estate_floor_plan($post->ID); ?>
        </div>
    <?php } ?>
      
    <?php if($show_graph_prop_page=='yes'){ ?>
        <div role="tabpanel" class="tab-pane" id="stats">
             <div class="panel-body">
                <canvas id="myChart"></canvas>
             </div>
        </div>
    <?php } ?>
      
      
  </div>

</div>