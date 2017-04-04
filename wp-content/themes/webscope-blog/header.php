<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Webscope_Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="nSlDGW0HgzM-v7VWcHmUX3TZ1vbtBx9dEFTU6RNjfkA" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() . "/images/favicon.png"; ?>" >


	<!-- GOOGLE ANALYTICS -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-91795686-3', 'auto');
        ga('send', 'pageview');

    </script>
	<!-- GOOGLE ANALYTICS -->

    <!--WEBSCOPE-->
<!--    <script src="http://localhost:3000/external.bundle.js" async data-webscope-id="c938a393-e22c-474e-a194-b90ffa7fc149"></script>-->
    <!--WEBSCOPE-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text"
	   href="#content"><?php esc_html_e( 'Skip to content', 'webscope-blog' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding pull-left">
				<h1 class="logo">
					<a href="<?php echo esc_url( 'http://webscopeapp.com' ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() . '/images/logo.png' ?>"/></a>
				</h1>
			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="navbar" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
						        data-target=".navbar-ex2-collapse">
							<i class="material-icons">menu</i>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex2-collapse">
						<?php /* Primary navigation */
						wp_nav_menu( array(
								'menu'       => 'primary',
								'depth'      => 2,
								'container'  => false,
								'menu_class' => 'nav menu-primary',
								'walker'     => new wp_bootstrap_navwalker(),
							)
						);
						?>
					</div>
				</nav>

			<?php endif; ?>
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
