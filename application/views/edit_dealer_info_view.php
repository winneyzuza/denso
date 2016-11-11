<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">
<script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
<script>
	jQuery(document).ready(function() {
    	jQuery("[required]").after("<span class='required'>*</span>");
	});
</script>
<div class="content" id="redisign-form">
	<div class="center_table"><h3><?php echo lang('service_dealer_title'); ?></h3></div>       
   	<?PHP
	       if (validation_errors()) {
	           echo "<script>window.onload = function(){alert('" . validation_errors() . "');}</script>";
	       }else{
	       	$msg = $this->session->userdata('result');
	          if($msg != ''){
	          	if($msg == 'update_successful'){
	          		echo "<script>window.onload = function(){alert('" .  lang('update_successful') . "');}</script>";
	          	}else {
	          		echo "<script>window.onload = function(){alert('" .  lang('update_error') . "');}</script>";
	          	}
	          }
	       }
	       $this->session->unset_userdata('result');
  	 ?>
	<script>
		function navigateToHome() {
			window.location = '<?php echo base_url(); ?>';
		}
	</script>  	 
	<form name="editDealerInfoView" id="editDealerInfoView" action="<?PHP echo base_url();?>index.php/editProfile/editDealerInfoAction" method="post">
        <input type="hidden" name="sd_id" value="<?php echo $this->session->userdata('sd_id'); ?>" />      
            <table class="table middle">
            	<tobody>
                	<tr>
                    	<td class="width-130"></td>
                        <td class="width-270"></td>
                   	</tr>
                </tbody>
                <tr>
                    <td><?php echo lang('service_dealer_name_en'); ?><label required></td>
                    <td><input type="text" name="NameEnglish" value="<?php if(isset($sd_profile_info['name_eng'])) echo $sd_profile_info['name_eng']; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_name_th'); ?><label required></td>
                    <td><input type="text" name="NameThai" value="<?php if(isset($sd_profile_info['name_th'])) echo $sd_profile_info['name_th']; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_region'); ?><label required></td>
                    <td>
                        <select name="RegionCode">
                            <option value=""><?php echo lang('please_select_option'); ?></option>
                            <?php
                                if($regions){
                                    foreach ($regions as $value) {
                                        if($value['region_code'] == $sd_profile_info['region_code'])
                                            echo "<option value='".$value['region_code']."' ".set_select('$regions', $value['region_code'])." selected>".$value[lang('region_name')]."</option>";
                                        else
                                            echo "<option value='".$value['region_code']."' ".set_select('$regions', $value['region_code']).">".$value[lang('region_name')]."</option>";
                                    }
                                }
                            ?>
                        </select>						
                    </td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_address'); ?><label required></td>
                    <td><textarea class="address" name="Address"><?php if(isset($sd_profile_info['address'])) echo $sd_profile_info['address']; ?></textarea></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_phone'); ?><label required></td>
                    <td><input type="text" name="PrimaryPhone" value="<?php if(isset($sd_profile_info['primary_phone'])) echo $sd_profile_info['primary_phone']; ?>" maxlength="20"/></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_mobile'); ?><label required></td>
                    <td><input type="text" name="Phone" value="<?php if(isset($sd_profile_info['phone'])) echo $sd_profile_info['phone']; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_fax'); ?></td>
                    <td><input type="text" name="Fax" value="<?php if(isset($sd_profile_info['fax'])) echo $sd_profile_info['fax']; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_onwer'); ?><label required></td>
                    <td><input type="text" name="Owner" value="<?php if(isset($sd_profile_info['owner'])) echo $sd_profile_info['owner']; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo lang('service_dealer_email'); ?><label></td>
                    <td><input type="text" name="Email" value="<?php if(isset($sd_profile_info['email'])) echo $sd_profile_info['email']; ?>" /></td>
                </tr>
            </table>
            <br/>
            <div class="center_table">
            	<button type="submit" class="button blue_back"><?php echo lang('ok_button'); ?></button>
            	<button type="button" class="button blue_back" onClick="navigateToHome()"><?php echo lang('cancel_button'); ?></button>
            </div>
            <br/>
        </form>
</div>