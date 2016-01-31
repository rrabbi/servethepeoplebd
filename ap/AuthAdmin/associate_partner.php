<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 220; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//get data
	if (isset($_GET['asso_partner_id'])){
		$asso_partner_id = mysql_real_escape_string(htmlentities(input_validation($_GET['asso_partner_id'])));
				
		$query = $con->prepare("SELECT * FROM associate_partner WHERE asso_partner_id=:asso_partner_id");
		$query->execute(array(':asso_partner_id'=>$asso_partner_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);
			$associate_type_id = $result['associate_type_id'];		
			$asso_partner_name = $result['asso_partner_name'];
			$asso_partner_details = $result['asso_partner_details'];
			$asso_partner_contact = $result['asso_partner_contact'];
			$asso_partner_url = $result['asso_partner_url'];
			$asso_partner_status = $result['asso_partner_status'];
			$asso_partner_img = $result['asso_partner_img'];				
	}			
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
        <div class="form_area" style="width:700px; height:470px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">List list</a></li>
                    <li><a href="#add_edit_associate_partner_form">Associate partner Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/associate_partner_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_associate_partner_form" class="tab_section">
            	<?php require_once '../form/associate_partner_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>