<template>
    <div class="container">
        <h1>Datubāzes un tabulu izveidošanas skripti</h1>
        <h4>Datubāzes izveidošana:</h4>
        <p>CREATE DATABASE `unitedconstuctiongroup` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
            /*!80016 DEFAULT ENCRYPTION='N' */;</p>
        <hr>
        <h4>Tabulu izveidošana:</h4>

        <h5>Address:</h5>
        <p>DROP TABLE IF EXISTS `address`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `address` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `Address` varchar(255) NOT NULL,
            `City` varchar(255) NOT NULL,
            `CountryId` int NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `CountryId_idx` (`CountryId`),
            CONSTRAINT `CountryId` FOREIGN KEY (`CountryId`) REFERENCES `country` (`Id`) ON DELETE CASCADE ON UPDATE
            CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
        </p>

        <hr />
        <p>LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (3,'ADASDASDAS','Riga',222),(4,'Hiroko Potter','Latrobe ',12),(5,'511-5762 At Rd.','Lebanon ',12),(7,'935-9940 Tortor. Street','Santa Rosa',12),(8,'asdasd','asd',5),(9,'Tartuas 12-3d','Daugavpils',124),(10,'511-5762 At Rd.','Santa Rosa',124),(11,'Hiroko Potter','Lebanon ',124),(12,'ADASDASDAS','Latrobe ',124),(13,'asdasd','Riga',124);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;</p>
 <hr />

        <hr />
        <h5>Billings</h5>
        <p>DROP TABLE IF EXISTS `billings`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `billings` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `BillingOwnerId` int NOT NULL,
            `HoursCount` float NOT NULL,
            `RequestedAmount` float NOT NULL,
            `WorkedOnProjectId` int NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `BillingOwnerId_idx` (`BillingOwnerId`),
            CONSTRAINT `BillingOwnerId` FOREIGN KEY (`BillingOwnerId`) REFERENCES `workers` (`Id`) ON DELETE CASCADE ON
            UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />

        <hr />
        <p></p>
         <hr />


        <h5>country</h5>
        <p>DROP TABLE IF EXISTS `country`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `country` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `Name` varchar(255) NOT NULL,
            `Code` varchar(3) NOT NULL,
            `Phone` int NOT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />

        <hr />
        <p></p>
         <hr />

        <h5>Ievadit visas valstis</h5>
        <p>INSERT INTO `country` VALUES (1,'Afghanistan','AF',93),(2,'Aland
            Islands','AX',358),(3,'Albania','AL',355),(4,'Algeria','DZ',213),(5,'American
            Samoa','AS',1684),(6,'Andorra','AD',376),(7,'Angola','AO',244),(8,'Anguilla','AI',1264),(9,'Antarctica','AQ',672),(10,'Antigua
            and
            Barbuda','AG',1268),(11,'Argentina','AR',54),(12,'Armenia','AM',374),(13,'Aruba','AW',297),(14,'Australia','AU',61),(15,'Austria','AT',43),(16,'Azerbaijan','AZ',994),(17,'Bahamas','BS',1242),(18,'Bahrain','BH',973),(19,'Bangladesh','BD',880),(20,'Barbados','BB',1246),(21,'Belarus','BY',375),(22,'Belgium','BE',32),(23,'Belize','BZ',501),(24,'Benin','BJ',229),(25,'Bermuda','BM',1441),(26,'Bhutan','BT',975),(27,'Bolivia','BO',591),(28,'Bonaire,
            Sint Eustatius and Saba','BQ',599),(29,'Bosnia and
            Herzegovina','BA',387),(30,'Botswana','BW',267),(31,'Bouvet
            Island','BV',55),(32,'Brazil','BR',55),(33,'British Indian Ocean Territory','IO',246),(34,'Brunei
            Darussalam','BN',673),(35,'Bulgaria','BG',359),(36,'Burkina
            Faso','BF',226),(37,'Burundi','BI',257),(38,'Cambodia','KH',855),(39,'Cameroon','CM',237),(40,'Canada','CA',1),(41,'Cape
            Verde','CV',238),(42,'Cayman Islands','KY',1345),(43,'Central African
            Republic','CF',236),(44,'Chad','TD',235),(45,'Chile','CL',56),(46,'China','CN',86),(47,'Christmas
            Island','CX',61),(48,'Cocos (Keeling)
            Islands','CC',672),(49,'Colombia','CO',57),(50,'Comoros','KM',269),(51,'Congo','CG',242),(52,'Congo,
            Democratic Republic of the Congo','CD',242),(53,'Cook Islands','CK',682),(54,'Costa
            Rica','CR',506),(55,'Cote
            D\'Ivoire','CI',225),(56,'Croatia','HR',385),(57,'Cuba','CU',53),(58,'Curacao','CW',599),(59,'Cyprus','CY',357),(60,'Czech
            Republic','CZ',420),(61,'Denmark','DK',45),(62,'Djibouti','DJ',253),(63,'Dominica','DM',1767),(64,'Dominican
            Republic','DO',1809),(65,'Ecuador','EC',593),(66,'Egypt','EG',20),(67,'El
            Salvador','SV',503),(68,'Equatorial
            Guinea','GQ',240),(69,'Eritrea','ER',291),(70,'Estonia','EE',372),(71,'Ethiopia','ET',251),(72,'Falkland
            Islands (Malvinas)','FK',500),(73,'Faroe
            Islands','FO',298),(74,'Fiji','FJ',679),(75,'Finland','FI',358),(76,'France','FR',33),(77,'French
            Guiana','GF',594),(78,'French Polynesia','PF',689),(79,'French Southern
            Territories','TF',262),(80,'Gabon','GA',241),(81,'Gambia','GM',220),(82,'Georgia','GE',995),(83,'Germany','DE',49),(84,'Ghana','GH',233),(85,'Gibraltar','GI',350),(86,'Greece','GR',30),(87,'Greenland','GL',299),(88,'Grenada','GD',1473),(89,'Guadeloupe','GP',590),(90,'Guam','GU',1671),(91,'Guatemala','GT',502),(92,'Guernsey','GG',44),(93,'Guinea','GN',224),(94,'Guinea-Bissau','GW',245),(95,'Guyana','GY',592),(96,'Haiti','HT',509),(97,'Heard
            Island and Mcdonald Islands','HM',0),(98,'Holy See (Vatican City
            State)','VA',39),(99,'Honduras','HN',504),(100,'Hong
            Kong','HK',852),(101,'Hungary','HU',36),(102,'Iceland','IS',354),(103,'India','IN',91),(104,'Indonesia','ID',62),(105,'Iran,
            Islamic Republic of','IR',98),(106,'Iraq','IQ',964),(107,'Ireland','IE',353),(108,'Isle of
            Man','IM',44),(109,'Israel','IL',972),(110,'Italy','IT',39),(111,'Jamaica','JM',1876),(112,'Japan','JP',81),(113,'Jersey','JE',44),(114,'Jordan','JO',962),(115,'Kazakhstan','KZ',7),(116,'Kenya','KE',254),(117,'Kiribati','KI',686),(118,'Korea,
            Democratic People\'s Republic of','KP',850),(119,'Korea, Republic
            of','KR',82),(120,'Kosovo','XK',381),(121,'Kuwait','KW',965),(122,'Kyrgyzstan','KG',996),(123,'Lao People\'s
            Democratic
            Republic','LA',856),(124,'Latvia','LV',371),(125,'Lebanon','LB',961),(126,'Lesotho','LS',266),(127,'Liberia','LR',231),(128,'Libyan
            Arab
            Jamahiriya','LY',218),(129,'Liechtenstein','LI',423),(130,'Lithuania','LT',370),(131,'Luxembourg','LU',352),(132,'Macao','MO',853),(133,'Macedonia,
            the Former Yugoslav Republic
            of','MK',389),(134,'Madagascar','MG',261),(135,'Malawi','MW',265),(136,'Malaysia','MY',60),(137,'Maldives','MV',960),(138,'Mali','ML',223),(139,'Malta','MT',356),(140,'Marshall
            Islands','MH',692),(141,'Martinique','MQ',596),(142,'Mauritania','MR',222),(143,'Mauritius','MU',230),(144,'Mayotte','YT',269),(145,'Mexico','MX',52),(146,'Micronesia,
            Federated States of','FM',691),(147,'Moldova, Republic
            of','MD',373),(148,'Monaco','MC',377),(149,'Mongolia','MN',976),(150,'Montenegro','ME',382),(151,'Montserrat','MS',1664),(152,'Morocco','MA',212),(153,'Mozambique','MZ',258),(154,'Myanmar','MM',95),(155,'Namibia','NA',264),(156,'Nauru','NR',674),(157,'Nepal','NP',977),(158,'Netherlands','NL',31),(159,'Netherlands
            Antilles','AN',599),(160,'New Caledonia','NC',687),(161,'New
            Zealand','NZ',64),(162,'Nicaragua','NI',505),(163,'Niger','NE',227),(164,'Nigeria','NG',234),(165,'Niue','NU',683),(166,'Norfolk
            Island','NF',672),(167,'Northern Mariana
            Islands','MP',1670),(168,'Norway','NO',47),(169,'Oman','OM',968),(170,'Pakistan','PK',92),(171,'Palau','PW',680),(172,'Palestinian
            Territory, Occupied','PS',970),(173,'Panama','PA',507),(174,'Papua New
            Guinea','PG',675),(175,'Paraguay','PY',595),(176,'Peru','PE',51),(177,'Philippines','PH',63),(178,'Pitcairn','PN',64),(179,'Poland','PL',48),(180,'Portugal','PT',351),(181,'Puerto
            Rico','PR',1787),(182,'Qatar','QA',974),(183,'Reunion','RE',262),(184,'Romania','RO',40),(185,'Russian
            Federation','RU',70),(186,'Rwanda','RW',250),(187,'Saint Barthelemy','BL',590),(188,'Saint
            Helena','SH',290),(189,'Saint Kitts and Nevis','KN',1869),(190,'Saint Lucia','LC',1758),(191,'Saint
            Martin','MF',590),(192,'Saint Pierre and Miquelon','PM',508),(193,'Saint Vincent and the
            Grenadines','VC',1784),(194,'Samoa','WS',684),(195,'San Marino','SM',378),(196,'Sao Tome and
            Principe','ST',239),(197,'Saudi
            Arabia','SA',966),(198,'Senegal','SN',221),(199,'Serbia','RS',381),(200,'Serbia and
            Montenegro','CS',381),(201,'Seychelles','SC',248),(202,'Sierra
            Leone','SL',232),(203,'Singapore','SG',65),(204,'Sint
            Maarten','SX',1),(205,'Slovakia','SK',421),(206,'Slovenia','SI',386),(207,'Solomon
            Islands','SB',677),(208,'Somalia','SO',252),(209,'South Africa','ZA',27),(210,'South Georgia and the South
            Sandwich Islands','GS',500),(211,'South Sudan','SS',211),(212,'Spain','ES',34),(213,'Sri
            Lanka','LK',94),(214,'Sudan','SD',249),(215,'Suriname','SR',597),(216,'Svalbard and Jan
            Mayen','SJ',47),(217,'Swaziland','SZ',268),(218,'Sweden','SE',46),(219,'Switzerland','CH',41),(220,'Syrian
            Arab Republic','SY',963),(221,'Taiwan, Province of
            China','TW',886),(222,'Tajikistan','TJ',992),(223,'Tanzania, United Republic
            of','TZ',255),(224,'Thailand','TH',66),(225,'Timor-Leste','TL',670),(226,'Togo','TG',228),(227,'Tokelau','TK',690),(228,'Tonga','TO',676),(229,'Trinidad
            and
            Tobago','TT',1868),(230,'Tunisia','TN',216),(231,'Turkey','TR',90),(232,'Turkmenistan','TM',7370),(233,'Turks
            and Caicos
            Islands','TC',1649),(234,'Tuvalu','TV',688),(235,'Uganda','UG',256),(236,'Ukraine','UA',380),(237,'United
            Arab Emirates','AE',971),(238,'United Kingdom','GB',44),(239,'United States','US',1),(240,'United States
            Minor Outlying
            Islands','UM',1),(241,'Uruguay','UY',598),(242,'Uzbekistan','UZ',998),(243,'Vanuatu','VU',678),(244,'Venezuela','VE',58),(245,'Viet
            Nam','VN',84),(246,'Virgin Islands, British','VG',1284),(247,'Virgin Islands, U.s.','VI',1340),(248,'Wallis
            and Futuna','WF',681),(249,'Western
            Sahara','EH',212),(250,'Yemen','YE',967),(251,'Zambia','ZM',260),(252,'Zimbabwe','ZW',263);
        </p>
        <hr />

        <hr />
        <p></p>
         <hr />

        <h5>customers</h5>
        <p>CREATE TABLE `customers` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `UserId` int NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `UserId_idx` (`UserId`),
            CONSTRAINT `UserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr/>


        <hr />
        <p>LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (8,7),(7,15),(6,19),(14,31),(13,32),(12,33),(11,34);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />


        <h5>orderedprojects</h5>
        <p>DROP TABLE IF EXISTS `orderedprojects`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `orderedprojects` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `OrderedProjectCustomerId` int DEFAULT NULL,
            `Status` enum('Ordered','Approved','In Progress','Finished') DEFAULT NULL,
            `ProjectDescriptionId` int DEFAULT NULL,
            `IsArchived` tinyint DEFAULT NULL,
            PRIMARY KEY (`Id`),
            KEY `OrderedProjectCustomerId_idx` (`OrderedProjectCustomerId`),
            KEY `ProjectDescriptionId_idx` (`ProjectDescriptionId`),
            CONSTRAINT `OrderedProjectCustomerId` FOREIGN KEY (`OrderedProjectCustomerId`) REFERENCES `customers` (`Id`)
            ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `ProjectDescriptionId` FOREIGN KEY (`ProjectDescriptionId`) REFERENCES `projectdescription`
            (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />

        <hr />
        <p>LOCK TABLES `orderedprojects` WRITE;
/*!40000 ALTER TABLE `orderedprojects` DISABLE KEYS */;
INSERT INTO `orderedprojects` VALUES (25,NULL,'Ordered',2,NULL),(26,NULL,'Finished',3,NULL),(27,NULL,'Finished',4,NULL),(28,6,'In Progress',5,NULL),(29,7,'In Progress',6,NULL),(30,8,'In Progress',7,NULL),(31,NULL,'Ordered',8,1),(33,NULL,'Finished',9,NULL),(34,NULL,'Finished',10,NULL),(35,NULL,'Finished',11,0),(37,11,'Finished',13,0),(38,12,'Finished',14,0),(39,13,'Finished',15,0),(40,14,'Finished',16,0);
/*!40000 ALTER TABLE `orderedprojects` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />


        <h5>productcategories</h5>
        <p>DROP TABLE IF EXISTS `productcategories`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `productcategories` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `Name` varchar(45) NOT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;</p>
        <hr />

        <hr />
        <p>LOCK TABLES `productcategories` WRITE;
/*!40000 ALTER TABLE `productcategories` DISABLE KEYS */;
INSERT INTO `productcategories` VALUES (1,'Door'),(2,'Window');
/*!40000 ALTER TABLE `productcategories` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />


        <h5>productdescription</h5>
        <p>DROP TABLE IF EXISTS `productdescription`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `productdescription` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `Color` varchar(45) DEFAULT NULL,
            `Manufacturer` varchar(255) NOT NULL,
            `Size` varchar(45) NOT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />

        <hr />
        <p></p>
         <hr />

        <h5>productorderitem</h5>
        <p>DROP TABLE IF EXISTS `productorderitem`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `productorderitem` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `OrderedProductId` int NOT NULL,
            `Count` int NOT NULL,
            `Discount` float DEFAULT '0',
            `OrderId` int NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `OrderedProductId_idx` (`OrderedProductId`),
            KEY `OrderId_idx` (`OrderId`),
            CONSTRAINT `OrderedProductId` FOREIGN KEY (`OrderedProductId`) REFERENCES `products` (`Id`) ON DELETE
            CASCADE ON UPDATE CASCADE,
            CONSTRAINT `OrderId` FOREIGN KEY (`OrderId`) REFERENCES `productorders` (`Id`) ON DELETE CASCADE ON UPDATE
            CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;</p>
        <hr />

        <hr />
        <p></p>
         <hr />


        <h5>productorders</h5>
        <p>CREATE TABLE `productorders` (
            `Id` int NOT NULL,
            `Address` varchar(255) NOT NULL,
            `City` varchar(255) NOT NULL,
            `OrderClientId` int DEFAULT NULL,
            `SumToPay` float NOT NULL,
            `Status` enum('Processing','Approved','Ordered','Declined') NOT NULL,
            `OrderDate` date NOT NULL,
            `ReceivedDate` date DEFAULT NULL,
            PRIMARY KEY (`Id`),
            KEY `OrderClientId_idx` (`OrderClientId`),
            CONSTRAINT `OrderClientId` FOREIGN KEY (`OrderClientId`) REFERENCES `customers` (`Id`) ON DELETE CASCADE ON
            UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;</p>
        <hr />

        <hr />
        <p></p>
         <hr />

        <h5>products</h5>
        <p>DROP TABLE IF EXISTS `products`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `products` (
            `Id` int NOT NULL,
            `SKU` varchar(45) NOT NULL,
            `CategoryId` int NOT NULL,
            `Price` float NOT NULL,
            `ClientAssesment` float NOT NULL DEFAULT '5',
            `ProductDescriptionId` int DEFAULT NULL,
            PRIMARY KEY (`Id`),
            KEY `ProductDescriptionId_idx` (`ProductDescriptionId`),
            KEY `CategoryId_idx` (`CategoryId`),
            CONSTRAINT `CategoryId` FOREIGN KEY (`CategoryId`) REFERENCES `productcategories` (`Id`) ON DELETE CASCADE
            ON UPDATE CASCADE,
            CONSTRAINT `ProductDescriptionId` FOREIGN KEY (`ProductDescriptionId`) REFERENCES `productdescription`
            (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />

        <hr />
        <p></p>
         <hr />

        <h5>projectdescription</h5>
        <p>CREATE TABLE `projectdescription` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `MoneySpent` float DEFAULT NULL,
            `EmployedCount` int DEFAULT NULL,
            `Text` text,
            `Title` varchar(255) DEFAULT NULL,
            `Address` varchar(255) DEFAULT NULL,
            `City` varchar(255) DEFAULT NULL,
            `StartDate` date NOT NULL,
            `PlannedEndDate` date DEFAULT NULL,
            `FinishDate` date DEFAULT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;</p>
        <hr />

        <hr />
        <p>LOCK TABLES `projectdescription` WRITE;
/*!40000 ALTER TABLE `projectdescription` DISABLE KEYS */;
INSERT INTO `projectdescription` VALUES (2,16499.2,5,'Text2','Title2','address 2','city 2','2020-04-18',NULL,'2021-05-01'),(3,26000,5,'Text3','Title3','address 3','city 2','2020-03-11',NULL,'2021-04-15'),(4,26000,5,'Text4','Title4','address 4','city 4','2020-03-11',NULL,'2021-04-15'),(5,15000.2,11,'Text5','Title5','Address 5','city 5','2020-03-11',NULL,'2021-04-15'),(6,15000.2,8,'Text6','ASDASD','12sadasd2','city 6','2020-04-18',NULL,'2021-06-13'),(7,15000.2,11,'Text7','ASD12','asd13123','city 7','2020-06-13',NULL,'2021-04-15'),(8,0,5,'Text8','ASD12','asd13123','city 7','2020-06-13',NULL,'2021-04-15'),(9,1234.42,5,NULL,'Endrup School','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','Denmarksa','2019-11-21',NULL,'2021-06-10'),(10,239.234,8,'Using a design principle that integrates architectural quality and energy efficiency, the VELUX Group set out to develop a home with a positive energy balance, a neutral environmental impact and the capacity to enhance well being.','Maison Air et Lumiere','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','Franceasd','2019-11-21',NULL,'2021-06-10'),(11,239.234,8,'Using a design principle that integrates architectural quality and energy efficiency, the VELUX Group set out to develop a home with a positive energy balance, a neutral environmental impact and the capacity to enhance well being.','Maison Air et Lumiere','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','Franceasd','2019-11-21',NULL,'2021-06-10'),(13,239.234,8,'Nine up-and-coming Austrian architects pitched their ideas for carbon-neutral home designs that kept energy consumption to a minimum without sacrificing the residents’ comfort or standard of living.','TUEN','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','city 7','2019-11-21',NULL,'2021-06-10'),(14,239.234,8,'Guided by the culture and well-established architectural standards of the Old Webster district in St. Louis, Missouri, the design team set out to develop the first Active House in the USA.','Future Active House','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','city 7','2019-11-21',NULL,'2021-06-10'),(15,239.234,8,'This renovation brought natural light into a previously dark and chilly home and improved its indoor climate and comfort.','Solhuset','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','city 7','2019-11-21',NULL,'2021-06-10'),(16,239.234,8,'Taking a holistic approach to energy, comfort and environment, the project team set out to develop a low-tech Active House concept with high residential quality.','zu-haus','Hiroko Potter P.O. Box 887 2508 Dolor. Av.','city 7','2019-11-21',NULL,'2021-06-10');
/*!40000 ALTER TABLE `projectdescription` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />

        <h5>projectimages</h5>
        <p>DROP TABLE IF EXISTS `projectimages`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `projectimages` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `ImageProjectId` int DEFAULT NULL,
            `ImagePath` varchar(45) DEFAULT NULL,
            `IsMainImage` tinyint NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `ImageProjectId_idx` (`ImageProjectId`),
            CONSTRAINT `ImageProjectId` FOREIGN KEY (`ImageProjectId`) REFERENCES `orderedprojects` (`Id`) ON DELETE
            CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;</p>
        <hr />
        <hr/>
        <p>LOCK TABLES `projectimages` WRITE;
/*!40000 ALTER TABLE `projectimages` DISABLE KEYS */;
INSERT INTO `projectimages` VALUES (39,25,'project-1.png',1),(40,26,'project-1.png',1),(50,38,'project-1.png',1),(51,39,'project-1.png',1),(52,40,'project-1.png',1),(53,37,'project-1.png',1);
/*!40000 ALTER TABLE `projectimages` ENABLE KEYS */;
UNLOCK TABLES;</p>
<hr/>
        <h5>skills</h5>
        <p>CREATE TABLE `skills` (
            `Id` int NOT NULL,
            `Name` varchar(45) NOT NULL,
            `Level` varchar(45) DEFAULT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />
        <hr />
        <p>LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'Driver Licence',NULL),(2,'Ironwork',NULL),(3,'Concrete',NULL),(4,'Drywall',NULL),(5,'Electrical',NULL),(6,'Plumbing',NULL),(7,'Painting',NULL),(8,'English','C'),(9,'English','B'),(10,'English','A'),(11,'Latvian','C'),(12,'Latvian','B'),(13,'Latvian','A'),(14,'Latvian','Native'),(15,'English','Native'),(16,'Russian','Native');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />

        <h5>userroles</h5>
        <p>CREATE TABLE `userroles` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `Name` varchar(45) NOT NULL,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />


        <hr />
        <p>LOCK TABLES `userroles` WRITE;
/*!40000 ALTER TABLE `userroles` DISABLE KEYS */;
INSERT INTO `userroles` VALUES (1,'Admin'),(2,'Builder'),(3,'Client');
/*!40000 ALTER TABLE `userroles` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />

        <h5>users</h5>
        <p>CREATE TABLE `users` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `UserName` varchar(255) NOT NULL,
            `Email` varchar(255) NOT NULL,
            `PasswordHash` longtext NOT NULL,
            `PhoneNumber` varchar(45) DEFAULT NULL,
            `FirstName` varchar(255) NOT NULL,
            `LastName` varchar(255) NOT NULL,
            `FullName` varchar(255) NOT NULL,
            `IsEnabled` tinyint NOT NULL DEFAULT '1',
            `RoleId` int NOT NULL DEFAULT '3',
            `AddressId` int DEFAULT NULL,
            PRIMARY KEY (`Id`),
            KEY `RoleId_idx` (`RoleId`),
            KEY `AdressId_idx` (`AddressId`),
            CONSTRAINT `AdressId` FOREIGN KEY (`AddressId`) REFERENCES `address` (`Id`) ON DELETE CASCADE ON UPDATE
            CASCADE,
            CONSTRAINT `RoleId` FOREIGN KEY (`RoleId`) REFERENCES `userroles` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />


        <hr />
        <p>LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'lorettaGr123@gmail.com','lorettaGr123@gmail.com','$2y$10$sPN0nHXuV1.QScNqJ05peuLtJ2yJEHAogFUiWZhA1/u6FAXusduGa','20512333','lora','Gresta','lora Gresta',1,1,NULL),(15,'Sinet1','asd211@gmail.com','$2y$10$W9KakRs/At19Ciox6R8MNOxijPf3JluZP3OZu80lpunsik8YtlxJO','239312345','Nik','Potas','Nik Potas',1,1,3),(19,'vija.vagale@gmail.com','vija.vagale@gmail.com','$2y$10$WBHx1LM9G9cUwQ6GR/c/YO2SSW0bvO4c0w8kXH/KneEQifrdwfdnC','20317330','Vija','Vgaas','Vija Vgaas',1,3,4),(26,'estt@gmail.com','estt@gmail.com','$2y$10$Qt/dMS1N7TB6MRF1i5HijOffH95T2dz3h95T5mHyikRrHNGp1yckC','20317330','test','tester','test,tester',1,3,9),(31,'estt@gmail.com','estt@gmail.com','$2y$10$Qt/dMS1N7TB6MRF1i5HijOffH95T2dz3h95T5mHyikRrHNGp1yckC','20317330','test','tester','test,tester',1,3,10),(32,'estt@gmail.com','estt@gmail.com','$2y$10$Qt/dMS1N7TB6MRF1i5HijOffH95T2dz3h95T5mHyikRrHNGp1yckC','20317330','test','tester','test,tester',1,3,11),(33,'estt@gmail.com','estt@gmail.com','$2y$10$Qt/dMS1N7TB6MRF1i5HijOffH95T2dz3h95T5mHyikRrHNGp1yckC','20317330','test','tester','test,tester',1,3,12),(34,'estt@gmail.com','estt@gmail.com','$2y$10$Qt/dMS1N7TB6MRF1i5HijOffH95T2dz3h95T5mHyikRrHNGp1yckC','20317330','test','tester','test,tester',1,3,13);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;</p>
         <hr />

        <h5>workers</h5>
        <p>CREATE TABLE `workers` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `WorkerUserId` int NOT NULL,
            `BankAccount` varchar(255) DEFAULT NULL,
            `SalaryPerHour` float NOT NULL,
            PRIMARY KEY (`Id`),
            KEY `WorkerUserId_idx` (`WorkerUserId`),
            CONSTRAINT `WorkerUserId` FOREIGN KEY (`WorkerUserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE
            CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />


        <hr />
        <p></p>
         <hr />

        <h5>workerskills</h5>
        <p>DROP TABLE IF EXISTS `workerskills`;
            /*!40101 SET @saved_cs_client = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `workerskills` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `SkillOwnerId` int NOT NULL,
            `SkillId` int DEFAULT NULL,
            PRIMARY KEY (`Id`),
            KEY `SkillOwnerId_idx` (`SkillOwnerId`),
            KEY `SkillId_idx` (`SkillId`),
            CONSTRAINT `SkillId` FOREIGN KEY (`SkillId`) REFERENCES `skills` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `SkillOwnerId` FOREIGN KEY (`SkillOwnerId`) REFERENCES `workers` (`Id`) ON DELETE CASCADE ON
            UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;</p>
        <hr />


        <hr />
        <p></p>
         <hr />

    </div>
</template>

<script>
    export default {

    }

</script>
