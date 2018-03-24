<?php


if(!function_exists('wpestate_custom_fonts_elements')):
    function wpestate_custom_fonts_elements(){
        $style='';
        $h1_fontfamily =    esc_html( get_option('wp_estate_h1_fontfamily', '') );
        $h1_fontfamily =    str_replace('+', '', $h1_fontfamily);
        $h1_fontsubset =    esc_html( get_option('wp_estate_h1_fontsubset', '') );
        $h1_fontsize   =    esc_html( get_option('wp_estate_h1_fontsize') );
        $h1_lineheight =    esc_html( get_option('wp_estate_h1_lineheight') );
        $h1_fontweight =    esc_html( get_option('wp_estate_h1_fontweight') );

       
        if ($h1_fontfamily != '') {
            $style.= 'h1,h1 a{font-family:"' . $h1_fontfamily .'";}';
        }     
        if ($h1_fontsize != '') { 
            $style.= 'h1,h1 a{font-size:' . $h1_fontsize .'px;}';
        }
        if ($h1_lineheight != '') {  
            $style.= 'h1,h1 a{line-height:' . $h1_lineheight .'px;}';
        }
        if ($h1_fontweight != '') {  
            $style.=  'h1,h1 a{font-weight:' . $h1_fontweight .';}';
        }
     
        
        $h2_fontfamily =    esc_html( get_option('wp_estate_h2_fontfamily', '') );
        $h2_fontfamily =    str_replace('+', ' ', $h2_fontfamily);
        $h2_fontsize   =    esc_html( get_option('wp_estate_h2_fontsize') );
        $h2_lineheight =    esc_html( get_option('wp_estate_h2_lineheight') );
        $h2_fontweight =    esc_html( get_option('wp_estate_h2_fontweight') );


     
        if ($h2_fontfamily != '') {
            $style.=  'h2,h2 a{font-family:"' . $h2_fontfamily .'";}';
        }     
        if ($h2_fontsize != '') { 
            $style.=  'h2,h2 a{font-size:' . $h2_fontsize .'px;}';
        }
        if ($h2_lineheight != '') {  
            $style.=  'h2,h2 a{line-height:' . $h2_lineheight .'px;}';
        }
        if ($h2_fontweight != '') {  
            $style.=  'h2,h2 a{font-weight:' . $h2_fontweight .';}';
        }
          
 
        $h3_fontfamily =    esc_html( get_option('wp_estate_h3_fontfamily', '') );
        $h3_fontfamily =    str_replace('+', ' ', $h3_fontfamily);
        $h3_fontsize   =    esc_html( get_option('wp_estate_h3_fontsize') );
        $h3_lineheight =    esc_html( get_option('wp_estate_h3_lineheight') );
        $h3_fontweight =    esc_html( get_option('wp_estate_h3_fontweight') );
     
        if ($h3_fontfamily != '') {
            $style.=  'h3,h3 a{font-family:"' . $h3_fontfamily .'";}';
        }     
        if ($h3_fontsize != '') { 
            $style.=  'h3,h3 a{font-size:' . $h3_fontsize .'px;}';
        }if ($h3_lineheight != '') {  
            $style.=  'h3,h3 a{line-height:' . $h3_lineheight .'px;}';
        }
        if ($h3_fontweight != '') {  
            $style.=  'h3,h3 a{font-weight:' . $h3_fontweight .';}';
        }

        
        $h4_fontfamily =    esc_html( get_option('wp_estate_h4_fontfamily', '') );
        $h4_fontfamily =    str_replace('+', ' ', $h4_fontfamily);
        $h4_fontsize   =    esc_html( get_option('wp_estate_h4_fontsize') );
        $h4_lineheight =    esc_html( get_option('wp_estate_h4_lineheight') );
        $h4_fontweight =    esc_html( get_option('wp_estate_h4_fontweight') );
        
        if ($h4_fontfamily != '') {
             $style.=  'h4,h4 a{font-family:"' . $h4_fontfamily .'";}';
        }     
        if ($h4_fontsize != '') { 
            $style.=  'h4,h4 a{font-size:' . $h4_fontsize .'px;}';
        }
        if ($h4_lineheight != '') {  
            $style.=  'h4,h4 a{line-height:' . $h4_lineheight .'px;}';
        }
        if ($h4_fontweight != '') {  
            $style.=  'h4,h4 a{font-weight:' . $h4_fontweight .';}';
        }
         
        
        $h5_fontfamily =    esc_html( get_option('wp_estate_h5_fontfamily', '') );
        $h5_fontfamily =    str_replace('+', ' ', $h5_fontfamily);
        $h5_fontsize   =    esc_html( get_option('wp_estate_h5_fontsize') );
        $h5_lineheight =    esc_html( get_option('wp_estate_h5_lineheight') );
        $h5_fontweight =    esc_html( get_option('wp_estate_h5_fontweight') );

        if ($h5_fontfamily != '') {
            $style.= 'h5,h5 a{font-family:"' . $h5_fontfamily .'";}';
        }     
        if ($h5_fontsize != '') { 
            $style.= 'h5,h5 a{font-size:' . $h5_fontsize .'px;}';
        }
        if ($h5_lineheight != '') {  
            $style.= 'h5,h5 a{line-height:' . $h5_lineheight .'px;}';
        }
        if ($h5_fontweight != '') {  
            $style.= 'h5,h5 a{font-weight:' . $h5_fontweight .';}';
        }
          
        $h6_fontfamily =    esc_html( get_option('wp_estate_h6_fontfamily', '') );
        $h6_fontfamily =    str_replace('+', ' ', $h6_fontfamily);
        $h6_fontsize   =    esc_html( get_option('wp_estate_h6_fontsize') );
        $h6_lineheight =    esc_html( get_option('wp_estate_h6_lineheight') );
        $h6_fontweight =    esc_html( get_option('wp_estate_h6_fontweight') );

        if ($h6_fontfamily != '') {
            $style.=  'h6,h6 a{font-family:"' . $h6_fontfamily .'";}';
        }     
        if ($h6_fontsize != '') { 
           $style.=  'h6,h6 a{font-size:' . $h6_fontsize .'px;}';
        }if ($h6_lineheight != '') {  
           $style.=  'h6,h6 a{line-height:' . $h6_lineheight .'px;}';
        }
        if ($h6_fontweight != '') {  
           $style.=  'h6,h6 a{font-weight:' . $h6_fontweight .';}';
        }

      
        $p_fontfamily = esc_html( get_option('wp_estate_p_fontfamily', '') );
        $p_fontfamily = str_replace('+', ' ', $p_fontfamily);
        $p_fontsize   = esc_html( get_option('wp_estate_p_fontsize') );
        $p_lineheight = esc_html( get_option('wp_estate_p_lineheight') );
        $p_fontweight = esc_html( get_option('wp_estate_p_fontweight') );

        if ($p_fontfamily != '') {
            $style.=  'body,p{font-family:"' . $p_fontfamily .'";}';
        }     
        if ($p_fontsize != '') { 
            $style.=  '.single-content,p{font-size:' . $p_fontsize .'px;}';
        }
        if ($p_lineheight != '') {  
            $style.=  'p{line-height:' . $p_lineheight .'px;}';
        }
        if ($p_fontweight != '') {  
            $style.=  'p{font-weight:' . $p_fontweight .';}';
        }
          
        $menu_fontfamily =  esc_html( get_option('wp_estate_menu_fontfamily', '') );
        $menu_fontfamily =  str_replace('+', ' ', $menu_fontfamily);
        $menu_fontsize   =  esc_html( get_option('wp_estate_menu_fontsize') );
        $menu_lineheight =  esc_html( get_option('wp_estate_menu_lineheight') );
        $menu_fontweight =  esc_html( get_option('wp_estate_menu_fontweight') );

       
        if ($menu_fontfamily != '') {
             $style.= '#access a,#access ul ul a,#user_menu_u{font-family:"' . $menu_fontfamily .'";}';
        }     
        if ($menu_fontsize != '') { 
            $style.= '#access a,#user_menu_u{font-size:' . $menu_fontsize .'px;}';
        }
        if ($menu_lineheight != '') {  
            $style.= '#access a,#user_menu_u{line-height:' . $menu_lineheight .'px;}';
        }
        if ($menu_fontweight != '') {  
            $style.= '#access a,#user_menu_u{font-weight:' . $menu_fontweight .';}';
        }
      
        
        
        
        
        if($style!=''){
            //echo "<style type='text/css'>".$style."</style>";  
            echo $style; 
        }
    }
