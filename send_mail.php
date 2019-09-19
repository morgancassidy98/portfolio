<?php

$webmaster_email = "morgancassidy98@gmail.com";


$feedback_page = "contact.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";

$email_address = $_REQUEST['email_address'];
$message = $_REQUEST['message'];
$name = $_REQUEST['name'];
$company = $_REQUEST['company'];

$msg = 

"Name: " . $name . "\r\n" .
"Email: " . $email_address . "\r\n" .
"Company " . $company . "\r\n" .
"Message " . $message ;


function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email_address'])){
    header("location: $feedback_page");
}

elseif(empty($name) || empty($email_address)){
    header("location: $error_page");
}

elseif ( isInjected($email_address) || isInjected($name)  || isInjected($message) ) {
    header( "location: $error_page" );
    }
    else {

        mail( "$webmaster_email", "Feedback Form Results", $msg );
    
        header( "Location: $thankyou_page" );
    }
    ?>

    


