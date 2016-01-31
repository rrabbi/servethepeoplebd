<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 204; //Fixed Page Code
	require_once '../../core/page_setup.php';
	if(isset($_GET['faq_id'])){ 
		$faq_id = mysql_real_escape_string(htmlentities(input_validation($_GET['faq_id'])));	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM faq_mst WHERE faq_id = '$faq_id'"));
			$faq_type = $query['faq_type'];
			$faq_status = $query['faq_status'];
			$faq_question = $query['faq_question'];
			$faq_answer = $query['faq_answer'];			
	}
		
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">
    	<div class="form_area" style="width:550px; height:460px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">FAQ List</a></li>
                    <li><a href="#add_edit_faq_mst_form">FAQ Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/faq_mst_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_faq_mst_form" class="tab_section">
            	<?php require_once '../form/faq_mst_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->
    
    <!--<script>
        $("textarea").cleditor({ controls: "bold italic underline strikethrough" })[0].focus();
    </script>-->    

<?php require_once '../../includes/all_footer.php'; ?>