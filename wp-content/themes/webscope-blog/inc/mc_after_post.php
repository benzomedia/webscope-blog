<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 21/08/2016
 * Time: 22:16
 */

function webscope_mc_after_post($content){

$form = '<div class="mc-after-post">
			<h2>Don\'t Miss Out</h2>
			<p>Join our mailing list for more amazing content!</p>
		<form id="mc-after-form" class="form-inline">
			<div class="form-group">
				<label for="first-name-input" hidden>First Name</label>
				<input type="text" class="form-control" id="mc-after-first-name-input" placeholder="First Name">
			</div>
			<div class="form-group">
				<label for="email-input" hidden>Email address</label>
				<input type="email" class="form-control" id="mc-after-email-input" placeholder="Email">
			</div>
			<div class="form-group text-center">
				<button class="btn btn-primary">Send<i id="mc-after-spinner" class="fa fa-cog fa-spin fa-fw"></i></button>
			</div>
			<div id="mc-after-loading-div"></div>
		</form>
	</div>';

	if( is_single() ) {
		$content .= $form;
	}
	return $content;


}

add_filter( 'the_content', 'webscope_mc_after_post', 20 );