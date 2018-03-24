<?php

$main_color                     =   esc_html ( get_option('wp_estate_main_color','') );
$background_color               =   esc_html( get_option('wp_estate_background_color', '') );
$content_back_color             =   esc_html( get_option('wp_estate_content_back_color', '') );
$header_color                   =   esc_html( get_option('wp_estate_header_color', '') );
$breadcrumbs_font_color         =   esc_html(get_option('wp_estate_breadcrumbs_font_color', '') );
$menu_items_color               =   esc_html(get_option('wp_estate_menu_items_color', '') );
$font_color                     =   esc_html(get_option('wp_estate_font_color', '') );
$link_color                     =   esc_html(get_option('wp_estate_link_color', '') );
$headings_color                 =   esc_html(get_option('wp_estate_headings_color', '') );
$footer_back_color              =   esc_html(get_option('wp_estate_footer_back_color', '') );
$footer_font_color              =   esc_html(get_option('wp_estate_footer_font_color', '') );
$footer_copy_color              =   esc_html(get_option('wp_estate_footer_copy_color', '') );
$footer_copy_back_color         =   esc_html(get_option('wp_estate_footer_copy_back_color', '') );
$sidebar2_font_color            =   esc_html(get_option('wp_estate_sidebar2_font_color', '') );
$menu_font_color                =   esc_html(get_option('wp_estate_menu_font_color', '') );
$menu_hover_back_color          =   esc_html(get_option('wp_estate_menu_hover_back_color', '') );
$menu_hover_font_color          =   esc_html(get_option('wp_estate_menu_hover_font_color', '') );
$menu_border_color              =   esc_html ( get_option('wp_estate_menu_border_color','') );
$agent_color                    =   esc_html(get_option('wp_estate_agent_color', '') );
$top_bar_back                   =   esc_html ( get_option('wp_estate_top_bar_back','') );
$top_bar_font                   =   esc_html ( get_option('wp_estate_top_bar_font','') );
$adv_search_back_color          =   esc_html ( get_option('wp_estate_adv_search_back_color ','') );
$adv_search_font_color          =   esc_html ( get_option('wp_estate_adv_search_font_color','') );
$box_content_back_color         =   esc_html ( get_option('wp_estate_box_content_back_color','') );
$box_content_border_color       =   esc_html ( get_option('wp_estate_box_content_border_color','') );
$hover_button_color             =   esc_html ( get_option('wp_estate_hover_button_color','') );
 
$top_menu_hover_font_color                =  esc_html ( get_option('wp_estate_top_menu_hover_font_color','') );
    
/// Custom Colors
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($main_color != '') {
print'
    
.ll-skin-melon td .ui-state-active,
.ll-skin-melon td .ui-state-hover,
.adv_search_tab_item.active,    
button.slick-prev.slick-arrow, button.slick-next.slick-arrow,
.wpresidence_button,.comment-form #submit, #adv-search-header-3,#tab_prpg>ul,.wpcf7-form input[type="submit"],
.adv_results_wrapper #advanced_submit_2,.wpb_btn-info,#slider_enable_map:hover, #slider_enable_street:hover, 
#slider_enable_slider:hover,#colophon .social_sidebar_internal a:hover, #primary .social_sidebar_internal a:hover,
.ui-widget-header,.slider_control_left, .slider_control_right,.single-content input[type="submit"] ,
#slider_enable_slider.slideron,#slider_enable_street.slideron, #slider_enable_map.slideron ,
.comment-form #submit,#add_favorites.isfavorite:hover,#add_favorites:hover,.carousel-control-theme-prev,.carousel-control-theme-next,
#primary .social_sidebar_internal a:hover , #adv-search-header-mobile,#adv-search-header-1, .featured_second_line, 
.wpb_btn-info, .agent_contanct_form input[type="submit"]{
    background-color: #' . $main_color . '!important;
}
.wpresidence_button{
border:none;
}

.comment-form #submit, 
.blog_unit_image img, .blog2v img, .single-content input[type="submit"] ,
.agentpict,.featured_property img , .agent_unit img {
    border-bottom: 3px solid #'.$main_color.'!important;
}

.single-content p a:hover,
.agent_unit_social a:hover,
.featured_prop_price .price_label,
.featured_prop_price .price_label_before,.compare_item_head .property_price,#grid_view:hover, 
#list_view:hover,#primary a:hover,.front_plan_row:hover,.adv_extended_options_text,.slider-content h3 a:hover,
.agent_unit_social_single a:hover ,
.adv_extended_options_text:hover ,.breadcrumb a:hover , .property-panel h4:hover,
.featured_article:hover .featured_article_right, .info_details .prop_pricex,.info_details .infocur,#contactinfobox,
.featured_property:hover h2 a,
.blog_unit:hover h3 a,.blog_unit_meta .read_more:hover,
.blog_unit_meta a:hover,.agent_unit:hover h4 a,.listing_filter_select.open .filter_menu_trigger,
.wpestate_accordion_tab .ui-state-active a,.wpestate_accordion_tab .ui-state-active a:link,.wpestate_accordion_tab .ui-state-active a:visited,
.theme-slider-price, .agent_unit:hover h4 a,.meta-info a:hover,.widget_latest_price,.pack-listing-title,#colophon a:hover, #colophon li a:hover,
.price_area, .property_listing:hover h4 a, .listing_unit_price_wrapper,a:hover, a:focus, .top_bar .social_sidebar_internal a:hover,
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, 
.pagination > .active > a:focus, .pagination > .active > span:focus,.featured_prop_price,.user_menu,.user_loged i, 
#access .current-menu-item >a, #access .current-menu-parent>a, #access .current-menu-ancestor>a,#access .menu li:hover>a, 
#access .menu li:hover>a:active, #access .menu li:hover>a:focus{
    color: #' . $main_color . ';
}
#amount_wd, #amount,#amount_mobile,#amount_sh{
    color: #' . $main_color . '!important;
}
        
