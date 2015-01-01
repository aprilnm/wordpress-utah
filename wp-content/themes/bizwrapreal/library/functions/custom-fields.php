<?php
global $new_meta_boxes;
$new_meta_boxes =
        array(
// Pages	
            "_bw_page_sidebar" => array(
                "name" => "_bw_page_sidebar",
                "std" => "",
                "title" => "Choose a sidebar",
                "description" => "choose between existing sidebars.",
                "type" => "sidebar",
                "blocksize" => "one_half",
                "location" => "Page"
            )            
);

function new_meta_boxes_page() {
    new_meta_boxes('Page');
}
function new_meta_boxes($type) {
    global $post, $new_meta_boxes;

// Use nonce for verification
    echo '<input type="hidden" name="bizwrap_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<div class="form-wrap">';

    foreach ($new_meta_boxes as $meta_box) {
        if ($meta_box['location'] == $type) {

            if ($meta_box['type'] == 'title') {
                echo '<p style="font-size: 18px; font-weight: bold; font-style: normal; color: #e5e5e5; text-shadow: 0 1px 0 #111; line-height: 40px; background-color: #464646; border: 1px solid #111; padding: 0 10px; -moz-border-radius: 6px;">' . $meta_box['title'] . '</p>';
            } else {
                $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);

                if (isset($meta_box_value) && $meta_box_value == "")
                    if (isset($meta_box['std']))
                        $meta_box_value = $meta_box['std'];
                if (!isset($meta_box['blocksize']))
                    echo '<div class="clear"></div>';
                ?>
                <div class="form-field form-required <?php echo isset($meta_box['blocksize']) ? $meta_box['blocksize'] : '' ?>">
                    <?php
                    switch ($meta_box['type']) {
                        case 'text':
                            echo '<label for="' . $meta_box['name'] . '"><strong>' . $meta_box['title'] . '</strong></label>';
                            echo '<input type="text" name="' . $meta_box['name'] . '" value="' . htmlspecialchars($meta_box_value) . '" />';
                            if (isset($meta_box['description']))
                                echo '<p>' . $meta_box['description'] . '</p>';
                            break;

                        case 'sidebar':

                            global $post;
                            $post_id = $post;
                            if (is_object($post_id)) {
                                $post_id = $post->ID;
                            }
                            $selected_sidebar = get_post_meta($post_id, '_bw_page_sidebar', true);
                            
                            ?>

                            <label for="<?php echo $meta_box['name'] ?>"><strong><?php echo $meta_box['title'] ?></strong></label>
                            <ul>
                                <?php
                                global $wp_registered_sidebars;
                                ?>
                                <li>
                                    <select name="_bw_page_sidebar">
                                        <option value="0">WP Default Sidebar</option>
                                                <?php
                                                $sidebars = $wp_registered_sidebars; // sidebar_generator::get_sidebars();
                                                if (is_array($sidebars) && !empty($sidebars)) {
                                                    foreach ($sidebars as $sidebar) {
                                                        if ($selected_sidebar == $sidebar['id']) {
                                                            echo "<option value='{$sidebar['id']}' selected>{$sidebar['name']}</option>\n";
                                                        } else {
                                                            echo "<option value='{$sidebar['id']}'>{$sidebar['name']}</option>\n";
                                                        }
                                                    }
                                                    ?>

                                        </select>
                                    </li>
                                <?php }
                                ?>
                            </ul>

                            <?php if (isset($meta_box['description'])) echo '<p class="top15">' . $meta_box['description'] . '</p>'; ?>
                            <?php
                            break;
                    }


                    echo '</div>';
                }
            }
        }

        echo '</div>';
    }

    function create_meta_box() {
        global $theme_name;
        if (function_exists('add_meta_box')) {
            add_meta_box('new_meta_boxes_page', 'Bizwrap' . ' Page Settings', 'new_meta_boxes_page', 'page', 'normal', 'high');
        }
    }

    function save_postdata($post_id) {

        if (!wp_verify_nonce(isset($_POST['bizwrap_meta_box_nonce']) ? $_POST['bizwrap_meta_box_nonce'] : '', basename(__FILE__))) {

            return $post_id;
        }

        if (wp_is_post_revision($post_id) or wp_is_post_autosave($post_id))
            return $post_id;

        global $post, $new_meta_boxes;

        foreach ($new_meta_boxes as $meta_box) {

            if ($meta_box['type'] != 'title)') {

                if ('page' == $_POST['post_type']) {
                    if (!current_user_can('edit_page', $post_id))
                        return $post_id;
                } else {
                    if (!current_user_can('edit_post', $post_id))
                        return $post_id;
                }

                if (isset($_POST[$meta_box['name']]) && is_array($_POST[$meta_box['name']])) {
                    $cats = '';
                    foreach ($_POST[$meta_box['name']] as $cat) {
                        $cats .= $cat . ",";
                    }
                    $data = substr($cats, 0, -1);
                } else {
                    $data = '';
                    if (isset($_POST[$meta_box['name']]))
                        $data = $_POST[$meta_box['name']];
                }

                if (get_post_meta($post_id, $meta_box['name']) == "")
                    add_post_meta($post_id, $meta_box['name'], $data, true);
                elseif ($data != get_post_meta($post_id, $meta_box['name'], true))
                    update_post_meta($post_id, $meta_box['name'], $data);
                elseif ($data == "")
                    delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
            }
        }
    }

    add_action('admin_menu', 'create_meta_box');
    add_action('save_post', 'save_postdata');
    ?>