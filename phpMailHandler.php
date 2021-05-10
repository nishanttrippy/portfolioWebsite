<?
	// SIMPLE PHP MAIL HANDLER prepared by Eugene Ahn codeyourheartout@gmail.com for USC Roski DES 303


	/*

	HOW TO USE THIS SCRIPT - ESSENTIAL ITEMS

	1. Set your HTML form method as POST. Example: <form method=post>

	2. Set your HTML form action as http://sandbox.design303.com/_resources/mail/phpMailHandler.php. Example: <form action=http://sandbox.design303.com/_resources/mail/phpMailHandler.php>

	3. Therefore, if you combine essential steps 1 and 2 above your opening HTML form tag will look like this: <form action=http://sandbox.design303.com/_resources/mail/phpMailHandler.php method=post>

	4. Make sure your HTML form includes the following data:

		- name=action value=sendAlert	: this will trigger the handler
		- name=emailFrom				: the corresponding value determines the email from address
		- name=emailTo					: the corresponding value determines the email to address
		- name=messageSubject			: the corresponding value determines the email message subject
		- name=messageBody				: the corresponding value determines the email message body
		- name=urlActionCompleted		: the corresponding value determines the web page URL to load when the email is successfully sent
		- name=urlActionFailed			: the corresponding value determines the web page URL to load when the page is loaded but the handler is not properly triggered

	HOW TO USE THE SCRIPT - ADDITIONAL BUT NOT REQUIRED ITEMS

	5. To customize a confirmation page, make sure you set data name=urlActionCompleted in your HTML form. The value of this data should be the URL of your confirmation page.

	6. To customize a failure alert page, make sure you set data name=urlActionFailed in your HTML form. The value of this data should be the URL of your failure alert page.

	*/






	if ($_POST['action'] == 'sendAlert')
	{
		// POST ACTION IS VALID. PROCESS THE MAIL ALERT.

		// PREPARE POST DATA
		$emailFrom 			= $_POST['email'];
		$emailTo 			= "tripathi.nishant25@gmail.com";
		$messageSubject 	= $_POST['subject'];
		$messageBody 		= $_POST['messageBody'];
		$content 			= $_POST['body'];
		$url 				= $_POST['urlActionCompleted'];
		$userName = $_POST['name'];

		// prepare a mail message
		$messageBody = "

		<div style='background-color: rgb(33, 8, 44); color: white; width: 100%; height: 100%'>
		<h1>Received Email!</h1>
		<p><img src=logo.png>
		<h2>Someone named $userName submitted a quiz</h2>

		<p>Here is what they submitted:

		<ul>
		<li>Name: $userName
		<li>Content: $content
		</ul>
		</div>
		";


		// PREPARE HTML MAIL HEADER
		$header  = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$header .= "To: <".$emailTo.">" . "\r\n";
		$header .= "From: <".$emailFrom.">"."\r\n";
		$header .= "bcc: <ahne@usc.edu>"."\r\n";


		// SEND MAIL ALERT
		mail($emailTo,$messageSubject,$messageBody,$header);

	}
	else
	{
		// POST ACTION IS INVALID. PROCESS A FAIL.

		if (isset($_POST['urlActionFailed']))
		{
			$url = $_POST['urlActionFailed'];
		}
		else
		{
			$url = "http://www.google.com";
		}
	}

	// GENERATE THE HTML WITH A REDIRECT TO THE SPECIFIED URL

?>



<html>
	<head>
		<meta http-equiv="refresh" content="0; url=<?=$url?>">
	</head>
	<body>
	</body>
</html>
