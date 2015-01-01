<?php
/*
 * Template Name: Portfolio
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
        <div class="col-md-12 text-center">
            <ul class="portfolio-filters">
                <li class="filter active" data-filter="all">all</li>
                <?php
                $portfolio_categories = get_categories(array('type' => 'portfolio', 'taxonomy' => 'portfolio_category', 'hierarchical' => 3));
                foreach ($portfolio_categories as $portfolio_categorie) {
                    echo ' <li class="filter" data-filter="' . $portfolio_categorie->slug . '">' . $portfolio_categorie->name . '</li>';
                }
                ?>
            </ul>
            <div id="grid" class="row">
                <div class="grid">
                    <?php get_template_part('loop', 'portfolio'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>