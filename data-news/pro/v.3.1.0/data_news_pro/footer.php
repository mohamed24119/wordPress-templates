<?php
if(is_single() || is_author()){
    $post_id = get_queried_object_id();
    $post_author_id = get_post_field('post_author', $post_id);            
}
$ad_code_head       = esc_html(get_theme_mod('ad_code_head'));
$status_ad_code_head   = get_theme_mod('status_ad_code_head'); 
    

    if(!empty($ad_code_head) && !$status_ad_code_head && is_single() || is_author()){
        if(!empty(get_the_author_meta('data_ad_slot_5', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){
            ?>
            <div class="ads" id="ads-posts-top">
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                    data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_5', $post_author_id)?>"
                    data-ad-format="auto"
                    data-full-width-responsive="true">
                </ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
            <?php
        } 
        else {
            fun_get_ads('ad_code9','ads-before-footer');
        }
    }  
    else {
        fun_get_ads('ad_code9','ads-before-footer');
    }
   




    $footer_logo = get_theme_mod('footer_logo');
    $footer_social_title = get_theme_mod('footer_social_title',esc_html__('تابعنا على','data_news_pro'));
    $copy_right = get_theme_mod('copy_right',esc_html__('جميع الحقوق محفوظة © لـ','data_news_pro'));
?>
</div><!-- end container -->
    <footer class="footer-site">
        <div class="container">
            <div class="footer-sections">
                <div class="footer-blog-info" id="bloginfo">
                    <div class="footer_logo_sec" id="footer_logo_sec">
                        <div class="widget Header">
                            <?php 
                                echo '
                                    <div class="footer-logo">
                                        <a class="footer-link" href="'.esc_url(get_bloginfo('url')).'">';
                                            if(!empty($footer_logo)){
                                                echo '<img alt="'.esc_html__('شعار','data_news_pro') . ' ' .esc_html(get_bloginfo('name')).'" class="footer-img" height="113" loading="lazy" width="200" data-src="'.$footer_logo.'">';
                                            }
                                            echo '<div class="footer-title">'.esc_html(get_bloginfo('name')).'</div>
                                        </a>';

                                        if(!empty(get_bloginfo('description'))){
                                            echo '<p class="footer-des">'.esc_html(get_bloginfo('description')).'</p>';
                                        }
                                    echo '</div>                        
                                ';
                            ?>
                        </div>
                    </div>
                    

                    <?php  
                        echo '<div class="footer_apps_sec" id="footer_apps_sec"><div class="apps-mobiles">';
                            fun_app('googleNews','google-news.png',esc_html__('تابعنا على جوجل نيوز','data_news_pro'));
                            fun_app('android_app','google_play.png',esc_html__('حمل التطبيق على الاندرويد','data_news_pro'));
                            fun_app('iphone_app','apple.png',esc_html__('حمل التطبيق على آيفون','data_news_pro'));
                            fun_app('ipad_app','apple.png',esc_html__('حمل التطبيق على آيباد','data_news_pro'));
                            fun_app('windows_fone_app','windows.png',esc_html__('حمل التطبيق على ويندوز فون','data_news_pro'));
                            fun_app('huawei_app','huawei.jpg',esc_html__('حمل التطبيق على هواوي','data_news_pro'));
                        echo '</div></div>';
                    ?> 



                </div>

                <div class="footer-pages">
                    <div class="widget">
                        <?php fun_get_menu("menu_pages","menu_pages","menu_pages",1)?>
                    </div>
                </div>

                <div class="section" id="footer-social">
                    <div class="widget">
                        <?php
                            if(!empty($footer_social_title)){
                                echo '<div class="widget-header"><span class="widget-title">'.$footer_social_title.'</span></div>';
                            }
                        ?>
                        <div class="social-icons footer-social">
                            <?php fun_get_scoial_link()?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <div class="foot-bar">
        <div class="container">
            <div class="copy-rights">
                <div id="credit"></div>
                <?php 
                echo '
                    <span class="copy-right-text">'.$copy_right.'</span>
                    <a href="'.esc_url(get_bloginfo('url')).'">'.esc_html(get_bloginfo('name')).'</a> - <span id="footYear">2024</span>
                ';
                ?>
            </div>
        </div>
    </div>


    <div class="ads-group">
        <?php 
           
            if(empty($ad_code_head) && !$status_ad_code_head && is_single() || is_author()){
                if(!empty(get_the_author_meta('data_ad_slot_6', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){
                    ?>
                    <div class="ads" id="ads-inline-start">
                        <ins class="adsbygoogle"
                            style="display:inline-block;width:160px;height:600px"
                            data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                            data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_6', $post_author_id)?>">
                        </ins>
                        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    </div>

                    <div class="ads" id="ads-inline-end">
                        <ins class="adsbygoogle"
                            style="display:inline-block;width:160px;height:600px"
                            data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                            data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_6', $post_author_id)?>">
                        </ins>
                    </div>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    <?php
                } 
                else {
                    fun_get_ads('ad_code10','ads-inline-start');
                    fun_get_ads('ad_code10','ads-inline-end');
                }
            } 
            else {
                fun_get_ads('ad_code10','ads-inline-start');
                fun_get_ads('ad_code10','ads-inline-end');
            }
            
        ?>
    </div>


        <?php
        if(is_home()){
            echo '<script src="'. esc_url(get_template_directory_uri()).'/assets/js/code_home.js"></script>';
        }

        echo '<script src="'. esc_url(get_template_directory_uri()).'/assets/js/code_body_c.js"></script>';

        $codes_body = get_theme_mod('codes_body');
        $status_codes_body = get_theme_mod('status_codes_body',false);
        
        if(!empty($codes_body) && !$status_codes_body){echo $codes_body;}
        wp_footer();
        fun_get_code_google_analytics();
    ?>
    </body>
</html>