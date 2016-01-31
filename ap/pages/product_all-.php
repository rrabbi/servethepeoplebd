<!--<div class="container_top">            	
</div>--><!--End container_top-->

<div class="row" >
        <div class="col-md-3">
        	<div class="row" style="background:#fff; border:1px solid rgba(223, 223, 223, 1); border-radius:5px; margin-right:1px;">
        		<?php require_once 'product_filter.php';?>
            </div>
        </div>
        
        <div class="col-md-9 product_view_style">
        	<div class="row" >
            	<div class="col-md-6 col-sm-6 col-xs-6">
                	
                	<?php 
						if( (isSet($_COOKIE['_cn']) OR isSet($_COOKIE['_scn'])) OR (isSet($_COOKIE['_cn']) AND isSet($_COOKIE['_scn']))  ){
							@$CatName = ucfirst(remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_cn']))) );
							@$SubCatName = ucfirst(remove_underscore_to_str(mysql_real_escape_string(htmlentities($_COOKIE['_scn']))) );
							if(!empty($CatName) && empty($SubCatName)){
								echo '<h5>'.$CatName.'</h5>';	
							}elseif(!empty($CatName) && !empty($SubCatName)){
								echo '<h5>'.$CatName.' / '.$SubCatName.'</h5>';
							}							
							
							//echo '<div class="titel_head"><h5>All Product</h5></div>';							
						}else{
							echo '<h5>All Product</h5>';								
						}						
					?>               
                </div><?php //For product category name ?>
                
                <div class="col-md-6 col-sm-6 .col-xs-6 text-right">
                        <div id="viewcontrols">
                            <div class="btn-group">
                                <a id="gridview" class="switcher btn btn-default"><span class="glyphicon glyphicon-th"></span></a>
                                <a id="listview" class="switcher active btn btn-default"><span class="glyphicon glyphicon-list" ></span></a>
                            </div>                    	
                        </div>                                                
                </div><?php //For switching between list & grid ?>                
            </div><?php //For product category name and switching between list & grid ?>
            
            <!--<div class="row"><div class="well">All Product</div></div>-->
            <div class="gradient_border" style="width:100%"></div>
            
            <div class="row" >
            	<div class="col-md-12">
                	
                	<?php
						/*Query from product_script.php*/							
						//echo '<div style=" display:block; height:auto; overflow:hidden;">';
						
						echo '<ul class="product_view list">';
							while($row = $query_item->fetch(PDO::FETCH_ASSOC)){
								echo '<li><a style="" href="'.PRODUCT_PAGE.'&ItemName='.add_underscore_to_str($row['i_name']).'">';
									echo '<div class="row">';
									$query_item_img = $con->prepare("SELECT item_id, i_img FROM item_images 
										WHERE item_id=".$row['item_id']."  LIMIT 1");
									$query_item_img->execute();
									while($row1 = $query_item_img->fetch(PDO::FETCH_ASSOC)){
										echo '<div class="col-md-3 list_left grid_left"><img class="img-thumbnail" src="files/items/'.$row1['i_img'].'" alt=""></div>';	
									}
															
									echo '  <div class="col-md-6 list_mid grid_mid" style="color:#000">
												<div class="product_name_style" ><h4>'.$row['i_name'].'</h4></div>
												<p>'.$row['i_cat_name'].' > '.$row['sub_category'].'</p>
												<p>';
													if($row['i_available'] == 1){echo 'Available';}else{echo 'Unavailable';}
												echo '</p>
												<p> Item for '.$row['i_user_type'].'</p>
												<p><span class="label label-warning " style="font-size:16px; font-weight:normal">$$ '.$row['i_price'].'</span></p>
											</div>
											<div class="col-md-3 list_right grid_right">
												<div class="style_post_date">'.show_date($row['adate']).'</div>
											</div>
									</div>																							
								</a></li>';
							}
						echo '</ul>';
						//echo '</div>';					
					?>
                </div>
            </div><?php //For product view ?> 
            
            <div class="row">
            	<div class="col-md-12 text-right"> 
					<?php //Bootstrap & twbsPagination Pagination
                        if( $number_row != 0 ){ ?> 
                        </br>                  
                            <nav>
                                <ul class="pagination pagination-sm" id="pagination-for-items" >                        
                                    <?php 								
                                        for ($i=1; $i<=$max_page; $i++) {
                                            echo '<li class="page"><a  href="'.$self.'?page='.$i.'">'.$i.'</a></li> '; 								
                                        };
										
                                    ?>
                                </ul>
                                <ul class="pagination pagination-sm"><?php echo '<li class="page"><a> Total '.$max_page.' ...</a></li> ';?></ul>
                            </nav>
                    <?php }else{					
							echo '<div class="no_data_found"> No Data Found</div>';
						} //END Bootstrap & twbsPagination Pagination
					?> 
                </div>            
            </div><?php //For product pagination ?>
        </div>
        <div class="col-md-1"><!--For Add-->
			<?php //require_once 'advertisement.php'; ?> 
        </div><!--For Add-->    
</div><!--End container_mid-->
</br></br>
<div class="row">
    <?php require_once 'img_vticker_associate_partner.php'; ?>
</div><!--End container_bottom-->