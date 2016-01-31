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
					$article_query->execute(array(':a_status'=>1, ':ac_code'=>'CPROJECT'));
					
					echo '<h5 class="heading_color"><strong>Current Project\'s</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div>';
						
						while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
							//echo '<div class="row">
							echo '<div class="col-sm-6 col-md-4">
									<div class="thumbnail">
										<img ';
										if(!empty($row['a_img'])){
											echo 'src="files/article/'.$row['a_img'].'"';
										}else{
											echo 'src="'.NO_IMG.'"';
										} 
										echo' style="height:150px; width:80%;">
										<div class="caption">
											<h4 style="height:40px;">'.$row['a_title'].'</h4>
											<p style="height:80px;">'.substr($row['a_desc'],0,80).'</p>
											<p><a href="'.CURRENT_PROJECT_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'">View details...</a></p>
										</div>
									</div>
								</div>';
							//</div>';
						}												
					?>          
            </div>
        </div>
    </div><!--End Col-->	   
</div><!--End row-->
</br></br>