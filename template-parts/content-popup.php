<?php if(is_front_page() && get_theme_mod('ol_popup_enabled',false)): $img_id=absint(get_theme_mod('ol_popup_image')); $img=$img_id?wp_get_attachment_image_url($img_id,'large'):''; ?>
<div id="ol-home-popup" class="home-popup" role="dialog" aria-modal="true" aria-labelledby="ol-popup-title">
<div class="home-popup-backdrop" data-popup-close></div>
<div class="home-popup-card">
<button class="home-popup-close" type="button" aria-label="Close popup" data-popup-close>×</button>
<?php if($img): ?><div class="home-popup-image"><img src="<?php echo esc_url($img); ?>" alt=""></div><?php endif; ?>
<div class="home-popup-body"><span class="eyebrow">Featured Notice</span><h2 id="ol-popup-title"><?php echo esc_html(get_theme_mod('ol_popup_title','Admission 2026–2027')); ?></h2><div><?php echo wp_kses_post(get_theme_mod('ol_popup_content','Applications are now open.')); ?></div><?php if($url=get_theme_mod('ol_popup_url')): ?><a class="button ai-style-change-1" href="<?php echo esc_url($url); ?>"><?php echo esc_html(get_theme_mod('ol_popup_button','Apply Now')); ?></a><?php endif; ?></div>
</div></div>
<?php endif; ?>
