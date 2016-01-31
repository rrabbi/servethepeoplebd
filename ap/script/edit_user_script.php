<?php
	if(isset($_GET['user_id'])){
		$user_id = mysql_real_escape_string(htmlentities(input_validation($_GET['user_id'])));
				
		$query = $con->prepare("SELECT * FROM user WHERE user_id=:user_id");
		$query->execute(array(':user_id'=>$user_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
			$username = $result['username'];
			//$full_name = $result['full_name'];
			$email = $result['email'];
			//$dob = $result['dob'];
			//$dob = date('d-m-Y',strtotime($dob));
			$role = $result['role'];
			$active = $result['active'];
			//$login_attempt = $result['login_attempt'];
			$user_lock = $result['user_lock'];
			$allow_email = $result['allow_email'];
			$tac = $result['tac'];
			$rdate = $result['rdate'];
			$mdate = $result['mdate'];
	}	
?>

<?php // Start page Navigation

	$self = $_SERVER['PHP_SELF'];
	$rows_per_page =20;

	if (isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}else {
		$pageNum = 1; // by default we show first page
	}
	
	$start_from = ($pageNum - 1) * $rows_per_page;
	
	$query = $con->prepare("SELECT * FROM user
								LIMIT $start_from, $rows_per_page");
	$query->execute();								
	
	// how many rows we have in database
	$query_count = "SELECT COUNT(user_id) FROM user";
	$count_result = mysql_query($query_count);
	$count_row = mysql_fetch_array($count_result); // also can use mysql_fetch_assoc($count_result);
	$number_row = $count_row[0];

	// how many pages we have when using paging?
	$max_page = ceil($number_row/$rows_per_page);
	
		
	// creating previous and next link, plus the link to go straight to the first and last page
	if($pageNum > 1){
		$this_page = $pageNum -1;
		$prev = "<a class='nav_btn' href=".$self."?page=".$this_page.">Prev</a>";
		$first = "<a class='nav_btn' href=".$self."?page=1>First Page</a>";
	}else{
		$prev = '&nbsp;'; // we're on page one, don't print previous link
		$first = '&nbsp;';// nor the first page link
	}
	
	if($pageNum < $max_page){
		$this_page = $pageNum + 1;
		$next = "<a class='nav_btn' href=".$self."?page=".$this_page.">Next</a>";
		$last = "<a class='nav_btn' href=".$self."?page=".$max_page.">Last Page</a>";
	}else{
		$next ='&nbsp;';// we're on the last page, don't print next link
		$last ='&nbsp;';	// nor the last page link	
	}
	// End page Navigation
?>
