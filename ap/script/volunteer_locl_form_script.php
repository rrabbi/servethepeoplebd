<?php
	//require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$name = mysql_real_escape_string(htmlentities(input_validation($_POST['name'])));
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));
		$address = mysql_real_escape_string(htmlentities(input_validation($_POST['address'])));
		$city = mysql_real_escape_string(htmlentities(input_validation($_POST['city'])));
		$state = mysql_real_escape_string(htmlentities(input_validation($_POST['state'])));
		
		$country = mysql_real_escape_string(htmlentities(input_validation($_POST['country'])));
		$phone = mysql_real_escape_string(htmlentities(input_validation($_POST['phone'])));
		$age = mysql_real_escape_string(htmlentities(input_validation($_POST['age'])));
		$hour_per_week = mysql_real_escape_string(htmlentities(input_validation($_POST['hour_per_week'])));
		$about_your_self = mysql_real_escape_string(htmlentities(input_validation($_POST['about_your_self'])));
		
		
		if(!empty($name) && !empty($email) && !empty($city) ){
			//echo 'OK';
			//for imput text validation (if some one brack the maxlenght="" attribute in html), i also restricted in HTML input tag (maxlength=""), the maxlenght is the first validation.
			if (strlen($name)>50 ){
				$errors[] = 'Oppos! Max leangth for Name field was excceded.';
			}elseif(strlen($email)>100){
				$errors[] = 'Oppos! Max leangth for Email field was excceded.';
			}elseif(strlen($about_your_self)>1000){
				$errors[] = 'Oppos! Max leangth for Message field was excceded.';
			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Your given email \''.$email.'\' is not valid.';
			}else {
					$to = "rasheed_rabbi@hotmail.com";
					$header = 'Form: hello@servethepeoplebd.org';
					//$header = "Form: contact@edawah.net\r\n";
					//$header .= "Reply-To: ".$email."\r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					$subject = "Local Volunteer Name and Deatils of ".$name;					
					
					$body =  "<html><body>Dear Sir,
								<table style='width:100%; border-color: #666;'>
									<tr><td>Requester Name: ".$name."</td></tr>
									<tr><td>Email: ".$email."</td></tr>
									<tr><td>Address: ".$Address."</td></tr>
									<tr><td>City: ".$city."</td></tr>
									<tr><td>State: ".$state."</td></tr>
									<tr><td>Country: ".$country."</td></tr>
									<tr><td>Phone: ".$phone."</td></tr>
									<tr><td>Age: ".$age."</td></tr>
									<tr><td>Hours per week: ".$hour_per_week."</td></tr>
									<tr><td>Details: ".$about_your_self."</td></tr>
								</table>							
							</body></html>";					
					
					if (mail($to, $subject, $body ,$header)){
						$_SESSION['check_session_value'] = $to; //for success contact check
						
						if($_GET['type'] == 'ContactUs'){
							header('Location: auth.php?type=VolunteerContent&Success');
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