endif;











if( !function_exists('wpestate_general_design_elements') ):
    function wpestate_general_design_elements(){
        $style='
        ';   
      
        $main_grid_content_width                    =   esc_html ( get_option('wp_estate_main_grid_content_width','') );
        $main_content_width                         =   esc_html ( get_option('wp_estate_main_content_width','') );
        $header_height                              =   esc_html ( get_option('wp_estate_header_height','') );   
        $sticky_header_height                       =   esc_html ( get_option('wp_estate_sticky_header_height','') );
        $border_radius_corner                       =   get_option('wp_estate_border_radius_corner','');
        $cssbox_shadow                              =   get_option('wp_estate_cssbox_shadow','');
        $prop_unit_min_height                       =   get_option('wp_estate_prop_unit_min_height','');
        $border_bottom_header                       =   esc_html ( get_option('wp_estate_border_bottom_header','') );
        $sticky_border_bottom_header                =   esc_html ( get_option('wp_estate_sticky_border_bottom_header','') );
        $border_bottom_header_sticky_color          =   esc_html ( get_option('wp_estate_border_bottom_header_sticky_color','') );
        $border_bottom_header_color                 =   esc_html ( get_option('wp_estate_border_bottom_header_color','') );
        $cssbox_shadow_value                        =   esc_html ( get_option('wp_estate_cssbox_shadow','') );
        
        $property_unit_color                        =   esc_html ( get_option('wp_estate_property_unit_color','') );
        $propertyunit_internal_padding_top          =   get_option('wp_estate_propertyunit_internal_padding_top','');
        $propertyunit_internal_padding_left         =   get_option('wp_estate_propertyunit_internal_padding_left','');
        $propertyunit_internal_padding_bottom       =   get_option('wp_estate_propertyunit_internal_padding_bottom','');
        $propertyunit_internal_padding_right        =   get_option('wp_estate_propertyunit_internal_padding_right','');
    
        $wp_estate_content_area_back_color                   = esc_html ( get_option('wp_estate_content_area_back_color','') );
        $wp_estate_contentarea_internal_padding_top          = get_option('wp_estate_contentarea_internal_padding_top','');
        $wp_estate_contentarea_internal_padding_left         = get_option('wp_estate_contentarea_internal_padding_left','');
        $wp_estate_contentarea_internal_padding_bottom       = get_option('wp_estate_contentarea_internal_padding_bottom','');
        $wp_estate_contentarea_internal_padding_right        = get_option('wp_estate_contentarea_internal_padding_right','');
        
        $blog_unit_min_height       = get_option('wp_estate_blog_unit_min_height','');
        $agent_unit_min_height      = get_option('wp_estate_agent_unit_min_height','');
        
        $unit_border_color          =  esc_html ( get_option('wp_estate_unit_border_color','') );
        $unit_border_size           = get_option('wp_estate_unit_border_size','');
        
        $wp_estate_widget_sidebar_border_size   = get_option('wp_estate_widget_sidebar_border_size','');
        $widget_sidebar_border_color            =  esc_html ( get_option('wp_estate_widget_sidebar_border_color','') );
        
        $map_controls_back                      =  esc_html ( get_option('wp_estate_map_controls_back','') );
        $map_controls_font_color                =  esc_html ( get_option('wp_estate_map_controls_font_color','') );
   
    
        $sidebarwidget_internal_padding_top         = esc_html ( get_option('wp_estate_sidebarwidget_internal_padding_top','') );
        $sidebarwidget_internal_padding_left        = esc_html ( get_option('wp_estate_sidebarwidget_internal_padding_left','') ) ;
        $sidebarwidget_internal_padding_bottom      = esc_html ( get_option('wp_estate_sidebarwidget_internal_padding_bottom','') );
        $sidebarwidget_internal_padding_right       = esc_html ( get_option('wp_estate_sidebarwidget_internal_padding_right','') ) ;
        $sidebar_heading_background_color           = esc_html ( get_option('wp_estate_sidebar_heading_background_color','') );
        $sidebar_widget_color                       = esc_html ( get_option('wp_estate_sidebar_widget_color', '') );
        $sidebar_heading_color                      = esc_html ( get_option('wp_estate_sidebar_heading_color','') );
        $sidebar_heading_boxed_color                = esc_html ( get_option('wp_estate_sidebar_heading_boxed_color','') );
        $sidebar2_font_color                        = esc_html ( get_option('wp_estate_sidebar2_font_color', '') );
    
        $wp_estate_use_same_colors_widgets          = esc_html(get_option('wp_estate_use_same_colors_widgets','') );

        
        $adv_position             =  esc_html ( get_option('wp_estate_adv_position','') );

        if($adv_position !=''){
            $style.='.adv-search-1{bottom:'.$adv_position.';}';
        }
        
        if($wp_estate_use_same_colors_widgets=='yes'){
            $widgett_area_classes= "#primary .widget-container,#primary .agent_contanct_form";   
        
            if ( $sidebarwidget_internal_padding_top!='' ){
                $style.='
                .agent_contanct_form_sidebar #show_contact{
                    margin: 0px 0px 10px 0px;
                    padding: 7px 0px 7px 0px;
                    font-size: 16px;
                    line-height: 26px;
                    width:auto;
                }';
                 
                $style.=$widgett_area_classes.'{
                    padding-top:'.$sidebarwidget_internal_padding_top.'px;
                }
                .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar,
                .widget-title-sidebar{
                    margin-top:'.(-1 * $sidebarwidget_internal_padding_top).'px;
                    margin-bottom:'.($sidebarwidget_internal_padding_top).'px;
                }
                
                .widget-container.boxed_widget .wd_user_menu,
                #primary .login_form, 
                .widget-container.boxed_widget form{
                    padding: 0px 0px 0px 0px;
                }';
            }
        
        
            if ( $sidebarwidget_internal_padding_left!='' ){
                $style.=$widgett_area_classes.'{
                    padding-left:'.$sidebarwidget_internal_padding_left.'px;
                }
                .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar,
                .widget-title-sidebar{
                    padding-left:'.$sidebarwidget_internal_padding_left.'px;
                    margin-left:'.(-1 * $sidebarwidget_internal_padding_left).'px;
                }
                .widget li, .widget-container li {
                    border:none;
                    margin-bottom: 5px;
                    padding-bottom: 5px;
                }
                ';
            }
        
        
            if ( $sidebarwidget_internal_padding_bottom!='' ){
                $style.=$widgett_area_classes.'{
                    padding-bottom:'.$sidebarwidget_internal_padding_bottom.'px;
                }';
            }
        
        
        
            if ( $sidebarwidget_internal_padding_right!='' ){
                $style.=$widgett_area_classes.'{
                    padding-right:'.$sidebarwidget_internal_padding_right.'px;
                } 
                #input_formula{
                    padding:0px;
                }
                 .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar,
                .widget-title-sidebar{
                    margin-right:'.(-1 * $sidebarwidget_internal_padding_right).'px;
                }
               
                ';
            }
        
            $style.='#primary .widget-container.featured_sidebar{
                padding:0px;
            }';
            
            if ( $widget_sidebar_border_color!='' ){
                $style.=$widgett_area_classes.'
                     {
                    border-color:#'.$widget_sidebar_border_color.';
                    border-style: solid;
                }
                .advanced_search_sidebar .widget-title-footer, .advanced_search_sidebar .widget-title-sidebar{
                    border-color:#'.$widget_sidebar_border_color.';
                    border-style: solid;
                }
                ';
            }
            
            if ( $wp_estate_widget_sidebar_border_size!='' ){
                $style.=$widgett_area_classes.'
                    {
                    border-width:'.$wp_estate_widget_sidebar_border_size.'px;
                }
                ';
            }
            
             
            if($sidebar_heading_background_color!=''){
                $style.='
                    .widget-title-sidebar,.boxed_widget .widget-title-sidebar,
                    .agent_contanct_form_sidebar #show_contact{
                        background-color:#'.$sidebar_heading_background_color.';
                        border:none;
                    }
                ';
            }
            //widget-container
            if ($sidebar_widget_color != '') {
            $style.='
                #primary .agent_contanct_form,
                #primary .widget-container {
                    background-color: #'.$sidebar_widget_color.';
                }';
            } 
            
            if($sidebar_heading_boxed_color!=''){
                $style.= '.boxed_widget .widget-title-sidebar,
                    .widget-title-sidebar,
                    .agent_contanct_form_sidebar #show_contact{
                    color: #'.$sidebar_heading_boxed_color.';
                }';
            }
  

            $sidebar_boxed_font_color            =  esc_html ( get_option('wp_estate_sidebar_boxed_font_color','') );
            if ($sidebar_boxed_font_color != '') {
                $style.= '
                #primary,#primary a,#primary label,
                .advanced_search_sidebar .form-control::-webkit-input-placeholder ,
                #primary .boxed_widget,#primary .boxed_widget a,#primary  .boxed_widget label,
                .boxed_widget .advanced_search_sidebar .form-control::-webkit-input-placeholder {
                    color: #'.$sidebar_boxed_font_color.';
                }'; 
            } 
            
            
        ////////////////////////////////////////// end same style widgelts  
        }else{
      
            $widgett_area_classes= "#primary .widget-container.boxed_widget,#primary .agent_contanct_form";   
            if ( $sidebarwidget_internal_padding_top!='' ){
                $style.='
                .agent_contanct_form_sidebar #show_contact{
                    margin: 0px 0px 10px 0px;
                    padding: 7px 0px 7px 0px;
                    font-size: 16px;
                    line-height: 26px;
                    width:auto;
                }';
                 
                  
                $style.=$widgett_area_classes.'{
                    padding-top:'.$sidebarwidget_internal_padding_top.'px;
                }
                .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar{
                    margin-top:'.(-1 * $sidebarwidget_internal_padding_top).'px;
                    margin-bottom:'.( $sidebarwidget_internal_padding_top).'px;
                }
                .widget-container.boxed_widget .wd_user_menu, 
                .widget-container.boxed_widget form{
                    padding: 0px 0px 13px 0px;
                }';
            }
        
        
            if ( $sidebarwidget_internal_padding_left!='' ){
                $style.=$widgett_area_classes.'{
                    padding-left:'.$sidebarwidget_internal_padding_left.'px;
                }
                .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar{
                    padding-left:'.$sidebarwidget_internal_padding_left.'px;
                    margin-left:'.(-1 * $sidebarwidget_internal_padding_left).'px;
                }
                .widget-container.boxed_widget .wd_user_menu,
                #primary .login_form,
                .widget-container.boxed_widget form{
                    padding: 0px 0px 0px 0px;
                }
                .widget li, .widget-container li {
                    border:none;
                    margin-bottom: 5px;
                    padding-bottom: 5px;
                }