.featured_article_title{
    border-top: 3px solid #'.$main_color.'!important;
}
.adv_search_tab_item.active,
.scrollon {
    border: 1px solid #'.$main_color.';
}
';   
    

} 

    
if ($background_color != '') {
print'body,.wide {background-color: #' . $background_color . ';} ';        
} // end $background_color


if ($content_back_color != '') {
print '.content_wrapper{ background-color: #' . $content_back_color . ';} ';
}// end content_back_color


if ($header_color != '') {
print'
    .fixed_header.header_transparent .header_wrapper,
    .header_transparent .header_wrapper.navbar-fixed-top.customnav,
    .header_wrapper ,
    .master_header,
    #access ul ul,.customnav{
        background-color: #' . $header_color . '
    }'; 
} // end $header_color


if ($breadcrumbs_font_color != '') {
print '
.featured_article_righ, .featured_article_secondline,
.property_location .inforoom, .property_location .infobath , .agent_meta , .blog_unit_meta a, .property_location .infosize,
.sale_line , .meta-info a, .breadcrumb > li + li:before, .blog_unit_meta, .meta-info,.agent_position,.breadcrumb a {
    color: #' . $breadcrumbs_font_color . ';
}';
} // end $breadcrumbs_font_color 


if ($menu_font_color != '') {
    print '
    #header4_footer,
    #header4_footer .widget-title-header4,
    #header4_footer a,
    .submit_action,
    #access ul.menu >li>a{
        color: #' . $menu_font_color . ';
    }
    
    .menu_user_picture{
        border-color:#' . $menu_font_color . ';
    }
    
    .navicon:before, 
    .navicon:after,
    .navicon{  
        background: #'.$menu_font_color.';
     }';
} 

$transparent_menu_font_color                =  esc_html ( get_option('wp_estate_transparent_menu_font_color','') );
if ($transparent_menu_font_color != '') {
    print '
    .header_transparent .menu_user_tools, 
    .header_transparent .submit_action,
    .header_transparent #access ul.menu >li>a{
        color: #' . $transparent_menu_font_color . ';
    }
    
    .header_transparent .navicon:before, 
    .header_transparent .navicon:after,
    .header_transparent .navicon{
        background: #' . $transparent_menu_font_color . ';
    }
    .header_transparent .menu_user_picture{
        border-color: #' . $transparent_menu_font_color . ';
    }
    '; 
    
    

} 


if($top_menu_hover_font_color!=''){

    print '
    .header_type3_menu_sidebar #access .menu li:hover>a, 
    .header_type3_menu_sidebar #access .menu li:hover>a:active, 
    .header_type3_menu_sidebar #access .menu li:hover>a:focus,
    .customnav #access ul.menu >li>a:hover,
    #access ul.menu >li>a:hover,
    .hover_type_3 #access .menu > li:hover>a,
    .hover_type_4 #access .menu > li:hover>a,
    .hover_type_6 #access .menu > li:hover>a {
        color: #' . $top_menu_hover_font_color . ';
    }
    .hover_type_5 #access .menu > li:hover>a {
        border-bottom: 3px solid #' . $top_menu_hover_font_color . ';
    }
    .hover_type_6 #access .menu > li:hover>a {
      border: 2px solid #' . $top_menu_hover_font_color . ';
    }
    .hover_type_2 #access .menu > li:hover>a:before {
        border-top: 3px solid #' . $top_menu_hover_font_color . ';
    }'; 
   

}
$transparent_menu_hover_font_color               =  esc_html ( get_option('wp_estate_transparent_menu_hover_font_color','') );
  
