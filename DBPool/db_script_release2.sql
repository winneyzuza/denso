--DB script : Release 2
------------------------------------------------------------------------------

ALTER TABLE region ADD COLUMN 'region_name_th' TEXT NOT NULL AFTER 'region_name';

UPDATE region SET  region_name_th = 'กรุงเทพและปริมณฑล' WHERE region_code ='BKK';
UPDATE region SET  region_name_th = 'ตะวันออก' WHERE region_code ='E';
UPDATE region SET  region_name_th = 'เหนือ' WHERE region_code ='N';
UPDATE region SET  region_name_th = 'ตะวันออกเฉียงเหนือ' WHERE region_code ='N-E';
UPDATE region SET  region_name_th = 'ใต้' WHERE region_code ='S';
UPDATE region SET  region_name_th = 'ตะวันตก' WHERE region_code ='W';
COMMIT;

------------------------------------------------------------------------------