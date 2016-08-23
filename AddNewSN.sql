------ ros_form ------
ALTER TABLE  `ros_form`
ADD  `new_sn_1` TEXT NULL AFTER  `failure_sn_6` ,
ADD  `new_sn_2` TEXT NULL AFTER  `new_sn_1` ,
ADD  `new_sn_3` TEXT NULL AFTER  `new_sn_2` ,
ADD  `new_sn_4` TEXT NULL AFTER  `new_sn_3` ,
ADD  `new_sn_5` TEXT NULL AFTER  `new_sn_4` ,
ADD  `new_sn_6` TEXT NULL AFTER  `new_sn_5` ;


------ ros_draft ------
ALTER TABLE  `ros_draft`
ADD  `new_sn_1` TEXT NULL AFTER  `failure_sn_6` ,
ADD  `new_sn_2` TEXT NULL AFTER  `new_sn_1` ,
ADD  `new_sn_3` TEXT NULL AFTER  `new_sn_2` ,
ADD  `new_sn_4` TEXT NULL AFTER  `new_sn_3` ,
ADD  `new_sn_5` TEXT NULL AFTER  `new_sn_4` ,
ADD  `new_sn_6` TEXT NULL AFTER  `new_sn_5` ;