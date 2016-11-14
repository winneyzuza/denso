<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>application/assets/css/manage.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>application/assets/css/create.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>application/assets/css/jquery-ui.min.css">

<?php
    $car_makers = "<option value=''>All</option>";
    $model_name = "<option value=''>All</option>";
    $model_code = "<option value=''>All</option>";
    $all_makers = array();
    $all_model_name = array();
    $all_model_code = array();
    $orCondition = "";
    if (!isset($maker_ids) || empty($maker_ids)) {
    	$maker_ids = "";
    	$orCondition = " or trim(model.maker_id) like '%' ";
    }
    if (!isset($model_names) || empty($model_names)) {
    	$model_names = "";
    }
    if (!isset($model_codes) || empty($model_codes)) {
    	$model_codes = "";
    }
    
    $this->db->select('maker_en, maker_id');
    $this->db->order_by('maker_en', 'asc');
    $raw = $this->db->get('car_makers')->result_array();
    
    foreach ($raw as $value) {
    	if($value['maker_id'] == $maker_ids){
    		$car_makers .= "<option selected value='".$value['maker_id']."'>".$value['maker_en']."</option>";
    	}else{
    		$car_makers .= "<option value='".$value['maker_id']."'>".$value['maker_en']."</option>";
    	}
    	
    }
    
    $maker_id = $this->input->get('CarMaker');
    
    $query_car_model = "select distinct(model.car_model),engine_model from (
		        				select * from pump_parts pp
		        				union all
		        				select * from compressor_parts cp
		        				union all
		        				select * from injector_parts ip
		        				union all
		        				select * from alternator_parts ap) model
		        		where model.maker_id = '".$maker_ids."' ".$orCondition.
        				" "." order by model.car_model asc";
    
    $car_model =  $this->db->query($query_car_model)->result_array();
    foreach ($car_model as $value) {
    	if($value['car_model'] == $model_names){
    		array_push($all_model_name, "<option selected value='".trim($value['car_model'])."'>".trim($value['car_model'])."</option>");
    	}else{
    		array_push($all_model_name, "<option value='".trim($value['car_model'])."'>".trim($value['car_model'])."</option>");
    	}
    	
		if (isset ( $model_names ) && ! empty ( $model_names )) {
			if ($value ['car_model'] == $model_names) {
				if ($value ['engine_model'] == $model_codes) {
					array_push ( $all_model_code, "<option selected value='" . $value ['engine_model'] . "'>" . $value ['engine_model'] . "</option>" );
				} else {
					array_push ( $all_model_code, "<option value='" . $value ['engine_model'] . "'>" . $value ['engine_model'] . "</option>" );
				}
	    	}
	    }else{
	    	if ($value ['engine_model'] == $model_codes) {
	    		array_push ( $all_model_code, "<option selected value='" . $value ['engine_model'] . "'>" . $value ['engine_model'] . "</option>" );
	    	} else {
	    		array_push ( $all_model_code, "<option value='" . $value ['engine_model'] . "'>" . $value ['engine_model'] . "</option>" );
	    	}
	    }
    }

    sort($all_model_code, SORT_STRING);
	$model_name.= implode("", array_unique($all_model_name));
	$model_code.= implode("", array_unique($all_model_code));

 ?>
