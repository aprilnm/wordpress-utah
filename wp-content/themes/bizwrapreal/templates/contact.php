<?php
/*
 * Template Name: Contact
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
<?php
$contacts = get_bw_theme_options('map');
$map_address = $contacts['contact_address'];
$map_active = $contacts['active_map'];
$map_zoom = $contacts['zoom'];
$map_scrollwheel = $contacts['scrollwheel'];
$map_draggable = $contacts['draggable'];
$geocode = wp_remote_get("http://maps.google.com/maps/api/geocode/json?address=" . urlencode($map_address) . "&sensor=false");
$output = json_decode($geocode['body']);
$lat = $output->results[0]->geometry->location->lat;
$lng = $output->results[0]->geometry->location->lng;
?>
<?php if ($map_active == '1'): ?>
    <div id="map-canvas"></div>
<?php endif; ?>
<div class="space-70"></div>
<div class="container">
    <div class="row">
        <?php
        if (have_posts()):
            while (have_posts()):the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php if ($map_active == '1'): ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
        var myLatlng;
        var map;
        var marker;
        var lat =<?php echo $lat; ?>;
        var lng =<?php echo $lng ?>;
        function initialize() {
            myLatlng = new google.maps.LatLng(lat, lng);

            var mapOptions = {
                zoom: <?php echo $map_zoom; ?>,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: <?php echo $map_scrollwheel; ?>,
                draggable: <?php echo $map_draggable; ?>
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: '<?php echo $map_address; ?>'
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<?php endif; ?>
<?php get_footer(); ?>
