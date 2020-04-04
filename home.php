<?php get_header(); ?>
<div class="main-container">
    <div class="main-posts-container">
        <?php
        while (have_posts()) {
            the_post(); ?>
            <div <?php post_class(); ?>>
                <div class="main-post-container">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><img src="<?php echo esc_url(get_avatar_url(get_the_author_meta('user_email'))); ?>" alt="head_user_avatar"></img></a>
                    <div class="sub-post-container">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="sub-post-title"><?php esc_attr(the_title()); ?></a>
                        <p class="sub-post-author">By <?php esc_attr(the_author()); ?></p>
                        <div class="sub-post-categories-and-tags">
                            <?php $categories = get_the_category(get_the_ID()); ?>
                            <?php foreach ($categories as $category) { ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_attr($category->name); ?></a>
                            <?php } ?>
                            <?php $tags = get_the_tags(get_the_ID()); ?>
                            <?php if (is_array($tags) || is_object($tags)) { ?>
                                <?php foreach ($tags as $tag) { ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_attr($tag->name); ?></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(get_permalink()); ?>"><button class="main-view-post-button">View Post</button></a>
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail();
                } ?>
                <div class="main-post-content"><?php esc_attr(the_content()); ?></div>
                <div style="clear: both;"></div>
            </div>
        <?php } ?>
    </div>
    <div class="right-sidebar-wrapper">
        <?php get_sidebar('Right Sidebar'); ?>
    </div>
</div>
<?php get_footer(); ?>