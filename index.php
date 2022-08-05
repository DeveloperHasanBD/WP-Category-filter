<?php
    $dvc_portfolio_cats = get_terms('dvc_portfolio_cat');
    foreach ($dvc_portfolio_cats as $key => $single_slug) {
        $single_slug_name = $single_slug->slug;
        $single_title_name = $single_slug->name;
    ?>
        <li class="scroll_up" data-filter=".<?php echo $single_slug_name; ?>"><?php echo $single_title_name; ?></li>
    <?php
    }
    ?>
</ul>

<?php
  $portfolio_query = new WP_Query([
      'post_type' => 'dvc-portfolio',
      'posts_per_page' => -1,
  ]);
  $i = 1;
  while ($portfolio_query->have_posts()) {
      $portfolio_query->the_post();
      $terms_array = get_the_terms($post->ID, 'dvc_portfolio_cat');
      $term_slug = "";
      foreach ($terms_array as $single_term) {
          $term_slug .= $single_term->slug . ' ';
      }
      $shm_portfolio_url = get_field('shm_portfolio_url');
  ?>
      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 item <?php echo $term_slug; ?>">
      
      </div>
  <?php
  }
  wp_reset_query();
}
