<?php
	require_once '../../core/init.php';
?>
<?php
//usset session_item_id
	if(isset($_POST['remove_session_item_id'])){
		if($_POST['remove_session_item_id'] == 1){
			unset($_SESSION['session_item_id']);
		}		
	}
	
//remover item images
	if(isset($_POST['del_img_item_id']) && isset($_POST['del_img_i_img'])){
		$item_id = mysql_real_escape_string($_POST['del_img_item_id']);
		$i_img = mysql_real_escape_string($_POST['del_img_i_img']);
		$query = $con->prepare("DELETE FROM item_images WHERE item_id=:item_id AND i_img=:i_img");
		$query->execute(array(':item_id'=>$item_id, ':i_img'=>$i_img ));
		
		if(@unlink('../../files/items/'.$i_img)){
			echo 1; //for pass data for jquery	
		}
				
	}

//script for selecting sub-category when changed category
	if(isset($_POST['changed_i_cat_id'])){
		$changed_i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['changed_i_cat_id'])));
		$query = $con->prepare("SELECT i_sub_cat_id, sub_category FROM item_sub_category WHERE i_cat_id=".$changed_i_cat_id." ORDER BY sub_category");
		$query->execute();		
		//echo '<select class="input_option" name="select_sub_category" id="select_sub_category">'; //not need
		echo '<option value="0" hidden="hidden"> -- Sub-Category -- </option>';
			while($row = $query->fetch(PDO::FETCH_ASSOC)){				
				echo '<option ';
					//if($i_sub_cat_id == $row['i_sub_cat_id']){echo 'selected="selected"';}
				echo 'value='.$row['i_sub_cat_id'].'>'.$row['sub_category'].'</option>';				
			}
		//echo '</select>';				
	}
	
//script for selecting item attribute when changed sub-category
	if(isset($_POST['changed_i_sub_cat_id'])){
		$changed_i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['changed_i_sub_cat_id'])));
		
		$query = mysql_query("SELECT ia.i_attrib_id, ia.attribute_name FROM item_attribute AS ia
							  INNER JOIN j_sub_cat_attrib AS jsca ON jsca.i_attrib_id = ia.i_attrib_id
							  INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jsca.i_sub_cat_id
							  WHERE jsca.i_sub_cat_id=".$changed_i_sub_cat_id);
		//echo '<fieldset>';
		if(mysql_num_rows($query) != 0){ //if no rows return than nothing will display
			echo '<div style="font-weight:bold; text-align:left">Enter Item Attributes details.....</div></br>';
		}
		while($row = mysql_fetch_array($query)){
			echo '<div class="field">';
				echo '<label>'.$row['attribute_name'].': </label>';
				echo '<input type="hidden" class="input" name="i_attrib_id[]" value="'.$row['i_attrib_id'].'">';
				echo '<div class="data">
						<input type="text" class="a_text" name="attribe_value[]" style="width:200px;">
						<input type="text" class="a_text" name="attribe_sirial[]" style="width:30px;">						
					';
				echo '</div>';
			echo '</div>';	
		}	//*/		
	}
	
