<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row">
	<div class="col-md-12">
    	<?php 
			$query_item = $con->prepare("SELECT i.item_id, i.i_code, i.i_name, i.i_price, i.i_quantity,
				 i.i_available, i.i_details, i.adate, ib.brand_name, iut.i_user_type, ic.i_cat_name, isc.sub_category
				FROM item_mst AS i
				INNER JOIN j_item_sub_cat AS jisc ON jisc.item_id = i.item_id
				INNER JOIN item_sub_category AS isc ON isc.i_sub_cat_id = jisc.i_sub_cat_id
				INNER JOIN item_category AS ic ON ic.i_cat_id = isc.i_cat_id
				LEFT JOIN item_brand AS ib ON ib.brand_id = i.brand_id
				LEFT JOIN item_user_type AS iut ON iut.i_user_type_id = i.i_user_type_id					
				WHERE i.i_name=:i_name ORDER BY i.adate DESC");
			$query_item->execute(array(':i_name'=>$ItemName));
			$query_item = $query_item->fetch(PDO::FETCH_ASSOC);
		
		?>
        <div class="row">
        	<div class="col-md-12">
            	<?php echo '<div class="titel_head">
						<h3 class="heading_color"><strong>'.$query_item['i_name'].'</strong></h3>
						<!--<div class="gradient_border" style=""></div>-->
					</div>';
				?>
            </div>
        </div><!--end item name row-->
        
        <div class="row">
        	<div class="col-md-12">
            	<div class="row">
                	<div class="col-md-6">
                    	<?php 
							$query_item_imgs = $con->prepare("SELECT item_id, i_img FROM item_images WHERE item_id=:item_id");
							$query_item_imgs->execute(array(':item_id'=>$query_item['item_id']));
							
							echo '<div class="product_img_area" style="background:#fff; border-radius:5px;">';							
							
								echo '<div class="fotorama" data-nav="thumbs" data-width="100%" data-minheight="200" data-maxheight="300">';
										 while($row1 = $query_item_imgs->fetch(PDO::FETCH_ASSOC)){
											//echo $row1['i_img'];									
											echo '<a href="files/items/'.$row1['i_img'].'"><img src="files/items/'.$row1['i_img'].'"  ></a>';
										}
								echo '</div><!--End fotorama-->';
															
							echo '</div><!--End product_img_area-->';
						
						?>
                    </div><!--end gallary col-->
                    
                    <div class="col-md-6" style="border:1px solid rgba(223, 223, 223, 1); border-radius:5px; background:#fff;">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<?php 
									echo '<div class=""> 
										<h4><strong>Features of '.$query_item['i_name'].'</strong></h4>										
									</div>';
									
									echo '<table class="table" style=" width:95%; margin-left:15px;">';
										echo '<tr><td>Category: </td><td>'.$query_item['i_cat_name'].'</td></tr>';
										echo '<tr><td>Item Code: </td><td>'.$query_item['i_code'].'</td></tr>';
										echo '<tr><td>Status: </td><td>'.display_yes_or_no($query_item['i_available']).'</td></tr>';									
										if(!empty($query_item['brand_name'])){echo '<tr><td>Brand: </td><td>'.$query_item['brand_name'].'</td></tr>';}
										if(!empty($query_item['i_user_type'])){echo '<tr><td>Item for: </td><td>'.$query_item['i_user_type'].'</td></tr>';}
										//if(!empty($query_item['i_price'])){echo '<tr><td>Price: </td><td>'.$query_item['i_price'].'</td></tr>';}
										if(!empty($query_item['i_quantity'])){echo '<tr><td>Quantity: </td><td>'.$query_item['i_quantity'].'</td></tr>';}									
										echo '<tr><td>Date: </td><td>'.show_date($query_item['adate']).'</td></tr>';
									echo '</table>';
								?>
                            	 
                            </div>
                        </div><!--Fiexd item attribute-->
                        <div class="row">
                        	<div class="col-md-12" >
                            	<?php
                                	$query_item_attrib = $con->prepare("SELECT iav.attribe_value, iav.attribe_sirial,  ia.attribute_name
										FROM j_item_attrib_value AS iav
										INNER JOIN item_attribute AS ia ON ia.i_attrib_id = iav.i_attrib_id					
										WHERE iav.item_id=:item_id ORDER BY iav.attribe_sirial ASC");
									$query_item_attrib->execute(array(':item_id'=>$query_item['item_id']));
									
									/*echo '<div class="">
										<h4><strong>Specifications of '.$query_item['i_name'].'</strong></h4>
									</div>';*/
									
									//Dynamic attribute list
									$max_li = 3;									
									echo '<div class="item_attribute_list" style="float:left"><table class="table">';
									//echo '			<ul>';
									$i = 0;
										while($row = $query_item_attrib->fetch(PDO::FETCH_ASSOC)){																				
											//echo '		    <li>'.$row['attribute_name'].' : '.$row['attribe_value'].'</li>';
											echo '<tr> <td style="width:70px">'.$row['attribute_name'].': </td><td style="min-width:110px; max-width:110px">'.$row['attribe_value'].'</td> </tr>';
											if($i == $max_li){
												//echo '</ul></div><div class="item_attribute_list" style="float:left"><ul>';
												echo '</table></div><div class="item_attribute_list" style="float:left"><table class="table">';
											}
											$i++;								
										}
									//end splite area
									//echo '		    </ul>';
									echo '</table></div>';
								?>                           		                
                            </div>
                        </div><!--end Dynamic item attribute-->                    	                  
                    </div><!--end attribute & spacifiction col-->
                </div>
            </div>        
        </div><!--end item image and attribute row-->
        <br><br>
        <div class="row">
        	<div class="col-md-12" style="border:1px solid rgba(223, 223, 223, 1); border-radius:5px; background:#fff;">
            	<?php 
					echo '<div class="">
							<h4><strong>Details ('.$query_item['i_name'].')</strong></h4>
                            <!--<div class="gradient_border" style=""></div>-->
                        </div>';
                    echo '<div class="view_product_row" >';						
                        echo '<div class="product_desc">'.$query_item['i_details'].'</div>';				
                    echo '</div>';				
				?>
            </div>
        </div><!--end item details row-->
        <br><br>
    </div><!--col-md-12-->    
</div><!--End row-->

<div class="row">
    <?php require_once 'img_vticker_product.php'; ?>
</div><!--End container_bottom-->