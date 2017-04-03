<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 03/09/2016
 * Time: 20:34
 */

// [banner post="post id"]
/**
 * @param $atts
 *
 * @return string
 */
function ws_banner_func( $atts ) {
	$a = shortcode_atts( array(
		'post' => 'undefined'
	), $atts );

	$banner = '<a href="http://webscopeapp.com/?utm_source=blog&utm_medium=banner&utm_term=post-' . $a["post"] .'&utm_campaign=Webscope%20Blog">';
	$banner .= '<img src="'. get_template_directory_uri() . '/images/ws-banner.png" class="ws-banner img-responsive center-block"  /></a>';

	return $banner;

}

add_shortcode( 'banner', 'ws_banner_func' );