<div class="list-group"> 
  <!--<a href="#" class="list-group-item active"> Cras justo odio </a>-->
  <?php
	
	//dynamic link
	/*$article_query = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
				FROM article_mst AS a
				INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
				WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
	$article_query->execute(array(':a_status'=>1, ':ac_code'=>'CPROJECT'));
	
	while($row = $article_query->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="'.CURRENT_PROJECT_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'" class="list-group-item">
				<span class="glyphicon glyphicon glyphicon-chevron-right"></span>  &nbsp;
				<span class="heading_color"><b>'.$row['a_title'].'</b></span>
			</a>';
	}*/
	
	//Static Link
	echo '<a href="'.CHILDHOOD_PROGRAM_PAGE.'" class="list-group-item">
				<span class="glyphicon glyphicon glyphicon-chevron-right"></span>  &nbsp;
				<span class="heading_color"><b> Childhood Development Program </b></span>
			</a>';
	echo '<a href="'.MOSQUE_RENOVATION_PAGE.'" class="list-group-item">
				<span class="glyphicon glyphicon glyphicon-chevron-right"></span>  &nbsp;
				<span class="heading_color"><b> Mosque Renovation </b></span>
			</a>';

	
  ?>
  	
</div>
