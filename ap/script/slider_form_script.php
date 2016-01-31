<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["slider_img"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){				
	//echo 'OK';
	
	$slider_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['slider_type_id'])));
	$s_title = mysql_real_escape_string(htmlentities(input_validation($_POST['s_title'])));
	$s_serial = mysql_real_escape_string(htmlentities(input_validation($_POST['s_serial'])));
	@$s_status = mysql_real_escape_string(htmlentities(input_validation($_POST['s_status'])));
	//$s_text1 = mysql_real_escape_string(htmlentities(input_validation($_POST['s_text1'])));
	//$s_text2 = mysql_real_escape_string(htmlentities(input_validation($_POST['s_text2'])));	
	
	$slider_img = mysql_real_escape_string(htmlentities(strtolower($_FILES["slider_img"]["name"])));
	//$slider_img = md5(time()).'_'.$slider_img; //generate unique name converting timestam into md5 hash
	
	$slider_id = mysql_real_escape_string(htmlentities(input_validation($_POST['slider_id'])));
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
	//query existing img
	$query = $con->prepare("SELECT s_img1 FROM slider WHERE slider_id=:slider_id");
	$query->execute(array(':slider_id'=>$slider_id));
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$exist_img = $query['s_img1'];			
	
	//if( !empty($s_title) && !empty($s_serial) ){
			
	$img_type = $_FILES["slider_img"]["type"];
	$img_size = $_FILES["slider_img"]["size"];
	$img_tmp = $_FILES["slider_img"]["tmp_name"];
	$tmp_size = filesize($_FILES["slider_img"]["tmp_name"]);				
	$img_error = $_FILES["slider_img"]["error"];
	define("MAX_SIZE", "1000");//Kb

	$allowedExt = array("png","jpeg","jpg","gif");
	//$extension = strtolower (substr ($slider_img, strpos($slider_img, '.') + 1)); // just show the file extension in lowercase
	$temp = explode(".", $_FILES["slider_img"]["name"]);
	$extension = end($temp);//$ext = getExtension($slider_img);
	$extension = strtolower($extension);
	$array_match = in_array($extension, $allowedExt);												
	
	//new image name 
	$new_img = md5(time().$slider_img).'.'.$extension;
	
	//Empty check usng array
	$required_fields = array('slider_type_id','s_title', 's_serial');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			echo  'Fields marked with an asterisk are required./e';
			$error = 1; //for check
			break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
		}
	}
					
	if(empty($error) === true){
		if(!empty($slider_img)){
			if(( ($extension != "gif")
				|| ($extension != "jpeg")
				|| ($extension != "jpg")
				|| ($extension != "png") )
				&& !$array_match){
				echo $extension." - is not support for upload./e";
			}elseif($tmp_size >(MAX_SIZE*1024)){
				echo number_format(($slider_img_size/1024),2)."Kb, is Big size file, Not upload./e";
			}else{  //unlink() file_exists()
				if(empty($slider_id)){
					
					$insert = mysql_query("INSERT INTO slider VALUES ('','$slider_type_id','$s_title','$s_serial','$s_status','','','$new_img','','' ) ");						
					if(!$insert){
						echo "Opps! Data not Inserted./e";
					}else{
						upload_img(@$img_tmp, '../../files/slider/'.$exist_img, '../../files/slider/'.$new_img); //upload Images	
						
						//for user log;
						if($allow_log == 1){
							$remark = 'New slider added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
													
						echo "Data was inserted Successful!";
					}//end item insert check											
				}else{//if slider_id not empty
					
					$update = mysql_query("UPDATE slider SET
										slider_type_id='$slider_type_id', s_title='$s_title', s_serial='$s_serial', s_status='$s_status',	s_img1='$new_img' 
										WHERE slider_id = '$slider_id'");
					if(!$update){
						echo "Opps! Data not updated./e";
					}else{
						upload_img(@$img_tmp, '../../files/slider/'.$exist_img, '../../files/slider/'.$new_img); //upload Images
						
						//for user log;
						if($allow_log == 1){
							$remark = 'Slider Updated';
							insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
						}
						
						echo "Data was updated Successful!";
					}						
				}//end first slider_id check
			}//end extention check
		}elseif(empty($slider_img)){
			if(empty($slider_id)){
				$insert = mysql_query("INSERT INTO slider VALUES ('','$slider_type_id','$s_title','$s_serial','$s_status','','','$slider_img','','' ) ");						
				if(!$insert){
					echo "Opps! Data not Inserted./e";
				}else{
					
					//for user log;
					if($allow_log == 1){
						$remark = 'New slider added';
						insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
					}	
												
					echo "Data was inserted Successful!";
				}//end item insert check							
			}else{//if slider_id not empty					
				$update = mysql_query("UPDATE slider SET
									slider_type_id='$slider_type_id', s_title='$s_title', s_serial='$s_serial', s_status='$s_status', s_img1='$exist_img' 
									WHERE slider_id = '$slider_id'");
				if(!$update){
					echo "Opps! Data not updated./e";
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'Slider Updated';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo "Data was updated Successful!";
				}		
			}//end second slider_id check
		}//end slider_img check							
							
	}//end empty error check */	
}

?>