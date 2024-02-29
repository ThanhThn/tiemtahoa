<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TTHHCN
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="single_blog_title">
		<?php
		echo '<p>' . get_the_title() . '</p>';
		echo '<span>' . get_the_time('F j, Y') . '</span>';
		echo '<div class="author">' . get_the_author() . '</div>';
		?>
	</div>
	<?php
	tthhcn_post_thumbnail();
	?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'tthhcn'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		// wp_link_pages(
		// 	array(
		// 		'before' => '<div class="page-links">' . esc_html__('Pages:', 'tthhcn'),
		// 		'after' => '</div>',
		// 	)
		// );
		//      ?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php //tthhcn_entry_footer();     ?>
	</footer>.entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->