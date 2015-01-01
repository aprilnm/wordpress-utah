<?php get_header(); ?>

<div class="container">
    <div class="row">

        <div id="main" class="col-md-8" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-post-section" id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
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
                            <?php the_content(); ?>
                        </div>
                        <div class="blog-post-more text-right">
                            <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                        </div>
                    </div><!--blog post section end-->                
                    <div class="space-20"></div>
                    <?php if (comments_open()) comments_template('', true); ?>

                <?php endwhile; ?>			

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
        </div>
    </div> <!-- end #main -->

    <?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>