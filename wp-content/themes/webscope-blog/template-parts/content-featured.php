<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 14/08/2016
 * Time: 14:43
 */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail( 'slider', [ "class" => 'img-responsive' ] ); ?>
	<div class="overlay-div">
		<div>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content hidden-sm">
			<?php echo substr( get_the_excerpt(), 0, 100 ) . "..."; ?>
		</div><!-- .entry-content -->
			<div class="read-more-link">
				<a  href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">Read Full Article...</a>
			</div>
		</div>
	</div>
</article><!-- #post-## -->