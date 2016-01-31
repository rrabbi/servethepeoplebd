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
					$article_query = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
					$article_query->execute(array(':a_status'=>1, ':ac_code'=>'ABOUTUS'));
					
					echo '<h5 class="heading_color"><strong>About us</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div>';
					
					while($row = $article_query->fetch(PDO::FETCH_ASSOC)){					
						echo '<div class="col-sm-6 col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading"><span class="heading_color"><b>'.$row['a_title'].'</b></span></div>
								<div class="panel-body" style="line-height:25px; font-size:14px;">
									<p style="text-align:justify;">
									'.substr($row['a_desc'],0,150).'								
									<p>
									<p><a href="'.ABOUTUS_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'"  role="button">Read more...</a></p>
								</div>
								
							</div>
						</div>';
					}
						
					/*echo '<ul class="view_all_list">';
					while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
						echo '<li><a href="'.ABOUTUS_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'">';						
						echo '	<div class="view_all_list_details">
									<span>'.$row['a_title'].'</span>
									<span>'.substr($row['a_desc'],0,200).'</span>
								</div>';
								if(!empty($row['a_img'])){
								echo '<div class="view_all_list_img">
										<img src="files/article/'.$row['a_img'].'" alt="">
									</div>'; 
								}												
					echo '		</a></li>';
					}
					echo '</ul>';*/
					
					/*echo '<ul class="view_all_list">';
					while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
						echo '<li><a href="'.ABOUTUS_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'">';						
						
						echo '<div class="row">
								<div class="col-md-9">
									<span>'.$row['a_title'].'</span>
									<span>'.substr($row['a_desc'],0,200).'</span>
								</div>';//end col-8
								
								if(!empty($row['a_img'])){
								echo '<div class="col-md-3">
										<img class="img-thumbnail" src="files/article/'.$row['a_img'].'" alt="">
									</div>'; //end col-4
								}
						echo '</div>';//end row												
					
					echo '		</a></li>';
					}
					echo '</ul>'; */
						
				?>             
            </div>
        </div>
    </div><!--End Col-->  
</div><!--End row-->
</br></br>
<div class="row">
    <?php require_once 'img_vticker_product.php'; ?>
</div><!--End row-->
