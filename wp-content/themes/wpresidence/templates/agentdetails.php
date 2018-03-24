<?php
global $options;
global $prop_id;
global $post;
global $agent_url;
global $agent_urlc;
global $link;

$pict_size=5;
$content_size=7;

if ($options['content_class']=='col-md-12'){
   $pict_size=4; 
   $content_size='8';
}

if ( get_post_type($prop_id) == 'estate_property' ){
    $pict_size=4;
    $content_size=8;
    if ($options['content_class']=='col-md-12'){
       $pict_size=3; 
       $content_size='9';
    }   
}


if($preview_img==''){
    $preview_img    =   get_template_directory_uri().'/img/default_user_agent.gif';
}

?>
<div class="wpestate_agent_details_wrapper">
    <div class="col-md-<?php print $pict_size;?> agentpic-wrapper">
            <div class="agent-listing-img-wrapper" data-link="<?php echo  $link; ?>">
                <?php
                if ( 'estate_agent' != get_post_type($prop_id)) { ?>
                <a href="<?php print esc_url($link);?>">
                    <img src="<?php print $preview_img;?>"  alt="agent picture" class="img-responsive agentpict"/>
                </a>
                <?php
                }else{
                ?>
                    <img src="<?php print $preview_img;?>"  alt="agent picture" class="img-responsive agentpict"/>
                <?php }?>

                <div class="listing-cover"></div>
                <div class="listing-cover-title"><a href="<?php echo esc_url($link);?>"><?php echo esc_html($name);?></a></div>

            </div>

            <div class="agent_unit_social_single">
                <div class="social-wrapper"> 

                    <?php

                    if($agent_facebook!=''){
                        print ' <a href="'. $agent_facebook.'" target="_blank"><i class="fa fa-facebook"></i></a>';
                    }

                    if($agent_twitter!=''){
                        print ' <a href="'.$agent_twitter.'" target="_blank"><i class="fa fa-twitter"></i></a>';
                    }
                    if($agent_linkedin!=''){
                        print ' <a href="'.$agent_linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a>';
                    }
                    if($agent_pinterest!=''){
                        print ' <a href="'. $agent_pinterest.'" target="_blank"><i class="fa fa-pinterest"></i></a>';
                    }
                    if($agent_instagram!=''){
                        print ' <a href="'. $agent_instagram.'"><i class="fa fa-instagram"></i></a>';
                    }
                    ?>

                 </div>
            </div>
    </div>  

    <div class="col-md-<?php print esc_html($content_size);?> agent_details">    
            <div class="mydetails">
                <?php _e('My details','wpestate');?>
            </div>
            <?php   
            print '<h3><a href="'.$link.'">' .$name. '</a></h3>
            <div class="agent_position">'.$agent_posit.'</div>';
            if ($agent_phone) {
                print '<div class="agent_detail agent_phone_class"><i class="fa fa-phone"></i><a href="tel:' . $agent_phone . '">' . $agent_phone . '</a></div>';
            }
            if ($agent_mobile) {
                print '<div class="agent_detail agent_mobile_class"><i class="fa fa-mobile"></i><a href="tel:' . $agent_mobile . '">' . $agent_mobile . '</a></div>';
            }

            if ($agent_email) {
                print '<div class="agent_detail agent_email_class"><i class="fa fa-envelope-o"></i><a href="mailto:' . $agent_email . '">' . $agent_email . '</a></div>';
            }

            if ($agent_skype) {
                print '<div class="agent_detail agent_skype_class"><i class="fa fa-skype"></i>' . $agent_skype . '</div>';
            }

            if ($agent_urlc) {
                print '<div class="agent_detail agent_web_class"><i class="fa fa-desktop"></i><a href="http://'.$agent_urlc.'" target="_blank">'.$agent_urlc.'</a></div>';
            }
            ?>

    </div>

</div>


<?php 
if ( 'estate_agent' == get_post_type($prop_id)) { ?>
        <div class="agent_content col-md-12">
            <h4><?php _e('About Me ','wpestate'); ?></h4>    
            <?php the_content();?>
        </div>
<?php }
?>