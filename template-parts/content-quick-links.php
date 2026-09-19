<section class="section quick-links-section">
<div class="container">
<div class="section-heading"><div class="section-meta">Resources</div><h2>Quick Links</h2></div>
<div class="quick-links-grid">
<?php
$links=array(
'Admissions'=>get_page_by_path('admission')?get_permalink(get_page_by_path('admission')):'#',
'Contact Us'=>get_page_by_path('contact')?get_permalink(get_page_by_path('contact')):'#',
'Gallery'=>get_page_by_path('gallery')?get_permalink(get_page_by_path('gallery')):'#',
'Latest News'=>get_permalink(get_option('page_for_posts')) ?: '#',
);
foreach($links as $label=>$url): ?>
<a class="quick-link" href="<?php echo esc_url($url); ?>"><span><?php echo esc_html($label); ?></span><b>→</b></a>
<?php endforeach; ?>
</div></div></section>
