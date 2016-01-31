<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 181; //Fixed Page Code
	require_once '../../core/page_setup.php';	
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area" style="">
    	<div class="form_area" style="width:900px; height:440px;">
        	<div class="control_link_style">
            	<a onclick="refresh();">Refresh</a>
            	<a onclick="ExportLogToExcel();" >Export to Excel</a><!--<a href="../script/export_log_to_excel_script.php" >Export to Excel</a>-->
                <a onclick="ClearAllLog();">Clear all Log</a>        
            </div>
            
    		<div id="tab_manu">
                <ul id="tabs">                	
                    <li><a href="#login_user_log">Login Log</a></li>
                    <li><a href="#all_user_log">All Log</a></li> 
                    <li><a href="#total_user_count">Users</a></li>                     
                </ul>
            </div>
            
            <div id="login_user_log" class="tab_section">
                <?php require_once '../data_view/login_user_log_view.php'; ?><!--Config page List Data view -->                
            </div>
            
            <div id="all_user_log" class="tab_section">
            	<?php require_once '../form/user_log_search_form.php'; ?> 
                <?php require_once '../data_view/all_user_log_view.php'; ?><!--Config page List Data view -->                
            </div>
            
            <div id="total_user_count" class="tab_section">
				<?php require_once '../data_view/user_count_data_view.php'; ?>
            </div> 
            
        </div><!--End form_area-->
    </div><!--end contents_area-->
        

<?php require_once '../../includes/all_footer.php'; ?>