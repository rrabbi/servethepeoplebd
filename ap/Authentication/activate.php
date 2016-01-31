<?php 
	require_once 'core/init.php';
	logged_in_redirect($con);
	$page_code = 125; //Fixed Page Code
	require_once 'core/page_setup.php';
	
	require_once 'ap/script/activation_script.php'; //call login_script in top of page ;
	
	require_once 'includes/all_header.php'; 
?> 

    <div id="contents_area">
    	<div class="authetication_area">
            <div class="auth_container">
                <!--<h3><img src="<?php //echo LOGO;?>" alt="Logo"></h3> -->         
                
                <h2>Account Activation</h2>
                
                <div class="auth_form" style="width:630px">                                      
                    <?php 
						if(isset($_GET['success']) === true && empty($_GET['success']) === true){
							//echo '<p>Thanks, we have activate your account, you can login now </p><br><br>';
							if(!empty($_SESSION['activation_email'])){
								echo '<p>Thanks, we have activate your account for '.$_SESSION['activation_email'].', you can login now </p><br><br>';
								unset($_SESSION['activation_email']); // unset session 
							}else{
								//header('Location: '.PROTECT_PAGE); //exit();
								echo 'Oops, Session Expire';	
							}
						}else{													
							if(empty($errors) === false){
								echo '<p>'.output_errors($errors).'</p>';//display errors
							}
						}
					?>           
                    
                    <br>
                    <p>
                    <a href="<?php echo AUTH_PAGE.'?type=Login'; ?>"> Sign in </a></p>
                    <!--ap/recover.php?mode=username --ap/recover.php?mode=password -->
                
                </div><!--End login_form--> 
                
               <!-- <div class="auth_info">
                     <?php //require_once 'auth_instruction.php'; ?>                
                </div> -->     	
                
            </div><!--end container-->
        </div><!--end authetication_area-->       
    </div><!--end contant_area-->

<?php 
	require_once 'includes/all_footer.php'; 
?>