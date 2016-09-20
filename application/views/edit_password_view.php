<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">

<body>
    
   <div class="content">
   <h3><?php echo lang('change_password'); ?></h3>
   <?PHP
       if (validation_errors()) {
           echo "<script>window.onload = function(){alert('" . validation_errors() . "');}</script>";
       }else{
          if($this->session->userdata('status') != ''){
                $msg = $this->session->userdata('status');
                echo "<script>window.onload = function(){alert('" . $msg . "');}</script>";
          }
       }
   ?>
   
   <form id="pwd" name="pwd" action="<?PHP echo base_url();?>index.php/editProfile/editDealerPwdScreen" method="post">
        <table class=”table table-bordered”>

                <tbody>

                     <tr>
                         <td><label for="password"><?php echo lang('password_original'); ?></label></td>
                         <td>
                             <input type="password" name="opassword" id="opassword" 
                                placeholder="Old Password"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password"><?php echo lang('password_new'); ?></label></td>
                         <td>
                             <input type="password" name="npassword" id="opassword" 
                                placeholder="New Password"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password"><?php echo lang('password_new_confirm'); ?></label></td>
                         <td>
                             <input type="password" name="cpassword" id="opassword" 
                                placeholder="Confirm Password"/>
                         </td>
                     </tr>
                 </tbody>
         </table>
        <br/>
        <div style="margin-left: 45px;">
            <input type="submit" name="bt" id="bt" class="button blue_back" value="<?php echo lang('confirm'); ?>" />
            <button type="reset" class="button blue_back"><?php echo lang('clear'); ?></button>
            
        </div>
    </form>
</body>
  
    
   