<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Webscope_Blog
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="primary" class="post-article content-area col-xs-12 col-sm-9">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );


						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<div class="sidebar hidden-xs col-sm-3">
				<?php get_sidebar(); ?>
			</div><!-- #secondary -->
		</div><!-- .row -->
	</div><!-- .container -->


<?php get_footer();