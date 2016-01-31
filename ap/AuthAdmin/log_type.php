<?php
	require_once '../../core/init.php';
	protect_page(); 
	only_for_admin($con);
	$page_code = 162; //Fixed Page Code
	require_once '../../core/page_setup.php';
	
	//require_once '../script/edit_user_script.php'; //script for member page
	if(isset($_GET['log_type_id'])){
		$log_type_id = mysql_real_escape_string(htmlentities(input_validation($_GET['log_type_id'])));
				
		$query = $con->prepare("SELECT * FROM log_type WHERE log_type_id=:log_type_id");
		$query->execute(array(':log_type_id'=>$log_type_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$log_type_name = $result['log_type_name'];
	}	
	
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
    	<div class="form_area" style="width:450px; height:420px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
            
        	<div id="tab_manu">
                <ul id="tabs">
                	<li><a href="#log_type_list_view">List View</a></li>
                    <li><a href="#log_type_add_edit">Log type Add/Edit</a></li>                                          
                </ul>
            </div>
            
            <div id="log_type_list_view" class="tab_section">
				<?php require_once '../data_view/log_type_data_view.php'; ?><!--Config page List Data view -->
            </div>
            
            <div id="log_type_add_edit" class="tab_section">
				<?php require_once '../form/log_type_form.php'; ?> 
            </div>          
                                 
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>