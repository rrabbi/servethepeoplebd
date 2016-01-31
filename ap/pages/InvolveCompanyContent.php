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
					$art_query->execute(array(':a_status'=>1, ':a_code'=>'GET-INVOLVED003'));
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
        </div><br><br>
    </div>
    
    <div class="col-md-3">
        <?php require_once 'get_involved_nav.php'; ?>
    </div>
        
</div><!--End row-->
</br>
<div class="row">
	<div class="col-md-8" style="">
    	 <div class="panel-group" id="accordion">
				<?php
                    $article_query = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
					$article_query->execute(array(':a_status'=>1, ':ac_code'=>'INVOLVED-COMPANY')); //CHILD-PROGRAM
					
                    while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
                        echo '
                            <div class="panel panel-danger" style="//background:#E7395B">
                                <div class="panel-heading">
                                  <div class="panel-title">
                                    <a href="#collapse-'.$row['article_id'].'" data-toggle="collapse" data-parent="#accordion" style="text-decoration:none; font-weight:bold;">
                                      '.$row['a_title'].'
                                    </a>
                                  </div><!-- End panel title -->
                                  <div id="collapse-'.$row['article_id'].'" class="panel-collapse collapse"><br>
                                    <div class="panel-body" style="//background:#FFFFFF;">
										<!--<div class="col-md-5">
											<img src="files/article/'.$row['a_img'].'" alt="" class="img-thumbnail" style="width:100%; max-height:150px;" >
										</div>-->
										<div class="col-md-12">'.$row['a_desc'].'</div>                                      
                                    </div>
                                  </div><!-- End Panel collapse -->
                                </div>
                            </div>';				
                    }								
                ?>                                 
			</div><!-- End panel group -->    
    </div>
    <div class="col-md-3"></div>
</div>
</br></br>