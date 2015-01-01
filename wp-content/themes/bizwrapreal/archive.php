<?php get_header(); ?>
<section class="padding-40 page-tree-bg">
    <div class="container">
        <?php if (is_category()) { ?>
            <h3 class="page-tree-text">
                <span><?php _e("Posts Categorized:", "bizwrap"); ?></span> <?php single_cat_title(); ?>
            </h3>
        <?php } elseif (is_tag()) { ?> 
            <h3 class="page-tree-text">
                <span><?php _e("Posts Tagged:", "bizwrap"); ?></span> <?php single_tag_title(); ?>
            </h3>
        <?php } elseif (is_author()) { ?>
            <h3 class="page-tree-text">
                <span><?php _e("Posts By:", "bizwrap"); ?></span> <?php get_the_author_meta('display_name'); ?>
            </h3>
        <?php } elseif (is_day()) { ?>
            <h3 class="page-tree-text">
                <span><?php _e("Daily Archives:", "bizwrap"); ?></span> <?php the_time(_x('l, F j, Y', 'Daily archives date format', 'bizwrap')); ?>
            </h3>
        <?php } elseif (is_month()) { ?>
            <h3 class="page-tree-text">
                <span><?php _e("Monthly Archives:", "bizwrap"); ?>:</span> <?php the_time(_x('F Y', 'Monthly archives date format', 'bizwrap')); ?>
            </h3>
        <?php } elseif (is_year()) { ?>
            <h3 class="page-tree-text">
                <span><?php _e("Yearly Archives:", "bizwrap"); ?>:</span> <?php the_time(_x('Y', 'Yearly archives date format', 'bizwrap')); ?>
            </h3>
        <?php } ?>

    </div>
</section><!--page-tree end here-->
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <div id="main" class="col-md-8" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-post-section">
                        <div class="blog-post-img">
                            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive', 'alt' => '')) ?>
                        </div>
                        <div class="blog-post-header">
                            <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                        </div>
                        <div class="blog-post-info">
                            <span><?php _e('by', 'bizwrap'); ?> <?php the_author_posts_link(); ?> | <?php _e('on', 'bizwrap'); ?> <?php echo get_the_date(); ?> | <?php comments_number(); ?></span>
                        </div>
                        <div class="blog-post-detail">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="blog-post-more text-right">
                            <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                        </div>
                    </div><!--blog post section end-->                
                    <div class="space-40"></div>
                <?php endwhile; ?>	

                <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
                    <?php page_navi(); // use the page navi function ?>
                <?php } ?>
            <?php else : ?>
                <div class="blog-post-section">
                    <div class="blog-post-header">
                        <h1><?php _e("Not Found", "bizwrap"); ?></h1>
                    </div>
                    <div class="blog-post-detail">
                        <p><?php _e("Sorry, but the requested resource was not found on this site.", "bizwrap"); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div> <!-- end #main -->
        <?php get_sidebar(); // sidebar 1 ?>
    </div>
</div> <!-- end #content -->
<?php get_footer(); ?>