';
                
            }
        
        
            if ( $sidebarwidget_internal_padding_bottom!='' ){
                $style.=$widgett_area_classes.'{
                    padding-bottom:'.$sidebarwidget_internal_padding_bottom.'px;
                }';
            }
        
        
        
            if ( $sidebarwidget_internal_padding_right!='' ){
                $style.=$widgett_area_classes.'{
                    padding-right:'.$sidebarwidget_internal_padding_right.'px;
                }
                #input_formula{
                    padding:0px;
                }
                .agent_contanct_form_sidebar #show_contact,
                .boxed_widget .widget-title-sidebar{
                    margin-right:'.(-1 * $sidebarwidget_internal_padding_right).'px;
                }';
            }
        
            if ( $widget_sidebar_border_color!='' ){
                $style.=$widgett_area_classes.'
                    {
                    border-color:#'.$widget_sidebar_border_color.';
                    border-style: solid;
                }
                .advanced_search_sidebar .widget-title-footer, 
                .advanced_search_sidebar .widget-title-sidebar{
                    border-color:#'.$widget_sidebar_border_color.';
                    border-style: solid;
                }
                ';
            }
            
            if ( $wp_estate_widget_sidebar_border_size!='' ){
                $style.=$widgett_area_classes.'{
                    border-width:'.$wp_estate_widget_sidebar_border_size.'px;
                }
                ';
            }
            
            if($sidebar_heading_background_color!=''){
                $style.='
                    .boxed_widget .widget-title-sidebar,
                    .agent_contanct_form_sidebar #show_contact{
                        background-color:#'.$sidebar_heading_background_color.';
                        border:none;
                    }
                ';
            }
            if ($sidebar_widget_color != '') {
            $style.='
                #primary .agent_contanct_form,
                #primary .widget-container.boxed_widget {
                    background-color: #'.$sidebar_widget_color.';
                }';
            } 
            
            if($sidebar_heading_boxed_color!=''){
                $style.= '.boxed_widget .widget-title-sidebar,.agent_contanct_form_sidebar #show_contact{
                    color: #'.$sidebar_heading_boxed_color.';
                }';
            }
            
            if($sidebar_heading_color!=''){
                $style.= '
                    .widget-title-sidebar{
                    color: #'.$sidebar_heading_color.';
                }';
            }
            
            
            
            if ($sidebar2_font_color != '') {
                $style.= '
                #primary,#primary a,#primary label,
                .advanced_search_sidebar .form-control::-webkit-input-placeholder {
                    color: #'.$sidebar2_font_color.';
                }'; 
            } 

            $sidebar_boxed_font_color            =  esc_html ( get_option('wp_estate_sidebar_boxed_font_color','') );
            if ($sidebar2_font_color != '') {
                $style.= '
                #primary .boxed_widget,#primary .boxed_widget a,#primary .boxed_widget label,
                .boxed_widget .advanced_search_sidebar .form-control::-webkit-input-placeholder {
                    color: #'.$sidebar_boxed_font_color.';
                }'; 
            } 
        }
        
        ////////////////////////////////////////// end same style widgelts  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
      



     
      
        
       
        
        
        
        if($map_controls_back!=''){
            $style.='#gmap-control span.spanselected, #gmap-control span:hover,#gmap-control span,#gmap-control,
                #gmapzoomplus_sh, #gmapzoomplus,#gmapzoomminus_sh, #gmapzoomminus,#openmap,#slider_enable_street_sh,#street-view{
                background-color:#'.$map_controls_back.';
            }';
        }
        
     
  
        if($map_controls_font_color!=''){
            $style.='#gmap-control span.spanselected, #gmap-control span:hover,#gmap-control span,
                #gmap-control,#gmapzoomplus_sh, #gmapzoomplus,#gmapzoomminus_sh, #gmapzoomminus,#openmap,#slider_enable_street_sh,#street-view{
                color:#'.$map_controls_font_color.';
            }';
        }
        
        if ( $unit_border_color!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .property_listing:hover,
                .featured_property,
                .featured_article,
                .agent_unit
                {
                border-color:#'.$unit_border_color.'
            }
            ';
        }
        if ( $unit_border_size!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .property_listing:hover,
                .featured_property,
                .featured_article,
                .agent_unit
                {
                border-width:'.$unit_border_size.'px;
            }
            ';
        }
        
        
        
        if($blog_unit_min_height!=''){
            $style.='.blog2v .property_listing{
                min-height: '.$blog_unit_min_height.'px;
            }';
        }
        
        if($agent_unit_min_height!=''){
            $style.='.article_container .agent_unit, .category .agent_unit, .page-template-agents_list .agent_unit{
                min-height: '.$agent_unit_min_height.'px;
            }';
        }
             
        $content_area_classes_color='.notice_area,
            .wpestate_property_description,
            .property-panel .panel-body,
            .wpestate_agent_details_wrapper,
            .agent_contanct_form,
            .page_template_loader .vc_row,
            #tab_prpg .tab-pane,
            .single-agent,
            .single-blog,
            .single_width_blog #comments,
            .contact-wrapper,
            .contact-content,
            .profile-onprofile,
            .submit_container,
            .invoice_unit:nth-of-type(odd)
            ';
        
        $content_area_classes='.notice_area,
            .wpestate_property_description,
            .property-panel .panel-body,
            .property-panel .panel-heading,
            .wpestate_agent_details_wrapper,
            .agent_contanct_form,
            .page_template_loader .vc_row,
            #tab_prpg .tab-pane,
            .single-agent,
            .single-blog,
            .single_width_blog #comments,
            .contact-wrapper,
            .contact-content,
            .profile-onprofile
            ';
        
        
        if($wp_estate_content_area_back_color!=''){
            $style.=$content_area_classes_color.'{
                background-color:#'.$wp_estate_content_area_back_color.'   
            }
            .wpestate_property_description p{
                margin-bottom:0px;
            }
            
            .page_template_loader .vc_row{
                margin-bottom:13px;
            }
            .page_template_loader .vc_row{
                margin-left: 0px;
                margin-right: 0px;
            }
            .agent_contanct_form {
                margin-top:26px;
            }
            .contact-content .agent_contanct_form,
            .agent_content.col-md-12,
            .single-agent .wpestate_agent_details_wrapper{
                padding:0px;
            }
            .single-agent {
                padding: 0px 15px 0px 0px;
                margin-bottom: 0px;
                margin-left: 13px;
                margin-right: 13px;
                width: auto;
            }
            .contact_page_company_picture,
            .agentpic-wrapper{
                padding-left:0px;
            }
            
            .profile-onprofile,
            .contact-wrapper{
                margin:0px;
            }
            .contact_page_company_details{
                padding-right:0px;
            }
            

            ';
        }
        
        
        if ( $wp_estate_contentarea_internal_padding_top!='' ){
            $style.=$content_area_classes.'{
                padding-top:'.$wp_estate_contentarea_internal_padding_top.'px;
            }';
        }
        
        
        if ( $wp_estate_contentarea_internal_padding_left!='' ){
            $style.=$content_area_classes.'{
                padding-left:'.$wp_estate_contentarea_internal_padding_left.'px;
            }
            ';
        }
        
        
        if ( $wp_estate_contentarea_internal_padding_bottom!='' ){
            $style.=$content_area_classes.'{
                padding-bottom:'.$wp_estate_contentarea_internal_padding_bottom.'px;
            }';
        }
        
        
        
        if ( $wp_estate_contentarea_internal_padding_right!='' ){
            $style.=$content_area_classes.'{
                padding-right:'.$wp_estate_contentarea_internal_padding_right.'px;
            }
            .property-panel h4:after{
                margin-right:0px;
            }
            .property_categs{
                margin-top:0px;
            }
            
            #add_favorites,
            .prop_social{
                right:'.$wp_estate_contentarea_internal_padding_right.'px;
            }
            ';
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
        if ( $property_unit_color!='' ){
            $style.='.property_listing,
                .property_listing:hover,
                .featured_property,
                .featured_article,
                .agent_unit
                {
                background-color:#'.$property_unit_color.'
            }
            ';
        }
        
        
        if ( $propertyunit_internal_padding_top!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .agent_unit,
                .featured_property,
                .featured_article{
                padding-top:'.$propertyunit_internal_padding_top.'px;
            }';
        }
        if ( $propertyunit_internal_padding_left!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .agent_unit,
                .featured_property,
                .featured_article{
                padding-left:'.$propertyunit_internal_padding_left.'px;
            }';
        }
        if ( $propertyunit_internal_padding_bottom!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .agent_unit,
                .featured_property,
                .featured_article,
                .listing_wrapper.col-md-12 > .property_listing{
                padding-bottom:'.$propertyunit_internal_padding_bottom.'px;
            }';
        }
        if ( $propertyunit_internal_padding_right!='' ){
            $style.='.property_listing,
                .related_blog_unit_image,
                .agent_unit,
                .featured_property,
                .featured_article{
                padding-right:'.$propertyunit_internal_padding_right.'px;
            }';
        }
        
        
        
        
         
        if($border_bottom_header_color!=''){
            $style.='.master_header{
                border-color:#'.$border_bottom_header_color.';
            }';
        } 
        if($border_bottom_header_sticky_color!=''){
            $style.='.master_header.master_header_sticky{
                border-color:#'.$border_bottom_header_sticky_color.';
            }';
        }
        
        if($border_bottom_header!=''){
            $style.='.master_header{
               border-width:'.$border_bottom_header.'px;
            }';
        }
        
        if($sticky_border_bottom_header!=''){
            $style.='
                .master_header_sticky,
                .master_header.header_transparent.master_header_sticky{
                    border-width:'.$sticky_border_bottom_header.'px;
                    border-bottom-style:solid;
            }';
        }
        
          
        if($prop_unit_min_height!=''){
            $style.='.property_listing{
                min-height:'.$prop_unit_min_height.'px;
            }';
             $style.='#google_map_prop_list_sidebar .property_listing,.col-md-6.has_prop_slider.listing_wrapper .property_listing{
                min-height:'.($prop_unit_min_height+30).'px;
            }';
        }
         
         
        if($cssbox_shadow!=''){
            if( $cssbox_shadow=='none'){
                $cssbox_shadow_value='-webkit-box-shadow:none;
                box-shadow:none;';
            }else{
                $cssbox_shadow_value='-webkit-box-shadow:'.$cssbox_shadow.';
                box-shadow:'.$cssbox_shadow.';';
            }
            
            $style.='
            .wpb_btn-info,
            #primary .widget-container.twitter_wrapper,
            .wpcf7-form-control,
            #access ul ul,
            .form-control.open,
            .btn,
            .customnav,
            #user_menu_open,
            .filter_menu,
            .pagination > li > a, 
            .pagination > li > span,
            .property_listing,
            .agent_unit,
            .blog_unit,
            .related_blog_unit .blog_unit_image img,
            #tab_prpg .tab-pane,
            .agent_unit_social_single,
            .agent_contanct_form_sidebar .agent_contanct_form,
            #footer-contact-form input[type=text], 
            #footer-contact-form input[type=password],
            #footer-contact-form input[type=email], 
            #footer-contact-form input[type=url], 
            #footer-contact-form input[type=number],
            #footer-contact-form textarea,
            #comments input[type=text], 
            #comments input[type=password],
            #comments input[type=email], 
            #comments input[type=url], 
            #comments input[type=number],
            #comments textarea,
            .agent_contanct_form input[type=text], 
            .agent_contanct_form input[type=password],
            .agent_contanct_form input[type=email], 
            .agent_contanct_form input[type=url], 
            .agent_contanct_form input[type=number],
            .agent_contanct_form textarea,
            .zillow_widget,
            .advanced_search_shortcode,
            .advanced_search_sidebar,
            .mortgage_calculator_div,
            .footer-contact-form,
            .contactformwrapper,
            .info_details,
            .info_idx,
            .pack_description,
            .submit_container,
            .loginwd_sidebar,
            blockquote,
            .featured_article,
            .featured_property,
            .customlist2 ul,
            .featured_agent,
            .testimonial-text,
            .wpb_alert-info.vc_alert_3d.wpestate_message,
            .wpb_alert-success.vc_alert_3d.wpestate_message,
            .wpb_alert-error.vc_alert_3d.wpestate_message,
            .wpb_alert-danger.vc_alert_3d.wpestate_message,
            .wpb_call_to_action.wpestate_cta_button,
            .vc_call_to_action.wpestate_cta_button2,
            .saved_search_wrapper,
            .search_unit_wrapper,.mortgage_calculator_li{
              '.$cssbox_shadow_value.'
            }
            
            .wpresidence_button{
                border:none!important;
                padding:14px 26px;
            }


            .agent_contanct_form input[type="submit"], 
            .single-content input[type="submit"]{
                border:none!important;
            }
            
            #facebooklogin, 
            #facebookloginsidebar_mobile, 
            #facebookloginsidebar_topbar, 
            #facebookloginsidebar,
            #googlelogin, 
            #googleloginsidebar_mobile, 
            #googleloginsidebar_topbar, 
            #googleloginsidebar,
            #yahoologin, 
            #yahoologinsidebar_mobile, 
            #yahoologinsidebar_topbar, 
            #yahoologinsidebar{
                border-bottom:0px;
            }

            #primary .widget-container.twitter_wrapper,
            .agentpict,
            .agent_unit img,
            .property_listing img{
                border:none;
            }';
           
            
        }
        
        if($border_radius_corner!=''){
            $style.='
            .places_wrapper_type_2,
            .places_wrapper_type_2 .places_cover,
            .mortgage_calculator_li,
            input[type=text], 
            input[type=password], 
            input[type=email], 
            input[type=url], 
            input[type=number], 
            textarea,
            .wpcf7-form-control,
            #mobile_display,
            .form-control, 
            .adv-search-1 input[type=text], 
            .property_listing,
            .listing-cover-plus,
            .share_unit,
            .items_compare img,
            .ribbon-wrapper-default, 
            .featured_div,
            .agent_unit,
            .blog_unit,
            .related_blog_unit,
            .related_blog_unit_image,
            .related_blog_unit_image img,
            .related_blog_unit_image .listing-cover,
            .listing-cover-plus-related,
            .gallery img,
            .post-carusel,
            .property-panel .panel-heading,
            .isnotfavorite,
            #add_favorites.isfavorite:hover,
            #add_favorites:hover,
            #add_favorites.isfavorite,
            #slider_enable_map,
            #slider_enable_street,
            #slider_enable_slider,
            .mydetails,
            .agent_contanct_form_sidebar .agent_contanct_form,
            .comment .blog_author_image,
            #agent_submit,
            .comment-reply-link,
            .comment-form #submit,
            #colophon .social_sidebar_internal a,
            #primary .social_sidebar_internal a,
            .zillow_widget,
            .twitter_wrapper,
            #calendar_wrap,
            .widget_latest_internal img,
            .widget_latest_internal .listing-cover,
            .widget_latest_internal .listing-cover-plus,
            .featured_sidebar,
            .featured_widget_image img,
            .advanced_search_shortcode,
            .advanced_search_sidebar,
            .mortgage_calculator_div,
            .flickr_widget_internal img,
            .Widget_Flickr .listing-cover,
            #gmap-loading,
            #gmap-noresult,
            #street-view,
            .contact-comapany-logo,
            #gmap-control,
            #google_map_prop_list_sidebar #advanced_submit_2,
            #results,
            .adv-search-1 input[type=text],
            .adv-search-3,
            .adv-search-3 #results,
            #advanced_submit_22,
            .adv_results_wrapper #advanced_submit_2,
            .compare_item_head img,
            .backtop, 
            .contact-box,
            .footer-contact-form,
            .contactformwrapper,
            .info_details,
            .info_idx,
            .user_dashboard_links,
            #stripe_cancel,
            .pack_description,
            .pack-unit,
            .perpack,
            #direct_pay,
            #send_direct_bill,
            #profile-image,
            .dasboard-prop-listing,
            .info-container i,
            .submit_container,
            #form_submit_1,
            .loginwd_sidebar,
            .login_form,
            .alert-message,
            .login-alert,
            .agent_contanct_form input[type="submit"],
            .single-content input[type="submit"],
            table,
            blockquote,
            .featured_article,
            .blog_author_image,
            .featured_property,
            .agent_face,
            .agent_face img,
            .agent_face_details img,
            .google_map_sh,
            .customlist2 ul,
            .featured_agent,
            .iconcol img,
            .testimonial-image,
            .testimonial-text,
            .wpestate_posts_grid.wpb_teaser_grid .categories_filter li, 
            .wpestate_posts_grid.wpb_categories_filter li,
            .wpestate_posts_grid img,
            .wpestate_progress_bar.vc_progress_bar .vc_single_bar,
            .wpestate_cta_button,
            .wpestate_cta_button2,
            button.wpb_btn-large, span.wpb_btn-large,
            select.dsidx-resp-select,
            .dsidx-resp-area input[type="text"], .dsidx-resp-area select,
            .sidebar .dsidx-resp-area-submit input[type="submit"], .dsidx-resp-vertical .dsidx-resp-area-submit input[type="submit"], 
            .saved_search_wrapper,
            .search_unit_wrapper,
            .front_plan_row,
            .front_plan_row_image,
            #floor_submit,
            .manage_floor,
            #search_form_submit_1,
            .dropdown-menu,
            .wpcf7-form input[type="submit"],
            .panel-group .panel,
            .label,
            .featured_title,
            .featured_second_line,
            .transparent-wrapper,
            .wpresidence_button,
            .tooltip-inner,
            .listing_wrapper.col-md-12 .property_listing>img,
            #facebooklogin, 
            #facebookloginsidebar_mobile, 
            #facebookloginsidebar_topbar, 
            #facebookloginsidebar,
            #googlelogin, 
            #googleloginsidebar_mobile, 
            #googleloginsidebar_topbar, 
            #googleloginsidebar,
            #yahoologin, 
            #yahoologinsidebar_mobile, 
            #yahoologinsidebar_topbar, 
            #yahoologinsidebar,
            #new_post select,
            button.slick-prev.slick-arrow,
            button.slick-next.slick-arrow,
            #pick_pack{
                border-radius: '.intval($border_radius_corner).'px;
            }
            
            .wpestate_tabs .ui-widget-content,
            .agent_contanct_form input[type="submit"], 
            .single-content input[type="submit"],
            button.wpb_btn-large, span.wpb_btn-large{
                border-radius: '.intval($border_radius_corner).'px!important;
            }
            
            .carousel-control-theme-prev,
            .carousel-control-theme-next,
            .icon-fav-on-remove,
            #tab_prpg .tab-pane,
            .nav-prev-wrapper,
            #advanced_submit_2:hover,
            .pagination > li:first-child > a, 
            .pagination > li:first-child > span,
            .pagination .roundright a, 
            .pagination .roundright span,
            #user_menu_open,
            #access ul ul,
            .adv-search-1,
            #openmap,
            .slider-content,
            #access ul li.with-megamenu>ul.sub-menu,
            #access ul li.with-megamenu:hover>ul.sub-menu,
            .wpb_toggle.wpestate_toggle,
            .featured_property img,
            .info_details img,
             #adv-search-header-3,
            #adv-search-header-1,
            .page-template-advanced_search_results .with_search_2 #openmap,
            .agentpict,
            #tab_prpg li:first-of-type,
            #tab_prpg ul,
            .slider-property-status,
            .nav-next-wrapper,
            .agent_unit img,
            .listing-cover,
            .pagination .roundleft a, 
            .pagination .roundleft span,
            .slider-content,
            .property_listing img,
            .agent_unit_social_single{
                border-top-left-radius: '.intval($border_radius_corner).'px;
                border-top-right-radius: '.intval($border_radius_corner).'px;
                border-bottom-left-radius: '.intval($border_radius_corner).'px;
                border-bottom-right-radius: '.intval($border_radius_corner).'px;
            }
            .pack-unit h4,
            .user_dashboard_links a:first-of-type{
                border-top-left-radius: '.intval($border_radius_corner).'px;
                border-top-right-radius: '.intval($border_radius_corner).'px;
            }

            .featured_secondline{
                border-bottom-left-radius: '.intval($border_radius_corner).'px;
                border-bottom-right-radius: '.intval($border_radius_corner).'px;
            }
            #infocloser{
                border-top-right-radius:0px;
            }
            ';
        
        }
        
        
        if ($main_grid_content_width!='' && $main_grid_content_width!='1200'){
            $style.='
            .is_boxed.container,
            .content_wrapper,
            .master_header,
            .wide .top_bar,
            .header_type2 .header_wrapper_inside,
            .header_type1 .header_wrapper_inside,
            .slider-content-wrapper{
                width:'.$main_grid_content_width.'px;
            }
            
            #footer-widget-area{
                width:'.($main_grid_content_width).'px;
                max-width:'.($main_grid_content_width).'px;
            }
             
            .blog_listing_image{
                width:25%;
            }
            .dasboard-prop-listing .blog_listing_image img{
                width:100%
            }
            .prop-info{
                width:75%;
            }
            
            .perpack, #direct_pay{
                width: 100%;
            }
            #results {
              width:'.($main_grid_content_width-234-90).'px;
            }
            
            .adv-search-1{
                width:'.($main_grid_content_width-90).'px;
              
            }
            .transparent-wrapper{  
                width:'.($main_grid_content_width-90).'px;
            }
            .adv1-holder{
               width:'.($main_grid_content_width-13-274).'px;
            }
            
            #google_map_prop_list_sidebar .adv-search-1 .filter_menu{
                width:100%;min-width:100%;
            }
            
          
                      
            .search_wr_3#search_wrapper{
              width:'.($main_grid_content_width-90).'px;
            }
            
            
            .header_wrapper_inside,
            .sub_footer_content,
            .gmap-controls,
            #carousel-property-page-header .carousel-indicators{
                max-width:'.$main_grid_content_width.'px;
            }
            
            .gmap-controls{
                margin-left:-'.intval($main_grid_content_width/2).'px;
            }
            .shortcode_slider_list li {
                max-width: 25%;
            }
            
            @media only screen and (max-width: '.$main_grid_content_width.'px){
                
                .content_wrapper, 
                .master_header, 
                .wide .top_bar, 
                .header_wrapper_inside, 
                .slider-content-wrapper,
                .wide .top_bar, .top_bar {
                    width: 100%;
                    max-width:100%;
                }
            }
            ';
        }
        
        
        if($main_content_width!=''){
            $sidebar_width = intval(100-$main_content_width);
            $style.='
            .col-md-9.rightmargin,
            .single_width_blog,
            .full_width_prop{
                width:'.$main_content_width.'%;
            }
            
            .col-md-push-3.rightmargin,
            .single_width_blog.col-md-push-3,
            .full_width_prop.col-md-push-3{
                left:'.$sidebar_width.'%;
            }
            
            #primary{
               width:'.$sidebar_width.'%;
            }
            
            #primary.col-md-pull-9{
                right:'.$main_content_width.'%;
            }
            ';
        
            
        }
        
        
        if($header_height!=''){
            $style.='.header_wrapper{
                height:'.$header_height.'px;
            }
            #access ul li.with-megamenu>ul.sub-menu, 
            #access ul li.with-megamenu:hover>ul.sub-menu,
            #access ul li:hover > ul {
                top:'.$header_height.'px;
            }
            .menu > li{
                height:'.$header_height.'px;
                line-height:'.$header_height.'px;
            }
            #access .menu>li>a i{
                line-height:'.$header_height.'px;
            }

            #access ul ul{
                top:'.($header_height+50).'px;
            }
           

            .has_header_type2 .header_media,
            .has_header_type3 .header_media,
            .has_header_type4 .header_media,
            .has_header_type1 .header_media{
                padding-top: '.($header_height).'px;
            }


            .has_top_bar .has_header_type2 .header_media,
            .has_top_bar .has_header_type3 .header_media,
            .has_top_bar .has_header_type4 .header_media,
            .has_top_bar .has_header_type1 .header_media{
                padding-top: '.($header_height-90+130).'px;
            }

            .admin-bar .has_header_type2 .header_media,
            .admin-bar .has_header_type3 .header_media,
            .admin-bar .has_header_type4 .header_media,
            .admin-bar .has_header_type1 .header_media{
                padding-top: '.($header_height-90+122).'px;
            }

            .admin-bar.has_top_bar .has_header_type2 .header_media,
            .admin-bar.has_top_bar .has_header_type3 .header_media,
            .admin-bar.has_top_bar .has_header_type4 .header_media,
            .admin-bar.has_top_bar .has_header_type1 .header_media{
                padding-top: '.($header_height-90+164).'px;
            }
            
            #google_map_prop_list_sidebar,
            #google_map_prop_list_wrapper{
                top: '.($header_height+41).'px;
            }
            #google_map_prop_list_wrapper.half_no_top_bar, 
            #google_map_prop_list_sidebar.half_no_top_bar{
                top: '.($header_height).'px;
            }
            
            .admin-bar #google_map_prop_list_sidebar.half_type3, 
            .admin-bar #google_map_prop_list_sidebar.half_type2, 
            .admin-bar #google_map_prop_list_wrapper.half_type2, 
            .admin-bar #google_map_prop_list_wrapper.half_type3,
            #google_map_prop_list_sidebar.half_type2, 
            #google_map_prop_list_sidebar.half_type3, 
            #google_map_prop_list_wrapper.half_type2, 
            #google_map_prop_list_wrapper.half_type3{
            margin-top: 32px;
            }

            ';
        }
        if($sticky_header_height!=''){
            $style.='.header_wrapper.customnav{
                height:'.$sticky_header_height.'px;
            } 
            .customnav.header_type2 .logo img{
                bottom: 10px;
                top: auto;
                transform: none;
            }
          

            .customnav .menu > li{
                height:'.$sticky_header_height.'px;
                line-height:'.$sticky_header_height.'px;
            }
            .customnav #access .menu>li>a i{
                line-height:'.$sticky_header_height.'px;
            }
            .customnav #access ul li.with-megamenu>ul.sub-menu, 
            .customnav #access ul li.with-megamenu:hover>ul.sub-menu,
            .customnav #access ul li:hover> ul{
              top:'.$sticky_header_height.'px;
            }
            
            .full_width_header .header_type1.header_left.customnav #access ul li.with-megamenu>ul.sub-menu, 
            .full_width_header .header_type1.header_left.customnav #access ul li.with-megamenu:hover>ul.sub-menu{
                top:'.$sticky_header_height.'px;
            }
            ';
        }
         
        $wpestate_uset_unit       =   intval ( get_option('wpestate_uset_unit','') );
        $custom_unit_structure = get_option('wpestate_property_unit_structure');
        if($wpestate_uset_unit==1 && $custom_unit_structure!=''){
            foreach($custom_unit_structure as $rows){
                foreach($rows as $columns){
                    foreach($columns as $elements){
                        if($elements['class_name']!='' && $elements['class_content']!=''){
                            $style.= ".".$elements['class_name']."{".$elements['class_content']."}";
                            if($elements['font']!=''){
                                $style.= ".".$elements['class_name']." a{font-size:".$elements['font']."px;color:".$elements['color']."}";
                                $style.= ".".$elements['class_name']." span:before{font-size:".$elements['font']."px;color:".$elements['color']."}";
                            }

                        }
                    }
                   
                }
            }
        
        }
        
        
        if($style!=''){
            // echo "<style type='text/css'>".$style."</style>";  
            echo $style;  
        }

    }
