<?php
//Auto generate Item code
	$max_id_query = mysql_fetch_array(mysql_query("SELECT MAX(item_id) FROM item_mst"));
	//echo $max_id_query[0];
	$get_last_code = mysql_fetch_array(mysql_query("SELECT i_code FROM item_mst WHERE item_id = '$max_id_query[0]'"));
	//echo $get_last_code[0];
	$code_array = preg_split('/(?<=\d)(?=[A-Z])|(?<=[A-Z])(?=\d)/i', $get_last_code[0]);
	$char_part = $code_array[0];
	@$num_part = $code_array[1];
	$new_num = $num_part + 1;
	if (strlen($new_num) == 1){
		$new_code = $char_part.'00'.$new_num; //first time generate 001 number
	}elseif(strlen($new_num) == 2){
		$new_code = $char_part.'0'.$new_num;
	}elseif(strlen($new_num) >= 3){
		$new_code = $char_part.$new_num;
	}

//geting value
	if(isset($_GET['item_id'])){ 
		@$item_id = mysql_real_escape_string(htmlentities(input_validation($_GET['item_id'])));
		$_SESSION['session_item_id'] = $item_id;
		
		//query item
		$item_query = $con->prepare("SELECT * FROM item_mst WHERE item_id=:item_id");
		$item_query->execute(array(':item_id'=>$item_id));
		$item_query = $item_query->fetch(PDO::FETCH_ASSOC);
			$item_type_id = $item_query['item_type_id'];
			$i_code = $item_query['i_code'];
			$i_name = $item_query['i_name'];
			$i_details = $item_query['i_details'];
			$i_available = $item_query['i_available'];
			$i_price = $item_query['i_price'];
			$i_quantity = $item_query['i_quantity'];
			$brand_id = $item_query['brand_id'];
			$i_user_type_id = $item_query['i_user_type_id'];
			$i_img = $item_query['i_img'];
		
		//query category and sub-category of item
		$item_sub_cat_query = $con->prepare("SELECT isc.i_sub_cat_id, isc.i_cat_id
								FROM item_sub_category AS isc
								INNER JOIN j_item_sub_cat AS jisc ON jisc.i_sub_cat_id = isc.i_sub_cat_id
								WHERE jisc.item_id=:item_id");
		$item_sub_cat_query->execute(array(':item_id'=>$item_id));
		$item_sub_cat_query = $item_sub_cat_query->fetch(PDO::FETCH_ASSOC);
			$i_sub_cat_id = $item_sub_cat_query['i_sub_cat_id']; //sub-category
			$i_cat_id = $item_sub_cat_query['i_cat_id']; //category
			
		//query item attribute based on sub-category
		$item_attrib_value_query = $con->prepare("SELECT jiav.i_attrib_id, jiav.attribe_value, jiav.attribe_sirial, ia.attribute_name
								FROM j_item_attrib_value AS jiav
								INNER JOIN item_attribute AS ia ON ia.i_attrib_id = jiav.i_attrib_id
								WHERE jiav.item_id=:item_id");
		$item_attrib_value_query->execute(array(':item_id'=>$item_id));
		//$item_attrib_value_query = $item_attrib_value_query->fetch(PDO::FETCH_ASSOC);
	
	}elseif(isset($_SESSION['session_item_id'])){
		@$item_id = mysql_real_escape_string(htmlentities(input_validation($_SESSION['session_item_id'])));
		
		//query item
		$item_query = $con->prepare("SELECT * FROM item_mst WHERE item_id=:item_id");
		$item_query->execute(array(':item_id'=>$item_id));
		$item_query = $item_query->fetch(PDO::FETCH_ASSOC);
			$i_code = $item_query['i_code'];
			$i_name = $item_query['i_name'];
			$i_details = $item_query['i_details'];
			$i_available = $item_query['i_available'];
			$i_price = $item_query['i_price'];
			$i_quantity = $item_query['i_quantity'];
			$brand_id = $item_query['brand_id'];
			$i_user_type_id = $item_query['i_user_type_id'];
			$i_img = $item_query['i_img'];
		
		//query category and sub-category of item
		$item_sub_cat_query = $con->prepare("SELECT isc.i_sub_cat_id, isc.i_cat_id
								FROM item_sub_category AS isc
								INNER JOIN j_item_sub_cat AS jisc ON jisc.i_sub_cat_id = isc.i_sub_cat_id
								WHERE jisc.item_id=:item_id");
		$item_sub_cat_query->execute(array(':item_id'=>$item_id));
		$item_sub_cat_query = $item_sub_cat_query->fetch(PDO::FETCH_ASSOC);
			$i_sub_cat_id = $item_sub_cat_query['i_sub_cat_id']; //sub-category
			$i_cat_id = $item_sub_cat_query['i_cat_id']; //category
			
		//query item attribute based on sub-category
		$item_attrib_value_query = $con->prepare("SELECT jiav.i_attrib_id, jiav.attribe_value, jiav.attribe_sirial, ia.attribute_name
								FROM j_item_attrib_value AS jiav
								INNER JOIN item_attribute AS ia ON ia.i_attrib_id = jiav.i_attrib_id
								WHERE jiav.item_id=:item_id");
		$item_attrib_value_query->execute(array(':item_id'=>$item_id));
		//$item_attrib_value_query = $item_attrib_value_query->fetch(PDO::FETCH_ASSOC);
	}
		
//Querry for data view
	$query_item = "SELECT i.item_id, i.i_code, i.i_name, i.i_available, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category, it.item_type
					FROM item_mst AS i
					INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
					INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
					INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
					INNER JOIN item_type_mst AS it ON it.item_type_id =i.item_type_id
					LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
					LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id					
					ORDER BY i.item_id";
					//LIMIT $start_from, $rows_per_page";									
	$item_list = mysql_query($query_item);


	
?>