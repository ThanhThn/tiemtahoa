<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TTHHCN
 */

?>
<?php if (!is_front_page()) { ?>
	<div class="popup_container" style="display: none">
	</div>
<?php } ?>
<footer id="colophon" class="site-footer">
	<div class="footer_content">
		<div class="contact">
			<div class="logo">
				<img src="<?php echo get_template_directory_uri() . '/assets/img/logo.svg'; ?>" alt="logo">
			</div>
			<ul>
				<li><strong>Địa chỉ: </strong>19 Quảng Đức, Vĩnh Hãi, Nha Trang Khánh Hòa</li>
				<li><a href="tel:07828243334"><strong>Hotline: </strong>078 2824 3334</a></li>
				<li><a href="mailto:dang.vu@vnresource.org"><strong>Email: </strong>dang.vu@vnresource.org</a></li>
			</ul>
		</div>
		<div class="category">
			<h6>Danh mục</h6>
			<ul>
				<?php
				$product_categories = get_terms(
					array(
						'taxonomy' => 'product_cat',
						'hide_empty' => true,
					)
				);
				foreach ($product_categories as $category) {
					echo '<li>';
					echo '<a href="' . get_term_link($category) . '">' . $category->name . '</a>';
					echo '</li>';
				}
				?>
			</ul>
		</div>
		<div class="information">
			<h6>Thông tin</h6>
			<ul>
				<?php
				$policy_category = new WP_Query(
					array(
						'tax_query' => array(
							array(
								'taxonomy' => 'cate',
								'field' => 'name',
								'terms' => 'Chính sách',
							),
						),
					)
				);

				if ($policy_category->have_posts()) {
					while ($policy_category->have_posts()) {
						$policy_category->the_post();
						echo '<li>';
						echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
						echo '</li>';
					}
					wp_reset_postdata();
				}
				?>
			</ul>
		</div>
		<div class="social">
			<h6>Mạng xã hội</h6>
			<ul>
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Instagram</a></li>
				<li><a href="#">Zalo</a></li>
				<li><a href="#">Tiktok</a></li>
			</ul>
		</div>
	</div>
	<!-- <div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'tthhcn')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'tthhcn'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'tthhcn'), 'tthhcn', '<a href="http://underscores.me/">Underscores.me</a>');
		?>
	</div>.site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>