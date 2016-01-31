<?php
	require_once 'core/init.php';
	$page_code = 108; //Fixed Page Code
	require_once 'core/page_setup.php';	
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
			if(isset($_GET['AssoName'])){
				$AssoName = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['AssoName'])) );
				if(!empty($AssoName)){
					require_once 'associate_partner_single.php';
				}
			}else{
				require_once 'associate_partner_all.php';
			}
		?>        	
    </div><!--end contant_area-->
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
