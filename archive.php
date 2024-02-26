<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TTHHCN
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	$categories = get_queried_object(); ?>
	<div class="category_container">
		<div class="post_header category_header">
			<span>
				BÀI VIẾT NỔI BẬT
			</span>
		</div>
		<div class="posts">
			<?php
			$args = [
				'category_name' => $categories->slug,
				'posts_per_page' => 5,
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
			];
			$query = new WP_Query($args);
			/* Start the Loop */
			while ($query->have_posts()):
				$query->the_post();
				if ($query->current_post == 0) {
					get_template_part('template-parts/content_card/content', 'top', get_post_type());
				} else {
					get_template_part('template-parts/content_card/content', 'popular', get_post_type());
				}
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php  (where ___ is the Post Type name) and that will be used instead.
				 */
			endwhile;
			wp_reset_postdata();
			// the_posts_navigation();
			?>
		</div>

		<div class="post_container">
			<div class="post">
				<!-- All post -->
				<div class="post_header category_header">
					<span>
						BÀI VIẾT
					</span>
				</div>
				<hr>
				<div class="posts">
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = [
						'category_name' => $categories->slug,
						'posts_per_page' => 4,
						'paged' => $paged
					];
					$query = new WP_Query($args);
					while ($query->have_posts()):
						$query->the_post();
						get_template_part('template-parts/content_card/content', get_post_type());
						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php  (where ___ is the Post Type name) and that will be used instead.
						 */
					endwhile;
					wp_reset_postdata(); ?>
				</div>
				<?php $total_pages = $query->max_num_pages;
				if ($total_pages > 1) {
					$current_page = max(1, get_query_var('paged'));
					paginate($current_page, $query);
				} ?>
			</div>
			<!-- Posts New -->
			<div class="post_new">
				<div class="post_header category_header">
					<span>
						BÀI VIẾT MỚI
					</span>
				</div>
				<hr>
				<div class="posts_new">
					<?php
					$args = [
						'category_name' => $categories->slug,
						'posts_per_page' => 6,
						'order' => 'DESC'
					];
					$query = new WP_Query($args);
					while ($query->have_posts()):
						$query->the_post();
						get_template_part('template-parts/content_card/content', 'new', get_post_type());
						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php  (where ___ is the Post Type name) and that will be used instead.
						 */
					endwhile;
					wp_reset_postdata(); ?>
				</div>

			</div>
		</div>
	</div>
	<?php
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
