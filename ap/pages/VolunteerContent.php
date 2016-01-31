<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row">    
	<div class="col-md-9" >
    	<div class="row" style="margin-right:3px;" >
            <div class="col-md-12" >
            	<?php
					$art_query = $con->prepare("SELECT article_id, a_code, a_title, a_desc, a_status,  a_img
						FROM article_mst 
						WHERE a_code=:a_code AND a_status=:a_status ");
					$art_query->execute(array(':a_status'=>1, ':a_code'=>'GET-INVOLVED002'));
					$art_query = $art_query->fetch(PDO::FETCH_ASSOC);					
					 
					echo '<h5 class="heading_color"><strong>'.ucfirst($art_query['a_title']).'</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div><br>';
					
					echo '
						<div class="row">
							<div class="col-md-12 ul_style_for_desc">
								<p>'.$art_query['a_desc'].'</p>
							</div>
						</div><br><!--for desc-->';
						
					if(!empty($art_query['a_img'])){
						echo '<div class="row">
									<div class="col-md-10 col-md-offset-1 text-center">
										<img src="files/article/'.$art_query['a_img'].'" alt="" class="img-thumbnail" style="width:100%; max-height:400px;" >
									</div>
							</div><br>';
					}											
				?>
            </div>
        </div><br>
        
        
        
        <div class="row" style="margin-right:3px;" >
            <div class="col-md-12" >
            </div>
        </div>
        
    </div><!--End col-->
    
    <div class="col-md-3">        
        <?php require_once 'get_involved_nav.php'; ?>
    </div><!--End col-->
        
</div><!--End row-->
</br>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
    	<div class="row">
            <div class="col-md-12 text-center">
                <h3 class="heading_color">Form for Local Volunteer Name and Deatils</h3><br>
            </div>
        </div>
        
        <div class="row" style="margin-right:3px;" >
            <div class="col-md-12" >
            	<?php
					if(isset($_GET['Success']) === true && empty($_GET['Success']) === true){
							if(!empty($_SESSION['check_session_value'])){
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-success">
										<img style="width:23px; float:left; margin-right:15px" src="'.SUCCESS_ICON.'" /><ul>
											<li style="list-style:none;">
												Thank you for submit, we will be in touch soon.
											</li></ul>
								</div></div></div>';
								unset($_SESSION['check_session_value']); // unset session 
							}else{
								//echo '<div class="error_message_area"><img src="'.ERROR_ICON.'" /><ul><li> Oops, Session Expire! </li></ul></div>';
								echo '<div class="row"><div class="col-md-12"><div class="alert alert-warning">
										<img style="width:23px; float:left; margin-right:15px" src="'.WARNING_ICON.'" /><ul><li style="list-style:none;"> Oops, Session Expire! </li></ul>
								</div></div></div>';	
							}
						}else{
							require_once 'ap/form/volunteer_local_form.php';
							
							if(empty($errors) === false){
								echo '<br><div class="row"><div class="col-md-12"><div class="alert alert-danger">
										<img style="width:23px; float:left; margin-right:15px" src="'.ERROR_ICON.'" />'.output_errors($errors).'
								</div></div></div>';//display errors
							}
						} 					
				?>
            </div>
        </div>
    </div>
</div>
</br></br></br>