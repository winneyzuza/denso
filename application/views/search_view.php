<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/create.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/jquery-ui.min.css">

<?php
    $car_makers = "<option value=''>All</option>";
    $model_name = "<option value=''>All</option>";
    $model_code = "<option value=''>All</option>";
    $all_makers = array();
    $all_model_name = array();
    $all_model_code = array();
    
    $this->db->select('maker_en, maker_id');
    $this->db->order_by('maker_en', 'asc');
    $raw = $this->db->get('car_makers')->result_array();
    
    foreach ($raw as $value) {
    	$car_makers .= "<option value='".$value['maker_id']."'>".$value['maker_en']."</option>";
    }
    
    $maker_id = $this->input->get('CarMaker');
    
    $query = "select distinct(car_model),engine_model from (
        				select * from pump_parts pp
        				union all
        				select * from compressor_parts cp
        				union all
        				select * from injector_parts ip
        				union all
        				select * from alternator_parts ap) model";
    
    $car_model =  $this->db->query($query)->result_array();
    foreach ($car_model as $value) {
    	$model_name .= "<option value='".$value['car_model']."'>".$value['car_model']."</option>";
        array_push($all_model_code, "<option value='".$value['engine_model']."'>".$value['engine_model']."</option>");
    }

	$model_code.= implode("", array_unique($all_model_code));
 ?>
<div style="float:right;">
    <label>
        Auto Refresh
        <select id="auto_refresh" style="padding:5px;">
            <option value="on">On</option>
            <option value="off">Off</option>
        </select>
    </label>
</div>
<form name="frmSearchCarModel" id="frmSearchCarModel" action="<?php echo base_url();?>index.php/create/doSearchAction" method="post">
	<table class="table middle">
		<tobody>
			<tr>
				<td class="width-400"></td>
				<td class="width-400"></td>
				<td class="width-400"></td>
			</tr>
		</tbody>
        <tr>
            <td><?php echo lang('car_maker') ?></td>
            <td><?php echo lang('model_name') ?></td>
            <td><?php echo lang('model_code') ?></td>
        </tr>
        <tr>
            <td><select name="CarMaker"><?php echo $car_makers; ?></select></td>
            <td><select name="ModelName"><?php echo $model_name; ?></select></td>
            <td><select name="ModelCode"><?php echo $model_code; ?></select></td>            
        </tr>
        <tr>
            <td><?php echo lang('car_maker_pn') ?></td>
		    <td><?php echo lang('denso_part_no'); ?></td>
            <td><?php echo lang('keywords') ?></td>		    
        </tr>
	    <tr>
            <td><input class="width_210" type="text" name="CarMakerPN" value="<?php echo $this->input->get('CarMakerPn') ?>" /></td>	    
		    <td><input class="width_210" type="text" name="denso_part_no" value="<?php echo $this->input->get('DensoPartNo'); ?>"/></td>
            <td><input class="width_210" type="text" name="KeyWords" value="<?php echo $this->input->get('KeyWords'); ?>" /></td>		    
	    </tr>
	    <tr>
	    	<td colspan="3">
	    		<br/>
				<br/>
				<div class="center_table">
			        <input type="submit" class="blue_back button search_btn" value="<?php echo lang('search'); ?>"  />
			        <input type="reset" class="blue_back button" value="<?php echo lang('clear'); ?>">
				</div>
			</td>
	    </tr>	    
	</table>
	<br/>
	<br/>
</form>
<?php
    if (!isset($records) OR empty($records)) {
        if($this->input->get('status') == '')
            echo "<h1 class='table middle'>NO DRAFTS FOUND!</h1>";
        else
            echo "<h1 class='table middle'>NO RECORDS FOUND!</h1>";
        goto end;
    }
?>
<div class="table middle">
	<div class="row"> <!-- PINK COLOR ROW class="pink" -->
		<div class="head"><?php echo lang('manage_create_date') ?></div>
		<div class="head">ROS No.</div>
		<div class="head"><?php echo lang('car_maker') ?></div>
		<div class="head"><?php echo lang('model_name') ?></div>
        <div class="head"><?php echo lang('model_code') ?></div>
        <div class="head"><?php echo lang('car_maker_pn') ?></div>
        <div class="head"><?php echo lang('denso_part_no') ?></div>
	</div>
	<?php foreach ($records as $key => $row) { ?>
		<div class="row record">
			<div class="cell border center search_data" data-search="create_date"><?php echo isset($row['engine_model'])?$row['engine_model']:""; ?></div>
			<div class="cell border center search_data" data-search="ros_no"><?php echo isset($row['ros_no'])?$row['ros_no']:""; ?></div>
			<div class="cell border search_data" data-search="dealer"><?php echo isset($row["dealer_".lang("manage_dealer_name")])?$row["dealer_".lang("manage_dealer_name")]:(isset($row['service_dealer'])?$row['service_dealer']:""); ?></div>
			<div class="cell hidden search_data" data-search="service_dealer"><?php echo isset($row['service_dealer'])?$row['service_dealer']:""; ?></div>
			<div class="cell hidden search_data" data-search="repair_date"><?php echo isset($row["repair_date"])?date("m/d/Y",strtotime($row['repair_date'])):""; ?></div>
			<div class="cell border search_data" data-search="car_maker"><?php echo isset($row[lang("manage_maker_name")])?$row[lang("manage_maker_name")]:""; ?></div>
            <div class="cell border"><?php echo isset($row['car_model'])?$row['car_model']:""; ?></div>
            <div class="cell border"><?php echo isset($row['warranty'])?strtoupper($row['warranty']):""; ?></div>
            <div class="cell border">
            <?php
                echo isset($row[lang("manage_part_type_column")]) ? $row[lang("manage_part_type_column")]: "";
            ?>
            </div>
			<div class="cell border"> <?php echo isset($row['part_no'])?$row['part_no']:""; ?> </div>
            <?php if($this->input->get('status')) { ?>
			<div class="cell border center"><?php echo isset($row['ApproveDate'])?date("d/m/Y H:i",strtotime($row['ApproveDate'])):""; ?></div>
			<div class="cell border center"><?php echo isset($row['Delivery'])?date("d/m/Y H:i",strtotime($row['Delivery'])):""; ?></div>
			<div class="cell border"><?php echo isset($row['Core'])?date("d/m/Y H:i",strtotime($row['Core'])):""; ?></div>
            <?php } ?>
			<div class="cell border search_data <?php echo isset($row['status'])?str_replace(" ", "_", $row['status']):""; ?>" data-search="status"><?php echo isset($row['status'])?$row['status']:""; ?></div>
		</div>
	<?php } ?>
</form>
        <?php echo $this->pagination->create_links(); ?>
</div>
<?php end: ?>
<script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(function(){
        var _timer;
        _timer = setTimeout(function(){location.reload(true);},60000);
        $("#auto_refresh").on("change", function(){
            var _me = $(this);
            if(_me.val()=="on"){
                clearTimeout(_timer);
                _timer = setTimeout(function(){location.reload(true);},60000);
            } else {
                clearTimeout(_timer);
            }
        });
    });
    $('select[name="CarMaker"]').on('change', function(){
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/manage/getsomedealers",
            type: "POST",
            data: "CarMaker=" + $('select[name="CarMaker"]').val(),
            dataType: "json",
            async: false,
            success: function(data){
                    if (data.code == "200") {
                        $('select[name="DealerName"]').html(data.message);
                    }
                    else {
                        $('select[name="DealerName"]').html("<option value=''>All</option>");
                    }
            },
            error: function(one, two, three){
            complete: function(){
                    // $(".part_type").removeAttr('disabled');
            }
        });
    })
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