if($transparent_menu_hover_font_color!=''){

    print '
    .header_transparent .customnav #access ul.menu >li>a:hover,
    .header_transparent #access ul.menu >li>a:hover,
    .header_transparent .hover_type_3 #access .menu > li:hover>a,
    .header_transparent .hover_type_4 #access .menu > li:hover>a,
    .header_transparent .hover_type_6 #access .menu > li:hover>a {
        color: #' . $transparent_menu_hover_font_color . ';
    }
    .header_transparent .hover_type_5 #access .menu > li:hover>a {
        border-bottom: 3px solid #' . $transparent_menu_hover_font_color . ';
    }
    .header_transparent .hover_type_6 #access .menu > li:hover>a {
      border: 2px solid #' . $transparent_menu_hover_font_color . ';
    }
    .header_transparent .hover_type_2 #access .menu > li:hover>a:before {
        border-top: 3px solid #' . $transparent_menu_hover_font_color . ';
    }'; 
   

}



$top_menu_hover_back_font_color                =  esc_html ( get_option('wp_estate_top_menu_hover_back_font_color','') );
if($top_menu_hover_back_font_color !=''){
    print '
     .alalx223,
       .header_type3_menu_sidebar .menu > li:hover,
    .hover_type_3 #access .menu > li:hover>a,
    .hover_type_4 #access .menu > li:hover>a {
        background: #'.$top_menu_hover_back_font_color.'!important;
    }';
}
    

$sticky_menu_font_color                =  esc_html ( get_option('wp_estate_sticky_menu_font_color','') );
if($sticky_menu_font_color!=''){
    print '
    .customnav .submit_action,
    .customnav #access ul.menu >li>a{
        color: #' . $sticky_menu_font_color . ';
    }
    .customnav .menu_user_picture{
        border-color:#' . $sticky_menu_font_color . ';
    }
    
    .customnav .navicon:before, 
    .customnav .navicon:after,
    .customnav .navicon{  
        background: #'.$sticky_menu_font_color.';
    }'; 
     
}


$menu_item_back_color         =  esc_html ( get_option('wp_estate_menu_item_back_color','') );
if($menu_item_back_color!=''){
    print '
    #access ul ul{
        background-color: #' . $menu_item_back_color . ';
    }'; 
     
}


  
  
  
  
if ($menu_hover_back_color != '') {
    print '
    #user_menu_open > li > a:hover,
    #user_menu_open > li > a:focus,
    .filter_menu li:hover,
    .sub-menu li:hover, #access .menu li:hover>a, 
    #access .menu li:hover>a:active, 
    #access .menu li:hover>a:focus{
    background-color: #'.$menu_hover_back_color.';}
    
    .form-control.open .filter_menu_trigger, .menu_user_tools{
        color: #'.$menu_hover_back_color.';
    }
    .menu_user_picture {
        border: 1px solid #'.$menu_hover_back_color.';
    }
    ';
} // end $menu_hover_back_color


if ($menu_hover_font_color != '') {
    print '
    #access .menu ul li:hover>a,
    #access .sub-menu li:hover>a,
    #access .sub-menu li:hover>a:active, 
    #access .sub-menu li:hover>a:focus {
        color: #'.$menu_hover_font_color.';
    }
    ';
} // end $menu_hover_font_color


if($menu_border_color!=''){
    print'#access ul ul {
        border-left: 1px solid   #'.$menu_border_color.'!important;
        border-right: 1px solid  #'.$menu_border_color.'!important;
        border-bottom: 1px solid #'.$menu_border_color.'!important;
        border-top: 1px solid #'.$menu_border_color.'!important;
    }
    #access ul ul a {
        border-bottom: 1px solid #'.$menu_border_color.';
    }';
}

$wp_estate_top_menu_font_size     = get_option('wp_estate_top_menu_font_size','');
if($wp_estate_top_menu_font_size!=''){     
    print '
    #access ul.menu >li>a{
        font-size:' . $wp_estate_top_menu_font_size . 'px;
    }'; 
}
 
$wp_estate_menu_item_font_size     = get_option('wp_estate_menu_item_font_size','');

