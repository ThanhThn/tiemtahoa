<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/assets/css/single.css'; ?>">
<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php  //wc_product_class('', $product); ?> class="detail_product">

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action('woocommerce_before_single_product_summary');
	the_post_thumbnail();
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		//do_action('woocommerce_single_product_summary');
		woocommerce_template_single_title();
		woocommerce_template_single_price();
		woocommerce_template_single_add_to_cart();
			?>
	</div>
</div>
</div>

<div class="img_detail">
	<?php
	echo '<div class="activated">';
	the_post_thumbnail();
	echo "<div class=\"mask\"></div></div>";
	$product_id = get_the_ID();
	$gallery_images = get_post_meta($product_id, '_product_image_gallery', true);
	$gallery_images_array = explode(',', $gallery_images);
	foreach ($gallery_images_array as $image_id) {
		$image_url = wp_get_attachment_image_url($image_id, 'full');

		if ($image_url) {
			echo '<div><img src="' . esc_url($image_url) . '" alt="Product Image"><div class="mask"></div></div>';
		}
	}
	?>
</div>
<div class="description_container">
	<div class="description_heading">
		<h2>THÔNG TIN SẢN PHẨM</h2>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.8839 15.5303C12.3957 16.0185 11.6043 16.0185 11.1161 15.5303L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
				fill="#84BD00" stroke="#84BD00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
	</div>
	<hr>
	<?php
	// Đảm bảo rằng bạn đang ở trong một vùng loop WordPress hoặc có ID sản phẩm cụ thể để truy vấn
	global $product;

	// Lấy ID sản phẩm hiện tại
	$product_id = $product->get_id();

	// Lấy mô tả sản phẩm
	$product_description = get_post_field('post_content', $product_id);

	// Hiển thị mô tả sản phẩm
	echo "<div class=\"description\">$product_description</div>";
	?>
</div>
<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
woocommerce_output_related_products()
	//do_action('woocommerce_after_single_product_summary');
	?>

<?php do_action('woocommerce_after_single_product'); ?>