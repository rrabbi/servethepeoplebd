<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 157; //Fixed Page Code
	require_once '../../core/page_setup.php';	
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area" style="">
    	<div class="form_area" style="width:450px; height:380px;">
        	<?php require_once '../form/reset_password_search_form.php';?>
    		<?php require_once '../form/reset_password_form.php';?>
        </div><!--End form_area-->
    </div><!--end contents_area-->
        

<?php require_once '../../includes/all_footer.php'; ?>