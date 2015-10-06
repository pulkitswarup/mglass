 -- USERS TABLE
CREATE TABLE `USERS` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 -- REVIEWS TABLE
 CREATE TABLE `REVIEWS` (
  `reviewId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `review` varchar(500) NOT NULL DEFAULT '',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`reviewId`),
  UNIQUE KEY `userId` (`userId`,`movieId`),
  KEY `movieId` (`movieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- RATINGS TABLE
 CREATE TABLE `RATINGS` (
  `ratingId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `rating` smallint(3) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ratingId`),
  UNIQUE KEY `userId` (`userId`,`movieId`),
  KEY `movieId` (`movieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- MOVIES TABLE
CREATE TABLE `MOVIES` (
  `movieId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year` int(4) NOT NULL DEFAULT '0',
  `genre` varchar(30) NOT NULL DEFAULT 'Others',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`movieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 