<?php
/*
  The comments page for Bones
 */

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Please do not load this page directly. Thanks!');

if (post_password_required()) {
    ?>

<div class="alert alert-info">
  <?php _e("This post is password protected. Enter the password to view comments.", "bizwrap"); ?>
</div>
<?php
    return;
}
?>
<?php if (have_comments()) : ?>
<div class="row">
  <div class="col-md-12">
    <div class="post-comment-wrapper clearfix">
      <?php if (!empty($comments_by_type['comment'])) : ?>
      <h3>
        <?php comments_number('<span>' . __("Comment(0)", "bizwrap") . '</span> ', '<span>' . __("Comment(1)", "bizwrap") . '</span> ', '<span>Comment(%)</span> '); ?>
      </h3>
      <?php wp_list_comments('type=comment&callback=wp_bootstrap_comments'); ?>
      <?php endif; ?>
      <?php
                previous_comments_link(__("<div class='col-md-6 text-left'><button class='btn btn-lg theme-btn-color'>Older comments</button></div>", "bizwrap"));
                next_comments_link(__("<div class='col-md-6 text-right'><button class='btn btn-lg theme-btn-color'>Newer comments</button></div>", "bizwrap"));
                ?>
    </div>
  </div>
  <!--comment wrapper-->
</div>
<?php endif; ?>
<?php
$new_defaults = array(
    'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => __('leave a comment', 'bizwrap'),
    'title_reply_to' => __('Leave a Reply to %s', 'bizwrap'),
    'cancel_reply_link' => __('Cancel Reply', 'bizwrap'),
    'label_submit' => __('Comment', 'bizwrap'),
    'comment_field' => '<div class="col-md-12"><textarea id="comment" class="form-control" placeholder="Comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
    'must_log_in' => '<p class="must-log-in">' .
    sprintf(
            __('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink()))
    ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
            __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))
    ) . '</p>',
    'comment_notes_before' => '<p class="comment-notes">' .
    __('Your email address will not be published.', 'bizwrap') . '</p>',
    'comment_notes_after' => '',
    'fields' => apply_filters('comment_form_default_fields', array(
        'author' =>
        '<div class="col-md-6">' .
        '<input id="author" placeholder="Name*" class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30" /></div>',
        'email' =>
        '<div class="col-md-6">' .
        '<input id="email" placeholder="Email*" class="form-control" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30" /></div>',
            )
    ),
);
?>
<?php if (comments_open()) : ?>
<div class="comment-form-wrapper">
  <div class="row">
    <div class="col-md-12">
      <?php comment_form($new_defaults); ?>
    </div>
  </div>
</div>
<!--comment form wrapper-->
<?php endif; ?>
</div>
