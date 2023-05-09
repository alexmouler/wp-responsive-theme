<!-- Blog Archive -->

<?php get_header('secondary');?>

<div class="page-title d-flex align-items-center justify-content-center">
  <h1>Blog Archive</h1>
</div>
<div class="main-content container-fluid">
  <div class="row">
    <?php if(is_active_sidebar('sidebar-2')):?>
      <div class="col-xl-3 mb-3 filter-widget">
        <?php dynamic_sidebar('sidebar-2');?>
      </div>
      <div class="col-xl-9">
    <?php else:?>
      <div>
    <?php endif;?>
    <?php if(have_posts()) {
      while(have_posts()) {
        the_post();
        get_template_part('template-parts/content', 'archive');
      }
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