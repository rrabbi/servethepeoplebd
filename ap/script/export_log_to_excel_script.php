<?php
	require_once '../../core/init.php';
?>
<?php
	//if(isset($_POST['export_log_to_excel'])){
		//echo 'OK';
		///*
				
		/*$query = "SELECT u.email AS User, ul.ip AS IP, ul.datetime AS DateTime, ul.log_type AS LogType, ul.remark AS Remark
				FROM user_log AS ul
				INNER JOIN user AS u ON u.user_id = ul.user_id
				ORDER BY ul.datetime DESC
				";*/
		$query ="SELECT u.username AS Username, u.email AS Email, ul.ip AS IP, ul.datetime AS DateTime, ul.remark AS Remark, lt.log_type_name AS LogType
					FROM user_log AS ul
					INNER JOIN user AS u ON u.user_id = ul.user_id
					INNER JOIN log_type AS lt ON lt.log_type_id = ul.log_type
					ORDER BY datetime DESC";
		$header = '';
		$result ='';
		$exportData = mysql_query ($query);
		
		$fields = mysql_num_fields( $exportData );
		
		for ( $i = 0; $i < $fields; $i++ )
		{
			$header .= mysql_field_name( $exportData , $i ) . "\t";
		}
		
		while( $row = mysql_fetch_row( $exportData ) )
		{
			$line = '';
			foreach( $row as $value )
			{                                            
				if ( ( !isset( $value ) ) || ( $value == "" ) )
				{
					$value = "\t";
				}
				else
				{
					$value = str_replace( '"' , '""' , $value );
					$value = '"' . $value . '"' . "\t";
				}
				$line .= $value;
			}
			$result .= trim( $line ) . "\n";
		}
		$result = str_replace( "\r" , "" , $result );
		
		
		if ( $result == "" )
		{
			$result = "\nNo Record(s) Found!\n";                        
		}
		
		//auto_numeber generate
		$auto_generate_numbe = rand(0, 100);
		//$file_name = TODAY_DATE.'-'.$auto_generate_numbe.'-user_log.xls';
		$file_name = TODAY_DATE.'-user_log.xls';
		
		// allow exported file to download forcefully
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$file_name);
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$result";
		
		//*/
	//}



?>