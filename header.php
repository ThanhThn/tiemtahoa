<?php
if (class_exists('WooCommerce')) {
	$cart_count = WC()->cart->get_cart_contents_count();
} ?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TTHHCN
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
		integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
		integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
</head>

<body>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary">
			<?php esc_html_e('Skip to content', 'tthhcn'); ?>
		</a>

		<header id="masthead" class="site-header">
			<div class="heading">
				<div class="logo">
					<img src="<?php echo get_template_directory_uri() . '/assets/img/logo.svg'; ?>" alt="logo">
				</div>
				<div class="site-branding">
					<?php
					the_custom_logo();
					if (is_front_page() && is_home()):
						?>
						<!-- <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a></h1> -->
						<?php
					else:
						?>
						<!-- <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a></p> -->
						<?php
					endif;
					$tthhcn_description = get_bloginfo('description', 'display');
					if ($tthhcn_description || is_customize_preview()):
						?>
						<!-- <p class="site-description">
							<?php echo $tthhcn_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    ?>
						</p> -->
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<?php esc_html_e('Primary Menu', 'tthhcn'); ?>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id' => 'primary-menu',
						)
					);
					?>
					<i id="iconSearch">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
							<path
								d="M17.7043 16.2848L14.3054 12.8958C15.402 11.4988 15.9971 9.77351 15.9948 7.99743C15.9948 6.41569 15.5258 4.86947 14.647 3.5543C13.7683 2.23913 12.5192 1.21408 11.0579 0.608771C9.59657 0.00346513 7.98855 -0.15491 6.43721 0.153672C4.88586 0.462254 3.46085 1.22393 2.34239 2.34239C1.22393 3.46085 0.462254 4.88586 0.153672 6.43721C-0.15491 7.98855 0.00346513 9.59657 0.608771 11.0579C1.21408 12.5192 2.23913 13.7683 3.5543 14.647C4.86947 15.5258 6.41569 15.9948 7.99743 15.9948C9.77351 15.9971 11.4988 15.402 12.8958 14.3054L16.2848 17.7043C16.3777 17.798 16.4883 17.8724 16.6101 17.9231C16.7319 17.9739 16.8626 18 16.9945 18C17.1265 18 17.2572 17.9739 17.379 17.9231C17.5008 17.8724 17.6114 17.798 17.7043 17.7043C17.798 17.6114 17.8724 17.5008 17.9231 17.379C17.9739 17.2572 18 17.1265 18 16.9945C18 16.8626 17.9739 16.7319 17.9231 16.6101C17.8724 16.4883 17.798 16.3777 17.7043 16.2848ZM1.99936 7.99743C1.99936 6.81112 2.35114 5.65146 3.01022 4.66508C3.66929 3.6787 4.60606 2.90991 5.70207 2.45593C6.79807 2.00196 8.00408 1.88317 9.16759 2.11461C10.3311 2.34605 11.3999 2.91731 12.2387 3.75615C13.0775 4.595 13.6488 5.66375 13.8802 6.82726C14.1117 7.99077 13.9929 9.19678 13.5389 10.2928C13.0849 11.3888 12.3162 12.3256 11.3298 12.9846C10.3434 13.6437 9.18373 13.9955 7.99743 13.9955C6.40664 13.9955 4.88101 13.3636 3.75615 12.2387C2.6313 11.1138 1.99936 9.58821 1.99936 7.99743Z"
								fill="#D9D9D9" />
						</svg>
					</i>
					<div class="icon_cart">
						<i>
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21"
								fill="none">
								<path
									d="M3.11209 3.87121H15.9009C16.286 3.87121 16.571 4.32448 16.4844 4.79924L15.3625 10.9503C15.0991 12.394 14.0831 13.4167 12.912 13.4167H6.85376C5.6827 13.4167 4.66662 12.394 4.4033 10.9503L3.84237 7.875M3.11209 3.87121L3.00069 3.26042C2.83942 2.37629 2.21717 1.75 1.5 1.75M3.11209 3.87121L3.84237 7.875M3.84237 7.875H7.5M8.16667 17.7917C8.16667 18.5971 7.60702 19.25 6.91667 19.25C6.22631 19.25 5.66667 18.5971 5.66667 17.7917C5.66667 16.9863 6.22631 16.3333 6.91667 16.3333C7.60702 16.3333 8.16667 16.9863 8.16667 17.7917ZM14 17.7917C14 18.5971 13.4404 19.25 12.75 19.25C12.0596 19.25 11.5 18.5971 11.5 17.7917C11.5 16.9863 12.0596 16.3333 12.75 16.3333C13.4404 16.3333 14 16.9863 14 17.7917Z"
									stroke="#D9D9D9" stroke-linecap="round" />
							</svg>
						</i>
						<div class="number_product">
							<?php
							echo $cart_count
								?>
						</div>
				</nav><!-- #site-navigation -->
				<form class="form_search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
					<input type="text" placeholder="Tìm kiếm..." name="s">
					<input name="post_type" type="hidden" value="product">
				</form>
			</div>
			<div class="cart" style="  display: none;">
				<div class="cart_container">
					<?php
					echo '<h3>Giỏ hàng (' . $cart_count . ')</h3>';
					echo '<hr>';
					include __DIR__ . '\woocommerce\cart\mini-cart.php';
					?>
				</div>
		</header><!-- #masthead -->
		<?php if (!is_front_page() && !is_search()): ?>
			<div class="breadcrumbs">
				<?php
				if (function_exists('yoast_breadcrumb')) {
					yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
				}
				?>
			</div>
		<?php endif; ?>