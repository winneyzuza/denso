#--DB script : Release 3
#----------------------------------------------------------------------------------
ALTER TABLE `ros_form` ADD `ext_field` VARCHAR(10) NOT NULL AFTER `updated_time`;

#----------------------------------------------------------------------------------

CREATE TABLE email_template(
   email_id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(email_id),
   subject        VARCHAR(255) NOT NULL,
   sender         VARCHAR(255) NOT NULL,
   email_content  TEXT NOT NULL
);

#----------------------------------------------------------------------------------