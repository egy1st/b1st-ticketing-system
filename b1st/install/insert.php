<?php

$ins1 = "INSERT INTO b1st_privilege_group (id,privilege_name, privileges, description, status, create_date) VALUES (NULL, 'Super Admin', '[\"AT\",\"DT\",\"CT\",\"ET\",\"ATTA\",\"TTAA\",\"RT\",\"RAT\",\"AAT\"]', 'Super Admin privilege with all the possible privileges in the application', '1', CURRENT_TIMESTAMP);";

$ins2 = "INSERT INTO b1st_privileges (id, code, name, status,create_date) VALUES (NULL, 'AT', 'Add Ticket', '1', CURRENT_DATE()), (NULL, 'DT', 'Delete Ticket', '1', CURRENT_DATE()), (NULL, 'CT', 'Close Ticket', '1', CURRENT_DATE()), (NULL, 'ET', 'Edit Ticket', '1', CURRENT_DATE()), (NULL, 'ATTA', 'Assign ticket to Admin', '1', CURRENT_DATE()), (NULL, 'TTAA', 'Transfer ticket from one Admin to another Admin', '1', CURRENT_DATE()), (NULL, 'RT', 'Reopen Tickets', '1', CURRENT_DATE()), (NULL, 'RAT', 'Read all Tickets', '1', CURRENT_DATE()), (NULL, 'AAT', 'Answer any tickets', '1', CURRENT_DATE());";

$ins3 = "INSERT INTO b1st_ticket_states (id, code, name, status, creation_date) VALUES (NULL, 'O', 'open', '1', CURRENT_TIMESTAMP), (NULL, 'C', 'close', '1', CURRENT_TIMESTAMP), (NULL, 'P', 'pending', '1', CURRENT_TIMESTAMP), (NULL, 'S', 'spam', '1', CURRENT_TIMESTAMP), (NULL, 'RO', 're-opened', '1', CURRENT_TIMESTAMP),(NULL, 'A', 'answered', '1', CURRENT_TIMESTAMP);";

$ins4 = "INSERT INTO b1st_ticket_users (id,firstname,lastname,username,email,mobile,password,admin,privilege_group_id,responder_time_duration,hash,type,status,creation_date,modified_date) VALUES (NULL, 'Admin', 'Admin', 'admin', 'admin@example.com', NULL,'1-6-K-2-5-K-7-8-A-7-9-C-6-1-1-M-2-8-L-7-8-G-9-8', '1','1', NULL, NULL, NULL, '1', NOW(), NOW());";

$ins5 = "INSERT INTO b1st_ticket_users (id, firstname, lastname, username, email, mobile, password, admin, privilege_group_id, responder_time_duration, hash, type, online_status, status, creation_date, modified_date) VALUES
(NULL, 'test', 'test', 'test', 'test@example.com', '', '1-6-H-1-6-I-5-6-R-0-0-1-K-2-2-1-J-6-8-G-1-7-G-0-0-1', '0', '', NULL, NULL, 'ticket_posting', '0', '1', NOW(), NOW());";


$ins6 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'adminemail', '{\"email\":\"admin@example.com\"} ');";

$ins7 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'tsemail', '{\"email\":\"b1st@example\"} ');";
$ins8 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'imapsetting', '{\"subject\":\"test\",\"login\":\"example@gmail.com\",\"pass\":\"your password\",\"host\":\"imap.gmail.com\",\"port\":\"993\",\"service_flags\":\"/imap/ssl/novalidate-cert\",\"mailbox\":\"[Gmail]/All Mail\",\"client\":\"gmail\"} ');";

$ins9 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'ticket_attachment', '{\"extensions_allowed\":\"pdf,jpg,png,gif\",\"max_upload\":5} ');";

$ins10 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'mobile_verification', '{\"app_id\":\"\",\"access_token\":\"\",\"type\":\"2\"} ');";

$ins1 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'reCAPTCHA', '{\"theme\":\"light\",\"language\":\"en\",\"sitekey\":\"\",\"type\":\"2\"} ');";

$ins11 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'ticket_auto_close', '{\"number\":1,\"type\":\"day\",\"val\":\"1 day\"} ');";

