<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TTHHCN
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	if (have_posts()):

		if (is_home() && !is_front_page()):
			?>
			<header>
				<h1 class="page-title screen-reader-text">
					<?php single_post_title(); ?>
				</h1>
			</header>
			<?php
		endif;

		$categories = get_categories();
		foreach ($categories as $category) { ?>
			<div class="category_container">
				<div class="category_header">
					<span>
						<?php echo $category->name ?>
					</span>
					<a href="<?php echo esc_url(get_category_link($category->term_id)) ?>">Tất cả
						<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M0.729776 9.35283C0.559562 9.35313 0.394605 9.29888 0.26354 9.19949C0.189774 9.14353 0.128797 9.07479 0.0841029 8.99723C0.0394083 8.91966 0.0118739 8.83479 0.00307674 8.74747C-0.00572046 8.66016 0.00439251 8.57211 0.0328362 8.48837C0.0612798 8.40464 0.107495 8.32686 0.168835 8.25949L3.43249 4.68616L0.285395 1.10616C0.224882 1.03797 0.179692 0.959503 0.152423 0.875276C0.125155 0.79105 0.116344 0.702722 0.126499 0.61537C0.136654 0.528018 0.165573 0.443363 0.211594 0.366272C0.257616 0.289181 0.319833 0.221173 0.394669 0.166158C0.470043 0.105467 0.558312 0.0596889 0.653936 0.0316962C0.749559 0.00370351 0.850474 -0.00589896 0.950345 0.00349097C1.05022 0.0128809 1.14689 0.0410607 1.2343 0.086262C1.3217 0.131463 1.39796 0.19271 1.45827 0.266158L4.9769 4.26616C5.08404 4.38545 5.14262 4.53508 5.14262 4.68949C5.14262 4.84391 5.08404 4.99354 4.9769 5.11283L1.33443 9.11283C1.26135 9.1935 1.16851 9.25728 1.06345 9.29898C0.958399 9.34068 0.844081 9.35913 0.729776 9.35283Z"
								fill="#057F62" />
						</svg>
					</a>
				</div>
				<div class="posts">
					<?php
					$args = [
						'category_name' => $category->slug,
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

					the_posts_navigation();
					?>
				</div>
			</div>
		<?php }
	else:

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
