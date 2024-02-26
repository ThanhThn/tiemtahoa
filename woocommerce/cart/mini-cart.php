<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php
global $woocommerce;
$cart_count = WC()->cart->get_cart_contents_count();
echo '<div class="total_cart"><h3>Giỏ hàng (' . $cart_count . ')</h3>';
echo '<span> ' . $woocommerce->cart->get_cart_total() . '</span></div>';
echo '<hr>';
if (!WC()->cart->is_empty()): ?>
	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php //echo esc_attr($args['list_class']);       ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
				?>
				<li
					class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
					<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'',
						sprintf(
							'<button class="remove remove_button" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
							<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M11.25 3.75L3.75 11.25" stroke="#C49A6C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3.75 3.75L11.25 11.25" stroke="#C49A6C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg></button>',
							/* translators: %s is the product name */
							esc_attr($product_id),
							esc_attr($cart_item_key),
							esc_attr($_product->get_sku())
						),
						$cart_item_key
					);
					?>
					<?php if (empty($product_permalink)): ?>
						<?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped                                   ?>
					<?php else: ?>
						<a href="<?php echo esc_url($product_permalink); ?>">
							<?php echo wp_kses_post(apply_filters('woocommerce_order_item_thumbnail', $_product->get_image(), $cart_item)); ?>
							<div class="infor_product">
								<span>
									<?php echo wp_kses_post($product_name); ?>
								</span>
								<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped                                   ?>
								<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped                                   ?>
							</div>
						</a>
					<?php endif; ?>
				</li>
				<?php
			}
		}
		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>

	<!-- <p class="woocommerce-mini-cart__total total">
		<strong>TỔNG :</strong>
		<span>
			<?php //global $woocommerce;                                  ?>
			<?php //echo $woocommerce->cart->get_cart_total();                                  ?>
		</span>
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		// do_action('woocommerce_widget_shopping_cart_total');
		?>
	</p> -->

	<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

	<p class="woocommerce-mini-cart__buttons buttons">
		<?php
		echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="button checkout wc-forward">' . esc_html__('Tiến hành thanh toán', 'woocommerce') . '</a>';
		//do_action('woocommerce_widget_shopping_cart_buttons');                                   ?>
	</p>

	<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

<?php else: ?>

	<p class="woocommerce-mini-cart__empty-message">
		<?php esc_html_e('No products in the cart.', 'woocommerce'); ?>
	</p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>