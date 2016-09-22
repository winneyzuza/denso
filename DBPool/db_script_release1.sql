--DB script : Release 1
------------------------------------------------------------------------------
ALTER TABLE user_auth ADD user_rule varchar(1);

CREATE TABLE `user_role` (
  `id` int(1) NOT NULL,
  `role_id` varchar(1)  NOT NULL,
  `name_eng` varchar(20)  NOT NULL,
  `name_th` varchar(20)   NOT NULL
);

INSERT INTO `user_role` (`id`, `role_id`, `name_eng`, `name_th`) VALUES
(1, '1', 'ServiceAdmin', 'ผู้ดูแลศูนย์บริการ'),
(2, '0', 'Non-ServiceAdmin', 'ผู้ใช้งานระบบ');

------------------------------------------------------------------------------