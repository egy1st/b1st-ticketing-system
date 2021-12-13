#
# TABLE STRUCTURE FOR: PREFIX_ticket
#

DROP TABLE IF EXISTS PREFIX_ticket;

CREATE TABLE `PREFIX_ticket` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `ticket_no` varchar(255) NOT NULL,
  `userid` bigint(25) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `query` text NOT NULL,
  `department_id` bigint(25) NOT NULL,
  `company_id` bigint(25) NOT NULL,
  `product_id` bigint(25) NOT NULL,
  `priorty` varchar(255) NOT NULL,
  `state` varchar(10) NOT NULL DEFAULT 'O',
  `rating` varchar(3) NOT NULL DEFAULT '0',
  `email_no` bigint(25) DEFAULT NULL,
  `tweet_id` bigint(25) DEFAULT NULL,
  `spam` int(1) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (1, 'e97dc7b9-c46-870', 1, 'Hello World', 'alex@egyfirst.com', 'Hello World\n\nI am sending this message to say hello to every one and wish him to have a nice day\n\nMohamed Ali', 1, 1, 2, '2', 'C', '0', NULL, NULL, 0, '1', '2016-01-14 02:18:39', '2016-01-20 23:38:57');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (3, '67036ba4-d4b-e10', 2, 'How can I receive Twitter notifications', 'alex@egyfirst.com', 'Hi there,\nHow can I receive Twitter notifications. and is it possible to post these notifications as new tickets.\n\nKind regards,\nAlex', 1, 1, 2, '2', 'C', '4.5', NULL, NULL, 0, '1', '2016-01-14 02:35:36', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (4, 'caeac3db-823-4cc', 2, 'Does B1st scan attachments for viruses?', 'alex@egyfirst.com', 'Does B1st scan attachments for viruses?\nWhich engines it uses for detection?\nand how perfect can it remove it if any?\n\nRegards,\nAlex', 1, 1, 2, '2', 'C', '5', NULL, NULL, 0, '1', '2016-01-14 19:27:56', '2016-01-30 20:32:15');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (5, '7bee31c0-05c-765', 2, 'How to prevent spam messages?', 'alex@egyfirst.com', 'I receive many spam tickets each day. I want to be able to prevent spam messages automatically. is there a way to do that.\n\nBest Regards,\nAlex', 1, 1, 2, '3', 'C', '3.5', NULL, NULL, 0, '1', '2016-01-14 19:51:17', '2016-01-23 19:57:02');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (7, 'bc5a9f60-74f-dee', 2, 'from where I can restyle my theme?', 'maa@mygoldensoft.com', 'from where I can restyle my theme? The default theme is red but I would prefer a blue one.\n\nKind Regards,\nJack', 1, 1, 2, '2', 'C', '2', NULL, NULL, 0, '1', '2016-01-15 17:34:23', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (9, '90186afe-a37-c6f', 2, 'B1st price', 'maa@mygoldensoft.com', 'How much does B1ST cost ?????????\n\nJack', 2, 1, 2, '2', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:37:13', '2016-01-20 23:38:57');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (10, '6e4f4ef5-788-c34', 2, 'Billing Problem', 'alex@egyfirst.com', 'I purchased DC NUmber2Text but the transaction does not appear on my credit card yet.\n\nBest Regards,\nAlex', 3, 1, 3, '1', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:38:44', '2016-01-30 20:26:35');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (11, '4a241d8a-7cb-8c2', 2, 'Number2Text Configuration', 'maa@mygoldensoft.com', 'How can I configure DC Number2Text? \nHow can I set my language as the default language.\n\nKind Regards,\nJack\n', 1, 1, 3, '2', 'C', '4.5', NULL, NULL, 0, '1', '2016-01-15 17:41:31', '2016-01-20 23:38:57');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (12, '2a34cd9a-74b-005', 2, 'Russian Language', 'alex@egyfirst.com', 'Does DC Number2Text support Russian Language. Actually, that would be a great advantage as it is my local language.\n\nAlex', 1, 1, 3, '3', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:43:13', '2016-01-20 23:38:57');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (13, 'aad107a7-f64-9a5', 2, 'B1ST license', 'info@egyfirst.com', 'what is the license of B1ST. also, do you offer it as royal free?\n\nMac', 1, 2, 2, '2', 'C', '4', NULL, NULL, 0, '1', '2016-01-15 17:47:33', '2016-01-20 23:34:39');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (14, '92397e3d-df8-b4a', 2, 'script integration problem', 'maa@mygoldensoft.com', 'hello there,\n\nalthough I have installed B1ST, I still navigate to the install folder each time I try to login to B1ST\n\nJack', 2, 2, 2, '1', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:49:33', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (15, '4981324e-2f1-1ae', 2, 'Tickets prioriteis', 'info@egyfirst.com', 'is there a way to add several priorities level than the standard ones (High - Normal and Low)\n\nKind Regards,\nMac', 1, 2, 2, '3', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:51:54', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (16, '3d0fa756-58f-929', 2, 'Filtering Tickets', 'maa@mygoldensoft.com', 'I receive tens of messages each day, I need to be able to filter tickers per different criteria e.g. department, product and so on.\n\nRegards,\nJack', 1, 1, 2, '2', 'C', '4.5', NULL, NULL, 0, '1', '2016-01-15 17:53:45', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (17, 'afe668fb-aff-54e', 2, 'Number2Text Cost', 'info@egyfirst.com', 'How much does it cost to get DC Number2Text with All-Languages Pack. I mean not only the English version.\n\nRegards,\nMac', 2, 2, 3, '1', 'C', '3.5', NULL, NULL, 0, '1', '2016-01-15 17:55:47', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (18, 'a62f4c33-167-ebe', 2, 'Ways to Buy B1ST', 'alex@egyfirst.com', 'I need to buy B1ST using my paypal account is that possible. I mean I do not have Credit card. Please help I want to get it right away.\n\nAlex', 3, 1, 2, '2', 'C', '5', NULL, NULL, 0, '1', '2016-01-15 17:57:52', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (19, 'a5987947-86f-81b', 1, 'b1st is good', 'mohamed.alyabbas@gmail.com', 'hi\n\n---\nThis email has been checked for viruses by Avast antivirus software.\nhttps://www.avast.com/antivirus\n\n', 3, 1, 2, '2', 'C', '0', 14, NULL, 0, '1', '2016-01-15 21:18:21', '2016-01-20 08:27:41');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (50, '6d6af0c4-236-b2e', 2, 'Test Ticket', 'test@mygoldensoft.com', 'I send this ticket as a test', 1, 1, 2, '2', 'C', '4.5', NULL, NULL, 0, '1', '2016-01-19 19:41:41', '2016-01-23 19:57:02');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (51, '892727d8-07a-d35', 2, 'Chat session with Mohamed Ali', 'mohamed.alyabbas@gmail.com', 'I send a question via Chat session\n We post this Chat session as new ticket\n', 1, 1, 2, '3', 'C', '5', NULL, NULL, 0, '1', '2016-01-19 19:43:28', '2016-01-23 19:57:02');
INSERT INTO PREFIX_ticket (`id`, `ticket_no`, `userid`, `subject`, `customer`, `query`, `department_id`, `company_id`, `product_id`, `priorty`, `state`, `rating`, `email_no`, `tweet_id`, `spam`, `status`, `create_date`, `modified_date`) VALUES (52, '3d3d4696-8b2-1c9', 2, 'Hello World', 'mohamed.alyabbas@gmail.com', 'I send this email as a test\n\n---\nThis email has been checked for viruses by Avast antivirus software.\nhttps://www.avast.com/antivirus\n\n', 1, 1, 2, '2', 'C', '4.5', 1, NULL, 0, '1', '2016-01-19 19:45:55', '2016-01-23 19:57:02');


#
# TABLE STRUCTURE FOR: PREFIX_product
#

DROP TABLE IF EXISTS PREFIX_product;

CREATE TABLE `PREFIX_product` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO PREFIX_product (`id`, `product_name`, `status`, `create_date`) VALUES (2, 'B1ST Ticketing System', '1', '2016-01-10 01:38:48');
INSERT INTO PREFIX_product (`id`, `product_name`, `status`, `create_date`) VALUES (3, 'DC Number2Text', '1', '2016-01-10 01:38:58');


#
# TABLE STRUCTURE FOR: PREFIX_department
#

DROP TABLE IF EXISTS PREFIX_department;

CREATE TABLE `PREFIX_department` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO PREFIX_department (`id`, `department_name`, `status`, `create_date`) VALUES (1, 'Support', '1', '2016-01-10 01:39:49');
INSERT INTO PREFIX_department (`id`, `department_name`, `status`, `create_date`) VALUES (2, 'Sales', '1', '2016-01-10 01:40:16');
INSERT INTO PREFIX_department (`id`, `department_name`, `status`, `create_date`) VALUES (3, 'Billing', '1', '2016-01-10 01:41:43');


#
# TABLE STRUCTURE FOR: PREFIX_company
#

DROP TABLE IF EXISTS PREFIX_company;

CREATE TABLE `PREFIX_company` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_company (`id`, `company_name`, `company_website`, `status`, `create_date`) VALUES (1, 'EgyFirst Softwafare, LLC.', 'http://egyfirst.com', '1', '2015-11-21 12:09:22');
INSERT INTO PREFIX_company (`id`, `company_name`, `company_website`, `status`, `create_date`) VALUES (2, 'Premium Systems, LLC.', 'http://egyfirst.com/b1st', '1', '2015-11-21 12:10:01');


#
# TABLE STRUCTURE FOR: PREFIX_faq
#

DROP TABLE IF EXISTS PREFIX_faq;

CREATE TABLE `PREFIX_faq` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(25) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (1, 1, 'How often should I blog?', 'As much as you can. (That sounds flippant, but it\'s not meant to. Here\'s what I mean.)\n\nBlogging must be done consistently and frequently to see results. But here\'s the kicker: You must be able to sustain that frequency. In other words, if you set out to start blogging really great content five times a week, but that\'s too high a frequency for you to sustain over a long period of time, you\'re setting yourself up for failure. So, before you settle on a weekly or monthly number to hit, think about what frequency you can actually sustain based on the type of content you\'re creating.', '1', '2015-11-21 12:17:05');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (2, 1, 'How much of my own content should I tweet?', 'The general rule of thumb is that you should tweet about your brand 20% of the time and about your industry 80% of the time.\n\nThis 80% could include your own blog posts about the industry (not about your products/services), content from credible sources within your industry, user generated content, etc. The source of the content is up to you, as long as that 80% is helpful, educational, or entertaining for people in your industry (and not sales-y). The 20% includes more direct information about your products/services, which can be slightly more sales-focused.', '1', '2015-11-21 12:21:53');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (3, 1, 'How can a marketer create content and with ROI in mind?', 'Strategy and infrastructure. Without these, you\'ll lose steam after awhile and never see results. So, resist the urge to sprint out of the gate and create content haphazardly. Pause enough to plan and be strategic, set your goals, learn what will actually attract the right buyer, and then start producing content. I promise you\'ll run faster and longer if you plan first.', '1', '2015-11-21 12:33:20');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (4, 1, 'should I spend on social PPC or Google PPC?', 'This seems to be a big question among marketers who want to try out some paid campaigns but are constrained by budget. It’s tough to know right off the bat which network will be the best investment of your spend, so first and foremost, identify your goal and your metrics.', '1', '2015-11-21 12:35:57');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (5, 1, 'What metrics should I be using to measure email effectiveness?', 'When it comes to metrics for individual email sends and A/B tests, the open rate (OR) of an email send is a vital one to monitor. It\'s the measurement of total emails opened divided by total emails delivered. Use ORs to A/B test best send times, reactions to the sender name and email, and subject lines.', '1', '2015-11-21 12:36:32');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (6, 2, 'How to find content specific to your audience?', 'Try out some of these other great tools.\n\nSwayy\nQuora\nLinkedIn Pulse\nDigg Deeper\nSubreddits\nTopsy\nFeedly\nPrismatic', '1', '2015-11-21 12:39:44');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (7, 2, 'How to spread a tweet beyond your audience?', 'Getting extra attention to your campaign can be done a couple different ways. If you’re open to paying a bit for Twitter advertising, you can opt in to have a new or existing tweet appear in the timeline of other folks. You pay when a user engages with your tweet, and the average bid per engagement tends to be around $1.50 or $2.00.', '1', '2015-11-21 12:40:44');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (8, 2, 'Where to find content when you’re light on material?', '1-Hunting down great content using some of the tools and options mentioned above (BuzzSumo, Nuzzel, Digg Deeper, etc.).\n2- Blogging. If you don’t yet have a firmly established product or voice, you can 3- share behind-the-scenes with your process or share your thoughts on the industry.', '1', '2015-11-21 12:42:42');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (9, 2, 'How to get your customers involved and engaged?', 'Engagement—the sum of reshares, likes, comments, and clicks—is a big signal of social success for many people. How do you get more people talking about and interacting with your brand on social media?', '1', '2015-11-21 12:43:29');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (10, 2, 'How to get more retweets on Twitter?', 'So few of my tweets are RTed or favorited. I understand this for the promotional ones, which I try to disperse sparingly, but even the ones I feel offer great content have trouble getting traction.', '1', '2015-11-21 12:44:10');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (11, 2, 'How to respond on social media right away?', 'A key to quick reciprocation on social is to receive fast notifications. You can do this by keeping by your computer during work hours (one of the busiest times for social media interaction) or by setting up alerts and notifications from a mobile device.', '1', '2015-11-21 12:45:09');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (12, 3, 'How long should a letter, email or subject line be?', 'No matter which type of media is delivering your message, the content needs to be as long as it needs to be to generate action from your targeted audience.', '1', '2015-11-21 13:01:43');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (13, 3, '  What response rate should  I expect?', 'It depends. Response rates are affected by many variables, including media selection, list segmentation, timing, offers, copy and creative.', '1', '2015-11-21 13:02:10');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (14, 3, 'Does an offer have to be free shipping or a free gift to  be successful?', 'Offers are actually much more than just freebies that you throw into your marketing campaign. An offer is a package of elements. It\'s everything you\'re willing to give your readers in exchange for their response. ', '1', '2015-11-21 13:02:54');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (15, 3, 'Is direct mail dead?', 'Direct mail is not dead, but it\'s changing. To remain cost-effective, it\'s become much more targeted and is now integrated with digital media.', '1', '2015-11-21 13:03:33');
INSERT INTO PREFIX_faq (`id`, `product_id`, `question`, `answer`, `status`, `create_date`) VALUES (16, 3, 'Are direct marketing and direct mail the same thing?', 'No. Direct mail lists were the original workhorse used by direct marketers, but the two terms are not synonymous. The direct marketing process is channel agnostic and is powered by both traditional (such as direct mail lists) and new digital media.', '1', '2015-11-21 13:04:22');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_priority
#

DROP TABLE IF EXISTS PREFIX_ticket_priority;

CREATE TABLE `PREFIX_ticket_priority` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `priority_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_priority (`id`, `priority_name`, `priority_color`, `status`, `create_date`) VALUES (1, 'Critical', '#eb3026', '1', '2015-11-21 12:12:01');
INSERT INTO PREFIX_ticket_priority (`id`, `priority_name`, `priority_color`, `status`, `create_date`) VALUES (2, 'Normal', '#2077d9', '1', '2015-11-21 12:12:17');
INSERT INTO PREFIX_ticket_priority (`id`, `priority_name`, `priority_color`, `status`, `create_date`) VALUES (3, 'Low', '#94d426', '1', '2015-11-21 12:12:44');


#
# TABLE STRUCTURE FOR: PREFIX_privilege_group
#

DROP TABLE IF EXISTS PREFIX_privilege_group;

CREATE TABLE `PREFIX_privilege_group` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `privilege_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privileges` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_privilege_group (`id`, `privilege_name`, `privileges`, `description`, `status`, `create_date`) VALUES (1, 'Super Admin', '[\"AT\",\"DT\",\"CT\",\"ET\",\"ATTA\",\"TTAA\",\"RT\",\"RAT\",\"AAT\"]', 'Super Admin privilege with all the possible privileges in the application', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_privilege_group (`id`, `privilege_name`, `privileges`, `description`, `status`, `create_date`) VALUES (2, 'Users Ticket', '[\"RAT\"]', 'Users Ticket/ Client privilages', '1', '2016-01-14 02:38:38');


#
# TABLE STRUCTURE FOR: PREFIX_privileges
#

DROP TABLE IF EXISTS PREFIX_privileges;

CREATE TABLE `PREFIX_privileges` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (1, 'AT', 'Add Ticket', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (2, 'DT', 'Delete Ticket', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (3, 'CT', 'Close Ticket', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (4, 'ET', 'Edit Ticket', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (5, 'ATTA', 'Assign ticket to Admin', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (6, 'TTAA', 'Transfer ticket from one Admin to another Admin', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (7, 'RT', 'Reopen Tickets', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (8, 'RAT', 'Read all Tickets', '1', '2015-11-20 00:00:00');
INSERT INTO PREFIX_privileges (`id`, `code`, `name`, `status`, `create_date`) VALUES (9, 'AAT', 'Answer any tickets', '1', '2015-11-20 00:00:00');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_reply
#

DROP TABLE IF EXISTS PREFIX_ticket_reply;

CREATE TABLE `PREFIX_ticket_reply` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(25) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `replier_id` bigint(25) NOT NULL,
  `replier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (2, 3, 'Thank you for contact us.\n\n1- Select Twitter From Ticketing top menu.  Twitter Module window will open with blank tweet list for first time since no tweet is fetched.\n2- Click  Refresh icon in right panel for fetching tweets from given twitter account as set in settings tab\n3- Select a tweet from right panel will fetch it to the adjacent section with tweet content\n\nPlease let me know if I can help you any more\n', 1, 'admin', '2016-01-14 02:41:07');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (4, 6, 'Ife you worried about your customers messages and what accidents may happen to your server. Do not worry, B1ST allows you to generate backup of your messages database, as many as you wish to, with a push of a button.\n\nSelect Backup from Safety & Security menu. Manage Backup page is opened with existing backup file list if any along with the creation date when the backup was taken.', 1, 'admin', '2016-01-14 19:56:48');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (5, 5, 'Thank you for contact us.\n\nB1ST prevents spam by using 2 layers of authentication.\nThe first prevention layer by enabling reCAPTCHA to stop bot messages.\nThe second layer by integrating A.kis.met, the best automated spam killer that actually gets better as it learns.', 1, 'admin', '2016-01-14 19:57:24');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (6, 5, 'does this means it wont appear in my tickets initially?', 2, 'client', '2016-01-14 20:49:04');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (7, 5, 'Yes you can configure that from Spam settings page', 1, 'admin', '2016-01-14 21:31:32');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (8, 18, 'Thanks for contact us.\n\nSure you can use you PayPal account to Buy B1ST. We provide several ways including check and fax order.', 1, 'admin', '2016-01-15 21:24:29');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (9, 7, 'from \"Appearance & Locale\" top menu ==> select \"Theme\", then select the theme you like or even creat a one of your preferred color', 1, 'admin', '2016-01-15 21:31:29');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (10, 19, 'Nice that we can make you feel GOOD', 1, 'admin', '2016-01-15 23:10:39');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (11, 17, 'DC Number2Text costs $49 for the whole languages pack', 1, 'admin', '2016-01-15 23:11:35');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (12, 15, 'Sure you can. Simply use a proper name (level) with a proper color from \"Theme\" menu. That is it.', 1, 'admin', '2016-01-15 23:13:02');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (13, 16, 'Message-board has a section where an admin can filter/search  messages by different ways. We refer to this section as Filtering-Section. In this section you can filter tickets by:\nPriority\nDepartment\nProduct\nState', 1, 'admin', '2016-01-15 23:13:57');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (14, 14, 'Please make sure to remove \"install\" folder once a successful installation is done.', 1, 'admin', '2016-01-15 23:15:25');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (15, 3, 'Thanks for the comprehensive instructions', 2, 'client', '2016-01-15 23:17:48');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (16, 3, 'thanks', 2, 'client', '2016-01-15 23:53:05');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (17, 3, 'hi\n', 2, 'client', '2016-01-16 00:36:22');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (18, 13, 'B1ST is a commercial product. no part of it can be used in any product based on it without a written license from EgyFirst Softwate. LLC', 1, 'admin', '2016-01-16 23:34:10');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (19, 11, 'Thanks for contact us.\n\nsimply use \"setLanguage\" function to set the the language.\ne.g. setlanguage(ENGLISH)', 1, 'admin', '2016-01-16 23:35:34');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (20, 9, 'you can get it from Codecanyon.net ', 1, 'admin', '2016-01-16 23:36:20');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (21, 12, 'Thanks for contact us.\n\nSure, DC Number2Text support Russian language in addition to other 12 languages. for a list of supported languages visit our website\n', 1, 'admin', '2016-01-16 23:37:54');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (22, 1, 'Thank you. EgyFirst wish you a happy new year, Mohamed', 1, 'admin', '2016-01-16 23:38:40');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (40, 10, 'Please allow 2 days for the transaction to appear on your CC', 1, 'admin', '2016-01-19 18:43:09');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (44, 50, 'This is our reply to your ticket', 1, 'admin', '2016-01-19 19:42:10');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (45, 51, 'This is our reply to your Chat session', 1, 'admin', '2016-01-19 19:44:04');
INSERT INTO PREFIX_ticket_reply (`id`, `ticket_id`, `body`, `replier_id`, `replier`, `date`) VALUES (46, 4, 'Ok. this is our reply', 1, 'admin', '2016-01-30 20:32:15');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_states
#

DROP TABLE IF EXISTS PREFIX_ticket_states;

CREATE TABLE `PREFIX_ticket_states` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (1, 'O', 'open', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (2, 'C', 'close', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (3, 'P', 'pending', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (4, 'S', 'spam', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (5, 'RO', 're-opened', '1', '2015-11-20 23:11:59');
INSERT INTO PREFIX_ticket_states (`id`, `code`, `name`, `status`, `creation_date`) VALUES (6, 'A', 'answered', '1', '2015-11-20 23:11:59');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_users
#

DROP TABLE IF EXISTS PREFIX_ticket_users;

CREATE TABLE `PREFIX_ticket_users` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `privilege_group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responder_time_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Offline=0, Online=1',
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (1, 'Mohamed', 'Ali', 'admin', 'mohamed.alyabbas@gmail.com', '', '1-6-M-2-5-R-7-8-C-7-9-S-6-1-1-H-2-8-G-7-8-Y-9-8', '1', '1', NULL, NULL, NULL, '1', '1', '2015-11-20 23:11:59', '2016-01-31 00:24:26');
INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (2, 'Jan', 'Louis', 'test', 'gr.b10@mailinator.com', '', '1-6-H-1-6-E-5-6-X-0-0-1-T-2-2-1-G-6-8-V-1-7-H-0-0-1', '0', '2', NULL, NULL, 'ticket_posting', '1', '1', '2015-11-20 23:11:59', '2016-01-30 20:17:56');
INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (3, 'Paul ', 'Antonio', 'paul', 'gr.b25@mailinator.com', '', '1-6-B-9-6-P-2-2-1-N-8-7-Z-3-5-J-9-6-J-6-0-1-T-7-7-P-0-2-1-Q-7-7-Z-4-8-M-7-7', '0', '2', NULL, NULL, 'ticket_posting', '0', '1', '2016-01-26 00:53:36', '2016-01-30 20:04:28');
INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (4, 'Jhon', 'Bird', 'jhon', 'gr.g11@mailinator.com', '', '1-6-G-9-6-G-2-2-1-A-8-7-G-3-5-U-9-6-F-6-0-1-R-7-7-L-0-2-1-I-7-7-X-4-8-D-7-7', '0', '2', NULL, NULL, 'ticket_posting', '0', '1', '2016-01-26 01:10:44', '2016-01-30 20:14:02');
INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (8, 'Mac', 'Lee', 'Sales', 'alex.ted71@yahoo.com', '', '1-6-W-2-5-W-7-8-X-7-9-P-6-1-1-G-2-8-P-7-8-L-9-8', '1', '1', NULL, NULL, NULL, '0', '1', '2016-01-26 14:50:44', '2016-01-30 20:21:52');
INSERT INTO PREFIX_ticket_users (`id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `password`, `admin`, `privilege_group_id`, `responder_time_duration`, `hash`, `type`, `online_status`, `status`, `creation_date`, `modified_date`) VALUES (9, 'Alex', 'Merci', 'Billing', 'alex@egyfirst.com', '', '1-6-J-2-5-M-7-8-L-7-9-Z-6-1-1-Y-2-8-K-7-8-G-9-8', '1', '1', NULL, NULL, NULL, '1', '1', '2016-01-26 14:51:54', '2016-01-30 20:22:21');


#
# TABLE STRUCTURE FOR: PREFIX_attachments
#

DROP TABLE IF EXISTS PREFIX_attachments;

CREATE TABLE `PREFIX_attachments` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(25) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_attachments (`id`, `ticket_id`, `filename`) VALUES (1, 54, '3d5eb283-8ed-1ef.jpg');


#
# TABLE STRUCTURE FOR: PREFIX_temp_file
#

DROP TABLE IF EXISTS PREFIX_temp_file;

CREATE TABLE `PREFIX_temp_file` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_temp_file (`id`, `filename`, `session_id`) VALUES (1, '3d5eb283-8ed-1ef.jpg', '45d2196c553c768fe6f05faf4439fe4c');


#
# TABLE STRUCTURE FOR: PREFIX_theme
#

DROP TABLE IF EXISTS PREFIX_theme;

CREATE TABLE `PREFIX_theme` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL,
  `theme_color` varchar(10) NOT NULL,
  `set_default` enum('1','0') NOT NULL DEFAULT '0',
  `front_set_default` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (1, 'Default', '#da4c4c', '0', '0', '1', '2015-04-16 11:22:29');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (2, 'Red', '#9e0000', '0', '0', '1', '2015-04-16 11:22:29');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (3, 'Blue', '#1d72b3', '0', '0', '1', '2015-04-16 11:22:45');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (4, 'Green', '#579e4f', '0', '0', '1', '2015-04-16 11:23:22');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (5, 'Orange', '#f2780c', '0', '0', '1', '2015-04-16 11:23:38');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (6, 'Grey', '#969696', '0', '0', '1', '2015-04-16 11:23:51');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (7, 'Dark', '#646464', '0', '0', '1', '2015-04-16 11:24:13');
INSERT INTO PREFIX_theme (`id`, `theme_name`, `theme_color`, `set_default`, `front_set_default`, `status`, `create_date`) VALUES (8, 'Light', '#c8c8c8', '0', '0', '1', '2015-04-16 11:24:51');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_register_types
#

DROP TABLE IF EXISTS PREFIX_ticket_register_types;

CREATE TABLE `PREFIX_ticket_register_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_register_types (`id`, `type`) VALUES (1, 'ticket_posting');
INSERT INTO PREFIX_ticket_register_types (`id`, `type`) VALUES (2, 'read_reply');
INSERT INTO PREFIX_ticket_register_types (`id`, `type`) VALUES (3, 'register');


#
# TABLE STRUCTURE FOR: PREFIX_ticket_rating
#

DROP TABLE IF EXISTS PREFIX_ticket_rating;

CREATE TABLE `PREFIX_ticket_rating` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(25) NOT NULL,
  `user_id` bigint(25) NOT NULL,
  `rating` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (1, 3, 2, '4.5', '2016-01-14 02:42:36');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (2, 4, 2, '5.0', '2016-01-14 19:47:23');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (3, 5, 2, '3.5', '2016-01-15 17:30:37');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (4, 6, 2, '5.0', '2016-01-15 17:30:47');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (5, 7, 2, '2.0', '2016-01-15 21:28:09');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (6, 8, 2, '0.5', '2016-01-15 21:29:13');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (7, 9, 2, '5.0', '2016-01-15 23:16:32');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (8, 10, 2, '5.0', '2016-01-15 23:16:34');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (9, 11, 2, '4.5', '2016-01-15 23:16:36');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (10, 12, 2, '5.0', '2016-01-15 23:16:38');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (11, 13, 2, '4.0', '2016-01-15 23:16:41');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (12, 14, 2, '5.0', '2016-01-15 23:16:45');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (13, 15, 2, '5.0', '2016-01-15 23:16:48');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (14, 16, 2, '4.5', '2016-01-15 23:16:52');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (15, 17, 2, '3.5', '2016-01-15 23:16:57');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (16, 18, 2, '5.0', '2016-01-15 23:16:59');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (17, 50, 2, '4.5', '2016-01-30 16:14:38');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (18, 51, 2, '5.0', '2016-01-30 16:14:40');
INSERT INTO PREFIX_ticket_rating (`id`, `ticket_id`, `user_id`, `rating`, `dateAdded`) VALUES (19, 52, 2, '4.5', '2016-01-30 16:14:45');


#
# TABLE STRUCTURE FOR: PREFIX_chatsession
#

DROP TABLE IF EXISTS PREFIX_chatsession;

CREATE TABLE `PREFIX_chatsession` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `to_userid` bigint(25) NOT NULL,
  `from_userid` bigint(25) NOT NULL,
  `seen` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'seen=1, unseen=0',
  `chat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (11, 9, 2, '1', 'Hello\n', '2016-01-26 14:53:14');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (12, 2, 9, '1', 'Hello\n', '2016-01-26 14:53:38');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (13, 9, 2, '1', 'I want to buy your product using paypal\n', '2016-01-26 14:53:57');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (14, 2, 9, '1', 'NO problem. I will post this chat as ticket for further assistance\n', '2016-01-26 14:55:26');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (15, 9, 2, '1', 'Thanks\n', '2016-01-26 14:57:00');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (16, 2, 9, '1', 'your ticket No is\n de70f23a-24e-e1f\n', '2016-01-26 14:57:17');
INSERT INTO PREFIX_chatsession (`id`, `to_userid`, `from_userid`, `seen`, `chat`, `create_date`) VALUES (17, 2, 9, '1', 'Wii will send you a message once this issue is solved\n', '2016-01-26 14:58:15');


#
# TABLE STRUCTURE FOR: PREFIX_kb_cat
#

DROP TABLE IF EXISTS PREFIX_kb_cat;

CREATE TABLE `PREFIX_kb_cat` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_kb_cat (`id`, `category_name`, `status`, `create_date`) VALUES (1, 'System Requirements', '1', '2015-11-21 13:12:39');
INSERT INTO PREFIX_kb_cat (`id`, `category_name`, `status`, `create_date`) VALUES (2, 'Setup & Installation', '1', '2015-11-21 13:54:31');
INSERT INTO PREFIX_kb_cat (`id`, `category_name`, `status`, `create_date`) VALUES (3, 'Configuration & Customization', '1', '2015-11-21 13:54:55');
INSERT INTO PREFIX_kb_cat (`id`, `category_name`, `status`, `create_date`) VALUES (5, 'Maintenance & Safety', '1', '2015-11-21 13:56:40');


#
# TABLE STRUCTURE FOR: PREFIX_knowledgebasemod
#

DROP TABLE IF EXISTS PREFIX_knowledgebasemod;

CREATE TABLE `PREFIX_knowledgebasemod` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(25) NOT NULL,
  `product_id` bigint(25) NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (1, 1, 1, 'Minimum Hardware Requirement', 'This section describes the minimum hardware requirements for the Enterprise Service Monitor.\n2 CPU Cores\n2 GB RAM\n\nDisk I/O subsystem applicable to a write-intensive database', '1', '2015-11-21 13:15:57');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (2, 1, 1, 'Recommended Hardware Requirements', 'This section describes the recommended hardware requirements for the Enterprise Service Manager.\n\n4 CPU Cores or more\n8 GB RAM or more\nRAID10 or RAID 0+1 disk setup', '1', '2015-11-21 13:16:53');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (3, 1, 1, 'Supported Platforms', 'The following are recommended:\n\nEnsure that your Service Manager and Agent hosts are synchronized to the same time server. It is important that all times are properly synchronized.\n\nEnsure that your Service Manager and Agent hosts use different SSH host keys before installing.', '1', '2015-11-21 13:18:14');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (4, 1, 2, 'Minimum Hardware Requirement', 'If you want to run Windows 8.1 on your PC, here is what it takes:\n\nProcessor: 1 gigahertz (GHz) or faster with support for PAE, NX, and SSE2 (more info)\n\nRAM: 1 gigabyte (GB) (32-bit) or 2 GB (64-bit)\n\nHard disk space: 16 GB (32-bit) or 20 GB (64-bit)\n\nGraphics card: Microsoft DirectX 9 graphics device with WDDM driver', '1', '2015-11-21 13:43:34');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (5, 1, 2, 'Additional requirements to use certain features', 'To use touch, you need a tablet or a monitor that supports multitouch (more info)\n\nTo access the Windows Store and to download, run, and snap apps, you need an active Internet connection and a screen resolution of at least 1024 x 768\n\nMicrosoft account required for some features\n\nInternet access (ISP fees might apply)\n\nSecure boot requires firmware that supports UEFI v2.3.1 Errata B and has the Microsoft Windows Certification Authority in the UEFI signature database\n', '1', '2015-11-21 13:45:33');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (6, 1, 3, 'Minimum Hardware Requirement', 'Microsoft Windows 7 Home Premium\n32-bit Intel® Pentium® 4 or AMD Athlon™ Dual Core, 3.0 GHz or higher with SSE2 technology\nDeployment via Deployment Wizard.\n2 GB Memory\n1024x768 (1600x1050 or higher recommended) with True Color\nInstallation 6.0 GB', '1', '2015-11-21 13:51:14');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (7, 1, 3, 'Recommended Hardware Requirements', 'Microsoft Windows 8.1\n64-bit Intel® Pentium® 4 or AMD Athlon™ Dual Core, 3.0 GHz or higher with SSE2 technology\nDeployment via Deployment Wizard.\n8 GB Memory\n1600x1050 or higher recommended) with True Color\nInstallation 6.0 GB + 4 GB for workplace area.', '1', '2015-11-21 13:53:07');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (8, 2, 2, 'How can I install B1ST?', 'Navigate to your_script_install_path_on_server/install/\ne.g. http://egyfirst.com/install\n\nMake sure that these files have permission of 777\n\nCI/application/config/config.php\n\nMake sure tha these folders have permission of 777\n\nbackup\ntmp\nCI/assets/attachment\n\n\nMySQL Configuration\nenter your MySQL database name, user-name, user-password and server name (usually localhost works fine)', '1', '2016-01-14 20:00:04');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (9, 2, 3, 'How can I install DC Number2Text?', 'DC Number2Text is a COM-Based DLL. you can simply include it in your project within Microsoft Visual studio IDE. Then from references navigate to the location where the dll is installed in your system. That is it.', '1', '2016-01-14 20:02:47');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (10, 3, 2, 'How can I confgure B1ST?', 'There are several ways to configure B1st. You can decide which module to load and which to not. you can customize the color of your themes. You can define how how long tickets should take to auto close if no response received and how long a databases should backed up automatically and more ...', '1', '2016-01-14 20:09:26');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (11, 3, 3, 'How can I confgure DC Number2text?', 'DC Number2Text can be configured to specify which language you want the numbers to be translated into words in. DC Number2text offers 13 languages to choose from including English, French, German, Italian, Arabic, Chines, Portuguese, Russian, Turkish and more.', '1', '2016-01-14 20:13:16');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (12, 5, 2, 'How can I Backup B1ST?', 'If you are worried about your customers messages and what accidents may happen to your server. Do not worry, B1ST allows you to generate backup of your messages database, as many as you wish to, with a push of a button.\n\nSelect Backup from Safety & Security menu. Manage Backup page is opened with existing backup file list if any along with the creation date when the backup was taken.\n', '1', '2016-01-14 20:37:15');
INSERT INTO PREFIX_knowledgebasemod (`id`, `category_id`, `product_id`, `topic`, `content`, `status`, `create_date`) VALUES (13, 5, 2, 'How can I prevent Spam in B1st?', 'B1ST prevents spam by using 2 layers of authentication.\nThe first prevention layer by enabling reCAPTCHA to stop bot messages.\nThe second layer by integrating A.kis.met, the best automated spam killer that actually gets better as it learns.\n\n', '1', '2016-01-14 20:39:32');


#
# TABLE STRUCTURE FOR: PREFIX_language
#

DROP TABLE IF EXISTS PREFIX_language;

CREATE TABLE `PREFIX_language` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_default_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (1, 'English', 'eng', '1', '1');
INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (2, 'French', 'fra', '0', '0');
INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (3, 'German', 'ger', '0', '0');
INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (4, 'Spanish', 'spa', '0', '0');
INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (5, 'Arabic', 'ara', '0', '0');
INSERT INTO PREFIX_language (`id`, `language_name`, `language_code`, `default_status`, `back_default_status`) VALUES (6, 'Indian', 'hin', '0', '0');


#
# TABLE STRUCTURE FOR: PREFIX_admin_ticket_assignment
#

DROP TABLE IF EXISTS PREFIX_admin_ticket_assignment;

CREATE TABLE `PREFIX_admin_ticket_assignment` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(25) NOT NULL,
  `ticket_id` bigint(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_admin_ticket_assignment (`id`, `admin_id`, `ticket_id`) VALUES (1, 1, 1);


#
# TABLE STRUCTURE FOR: PREFIX_ticket_backup
#

DROP TABLE IF EXISTS PREFIX_ticket_backup;

CREATE TABLE `PREFIX_ticket_backup` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `backup_description` text COLLATE utf8mb4_unicode_ci,
  `backup_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (1, '2015-12-12_16:56:58', 'Auto Backup', 'all', '2015-12-12 16:56:58');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (2, 'backup', NULL, 'all', '2015-12-12 17:08:23');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (3, '2016-01-10_01:33:28', 'Auto Backup', 'all', '2016-01-10 01:33:28');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (4, 'last backup', NULL, 'all', '2016-01-16 00:06:57');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (5, '2016-01-17_00:00:01', 'Auto Backup', 'all', '2016-01-17 00:00:01');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (6, 'lastful', NULL, 'all', '2016-01-23 20:00:30');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (7, '2016-01-25_09:31:58', 'Auto Backup', 'all', '2016-01-25 09:31:58');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (8, '2016-02-03_21:17:44', 'Auto Backup', 'all', '2016-02-03 21:17:44');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (9, 'init', NULL, 'all', '2016-02-04 16:34:36');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (10, 'Demo-Data', NULL, 'data', '2016-02-04 16:35:28');
INSERT INTO PREFIX_ticket_backup (`id`, `backup_name`, `backup_description`, `backup_type`, `creation_date`) VALUES (11, 'Restore_to_Load_a_Demo_Data', NULL, 'data', '2016-02-04 17:45:09');


#
# TABLE STRUCTURE FOR: PREFIX_moduletables
#

DROP TABLE IF EXISTS PREFIX_moduletables;

CREATE TABLE `PREFIX_moduletables` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `install_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (1, 'faq', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (2, 'knowledge_base_cat', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (3, 'knowledge_base', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (4, 'backup', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (5, 'chat', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (6, 'response_time', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (7, 'rating', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (8, 'opswat', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (9, 'akismet', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (10, 'email_mod', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (11, 'twitter', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (12, 'mob_ver', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (13, 'statistics', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (14, 'company', '1', '1');
INSERT INTO PREFIX_moduletables (`id`, `name`, `status`, `install_status`) VALUES (15, 'product', '1', '1');


#
# TABLE STRUCTURE FOR: PREFIX_emails
#

DROP TABLE IF EXISTS PREFIX_emails;

CREATE TABLE `PREFIX_emails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `eid` bigint(20) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_emails (`id`, `eid`, `subject`, `body`, `deleted`) VALUES (1, 1, 'Hello World', 'I send this email as a test\r\n\r\n---\r\nThis email has been checked for viruses by Avast antivirus software.\r\nhttps://www.avast.com/antivirus\r\n\r\n', 0);


#
# TABLE STRUCTURE FOR: PREFIX_tweets
#

DROP TABLE IF EXISTS PREFIX_tweets;

CREATE TABLE `PREFIX_tweets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tid` bigint(20) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (1, 686008400241647616, '@egyfirst Succeeded', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (2, 686007680310329345, '@egyfirst How are you. Fine?', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (3, 600429440292773888, '. @egyfirst Welcome to Owler! Your company profile can be accessed here: http://t.co/Zt4mBUyeng', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (5, 464920519016714240, 'The Daily Squid is out! http://t.co/sDtmxpfqKs Stories via @Crane_Maiden @maheshsundarvl @egyfirst', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (6, 688061256620752896, '@egyfirst How much does it cost?', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (7, 688166287550201856, '@egyfirst answer', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (8, 688166141047386113, '@egyfirst How are you', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (9, 688171675771252736, '@egyfirst go ahead', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (10, 688366368912224257, '@egyfirst I send this from Mohamed Aly Abbas', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (11, 688369054369845250, '@egyfirst hi', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (12, 688374986273386500, 'Hello', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (13, 688374828924071940, 'please let me know', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (14, 688374761525800963, 'ok received or not', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (15, 609381313137745920, 'Gostaria do orçamento para manipulação. Obrigada.', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (16, 608628530184859648, 'dsfsfsdfdsf', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (17, 688848924824698883, 'شكرا لكلماتك الرقيقة', 1);
INSERT INTO PREFIX_tweets (`id`, `tid`, `body`, `deleted`) VALUES (18, 689534463022333956, 'I send this message via twitter direct message', 0);


#
# TABLE STRUCTURE FOR: PREFIX_responder_time_duration
#

DROP TABLE IF EXISTS PREFIX_responder_time_duration;

CREATE TABLE `PREFIX_responder_time_duration` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `userid` bigint(25) NOT NULL,
  `responder_time_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currentdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (1, 1, '307', '2016-01-14 02:31:45');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (2, 1, '331', '2016-01-14 02:41:07');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (3, 1, '1132', '2016-01-14 19:46:48');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (4, 1, '100', '2016-01-14 19:56:48');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (5, 1, '367', '2016-01-14 19:57:24');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (6, 1, '2548', '2016-01-14 21:31:32');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (7, 1, '12397', '2016-01-15 21:24:29');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (8, 1, '14226', '2016-01-15 21:31:29');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (9, 1, '6738', '2016-01-15 23:10:39');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (10, 1, '18948', '2016-01-15 23:11:35');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (11, 1, '19268', '2016-01-15 23:13:02');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (12, 1, '19212', '2016-01-15 23:13:57');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (13, 1, '19552', '2016-01-15 23:15:25');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (14, 1, '107197', '2016-01-16 23:34:10');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (15, 1, '107643', '2016-01-16 23:35:34');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (16, 1, '107947', '2016-01-16 23:36:20');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (17, 1, '107681', '2016-01-16 23:37:54');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (18, 1, '249601', '2016-01-16 23:38:40');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (19, 1, '40', '2016-01-19 00:04:53');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (20, 1, '40', '2016-01-19 00:14:00');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (21, 1, '34', '2016-01-19 00:20:04');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (22, 1, '36', '2016-01-19 14:11:08');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (23, 1, '33', '2016-01-19 14:35:50');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (24, 1, '29', '2016-01-19 14:37:38');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (25, 1, '35', '2016-01-19 15:46:42');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (26, 1, '29', '2016-01-19 15:58:06');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (27, 1, '27', '2016-01-19 16:18:24');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (28, 1, '32', '2016-01-19 16:23:34');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (29, 1, '33', '2016-01-19 16:25:17');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (30, 1, '23', '2016-01-19 16:27:52');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (31, 1, '19', '2016-01-19 17:41:49');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (32, 1, '13', '2016-01-19 17:55:11');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (33, 1, '48', '2016-01-19 18:33:17');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (34, 1, '21', '2016-01-19 18:39:10');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (35, 1, '440', '2016-01-19 18:40:37');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (36, 1, '38', '2016-01-19 18:43:09');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (37, 1, '34', '2016-01-19 19:17:51');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (38, 1, '31', '2016-01-19 19:19:26');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (39, 1, '32', '2016-01-19 19:34:22');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (40, 1, '29', '2016-01-19 19:42:10');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (41, 1, '36', '2016-01-19 19:44:04');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (42, 9, '190', '2016-01-26 14:59:18');
INSERT INTO PREFIX_responder_time_duration (`id`, `userid`, `responder_time_duration`, `currentdate`) VALUES (43, 1, '324', '2016-01-30 20:32:15');


