<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con); 
	$page_code = 153; //Fixed Page Code
	require_once '../../core/page_setup.php';
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
    	<div class="form_area" style="width:700px; height:490px;">
        	<?php require_once '../form/add_admin_user_form.php'; ?>             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>