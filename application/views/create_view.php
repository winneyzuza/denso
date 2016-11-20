<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/create.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/jquery-ui-1.9.2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/select2.min.css">
    

<form method="POST" id="create_frm">
        <div id="tabs">
	<div id="save_draft" title="<?php echo lang('create_save_draft'); ?>" data-action="<?php echo (isset($ros_info['ros_no']) AND $ros_info['status']=='Draft')?('update'):('add'); ?>"></div>
	<div id="del_draft" title="<?php echo lang('create_delete_draft'); ?>" data-rosno="<?php echo (isset($ros_info['ros_no']) AND $ros_info['status']=='Draft')?($ros_info['ros_no']):('0'); ?>"></div>
        <div id="printform"></div>
        <div id="searchform"></div>
		<ul id="tabs_list">
			<li><a href="#page_1"><?php echo lang('create_menu_dealer_info'); ?></a></li>
			<li><a href="#page_2"><?php echo lang('create_menu_car_info'); ?></a></li>
			<!-- <li><a href="#page_2"><?php //echo lang('create_menu_car_prob'); ?></a></li> -->
			<!-- <li><a href="#page_3"><?php echo lang('create_menu_part_exchange'); ?></a></li> -->
		</ul>
                 <div id="page_1" class="frm_part">
			<?php 
                            if($dealer_status===$user_role_admin) {
                               
                        ?>
                        <table>
                                
				<tr>
					<td><?php echo lang('create_service_dealer_name'); ?></td>
                                        <td>
                                            <select name="sd_id" id="sd_id" class="select2">
                                                <option value="<?php echo $this->session->userdata('sd_id')?>" selected="selected">
                                                        <?php if(isset($sd_info[lang('create_sd_name')])){
                                                            echo $sd_info[lang('create_sd_name')]; 
                                                        }else{
                                                            echo "- - - - - - - ". lang('create_service_dealer_name'). " - - - - - - - -" ;
                                                        } 
                                                        
                                                        ?></option>
                                                    <?php foreach ($service_dealers as $key => $row) { ?>
                                                        <option value="<?php echo $row['sd_id'] ?>"><?php echo $row[lang("create_sd_name")] ?></option>
                                                    <?php } ?>
                                            </select>
                                        </td>
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_address'); ?></td>
                                        <td style="width:400px;" ><u><b id="address"><?php if(isset($sd_info['address'])) echo $sd_info['address']; ?></b></u></td>							<!-- FETCH FROM THE DATABASE -->
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_telephone'); ?></td>
                                        <td style="width:400px;"><u><b id="tel"><?php if(isset($sd_info['phone'])) echo $sd_info['phone']; ?></b></u></td>								<!-- FETCH FROM THE DATABASE -->
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_fax'); ?></td>
                                        <td style="width:400px;"><u><b id="fax"><?php if(isset($sd_info['fax'])) echo $sd_info['fax']; ?></b></u></td>								<!-- FETCH FROM THE DATABASE -->
				</tr>
			</table>
                    <?php } else {?>
                    
                        <table>
				<tr>
                                        <td><?php echo lang('create_service_dealer_name'); ?></td>
                                        <td style="width:400px;"><u><b><?php if(isset($sd_info[lang('create_sd_name')])) echo $sd_info[lang('create_sd_name')]; ?></b></u></td>						<!-- FETCH FROM THE DATABASE -->
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_address'); ?></td>
					<td style="width:400px;"><u><b><?php if(isset($sd_info['address'])) echo $sd_info['address']; ?></b></u></td>							<!-- FETCH FROM THE DATABASE -->
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_telephone'); ?></td>
					<td style="width:400px;"><u><b><?php if(isset($sd_info['phone'])) echo $sd_info['phone']; ?></b></u></td>								<!-- FETCH FROM THE DATABASE -->
				</tr>

				<tr>
					<td><?php echo lang('create_service_dealer_fax'); ?></td>
					<td style="width:400px;"><u><b><?php if(isset($sd_info['fax'])) echo $sd_info['fax']; ?></b></u></td>								<!-- FETCH FROM THE DATABASE -->
				</tr>
			</table>
                    <?php } ?>
			<br/><br/><br/><hr/>
			<h2><?php echo lang('create_menu_dealer_info'); ?><span class="required">*</span></h2>
			<label><?php echo lang('create_car_maker'); ?><span class="required">*</span>
				<select name="maker_id" id="maker" class="req_field">
                                    <option value="" selected><?php echo lang('create_car_maker'); ?></option>
					<?php foreach ($car_makers as $key => $row) { ?>
					<option value="<?php echo $row['maker_id'] ?>"><?php echo $row[lang("create_car_maker_column")] ?></option>
					<?php } ?>
				</select>
			</label>
			<br/>
			<br/>
			<h3><?php echo lang('create_filter_dealers'); ?></h3>
			<label>
				<?php echo lang('create_filter_region'); ?>
				<select id="filter_province">
					<option>All</option>
					<?php foreach ($regions as $key => $value) {
						echo "<option>".$value[lang('create_region_column')]."</option>";
					} ?>
				</select>
			</label>
			<label>
				<?php echo lang('create_filter_province'); ?>
				<select id="filter_dealer">
					<option class="All">All</option>
					<?php foreach ($provinces as $key => $value) {
						echo "<option class='".$value[lang('create_region_column')]." All' value='".$value[lang('create_province_column')]."'>".$value[lang('create_province_column')]."</option>";
					} ?>
				</select>
			</label>
			<br/>
			<br/>
			<br/>
			<label>
				<?php echo lang('create_dealer_name'); ?><span class="required">*</span>
				<div id="dealer_div">
					<input type="text" id="dealer_txt" style="position:absolute;width:300px;height:23px;" class="req_field" />
					<i class="fa fa-angle-down fa-2x" id="autocomplete_drop"></i>
					<!-- <button type="button" id="autocomplete_drop">\/</button> -->
					<select name="dealer_id" style="width:250px;" id="dealer_name" class="req_field">
						<option value=""><?php echo lang('create_general_select'); ?></option>
					</select>
	                 <?php if(isset($sd_info[lang('create_sd_name')]) && $this->session->userdata("sd_id") != ''){ ?>
	                     <label id="frontshop_label"><input type="checkbox" id="frontshop" /> <?php echo lang('create_front_shop') ?></label>
	                 <?php } ?>
				</div>
			</label>
			<br/><br/>
			<h2><?php echo lang('create_part_type'); ?><span class="required">*</span></h2>
                        <select name="part_id" class="part_type" disabled id="part_id">
				<!-- <option value=""><?php echo lang('create_part_type'); ?></option> -->
				<?php foreach ($part_types as $key => $value) {
					echo "<option value='".$value['part_id']."' data-prefix='".$value['table_prefix']."'>".$value[lang('create_part_type_column')]."</option>";
				} ?>
			</select>
			<!-- <label><input type="radio" class="part_type" value="pump" disabled /> <?php echo lang('create_supply_pump'); ?>
				<input type="hidden" name="supply_pump" value="true" />
			</label>
			<label><input type="radio" class="part_type" value="injector" disabled/><?php echo lang('create_injector'); ?>
				<input type="hidden" name="injector" value="false" />
			</label> -->
			<br/><br/>
			<button type="button" class="blue_back button next_tab" style="margin-left: 65%;"><?php echo lang('create_next'); ?></button>
		</div>
		<div id="page_2" class="frm_part">
			<table class="frm_table">
            	<tobody>
                	<tr>
                    	<td class="width-120"></td>
                        <td class="width-200"></td>
                        <td class="width-120"></td>
                        <td class="width-150"></td>
                        <td class="width-150"></td>                        
                        <td class="width-200"></td>
                   	</tr>
                </tbody>			
				<!-- <tr class="empty_row"></tr>
				<tr>
					<td><?php echo lang('create_car_maker'); ?></td>
					<td>
						<select name="car_maker">
							<option value=""><?php echo lang('create_general_select'); ?></option>
						</select>
					</td>
					<td><?php echo lang('create_dealer_name'); ?></td>
					<td colspan="3">
						<select name="dealer_name">
							<option value=""><?php echo lang('create_general_select'); ?></option>
						</select>
					</td>
				</tr> -->
				<tr>
					<td><?php echo lang('create_car_model'); ?><span class="required">*</span></td>
					<td>
						<select name="car_model" class="req_field">
							<option value=""><?php echo lang('create_general_select'); ?></option>
						</select>
					</td>
					<td><?php echo lang('create_frame_number'); ?><span class="required">*</span></td>
					<td style="white-space: nowrap;">
						<input type="text" name="frame_no" placeholder="<?php echo lang('create_frame_number'); ?>" class="req_field">
					</td>
					<td><?php echo lang('create_engine_number'); ?><span class="required">*</span></td>
					<td style="white-space: nowrap;">
                    	<input type="text" name="engine_no" placeholder="<?php echo lang('create_engine_number'); ?>" class="req_field">
                  	</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
               		<td><label><input type="checkbox" id="frame_indiscernible"/><?php echo lang('create_indiscernible'); ?></label></td>
               		<td></td>
               		<td><label><input type="checkbox" id="engine_indiscernible"/><?php echo lang('create_indiscernible'); ?></label></td>
				</tr>				
				<tr class="empty_row"></tr>
				<tr>
					<td><?php echo lang('create_engine_model'); ?><span class="required">*</span></td>
					<td>
						<select name="engine_model" class="req_field">
							<option value=""><?php echo lang('create_general_select'); ?></option>
						</select>
					</td>
					<td><?php echo lang('create_year'); ?></td>
					<td><input type="text" name="year" placeholder="<?php echo lang('create_year'); ?>"></td>
					<td><?php echo lang('create_plate_no'); ?></td>
					<td><input type="text" name="plate_no" placeholder="<?php echo lang('create_plate_no'); ?>"></td>
				</tr>
				<tr class="empty_row"></tr>
				<tr>
					<td><?php echo lang('create_delivery_date'); ?><span class="required">*</span></td>
					<td>
						<input type="text" name="delivery_date" placeholder="<?php echo lang('create_delivery_date'); ?>" class="date req_field" readonly="readonly">
					</td>
					<td><?php echo lang('create_repair_date'); ?><span class="required">*</span></td>
					<td><input type="text" name="repair_date" placeholder="<?php echo lang('create_repair_date'); ?>" class="date req_field" readonly="readonly"></td>
					<td><?php echo lang('create_mileage'); ?><span class="required">*</span></td>
					<td><input type="text" name="mileage" placeholder="<?php echo lang('create_mileage'); ?>" class="req_field"></td>
				</tr>
				<tr>
					<td></td>
               		<td><label><input type="checkbox" id="chkbox_delivery_date"/><?php echo lang('create_indiscernible'); ?></label></td>
               		<td></td>
               		<td></td>
               		<td></td>
               		<td><label><input type="checkbox" id="chkbox_mileage"/><?php echo lang('create_indiscernible'); ?></label></td>
				</tr>
                <!--For IE8 bug-->
                <tr>
                    <td><input type="text" name="dummy" class="date hidden" readonly="readonly" disabled hidden></td>
                </tr>
				<tr class="empty_row"></tr>
				<tr>
					<td><?php echo lang('create_warranty_condition'); ?></td>
					<td colspan="3">
						<label><input type="radio" name="warranty" value="in" disabled> <?php echo lang('create_warranty_in'); ?></input></label>
						<label><input type="radio" name="warranty" value="out" disabled> <?php echo lang('create_warranty_out'); ?></input></label>
					</td>
					<td colspan="2"><?php //echo lang('create_status_of_ros'); ?></td>
				</tr>
				<tr class="empty_row"></tr>
				<tr>
					<td><?php echo lang('create_car_problem'); ?><span class="required">*</span></td>
					<td colspan="2">
						<select name="car_problem" class="req_field">
							<option value=""><?php echo lang('create_general_select'); ?></option>
							<?php //foreach ($problems as $key => $value) {
								//echo "<option value='".$value['id']."'>".$value[lang('create_problems_column')]."</option>";
							//} ?>
						</select>
					</td>
					<td><?php echo lang('create_others'); ?></td>
					<td colspan="2"><input type="text" name="car_problem_other" placeholder="<?php echo lang('create_others'); ?>" disabled /></td>
				</tr>
				<!-- <tr class="empty_row"></tr> -->
				
				<tr class="empty_row"></tr>
				<tr class="empty_row"></tr>
				<tr>
					<td><button type="button" class="blue_back button prev_tab"><?php echo lang('create_back'); ?></button></td>
					<td colspan="3"></td>
					<td><button type="button" class="blue_back button next_tab" ><?php echo lang('create_next'); ?></button></td>
				</tr>
			</table>
		</div>
		
	</div>
	<br/><br/>
	<!-- <button type="button" class="blue_back button"><?php //echo lang('create_save_draft'); ?></button> -->
