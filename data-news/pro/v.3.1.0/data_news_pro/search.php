<?php  
    get_header(); 
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
            fun_get_ads('ad_code9','status_ad_code9','ad-pagination-before');
            fun_post_pagination();
            fun_get_ads('ad_code10','status_ad_code10','ad-pagination-after');
        echo '</main>';
        get_sidebar();
    echo '</div>';
get_footer();

