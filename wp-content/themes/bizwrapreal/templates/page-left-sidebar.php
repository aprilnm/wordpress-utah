<?php
/*
 * Template Name: Page left sidebar
 */
?>

<?php get_header(); ?>
<section id="content-region-3" class="padding-40 page-tree-bg">
    <div class="container">
        <h3 class="page-tree-text">
            <?php the_title(); ?>
        </h3>
    </div>
</section>
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php get_bw_sidebar(); ?>
        </div>
        <div class="col-md-8">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                      <?php the_content(); ?>
                <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
