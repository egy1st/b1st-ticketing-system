<?php

$table1 = "CREATE TABLE IF NOT EXISTS b1st_ticket (
 id bigint(25) NOT NULL AUTO_INCREMENT,
 ticket_no varchar(255) NOT NULL,
 userid bigint(25) NOT NULL ,
 subject varchar(255) NOT NULL,
 customer varchar(255) NOT NULL,
 query text NOT NULL,
 department_id bigint(25) NOT NULL,
 company_id bigint(25) NOT NULL,
 product_id bigint(25) NOT NULL,
 priorty varchar(255) NOT NULL,
 state varchar(10) NOT NULL DEFAULT 'O',
 rating varchar(3) NOT NULL DEFAULT '0',
 email_no bigint(25) NULL,
 tweet_id bigint(25) NULL,
 spam int(1) NULL,
 status enum('1','0') NOT NULL DEFAULT '1',
 create_date datetime NOT NULL,
 modified_date datetime NOT NULL,
 PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table2 = "CREATE TABLE IF NOT EXISTS b1st_product (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  product_name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table3 = "CREATE TABLE IF NOT EXISTS b1st_department (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  department_name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table4 = "CREATE TABLE IF NOT EXISTS b1st_company (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  company_name varchar(255) NOT NULL,
  company_website varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table5 = "CREATE TABLE IF NOT EXISTS b1st_faq (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  product_id bigint(25) NOT NULL,
  question varchar(255) NOT NULL,
  answer text NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table6 = "CREATE TABLE IF NOT EXISTS b1st_ticket_priority (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  priority_name varchar(255) NOT NULL,
  priority_color varchar(10) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table7 = "CREATE TABLE IF NOT EXISTS b1st_privilege_group (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  privilege_name varchar(255) NOT NULL,
  privileges text NOT NULL,
  description text NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";


$table8 = "CREATE TABLE IF NOT EXISTS b1st_privileges (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  code varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";


$table9 = "CREATE TABLE IF NOT EXISTS b1st_ticket_reply (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  ticket_id bigint(25) NOT NULL,
  body text NOT NULL,
  replier_id bigint(25) NOT NULL,
  replier varchar(255) NOT NULL,
  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table10 = "CREATE TABLE IF NOT EXISTS b1st_ticket_states (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  code varchar(20) NOT NULL,
  name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  creation_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table11 = "CREATE TABLE IF NOT EXISTS b1st_ticket_users (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  mobile varchar(30) NULL,
  password varchar(255) NOT NULL,
  admin varchar(255) NOT NULL DEFAULT '0',
  privilege_group_id varchar(255) DEFAULT NULL,
  responder_time_duration varchar(255) DEFAULT NULL,
  hash varchar(255) DEFAULT NULL,
  type varchar(255) DEFAULT NULL,
  online_status enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Offline=0, Online=1',
  status enum('1','0') NOT NULL DEFAULT '1',
  creation_date datetime NOT NULL,
  modified_date datetime NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";


$table12 = "CREATE TABLE IF NOT EXISTS b1st_settings (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  value text NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table13 = "CREATE TABLE IF NOT EXISTS b1st_attachments (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  ticket_id bigint(25) NOT NULL,
  filename varchar(255) NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table14 = "CREATE TABLE IF NOT EXISTS b1st_temp_file (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  filename varchar(255) NOT NULL,
  session_id text NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table15 = "CREATE TABLE IF NOT EXISTS b1st_theme (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  theme_name varchar(255) NOT NULL,
  theme_color varchar(10) NOT NULL,
  set_default enum('1','0') NOT NULL DEFAULT '0',
  front_set_default enum('1','0') NOT NULL DEFAULT '0',
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table16 = "CREATE TABLE IF NOT EXISTS b1st_ticket_register_types (
  id int(11) NOT NULL AUTO_INCREMENT,
  type varchar(255) NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table17 = "CREATE TABLE IF NOT EXISTS b1st_ticket_rating (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  ticket_id bigint(25) NOT NULL,
  user_id bigint(25) NOT NULL,
  rating varchar(3) NOT NULL,
  dateAdded timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table18 = "CREATE TABLE IF NOT EXISTS b1st_chatsession (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  to_userid bigint(25) NOT NULL,
  from_userid bigint(25) NOT NULL,
  seen enum('1','0') NOT NULL DEFAULT '0' COMMENT 'seen=1, unseen=0',
  chat text NOT NULL,
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table19 = "CREATE TABLE IF NOT EXISTS b1st_kb_cat (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  category_name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table20 = "CREATE TABLE IF NOT EXISTS b1st_knowledgebasemod (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  category_id bigint(25) NOT NULL,
  product_id bigint(25) NOT NULL,
  topic varchar(255) NOT NULL,
  content text NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '1',
  create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";


$table21 = "CREATE TABLE IF NOT EXISTS b1st_language (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  language_name varchar(255) NOT NULL,
  language_code varchar(255) NOT NULL,
  default_status enum('1','0') NOT NULL,
  back_default_status enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table22 = "CREATE TABLE IF NOT EXISTS b1st_admin_ticket_assignment (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  admin_id bigint(25) NOT NULL,
  ticket_id bigint(25) NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table23 = "CREATE TABLE b1st_ticket_backup (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  backup_name varchar(255) NOT NULL,
  backup_description text  NULL,
  backup_type varchar(255) NOT NULL,
  creation_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table24 = "CREATE TABLE IF NOT EXISTS b1st_moduletables (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  status enum('1','0') NOT NULL DEFAULT '0',
  install_status enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table25 = "CREATE TABLE IF NOT EXISTS b1st_emails (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  eid bigint(20) NOT NULL,
  subject varchar(255) NOT NULL,
  body text NOT NULL,
  deleted int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
)CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table26 = "CREATE TABLE IF NOT EXISTS b1st_tweets (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  tid bigint(20) NOT NULL,
  body text NOT NULL,
  deleted tinyint(4) DEFAULT '0',
  PRIMARY KEY (id)
)CHARACTER SET utf8 COLLATE utf8_general_ci;";

$table27 = "CREATE TABLE IF NOT EXISTS b1st_responder_time_duration (
  id bigint(25) NOT NULL AUTO_INCREMENT,
  userid bigint(25) NOT NULL,
  responder_time_duration varchar(255) NOT NULL,
  currentdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)CHARACTER SET utf8 COLLATE utf8_general_ci;";