$ins12 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'scheduled_backup', '{\"number\":7,\"type\":\"day\",\"set_date\":\"".date('Y-m-d')."\"} ');";

$ins13 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'register', '{\"active\":\"ticket_posting\"} ');";

$ins14 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'pagination', '{\"active\":\"10\"} ');";

$ins15 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'ticket_time', '{\"type\":\"1\"} ');";

$ins16 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'delete_confirmation', '{\"type\":\"1\"} ');";

$ins17 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'auto_responder', '{\"type\":\"1\"} ');";

$ins18 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'akismet', '{\"api_key\":\"\"} ');";

$ins19 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'opswat', '{\"api_key\":\"\"} ');";

$ins20 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'response_time', '{\"number\":\"5\",\"unit\":\"hour\"} ');";

$ins21 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'twitter', '{\"oauth_access_token\":\"\",\"oauth_access_token_secret\":\"\",\"consumer_key\":\"\",\"consumer_secret\":\"\",\"screen_name\":\"your username\",\"count\":\"5\"} ');";

$ins22 = "INSERT INTO b1st_settings (id, name, value) VALUES (NULL, 'email_verification', '{\"type\":\"2\"} ');";


$ins23 = "INSERT INTO b1st_theme (theme_name,theme_color,set_default,front_set_default,status,create_date) VALUES
('Default', '#da4c4c', '0', '0', '1', '2015-04-16 11:22:29'),
('Red', '#9e0000', '0', '0', '1', '2015-04-16 11:22:29'),
('Blue', '#1d72b3', '0', '0', '1', '2015-04-16 11:22:45'),
('Green', '#579e4f', '0', '0', '1', '2015-04-16 11:23:22'),
('Orange', '#f2780c', '0', '0', '1', '2015-04-16 11:23:38'),
('Grey', '#969696', '0', '0', '1', '2015-04-16 11:23:51'),
('Dark', '#646464', '0', '0', '1', '2015-04-16 11:24:13'),
('Light', '#c8c8c8', '0', '0', '1', '2015-04-16 11:24:51');";


$ins24 = "INSERT INTO b1st_ticket_register_types (id, type) VALUES
(NULL,'ticket_posting'), (NULL,'read_reply'), (NULL,'register');";


$ins25 = "INSERT INTO b1st_language (language_name, language_code, default_status,back_default_status) VALUES
('English', 'eng', '1','1'),
('French', 'fra', '0', '0'),
('German', 'ger', '0', '0'),
('Spanish', 'spa', '0', '0'),
('Arabic', 'ara', '0', '0'),
('Indian', 'hin', '0', '0');";

$ins26 = "INSERT INTO b1st_moduletables (name, status, install_status) VALUES
('faq', '1', '1'),
('knowledge_base_cat', '1', '1'),
('knowledge_base', '1', '1'),
('backup', '1', '1'),
('chat', '1', '1'),
('response_time', '1', '1'),
('rating', '1', '1'),
('opswat', '1', '1'),
('akismet', '1', '1'),
('email_mod', '1', '1'),
('twitter', '1', '1'),
('mob_ver', '1', '1'),
('statistics', '1', '1'),
('company', '1', '1'),
('product', '1', '1'); " ;

$ins27 = "INSERT INTO `b1st_privilege_group` (`id`, `privilege_name`, `privileges`, `description`, `status`, `create_date`) VALUES
(1, 'Super Admin', '[\"AT\",\"DT\",\"CT\",\"ET\",\"ATTA\",\"TTAA\",\"RT\",\"RAT\",\"AAT\"]', 'Super Admin privilege with all the possible privileges in the application', '1', '2015-11-10 16:05:35');";

$ins2tab=array($ins1,$ins2,$ins3,$ins4,$ins5,$ins6,$ins7,$ins8,$ins9,$ins10,$ins11,$ins12,$ins13,$ins14,$ins15,$ins16,$ins17,$ins18,$ins19,$ins20,$ins21,$ins22,$ins23,$ins24,$ins25,$ins26,$ins27);

//print_r ($ins2tab);

?>