endif;


if(!function_exists('wpestate_build_unit_custom_structure')):
function wpestate_build_unit_custom_structure($custom_unit_structure,$propID,$property_unit_slider){
   
    $row_no=0;
    foreach($custom_unit_structure as $rows){
       
        $row_class=count ($rows);
        $col_md=12;
        if($row_class==2){
            $col_md=6;
        }else if($row_class==3){
            $col_md=4;
        }else if($row_class==4){
            $col_md=3;
        }
        
        $row_no++;
        foreach($rows as $columns){
            print '<div class="property_unit_custom row_no_'.$row_no.' col-md-'.$col_md.'  ">';
                foreach($columns as $elements){
                    print '<div class="property_unit_custom_element '.$elements['element_name'].' '.$elements['class_name'].' '.$elements['extra_class'];
                    if($elements['element_name']=='custom_div') {
                        print ' '. $elements['text'].' ';
                    }
                    print '"';
                    if($elements['text-align']!='' ) {
                        if( $col_md==12 || $elements['text-align']=='center'){
                            print ' style=" width:100%; " ';
                        } else{
                            print ' style=" float:'.$elements['text-align'].'; " ';
                        }
                        
                    }
                    
                    print '>';
                    wpestate_build_unit_show_detail($elements['element_name'],$propID,$property_unit_slider,$elements['text'],$elements['icon']);
                    print '</div>';
                }
            print'</div>';
        }
        
        
    }
            
}
endif;


