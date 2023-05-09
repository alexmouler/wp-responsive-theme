<article class="container-fluid">
  <?php if(has_post_thumbnail()):?>
    <figure>
      <img src="<?php the_post_thumbnail_url();?>"
        alt="<?php the_title();?>"
        class="img-fluid d-block mx-auto mb-3">
    </figure>
  <?php endif;?>
  <div id="content-div">
    <div class="row">
      <div class="col-xl-6">
        <?php 
          $fields = get_fields();
          if($fields):?>
            <ul class="car-stats">
              <?php foreach($fields as $name => $value):?>
                <?php if($value != ""):?>
                  <?php if($name == 'price'):?>
                    <li><b>Price:</b> $<?php echo $value; ?></li>
                  <?php else:?>
                    <?php $label = get_field_object($name)['label'];?>
                    <li><b><?php echo $label . ':'; ?></b> <?php echo $value; ?></li>
                  <?php endif;?>
                <?php endif;?>
              <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php the_content();?>
      </div>
      <div class="col-xl-6">
        <h4>Submit an inquiry about the <strong><?php the_title();?>:</strong></h4>
        <?php echo do_shortcode('[contact]'); ?>
      </div>
    </div>
  </div>
</article>