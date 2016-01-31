<form method="POST" id="item_brand_form">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_brand($con, @$brand_id);//echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="brand_id" name="brand_id" value="<?php  if(!empty($brand_id)){ echo $brand_id;} ?>">
            
            <div class="field">
                <label>Brand Name: *</label>
                <div class="data"><input type="text" class="input a_text" id="brand_name" name="brand_name" value="<?php if(!empty($brand_name)){ echo $brand_name; }?>" placeholder="Brand name"></div>
            </div>
            <div class="field">
                <label>Details: </label>
                <div class="data"> <textarea class="textarea" id="brand_details" name="brand_details" placeholder="Enter Details"><?php  if(!empty($brand_details)){ echo $brand_details;} ?></textarea></div>
            </div>
            <div class="field">
           		<div>
                    <label for="name">Logo: </label>
                    <input class="a_text" type="file" name="brand_img" id="brand_img" onchange="readURL(this);" >
                </div>
                
                <div class="display_img">
                    <img id="show_img" src="<?php if(!empty($brand_img)){ echo '../../files/brand/'.$brand_img;}else{ echo NO_IMG;} ?>" 
                    style="max-width:50px; max-height:50px; margin:10px 0px 10px 40px;"> 
               </div>
           </div>                                                                                     
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_brand_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
