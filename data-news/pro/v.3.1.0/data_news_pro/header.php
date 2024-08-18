<?php 
    if(is_single() || is_author()){
        $post_id = get_queried_object_id();
        $post_author_id = get_post_field('post_author', $post_id);            
    }
    $ad_code_head           = esc_html(get_theme_mod('ad_code_head'));
    $status_ad_code_head    = get_theme_mod('status_ad_code_head',false); 
    $theme_color            = esc_attr(get_theme_mod('theme_color','#3b3a3a'));
    $api_google             = esc_attr(get_theme_mod('api_google'));
    $codes_head             = get_theme_mod('codes_head');
    $status_codes_head      = get_theme_mod('status_codes_head',false);
    $all_metatag            = get_theme_mod('all_metatag');
?>
<!DOCTYPE html>
<html lang='<?php esc_attr(bloginfo('language'))?>' dir='<?php esc_attr(fun_direction())?>'>
<head>
    <?php
        echo '
            <meta charset="'.esc_attr(get_bloginfo('charset')).'">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="theme-color" content="'.$theme_color.'">
            <meta name="msapplication-navbutton-color" content="'.$theme_color.'">
        ';
        fun_tab_title();
        if(!$all_metatag){fun_get_all_metatag();}
        fun_get_theme_style();
        fun_theme_head_code_js();
        fun_get_code_google_ads();
        wp_head();
        if(!empty($codes_head) && !$status_codes_head){echo $codes_head;}
    ?>
