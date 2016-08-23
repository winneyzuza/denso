<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/manage.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/jquery-ui.min.css">

<?php
    $car_makers = "<option value=''>All</option>";
    $statuses = "<option value='all'>Status</option>";
    $service_dealers = "<option value=''>All</option>";
    $dealers = "<option value=''>All</option>";
    $all_makers = array();
    $all_dealers = array();
    $all_statuses = array();
    $all_service_dealers = array();

    foreach ($table_makers as $key => $row) {
        if($this->input->get('CarMaker') == $row[lang('manage_maker_name')])
            array_push($all_makers, "<option value='".$row[lang('manage_maker_name')]."' selected>".$row[lang('manage_maker_name')]."</option>");
        else
            array_push($all_makers, "<option value='".$row[lang('manage_maker_name')]."'>".$row[lang('manage_maker_name')]."</option>");
    }

    foreach ($table_statuses as $key => $row) {
        if($row['status'] != 'Draft'){
            if($this->input->get('status') == $row['status'])
                array_push($all_statuses, "<option value='".$row['status']."' selected>".$row['status']."</option>");
            else
                array_push($all_statuses, "<option value='".$row['status']."'>".$row['status']."</option>");
        }
    }

    foreach ($table_dealers as $key => $row) {
        if($this->input->get('DealerName') == $row[lang('manage_dealer_name')])
            array_push($all_dealers, "<option value='".$row[lang('manage_dealer_name')]."' selected>".$row[lang('manage_dealer_name')]."</option>");
        else
            array_push($all_dealers, "<option value='".$row[lang('manage_dealer_name')]."'>".$row[lang('manage_dealer_name')]."</option>");
    }
    
//foreach ($table_makers as $key => $row) {
//	array_push($all_makers, "<option value='".$row[lang('manage_maker_name')]."'>".$row[lang('manage_maker_name')]."</option>");
//}
//
//foreach ($table_statuses as $key => $row) {
//	array_push($all_statuses, "<option value='".$row['status']."'>".$row['status']."</option>");
//}
//
//foreach ($table_dealers as $key => $row) {
//	array_push($all_dealers, "<option value='".$row[lang('manage_dealer_name')]."'>".$row[lang('manage_dealer_name')]."</option>");
//}

$car_makers.= implode("", array_unique($all_makers));
$statuses.= implode("", array_unique($all_statuses));
//$service_dealers.= implode("", array_unique($all_service_dealers));
$dealers.= implode("", array_unique($all_dealers));
 ?>
<!--<form>
    <div class="table padded" style="width: 100%;">
            <div class="row">
                    <div class="cell" style="width: 15%;">Car maker</div>
                    <div class="cell" style="width: 20%;">
                            <select class="search padded-half" id="car_maker" style="width: 100%;">
                                    <?php echo $car_makers; ?>
                            </select>
                    </div>
                    <div class="cell" style="width: 15%;">Dealer name</div>
                    <div class="cell" style="width: 50%;">
                            <select class="search padded-half" id="dealer" style="width: 94%;">
                                    <?php echo $dealers; ?>
                            </select>
                    </div>
            </div>
    </div>
    <div class="table padded" style="width: 100%;">
            <div class="row">
                    <div class="cell" style="width: 15%;">Service dealer</div>
                    <div class="cell" style="width: 50%;">
    			<select class="search padded-half" id="service_dealer" style="width: 100%;">
                                    <?php echo $service_dealers; ?>
                            </select>
                        <?php echo isset($records[0][lang("manage_sd_name")])?$records[0][lang("manage_sd_name")]:""; ?>
                    </div>
                    <div class="cell" style="width: 15%;">ROS No.</div>
                    <div class="cell" style="width: 20%;">
                            <input type="text" placeholder="ROS No." id="ros_no" class="search padded-half" />
                    </div>
            </div>
    </div>
    <div class="table padded" style="width: 100%;">
            <div class="row">
                    <div class="cell" style="width: 8%;">Create date</div>
                    <div class="cell" style="width: 20%;">
                            <input type="text" placeholder="mm/dd/yyyy" class="search date padded-half" readonly="readonly" id="create_date_from" />
                    </div>
                    <div class="cell" style="width: 2%;">to</div>
                    <div class="cell" style="width: 20%;">
                            <input type="text" placeholder="mm/dd/yyyy" class="search date padded-half" readonly="readonly" id="create_date_to" />
                    </div>
                    <div class="cell" style="width: 8%;">Repair date</div>
                    <div class="cell" style="width: 20%;">
                            <input type="text" placeholder="mm/dd/yyyy" class="search date padded-half" readonly="readonly" id="repair_date_from" />
                    </div>
                    <div class="cell" style="width: 2%;">to</div>
                    <div class="cell" style="width: 20%;">
                            <input type="text" placeholder="mm/dd/yyyy" class="search date padded-half" readonly="readonly" id="repair_date_to" />
                    </div>
            </div>
    </div>

    <div class="table">
            <div class="row">
                    <div class="cell">
                            <button type="button" class="blue_back button search_btn"><?php echo lang('manage_search'); ?></button>
                    </div>
                    <div class="cell">
                            <button type="button" class="blue_back button"><?php echo lang('manage_export'); ?></button>
                    </div>
                    <div class="cell">
                            <button type="button" class="blue_back button"><?php echo lang('manage_core_in'); ?></button>
                    </div>
                        <div class="cell">
                            <button type="button" class="blue_back button"><?php echo lang('manage_cancel'); ?></button>
                    </div>
                    <div class="cell">
                        <input type="reset" class="blue_back button" value="<?php echo lang('manage_cancel'); ?>">
                    </div>
                    <div class="cell" style="width: 35%;">
                            <select style="width: 50%;" class="padded search" id="status">
                                    <?php echo $statuses; ?>
                            </select>
                    </div>
            </div>
    </div>