if($wp_estate_menu_item_font_size!=''){     
    print '
        #access ul ul a,
        #access ul ul li.wpestate_megamenu_col_1, 
        #access ul ul li.wpestate_megamenu_col_2, 
        #access ul ul li.wpestate_megamenu_col_3, 
        #access ul ul li.wpestate_megamenu_col_4, 
        #access ul ul li.wpestate_megamenu_col_5, 
        #access ul ul li.wpestate_megamenu_col_6, 
        #access ul ul li.wpestate_megamenu_col_1 a, 
        #access ul ul li.wpestate_megamenu_col_2 a, 
        #access ul ul li.wpestate_megamenu_col_3 a, 
        #access ul ul li.wpestate_megamenu_col_4 a, 
        #access ul ul li.wpestate_megamenu_col_5 a, 
        #access ul ul li.wpestate_megamenu_col_6 a{
            font-size:' . $wp_estate_menu_item_font_size . 'px;
    }'; 
}




if ($menu_items_color != '') {
    print '
        #access a,
        #access ul ul a,
        #access ul ul li.wpestate_megamenu_col_1, 
        #access ul ul li.wpestate_megamenu_col_2, 
        #access ul ul li.wpestate_megamenu_col_3, 
        #access ul ul li.wpestate_megamenu_col_4, 
        #access ul ul li.wpestate_megamenu_col_5, 
        #access ul ul li.wpestate_megamenu_col_6, 
        #access ul ul li.wpestate_megamenu_col_1 a, 
        #access ul ul li.wpestate_megamenu_col_2 a, 
        #access ul ul li.wpestate_megamenu_col_3 a, 
        #access ul ul li.wpestate_megamenu_col_4 a, 
        #access ul ul li.wpestate_megamenu_col_5 a, 
        #access ul ul li.wpestate_megamenu_col_6 a {
        color:#'.$menu_items_color.';
        }';  
   print '
       #access ul ul li.wpestate_megamenu_col_1 .megamenu-title:hover a, 
       #access ul ul li.wpestate_megamenu_col_2 .megamenu-title:hover a, 
       #access ul ul li.wpestate_megamenu_col_3 .megamenu-title:hover a, 
       #access ul ul li.wpestate_megamenu_col_4 .megamenu-title:hover a, 
       #access ul ul li.wpestate_megamenu_col_5 .megamenu-title:hover a, 
       #access ul ul li.wpestate_megamenu_col_6 .megamenu-title:hover a,
       #access .with-megamenu .sub-menu li:hover>a, 
       #access .with-megamenu .sub-menu li:hover>a:active, 
       #access .with-megamenu .sub-menu li:hover>a:focus,
       #access .current-menu-item >a, 
       #access .current-menu-parent>a, 
       #access .current-menu-ancestor>a,
       #access .menu li:hover>a, 
       #access .menu li:hover>a:active, 
       #access .menu li:hover>a:focus{
        color: #' . $menu_items_color . ';
    }'; 
   
 
    
   
}
















