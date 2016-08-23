<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/create.css">
<form method="POST" action="final">
	<table>
		<tr>
			<td><?php echo lang('create_exchange_part'); ?></td>
			<td colspan="3"></td>
			<td colspan="2" class="blue_back"><?php echo lang('create_status_of_ros'); ?></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><label><input type="checkbox" name="supply_pump" /> <?php echo lang('create_supply_pump'); ?></label></td>
			<td>
				<select name="car_maker">
					<option>Select</option>
				</select>
			</td>
			<td><?php echo lang('create_dealer_name'); ?></td>
			<td colspan="3">
				<select name="dealer_name">
					<option>Select</option>
				</select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_car_model'); ?></td>
			<td>
				<select name="car_model">
					<option>Select</option>
				</select>
			</td>
			<td><?php echo lang('create_frame_number'); ?></td>
			<td><input type="text" name="frame_no" placeholder="<?php echo lang('create_frame_number'); ?>"></td>
			<td><?php echo lang('create_engine_number'); ?></td>
			<td><input type="text" name="engine_no" placeholder="<?php echo lang('create_engine_number'); ?>"></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_engine_model'); ?></td>
			<td>
				<select name="engine_model">
					<option>Select</option>
				</select>
			</td>
			<td><?php echo lang('create_year'); ?></td>
			<td><input type="text" name="year" placeholder="<?php echo lang('create_year'); ?>"></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_delivery_date'); ?></td>
			<td><input type="text" name="delivery_date" placeholder="<?php echo lang('create_delivery_date'); ?>"></td>
			<td><?php echo lang('create_repair_date'); ?></td>
			<td><input type="text" name="repair_date" placeholde="<?php echo lang('create_repair_date'); ?>"></td>
			<td><?php echo lang('create_mileage'); ?></td>
			<td><input type="text" name="mileage" placeholder="<?php echo lang('create_mileage'); ?>"></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_car_problem'); ?></td>
			<td colspan="2">
				<select name="car_problem">
					<option>Select</option>
				</select>
			</td>
			<td><?php echo lang('create_others'); ?></td>
			<td colspan="2"><input type="text" name="others" placeholder="<?php echo lang('create_others'); ?>"></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_dtc_code'); ?></td>
			<td><input type="text" name="dtc_code" placeholder="<?php echo lang('create_dtc_code'); ?>" /></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_car_condition'); ?></td>
			<td><label><input type="radio" name="car_condition" /> <?php echo lang('create_condition_original'); ?></label></td>
			<td><label><input type="radio" name="car_condition" /> <?php echo lang('create_condition_modify'); ?></label></td>
			<td><input type="text" name="car_condition_other" /></td>
			<td><?php echo lang('create_car_condition_ex'); ?></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_fuel_condition'); ?></td>
			<td><label><input type="radio" name="fuel_condition" /> <?php echo lang('create_condition_normal'); ?></label></td>
			<td><label><input type="radio" name="fuel_condition" /> <?php echo lang('create_condition_abnormal'); ?></label></td>
			<td><input type="text" name="fuel_condition_other" /></td>
			<td><?php echo lang('create_fuel_condition_ex'); ?></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_parts_condition'); ?></td>
			<td><label><input type="radio" name="parts_condition" /> <?php echo lang('create_condition_normal'); ?></label></td>
			<td><label><input type="radio" name="parts_condition" /> <?php echo lang('create_condition_abnormal'); ?></label></td>
			<td><input type="text" name="parts_condition_other" /></td>
			<td><?php echo lang('create_parts_condition_ex'); ?></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr class="empty_row"></tr>
		<tr>
			<td colspan="2"><button type="button" class="blue_back button"><?php echo lang('create_save_draft'); ?></button></td>
			<td colspan="2"></td>
			<td><input type="submit" class="blue_back button" value="<?php echo lang('create_next'); ?>" /></td>
		</tr>
	</table>
</form>