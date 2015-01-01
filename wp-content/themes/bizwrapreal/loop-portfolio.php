<?php
$portfolio_template = get_bw_theme_options('portfolio_layout');
$portfolio_per_page = get_bw_theme_options('portfolio_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wp_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $portfolio_per_page, 'paged' => $paged, 'orderby' => 'menu_order', 'order' => 'ASC'));
?>
<?php if (!have_posts()) : ?>
    <div class="blog-post-section">
        <div class="blog-post-header">
            <h3><?php _e('Not Found', 'bizwrap'); ?></h3>
        </div>
        <div class="blog-post-detail">
            <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'bizwrap'); ?></p>
            <?php get_search_form(); ?>
        </div>
    </div>
<?php endif; ?>
<?php
$portfolio_content_class = '';
if ($portfolio_template == '22' || $portfolio_template == '32' || $portfolio_template == '42'):
    $portfolio_content_class.='grid';
endif;
?>
<div class="<?php echo $portfolio_content_class; ?>">
    <?php
    if ($wp_query->have_posts()) :
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $cats = wp_get_object_terms($post->ID, 'portfolio_category');
            $cat_slugs = '';
            $cat_names = '';
            if ($cats):
                $i = 1;
                foreach ($cats as $cat) {
                    $cat_slugs .= $cat->slug . " ";
                    if (count($cats) == $i) {
                        $cat_names.=$cat->name;
                    } else {
                        $cat_names.=$cat->name . ' , ';
                    }
                    $i++;
                }
            endif;
            if ($portfolio_template == 2):
                ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-6 col-sm-6 margin-btm-40">
                    <div class="portfolio-sec">
                        <div class="portfolio-thumnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'img-responsive')); ?>
                            </a>
                        </div>
                        <div class="portfolio-desc text-center">
                            <h4 class="portfolio-post-title"><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h4>
                            <span class="portfolio-post-cat"><?php echo $cat_names; ?></span>
                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <?php if ($portfolio_template == 22):
                ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-6 col-sm-6  margin-btm-40">
                    <div class="portfolio-sec">
                                    <figure class="effect-layla">
                                        <div class="portfolio-thumnail">
                                            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) ?>
                                        </div>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                            <?php the_excerpt(); ?>
                                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                                        </figcaption>
                                    </figure>
                                </div>
                </div>
            <?php endif; ?>
            <?php if ($portfolio_template == 3): ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-4 col-sm-6 margin-btm-40">
                    <div class="portfolio-sec">
                        <div class="portfolio-thumnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'img-responsive')) ?>
                            </a>
                        </div>
                        <div class="portfolio-desc text-center">
                            <h4 class="portfolio-post-title"><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h4>
                            <span class="portfolio-post-cat"><?php echo $cat_names; ?></span>
                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <?php if ($portfolio_template == 32): ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-4 col-sm-6 margin-btm-40">
                    <div class="portfolio-sec">
                                    <figure class="effect-layla">
                                        <div class="portfolio-thumnail">
                                            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive', 'alt' => '')) ?>
                                        </div>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                                        </figcaption>
                                    </figure>
                                </div>
                </div>
            <?php endif; ?>
            <?php if ($portfolio_template == 4): ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-3 col-sm-6 margin-btm-40">
                    <div class="portfolio-sec">
                        <div class="portfolio-thumnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'img-responsive')) ?>
                            </a>
                        </div>
                        <div class="portfolio-desc text-center">
                            <h4 class="portfolio-post-title"><a href="<?php the_permalink(); ?>" class="hover-color"><?php the_title(); ?></a></h4>
                            <span class="portfolio-post-cat"><?php echo $cat_names; ?></span>
                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($portfolio_template == 42): ?>
                <div class=" mix <?php echo $cat_slugs; ?> col-md-3" style="padding-right: 0px;">
                    <div class="portfolio-sec">
                                    <figure class="effect-layla">
                                        <div class="portfolio-thumnail">
                                            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive', 'alt' => '')) ?>
                                        </div>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                            <h4><a href="<?php the_permalink(); ?>" class="btn theme-btn-default btn-lg">More detail</a></h4>
                                        </figcaption>
                                    </figure>
                                </div>
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
</div>






