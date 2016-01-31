<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 205; //Fixed Page Code
	require_once '../../core/page_setup.php';
	
	//get data
	if(isset($_GET['slider_type_id'])){ 
		$slider_type_id = $_GET['slider_type_id'];	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM slider_type WHERE slider_type_id = '$slider_type_id'"));
			$st_name = $query['st_name'];
			$st_code = $query['st_code'];
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
                    <li><a href="#list_view">List View</a></li>
                    <li><a href="#add_edit_slider_type_form">Slider type Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/slider_type_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_slider_type_form" class="tab_section">
            	<?php require_once '../form/slider_type_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>