<article class="container-fluid">
  <header class="content-header">
    <div class="meta small mb-3 d-flex flex-wrap align-items-center gap-1 column-gap-4">
      <?php
        $name = get_the_author_meta('display_name');
        if ($name != ""):
      ?>
        <span class="author">
          Posted by <a href="<?php echo get_the_author_meta('user_url');?>">
            <?php echo $name;?>
          </a>
        </span>
      <?php endif;?>
      <span class="date"><?php the_date();?></span>
      <?php if(get_the_tags()):?>
        <div id="tag-div" class="d-flex flex-wrap gap-1 column-gap-2">
          <!-- Tags: params are what comes before the first tag, what goes in between each tag, and what goes after the last tag -->
          <?php the_tags('<span class="tag"><i class="fa fa-tag"></i> ', '</span> <span class="tag"><i class="fa fa-tag"></i> ', '</span>');?>
        </div>
      <?php endif;?>
      <?php if(get_the_category()):?>
        <div id="category-div">
          <!-- Categories: params are what goes after each category, how to display parents (multiple, single, ''), and the post id to show categories for (defaults to current post aka false) -->
          <span class="tag">
            <i class="fa fa-tag"></i>
            <?php the_category('</span><span class="tag"><i class="fa fa-tag"></i> ', 'multiple', false);?>
          </span>
        </div>
      <?php endif;?>
      <!-- Number of comments -->
      <span class="comment-num">
        <i class="fa fa-comment"></i>
        <a href="#comments-wrapper">
          <?php comments_number();?>
        </a>
      </span>
    </div>
  </header>
  <?php if(has_post_thumbnail()):?>
    <figure>
      <img src="<?php the_post_thumbnail_url();?>"
        alt="<?php the_title();?>"
        class="img-fluid d-block mx-auto mb-3">
      <figcaption class="mb-1 text-center small">
        <a href="<?php the_post_thumbnail_url();?>" id="image-credit">Image Credit</a>
      </figcaption>
    </figure>
  <?php endif;?>
  <div id="content-div">
    <?php the_content();?>
  </div>
  <!-- Comments template in comments.php -->
  <?php if(comments_open()) {
    comments_template();
  }?>
</article>