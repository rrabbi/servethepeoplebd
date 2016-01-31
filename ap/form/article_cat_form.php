<form method="POST" id="article_cat_add_edit">
    <div class="form_top"><!--Start Form-->
    
        <!--Hidden type input for pass award_id for updating  > -->
        <input type="hidden" id="art_cat_id" name="art_cat_id" value="<?php  if(!empty($art_cat_id)){ echo $art_cat_id;} ?>">
         <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>"> 
        <?php //select_article_category($con, @$art_cat_id); ?>
        
        <div class="field">
            <label> Category Name: *</label>
            <div class="data">
                <input type="text" class="a_text" id="ac_name" name="ac_name" value="<?php  if(!empty($ac_name)){ echo $ac_name;} ?>" 
                placeholder="Enter Name">
            </div>                        	
        </div>
        <div class="field">
            <label>Code: *</label>
            <div class="data">
                <input type="text" class="a_text" id="ac_code" name="ac_code" value="<?php  if(!empty($ac_code)){ echo $ac_code;} ?>" 
                placeholder="Enter code">
            </div>                        	
        </div>
                                                                                           
    </div><!--End form_top--> 
             
     
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="Clear" onClick="clearForm();" title="Clear form ">
            <input type="submit" class="a_button" id="article_cat_add_edit_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!-- display notification using jquery -->
