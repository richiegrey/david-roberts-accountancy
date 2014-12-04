<?php

	include_once "swift/lib/swift_required.php";

	$subject = 'Website Enquiry';
	
	$from = array('info@walesaccountancy.co.uk' =>'David Roberts Accountancy Services');
	
	$to = array(
	 'davidroberts1234@gmail.com'  => 'David Roberts',
	 'richard.grey@efectus.co.uk'  => 'David Roberts'
	);

	$name = $_POST['userName'];
	$email = $_POST['userEmail'];
	$msg = $_POST['userMsg'];

	$text = $name ."<br />". $email ."<br />". $msg;

	$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
	$transport->setUsername('richard.grey@efectus.co.uk');
	$transport->setPassword('zFCcJFIqlOVKtlWCVgKxxQ');
	$swift = Swift_Mailer::newInstance($transport);

	$message = new Swift_Message($subject);
	$message->setFrom($from);
	$message->setBody($text, 'text/html');
	$message->setTo($to);

	if ($recipients = $swift->send($message, $failures))
	{
		header( 'Location: http://www.walesaccountancy.co.uk/contact.html' );
	} else {
	 echo "There was an error:\n";
	 print_r($failures);
	 header( 'Location: http://www.walesaccountancy.co.uk/contact.html' );
	}

	

?>