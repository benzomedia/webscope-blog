<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Webscope_Blog
 */

get_header(); ?>
<div class="container">

	<!-- Featured Posts Slider Div -->
	<?php
		$paged = (get_query_var('paged'));
		if ($paged < 2) :?>
		<div class="featured-posts-div hidden-xs">
			<?php

			// args
			$args = array(
			'numberposts'	=> -1,
			'post_type'		=> 'post',
			'meta_key'		=> 'featured',
			'meta_value'	=> true
			);


			// query
			$the_query = new WP_Query( $args );

			?>
			<?php if( $the_query->have_posts() ): ?>

					<?php while( $the_query->have_posts() ) : $the_query->the_post();

						get_template_part( 'template-parts/content-featured' );

					  endwhile; ?>

			<?php endif; ?>

			<?php wp_reset_query(); ?>
		</div>
	<?php endif; ?>

	<!-- Regular Posts Div -->
	<div class="row">
	<div id="primary" class="index-posts content-area col-xs-12 col-sm-9">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-archive' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="sidebar hidden-xs col-sm-3">
		<?php get_sidebar(); ?>
	</div><!-- #secondary -->
	</div><!-- .row -->
</div><!-- .container -->




<?php get_footer();