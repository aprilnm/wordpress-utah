<div class="space-70"></div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 margin-btm-20">
                <?php dynamic_sidebar('footer1'); ?>
            </div><!--col-4 end-->
            <div class="col-md-3 margin-btm-20">
                <?php dynamic_sidebar('footer2'); ?>
            </div><!--latest post col end-->
            <div class="col-md-6 margin-btm-20">
                <?php dynamic_sidebar('footer4'); ?>
            </div><!--get in touch col end-->
        </div><!--footer main row end-->  
         <div class="row">
            <div class="col-md-12 text-center">
                <span><?php echo get_bw_theme_options('footer_copyright'); ?></span>
            </div>
        </div><!--footer copyright row end-->
    </div><!--container-->
</div><!--footer main end-->
<?php wp_footer(); ?>
</body>
</html>

