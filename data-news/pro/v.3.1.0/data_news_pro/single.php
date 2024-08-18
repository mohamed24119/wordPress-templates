<?php
    get_header();

    $status_options = [
        'status_post_published_date',
        'status_post_updated_date',
        'status_post_views',
        'status_post_comment',
        'status_post_tags',
        'status_post_related',
        'status_post_comments_box',
        'status_post_thumbnail',
        'status_post_author',
        'single_tableOfContents',
        'status_post_related_author'
    ];
    foreach ($status_options as $item) {
        if($item == "status_post_updated_date"){
            $$item = get_theme_mod($item,   true);
        } else {
            $$item = get_theme_mod($item,   false);
        }
        
    }




    $post_related_type              = get_theme_mod('post_related_type',        'category');
    $label_post_published           = get_theme_mod('label_post_published', esc_html__('تاريخ النشر:','data_news_pro'));
    $label_author                   = get_theme_mod('label_author',         esc_html__('كتب','data_news_pro'));
    $label_post_views               = get_theme_mod('label_post_views',     esc_html__('مشاهدة','data_news_pro'));
    $post_related_by_author_text   = get_theme_mod('post_related_by_author_text', esc_html__('مقالات مقترحة لنفس الكاتب','data_news_pro'));
    $tableOfContents_headding       = get_theme_mod('tableOfContents_headding','h2,h3,h4');


    $post_id = get_queried_object_id();
    $post_author_id     = get_post_field('post_author', $post_id);
    $ad_code_head       = esc_html(get_theme_mod('ad_code_head'));
    $status_ad_code_head   = get_theme_mod('status_ad_code_head'); 

