<?php
get_template_part('admin/customaize/genral');
get_template_part('assets/css/customaize_style');
get_template_part('admin/customaize/meta');

// استدعاء الويدجات المخصصة
get_template_part('admin/custom_widgets/tags');
get_template_part('admin/custom_widgets/categories');
get_template_part('admin/custom_widgets/popular_posts');
get_template_part('admin/custom_widgets/users');
get_template_part('admin/custom_widgets/widget_archive');

// استدعاء الأعمدة المخصصة التي تم إضافتها ضمن لوحة التحكم
get_template_part('admin/add_columns');


// استدعاء الحقول المخصصة ضمن الملف الشخصي للعضو
get_template_part('admin/add_fields/tag');
get_template_part('admin/add_fields/category');
get_template_part('admin/add_fields/users');


$ad_code_head       = esc_html(get_theme_mod('ad_code_head'));
$status_ad_code_head   = get_theme_mod('status_ad_code_head');


// التحقق من اتجاه الصفحة
function fun_direction(){
	if(is_rtl()){echo 'rtl';}
	else {echo 'ltr';}
}




// إنشاء القوائم
function register_menus(){
	register_nav_menus(
		array(
			'menu_categories'  	=> esc_html__("قائمة التصنيفات الرئيسية",'data_news_pro'),
			'menu_pages'  		=> esc_html__("قائمة الصفحات الثابتة",'data_news_pro'),
		)
	);
}
function fun_get_menu($theme_location,$menu_id,$menu_class,$depth){
	wp_nav_menu(array(
	'theme_location'   => $theme_location, 
	'menu_id'          => $menu_id,
	'menu_class'       => $menu_class,
	'container'        => false,
	'depth'            => $depth,
	'fallback_cb' 	   => false,
	));
}
add_action('init', 'register_menus');



add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('customize-selective-refresh-widgets' );

add_theme_support( 'post-formats', array('status','aside','gallery','link','image','quote','video','audio','chat') );





function fun_post_thumbnail($class_name = ""){
	global $post;

	$post_thumbnail_url = "";
	$post_thumbnail_alt = "";

	if($class_name != ""){
		$class_name = 'class="'.$class_name.'"';
	}


	$post_id = get_the_ID();
	$post_title = get_the_title($post_id);
	if (has_post_thumbnail()) {
		$post_thumbnail_url = get_the_post_thumbnail_url($post_id);
		$post_thumbnail_alt = get_post_meta(get_the_post_thumbnail_caption($post_id));
		if(!empty($post_thumbnail_alt)){
			$post_thumbnail_alt =  $post_thumbnail_alt;
		} 
		else {
			$post_thumbnail_alt = $post_title;
		}
		return '
			<figure class="post-featured-image">
					<img '.$class_name.' src="'.$post_thumbnail_url.'" alt="'.$post_thumbnail_alt.'">
					<figcaption class="line">
					'.get_the_title().'
				</figcaption>
			</figure>
		';				
	} 
	elseif (!has_post_thumbnail()) {
		$attachments = get_posts(array(
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'posts_per_page' => 1,
		));
		if ($attachments) {
			$first_attachment = $attachments[0];
			set_post_thumbnail($post->ID, $first_attachment->ID);
		}
	}

	else{
		return '
			<figure class="post-featured-image">
					<img '.$class_name.' src="'.$get_theme_mod('default_thumbnail').'" alt="'.$post_thumbnail_alt.'">
					<figcaption class="line">
					'.get_the_title().'
				</figcaption>
			</figure>
		';
	}
}


function fun_posts_thumbnail($class_name = ""){
	$post_thumbnail_url = "";
	$post_thumbnail_alt = "";

	if($class_name != ""){
		$class_name = 'class="'.$class_name.'"';
	}


	$post_id = get_the_ID();
	$post_title = get_the_title($post_id);
	if (has_post_thumbnail()) {
		$post_thumbnail_url = get_the_post_thumbnail_url($post_id);
		$post_thumbnail_alt = get_post_meta(get_the_post_thumbnail_caption($post_id));

		if(!empty($post_thumbnail_alt)){
			$post_thumbnail_alt =  $post_thumbnail_alt;
		} 
		else {
			$post_thumbnail_alt = $post_title;
		}
		return '<img '.$class_name.' src="'.$post_thumbnail_url.'" alt="'.$post_thumbnail_alt.'">';
	} 

	else {
		return '<img class="default-thumbnail" src="'.get_theme_mod('default_thumbnail').'" alt="'.$post_title.'">';
	}
}