if(!function_exists('wpestate_build_unit_show_detail')):
function wpestate_build_unit_show_detail($element,$propID,$property_unit_slider,$text,$icon){
    $element = strtolower($element);
    
    
    switch ($element) {
        case 'share':
            $link=get_permalink($propID);
            if ( has_post_thumbnail() ){
                $pinterest = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_full_map');
            }
            print '
                <div class="share_unit">
                <a href="http://www.facebook.com/sharer.php?u='.esc_url($link).'&amp;t='.urlencode(get_the_title($propID)).'" target="_blank" class="social_facebook"></a>
                <a href="http://twitter.com/home?status='.urlencode(get_the_title($propID).' '.$link).'" class="social_tweet" target="_blank"></a>
                <a href="https://plus.google.com/share?url='.esc_url($link).'" onclick="javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" target="_blank" class="social_google"></a> 
                <a href="http://pinterest.com/pin/create/button/?url='.esc_url($link).'&amp;media=';
                    if (isset( $pinterest[0])){ echo esc_url($pinterest[0]); }
                    print '&amp;description='.urlencode(get_the_title($propID)).'" target="_blank" class="social_pinterest"></a>
                </div>';
            if($text==''){
                if($icon!=''){
                    if ( strpos($icon, 'fa-') !== false){
                        print '<span class="share_list text_share"  data-original-title="'.__('share','wpestate').'" ><i class="fa '.$icon.'" aria-hidden="true"></i></span>';
                    }else{
                        print '<span class="share_list text_share"  data-original-title="'.__('share','wpestate').'" ><img src="'.$icon.'" alt="featured_icon"></span>';
                    }
                }else{
                    print '<span class="share_list"  data-original-title="'.__('share','wpestate').'" ></span>';
                }
                
            }else{
               print '<span class="share_list text_share"  data-original-title="'.__('share','wpestate').'" >'.$text.'</span>';
            }       
               
        break;
        
        
        case 'link_to_page':
         
            $link=get_permalink($propID);        
            if($text==''){
                if ( strpos($icon, 'fa-') !== false){
                    print '<a href="'.$link.'"><i class="fa '.$icon.'" aria-hidden="true"></i></a>';
                }else{
                    print '<a href="'.$link.'"><img src="'.$icon.'" alt="details"></a>';
                }
            }else{
               print '<a href="'.$link.'">'.str_replace('_',' ',$text).'</a>';
               
            }       
               
        break;
       
        case 'favorite':
            $current_user   =   wp_get_current_user();
            $userID         =   $current_user->ID;
            $user_option    =   'favorites'.$userID;
            $favorite_class =   'icon-fav-off';
            $fav_mes        =   __('add to favorites','wpestate');
            $user_option    =   'favorites'.$userID;
            $curent_fav     =   get_option($user_option);
            if($curent_fav){
                if ( in_array ($propID,$curent_fav) ){
                    $favorite_class =   'icon-fav-on';   
                    $fav_mes        =   __('remove from favorites','wpestate');
                } 
            }
            // print '<span class="icon-fav '.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'"></span>';
            /*
            if($text==''){
                if($icon!=''){
                    if ( strpos($icon, 'fa-') !== false){
                        print '<span class="icon-fav '.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'"><i class="fa '.$icon.'" aria-hidden="true"></i></span>';
                    }else{
                        print '<span class="icon-fav '.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'"><img src="'.$icon.'" alt="favorite icon"></span>';
                    }
                }else{
                    print '<span class="icon-fav '.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'"></span>';
                }
            } else{
                print '<span class="icon-fav favorite-text'.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'">'.$text.'</span>';
            }
            */
            print '<span class="icon-fav custom_fav '.esc_html($favorite_class).'" data-original-title="'.$fav_mes.'" data-postid="'.intval($propID).'"></span>';
        
        break;
        
               
        case 'compare':
         
          //    
            $compare   = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider_thumb');           
            if($text==''){
              
                if($icon!=''){
                    if ( strpos($icon, 'fa-') !== false){
                        print '<span class="compare-action text_compare" data-original-title="'.__('compare','wpestate').'" data-pimage="';
                        if( isset($compare[0])){echo esc_html($compare[0]);} 
                        print '" data-pid="'.intval($propID).'"><i class="fa '.$icon.'" aria-hidden="true"></i></span>';
                       
                    }else{
                        print '<span class="compare-action text_compare" data-original-title="'.__('compare','wpestate').'" data-pimage="';
                        if( isset($compare[0])){echo esc_html($compare[0]);} 
                        print '" data-pid="'.intval($propID).'"><img src="'.$icon.'" alt="featured_icon"></span>';
                    }
                }else{
                    print '<span class="compare-action" data-original-title="'.__('compare','wpestate').'" data-pimage="';
                    if( isset($compare[0])){echo esc_html($compare[0]);} 
                    print '" data-pid="'.intval($propID).'"></span>';
                }
                
            }else{
               print '<span class="compare-action text_compare" data-original-title="'.__('compare','wpestate').'" data-pimage="';
               if( isset($compare[0])){echo esc_html($compare[0]);} 
               print '" data-pid="'.intval($propID).'">'.$text.'</span>';
               
            }       
               
        break;
        
        
         case 'property_status':
            $prop_stat              =   esc_html( get_post_meta($propID, 'property_status', true) );
            if ($prop_stat != 'normal') {
                $ribbon_class = str_replace(' ', '-', $prop_stat);
                if (function_exists('icl_translate') ){
                    $prop_stat     =   icl_translate('wpestate','wp_estate_property_status'.$prop_stat, $prop_stat );
                }
                print $prop_stat ;
            }
        break;
        
        
    
            
        case 'icon':
            if ( strpos($icon, 'fa-') !== false){
                print '<i class="fa '.$icon.'" aria-hidden="true"></i>';
            }else{
                print '<img src="'.$icon.'" alt="featured_icon">';
            }
        break;
        
        
        
        case 'featured_icon':
            if(intval  ( get_post_meta($propID, 'prop_featured', true) )==1){
                
                if($text!=''){
                    print $text;
                }else{
                    if ( strpos($icon, 'fa-') !== false){
                        print '<i class="fa '.$icon.'" aria-hidden="true"></i>';
                    }else{
                        print '<img src="'.$icon.'" alt="featured_icon">';
                    }
                }
                
               
            }
        break;
        
        case 'text':
            if (function_exists('icl_translate') ){
                print stripslashes(str_replace('_',' ',$text));
            }else{
                $meta_value =stripslashes(str_replace('_',' ',$text));
                $meta_value = apply_filters( 'wpml_translate_single_string', $meta_value, 'wpestate', 'wp_estate_custom_unit_'.$meta_value );
                echo $meta_value;
            }
        break;
        
        case 'image':
            wpestate_build_unit_show_detail_image($propID,$property_unit_slider);
        break;
    
        case 'description':
            echo wpestate_strip_excerpt_by_char(get_the_excerpt(),115,$propID);
        break;
    
        case 'title':
            print '<h4><a href="'.get_permalink($propID).'">'.get_the_title($propID).'</a></h4>';
        break;
    
        case 'property_price':
            $currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
            $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
            wpestate_show_price($propID,$currency,$where_currency);
        break;
    
        case 'property_category';
            echo get_the_term_list($propID, 'property_category', '', ', ', '') ;
        break;
    
        case 'property_action_category';
            echo get_the_term_list($propID, 'property_action_category', '', ', ', '') ;
        break;
        
        case 'property_city';
            echo get_the_term_list($propID, 'property_city', '', ', ', '') ;
        break;
        
        case 'property_area';
            echo get_the_term_list($propID, 'property_area', '', ', ', '') ;
        break;
        
        case 'property_county_state';
            echo  get_the_term_list($propID, 'property_county_state', '', ', ', '') ;
        break;
        
        case 'property_agent';
            $agent_id   = intval( get_post_meta($propID, 'property_agent', true) );
            echo '<a href="'.get_permalink($agent_id).'">'.get_the_title($agent_id).'</a>';
        break;
        
        case 'property_agent_picture';
            $agent_id   = intval( get_post_meta($propID, 'property_agent', true) );
            $preview            = wp_get_attachment_image_src(get_post_thumbnail_id($agent_id), 'agent_picture_thumb');
            $preview_img         = $preview[0];
            echo '<a href="'.get_permalink($agent_id).'" class="property_unit_custom_agent_face" style="background-image:url('.$preview_img.')"></a>';
        break;
        
        case 'custom_div';
            print '';
        break;
        case 'property_size';
            print wpestate_sizes_no_format ( floatval ( get_post_meta($propID, 'property_size', true) ) );
        break;
        default:
           
            if (function_exists('icl_translate') ){
                print  get_post_meta($propID, $element, true);
            }else{
                $meta_value = get_post_meta($propID, $element, true);;
                $meta_value = apply_filters( 'wpml_translate_single_string', $meta_value, 'wpestate', 'wp_estate_custom_unit_'.$meta_value );
                echo $meta_value;
            }
    }
    
  
}
endif;

