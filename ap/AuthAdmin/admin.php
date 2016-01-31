<?php
	require_once '../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 150; //Fixed Page Code
	require_once '../core/page_setup.php';	
	require_once '../includes/all_header.php';
?>        
     
    <div id="admin_container" style="margin-top:39px; ">
    	<div id="ap_menu_area" class="nested_menu">
        	<div id="ap_menu_area_top">
            	
            	<div id="tab_manu">
                    <ul id="tabs">
                        <li><a href="#admin_menu">Menu</a></li>
                        <li><a href="#admin_settings">Settings</a></li> 
                        <li><a href="#admin_about">About</a></li>                       
                    </ul>
                </div>
                
                <div id="admin_menu" class="tab_section">
                        <?php include '../includes/admin_nested_menu.php';?>
                </div>          
                
                <div id="admin_settings" class="tab_section">
                    <?php require_once '../includes/admin_nested_settings.php'; ?>
                </div>
                
                <div id="admin_about" class="tab_section">
                    <?php require_once '../includes/admin_nested_about.php'; ?>
                </div>            	
            	
            </div><!--End ap_menu_area_top-->
            
            <div id="ap_menu_area_bottom">
            	More Menu Comming soon
            </div><!--End ap_menu_area_bottom-->
        	
        </div>
        
        <div id="ap_content">     
             
       </div>
       
    </div><!--end admin_container-->
        

<?php require_once '../includes/all_footer.php'; ?>