<div class="left" id="side_bar">
	<div class="heading">
		<?php echo lang('side_user_heading'); ?>

	</div>
	<br/><br/>
	<div class="user">
		<div class="greeting text">
			<?php echo lang('side_user_greeting'); ?>
		</div>
		<div class="username text">
			<?php echo $this->session->userdata('full_name')?$this->session->userdata('full_name'):"Guest"; ?>
		</div>
		<br/>
		<div>
			<?php echo $this->session->userdata('logged_in')?(anchor('logout',lang('side_logout'))):""; ?>
		</div>
	</div>

	<?php if ($this->session->userdata('logged_in')) { ?>
		<div class="exchange">
		<ul>
			<li><?php echo lang('edit_profile'); ?></li>
			<ul>
            	<div id="sidemenu">
                	<li><?php echo anchor('editProfile/editDealerPwdScreen', lang('edit_password')); ?></li>
                    <li><?php echo anchor('editProfile/editDealerInfoScreen', lang('edit_profile_info')); ?></li>
                </div>
			</ul>				
				<li><?php echo lang('side_exchange_system'); ?></li>
				<ul>
					<li><a href="<?php echo base_url(); ?>"><?php echo lang('side_DFIP'); ?></a></li>
				</ul>
			</ul>
		</div>
	<?php } ?>
</div>

<div id="main_content">