// $prop_stat              =   esc_html( get_post_meta($post->ID, 'property_status', true) );








if (!function_exists('wpestate_build_unit_show_detail_image')):
function wpestate_build_unit_show_detail_image($propID,$property_unit_slider){
    
    if ( has_post_thumbnail($propID) ){
        $link       =   get_permalink($propID);
        $title      =   get_the_title($propID);
        $pinterest  =   wp_get_attachment_image_src(get_post_thumbnail_id($propID), 'property_full_map');
        $preview    =   wp_get_attachment_image_src(get_post_thumbnail_id($propID), 'property_listings');
        $compare    =   wp_get_attachment_image_src(get_post_thumbnail_id($propID), 'slider_thumb');
        $extra= array(
            'data-original' =>  $preview[0],
            'class'         =>  'lazyload img-responsive',    
        );


        $thumb_prop             =   get_the_post_thumbnail($propID, 'property_listings',$extra);

        if($thumb_prop ==''){
            $thumb_prop_default =  get_template_directory_uri().'/img/defaults/default_property_listings.jpg';
            $thumb_prop         =  '<img src="'.$thumb_prop_default.'" class="b-lazy img-responsive wp-post-image  lazy-hidden" alt="no thumb" />';   
        }

        print   '<div class="listing-unit-img-wrapper">';

            if(  $property_unit_slider==1){
                    //slider
                $arguments      = array(
                                    'numberposts' => -1,
                                    'post_type' => 'attachment',
                                    'post_mime_type' => 'image',
                                    'post_parent' => $propID,
                                    'post_status' => null,
                                    'exclude' => get_post_thumbnail_id(),
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC'
                                );
                $post_attachments   = get_posts($arguments);

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
                print   '<div class="listing-cover"></div><a href="'.$link.'"> <span class="listing-cover-plus">+</span></a>'; 
            }



            
            print   '</div>';
                

            }
}
endif;