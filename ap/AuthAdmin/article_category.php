<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 202; //Fixed Page Code
	require_once '../../core/page_setup.php';
	
	//get data
	if(isset($_GET['art_cat_id'])){ 
		$art_cat_id = $_GET['art_cat_id'];	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM article_category WHERE art_cat_id = '$art_cat_id'"));
			$ac_name = $query['ac_name'];
			$ac_code = $query['ac_code'];
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
                    <li><a href="#list_view">Article category List</a></li>
                    <li><a href="#add_edit_article_cat_form">Article category Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/article_cat_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_article_cat_form" class="tab_section">
            	<?php require_once '../form/article_cat_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>