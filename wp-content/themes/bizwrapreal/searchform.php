<div class="widget-search">
    <form action="<?php echo home_url('/'); ?>" method="get" class="search-form">
        <input type="text" name="s" id="search" placeholder="<?php _e("Search", "bizwrap"); ?>" value="<?php the_search_query(); ?>" class="form-control">
        <i data-original-title="hit enter to search" title="" data-placement="top" data-toggle="tooltip" class="ion-search"></i>
    </form>
</div>