?>


 
    <div class="wrapper">
        <main class="main-content">
            <div class="section" id="main">
                <?php if (have_posts()) {
                    while (have_posts()) {
                        get_template_part('inc/breadcrumb');
                        the_post();?>
                        <div class="blog-post">
                            <article class="article-post" id="post-id-<?php echo get_the_ID()?>">
                                <?php fun_get_application_json_post_meta()?>
                                <div class="article-post-header">
                                    <?php
                                        echo '
                                            <h1 class="post-title">'.get_the_title().'</h1>
                                            <meta content="'.get_permalink().'">
                                        ';

                                        if(!$status_post_published_date || !$status_post_updated_date || !$status_post_views || !$status_post_comment){
                                            echo '<div class="post-meta">';

                                                if(!$status_post_published_date){
                                                    echo '
                                                        <time class="meta-item post-meta post-published" datetime="'.esc_attr(get_the_time("c")).'">
                                                            <div class="post-published-date"><i class="fa-regular fa-calendar-days"></i> <span class="post-updated-label"> '.$label_post_published.'</span> '.get_the_time("D j F Y").'</div>
                                                            <div class="post-published-clock"><i class="icon fa-regular fa-clock"></i> '.get_the_time().'</div>
                                                        </time>                                            
                                                    ';
                                                }

                                                if(!$status_post_updated_date){
                                                    echo '
                                                        <time class="meta-item post-meta post-updated" datetime="'.esc_attr(get_the_modified_time("c")).'">
                                                            <div class="post-updated-date"><i class="fa-regular fa-calendar-days"></i> <span class="post-updated-label">أخر تحديث </span> '.get_the_modified_date("D j F Y").'</div>
                                                            <div class="post-updated-clock"><i class="icon fa-regular fa-clock"></i> '.get_the_modified_time().'</div>
                                                        </time>                                            
                                                    ';
                                                }
                                                
                                                if(!$status_post_views){
                                                    echo '<div class="post-views"><i class="fa fa-eye"></i> '.get_post_views_count(get_the_ID()). ' ' . $label_post_views.'</div>';
                                                }

                                                if(!$status_post_comment){
                                                    echo '<a class="meta-item post-meta-comment" href="'.esc_url(get_the_permalink()).'#commentform"> <i class="fa-regular fa-comment-dots"></i> '.get_comments_number(get_the_ID()).'</a>';
                                                }
                                            echo '</div>';
                                        }
                                    ?>
                                </div>

                                <?php if(!$status_post_thumbnail){echo fun_post_thumbnail();}?>
   
                                <div class="post-body">
                                    <div class="article-post-meta">
                                        <?php 
                                            
                                            if($status_post_author == false){
                                                if(!get_the_author_meta('user_author_name',$post_author_id)){
                                                    echo '
                                                        <div class="meta-item post-author" rel="author">
                                                            <div class="meta-item author-label">
                                                                <i class="fa-solid fa-user"></i><span>'.$label_author.'</span>
                                                            </div>
                                                            <a class="author-name" href="'.esc_url(get_author_posts_url($post_author_id)).'">'.get_the_author().'</a>
                                                        </div>                                        
                                                    ';
                                                }
                                            }
                                            fun_get_icons_post_share();
                                        ?>
                                    </div>
                                    <div class="data-post-body" id="data-post-body">
                                        <?php 
                                            // إعلان أول المقالة
                                        
                                            if(!empty($ad_code_head) && !$status_ad_code_head && !empty(get_the_author_meta('data_ad_slot_2', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){?>
                                                <div class="ads" id="ads-posts-top">
                                                    <ins class="adsbygoogle"
                                                        style="display:block"
                                                        data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                                                        data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_2', $post_author_id)?>"
                                                        data-ad-format="auto"
                                                        data-full-width-responsive="true">
                                                    </ins>
                                                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                                                </div><?php 
                                            }
                                            else {
                                                fun_get_ads('ad_code11','ads-posts-top');
                                            }
                                        
                                        ?>
                                        <div class="data-post-content" id="data-post-content"><?php the_content()?></div>
                                        <?php 
                                        
                                        
                                            // إعلان بعد فقرة عشوائية
                                            // التحقق إذا كان الكاتب يضمن معرف الإعلان
                                            if(!empty($ad_code_head) && !$status_ad_code_head && !empty(get_the_author_meta('data_ad_slot_3', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){?>
                                                <div class="ads" id="ads-posts-random">
                                                    <ins class="adsbygoogle"
                                                        style="display:block; text-align:center;"
                                                        data-ad-layout="in-article"
                                                        data-ad-format="fluid"
                                                        data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                                                        data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_3', $post_author_id)?>">
                                                    </ins>
                                                    <script>
                                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                                    </script>
                                                </div><?php
                                            } 
                                        
                                            else {
                                                // تضمين شفرة الإعلان الافتراضية لمالك الموقع
                                                fun_get_ads('ad_code12','ads-posts-random');
                                            }

                                            if(!empty(get_the_author_meta('data_ad_slot_3', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id) || !empty(get_theme_mod('ad_code14')) && !get_theme_mod('status_ad_code14')){?>
                                                <script>
                                                    const ads_posts_random = document.querySelector("#ads-posts-random");
                                                    const data_post_content_ad = document.querySelector("#data-post-content");
                                                    const ads_p = data_post_content_ad.querySelectorAll("p,br");
                                                    if(ads_p.length>0){
                                                        const ads_pr = Math.floor(Math.random()*ads_p.length);
                                                        const ads_el=document.createElement("div");
                                                        ads_el.innerHTML=ads_posts_random.innerHTML;
                                                        ads_p[ads_pr].after(ads_el);ads_posts_random.remove();
                                                    }
                                                </script><?php 
                                            }

                               
                                            // إعلان في نهاية المقالة
                                            if(!empty(get_the_author_meta('data_ad_slot_4', $post_author_id)) && !get_the_author_meta('user_ads_disabled', $post_author_id)){?>
                                                <div class="ads" id="ads-posts-bottom">
                                                    <ins class="adsbygoogle"
                                                        style="display:block"
                                                        data-ad-format="autorelaxed"
                                                        data-ad-client="ca-pub-<?php echo $ad_code_head?>"
                                                        data-ad-slot="<?php echo get_the_author_meta('data_ad_slot_4', $post_author_id)?>">
                                                    </ins>
                                                    <script>
                                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                                    </script>
                                                </div><?php 
                                            } 
                                        
                                            else {
                                                // الإعلان الافتراضي لمالك الموقع في حالة عدم تضمين إعلان للكاتب
                                                fun_get_ads('ad_code13','ads-posts-bottom');
                                            }
                                        

                                        // الوسوم
                                        if(!$status_post_tags){
                                            fun_get_tags_posts();
                                        }

                                        // معلومات عن الكاتب
                                        if(!get_the_author_meta('user_author_card')){
                                            get_template_part('inc/author_card');
                                        }
                                        ?>


                                        <?php 
                                            
                                            // مقالات حسب الكاتب الحالي
                                            if(!$status_post_related_author){ 
                                                echo '<div id="posts_related_author"
                                                    data-wp-url="'.esc_url(get_bloginfo('url')).'"
                                                    data-author-id="'.$post_author_id.'" 
                                                    data-widget-title="'.$post_related_by_author_text.'"
                                                    data-class-name="grid grid-2 grid-list"
                                                    data-random-posts="true" 
                                                    data-posts-count="6"
                                                    data-slug="'.get_the_author_meta('user_login',$post_author_id).'"
                                                ></div>';
                                            }

                                            // إعلان قبل مقالات ذات صلة لمالك الموقع
                                            fun_get_ads('ad_code14','ads-related-before');

                                            // مقالات ذات صلة
                                            if(!$status_post_related){
                                                fun_get_related_posts(''.$post_related_type.'');

                                            }



                                           // نموذج التعليقات
                                            if(!$status_post_comments_box){
                                                echo comments_template();
                                            }

                                            // جدول المحتويات
                                            if(!$single_tableOfContents){ 
                                                echo '<script src="'. esc_url(get_template_directory_uri()).'/assets/js/table_of_content.js"></script>';
                                                echo '<script>get_table_of_contents("#data-post-content","'.$tableOfContents_headding.'")</script>';
                                            }
                                        
                                            
                                        ?>

                                    </div>

                                    <script>
                                        // إزالة الصورة المطابقة للصورة البارزة لعدم التكرار
                                        let post_featured_image = document.querySelector(".post-featured-image img");
                                        const data_post_content = document.querySelector("#data-post-content");
                                        let wp_block_image_first = data_post_content.querySelector(".wp-block-image img");
                                        if(post_featured_image !== null && wp_block_image_first !== null){
                                            if(post_featured_image.src == wp_block_image_first.src){
                                                wp_block_image_first.parentElement.parentElement.remove();
                                            }
                                        }

                                    </script>
                                </div>
                            </article>
                        </div>
                    <?php } 
                } 
                else {
                    // طباعة رسالة مخصصة في حالة عدم العثور على مشاركات
                    fun_not_posts();
                }
                ?>
            </div>
        </main>
        <?php 
        // استدعاء العمود الجانبي
        get_sidebar();
        ?>
    </div>
<?php get_footer();?>