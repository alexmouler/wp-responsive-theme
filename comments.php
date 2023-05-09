<hr>
<div class="comments-wrapper" id="comments-wrapper">
  <div class="comments">
    <div class="comments-header">
      <h4 class="comment-reply-title">
        <?php
          if(!have_comments() || get_comments_number() == 0) {
            echo "No comments yet";
          }
          else if (get_comments_number() == 1) {
            echo "1 Comment on \"" . get_the_title() . "\"";
          }
          else {
            echo get_comments_number() . " Comments on \"" . get_the_title() . "\"";
          }
        ?>
      </h4>
    </div>

    <div class="comments-inner">
      <?php
        wp_list_comments([
          'avatar_size' => 60,
          'style' => 'div',
          'max_depth' => 3
        ]);
      ?>
    </div>
  </div>

  <?php
    if(comments_open()) {
      $commenter = wp_get_current_commenter();
      $req = get_option( 'require_name_email' );
      $aria_req = ( $req ? " aria-required='true'" : '' );
      comment_form([
        'fields' => [
          'author' => '<div class="form-floating mb-3"><input id="author" class="form-control" name="author" type="text" placeholder="John Doe" size="30" ' . $aria_req . ' value="' . esc_attr($commenter['comment_author']) . '" /><label for="author" class="form-label">Name' . ( $req ? '<span class="required">*</span>' : '') . '</label></div>',
          'email' => '<div class="form-floating mb-3"><input id="email" class="form-control" name="email" type="email" placeholder="name@example.com" size="30" ' . $aria_req  . ' value="' . esc_attr($commenter['comment_author_email']) . '" /><label for="email" class="form-label">Email' . ( $req ? '<span class="required">*</span>' : '') . '</label></div>',
          'url' => '<div class="form-floating mb-3"><input id="url" class="form-control" name="url" type="text" placeholder="example.com" size="30" value="' . esc_attr($commenter['comment_author_url']) . '" /><label for="url" class="form-label">Website</label></div>',
          'cookies' => '<label class="mb-3"><input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for accepting cookies"> Save my name, email, and website in this browser for the next time I comment.</label>'
        ],
        'comment_field' => '<div class="form-floating mb-3"><textarea id="comment" class="form-control" name="comment" placeholder="Leave a comment" aria-required></textarea><label for="comment">Comment*</label></div>',
        'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h4>',
        'submit_button' => '<input name="submit" type="submit" id="submit" class="btn btn-outline-primary" value="Post Comment">'
      ]);
    }
  ?>
</div>