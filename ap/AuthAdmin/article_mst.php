<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 203; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//require_once '../script/article_mst_script.php'; //script for article mst
	if(isset($_GET['article_id'])){ 
		$article_id = mysql_real_escape_string(htmlentities(input_validation($_GET['article_id'])));	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM article_mst WHERE article_id = '$article_id'"));
			$art_cat_id = $query['art_cat_id'];
			$a_code = $query['a_code'];
			$a_title = $query['a_title'];
			$a_desc = $query['a_desc'];
			$a_pdate = $query['a_pdate'];
			$a_comment = $query['a_comment'];
			$a_status = $query['a_status'];
			$file_name = $query['a_img'];			
	}
		
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">
    	<div class="form_area" style="width:700px; height:480px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">Article List</a></li>
                    <li><a href="#add_edit_article_mst_form">Article Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/article_mst_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_article_mst_form" class="tab_section">
            	<?php require_once '../form/article_mst_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->
    
    <!--<script>
        $("textarea").cleditor({ controls: "bold italic underline strikethrough" })[0].focus();
    </script>-->    

<?php require_once '../../includes/all_footer.php'; ?>