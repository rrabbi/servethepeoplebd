<?php
	require_once 'core/init.php';
	$page_code = 103; //Fixed Page Code
	require_once 'core/page_setup.php';
	require_once 'product_script.php'; //script for member page	
	require_once 'includes/all_header.php';
?>   
	<div class="container">   
    	<div class="row">
        	<div class="col-md-12">  
     			<div class="row"><?php require_once 'includes/breadcrumbs.php'; ?></div>
            </div>
     	</div>
     </div> 
    <div class="container">
    	<?php 
			if(isset($_GET['ItemName'])){
				//$ItemName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['ItemName'])));
				$ItemName = remove_underscore_to_str($_GET['ItemName']);
				require_once 'product_single.php';
			/*	
			}elseif(isset($_GET['CatName'])){
				$CatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['CatName'])) );
				require_once 'product_category.php';
			}elseif(isset($_GET['SubCatName'])){
				$SubCatName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['SubCatName'])) );
				require_once 'product_sub_category.php';
				*/
			}else{
				require_once 'product_all.php';
			}
		
		?>       	
    </div><!--end container-->
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
