<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">
<script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
<div>
        <h1>Edit Service Dealer Information</h1>
        <?PHP
            //if(validation_errors())
                //echo "<script>window.onload = function(){alert('".validation_errors()."');}</script>";
        ?>
        <form action="<?PHP echo base_url();?>index.php/editProfile/ChangeShopInfoAction" method="post">
        <input type="hidden" name="sd_id" value="<?php echo $this->session->userdata('sd_id'); ?>" />      
            <table>
                <tr>
                    <td>Name (English)</td>
                    <td><input type="text" name="NameEnglish" value="<?php if(isset($sd_profile_info['name_eng'])) echo $sd_profile_info['name_eng']; ?>" /></td>
                </tr>
                <tr>
                    <td>Name (Thai)</td>
                    <td><input type="text" name="NameThai" value="<?php if(isset($sd_profile_info['name_th'])) echo $sd_profile_info['name_th']; ?>" /></td>
                </tr>
                <tr>
                    <td>Region Code</td>
                    <td>
						<select id="RegionCode">
							<option value="">Please Select Region</option>
							<?php foreach ($regions as $value) {
								echo "<option value='".$value['region_code']."'>".$value['region_name_th']."</option>";
								//echo "<option value='".$value['region_code']."' ".set_select('RegionCode', $value['region_code']).">".$value['region_name']."</option>";
							} ?>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="Address"><?php if(isset($sd_profile_info['address'])) echo $sd_profile_info['address']; ?></textarea></td>
                </tr>
                <tr>
                    <td>PrimaryPhone</td>
                    <td><input type="text" name="PrimaryPhone" value="<?php if(isset($sd_profile_info['primary_phone'])) echo $sd_profile_info['primary_phone']; ?>" /></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="Phone" value="<?php if(isset($sd_profile_info['phone'])) echo $sd_profile_info['phone']; ?>" /></td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td><input type="text" name="Fax" value="<?php if(isset($sd_profile_info['fax'])) echo $sd_profile_info['fax']; ?>" /></td>
                </tr>
                <tr>
                    <td>Owner</td>
                    <td><input type="text" name="Owner" value="<?php if(isset($sd_profile_info['owner'])) echo $sd_profile_info['owner']; ?>" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="Email" value="<?php if(isset($sd_profile_info['email'])) echo $sd_profile_info['email']; ?>" /></td>
                </tr>
            </table>
            <br/>
            <button type="submit" class="button blue_back">Add</button>
            <button type="reset" class="button blue_back">Clear</button>
            <br/>
        </form>
</div>