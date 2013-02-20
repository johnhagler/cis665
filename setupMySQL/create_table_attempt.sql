CREATE TABLE IF NOT EXISTS `Attempt` (
  `AttemptID` int(11) NOT NULL AUTO_INCREMENT,
  `RouteID` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `AttemptDate` int(8) NOT NULL,
  `AttemptTIme` int(6) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`AttemptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;