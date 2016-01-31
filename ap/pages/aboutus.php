<?php
	require_once 'core/init.php';
	$page_code = 106; //Fixed Page Code
	require_once 'core/page_setup.php';	
	require_once 'includes/all_header.php';
?>  
	<section class="page_head_bg">
    	<div class="container" style="padding-top:150px">   
            <div class="row" >
                <div class="col-md-8 col-sm-8 col-xs-9 hidden-xs">  
                    <div class="row"><?php //require_once 'includes/breadcrumbs.php'; ?></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-3 text-right">  
                    <div class="row"><p class="page_title_style">About Us</p></div>
                </div>
            </div>
        </div>
    </section><br><br>
    
    <div class="container">
    	
    	<?php 
			require_once 'aboutus_single.php';
		?>       	
    </div><!--end contant_area-->
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
