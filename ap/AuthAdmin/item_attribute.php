<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 214; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//get data
	if (isset($_GET['i_attrib_id'])){
		$i_attrib_id = mysql_real_escape_string(htmlentities(input_validation($_GET['i_attrib_id'])));
				
		$query = $con->prepare("SELECT * FROM item_attribute WHERE i_attrib_id=:i_attrib_id");
		$query->execute(array(':i_attrib_id'=>$i_attrib_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$attribute_name = $result['attribute_name'];				
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
                    <li><a href="#list_view">Attribute List</a></li>
                    <li><a href="#add_edit_item_attrib_form">Attribute Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/item_attribute_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_item_attrib_form" class="tab_section">
            	<?php require_once '../form/item_attribute_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>