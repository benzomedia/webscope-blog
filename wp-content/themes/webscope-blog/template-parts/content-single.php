<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 14/08/2016
 * Time: 18:19
 */?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>

				<div class="entry-meta">
					<?php webscope_blog_posted_on(); ?>
				</div><!-- .entry-meta -->
			<div class="entry-thumbnail">
				<?php the_post_thumbnail('slider',["class" => "img-responsive"]); ?>
			</div>



		</header><!-- .entry-header -->


		<div class="entry-content">
			<?php
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'webscope-blog' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php webscope_blog_entry_footer(); ?>
		</footer><!-- .entry-footer -->

</article><!-- #post-## -->