//Item search script
	//Instant search for item name 
	if(isset($_POST['instant_search_i_name'])){ //if(isset($_POST['term'])){ //where 'term' is the default keyword in jquery autocomplete api
		$instant_search_i_name = mysql_real_escape_string($_POST['instant_search_i_name']);
					
			$query = $con->prepare("SELECT i_name FROM item_mst WHERE i_name LIKE :instant_search_i_name LIMIT 20 ");
			$query->execute(array(':instant_search_i_name'=> '%'.$instant_search_i_name.'%'));
			//$result = $query->fetch(PDO::FETCH_ASSOC);			
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$results[] = $row['i_name'];
			}
			echo json_encode($results);//			
	}
	//search for username from search_i_name or date_of_birth (dob)
		if(isset($_POST['search_i_name']) && isset($_POST['i_cat_id']) && isset($_POST['i_sub_cat_id']) && isset($_POST['brand_id'])){
			$search_i_name = mysql_real_escape_string(htmlentities(input_validation($_POST['search_i_name'])));
			$i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_cat_id'])));
			$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_sub_cat_id'])));
			$brand_id = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_id'])));		
			//$user_id = get_user_id_from_search_i_name($con, $search_i_name);			
			
			//single item
			if(!empty($search_i_name) && empty($i_cat_id) && empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE i.i_name LIKE :i_name");
				$query->execute(array(':i_name'=>'%'.$search_i_name.'%'));				
					
						
			}elseif(empty($search_i_name) && !empty($i_cat_id) && empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id");
				$query->execute(array(':i_cat_id'=>$i_cat_id));
				
			}elseif(empty($search_i_name) && empty($i_cat_id) && !empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE isc.i_sub_cat_id=:i_sub_cat_id");
				$query->execute(array(':i_sub_cat_id'=>$i_sub_cat_id));
				
			}elseif(empty($search_i_name) && empty($i_cat_id) && empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ib.brand_id=:brand_id");
				$query->execute(array(':brand_id'=>$brand_id));
				
			}
			//double item
			elseif(!empty($search_i_name) && !empty($i_cat_id) && empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}elseif(!empty($search_i_name) && empty($i_cat_id) && !empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE isc.i_sub_cat_id=:i_sub_cat_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_sub_cat_id'=>$i_sub_cat_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}elseif(!empty($search_i_name) && empty($i_cat_id) && empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ib.brand_id=:brand_id AND i.i_name LIKE :i_name");
				$query->execute(array(':brand_id'=>$brand_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}elseif(empty($search_i_name) && !empty($i_cat_id) && !empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND isc.i_sub_cat_id=:i_sub_cat_id");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':i_sub_cat_id'=>$i_sub_cat_id));
				
			}elseif(empty($search_i_name) && !empty($i_cat_id) && empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND ib.brand_id=:brand_id");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':brand_id'=>$brand_id));
				
			}elseif(empty($search_i_name) && empty($i_cat_id) && !empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE isc.i_sub_cat_id=:i_sub_cat_id AND ib.brand_id=:brand_id");
				$query->execute(array(':i_sub_cat_id'=>$i_sub_cat_id, ':brand_id'=>$brand_id));
				
			}
			//triple itme
			elseif(!empty($search_i_name) && !empty($i_cat_id) && !empty($i_sub_cat_id) && empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND isc.i_sub_cat_id=:i_sub_cat_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':i_sub_cat_id'=>$i_sub_cat_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}elseif(!empty($search_i_name) && !empty($i_cat_id) && empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND ib.brand_id=:brand_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':brand_id'=>$brand_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}elseif(empty($search_i_name) && !empty($i_cat_id) && !empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND isc.i_sub_cat_id=:i_sub_cat_id AND ib.brand_id=:brand_id");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':i_sub_cat_id'=>$i_sub_cat_id, ':brand_id'=>$brand_id));
				
			}elseif(!empty($search_i_name) && empty($i_cat_id) && !empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE isc.i_sub_cat_id=:i_sub_cat_id AND ib.brand_id=:brand_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_sub_cat_id'=>$i_sub_cat_id, ':brand_id'=>$brand_id, ':i_name'=>'%'.$search_i_name.'%'));
				
			}
			elseif(!empty($search_i_name) && !empty($i_cat_id) && !empty($i_sub_cat_id) && !empty($brand_id) ){
				$query = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_img, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
					WHERE ic.i_cat_id=:i_cat_id AND isc.i_sub_cat_id=:i_sub_cat_id AND ib.brand_id=:brand_id AND i.i_name LIKE :i_name");
				$query->execute(array(':i_cat_id'=>$i_cat_id, ':i_sub_cat_id'=>$i_sub_cat_id, ':brand_id'=>$brand_id, ':i_name'=>'%'.$search_i_name.'%'));
							
			}elseif( empty($search_i_name) && empty($i_cat_id) && empty($i_sub_cat_id) && empty($brand_id) ){
				return false;
			}
			
			if($query->rowCount() == 0){
				echo '<div style="width:100%; text-align:center; color:red;"><h2>No result found.</h2></div>';	
			}else{
				echo '<table class="table">
					<tr class="table_head">
						<!--<td style="width:2%">ID</td>--> 
						<td style="width:5%">Code</td>
						<td style="width:10%">Type</td>
						<td style="width:15%">Name</td>
						<td style="width:5%">Available</td>
						<td style="width:10%">Category</td>
						<td style="width:10%">Sub-Cat</td>                          
						<td style="width:5%"><strong>Option</strong></td>
					</tr>';
					while ($row1 = $query->fetch(PDO::FETCH_ASSOC) ){
						echo '<tr class="table_data">';
						//echo 	'<td class="center_text">'.$row1['item_id'].'</td>';
						echo 	'<td class="center_text">'.$row1['i_code'].'</td>';
						echo 	'<td class="center_text">'.$row1['item_type'].'</td>';
						echo 	'<td class="center_text">'.$row1['i_name'].'</td>';
						echo 	'<td class="center_text">';
							if($row1['i_available'] == 1){echo 'Yes';}elseif($row1['i_available'] == 0){echo 'No';}
						echo '</td>';
						echo 	'<td class="center_text">'.$row1['i_cat_name'].'</td>';
						echo 	'<td class="center_text">'.$row1['sub_category'].'</td>';
						/*echo 	'<td class="center_text"><img style="width:80px; height:30px;" src="';
							if(!empty($row1['i_img'])){ echo '../../files/items/'.$row1['i_img'];}else{ echo NO_IMG;}
						echo '"/></td>';*/
						echo '<td style="width:40px" class="center_text">
								<a class="edit_link" href="item_mst.php?item_id='.$row1['item_id'].'" title="Edit"> <img src="'.EDIT.'" alt="Edit"> </a>
							  </td>';
						echo '</tr>';	
					}
				echo '</table>';
			}
		}
	//End user_log search script*/

?>