$droptable1="DROP TABLE IF EXISTS b1st_ticket";

$droptable2="DROP TABLE IF EXISTS b1st_product";

$droptable3="DROP TABLE IF EXISTS b1st_department";

$droptable4="DROP TABLE IF EXISTS b1st_company";

$droptable5="DROP TABLE IF EXISTS b1st_faq";

$droptable6="DROP TABLE IF EXISTS b1st_ticket_priority";

$droptable7="DROP TABLE IF EXISTS b1st_privilege_group";

$droptable8="DROP TABLE IF EXISTS b1st_privileges";

$droptable9="DROP TABLE IF EXISTS b1st_ticket_reply";

$droptable10="DROP TABLE IF EXISTS b1st_ticket_states";

$droptable11="DROP TABLE IF EXISTS b1st_ticket_users";

$droptable12="DROP TABLE IF EXISTS b1st_settings";

$droptable13="DROP TABLE IF EXISTS b1st_attachments";

$droptable14="DROP TABLE IF EXISTS b1st_temp_file";

$droptable15="DROP TABLE IF EXISTS b1st_theme";

$droptable16="DROP TABLE IF EXISTS b1st_ticket_register_types";

$droptable17="DROP TABLE IF EXISTS b1st_ticket_rating";

$droptable18="DROP TABLE IF EXISTS b1st_chatsession";

$droptable19="DROP TABLE IF EXISTS b1st_kb_cat";

$droptable20="DROP TABLE IF EXISTS b1st_knowledgebasemod";

$droptable21="DROP TABLE IF EXISTS b1st_language";

$droptable22="DROP TABLE IF EXISTS b1st_admin_ticket_assignment";

$droptable23="DROP TABLE IF EXISTS b1st_ticket_backup";

$droptable24="DROP TABLE IF EXISTS b1st_moduletables"; 

$droptable25="DROP TABLE IF EXISTS b1st_emails"; 

$droptable26="DROP TABLE IF EXISTS b1st_tweets";

$droptable27="DROP TABLE IF EXISTS b1st_responder_time_duration"; 

$instab=array($table1,$table2,$table3,$table4,$table5,$table6,$table7,$table8,$table9,$table10,$table11,$table12,$table13,$table14,$table15,$table16,$table17,$table18,$table19,$table20,$table21,$table22,$table23,$table24,$table25,$table26,$table27);

$droptab=array($droptable1,$droptable2,$droptable3,$droptable4,$droptable5,$droptable6,$droptable7,$droptable8,$droptable9,$droptable10,$droptable11,$droptable12,$droptable13,$droptable14,$droptable15,$droptable16,$droptable17,$droptable18,$droptable19,$droptable20,$droptable21,$droptable22,$droptable23,$droptable24,$droptable25,$droptable26,$droptable27);

$tables = array("ticket","product","department","company","faq","ticket_priority","privilege_group","privileges","ticket_reply","ticket_states","ticket_users","settings","attachments","temp_file","theme","ticket_register_types","ticket_rating","chatsession","kb_cat","knowledgebasemod","language","admin_ticket_assignment","ticket_backup","moduletables","emails","tweets","responder_time_duration");
?>
