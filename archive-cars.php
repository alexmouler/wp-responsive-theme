<!-- Custom Post Type Cars Archive & Search -->
<?php
  $is_search = count($_GET); //Number of search parameters

  $brands = get_terms([
    'taxonomy' => 'brands',
    'hide_empty' => false, 
  ]);

  if($is_search) {
    $query = search_query();
  }
?>

<?php get_header('secondary');?>

<div class="page-title d-flex align-items-center justify-content-center">
  <h1>Cars</h1>
</div>
<div class="main-content container-fluid">
  <form class="mb-4" action="<?php echo home_url('/car-search');?>">
    <div class="form-group mb-3">
      <label class="mb-1">Search Cars</label>
      <input
        type="text"
        name="keyword"
        placeholder="Search"
        class="form-control"
        value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '';?>"
        >
    </div>
    <div class="form-group mb-3">
      <label class="mb-1">Brand</label>
      <select name="brand" class="form-select">
        <option value="">Choose a brand</option>
        <?php foreach($brands as $brand):?>
          <option 
            <?php if(isset($_GET['brand']) && $_GET['brand'] == $brand->slug):?>
              selected
            <?php endif;?>
            value="<?php echo $brand->slug;?>">
            <?php echo $brand->name;?>
          </option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="form-group row mb-3">
      <div class="col-lg-6">
        <label>From:</label>
        <select name="price_above" class="form-select">
          <?php for($i=0; $i<=100000; $i+= 10000):?>
            <option
              <?php if(isset($_GET['price_above']) && $_GET['price_above'] == $i):?>
                selected
              <?php endif;?>
              value="<?php echo $i;?>">
              <?php echo '$' . number_format($i);?>
            </option>
          <?php endfor;?>
        </select>
      </div>
      <div class="col-lg-6">
      <label>To:</label>
        <select name="price_below" class="form-select">
          <?php for($i=0; $i<=100000; $i+= 10000):?>
            <option
              <?php if(isset($_GET['price_below']) && $_GET['price_below'] == $i):?>
                selected
              <?php elseif(!isset($_GET['price_below']) && $i == 100000):?>
                selected
              <?php endif;?>
              value="<?php echo $i;?>">
              <?php echo '$' . number_format($i);?>
            </option>
          <?php endfor;?>
        </select>
      </div>
    </div>
    <div class="d-flex gap-3">
      <button
        type="submit"
        class="btn btn-primary btn-large w-100 mb-2">Search</button>
      <a href="<?php echo home_url('/cars');?>" class="btn btn-outline-primary reset-btn">
        Reset Search
      </a>
    </div>
  </form>
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