<?php
	//for rember section
	echo '<div class="product_filter_row">';
		echo '<div class="titel_head" style="background: #FCFCFC;"> 
			<h4>YOUR SECTION</h4>
			<div class="gradient_border" style="width:98%"></div>
		</div>';
		echo '<div style="width:95%; text-align:right; padding:5px;">
				<a style="cursor:pointer" onClick="ClearProductCookie();"><span style="color:red;">Clear all  X</span></a>
			</div>';
			
		echo '<div id="product_filter_section">';
				if( (isSet($_COOKIE['_cn']) OR isSet($_COOKIE['_scn'])) OR (isSet($_COOKIE['_cn']) AND isSet($_COOKIE['_scn'])) ){
					@$CatName = ucfirst(remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_cn']))) );
					@$SubCatName = ucfirst(remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_scn']))) );
					
					echo '<ul class="CookieItem_list">';
						if(!empty($CatName)){echo '<li class="CookieItem"><a href="#" rel="_cn">'.$CatName.' <span style="color:red;"> X</span></a></li>';}
						if(!empty($SubCatName)){echo '<li class="CookieItem"><a href="#" rel="_scn">'.$SubCatName.' <span style="color:red;"> X</span></a></li>';}
					echo '</ul>';					
				}
		echo '</div>';		
	echo '</div>';
	
	//for product type
	echo '<div class="product_filter_row">';
		echo '<div class="titel_head" style="background: #FCFCFC;"> 
			<h4>PRODUCT TYPE</h4>
			<div class="gradient_border" style="width:98%"></div>
		</div>';
		
		$item_type_query = $con->prepare("SELECT item_type_id, item_type FROM item_type_mst");
		$item_type_query->execute();
		
		echo '<ul class="category_list">';
			while($row = $item_type_query->fetch(PDO::FETCH_ASSOC)){
				/*echo '<div class="radio">
					  <label><input type="radio" name="'.$row['item_type'].'">'.$row['item_type'].'</label>
					</div>';*/
					
				$ItemCount_for_ItemType = $con->prepare("SELECT COUNT(i.item_id) AS ItemCount
						FROM item_mst AS i
						INNER JOIN item_type_mst AS itm ON itm.item_type_id = i.item_type_id
						WHERE itm.item_type_id=".$row['item_type_id']);
				$ItemCount_for_ItemType->execute();
				$ItemCount_for_ItemType = $ItemCount_for_ItemType->fetch(PDO::FETCH_ASSOC);
																											
				echo '<li style="list-style:none;">
						<a class="item_type_list_item" style="color: #03b;" id="'.add_underscore_to_str($row['item_type']).'" href="'.PRODUCT_PAGE.'&ItemType='.add_underscore_to_str($row['item_type']).'" title=""> 
							'.$row['item_type'].' <span style="color:#03b;">('.$ItemCount_for_ItemType['ItemCount'].')</span>
						</a>
					</li>';
			}	
		echo '<ul>';		
	echo '</div>';

	//for product category
	$item_category_query = $con->prepare("SELECT i_cat_id, i_cat_name AS CatName FROM item_category");
	$item_category_query->execute();
	echo '<div class="product_filter_row">';
		echo '<div class="titel_head" style="background: #FCFCFC;"> 
			<h4>CATEGORY</h4>
			<div class="gradient_border" style="width:98%"></div>
		</div>';
		
		echo '<ul class="category_list">';
		while($row = $item_category_query->fetch(PDO::FETCH_ASSOC)){
				$ItemCount_for_cat = $con->prepare("SELECT COUNT(i.item_id) AS ItemCount
						FROM item_mst AS i
						INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
						INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
						INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
						WHERE ic.i_cat_id=".$row['i_cat_id']);
				$ItemCount_for_cat->execute();
				$ItemCount_for_cat = $ItemCount_for_cat->fetch(PDO::FETCH_ASSOC);
			
			//echo '<li class="category_list_item"><a id="'.add_underscore_to_str($row['CatName']).'" href="#">'.$row['CatName'].' <span style="color:#03b;">('.$ItemCount_for_cat['ItemCount'].')<span></a>';
			echo '<li class="category_list_item"><a style="color: #03b;" id="'.add_underscore_to_str($row['CatName']).'" href="'.PRODUCT_PAGE.'&CatName='.add_underscore_to_str($row['CatName']).'" >'.$row['CatName'].' <span style="color:#03b;">('.$ItemCount_for_cat['ItemCount'].')</span></a>';
				
								
				$item_sub_cat_query = $con->prepare("SELECT i_sub_cat_id AS SubCatId, sub_category AS SubCatName FROM item_sub_category WHERE i_cat_id=".$row['i_cat_id']);
				$item_sub_cat_query->execute();
				
				echo '<ul class="sub_cat_list">';
					while($row = $item_sub_cat_query->fetch(PDO::FETCH_ASSOC)){
							
							$ItemCount_for_sub_cat = $con->prepare("SELECT COUNT(i.item_id) AS ItemCount
									FROM item_mst AS i
									INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
									INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
									WHERE jisc.i_sub_cat_id=".$row['SubCatId']);
							$ItemCount_for_sub_cat->execute();
							$ItemCount_for_sub_cat = $ItemCount_for_sub_cat->fetch(PDO::FETCH_ASSOC);
																											
						echo '<li><a class="sub_cat_list_name" style="color: #03b;" id="'.add_underscore_to_str($row['SubCatName']).'" href="'.PRODUCT_PAGE.'&SubCatName='.add_underscore_to_str($row['SubCatName']).'" title=""> <div class="right_arrow_icon"></div> '.$row['SubCatName'].' <span style="color:#03b;">('.$ItemCount_for_sub_cat['ItemCount'].')</span></a></li>';
					}
				echo '</ul><!--End sub-cat_list-->';
				
			echo '</li><!--End category_list_item-->';						
		}
		echo '</ul><!--End category_list-->';
	echo '</div><!--End product_filter_area-->';

?>