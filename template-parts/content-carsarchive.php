<div class="archive-post mb-5">
  <div class="d-flex">
    <?php if(has_post_thumbnail()):?>
      <div class="flex-shrink-0 me-md-4">
        <?php $thumbnail_id = get_post_thumbnail_id( $post->ID );
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if ($alt != ""):?>
          <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php the_post_thumbnail_url('thumbnail');?>" alt="<?php echo $alt;?>">
        <?php else:?>
          <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php the_post_thumbnail_url('thumbnail');?>" alt="<?php echo get_the_title();?>">
        <?php endif;?>
        </div>
    <?php endif;?>
    <div class="flex-grow-1">
      <div class="archive-post-body">
        <h3 class="title mb-1">
          <a href="<?php the_permalink();?>">
            <?php the_title();?>
          </a>
        </h3>
        <div class="excerpt">
          <?php the_excerpt();?>
        </div>
        <a href="<?php the_permalink();?>" class="btn btn-outline-primary">
          Read more &rarr;
        </a>
      </div>
    </div>
  </div>
</div>