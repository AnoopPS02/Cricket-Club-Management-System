SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE Club(
 `ClubID` int(10) NOT NULL,
    `ClubName` varchar(30) NOT NULL,
    `President` varchar(20) NOT NULL,
    `Club_formed` date NOT NULL,
    `Address` varchar(30) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `players` (
  `playerID` int(10) AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `father_name` varchar(20) DEFAULT NULL,
  `mother_name` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `education` (
  `playerID` int(10) AUTO_INCREMENT PRIMARY KEY,
  `degree` varchar(20) NOT NULL,
  `institution` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `result` varchar(10) DEFAULT NULL,
  `year` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `player_history` (
  `playerID` int(10),
  `club_name` varchar(30) NOT NULL,
  `transferred_to` varchar(30) DEFAULT NULL,
  `transferred_from` varchar(30) DEFAULT NULL,
  `total_runs` int(7) NOT NULL,
  `total_wickets` int(5) NOT NULL,
   FOREIGN KEY (playerID) 
        REFERENCES players(playerID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `contracts` (
  `playerID` int(10) NOT NULL,
  `contract_start_date` date NOT NULL,
  `contract_end_date` date NOT NULL,
  `paymentID` int(20) AUTO_INCREMENT PRIMARY KEY,
  `contract_amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `payment_schedule` (
  `paymentID` int(20),
  `due_date` date NOT NULL,
  `actual_payment_date` date NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL,
  `payment_serial` int(30) DEFAULT NULL,
    FOREIGN KEY (paymentID)
    REFERENCES contracts(paymentID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Staff_info` (
    `Staffid` int(10) AUTO_INCREMENT PRIMARY KEY,
    `f_name` varchar(20) NOT NULL,
    `l_name` varchar(20) NOT NULL,
    `dob` date NOT NULL,
    `role` varchar(20) NOT NULL,
    `Exp` int NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `Staff_previous` (
    `Staffid` int(10) AUTO_INCREMENT PRIMARY KEY,
    `Clubname` varchar(20) NOT NULL,
    `From` int(4) NOT NULL,
    `To` int(4) NOT NULL,
    `Pre_Role` varchar(30) NOT NULL
)
