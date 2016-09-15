<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">

<body>
    
   <div class="content">
   <h1>Change Password</h1>
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
                         <td><label for="password">Old Password:</label></td>
                         <td>
                             <input type="password" name="opassword" id="opassword" 
                                placeholder="Old Password"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password">New Password:</label></td>
                         <td>
                             <input type="password" name="npassword" id="opassword" 
                                placeholder="New Password"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td><label for="password">Confirm Password:</label></td>
                         <td>
                             <input type="password" name="cpassword" id="opassword" 
                                placeholder="Confirm Password"/>
                         </td>
                     </tr>
                 </tbody>
         </table>
        <br/>
        <div style="position:relative;">
            <input type="submit" name="bt" id="bt" class="button blue_back" value="Submit" />
            <button type="reset" class="button blue_back">Clear</button>
            
        </div>
    </form>
</body>
  
    
   