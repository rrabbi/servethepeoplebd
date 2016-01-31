<div class="serach_option_area" style="margin:0px 3px 3px 0px;">
    <ul>
    <!--<li><input type="text" name="edit_user_s_username" id="edit_user_s_username" value="" autocomplete="on" placeholder="Search by username"></li>--> 
        <li><input type="text" id="edit_user_s_email" name="edit_user_s_email"  value="" autocomplete="on" placeholder="Search by email..." ></li>
        <li><?php select_user_role(@$role); ?></li>        
        <li><input type="button" id="edit_user_search_button" style="width:auto" value="Search"></li> 
        <li><input type="button" id="" onClick="clearForm();" style="width:auto" value="Reload"></li>                                     
    </ul>
</div>