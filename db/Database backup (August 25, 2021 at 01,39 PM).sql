DROP TABLE IF EXISTS activity_logs;

CREATE TABLE `activity_logs` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(11) unsigned NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `country` varchar(40) NOT NULL,
  `countryCode` varchar(10) NOT NULL,
  `browser` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

INSERT INTO activity_logs VALUES("1","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 09:30:30");
INSERT INTO activity_logs VALUES("2","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 09:59:58");
INSERT INTO activity_logs VALUES("3","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 10:23:47");
INSERT INTO activity_logs VALUES("4","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 10:41:42");
INSERT INTO activity_logs VALUES("5","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 11:03:31");
INSERT INTO activity_logs VALUES("6","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 11:07:43");
INSERT INTO activity_logs VALUES("7","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 11:24:24");
INSERT INTO activity_logs VALUES("8","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 11:27:21");
INSERT INTO activity_logs VALUES("9","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 11:49:27");
INSERT INTO activity_logs VALUES("10","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 12:06:16");
INSERT INTO activity_logs VALUES("11","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 12:31:12");
INSERT INTO activity_logs VALUES("12","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:09:00");
INSERT INTO activity_logs VALUES("13","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:16:50");
INSERT INTO activity_logs VALUES("14","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:20:03");
INSERT INTO activity_logs VALUES("15","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:24:07");
INSERT INTO activity_logs VALUES("16","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:26:24");
INSERT INTO activity_logs VALUES("17","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:28:13");
INSERT INTO activity_logs VALUES("18","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:32:12");
INSERT INTO activity_logs VALUES("19","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:33:50");
INSERT INTO activity_logs VALUES("20","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:35:56");
INSERT INTO activity_logs VALUES("21","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:38:28");
INSERT INTO activity_logs VALUES("22","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:40:12");
INSERT INTO activity_logs VALUES("23","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 13:41:53");
INSERT INTO activity_logs VALUES("24","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 14:07:02");
INSERT INTO activity_logs VALUES("25","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 14:55:34");
INSERT INTO activity_logs VALUES("26","4","Login admin","admin","41.238.78.0","Egypt","EG","Chrome","2021-07-25 15:03:32");
INSERT INTO activity_logs VALUES("27","4","Login admin","admin","156.219.11.237","Egypt","EG","Chrome","2021-07-25 22:23:49");
INSERT INTO activity_logs VALUES("28","4","Login admin","admin","102.41.3.90","Egypt","EG","Chrome","2021-07-26 14:46:41");
INSERT INTO activity_logs VALUES("29","4","Login admin","admin","102.41.3.90","Egypt","EG","Chrome","2021-07-26 14:57:27");
INSERT INTO activity_logs VALUES("30","4","Login admin","admin","156.219.11.237","Egypt","EG","Chrome","2021-07-26 21:34:27");
INSERT INTO activity_logs VALUES("31","4","Login admin","admin","156.208.192.222","Egypt","EG","Chrome","2021-07-28 12:16:08");
INSERT INTO activity_logs VALUES("32","4","Login admin","admin","196.157.100.67","Egypt","EG","Chrome","2021-07-29 10:01:06");
INSERT INTO activity_logs VALUES("33","4","Login admin","admin","156.219.240.108","Egypt","EG","Chrome","2021-07-30 10:48:26");
INSERT INTO activity_logs VALUES("34","4","Login admin","admin","156.219.240.108","Egypt","EG","Chrome","2021-07-30 21:33:50");
INSERT INTO activity_logs VALUES("35","4","Login admin","admin","197.40.171.144","Egypt","EG","Chrome","2021-07-31 16:18:02");
INSERT INTO activity_logs VALUES("36","4","Login admin","admin","156.219.249.83","Egypt","EG","Chrome","2021-07-31 22:29:40");
INSERT INTO activity_logs VALUES("37","4","Login admin","admin","156.219.249.83","Egypt","EG","Chrome","2021-07-31 22:31:27");
INSERT INTO activity_logs VALUES("38","4","Login admin","admin","41.40.187.157","Egypt","EG","Chrome","2021-08-01 10:31:04");
INSERT INTO activity_logs VALUES("39","4","Login admin","admin","41.40.187.157","Egypt","EG","Chrome","2021-08-01 11:04:39");
INSERT INTO activity_logs VALUES("40","4","Login admin","admin","41.40.187.157","Egypt","EG","Chrome","2021-08-01 11:05:23");
INSERT INTO activity_logs VALUES("41","4","Login admin","admin","41.40.187.157","Egypt","EG","Chrome","2021-08-01 13:10:05");
INSERT INTO activity_logs VALUES("42","4","Login admin","admin","41.40.187.157","Egypt","EG","Chrome","2021-08-01 13:44:26");
INSERT INTO activity_logs VALUES("43","4","Login admin","admin","156.208.241.114","Egypt","EG","Chrome","2021-08-02 12:47:55");
INSERT INTO activity_logs VALUES("44","4","Login admin","admin","41.64.212.149","Egypt","EG","Chrome","2021-08-02 16:03:51");
INSERT INTO activity_logs VALUES("45","4","Login admin","admin","41.64.212.149","Egypt","EG","Chrome","2021-08-02 16:03:51");
INSERT INTO activity_logs VALUES("46","4","Login admin","admin","41.64.212.149","Egypt","EG","Chrome","2021-08-02 16:11:11");
INSERT INTO activity_logs VALUES("47","4","Login admin","admin","176.47.44.196","Saudi Arabia","SA","Chrome","2021-08-03 12:46:47");
INSERT INTO activity_logs VALUES("48","4","Login admin","admin","41.40.163.157","Egypt","EG","Chrome","2021-08-05 11:56:35");
INSERT INTO activity_logs VALUES("49","3","Deleted id from orders","admin","41.40.163.157","Egypt","EG","Chrome","2021-08-05 12:08:25");
INSERT INTO activity_logs VALUES("50","4","Login admin","admin","41.40.163.157","Egypt","EG","Chrome","2021-08-05 12:10:22");
INSERT INTO activity_logs VALUES("51","4","Login admin","admin","51.39.115.174","Saudi Arabia","SA","Chrome","2021-08-05 13:06:21");
INSERT INTO activity_logs VALUES("52","3","Deleted id from categories","admin","51.39.115.174","Saudi Arabia","SA","Chrome","2021-08-05 13:34:44");
INSERT INTO activity_logs VALUES("53","3","Deleted id from customers","admin","51.39.115.174","Saudi Arabia","SA","Chrome","2021-08-05 13:43:04");
INSERT INTO activity_logs VALUES("54","3","Deleted id from customers","admin","51.39.115.174","Saudi Arabia","SA","Chrome","2021-08-05 13:43:58");
INSERT INTO activity_logs VALUES("55","3","Deleted id from customers","admin","51.39.115.174","Saudi Arabia","SA","Chrome","2021-08-05 13:45:00");
INSERT INTO activity_logs VALUES("56","4","Login admin","admin","41.40.163.157","Egypt","EG","Chrome","2021-08-05 14:35:29");
INSERT INTO activity_logs VALUES("57","4","Login admin","admin","41.40.163.157","Egypt","EG","Chrome","2021-08-05 14:50:23");
INSERT INTO activity_logs VALUES("58","4","Login admin","admin","156.219.134.140","Egypt","EG","Chrome","2021-08-05 21:06:04");
INSERT INTO activity_logs VALUES("59","4","Login admin","admin","156.219.157.209","Egypt","EG","Chrome","2021-08-06 16:54:53");
INSERT INTO activity_logs VALUES("60","4","Login admin","admin","156.219.157.209","Egypt","EG","Chrome","2021-08-07 17:21:23");
INSERT INTO activity_logs VALUES("61","4","Login admin","admin","41.40.173.57","Egypt","EG","Chrome","2021-08-08 10:53:08");
INSERT INTO activity_logs VALUES("62","4","Login admin","admin","41.40.173.57","Egypt","EG","Chrome","2021-08-08 11:14:40");
INSERT INTO activity_logs VALUES("63","4","Login admin","admin","41.40.173.57","Egypt","EG","Chrome","2021-08-08 13:31:56");
INSERT INTO activity_logs VALUES("64","4","Login admin","admin","156.219.157.209","Egypt","EG","Chrome","2021-08-08 22:42:59");
INSERT INTO activity_logs VALUES("65","4","Login admin","admin","156.208.84.134","Egypt","EG","Firefox","2021-08-09 08:25:01");
INSERT INTO activity_logs VALUES("66","4","Login admin","admin","156.208.84.134","Egypt","EG","Chrome","2021-08-09 14:09:44");
INSERT INTO activity_logs VALUES("67","4","Login admin","admin","41.40.188.45","Egypt","EG","Chrome","2021-08-10 10:50:41");
INSERT INTO activity_logs VALUES("68","4","Login admin","admin","156.208.205.158","Egypt","EG","Chrome","2021-08-11 10:07:28");
INSERT INTO activity_logs VALUES("69","4","Login admin","admin","156.208.205.158","Egypt","EG","Chrome","2021-08-11 14:13:55");
INSERT INTO activity_logs VALUES("70","4","Login admin","admin","197.40.139.54","Egypt","EG","Chrome","2021-08-12 10:04:17");
INSERT INTO activity_logs VALUES("71","4","Login admin","admin","156.219.249.2","Egypt","EG","Chrome","2021-08-14 11:28:29");
INSERT INTO activity_logs VALUES("72","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-15 12:34:39");
INSERT INTO activity_logs VALUES("73","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-15 14:26:00");
INSERT INTO activity_logs VALUES("74","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-16 14:47:55");
INSERT INTO activity_logs VALUES("75","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-17 15:33:01");
INSERT INTO activity_logs VALUES("76","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-18 08:40:29");
INSERT INTO activity_logs VALUES("77","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-18 14:18:54");
INSERT INTO activity_logs VALUES("78","4","Login admin","admin","41.40.174.185","Egypt","EG","Chrome","2021-08-19 10:49:30");
INSERT INTO activity_logs VALUES("79","4","Login admin","admin","156.208.31.181","Egypt","EG","Chrome","2021-08-19 13:43:21");
INSERT INTO activity_logs VALUES("80","4","Login admin","admin","197.40.254.247","Egypt","EG","Chrome","2021-08-20 13:16:15");
INSERT INTO activity_logs VALUES("81","4","Login admin","admin","154.182.252.64","Egypt","EG","Chrome","2021-08-21 14:32:24");
INSERT INTO activity_logs VALUES("82","4","Login admin","admin","156.208.58.129","Egypt","EG","Chrome","2021-08-22 11:38:21");
INSERT INTO activity_logs VALUES("83","4","Login admin","admin","156.208.46.2","Egypt","EG","Chrome","2021-08-25 11:23:04");
INSERT INTO activity_logs VALUES("84","4","Login admin","admin","156.208.12.21","Egypt","EG","Chrome","2021-08-25 13:39:10");



