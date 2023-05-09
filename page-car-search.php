<?php
  /*
  Template Name: Car Search
  */

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
  <h1>Search Results</h1>
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
  <?php if($is_search):?>
    <?php if($query->have_posts()):?>
      <?php while($query->have_posts()): $query->the_post();?>
      <?php get_template_part('template-parts/content', 'carsarchive');?>
      <?php endwhile;?>
      <!-- Copied from WP Docs -->
      <div class="mx-auto">
        <nav class="navigation pagination">
          <h2 class="screen-reader-text">Cars navigation</h2>
          <div class="nav-links">
            <?php
              echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
                'add_args'     => false,
                'add_fragment' => '',
              ) );
            ?>
          </div>
        </nav>
      </div>

      <?php wp_reset_postdata();?>
    <?php else:?>
      <p>No results.</p>
    <?php endif;?>
  <?php endif;?>
</div>

<?php get_footer();?>