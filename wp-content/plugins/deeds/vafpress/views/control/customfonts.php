<?php if (!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<input class="vp-input-fonts" type="text" readonly id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" />
<div class="buttons-fonts">
    <input id="font_upload" class="" type="button" value="<?php esc_html_e('Choose File', 'wp-deeds'); ?>" />
</div>
<div id="fonts_uploader_output"></div>
<?php if (!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>
