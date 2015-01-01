<?php

add_shortcode('bizwarp_flexslider', 'bizwarp_slider');
add_shortcode('space', 'bizwarp_space');
add_shortcode('container', 'bizwarp_containers');
add_shortcode('row', 'bizwarp_row');
add_shortcode('servicesbox', 'bizwarp_services_box');
add_shortcode('faq_item', 'bizwarp_faqs_itesm');
add_shortcode('button', 'bizwarp_botton');
add_shortcode('get_shortcode', 'bizwarp_get_shortcode');
add_shortcode('pricing_column', 'bizwarp_price_table_item');
add_shortcode('faq', 'bizwarp_faqs');
add_shortcode('faq_box', 'bizwarp_faqs_box');
add_shortcode('portfolio', 'bizwarp_portfolio');
add_shortcode('latest_news', 'bizwarp_latest_news');
add_shortcode('team_member', 'bizwarp_team_member');
add_shortcode('progress_bar', 'bizwarp_progress_bar');
add_shortcode('title_small', 'bizwarp_heading_mini');
add_shortcode('pricing_table', 'bizwarp_price_table');
add_shortcode('one_fourth', 'bizwarp_one_fourth');
add_shortcode('one_half', 'bizwarp_one_half');
add_shortcode('one_third', 'bizwarp_one_third');
add_shortcode('list', 'bizwarp_list');
add_shortcode('list_item', 'bizwarp_list_items');
add_shortcode('service_box', 'bizwarp_service_box');

function shortcodes_cleanup($content) {
    $shortcodes = join("|", array("bizwarp_flexslider", "space", "container", "row", "servicesbox", "faq_item", "button", "get_shortcode",
        "pricing_column", "faq", "faq_box", "portfolio", "latest_news", "team_member", "progress_bar", "title_small", "pricing_table",
        'one_fourth', 'one_half', 'list', 'list_item', 'service_box',"one_third"));

    $output = preg_replace("/(<p>)?\[($shortcodes)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);

    $output = preg_replace("/(<p>)?\[\/($shortcodes)](<\/p>|<br \/>)/", "[/$2]", $output);

    return $output;
}

add_filter('the_content', 'shortcodes_cleanup');
add_filter('widget_text', 'shortcodes_cleanup');
add_filter('widget_title', 'shortcodes_cleanup');

/* * *********************** Slider************************ */

function bizwarp_slider() {
    $output = '<div class="main-flex-slider">
        <ul class="slides">';
    $slider_args = array(
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'post_type' => 'slider',
    );
    $slider_array = get_posts($slider_args);
    foreach ($slider_array as $post) : setup_postdata($post);
        $output.= '<li>
                    <figure>' . get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')) . '<figcaption class="slider-overlay ">
                            <div class="slider-text animated fadeInDown">
                                ' . get_the_content() . '                                
                            </div>
                        </figcaption>
                    </figure>
                </li>';
    endforeach;
    $output.=' </ul>
    </div>';
    return $output;
}

/* * ***********************SPACE******************** */

function bizwarp_space($atts) {
    extract(shortcode_atts(array(
        'height' => '',
                    ), $atts));
    return '<div class="space-' . $height . '"></div>';
}

/* * ***********************CONTAINER******************* */

function bizwarp_containers($atts, $content = null) {
    return '<div class="container">' . do_shortcode($content) . '</div>';
}

/* * *******************ROW******************* */

function bizwarp_row($atts, $content = null) {
    return '<div class="row">' . do_shortcode($content) . '</div>';
}

/* * *******************services-box******************* */

function bizwarp_services_box($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '', 'icons' => 'ion-laptop'
                    ), $atts));
    $output = '<div class = "col-md-3 col-sm-6">
    <div class = "services-box">
    <i class = "' . $icons . '"></i>
    <h1>' . $title . '</h1>
    <p>' . $content . '</p> </div>
    </div>';
    return $output;
}

/* * *************************FAQS******************************** */

function bizwarp_faqs_itesm($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '', 'open' => ''
                    ), $atts));
    $output = '<div class="panel panel-default">
        <div class="panel-heading">
    <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#' . preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ", "_", $title)) . '">' . $title . '</a>
        </h4>
        </div>
    <div id="' . preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ", "_", $title)) . '" class="panel-collapse collapse ' . $open . '">
                                <div class="panel-body">' . $content . '</div>
    </div></div>';
    return $output;
}

