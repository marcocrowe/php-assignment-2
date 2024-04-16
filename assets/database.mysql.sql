
CREATE DATABASE  IF NOT EXISTS `it-school-v2024`;
USE `it-school-v2024`;

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;

CREATE TABLE `lecturer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Password` varchar(45) DEFAULT NULL,
   PRIMARY KEY (`Id`)
)ENGINE=InnoDB;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`Id`, `FirstName`, `LastName`, `Password`) VALUES
(1, 'John', 'Doe', '123456'),
(2, 'Jane', 'Doe', '123456'),
(3, 'John', 'Smith', '123456'),
(4, 'Jane', 'Smith', '123456');
