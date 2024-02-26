<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TTHHCN
 */

get_header();
woocommerce_output_content_wrapper();
global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type' => 'product',
	'numberposts' => 1,
	'posts_per_page' => 1,
	'paged' => $paged,
);

// query_posts(array_merge($args, $wp_query->query));
?>

<main id="primary" class="site-main">

	<?php if (have_posts()): ?>

		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf(esc_html__('Search Results for: %s', 'tthhcn'), '<span>' . get_search_query() . '</span>');
			?>
		</h1>
		<div class="woocommerce">
			<?php
			/* Start the Loop */
			woocommerce_product_loop_start(); ?>
			<?php while (have_posts()):
				the_post();
				do_action('woocommerce_shop_loop');
				wc_get_template_part('content', 'product');
			endwhile;
			woocommerce_product_loop_end();
			echo '</div>';
			$total_pages = $wp_query->max_num_pages;
			if ($total_pages > 1) {
				$current_page = max(1, get_query_var('paged')); ?>
				<?php paginate(); ?>
				<?php
			}
			?>
			<?php wp_reset_postdata();
	// the_posts_navigation();

else:

	get_template_part('template-parts/content', 'none');

endif;
?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
