<div class="list-group"> 
  <!--<a href="#" class="list-group-item active"> Cras justo odio </a>-->
  <?php
  	$ap_query = $con->prepare("SELECT ap.asso_partner_id, ap.asso_partner_name, ap.asso_partner_details, ap.asso_partner_contact,
				ap.asso_partner_url, ap.asso_partner_status, ap.asso_partner_img, at.asso_name
				FROM associate_partner AS ap
				INNER JOIN associate_type AS at ON at.associate_type_id = ap.associate_type_id
				WHERE ap.asso_partner_status =:asso_partner_status ");
	$ap_query->execute(array(':asso_partner_status'=>1));
	
	while($row = $ap_query->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="'.ASSOCIATE_CLIENT_PAGE.'&AssoName='.add_underscore_to_str($row['asso_partner_name']).'" class="list-group-item">
				<span class="glyphicon glyphicon glyphicon-ok"></span>  &nbsp;
				<span class="heading_color"><b>'.$row['asso_partner_name'].'</b></span>
			</a>';
	}
  ?>
</div>
