<?php
	require_once '../../core/init.php';
	protect_page();
	only_for_admin($con);
	$page_code = 201; //Fixed Page Code
	require_once '../../core/page_setup.php';
	//require_once '../script/slider_script.php'; //script for member page
	//get data
	if(isset($_GET['slider_id'])){
		$slider_id = mysql_real_escape_string(htmlentities(input_validation($_GET['slider_id'])));
		$query = $con->prepare("SELECT * FROM slider WHERE slider_id=:slider_id");
		$query->execute(array(':slider_id'=>$slider_id));
		$query = $query->fetch(PDO::FETCH_ASSOC);
			$slider_type_id = $query['slider_type_id'];
			$s_serial = $query['s_serial'];
			$s_title = $query['s_title'];
			$s_status = $query['s_status'];
			$slider_img = $query['s_img1'];
			//$s_img2 = $query['s_img2'];
			//$s_text1 = $query['s_text1'];
			//$s_text2 = $query['s_text2'];
			//$s_url = $query['s_url'];
			
	}			
	require_once '../../includes/all_header.php';
?>        
     
    <div id="contents_area">        
        <div class="form_area" style="width:700px; height:460px;">
        	<div class="control_link_style">
            	<a onclick="clearForm();">Refresh</a>        
            </div>
        
        	<div id="tab_manu">
                <ul id="tabs">
                    <li><a href="#list_view">Slider List</a></li>
                    <li><a href="#add_edit_slider_form">Slider Update</a></li>                      
                </ul>
            </div>
            
            <div id="list_view" class="tab_section">
                <?php require_once '../data_view/slider_data_view.php'; ?><!--Config page List Data view --> 
            </div>          
            
            <div id="add_edit_slider_form" class="tab_section">
            	<?php require_once '../form/slider_form.php'; ?>
            </div>    
        	             
        </div>
    </div><!--end contant_area-->        

<?php require_once '../../includes/all_footer.php'; ?>