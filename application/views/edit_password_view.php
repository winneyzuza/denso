<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">
<div class="center_div">
	<?php if ($this->session->userdata('logged_in')) { ?>
		<form method="POST">
			<div style="border:1px solid #cccccc;width:500px;">
				<table class="center_table">
					<tr>
						<td><label for="password_original"><?php echo lang('password_original') ?></label></td>
						<td><input type="password" name="password_original" id="password_original" autofocus></td>
					</tr>
					<tr>
						<td><label for="password_new"><?php echo lang('home_label_password') ?></label></td>
						<td><input type="password" name="password_new" id="password_new" autofocus value="<?php echo urldecode($this->input->get('password_new')); ?>"></td>
					</tr>
	
					<tr>
						<td><label for="password_new_confirm"><?php echo lang('password_new_confirm') ?></label></td>
						<td><input type="password" name="password_new_confirm" id="password_new_confirm" autofocus></td>
					</tr>
					<tr class="empty_row"></tr>
					<tr>
						<td colspan=2>
							<input type="submit" value="<?php echo lang('confirm'); ?>">
						</td>
					</tr>
				</table>
			</div>
		</form>
	<?php } else{ ?>
		<h2><?php echo lang('home_heading_login'); ?></h2>
		<form method="POST">
			<table class="center_table">
				<tr>
					<td><label for="username"><?php echo lang('home_label_username') ?></label></td>
					<td><input type="text" name="username" id="username" autofocus value="<?php echo urldecode($this->input->get('username')); ?>"></td>
				</tr>

				<tr>
					<td><label for="password"><?php echo lang('home_label_password') ?></label></td>
					<td><input type="password" name="password" id="password" autofocus></td>
				</tr>
				<tr class="empty_row"></tr>
				<tr>
					<td colspan=2>
						<input type="submit" value="<?php echo lang('home_label_login'); ?>">
					</td>
				</tr>
			</table>
		</form>
	<?php } ?>
</div>

<script type="text/javascript">
	<?php if ($this->input->get('message')) { ?>
		alert("<?php echo urldecode($this->input->get('message')); ?>");
	<?php } ?>
</script>