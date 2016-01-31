<?php 
	require_once 'core/init.php';
	$page_code = 125; //Fixed Page Code
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
                    <div class="row"><p class="page_title_style">Not found</p></div>
                </div>
            </div>
        </div>
    </section><br><br>
	
	<div class="container">
    	
        <br><br>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
            	<div class="row">
                	<div class="col-md-6">
                    	<div class="row">
                        	<div class="col-md-12">
								<?php  ?> 
                                 <h2 class="text-muted">Page Not Found.</h2>  
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                        	<div class="col-md-12">
                            	Go back to <a href="/">home</a> page OR 
                                <a href="<?php echo LOGIN_PAGE; ?>">Sign In</a>
                            </div>
                        </div>
                        
                    </div><!--form-->
                	<div class="col-md-6">
                    	<?php require_once 'auth_instruction.php'; ?> 
                    </div><!--instruction-->
                </div><!--end row-->            	            
            </div>
        </div><!--Login form area-->    
    </div><!--End container-->
    <br><br>
<?php 
	require_once 'includes/all_footer.php'; 
?>