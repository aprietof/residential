<?php
//related listings
global $property_unit_slider;
global $no_listins_per_row;
global $wpestate_uset_unit;
global $custom_unit_structure;
global $prop_unit;
        
$custom_unit_structure  =   get_option('wpestate_property_unit_structure');
$wpestate_uset_unit     =   intval ( get_option('wpestate_uset_unit','') );
$no_listins_per_row     =   intval( get_option('wp_estate_listings_per_row', '') );
$property_unit_slider   =   get_option('wp_estate_prop_list_slider','');
$counter                =   0;
$post_category          =   get_the_terms($post->ID, 'property_category');
$post_action_category   =   get_the_terms($post->ID, 'property_action_category');
$post_city_category     =   get_the_terms($post->ID, 'property_city');
$similar_no             =   3;
$args                   =   '';
$items[]                =   '';
$items_actions[]        =   '';
$items_city[]           =   '';
$categ_array            =   '';
$action_array           =   '';
$city_array             =   '';
$not_in                 =   array();
$not_in[]               =   $post->ID;

////////////////////////////////////////////////////////////////////////////
/// compose taxomomy categ array
////////////////////////////////////////////////////////////////////////////

if ($post_category!=''):
    foreach ($post_category as $item) {
        $items[] = $item->term_id;
    }
    $categ_array=array(
            'taxonomy' => 'property_category',
            'field' => 'id',
            'terms' => $items
        );
endif;

////////////////////////////////////////////////////////////////////////////
/// compose taxomomy action array
////////////////////////////////////////////////////////////////////////////

if ($post_action_category!=''):
    foreach ($post_action_category as $item) {
        $items_actions[] = $item->term_id;
    }
    $action_array=array(
            'taxonomy' => 'property_action_category',
            'field' => 'id',
            'terms' => $items_actions
        );
endif;

////////////////////////////////////////////////////////////////////////////
/// compose taxomomy action city
////////////////////////////////////////////////////////////////////////////

if ($post_city_category!=''):
    foreach ($post_city_category as $item) {
        $items_city[] = $item->term_id;
    }
    $city_array=array(
            'taxonomy' => 'property_city',
            'field' => 'id',
            'terms' => $items_city
        );
endif;

////////////////////////////////////////////////////////////////////////////
/// compose wp_query
////////////////////////////////////////////////////////////////////////////

$args=array(
    'showposts'             => $similar_no,      
    'ignore_sticky_posts'   => 0,
    'post_type'             => 'estate_property',
    'post_status'           => 'publish',
    'post__not_in'          => $not_in,
    'tax_query'             => array(
    'relation'              => 'AND',
                               $categ_array,
                               $action_array,
                               $city_array
                               )
);


$prop_unit          =   esc_html ( get_option('wp_estate_prop_unit','') );
$compare_submit     =   get_compare_link();
$my_query           =   new WP_Query($args);

$property_card_type         =   intval(get_option('wp_estate_unit_card_type'));
$property_card_type_string  =   '';
if($property_card_type==0){
    $property_card_type_string='';
}else{
    $property_card_type_string='_type'.$property_card_type;
}

    if ($my_query->have_posts()) { ?>	
        <?php  get_template_part('templates/compare_list'); ?> 

        <div class="mylistings"> 
            <h3 class="agent_listings_title_similar" ><?php _e('Similar Listings', 'wpestate'); ?></h3>   
            <?php
            while ($my_query->have_posts()):$my_query->the_post();
                get_template_part('templates/property_unit'.$property_card_type_string); 
            endwhile;
            ?>
        </div>	
    <?php } //endif have post
    ?>


<?php
wp_reset_query();
?> 