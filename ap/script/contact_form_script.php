<?php
	//require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$visitor_name = mysql_real_escape_string(htmlentities(input_validation($_POST['visitor_name'])));
		$visitor_email = mysql_real_escape_string(htmlentities(input_validation($_POST['visitor_email'])));
		$visitor_contact = mysql_real_escape_string(htmlentities(input_validation($_POST['visitor_contact'])));
		$email_subject = mysql_real_escape_string(htmlentities(input_validation($_POST['email_subject'])));
		$visitor_message = mysql_real_escape_string(htmlentities(input_validation($_POST['visitor_message'])));
		
		
		if(!empty($visitor_name) && !empty($visitor_email) && !empty($email_subject) && !empty($visitor_message) ){
			//echo 'OK';
			//for imput text validation (if some one brack the maxlenght="" attribute in html), i also restricted in HTML input tag (maxlength=""), the maxlenght is the first validation.
			if (strlen($visitor_name)>40 ){
				$errors[] = 'Oppos! Max leangth for Name field was excceded.';
			}elseif(strlen($visitor_email)>100){
				$errors[] = 'Oppos! Max leangth for Email field was excceded.';
			}elseif(strlen($email_subject)>150){
				$errors[] = 'Oppos! Max leangth for Subject field was excceded.';
			}elseif(strlen($visitor_message)>1000){
				$errors[] = 'Oppos! Max leangth for Message field was excceded.';
			}elseif(!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Your given email \''.$visitor_email.'\' is not valid.';
			}else {
					$to = COMPANY_CONTACT_EMAIL;
					$header = 'Form: '.$visitor_email;
					$email_subject = $email_subject;
					$body = $visitor_message."\n\n".$visitor_name."\n".$visitor_contact."\n".$visitor_email;					
					
					if (mail($to, $email_subject, $body ,$header)){
						$_SESSION['contact_form_email'] = $to; //for success contact check
						
						if($_GET['type'] == 'ContactUs'){
							header('Location: auth.php?type=ContactUs&Success');
							exit();
						}
						//$errors[] = 'Thank you for contact us, we will be in touch soon';
						//echo 1;
					}else{
						$errors[] = 'Oppos! Email sending error, please try again later.';
					}				
			}
		}else {
			$errors[] = "Star mark field are required.";
		}//end empty  */	
	}//end isset
	
?>