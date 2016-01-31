<div class="img_vticker_view">
    <ul id="img_vticker">
        <?php 
            /*$query_asso_part = $con->prepare("SELECT * FROM associate_partner");
                $query_asso_part->execute();
            while($row = $query_asso_part->fetch()){
                echo '<li><a class="popup_img" href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'" target="_blank">';
                echo '<img title="'.$row['asso_partner_name'].'" alt="" src="files/associate_partner/'.$row['asso_partner_img'].'">';
                echo '<span style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">'.$row['asso_partner_name'].'</span>';
                echo '</a></li>';
            }*/
			
			$vticker_cp_query = $con->prepare("SELECT a.article_id, a.a_code, a.a_title, a.a_desc, a.a_img, a.a_status, ac.ac_code
								FROM article_mst AS a
								INNER JOIN article_category AS ac ON ac.art_cat_id = a.art_cat_id
								WHERE a.a_status =:a_status AND ac.ac_code=:ac_code ");
			$vticker_cp_query->execute(array(':a_status'=>1, ':ac_code'=>'CPROJECT'));
			while($row = $vticker_cp_query->fetch()){
                echo '<li><a class="popup_img" href="'.CURRENT_PROJECT_PAGE.'&ArtTitle='.add_underscore_to_str($row['a_title']).'" target="_blank">';
                echo '<img title="'.$row['a_title'].'" alt="" src="files/article/'.$row['a_img'].'">';
                echo '<span style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">'.$row['a_title'].'</span>';
                echo '</a></li>';
            }
        ?>
    </ul>
</div>