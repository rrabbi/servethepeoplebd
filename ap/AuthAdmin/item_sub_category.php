<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 213; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//require_once '../script/slider_script.php'; //script for member page
	//get data
	if (isset($_GET['i_sub_cat_id'])){
		$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_GET['i_sub_cat_id'])));
				
		$query = $con->prepare("SELECT * FROM item_sub_category WHERE i_sub_cat_id=:i_sub_cat_id");
		$query->execute(array(':i_sub_cat_id'=>$i_sub_cat_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$i_cat_id = $result['i_cat_id'];
			$sub_category = $result['sub_category'];				
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
                    <li><a href="#list_view">Sub category List</a></li>
                    <li><a href="#add_edit_item_sub_cat_form">Sub Category Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/item_sub_category_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_item_sub_cat_form" class="tab_section">
            	<?php require_once '../form/item_sub_category_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>