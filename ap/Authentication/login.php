<?php 
	require_once 'core/init.php';	
	logged_in_redirect($con);
	$page_code = 121; //Fixed Page Code	
	require_once 'core/page_setup.php';
	
	require_once 'ap/script/login_script.php'; //call login_script in top of page ;
		
	require_once 'includes/all_header.php';
?> 
	<section class="page_head_bg">
    	<div class="container" style="padding-top:150px">   
            <div class="row" >
                <div class="col-md-8 col-sm-8 col-xs-9 hidden-xs">  
                    <div class="row"><?php //require_once 'includes/breadcrumbs.php'; ?></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-3 text-right">  
                    <div class="row"><p class="page_title_style">Sign in</p></div>
                </div>
            </div>
        </div>
    </section><br><br>
    
	<div class="container">
    	<div class="row">
        	<div class="col-md-4 col-md-offset-4 text-center">
            	<h2>Sign in</h2>
            </div>
        </div>
        <br><br>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
            	<div class="row">
                	<div class="col-md-6">
                    	<div class="row">
                        	<div class="col-md-12">
								<?php require_once 'ap/form/login_form.php'; ?> 
                                              
                                <span></span><!--Display message using jquery-->  
                                <?php
                                    if(empty($errors) === false){
                                        //echo '<div class="error_message_area"><img src="'.ERROR_ICON.'" />We are tried to log you in, but...... '.output_errors($errors).'</div>';
                                        //echo output_errors($errors);//display errors
                                        echo '<br><div class="row"><div class="col-md-12"><div class="alert alert-danger">
                                                <img style="width:23px;" src="'.ERROR_ICON.'" /> We are tried to log you in, but... '.output_errors($errors).'
                                        </div></div></div>';//display errors
                                    }					
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        	<div class="col-md-12">                        	
                            	<a href="<?php echo FORGOT_PASSWORD_PAGE; ?>">Forgot Password?</a> 
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