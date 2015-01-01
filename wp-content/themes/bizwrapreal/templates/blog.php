<?php
/*
 * Template Name: Blog 
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
        <?php
        $blog_template = end(explode('_', get_bw_theme_options('blog_layout')));
        $blog_content_class = '';
        $blog_content_grid_class = '';
        switch ($blog_template) {
            case 'sliderbar':
                $blog_content_class = 'col-md-8 blog-sidebar-active';
                break;
            default:
                $blog_content_class = 'col-md-12';
                break;
        }
        ?>
        <?php if ($blog_template == '22' || $blog_template == '32' || $blog_template == '4'): ?>
            <?php
            $blog_content_grid_class='grid blog-columns-layout';
        endif;
        ?>
        <?php if ($blog_template == 'sliderbar'): ?>
            <div class="<?php echo $blog_content_class; ?>">
                <?php get_template_part('loop', 'blog'); ?> 
            </div>
            <div class="col-md-4">
                <?php get_bw_sidebar() ?>
            </div>
        <?php else:
            ?>
            <div class="<?php echo $blog_content_class; ?>">
                <div class="<?php echo $blog_content_grid_class; ?>">
                    <div class="row">
                        <?php get_template_part('loop', 'blog'); ?> 
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