function bizwarp_faqs($atts, $content = null) {
    return '<div id="accordion" class="panel-group">' . do_shortcode($content) . '</div>';
}

function bizwarp_faqs_box($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => ''), $atts));
    return '<div class="price-faq-box"><h3>' . $title . '</h3><p>' . do_shortcode($content) . '<p></div>';
}

/* * ***************PORTFOLLW************ */

function bizwarp_portfolio($atts) {
    extract(shortcode_atts(array(
        'limit' => '6', 'title' => '', 'category' => ''), $atts));
    $output = '';
    if ($title):
        $output = '<div class="row"><div class="col-md-12">
            <h3 class="heading-sec">' . $title . '</h3>
        </div></div>';
    endif;
    $output.='<div class="row">';
    $work_args = array(
        'posts_per_page' => $limit,
        'orderby' => 'menu_order',
        'post_type' => 'portfolio',
        'category' => $category
    );
    $work_array = get_posts($work_args);
    foreach ($work_array as $portfolio):
        $cats = wp_get_object_terms($portfolio->ID, 'portfolio_category');
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
        $output.='<div class="col-md-4 col-sm-6 margin-btm-40">
            <div class="portfolio-sec">
                <div class="portfolio-thumnail">
                    <a href="' . get_permalink($portfolio->ID) . '">
        ' . get_the_post_thumbnail($portfolio->ID, 'medium', array('class' => 'img-responsive', 'alt' => '')) . '
                    </a>
                </div>
                <div class="portfolio-desc text-center">
                    <h4 class="portfolio-post-title">' . $portfolio->post_title . '</h4>
                    <span class="portfolio-post-cat">' . $cat_names . '</span>
                    <h4><a href="' . get_permalink($portfolio->ID) . '" class="btn theme-btn-default btn-lg">More detail</a></h4>
                </div>
            </div>
        </div><!--portfolio item -->';
    endforeach;
    $output.='</div>';
    return $output;
}

function bizwarp_latest_news($atts) {
    extract(shortcode_atts(array(
        'limit' => '3', 'title' => '', 'category' => ''), $atts));
    $output = '';
    if ($title):
        $output = '<div class="row"><div class="col-md-12">
            <h3 class="heading-sec">' . $title . '</h3>
        </div></div>';
    endif;
    $output.='';
    $latest_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $limit, 'orderby' => 'menu_order', 'cat' => $category, 'order' => 'ASC'));
    if ($latest_posts->have_posts()) :
        while ($latest_posts->have_posts()) : $latest_posts->the_post();
            $postcats = get_the_category(get_the_ID());
            $totalcat = count($postcats);
            $post_cat_display = '';
            if ($postcats):
                $i = 1;
                foreach ($postcats as $postcat) {
                    if ($totalcat == $i) {
                        $post_cat_display.= '<a href="' . get_category_link($postcat->term_id) . '" class="hover-color">' . $postcat->name . '</a>';
                    } else {
                        $post_cat_display.= '<a href="' . get_category_link($postcat->term_id) . '" class="hover-color">' . $postcat->name . '</a> , ';
                    }
                    $i++;
                }
            endif;
            $output.='<div class="col-md-4 col-sm-6 margin-btm-20">
            <div class="news-sec">
                <div class="news-thumnail">
                    <a href="' . get_permalink() . '">
        ' . get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'img-responsive', 'alt' => '')) . '
                    </a>
                </div>
                <div class="news-desc">
                    <h3 class="blog-post-title"><a href="' . get_permalink() . '" class="hover-color">' . get_the_title() . '</a></h3>
                    <span class="news-post-cat">On ' . get_the_date() . ' | ' . $post_cat_display . '</span>
                        ' . get_the_excerpt() . '
                </div>
            </div>
        </div>';
        endwhile;
    endif;
    $output.='';
    return $output;
}

/* * ***********************************OUR TEAM******************************* */

function bizwarp_team_member($atts, $content = NULL) {
    extract(shortcode_atts(array(
        'name' => '', 'picture_path' => '', 'facebook' => '#', 'twitter' => '#', 'google' => '#', 'designation' => ''), $atts));
    $output = '<div class="person-section">
        <img src="' . $picture_path . '" class="img-responsive" alt="">
        <div class="person-desc">
            <h3>' . $name . '<span>' . $designation . '</span></h3>

            <p>' . $content . '</p>
            <ul class=" team list-inline social-btn">
                <li><a href="' . $facebook . '"><i class="ion-social-facebook" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like On Facebook"></i></a></li>
                <li><a href="' . $twitter . '"><i class="ion-social-twitter" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow On twitter"></i></a></li>
                <li><a href="' . $google . '"><i class="ion-social-googleplus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow On googleplus"></i></a></li>
            </ul>
        </div>
        </div>';
    return $output;
}