if ($font_color != '') {
print'body,a,label,input[type=text], input[type=password], input[type=email], 
    input[type=url], input[type=number], textarea, .slider-content, .listing-details, .form-control, #user_menu_open i,
#grid_view, #list_view, .listing_details a, .notice_area, .social-agent-page a, .prop_detailsx, #reg_passmail_topbar,
#reg_passmail, .testimonial-text,
.wpestate_tabs .ui-widget-content, 
.wpestate_tour .ui-widget-content, .wpestate_accordion_tab .ui-widget-content, 
.wpestate_accordion_tab .ui-state-default, .wpestate_accordion_tab .ui-widget-content .ui-state-default, 
.wpestate_accordion_tab .ui-widget-header .ui-state-default,
.filter_menu{ color: #' . $font_color . ';}';

print '.caret, .caret_sidebar, .advanced_search_shortcode .caret_filter{ border-top-color:#' . $font_color . ';}';

} // end $font_color #a0a5a8



if ($link_color != '') {
    
print '
.pagination > li > a,
.pagination > li > span,
.single-content p a,
.featured_article:hover h2 a,
.user_dashboard_listed a,
.blog_unit_meta .read_more, 
.slider-content .read_more, 
.blog2v .read_more, 
.breadcrumb .active,
.unit_more_x a, .unit_more_x{
    color: #'.$link_color.';
}';
    
} // end $link_color



if ($headings_color != '') {
print 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a ,.featured_property h2 a, .featured_property h2,'
    . '.blog_unit h3, .blog_unit h3 a,.submit_container_header,.info_details #infobox_title {color: #'.$headings_color.';}';
} // end $headings_color 



if ($footer_back_color != '') {
print '#colophon {background-color: #'.$footer_back_color.';}';
} // end 


if ($footer_font_color != '') {
print '#colophon, #colophon a, #colophon li a ,#colophon .widget-title-footer{color: #'.$footer_font_color.';}';
} 

if ($footer_copy_color != '') {
    print '.sub_footer, .subfooter_menu a, .subfooter_menu li a {color: #'.$footer_copy_color.'!important;}';
} 

if($footer_copy_back_color!=''){
    print '.sub_footer{background-color:#'.$footer_copy_back_color.';};'; 
}






if($top_bar_back!=''){
    print '.top_bar_wrapper{background-color:#'.$top_bar_back.';}';
}    

if($top_bar_font!=''){
    print '.top_bar,.top_bar a{color:#'.$top_bar_font.';}';
}
 
if ($adv_search_back_color != '') {
    print '#advanced_submit_3,#search_wrapper, .adv-search-1 .wpresidence_button{background-color:#'.$adv_search_back_color.'!important;}';
} 

if ($adv_search_font_color != '') {
    print '.advanced_search_shortcode .caret_filter,
    .advanced_search_shortcode .form-control,
    .advanced_search_shortcode input[type=text],
    .advanced_search_shortcode .form-control::-webkit-input-placeholder,
    .adv-search-1 .caret_filter,
    .adv-search-1 .form-control,
    .adv-search-3 .caret_filter,
    .adv-search-3 .form-control,
    .adv-search-1 input[type=text],
    .adv-search-3 input[type=text],
    .adv-search-1 .form-control::-webkit-input-placeholder,
    .adv-search-3 .form-control::-webkit-input-placeholder{color:#'.$adv_search_font_color.';}';
} 

if ($box_content_back_color != '') {
    print '.featured_article_title, .testimonial-text, .adv1-holder,.advanced_search_shortcode, .featured_secondline , '
    . '.property_listing ,.agent_unit, .blog_unit { background-color:#'.$box_content_back_color.';}';
} 

if ($box_content_border_color != '') {
    print '
    .featured_article,.mortgage_calculator_div, .loginwd_sidebar, .advanced_search_sidebar, 
    .advanced_search_shortcode, #access ul ul, .testimonial-text, .submit_container, .zillow_widget, 
    .featured_property, .property_listing ,.agent_unit,.blog_unit,property_listing{
        border-color:#'.$box_content_border_color.';
    } 
 
    .company_headline, .loginwd_sidebar .widget-title-sidebar,
    .advanced_search_sidebar .widget-title-footer,.advanced_search_sidebar .widget-title-sidebar ,
    .zillow_widget .widget-title-footer,.zillow_widget .widget-title-sidebar, .adv1-holder,.notice_area,
    .top_bar_wrapper, .master_header,#access ul ul a , .listing_filters_head, .listing_filters{
        border-bottom: 1px solid #'.$box_content_border_color.';
    }
    
    .notice_area,.listing_filters_head, .listing_filters{
        border-top: 1px solid #'.$box_content_border_color.';
    }
    
    .adv1-holder{
        border-left: 1px solid #'.$box_content_border_color.';
    }
    
    #search_wrapper{
      border-bottom: 3px solid #'.$box_content_border_color.';
    }'; 
} 

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// End colors


if ($hover_button_color!=''){
    print '
    .wpresidence_button:hover,
    .twitter_wrapper, 
    .slider_control_right:hover, 
    .slider_control_left:hover, 
    .comment-form #submit:hover, 
    .carousel-control-theme-prev:hover, 
    .carousel-control-theme-next:hover , 
    .wpb_btn-info:hover, 
    #advanced_submit_2:hover, 
    #agent_submit:hover{
        background-color: #' . $hover_button_color . '!important;
    }
    
   
   
    
    .icon_selected,.featured_prop_label {
        color: #' . $hover_button_color . '!important;
    }
    #tab_prpg li{
        border-right: 1px solid #'. $hover_button_color.';
    }';
}

$adv_back_color              =  esc_html ( get_option('wp_estate_adv_back_color','') );
if( $adv_back_color  !=''){ 
    print'.adv-search-3,.adv1-holder,.adv8-holder .tab-content,.adv-search-1,.search_wr_5 .adv-search-1,#search_wrapper.search_wr_5 ,#search_wrapper.search_wr_7 ,#search_wrapper{  background-color: #' . $adv_back_color . '!important;}';    
    print '.adv-search-1#adv-search-8{background:transparent!important;}';
    
}

$adv_font_color             =  esc_html ( get_option('wp_estate_adv_font_color','') );
if( $adv_font_color  !=''){ 
    print'.adv-search-3,#amount,.adv-search-1 label,.adv_search_slider label,.adv_search_slider span,.adv_extended_options_text{  color: #' . $adv_font_color . '!important;}';    

    print '';
    
}




?>