function fun_get_application_json_post_meta(){
    $meta_post_thumbnail = get_theme_mod('default_thumbnail');
    
    if (has_post_thumbnail()) {
        $meta_post_thumbnail = get_the_post_thumbnail_url();
    } else {
        return $meta_post_thumbnail;
    }
    $schema_type_default = get_theme_mod('schema_type_default','NewsArticle');
    echo '<script type="application/ld+json">
        {
            "@context"          : "http://schema.org",
            "@type"             : "'.$schema_type_default.'",
            "mainEntityOfPage"  : {
                "@type"         : "WebPage",
                "@id"           : "'.get_the_permalink().'"
            },
            "headline"          : "'.get_the_title().'",
            "description"       : "'.esc_html(get_the_excerpt()).'",
            "datePublished"     : "'.get_the_time("c").'",
            "dateModified"      : "'.get_the_modified_date("c").'",
            "image"             : {
                "@type"         : "ImageObject",
                "url"           : "'.$meta_post_thumbnail.'",
                "height"        : 630,
                "width"         : 1200
            },
            "publisher"         : {
                "@type"         : "Organization",
                "name"          : "'.get_bloginfo("name").'",
                "logo"          : {
                    "@type"     : "ImageObject",
                    "url"       : "'.get_theme_mod("header_logo").'",
                    "width"     : 200,
                    "height"    : 90
                }
            },
            "author"            : {
                "@type"         : "Person",
                "name"          : "'.get_the_author().'",
                "url"           : "'.get_author_posts_url('',get_the_author_meta('user_login')).'"
            }
        }
    </script>';
}




function fun_not_posts(){
	echo '<div class="not-posts"><i class="icon fa-solid fa-blog"></i><p>'.esc_html__('لم يتم العثور على مشاركات','data_news_pro').'</p></div>';
}




function fun_loop_posts(){
	echo '
		<div class="col">';
			echo '<article class="article-posts">
				<div class="article-posts-img">
					<a href="'.get_the_permalink().'">';
						echo fun_posts_thumbnail();
					echo '</a>
				</div>
				<div class="article-posts-body">
					<h2 class="line posts-headding">
						<a class="posts-title" href="'.get_the_permalink().'">'.get_the_title().'</a>
					</h2>
					<a class="post-meta" href="'.get_bloginfo('url')."/".get_the_time("Y/m/d").'">
						<time class="post-meta post-published" data-time="'.get_the_time('c').'">
							<i class="fa-regular fa-calendar-days"></i>
							'.get_the_time("D j F Y").'
						</time>
					</a>
				</div>
			</article>
		</div>
	';
}

function fun_get_related_posts($posts_related_type){
	$post_related_type_text = get_theme_mod('post_related_type_text',esc_html__('مقالات ذات صلة','data_news_pro'));
	$posts_type = "";
	if($posts_related_type == 'category'){
		$posts_type = get_the_category();
	}
	elseif ($posts_related_type == 'tag') {
		$posts_type = get_the_tags();
	}
	if ($posts_type) {
		$random_posts_related_type = array_rand($posts_type);
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 6,
			'order'=>'ASC',
			'orderby' => 'rand',
			''.$posts_related_type.'__in' => array($posts_type[$random_posts_related_type]->term_id),
			'post__not_in' => array(get_the_ID()),
		);
		$related_posts_query = new WP_Query($args);
		if ($related_posts_query->have_posts()) {
			echo '
				<div class="related-posts" id="related-posts">
					<div class="widget">
						<div class="widget-header">
							<div class="widget-title"><i class="icon fa-solid fa-random"></i>'.$post_related_type_text.'</div>
						</div>
						<div class="widget-body blog-posts grid grid-2 grid-list">';
							while ($related_posts_query->have_posts()) {
								$related_posts_query->the_post();
								fun_loop_posts();
							}
						echo '</div>
					</div>
				</div>
			';
			wp_reset_postdata();
			// إعلان بعد مقالات ذات صلة لمالك الموقع
			fun_get_ads('ad_code15','ads-related-after');
		}
	}
}