/* * *************************************progress-bar************************* */

function bizwarp_progress_bar($atts) {
    extract(shortcode_atts(array(
        'title' => '', 'value' => ''), $atts));
    $output = '<h3 class="heading-progress">' . $title . '<span class="pull-right">' . $value . '%</span></h3>
                    <div class="progress">
                        <div class="progress-bar" style="width: ' . $value . '%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="' . $value . '" role="progressbar">
                        </div>
                    </div>';
    return $output;
}

/* * ****************************heading-mini********************* */

function bizwarp_heading_mini($atts) {
    extract(shortcode_atts(array(
        'title' => ''), $atts));
    return '<h4 class="heading-mini">' . $title . '</h4>';
}

/* * ********************ONE HALF******************** */

function bizwarp_one_half($atts, $content = null) {

    return '<div class="col-md-6">' . do_shortcode($content) . '</div>';
}

/* * ********************ONE THIRD******************** */

function bizwarp_one_third($atts, $content = null) {

    return '<div class="col-md-4">' . do_shortcode($content) . '</div>';
}

/* * ********************ONE FOURTH******************** */

function bizwarp_one_fourth($atts, $content = null) {

    return '<div class="col-md-3">' . do_shortcode($content) . '</div>';
}

/* * *******************************LIST STYLE******************** */

function bizwarp_list($atts, $content = null) {

    return '<ul class="icon-list list-unstyled"> ' . do_shortcode($content) . '</ul>';
}

function bizwarp_list_items($atts, $content = null) {
    extract(shortcode_atts(array(
        'icon' => ''), $atts));

    return '<li><i class="' . $icon . '"></i> ' . $content . '</li>';
}

/* * *******************************PRICE TABLE********************** */

function bizwarp_price_table($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '', 'layout' => ''), $atts, 'pricing_table'));

    return '<div class="col-md-12">' . do_shortcode($content) . '</div>';
}

function bizwarp_price_table_item($atts, $content = NULL, $test) {
    extract(shortcode_atts(array(
        'title' => '', 'plan' => '', 'price' => '', 'time' => 'month', 'layout' => ''), $atts, 'priceing_table_item'));
    switch ($layout) {
        case '2':
            $content_class = 'col-md-6';
            break;
        case '4':
            $content_class = 'col-md-3';
            break;
        default:
            $content_class = 'col-md-4';
            break;
    }
    $output = '          
            <div class="' . $content_class . ' col-sm-6 margin-btm-20">
                <div class="pricing-wrapper">
                    <div class="pricing-head">
                        <h3>' . $plan . '</h3>
                    </div>
                    <div class="pricing-rate">
                        <h1> $' . $price . '<small>-' . $time . '</small></h1>
                    </div>
                    <div class="pricing-desc">
                        ' . do_shortcode($content) . '
                    </div>
                    <div class="pricing-select">
                        <a href="#" class="btn theme-btn-default btn-lg">Choose plan </a>
                    </div>
                </div><!--pricing wrapper-->
            </div><!--pricing col end-->
        ';
    return $output;
}

/* * *********************************SERVICES BOX************************** */

function bizwarp_service_box($atts, $content = NULL) {
    extract(shortcode_atts(array(
        'title' => '', 'icons' => ''), $atts));
    $output = '<div class = "col-md-3 services-icon">
        <i class = "' . $icons . '"></i>
        </div>
        <div class = "col-md-9 services-text"><h4 class = "heading-mini">' . $title . '</h4><p>' . $content . '</p></div>';
    return $output;
}

/* * *********************************GET SHORTCODE************************** */

function bizwarp_get_shortcode($atts, $content = NULL) {

    return $content;
}

/* * ********************************BUTTON************************* */

function bizwarp_botton($atts) {
    extract(shortcode_atts(array(
        'type' => '', 'size' => '', 'title' => 'Button'), $atts));

    return '<button class="btn ' . $type . ' ' . $size . '" type="button">' . $title . '</button>';
}

?>
