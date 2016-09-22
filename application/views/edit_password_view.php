<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">

<body>
    
   <div class="content">
   
   <?PHP
       if (validation_errors()) {
           echo "<script>window.onload = function(){alert('" . validation_errors() . "');}</script>";
       }else{
          if($this->session->userdata('status') != ''){
                $msg = $this->session->userdata('status');
                if($msg != ''){
	          	if($msg == 'Password updated successfully'){
                            echo "<script>window.onload = function(){alert('" . lang('update_password_successful') . "');}</script>";
                        }else if($msg == 'Password updated fail'){
                            echo "<script>window.onload = function(){alert('" . lang('update__password_error') . "');}</script>";
                        }else{
                            echo "<script>window.onload = function(){alert('" . lang('password_wrong') . "');}</script>";
                        }
                
                }
          }
       }
   ?>
   
   <form id="pwd" name="pwd" action="<?PHP echo base_url();?>index.php/editProfile/editDealerPwdScreen" method="post">
       <div class="center_table"><h3><?php echo lang('change_password'); ?></h3> </div>
           <table class="center-element">

                <tbody>

                     <tr>
                         <td><label for="password" required><?php echo lang('password_original'); ?></label></td>
                         <td>
                             <input type="password" name="opassword" id="opassword" 
                                placeholder="<?php echo lang('password_original'); ?>" autocomplete="off"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password" required><?php echo lang('password_new'); ?></label></td>
                         <td>
                             <input type="password" name="npassword" id="opassword" 
                                placeholder="<?php echo lang('password_new'); ?>" autocomplete="off"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password" required><?php echo lang('password_new_confirm'); ?></label></td>
                         <td>
                             <input type="password" name="cpassword" id="opassword" 
                                placeholder="<?php echo lang('password_new_confirm'); ?>" autocomplete="off"/>
                         </td>
                     </tr>
                 </tbody>
         </table>
        <br/>
        <div class="center_table">
            <input type="submit" name="bt" id="bt" class="button blue_back" value="<?php echo lang('confirm'); ?>" />
            <button type="reset" class="button blue_back"><?php echo lang('clear'); ?></button>
            
        </div>
        
    </form>
   <script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
   <script>
   jQuery(document).ready(function() {
        jQuery("[required]").after("<span class='required'>*</span>");
       });
   </script>
</body>
  
    
   