DROP TABLE IF EXISTS admins;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `profile` varchar(225) NOT NULL DEFAULT 'images/profile.png',
  `otp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO admins VALUES("1","admin","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","admin@gmail.com","","","0");



DROP TABLE IF EXISTS categories;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `image` varchar(225) NOT NULL,
  `no_products` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO categories VALUES("3","0","شراريب","uploads/images/Untitled-4-02.png","0","2021-07-12 15:32:48","2021-07-14 15:20:05","1");
INSERT INTO categories VALUES("4","0","مناشف","uploads/images/Untitled-4-03.png","0","2021-07-12 15:33:04","2021-08-05 13:27:39","1");
INSERT INTO categories VALUES("5","3","شرابات رجالى","uploads/images/9816713045c769f2e3df04e5a0dd14af_680x.png","0","2021-07-12 16:07:41","2021-07-14 15:20:14","1");
INSERT INTO categories VALUES("6","4","مناشف احجام منوعه  ","uploads/images/Q1.jpg","0","2021-07-12 16:08:27","2021-08-05 13:36:56","1");
INSERT INTO categories VALUES("7","4","بشكير","uploads/images/download.jpg","0","2021-07-14 11:40:53","2021-07-14 13:01:37","0");
INSERT INTO categories VALUES("8","7","sub food","uploads/images/food.png","0","2021-07-14 11:47:19","2021-08-05 13:33:04","0");
INSERT INTO categories VALUES("9","9","قطنيات","uploads/images/pause-black.jpg","0","2021-07-14 13:11:04","2021-08-05 13:26:25","0");
INSERT INTO categories VALUES("10","3","شراريب نسائي","uploads/images/شراب نسائي.jpg","0","2021-08-05 13:21:14","0000-00-00 00:00:00","1");
INSERT INTO categories VALUES("11","3","شراريب اطفال","uploads/images/شراريب اطفال.jpeg","0","2021-08-05 13:24:36","0000-00-00 00:00:00","1");



DROP TABLE IF EXISTS customers;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `profile` varchar(225) NOT NULL DEFAULT 'images/profile.png',
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `no_sales` bigint(20) unsigned NOT NULL,
  `otp` varchar(30) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

INSERT INTO customers VALUES("1","soliman","222222","soliman@gmail.com","201093710539","uploads/customers/discount_banner.png","","","","2021","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("2","ahmed","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","ahmed@gmail.com","00000000000","images/profile.png","","al_harm","giza","al_harm-giza","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("4","ahmed1","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","ahmed1@gmail.com","00000000001","images/profile.png","","al_harm","giza","al_harm-giza","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("14","asd","03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4","asd@gmail.com","01011480488","images/profile.png","","asd city","asd region","asd location","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("17","as","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","as@gmail.com","12345123456","images/profile.png","","as city","as region","as","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("23","zx","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","zx@gmail.com","11112233445","images/profile.png","","city","region","location","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("24","op","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","OP@gmail.com","09876545678","images/profile.png","","jsjs","jsjsj","qww","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("25","cv","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","cv@gmail.com","0101010101","images/profile.png","","as city","as region","as","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("26","we","a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3","we@gmail.com","12341234123","images/profile.png","","we city","we region","we location","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("27","new","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","new@gmail.com","966561955765","uploads/customers/image_picker2078239887601558880.jpg","","new city","new region","new location ","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("28","ahmed2","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","ahmed2@gmail.com","966541955765","uploads/customers/image_picker6436885171753085923.jpg","","test","trst","hhhkkh","0","0","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("29","سامي","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","smasmagiba3061974@gmail.com","+966599948481","images/profile.png","","الندينة","المدينة","للمدينة","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("35","سامي","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","smsmagib3061974@gmail.com","+966599948781","images/profile.png","","المدينة","المدينة","المدينة","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("43","Ahmed adell","a25752762e6fa67d5f3a0b8427b37b65899f75343f65ba0c1bc2fda941c29dd3","ahmedadellelsayed1@gmail.com","01021106697","images/profile.png","","dd","g","af","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("51","gggg","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","gggg@gmai.com","01222721854","images/profile.png","","hggf","gffff","gffgg","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("57","gg","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","gg@gmail.com","55555555555","images/profile.png","","gg","gg","gg","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("60","hh","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","hh@gmail.com","55555555556","images/profile.png","","hh","hh","hh","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("66","kk","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","kk@gmail.com","55555555557","images/profile.png","","kk","kk","kk","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("68","zz","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","zz@gmail.com","55555555558","images/profile.png","","zz","zz","zz","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("73","xx","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","xx@gmail.com","55555555559","images/profile.png","","xx","xx","xx","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("77","cc","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","cc@gmail.com","55555555550","images/profile.png","","cc","cc","cc","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("81","cv","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","ccv@gmail.com","55555555551","images/profile.png","","cv","cv","cv","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("82","cv2","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","cv2@gmail.com","55555555552","images/profile.png","","as1 city","as region1","as1","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("83","bb","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","bb@gmail.com","55555555553","images/profile.png","","bb","bb","bb","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("87","bb","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","bb1@gmail.com","555555555554","images/profile.png","","bb","bb","bb","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("89","nm","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","nm@gmail.com","55555555554","images/profile.png","","nm","nm","nm","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("91","vb","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","vb@gmail.com","55555555500","images/profile.png","","vb","vb","vb","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("93","cf","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","cf@gmail.com","00000085236","images/profile.png","","cfcf","cf","cf","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("94","سييني","8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414","kfkfkdk@gmail.com","07845166451646","images/profile.png","","otiig","iorototo","kkrororororo","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("95","ahmed","a25752762e6fa67d5f3a0b8427b37b65899f75343f65ba0c1bc2fda941c29dd3","ahmedadellelsayed11@gmail.com","01021409986","images/profile.png","","yy","yy","hh","0","","1","0000-00-00 00:00:00");
INSERT INTO customers VALUES("96","sss","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","jjdjdj@gmail.com","07813482619","images/profile.png","","ddhdh","gddgh","ghdhdh","0","","1","2021-07-24 14:22:35");
INSERT INTO customers VALUES("104","نرزبز","b6197fe0d62a4e463edd2925382d4d268c4fce0859378682608efa4fda326f26","nfjfj@gmail.com","8566565629","images/profile.png","","ghdh","bdhdh","ghfhfh","0","","1","2021-07-26 13:30:48");
INSERT INTO customers VALUES("115","jkl","bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a","jkl@gmail.com","00008523697","images/profile.png","","jkl","jkl","jkl","0","","1","2021-07-26 14:19:46");
INSERT INTO customers VALUES("116","jfkfjtj","95fbeb8f769d2c0079d1d11348877da944aaefaba6ecf9f7f7dab6344ece8605","jjdjfork@gmwil.com","656295692","images/profile.png","","ffgg","fff","bdjdk","0","","1","2021-07-26 14:23:53");
INSERT INTO customers VALUES("117","ahmedadell","d989c40c64cd3f44b523f98e7a8861814445c7821016307e0764c56fcbb3e52a","ahmedadellelsayed111@gmail.com","02025578858","images/profile.png","","dd","fff","fgjfjfbd","0","","1","2021-07-26 14:24:49");
INSERT INTO customers VALUES("118","Ahmed3","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","elwffgardtyggv73our@yahoo.com","691986854","images/profile.png","","ffss","dddd","5wte","0","","1","2021-07-26 14:25:50");
INSERT INTO customers VALUES("119","mmcjcmcm","ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797","nncirjd@gmail.com","9983298949","images/profile.png","","jjdjd","jjxjdjdj","jjxjfjf","0","","1","2021-07-27 15:35:56");
INSERT INTO customers VALUES("120","jncjfn","95fbeb8f769d2c0079d1d11348877da944aaefaba6ecf9f7f7dab6344ece8605","hhhx@gmail.com","6683464676","images/profile.png","","jjdjxj","jjdjdjdj","hhxhdjd","0","","1","2021-07-27 15:44:18");
INSERT INTO customers VALUES("121","ffgh","4378c5895e7ade691792a8bbed89dbfcbea257a8949a3b1132a875e67aa45583","sdf@gmail.com","08454236","images/profile.png","","j","j","fh","0","","1","2021-07-28 15:26:17");
INSERT INTO customers VALUES("123","fg","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","yi@yh.com","005856865649","images/profile.png","","rr","tt","rt","0","","1","2021-08-01 13:51:24");
INSERT INTO customers VALUES("124","سمسم","8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414","sms@gmail.com","6862953595","images/profile.png","","dd","ss","dhd","0","","1","2021-08-01 13:56:24");
INSERT INTO customers VALUES("130","عز","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","nogur@yahoo.com","010211088536","images/profile.png","","عاا","ههه","ع","0","","1","2021-08-09 11:31:05");
INSERT INTO customers VALUES("131","احمد ابراهيم","1abbff1f242912380d02a62d709fb44e6842e26c7c2de018b3c6bf1d5232e194","ahmedibrahimmosu.@gamil.com","01115822442","images/profile.png","","القليوبيه","الخصوص","23الخصوص البنزينه","0","","1","2021-08-09 11:37:37");
INSERT INTO customers VALUES("132","سمسوم","8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92","smsom@gmail.com","0123456789","images/profile.png","","gg","gg","gg","0","","1","2021-08-09 14:09:07");



DROP TABLE IF EXISTS favourites;

CREATE TABLE `favourites` (
  `id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `is_favourite` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no|1=yes',
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customer_id_fk2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS languages;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(225) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO languages VALUES("1","en","english","languages/en.json","1");
INSERT INTO languages VALUES("2","ar","العربية","languages/ar.json","1");



