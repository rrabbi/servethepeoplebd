<form method="POST" id="associate_partner_form" style="height:360px; margin-top:5px; overflow:auto">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_associate_partner($con, @$asso_partner_id);//echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="asso_partner_id" name="asso_partner_id" value="<?php  if(!empty($asso_partner_id)){ echo $asso_partner_id;} ?>">
            
            <div class="form_left">
                <div class="field">
                    <label>Name: *</label>
                    <div class="data"><input type="text" class="input a_text" id="asso_partner_name" name="asso_partner_name" value="<?php if(!empty($asso_partner_name)){ echo $asso_partner_name; }?>" placeholder="Name"></div>
                </div>
                <div class="field">
                    <label>Associte type: *</label>
                    <?php select_associate_type($con, @$associate_type_id); ?>
                </div>
                <div class="field">
                    <label>Status: &nbsp;&nbsp; 
                        <input type="checkbox" class="checkbox" <?php if(@$asso_partner_status == 1){echo 'checked="checked"';} ?> id="asso_partner_status" name="asso_partner_status" 
                        value="<?php if(!empty($asso_partner_status)){echo $asso_partner_status; }else{ echo 0; } ?>"> Show
                    </label>                       	
                </div>
                <div class="field">
                    <label>Contact: *</label>
                    <div class="data"><input type="text" class="input a_text" id="asso_partner_contact" name="asso_partner_contact" value="<?php if(!empty($asso_partner_contact)){ echo $asso_partner_contact; }?>" placeholder="Contact details"></div>
                </div>               
            </div><!--End form_left-->
            <div class="form_right">            	
            	<div class="field">
                    <label>URL: *</label>
                    <div class="data"><input type="text" class="input a_text" id="asso_partner_url" name="asso_partner_url" value="<?php if(!empty($asso_partner_url)){ echo $asso_partner_url; }?>" placeholder="URL"></div>
                </div>
                <div class="field">
                    <div>
                        <label for="name">Logo: </label>
                        <input class="a_text" type="file" name="asso_partner_img" id="asso_partner_img" onchange="readURL(this);" >
                    </div>
                    
                    <div class="display_img">
                        <img id="show_img" src="<?php if(!empty($asso_partner_img)){ echo '../../files/associate_partner/'.$asso_partner_img;}else{ echo NO_IMG;} ?>" 
                        style="max-width:100px; max-height:70px; margin:10px 0px 10px 40px;"> 
                   </div>
               </div>
               
           </div><!--End form_right-->                                                                                                   
    </div><!--End form_top-->
    
    <div class="field">
        <label>Details: </label>
        <div class="data"><textarea class="textarea rich_text" id="asso_partner_details" name="asso_partner_details" placeholder="Enter Details"><?php  if(!empty($asso_partner_details)){ echo $asso_partner_details;} ?></textarea></div>
   </div> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="associate_partner_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!--Show message using jquery--> 
         