</form>-->

<div style="float:right;">
    <label>
        Auto Refresh
        <select id="auto_refresh" style="padding:5px;">
            <option value="on">On</option>
            <option value="off">Off</option>
        </select>
    </label>
</div>
<form type="GET" id="create_frm">
    <table class="table middle">
        <tr>
            <td><?php echo lang('manage_car_maker') ?></td>
            <td><select name="CarMaker"><?php echo $car_makers; ?></select></td>
        </tr>
        <tr>
            <td><?php echo lang('manage_dealer_names') ?></td>
            <td colspan="3"><select name="DealerName"><?php echo $dealers; ?></select></td>
        </tr>
        <tr>
            <td><?php echo lang('manage_dealer_keyword') ?></td>
            <td colspan="3"><input type="text" name="DealerKey" value="<?php echo $this->input->get('DealerKey'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('manage_ros_no') ?></td>
            <td colspan="3"><input type="text" name="RosNo" value="<?php echo $this->input->get('RosNo') ?>" /></td>
        </tr>
	    <tr>
		    <td><?php echo lang('manage_plate_no'); ?></td>
		    <td colspan="3"><input type="text" name="plate_no" value="<?php echo $this->input->get('plate_no'); ?>"/></td>
	    </tr>
	    <tr>
		    <td><?php echo lang('manage_frame_no'); ?></td>
		    <td colspan="3"><input type="text" name="frame_no" value="<?php echo $this->input->get('frame_no'); ?>"/></td>
	    </tr>
        <tr>
            <td><?php echo lang('manage_create_date') ?></td>
            <td><input type="text" placeholder="dd-mm-yyyy" class="date" readonly="readonly" name="CreateFrom" value="<?php echo $this->input->get('CreateFrom') ?>" /></td>
            <td>to</td>
            <td><input type="text" placeholder="dd-mm-yyyy" class="date" readonly="readonly" name="CreateTo" value="<?php echo $this->input->get('CreateTo') ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('manage_repair_date') ?></td>
            <td><input type="text" placeholder="dd-mm-yyyy" class="date" readonly="readonly" name="RepairFrom" value="<?php echo $this->input->get('RepairFrom') ?>" /></td>
            <td>to</td>
            <td><input type="text" placeholder="dd-mm-yyyy" class="date" readonly="readonly" name="RepairTo" value="<?php echo $this->input->get('RepairTo') ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('manage_status') ?></td>
            <td>
                <select name="status">
                    <?php echo $statuses; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="text" placeholder="yyyy/mm/dd" class="date hidden" readonly="readonly" name="dummy" hidden disabled /></td>
            <!--needs dummy for bug-->
        </tr>
    </table>
    <div class="table middle">
        <input type="submit" class="blue_back button search_btn" value="<?php echo lang('manage_search'); ?>"  />
        <?php if($this->input->get('status')){ ?>
        <button type="button" class="blue_back button" id="export"><?php echo lang('manage_export'); ?></button>
        <?php } ?>
        <input type="reset" class="blue_back button" value="<?php echo lang('manage_clear'); ?>">
    </div>