DROP TABLE IF EXISTS order_details;

CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `color` varchar(225) NOT NULL,
  `size` varchar(225) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) unsigned NOT NULL,
  `total` double NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `order_id_fk` (`product_id`),
  CONSTRAINT `order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

INSERT INTO order_details VALUES("1","1","28","16","#804000","m","6","2","12","2021-07-13 13:03:23");
INSERT INTO order_details VALUES("2","1","28","15"," #9d9d9d"," s","16","3","48","2021-07-13 13:03:23");
INSERT INTO order_details VALUES("3","2","28","16","#000000","s","6","1","6","2021-07-13 13:14:35");
INSERT INTO order_details VALUES("4","3","28","16","#000000","s","6","1","6","2021-07-13 13:16:33");
INSERT INTO order_details VALUES("5","3","28","14"," #3f3f3f"," m","10","2","20","2021-07-13 13:16:33");
INSERT INTO order_details VALUES("6","3","28","13"," #0000ff"," m","22","3","66","2021-07-13 13:16:33");
INSERT INTO order_details VALUES("7","3","28","11"," #ebebeb"," l","10","2","20","2021-07-13 13:16:33");
INSERT INTO order_details VALUES("8","3","28","8"," #000000"," m","300","2","600","2021-07-13 13:16:33");
INSERT INTO order_details VALUES("9","4","28","16","#000000","m","6","2","12","2021-07-13 13:18:58");
INSERT INTO order_details VALUES("10","4","28","15"," #800040"," s","16","3","48","2021-07-13 13:18:58");
INSERT INTO order_details VALUES("11","4","28","13"," #0000ff"," m","22","4","88","2021-07-13 13:18:58");
INSERT INTO order_details VALUES("12","5","28","15","#800040","s","16","2","32","2021-07-13 13:25:34");
INSERT INTO order_details VALUES("13","6","94","11","#004080","m","10","3","30","2021-07-13 16:30:09");
INSERT INTO order_details VALUES("14","6","94","8"," #000000"," m","300","2","600","2021-07-13 16:30:09");
INSERT INTO order_details VALUES("15","7","94","11","#004080","m","10","1","10","2021-07-13 20:54:01");
INSERT INTO order_details VALUES("16","8","94","15","#800040","s","16","2","32","2021-07-13 20:55:12");
INSERT INTO order_details VALUES("17","8","94","8"," #ffffff"," m","300","2","600","2021-07-13 20:55:12");
INSERT INTO order_details VALUES("18","9","94","14","#3f3f3f","m","10","1","10","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("19","9","94","8"," #ffffff"," l","300","2","600","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("20","9","94","9"," #545fe7"," xl","400","2","800","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("21","9","94","14"," #3f3f3f"," m","10","1","10","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("22","9","94","8"," #ffffff"," l","300","2","600","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("23","9","94","9"," #545fe7"," xl","400","2","800","2021-07-13 20:59:23");
INSERT INTO order_details VALUES("24","10","94","18","#ea7237","l","10","2","20","2021-07-13 21:01:58");
INSERT INTO order_details VALUES("25","11","94","20","#af8a04","m","12","2","24","2021-07-14 12:52:09");
INSERT INTO order_details VALUES("27","13","28","21","#cd0404","m","15","1","15","2021-07-15 12:06:52");
INSERT INTO order_details VALUES("28","14","95","18","#4ed32c","m","10","2","20","2021-07-15 14:35:07");
INSERT INTO order_details VALUES("29","15","91","19","#bcdf42","s","20","3","60","2021-07-16 19:06:11");
INSERT INTO order_details VALUES("30","16","95","16","#000000","s","6","1","6","2021-07-17 17:20:53");
INSERT INTO order_details VALUES("31","17","95","19","#bcdf42","s","20","1","20","2021-07-19 19:10:01");
INSERT INTO order_details VALUES("32","18","94","8","#000000","l","300","2","600","2021-07-19 21:44:41");
INSERT INTO order_details VALUES("33","19","91","19","#bcdf42","m","20","2","40","2021-07-22 12:52:29");
INSERT INTO order_details VALUES("34","20","96","18","#4ed32c","m","10","1","10","2021-07-24 14:24:08");
INSERT INTO order_details VALUES("35","20","96","18"," #ea7237"," m","10","1","10","2021-07-24 14:24:08");
INSERT INTO order_details VALUES("36","20","96","18"," #4ed32c"," l","10","3","30","2021-07-24 14:24:08");
INSERT INTO order_details VALUES("37","21","96","9","#545fe7","l","400","1","400","2021-07-24 14:25:52");
INSERT INTO order_details VALUES("38","21","96","16"," #000000"," m","6","1","6","2021-07-24 14:25:52");
INSERT INTO order_details VALUES("39","22","28","21","#5e4f03","s","15","1","15","2021-07-24 15:26:05");
INSERT INTO order_details VALUES("40","23","28","21","#c2a905","m","15","2","30","2021-07-24 15:28:18");
INSERT INTO order_details VALUES("41","24","96","19","#bcdf42","m","20","2","40","2021-07-24 17:17:29");
INSERT INTO order_details VALUES("42","24","96","19"," #000000"," m","20","2","40","2021-07-24 17:17:29");
INSERT INTO order_details VALUES("43","25","91","11","#004080","m","10","8","80","2021-07-25 08:28:39");
INSERT INTO order_details VALUES("44","25","91","9"," #545fe7"," xl","400","3","1200","2021-07-25 08:28:39");
INSERT INTO order_details VALUES("45","25","91","19"," #bcdf42"," m","20","4","80","2021-07-25 08:28:39");
INSERT INTO order_details VALUES("46","26","91","19","#bcdf42","m","20","5","100","2021-07-25 08:29:54");
INSERT INTO order_details VALUES("47","27","91","8","#000000","m","300","2","600","2021-07-25 08:31:34");
INSERT INTO order_details VALUES("48","27","91","22"," #000000"," s","22","4","88","2021-07-25 08:31:34");
INSERT INTO order_details VALUES("49","28","91","9","#545fe7","2xl","400","1","400","2021-07-25 08:36:03");
INSERT INTO order_details VALUES("50","28","91","11"," #004080"," m","10","4","40","2021-07-25 08:36:03");
INSERT INTO order_details VALUES("51","29","91","16","#804000","m","6","4","24","2021-07-25 08:39:35");
INSERT INTO order_details VALUES("52","29","91","9"," #545fe7"," xl","400","4","1600","2021-07-25 08:39:35");
INSERT INTO order_details VALUES("53","30","91","22","#000000","m","22","5","110","2021-07-25 08:56:12");
INSERT INTO order_details VALUES("54","30","91","18"," #4ed32c"," s","10","4","40","2021-07-25 08:56:12");
INSERT INTO order_details VALUES("55","31","91","22","#000000","m","22","4","88","2021-07-25 08:57:36");
INSERT INTO order_details VALUES("56","32","91","19","#bcdf42","l","20","4","80","2021-07-25 08:58:26");
INSERT INTO order_details VALUES("57","33","91","11","#004080","m","10","4","40","2021-07-25 09:18:37");
INSERT INTO order_details VALUES("58","34","91","11","#004080","m","10","3","30","2021-07-25 09:25:57");
INSERT INTO order_details VALUES("59","35","91","19","#000000","s","20","4","80","2021-07-25 10:28:43");
INSERT INTO order_details VALUES("60","36","91","18","#ea7237","m","10","3","30","2021-07-25 10:30:23");
INSERT INTO order_details VALUES("61","37","91","16","#804000","s","6","4","24","2021-07-25 11:00:52");
INSERT INTO order_details VALUES("62","38","91","21","#cd0404","m","15","5","75","2021-07-25 11:03:56");
INSERT INTO order_details VALUES("63","39","91","20","#af8a04","s","12","3","36","2021-07-25 11:08:41");
INSERT INTO order_details VALUES("64","40","91","16","#804000","s","6","2","12","2021-07-25 11:49:19");
INSERT INTO order_details VALUES("65","40","91","9"," #c0f01e"," l","400","1","400","2021-07-25 11:49:19");
INSERT INTO order_details VALUES("66","41","28","21","#5e4f03","s","15","2","30","2021-07-25 11:57:45");
INSERT INTO order_details VALUES("67","41","28","21"," #cd0404"," l","15","1","15","2021-07-25 11:57:45");
INSERT INTO order_details VALUES("68","41","28","21"," #c2a905"," m","15","1","15","2021-07-25 11:57:45");
INSERT INTO order_details VALUES("69","42","28","20","#af8a04","s","12","1","12","2021-07-25 12:08:57");
INSERT INTO order_details VALUES("70","43","28","20","#17721a","m","12","1","12","2021-07-25 12:10:16");
INSERT INTO order_details VALUES("71","44","28","22","#000000","s","22","1","22","2021-07-25 12:11:33");
INSERT INTO order_details VALUES("72","45","28","20","#17721a","m","12","1","12","2021-07-25 12:13:40");
INSERT INTO order_details VALUES("73","45","28","20"," #17721a"," m","12","1","12","2021-07-25 12:13:40");
INSERT INTO order_details VALUES("74","45","28","20"," #17721a"," m","12","1","12","2021-07-25 12:13:40");
INSERT INTO order_details VALUES("75","46","28","20","#af8a04","s","12","1","12","2021-07-25 12:22:48");
INSERT INTO order_details VALUES("76","47","28","18","#4ed32c","s","10","1","10","2021-07-25 12:27:28");
INSERT INTO order_details VALUES("77","48","28","8","#ffffff","m","300","1","300","2021-07-25 12:29:10");
INSERT INTO order_details VALUES("78","49","91","16","#804000","s","6","4","24","2021-07-25 13:18:29");
INSERT INTO order_details VALUES("79","50","91","19","#bcdf42","s","20","4","80","2021-07-25 13:20:41");
INSERT INTO order_details VALUES("80","51","91","19","#bcdf42","m","20","4","80","2021-07-25 13:26:57");
INSERT INTO order_details VALUES("81","52","91","15","#800040","s","16","4","64","2021-07-25 13:31:09");
INSERT INTO order_details VALUES("82","53","91","9","#0000a0","xl","400","4","1600","2021-07-25 13:32:33");
INSERT INTO order_details VALUES("83","54","91","21","#cd0404","m","15","4","60","2021-07-25 13:36:28");
INSERT INTO order_details VALUES("84","55","91","18","#4ed32c","m","10","3","30","2021-07-25 13:41:14");
INSERT INTO order_details VALUES("85","56","91","19","#bcdf42","s","20","5","100","2021-07-25 15:01:57");
INSERT INTO order_details VALUES("86","57","91","16","#804000","s","6","4","24","2021-07-25 22:31:09");
INSERT INTO order_details VALUES("88","59","91","19","#bcdf42","s","20","4","80","2021-07-26 14:56:28");
INSERT INTO order_details VALUES("89","60","121","22","#000000","s","22","1","22","2021-07-29 09:59:53");
INSERT INTO order_details VALUES("90","61","121","20","#af8a04","m","12","1","12","2021-07-29 13:23:49");
INSERT INTO order_details VALUES("91","62","91","16","#804000","s","6","1","6","2021-07-30 11:38:12");
INSERT INTO order_details VALUES("92","63","28","11","#004080","m","4","1","4","2021-08-01 13:12:53");
INSERT INTO order_details VALUES("93","64","124","16","#804000","s","3","2","6","2021-08-01 13:57:34");
INSERT INTO order_details VALUES("94","64","124","22"," #000000"," m","22","1","22","2021-08-01 13:57:34");
INSERT INTO order_details VALUES("97","67","91","11","#004080","m","10","4","40","2021-08-05 12:10:57");
INSERT INTO order_details VALUES("98","68","91","21","#cd0404","s","15","4","60","2021-08-05 12:13:39");
INSERT INTO order_details VALUES("99","69","130","19","#bcdf42","m","10","2","20","2021-08-09 11:31:33");
INSERT INTO order_details VALUES("100","70","28","21","#cd0404","s","15","1","15","2021-08-09 11:35:26");
INSERT INTO order_details VALUES("101","71","28","21","#c2a905","s","15","1","15","2021-08-09 11:44:54");
INSERT INTO order_details VALUES("102","72","28","22","#000000","s","22","1","22","2021-08-09 12:16:29");
INSERT INTO order_details VALUES("103","73","28","21","#5e4f03","m","15","1","15","2021-08-09 12:17:18");
INSERT INTO order_details VALUES("104","74","28","20","#17721a","m","12","1","12","2021-08-09 12:18:29");
INSERT INTO order_details VALUES("105","75","28","21","#5e4f03","s","15","2","30","2021-08-09 12:35:00");
INSERT INTO order_details VALUES("106","76","28","18","#4ed32c","m","10","1","10","2021-08-09 12:57:54");
INSERT INTO order_details VALUES("107","77","132","22","#000000","s","22","1","22","2021-08-09 14:11:17");
INSERT INTO order_details VALUES("108","77","132","21"," #5e4f03"," m","15","2","30","2021-08-09 14:11:17");
INSERT INTO order_details VALUES("109","78","132","19","#bcdf42","s","10","1","10","2021-08-09 21:05:48");
INSERT INTO order_details VALUES("110","78","132","19"," #bcdf42"," m","10","1","10","2021-08-09 21:05:48");
INSERT INTO order_details VALUES("111","79","28","8","#ffffff","xl","250","3","750","2021-08-19 10:52:40");
INSERT INTO order_details VALUES("112","79","28","8"," #000000"," s","250","2","500","2021-08-19 10:52:40");
INSERT INTO order_details VALUES("113","79","28","20"," #af8a04"," s","12","2","24","2021-08-19 10:52:40");
INSERT INTO order_details VALUES("114","80","28","21","#5e4f03","s","15","3","45","2021-08-19 11:36:06");
INSERT INTO order_details VALUES("115","80","28","21"," #c2a905"," m","15","4","60","2021-08-19 11:36:06");
INSERT INTO order_details VALUES("116","80","28","21"," #5e4f03"," m","15","2","30","2021-08-19 11:36:06");
INSERT INTO order_details VALUES("117","80","28","21"," #cd0404"," l","15","2","30","2021-08-19 11:36:06");



DROP TABLE IF EXISTS orders;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `order_status` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT '0=pending|1=waiting|2=cancelled|3=shipped|4=completed|5=returned',
  `payment_method` varchar(225) NOT NULL,
  `shipping_location` text NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unpaid|1=paid',
  `total` float(10,0) NOT NULL,
  `notes` text NOT NULL,
  `details` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

INSERT INTO orders VALUES("1","28","0","cashOnDelivery","test ","0","66","","","2021-07-13 13:03:23");
INSERT INTO orders VALUES("2","28","5","cashOnDelivery","test ","1","12","","","2021-07-13 13:14:35");
INSERT INTO orders VALUES("3","28","5","cashOnDelivery","test ","1","718","","","2021-07-13 13:16:33");
INSERT INTO orders VALUES("4","28","5","card","test ","1","154","","","2021-07-13 13:18:58");
INSERT INTO orders VALUES("5","28","5","cashOnDelivery","test ","1","38","","","2021-07-13 13:25:34");
INSERT INTO orders VALUES("6","94","0","cashOnDelivery","kkrororororo","0","636","","","2021-07-13 16:30:09");
INSERT INTO orders VALUES("7","94","0","cashOnDelivery","kkrororororo","0","16","","","2021-07-13 20:54:01");
INSERT INTO orders VALUES("8","94","0","cashOnDelivery","kkrororororo","0","638","جيدة","","2021-07-13 20:55:12");
INSERT INTO orders VALUES("9","94","3","cashOnDelivery","kkrororororo","0","1416","جيدة","","2021-07-13 20:59:23");
INSERT INTO orders VALUES("10","94","5","cashOnDelivery","kkrororororo","1","26","","","2021-07-13 21:01:58");
INSERT INTO orders VALUES("11","94","5","cashOnDelivery","kkrororororo","1","30","","","2021-07-14 12:52:09");
INSERT INTO orders VALUES("13","28","0","card","location ","1","21","","","2021-07-15 12:06:52");
INSERT INTO orders VALUES("14","95","0","cashOnDelivery","hh","0","26","","","2021-07-15 14:35:07");
INSERT INTO orders VALUES("15","91","0","card","vb","1","66","","","2021-07-16 19:06:11");
INSERT INTO orders VALUES("16","95","0","cashOnDelivery","hh","0","12","","","2021-07-17 17:20:53");
INSERT INTO orders VALUES("17","95","0","cashOnDelivery","hh","0","26","","","2021-07-19 19:10:01");
INSERT INTO orders VALUES("18","94","0","cashOnDelivery","kkrororororo","0","606","","","2021-07-19 21:44:41");
INSERT INTO orders VALUES("19","91","0","card","vb","1","46","","","2021-07-22 12:52:29");
INSERT INTO orders VALUES("20","96","0","cashOnDelivery","ghdhdh","0","56","","","2021-07-24 14:24:08");
INSERT INTO orders VALUES("21","96","0","card","ghdhdh","0","412","ممتاز","","2021-07-24 14:25:52");
INSERT INTO orders VALUES("22","28","0","cashOnDelivery","location ","0","21","","","2021-07-24 15:26:05");
INSERT INTO orders VALUES("23","28","0","cashOnDelivery","location ","0","36","","","2021-07-24 15:28:18");
INSERT INTO orders VALUES("24","96","0","cashOnDelivery","ghdhdh","0","86","","","2021-07-24 17:17:29");
INSERT INTO orders VALUES("25","91","0","cashOnDelivery","vb","0","1366","","","2021-07-25 08:28:39");
INSERT INTO orders VALUES("26","91","0","cashOnDelivery","vb","0","106","","","2021-07-25 08:29:54");
INSERT INTO orders VALUES("27","91","0","cashOnDelivery","vb","0","694","","","2021-07-25 08:31:34");
INSERT INTO orders VALUES("28","91","0","cashOnDelivery","vb","0","446","","","2021-07-25 08:36:03");
INSERT INTO orders VALUES("29","91","0","cashOnDelivery","vb","0","1630","","","2021-07-25 08:39:35");
INSERT INTO orders VALUES("30","91","0","cashOnDelivery","vb","0","156","","","2021-07-25 08:56:12");
INSERT INTO orders VALUES("31","91","0","card","vb","1","94","","","2021-07-25 08:57:36");
INSERT INTO orders VALUES("32","91","0","card","vb","1","86","","","2021-07-25 08:58:26");
INSERT INTO orders VALUES("33","91","0","card","vb","1","46","","","2021-07-25 09:18:37");
INSERT INTO orders VALUES("34","91","0","cashOnDelivery","vb","0","36","","","2021-07-25 09:25:57");
INSERT INTO orders VALUES("35","91","0","cashOnDelivery","vb","0","86","","","2021-07-25 10:28:43");
INSERT INTO orders VALUES("36","91","0","cashOnDelivery","vb","0","36","","","2021-07-25 10:30:23");
INSERT INTO orders VALUES("37","91","0","cashOnDelivery","vb","0","30","","","2021-07-25 11:00:52");
INSERT INTO orders VALUES("38","91","0","cashOnDelivery","vb","0","81","","","2021-07-25 11:03:56");
INSERT INTO orders VALUES("39","91","0","cashOnDelivery","vb","0","42","","","2021-07-25 11:08:41");
INSERT INTO orders VALUES("40","91","0","cashOnDelivery","vb","0","418","","","2021-07-25 11:49:19");
INSERT INTO orders VALUES("41","28","0","cashOnDelivery","location ","0","66","","","2021-07-25 11:57:45");
INSERT INTO orders VALUES("42","28","0","cashOnDelivery","location ","0","18","","","2021-07-25 12:08:57");
INSERT INTO orders VALUES("43","28","0","cashOnDelivery","location ","0","18","","","2021-07-25 12:10:16");
INSERT INTO orders VALUES("44","28","0","cashOnDelivery","location ","0","28","","","2021-07-25 12:11:33");
INSERT INTO orders VALUES("45","28","0","cashOnDelivery","location ","0","18","","","2021-07-25 12:13:40");
INSERT INTO orders VALUES("46","28","0","cashOnDelivery","location ","0","18","","","2021-07-25 12:22:48");
INSERT INTO orders VALUES("47","28","0","card","location ","1","16","","","2021-07-25 12:27:28");
INSERT INTO orders VALUES("48","28","0","card","location ","1","306","","","2021-07-25 12:29:10");
INSERT INTO orders VALUES("49","91","0","cashOnDelivery","vb","0","30","","","2021-07-25 13:18:29");
INSERT INTO orders VALUES("50","91","0","card","vb","1","86","","","2021-07-25 13:20:41");
INSERT INTO orders VALUES("51","91","0","cashOnDelivery","vb","0","86","","","2021-07-25 13:26:57");
INSERT INTO orders VALUES("52","91","0","cashOnDelivery","vb","0","70","","","2021-07-25 13:31:09");
INSERT INTO orders VALUES("53","91","0","cashOnDelivery","vb","0","1606","","","2021-07-25 13:32:33");
INSERT INTO orders VALUES("54","91","0","cashOnDelivery","vb","0","66","","","2021-07-25 13:36:28");
INSERT INTO orders VALUES("55","91","0","card","vb","1","36","","","2021-07-25 13:41:14");
INSERT INTO orders VALUES("56","91","0","card","vb","1","106","","","2021-07-25 15:01:57");
INSERT INTO orders VALUES("57","91","0","cashOnDelivery","vb","0","30","","","2021-07-25 22:31:09");
INSERT INTO orders VALUES("59","91","5","cashOnDelivery","vb","1","86","","","2021-07-26 14:56:28");
INSERT INTO orders VALUES("60","121","0","cashOnDelivery","fh","0","28","تمام","","2021-07-29 09:59:53");
INSERT INTO orders VALUES("61","121","0","cashOnDelivery","fh","0","18","","","2021-07-29 13:23:49");
INSERT INTO orders VALUES("62","91","5","cashOnDelivery","vb","1","12","","","2021-07-30 11:38:12");
INSERT INTO orders VALUES("63","28","5","cashOnDelivery","location ","1","10","","","2021-08-01 13:12:52");
INSERT INTO orders VALUES("64","124","5","cashOnDelivery","dhd","1","34","","","2021-08-01 13:57:34");
INSERT INTO orders VALUES("67","91","5","card","vb","1","46","","","2021-08-05 12:10:57");
INSERT INTO orders VALUES("68","91","5","card","vb","1","66","","","2021-08-05 12:13:39");
INSERT INTO orders VALUES("69","130","0","cashOnDelivery","ع","0","26","","","2021-08-09 11:31:33");
INSERT INTO orders VALUES("70","28","0","cashOnDelivery","location ","0","21","","","2021-08-09 11:35:26");
INSERT INTO orders VALUES("71","28","0","cashOnDelivery","location ","0","21","","","2021-08-09 11:44:54");
INSERT INTO orders VALUES("72","28","0","cashOnDelivery","location ","0","28","","","2021-08-09 12:16:29");
INSERT INTO orders VALUES("73","28","0","cashOnDelivery","location ","0","21","","","2021-08-09 12:17:18");
INSERT INTO orders VALUES("74","28","0","cashOnDelivery","location ","0","18","","","2021-08-09 12:18:29");
INSERT INTO orders VALUES("75","28","0","cashOnDelivery","location ","0","36","","","2021-08-09 12:35:00");
INSERT INTO orders VALUES("76","28","0","cashOnDelivery","location ","0","16","","","2021-08-09 12:57:54");
INSERT INTO orders VALUES("77","132","0","cashOnDelivery","gg","0","58","","","2021-08-09 14:11:17");
INSERT INTO orders VALUES("78","132","0","cashOnDelivery","gg","0","26","","","2021-08-09 21:05:48");
INSERT INTO orders VALUES("79","28","0","cashOnDelivery","location ","0","1280","","","2021-08-19 10:52:40");
INSERT INTO orders VALUES("80","28","0","cashOnDelivery","location ","0","171","","","2021-08-19 11:36:06");



DROP TABLE IF EXISTS payments;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `transaction_id` varchar(225) NOT NULL,
  `card_number` varchar(225) NOT NULL,
  `card_type` varchar(100) NOT NULL,
  `payment_status` varchar(225) NOT NULL,
  `total` double NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO payments VALUES("1","1","28","ahmed2","txn_1JCRrbHON3VTGwrUaBAPsvmW","4242424242424242","visa","succeeded","16","2021-07-12 10:56:59");
INSERT INTO payments VALUES("2","2","28","ahmed2","txn_1JCRwMHON3VTGwrULwkw66vj","4242424242424242","visa","succeeded","26","2021-07-12 10:57:07");
INSERT INTO payments VALUES("3","5","91","vb","txn_1JCippHON3VTGwrU1GRLVJu7","4242424242424242","visa","succeeded","38","2021-07-13 12:31:23");
INSERT INTO payments VALUES("4","4","28","ahmed2","txn_1JClVoHON3VTGwrUZl2LQESR","4242424242424242","visa","succeeded","154","2021-07-13 13:18:58");
INSERT INTO payments VALUES("5","5","28","ahmed2","N/A","N/A","N/A","succeeded","38","2021-07-13 13:51:05");
INSERT INTO payments VALUES("6","2","28","ahmed2","N/A","N/A","N/A","succeeded","12","2021-07-13 13:54:11");
INSERT INTO payments VALUES("7","3","28","ahmed2","N/A","N/A","N/A","succeeded","718","2021-07-13 14:09:49");
INSERT INTO payments VALUES("8","4","28","ahmed2","N/A","N/A","N/A","succeeded","154","2021-07-13 21:46:07");
INSERT INTO payments VALUES("9","11","94","سييني","N/A","N/A","N/A","succeeded","30","2021-07-14 12:53:28");
INSERT INTO payments VALUES("10","10","94","سييني","N/A","N/A","N/A","succeeded","26","2021-07-14 12:53:53");
INSERT INTO payments VALUES("11","13","28","ahmed2","txn_1JDTL7HON3VTGwrUfAcWcFPK","4242424242424242","visa","succeeded","21","2021-07-15 12:06:52");
INSERT INTO payments VALUES("12","15","91","vb","txn_1JDwMTHON3VTGwrUC9tWuehw","4242424242424242","visa","succeeded","66","2021-07-16 19:06:11");
INSERT INTO payments VALUES("13","19","91","vb","txn_1JG1O7HON3VTGwrUm5675179","4242424242424242","visa","succeeded","46","2021-07-22 12:52:29");
INSERT INTO payments VALUES("14","31","91","vb","txn_1JH39RHON3VTGwrUjl2gKqFf","4242424242424242","visa","succeeded","94","2021-07-25 08:57:36");
INSERT INTO payments VALUES("15","32","91","vb","txn_1JH3AFHON3VTGwrUIEwxOBGq","4242424242424242","visa","succeeded","86","2021-07-25 08:58:26");
INSERT INTO payments VALUES("16","33","91","vb","txn_1JH3TnHON3VTGwrUuRBqwWg9","4242424242424242","visa","succeeded","46","2021-07-25 09:18:37");
INSERT INTO payments VALUES("17","47","28","ahmed2","txn_1JH6QYHON3VTGwrUXYqHIg8H","4242424242424242","visa","succeeded","16","2021-07-25 12:27:28");
INSERT INTO payments VALUES("18","48","28","ahmed2","txn_1JH6SCHON3VTGwrUBw39Q7En","4242424242424242","visa","succeeded","306","2021-07-25 12:29:10");
INSERT INTO payments VALUES("19","50","91","vb","txn_1JH7G3HON3VTGwrUJBY42wZt","4242424242424242","visa","succeeded","86","2021-07-25 13:20:41");
INSERT INTO payments VALUES("20","55","91","vb","txn_1JH7ZwHON3VTGwrUhGiEU9hP","4242424242424242","visa","succeeded","36","2021-07-25 13:41:14");
INSERT INTO payments VALUES("21","56","91","vb","txn_1JH8q3HON3VTGwrUE7NbKzRM","4242424242424242","visa","succeeded","106","2021-07-25 15:01:57");
INSERT INTO payments VALUES("22","59","91","vb","N/A","N/A","N/A","succeeded","86","2021-07-28 12:17:28");
INSERT INTO payments VALUES("23","64","124","سمسم","N/A","N/A","N/A","succeeded","34","2021-08-02 16:07:28");
INSERT INTO payments VALUES("24","63","28","ahmed2","N/A","N/A","N/A","succeeded","10","2021-08-02 16:07:38");
INSERT INTO payments VALUES("25","67","91","vb","txn_3JL5PaHON3VTGwrU1BA7tKei","************4242","visa","succeeded","46","2021-08-05 12:10:57");
INSERT INTO payments VALUES("26","68","91","vb","txn_3JL5SCHON3VTGwrU0TKOoW9S","************4444","mastercard","succeeded","66","2021-08-05 12:13:39");
INSERT INTO payments VALUES("27","67","91","vb","N/A","N/A","N/A","succeeded","46","2021-08-06 16:55:19");
INSERT INTO payments VALUES("28","62","91","vb","N/A","N/A","N/A","succeeded","12","2021-08-06 17:33:33");



DROP TABLE IF EXISTS product_ratings;

CREATE TABLE `product_ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `total_users_rated` bigint(20) unsigned NOT NULL,
  `total_ratings` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_id_fk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO product_ratings VALUES("5","8","52","107");
