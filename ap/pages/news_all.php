<!--<div class="container_top">            	
</div>--><!--End container_top-->
<div class="row">
    <!--<div class="col-md-3">
        <div class="row" style="margin-right:3px;">
            <?php //require_once 'newsbox_vticker.php'; ?>
        </div>
    </div>-->
    
    
    <div class="col-md-10 col-md-offset-1">
        <div class="row" >
            <div class="col-md-12">
            	<?php
					echo '<h5 class="heading_color"><strong>All the News Here.</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div>';
					
					$art_year_query = $con->prepare("SELECT a.article_id, year(a.a_pdate) AS OrderYear, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code
								GROUP BY OrderYear desc");
					$art_year_query->execute(array(':a_status'=>1, ':ac_code'=>'NEWS'));
					echo '<ul>';
					while($row = $art_year_query->fetch(PDO::FETCH_ASSOC)){
						echo '<li style="list-style:none; margin-left:50px; color:#CD2122;"><h3><small></small> '.$row['OrderYear'].'</h3><ul>';
								
								$art_t_query = $con->prepare("SELECT a.article_id, a.a_pdate, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code AND year(a.a_pdate)=:OrderYear ");
								$art_t_query->execute(array(':a_status'=>1, ':ac_code'=>'NEWS', ':OrderYear'=>$row['OrderYear']));
								while($row = $art_t_query->fetch(PDO::FETCH_ASSOC)){
									echo '<li style="list-style:none; margin-left:30px; padding:5px; color:#70A9C4;">
										<h4><small><span class="glyphicon glyphicon-chevron-right" style="color:#968896;"></span></small>
											<a href="'.NEWS_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'" style="text-decoration:none; color:#968896;"> '.$row['a_title'].'</a>
									 	</h4>
									</li>';
								}
						echo '</ul></li>';
					}
					echo '</ul>';
				
				
				
					/*$article_query = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
					$article_query->execute(array(':a_status'=>1, ':ac_code'=>'NEWS'));
					
					echo '<h5 class="heading_color"><strong>All the News Here.</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div>';
					
					while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
						echo '<div class="col-sm-6 col-md-4">
							<div class="panel panel-info">							
								<div class="panel-heading"><span class="heading_color"><b>'.$row['a_title'].'</b></span></div>							
								<div class="panel-body" style="">
									<div>
										<img ';
											if(!empty($row['a_img'])){
												echo 'src="files/article/'.$row['a_img'].'"';
											}else{
												echo 'src="'.NO_IMG.'"';
											} 
										echo' style="width:100%; height:240px; margin-bottom:10px;">
									</div>
									<p style="text-align:justify; height:100px;">
									'.substr($row['a_desc'],0,150).'								
									<p>
									<p><a href="'.NEWS_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'"  role="button">Read more...</a></p>
								</div>
								
							</div>
						</div>';
					}*/					
				?>             
            </div>
        </div>
    </div><!--End Col-->  
</div><!--End row-->
</br></br>
