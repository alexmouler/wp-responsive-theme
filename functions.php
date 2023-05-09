<?php
  function my_styles() {
    wp_enqueue_style('my-css', get_template_directory_uri() . '/style.css', ['my-bs'], '1.0', 'all');
    wp_enqueue_style('my-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], '5.3.0', 'all');
    wp_enqueue_style('my-fa', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');
  }
  add_action('wp_enqueue_scripts', 'my_styles');

  function my_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('my-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', [], '5.3.0', true);
    wp_enqueue_script('my-js', get_template_directory_uri() . '/main.js', array(), '1.0', true);
  }
  add_action('wp_enqueue_scripts', 'my_scripts');

  function my_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
  }
  add_action('after_setup_theme', 'my_theme_support');

  function my_menus() {
    $locations = [
      'primary' => 'Left Sidebar',
      'cars' => 'Car Brand Filters'
    ];
    register_nav_menus($locations);
  }
  add_action('init', 'my_menus');

  function my_widgets() {
    register_sidebar([
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '<ul class="social-list list-inline py-3 mx-auto">',
      'after_widget' => '</ul>',
      'name' => 'Sidebar Area',
      'id' => 'sidebar-1',
      'description' => 'Sidebar Widget Area'
    ]);

    register_sidebar([
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Archive Links Area',
      'id' => 'sidebar-2',
      'description' => 'Archive Filtering Links Widget Area'
    ]);

    register_sidebar([
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Email Subscription Area',
      'id' => 'sidebar-3',
      'description' => 'Email Subscription Widget Area'
    ]);

    register_sidebar([
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Footer Area',
      'id' => 'sidebar-4',
      'description' => 'Footer Links Area'
    ]);
  }
  add_action('widgets_init', 'my_widgets');

  function my_post_type() {
    $args = [
      'labels' => [
        'name' => 'Cars',
        'singular_name' => 'Car'
      ],
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-car',
      'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
    ];
    register_post_type('cars', $args);
  }
  add_action('init', 'my_post_type');

  function my_car_taxonomy() {
    $args = [
      'labels' => [
        'name' => 'Brands',
        'singular_name' => 'Brand'
      ],
      'public' => true,
      'hierarchical' => true,
    ];
    register_taxonomy('brands', ['cars'], $args);
  }
  add_action('init', 'my_car_taxonomy');

  //Custom search
  function search_query() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = [
      'paged' => $paged,
      'post_type' => 'cars',
      'tax_query' => [],
      'meta_query' => [
        'relation' => 'AND',
      ],
    ];

    if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
      $args['s'] = sanitize_text_field($_GET['keyword']); //s for search
    }

    if(isset($_GET['brand']) && !empty($_GET['brand'])) {
      $args['tax_query'][] = [
        'taxonomy' => 'brands',
        'field' => 'slug',
        'terms' => [sanitize_text_field($_GET['brand'])],
      ];
    }

    if(isset($_GET['price_above']) && !empty($_GET['price_above'])) {
      $args['meta_query'][] = [
        'key' => 'price',
        'value' => sanitize_text_field($_GET['price_above']),
        'type' => 'numeric',
        'compare' => '>='
      ];
    }

    if(isset($_GET['price_below']) && !empty($_GET['price_below'])) {
      $args['meta_query'][] = [
        'key' => 'price',
        'value' => sanitize_text_field($_GET['price_below']),
        'type' => 'numeric',
        'compare' => '<='
      ];
    }

    return new WP_Query($args);
  }
?>