<!--</form>-->
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
            <?php if($this->input->get('status')) { ?>
		<div class="head">Mark<br/><input id="mark" type="checkbox"></div>
            <?php } ?>
		<div class="head"><?php echo lang('manage_create_date') ?></div>
		<div class="head">ROS No.</div>
		<div class="head"><?php echo lang('manage_dealer') ?></div>
		<div class="head"><?php echo lang('manage_car_maker') ?></div>
        <div class="head"><?php echo lang('manage_car_model') ?></div>
        <div class="head"><?php echo lang('manage_warranty') ?></div>
        <div class="head"><?php echo lang('manage_part_type') ?></div>
		<div class="head"><?php echo lang('manage_part_no') ?></div>
        <?php if($this->input->get('status')){ ?>
		<div class="head">Approve Date</div>
		<div class="head">Delivery</div>
		<div class="head">Core</div>
        <?php } ?>
		<div class="head"><?php echo lang('manage_status') ?></div>
		<div class="head">Cancel</div>
	</div>
	<?php foreach ($records as $key => $row) { ?>
		<div class="row record">
            <?php if($this->input->get('status')) { ?>
			<div class="cell border center"><input class="mark" type="checkbox" name="RosCheck[]" value="<?php echo isset($row['raw_ros'])?$row['raw_ros']:""; ?>"></div>
            <?php } ?>
			<div class="cell border center search_data" data-search="create_date"><?php echo isset($row['created_time'])?date("d/m/Y H:i",strtotime($row['created_time'])):""; ?></div>
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
			<div class="cell border">
				<?php 
					echo (
					(isset($row['status']) AND $row['status'] == "Request")
						?("<a href='#' title='Cancel' data-ros_no='".$row['raw_ros']."' class='cancel'>Cancel</a>")
						:(
							($row['status'] == "Draft")
							?("<a href='#' title='Delete' data-ros_no='".$row['raw_ros']."' class='delete'>Delete</a>")
							:("")
						)
					); 
				?>
			</div>
		</div>
	<?php } ?>
</form>
        <?php echo $this->pagination->create_links(); ?>
	<!-- <div class="row">
		<div class="cell border center"><input class="mark" type="checkbox"></div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">TPB-003-14</div>
		<div class="cell border">Thai Jaroen</div>
		<div class="cell border">TOYOTA</div>
		<div class="cell border">095000-8290</div>
		<div class="cell border center">-</div>
		<div class="cell border center">-</div>
		<div class="cell border"></div>
		<div class="cell border">Request</div>
	</div>
	<div class="row">
		<div class="cell border center"><input class="mark" type="checkbox"></div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">TPB-003-14</div>
		<div class="cell border"></div>
		<div class="cell border">TOYOTA</div>
		<div class="cell border">095000-8290</div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">-</div>
		<div class="cell border"></div>
		<div class="cell border">Approval</div>
	</div>
	<div class="row">
		<div class="cell border center"><input class="mark" type="checkbox"></div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">TPB-003-14</div>
		<div class="cell border"></div>
		<div class="cell border">TOYOTA</div>
		<div class="cell border">095000-8290</div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">12/16/2014</div>
		<div class="cell border"></div>
		<div class="cell border">Delivery</div>
	</div>
	<div class="row">
		<div class="cell border center"><input class="mark" type="checkbox"></div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">TPB-003-14</div>
		<div class="cell border"></div>
		<div class="cell border">TOYOTA</div>
		<div class="cell border">095000-8290</div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">12/16/2014</div>
		<div class="cell border">12/16/2014</div>
		<div class="cell border">Core return</div>
	</div>
	<div class="row">
		<div class="cell border center"><input class="mark" type="checkbox"></div>
		<div class="cell border center">10/16/2014</div>
		<div class="cell border center">TPB-003-14</div>
		<div class="cell border"></div>
		<div class="cell border">TOYOTA</div>
		<div class="cell border">095000-8290</div>
		<div class="cell border center">-</div>
		<div class="cell border center">-</div>
		<div class="cell border">-</div>
		<div class="cell border">Cancel</div>
	</div> -->
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
                    //console.log(data);
                    if (data.code == "200") {
                        $('select[name="DealerName"]').html(data.message);
                    }
                    else {
                        $('select[name="DealerName"]').html("<option value=''>All</option>");
                    }
            },
            error: function(one, two, three){
                    //console.log(one);
                    //console.log(two);
                    //console.log(three);
            },
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

				if (typeof(search_fields['create_date_from'])!='undefined' && typeof(search_data['create_date'])!='undefined') {
					var create_date_from = new Date(search_fields['create_date_from']);
					var create_date = new Date(search_data['create_date']);
					if (create_date < create_date_from) {
						me.addClass("hidden");
					}
				}

				if (typeof(search_fields['create_date_to'])!='undefined' && typeof(search_data['create_date'])!='undefined') {
					var create_date_to = new Date(search_fields['create_date_to']);
					var create_date = new Date(search_data['create_date']);
					if (create_date > create_date_to) {
						me.addClass("hidden");
					}
				}

				if (typeof(search_fields['repair_date_from'])!='undefined' && typeof(search_data['repair_date'])!='undefined') {
					var repair_date_from = new Date(search_fields['repair_date_from']);
					var repair_date = new Date(search_data['repair_date']);
					if (repair_date < repair_date_from) {
						me.addClass("hidden");
					}
				}

				if (typeof(search_fields['repair_date_to'])!='undefined' && typeof(search_data['repair_date'])!='undefined') {
					var repair_date_to = new Date(search_fields['repair_date_to']);
					var repair_date = new Date(search_data['repair_date']);
					if (repair_date > repair_date_to) {
						me.addClass("hidden");
					}
				}