<form name="frmSearchCarModel" id="frmSearchCarModel"
	action="<?php echo base_url();?>index.php/create/doSearchAction"
	method="post">
	<div class="table middle">
		<table>
			<tobody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			</tbody>
			<tr>
				<td><b><?php echo lang('car_maker') ?></b></td>
				<td><b><?php echo lang('model_name') ?></b></td>
				<td><b><?php echo lang('model_code') ?></b></td>
			</tr>
			<tr>
				<td><select name="CarMaker" id="CarMaker"><?php echo $car_makers; ?></select></td>
				<td><select name="ModelName" id="ModelName"><?php echo $model_name; ?></select></td>
				<td><select name="ModelCode" id="ModelCode"><?php echo $model_code; ?></select></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b><?php echo lang('car_maker_pn') ?></b></td>
				<td><b><?php echo lang('denso_part_no'); ?></b></td>
				<td><b><?php echo lang('keywords') ?></b></td>
			</tr>
			<tr>
				<td><input class="width_210" type="text" name="CarMakerPN"
					value="<?php echo $this->input->get('CarMakerPN') ?>" /></td>
				<td><input class="width_210" type="text" name="DensoPartNo"
					value="<?php echo $this->input->get('DensoPartNo'); ?>" /></td>
				<td><input class="width_210" type="text" name="KeyWords"
					value="<?php echo $this->input->get('KeyWords'); ?>" /></td>
			</tr>
			<tr>
				<td colspan="3"><br /> <br />
					<div class="center_table">
						<input type="submit" class="blue_back button search_btn" value="<?php echo lang('search'); ?>" />
						<input type="reset"	class="blue_back button" value="<?php echo lang('clear'); ?>">
					</div></td>
			</tr>
		
		</table>
		<br /> <br />
	
		<?php
		    if (!isset($records) OR empty($records)) {
		     	echo "<h1 class='table middle'>Search record was not found!</h1>";
		        goto end;
		    }
		?>
		<div>
			<div class="row">
				<!-- PINK COLOR ROW class="pink" -->
				<div class="head"><?php echo lang('car_maker') ?></div>
				<div class="head"><?php echo lang('model_name') ?></div>
				<div class="head"><?php echo lang('model_code') ?></div>
				<div class="head"><?php echo lang('car_maker_pn') ?></div>
				<div class="head"><?php echo lang('denso_part_no') ?></div>
			</div>
			<?php foreach ($records as $key => $row) { ?>
				<div class="row record">
				<div class="cell border center search_data" data-search="maker_en"><?php echo isset($row['maker_en'])?$row['maker_en']:""; ?></div>
				<div class="cell border center search_data" data-search="car_model"><?php echo isset($row['car_model'])?$row['car_model']:""; ?></div>
				<div class="cell border center search_data"
					data-search="engine_model"><?php echo isset($row['engine_model'])?$row['engine_model']:""; ?></div>
				<div class="cell border center search_data"
					data-search="car_maker_PN"><?php echo isset($row['car_maker_PN'])?$row['car_maker_PN']:""; ?></div>
				<div class="cell border"><?php echo isset($row['exchange_PN'])?$row['exchange_PN']:""; ?></div>
			</div>
			<?php } ?>
		    <?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</form>
<?php end: ?>
<script
	src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
<script
	src="<?php echo base_url(); ?>application/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">

    $(document).on('change', '#CarMaker', function(){
        $('select[name="ModelName"]').html("<option value=''>All</option>");
        $('select[name="ModelCode"]').html("<option value=''>All</option>");
        var car_id = this.value;
        $.ajax({
            url:        '<?PHP echo base_url(); ?>index.php/create/fetchallcarmodel',
            data:       {CarMaker: this.value},
            type:       'POST',
            dataType:   'json',
        })
        .done(function(data){
            $('select[name="ModelName"]').html("<option value=''>All</option>");
            $.each(data, function(key, value){
            	$('select[name="ModelName"]').append("<option value='" + value.car_model + "'>" + value.car_model + "</option>");
            });
            
            $.ajax({
                url:        '<?PHP echo base_url(); ?>index.php/create/fetchallcarengine_bycarmaker',
                data:       {CarMaker: car_id},
                type:       'POST',
                dataType:   'json',
            })
            .done(function(data){
                $('select[name="ModelCode"]').html("<option value=''>All</option>");
                $.each(data, function(key, value){
                	$('select[name="ModelCode"]').append("<option value='" + value.engine_model + "'>" + value.engine_model + "</option>");
                });
            })
        })
    });

    $(document).on('change', '#ModelName', function(){
        $('select[name="ModelCode"]').html("<option value=''>All</option>");
        $.ajax({
            url:        '<?PHP echo base_url(); ?>index.php/create/fetchallcarengine',
            data:       {CarMaker: $('#CarMaker').val(),ModelName: this.value},
            type:       'POST',
            dataType:   'json',
        })
        .done(function(data){
            $('select[name="ModelCode"]').html("<option value=''>All</option>");
            $.each(data, function(key, value){
            	$('select[name="ModelCode"]').append("<option value='" + value.engine_model + "'>" + value.engine_model + "</option>");
            });
        })
    });
    
	$(function(){
		var checked = 0;
		
		$(".search_btn").on("click",filterRecords);

		function filterRecords (ev) {
			var search_fields = [];
			var search_data = [];
			$(".search").each(function(){
				var me = $(this);
				if (me.val()!="") {
					search_fields[me.attr("id")] = me.val().toLowerCase();
				}
			});

			$(".record").removeClass("hidden");

			$(".record").each(function(){
				var me = $(this);
//				console.log("Row Data:");
				me.find(".search_data").each(function(){
					var data = $(this);
					var key = data.data("search");
					search_data[key] = data.text().toLowerCase();
					if (typeof(search_fields[key])!='undefined') {
						if (search_data[key].indexOf(search_fields[key])==-1) {
							me.addClass("hidden");
							return false;					//EXPERIMENTAL.. Take it off if weird behavior is noticed. Basically to save the resource usage.
						}
					}
				});


			});
		}
	});
</script>