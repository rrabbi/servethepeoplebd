<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 217; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//get data
	if (isset($_GET['i_user_type_id'])){
		$i_user_type_id = mysql_real_escape_string(htmlentities(input_validation($_GET['i_user_type_id'])));
				
		$query = $con->prepare("SELECT * FROM item_user_type WHERE i_user_type_id=:i_user_type_id");
		$query->execute(array(':i_user_type_id'=>$i_user_type_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$i_user_type = $result['i_user_type'];				
	}			
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
        <div class="form_area" style="width:450px; height:430px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">List view</a></li>
                    <li><a href="#add_edit_item_user_type_form">Item user type update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/item_user_type_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_item_user_type_form" class="tab_section">
            	<?php require_once '../form/item_user_type_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>