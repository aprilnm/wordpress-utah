<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section id="content-region-<?php the_ID(); ?>" class="padding-40 page-tree-bg">
            <div class="container">
                <h3 class="page-tree-text">
                    <?php the_title(); ?>
                </h3>
            </div>
        </section><!--page-tree end here-->
        <div class="space-70"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php if(comments_open()) comments_template('', true); ?>
        </div><!--full width page end-->

    <?php endwhile; ?>		

<?php else : ?>
    <section id="content-region-<?php the_ID(); ?>" class="padding-40 page-tree-bg">
        <div class="container">
            <h3 class="page-tree-text">
                <?php _e("Not Found", "bizwrap"); ?>
            </h3>
        </div>
    </section><!--page-tree end here-->
    <div class="space-70"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p><?php _e("Sorry, but the requested resource was not found on this site.", "bizwrap"); ?></p>
            </div>
        </div>
    </div><!--full width page end-->
<?php endif; ?>
<?php get_footer(); ?>