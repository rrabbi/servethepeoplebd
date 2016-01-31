<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["file_name"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){				
	//echo 'OK';
	//echo $a_desc = $_POST['a_desc'];	
	$art_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['art_cat_id'])));
	$a_code = mysql_real_escape_string(htmlentities(input_validation($_POST['a_code'])));
	$a_title = mysql_real_escape_string(htmlentities(input_validation($_POST['a_title'])));
	//$a_desc = mysql_real_escape_string(htmlentities(input_validation($_POST['a_desc'])));
	$a_desc = mysql_real_escape_string($_POST['a_desc']);
	$a_pdate = mysql_real_escape_string($_POST['a_pdate']);
	$a_comment = mysql_real_escape_string(htmlentities(input_validation($_POST['a_comment'])));
	@$a_status = mysql_real_escape_string(htmlentities(input_validation($_POST['a_status'])));
	
	$file_name = mysql_real_escape_string(htmlentities(strtolower($_FILES["file_name"]["name"])));
	//@$file_name_md5 = md5(time()).'_'.$file_name; //generate unique name converting timestam into md5 hash
	
	
	$article_id = mysql_real_escape_string(htmlentities(input_validation($_POST['article_id'])));
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
	
	//array_value
	//$ad_head = $_POST['ad_head'];
	//$ad_article = $_POST['ad_article'];
	//print_r($ad_head);
	//print_r($ad_article);	
	//$data = array($ad_head, $ad_article);
	//print_r($data);	
	//$join_query = mysql_query("INSERT INTO article_dtl (art_dtl_id, article_id, ad_head, ad_article, ad_img) VALUES ".implode(', ', $values) );
	
	
	
	//query existing file_name
	/*$x_file_name_query = mysql_query("SELECT a_img FROM article_mst WHERE article_id='$article_id'");
	$x_file_name_row = mysql_fetch_array($x_file_name_query);
	$x_file_name = $x_file_name_row[0];*/
	
	//query existing img
	$query = $con->prepare("SELECT a_img FROM article_mst WHERE article_id=:article_id");
	$query->execute(array(':article_id'=>$article_id));
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$exist_img = $query['a_img'];			
	
	$img_type = $_FILES["file_name"]["type"];
	$img_size = $_FILES["file_name"]["size"];
	$img_tmp = $_FILES["file_name"]["tmp_name"];
	$tmp_size = filesize($_FILES["file_name"]["tmp_name"]);				
	$img_error = $_FILES["file_name"]["error"];
	define("MAX_SIZE", "1000");//Kb

	$allowedExt = array("png","jpeg","jpg","gif");
	//$extension = strtolower (substr ($file_name, strpos($file_name, '.') + 1)); // just show the file extension in lowercase
	$temp = explode(".", $_FILES["file_name"]["name"]);
	$extension = end($temp);//$ext = getExtension($file_name);
	$extension = strtolower($extension);
	$array_match = in_array($extension, $allowedExt);												
	
	//new image name 
	if(!empty($file_name)){
		$new_img = md5(time().$file_name).'.'.$extension;
	}else{
		$new_img = '';	
	}
	
	//Empty check usng array
	$required_fields = array('a_code', 'a_title', 'ad_head', 'ad_article');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			echo  'Fields marked with an asterisk are required./e';
			$error = 1; //for check
			break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
		}
	}			
	
	if(empty($error) === true){
		if(!empty($file_name)){
			if(( ($extension != "gif")
				|| ($extension != "jpeg")
				|| ($extension != "jpg")
				|| ($extension != "png") )
				&& !$array_match){
				echo $extension." - is not support for upload./e";
			}elseif($tmp_size >(MAX_SIZE*1024)){
				echo number_format(($file_name_size/1024),2)."Kb, is Big size file, Not upload./e";
			}else{  //unlink() file_exists()
				if(empty($article_id)){
					
					$insert = mysql_query("INSERT INTO article_mst VALUES ('','$art_cat_id','$a_code','$a_title','$a_desc','$a_comment','$a_status','$a_pdate','','$new_img' ) ");						
					if(!$insert){
						echo "Opps! Data not Inserted./e";
					}else{
						$last_inserted_id = mysql_insert_id();
						if(!empty($last_inserted_id) ){
							$values =array();
							if(isset($_POST['ad_head'])){
								foreach($_POST['ad_head'] AS $key=>$ad_head){
									@$ad_head = mysql_real_escape_string(htmlentities(input_validation($ad_head)));
									//$ad_article = mysql_real_escape_string(htmlentities(input_validation($_POST['ad_article'][$key])));
									$ad_article = $_POST['ad_article'][$key];
									$values[] = "('','$last_inserted_id','$ad_head','$ad_article','')";
								}
							}
							//$values = implode(',', $values); //print_r($values);
							$join_query = mysql_query("INSERT INTO article_dtl (art_dtl_id, article_id, ad_head, ad_article, ad_img) 
											VALUES ".implode(',', $values) );
							if(!$join_query){
								echo "Opps! something was wrong for Inserting join table./e";
							}else{													
								upload_img(@$img_tmp, '../../files/article/'.$exist_img, '../../files/article/'.$new_img); //upload Images		
								
								//for user log;
								if($allow_log == 1){
									$remark = 'New article added';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
															
								echo "Data was inserted Successful!";
							}
						}else{
							echo 'Iast ID is empty./e';
						}
					}//end item insert check											
				}else{//if article_id not empty					
					$update = mysql_query("UPDATE article_mst SET
										art_cat_id='$art_cat_id', a_code='$a_code', a_title='$a_title', a_desc='$a_desc',
										a_comment='$a_comment', a_status='$a_status', a_pdate='$a_pdate', a_mdate=NOW(), a_img='$new_img' 
										WHERE article_id = '$article_id'");
					if(!$update){
						echo "Opps! Data not updated./e";
					}else{
						$delete_join = mysql_query("DELETE FROM article_dtl WHERE article_id = '$article_id'");
						if(!$delete_join){
							echo 'Opps! join data not deleted';
						}else{
							$values =array();
							foreach($_POST['ad_head'] AS $key=>$ad_head){
								@$ad_head = mysql_real_escape_string(htmlentities(input_validation($ad_head)));
								$ad_article = mysql_real_escape_string(htmlentities(input_validation($_POST['ad_article'][$key])));;
								$values[] = "('','$article_id','$ad_head','$ad_article','')";
							}							
							//$values = implode(',', $values); //print_r($values);
							$join_query = mysql_query("INSERT INTO article_dtl (art_dtl_id, article_id, ad_head, ad_article, ad_img) 
											VALUES ".implode(',', $values) );
							if(!$join_query){
								echo "Opps! something was wrong for Inserting join table./e";
							}else{
								upload_img(@$img_tmp, '../../files/article/'.$exist_img, '../../files/article/'.$new_img); //upload Images	
								
								//for user log;
								if($allow_log == 1){
									$remark = 'Article Updated';
									insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
								}	
													
								echo "Data was updated Successful!";
							}
						}//end Delete join
					}						
				}//end first article_id check
			}//end extention check
		}elseif(empty($file_name)){
			if(empty($article_id)){
				$insert = mysql_query("INSERT INTO article_mst VALUES ('','$art_cat_id','$a_code','$a_title','$a_desc','$a_comment','$a_status','$a_pdate','','$file_name' ) ");						
				if(!$insert){
					echo "Opps! Data not Inserted./e";
				}else{								
					$last_inserted_id = mysql_insert_id();
					if(!empty($last_inserted_id) ){
						$values =array();
						if(isset($_POST['ad_head'])){
							foreach($_POST['ad_head'] AS $key=>$ad_head){
								@$ad_head = mysql_real_escape_string(htmlentities(input_validation($ad_head)));
								$ad_article = mysql_real_escape_string(htmlentities(input_validation($_POST['ad_article'][$key])));;
								$values[] = "('','$last_inserted_id','$ad_head','$ad_article','')";
							}
						}
						//$values = implode(',', $values); //print_r($values);
						$join_query = mysql_query("INSERT INTO article_dtl (art_dtl_id, article_id, ad_head, ad_article, ad_img) 
										VALUES ".implode(',', $values) );
						if(!$join_query){
							echo "Opps! something was wrong for Inserting join table./e";
						}else{													
							//upload_img(@$img_tmp, '../../files/article/'.$exist_img, '../../files/article/'.$new_img); //upload Images	
							
							//for user log;
							if($allow_log == 1){
								$remark = 'New article added';
								insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
							}
														
							echo "Data was inserted Successful!";
						}
					}else{
						echo 'Iast ID is empty./e';
					}
				}//end item insert check							
			}else{//if article_id not empty
				$update = mysql_query("UPDATE article_mst SET
										art_cat_id='$art_cat_id', a_code='$a_code', a_title='$a_title', a_desc='$a_desc',
										a_comment='$a_comment', a_status='$a_status', a_pdate='$a_pdate', a_mdate=NOW(), a_img='$exist_img' 
										WHERE article_id = '$article_id'");
				if(!$update){
					echo "Opps! Data not updated./e";
				}else{
					$delete_join = mysql_query("DELETE FROM article_dtl WHERE article_id = '$article_id'");
					if(!$delete_join){
						echo 'Opps! join data not deleted';
					}else{
						$values =array();
						foreach($_POST['ad_head'] AS $key=>$ad_head){
							@$ad_head = mysql_real_escape_string(htmlentities(input_validation($ad_head)));
							$ad_article = mysql_real_escape_string(htmlentities(input_validation($_POST['ad_article'][$key])));;
							$values[] = "('','$article_id','$ad_head','$ad_article','')";
						}							
						//$values = implode(',', $values); //print_r($values);
						$join_query = mysql_query("INSERT INTO article_dtl (art_dtl_id, article_id, ad_head, ad_article, ad_img) 
										VALUES ".implode(',', $values) );
						if(!$join_query){
							echo "Opps! something was wrong for Inserting join table./e";
						}else{
							//for user log;
								if($allow_log == 1){
									$remark = 'Article Updated';
									insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
								}
														
							echo "Data was updated Successful!";
						}
					}//end Delete join					
				}
						
			}//end second article_id check
		}//end file_name check							
							
	}//*///end empty error	check
}

?>