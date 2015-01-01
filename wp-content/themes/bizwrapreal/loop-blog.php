<?php
$blog_template = get_bw_theme_options('blog_layout');
$blog_per_page = get_bw_theme_options('blog_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wp_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $blog_per_page, 'paged' => $paged, 'orderby' => 'menu_order', 'order' => 'ASC'));
?>
<?php if (!have_posts()) : ?>
    <div class="blog-post-section">
        <div class="blog-post-header">
            <h3><?php _e('Not Found', 'bizwrap'); ?></h3>
        </div>
        <div class="blog-post-detail">
            <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'Bizwrap'); ?></p>
            <?php get_search_form(); ?>
        </div>
    </div>
<?php endif; ?>

<?php
if ($wp_query->have_posts()) :
    while ($wp_query->have_posts()) : $wp_query->the_post();
        if ($blog_template == 1 || $blog_template == '1_sliderbar'):
            ?>
            <div class="col-md-12">
                <div class="blog-post-section blog-section-full">
                    <div class="blog-post-img">
                        <?php echo get_the_post_thumbnail($post->ID, 'blog_fullwidth', array('class' => 'img-responsive')) ?>
                    </div>
                    <div class="blog-post-header">
                        <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                        <div class="blog-post-info">
                            <span><?php _e('By', 'bizwrap'); ?><?php the_author_posts_link(); ?> | on <?php echo get_the_date(); ?> | <?php the_category(', '); ?> | <?php comments_number(); ?></span>
                        </div>
                    </div>

                    <div class="blog-post-detail">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="blog-post-more text-right">
                        <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                    </div>
                </div>
            </div>
            <div class="space-20"></div>
            <?php
        endif;
        ?>
        <?php if ($blog_template == 2 || $blog_template == '2_sliderbar'): ?>
            <div class="col-md-6">
                <div class="blog-post-section">
                    <div class="blog-post-img">
                        <?php echo get_the_post_thumbnail($post->ID, 'large', array('class' => 'img-responsive')) ?>
                    </div>
                    <div class="blog-post-header">
                        <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="blog-post-info">
                        <span><?php _e('By', 'bizwrap'); ?> <?php the_author_posts_link(); ?> | on <?php echo get_the_date(); ?> | <?php the_category(', '); ?> | <?php comments_number(); ?></span>
                    </div>
                    <div class="blog-post-detail">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="blog-post-more text-right">
                        <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($blog_template == 22): ?>
            <div class="col-md-6">
                <figure class="effect-zoe">
                    <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) ?>
                    <figcaption>
                        <h3>
                            <?php the_title(); ?>
                        </h3>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>">View more</a>
                    </figcaption>
                </figure>
            </div>
        <?php endif; ?>
        <?php if ($blog_template == 3 || $blog_template == '3_sliderbar'): ?>
            <div class="col-md-4">
                <div class="blog-post-section">
                    <div class="blog-post-img">
                        <?php echo get_the_post_thumbnail($post->ID, 'large', array('class' => 'img-responsive')) ?>
                    </div>
                    <div class="blog-post-header">
                        <h3><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="blog-post-info">
                        <span><?php _e('By', 'bizwrap'); ?> <?php the_author_posts_link(); ?> | on <?php echo get_the_date(); ?> | <?php the_category(', '); ?></span>
                    </div>
                    <div class="blog-post-detail">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="blog-post-more text-right">
                        <a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">continue reading</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($blog_template == 32): ?>
            <div class="col-md-4">
                <figure class="effect-zoe">
                    <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) ?>
                    <figcaption>
                        <h3>
                            <?php the_title(); ?>
                        </h3>                       
                        <a href="<?php the_permalink(); ?>">View more</a>
                    </figcaption>
                </figure>
            </div>
        <?php endif; ?>
        <?php if ($blog_template == 4): ?>
            <div class="col-md-3">
                <figure class="effect-layla col-4-layout-2">
                                    <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) ?>
                                    <figcaption>
                                        <h2><?php the_title(); ?></h2>
                                        <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                                    </figcaption>
                                </figure>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
    <div class="row">
        <div class="col-md-12">          
            <?php page_navi(); // use the page navi function         ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
<?php endif; ?>