//				console.log("Search data:");
//				console.log(search_data);

				// if (search_fields) {};
			});
//			console.log(search_fields);
		}
                
                $('.date').datepicker({
                    dateFormat:'dd-mm-yy',
                    yearRange:'-50:+10',
                    changeMonth:true,
                    <?php if($this->session->userdata('lang') == 'th'){ ?>
                        closeText: 'ปิด',
                        prevText: '&#xAB;&#xA0;ย้อน',
                        nextText: 'ถัดไป&#xA0;&#xBB;',
                        currentText: 'วันนี้',
                        monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน',
                        'กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
                        monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.',
                        'ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
                        dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
                        dayNamesShort: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
                        dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
                    <?php } ?>
                    changeYear:true
                });
                
		$('#mark').on('click',function(){
			// $(this).prop("indeterminate",true);
			var parent = $(this);
			$('.mark').prop("checked",parent.prop("checked"));
			checked = parent.prop("checked")?6:0;
		});

		$('.mark').on('change',function(){
			checked = $(this).prop("checked")?(checked + 1):(checked - 1);
			setParent();
		});
		function setParent(){
			if (checked == 6) {
				$("#mark").prop("indeterminate",false);
				$("#mark").prop("checked",true);
			} else if(checked == 0){
				$("#mark").prop("indeterminate",false);
				$("#mark").prop("checked",false);
			} else{
				$("#mark").prop("indeterminate",true);
			}
		}

		$(document).on("click",".cancel",cancelRos);
		$(document).on("click",".delete",deleteDraft);

		function cancelRos (ev) {
            if(confirm("Are you sure you want to cancel?")){
			var data = {};
			data.ros_no = $(ev.currentTarget).data("ros_no");
			data.action = "cancel";
			data.draft = "false";
			data.status = "Cancel";
			var formdata = $.param(data);
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create",
				type: "POST",
				data: formdata,
				dataType: "json",
				// async: false,
				success: function(data){
					//console.log(data);
					if (data.code == 1) {
						window.location.reload(true);
					} else{
						alert(data.message);
					}
				},
				error: function(one, two, three){
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					// $(".part_type").removeAttr('disabled');
				}
			});
                    }
		}

		function deleteDraft (ev) {
                    if(confirm("Are you sure you want to cancel?")){
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create/delete",
				type: "POST",
				data: "ros_no="+$(ev.currentTarget).data("ros_no"),
				dataType: "json",
				success: function(data){
					if (data.code == "1") {
						alert("Deleted successfully.");
						window.location.reload(true);
						// location.reload(true);
					} else {
						alert(data.message);
					}
				},
				error: function(one, two, three){
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					inputs.removeAttr("disabled");
				}
			});
                    }
		}
                
                $('#export').click(function(){
                    var form = $("#create_frm");
                    var data = form.serialize();
                    window.open("<?php echo base_url(); ?>index.php/excel/filtered/?" + data);
                })

	});
</script>