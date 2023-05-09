<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head();?>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand h3" id="site-title" href="<?php echo get_site_url();?>">
            <?php echo get_bloginfo('name');?>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
              if(function_exists('the_custom_logo')) {
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id);
              }
            ?>
            <img class="mb-3 mx-auto logo" src="<?php echo $logo[0];?>" alt="logo" >
            <?php
              wp_nav_menu([
                'menu' => 'primary',
                'container' => '',
                'theme_location' => 'primary',
                'items_wrap' => '<ul id="nav-links" class="my-2 mb-lg-0">%3$s</ul>'
              ]);
            ?>
            <?php
              dynamic_sidebar('sidebar-1');
            ?>
          </div>
        </div>
      </nav>
      <?php if(is_admin_bar_showing()):?>
        <style>
          #navbar {
            top: 32px;
          }

          .page-title {
            top: 32px;
          }

          @media (max-width: 992px) {
            .page-title {
              top: 90px;
            }
          }

          @media (max-width: 768px) {
            #navbar {
              top: 46px;
            }

            .page-title {
              top: 104px;
            }
          }
        </style>
      <?php endif;?>
    </header>
    <div class="main-wrapper">
      <div class="page-title d-flex align-items-center justify-content-center">
        <h1 id="title"><?php the_title();?></h1>
      </div>