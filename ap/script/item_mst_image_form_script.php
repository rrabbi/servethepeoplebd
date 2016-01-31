<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["slider_i_img"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){				
	//echo 'OK';		
	$img = $_FILES["i_img"]["name"];//print_r($img); //array		
	@$item_id = mysql_real_escape_string(htmlentities(input_validation($_POST['item_id'])));
	
	if(!empty($item_id)){	
		//Empty check usng array
		$required_fields = $_FILES["i_img"]["name"]; //put all img into array
		foreach($required_fields as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				echo  'Please select file./e';
				$error = 1; //for check
				break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
			}
		}
		
		define("MAX_SIZE", '1000', true);//Kb
		
		if(empty($error) === true){
			//$img =$_FILES['i_img']['name'];
			$img_array= array();			
			foreach($img AS $key=>$value){
				$target_path = "../../files/items/";
				$img_type = $_FILES["i_img"]["type"][$key];
				$img_size = $_FILES["i_img"]["size"][$key];
				$img_tmp = $_FILES["i_img"]["tmp_name"][$key];
				$tmp_size = filesize($_FILES["i_img"]["tmp_name"][$key]);				
				$img_error = $_FILES["i_img"]["error"][$key];
				
				$allowedExt = array("png","jpeg","jpg","gif");				
				$temp = explode(".", $_FILES["i_img"]["name"][$key]);
				$extension = end($temp);//$ext = getExtension($i_img);
				$extension = strtolower($extension);
				$array_match = in_array($extension, $allowedExt);
				
				$new_img = md5(time().$img[$key]).'.'.$extension;			
				$target_file = $target_path.$new_img;
				
				if(!$array_match){
					echo $extension." - is not support for upload./e";
				}elseif($tmp_size >(MAX_SIZE*1024)){
					echo number_format(($img_size/1024),2)."Kb, is Big size file, Not upload./e";
				}else{
					
					if (move_uploaded_file($img_tmp, $target_file)) {
										
						echo 'Image uploaded successfully! <br>';
					} else {     //  If File Was Not Moved.
						echo ' please try again!./e';
					}
					$img_array[] = "('$item_id','$new_img')";
				}
			}
			$insert = mysql_query("INSERT INTO item_images VALUES ".implode(',', $img_array) );			
			//print_r($img_array);
			//if($insert){
			//	echo 'Image uploaded successfully!';
			//}			
		}//error check*/
	}else{
		echo 'Work only for adding and editing item./e';
	}
}

/*
for ($i = 0; $i < $no_files; $i++) {
				$img_type = $_FILES["i_img"]["type"][$i];
				$img_size = $_FILES["i_img"]["size"][$i];
				$img_tmp = $_FILES["i_img"]["tmp_name"][$i];
				//$tmp_size = filesize($_FILES["i_img"]["tmp_name"][$i]);				
				//$img_error = $_FILES["i_img"]["error"][$i];
				
				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
				$ext = explode('.', basename($_FILES['i_img']['name'][$i]));   // Explode file name from dot(.)
				$file_extension = end($ext); // Store extensions in the variable.
				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
				
				$count = $count + 1;      // Increment the number of uploaded images according to the files in array.
				$img =$_FILES['i_img']['tmp_name'][$i];
				$img_array = $img;
				
				if (($img_size < 100000)    // Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					//$insert = mysql_query("INSERT INTO item_images VALUES(1,'$img')");
					if (move_uploaded_file($img, $target_path)) {
					//if (upload_img($img, '../../files/items/', $target_path)) {
					// If file moved to uploads folder.
						
						echo $count. ') Image uploaded successfully!';
					} else {     //  If File Was Not Moved.
						echo $count. ') please try again!.';
					}
				} else {     //   If File Size And File Type Was Incorrect.
					echo $count. ') Invalid file Size or Type***';
				}
			}
*/



/*
$no_files = count($_FILES["i_img"]['name']);
			$count = 0;
			for ($i = 0; $i < $no_files; $i++) {
				
				$img_type = $_FILES["i_img"]["type"][$i];
				$img_size = $_FILES["i_img"]["size"][$i];
				$img_tmp = $_FILES["i_img"]["tmp_name"][$i];
				$tmp_size = filesize($_FILES["i_img"]["tmp_name"][$i]);				
				$img_error = $_FILES["i_img"]["error"][$i];
				
				
				$allowedExt = array("png","jpeg","jpg","gif");				
				$temp = explode(".", $_FILES["i_img"]["name"][$i]);
				$extension = end($temp);//$ext = getExtension($i_img);
				$extension = strtolower($extension);
				$array_match = in_array($extension, $allowedExt);
				
				$new_img = md5(time().$img[$i]).'.'.$extension;
				
				if(!$array_match){
					echo $extension." - is not support for upload";
				}elseif($tmp_size >(MAX_SIZE*1024)){
					echo number_format(($img_size/1024),2)."Kb, is Big size file, Not upload";
				}else{  //unlink() file_exists()
					//print_r($new_img);
					//echo $item_id.'='.$new_img.'</br>';
				
					$count++;
					$insert = mysql_query("INSERT INTO item_images VALUES('$item_id','$new_img')");						
					if(!$insert){
						echo "Opps! Data not Save./e";
					}else{
						upload_img(@$img_tmp, '../../files/items/', '../../files/items/'.$new_img[$i]); //upload Images														
						echo "Image upload Successful!";
					}//end item insert check
					
				}//end extention check
			}//end foreach*/
?>