<?php

// Funnction to list News articles in Admin side
function list_news() {
		
		global $wpdb;
		?>
	
<div>
<span><h3>Home Page News Ticker Management Area</h3><h2><a class="add-new-h2" href="<?php echo  admin_url(); ?>/admin.php?page=news_ticker">Add New</a>
</h2></span>
<table class="widefat">
	<thead>
		<tr class="thead">
			<th>Title</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php

			$row = 1;
		 	
		 
		 	 $select_query = "SELECT * FROM ".$wpdb->prefix."news_ticker ORDER BY news_ticker_id DESC LIMIT 0 , 30";
			 $get_select_query_result = $wpdb->get_results($select_query);
				
			
			foreach ( $get_select_query_result as $result ) { 
				$class = ( $row % 2 ) ? '' : ' class="alternate"';
				$site_url= admin_url();
				$edit_url=$site_url."admin.php?page=update_news&news_ticker_id=".$result->news_ticker_id;
		    	?>

				    <tr <?php echo $class; ?>>
						<td> <?php echo $result->news_title; ?></td>
						<td><?php echo $result->news_date; ?></td>
						<td><a href="<?php echo $edit_url ?>">Edit</a>/ <a href="javascript:void(0)" class="delete_news_confirm" id="<?php echo $result->news_ticker_id;?>"> Delete </a></td> 
					</tr>
		<?php
			$row++;
			}
		?>
	</tbody>
</table>
<div class="ajax_response"></div>
</div>


<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery(".delete_news_confirm").click(function() {
		var base_url="<?php echo  admin_url(); ?>";
		
		var ret_value = confirm("Do you want to delete this news ?");
		if (ret_value == true) {
			jQuery(this).parent().parent().fadeOut('slow');
			id = jQuery(this).attr('id');
			jQuery.ajax( {
				url : base_url+"/admin-ajax.php",
				type : "POST",
				data : {'action':'delete_news','news_ticker_id':id},
				async:true,
				success : function(data) {
					if(data){
						jQuery('.ajax_response').html(data);
					}	
				}
				
			});
			return true;
		}



	
		
	});

});

</script>



<?php } ?>

