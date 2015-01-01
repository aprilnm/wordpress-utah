<?php
/*
  Template Name: Homepage
 */
?>
<?php get_header(); ?>
<section id="slider-sec" class="slider-reg">
    <?php echo do_shortcode('[bizwarp_flexslider]'); ?>
</section><!--main flex slider end-->
<div class="space-50"></div>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <?php the_content(); ?>
        <?php
    endwhile;
endif;
?>


<?php get_footer(); ?>