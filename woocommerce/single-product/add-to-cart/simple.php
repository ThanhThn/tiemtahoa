<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()): ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart"
		action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
		method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="quantity_container">
			<?php
			do_action('woocommerce_before_add_to_cart_quantity');

			woocommerce_quantity_input(
				array(
					'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
					'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
					'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);

			do_action('woocommerce_after_add_to_cart_quantity');
			?>

			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
				class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><svg
					xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
					<path
						d="M2.92035 2.58089H12.8672C13.1667 2.58089 13.3884 2.88307 13.321 3.19958L12.4484 7.30029C12.2436 8.26275 11.4533 8.94453 10.5425 8.94453H5.83054C4.91971 8.94453 4.12943 8.26275 3.92462 7.30029L3.48835 5.25008M2.92035 2.58089L2.8337 2.1737C2.70828 1.58428 2.2243 1.16675 1.6665 1.16675M2.92035 2.58089L3.48835 5.25008M3.48835 5.25008H6.33317M6.85169 11.8612C6.85169 12.3981 6.41641 12.8334 5.87947 12.8334C5.34252 12.8334 4.90724 12.3981 4.90724 11.8612C4.90724 11.3242 5.34252 10.889 5.87947 10.889C6.41641 10.889 6.85169 11.3242 6.85169 11.8612ZM11.3887 11.8612C11.3887 12.3981 10.9534 12.8334 10.4165 12.8334C9.87956 12.8334 9.44428 12.3981 9.44428 11.8612C9.44428 11.3242 9.87956 10.889 10.4165 10.889C10.9534 10.889 11.3887 11.3242 11.3887 11.8612Z"
						stroke="#84BD00" stroke-linecap="round" />
				</svg><span>
					Thêm giỏ hàng
				</span>
				<?php //echo esc_html($product->single_add_to_cart_text()); ?>
			</button>

			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
			<!-- <button class="buy_now" type="button">
				Mua Ngay
			</button> -->
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>