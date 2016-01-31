<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row">
	<div class="col-md-3">
    	<div class="row" style="margin-right:3px;">
        	<?php require_once 'associate_partner_nav.php'; ?>
        </div>
        <div class="row" style="margin-right:3px;">
        	<?php require_once 'newsbox_vticker.php'; ?>
        </div>
    </div>
    
    <div class="col-md-9 product_view_style">
    	<div class="row" >
            <div class="col-md-12">
            	<?php
					$ap_query = $con->prepare("SELECT ap.asso_partner_id, ap.asso_partner_name, ap.asso_partner_details, ap.asso_partner_contact,
							ap.asso_partner_url, ap.asso_partner_status, ap.asso_partner_img, at.asso_name
							FROM associate_partner AS ap
							INNER JOIN associate_type AS at ON at.associate_type_id = ap.associate_type_id
							WHERE ap.asso_partner_status =:asso_partner_status AND ap.asso_partner_name=:asso_partner_name ");
					$ap_query->execute(array(':asso_partner_status'=>1, ':asso_partner_name'=>$AssoName));
					$ap_query = $ap_query->fetch(PDO::FETCH_ASSOC);					
					 
					echo '<h5 class="heading_color"><strong>'.$ap_query['asso_partner_name'].'</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div><br>';
					
					echo '
						<div class="row">
							<div class="col-md-12">
								<p>'.$ap_query['asso_partner_details'].'</p>
							</div>
						</div><!--for desc-->';
						
						if(!empty($ap_query['asso_partner_img'])){
							echo '
							<div class="row">
								<div class="col-md-4">
									<img src="files/associate_partner/'.$ap_query['asso_partner_img'].'" alt="" class="img-thumbnail" >
								</div>
								
								<div class="col-md-8">';								
								
								echo '<div class="view_single_list">
										<ul>';
											if(!empty($ap_query['asso_partner_name'])){ echo '<li>Name: '.$ap_query['asso_partner_name'].'</li>';}
											if(!empty($ap_query['asso_name'])){ echo '<li>Type: '.$ap_query['asso_name'].'</li>';}
											if(!empty($ap_query['asso_partner_contact'])){ echo '<li>Contact: '.$ap_query['asso_partner_contact'].'</li>';}
											if(!empty($ap_query['asso_partner_url'])){ echo '<li>URL: <a href="http://'.$ap_query['asso_partner_url'].'" target="_blank">'.$ap_query['asso_partner_url'].'</a></li>';}
								echo '	</ul>							
									</div>';
									
							echo'	</div>
							</div><br><br><!--for img and details-->
							';
						
						}else{
							echo '
							<div class="row">
								<div class="col-md-12">';
								
								echo '<div class="view_single_list">
										<ul>';
											if(!empty($ap_query['asso_partner_name'])){ echo '<li>Name: '.$ap_query['asso_partner_name'].'</li>';}
											if(!empty($ap_query['asso_name'])){ echo '<li>Type: '.$ap_query['asso_name'].'</li>';}
											if(!empty($ap_query['asso_partner_contact'])){ echo '<li>Contact: '.$ap_query['asso_partner_contact'].'</li>';}
											if(!empty($ap_query['asso_partner_url'])){ echo '<li>URL: <a href="http://'.$ap_query['asso_partner_url'].'" target="_blank">'.$ap_query['asso_partner_url'].'</a></li>';}
								echo '	</ul>							
									</div>';
									
							echo '	</div>
							</div><!--for img and details-->
							';							
						}
					
					/*echo '<div class="view_single_details" >';
						echo '<div class="" >';
						echo '	<p class="lead">'.$ap_query['asso_partner_details'].'</p> ';
						echo '</div></br>';
					
						
						echo '<div>';							
							if(!empty($ap_query['asso_partner_img'])){
								echo '<div class="view_single_img">';
									echo '<img src="files/associate_partner/'.$ap_query['asso_partner_img'].'" alt="" >';
								echo '</div>';
							}
							
							echo '<div class="view_single_list">
									<ul>';
										if(!empty($ap_query['asso_partner_name'])){ echo '<li>Name: '.$ap_query['asso_partner_name'].'</li>';}
										if(!empty($ap_query['asso_name'])){ echo '<li>Type: '.$ap_query['asso_name'].'</li>';}
										if(!empty($ap_query['asso_partner_contact'])){ echo '<li>Contact: '.$ap_query['asso_partner_contact'].'</li>';}
										if(!empty($ap_query['asso_partner_url'])){ echo '<li>URL: '.$ap_query['asso_partner_url'].'</li>';}
							echo '	</ul>							
								</div>';
													
						echo '</div>';						
					echo '</div>';*/
						
				?>
            </div>
        </div>
    </div>
       
</div><!--End row-->
<br><br>
<div class="row">
    <?php require_once 'img_vticker_product.php'; ?>
</div><!--End row-->