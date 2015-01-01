<?php get_header(); ?>
<?php
$page_for_posts = get_option('page_for_posts');
$post_sidebar = get_post_meta($page_for_posts, '_bw_page_sidebar', true);
?>
<section class="padding-40 page-tree-bg">
    <div class="container">
        <h3 class="page-tree-text">
            <?php
            echo get_the_title($page_for_posts);
            ?>
        </h3>
    </div>
</section>
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="col-md-6">
                    <div class="blog-post-section">
                        <div class="blog-post-img">
                            <?php echo get_the_post_thumbnail($post->ID, 'large', array('class' => 'img-responsive')) ?>
                        </div>
                        <div class="blog-post-header">
                            <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                        </div>
                        <div class="blog-post-info">
                            <span><?php _e('By', 'bizwrap'); ?> <span><?php the_author_posts_link(); ?> | on <?php echo get_the_date(); ?> | <?php the_category(', '); ?> | <?php comments_number(); ?></span>
                        </div>
                        <div class="blog-post-detail">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="blog-post-more text-right">
                            <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php get_footer(); ?>