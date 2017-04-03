<?php
/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 08/07/2016
 * Time: 09:19
 */

require( get_template_directory(). "/vendor/autoload.php" );




use \DrewM\MailChimp\MailChimp;


function sendContactToMailchimp($userEmail, $firstName) {

	$MailChimp = new MailChimp( '5717d309d274889a98edc2e49558eef6-us10' );

	$list_id = '341f75f304';
	$group_id = 'a74abc75de';

	$result = $MailChimp->post( "lists/$list_id/members", [
		'email_address' => $userEmail,
		'status'        => 'subscribed',
		"merge_fields" => ["FNAME" => $firstName],
		'interests' => [$group_id => true]
	] );

	$message = "There was a new subscriber for webscope.\r\nEmail: " . $userEmail;
	$message = wordwrap( $message, 70, "\r\n" );


	$to      = 'hello@webscopeapp.com';
	$subject = "New Subscriber for Webscope";


	$headers = "From:hello@webscopeapp.com \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html\r\n";

	mail( $to, $subject, $message, $headers );


	return $result;

}