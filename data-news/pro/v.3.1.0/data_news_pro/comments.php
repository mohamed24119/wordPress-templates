<?php
    $data_messages_blog_comment = get_theme_mod('data_messages_blog_comment');
    $title_reply                = esc_html__('إضافة تعليق','data_news_pro');
    $title_reply_to             = esc_html__(' رد على التعليق','data_news_pro');
    $comment_form_label_name    = esc_html__('الاسم','data_news_pro');
    $comment_form_label_email   = esc_html__('البريد الالكتروني','data_news_pro');
    $comment_form_label_website = esc_html__('الموقع الالكتروني','data_news_pro');
    $comment_form_label_content = esc_html__('محتوى التعليق','data_news_pro');
    $comment_close_label        = esc_html__('التعليقات متوقفة','data_news_pro');
    $comment_send_label         = esc_html__('إرسال تعليق','data_news_pro');

    $comment_per_page = get_theme_mod('comment_per_page','10');
    $comment_depth = get_theme_mod('comment_depth','3');
    $comment_avatar_size = get_theme_mod('comment_avatar_size','44');
    if(comments_open()){
        ?>
        <div class="widget comments threaded">
            <div class="widget-header">
                <span class="widget-title data-messages-comments">
                    <i class="fa-regular fa-comment-dots"></i>
                    <?php comments_number(' لا يوجد تعليقات', '1 تعليق', '% تعليقات') ?>
                </span>
            </div>
            <div class="widget-content">
                <div class="custom-messages-comment">
                    <p class="data-messages-postAComment" id="comment-post-message">
                        <i class="icon fa-solid fa-comment-dots"></i> <b><?php echo $comment_send_label?></b>
                    </p>
                    <p class="data-messages-blog-comment"><?php echo $data_messages_blog_comment?></p>
                </div>


                
                <?php 
                    $comments_arguments = array(
                        'max_depth' => esc_attr($comment_per_page),
                        'type' => 'comment',
                        'per_page' => esc_attr($comment_depth), 
                        'avatar_size' => esc_attr($comment_avatar_size),
                        'reverse_top_level' => true
                    );

                    echo '<div class="widget-content"><ul class="comments">';
                        wp_list_comments($comments_arguments);
                    echo '</ul></div>';
                    $commentform_arguments = array(
                        'title_reply' => ''.esc_html($title_reply).'',
                        'title_reply_to' => ''.esc_html($title_reply_to).' {%s}',
                        'class_submit' => 'btn-send-conmment',
                        'comment_notes_before' => '',
                        'fields' => array(
                            'author' => '<div class="form-group">
                                <input 
                                    name="author" type="text" 
                                    class="form-control" 
                                    id="author" 
                                    aria-label="'.$comment_form_label_name.'" 
                                    placeholder="'.$comment_form_label_name.'"
                                >
                            </div>',

                            'email' => '<div class="form-group">
                                <input 
                                    name="email" 
                                    type="text" 
                                    class="form-control" 
                                    id="email" 
                                    aria-label="'.$comment_form_label_email.'" 
                                    placeholder="'.$comment_form_label_email.'"
                                >
                            </div>',

                            'url' => '<div class="form-group">
                                <input 
                                    name="url" 
                                    type="text" 
                                    class="form-control" 
                                    id="url" 
                                    aria-label="'.$comment_form_label_website.'" 
                                    placeholder="'.$comment_form_label_website.'"
                                >
                            </div>'
                        ),
                        'comment_field' => '<div class="form-group">
                            <textarea 
                                class="form-control" 
                                rows="8" 
                                id="comment" 
                                name="comment" 
                                aria-label="'.$comment_form_label_content.'" 
                                placeholder="'.$comment_form_label_content.'"
                            ></textarea>
                        </div>'
                    );
                    comment_form($commentform_arguments);
                ?>
            </div>
        </div>
    <?php }
    else {
        echo '<div class="widget-content">'.$comment_close_label.'</div>';
    }
?>
<style>
.comments.threaded{display:grid;border-radius:8px;overflow:hidden;border:1px dashed #d5d7d9;}.data-messages-postAComment{margin-top:0;display:flex;align-items:center;column-gap:10px;color:#df2829;}.comments{background-color:#f4f5f9;margin-inline:-8px;}.comments>li{position:relative;margin-bottom:30px;padding:10px;background-color:#fff;border:1px dashed #ddd;}.comment-body{background-color:#fff;margin-bottom:15px;}.comment-author.vcard{display:flex;column-gap:10px;align-items:center;}.comments .avatar{width:44px;height:44px;inset-inline-start:5px;border-radius:50%;display:flex;align-items:center;justify-content:center;overflow:hidden;}.says{display:none;}.fn .url{color:initial;font-weight:bold;}.comment-meta,.comment-meta a{color:#3a3a3a;}.comment-meta{font-size:13px;inset-inline-end:30px;display:flex;align-items:center;column-gap:5px;}.comment-meta+p{background-color:#fff;margin:0;border-bottom:1px dashed #ddd;text-align:justify;}.comment-reply-link{background-color:#df2829;color:#fff;min-height:36px;padding-inline:15px;border-radius:4px;display:inline-flex;margin-block:5px;}.comments .children{margin-inline-start:15px;}#comment{width:100%;padding:15px;}.form-submit{margin:0;}.comments #submit{background-color:#df2829;color:#fff;min-height:36px;padding-inline:15px;border-radius:4px;display:inline-flex;margin-block:5px;cursor:pointer;width:auto;border:0;}.dark-mode .comments,.dark-mode .comments>li,.dark-mode .comment-meta+p,.dark-mode .comment-body{background-color:transparent!important;}
</style>