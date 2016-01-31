<div class="data_list_content" style="max-height:360px; overflow:auto;">
    <table class="table">
        <tr class="table_head">        	
            <!--<td style="width:5%">Username</td>-->
            <td style="width:7%">Username</td>
            <td style="width:20%">Email</td>  
            <td style="width:25%">Date Time</td>           
            <td style="width:15%">IP</td>
            <td style="width:7%">LogType</td>
            <td style="width:30%">Remark</td>
        </tr>                                               
        <?php						
            //$query ="SELECT * FROM user_log WHERE log_type=1 OR  log_type=2 ORDER BY datetime DESC";
			$query ="SELECT ul.user_id, ul.ip, ul.remote_host, ul.log_type, ul.datetime, ul.remark, lt.log_type_name
					FROM user_log AS ul
					INNER JOIN log_type AS lt ON lt.log_type_id = ul.log_type
					WHERE ul.log_type=1 OR  ul.log_type=2
					ORDER BY datetime DESC";
			$query_list = mysql_query($query);				
            while ($row = mysql_fetch_array($query_list)){
                echo '<tr class="table_data">';
				echo 	'<td>'.display_username_from_user_id($con, $row['user_id']).'</td>';           
                echo 	'<td>'.display_email_from_user_id($con, $row['user_id']).'</td>';
                echo 	'<td>'.show_date_time($row['datetime']).'</td>';
				echo 	'<td>'.$row['ip'].'</td>';
                echo 	'<td>'.$row['log_type_name'].'</td>';		
				echo 	'<td>'.$row['remark'].'</td>';                
                echo '</tr>';	
            } // */					
        ?>
    </table>                                	               
</div><!--End data_list_content-->
