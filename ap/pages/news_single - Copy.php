<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row">   
	<div class="col-md-9">
    	<div class="row" style="margin-right:3px;" >
            <div class="col-md-12">
            	<?php
					$art_query = $con->prepare("SELECT article_id, a_code, a_title, a_desc, a_status,  a_img
						FROM article_mst 
						WHERE a_title=:a_title AND a_status=:a_status ");
					$art_query->execute(array(':a_status'=>1, ':a_title'=>$ArtTitle));
					$art_query = $art_query->fetch(PDO::FETCH_ASSOC);					
					 
					echo '<h5 class="heading_color"><strong>'.ucfirst($art_query['a_title']).'</strong></h5>';
					echo '<div class="gradient_border" style="width:100%"></div><br>';
					
					echo '
						<div class="row">
							<div class="col-md-12">
								<p>'.$art_query['a_desc'].'</p>
							</div>
						</div><!--for desc-->';
						
						if(!empty($art_query['a_img'])){
							echo '
							<div class="row">
								<div class="col-md-4">
									<img src="files/article/'.$art_query['a_img'].'" alt="" class="img-thumbnail" >
								</div>
								<div class="col-md-8">';
								
								$query = $con->prepare("SELECT ad_head, ad_article FROM article_dtl
									WHERE article_id=:article_id ");
								$query->execute(array(':article_id'=>$art_query['article_id']));//for loop
								while($row = $query->fetch(PDO::FETCH_ASSOC)){
									echo '<h4>'.$row['ad_head'].'</h4>';
									echo '<p>';											
									echo $row['ad_article'];
									echo '</p>';				
								}
									
							echo'	</div>
							</div><br><br><!--for img and details-->
							';
						
						}else{
							echo '
							<div class="row">
								<div class="col-md-12">';
								
								$query = $con->prepare("SELECT ad_head, ad_article FROM article_dtl
									WHERE article_id=:article_id ");
								$query->execute(array(':article_id'=>$art_query['article_id']));//for loop
								while($row = $query->fetch(PDO::FETCH_ASSOC)){
									echo '<h4>'.$row['ad_head'].'</h4>';
									echo '<p>';											
									echo $row['ad_article'];
									echo '</p>';				
								}
									
							echo '	</div>
							</div><!--for img and details-->
							';							
						}					
				?>
            </div>
        </div>
    </div><br>
    
    <div class="col-md-3">
    	<?php require_once 'news_nav.php'; ?>
    	<!--<div class="row" >
        	<?php //require_once 'news_nav.php'; ?>
        </div>
        <div class="row">
        	<?php //require_once 'newsbox_vticker.php'; ?>
        </div>-->
    </div>
    <br><br>
        
</div><!--End row-->
</br></br>