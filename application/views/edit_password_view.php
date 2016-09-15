<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">
<style> 
div .content {
    border: 2px solid #a1a1a1;
    padding: 10px 40px; 
    background: #0000;
    width: 300px;
    border-radius: 25px;
}
.button{
    width:100px;
    margin-left:auto;
    margin-right:auto;
}

</style>
<body>
    
   <div class="content" style="border: ">
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
        <div style="margin-left: 45px;">
            <input type="submit" name="bt" id="bt" class="button blue_back" value="Submit" />
            <button type="reset" class="button blue_back">Clear</button>
            
        </div>
    </form>
</body>
  
    
   