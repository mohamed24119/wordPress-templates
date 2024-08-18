<?php  
    get_header();
    if(!is_paged()){
        // مقالات عشوائية في الصفحة الرئيسية
        
        if(!get_theme_mod('random_Posts_status') && !empty(get_theme_mod('random_Posts_code'))){
            echo '<div class="posts-overlay">
                <div id="randomPostsSec1">
                    '.get_theme_mod('random_Posts_code').'
                </div>
            </div>';
            fun_get_ads('ad_code3','ad-random-posts-after');
        }
        

        
        // سلايدر العناوين
        if(!get_theme_mod('slider_title_status') && !empty(get_theme_mod('slider_title_code'))){
            echo '<div class="title_slider_wraper">
                <div class="title_slider_sec" id="title_slider_sec">
                    '.get_theme_mod('slider_title_code').'
                </div>';
                if(!get_theme_mod('slider_title_ads_status') && !empty(get_theme_mod('slider_title_ads_code'))){
                    echo '<div class="slider-ads" id="slider_ads_sec">'.get_theme_mod('slider_title_ads_code').'</div>';
                }
            echo '</div>';

            fun_get_ads('ad_code5','ad-title-slider-after');
        }
        
        // سلايدر الصور
        
        if(!get_theme_mod('slider_images_status') && !empty(get_theme_mod('slider_images_code'))){

            echo '<div class="image_slider_sec" id="image_slider_sec">
                '.get_theme_mod('slider_images_code').'
            </div>';
            fun_get_ads('ad_code6','ad_image_slider_after');
        }
        
        
        $videos_id = get_theme_mod('videos_id');
        $channel_id = get_theme_mod('channel_id');
        $channel_videos_count = get_theme_mod('channel_videos_count',6);

        $videos_id_status = get_theme_mod('videos_id_status',false);
        $channel_id_status = get_theme_mod('channel_id_status',false);

        if(!empty($videos_id) && $videos_id_status && !$channel_id_status){
            echo ' <div class="watch-videos-sec-group">
                <div class="watch-videos-sec" id="watch-videos-sec-api">
                    <div data-class-name="watch-videos" data-videos-id="'.$videos_id.'" data-widget-title="'.esc_html__('فيديوهات متنوعة','data_news_pro').'"></div>
                </div>';
            echo '</div>';
            fun_get_ads('ad_code7','ad-watch-videos-after');
        }
        
        if(!empty($channel_id) && $channel_id_status && !$videos_id_status){
            echo ' <div class="watch-videos-sec-group">
                <div class="watch-videos-sec" id="watch-videos-sec-api">
                    <div data-channel-id="'.$channel_id.'" data-class-name="watch-videos" data_video_count="'.$channel_videos_count.'"></div>';
                echo '</div>
            </div>';
            fun_get_ads('ad_code7','ad-watch-videos-after');
        }
        
    }
?>


    <div class="wrapper">
        <main class="main-content">
            <div class="home_posts_sec" id="home_posts_sec">
                <div class="widget">
                    <?php $custom_widgets_home = get_theme_mod('custom_widgets_home');
                        if(!is_paged() && !$custom_widgets_home){
                            echo '<div class="section" id="home-posts">';
                                dynamic_sidebar('posts_home');
                            echo '</div>';
                        }

                        $recent_posts_home = get_theme_mod('recent_posts_home',false);
                        if($recent_posts_home){
                            if (have_posts()) {
                                echo '<div class="blog-posts grid grid-3">';
                                    while (have_posts()) {
                                        the_post();
                                        fun_loop_posts();
                                    }
                                echo '</div>';
                                fun_get_ads('ad_code8','ad-before-pagination');
                                fun_post_pagination();
                            } 
                            else {
                                fun_not_posts();
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
        <?php get_sidebar();?>
    </div>
<?php get_footer();?>
