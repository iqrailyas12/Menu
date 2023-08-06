

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(50) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(50) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO categories VALUES("7","burgers","2023-07-28 15:33:25","","2023-07-28 12:54:18","iqra12","","");
INSERT INTO categories VALUES("8","fries","2023-07-28 15:33:25","","","","2023-07-28 12:54:04","iqra12");
INSERT INTO categories VALUES("10","combo","2023-07-28 15:33:25","","2023-07-28 15:53:02","","2023-07-28 12:53:47","iqra12");
INSERT INTO categories VALUES("11","wings","2023-07-28 15:54:30","iqra12","","","","");
INSERT INTO categories VALUES("12","chips","2023-07-31 22:13:04","iqra12","","","","");
INSERT INTO categories VALUES("13","meals12","2023-07-31 23:36:54","iqra12","2023-07-31 23:37:00","iqra12","2023-07-31 23:37:01","iqra12");



CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(50) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO customers VALUES("1","iqraA","ilyas","543546565","2023-07-28 17:07:19","2023-07-31 23:45:01","iqra12","","");
INSERT INTO customers VALUES("2","nimra","sheikh","32434","2023-07-28 17:07:19","","","2023-07-28 17:16:55","iqra12");



CREATE TABLE `deal_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(20) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(20) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deal_id` (`deal_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `deal_details_ibfk_1` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`),
  CONSTRAINT `deal_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;

INSERT INTO deal_details VALUES("62","12","15","1","1222","1222","2023-07-29 17:25:09"," iqra12","2023-07-29 17:49:35","iqra12","2023-07-29 18:07:05","iqra12");
INSERT INTO deal_details VALUES("63","12","15","3","1222","3666","2023-07-29 18:08:39"," iqra12","2023-07-29 22:17:38","iqra12","2023-07-31 12:44:21","iqra12");
INSERT INTO deal_details VALUES("64","16","15","1","22","22","2023-07-31 22:13:25"," iqra12","","","","");
INSERT INTO deal_details VALUES("65","17","15","1","1200","1200","2023-07-31 22:13:25"," iqra12","","","2023-07-31 22:13:31","iqra12");
INSERT INTO deal_details VALUES("66","16","23","9","22","198","2023-07-31 23:43:13"," iqra12","2023-07-31 23:43:54","iqra12","","");
INSERT INTO deal_details VALUES("67","23","23","1","1200","1200","2023-07-31 23:43:13"," iqra12","2023-07-31 23:43:54","iqra12","","");
INSERT INTO deal_details VALUES("68","17","23","4","1200","4800","2023-07-31 23:43:13"," iqra12","","","2023-07-31 23:43:35","iqra12");



CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` int(200) NOT NULL,
  `discountType` int(20) DEFAULT NULL,
  `discountRate` int(11) DEFAULT NULL,
  `discountPrice` int(11) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(20) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(20) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

INSERT INTO deals VALUES("15","seasonal deal","1200","2","0","0","7.png","2023-07-28 16:50:34","","2023-07-31 00:47:26","iqra12","","");
INSERT INTO deals VALUES("16","max deal","1000","0","500","500","8.png","2023-07-28 16:50:34","","2023-07-31 12:42:30","iqra12","","");
INSERT INTO deals VALUES("19","occassional ","1000","2","0","0","13.png","2023-07-28 16:50:34","","","","","");
INSERT INTO deals VALUES("20","happy meal","100","2","0","0","5.png","2023-07-28 16:50:34","","","","","");
INSERT INTO deals VALUES("21","dsf","100","1","1","99","18.png","2023-07-28 16:50:34","","","","","");
INSERT INTO deals VALUES("22","deals","700","0","10","690","15.png","2023-07-28 16:50:34","","2023-07-28 14:00:00","iqra12","2023-07-28 14:00:21","iqra12");
INSERT INTO deals VALUES("23","hot deal","1222","1","10","1100","17.png","2023-07-31 23:37:41","iqra12","","","","");



CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount_rate` int(11) NOT NULL,
  `discounted_amount` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `estimatedPreparationTimeMin` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(50) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(20) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

INSERT INTO items VALUES("2","$var_name","0","1","1","1","7","7","7","2023-07-28 15:59:23","","2023-07-31 00:48:48","7","2023-07-31 00:37:27","iqra12");
INSERT INTO items VALUES("10","Zingerella","1234","1","12","1086","10","12","burger4.png","2023-07-28 15:59:23","","2023-07-28 13:42:49","iqra12","2023-07-31 00:37:26","iqra12");
INSERT INTO items VALUES("12","Chicken BURGER","1222","2","0","0","8","12","burger8.png","2023-07-28 16:20:38","iqra12","2023-07-31 00:33:00","iqra12","2023-07-31 00:37:25","iqra12");
INSERT INTO items VALUES("13","43","34","1","34","22","8","34","burger7.png","2023-07-31 00:36:49","iqra12","","","2023-07-31 00:37:23","iqra12");
INSERT INTO items VALUES("14","burger","34","1","100","0","7","45","combo2.png","2023-07-31 00:39:01","iqra12","2023-07-31 12:48:07","iqra12","","");
INSERT INTO items VALUES("15","burger","34","2","0","0","7","34","hpmeal3.png","2023-07-31 00:46:42","iqra12","2023-07-31 12:48:15","iqra12","","");
INSERT INTO items VALUES("16","chicken burgeer","22","1","34","15","7","45","combo8.png","2023-07-31 00:58:23","iqra12","2023-07-31 12:50:22","iqra12","","");
INSERT INTO items VALUES("17","burger","1200","0","12","1188","7","12","burger15.png","2023-07-31 22:12:50","iqra12","2023-07-31 23:17:47","iqra12","","");
INSERT INTO items VALUES("18","zinger","1200","1","12","1056","7","12","burger5.png","2023-07-31 23:16:22","iqra12","","","2023-07-31 23:18:18","iqra12");
INSERT INTO items VALUES("19","zinger","1200","1","100","0","7","12","combo7.png","2023-07-31 23:16:48","iqra12","2023-07-31 23:18:07","iqra12","2023-07-31 23:18:20","iqra12");
INSERT INTO items VALUES("20","chkn burger","500","2","0","0","10","23","combo14.png","2023-07-31 23:17:14","iqra12","","","2023-07-31 23:24:39","iqra12");
INSERT INTO items VALUES("21","zinger","1200","2","0","0","7","12","combo2.png","2023-07-31 23:34:27","iqra12","2023-07-31 23:36:21","iqra12","2023-07-31 23:36:30","iqra12");
INSERT INTO items VALUES("22","chkn burgeer","1200","0","12","1188","12","12","combo1.png","2023-07-31 23:34:55","iqra12","","","","");
INSERT INTO items VALUES("23","combo1","1200","1","12","1056","7","12","combo4.png","2023-07-31 23:35:31","iqra12","2023-07-31 23:36:13","iqra12","","");



CREATE TABLE `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO logins VALUES("1","iqra","iqra","iqra@gmail.com","iqra12","1");
INSERT INTO logins VALUES("2","aqsa","aqsa","aqsa@gmail.com","aqsa12","2");
INSERT INTO logins VALUES("3","nimra","nimra","nimra@gmail.com","nimra12","3");



CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `deal_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_type` int(11) DEFAULT NULL,
  `discount_rate` int(11) DEFAULT NULL,
  `discounted_amnt` int(11) DEFAULT NULL,
  `total_amnt` int(11) NOT NULL,
  `order_type` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `deal_id` (`deal_id`),
  KEY `item_id` (`item_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`),
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO order_details VALUES("1","1","2","","12","12","12","12","12","100","dinein","2023-07-26 15:32:55");
INSERT INTO order_details VALUES("2","1","","20","1","1233","1","12","12","122","dinein","2023-07-26 15:34:31");



CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(200) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `gross_amnt` decimal(4,2) NOT NULL,
  `tax_type` int(11) NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount_rate` decimal(4,2) NOT NULL,
  `net_amnt` decimal(4,2) NOT NULL,
  `total_amnt` decimal(4,2) NOT NULL,
  `no_items` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `waiter_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `table_id` (`table_id`),
  KEY `waiter_id` (`waiter_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`),
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`waiter_id`) REFERENCES `waiters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("1","2011-1","1","5","12.00","1","12","1","12.00","12.00","12.00","1","1","3","2023-07-24 16:20:54");



CREATE TABLE `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `seaters` int(11) NOT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `CreatedBy` varchar(20) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO tables VALUES("5","family","1","133","2023-07-27 16:56:03","","2023-07-27 22:05:57","","","");
INSERT INTO tables VALUES("15","12","1","12","2023-07-27 22:35:24","iqra","","","","");
INSERT INTO tables VALUES("16","single","1","12","2023-07-27 22:36:23","iqra","2023-07-31 23:44:33","iqra12","","");
INSERT INTO tables VALUES("17","mine","1","121","2023-07-27 22:36:57","iqra12","2023-07-27 22:46:31","iqra12","2023-07-27 19:46:31","iqra12");
INSERT INTO tables VALUES("18","wasd","0","2","2023-07-31 22:13:43","iqra12","","","","");



CREATE TABLE `waiters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(20) DEFAULT NULL,
  `LastModifiedOn` datetime DEFAULT NULL,
  `LastModifiedBy` varchar(20) DEFAULT NULL,
  `DeletedOn` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO waiters VALUES("3","waiter","0","2023-07-28 15:18:35","","2023-07-31 23:45:14","iqra12","","");
INSERT INTO waiters VALUES("13","iqra","0","2023-07-28 15:30:22","iqra12","2023-07-28 12:30:26","iqra12","2023-07-31 23:45:26","iqra12");