</form>

<!--script src="<?php echo base_url(); ?>application/assets/js/jquery-2.1.3.min.js"></script-->
<script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/jquery.datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/jquery.deserialize.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/select2.min.js"></script>

<!--script src="<?php echo base_url(); ?>application/assets/js/jquery-ui.min.js"></script-->
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->
<script>
	$(document).ready(function(){
        $(".select2").select2();
        // SHOW SOME FANCY LOADING
	var warranty_info = {};
        var frontd = '<option value="<?PHP echo $this->session->userdata("sd_id"); ?>"><?PHP if(isset($sd_info[lang('create_sd_name')])) echo $sd_info[lang('create_sd_name')]; ?></option>';
        var fronto = '<?PHP if(isset($sd_info[lang('create_sd_name')])) echo $sd_info[lang('create_sd_name')]; ?>';
        var ajaxd = '<option value=""><?php echo lang('create_general_select'); ?></option>';
        var provinces = $("#filter_dealer").contents();
        var source = [];
		var formdata = <?php echo isset($ros_info)?json_encode($ros_info):"null"; ?>;

		$('#tabs').tabs();
		fixtabs();

		function showLoader(){
			hideLoader();
			$('body').append("<div id='mask'><div id='loader'><img src='<?php echo base_url(); ?>application/assets/images/ajax-loader.gif' alt='loading'></div></div>");
		}

		function hideLoader(){
			$("#mask").remove();
		}

		$.widget("custom.densoCombo",$.ui.autocomplete, {
			_renderMenu: function( ul, items ) {
				var that = this;
				var desired = $("#filter_dealer option:selected").val();
				$.each( items, function( index, item ) {
					if(item.class1 == desired || item.class2 == desired)
					that._renderItemData( ul, item );
				});
			}
		});

		// console.log(formdata);
		if (formdata!=null) {
            $("input[name='car_condition_other']").prop("disabled", false);
            $("input[name='fuel_condition_other']").prop("disabled", false);
            $("input[name='parts_condition_other']").prop("disabled", false);
            $("input[name='car_problem_other']").prop("disabled", false);
			$('body').append("<div id='mask'><div id='loader'><img src='<?php echo base_url(); ?>application/assets/images/ajax-loader.gif' alt='loading'></div></div>");
			console.log("\n\n\nFields:");
			$("#create_frm").deserialize(formdata,{"change":change, "complete":complete});
			console.log("End of Fields\n\n\n");
		}
		function change (value,element) {
			// CUSTOM OPERATIONS ON CHANGE (AJAX DATA)
			console.log(element);
			switch(element){
				case "maker_id":
					maker_change();
				break;

				case "dealer_id":
					$("#dealer_txt").val($("#dealer_name option:selected").text());
					dealer_change(value);
				break;

				case "part_id":
					part_change({currentTarget : $('.part_type')});
				break;

				case "car_model":
					model_change();
				break;

				case "engine_model":
					engine_change();
				break;

				case "delivery_date":
				case "repair_date":
					if (value!=null){
						addDate(new Date(value),$("input[name='"+element+"']"),"loaded");
					}
				break;

				case "mileage":
					if (value!=null){
						mileage_change();
					}
				break;

				case "part_failure_pn":
					failure_change();
                break;
	                    
                case "car_condition":
                case "fuel_condition":
                case "parts_condition":
                    radio_change();
                break;
                
                case "car_problem":
                    car_problem_change();
                break;
                
                case "sd_id":
                    service_name_change();
                break;
                        
                case "frame_no":
                case "engine_no":
                    frame_init();
				break;
			}
		}

		function dealer_change (dealer_id) {
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create/getfilters",
				type: "POST",
				data: "dealer_id="+dealer_id,
				dataType: "json",
				async: true,
				success: function(data){
					if (data.code == 1) {
						var _class = $("#filter_dealer option[value='"+data.message+"']").attr("class").replace(" All","");
						$("#filter_province").val(_class);
						$("#filter_dealer").val(data.message);
						$("#filter_dealer option:not(."+_class+")").remove();
					}
				},
				error: function(one, two, three){
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					delete warranty_info["maker_id"];
				}
			});
		}
                
        $("select[name='sd_id']").on("change",service_name_change);
        
        function service_name_change(){
            var sd_id = $(this).val();
            $('#part_id')
                .empty()
            ;
            
            <?PHP if($this->session->userdata('lang') == 'th') {?>
               $('#maker').val($("#maker option:contains('ยี่ห้อ')").val()); 
            <?PHP } ?>

            <?PHP if($this->session->userdata('lang') == 'en') {?>
                $('#maker').val($("#maker option:contains('TO')").val()); 
            <?PHP } ?> 
            $.ajax({

                    url: "<?php echo base_url(); ?>index.php/create/getAddress",
                    type: "POST",
                    data: "sid="+sd_id,
                    dataType: "json",
                    async: true,
                    catch:false,
                    success: function(data){
                             $("#address").html(data.address);   
                             $("#phone").html(data.phone);
                             $("#fax").html(data.fax);
                             
                    },
                    error: function(){
                            alert("Error with response");
                    }        
                   
            });
            var lang = $("#lang_select").val();
            $.ajax({
                    url: "<?php echo base_url(); ?>index.php/create/getPartTypes",
                    type: "POST",
                    data: "sid="+sd_id,
                    dataType: "json",
                    async: true,
                    catch:false,
                    
                    success: function(data){
                       var toAppend = '';
                        //if(typeof data === 'object'){
                            if(lang == 'th'){
                                $name_lang = 'name_th';
                            }else{
                                $name_lang = 'name_eng';
                            }
                            for(var i=0;i<data.length;i++){
                                toAppend += '<option value=' + data[i]['part_id']+ ' data-prefix=' + data[i]['table_prefix'] +  '>'+data[i][$name_lang]+'</option>';
                            }
                        //}
                        $('#part_id').append(toAppend);

       
                    },
                    error: function(){
                            alert("Error with response");
                    }        
            });
            $('#dealer_name').html("<option selected value=''><?php echo lang('create_general_select'); ?></option>");
            destroyAutoComplete();
        }
        
        $("select[name='car_problem']").on("change",car_problem_change);
        
        function car_problem_change(){
            if($("select[name='car_problem']").val() == 10 || $("select[name='car_problem']").val() == 20 || $("select[name='car_problem']").val() == 31 || $("select[name='car_problem']").val() == 37){
                $("input[name='car_problem_other']").prop("disabled", false);
            }
            else{
                $("input[name='car_problem_other']").prop("disabled", true);
            }
        }
        
        function frame_init(){
            if($("input[name='frame_no']").val() == 'XXXXX'){
                $("#frame_indiscernible").prop("checked", true);
                $("input[name='frame_no']").prop("readonly", true);
            }
            if($("input[name='engine_no']").val() == 'XXXXX'){
                $("#engine_indiscernible").prop("checked", true);
                $("input[name='engine_no']").prop("readonly", true);
            }

            if($("input[name='delivery_date']").val() == 'XXXXX'){
                $("#chkbox_delivery_date").prop("checked", true);
                $("input[name='delivery_date']").prop("readonly", true);
            }

            if($("input[name='mileage']").val() == 'XXXXX'){
                $("#chkbox_mileage").prop("checked", true);
                $("input[name='mileage']").prop("readonly", true);
            }
        }
        
        $("#frame_indiscernible").on("change",frame_change);
        $("#engine_indiscernible").on("change",frame_change);
        $("#chkbox_delivery_date").on("change",frame_change);
        $("#chkbox_mileage").on("change",frame_change);
        
        function frame_change(){
            if($("#frame_indiscernible").is(':checked')){
                $("input[name='frame_no']").val('XXXXX');
                $("input[name='frame_no']").prop("readonly", true);
            }
            else{
                $("input[name='frame_no']").prop("readonly", false);
                if($("input[name='frame_no']").val() == 'XXXXX'){
                	$("input[name='frame_no']").val('');
                }
            }
            if($("#engine_indiscernible").is(':checked')){
                $("input[name='engine_no']").val('XXXXX');
                $("input[name='engine_no']").prop("readonly", true);
            }
            else{
                $("input[name='engine_no']").prop("readonly", false);
                if($("input[name='engine_no']").val() == 'XXXXX'){
                	$("input[name='engine_no']").val('');
                }
            }

            if($("#chkbox_delivery_date").is(':checked')){
                $("input[name='delivery_date']").val('XXXXX');
                delivery_date_change();
                $("input[name='delivery_date']").prop("disabled", true);
            }
            else{
                $("input[name='delivery_date']").prop("disabled", false);
                if($("input[name='delivery_date']").val() == 'XXXXX'){
                	$("input[name='delivery_date']").val('');
                }
                delivery_date_change();
            }

            if($("#chkbox_mileage").is(':checked')){
                $("input[name='mileage']").val('XXXXX');
                $("input[name='mileage']").prop("readonly", true);
            }
            else{
                $("input[name='mileage']").prop("readonly", false);
                if($("input[name='mileage']").val() == 'XXXXX'){
                	$("input[name='mileage']").val('');
                }
            }

            mileage_change();
        }
        
        $(document).on("change","input[name='car_condition']",radio_change);
        $(document).on("change","input[name='fuel_condition']",radio_change);
        $(document).on("change","input[name='parts_condition']",radio_change);
        
        function radio_change(){
            if($("input[name='car_condition']:checked").val() != 'others'){
                $("input[name='car_condition_other']").prop("disabled", true);
            }
            else{
                $("input[name='car_condition_other']").prop("disabled", false);
            }
            
            if($("input[name='fuel_condition']:checked").val() == 'normal'){
                $("input[name='fuel_condition_other']").prop("disabled", true);
            }
            else{
                $("input[name='fuel_condition_other']").prop("disabled", false);
            }
            
            if($("input[name='parts_condition']:checked").val() != 'others'){
                $("input[name='parts_condition_other']").prop("disabled", true);
            }
            else{
                $("input[name='parts_condition_other']").prop("disabled", false);
            }
        }
        
        $('#frontshop').on('change', frontshop);
        
        function frontshop(){
            if($('#frontshop').is(':checked')){
                $('#dealer_name').html(frontd);
                
                <?PHP if($this->session->userdata('lang') == 'th') {?>
                    $("#dealer_txt").val("แลกเปลี่ยนหน้าร้าน");
                <?PHP } ?>
                    
                <?PHP if($this->session->userdata('lang') == 'en') {?>
                    $("#dealer_txt").val("Front Shop Exchange");
                <?PHP } ?> 
                    
                $("#dealer_txt").attr("readonly","readonly");
                destroyAutoComplete();
            }
            else{
                $('#dealer_name').html(ajaxd);
                $("#dealer_txt").val("");
                createAutoComplete(source);
                $("#dealer_txt").removeAttr("readonly");
            }
        }

        function createAutoComplete (source) {
        	var ul = $("<ul>");
        	$( "#dealer_txt" ).densoCombo({
				source: source,
				minLength: 0,
				select: function(event, ui){$("#dealer_txt").val(ui.item.label);$("#dealer_name").val(ui.item.value); return false;},
				focus: function(event, ui){/*$("#dealer_txt").val(ui.item.label);$("#dealer_name").val(ui.item.value);*/ return false;},
				change: function(event, ui){if (!ui.item) {alert("INVALID");$("#dealer_txt").val("");$("#dealer_name").val("");}}
		    });
		    $("#autocomplete_drop").on("click",function(){
		    	$( "#dealer_txt" ).focus();
		    	$( "#dealer_txt" ).densoCombo("search","");
		    });
        }

        function destroyAutoComplete () {
        	$("#dealer_txt").autocomplete();
        	$("#dealer_txt").autocomplete("destroy");
        	$("#autocomplete_drop").off("click");
        }

        $("#filter_province").on("change", filter_province);

        function filter_province () {
        	// ALTERNATE WAY COZ OF IE
        	var _class = $("#filter_province option:selected").val();
        	$("#filter_dealer").html(provinces);
        	$("#filter_dealer option:not(."+_class+")").remove();
        	// $("#filter_dealer ."+_class+":first").attr("selected","selected");
        	filter_dealer();
        	// ALTERNATE WAY

        	// var _class = $("#filter_province option:selected").val();
        	// $("#filter_dealer .All").hide().attr("disabled","disabled");
        	// $("#filter_dealer ."+_class).show().removeAttr("disabled");$("#filter_dealer ."+_class+":first").attr("selected","selected");
        	// filter_dealer();
        }

        $("#filter_dealer").on("change", filter_dealer);

        function filter_dealer () {
        	$("#dealer_txt").val("");
        }
                
		function complete () {
			// HIDE THE FANCY LOADER
            <?PHP
                if(isset($ros_info['dealer_id'])){
                    if(strpos($ros_info['dealer_id'], 'SD') !== false){
                        echo "$('#frontshop').prop('checked', true);";
                        echo "frontshop();";
                    }
                }
            ?>
			// console.log("Done loading data.");
			hideLoader();
		}
                
        $('.date').datepicker({
            dateFormat:'dd-mm-yy',
            yearRange:'-50:+10',
            changeMonth:true,
            changeYear:true,
            <?PHP if($this->session->userdata('lang') == 'th'){ ?>
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
            <?PHP } ?>
            onSelect: addDate
        });

		function fixtabs(){
			$("#tabs").tabs("refresh");
			var currenttab = $("#tabs").tabs("option","active");
			var indices = [];
			$("#tabs_list>li").each(function(index,element){indices.push(index);});
			indices.splice(currenttab,1);
			$("#tabs").tabs("option","disabled",false);
			$("#tabs").tabs("option","disabled",indices);
		}

		function addDate (date, field, event) {
            if(event == 'loaded'){
                field_name = (field).attr("name");
                field_value = (date).dateFormat("Y-m-d");
            }
            else{
                field_name = this.name;
                field_value = date;
            }
			warranty_info[field_name] = field_value;
			getwarranty();
		}

		$(document).on("change blur","input[name='delivery_date']",delivery_date_change);


		function delivery_date_change(){
			warranty_info["delivery_date"] = $("input[name='delivery_date']").val();
			getwarranty();
		}

		$(document).on("change blur","input[name='mileage']",mileage_change);


		function mileage_change(){
			warranty_info["mileage"] = $("input[name='mileage']").val();
			getwarranty();
		}

		function injector_check () {
			$(".part_type").each(function(){
				var _me = $(this);
				if (_me.siblings("input[type='hidden']").val() == "true") {
					_me.prop("checked",true);
					part_change({currentTarget: _me});
				} else {
					_me.prop("checked", false);
				}

			});
		}

		function clear_warranty(){
			$("input[name='warranty']").prop("checked", false).attr("disabled","disabled");
		}
		
		function getwarranty () {
			// console.log(warranty_info);
			var warrantycount = 0;
            $.each(warranty_info, function (key, value){
            	if(value!=""){
                	warrantycount++;
            	}
            });
			if (warrantycount != 3) {
				clear_warranty();
				// console.log("Not enough info.");
			} else{
				warranty_info["maker_id"] = $('#maker option:selected').val();
                warranty_info['repair_date'] = $("input[name='repair_date']").val();
                warranty_info['delivery_date'] = $("input[name='delivery_date']").val();
				data = $.param(warranty_info);			//SERIALIZE THE OBJECT TO SEND IN AJAX
				// console.log("Sending request....");
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getwarranty",
					type: "POST",
					data: data,
					dataType: "json",
					async: false,
					success: function(data){
						if (data.code == 1) {
							$("input[name='warranty']").each(function(index, element){
								var radio = $(this);
								radio.attr("disabled","disabled");
								if(radio.val() == data.warranty){
									radio.removeAttr("disabled");
									radio.prop("checked","checked");
								}
							});
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
						delete warranty_info["maker_id"];
					}
				});
			}
		}

		$(document).on('click',".next_tab",function(){
			var button = $(this);
			var fields = button.parents('div.frm_part').find(".req_field");
			var error = 0;
			fields.each(function(){
				var input = $(this);
				if (input.val() == "" || input.val() == null) {
					input.addClass("error");
					error = 1;
				} else{
					input.removeClass("error");
				}
			});
			if (error == 0) {
				var currenttab = $("#tabs").tabs("option","active");
				var temp = [];
				$("#tabs_list>li").each(function(index,element){temp.push(index);});
				temp.splice(currenttab+1,1);
				$("#tabs").tabs("option","disabled",false);
				var nextid = button.parents('div').next('div').attr('id');
				var nexttab = $('#tabs a[href="#'+nextid+'"]');
				nexttab.click();
				$('#side_bar').height($('#tabs').height() + 7);
				$("#tabs").tabs("option","disabled",temp);
			} else{
				alert("VALIDATION ERROR");
			}
		});

		$(document).on('click',".prev_tab",function(){
			var currenttab = $("#tabs").tabs("option","active");
			var temp = [];
			$("#tabs_list>li").each(function(index,element){temp.push(index);});
			temp.splice(currenttab-1,1);
			$("#tabs").tabs("option","disabled",false);
			var button = $(this);
			var nextid = button.parents('div').prev('div').attr('id');
			var nexttab = $('#tabs a[href="#'+nextid+'"]');
			nexttab.click();
			$('#side_bar').height($('#tabs').height() + 7);
			$("#tabs").tabs("option","disabled",temp);
		});

		$('#tabs a').click(function(){
			$('#side_bar').height($('#tabs').height() + 7);
			return false;
		});
		$('#side_bar').height($('#tabs').height() + 7);

		$('#maker').on('change',maker_change);

		function maker_change () {
			var maker_id = $('#maker option:selected').val();
                        var sd_id = $("select[name='sd_id']").val();
                        $("#dealer_txt").val("");
			if (maker_id!="") {
				$('.part_type').removeAttr("disabled");
				// var temp = $(".part_type")[0];
				// $(temp).trigger("change");
				$('#maker').attr('disabled','disabled');
                                
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getdealers",
					type: "POST",
					data: {maker_id: maker_id, sd_id :sd_id },
					dataType: "json",
					async: false,
					success: function(data){
						//console.log(data);
						if (data.code == "1") {
							ajaxd = data.message;
							source = $.parseJSON(data.arrayObject);
							createAutoComplete(source);
                            frontshop();
						} else {
							alert(data.message);
							$('#dealer_name').html("<option selected value=''><?php echo lang('create_general_select'); ?></option>");
							destroyAutoComplete();
						}
					},
					error: function(one, two, three){
						//console.log(one);
						//console.log(two);
						//console.log(three);
					},
					complete: function(){
						$('#maker').removeAttr('disabled');
					}
				});
				//console.log("CHAGNED PART");
				$($(".part_type:first")[0]).removeAttr("disabled");
				part_change({currentTarget : $('.part_type')});
			} else{
                               $('#dealer_name').html("<option selected value=''><?php echo lang('create_general_select'); ?></option>");
                               destroyAutoComplete();
				frontshop();
			}
		}

		$(document).on('click','#frm_submit, #save_draft',function(){
			showLoader();
			var button = $(this);
			var form = $("#create_frm");
			var data = form.serialize();
			var draft = button.attr("id")=="frm_submit"?"false":"true";
			var action = button.data("action");
            if($('select[name="part_failure_pn"]').val()=='' && draft == 'false' && !$('select[name="part_failure_pn"]').parents('tr').hasClass('hidden')
              || $('select[name="part_failure_pn_inj"]').val()=='' && draft == 'false' && !$('select[name="part_failure_pn_inj"]').parents('tr').hasClass('hidden')      
              ){
                $('select[name="part_failure_pn"]').addClass("error");
                alert("VALIDATION ERROR");
                hideLoader();
                return false;
            }
            else{
                $('select[name="part_failure_pn"]').removeClass("error");
                $('select[name="part_failure_pn_inj"]').removeClass("error");
            }
			var maker_name = $('#maker:checked').parent('label').text();
			var inputs = form.find("input, select");
			inputs.attr("disabled","disabled");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create",
				type: "POST",
				data: data+"&maker_name="+maker_name+"&action="+action+"&draft="+draft+"&ros_no=<?php echo isset($ros_info['ros_no'])?$ros_info['ros_no']:''; ?>",
				dataType: "json",
				success: function(data){
					if (data.code == "1") {
						alert("Added " + data.ross + " successfully.");
						window.location.href="<?php echo base_url(); ?>index.php/manage";
						// location.reload(true);
					} else {
						alert(data.message);
					}
				},
				error: function(one, two, three){
					console.log(one);
					console.log(two);
					console.log(three);
					alert("Can't contact the server right now.");
				},
				complete: function(){
					inputs.removeAttr("disabled");
					hideLoader();
				}
			});
		});

        $('#searchform').on('click',function(){
            /* alert('Opening new window to search function.'); */
            window.open("<?php echo base_url(); ?>index.php/create/searchform");
		});
		          
            $('#printform').on('click',function(){
            alert('Opening new window to print!');
			var form = $("#create_frm");
			var data = form.serialize();
			var compressor_repair_name = $("select[name='compressor_repair_id'] option:selected").text();
			var compressor_type = $("select[name='compressor_type_id'] option:selected").text();
			var inputs = form.find("input, select");
            window.open("<?php echo base_url(); ?>index.php/create/printform/?" + data+"&compressor_type="+compressor_type+"&compressor_repair_name="+compressor_repair_name+"&CarMaker="+$("#maker option:selected").text()+"&ros_no=<?php echo isset($ros_info['ros_no'])?$ros_info['ros_no']:''; ?>");
		});
                
		$('#del_draft').on('click',function(){
			var button = $(this);
			var form = $("#create_frm");
			var inputs = form.find("input, select");
			inputs.attr("disabled","disabled");
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create/delete",
				type: "POST",
				data: "ros_no=<?php echo isset($ros_info['ros_no'])?$ros_info['ros_no']:''; ?>",
				dataType: "json",
				success: function(data){
					if (data.code == "1") {
						alert("Deleted successfully.");
						window.location.href="<?php echo base_url(); ?>index.php/manage";
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
		});

		$(".part_type").on("change",part_change);

		function part_change(ev){
			//console.log(ev.currentTarget);
			var _this = ev.currentTarget;
			// var radio = $(_this);
			var selected = $(_this).find(":selected");
			// $(".part_type").attr("disabled","disabled");
			// $(".parttype").addClass("hidden");
			// $(".part_type").each(function(){
			// 	$(this).prop("checked",false);
			// 	$(this).siblings("input[type='hidden']").val("false");
			// 	// console.log($(this));
			// });
			// radio.prop("checked",true);
			// $("."+radio.val()).removeClass("hidden");
			$(".dynamic_content").remove();
			var table_prefix = selected.data("prefix");
			var part_id = selected.val();

			var new_tab_id = (($("#tabs_list>li").length)+1);
			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create/gettabs",
				type: "POST",
				data: "part_type="+(table_prefix),
				dataType: "json",
				async: false,
				success: function(data){
					//console.log(data);
					if (data.code == "200") {
						var tmp = new_tab_id;
						$("#tabs_list").append(data.tabs.replace(/id_here/g,function(){return "page_"+(tmp++);}));
						tmp = new_tab_id;
						$("#tabs").append(data.tab_content.replace(/id_here/g,function(){return "page_"+(tmp++);}));
						fixtabs();
					} else{
						alert("Couldn't get the data from server (input data error). Please try again later.");
					}
				},
				error: function(one, two, three){
					alert("Couldn't get the data from server (Server side error). Please try again later.");
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					$(".part_type").removeAttr('disabled');
				}
			});

			//console.log(table_prefix);
			$("."+table_prefix).removeClass("hidden");
			// radio.siblings("input[type='hidden']").val("true");
            $("select[name='engine_model']").html("<option value=''>Select</option>");

            $.ajax({
				url: "<?php echo base_url(); ?>index.php/create/getcarproblems",
				type: "POST",
				data: "part_id="+(part_id),
				dataType: "json",
				async: false,
				success: function(data){
					//console.log(data);
					if (data.code == "200") {
						$('select[name="car_problem"]').html(data.message);
					} else{
						$('select[name="car_problem"]').html("<option value=''>Select</option>");
					}
				},
				error: function(one, two, three){
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					$(".part_type").removeAttr('disabled');
				}
			});

			$.ajax({
				url: "<?php echo base_url(); ?>index.php/create/getcarmodels",
				type: "POST",
				data: "maker_id="+($("#maker option:selected").val())+"&part_type="+(table_prefix),
				dataType: "json",
				async: false,
				success: function(data){
					//console.log(data);
					if (data.code == "200") {
						$('select[name="car_model"]').html(data.message);
					} else{
						$('select[name="car_model"]').html("<option value=''>Select</option>");
					}
				},
				error: function(one, two, three){
					//console.log(one);
					//console.log(two);
					//console.log(three);
				},
				complete: function(){
					$(".part_type").removeAttr('disabled');
				}
			});
			
		}

		
		$('select[name="car_model"]').on("change",model_change);

		function model_change(){
			var value = $('select[name="car_model"] option:selected').val();
			if (value!="") {
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getenginemodels",
					type: "POST",
					data: "maker_id="+($("#maker option:selected").val())+"&part_type="+($(".part_type").find(":selected").data("prefix"))+"&car_model="+value,
					dataType: "json",
					async: false,
					success: function(data){
						//console.log(data);
						if (data.code == "200") {
							$('select[name="engine_model"]').html(data.message);
						} else{
							$('select[name="engine_model"]').html("<option value=''>Select</option>");
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
                
        $('select[name="engine_model"]').on("change",engine_change);

    	function engine_change(){
			var value = $('select[name="engine_model"] option:selected').val();
			if (value!="") {
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getfailuremodels",
					type: "POST",
					data: "maker_id="+($("#maker option:selected").val())+"&part_type="+($(".part_type").find(":selected").data("prefix"))+"&car_model="+$('select[name="car_model"] option:selected').val()+"&engine_model="+value,
					dataType: "json",
					async: false,
					success: function(data){
						//console.log(data);
						if (data.code == "200") {
                            $('select[name="part_failure_pn"]').html(data.message);
                            $('select[name="part_failure_pn_inj"]').html(data.message);
						} else{
							$('select[name="part_failure_pn"]').html("<option value=''>Select</option>");
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
                
    	$(document).on("change",'select[name="part_failure_pn"]',failure_change);
    	
		function failure_change(){
            var value = $('select[name="part_failure_pn"] option:selected').val();
			if (value!="") {
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getexchangemodels",
					type: "POST",
					data: "maker_id="+($("#maker option:selected").val())+"&part_type="+($(".part_type").find(":selected").data("prefix"))+"&car_model="+$('select[name="car_model"] option:selected').val()+"&engine_model="+$('select[name="engine_model"] option:selected').val()+"&car_maker_PN="+value,
					dataType: "json",
					async: false,
					success: function(data){
						//console.log(data);
						if (data.code == "200") {
                            $("input[name='part_exchange_pn']").val(data.message);
                            $("#part_code").html("<input type='hidden' name='part_code' value='"+data.part_code+"' />");
						} else{
							$('input[name="part_exchange_pn"]').val('');
							$("#part_code").html("");
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
                
                $(document).on("change",'select[name="part_failure_pn_inj"]',failure_change1);
    	
		function failure_change1(){
            var value = $('select[name="part_failure_pn_inj"] option:selected').val();
			if (value!="") {
				$.ajax({
					url: "<?php echo base_url(); ?>index.php/create/getexchangemodels",
					type: "POST",
					data: "maker_id="+($("#maker option:selected").val())+"&part_type="+($(".part_type").find(":selected").data("prefix"))+"&car_model="+$('select[name="car_model"] option:selected').val()+"&engine_model="+$('select[name="engine_model"] option:selected').val()+"&car_maker_PN="+value,
					dataType: "json",
					async: false,
					success: function(data){
						//console.log(data);
						if (data.code == "200") {
                            $("input[name='part_exchange_pn_inj']").val(data.message);
                            $("#part_code").html("<input type='hidden' name='part_code' value='"+data.part_code+"' />");
						} else{
							$('input[name="part_exchange_pn_inj"]').val('');
							$("#part_code").html("");
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
                
                $('input[name="year"]').on('keyup', function(){
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
                $('input[name="mileage"]').on('keyup', function(){
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
                
//		$('select[name="failure_pn"]').on("change",function(){
//			var value = $('select[name="failure_pn"] option:selected').data("exchange");
//			$("input[name='exchange_pn']").val(value);
//		});
	});
</script>