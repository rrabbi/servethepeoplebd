<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 215; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//require_once '../script/attrib_sub_cat_manage_script.php'; 
	//get data
	if (isset($_GET['i_sub_cat_id'])){
		$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_GET['i_sub_cat_id'])));
				
		/*$query = $con->prepare("SELECT * FROM item_attribute WHERE i_attrib_id=:i_attrib_id");
		$query->execute(array(':i_attrib_id'=>$i_attrib_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);		
			$attribute_name = $result['attribute_name'];	*/			
	}
				
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
        <div class="form_area" style="width:800px; height:430px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">List View</a></li>
                    <li><a href="#add_edit_attrib_sub_cat_manage">Attrib & Sub-category management</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/attrib_sub_cat_manage_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_attrib_sub_cat_manage" class="tab_section">
            	<div class="tab_section_split_area">
                	<?php require_once '../form/attrib_sub_cat_manage_form.php'; ?>
                </div>
                <div class="tab_section_split_area">
                	<?php require_once '../data_view/attrib_sub_cat_manage_control_data_view.php'; ?>
                </div>
            	
                <!--<div class="search_data_view" style="margin-top:20px"></div>-->
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>