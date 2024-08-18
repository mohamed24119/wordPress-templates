<?php
	$sidebar_tab1_title = get_theme_mod('sidebar_tab1_title',esc_html__('عام','data_news_pro'));
	$sidebar_tab2_title = get_theme_mod('sidebar_tab2_title',esc_html__('الأقسام','data_news_pro'));
	$sidebar_tab3_title = get_theme_mod('sidebar_tab3_title',esc_html__('الأكثر شعبية','data_news_pro'));
?>
<aside class="sidebar-site" id="sidebar-widgets">
    <div class="sidebar-tabs" id="sidebar-tabs">
        <ul class="list-tabs">
            <li class="tabs-item" data-tabs="sidebar-tab1"><?php echo $sidebar_tab1_title?></li>
            <li class="tabs-item" data-tabs="sidebar-tab2"><?php echo $sidebar_tab2_title?></li>
            <li class="tabs-item" data-tabs="sidebar-tab3"><?php echo $sidebar_tab3_title?></li>
        </ul>
        <div class="content-tabs">
            <div class="widgets sidebar-tab" id="sidebar-tab1"><?php dynamic_sidebar('sidebar_tab1');?></div>
            <div class="widgets sidebar-tab" id="sidebar-tab2"><?php dynamic_sidebar('sidebar_tab2');?></div>
            <div class="widgets sidebar-tab" id="sidebar-tab3"><?php dynamic_sidebar('sidebar_tab3');?></div>
        </div>
    </div>
</aside>