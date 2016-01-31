<!--<div class="data_list_head"><h3> Page List</h3></div>-->
<div class="data_list_content" style="max-height:350px">
    <table class="table">
        <tr class="table_head">
            <td style="width:50%">Role</td> 
            <td style="width:50%">Count</td>
        </tr>                                               
        <tr class="table_data">
        	<?php 		
				$query_admin = $con->prepare("SELECT COUNT(user_id) AS total FROM user WHERE role=:role");
				$query_admin->execute(array(':role'=> 1));
				$result_admin = $query_admin->fetch(PDO::FETCH_ASSOC); //echo $result_admin['total'];
				echo 	'<td style="padding:5px;">Total Number of \'ADMIN\' role: </td>';
				echo 	'<td>'.$result_admin['total'].'</td>';
			?>
        </tr>
        <tr class="table_data">
        	<?php 		
				/*$query_employer = $con->prepare("SELECT COUNT(user_id) AS total FROM user WHERE role=:role");
				$query_employer->execute(array(':role'=> 2));
				$result_employer = $query_employer->fetch(PDO::FETCH_ASSOC); //echo $result_admin['total'];
				echo 	'<td style="padding:5px;">Total Number of \'Employer\' role: </td>';
				echo 	'<td>'.$result_employer['total'].'</td>';*/
			?>
        </tr>
        <tr class="table_data">
        	<?php 		
				/*$query_user = $con->prepare("SELECT COUNT(user_id) AS total FROM user WHERE role=:role");
				$query_user->execute(array(':role'=> 3));
				$result_user = $query_user->fetch(PDO::FETCH_ASSOC); //echo $result_admin['total'];
				echo 	'<td style="padding:5px;">Total Number of \'User\' role: </td>';
				echo 	'<td>'.$result_user['total'].'</td>';*/
			?>
        </tr>
        <tr class="table_data">
        	<?php 		
				$query_total = $con->prepare("SELECT COUNT(user_id) AS total FROM user");
				$query_total->execute();
				$result_total = $query_total->fetch(PDO::FETCH_ASSOC); //echo $result_admin['total'];
				echo 	'<td style="padding:5px;">Total Number of users: </td>';
				echo 	'<td>'.$result_total['total'].'</td>';
			?>
        </tr>
		
    </table>                                	               
</div><!--End data_list_content-->
