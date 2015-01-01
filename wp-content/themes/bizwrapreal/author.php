<?php get_header(); ?>
<section class="padding-40 page-tree-bg">
    <div class="container">
        <h3 class="page-tree-text">
            <span><?php _e("Posts By:", "bizwrap"); ?></span> 
            <?php
            // If google profile field is filled out on author profile, link the author's page to their google+ profile page
            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            $google_profile = get_the_author_meta('google_profile', $curauth->ID);
            if ($google_profile) {
                echo '<a href="' . esc_url($google_profile) . '" rel="me">' . $curauth->display_name . '</a>';
                ?>
                <?php
            } else {
                echo get_the_author_meta('display_name', $curauth->ID);
            }
            ?>
        </h3>
    </div>
</section>
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <div id="main" class="col-md-8 clearfix" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="blog-post-section" id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                        <div class="blog-post-img">
                            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) ?>
                        </div>
                        <div class="blog-post-header">
                            <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                        </div>
                        <div class="blog-post-info">
                            <span><?php _e('by', 'bizwrap'); ?> <?php the_author_posts_link(); ?> | <?php _e('on', 'bizwrap'); ?> <?php echo get_the_date(); ?> |<?php the_category(', '); ?> | <?php comments_number(); ?></span>
                        </div>
                        <div class="blog-post-detail">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="blog-post-more text-right">
                            <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                        </div>
                    </div>
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