<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 216; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//get data
	if (isset($_GET['brand_id'])){
		$brand_id = mysql_real_escape_string(htmlentities(input_validation($_GET['brand_id'])));
				
		$query = $con->prepare("SELECT * FROM item_brand WHERE brand_id=:brand_id");
		$query->execute(array(':brand_id'=>$brand_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$brand_name = $result['brand_name'];
			$brand_details = $result['brand_details'];
			$brand_img = $result['brand_img'];				
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
                    <li><a href="#list_view">Brand List</a></li>
                    <li><a href="#add_edit_item_brand_form">Brand Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/item_brand_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_item_brand_form" class="tab_section">
            	<?php require_once '../form/item_brand_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>