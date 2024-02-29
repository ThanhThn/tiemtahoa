<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
	action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<?php if ($checkout->get_checkout_fields()): ?>

		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

		<div class="col2-set" id="customer_details">
			<div class="">
				<?php do_action('woocommerce_checkout_billing'); ?>
			</div>
			<div class="woocommerce-additional-fields form-row">
				<?php do_action('woocommerce_before_order_notes', $checkout); ?>

				<?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))): ?>

					<?php if (!WC()->cart->needs_shipping() || wc_ship_to_billing_address_only()): ?>

						<h3>
							<?php esc_html_e('Additional information', 'woocommerce'); ?>
						</h3>

					<?php endif; ?>

					<div class="woocommerce-additional-fields__field-wrapper">
						<?php foreach ($checkout->get_checkout_fields('order') as $key => $field): ?>
							<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
						<?php endforeach; ?>
					</div>

				<?php endif; ?>

				<?php do_action('woocommerce_after_order_notes', $checkout); ?>
			</div>
			<?php woocommerce_checkout_payment(); ?>
		</div>
		<div id="product_details">
			<h3 id="order_review_heading">
				<?php esc_html_e('Your order', 'woocommerce'); ?>
			</h3>
			<?php do_action('woocommerce_checkout_before_order_review'); ?>
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php
				remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
				do_action('woocommerce_checkout_order_review'); ?>
			</div>
			<?php woocommerce_checkout_coupon_form() ?>
			<table class="total_fee">
				<tr class="cart-subtotal">
					<th>
						<?php esc_html_e('Subtotal', 'woocommerce'); ?>
					</th>
					<td>
						<?php wc_cart_totals_subtotal_html(); ?>
					</td>
				</tr>

				<?php foreach (WC()->cart->get_coupons() as $code => $coupon): ?>
					<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
						<th>
							<?php wc_cart_totals_coupon_label($coupon); ?>
						</th>
						<td>
							<?php wc_cart_totals_coupon_html($coupon); ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>

					<?php do_action('woocommerce_review_order_before_shipping'); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action('woocommerce_review_order_after_shipping'); ?>

				<?php endif; ?>

				<?php foreach (WC()->cart->get_fees() as $fee): ?>
					<tr class="fee">
						<th>
							<?php echo esc_html($fee->name); ?>
						</th>
						<td>
							<?php wc_cart_totals_fee_html($fee); ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
					<?php if ('itemized' === get_option('woocommerce_tax_total_display')): ?>
						<?php foreach (WC()->cart->get_tax_totals() as $code => $tax): // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited                                           ?>
							<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
								<th>
									<?php echo esc_html($tax->label); ?>
								</th>
								<td>
									<?php echo wp_kses_post($tax->formatted_amount); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr class="tax-total">
							<th>
								<?php echo esc_html(WC()->countries->tax_or_vat()); ?>
							</th>
							<td>
								<?php wc_cart_totals_taxes_total_html(); ?>
							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>

				<?php do_action('woocommerce_review_order_before_order_total'); ?>

				<tr class="order-total">
					<th>
						<?php esc_html_e('Total', 'woocommerce'); ?>
					</th>
					<td>
						<?php wc_cart_totals_order_total_html(); ?>
					</td>
				</tr>

				<?php do_action('woocommerce_review_order_after_order_total'); ?>
			</table>
		</div>
		<?php do_action('woocommerce_checkout_after_customer_details'); ?>
	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>