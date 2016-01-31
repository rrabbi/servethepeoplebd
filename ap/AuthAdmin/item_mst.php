<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 211; //Fixed Page Code
	require_once '../../core/page_setup.php';
	require_once '../script/item_mst_script.php'; //script for member page				
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
        <div class="form_area" style="width:800px; height:480px;">
        	<div class="control_link_style">
            	<a class="remove_session_item_id" onclick="Refresh();">Refresh</a> 
                <?php //@print_r($_SESSION['session_item_id']); print_r($_SESSION['user_id']);?>       
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">Items List</a></li>
                    <li><a href="#add_edit_item_form">Item Update</a></li>
                    <li><a href="#add_edit_item_images">Item Images</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php 
					require_once '../form/item_mst_search_form.php';
					require_once '../data_view/item_mst_data_view.php'; 
				?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_item_form" class="tab_section">
            	<?php require_once '../form/item_mst_form.php'; ?>
            </div> 
            
             <div id="add_edit_item_images" class="tab_section">
             	<div class="tab_section_split_area">
                	<?php require_once '../form/item_mst_image_form.php'; ?>
                </div>
                <div class="tab_section_split_area">
                	<?php require_once '../data_view/item_mst_image_data_view.php'; ?>
                </div>            	
            </div>  
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>