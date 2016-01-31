<div class="serach_option_area" style="margin:0px 3px 3px 0px;">
    <ul>
    <!--<li><input type="text" name="edit_user_s_username" id="edit_user_s_username" value="" autocomplete="on" placeholder="Search by username"></li>--> 
        <li><input type="text" id="search_i_name" name="search_i_name"  value="" autocomplete="on" placeholder="Search by item..." style="width:120px"></li>
        <li><?php search_select_item_category($con); ?></li>
        <li><?php search_select_item_sub_category($con); ?></li> 
        <li><?php seaech_select_item_brand($con); ?></li>        
        <li><input type="button" id="item_mst_search_button" style="width:auto" value="Search"></li>                                    
    </ul>
</div>