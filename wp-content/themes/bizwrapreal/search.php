<?php get_header(); ?>
<section id="content-region-3" class="padding-40 page-tree-bg">
    <div class="container">
        <h3 class="page-tree-text">
            <span><?php _e("Search Results for", "bizwrap"); ?>:</span> <?php echo esc_attr(get_search_query()); ?>
        </h3>
    </div>
</section><!--page-tree end here-->
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-post-section">
                        <div class="blog-post-header">
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" class="hover-color" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                        <div class="blog-post-info">
                            <span><?php _e('By', 'bizwrap'); ?> <span><?php the_author_posts_link(); ?> | on <?php echo get_the_date(); ?> | <?php the_category(', '); ?> | <?php comments_number(); ?></span>
                        </div>
                        <div class="blog-post-detail">
                            <?php the_excerpt('<span class="read-more">' . __("Read more on", "bizwrap") . ' "' . the_title('', '', false) . '" &raquo;</span>'); ?>
                        </div>
                        <div class="blog-post-more text-right">
                            <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                        </div>
                    </div>
                <?php endwhile; ?>	
                <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
                    <?php page_navi(); // use the page navi function ?>
                <?php } ?>			
            <?php else : ?>
                <!-- this area shows up if there are no results -->
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
    </div> <!-- end #content -->
</div>
<?php get_footer(); ?>