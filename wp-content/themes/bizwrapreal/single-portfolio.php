<?php /* * * Portfolio Single Posts template. */ ?>
<?php get_header(); ?>

<section class="padding-40 page-tree-bg">
  <div class="container">
    <h3 class="page-tree-text">
      <?php the_title(); ?>
    </h3>
  </div>
</section>
<div class="space-70"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="portfolio-single-desc">
        <!--<div class="blog-post-img">
            <?php echo get_the_post_thumbnail($post->ID, 'blog_fullwidth', array('class' => 'img-responsive', 'alt' => '')) ?>
        </div>-->
          <div class="blog-post-header">
          <h3><a href="#" class="hover-color"><?php the_title(); ?></a></h3>
        </div>
        <!--<div class="blog-post-info">
            <span><?php _e('by', 'bizwrap'); ?><?php the_author_posts_link(); ?> | <?php _e('on', 'bizwrap'); ?> <?php the_date() ?> | <a href="#" class="hover-color"> <?php comments_number(); ?> </a>
          </span>
        </div>-->
        <div class="portfolio-single-desc">
          <?php the_content(); ?>
          <?php wp_link_pages(); ?>
          <hr>
        </div>
      </div>
      <?php if(comments_open()) comments_template('', true); ?>
      <?php
                endwhile;
            endif;
            ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
