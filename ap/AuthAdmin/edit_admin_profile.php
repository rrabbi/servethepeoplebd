<?php
	require_once '../../core/init.php';
	protect_page(); 
	$page_code = 155; //Fixed Page Code
	require_once '../../core/page_setup.php';
	
	//get data
	if(isset($_GET['user_id'])){
		$user_id = mysql_real_escape_string(htmlentities(input_validation($_GET['user_id'])));
				
		$query = $con->prepare("SELECT u.user_id, u.username, u.email, ud.user_name, ud.user_dob, ud.user_contact, ud.user_address, ud.user_desc, ud.user_img
						FROM user AS u
						LEFT JOIN user_dtl AS ud ON u.user_id = ud.user_id
						WHERE u.user_id=:user_id");
		$query->execute(array(':user_id'=>$user_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);
			
			$username = $result['username'];
			$email = $result['email'];
			$dob = $result['user_dob'];
			if(!empty($dob)){ $dob = date('d-m-Y',strtotime($dob));} //for prevent default			
			$user_name = $result['user_name'];
			$user_contact = $result['user_contact'];
			$user_address = $result['user_address'];
			$user_desc = $result['user_desc'];
			$user_img = $result['user_img'];
	}
	
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
    	<div class="form_area" style="width:700px; height:460px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">Admin List</a></li>
                    <li><a href="#edit_admin_form">Edit Profile</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
					<?php //require_once '../form/users_search_form.php'; ?> 
                <?php require_once '../data_view/edit_admin_profile_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="edit_admin_form" class="tab_section">
            	<?php require_once '../form/edit_admin_profile_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>