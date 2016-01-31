<?php
	require_once '../../core/init.php';
	protect_page(); 
	only_for_admin($con);
	$page_code = 154; //Fixed Page Code
	require_once '../../core/page_setup.php';
	
	require_once '../script/edit_user_script.php'; //script for member page
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
    	<div class="form_area" style="width:700px; height:400px;"> 
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
                   	      	
            <div id="tab_manu">
                <ul id="tabs">
                	<li><a href="#list_view">List View</a></li>
                    <li><a href="#edit_user_form">Add Edit</a></li>                                          
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
            	<?php require_once '../form/users_search_form.php'; ?> 
                <?php require_once '../data_view/edit_user_data_view.php'; ?><!--Config page List Data view -->
            </div>
            
            <div id="edit_user_form" class="tab_section">
					<?php require_once '../form/edit_user_form.php'; ?> 
            </div>
                        
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>