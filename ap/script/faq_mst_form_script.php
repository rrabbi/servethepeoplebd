<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["file_name"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){	
	@$faq_status = mysql_real_escape_string(htmlentities(input_validation($_POST['faq_status'])));
	$faq_type = mysql_real_escape_string(htmlentities(input_validation($_POST['faq_type'])));
	$faq_question = mysql_real_escape_string(htmlentities(input_validation($_POST['faq_question'])));
	$faq_answer = mysql_real_escape_string(htmlentities(input_validation($_POST['faq_answer'])));
	
	
	$faq_id = mysql_real_escape_string(htmlentities(input_validation($_POST['faq_id'])));
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
	//Empty check usng array
	$required_fields = array('faq_type','faq_type', 'faq_question');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			echo  'Fields marked with an asterisk are required./e';
			$error = 1; //for check
			break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
		}
	}			
	
	if(empty($error) === true){		
		if(empty($faq_id)){
			$insert = mysql_query("INSERT INTO faq_mst VALUES ('','$faq_type','$faq_status','$faq_question','$faq_answer' ) ");						
			if(!$insert){
				echo "Opps! Data not Inserted./e";
			}else{
				//for user log;
				if($allow_log == 1){
					$remark = 'New FAQ added';
					insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
				}
				
				echo "Data was inserted Successful!";
			}//end item insert check							
		}else{//if faq_id not empty
			$update = mysql_query("UPDATE faq_mst SET
									faq_status='$faq_status', faq_type='$faq_type', faq_question='$faq_question', faq_answer='$faq_answer'
									WHERE faq_id = '$faq_id'");
			if(!$update){
				echo "Opps! Data not updated./e";
			}else{
				//for user log;
				if($allow_log == 1){
					$remark = 'FAQ updated';
					insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
				}
						
				echo "Data was updated Successful!";					
			}
					
		}//end second faq_id check							
							
	}//*///end empty error	check
}

?>