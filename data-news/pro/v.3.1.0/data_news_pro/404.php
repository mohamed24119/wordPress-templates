<?php get_header();?>
<div class="container container-z view-error">
    <div class="wrapper">
        <main class="main-content">
            <div class="page-error">
                <div class="num-error">404</div>
                <p class="text-error">
                    <?php echo get_theme_mod('page_404_text','لم يتم العثور على الصفحة المطلوبة ، قد تكون اتبعت رابط خاطئ أو منتهي الصلاحية أو ربما تم حذف الصفحة أو نقلها أو لم يتم إنشاء الصفحة بعد');?>
                </p>
            </div>
            <div 
                data-wp-url="<?php bloginfo('url')?>"
                data-widget-title="<?php echo esc_html__('قد يهمك أيضاً','data_news_pro')?>"
                data-class-name="grid grid-3"
                data-random-posts="true" 
                data-posts-count="25"
                data-max-results="100"
            ></div>
        </main>
    </div>
</div>
<?php get_footer();?>