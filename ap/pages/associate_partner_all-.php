<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row">
	<div class="col-md-3">    	
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
									WHERE ap.asso_partner_status =:asso_partner_status ");
						$ap_query->execute(array(':asso_partner_status'=>1));
						
						echo '<h5 class="heading_color"><strong>Our Clients</strong></h5>';
						echo '<div class="gradient_border" style="width:100%"></div>';
						
						while($row = $ap_query->fetch(PDO::FETCH_ASSOC)){
							//echo '<div class="row">
							echo '<div class="col-sm-6 col-md-4">
									<div class="thumbnail">
										<img ';
										if(!empty($row['asso_partner_img'])){
											echo 'src="files/associate_partner/'.$row['asso_partner_img'].'"';
										}else{
											echo 'src="'.NO_IMG.'"';
										} 
										echo' style="height:80px;">
										<div class="caption">
											<h3>'.$row['asso_partner_name'].'</h3>
											<p style="height:80px;">'.substr($row['asso_partner_details'],0,100).'</p>
											<p><a href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'">View details...</a></p>
										</div>
									</div>
								</div>';
							//</div>';
						}
						
						/*echo '<ul class="view_all_list">';
							while($row = $ap_query->fetch(PDO::FETCH_ASSOC)){
								echo '<li><a href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'">';						
								
								echo '<div class="row">
										<div class="col-md-9">
											<span>'.$row['asso_partner_name'].'</span>
											<span>'.substr($row['asso_partner_details'],0,200).'</span>
										</div>';//end col-8
										
										if(!empty($row['asso_partner_img'])){
										echo '<div class="col-md-3">
												<img class="img-thumbnail" src="files/associate_partner/'.$row['asso_partner_img'].'" alt="">
											</div>'; //end col-4
										}
								echo '</div>';//end row												
							
							echo '		</a></li>';
							}
						echo '</ul>';*/
							
						/*echo '<ul class="view_all_list">';
						while($row = $ap_query->fetch(PDO::FETCH_ASSOC)){
							echo '<li><a href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'">';						
							echo '	<div class="view_all_list_details">
										<span>'.$row['asso_partner_name'].'</span>
										<span>'.substr($row['asso_partner_details'],0,200).'</span>
									</div>';
									if(!empty($row['asso_partner_img'])){
									echo '<div class="view_all_list_img">
											<img src="files/associate_partner/'.$row['asso_partner_img'].'" alt="">
										</div>'; 
									}												
						echo '		</a></li>';
						}
						echo '</ul>';*/
													
					?>          
            </div>
        </div>
    </div><!--End Col-->	   
</div><!--End row-->
</br></br>
<div class="row">
    <?php require_once 'img_vticker_product.php'; ?>
</div><!--End row-->