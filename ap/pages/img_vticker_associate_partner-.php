<div class="img_vticker_view">
    <ul id="img_vticker">
        <?php 
            $query_asso_part = $con->prepare("SELECT * FROM associate_partner");
                $query_asso_part->execute();
            while($row = $query_asso_part->fetch()){
                echo '<li><a class="popup_img" href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'" target="_blank">';
                echo '<img title="'.$row['asso_partner_name'].'" alt="" src="files/associate_partner/'.$row['asso_partner_img'].'">';
                echo '<span style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">'.$row['asso_partner_name'].'</span>';
                echo '</a></li>';
            }
        ?>
    </ul>
</div>