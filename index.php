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






// with condition 
<!-- End miloox News Pagination  -->
<div class="mlx_products_menu_item">
	<div class="container-fluid">
		<div class="menu_box">
			<ul>
				<?php
				global $wpdb;
				$term_table = $wpdb->prefix . 'terms';
				$slug_final_val = $_GET['goto'] ?? '';
				$product_category = get_terms('product_category');
				if ($slug_final_val) {
					foreach ($product_category as $key => $single_slug) {
						$single_slug_name = $single_slug->slug . '-';
						$single_slug_nml_name = $single_slug->slug;
						$single_title_name = $single_slug->name;

						$class_name = '';
						if ($slug_final_val == $single_slug_nml_name) {
							$class_name = 'semi_bold_text';
						}
				?>
						<li class="with_selected_mitem <?php echo $class_name; ?>" data-filter=".<?php echo $single_slug_name; ?>"><?php echo $single_title_name; ?></li>
					<?php
					}
				} else {
					foreach ($product_category as $key => $single_slug) {
						$single_slug_name = $single_slug->slug . '-';
						$single_title_name = $single_slug->name;
					?>
						<li data-filter=".<?php echo $single_slug_name; ?>"><?php echo $single_title_name; ?></li>
				<?php
					}
				}

				?>
			</ul>
		</div>
	</div>
</div>

<div class="mlx_products_item">
	<div class="container-fluid">

		<?php
		if ($slug_final_val) {
		?>
			<style>
				.with_not_selected_val {
					display: none;
				}
			</style>
			<div class="row grid_items with_selected_val">
				<?php
				$products_query = new WP_Query([
					'post_type' => 'product',
					'posts_per_page' => -1,
					'orderby'        => 'rand',
					'tax_query' => array(
						array(
							'taxonomy' => 'product_category',
							'field'    => 'slug',
							'terms'    => $slug_final_val,
						),
					),
				]);
				while ($products_query->have_posts()) {
					$products_query->the_post();
					$terms_array = get_the_terms($post->ID, 'product_category');
					$term_slug = "";
					foreach ($terms_array as $single_term) {
						$term_slug .= $single_term->slug . '-';
					}



					$post_id = get_the_ID();
					$total_gallery_ids = get_post_meta($post_id, 'product_gallery', true);
					$get_gallery_id = [];
					for ($i = 0; $i < $total_gallery_ids; $i++) {

						$get_gallery_id[] = get_post_meta($post_id, 'product_gallery_' . $i . '_image_galary');
					}
					$get_galley_img_id = $get_gallery_id[0][0];
					$get_galley_img_url = wp_get_attachment_image_url($get_galley_img_id, 'full');



				?>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 item_mbtm  <?php echo $term_slug; ?>">
						<a href="<?php the_permalink(); ?>">
							<div class="hmlx_product_single_item reveal">
								<img src="<?php echo $get_galley_img_url; ?>" alt="">
								<div class="hmlx_product_single_item_overlay">
									<h2><?php the_title(); ?></h2>
								</div>
							</div>
						</a>
						<p style="height: 20px"></p>
					</div>


				<?php
				}
				wp_reset_query();
				?>
			</div>
		<?php
		}

		?>
		<div class="row grid_items with_not_selected_val">
			<?php
			$products_query = new WP_Query([
				'post_type' => 'product',
				'orderby'        => 'rand',
				'posts_per_page' => -1,
			]);
			while ($products_query->have_posts()) {
				$products_query->the_post();
				$terms_array = get_the_terms($post->ID, 'product_category');
				$term_slug = "";
				foreach ($terms_array as $single_term) {
					$term_slug .= $single_term->slug . '-';
				}



				$post_id = get_the_ID();
				$total_gallery_ids = get_post_meta($post_id, 'product_gallery', true);
				$get_gallery_id = [];
				for ($i = 0; $i < $total_gallery_ids; $i++) {

					$get_gallery_id[] = get_post_meta($post_id, 'product_gallery_' . $i . '_image_galary');
				}
				$get_galley_img_id = $get_gallery_id[0][0];
				$get_galley_img_url = wp_get_attachment_image_url($get_galley_img_id, 'full');

			?>
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3  item_mbtm <?php echo $term_slug; ?>">
					<a href="<?php the_permalink(); ?>">
						<div class="hmlx_product_single_item reveal">
							<img src="<?php echo $get_galley_img_url; ?>" alt="">
							<div class="hmlx_product_single_item_overlay">
								<h2><?php the_title(); ?></h2>
							</div>
						</div>
					</a>
					<p style="height: 20px"></p>
				</div>


			<?php
			}
			wp_reset_query();
			?>

		</div>
	</div>
</div>
<?php
get_footer();

