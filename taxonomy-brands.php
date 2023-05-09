<!-- Taxonomy Car Brands Archive -->
<?php get_header('secondary');?>

<div class="page-title d-flex align-items-center justify-content-center">
  <h1>
    <?php
      echo single_cat_title('', false) . 's';
    ?>
  </h1>
</div>
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-xl-2 mb-3 filter-widget">
      <?php
        wp_nav_menu([
          'menu' => 'cars',
          'container' => '',
          'theme_location' => 'cars',
          'items_wrap' => '<h4 class="wp-block-heading">Brands</h4><ul class="wp-block-archives-list wp-block-archives">%3$s</ul>'
        ]);
      ?>
    </div>
    <div class="col-xl-10">
      <?php if(have_posts()) {
        while(have_posts()) {
          the_post();
          get_template_part('template-parts/content', 'carsarchive');
        }
      } else {
        echo "There are no " . single_cat_title('', false) . "s available.";
      }
      ?>
    </div>
  </div>
  <div class="mx-auto">
    <?php the_posts_pagination([
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    ]);?>
  </div>
</div>

<?php get_footer();?>