<?php
global $logo_header_align;
if($logo_header_align=='center'){
    $logo_header_align='left';
}
$text_header_align_select   =  get_option('wp_estate_text_header_align','');
?>
<div id="header_type3_wrapper" class="header_type3_menu_sidebar <?php echo 'header_'.$logo_header_align.' header_alignment_text_'.$text_header_align_select;?>">
    
    <ul class="xoxo">
        <?php dynamic_sidebar('sidebar-menu-widget-area-before'); ?>
    </ul>
    
    
    <nav id="access">
        <?php 
            wp_nav_menu( 
                array(  'theme_location'    => 'primary' ,
                        'walker'            => new wpestate_custom_walker
                    ) 
            ); 
        ?>
    </nav><!-- #access -->
    
    <ul class="xoxo">
        <?php dynamic_sidebar('sidebar-menu-widget-area-after'); ?>
    </ul>
    
</div> 