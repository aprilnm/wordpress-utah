<div id="sidebar1" class="col-sm-4">
    <?php if (is_active_sidebar('sidebar1')) : ?>
        <?php dynamic_sidebar('sidebar1'); ?>
    <?php else : ?>
        <?php _e('This content shows up if there are no widgets defined in the backend.', 'bizwrap') ?>  
    <?php endif; ?>
</div>
