<?php 
	require_once 'core/init.php';
	logged_in_redirect($con);
	$page_code = 123; //Fixed Page Code
	require_once 'core/page_setup.php';
	require_once 'ap/script/recover_script.php';
	require_once 'includes/all_header.php'; 
?> 
	<section class="page_head_bg">
    	<div class="container" style="padding-top:150px">   
            <div class="row" >
                <div class="col-md-8 col-sm-8 col-xs-9 hidden-xs">  
                    <div class="row"><?php //require_once 'includes/breadcrumbs.php'; ?></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-3 text-right">  
                    <div class="row"><p class="page_title_style">Recover login details</p></div>
                </div>
            </div>
        </div>
    </section><br><br>
	
	<div class="container">
        <br><br>
    	<div class="row">
        	<div class="col-md-4 col-md-offset-4 text-center">
            	<h2>Recover Login Details</h2>
            </div>
        </div>
        <br><br>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
            	<div class="row">
                	<div class="col-md-6">
                    	<div class="row">
                        	<div class="col-md-12">
								<?php 
									if(isset($_GET['Success']) === true && empty($_GET['Success']) === true){
										if(!empty($_SESSION['recover_password_email'])){
											//echo '<div class="success_message_area"><img src="'.SUCCESS_ICON.'" /><ul><li> Thanks, we\'ve emailed your \'Password\' to \''.$_SESSION['recover_password_email'].'\', Please check you email </li></ul></div><br><br>';
											echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
													<img style="width:23px;" src="'.SUCCESS_ICON.'" /><ul>
														<li style="list-style:none;">
															Thanks, we\'ve emailed your \'Password\' to \''.$_SESSION['recover_password_email'].'\', Please check you email
														</li></ul>
											</div></div></div>';
											unset($_SESSION['recover_password_email']); // unset session 
										}else{
											//echo '<div class="error_message_area"><img src="'.ERROR_ICON.'" /><ul><li> Oops, Session Expire! </li></ul></div>';
											echo '<div class="row"><div class="col-md-12"><div class="alert alert-warning">
													<img style="width:23px;" src="'.WARNING_ICON.'" /><ul><li style="list-style:none;"> Oops, Session Expire! </li></ul>
											</div></div></div>';	
										}
										
									}else{
										echo '<p>You can retrieve your login information to your email address. You Email address which you have used for Signup.</p><br>';
										
										require_once 'ap/form/recover_password_form.php';                                    
																	
										if(empty($errors) === false){
											//echo '<div class="error_message_area"><img src="'.ERROR_ICON.'" />'.output_errors($errors).'</div>';//display errors
											echo '<br><div class="row"><div class="col-md-12"><div class="alert alert-danger">
													<img style="width:23px;" src="'.ERROR_ICON.'" />'.output_errors($errors).'
											</div></div></div>';//display errors											
										}
									}
								?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        	<div class="col-md-12">                        	
                            	Go back to <a href="<?php echo LOGIN_PAGE; ?>">Sign In</a>
                            </div>
                        </div>
                        
                    </div><!--form-->
                	<div class="col-md-6">
                    	<?php require_once 'auth_instruction.php'; ?> 
                    </div><!--instruction-->
                </div><!--end row-->            	            
            </div>
        </div><!--Login form area-->
        
        
    </div><!--end Container-->
    <br><br>

<?php 
	require_once 'includes/all_footer.php'; 
?>