function fun_post_pagination() {
	global $wp_query;
	if( $wp_query->max_num_pages <= 1 ){
		return;
	}
	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max   = intval( $wp_query->max_num_pages );
	if ($paged >= 1){
		$links[] = $paged;
	}
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
	$links[] = $paged + 2;
	$links[] = $paged + 1;
	}
	echo '<div class="post-pagination"><ul>';
	if ( ! in_array( 1, $links ) ) {
	$class = 1 == $paged ? ' class="active"' : '';
	printf( '<li%s><a class="page-number" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( 1 ) ), '1' );
	if (! in_array(2, $links))
		echo '<li class="page-dot">…</li>';
	}

	sort($links);
	foreach ((array) $links as $link) {
	$class = $paged == $link ? ' class="active"' : '';
	printf( '<li%s><a class="page-number" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	if ( ! in_array( $max, $links ) ) {
	if ( ! in_array( $max - 1, $links ) )
	echo '<li class="page-dot">…</li>';
	$class = $paged == $max ? ' class="active"' : '';
	printf( '<li%s><a class="page-number" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	echo '</ul></div>';
}

function fun_get_tags_posts(){
	$tags = get_the_tags();
	$check_tag_icons = "";
	if($tags){
		echo '
			<div class="post-labels">
				<span class="data-byline-label">
					<i class="fa-solid fa-tags"></i> 
					'.esc_html__('الوسوم','data_news_pro').'
				</span>
				<div class="post-labels-group">';
					foreach ($tags as $tag) {
						$tag_logo = get_term_meta($tag->term_id, 'field_tag_logo', true);
						if(!empty($tag_logo)){
							$check_tag_icons = '<img class="tag-logo" data-src="'.get_bloginfo('url') . $tag_logo.'">';
						}
						$tag_link = get_tag_link($tag->term_id);
						echo '<a class="data-label-url" data-label-text="'.$tag->name.'" href="'.$tag_link.'" rel="tag">'.$check_tag_icons . $tag->name.'</a>';
					}
				echo '</div>
			</div>
		';
	}
}



function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function get_post_views_count($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    return $count ? $count : '0';
}
function track_post_views() {
    if (is_single()) {
        global $post;
        set_post_views($post->ID);
    }
}
add_action('wp_head', 'track_post_views');



/* ويدجات علامات التبويب */
function fun_register_sidebars() {
    function fun_register_sidebar($id,$name){
        register_sidebar( array(
            'name'           => __(''.$name.''),
            'id'             => ''.$id.'',
            'before_widget'  => '<div id="%1$s" class="widget %2$s">',
            'after_widget'   => '</div>',
            'before_title'   => '<div class="widget-header"><div class="widget-title"><span class="widget-icon fas fa-tags"></span>',
            'after_title'    => '</div></div>'
        ));
    }

    fun_register_sidebar('sidebar_tab1',''.get_theme_mod('sidebar_tab1_title',esc_html__('عام','data_news_pro')).'');
    fun_register_sidebar('sidebar_tab2',''.get_theme_mod('sidebar_tab2_title',esc_html__('الأقسام','data_news_pro')).'');
    fun_register_sidebar('sidebar_tab3',''.get_theme_mod('sidebar_tab3_title',esc_html__('الأكثر شعبية','data_news_pro')).'');


	register_sidebar( array(
		'name'           => esc_html__('مقالات الصفحة الرئيسية','data_news_pro'),
		'id'             => 'posts_home',
		'before_widget'  => '<div id="%1$s">',
		'after_widget'   => '</div>',
	));
}
add_action( 'widgets_init', 'fun_register_sidebars' );
	

function fun_get_term_link(){
	$term_id = get_queried_object()->term_id;
	$term_link = get_term_link($term_id);
	return $term_link;
}



// تسجيل حقل جديد في API REST لجلب رابط الصورة المميزة
function add_featured_image_to_rest_api() {
    $field_name = 'data_featured_image_url';
    register_rest_field(
        'post',
        $field_name,
        array(
            'get_callback'    => 'get_data_featured_image_url',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
add_action('rest_api_init', 'add_featured_image_to_rest_api');
function get_data_featured_image_url($object, $field_name, $request) {
    $featured_image_id = get_post_thumbnail_id($object['id']);
    $data_featured_image_url = wp_get_attachment_url($featured_image_id);
    return $data_featured_image_url;
}



$remove_default_css = get_theme_mod('remove_default_css');
if($remove_default_css){
	function fun_remove_default_css(){
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
	}
	add_action( 'wp_enqueue_scripts', 'fun_remove_default_css' );
}


$generator_v = get_theme_mod('generator_v');
if($generator_v){
	add_filter('the_generator', '__return_empty_string');
}

$rsd_link_status = get_theme_mod('rsd_link_status');
if($rsd_link_status){
	remove_action('wp_head', 'rsd_link');
}

// إزالة ملف 
// wp-emoji-styles-inline-css
$emoji_css_js = get_theme_mod('emoji_css_js',false);
if($emoji_css_js){
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
}

add_filter( 'get_the_archive_title_prefix', '__return_false' );
remove_filter('term_description','wpautop');   




// وضع الصيانة
$maintenance_mode = get_theme_mod('maintenance_mode',false);
if($maintenance_mode){
	function custom_maintenance_mode() {
		get_template_part('inc/maintenance');
	}
	add_action( 'wp', 'custom_maintenance_mode' );
}

// دعم الترجمات لنصوص القالب
// يجب استخدام إضافة loco translate 
load_theme_textdomain('data_news_pro', get_template_directory() . '/languages' );

// استدعاء ملف  وظائف مخصص من قبل المستخدم
get_template_part('user_functions');