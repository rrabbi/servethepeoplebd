<div class="row">    
	<div class="col-md-5" >
    	<div class="row" style="margin-right:3px;" >
            <div class="col-md-12" >
            	<?php
					$art_query = $con->prepare("SELECT article_id, a_code, a_title, a_desc, a_status,  a_img
						FROM article_mst 
						WHERE a_code=:a_code AND a_status=:a_status ");
					$art_query->execute(array(':a_status'=>1, ':a_code'=>'ABOUTUS001'));
					$art_query = $art_query->fetch(PDO::FETCH_ASSOC);					
					 
					echo '<h5 class="heading_color"><strong>'.$art_query['a_title'].'</strong></h5>';
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
    </div>
    
    <div class="col-md-7">
        <div class="col-md-12">
    	<?php
        	$art_year_query = $con->prepare("SELECT a.article_id, year(a.a_pdate) AS OrderYear, ac.ac_code
						FROM article_mst AS a
						INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
						WHERE a.a_status =:a_status AND ac.ac_code=:ac_code
						GROUP BY OrderYear DESC");
			$art_year_query->execute(array(':a_status'=>1, ':ac_code'=>'ABOUT-MILESTONE'));
			
			while($row = $art_year_query->fetch(PDO::FETCH_ASSOC)){				
				echo '<div class="row">
					<div class="col-md-2 col-sm-12">
						<div class="row">
							<div class="about_year_style">'.$row['OrderYear'].'</div><br>
						</div>
					</div>
					
					<div class="col-md-10 col-sm-12 display_style_effect">';
					
						$art_t_query = $con->prepare("SELECT a.article_id, a.a_pdate, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
									FROM article_mst AS a
									INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
									WHERE a.a_status =:a_status AND ac.ac_code=:ac_code AND year(a.a_pdate)=:OrderYear ");
									$art_t_query->execute(array(':a_status'=>1, ':ac_code'=>'ABOUT-MILESTONE', ':OrderYear'=>$row['OrderYear']));
						while($row1 = $art_t_query->fetch(PDO::FETCH_ASSOC)){
							echo '<div class=" about_desc">
									<p style="font-size:18px; font-weight:bold;">'.$row1['a_title'].'</p>
									<div style="padding:2px; background:#AAB7B8;"> </div><br>
									<p>'.$row1['a_desc'].'</p>
								</div><br>';
						}
						
				echo '</div>		
					</div><br><!--End row-->';
			}
					
		?>
    </div>
    </div>
        
</div><!--End row-->
</br>
<?php //echo '<div class="gradient_border" style="width:100%"></div><br>'; ?>
</br>
<!--<div class="row">
	<div class="col-md-12">
    	<?php
        	/*$art_year_query = $con->prepare("SELECT a.article_id, year(a.a_pdate) AS OrderYear, ac.ac_code
						FROM article_mst AS a
						INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
						WHERE a.a_status =:a_status AND ac.ac_code=:ac_code
						GROUP BY OrderYear DESC");
			$art_year_query->execute(array(':a_status'=>1, ':ac_code'=>'ABOUT-MILESTONE'));
			
			while($row = $art_year_query->fetch(PDO::FETCH_ASSOC)){				
				echo '<div class="row">
					<div class="col-md-1 col-sm-2">
						<div class="about_year_style">'.$row['OrderYear'].'</div><br>
					</div>
					<div class="col-md-2 col-sm-2 hidden-xs">
						<div class="about_span_style"><span class="glyphicon glyphicon-eye-open"></span></div>
					</div>
					<div class="col-md-9 col-sm-8 display_style_effect">';
					
						$art_t_query = $con->prepare("SELECT a.article_id, a.a_pdate, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
									FROM article_mst AS a
									INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
									WHERE a.a_status =:a_status AND ac.ac_code=:ac_code AND year(a.a_pdate)=:OrderYear ");
									$art_t_query->execute(array(':a_status'=>1, ':ac_code'=>'ABOUT-MILESTONE', ':OrderYear'=>$row['OrderYear']));
						while($row1 = $art_t_query->fetch(PDO::FETCH_ASSOC)){
							echo '<div class="row about_desc">
									<p style="font-size:18px; font-weight:bold;">'.$row1['a_title'].'</p>
									<div style="padding:2px; background:#AAB7B8;"> </div><br>
									<p>'.$row1['a_desc'].'</p>
								</div><br>';
						}
						
				echo '</div>		
					</div><br><!--End row-->';
			}*/
					
		?>
    </div>
</div>--><br><br><!--End row-->
