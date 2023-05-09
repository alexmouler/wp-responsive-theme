<?php get_header('secondary');?>

<header class="page-title theme-bg-light text-center gradient py-5">
  <h1 class="heading">Search Results for "<?php echo get_search_query();?>"</h1>
</header>

<div class="main-content container-fluid">
  <?php if(have_posts()):?>
    <?php while(have_posts()):?>
      <?php
        the_post();
        get_template_part('template-parts/content', 'archive');
      ?>
  <?php endwhile; else:?>
    <p class="text-center mb-5">
      There are no search results for "<?php echo get_search_query();?>".
    </p>
    <h4 class="text-center">Search for something else:</h4>
    <?php get_search_form();?>
  <?php endif;?>
  <div class="mx-auto">
    <?php the_posts_pagination([
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    ]);?>
  </div>
</div>

<?php get_footer();?>