<?php // Start page Navigation
	
	//$self = ''; //for test
	if(isset($_GET['SubCatName'])){
		$self = $_SERVER['PHP_SELF'].'?type=OurProduct&SubCatName='.$_GET['SubCatName'].'&';
	}elseif(isset($_GET['CatName'])){
		$self = $_SERVER['PHP_SELF'].'?type=OurProduct&CatName='.$_GET['CatName'].'&';
	}else{
		$self = $_SERVER['PHP_SELF'].'?type=OurProduct&';	
	}
	
	$rows_per_page =5;

	if (isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}else {
		$pageNum = 1; // by default we show first page
	}
	
	$start_from = ($pageNum - 1) * $rows_per_page;
	
	if( isset($_GET['SubCatName']) OR isSet($_COOKIE['_scn']) ){
		if(!empty($_GET['SubCatName'])){
			$SubCatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['SubCatName'])));
		}elseif(!empty($_COOKIE['_scn'])){
			$SubCatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_scn'])));
		}
				
		$query_item = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_price, i.i_details, i.adate, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
						LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
						WHERE isc.sub_category=:sub_category AND i_available=:i_available					
						ORDER BY i.adate DESC
						LIMIT $start_from, $rows_per_page");
		$query_item->execute(array(':sub_category'=>$SubCatName, ':i_available'=>1));
		
		// how many rows we have in database
		$query_count = $con->prepare("SELECT COUNT(i.item_id), isc.sub_category 
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						WHERE isc.sub_category=:sub_category AND i_available=:i_available");
		$query_count->execute(array(':sub_category'=>$SubCatName, ':i_available'=>1));
		$query_count = $query_count->fetch(PDO::FETCH_NUM);
		$number_row = $query_count[0];
		
	}elseif(isset($_GET['CatName']) OR isSet($_COOKIE['_cn']) ){
		if(!empty($_GET['CatName'])){
			$CatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['CatName'])));
		}elseif(!empty($_COOKIE['_cn'])){
			$CatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_cn'])));
		}
		//$CatName = remove_underscore_to_str(mysql_real_escape_string($_GET['CatName']) );
		$query_item = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_price, i.i_details, i.adate, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
						LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
						WHERE ic.i_cat_name=:i_cat_name	AND i_available=:i_available				
						ORDER BY i.adate DESC
						LIMIT $start_from, $rows_per_page");
		$query_item->execute(array(':i_cat_name'=>$CatName, ':i_available'=>1));
		
		// how many rows we have in database
		$query_count = $con->prepare("SELECT COUNT(i.item_id), ic.i_cat_name 
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						WHERE ic.i_cat_name=:i_cat_name AND i_available=:i_available");
		$query_count->execute(array(':i_cat_name'=>$CatName, ':i_available'=>1));
		$query_count = $query_count->fetch(PDO::FETCH_NUM);
		$number_row = $query_count[0];
				
	}else{
		$query_item = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_price, i.i_details, i.adate, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
						LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id
						WHERE i_available=1					
						ORDER BY i.adate DESC
						LIMIT $start_from, $rows_per_page");
		$query_item->execute();
		
		// how many rows we have in database
		$query_count = $con->prepare("SELECT COUNT(item_id) FROM item_mst WHERE i_available=1");
		$query_count->execute();
		$query_count = $query_count->fetch(PDO::FETCH_NUM);
		$number_row = $query_count[0];
	}
	
	// how many rows we have in database
	//$query_count = "SELECT COUNT(item_id) FROM item_mst";
	/*$count_result = mysql_query($query_count);
	@$count_row = mysql_fetch_array($count_result); // also can use mysql_fetch_assoc($count_result);
	$number_row = $count_row[0];*/

	// how many pages we have when using paging?
	$max_page = ceil($number_row/$rows_per_page);
	
		
	// creating previous and next link, plus the link to go straight to the first and last page
	if($pageNum > 1){
		$this_page = $pageNum -1;
		//$prev = "<a href=".$self."?page=".$this_page.">Prev</a>";
		$prev = "<a class='nav_btn' href=".$self."page=".$this_page."> < </a>";
		//$first = "<a href=".$self."?page=1>First Page</a>";
		$first = "<a class='nav_btn' href=".$self."page=1> << </a>";
	}else{
		$prev = '&nbsp;'; // we're on page one, don't print previous link
		$first = '&nbsp;';// nor the first page link
	}
	
	if($pageNum < $max_page){
		$this_page = $pageNum + 1;
		//$next = "<a href=".$self."?page=".$this_page.">Next</a>";
		$next = "<a class='nav_btn' href=".$self."page=".$this_page."> > </a>";
		//$last = "<a href=".$self."?page=".$max_page.">Last Page</a>";
		$last = "<a class='nav_btn' href=".$self."page=".$max_page."> >> </a>";
	}else{
		$next ='&nbsp;';// we're on the last page, don't print next link
		$last ='&nbsp;';	// nor the last page link	
	}
	// End page Navigation
?>