<!-- GET AGENT LISTINGS-->
<?php
global $agent_id;
global $current_user;
global $leftcompare;
global $wp_query;
global $property_unit_slider;
global $no_listins_per_row;
global $wpestate_uset_unit;
global $custom_unit_structure;
global $align_class;
global $prop_unit;

$custom_unit_structure    =   get_option('wpestate_property_unit_structure');
$wpestate_uset_unit       =   intval ( get_option('wpestate_uset_unit','') );
$no_listins_per_row       =   intval( get_option('wp_estate_listings_per_row', '') );
$paged = (get_query_var('page')) ? get_query_var('page') : 1;

if(isset($_GET['pagelist'])){
    $paged = intval( $_GET['pagelist'] );
}else{
    $paged = 1;
}

$property_card_type         =   intval(get_option('wp_estate_unit_card_type'));
$property_card_type_string  =   '';
if($property_card_type==0){
    $property_card_type_string='';
}else{
    $property_card_type_string='_type'.$property_card_type;
}
    

$current_user = wp_get_current_user();

$userID             =   $current_user->ID;
$user_option        =   'favorites'.$userID;
$curent_fav         =   get_option($user_option);
$show_compare_link  =   'no';
$currency           =   esc_html( get_option('wp_estate_currency_symbol', '') );
$where_currency     =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
$leftcompare        =   1;
$property_unit_slider = get_option('wp_estate_prop_list_slider','');

$args = array(
    'post_type'         => 'estate_property',
    'post_status'       => 'publish',
    'paged'             => $paged,
    'posts_per_page'    => 9,
    'meta_key'          => 'prop_featured',
    'orderby'           => 'meta_value',
    'order'             => 'DESC',
    'meta_query'        => array(
                                array(
                                    'key'   => 'property_agent',
                                    'value' => $agent_id,
                                )
                        )
                );

$mapargs = array(
    'post_type'         => 'estate_property',
    'post_status'       => 'publish',
    'posts_per_page'    => -1,
    'meta_query'        => array(
                                array(
                                    'key'   => 'property_agent',
                                    'value' => $agent_id,
                                )
                        )
                );

add_filter( 'posts_orderby', 'wpestate_my_order' );
$prop_selection =   new WP_Query($args);
remove_filter( 'posts_orderby', 'wpestate_my_order' );
    
//$selected_pins  =   wpestate_listing_pins($args);//call the new pins



if ( $prop_selection->have_posts() ) {
    $show_compare   =   1;
    $compare_submit =   get_compare_link();
    
    $prop_unit                  =   esc_html ( get_option('wp_estate_prop_unit','') );
    $prop_unit_class            =   '';
    if($prop_unit=='list'){
        $prop_unit_class="ajax12";
        $align_class=   'the_list_view';
    }


    ?>
    <div class="mylistings">
        <?php  get_template_part('templates/compare_list'); ?> 
        <?php   
        print'<h3 class="agent_listings_title">'.__('My Listings','wpestate').'</h3>';
        while ($prop_selection->have_posts()): $prop_selection->the_post();                     
            get_template_part('templates/property_unit'.$property_card_type_string);
        endwhile;
        // Reset postdata
        wp_reset_postdata();
        // Custom query loop pagination
    
        ?>
        
    <?php 
        second_loop_pagination($prop_selection->max_num_pages,$range =2,$paged,get_permalink());
        //kriesi_pagination_agent($prop_selection->max_num_pages, $range =2);    
    ?>  
   
    </div>
<?php        
}


if ( get_option('wp_estate_readsys','') =='yes' ){
    $path=estate_get_pin_file_path();
    $selected_pins=file_get_contents($path);
}else{
    $selected_pins = wpestate_listing_pins($mapargs);//call the new pins  
}

wp_localize_script('googlecode_regular', 'googlecode_regular_vars2', 
        array( 'markers2'   =>  $selected_pins,
               'agent_id'   =>  $agent_id )
        ); 


////////////////////////////////////////////////////////////////////////////////////////
/////// Second loop Pagination
///////////////////////////////////////////////////////////////////////////////////////////
function second_loop_pagination($pages = '', $range = 2,$paged,$link){
        $newpage    =   $paged -1;
        if ($newpage<1){
            $newpage=1;
        }
        $next_page  =   esc_url_raw ( add_query_arg('pagelist',$newpage, esc_url ($link) ) );
        $showitems = ($range * 2)+1; 
        if($pages>1)
        {
            print "<ul class='pagination pagination_nojax pagination_agent'>";
            echo "<li class=\"roundleft\"><a href='".$next_page."'><i class=\"fa fa-angle-left\"></i></a></li>";
      
             
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    $newpage    =   $paged -1;
                    $next_page  =  esc_url_raw (add_query_arg('pagelist',$i,esc_url ($link)));
                    echo ($paged == $i)? "<li class='active'><a href='' >".$i."</a><li>":"<li><a href='".$next_page."' >".$i."</a><li>";
                }
            }

             $prev_page= get_pagenum_link($paged + 1);
            if ( ($paged +1) > $pages){
                $prev_page  =   get_pagenum_link($paged );
                $newpage    =   $paged;
                $prev_page  =   esc_url_raw(add_query_arg('pagelist',$newpage,esc_url ($link)));
            }else{
                $prev_page  =   get_pagenum_link($paged + 1);
                $newpage    =   $paged + 1;
                $prev_page  =   esc_url_raw(add_query_arg('pagelist',$newpage,esc_url ($link)));
            }

            echo "<li class=\"roundright\"><a href='".$prev_page."'><i class=\"fa fa-angle-right\"></i></a><li>";
            echo "</ul>\n";
        }
}


?>