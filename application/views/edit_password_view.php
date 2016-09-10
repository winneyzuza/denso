<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/home.css">

<body>
    
    <div class="content">

    
    <form name="pwd" action="<?PHP echo base_url();?>index.php/editProfile/editDealerPwdScreen" method="post">
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

            <button type="submit" id="bt" class="button blue_back">Submit</button>
            <button type="reset" class="button blue_back">Clear</button>
            
        </div>
    </form>
 <script src="<?php echo base_url(); ?>application/assets/js/jquery-1.11.2.min.js"></script>
 <script src="<?php echo base_url(); ?>application/assets/js/jquery.validate.min.js"></script>   
 <script>
        // Wait for the DOM to be ready
        $(function() {
            
          // Initialize form validation on the registration form.
          // It has the name attribute "registration"
          $("form[name='pwd']").validate({
            // Specify validation rules
            rules: {
              
              password: {
                required: true,
                minlength: 5
              }
            },
            // Specify validation error messages
            messages: {
             
              password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
              }
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
              form.submit();
            }
          });
        });

    </script>    
</body>
  
    
   