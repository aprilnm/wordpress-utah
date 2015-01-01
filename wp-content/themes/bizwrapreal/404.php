<?php get_header(); ?>
<section class="padding-40 page-tree-bg">
    <div class="container">
        <h3 class="page-tree-text">
            <?php _e('Page Not Found', 'bizwrap'); ?>

        </h3>
    </div>
</section><!--page-tree end here-->
<div class="space-70"></div>
<div class="container text-center">
    <div class="error-digit animated flipInY">
        <?php _e('Error:404', 'bizwrap'); ?>
    </div>
    <div class="space-20"></div>
    <div class="error-text">
        <h3><?php _e('page you are trying to search isnt found.', 'bizwrap') ?></h3>
        <p>
            <?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus imperdiet pulvinar risus, at posuere justo scelerisque sed.', 'bizwarp') ?> 
        </p>
        <br>
    </div>           
</div><!--error page end-->
<?php get_footer(); ?>