<?php get_header(); ?>
<?php
$current_url = home_url(add_query_arg(array(), $wp->request));
$index = strpos($current_url, get_bloginfo('name'));
while ($index != false) {
    $current_url = substr($current_url, $index + 1, strlen($current_url));
    $index = strpos($current_url, "/");
}
$user_of_page = get_user_by("slug", $current_url); ?>

<div class="main-container">
    <div class="main-posts-container">
        <div class="author-container">
            <div class="author-information-and-avatar">
                <?php echo get_avatar(get_the_author_meta('user_email'), 160) ?>
                <div class="author-information">
                    <p><?php echo $user_of_page->first_name ?> <?php echo $user_of_page->last_name ?></p>
                    <p><?php echo $user_of_page->user_url ?></p>
                    <p><?php echo $user_of_page->jabber ?></p>
                </div>
            </div>
            <p class="author-description"><?php echo $user_of_page->description ?></p>
        </div>
        <h5 class="author-posts-title">Author Posts</h5>
        <?php
        while (have_posts()) {
            the_post(); ?>
            <div class="main-post-container">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email')) ?></a>
                <div class="sub-post-container">
                    <a href="<?php echo get_permalink() ?>" class="sub-post-title"><?php the_title() ?></a>
                    <p class="sub-post-author">By <?php the_author(); ?></p>
                    <div class="sub-post-categories-and-tags">
                        <?php $categories = get_the_category(get_the_ID()); ?>
                        <?php foreach ($categories as $category) { ?>
                            <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                        <?php } ?>
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php if (is_array($tags) || is_object($tags)) { ?>
                            <?php foreach ($tags as $tag) { ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <a href="<?php echo get_permalink() ?>"><button class="main-view-post-button">View Post</button></a>
            <div class="main-post-content"><?php the_content() ?></div>
        <?php } ?>
    </div>
    <div class="right-sidebar-wrapper">
        <?php get_sidebar('Right Sidebar'); ?>
    </div>
</div>
<?php get_footer(); ?>