<form method="POST" id="item_mst_image_form" enctype="multipart/form-data" style="//height:350px;// margin-top:5px; //overflow:auto">
    <div class="form_top"><!--Start Form_top-->     
        <!--Hidden type input for pass item_id for updating  > -->
        <?php if(isset($_SESSION['session_item_id'])){ ?>        			
                    <input type="hidden" class="item_id" id="item_id" name="item_id" value="<?php 
					if(!empty($_SESSION['session_item_id'])){ echo $_SESSION['session_item_id'];} ?>">
       	<?php  }else{ ?>
        			<input type="hidden" class="item_id" id="item_id" name="item_id" value="<?php  if(!empty($item_id)){ echo $item_id;} ?>">  
        <?php } ?>
        
        <!--Only for allow Log-->
        <!--<input type="hidden" id="allow_log" name="allow_log" value="<?php  //if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">-->
                                     
        <div class="form_left" style="width:100%">
        	<div class="field">
        		<label><?php  if(!empty($i_code)){ echo 'Code: \''.$i_code.'\' Name: \''.$i_name.'\'';}?></label>
            </div>
        	<div class="field">
                <label>File:</label>
                <div class="data">
                	<input type="file" class="a_text i_img" id="i_img_1" name="i_img[]" style="width:240px">
                    <input type="button" class="a_button" id="add_img_btn" value="Add New" >
                </div>                
            </div>
            <div id="image_array_container"></div><!--Containg multiple images-->
                                                                                                                                                                           
        </div><!--End form_left-->        
                                                                                           
    </div><!--End Form_top-->
          
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="Reload" onClick="Refresh();" title="Reload">
            <input type="submit" class="a_button" id="item_mst_image_form_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
    <span></span><!--Show message using jquery--> 