<?php echo '<script src="'. esc_url(get_template_directory_uri()).'/assets/js/code_head.js">';?></script>
</head>
<body <?php body_class('light-mode')?>>
    <button aria-label='<?php echo esc_html__('أعلى الصفحة','data_news_pro');?>' id='up_button'><i class='fa-solid fa-chevron-up'></i></button>

    <?php
        echo '<nav class="topnav-site">
            <div class="container">';
                $topnav_ads_word   = esc_html(get_theme_mod('topnav_ads_word',esc_html__('للإعلان','data_news_pro')));
                $topnav_ads_link   = esc_url(get_theme_mod('topnav_ads_link'));
                $topnav_ads_status = get_theme_mod('topnav_ads_status',false);
                if(!$topnav_ads_status){
                    if(!empty($topnav_ads_link)){
                        echo '
                            <a class="advertise" href="'.$topnav_ads_link.'">
                                <i class="icon fa-solid fa-bullhorn"></i>
                                <span class="advertise-text">'.$topnav_ads_word.'</span>
                            </a>
                        ';
                    }
                }

                echo '
                    <div class="box-date" id="box-date">
                        <div class="current-time">
                            <i class="fa-regular fa-clock"></i>
                            <div class="time-now">
                                <span class="time-now-number" id="time_now_number"></span>
                            </div>
                        </div>
                    </div>
                    <div class="topnav-icon-group">
                        <button 
                            aria-label="'.esc_html__('التبديل بين الوضع النهاري والوضع الليلي','data_news_pro').'"
                            class="icon fa-solid fa-moon" id="toggle-mdoe">
                        </button>';
                        $topnav_login_icon = get_theme_mod('topnav_login_icon');
                        if(!$topnav_login_icon){
                            if(is_user_logged_in()){
                                echo '<a 
                                    class="icon icon-logout" 
                                    href="'.esc_url(wp_logout_url()).'" 
                                    aria-label="'.__( 'Log out' ).'" 
                                    title="'.__( 'Log out' ).'">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>';
                            } 
                            else {
                                echo '<a 
                                    class="icon icon-login" 
                                    href="'.esc_url(wp_login_url()).'" 
                                    aria-label="'.__( 'Log In' ).'" 
                                    title="'.__( 'Log In' ).'">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </a>';
                            }
                        }
                    echo '</div>
            </div>
        </nav>';
    ?>

    <script>
        const toggleMode=document.getElementById("toggle-mdoe");toggleMode.addEventListener("click",function(){toggleMode.classList.contains("fa-moon")&&document.body.classList.contains("light-mode")?(toggleMode.classList.add("fa-sun"),toggleMode.classList.remove("fa-moon"),document.body.classList.add("dark-mode"),document.body.classList.remove("light-mode"),localStorage.setItem("iconMode","fa-sun"),localStorage.setItem("themeMode","dark-mode")):toggleMode.classList.contains("fa-sun")&&document.body.classList.contains("dark-mode")&&(toggleMode.classList.add("fa-moon"),toggleMode.classList.remove("fa-sun"),document.body.classList.add("light-mode"),document.body.classList.remove("dark-mode"),localStorage.setItem("iconMode","fa-moon"),localStorage.setItem("themeMode","light-mode"))}),"fa-sun"===localStorage.getItem("iconMode")&&(toggleMode.classList.add(localStorage.getItem("iconMode")),document.body.classList.add(localStorage.getItem("themeMode")),document.body.classList.remove("light-mode"),toggleMode.classList.remove("fa-moon"));
    </script>

    <?php 
        echo '
            <nav class="navbar-site" role="navigation">
                <div class="container">
                    <button 
                        aria-label="'.esc_html__('فتح وإغلاق قائمة التصنيفات','data_news_pro').'"
                        class="nav-icon fa-solid fa-bars" id="navbarOpen">
                    </button>';
                    fun_get_menu("menu_categories","navbar","navbar",3);
                    echo '<div id="navbar-logo"></div>
                    <button 
                            aria-label="'.esc_html__('فتح صندوق البحث','data_news_pro').'"
                            class="nav-icon fa-solid fa-search" id="searchOpen">
                    </button>
                </div>
             <div id="navbarClose"></div>
            </nav>

            <header class="header-site" id="header-site">
                <div class="container">
                    <div class="header-logo">
                        <a class="header-link" href="'.esc_url(get_bloginfo('url')).'">';
                            $header_logo = esc_attr(get_theme_mod('header_logo'));
                            if(!empty($header_logo)){
                                echo '<img src="'.$header_logo.'" alt="'.get_bloginfo('name').'" class="header-img" height="'.get_theme_mod('header_logo_height','113').'px" loading="lazy" width="'.get_theme_mod('header_logo_width','200').'px" >';
                                echo '<style>.header-blog-title {display: none}</style>';
                            }
                            if(is_singular()){
                                echo '<div class="header-blog-title">'.get_bloginfo('name').'</div>';
                            } else {
                                echo '<h1 class="header-blog-title">'.get_bloginfo('name').'</h1>';
                            }
                        echo '</a>
                    </div>';
                    fun_get_ads('ad_code1','ad_header');
                echo'</div>
            </header>';

            $news_ticker_word =  esc_html(get_theme_mod('news_ticker_word',esc_html__('عاجل','data_news_pro')));
            $news_ticker_count = esc_html(get_theme_mod('news_ticker_count',10));
            $arags = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $news_ticker_count,
            );
            $query = new WP_Query($arags);
        
            echo '<div class="news-tickers">
                <div class="container">
                    <div class="news-ticker-sec" id="news-ticker">
                        <div class="news-ticker">
                            <strong class="news-ticker-word">'.$news_ticker_word.'</strong>
                            <div class="news-ticker-wrapper">
                                <ul class="news-ticker-items" id="news-ticker-items">';
                                    if ($query->have_posts() ) {
                                        while ($query->have_posts() ) {
                                            $query->the_post();
                                            echo '<li><a class="line" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                                        }
                                    } else {
                                        echo '<li>'.esc_html__('لا يوجد مقالات','data_news_pro').'</li>';
                                    }
                                echo '</ul>
                            </div>
                        </div>
                    </div>
                
                    <div aria-label="اظهر صندوق البحث" class="search-site" id="search-site">
                        <form action="'. esc_url(get_bloginfo('url')).'" class="search-group">
                            <input class="input" name="s" placeholder="'.esc_html__('بحث ...','data_news_pro').'">
                            <button class="search-submit" type="submit">'.esc_html__('بحث','data_news_pro').'</button>
                        </form>
                        <button class="fa-solid fa-close" id="close-search"></button>
                    </div>
                </div>
            </div>
        ';
    ?>

    <div class="container container-z">
    <?php 
        // إعلان بعد شريط الأخبار
        if(is_single() || is_author()){
            if(!empty($ad_code_head) && !$status_ad_code_head && !empty(get_the_author_meta('data_ad_slot_1', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){
                ?>
                <div class="ads ads-author-id-<?php echo $post_author_id;?>" id="ad_news_ticker_after">
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                        data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_1', $post_author_id)?>"
                        data-ad-format="auto"
                        data-full-width-responsive="true">
                    </ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                </div>
                <?php
            } 
            else {
                fun_get_ads('ad_code2','ad_news_ticker_after');
            }
        }
        else {
            fun_get_ads('ad_code2','ad_news_ticker_after');
        }
    ?>
