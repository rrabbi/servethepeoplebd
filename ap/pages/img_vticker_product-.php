<div class="img_vticker_area">
    <div class="img_vticker_container">
        <!--<div class="img_vticker_name">
            <h2 style="font-family: arial, helvetica, sans-serif; color:#505050; font-size:22px; padding:20px;">Greentext Clients</h2>
        </div>-->
        <div class="img_vticker_view">
            <ul id="img_vticker" style="">
                <?php 
                    $query_item = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_available, i.i_details, i.adate, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
						LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id					
						ORDER BY RAND(), i.adate DESC LIMIT 100");
					$query_item->execute();
					
                    while($row = $query_item->fetch()){
                        echo '<li><a class="popup_img" href="'.PRODUCT_PAGE.'&ItemName='.add_underscore_to_str($row['i_name']).'">';
                        	
							$query_item_img = $con->prepare("SELECT item_id, i_img FROM item_images WHERE item_id=".$row['item_id']." LIMIT 1");
							$query_item_img->execute();
							while($row1 = $query_item_img->fetch(PDO::FETCH_ASSOC)){
								echo '<img title="'.$row['i_name'].'" alt="" src="files/items/'.$row1['i_img'].'">';
								//echo '	<div class="product_list_img"><img src="files/items/'.$row1['i_img'].'" alt=""></div>';	
							}
						
						echo '<div style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">';
							echo '<div>'.$row['i_name'].'</div>';
							echo '<div>'.$row['i_cat_name'].' > '.$row['sub_category'].'</div>';
						echo '</div>';	
						//echo '<span style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">'.$row['i_name'].'</span>';
                        //echo '<span style="position:absolute; padding:5px 0px 0px 0px; display:block; font-size:12px; bottom:1px; left:0; width:100%; text-align:center;">'.$row['i_cat_name'].'</span>';
						echo '</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</div>