INSERT INTO product_ratings VALUES("6","9","3","5");
INSERT INTO product_ratings VALUES("7","11","5","19");
INSERT INTO product_ratings VALUES("8","18","2","8");
INSERT INTO product_ratings VALUES("9","21","5","17");
INSERT INTO product_ratings VALUES("10","19","1","5");
INSERT INTO product_ratings VALUES("11","22","2","8");
INSERT INTO product_ratings VALUES("12","16","3","11");
INSERT INTO product_ratings VALUES("13","15","1","5");



DROP TABLE IF EXISTS product_reviews;

CREATE TABLE `product_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customer_id_fk3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_id_fk4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO product_reviews VALUES("1","8","28","good","2021-07-13 14:53:02");
INSERT INTO product_reviews VALUES("2","11","94","منتجات جديده","2021-07-13 21:02:57");
INSERT INTO product_reviews VALUES("3","21","28","good test","2021-07-14 14:59:15");
INSERT INTO product_reviews VALUES("4","21","28","good test2","2021-07-14 15:04:20");
INSERT INTO product_reviews VALUES("5","11","91","هذا المنتج جيد","2021-07-17 22:37:31");
INSERT INTO product_reviews VALUES("6","8","91","تجربة تقييم","2021-07-22 16:09:26");
INSERT INTO product_reviews VALUES("7","15","91","منتج جيد جدا","2021-07-22 21:11:16");



DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(225) NOT NULL,
  `product_description` longtext NOT NULL,
  `product_image` varchar(225) NOT NULL DEFAULT 'images/blank.gif',
  `category_id` bigint(20) unsigned NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `sale` decimal(10,0) NOT NULL,
  `size` varchar(225) NOT NULL,
  `color` varchar(225) NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  `no_sales` bigint(20) unsigned NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1=active|0=deactive',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO products VALUES("8","شراب رجالى","<p>شراب رجالى بلونين ابيض واسود</p>\n","uploads/products/6287011530021-550x550.jpg","3","300","250","s,m,l,xl,2xl","#000000,#ffffff","22","0","0","2021-07-12 15:46:20","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("9","شراب حريمي","<p>شراب حريمي بالوانه</p>\n","uploads/products/women-s-lycra-ankle-socks-p3i-w-2-1592840447532-3.jpeg","3","400","0","l,xl,2xl","#545fe7,#c0f01e,#0000a0","22","0","0","2021-07-12 15:47:41","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("11","مناشف22","<p>نتلشف</p>\n","uploads/products/best-towels-the-best-bathroom-beach-and-gym-towels-from-under-8-3.png","4","10","4","m,l","#004080,#ebebeb","10","0","0","2021-07-12 15:57:25","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("15","شراب رجالى 5","","uploads/products/620154174822446.jpg","3","16","5","s","#9d9d9d,#800040","33","0","0","2021-07-12 16:14:58","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("16","شراب حريمى","","uploads/products/3BxAiALKioHoXQsgoISP14NvpQW4xns0DPSZlW07.jpg","3","6","3","s,m","#000000,#804000","11","0","0","2021-07-12 16:06:54","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("18","شراب رجالى مقاس 1","<p>production</p>\n","uploads/products/9816713045c769f2e3df04e5a0dd14af_680x.png","5","10","0","s,m,l","#4ed32c,#ea7237","22","0","0","2021-07-13 14:50:40","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("19","szdadsasa","<p>saSasASasAS</p>\n","uploads/products/t-shirt-yellow.png","8","20","10","s,m,l","#bcdf42,#000000","2","0","0","2021-07-14 12:08:25","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("20","مناشف قطنية خالصة الوان","<p>مناشف قطنية احجام مختلفة</p>\n","uploads/products/Q5.jpg","4","12","0","s,m,l,xl,2xl,3xl,4xl","#af8a04,#17721a","100","0","0","2021-07-14 13:00:41","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("21","مناشف قطنية خالصة الوان","","uploads/products/Q4.jpg","4","15","0","s,m,l","#5e4f03,#c2a905,#cd0404,#057a73","100","0","0","2021-07-14 13:00:13","0000-00-00 00:00:00","1");
INSERT INTO products VALUES("22","قميص اسود","<p>تجربة</p>\n","uploads/products/pause-black.jpg","9","22","0","s,m,l","#000000,#000000","11","0","0","2021-07-14 13:11:52","0000-00-00 00:00:00","1");



DROP TABLE IF EXISTS products_images;

CREATE TABLE `products_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `path` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO products_images VALUES("3","8","uploads/products/6287011530021-550x550.jpg,uploads/products/6287011530021-550x550.jpg");
INSERT INTO products_images VALUES("5","18","uploads/products/06a40b0b04e2fd47bfd68b3a4e906e74cb3b451a.jpg,uploads/products/620154174822446.jpg,uploads/products/item_XL_131803839_d7e5f2e9e6b51.jpg");
INSERT INTO products_images VALUES("6","19","uploads/products/pause-black-casual.jpg,uploads/products/pause-grey.jpg,uploads/products/t-shirt-yellow.png");
INSERT INTO products_images VALUES("7","20","uploads/products/Q2.jpg,uploads/products/Q3.jpg");
INSERT INTO products_images VALUES("8","22","uploads/products/pause-grey.jpg");



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(225) NOT NULL,
  `site_logo` varchar(225) NOT NULL,
  `site_icon` varchar(225) NOT NULL,
  `site_keywords` text NOT NULL,
  `site_description` text NOT NULL,
  `site_language` varchar(50) NOT NULL,
  `facebook` varchar(225) DEFAULT NULL,
  `twitter` varchar(225) DEFAULT NULL,
  `instagram` varchar(225) DEFAULT NULL,
  `youtube` varchar(225) DEFAULT NULL,
  `google_analytics` varchar(225) DEFAULT NULL,
  `app_android_link` varchar(225) NOT NULL,
  `app_ios_link` varchar(225) NOT NULL,
  `timezone` varchar(225) NOT NULL,
  `shipping_amount` double NOT NULL,
  `currency` varchar(10) NOT NULL,
  `stripe_publish_key` varchar(255) NOT NULL,
  `stripe_secret_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO settings VALUES("1","qatan","uploads/images/3rood.png","uploads/images/botble.png","website keywords here.","website description here.","ar","","","","","UA-01200000000-0","https://play.google.com/store/apps/details?id=com.offers.sa","https://apps.apple.com/us/app/apple-store/id375380948","Asia/Riyadh","6","SAR","","");



DROP TABLE IF EXISTS sms;

CREATE TABLE `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(225) NOT NULL,
  `test_token` text NOT NULL,
  `live_token` text NOT NULL,
  `is_live` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS statics;

CREATE TABLE `statics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_products` bigint(20) unsigned NOT NULL,
  `no_orders` bigint(20) unsigned NOT NULL,
  `no_customers` bigint(20) unsigned NOT NULL,
  `sales` double unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO statics VALUES("1","0","0","0","0");



