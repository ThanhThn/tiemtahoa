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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://malsup.github.io/jquery.blockUI.js"></script>
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
							<?php echo $tthhcn_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped                                           ?>
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
					<ul class="menu">
						<li class="mini_cart">Giỏ hàng</li>
						<li class="search">Tìm kiếm</li>
					</ul>
				</nav><!-- #site-navigation -->
				<form class="form_search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
					<div>
						<input type="text" placeholder="Tìm kiếm..." name="s">
						<button type="submit">
							<svg width="30" height="30" viewBox="0 0 30 30" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<circle cx="13.75" cy="13.75" r="8.75" stroke="#057F62" stroke-width="2" />
								<path
									d="M13.75 10C13.2575 10 12.7699 10.097 12.3149 10.2855C11.86 10.4739 11.4466 10.7501 11.0983 11.0983C10.7501 11.4466 10.4739 11.86 10.2855 12.3149C10.097 12.7699 10 13.2575 10 13.75"
									stroke="#057F62" stroke-width="2" stroke-linecap="round" />
								<path d="M25 25L21.25 21.25" stroke="#057F62" stroke-width="2" stroke-linecap="round" />
							</svg>
						</button>
						<input name="post_type" type="hidden" value="product">
					</div>
				</form>
			</div>
			<div class="cart" style="display:none;">
				<div class="cart_container">
					<?php
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