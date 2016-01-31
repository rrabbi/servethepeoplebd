<form method="POST" id="document_add_edit" style="height:360px; margin-top:5px; overflow:auto">
    <div class="form_top"><!--Start Form_top--> 
    
        <!--Hidden type input for pass office_id for updating  > -->
        <input type="hidden" class="article_id" id="article_id" name="article_id" value="<?php  if(!empty($article_id)){ echo $article_id;} ?>">
        <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
                                   
        <div class="form_left">
            <div class="field">
                <label> Category: *</label>
                <div class="data">
                    <?php select_article_category($con, @$art_cat_id); ?>
                </div>                        	
            </div> 
            <div class="field">
                <label> Code: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="a_code" name="a_code" value="<?php  if(!empty($a_code)){ echo $a_code;} ?>" 
                    placeholder="Code will Auto generate">
                </div>                        	
            </div>           	
            <div class="field">
                <label> Title: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="a_title" name="a_title" value="<?php  if(!empty($a_title)){ echo $a_title;} ?>" 
                    placeholder="Enter Title">
                </div>                        	
            </div>
           <!-- <div class="field">
                <label> Details: </label>
                <div class="data">
                    <textarea class="textarea rich_text" id="a_desc" name="a_desc" placeholder="Enter Details"><?php  //if(!empty($a_desc)){ echo $a_desc;} ?></textarea>
                </div>                        	
            </div>--> 
             
            <div class="field">
                <label>Status: 
                    <input type="checkbox" class="checkbox" <?php if(@$a_status == 1){echo 'checked="checked"';} ?> id="a_status" name="a_status" 
                    value="<?php if(!empty($a_status)){echo $a_status; }else{ echo 0; } ?>"> Show
                </label>                        	
            </div>              
                                                                                                                                                               
        </div><!--End form_left-->
        
        <div class="form_right">
        	<div class="field">
                <label> Date: </label>
                <div class="data">
                    <input type="date" class="a_text" id="a_pdate" name="a_pdate" value="<?php  if(!empty($a_pdate)){ echo $a_pdate;} ?>" 
                    placeholder="mm/dd/yyyy">
                </div>                        	
            </div>
            
            <div class="field">
                <label> Comment: </label>
                <div class="data">
                    <textarea class="textarea" id="a_comment" name="a_comment" placeholder="Enter Comments"><?php  if(!empty($a_comment)){ echo $a_comment;} ?></textarea>
                </div>                        	
            </div>
                       
            <div class="field">
                <label> Image: </label>
                <div class="data"><input type="file" class="input" id="file_name" name="file_name" onchange="readURL(this);"></div>
            </div>                                                  
            
            <div class="display_img">
           		<img id="show_img" src="<?php 
					if(!empty($file_name)){ echo '../../files/article/'.$file_name;}else{ echo NO_IMG;} ?>" style="width:90px; max-height:60px;"> 
           </div>           
                                                                                                                                                                                   
        </div><!--End form_right--> 
        

        

	</div><!--End Form_top-->
    
    <div class="field">
            <label> Details: </label>
    </div>
    <div class="field">
        <textarea class="textarea rich_text" id="a_desc" name="a_desc" placeholder="Enter Details"><?php  if(!empty($a_desc)){ echo $a_desc;} ?></textarea>
    </div>

    <div id="array_items" style=" width:97%; margin:5px auto; margin-bottom:10px; padding:5px; background:#E2E2E2;">
        <?php if(empty($article_id)){ ?>           
            <table>
                <tr style="padding-bottom:10px;">
                    <!--<td width="5%">No</td>-->
                    <td width="40%">Article Head</td>
                    <td width="45%">Article Details</td>
                    <td width="10%"><input type="button" id="add_btn" class="array_button" name="add_btn" value="Add" ></td>
                </tr>
               <!--<tr class="records">
                    <td>1</td>
                    <td><input type="text" class="input" id="ad_head_1" name="ad_head[]" value="" style="width:300px" placeholder="Enter Title"></td>
                    <td><textarea class="textarea" id="ad_article_1" name="ad_article[]" style="width:350px" placeholder="Details here" ></textarea></td>
                    <td><input type="button" id="add_btn" class="array_button" name="add_btn" value="Add" ></td>                    
                </tr>-->
                
                <tbody id="array_container"></tbody>
            </table>
        <?php 
        }elseif(!empty($article_id)){
            echo '<table>
                <tr>
                    <!--<td width="5%">No</td>-->
                    <td width="40%">Article Head</td>
                    <td width="45%">Article Details</td>
                    <td width="10%"><input type="button" id="add_btn" class="array_button" name="add_btn" value="Add" ></td>
                </tr>';
            $article_query = mysql_query("SELECT art_dtl_id, article_id, ad_head, ad_article FROM article_dtl WHERE article_id='$article_id' ");
            //$count = 0;
            while($row = mysql_fetch_array($article_query)){
                //$count +=1;				
                echo '<tr class="records">';
               // echo '    <td >'.$count.'</td>';
                echo '    <td><input type="text" class="a_text" id="ad_head_1" name="ad_head[]" value="'.$row['ad_head'].'" style="width:200px"></td>';
                echo '    <td style="padding:3px;"><textarea class="textarea" id="ad_article_1" name="ad_article[]" style="width:250px" >'.$row['ad_article'].'</textarea></td>';
                echo '    <td><input type="button" class="remove_item array_button" value="Remove" ></td>                    ';
                echo '</tr>	';								
            }
                echo '<tbody id="array_container"></tbody>';
            echo '</table>';
        }
        ?>          
        
    </div>  <!--End array_items entry form--> 
  
       
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="New Entry" onClick="clearForm();" title="New Entry">
            <input type="submit" class="a_button" id="document_add_edit_button" value="Update" title="Update Document">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!--Show message using jquery--> 
