<!---->
    <div class="panel panel-info">
    	<!--<div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span><strong class="heading_color"> News </strong></div>-->
        <div class="panel-heading"><strong class="heading_color"> News </strong></div>
    	<div class="panel-body">
    		<div class="row">
    			<div class="col-xs-12">
    				<ul class="newsbox_vticker">
                    	<?php
                        	$news_art = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
							$news_art->execute(array(':a_status'=>1, ':ac_code'=>'NEWS'));
							
							while($row = $news_art->fetch(PDO::FETCH_ASSOC)){
								echo '<li class="news-item">
										<table cellpadding="4">
											<tr>
												<td><img src="files/article/'.$row['a_img'].'" width="60" class="img-circle" /></td>
												<td>
													<Strong>'.$row['a_title'].'</strong><br>
													<p>'.substr($row['a_desc'],0,80).'</p>  
													<a href="'.NEWS_PAGE.'&News='.add_underscore_to_str($row['a_title']).'">Read more...</a>
												</td>
											</tr>
										</table>
									</li>';
							}
						?>                    	
                        
                    </ul>
           		</div>
        	</div>
    	</div>
   		<div class="panel-footer"> </div>
	</div>
