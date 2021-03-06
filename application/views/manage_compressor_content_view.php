<?php 
// BREAKING THE MVC PATTERN :( Forgive me.
// Alternatively achievable via ajax underneath code.
// But may result in problems while loading the draft.
// So here it goes.

$compressors = $this->db->get("compressor_repair")->result_array();
$types = $this->db->get("compressor_type")->result_array();
$statuses = $this->db->get("compressor_status")->result_array();
$problems = $this->db->get("compressor_problem")->result_array();
?>

<div id="id_here" class="frm_part dynamic_content">
	<table>
		<tr>
			<td><?php echo lang('create_compressor_repair_name'); ?></td>
			<td>
				<select name="compressor_repair_id">
					<option value=""><?php echo lang('create_compressor_repair_name'); ?></option>
					<?php foreach ($compressors as $key => $compressor) {
						echo "<option value='".$compressor['compressor_repair_id']."'>".$compressor[lang('create_compressor_repair_column')]."</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_compressor_type'); ?></td>
			<td>
				<select name="compressor_type_id">
					<option value=""><?php echo lang('create_compressor_type'); ?></option>
					<?php foreach ($types as $key => $type) {
						echo "<option value='".$type['compressor_type_id']."'>".$type[lang('create_compressor_type_column')]."</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_compressor_status'); ?></td>
			<td>
				<select name="compressor_status_id">
					<option value=""><?php echo lang('create_compressor_status'); ?></option>
					<?php foreach ($statuses as $key => $status) {
						echo "<option value='".$status['compressor_status_id']."'>".$status[lang('create_compressor_status_column')]."</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><?php echo lang('create_compressor_problem'); ?></td>
			<td>
				<select name="compressor_problem_id">
					<option value=""><?php echo lang('create_compressor_problem'); ?></option>
					<?php foreach ($problems as $key => $problem) {
						echo "<option value='".$problem['compressor_problem_id']."'>".$problem[lang('create_compressor_problem_column')]."</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr class="empty_row"></tr>
		<tr>
			<td><button type="button" class="blue_back button prev_tab"><?php echo lang('create_back'); ?></button></td>
			<td colspan="3"></td>
			<td><button type="button" class="blue_back button next_tab" ><?php echo lang('create_next'); ?></button></td>
		</tr>
	</table>
</div>




<div id="id_here" class="frm_part dynamic_content">
	<table>
		<!-- <tr>
			<td><?php echo lang('create_exchange_part'); ?></td>
			<td colspan="3"></td>
			<td class="blue_back"><?php echo lang('create_status_of_ros'); ?></td>
		</tr> -->
		<tr class="empty_row"></tr>
		<tr class="pump parttype"><td colspan="4"><?php echo lang('create_pump_exchange'); ?></td></tr>
        <tr class="empty_row"></tr>
		<!-- <tr>
			<td colspan="2"><label><input type="checkbox" /> <?php echo lang('create_supply_pump'); ?>
				<input type="hidden" name="supply_pump" value="false" />
			</label></td>
			<td class="right"><?php echo lang('create_quantity'); ?></td>
			<td><input type="text" name="quantity" placeholder="<?php echo lang('create_quantity'); ?>" />&nbsp;&nbsp;<?php echo lang('create_quantity_unit'); ?></td>
		</tr>
		<tr class="empty_row"></tr> -->
		<tr class="pump parttype">
			<td></td>
			<td><?php echo lang('create_failure'); ?></td>
			<td></td>
			<td><?php echo lang('create_exchange'); ?></td>
		</tr>
		<tr class="pump parttype">
			<td class="right"><?php echo lang('create_pn'); ?><span class="required">*</span></td>
			<td>
				<select name="part_failure_pn">
					<option value=""><?php echo lang('create_general_select'); ?></option>
				</select>
			</td>
			<td class="right"><?php echo lang('create_pn'); ?></td>
            <td colspan="2"><input type="text" readonly name="part_exchange_pn" ></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr class="pump parttype">
			<td class="right"><?php echo lang('create_sn'); ?></td>
            <td><textarea name="failure_sn_1"></textarea></td>
		</tr>
        <tr class="empty_row"></tr>
		<tr class="pump parttype">
			<td class="right"><?php echo lang('create_new_sn'); ?></td>
			<td><textarea name="new_sn_1"></textarea></td>
		</tr>
		<tr class="empty_row"></tr>
		<tr class="empty_row"></tr>
        <tr>
            <td><?php echo lang('create_remark'); ?></td>
            <td colspan="6"><textarea name="remark"></textarea></td>
        </tr>
		<tr class="empty_row"></tr>
		<tr>
			<td>
				<?php echo lang('manage_status'); ?>
			</td>
			<td>
				<select name="status" id="status"></select>
			</td>
		</tr>
		<tr class="empty_row"></tr>
		<tr class="empty_row"></tr>
		<tr class="empty_row" id="part_code"></tr>
		<tr>
			<td colspan="2"><button type="button" class="blue_back button prev_tab"><?php echo lang('create_back'); ?></button></td>
			<td colspan="2"></td>
			<td><button type="button" id="frm_submit" class="blue_back button" data-action="<?php echo (isset($ros_info['ros_no']) AND $ros_info['status']!='Draft')?('update'):('add'); ?>"><?php echo lang('create_update'); ?></button></td>
		</tr>
	</table>
</div>