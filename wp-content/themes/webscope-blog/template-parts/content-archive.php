<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 17/08/2016
 * Time: 06:59
 */?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
	<div class="col-xs-12 col-sm-7">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php the_post_thumbnail('official',["class" => "img-responsive entry-image"]); ?>
			</a>
	</div>
	<div class="col-xs-12 col-sm-5">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );?>
			<div class="entry-meta">
				<?php webscope_blog_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-content -->
	</div>

</div><!-- .row -->
</article><!-- #post-## -->
