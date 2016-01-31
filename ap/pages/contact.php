<?php
	require_once 'core/init.php';
	$page_code = 107; //Fixed Page Code
	require_once 'core/page_setup.php';
	require_once 'ap/script/contact_form_script.php'; //call login_script in top of page ;	
	require_once 'includes/all_header.php';
?>   
	<section class="page_head_bg">
    	<div class="container" style="padding-top:150px">   
            <div class="row" >
                <div class="col-md-8 col-sm-8 col-xs-9 hidden-xs">  
                    <div class="row"><?php //require_once 'includes/breadcrumbs.php'; ?></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-3 text-right">  
                    <div class="row"><p class="page_title_style">Contact Us</p></div>
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
    	<div class="col-md-10 col-md-offset-1">
        	<div class="row">
            	<div class="col-md-12">
                    <h3 class="heading_color"><?php echo COMPANY_NAME; ?> Contact</h3>
                    <div class="gradient_border" style="width:100%"></div><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <p>                                   
                        <h4><strong>Bangladesh Office:</strong></h4>
                        20/4 Babor Rd. Mohammadpur,<br>
                        Mohammadpur, Dhaka-1207,<br>
                        Bangladesh <br>                                  
                        <span class="glyphicon glyphicon-phone"></span> +88-02-9140099 <br>
                        
                        <br>
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                	<p>
                		<h4><strong>USA Contacts:</strong></h4>
                        7226 Lee HighWay,<br>
                        Fall Church, VA 22046,<br>
                        Fax: 703-891-9558 <br>
                        <span class="glyphicon glyphicon-phone"></span> <?php echo CONPANY_PHONE;?> <br>
                        
                        <br>
                	</p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                	<p>
                    	<h4><strong>UK Contacts:</strong></h4>
                        4 Addington Court,<br>
                        Addington Way,<br>
                        Luton, UK <br>
                        <span class="glyphicon glyphicon-phone"></span> 44-07826287944 <br>
                	</p>
                </div>
            </div>
            
            <br><br>
        </div><!--end Col-12 -->      
    </div><!--end container-->
    
    
    <section style="background:#F9F9F9;">
    <div class="container">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="row">
            	<div class="col-md-12 text-center">
                    <h3 class="heading_color">We'd love to hear from you!</h3><br>
                    <!--<div class="gradient_border" style="width:100%"></div><br>-->
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-12">
                	<?php 
						if(isset($_GET['Success']) === true && empty($_GET['Success']) === true){
							if(!empty($_SESSION['contact_form_email'])){
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
										<img style="width:23px; float:left; margin-right:15px" src="'.SUCCESS_ICON.'" /><ul>
											<li style="list-style:none;">
												Thank you for contact us, we will be in touch soon.
											</li></ul>
								</div></div></div>';
								unset($_SESSION['contact_form_email']); // unset session 
							}else{
								//echo '<div class="error_message_area"><img src="'.ERROR_ICON.'" /><ul><li> Oops, Session Expire! </li></ul></div>';
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-warning">
										<img style="width:23px; float:left; margin-right:15px" src="'.WARNING_ICON.'" /><ul><li style="list-style:none;"> Oops, Session Expire! </li></ul>
								</div></div></div>';	
							}
						}else{
							require_once 'ap/form/contact_form.php';
							
							if(empty($errors) === false){
								echo '<br><div class="row"><div class="col-md-12"><div class="alert alert-danger">
										<img style="width:23px; float:left; margin-right:15px" src="'.ERROR_ICON.'" />'.output_errors($errors).'
								</div></div></div>';//display errors
							}
						}												
					?>
                </div>
            </div>
    	</div><!--end Col-12 -->      
    </div><!--end container-->
    <br><br><br><br>
    </section>
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
