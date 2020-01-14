<?php
if(!empty($_POST)) {
	
	$name = $_POST["name"];
	$email = $_POST["userEmail"];
	$phone = $_POST["phone"];
	$country = $_POST["country"];	

	//send email
	$toEmail = "demo@demo.com";
	$mailHeaders = "From: " . $name . "<". $email .">\r\n";
	$mailHeaders .= "MIME-Version: 1.0" . "\r\n";
	$mailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$content = "";
	$content .= "<div style='padding: 20px; border: 5px solid #9d0a12; border-style: inset;'>";		
	$content .= '<h2 style="color:#9D0A12">Enquiry On Your Website</h2>';
	$content .= "<b>Name:</b> ".$name.'<br>';
	$content .= "<b>Email Address:</b> ".$email.'<br>';
	$content .= "<b>Phone Number:</b> ".$phone.'<br>';
	$content .= "<b>City:</b> ".$country.'<br>';
	$content .= "</div>";	
	$result = mail($toEmail, 'Enquiry On Your Website', $content, $mailHeaders, 'aaaa@abc.com' );
	if($result) {
		
		$response['status']=TRUE;
		$response['message']="<div id='succmsg' class='alert alert-success'><p>We received your message! Will  get back to you shortly!!!</p></div>";
	}	
	else{
		$response['status']=FALSE;
		$response['errors'] = 'Error';
		$response['message']="<div id='errmsg' class='alert alert-danger'>There Were Errors</div>";
	}	
	echo json_encode($response);
}

?>