<?php
	require_once 'core/init.php';
	$page_code = 111; //Fixed Page Code
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
                    <div class="row"><p class="page_title_style">News</p></div>
                </div>
            </div>
        </div>
    </section><br><br>
    <!--<div class="container">   
        <div class="row">
            <div class="col-md-12">  
                <div class="row"><?php //require_once 'includes/breadcrumbs.php'; ?></div>
            </div>
        </div>
    </div>-->  
    <div class="container">
    	<?php 
			if(isset($_GET['ArtTitle'])){
				$ArtTitle = remove_underscore_to_str(mysql_real_escape_string(htmlentities($_GET['ArtTitle'])) );
				if(!empty($ArtTitle)){
					require_once 'news_single.php';
				}
			}else{
				require_once 'news_all.php';
			}
		?>       	
    </div><!--end contant_area-->
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
