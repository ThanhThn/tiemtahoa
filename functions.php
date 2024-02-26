<?php
/**
 * TTHHCN functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TTHHCN
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tthhcn_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on TTHHCN, use a find and replace
	 * to change 'tthhcn' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('tthhcn', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	add_theme_support('woocommerce');
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'tthhcn'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'tthhcn_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'tthhcn_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tthhcn_content_width()
{
	$GLOBALS['content_width'] = apply_filters('tthhcn_content_width', 640);
}
add_action('after_setup_theme', 'tthhcn_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tthhcn_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'tthhcn'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'tthhcn'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'tthhcn_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function enqueue_custom_styles()
{
	wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/product.css', array(), '1.0', 'all');
	wp_enqueue_style('single-style', get_template_directory_uri() . '/assets/css/single.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
function tthhcn_scripts()
{
	wp_enqueue_style('tthhcn-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('tthhcn-style', 'rtl', 'replace');

	wp_enqueue_script('tthhcn-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'tthhcn_scripts');

//Add Slider
function create_sliders()
{
	register_post_type(
		'slider',
		array(
			'labels' => array(
				'name' => __('Sliders'),
				'singular_name' => __('Slider'),
			),
			'description' => __('Tạo các ảnh sliders'),
			'supports' => array(
				'thumbnail',
			),
			'hierarchical' => false,
			'public' => true,
			'show_in_nav_menus' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_icon' => 'dashicons-location-alt',
			'show_in_admin_bar' => true,
			'publicly_queryable' => true,
		)
	);
}
add_action('init', 'create_sliders');
/** 
 * Posts per page for CPT archive
 * prevent 404 if posts per page on main query
 * is greater than the posts per page for product cpt archive
 *
 * thanks to https://sridharkatakam.com/ for improved solution!
 */

function prefix_change_cpt_archive_per_page($query)
{
	//* for cpt or any post type main archive
	if ($query->is_main_query() && !is_admin() && (is_post_type_archive('product') || is_archive())) {
		$query->set('posts_per_page', '1');
	}

}
add_action('pre_get_posts', 'prefix_change_cpt_archive_per_page');

/**
 * 
 * Posts per page for category (test-category) under CPT archive 
 *
 */
function prefix_change_category_cpt_posts_per_page($query)
{

	if ($query->is_main_query() && !is_admin() && is_category('test-category')) {
		$query->set('post_type', array('product'));
		$query->set('posts_per_page', '1');
	}

}
add_action('pre_get_posts', 'prefix_change_category_cpt_posts_per_page');
function paginate($current_page, $query = null)
{
	$pages = $query->max_num_pages;
	echo '<div class="pagination">';
	echo '<div class="prev-next-links">';
	if ($current_page > 1) {
		echo '<a href="' . get_pagenum_link($current_page - 1) . '" class="prev"><i class="fa-solid fa-angle-left"></i></a>';
	}
	echo '</div>';
	echo '<div class="page-numbers">';
	for ($i = 1; $i <= $pages; $i++) {
		echo '<a href="' . get_pagenum_link($i) . '" class="page-number ' . ($current_page == $i ? 'current' : '') . '">' . $i . '</a>';
	}
	echo '</div>';
	echo '<div class="prev-next-links">';
	if ($current_page < $pages) {
		echo '<a href="' . get_pagenum_link($current_page + 1) . '" class="next"><i class="fa-solid fa-angle-right"></i></a>';
	}
	echo '</div>';
	echo '</div>';
}

//AJAX
function asset_ajax()
{
	wp_enqueue_script('index', get_template_directory_uri() . '/assets/js/index.js', ['jquery'], _S_VERSION, true);
	wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/ajax.js', ['jquery'], _S_VERSION, true);
	wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/js/gsap.js', ['jquery'], _S_VERSION, true);
	wp_localize_script('app', 'siteConfig', [
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce('loadmore_post_nonce'),
	]);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\asset_ajax');

function ajax_script_asset_ajax(bool $initial_request = false)
{
	if (!$initial_request && !check_ajax_referer('loadmore_post_nonce', 'ajax_nonce', false)) {
		wp_send_json_error(_('Invalid security token sent.', 'text-domain'));
		wp_die('0', 400);
	}
	// Check if it's an ajax call
	$is_ajax_request = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	if ($is_ajax_request && !$initial_request) {
		wp_die();
	}
}
add_action('wp_ajax_asset_ajax', __NAMESPACE__ . '\\ajax_script_post_asset_ajax');
add_action('wp_ajax_nopriv_asset_ajax', __NAMESPACE__ . '\\ajax_script_post_asset_ajax');
function ajax_quickView()
{
	$id = $_POST['id'];
	$args = array(
		'post_type' => 'product',
		'p' => $id
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post(); ?>
			<div class="popup_product">
				<div class="popup_product-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="popup_product-infor">
					<?php
					woocommerce_template_single_title();
					woocommerce_template_single_price();
					woocommerce_template_single_add_to_cart(); ?>
				</div>
				<div class="close">
					<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g id="Menu / Close_SM">
							<path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke="#000000" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
						</g>
					</svg>
				</div>
			</div>
		<?php }
	}
	die();
}
add_action('wp_ajax_quickView', __NAMESPACE__ . '\\ajax_quickView');
add_action('wp_ajax_nopriv_quickView', __NAMESPACE__ . '\\ajax_quickView');
//Custom Currency
add_filter('woocommerce_currencies', 'add_cw_currency');
function add_cw_currency($cw_currency)
{
	$cw_currency['VIETNAM'] = __('VIETNAM DONG', 'woocommerce');
	return $cw_currency;
}
add_filter('woocommerce_currency_symbol', 'add_cw_currency_symbol', 10, 2);
function add_cw_currency_symbol($custom_currency_symbol, $custom_currency)
{
	switch ($custom_currency) {
		case 'VIETNAM':
			$custom_currency_symbol = 'đ';
			break;
	}
	return $custom_currency_symbol;
}

// Function Set Post View
function set_post_views($postID)
{
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == "") {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
//Get rid of prefetching to keep the count accurate
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//Function Track Posts View
function track_post_views($post_id)
{
	if (!is_single())
		return;
	if (empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');
// Function Get Popular Posts
function get_post_views($postID)
{
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count . ' Views';
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

