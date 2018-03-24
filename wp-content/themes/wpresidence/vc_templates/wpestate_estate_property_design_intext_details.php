<?php
$css = '';
extract(shortcode_atts(array(
    'css' => ''
), $atts));
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
    I am bartag
</div><?php echo $this->endBlockComment('bartag'); ?>