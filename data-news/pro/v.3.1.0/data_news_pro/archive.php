<?php  
    get_header(); 
    $random_posts_category  = get_theme_mod('random_posts_category');
    $random_posts_tag       = get_theme_mod('random_posts_tag');
    $random_posts_author    = get_theme_mod('random_posts_author');

    // مقالات عشوائية حسب التصنيف الحالي
    if(is_category() && $random_posts_category){ 
        $category_id = get_queried_object_id();
        function get_category_post_count($cat_id) {
            $category = get_category($cat_id);
            if ($category) {
                return $category->count;
            }
            return 0;
        }
        $category_post_count = get_category_post_count($category_id);
        if($category_post_count >= 5){?>
            <div class="posts-overlay">
                <div id="randomPostsSec1">
                    <div
                        data-wp-url="<?php echo esc_url(get_bloginfo('url'))?>"
                        data-category-id="<?php echo esc_attr($category_id)?>" 
                        data-widget-title="<?php single_term_title()?>"
                        data-class-name="grid"
                        data-random-posts="true" 
                        data-posts-count="5"
                    ></div>
                </div>
            </div>
        <?php }
    }

    // مقالات عشوائية حسب الوسم الحالي
    elseif(is_tag() && $random_posts_tag){ 
        $tag_id = get_queried_object_id();
        function get_tag_post_count($v_tag_id) {
            $tag = get_tag($v_tag_id);
            if ($tag) {
                return $tag->count;
            }
            return 0;
        }
        $tag_post_count = get_tag_post_count($tag_id);
        if($tag_post_count >= 5){?>
            <div class="posts-overlay">
                <div id="randomPostsSec1">
                    <div
                        data-wp-url="<?php echo esc_url(get_bloginfo('url'))?>"
                        data-tag-id="<?php echo esc_attr($tag_id)?>" 
                        data-widget-title="<?php single_term_title()?>"
                        data-class-name="grid"
                        data-random-posts="true" 
                        data-posts-count="5"

                    ></div>
                </div>
            </div>
        <?php }
    }




    // مقالات عشوائية حسب الكاتب الحالي 
    elseif(is_author() && $random_posts_author){ 
        $author_id = get_queried_object_id();
        $author_name = get_the_author_meta('display_name',$author_id);
        ?>

        <div class="posts-overlay">
            <div id="randomPostsSec1">
                <div 
                    data-wp-url="<?php echo esc_url(get_bloginfo('url'))?>" 
                    data-author-id="<?php echo esc_attr($author_id)?>" 
                    data-class-name="grid"
                    data-widget-title="<?php echo esc_attr($author_name)?>" 
                    data-random-posts="true" 
                    data-posts-count="5"
                ></div>
            </div>
        </div>
    <?php } ?>

    <?php 

    echo '<div class="wrapper">
        <main class="main-content">';
            get_template_part('inc/breadcrumb');
            echo '<div class="widget">';
                if(have_posts()) :
                    echo '<div class="widget-body blog-posts grid grid-3">';
                        while(have_posts()) : the_post();
                            fun_loop_posts('true');                 
                        endwhile;
                    echo '</div>';
                else :
                    get_template_part('404');
                endif;
            echo '</div>';
            // إعلان قبل ترقيم الصفحات
            fun_get_ads('ad_code9','status_ad_code9','ad-pagination-before');
            // ترقيم الصفحات
            fun_post_pagination();
            // إعلان بعد ترقيم الصفحات
            fun_get_ads('ad_code10','status_ad_code10','ad-pagination-after');
        echo '</main>';
        get_sidebar();
    echo '</div>';
get_footer();