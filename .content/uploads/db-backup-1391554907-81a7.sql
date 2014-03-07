CREATE DATABASE `lhsmath-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lhsmath-bak`;


DROP TABLE IF EXISTS events;

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(2000) NOT NULL,
  `to_auto_notify` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;

INSERT INTO events VALUES("1","Martin Luther King Day","2011-01-17","No School","0");
INSERT INTO events VALUES("2","HMMT","2011-02-12","","0");
INSERT INTO events VALUES("3","GBML 4","2011-01-19","In Wayland\nMeet at 2:30 by the flagpole\n\nTopics:\n1. Volume and Surface Area of Solids\n2. Inequalities and Absolute Value\n3. Similar Polygons, Circles, and Areas Related to Circles\n4. Sequences and Complex Numbers\n5. Conic Sections","0");
INSERT INTO events VALUES("4","MML 4","2011-01-20","In Weston\nMeet at 2:30 by the flagpole\n\nTopics:\n1. Analytic Geometry: Anything\n2. Algebra 1: Factoring and/or equations involving factoring\n3. Trigonometry: Equations having a reasonable number of solutions\n4. Algebra 2: Quadratic Equations/Quadratic Theory\n5. Geometry: Similarity of Polygons\n6. Algebra 1: Anything","0");
INSERT INTO events VALUES("5","LMT","2011-04-02","Lexington Math Tournament\n8 AM to 4 PM at Lexington High School\n\nClick the \"LMT\" link on the left for more information.","0");
INSERT INTO events VALUES("6","Practice","2011-01-24","","0");
INSERT INTO events VALUES("7","Team Contest #2","2011-01-31","","0");
INSERT INTO events VALUES("8","MML 5","2011-02-03","In Lincoln-Sudbury\nMeet at 2:30 by the flagpole\n\nTopics:\n1. Algebra 2: Algebraic Functions\n2. Elementary Number Theory/Arithmetic\n3. Trigonometry: Identities and/or Inverse Functions\n4. Algebra 1: Word Problems\n5. Plane Geometry: Circles\n6. Algebra 2: Sequences and Series","0");
INSERT INTO events VALUES("9","GBML 5","2011-02-16","In Canton","0");
INSERT INTO events VALUES("10","Practice","2011-02-07","","0");
INSERT INTO events VALUES("11","Practice","2011-02-14","","0");
INSERT INTO events VALUES("14","Vacation Week","2011-02-21","","0");
INSERT INTO events VALUES("13","Practice","2011-02-28","MML rounds (4)\nTeam Contest 3 distributed","0");
INSERT INTO events VALUES("15","AMC 10A & 12A","2011-02-08","7:35 in the Science Lecture Hall","0");
INSERT INTO events VALUES("16","AMC 10B & 12B","2011-02-23","","0");
INSERT INTO events VALUES("17","Mandelbrot 4","2011-02-04","2:30 in room 800","0");
INSERT INTO events VALUES("18","MML 6","2011-03-03","In Canton","0");
INSERT INTO events VALUES("19","MML State (tentative)","2011-04-08","In Shrewsbury","0");
INSERT INTO events VALUES("20","MML New England","2011-04-29","In Canton","0");
INSERT INTO events VALUES("21","NEML 6","2011-03-22","","0");
INSERT INTO events VALUES("22","MAML Level 2","2011-03-01","8:45-12:30 in the Science Lecture Hall","0");
INSERT INTO events VALUES("23","AIME","2011-03-17","15 problems in 3 hours - short answers that are integers between 0 and 999. See:\n\nhttp://amc.maa.org/e-exams/e7-aime/aime.shtml (general information)\nhttp://www.artofproblemsolving.com/Forum/resources.php?c=182&cid=45&sid=414f9130b1f140de5c4d9fc48c090f1e (practice tests)","0");
INSERT INTO events VALUES("24","USAMO (tentative)","2011-04-27","","0");
INSERT INTO events VALUES("25","USAMO (tentative)","2011-04-28","","0");
INSERT INTO events VALUES("26","Mandelbrot 5","2011-03-04","2:30 in room 800","0");
INSERT INTO events VALUES("27","LMT Prep Day","2011-03-28","Overview of procedures, schedule.\nCopy machine party.","0");
INSERT INTO events VALUES("28","Team Contest 3","2011-03-14","Final Round: Teams 1, 2, and 5","0");
INSERT INTO events VALUES("29","Math Team Awards Ceremony","2011-06-01","Join us as we wrap up the year by distributing some gifts awards (some of our own, some from the contests that we\'ve participated in) while eating real (?) food. Captains for 2011-12 will also be announced.","0");
INSERT INTO events VALUES("30","Student Talks","2011-05-16","We are opening the floor to 30-45 minute talks by any math team member who is interested. Please e-mail the captains with your ideas for giving a math lecture (and with any questions). Come share interesting topics or support your friends!","0");
INSERT INTO events VALUES("32","HMNT","2011-11-12","Harvard-MIT November Tournament\nSee http://web.mit.edu/hmmt/www/november.shtml","0");
INSERT INTO events VALUES("33","AMC 10/12 A","2012-02-07","","0");
INSERT INTO events VALUES("34","AMC 10/12 B","2012-02-22","Note: This is over February Break.","0");
INSERT INTO events VALUES("35","AIME I","2012-03-15","","0");
INSERT INTO events VALUES("36","First Day","2011-09-12","2:30 PM in room 800\n\n- Introductions\n- \"Tryout\" - an assessment of math ability, but it pretty much won\'t count for anything else","0");
INSERT INTO events VALUES("37","No School","2011-09-05","Labor Day","0");
INSERT INTO events VALUES("38","NEML #1","2011-10-18","NEML Contest 1\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("39","NEML #2","2011-11-15","NEML Contest 2\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("40","NEML #3","2011-12-13","NEML Contest 3\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("41","NEML #4","2012-01-10","NEML Contest 4\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("42","NEML #5","2012-02-14","NEML Contest 5\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("43","NEML #6","2012-03-13","NEML Contest 6\n30 minutes, 6 questions\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("44","WPI Invitational","2011-10-19","WPI Invitational Math Meet","0");
INSERT INTO events VALUES("45","No School","2011-10-10","Columbus Day","0");
INSERT INTO events VALUES("46","No School","2011-12-26","Winter Break","0");
INSERT INTO events VALUES("47","No School","2012-01-02","Winter Break","0");
INSERT INTO events VALUES("48","No School","2012-01-16","Martin Luther King, Jr. Day","0");
INSERT INTO events VALUES("49","No School","2012-02-20","February Break","0");
INSERT INTO events VALUES("50","No School","2012-04-16","April Break","0");
INSERT INTO events VALUES("51","No School","2012-05-28","Memorial Day","0");
INSERT INTO events VALUES("52","Practice","2011-09-19","Tryout Solutions\nMML Rounds (4)\nCMT + Freshmen intro","0");
INSERT INTO events VALUES("53","Mandelbrot #1","2011-11-04","First Mandelbrot Competition\n40 minutes, 7 questions, regional and national levels\nMeets 2:30 after school in room 800","0");
INSERT INTO events VALUES("54","Mandelbrot #2","2011-12-02","Second Mandelbrot Competition\n40 minutes, 7 questions, regional and national levels\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("55","Mandelbrot #3","2012-01-13","Third Mandelbrot Competition\n40 minutes, 7 questions, regional and national levels\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("56","Mandelbrot #4","2012-02-03","Fourth Mandelbrot Competition\n40 minutes, 7 questions, regional and national levels\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("57","Mandelbrot #5","2012-03-02","Fifth Mandelbrot Competition\n40 minutes, 7 questions, regional and national levels\nMeets 2:30 PM in room 800","0");
INSERT INTO events VALUES("58","HMMT","2012-02-11","2012 HMMT Competition, at Harvard","0");
INSERT INTO events VALUES("59","MML Meet #1","2011-10-06","MML Meet 1 in Weston\nRegulars and Alternates to meet in front of the school at 2:30 PM","0");
INSERT INTO events VALUES("60","GBML Meet #1","2011-10-12","GBML Meet 1 in Concord-Carlisle\nRegulars and Alternates meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("61","MML Meet #2","2011-11-03","MML Meet #2 in Lexington\nRegulars are expected to show up, anyone who took rounds may show up as an alternate","0");
INSERT INTO events VALUES("100","State Meet","2012-04-02","","0");
INSERT INTO events VALUES("62","GBML Meet #2","2011-11-09","GBML Meet #2 at Lexington\nRegulars are expected to show up, anyone who took rounds may show up as an alternate","0");
INSERT INTO events VALUES("78","MAML Level 2","2012-03-06","Massachusetts Association of Math Leagues Olympiad Level 2\nProof based exam, comparable to 2010 USAJMO 1,2,4,5 in difficulty","0");
INSERT INTO events VALUES("63","MML Meet #3","2011-12-01","MML Meet #3 in Acton-Boxboro\nRegulars and Alternates meet in front of the school at 2:30 PM","0");
INSERT INTO events VALUES("64","GBML Meet #3","2011-12-07","GBML Meet #3 in Belmont\nRegulars and Alternates meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("65","MML Meet #4","2012-01-05","MML Meet #4 in Winchester\nRegulars and Alternates meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("66","GBML Meet #4","2012-01-11","GBML Meet #4 in Arlington\nRegulars and Alternates meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("67","MML Meet #5","2012-02-02","MML Meet #5 in Lincoln-Sudbury\nRegulars and Alternates to meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("68","GBML Meet #5","2012-02-08","GBML Meet #5 at a location TBD\nRegulars and Alternates to meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("69","MML Meet #6","2012-03-01","MML Meet #6 in Canton\nRegulars and Alternates to meet in front of school at 2:30 PM","0");
INSERT INTO events VALUES("70","Practice","2011-09-26","Right Triangle Trig\nMML (2)\nGBML (2)","0");
INSERT INTO events VALUES("71","Practice","2011-10-03","GBML (3)\nHMNT Tryout","0");
INSERT INTO events VALUES("72","Practice","2011-10-17","Announcements (many)\nLecture: Unit Circle Trig\nMML Rounds (3)\n[something after?]","0");
INSERT INTO events VALUES("73","Practice","2011-10-24","Announcements\nLecture: Complex Numbers\nMML Rounds (3)","0");
INSERT INTO events VALUES("74","Practice","2011-10-31","SNOOOOOOOOOOOOOOOOO\nCANCELLED","0");
INSERT INTO events VALUES("75","MAML Level 1","2011-10-20","Massachusetts Association of Math Leagues Olympiad, Level 1\nTest consists of 25 multiple choice questions to be done in 75 minutes\nDifficulty between AMC 10 and AMC 12","0");
INSERT INTO events VALUES("77","New England Meet","2012-04-27","New England meet in Canton","0");
INSERT INTO events VALUES("79","USAMO Day 1","2012-04-25","USA Mathematical Olympiad Day 1\n3 questions, 4.5 hours\nHigh scorers are invited to the Math Olympiad Summer Program (MOP)","0");
INSERT INTO events VALUES("80","USAMO Day 2","2012-04-26","USA Mathematical Olympiad Day 2\n3 questions, 4.5 hours\nHigh scorers are invited to the Math Olympiad Summer Program (MOP)","0");
INSERT INTO events VALUES("81","Practice","2011-11-07","Lecture (Matrices)\nGBML Rounds (4)","0");
INSERT INTO events VALUES("82","Practice","2011-11-14","Lecture: Logarithms\nMML Rounds\nTeam Contest: Problems","0");
INSERT INTO events VALUES("83","Practice","2011-11-21","Lecture: Laws of Sines and Cosines\nMML Rounds","0");
INSERT INTO events VALUES("84","Practice","2011-11-28","Team Contest 1","0");
INSERT INTO events VALUES("99","LMT","2012-05-05","","0");
INSERT INTO events VALUES("86","Practice","2011-12-05","GBML Rounds (4)","0");
INSERT INTO events VALUES("87","Practice","2011-12-12","MML Rounds (4)","0");
INSERT INTO events VALUES("88","Not Practice","2011-12-19","Alumni Visit","0");
INSERT INTO events VALUES("89","Practice","2012-01-09","Conic Sections\nGBML Rounds\nBecause it\'s 2 days from this practice","0");
INSERT INTO events VALUES("90","Practice","2012-01-23","MML Rounds","0");
INSERT INTO events VALUES("91","Practice","2012-01-30","MML Rounds","0");
INSERT INTO events VALUES("92","Practice","2012-02-06","GBML Rounds","0");
INSERT INTO events VALUES("93","Practice","2012-02-13","TBD","0");
INSERT INTO events VALUES("94","Practice","2012-02-27","MML Rounds","0");
INSERT INTO events VALUES("95","Practice","2012-03-05","TBD\nDistribute Team Contest?","0");
INSERT INTO events VALUES("96","Practice","2012-03-12","TBD","0");
INSERT INTO events VALUES("97","Practice","2012-03-19","TBD","0");
INSERT INTO events VALUES("101","Opening Day","2012-08-28","First day of school\nNew students only","0");
INSERT INTO events VALUES("102","Opening Day","2012-08-29","First day of school\nReturning students","0");
INSERT INTO events VALUES("103","No School","2012-09-03","Labor Day","0");
INSERT INTO events VALUES("104","No School","2012-09-17","Rosh Hashanah (Day 1)\n[also Constitution Day]","0");
INSERT INTO events VALUES("105","Math Team Intro","2012-09-10","\"Tryout\" - more properly an assessment used to see where people are at the beginning of the year, with almost no bearing on future math team participation","0");
INSERT INTO events VALUES("106","Practice","2012-09-24","\"Tryout\" solutions\nIntroduction to weekly problem sets\nMML Rounds","0");
INSERT INTO events VALUES("107","Practice","2012-10-01","(Potentially) other things\nMML Rounds\nGBML Rounds","0");
INSERT INTO events VALUES("108","MML","2012-10-04","Meet 1\nWeston","0");
INSERT INTO events VALUES("109","No School","2012-10-08","Columbus Day","0");
INSERT INTO events VALUES("110","GBML","2012-10-10","Meet 1\nConcord-Carlisle","0");
INSERT INTO events VALUES("111","Practice","2012-10-15","HMNT \"Tryout\"","0");
INSERT INTO events VALUES("112","Practice","2012-10-22","Unit Circle Trigonometry/Sine and Cosine Laws\nMML Rounds","0");
INSERT INTO events VALUES("113","Practice","2012-10-29","Complex Numbers\nMML Rounds","0");
INSERT INTO events VALUES("114","MML","2012-11-01","[Probably]\n\nMeet 2\nLocation TBA","0");
INSERT INTO events VALUES("115","GBML","2012-11-07","[Probably]\n\nMeet 2\nLocation TBA","0");
INSERT INTO events VALUES("116","No School","2012-11-12","Veterans\' Day","0");
INSERT INTO events VALUES("117","Practice","2012-11-05","Matrices\nGBML Rounds","0");
INSERT INTO events VALUES("118","Practice","2012-11-19","Logarithms\nMML Rounds (4)","0");
INSERT INTO events VALUES("119","Practice","2012-11-26","Sine and Cosine Laws\nMML Rounds (2)\nGBML Rounds (2)","0");
INSERT INTO events VALUES("120","Practice","2012-12-03","Complex Numbers are Imbalanced\nGBML Rounds (3)","0");
INSERT INTO events VALUES("121","MML","2012-12-06","[Probably]\n\nMeet 3\nLocation TBA","0");
INSERT INTO events VALUES("122","GBML","2012-12-12","[Probably]\n\nMeet 3\nLocation TBA","0");
INSERT INTO events VALUES("123","Practice","2012-12-10","MML Rounds (4)","0");
INSERT INTO events VALUES("124","Alumni?","2012-12-17","Block 4","0");
INSERT INTO events VALUES("125","No School","2012-12-24","Winter Break","0");
INSERT INTO events VALUES("126","No School","2012-12-31","Winter Break","0");
INSERT INTO events VALUES("174","MML","2013-01-10","Meet 4 at Winchester","0");
INSERT INTO events VALUES("175","GBML","2013-01-16","Meet 4 at Arlington","0");
INSERT INTO events VALUES("129","Alumni","2013-01-07","","0");
INSERT INTO events VALUES("130","Practice","2013-01-14","Conic Sections\nGBML Rounds (3)","0");
INSERT INTO events VALUES("131","No School","2013-01-21","Martin Luther King, Jr. Day","0");
INSERT INTO events VALUES("132","Practice + Testsolve","2013-01-28","Circles Lecture\nMML Rounds (4)\nLMT Testsolving","0");
INSERT INTO events VALUES("133","MML","2013-02-07","Meet 5 at Lincoln-Sudbury","0");
INSERT INTO events VALUES("134","GBML","2013-02-13","Meet 5 at Canton","0");
INSERT INTO events VALUES("135","LMT Preparations","2013-02-04","","0");
INSERT INTO events VALUES("136","Practice","2013-02-11","AMC A Post-Mortem\nGBML Rounds (4)","0");
INSERT INTO events VALUES("137","No School","2013-02-18","Presidents\' Day\n(Wikipedia says Washington\'s Birthday is the official holiday name)","0");
INSERT INTO events VALUES("138","Practice","2013-02-25","AMC B Post-Mortem\nMML Rounds (3)\nLecture (?)","0");
INSERT INTO events VALUES("139","MML","2013-03-07","POSTPONED\n\nMeet 6 at Canton","0");
INSERT INTO events VALUES("140","Practice","2013-03-04","MML Rounds (2)\nTBD","0");
INSERT INTO events VALUES("141","Practice","2013-03-11","States Rounds\nTeam Contest starts","0");
INSERT INTO events VALUES("142","Practice","2013-03-18","States Rounds","0");
INSERT INTO events VALUES("143","Team Contest","2013-03-25","","0");
INSERT INTO events VALUES("145","New England Meet","2013-04-26","Canton","0");
INSERT INTO events VALUES("146","Practice","2013-04-01","Extra Lecture\nNew England Rounds","0");
INSERT INTO events VALUES("147","State Meet","2013-04-08","Shrewsbury","0");
INSERT INTO events VALUES("148","No School","2013-04-15","Patriots\' Day\n(According to Wikipedia, this is only celebrated in Massachusetts, Maine, and Wisconsin)","0");
INSERT INTO events VALUES("149","Purple Comet?","2013-04-22","Maybe?\n\nhttp://purplecomet.org/","0");
INSERT INTO events VALUES("150","TBD","2013-04-29","Block 9","0");
INSERT INTO events VALUES("151","TBD","2013-05-06","Block 9","0");
INSERT INTO events VALUES("152","TBD","2013-05-13","Block 9","0");
INSERT INTO events VALUES("153","TBD","2013-05-20","Block 9","0");
INSERT INTO events VALUES("154","No School","2013-05-27","Memorial Day","0");
INSERT INTO events VALUES("155","Awards","2013-06-03","[Probably]","0");
INSERT INTO events VALUES("156","WPI","2012-10-17","WPI Math Meet","0");
INSERT INTO events VALUES("157","NEML","2012-10-16","Contest 1\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("158","NEML","2012-11-13","Contest 2\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("159","NEML","2012-12-11","Contest 3\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("176","NEML","2013-01-15","Contest 4\nRoom 800 \n2:35 plus or minus 5 minutes ","0");
INSERT INTO events VALUES("161","NEML","2013-02-12","Contest 5\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("162","NEML","2013-03-12","Contest 6\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("163","Mandelbrot","2012-11-09","Contest 1\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("164","Mandelbrot","2012-12-07","Contest 2\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("165","Mandelbrot","2013-01-11","Contest 3\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("166","Mandelbrot","2013-02-01","Contest 4\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("167","Mandelbrot","2013-03-01","Contest 5\nRoom 800\n2:35 plus or minus 5 minutes","0");
INSERT INTO events VALUES("168","AMC A","2013-02-05","Science Lecture Hall\n7:30 AM","0");
INSERT INTO events VALUES("169","AMC B","2013-02-20","Location TBD\n8:30","0");
INSERT INTO events VALUES("170","HMNT","2012-11-10","Harvard-MIT November Tournament","0");
INSERT INTO events VALUES("171","HMMT","2013-02-16","Harvard-MIT Math Tournament","0");
INSERT INTO events VALUES("172","LMT","2013-02-09","(hopefully)","0");
INSERT INTO events VALUES("173","MAML","2012-10-18","Level 1 competition","0");
INSERT INTO events VALUES("177","MAML Level 2","2013-03-05","Three-hour low level proof exam for those who qualified by taking the Level 1 test.","0");
INSERT INTO events VALUES("178","LMT","2013-03-30","In the event of likely postponement.","0");
INSERT INTO events VALUES("180","AIME I + MML","2013-03-14","AIME I in the Science Lecture Hall from 9 to 12 in the morning.\n\nMML meet 6 at Canton","0");
INSERT INTO events VALUES("181","Opening Day","2013-09-03","Opening Day - new students only","0");
INSERT INTO events VALUES("182","Opening Day","2013-09-04","opening day - returning students","0");
INSERT INTO events VALUES("198","No School","2014-04-25","Holiday","0");
INSERT INTO events VALUES("193","No School","2013-12-27","Winter break","0");
INSERT INTO events VALUES("196","No School","2014-04-18","Holiday","0");
INSERT INTO events VALUES("194","No School","2014-02-21","February Break","0");
INSERT INTO events VALUES("197","No School","2013-04-25","Holiday","0");
INSERT INTO events VALUES("199","AMC10/12 A","2014-02-04","Both the AMC 10 A and the AMC 12 A will be offered on this date during school.","0");
INSERT INTO events VALUES("191","First Meeting","2013-09-13","Room 831","0");
INSERT INTO events VALUES("192","No School","2013-11-29","Thanksgiving","0");
INSERT INTO events VALUES("200","AMC 10/12 B","2014-02-19","The AMC 10 and 12 B will be offered on this date.  Note that this is during school vacation week -- it is not mandatory.","0");
INSERT INTO events VALUES("201","No School","2014-02-17","February Break","0");
INSERT INTO events VALUES("202","No School","2014-02-18","February Break","0");
INSERT INTO events VALUES("203","No School","2014-02-20","February Break","0");
INSERT INTO events VALUES("204","AIME I","2014-03-13","Everybody will be taking the AIME I unless there are major circumstances leading to their needing to take the AIME II with advance notice (such as a religious holiday or family trip)","0");
INSERT INTO events VALUES("205","AIME II","2014-03-26","","0");
INSERT INTO events VALUES("206","USA(J)MO Day 1","2014-04-29","","0");
INSERT INTO events VALUES("207","USA(J)MO Day 2","2014-04-30","","0");
INSERT INTO events VALUES("208","MML Meet 1","2013-10-03","Weston","0");
INSERT INTO events VALUES("209","MML Meet 2","2013-11-07","Concord Carlisle","0");
INSERT INTO events VALUES("210","MML Meet 3","2013-12-05","Acton-Boxboro","0");
INSERT INTO events VALUES("211","MML Meet 4","2014-01-09","Winchester","0");
INSERT INTO events VALUES("212","MML Meet 5","2014-02-06","Lincoln-Sudbury","0");
INSERT INTO events VALUES("213","MML Meet 6","2014-03-06","Canton","0");
INSERT INTO events VALUES("215","MAML Math Olympiad","2013-10-24","7:45-9:40  ","0");
INSERT INTO events VALUES("216","GBML Meet 1","2013-10-09","at Chelmsford","0");
INSERT INTO events VALUES("217","NEML Contest 1","2013-10-15","New England Math League Contest 1 - Room 831","0");
INSERT INTO events VALUES("218","NEML Contest 2","2013-11-12","New England Math League Contest 2","0");
INSERT INTO events VALUES("219","NEML Contest 3","2013-12-03","New England Math League Contest 3","0");
INSERT INTO events VALUES("220","NEML Contest 4","2014-01-14","New England Math League Contest 4","0");
INSERT INTO events VALUES("221","NEML Contest 5","2014-02-11","New England Math League Contest 5","0");
INSERT INTO events VALUES("222","NEML Contest 6","2014-03-11","New England Math League Contest 6","0");
INSERT INTO events VALUES("224","GBML Meet 2","2013-11-13","At Concord-Carlisle","0");
INSERT INTO events VALUES("225","GBML Meet 3","2013-12-11","At Gann Academy","0");
INSERT INTO events VALUES("226","GBML Meet 4","2014-01-15","At Lexington","0");
INSERT INTO events VALUES("228","GBML Playoff Meet","2014-02-12","","0");
INSERT INTO events VALUES("241","Yearbook Picture","2013-10-22","Our club picture will be taken directly after school in Commons II.","0");
INSERT INTO events VALUES("236","Mandelbrot Competition 1","2013-11-05","2:30 in Room 831","0");
INSERT INTO events VALUES("238","Mandelbrot Competition 3","2014-01-07","2:30 in Room 831","0");
INSERT INTO events VALUES("239","Mandlebrot Competition 4","2014-02-04","2:30 in Room 831","0");
INSERT INTO events VALUES("240","Mandlebrot Competition 5","2014-03-04","2:30 in Room 831","0");
INSERT INTO events VALUES("242","HMNT","2013-11-09","The Harvard-MIT November Tournament, which is basically a junior version of the HMMT. All Day.\nRules:\nhttp://web.mit.edu/hmmt/www/november/rules.shtml\n\nLogistics:\nhttp://web.mit.edu/hmmt/www/november/logistics.shtml\n\nSchedule:\nhttp://web.mit.edu/hmmt/www/november/datafiles/schedules/2013-november.shtml","0");
INSERT INTO events VALUES("243","Mandelbrot 3","2013-12-03","Room 831, after school","0");
INSERT INTO events VALUES("244","HMMT","2014-02-22","Harvard MIT Math Tournament, details at\nweb.mit.edu/hmmt/www/february/","0");



DROP TABLE IF EXISTS file_categories;

CREATE TABLE `file_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO file_categories VALUES("1","Lessons");
INSERT INTO file_categories VALUES("2","2010-2011 Team Contests");
INSERT INTO file_categories VALUES("4","Guest Lectures");
INSERT INTO file_categories VALUES("5","2011-12 Tests");
INSERT INTO file_categories VALUES("8","2012-13 Tests");
INSERT INTO file_categories VALUES("9","2012-13 Problem Sets");
INSERT INTO file_categories VALUES("10","2013-14 Tests");
INSERT INTO file_categories VALUES("11","2013-2014 Team Contests");



DROP TABLE IF EXISTS files;

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `permissions` char(1) NOT NULL,
  `category` int(11) NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

INSERT INTO files VALUES("1","Circles","Circles.pdf","M","1","9");
INSERT INTO files VALUES("45","Tryout","tryout.pdf","M","5","1");
INSERT INTO files VALUES("3","Complex Numbers","Complex Numbers.pdf","M","1","3");
INSERT INTO files VALUES("4","Conic Sections","Conic Sections.pdf","M","1","8");
INSERT INTO files VALUES("5","Laws of Sines and Cosines","Laws of Sines and Cosines.pdf","M","1","6");
INSERT INTO files VALUES("6","Logarithms","Logarithms.pdf","M","1","5");
INSERT INTO files VALUES("7","Matrices","Matrices.pdf","M","1","4");
INSERT INTO files VALUES("42","Geometric Probability","Probability Using Geometry.pdf","M","4","1");
INSERT INTO files VALUES("9","Right Triangle Trig","Right Triangle Trig.pdf","M","1","1");
INSERT INTO files VALUES("10","Trig Identities and Inverses","Trig Identities and Inverses.pdf","M","1","10");
INSERT INTO files VALUES("11","Trig with Complex Numbers","Trig with Complex Numbers.pdf","M","1","7");
INSERT INTO files VALUES("12","Unit Circle Trig","Unit Circle Trig.pdf","M","1","2");
INSERT INTO files VALUES("13","Team Contest 1","Team Contest 1.pdf","M","2","2");
INSERT INTO files VALUES("15","Team Contest 1 - Solutions","Team Contest 1 - Solutions.pdf","M","2","3");
INSERT INTO files VALUES("18","Team Contest 2","Team Contest 2.pdf","M","2","4");
INSERT INTO files VALUES("19","Team Contest 2 - Solutions","Team Contest 2 - Solutions.pdf","M","2","5");
INSERT INTO files VALUES("24","Team Contest 3","Team Contest 3.pdf","M","2","6");
INSERT INTO files VALUES("41","Arithmetic Mean - Geometric Mean Inequality","Arithmetic and Geometric Mean-ed99.pdf","M","4","2");
INSERT INTO files VALUES("40","Interpreting Problems Geometrically","Trig with Geometry-83c3.pdf","M","4","3");
INSERT INTO files VALUES("46","MML Assumed Ideas","assumed_ideas.pdf","M","0","1");
INSERT INTO files VALUES("47","HMNT Tryout","HMNT 2011.pdf","M","5","2");
INSERT INTO files VALUES("77","Trig Equations Solutions","trigeqnsolutions.pdf","M","0","2");
INSERT INTO files VALUES("75","HMNT Tryout","HMNT 2012.pdf","M","8","2");
INSERT INTO files VALUES("80","PSet 3","pset3.pdf","M","9","4");
INSERT INTO files VALUES("61","Team Contest","Team Contest 1-37b3.pdf","M","5","3");
INSERT INTO files VALUES("62","Team Contest Solutions","Team Contest 1 Solutions.pdf","M","5","4");
INSERT INTO files VALUES("69","Arithmetical Functions","arithmetical.pdf","M","4","4");
INSERT INTO files VALUES("70","Tryout","tryout-7fc0.pdf","M","8","1");
INSERT INTO files VALUES("73","PSet 1","pset1.pdf","M","9","1");
INSERT INTO files VALUES("78","PSet 2","pset2.pdf","M","9","3");
INSERT INTO files VALUES("81","PSet 4","pset4.pdf","M","9","5");
INSERT INTO files VALUES("82","Logarithms Solutions","gbml34solutions.pdf","M","0","3");
INSERT INTO files VALUES("86","Team Contest 2012-13","teamcontest.pdf","M","8","3");
INSERT INTO files VALUES("88","Team Contest 2012-13 Solutions","tcsols.pdf","M","8","4");
INSERT INTO files VALUES("90","New England Extra","neamlextra.pdf","M","8","5");
INSERT INTO files VALUES("91","2013 S-III","2013_USA(J)MO Student Letter S-I, S-II & S-III.pdf","M","0","4");
INSERT INTO files VALUES("92","Tryout","MathTeamTryout2.pdf","M","10","1");
INSERT INTO files VALUES("93","Team Contest 1","team contest.pdf","M","11","1");
INSERT INTO files VALUES("94","Database Backup: 2014-01-01","db-backup-1388629338-1487.sql","A","0","5");



DROP TABLE IF EXISTS login_attempts;

CREATE TABLE `login_attempts` (
  `email` varchar(320) NOT NULL,
  `remote_ip` varchar(39) NOT NULL,
  `successful` tinyint(1) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 15:38:20");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 19:53:17");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 20:43:59");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 20:44:51");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 21:01:45");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-01-31 21:55:17");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-01 12:51:48");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","0","2014-02-01 23:43:44");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-01 23:44:31");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-01 23:46:07");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-01 23:46:59");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-03 15:44:14");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-04 07:04:42");
INSERT INTO login_attempts VALUES("doobahead@gmail.com","::1","1","2014-02-04 17:53:23");



DROP TABLE IF EXISTS messages;

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(75) NOT NULL,
  `body` varchar(5000) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

INSERT INTO messages VALUES("3","21","2011-09-25 19:49:14","Practice 9/26/11","Hello everyone,<br />\n<br />\nIf you are getting this message, then the mailing list seems to be working properly.<br />\n<br />\nFor tomorrow\'s practice, we will be having the first lecture of the year (albeit a somewhat shorter one) on trigonometry in right triangles. Afterwards, we will do the last two rounds for MML and start the rounds for the GBML, which runs similarly to the MML except with 5 rounds and two teams of 5 people each.<br />\n<br />\nFor those of you who took rounds from last week home to complete in your own time, please get your answers to those rounds in ASAP.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("4","21","2011-10-03 21:35:39","MML Teams Thursday 10-6-11","The teams for the first MML meet at Weston on Thursday, October 6th are<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Regulars</span></span><br />\nAlan Zhou<br />\nJason Li<br />\nKevin Wen<br />\nAmy Zhang<br />\nDan Kim<br />\nAndrew Kuida<br />\nKyuil Lee<br />\nZachary Polansky<br />\nRohil Prasad<br />\nJonathan Tidor<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Alternates</span></span><br />\nSurya Bhupatiraju<br />\nNoah Golowich<br />\nCelina Hsieh<br />\nTanmay Khale<br />\nDaehyun Kim<br />\nHenry Li<br />\nHao Shen<br />\nShohini Stout<br />\nBenjamin Tidor<br />\nPeijin Zhang<br />\n<br />\nIf you are in the above list, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we have adequate time to find a replacement.<br />\n<br />\nRegulars, please select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Geometry: Volumes and Surfaces<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Plane Geometry: Pythagorean relations in rectilinear figures<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Algebra 1: Linear Equations<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 1: Fractions and Mixed Numbers<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Algebra 2: Inequalities and Absolute Value<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Algebra 1: Evaluations");
INSERT INTO messages VALUES("7","21","2011-10-05 22:16:04","MML 1 Reminder","If you are going to the MML meet tomorrow, please remember to be at the front entrance at 2:30 PM (and then be at the front entrance at 2:30 PM!).<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("9","21","2011-10-10 19:07:39","GBML Teams Wednesday 10-12-11","Teams for the first GBML meet at Concorde-Carlisle on Wednesday, October 12th.<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Alpha</span></span><br />\nJason Li<br />\nKevin Wen<br />\nAlan Zhou<br />\nJonathan Tidor<br />\nPeijin Zhang<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Beta</span></span><br />\nAmy Zhang<br />\nAndrew Kuida<br />\nZach Polansky<br />\nShohini Stout<br />\nBenjamin Tidor<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Alternates</span></span><br />\nSurya Bhupatiraju<br />\nNoah Golowich<br />\nAditya Gopalan<br />\nClark Ikezu<br />\nTanmay Khale<br />\nDan Kim<br />\nHenry Li<br />\nRohil Prasad<br />\nHao Shen<br />\nDaniel Wang<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Arithmetic: Open<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Algebra 1: Problem Solving (Word Problems)<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Algebra 1: Exponents and Radicals; Equations involving them<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2: Factoring; Equations involving Factoring<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Trigonometry: Angular and Linear Velocity; Right Triangle Trigonometry");
INSERT INTO messages VALUES("10","21","2011-10-11 20:09:25","GBML 1 Reminder","If you will be at the GBML meet tomorrow, please be present at the front entrance at 2:30 PM.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("11","21","2011-10-11 21:22:10","HMNT","When we took the HMNT tryout last week, a fair number of you put down that you were unsure whether you could make it to the competition, which is on November 12th. We would like a more definitive answer in the next day or two so that we have an idea how many people we\'ll be sending. If you are still not entirely sure if you can go, pick the one you\'re leaning towards right now. <br />\n<br />\nIf you don\'t remember what you said on the tryout, on the website, if you have a score of 1 on HMNT availability, you said you can go, if you have a 0, you said you can\'t, and no score means you said unsure or something else. If you were not here for the HMNT tryout but would like to go, just let us know (captains@lhsmath.org).<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("13","21","2011-10-17 21:11:56","NEML Reminder","This is a reminder that the first NEML of the year is tomorrow after school in room 800. We will attempt to get started as soon as possible (somewhere between 2:35 and 2:40 normally), so try to show up before then.");
INSERT INTO messages VALUES("14","21","2011-10-19 20:00:25","MAML Reminder","This is a reminder that the MAML Level 1 will be tomorrow in the Science Lecture Hall. Please arrive around 7:35 or 7:40 so we can start as soon as possible. You will be missing C and B blocks.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("15","21","2011-10-29 17:00:42","MML 11-3-11","The team for the second MML meet at Lexington on Thursday, November 3rd<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Regulars</span></span><br />\nAlan Zhou<br />\nJason Li<br />\nKevin Wen<br />\nAmy Zhang<br />\nAditya Gopalan<br />\nAndrew Kuida<br />\nHao Shen<br />\nJonathan Tidor<br />\nKyuil Lee<br />\nRohil Prasad<br />\n<br />\n<span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Alternates</span></span><br />\nAnyone that wishes to show up*<br />\n<br />\n<br />\nIf you are in the above list, you are expected to show up at the appropriate room in the math building (probably room 819 or something around there, it\'ll say Lexington on it). As per usual, email captains@lhsmath.org if you are unable to go so we can get a replacement.<br />\n<br />\nRegulars, select three categories from the six below and send your preferences to the captains at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Algebra 2: Complex Numbers (no Trig)<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Algebra 1: Anything<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Plane Geometry: Area of rectilinear figures<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 1: Factoring and its applications<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Trigonometry: Functions of 30, 45, 60 &amp; 90 and their integral multiples<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Plane Geometry: Angles about a point, triangles, and parallels<br />\n<br />\n*Direct result of the meet being at Lexington as opposed to somewhere else");
INSERT INTO messages VALUES("16","20","2011-11-02 15:08:30","MML Meet this Thursday","Hi all,<br />\n<br />\nJust a reminder that the 2nd MML math meet will be at Lexington High School tomorrow. Please be at room 819/820 by around 3:00 PM. Also, take note that ANYONE can participate in this meet as an alternate, so feel free to stop by! In the unlikely event that some schools cannot make it to the meet due to the snowstorm, there is a possibility that the meet would be postponed to a later date. We\'ll notify you guys ASAP if this happens.<br />\n<br />\n-The Captains");
INSERT INTO messages VALUES("17","21","2011-11-02 16:55:55","Events This Week","In addition to the MML Meet on Thursday, the first Mandelbrot competition of the year will be <span style=\"font-weight: bold;\">this Friday</span> in room 800 right after school. There are two levels, regional and national, and you individually get to decide which level you want to take. The national level is harder but shares some questions with regional, there are 7 questions to be done in 40 (? someone correct me if necessary) minutes.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("18","21","2011-11-03 23:47:58","Mandelbrot Reminder","This is a(n extremely late) reminder that the first Mandelbrot competition of the year is scheduled to be tomorrow after school in room 800.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("19","21","2011-11-04 16:22:59","HMNT","As of now, below is the list of people that are registered to go to HMNT, in no particular order (actually, it\'s alphabetical by first name). If you either are on the list and cannot go or are not on the list and wish to go or know someone who wants to go (and can), please let us know so we can make the appropriate adjustments (captains@lhsmath.org). Any such changes should be sent to us by 11 PM at the latest so we can be sure to make the appropriate adjustments on time.<br />\n<br />\nAditya Gopalan<br />\nAlan Qiu<br />\nAlex Sekula<br />\nAndrew Kuida<br />\nBenjamin Tidor<br />\nCelina Hsieh<br />\nCharles Li<br />\nClark Ikezu<br />\nDaehyun Kim<br />\nDaniel Wang<br />\nDarwin Ding<br />\nDavid Papp<br />\nDavid Yuan<br />\nEugenia Kim<br />\nHao Shen<br />\nHenry Li<br />\nHuixin Zhang<br />\nJongwon Kim<br />\nJulia Sun<br />\nKyuil Lee<br />\nNick Zhang<br />\nNikhil Bajaj<br />\nNoah Golowich<br />\nPeijin Zhang<br />\nSuchith De Silva<br />\nSurya Bhupatiraju<br />\nTanmay Khale<br />\nTimothy Zhu<br />\nVictor Zhang<br />\nZach Polansky<br />\n<br />\n~ Captains<br />\n<br />\n");
INSERT INTO messages VALUES("20","21","2011-11-04 16:45:21","Team Contest","Below is the list of people that currently have either said they can do team contest or didn\'t say they can\'t do team contest. If you wish to drop out of team contest or you wish to join team contest, drop us an email at captains@lhsmath.org. There is no deadline for this decision as of now, although you should try to do that over this weekend.<br />\n<br />\n(no particular order)<br />\n<br />\nAditya Gopalan	<br />\nAndrew Kuida<br />\nBenjamin Tidor<br />\nDaehyun Kim	<br />\nDan Kim	<br />\nEugenia Kim	<br />\nHao Shen	<br />\nHenry Li<br />\nJames Lung	<br />\nJonathan Tidor<br />\nKyuil Lee	<br />\nNoah Golowich<br />\nRohil Prasad<br />\nSuchith De Silva	<br />\nSurya Bhupatiraju	<br />\nAlex Sekula<br />\nClark Ikezu<br />\nDaniel Wang	<br />\nPeijin Zhang<br />\nShohini Stout<br />\nVictor Zhang<br />\nEric Hsu<br />\nMayukha Karnam	<br />\nShashwat Patel	<br />\nTanmay Khale<br />\nZach Polansky<br />\nAushu Khamesra<br />\nDavid Papp<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("21","21","2011-11-06 21:38:38","Practice 11/7/11 and HMNT Carpooling","Due to the whole storm stuff that happened last week, we have been forced to reschedule things a little bit.<br />\n<br />\nThis coming practice, we will be doing four of the five GBML rounds (all but arithmetic) after a lecture on some basic stuff about matrices. The 2nd GBML Meet is this Wednesday, again at Lexington.<br />\n<br />\nWe will not be holding a CMT meeting afterwards, but if you participate in it and have solutions to the first problem set, it would be nice to have those tomorrow so that they can be graded since the solutions will be going up afterwards. In addition, new problem sets will be available tomorrow as well to be picked up.<br />\n<br />\nHMNT is this Saturday, the 12th. To get there, we arrange carpools. If you are going and can send people there or bring people back from HMNT (at MIT), please email us (captains@lhsmath.org) with the direction(s) you can take people as well as how many. Any additional carpooling information such as any particular people you will be taking to HMNT should also be sent to us. The list of people signed up for HMNT sent a few days ago still holds for the most part aside from any changes that were sent to us, and we\'ll send out an updated list of people soon.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("22","21","2011-11-07 17:43:27","GBML Rounds","For those of you that took rounds home today, please get those in no later than 8 PM tonight so that we can get teams out on time.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("23","19","2011-11-07 21:31:33","GBML 11/9/11","Here is the team for the second GBML meet this Wednesday, November 9 at Lexington:<br />\n<br />\nRegulars:<br />\n<br />\nAlpha:<br />\nJason Li<br />\nHao Shen<br />\nJonathan Tidor<br />\nAmy Zhang<br />\nAlan Zhou<br />\n<br />\nBeta:<br />\nAndrew Kuida<br />\nRohil Prasad<br />\nShohini Stout<br />\nKevin Wen<br />\nPeijin Zhang<br />\n<br />\nAlternates:<br />\n<br />\nAnyone that wishes to show up (since this meet is at Lexington as well)<br />\n<br />\nIf you are a regular, you should show up at the appropriate room (probably 818, 819, or 820) in the math building at 3:00. As per usual, email captains@lhsmath.org if you are unable to go so we can get a replacement.<br />\n<br />\nRegulars, select three categories from the five below and send your preferences to the captains at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1: Arithmetic: Open<br />\nRound 2: Simultaneous Linear Equations and Word Problems, Matrices<br />\nRound 3: Geometry: Angles and Triangles<br />\nRound 4: Algebra 2: Quadratic Equations, Problems Involving Them, Theory of Quadratics<br />\nRound 5: Trig Equations");
INSERT INTO messages VALUES("24","19","2011-11-07 21:44:30","A note on future trig rounds","It turned out that over half the scores on the GBML Trig Equations round were zero. Some of these zeros came from freshmen who actually scored high on the other rounds. This was not unexpected, as many of the freshmen new to high school math may not know trig. We understand that trig is difficult to learn and that two half-hour lectures on trig is simply not sufficient for those who have never used trig before. If you want to make the regular team but are struggling with trig, please don\'t be discouraged: a zero on the trig round will not eliminate your chance of making the team. When forming teams, we do not only look at the total score on the tryouts, and will be making exceptions particularly on the trig rounds. (We did not have to make any exceptions this time.) So if you can score consistently high on all the rounds except trig, we will still put you on the team.<br />\n<br />\nOf course, this does not mean you should not learn trig on your own. You should, but keep in mind that it\'s a slow process, and it may be long before you get your first 6 on a trig round. But again, don\'t feel discouraged while you are still learning trig.<br />\n<br />\nAs a side note, the AIME, in March, does include trig, so just make sure you are good with trig by then.<br />\n<br />\n- The Captains");
INSERT INTO messages VALUES("25","21","2011-11-07 22:10:12","Addition to the Note on Future Trig Rounds","This does not necessarily apply to just trig rounds, but these are the rounds that such results would be likely to occur in (However, if a round hypothetically was simply about adding single digit integers and people hypothetically scored high on all the other rounds and bombed that, this might not apply. The example here is a <span style=\"font-style: italic;\">bit</span> extreme.)<br />\n<br />\n<br />\nAlso, for those that saw the note and thought &quot;lolwut rly guyz&quot;, we (or at least I) recommend you work on trig bashing some geometry problems. Chances are,  you\'ll find that you still have a fair amount of room to improve in trig.<br />\n<br />\n<br />\n~ Your Captains (who are not as good at trig as the last comment may lead one to believe)");
INSERT INTO messages VALUES("26","21","2011-11-08 20:13:26","GBML Reminder (Meet 2)","The 2nd GBML Meet is tomorrow at Lexington, we will be in room 819. Anyone who took rounds and isn\'t a regular is free to come as an alternate.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("27","21","2011-11-08 21:26:00","HMNT: Part One","Hello everyone,<br />\n<br />\nThere is a fair amount of stuff for HMNT that needs to be said.<br />\nFirst off, the teams:<br />\n<br />\n<span style=\"font-weight: bold;\">Alpha (A)</span><br />\nHao S.<br />\nAndrew K.<br />\nPeijin Z.<br />\nSurya B.<br />\nZach P.<br />\nAditya G.<br />\n<br />\n<span style=\"font-weight: bold;\">Beta (B)</span><br />\nBenjamin T.<br />\nAlan Q.<br />\nCelina H.<br />\nNick Z.<br />\nNoah G.<br />\nJulia S.<br />\n<br />\n<span style=\"font-weight: bold;\">Epsilon (E)</span><br />\nDarwin D.<br />\nVictor Z.<br />\nSuchith<br />\nShashwat P.<br />\nCharles Li<br />\n(blank spot)<br />\n<br />\n<span style=\"font-weight: bold;\">Kappa (K)</span><br />\nHuixin Z.<br />\nHenry Li<br />\nClark I.<br />\nEugenia K.<br />\nDavid Y.<br />\nJulia L.<br />\n<br />\n<span style=\"font-weight: bold;\">Mu (M)</span><br />\nDavid P.<br />\nNikhil B.<br />\nDaniel W.<br />\nDaehyun K.<br />\nTim Z.<br />\nAllison B.<br />\n<br />\nA few notes about this. First of all, in making the last three teams, we attempted to approximately balance them without rankings as in the first two. Second, the letter in parentheses corresponds to the short name of the team. For example, if you\'re in team Lexington Beta, your short team name is Lexington B.<br />\n<br />\nIf there are any changes in plans that prevent you from going or if you would like to go, please let us know. If you are one of the latter, we may not be able to guarantee that you can go (despite the fact that there is quite noticeably a blank spot in team Epsilon right now), but we can try.<br />\n<br />\nAgain, the date is Saturday, November 12th.<br />\n<br />\nInformation on logistics and whatnot will be sent soon.<br />\n<br />\nIf there are errors and such, please let us know.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("28","21","2011-11-08 22:10:00","HMNT: Part Two","Part one should be available in the messages section on the website (lhsmath.org), this contains all the teams for HMNT.<br />\n<br />\nThe schedule for HMNT is available <a href=\"&quot;http://web.mit.edu/hmmt/www/datafiles/schedules/2011-november.shtml&quot;\" target=\"_blank\">here</a>.<br />\n<br />\nNow, a word or a few on carpools. We currently have 29 competitors going to HMNT at this moment, and only 8 rides to and from MIT, which means we still need 21 each way. <br />\n<br />\nIf your parents are able to send people to HMNT or back (or both), please email us (captains@lhsmath.org) with how many people (including yourself) you can take. If you are going on your own, let us know as well. If we do not have enough rides, then the organized carpools will be called off and everyone will need to find their way to MIT to compete. The deadline for this will be <span style=\"font-weight: bold;\">Thursday 11:59 PM</span> (sorry for the short notice, this may be extended a little bit if we think we can organize the carpools quickly enough and/or we\'re very close to accommodating everyone).<br />\n<br />\nSchedule wise, assuming the carpools are arranged, we will meet up at the front of the school and be off towards MIT around 7:15 AM (carpooling groups may leave the school as soon as everyone in the group is present). The competition is scheduled to end around 5:15 PM although they tend to run a bit over. At that time, carpool groups should get together and head back (this is pretty self-explanatory).<br />\n<br />\nSome other things to note: We will not be getting free lunch or HMNT provided lunch, so remember to bring some money or a lunch. In addition, remember writing utensils (a good thing to have for math competitions) and various other competition materials.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("29","21","2011-11-08 22:12:02","HMNT: Part 2.1","The link to the schedule should actually be <a href=\"http://web.mit.edu/hmmt/www/datafiles/schedules/2011-november.shtml\" target=\"_blank\">this</a>");
INSERT INTO messages VALUES("30","21","2011-11-09 22:21:05","HMNT: Rides Update","At the moment, we have <span style=\"font-weight: bold;\">21/29</span> of the rides we need (both ways).<br />\n<br />\nTo copy paste from the previous message:<br />\nIf your parents are able to send people to HMNT or back (or both), please email us (captains@lhsmath.org) with how many people (including yourself) you can take. If you are going on your own, let us know as well. If we do not have enough rides, then the organized carpools will be called off and everyone will need to find their way to MIT to compete. The deadline for this will be Thursday 11:59 PM.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("31","21","2011-11-10 22:46:11","HMNT: Rides Update 2","At this point, we have enough rides! Details on carpool groups in the near future.<br />\n<br />\nFor those looking for an address: 77 Massachusetts Avenue will get you to Lobby 7, which is directly connected to Lobby 10, the registration site and where useful signs are (there are probably useful signs in Lobby 7 as well, directly peoples to Lobby 10). We will be meeting at LHS (front entrance) around 7:00 to 7:15 AM and people will go with their carpool groups to HMNT.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("32","21","2011-11-11 15:11:51","HMNT: Rides","The following is the list of carpool groups for HMNT tomorrow. If you will be sending people both to MIT and back home, make sure you look over both the group going to MIT and the group coming back because they may be different.<br />\n<br />\nWe will be meeting at the main entrance at 7:15 in the morning. HMNT will be in MIT, registration at Lobby 10. Lobby 7 is located at 77 Massachusetts Avenue and is directly connected to Lobby 10. You will need some money (10 to 15 dollars is pretty safe) for lunch, or alternatively you can just bring a lunch, and writing utensils for test taking.<br />\n<br />\nGroup leaders (people whose parents are driving) need to check in with Alan upon arriving at MIT to let us know that you\'re there. In addition, you need to check out with him before leaving so that we know you didn\'t just disappear. In each grouping below, the first person will be having their parents drive. <br />\n<br />\nIf there are any errors in the below list (parents can\'t drive, wrong person driving, can\'t fit that many people, not on the list, on the list multiple times, etc.) let us know ASAP so that it can be fixed.<br />\n<br />\n<br />\n<span style=\"text-decoration: underline;\">Both Ways</span><br />\nJulia Sun<br />\nCelina Hsieh<br />\n<br />\nNick Zhang<br />\nHuixin Zhang<br />\n<br />\nBenjamin Tidor<br />\nZach Polansky<br />\n<br />\n<br />\n<span style=\"text-decoration: underline;\">Only Going To HMNT</span><br />\nAditya Gopalan<br />\nShashwat Patel<br />\nDavid Papp<br />\n<br />\nAlan Zhou<br />\nPeijin Zhang<br />\nHao Shen<br />\nDarwin Ding<br />\n<br />\nVictor Zhang<br />\nSuchith de Silva<br />\nDaehyun Kim<br />\nNikhil Bajaj<br />\nAllison Bukys<br />\nTim Zhu<br />\n<br />\nNoah Golowich<br />\nAndrew Kuida<br />\nHenry Li<br />\nCharles Li<br />\n<br />\nDaniel Wang<br />\nJulia Leung<br />\nEugenia Kim<br />\nClark Ikezu<br />\nDavid Yuan<br />\nAlan Qiu<br />\n<br />\nSurya Bhupairaju<br />\n<br />\n<br />\n<span style=\"text-decoration: underline;\">Only Coming From HMNT</span><br />\nAlan Zhou<br />\nPeijin Zhang<br />\nHao Shen<br />\nSurya Bhupatiraju<br />\n<br />\nVictor Zhang<br />\nSuchith de Silva<br />\nAditya Gopalan<br />\nShashwat Patel<br />\nDaehyun Kim<br />\nNikhil Bajaj<br />\n<br />\nNoah Golowich<br />\nHenry Li<br />\nCharles Li<br />\nDarwin Ding<br />\n<br />\nDaniel Wang<br />\nDavid Papp<br />\nEugenia Kim<br />\nClark Ikezu<br />\nDavid Yuan<br />\nAlan Qiu<br />\n<br />\nKevin Wen<br />\nAndrew Kuida<br />\nJulia Leung<br />\nTim Zhu<br />\nAllison Bukys");
INSERT INTO messages VALUES("33","21","2011-11-13 16:19:01","Practice 11/14/11","Hello everyone,<br />\n<br />\nTomorrow we will be talking about logarithms and their basic properties. There is a handout on the website in the files section, which you may read if you so choose.<br />\n<br />\nAfterwards, we will be doing MML rounds, namely<br />\n4: Log and Exponential Functions<br />\n5: Ratio, Proportion, or Variation<br />\n6: Polygons (no areas)<br />\n<br />\nFor those of you that took home an HMNT team award, please bring that in to room 800 on Monday (just before school starts is probably the best time).<br />\n<br />\nIf you are participating in the team contest, then under your <a href=\"http://www.lhsmath.org/My_Scores\" target=\"_blank\">scores</a> on the website you should have a score of 1 under InTeamContest. If you wish to participate in the team contest but do not have a score of 1 on InTeamContest, then let us know at captains@lhsmath.org (if you do this too late, then you may not have a spot on a team unless someone else drops).<br />\n<br />\nFor the team contest, the participants will be divided into 6 hopefully approximately equal teams (which will be posted either tonight or announced tomorrow in practice). After the MML rounds are done tomorrow, we will have the problems for the first team contest (or at least some of them) and allow you guys to meet up with your teams to exchange contact info and/or start working and/or whatever else.<br />\nThe actual team contest will be two weeks after tomorrow, the 28th. It is expected to go until 4 or 4:15 ish, so plan accordingly.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("34","21","2011-11-14 22:02:22","NEML 2 Reminder","A shameless copy-paste is appropriate here<br />\n<br />\nThis is a reminder that the second NEML of the year is tomorrow after school in room 800. We will attempt to get started as soon as possible (somewhere between 2:35 and 2:40 normally), so try to show up before then.<br />\n<br />\nAny calculator that doesn\'t have a QWERTY keyboard is acceptable. The test will be 30 minutes long and have 6 questions.<br />\n<br />\n~ The Captains");
INSERT INTO messages VALUES("35","20","2011-11-16 08:16:01","HMNT Survey","If you have gone to the HMNT, please feel free to fill out the survey found at www.web.mit.edu/hmmt/www/. It would really help the creators of this event get a sense of how good the problems were and how they could improve on them, especially since the HMNT is a relatively new event.");
INSERT INTO messages VALUES("37","21","2011-11-16 20:40:57","Addendum","Disregard the previous email unless you really needed a second reminder.");
INSERT INTO messages VALUES("38","21","2011-11-20 14:54:00","Practice 11/21/11 and Team Contest 1","Hello everyone,<br />\n<br />\n- Nothing math-wise really goes on this week (and there\'s Thanksgiving)<br />\n- <span style=\"font-weight: bold;\">Lecture: Laws of Sines and Cosines</span><br />\n-- There is a handout in the files section if you want to read<br />\n-- This lecture takes what we\'ve done with trig and goes in the more geometric direction. Later in the year we\'ll be talking about a way to extend trig algebraically (with a lot of handwaving).<br />\n- <span style=\"font-weight: bold;\">MML Rounds</span><br />\n-- Round 1: Trigonometry: Right angle problems, Laws of Sine and Cosine<br />\n-- Round 2: Elementary Number Theory/Arithmetic<br />\n-- Round 3: Coordinate Geometry of Lines and Circles<br />\n- <span style=\"font-weight: bold;\">CMT: Circle Geometry</span><br />\n-- No, we didn\'t forget completely.<br />\n-- There are problem sets online (files section). If you are interested, you should work on them. They are (mostly) good problems.<br />\n<br />\nSome words on team contest. <br />\n- The team contest will take place on the 28th at our usual math team meeting time and will run probably until 4:15 give or take 10 minutes. <br />\n- The problems are up in the files section (yes, all of them). Any questions about clarifications and stuff should be sent to us (be specific about what is confusing/ambiguous).<br />\n- Problem order was random.org\'d, so don\'t expect problem 1 to be easier than problem 15 just because problem 1 is before problem 15, for example.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("39","21","2011-11-25 10:28:53","HMNT Results","First off, team contest in approximately 76 hours<br />\n<br />\nSecond, HMNT results are in: if you would like them, e-mail the captains (captains@lhsmath.org, still) to get them.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("40","21","2011-11-27 13:39:53","Practice 11/28/11","The first team contest of the year will be tomorrow. Unless you have a good excuse for not coming that you tell us about (and hopefully your team), your team will take a 0 on a problem during your turn (or maybe an alternative that is slightly less harsh). If you have not looked at the problems yet, they\'re up on the website in the files section.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("41","21","2011-11-28 18:05:35","MML Teams 12-1-11","The teams for the third MML meet at Acton-Boxboro on Thursday, December 1st are<br />\n<br />\nRegulars<br />\nAlan Zhou<br />\nJason Li<br />\nKevin Wen<br />\nAmy Zhang<br />\nJonathan Tidor<br />\nHao Shen<br />\nZach Polansky<br />\nAndrew Kuida<br />\nPeijin Zhang<br />\nDan Kim<br />\n<br />\nAlternates<br />\nAlex Sekula<br />\nNoah Golowich<br />\nSurya Bhupatiraju<br />\nHenry Li<br />\nAditya Gopalan<br />\nCelina Hsieh<br />\nSuchith De Silva<br />\nTanmay Khale<br />\nCharles Li	<br />\nShohini Stout<br />\n<br />\nIf you are in the above list, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we have adequate time to find a replacement.<br />\n<br />\nRegulars, please select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Trigonometry: Right angle problems, Laws of Sine and Cosine<br />\nRound 2: Elementary Number Theory/Arithmetic<br />\nRound 3: Coordinate Geometry of Lines and Circles<br />\nRound 4: Algebra 2: Log &amp; Exponential Functions<br />\nRound 5: Algebra 1: Ratio, Proportion or Variation<br />\nRound 6: Plane Geometry: Polygons (no areas)");
INSERT INTO messages VALUES("42","21","2011-11-30 16:57:46","MML Reminder 12-1-11","If you are going to the MML meet tomorrow, please remember to be at the front entrance at 2:30 PM (and then be at the front entrance at 2:30 PM!).<br />\n<br />\n~ Captains<br />\n<br />\n(shameless copy-paste)");
INSERT INTO messages VALUES("43","21","2011-11-30 17:00:24","Addendum","Information on the MML meet tomorrow is in the messages section <a href=\"http://www.lhsmath.org/Messages?View=41\" target=\"_blank\">here</a>.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("44","21","2011-12-01 22:09:16","Mandelbrot Reminder","As the title suggests, this is a reminder that Mandelbrot is scheduled to be tomorrow in room 800 after school.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("45","21","2011-12-04 10:36:57","12-5-11 Math Team","The team contest is (actually) in about 28 hours. That is all.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("46","21","2011-12-05 20:46:29","GBML 12-7-11","Teams for the third GBML meet at Belmont on Wednesday, December 7th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nAlan Zhou<br />\nKevin Wen<br />\nAmy Zhang<br />\nJonathan Tidor<br />\nNoah Golowich<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nJason Li<br />\nAndrew Kuida<br />\nRohil Prasad<br />\nAditya Gopalan<br />\nPeijin Zhang<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nSurya Bhupatiraju<br />\nCharles Li<br />\nZach Polansky<br />\nDavid Yuan<br />\nShohini Stout<br />\nTanmay Khale<br />\nClark Ikezu<br />\nDan Kim<br />\nHenry Li<br />\nBen Tidor<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1	   Algebra 1	   Fractions and Word Problems<br />\nRound 2	   Coordinate Geometry of the Straight Line	   <br />\nRound 3	   Geometry	   Polygons: Area and Perimeter<br />\nRound 4	   Algebra 2	   Logs, Exponents, Radicals and equations involving them<br />\nRound 5	   Trigonometric Analysis and Complex Numbers in Trigonometric form");
INSERT INTO messages VALUES("47","21","2011-12-06 18:15:13","GBML Reminder","The title somewhat says it all. It is tomorrow. If you are a regular or alternate and have not told us that you can\'t go, you should be present at the front entrance at 2:30.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("48","21","2011-12-12 14:14:48","Math Team 12-12-11 (Uber Late)","Today in practice, we shall do more MML rounds (surprise, surprise). They will be rounds 1,3,4,5 for meet 4, so it\'s something like analytic geometry, trig equations, quadratics, and plane geometry. Feel free to look it up on mmleague.net if that seems vague.<br />\n<br />\nTomorrow (Tuesday) is the 3rd NEML right after school, you should be there. DOE peoples, the NEML is only 30 minutes so you won\'t really miss anything (but make every effort to get to DOE as on time as possible without sabotaging your NEML score).<br />\n<br />\nNext week, there shall be alumni. Alumni talk about stuff. If I felt like typing up more at the moment, I would, but this will do for now. But you should be there as well.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("49","21","2011-12-12 21:05:49","NEML and MAML","First off, NEML is tomorrow right after school in room 800.<br />\n<br />\nThe MAML Level 1 <a href=\"http://www.wocomal.org/statistics/olympiad/201112/201112o_level1.html\" target=\"_blank\">top scores</a> are up (for those of you that don\'t remember, this was a 25 question multiple choice test we took back in October).<br />\n<br />\nThe top Lexington scorers are listed here. See the preceding link for details on score and also in the event that I missed somebody in the list.<br />\n<br />\n<span style=\"text-decoration: underline;\">Finalists (16)</span> (Advance to Level 2 test)<br />\nAlan Zhou<br />\nKevin Wen<br />\nJonathan Tidor<br />\nJason Li<br />\nNoah Golowich<br />\nPeijin Zhang<br />\nHenry Li<br />\nRohil Prasad<br />\nSurya Bhupatiraju<br />\nAndrew Kuida<br />\nHao Shen<br />\nAmy Zhang<br />\nAllison Bukys<br />\nBenjamin Tidor<br />\nMatt Arbesfeld<br />\nZach Polansky<br />\n<br />\n<span style=\"text-decoration: underline;\">Semifinalists (8)</span> (Listed, but do not qualify for the Level 2 test)<br />\nTanmay Khale<br />\nDan Kim<br />\nDavid Papp<br />\nAlan Qiu<br />\nClark Ikezu<br />\nAlex Sekula<br />\nDaniel Wang<br />\nDavid Yuan");
INSERT INTO messages VALUES("50","21","2011-12-18 16:57:37","Alumni","Tomorrow will be the math team alumni reunion. What this basically is is a chance for you to meet and get to know math team members from prior years and have since graduated. If you have any questions, you should come prepared to ask them. The alums will (probably) be talking about life in college or their experience with the LHS math team, potentially with a little bit of extra stuff.<br />\n<br />\nIn regards to questions, this is not the time to ask questions such as &quot;does math team increase my chances of getting into college&quot; or &quot;what should I do to get into MIT&quot;. There are plenty of other times and places for these types of questions. However, any other questions about college, math, science, or stuff on-topic if they choose to diverge from the original topics are fine.<br />\n<br />\nHope to see you all tomorrow,<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("51","21","2012-01-04 14:55:31","MML Teams 1-5-12","Hello everyone, hope you\'ve had a nice vacation <br />\n<br />\nThe teams for the fourth MML meet at Winchester on Thursday, January 5th are<br />\n<br />\nRegulars<br />\nAlan Zhou<br />\nJason Li<br />\nKevin Wen<br />\nAmy Zhang<br />\nAndrew Kuida<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nHao Shen<br />\nPeijin Zhang<br />\nRohil Prasad<br />\n<br />\nAlternates<br />\nZach Polansky<br />\nShohini Stout<br />\nAditya Gopalan<br />\nDan Kim<br />\nSurya Bhupatiraju<br />\nTanmay Khale<br />\nAlan Qiu<br />\nCelina Hsieh<br />\nDaehyun Kim<br />\nHenry Li<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Analytic Geometry: Anything<br />\nRound 2: Algebra 1: Factoring and/or equations involving factoring<br />\nRound 3: Trigonometry: Equations having a reasonable number of solutions<br />\nRound 4: Algebra 2: Quadratic Equations/Quadratic Theory<br />\nRound 5: Geometry: Similarity of Polygons<br />\nRound 6: Algebra 1: Anything<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("52","21","2012-01-09 06:40:16","Today...","we will be discussing the infamous conic sections.<br />\n<br />\nThen, a bunch of GBML rounds. Specifically, four of them. They are whatever rounds 2,3,4,5 are.<br />\n<br />\nRound 1	   Volume and Surface Area of Solids<br />\nRound 2	   Inequalities and Absolute Value<br />\nRound 3	   Similar Polygons, Circles and Areas Related to Circles<br />\nRound 4	   Sequences and Complex Numbers<br />\nRound 5	   Conic Sections<br />\n<br />\nLater this week:<br />\n<br />\nNEML number 4 (?) on Tuesday, be there around like 2:30 ish<br />\n<br />\nGBML is on Wednesday, and unlike the MML last week, we would like to not release the teams the day before, that means you either have to be at practice today or let us know so we can get you a copy of rounds, although you should really pick up a copy anyways<br />\n<br />\nMandelbrot on Friday, I forget what number this is but yeah, show up at 2:30 ish<br />\n<br />\nIt is also recommended you start thinking about writing middle school level math problems, unless there is something better for you to be thinking about<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("53","21","2012-01-09 20:29:11","Poke","This is a reminder to those that intend to go to GBML on Wednesday but haven\'t turned in all the rounds yet to do the rounds (unless I specifically told you otherwise).<br />\n<br />\nThat is all.");
INSERT INTO messages VALUES("54","21","2012-01-10 19:03:15","GBML Teams 1-11-12","Teams for the fourth GBML meet at Arlington on Wednesday, January 11th.<br />\n<br />\nAlpha<br />\nAlan Zhou<br />\nJason Li<br />\nAmy Zhang<br />\nJonathan Tidor<br />\nHao Shen<br />\n<br />\nBeta<br />\nKevin Wen<br />\nNoah Golowich<br />\nAndrew Kuida<br />\nZach Polansky<br />\nPeijin Zhang<br />\n<br />\nAlternates<br />\nBen Tidor<br />\nNick Zhang<br />\nCelina Hsieh<br />\nSuchith De Silva<br />\nTanmay Khale<br />\nClark Ikezu<br />\nHenry Li<br />\nShohini Stout<br />\nAditya Gopalan<br />\nDan Kim<br />\n<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1	   Volume and Surface Area of Solids<br />\nRound 2	   Inequalities and Absolute Value<br />\nRound 3	   Similar Polygons, Circles and Areas Related to Circles<br />\nRound 4	   Sequences and Complex Numbers<br />\nRound 5	   Conic Sections");
INSERT INTO messages VALUES("55","21","2012-01-14 17:30:35","Week of 1-15 to 1-21","Due to the holiday on Monday, there is no practice during the week. There are also no events that we are aware of.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("56","19","2012-01-18 21:34:25","Lexington Math Tournament","Hey mathletes,<br />\n<br />\nIn case you didn\'t know, the Lexington HS math team hosts a math tournament called Lexington Math Tournament (LMT), designed for middle-school students, every year in the spring. The LMT this year will likely be held at the end of March. The LMT website is &lt;www.lhsmath.org/LMT&gt;.<br />\n<br />\nBut in order to open up LMT, we need to make up math problems. This will be a team effort, and everyone is free to contribute. I (Jason) will be in charge of managing the problems this year, so if you have any math problems you would like to share, feel free to send them to me by email (jasonmli02@gmail.com). I will be selecting problems from those that are sent to me (and my own problems as well) and ordering them in approximate difficulty.<br />\n<br />\nKeep in mind that LMT is a middle-school competition, so the material in the competition should be restricted to Mathcounts-level math. This means no trig, calculus, or conic sections (but circles are fine). You are still welcome to submit hard problems as long as they can be solved with techniques used in Mathcounts. You can go on the LMT website and view problems from previous years to get a sense of the nature of the problems.<br />\n<br />\nAt the moment, please only send short-answer problems (no proof-type problems). Please DO NOT take problems from other sources, no matter how obscure the sources are. The selected short-answer problems will appear on the individual round and the guts round, and maybe on the theme round.<br />\n<br />\nI hope that we can have all the short-answer problems ready by the beginning of March. So if you would like to contribute to writing problems for LMT, you should start thinking about creating math problems soon. Keep in mind that preparing for the LMT is not something that we should hold off until the last week/day. After all, why procrastinate on something you enjoy doing? :)<br />\n<br />\n~ The Captains");
INSERT INTO messages VALUES("57","21","2012-01-22 16:15:01","Stuffs","Tomorrow we will be having our last lecture* of the year, which will be on Circles. The lecture is available in the Files section.<br />\n<br />\nAfterwards, we will be doing the following MML rounds<br />\n-Algebra 2: Algebraic Functions (1)<br />\n-Elementary Number Theory/Arithmetic (2)<br />\n-Trigonometry: Identities and/or Inverse Functions (3)<br />\n-Plane Geometry: Circles (5)<br />\n<br />\nJason already covered basically everything necessary to say about LMT problems. The tentative date is the 17th of March, which is about 2 weeks early and gives us about 2 months from this point (the 24th and 31st of March apparently were reserved very early, the 7th of April is Easter, and the 14th and 21st of April are the break weekends).<br />\n<br />\nWe promised <a href=\"http://collaborativemathtraining.net46.net/\" target=\"_blank\">CMT</a> earlier this year.<br />\n<br />\n* This does not account for what we call &quot;guest lectures&quot; later in the year or any random lectures we may feel like doing.");
INSERT INTO messages VALUES("58","21","2012-01-31 13:53:36","MML Status","The teams are currently not out due to the currently unsure status of the first round of physics olympiad (I think?)<br />\n<br />\nThat is all");
INSERT INTO messages VALUES("59","21","2012-01-31 22:12:09","MML Teams 2-2-2012","The assumption is that seniors are out because of physics, so...<br />\n<br />\nThe teams for the fifth MML meet at Lincoln-Sudbury on Thursday, February 2nd are<br />\n<br />\nRegulars<br />\nSurya Bhupatiraju<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nDan Kim<br />\nZach Polansky<br />\nShohini Stout<br />\n<br />\nAlternates<br />\nDavid Papp<br />\nHenry Li<br />\nJack Deschler<br />\nCelina Hsieh <br />\nDaniel Wang<br />\nAditya Gopalan<br />\nAlan Qiu<br />\nNick Zhang<br />\nYoonji Kim<br />\nDaehyun Kim<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Algebra 2: Algebraic Functions<br />\nRound 2: Elementary Number Theory/Arithmetic<br />\nRound 3: Trigonometry: Identities and/or Inverse Functions<br />\nRound 4: Algebra 1: Word Problems<br />\nRound 5: Plane Geometry: Circles<br />\nRound 6: Algebra 2: Sequences and Series");
INSERT INTO messages VALUES("60","21","2012-02-02 11:21:40","MML Reminder","This is a reminder for those of you that actually manage to check your email between now and the meet that if you are on the list for people going to MML, the meet is today after school.");
INSERT INTO messages VALUES("61","21","2012-02-02 20:32:07","Mandelbrot Reminder","The title is pretty self-explanatory, it is tomorrow in room 800 right after school and will run for 40 minutes.");
INSERT INTO messages VALUES("62","21","2012-02-06 05:39:50","Week of 2-5 to 2-11","... Sent on February 6th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Monday</span><br />\n<br />\nGBML Rounds. This is the last GBML meet of the year, and it features what is sometimes called the trip through high school. Why? We\'ll let the rounds speak for themselves.<br />\nRound 2	   Algebra 1	   Open<br />\nRound 3	   Geometry	   Open<br />\nRound 4	   Algebra 2	   Open<br />\nRound 5	   Precalculus	   Open<br />\n<br />\nAlso try to have your AMC forms for practice if you did not already give them to Mr. Roos. If you can\'t, don\'t worry that much about it, at the very least make sure your teachers know.<br />\n<br />\n<span style=\"text-decoration: underline;\">Tuesday</span><br />\n<br />\nThis is the day of the AMC 10/12 A. It will be in the Science Lecture Hall. Please try to arrive around 7:30 AM so that we can start at 7:45 AM and you have time to fill out all the bubbly things. Getting more sleep than is typical in this school is highly recommended. You will be excused from D and B blocks.<br />\n<br />\n<span style=\"text-decoration: underline;\">Wednesday</span><br />\n<br />\nThe GBML meet at Canton. As per usual, we meet outside the main entrance after school, get on a bus, and go on a bit of a road trip.");
INSERT INTO messages VALUES("63","21","2012-02-06 17:32:04","GBML Teams 2-7-12","Teams for the fifth GBML meet at Canton on Wednesday, February 7th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nAlan Zhou<br />\nJason Li<br />\nKevin Wen<br />\nJonathan Tidor<br />\nNoah Golowich<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nAmy Zhang<br />\nAlan Qiu<br />\nAndrew Kuida<br />\nHao Shen<br />\nSurya Bhupatiraju<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nHenry Li<br />\nBen Tidor<br />\nCelina Hsieh<br />\nCharles Li<br />\nDan Kim<br />\nZach Polansky<br />\nJack Deschler<br />\nNick Zhang<br />\nTanmay Khale<br />\nYoonji Kim<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1	 Arithmetic<br />\nRound 2	 Algebra 1<br />\nRound 3	 Geometry<br />\nRound 4	 Algebra 2<br />\nRound 5	 Precalculus");
INSERT INTO messages VALUES("64","21","2012-02-07 19:15:44","GBML Reminder","This is a reminder that the last GBML meet of the year is tomorrow after school.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("65","21","2012-02-13 22:31:13","NEML","The NEML is tomorrow after school in room 800.");
INSERT INTO messages VALUES("66","21","2012-02-20 13:13:20","AMC 10/12 B","For those of you who are in the area and want to take the AMC B, it is on Wednesday in the science lecture hall. We intend to start by 8 AM so it would do you good to show up somewhere between 7:30 and 7:45 AM for all the bubbling stuff. The test itself is 75 minutes long.<br />\n<br />\nNote: we cannot say we are guaranteed to have enough tests. In other words, if you show up late (late meaning probably after 7:45) you may* not have a chance to take the test since our ability to conjure forms and tests out of nowhere is less than proficient.<br />\n* Not super likely, but possible, also more applicable to the AMC 10 than the 12<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("67","19","2012-02-21 12:31:45","LMT problems status","Hey guys,<br />\n<br />\nWe currently have 35 problems out of the required 78 short-answer problems needed for LMT. The majority of these lean towards the hard side, so we could do with some easy-to-ridiculously-easy problems. Don\'t feel hesitant to send easy problems; they are just as needed for the contest as harder ones. As all of you are on break, keep your mind open to math problems and when a problem comes into your mind, don\'t hesitate to jot it down on paper or computer. Once you\'ve come up with some problems, feel free to send them to me (jasonmli02@gmail.com) and I\'ll add them into the ongoing collection. Remember, the LMT is a collective effort and every one of your contributions counts. Thanks!<br />\n<br />\nP.S. In case you forgot, the AMC 10/12B will be held tomorrow. Please be there by 7:45 AM.");
INSERT INTO messages VALUES("68","21","2012-02-29 01:01:45","MML Teams 3-1-12","The teams for the sixth and final MML meet at Canton on Thursday, March 1st are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nAndrew Kuida<br />\nJason Li<br />\nAmy Zhang<br />\nSurya Bhupatiraju<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nBenjamin Tidor<br />\nHenry Li<br />\nAditya Gopalan<br />\nKyuil Lee<br />\nCelina Hsieh<br />\nDan Kim<br />\nShohini Stout<br />\nEric Hsu<br />\nDaniel Wang<br />\nTanmay Khale<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Algebra 2: Simultaneous Equations and Determinants<br />\nRound 2: Algebra 1: Exponents and Radicals<br />\nRound 3: Trigonometry: Anything<br />\nRound 4: Algebra 1: Anything<br />\nRound 5: Plane Geometry: Anything<br />\nRound 6: Probability and Binomial Theorem<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("69","21","2012-03-01 08:53:22","MML","So the meet is (as far as we know which is about as close to official as possible) postponed until next week, the 8th of March.<br />\n<br />\nOh, and regulars, more of you guys should send in round choices.");
INSERT INTO messages VALUES("70","21","2012-03-07 23:04:18","MML 6 Reminder","This is a reminder that the sixth MML meet at Canton is tomorrow and that if you are going, you are to be at the front of LHS by 2:30 ish despite the half day.");
INSERT INTO messages VALUES("71","21","2012-03-18 11:17:56","3-19-12","Hello everyone,<br />\n<br />\nLast Thursday was the AIME I, so tomorrow we\'ll be holding an AIME post-mortem, where you guys get to present solutions to problems (from the AIME I of course).<br />\n<br />\nIf you would like to present, e-mail the captains (captains@lhsmath.org) with your requests <span style=\"font-style: italic;\">starting from the one you most want to present</span>. Requesting closes at 11:59 PM.<br />\n<br />\nWe then have one more round for the state meet afterwards.");
INSERT INTO messages VALUES("72","34","2012-03-25 12:56:42","Monday Practice","Hey everyone,<br />\n<br />\nWe\'ve already finished up 6 state rounds for tryouts to the state meet, so this week we\'ll be doing something fun at math team (not that state rounds aren\'t fun of course).<br />\n<br />\nWe\'ll be hosting a small math tournament of sorts. It\'ll mostly be the same as Mathcounts Countdown rounds. If you don\'t know how those work basically you\'re faced up against some other person, and questions appear before you. You have 45 seconds after the question is read in its entirety to buzz in and answer. No aids other than scratch paper and pencil can be used. <br />\n<br />\nHere\'s how the tournament is going to work. We\'ll split you guys into 4 groups, and each group will compete in a round. First two players who get 4 questions answered correctly move on to the brackets. Brackets will be best of 9 format, single elimination and the finals will be best of 13. Winner will get a <span style=\"font-style: italic;\">fabulous</span> prize. Hopefully we\'ll be able to finish by around 4~4:30 or so.<br />\n<br />\nEveryone is welcome to join, bring your non-math team friends, the more the merrier. If you\'d like to join it\'d be helpful if you could send me an email (just reply to this one, it shouldn\'t send to all like the yahoo group used to) stating that you\'ll be coming. We\'d like to get a rough estimate of how many people will show up and start forming groups.<br />\n<br />\nSee you on Monday!<br />\n");
INSERT INTO messages VALUES("73","21","2012-03-31 23:44:51","State Meet (Very Late Notice)","The team for the state meet is<br />\n<br />\nJason Li<br />\nKevin Wen<br />\nAmy Zhang<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nJonathan Tidor<br />\nNoah Golowich<br />\n<br />\n<br />\nThe state meet is this coming Monday, the 2nd, we\'ll be leaving at around 11 AM or something, not completely sure what the exact time is yet (will be sent as soon as possible).<br />\n<br />\nIf you\'re on the team, select the three categories you would like to do at the meet from the six below and send your preferences to the captains.<br />\n<br />\nRound 1: Arithmetic and Number Theory<br />\nRound 2: Algebra 1<br />\nRound 3: Geometry<br />\nRound 4: Algebra 2<br />\nRound 5: Analytic Geometry<br />\nRound 6: Trig and Complex Numbers<br />\n<br />\n<br />\nThere will be no meeting on Monday as a result of the state meet.");
INSERT INTO messages VALUES("74","19","2012-04-08 12:54:12","April schedule","Hi everyone,<br />\n<br />\nOn Monday, 4/9, we will be handing out rounds to select the team for the New England math meet. Like the state meet, the New England meet will have rounds scored in the same way as those of the GBML (in 1/2/3). The Monday after that will also be dedicated to rounds. Afterwards, we will have non-captain lectures, so if you would like to give out one, please tell us beforehand. (Except for Zach--you\'re welcome to present yours on 4/23).<br />\n<br />\nAlso, Jason will be giving out a lecture next practice (4/9) on generating functions. No advanced math knowledge is required for this lecture, so anyone is free to come! We will be finding explicit formulas for functions and sequences (such as the Fibonacci sequence).<br />\n<br />\nFinally, there is one month before the LMT takes place. You can continue to send us problems, but you can also volunteer to review and comment on any drafts of rounds that we currently have. Email me if you would like to volunteer as a reviewer. Of course, in doing so, you are making a pledge to not reveal any of the problems to middle-schoolers. We will have other jobs soon, such as making signs, recruiting schools, and doing the paperwork.<br />\n<br />\n~ the captains");
INSERT INTO messages VALUES("75","19","2012-04-09 20:24:20","4/9 lecture - online textbook","A lot of people had to leave early, so if you left in the middle of a problem and want to know the end result, you can read the online textbook that I based my lecture off of: http://www.math.upenn.edu/~wilf/gfologyLinked2.pdf<br />\n<br />\nThe Fibonacci problem was 1.3 and the partitions was 1.6. Note that textbooks can be harder to follow because they are much more concise in their solutions.");
INSERT INTO messages VALUES("76","34","2012-04-22 00:13:48","Purple Comet Math Competition","So guys we\'re not planning on running rounds this Monday. Apparently there will be rounds going online and you\'ll need to submit answers through email (Alan will clarify sometime later). <br />\n<br />\nSo instead we\'re going to be doing this online math contest, called Purple Comet.<br />\n<br />\nhttp://purplecomet.org/home/show/detailsrules<br />\n<br />\nBasically an up to 6 person team (could be less than 6) gets 90 minutes to solve a series of problems. IIRC it\'s around 15~20 and the questions range from easy to maybe first few AIME question level. Should be fun. Show up with a premade team or just show up anyways and we can form teams for you. Tell your friends! We should be done by say 4:30 at the latest.<br />\n<br />\nAlternatively you could listen to lectures. I hear through the math team grapevine that non-captain lectures could start early (this week perhaps if anyone is up for it), so if you have something you\'d like to lecture about you could come in and talk about it, or if you don\'t have something right now but would like to that\'s OK too. Lecture times will run to the end of the school year, so whenever you\'re ready. Topics can be on anything you want that\'s math related. Send an email to Alan if you\'d like to give a talk.<br />\n<br />\nShow up to practice on Monday. It\'ll be fun. Pinky promise.");
INSERT INTO messages VALUES("77","21","2012-04-22 22:37:11","Update on Tomorrow\'s Meeting","Rounds 2, 3, 5, and 6 for the New England meet on Friday are online in the Files section of the website. If you do them, email your answers to captains@lhsmath.org by Tuesday at 6:28 PM. Hard copies will also be available tomorrow.<br />\n<br />\nAs mentioned, we will be doing the Purple Comet. Details are in the <a href=\"http://www.lhsmath.org/Messages?View=76\" target=\"_blank\">previous message</a> and <a href=\"http://purplecomet.org/\" target=\"_blank\">their website</a>.<br />\n<br />\nNon-captain lectures will begin sometime in May, depending on the AP timing and stuff. If you are interested in giving a talk, email the captains with the topic of your lecture. Each lecture should last around 15 plus or minus 5 minutes. Presentations will be first come, first serve. One lecture is lined up already.");
INSERT INTO messages VALUES("78","21","2012-04-23 08:46:54","Correction","Round 3 Question 3<br />\n<br />\nFind the measure of angle QFE.");
INSERT INTO messages VALUES("79","21","2012-04-23 13:46:30","Another Correction","Round 3 Problem 3 AGAIN<br />\n<br />\nA, Q, P, E collinear <span style=\"font-style: italic;\">in that order</span>");
INSERT INTO messages VALUES("80","19","2012-04-30 18:11:57","LMT stuff!!","Hey everyone,<br />\n<br />\nThanks to all who participated in making the signs and doing the paperwork today. We were actually more productive than in the past two years I believe, finishing at just about 5PM - by the time I had left at 5PM in the past two years the paperwork still hadn\'t been complete - so great job everyone!<br />\n<br />\nNow for the more grave news: the LMT wasn\'t advertised enough this year. Last year, Hao and Surya did the honors of advertising the LMT at the state Mathcounts meet, but this didn\'t happen this year. Thus, we only have 10 teams signed up at the moment. In addition, a few schools that signed up last year did not this year, likely because this year\'s LMT is on a later date and because they didn\'t hear about it. <span style=\"text-decoration: underline;\">If you are in contact with other math team coaches from other schools, please let them know about the LMT. It\'s not too late for them to gather a team and sign up.</span><br />\n<br />\nOn the brighter side, this year\'s LMT will introduce a new event: the <span style=\"font-style: italic;\">mini-events</span>, like those during the HMM(N)T. In the past two years we have received complaints that the two-hour lunch break was too long, so allotting one hour of the lunch break to mini-events is the perfect solution. The only drawback is that the attention spans of middle-schoolers are considerably shorter than those of high-schoolers, so the events must be <span style=\"font-style: italic;\">exciting</span>. If you have an idea for a mini-event and/or would like to host a mini-event, please let the captains know! At the moment, we are considering a SET (card game) event and a DinoParmFish event.<br />\n<br />\nThat\'s all. See you all at LMT!");
INSERT INTO messages VALUES("81","20","2012-05-04 00:21:12","LMT Preparation!","Greetings,<br />\n<br />\nOkay so it\'s two days (one day?) until LMT. Since we want some time to set up the registration table, the distribution of jobs, and the putting up of signs, everyone please arrive at Commons 1 by 7:30 AM. The event should last until 4:30 PM.   Also note that the SAT\'s will be going on at the same time. Hopefully the registration for LMT and the SAT\'s won\'t intersect for very long. As of now, we are planning four mini events from 1 PM to 2 PM: Set, Fish, Origami, and Frisbee. If anyone has a full deck of cards, a Frisbee, a deck of Set cards, or some Origami paper, feel free to bring it to LMT. More info could be found in the LHS math team LMT website http://www.lhsmath.org/LMT/About. We hope to see you guys in two (one?) days!<br />\n<br />\nThe Captains, <br />\n<br />\nP.S. Ben Tidor or someone else, could you forward this email to all of the NHS volunteers?<br />\n<br />\nP.S.S. We\'ll have FREE pizza for all staffers! ");
INSERT INTO messages VALUES("82","21","2012-05-04 20:20:56","LMT - Final, Maybe","Things that need to get done<br />\n<br />\nTry to show up at 7:30 AM unless you have some conflict such as SATs<br />\nYou can volunteer at any time but don\'t be surprised if you get relegated to bouncing duties after sleeping in for two hours or something<br />\n<br />\n<span style=\"font-weight: bold;\">Money can only be handled by Kevin Wen or Mr. Roos</span><br />\nIf someone tries to give you money, redirect them to one of the aforementioned individuals (and do so kindly)<br />\n<br />\nWhen you arrive, it would be good to let us know whether or not you intend to proctor or grade just so we don\'t have imbalance<br />\n<br />\nHQ will be in room 143, what happens in HQ stays in HQ<br />\n<span style=\"font-weight: bold;\">That includes any mention or hints about lunch pizza</span><br />\n<br />\nYou should be aware of the schedule (http://www.lhsmath.org/LMT/Schedule)<br />\n<br />\nIf you\'re looking for hours of some sort, be sure to have the appropriate forms and talk to Mr. Roos at the end of the day, as opposed to a few weeks later<br />\n<br />\nTry to remember that there are many middle schoolers when you leave the &quot;safety&quot; of HQ so you don\'t do something insanely stupid<br />\n<br />\nIf I forgot something, expect another email");
INSERT INTO messages VALUES("83","34","2012-05-04 21:05:56","LMT Addendums","Staff:<br />\n<br />\nCheck in at 7:30. Head to HQ to get roles assigned. We\'ll need a couple of bouncers/proctors for the first few rounds and the rest of you will either be manning the welcome desk or grading.<br />\n<br />\n<span style=\"font-weight: bold;\">Important</span><br />\n<br />\nIf you have a LMT shirt from <span style=\"font-weight: bold;\">2011</span> (The red one) please wear it. If not, please either wear a <span style=\"font-weight: bold;\">red</span> T shirt, or bring $7 to buy one from the school.<br />\n<br />\nThat should be it for now. Any other information can be given out tomorrow.<br />\n<br />\n");
INSERT INTO messages VALUES("84","1","2012-05-04 21:37:05","LMT: Things to Bring","We\'re still looking for some things for the LMT tomorrow:<br />\n<br />\n* <span style=\"font-weight: bold;\">SET Cards.</span> If you have a deck, please email jonathan.tidor@gmail.com and bring it tomorrow.<br />\n<br />\n* <span style=\"font-weight: bold;\">Laptops.</span> It would be good if a few people brought their laptops, just in case we didn\'t get a cart.<br />\n<br />\n* <span style=\"font-weight: bold;\">Extension Cables.</span> If anyone could bring some in, that would be great.<br />\n<br />\n* Remember your T-shirt!");
INSERT INTO messages VALUES("85","21","2012-05-06 22:11:17","Math Team 5/7","Unless many of you take AP Psych or it invades our room, we\'ll be beginning guest lectures tomorrow.<br />\n<br />\nTo reiterate, these are ~15 minute lectures done by a non-captain (usually, it\'s more like captains just get last priority in the list) on some mathematical topic. If you would like to do a lecture, please e-mail the captains with the lecture topic and we\'ll add you to the queue as long as the topic isn\'t insane in some way.");
INSERT INTO messages VALUES("86","21","2012-05-20 21:36:24","5/21/12","Hello everyone,<br />\n<br />\nIn light of the Massachusetts victory at national MathCounts a week ago, we are bringing back a part of what used to be part of the USEMO at MOP. Namely, the 5-minute MathCounts sprint round.<br />\n<br />\nAdditionally, we have more lectures. Three (?) of them.<br />\n<br />\nThere is no meeting in 8 days due to Memorial Day.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("87","20","2012-05-28 16:44:39","NOSB Math Team Football Game","Hi y\'all,<br />\n<br />\nIn order to celebrate our highly successful year of Math Team, we\'ve decided to challenge our greatest academic rival in a game of sports! The Math Team and National Ocean Science Bowl team will both face off in our annual football game. Please be at the track field (next to the LHS tennis courts) at 1 PM on Saturday, June 2nd. Feel free to bring random assortments of footballs (nerf, peewee size, NFL size) and other things to throw (like Frisbees). This rivalry is unmatched to any other in LHS sports so everyone should come and crush NOSB to the ground like we did last year! In case a thunderstorm passes by we\'ll notify you guys ASAP if the game is cancelled. We hope to see you guys there!<br />\n<br />\nThe Captains");
INSERT INTO messages VALUES("88","20","2012-05-29 17:54:24","Team Colors","I forgot to mention that traditionally the math team wears green while NOSB wears blue. Don\'t worry if you don\'t have anything green; we\'ll still be able to identify you. However, we strongly advise against anyone wearing blue.");
INSERT INTO messages VALUES("89","20","2012-06-01 22:07:58","Football game status","Hi guys,<br />\n<br />\nEven though the forecast is 100% rain tomorrow, we talked to the NOSB team and agreed to still hold the game tomorrow! So don\'t be wimps and come play in the rain like real mathletes do. Of course, NOSB wants this game to happen tomorrow because the rain simulates their natural and optimal habitat (the ocean). If anyone forgot, it\'s 1 PM tomorrow at the LHS track field. I unfortunately will not be present because I sustained some serious and annoying injuries while playing basketball today. I hope all of you guys show up though!");
INSERT INTO messages VALUES("90","21","2012-06-04 00:28:35","Awards Ceremony Monday June 4 2012","Pretty much what the title says.<br />\n<br />\n- Wrap-up of the year with awards given out<br />\n- Captains for next year<br />\n- Food :D<br />\n- Something that I may have forgotten<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("91","21","2012-06-04 23:31:14","Awards","We still have a bunch of awards left, so if you were not present at the awards ceremony today, please stop by room 800 as soon as possible for any awards you think you may have received.");
INSERT INTO messages VALUES("92","34","2012-06-10 00:40:06","SAT Prep","Hi guys,<br />\n<br />\nI hope the final week of school has been going smoothly for everyone! For those people who don\'t have stuff to do in July and are harassed by parents to do something useful, I am directing my attention to you guys. An LHS alum is heading a 4 week SAT prep course at the high school starting at July 7. He\'s a really cool and smart guy who got a 2360 and got into uPenn so he\'s legit. If anyone is interested, just email me at kevinwen@mit.edu and I\'ll hook you up with a $300 discount (bringing the total to $599). For more information on scheduling, check out http://www.revolutionprep.com/instructors/kevin_l. Thanks and have a glorious summer vacation!<br />\n<br />\nTL;DR: Give me money and I\'ll make you smarter<br />\n<br />\n-Kevin Wen");
INSERT INTO messages VALUES("93","21","2012-09-08 21:02:42","Meeting/Tryout","Hello everyone,<br />\n<br />\nThe first meeting of the year will be this coming <span style=\"text-decoration: underline;\">Monday, September 10th, at 2:30 in room 800</span>. After an introduction, we\'ll be having the first &quot;tryout&quot; (which we will note does <span style=\"font-weight: bold;\">not</span> determine whether or not you can go to future practices).<br />\n<br />\nPlease spread the word around to anybody interested who may have not seen the posters. Hope to see you all there.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("94","34","2012-09-23 21:30:44","Next Practices","Hey guys,<br />\n<br />\nHope you\'ve had a nice weekend.<br />\n<br />\nHere\'s the agenda for the next few math team practices as well as information on upcoming events.<br />\n<br />\nNext practice (Tomorrow): We will be going over answers and solutions to the tryout you took two weeks ago. Also, there will be a reintroduction to any people who weren\'t here on our first meeting. We will also be taking our first two rounds of the year (hooray!)<br />\n<br />\nPractice after that (October 1st): One MML round and three GBML rounds.<br />\n<br />\nNo school on October 8th so you get a break from math team (boo). Don\'t forget to take your daily dose of math though.<br />\n<br />\nHere\'s the contests that are coming up:<br />\n<br />\nMML (Week of October 1st)<br />\nGeometry: Volumes and Surfaces<br />\nPlane Geometry: Pythagorean relations in rectilinear figures<br />\nAlgebra 1: Linear Equations<br />\nAlgebra 1: Fractions and Mixed Numbers<br />\nAlgebra 2: Inequalities and Absolute Value<br />\nAlgebra 1: Evaluations<br />\n<br />\nGBML (Week of October 8th)<br />\nArithmetic	   Open<br />\nAlgebra 1	   Problem Solving (Word Problems)<br />\nAlgebra 1	   Exponents and Radicals; Equations involving them<br />\nAlgebra 2	   Factoring; Equations involving Factoring<br />\nTrigonometry	   Angular and Linear Velocity; Right Triangle Trigonometry<br />\n<br />\nEach round of these contests consists of 3 questions which must be done in 10 minutes. For MML, each question is worth 2 points. For GBML, the first question is worth 1 point, the second 2 points, and the third 3 points. The top 6 mathletes in terms of net score will be on the varsity (cool kids) team with the captains; the next 10 will be alternates and will be able to tag along to the competition.<br />\n<br />\nYou may notice that some of these categories cover topics some of you may not be familiar with (namely trigonometry). If you want some help learning there are resources available on the website (http://www.lhsmath.org), and you\'re also free to ask any of us captains for help during practices.<br />\n<br />\n<br />\nFinally, we\'re introducing a new, fun activity this year. Each week, we will be giving out a problemset of proofs for you guys to take home and hand in the next week. There are two levels, each consisting of 3 questions. Solutions will be graded based on completeness of proofs and the scores will be cumulative throughout the year. Students with the most amount of points at the end of the year will get fabulous prizes not to mention the admiration and jealousy of your peers.<br />\n<br />\nWell, hope that didn\'t bore all of you guys too much. See you at practice! <br />\n");
INSERT INTO messages VALUES("95","21","2012-09-26 15:13:02","OMO and Problem Set","The <a href=\"http://www.lhsmath.org/Download?ID=71\" target=\"_blank\">first problem set</a> is now online.<br />\n<br />\nIf you are still interested in doing the OMO, the website is <a href=\"http://onlinemathopen.netne.net/?q=home\" target=\"_blank\">here</a>.");
INSERT INTO messages VALUES("96","21","2012-09-30 21:22:38","October 1 Meeting","Tomorrow we\'ll be finishing up the rounds to determine the MML and GBML teams for the first meet (about 4 of them). We send 20 people to each, 10 regulars and 10 alternates. In the MML, the regulars make up one team, in the GBML, the regulars are split into two teams of five.<br />\n<br />\nThe first MML meet is this Thursday, October 4th. The GBML meet is the following Wednesday, October 10th. There is no math team meeting that week since we have Monday (October 8th) off.<br />\n<br />\nGBML Round 5 features <a href=\"http://www.lhsmath.org/Download?ID=9\" target=\"_blank\">right triangle trigonometry</a>. We will go over it briefly before the rounds.<br />\n<br />\nIf you are doing the <a href=\"http://www.lhsmath.org/Download?ID=71\" target=\"_blank\">problem set</a>, solutions are to be turned in tomorrow. The second problem set will be available as well.");
INSERT INTO messages VALUES("97","21","2012-10-01 15:18:15","Problem Set 2","is now <a href=\"http://www.lhsmath.org/Download?ID=74\" target=\"_blank\">online</a>.<br />\n<br />\nFor this problem set and all future ones, please put no more than one problem on each page. This will make grading much easier for us.<br />\n<br />\nThis will be due two weeks from today, on October 15th.");
INSERT INTO messages VALUES("98","21","2012-10-02 13:56:56","MML Meet 10-04-12","The teams for the first MML meet at Weston on Thursday, October 4th, are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nHao Shen		<br />\nPeijin Zhang	<br />\nAlan Zhou<br />\nAditya Gopalan	<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nArjun Khandelwal<br />\nDan Kim<br />\nShohini Stout	<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nSurya Bhupatiraju<br />\nCelina Hsieh<br />\nTanmay Khale<br />\nHenry Li<br />\nAlan Qiu<br />\nAlan Burstein<br />\nAlbert Kim<br />\nRoshan Padaki<br />\nArul Prasad<br />\nDevin Shang<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Geometry: Volumes and Surfaces<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Plane Geometry: Pythagorean relations in rectilinear figures<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Algebra 1: Linear Equations<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 1: Fractions and Mixed Numbers<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Algebra 2: Inequalities and Absolute Value<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Algebra 1: Evaluations<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("99","21","2012-10-03 19:42:25","MML Reminder","This is a reminder that the first MML meet is tomorrow and that if you are a regular or alternate, then you are to be at the front entrance at around 2:30 after school.");
INSERT INTO messages VALUES("100","21","2012-10-06 12:22:22","GBML Teams 10-10-12","Teams for the first GBML meet at Concorde-Carlisle on Wednesday, October 10th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nHao Shen<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nClive Chan<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nSurya Bhupatiraju<br />\nPeijin Zhang<br />\nHenry Li<br />\nShohini Stout<br />\nArul Prasad<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nNoah Golowich<br />\nTanmay Khale<br />\nAlan Qiu<br />\nAlan Burstein<br />\nLalita Devadas<br />\nUma Roy<br />\nBrian Wang<br />\nMatthew Weiss<br />\nEric Xia<br />\nEthan Zou<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1</span>: Arithmetic: Open<br />\n<span style=\"font-weight: bold;\">Round 2</span>: Algebra 1: Problem Solving (Word Problems)<br />\n<span style=\"font-weight: bold;\">Round 3</span>: Algebra 1: Exponents and Radicals; Equations involving them<br />\n<span style=\"font-weight: bold;\">Round 4</span>: Algebra 2: Factoring; Equations involving Factoring<br />\n<span style=\"font-weight: bold;\">Round 5</span>: Trigonometry: Angular and Linear Velocity; Right Triangle Trigonometry");
INSERT INTO messages VALUES("101","21","2012-10-09 20:29:58","GBML Reminder","If you will be at the GBML meet tomorrow, please be present at the front entrance at 2:30 PM.<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("102","21","2012-10-13 22:15:54","Upcoming Events","Tuesday, October 16: NEML<br />\n- 30 minutes, 6 questions, any calculator without a QWERTY keyboard is allowed<br />\n- after school in room 800<br />\n<br />\nThursday, October 18: MAML Level 1<br />\n- 90 minutes, 25 multiple choice questions (choices A,B,C,D,E)<br />\n- 6 points for correct, 2 for blank, 0 for wrong<br />\n- during school hours in the science lecture hall<br />\n- we should have permission forms on Monday<br />\n<br />\nTuesday, October 23: Club photo<br />\n- after school in Commons II");
INSERT INTO messages VALUES("103","21","2012-10-14 20:28:21","October 15","Tomorrow we will be having tryouts for the HMNT/HMMT. The description is copy-pasted below:<br />\n<br />\nThe Harvard-MIT Mathematics Tournament is an international math competition organized by undergraduates from Harvard and MIT, held at one of the two campuses each year in February. The Harvard-MIT November Tournament is a similar competition geared toward local schools and less-experienced problem solvers, held in November. All math team members are invited to participate, but must try out to be placed on a team of 4 to 6 students.<br />\n<br />\nIn addition, if you did <a href=\"http://www.lhsmath.org/Download?ID=74\" target=\"_blank\">problem set 2</a>, you should have <a href=\"http://www.artofproblemsolving.com/Resources/articles.php?page=howtowrite\" target=\"_blank\">written up solutions</a> tomorrow if you want to get feedback and stuff on it. Problem set 3 will also be available.<br />\n");
INSERT INTO messages VALUES("104","21","2012-10-16 09:46:59","Probably the latest reminder ever","NEML is today after school in room 800 at 2:30 (the normal math team place and time)<br />\n<br />\n6 questions, 30 minutes, calculators are fine as long as they don\'t have a qwerty keyboard");
INSERT INTO messages VALUES("105","21","2012-10-17 19:28:06","MAML Reminder","The MAML Level 1 will be tomorrow. Please arrive around 7:30 ish so we can get started as soon as possible. You will be missing C and B blocks.<br />\n<br />\nAs mentioned earlier, show up to room 800. If there are any location changes, they should be physically posted so that you will know where to go (if we find out anything definitive earlier, we will try to send an email as soon as possible as well).");
INSERT INTO messages VALUES("106","21","2012-10-21 21:08:16","October 22","Tomorrow we\'ll be starting MML rounds for the second meet. There will be a lecture before these rounds, following up the <a href=\"http://www.lhsmath.org/Download?ID=9\" target=\"_blank\">previous lecture</a>.<br />\n<br />\nIf you are doing the <a href=\"http://www.lhsmath.org/Download?ID=76\" target=\"_blank\">third problem set</a>, it is due tomorrow.");
INSERT INTO messages VALUES("107","21","2012-10-21 21:25:58","HMNT Participants","If you have turned in a tryout (with your name on it) and did not say you couldn\'t go, you should appear in one of the following lists, separated based on availability for the HMNT competition on November 10th.<br />\n<br />\nPlease let us know at captains@lhsmath.org if any of the following is true at any point in time before <span style=\"font-weight: bold;\">November 1st</span>:<br />\n- You are not in a list and would like to go to the competition (and can go)<br />\n- You are in the &quot;Yes&quot; list but cannot go<br />\n- You are in one of the other lists and you can definitively say whether or not you can go (and let us know which one it is)<br />\n<br />\n<span style=\"text-decoration: underline;\">Yes</span><br />\nAditya Gopalan<br />\nAlan Burstein <br />\nAlbert Kim <br />\nAndrew Luo <br />\nArjun Khandelwal<br />\nArul Prasad <br />\nBrian Wang <br />\nCelina Hsieh <br />\nDevin Shang <br />\nEric Xia <br />\nEthan Zou <br />\nHenry Li <br />\nKara Luo <br />\nRoshan Padaki <br />\nShohini Stout <br />\nSteven Qiu <br />\nSuchith De Silva <br />\nTanmay Khale <br />\nYoonji Kim <br />\nZach Polansky <br />\nZhiping Wang<br />\n<br />\n<span style=\"text-decoration: underline;\">Probably</span><br />\nClive Chan <br />\nDavid Tu <br />\nKatie Fraser <br />\nLalita Devadas <br />\nMatthew Weiss <br />\nNoah Golowich <br />\nUma Roy<br />\n<br />\n<span style=\"text-decoration: underline;\">?/No Response</span><br />\nAlan Qiu<br />\nBharat Srirangam <br />\nHaochen Wang <br />\nJaney Lee <br />\nLingrui Zhong <br />\nMohammed Khan <br />\nReggie Luo <br />\nVictor Zhang <br />\nWilliam Kuszmaul <br />\nYoonji Choi");
INSERT INTO messages VALUES("108","21","2012-10-30 22:47:52","MML Meet 11-01-12","A few things to note first:<br />\n<br />\n- If there is a postponement of the meet for some reason (unlikely but who knows), we\'ll try to let you guys know as soon as possible.<br />\n<br />\n- We did not actually get a chance to go over complex numbers (round 1). The lecture is <a href=\"http://www.lhsmath.org/Download?ID=3\" target=\"_blank\">here</a>.<br />\n<br />\nThe team for the second MML meet at Lexington on Thursday, November 1st, is<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nCelina Hsieh<br />\nNoah Golowich<br />\nTanmay Khale<br />\nArjun Khandelwal<br />\nAlan Qiu<br />\nAlan Burstein<br />\nClive Chan<br />\n<br />\nSince this meet is hosted at Lexington, <span style=\"font-style: italic;\">anyone who was present for the rounds on Monday the 22nd but not in the above list is free to show up as an alternate</span>. We will be in the math building around 2:30 after school (with any luck room 819, but signs should tell you where to go).<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains at captains@lhsmath.org, or let us know that you cannot go to the meet as soon as possible. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1</span>: Algebra 2: Complex Numbers (no Trig)<br />\n<span style=\"font-weight: bold;\">Round 2</span>: Algebra 1: Anything<br />\n<span style=\"font-weight: bold;\">Round 3</span>: Plane Geometry: Area of rectilinear figures<br />\n<span style=\"font-weight: bold;\">Round 4</span>: Algebra 1: Factoring and its applications<br />\n<span style=\"font-weight: bold;\">Round 5</span>: Trigonometry: Functions of 30, 45, 60 &amp; 90 and their integral multiples<br />\n<span style=\"font-weight: bold;\">Round 6</span>: Plane Geometry: Angles about a point, triangles, and parallels<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("109","21","2012-10-31 21:25:29","MML Reminder","This is a reminder that (as far as we know), the MML meet is tomorrow after school in the math building.<br />\n<br />\nNote: If there is a postponement of the meet, we will attempt to let you know as soon as possible.");
INSERT INTO messages VALUES("110","21","2012-11-04 21:19:09","November 5 and upcoming competitions","Tomorrow we\'ll be having a lecture on matrices and then doing a bunch of GBML rounds for the meet on Wednesday, November 7.<br />\n<br />\nThis Friday, November 9, is the first Mandelbrot competition of the year, after school in room 800 at around 2:30 ish. It lasts about 40 (?) minutes. You can decide if you want to take the regional or national level (the latter is a bit harder).<br />\n<br />\nThis Saturday, November 10, is the HMNT competition. Expect a few more e-mails regarding that in the next few minutes.<br />\n<br />\nNext Tuesday, November 13, is the second NEML. Same procedure as last time, after school in room 800 at around 2:30 ish and it lasts 30 minutes. You can bring any calculator without a qwerty keyboard to it.");
INSERT INTO messages VALUES("111","21","2012-11-04 21:22:27","HMNT Carpooling","HMNT is this Saturday, the 10th. To get there, we arrange carpools. If you are going and can send people there or bring people back from HMNT (at Harvard), please email us (captains@lhsmath.org) with the direction(s) you can take people as well as how many. Any additional carpooling information such as any particular people you will be taking to HMNT should also be sent to us.<br />\n<br />\nNote: If we do not get enough rides (as of now, we need 36) to the competition, the carpooling arrangements we make are off and everyone needs to find rides to the competition.");
INSERT INTO messages VALUES("112","21","2012-11-04 21:55:34","HMNT Teams","At the end of this e-mail is the list of teams for the HMNT competition this Saturday. A few things first:<br />\n<br />\n- In general, read the entire e-mail. It does not take a long time, and sometimes people don\'t actually do this.<br />\n<br />\n- If you are on this list but unable to come, please let us know as soon as possible so we can make appropriate changes. The schedule is <a href=\"http://web.mit.edu/hmmt/www/november/datafiles/schedules/2012-november.shtml\" target=\"_blank\">here</a>.<br />\n<br />\n- Similarly, if you are not on the list but want to and are able to come, please let us know as soon as possible. Unfortunately we\'d have to put you on a waitlist if this is the case.<br />\n<br />\n- If there is another name you go by that you may write on the answer forms or if we managed to spell your name wrong, please let us know as well.<br />\n<br />\n- Lexington High School &lt;blank&gt; is the team long name, the text in the parentheses is the team short name. For example, if I were on Lexington High School Alpha, the team short name is Lexington A.<br />\n<br />\n- Chances are, your team name does not dictate your skill level or the overall team level (there was a little random.org involved). Letters were chosen to have reasonable team short names.<br />\n<br />\n- If there are changes, there will be more emails.<br />\n<br />\n- The actual teams: <br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Alpha (Lexington A)</span><br />\nAditya Gopalan<br />\nTanmay Khale<br />\nArjun Khandelwal<br />\nHenry Li<br />\nArul Prasad<br />\nShohini Stout<br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Beta (Lexington B)</span><br />\nYoonji Choi<br />\nAlbert Kim<br />\nWilliam Kuszmaul<br />\nAndrew Luo<br />\nDavid Tu<br />\nMatthew Weiss<br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Epsilon (Lexington E)</span><br />\nClive Chan<br />\nCelina Hsieh<br />\nAlan Qiu<br />\nBrian Wang<br />\nEric Xia<br />\nKatie Fraser<br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Kappa (Lexington K)</span><br />\nJaney Lee<br />\nReggie Luo<br />\nSteven Qiu<br />\nSuchith de Silva<br />\nBharat Srirangam<br />\nVictor Wang<br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Tau (Lexington T)</span><br />\nAlan Burstein<br />\nLalita Devadas<br />\nMohammed Khan<br />\nKara Luo<br />\nDevin Shang<br />\nLingrui Zhong<br />\n<br />\n<span style=\"text-decoration: underline;\">Lexington High School Zeta (Z)</span><br />\nEthan Zou<br />\nYoonji Kim<br />\nRoshan Padaki<br />\nUma Roy<br />\nHaochen Wang<br />\nZhiping Wang<br />\n<br />\n~ Captains (captains@lhsmath.org)");
INSERT INTO messages VALUES("113","21","2012-11-04 22:11:06","HMNT Carpooling: Additional","We will be meeting in the morning at the front of LHS at 7:15, and it is from there that carpool groups will leave.<br />\n<br />\nThe guts round ends around 4:15 and the awards ceremony is scheduled to end at 5:15 (they almost definitely will run a little behind).");
INSERT INTO messages VALUES("114","21","2012-11-04 22:16:01","HMNT Teams: Correction","For those of you on Lexington High School Zeta, your short name should be <span style=\"font-weight: bold;\">Lexington Z</span>, not just Z.");
INSERT INTO messages VALUES("115","21","2012-11-05 15:55:49","GBML Rounds","For those of you that did not take all four rounds today during math team, please get those in today if possible or let us know why it would not be possible (if you intend to actually take the rounds). The intention is to get the teams announced today.<br />\n<br />\nTo those of you who already brought it up with us and are waiting to receive the rounds, you should receive them soon-ish.");
INSERT INTO messages VALUES("116","21","2012-11-05 23:30:48","GBML Teams 11-07-12","First: The trig equations round evidently killed a lot of people, so there are (hastily written) solutions available to those problems <a href=\"http://www.lhsmath.org/Download?ID=77\" target=\"_blank\">here</a>. If you still feel weak with trig in general, the lectures are available <a href=\"http://www.lhsmath.org/Files\" target=\"_blank\">here</a>.<br />\n<br />\nTeams for the second GBML meet at Chelmsford on Wednesday, November 7th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nHao Shen<br />\nAlan Zhou<br />\nAditya Gopalan<br />\nJonathan Tidor<br />\nNoah Golowich<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nPeijin Zhang<br />\nRohil Prasad<br />\nArjun Khandelwal<br />\nShohini Stout<br />\nClive Chan<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nCelina Hsieh<br />\nHenry Li<br />\nAlan Qiu<br />\nDaniel Wang<br />\nAlbert Kim<br />\nArul Prasad<br />\nDevin Shang<br />\nMatthew Weiss<br />\nEric Xia<br />\nEthan Zou<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Arithmetic: Open<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Simultaneous Linear Equations and Word Problems, Matrices	   <br />\n<span style=\"font-weight: bold;\">Round 3:</span> Geometry: Angles and Triangles<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2: Quadratic Equations and problems involving them, Theory of Quadratics<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Trigonometric Equations");
INSERT INTO messages VALUES("117","21","2012-11-08 16:54:35","HMNT Rides: Update","We currently have... not that many rides. In other words, many of you probably have not even bothered to check with your parents if they are able to give rides. We highly recommend that you do this and let us know so that we can have an actual organized carpool to HMNT.<br />\n<br />\nThanks,<br />\n<br />\n~ benevolent dictators (Captains)");
INSERT INTO messages VALUES("118","21","2012-11-08 20:46:29","Mandelbrot Reminder and another HMNT Rides Update","<span style=\"text-decoration: underline;\">First Step</span><br />\n<br />\nRead the whole e-mail.<br />\n<br />\n<span style=\"text-decoration: underline;\">HMNT</span><br />\n<br />\nWe are still short a good number of rides (as in, double digits for each way). Thus, I copy paste and modify:<br />\n<br />\nIf your parents are able to send people to HMNT or back (or both), please email us (captains@lhsmath.org) with how many people (including yourself) you can take. If you are going on your own, let us know as well. If we do not have enough rides, then the organized carpools will be called off and everyone will need to find their way to Harvard to compete.<br />\n<br />\n<span style=\"text-decoration: underline;\">Mandelbrot</span><br />\n<br />\nThe first Mandelbrot competition of the year is tomorrow after school in room 800 at around 2:30.<br />\n<br />\nThe test lasts for 40 minutes and there are 7 questions. No calculators.<br />\nThere are national and regional levels, which you get to pick (national level swaps out some of the easier regional questions for harder ones).<br />\n<br />\n");
INSERT INTO messages VALUES("119","23","2012-11-09 19:40:19","Last HMNT Update","So we believe that all the rides are all set on the way there. However, we do not have enough on the way back. There are a couple of solutions:<br />\n1. Tell us if you are able to take some people back (note that you do not have to arrange carpools on your own, we will help)<br />\n2. Tell us if you can go home by yourselves<br />\n3. If people still require rides, tell Hao that you will going on the T with him back to the high school (note that he will NOT pay for your ride). <br />\nPlease remember that it is your job to get there and back home. We are just trying to help. <br />\n<br />\nBesides that, please remember to:<br />\n1. Get a good night\'s sleep <br />\n2. Don\'t eat breakfast unless you don\'t want to eat the free breakfast there<br />\n3. Bring pencil/pens/phone/brain/money for lunch and T if you cannot arrange any rides back  <br />\n4. Meet at LHS BY 7:15 or meet at Harvard at 8:00 if you have contacted us<br />\n5. Ask your parents for a ride back home if you are in need of one<br />\n6-10. Have FUN<br />\n<br />\nBelow is the carpool list for the way there:<br />\nShohini (4) - same on way back<br />\n- Celina<br />\n- Katie<br />\n- Diana (Yoonji)<br />\n<br />\nAlan Zhou (4) - same on way back<br />\n- Henry Li<br />\n- Surya Bhupatiraju<br />\n- Janey Lee<br />\n<br />\nMatthew Weiss (6)    <br />\n-Kara Luo<br />\n-Yoonji Kim<br />\n-Roshan Padaki<br />\n-Haochen Wang<br />\n-Zhiping Wang <br />\n<br />\nEric Xia (4) - same on way back<br />\n- Albert Kim<br />\n- Tanmay Khale <br />\n- Alan Qiu <br />\n<br />\nClive Chan (3)<br />\n- David Tu<br />\n- Andrew Luo<br />\n<br />\nHao Shen (4)  <br />\n- Aditya Gopalan<br />\n- Arjun Khandelwal<br />\n- Peijin Zhang <br />\n<br />\nBharat Srirangam (2)<br />\n-Mohammed Khan<br />\n<br />\nSteven Qiu (2)<br />\n- Reggie Luo<br />\n<br />\nEthan Zou (5)<br />\n-Brian Wang<br />\n-Devin Shang<br />\n-Alan Burnstein<br />\n-Arul Prasad<br />\n<br />\nGoing Solo:<br />\nLingrui Zhong<br />\nWilliam Kuzmaul <br />\n<br />\nPlease email us if there are any questions, concerns, or any changes in circumstances. We hope everything will go smoothly tomorrow. <br />\n<br />\nThanks,<br />\nCaptains");
INSERT INTO messages VALUES("120","21","2012-11-09 20:08:36","HMNT: More Logistics (We lied)","First of all, if for some reason you\'re reading this email but haven\'t seen the carpool groups for the way there, we recommend you do that now. That email is <a href=\"http://www.lhsmath.org/Messages?View=119\" target=\"_blank\">here</a>.<br />\n<br />\nTomorrow morning, be at the <span style=\"font-weight: bold;\">front entrance of LHS by 7:15</span> in the morning. HMNT this year will be in the Harvard Science Center. I have no idea where the earlier address I said came from (although it might be the parking garage), but the actual address is just <span style=\"font-weight: bold;\">1 Oxford Street, Cambridge, MA</span>. If you walk forward a little bit from any entrance (such as the one on Oxford street), you should find a hub area, and this is where we will be meeting (and, for that matter, pretty much everyone will be meeting).<br />\n<br />\nIn addition to materials for actually taking the test, you should bring either your own lunch or money to buy lunch. Ten to fifteen dollars should be reasonable, twenty is very safe.<br />\n<br />\nGroup leaders are the first person in each group and the person that should be doing the driving (or rather, a parent of that person). If you are a group leader, you need to check out with Alan when you have everyone in your group before you can go. In addition, you should check in with him at Harvard when you find him to let him know that you actually arrived. If you are going solo, you do not need to check out at the high school, but you should still check in at Harvard.<br />\n<br />\nFor rides on the way back: we don\'t have official groups set up because we didn\'t actually get enough seats. Thus, if you don\'t know how you\'re getting back home yet, figure out how you\'re going to do that if possible (see the previous email). We can try to work something out if none of those solutions work, but we can\'t make any guarantees.<br />\n<br />\nAgain, if there are any issues with arrangements in the previous email or questions that you have, email us as soon as possible so that you aren\'t confused when the competition comes around.<br />\n<br />\ngood luck have fun,<br />\n~ Captains");
INSERT INTO messages VALUES("121","21","2012-11-09 20:41:40","HMNT: Infinity plus seven","Here\'s a <a href=\"http://www.map.harvard.edu/\" target=\"_blank\">map of Harvard</a> in case you need to find where you\'re going or want to find someplace to eat in the area.<br />\n<br />\nWe highly recommend that you bring a cell phone just in case.");
INSERT INTO messages VALUES("122","23","2012-11-09 21:51:27","Facebook Group ","Hey all, <br />\n<br />\nA facebook group has been created that will have the same basic notifications as you guys will get in your emails. It would help with a lot of quick messaging. The link to join is http://www.facebook.com/groups/lhsmath/. We this will help make communication faster in the future.<br />\n<br />\nCaptains");
INSERT INTO messages VALUES("123","23","2012-11-10 19:04:25","HMNT Results","Hey everyone,<br />\n<br />\n1. We would like to thank everyone who came to HMNT. Although you guys may not have had a lot of veteran people, you guys did a great job! We are proud of you. To recap the results, Lexington Alpha came in 4th place overall with Arjun and Alan Q. placing top 15. Congratulations! Extended results will be posted on the HMNT website in the upcoming weeks.  <br />\n<br />\n2 There has been some unfortunate communication problems. We will address these in our next meeting but one thing that we find to be a reoccurring problem is that people don\'t read the emails entirely. READ THE ENTIRE EMAIL. We don\'t spam. We also opened up a facebook group if that is more convenient <br />\n<br />\n3 There is no practice this week so the next problem set will be due next week. We hope that more people will do this set as they are good questions and you have been given 3 weeks to complete them. Note that there will be a prize to the top overall scorer. <br />\n<br />\nLMT date will be 2/9/13 this year! This is earlier than previous years so right now we are asking for YOUR questions! If you have any questions that you would like to contribute to the test please email shenhao95@gmail.com. These problems can range from very easy to very hard but make sure they are original. <br />\n<br />\nCaptains");
INSERT INTO messages VALUES("124","21","2012-11-13 00:21:07","Late Reminder (NEML)","The second NEML of the year is Tuesday, November 13th after school at 2:30 in Room 800 (technically today, but if you are reading this at the time it was sent, it is functionally tomorrow).");
INSERT INTO messages VALUES("125","21","2012-11-18 21:14:17","November 19","Tomorrow we\'ll be having a lecture on logarithms and then doing a bunch of MML rounds for the meet on Thursday, December 6.*<br />\n<br />\nThere will also be information on LMT, the competition we run for middle school students.<br />\n<br />\n* That did not sound copy-pasted at all.");
INSERT INTO messages VALUES("126","21","2012-11-18 21:17:21","HMNT: Final (Maybe)","We received full HMNT results. If you would like to know how you did, drop us an email.");
INSERT INTO messages VALUES("127","21","2012-12-03 19:55:10","MML Meet 12-06-12","The teams for the third MML meet at Acton-Boxboro on Thursday, December 6th, are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nSurya Bhupatiraju<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nAditya Gopalan<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nTanmay Khale<br />\nShohini Stout<br />\nEthan Zou<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nCelina Hsieh<br />\nAudrey Li<br />\nHenry Li<br />\nAlan Qiu<br />\nClive Chan<br />\nRoshan Padaki<br />\nArul Prasad<br />\nDevin Shang<br />\nMatthew Weiss<br />\nEric Xia<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Trigonometry: Right angle problems, Laws of Sine and Cosine<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Elementary Number Theory/Arithmetic<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Coordinate Geometry of Lines and Circles<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2: Log &amp; Exponential Functions<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Algebra 1: Ratio, Proportion or Variation<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Plane Geometry: Polygons (no areas)");
INSERT INTO messages VALUES("128","21","2012-12-05 18:14:31","MML Reminder","This is a reminder that the MML meet is tomorrow and that if you are a regular or alternate, then you are to be at the front entrance at around 2:30 after school unless you have already notified us of otherwise.");
INSERT INTO messages VALUES("129","21","2012-12-06 20:05:34","Mandelbrot Reminder and GBML Rounds","The second Mandelbrot competition of the year is tomorrow after school in room 800 at around 2:30.<br />\n<br />\nAlso, if you missed any GBML rounds and wish to take them, send us an email as soon as you can so that teams can be made for the meet as soon as possible.");
INSERT INTO messages VALUES("130","21","2012-12-11 18:27:26","GBML Teams 12-12-12","Late notice............<br />\n<br />\nTeams for the third GBML meet at Belmont on Wednesday, December 12th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nArjun Khandelwal<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nHao Shen<br />\nAditya Gopalan<br />\nNoah Golowich<br />\nShohini Stout<br />\nClive Chan<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nSurya Bhupatiraju<br />\nCelina Hsieh<br />\nHenry Li<br />\nTanmay Khale<br />\nAlan Qiu<br />\nSuchith De Silva<br />\nAudrey Li<br />\nArul Prasad<br />\nMatthew Weiss<br />\nDavid Tu<br />\n<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday (tomorrow...) If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Algebra 1: Fractions and Word Problems<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Coordinate Geometry of the Straight Line	   <br />\n<span style=\"font-weight: bold;\">Round 3:</span> Geometry: Polygons: Area and Perimeter<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2: Logs, Exponents, Radicals and equations involving them<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Trigonometric Analysis and Complex Numbers in Trigonometric form");
INSERT INTO messages VALUES("131","23","2012-12-23 16:16:41","LMT Questions","Hey Everyone!<br />\n<br />\nWe hope you guys are enjoying your break and celebrating the holidays with your families! <br />\nWe realize that many you guys are pretty bored, so write some LMT problems! Our goal is to obtain at least 50/80 questions. Right now we have roughly 45 problems. Keep the problems coming in! We are keeping track of how many questions people write and remember that the top 5 people with the most written problems get FREE books. Please keep the problems relatively original. They easy problems are good too. Thanks!<br />\n<br />\nRankings are:<br />\nHao - 19<br />\nAlan Zhou -12<br />\nAlan Burnstein - 5<br />\nClive Chan -4 <br />\nEric Xia - 4 <br />\nEthan - 1<br />\n<br />\nIf you had any questions that weren\'t accepted, you can ask Hao why it was rejected. <br />\n<br />\nHappy Holidays,<br />\nCaptains ");
INSERT INTO messages VALUES("132","23","2013-01-02 16:26:51","LMT Update","Hey Everyone!<br />\n<br />\nWe hope you guys are enjoyed your break! Thanks for all the LMT questions so far. Some of them are rather sub-par but the majority are very good. If you have any more interesting questions, please keep sending them in. <span style=\"font-weight: bold;\">Remember, quality over quantity</span>.<br />\n<br />\nCurrently the number of questions written by each person is below: <br />\n<br />\nRankings are:<br />\nAlan Burnstein - 25<br />\nHao Shen - 23<br />\nAlan Zhou -20<br />\nDavid Amirault - 15<br />\nClive Chan -11 <br />\nEric Xia - 10 <br />\nAlan Qiu - 4<br />\nZach Polansky -3<br />\nArul Prasad - 3<br />\nEthan Zou- 1<br />\n<br />\n<br />\nIf you had any questions that weren\'t counted, you can ask Hao. <br />\n<br />\nRight now we still don\'t have many teams registered so please tell your previous teachers and other interested middle school students!<br />\n<br />\nWe look forward to seeing you guys back on the 7th. <br />\n<br />\nCaptains");
INSERT INTO messages VALUES("133","21","2013-01-06 21:51:02","01-07-13 to 01-11-13","Hello everyone,<br />\n<br />\nSchedule for the week:<br />\n<br />\nMonday, January 7: Alumni (the official alumni day, actually)<br />\nTuesday, January 8: NEML<br />\nThursday, January 10: MML Meet at Winchester<br />\nFriday, January 11: Mandelbrot<br />\n<br />\nAlso, write some LMT questions.");
INSERT INTO messages VALUES("134","2","2013-01-07 16:50:21","NEML","The NEML is tomorrow after school in room 800. ");
INSERT INTO messages VALUES("135","21","2013-01-07 17:16:48","MML Meet 01-10-13","There is a half day this Thursday, so we get out at 11:15. However, for those of you going to the meet, we are still meeting at 2:30 in front of the school, so you will have to find something to do for approximately three hours.<br />\n<br />\nThe teams for the fourth MML meet at Winchester on Thursday, January 10th, are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nSurya Bhupatiraju<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nDan Kim<br />\nArul Prasad<br />\nEthan Zou<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nAditya Gopalan<br />\nTanmay Khale<br />\nArjun Khandelwal<br />\nShohini Stout<br />\nAlan Burstein<br />\nRichard Huang<br />\nRoshan Padaki<br />\nDavid Tu<br />\nMatthew Weiss<br />\nEric Xia<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Analytic Geometry: Anything<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Algebra 1: Factoring and/or equations involving factoring<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Trigonometry: Equations having a reasonable number of solutions<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2: Quadratic Equations/Quadratic Theory<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Geometry: Similarity of Polygons<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Algebra 1: Anything");
INSERT INTO messages VALUES("136","21","2013-01-09 16:50:57","MML Reminder","This is a reminder that the MML meet is tomorrow and that if you are a regular or alternate, then you are to be at the front entrance at around 2:30 after school unless you have already notified us of otherwise.<br />\n<br />\nBecause of the half day, you will have to find some way to kill around 3 hours.");
INSERT INTO messages VALUES("137","21","2013-01-10 19:13:13","Mandelbrot","The third Mandelbrot competition of the year is tomorrow after school in room 800 at around 2:30.");
INSERT INTO messages VALUES("138","21","2013-01-14 14:52:51","NEML","The NEML is tomorrow after school in room 800.");
INSERT INTO messages VALUES("139","21","2013-01-14 15:03:30","MAML Level 2","The MAML Level 1 <a href=\"http://www.maml.org/v9/public_view_qualifiyers_2012_2013/index.php\" target=\"_blank\">top scores</a> are up (for those of you that don\'t remember, this was a 25 question multiple choice test we took back in October).<br />\n<br />\nThe top Lexington scorers are listed here. See the preceding link for details on score and also in the event that we missed somebody in the list.<br />\n<br />\n<span style=\"text-decoration: underline;\">Finalists (17)</span> (Advance to Level 2 test)<br />\nZach Polansky<br />\nJonathan Tidor<br />\nAlan Zhou<br />\nRohil Prasad<br />\nSurya Bhupatiraju<br />\nNoah Golowich<br />\nHao Shen<br />\nEthan Zou<br />\nPeijin Zhang<br />\nDan Kim<br />\nCelina Hsieh<br />\nArul Prasad<br />\nAlan Qiu<br />\nSteven Qiu<br />\nShohini Stout<br />\nClive Chan<br />\nHenry Li<br />\n<br />\n<span style=\"text-decoration: underline;\">Semifinalists (9)</span> (Listed, but do not qualify for the Level 2 test)<br />\nDaniel Wang<br />\nDavid Papp<br />\nDevin Shang<br />\nLalita Devadas<br />\nTanmay Khale<br />\nBrian Wang<br />\nArjun Khandelwal<br />\nKyuil Lee<br />\nUma Roy<br />\n<br />\nThe Level 2 test will be on March 5th.");
INSERT INTO messages VALUES("140","21","2013-01-15 21:39:25","GBML Teams 01-16-13","Even later notice than last time............<br />\n<br />\nTeams for the fourth GBML meet at Arlington on Wednesday, January 16th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nArjun Khandelwal<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nHao Shen<br />\nTanmay Khale<br />\nShohini Stout<br />\nClive Chan<br />\nDavid Tu<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nHenry Li<br />\nZach Polansky<br />\nAlan Qiu<br />\nAlan Burstein<br />\nAlbert Kim<br />\nAndrew Luo<br />\nRoshan Padaki<br />\nArul Prasad<br />\nDevin Shang<br />\nMatthew Weiss<br />\n<br />\nIf you are named above, you are expected* to be at the front doors of the school at 2:30 PM this Wednesday (tomorrow...) If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement. Regulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Volume and Surface Area of Solids<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Inequalities and Absolute Value<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Similar Polygons, Circles and Areas Related to Circles<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Sequences and Complex Numbers<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Conic Sections<br />\n<br />\n* expectation more lenient in this particular instance for obvious reasons, but if you are actually able to read this note, you should still let us know");
INSERT INTO messages VALUES("141","21","2013-01-16 11:55:44","GBML Update","<span style=\"font-weight: bold;\">As of now, the meet is still on.</span>");
INSERT INTO messages VALUES("142","21","2013-01-20 17:07:22","01-21-13 to the slightly distant future","As we have no school tomorrow, we have no math team meeting tomorrow. There are no events this week.<br />\n<br />\nAfter the usual math team stuff on Monday the 28th, we are planning to do a <a href=\"http://www.lhsmath.org/Calendar?Month=1&amp;Year=2013\" target=\"_blank\">test solve</a> of the LMT problems. If you are interested in helping out with that, it\'ll probably last about an hour or something afterwards. There may be more details on that later.<br />\n<br />\nIf you are interested in taking the AMC 10A or 12A on <a href=\"http://www.lhsmath.org/Calendar?Month=2&amp;Year=2013\" target=\"_blank\">February 5th</a> and haven\'t picked up the form yet, you should be able to pick it up next practice (the 28th). If you\'ve already finished it, you should check in with any new teachers you may have for B or D blocks in second semester and let them know you\'ll be out.");
INSERT INTO messages VALUES("143","34","2013-01-20 21:52:00","Lexington Math Tournament","Hi All,<br />\n<br />\nHope you\'re having a fun long weekend. <br />\n<br />\nA reminder, Lexington Math Tournament is set to run on <span style=\"font-weight: bold;\">Saturday, February 9th</span>. We\'ll need a lot of volunteers to come help out with grading, proctoring, and general running of the tournament. Those who come to assist us will not only have a blast of a time, but will also net a nifty 8 hours of community service and also get a free lunch (who said no free lunch?). If there are people interested in getting NHS sponsored community service, message me about it and if enough people reply I\'ll set up the event.<br />\n<br />\nSomething we\'ve done over the past several years is have custom T shirts made for graders. They are super rad, you will be the admiration of all your friends when you wear them, so pick them up while they\'re hot. <span style=\"font-weight: bold;\">All proctors and volunteers who want to come help should be wearing one</span>. The main function is to help distinguish staff from the middle school riffraff, but they\'re also super stylish and you\'ll be kicking yourself for not buying one in 10 years when you see them going for hefty sums on ebay.<br />\n<br />\n<span style=\"font-weight: bold;\">The price for T shirts will be between $10~15</span>, to be finalized later on. Those of you who are interested in coming to help volunteer for LMT, <span style=\"font-weight: bold;\">please respond to this email saying that you will be attending (even if it\'s just a maybe) as well as your T shirt size</span>. (This includes you seniors and other captains)<br />\n<br />\nThanks all, have a great MLK day.");
INSERT INTO messages VALUES("144","21","2013-01-27 11:14:02","01-28-13 to 02-01-13","<span style=\"font-weight: bold;\">Math Team Practice:</span> Tomorrow, we will have a lecture on Circle Geometry. Afterwards, we will be doing 4 rounds for MML Meet 5.<br />\n<br />\n<span style=\"font-weight: bold;\">LMT:</span> Following the rounds will be an LMT testsolve. If you would like, you can stay around for pretty much however long you wish and help us check problems for reasonable difficulty, wording, all sorts of things.<br />\n<br />\n<span style=\"font-weight: bold;\">AMC 10A/12A:</span> If you need to get AMC forms or lost your previous copy, you can pick them up tomorrow in room 800. Make sure to check in with your third quarter teachers if you filled it out during second quarter.<br />\n<br />\n<span style=\"font-weight: bold;\">Mandelbrot:</span> The fourth Mandelbrot competition will be on Friday in room 800 right after school. The test is 40 minutes long.");
INSERT INTO messages VALUES("145","21","2013-01-28 21:18:22","LMT Updates","Hello,<br />\n<br />\nThanks to all the people who stayed around and helped look for issues with the individual/theme/team round questions for the LMT. Just remember to keep all information about the questions confidential.<br />\n<br />\nWe may have another testsolve on Friday, after the Mandelbrot. We should actually have the guts round then, in addition to updated versions of the other rounds.");
INSERT INTO messages VALUES("146","21","2013-01-31 13:10:51","Mandelbrot Reminder and LMT","Tomorrow after school in room 800 is the 4th Mandelbrot competition. It will last for about 40 minutes.<br />\n<br />\nAfterwards, we\'ll be doing another LMT testsolve, which will last until whenever. We should have all of the rounds (individual, theme, team, guts) available this time.");
INSERT INTO messages VALUES("147","21","2013-02-03 16:22:08","02-04-13 to 02-09-13","<span style=\"font-weight: bold;\">Monday:</span> Our math team time will be dedicated to LMT preparations. This means printing problems, compiling team folders, making signs, stuff like that. Come by to help if you want to be a good person.<br />\n<br />\n<span style=\"font-weight: bold;\">Tuesday:</span> In the morning, we will be having the AMC 10A/12A in the Science Lecture Hall. Be there at 7:30 AM so that we can get forms and stuff done and still start by 7:45, and bring your forms to the competition if you haven\'t already turned them in to Mr. Roos.<br />\n<br />\n<span style=\"font-weight: bold;\">Thursday:</span> We have our 5th MML meet against Lincoln-Sudbury. Teams will be announced in a separate e-mail.<br />\n<br />\n<span style=\"font-weight: bold;\">Saturday:</span> LMT. More on that in separate e-mails.");
INSERT INTO messages VALUES("148","21","2013-02-04 22:33:35","AMC 10A/12A","For those of you who are still awake to receive this message, this is just a reminder to show up to the Science Lecture Hall at ~7:30 if you are taking the AMC 10A or the AMC 12A. You will be missing D and B blocks.");
INSERT INTO messages VALUES("149","21","2013-02-05 18:21:10","MML Meet 02-07-13","The teams for the fifth MML meet at Lincoln-Sudbury on Thursday, February 7th, are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nAditya Gopalan<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nArjun Khandelwal<br />\nZach Polansky<br />\nClive Chan<br />\nEthan Zou<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nNoah Golowich<br />\nTanmay Khale<br />\nDan Kim<br />\nHenry Li<br />\nShohini Stout<br />\nAlan Burstein<br />\nReggie Luo<br />\nArul Prasad<br />\nDevin Shang<br />\nDavid Tu<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Algebra 2: Algebraic Functions<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Elementary Number Theory/Arithmetic<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Trigonometry: Identities and/or Inverse Functions<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 1: Word Problems<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Plane Geometry: Circles<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Algebra 2: Sequences and Series<br />\n<br />\n~ Captains");
INSERT INTO messages VALUES("150","21","2013-02-06 22:42:26","MML Reminder","This is a reminder that the MML meet is tomorrow and that if you are a regular or alternate, then you are to be at the front entrance at around 2:30 after school unless you have already notified us otherwise.");
INSERT INTO messages VALUES("151","21","2013-02-10 17:02:02","02-11-13 to 02-15-13","<span style=\"font-weight: bold;\">Monday:</span> We will be doing 4 GBML rounds. They have very descriptive names: Algebra 1, Geometry, Algebra 2, Precalculus.<br />\n<br />\n<span style=\"font-weight: bold;\">Tuesday:</span> The NEML is after school in room 800. It lasts for about thirty minutes.<br />\n<br />\n<span style=\"font-weight: bold;\">Wednesday:</span> The final GBML meet of the year will be at Canton.");
INSERT INTO messages VALUES("152","21","2013-02-11 19:40:02","NEML Reminder","The NEML is tomorrow after school in room 800.");
INSERT INTO messages VALUES("153","21","2013-02-11 22:06:14","GBML Teams 02-13-13","Teams for the fifth GBML meet at Canton on Wednesday, February 13th.<br />\n<br />\n<span style=\"text-decoration: underline;\">Alpha</span><br />\nHao Shen<br />\nAlan Zhou<br />\nAditya Gopalan<br />\nJonathan Tidor<br />\nShohini Stout<br />\n<br />\n<span style=\"text-decoration: underline;\">Beta</span><br />\nPeijin Zhang<br />\nRohil Prasad<br />\nDan Kim<br />\nArul Prasad<br />\nEric Xia<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nSurya Bhupatiraju<br />\nCelina Hsieh<br />\nNoah Golowich<br />\nHenry Li<br />\nAndrew Luo<br />\nDavid Amirault<br />\nAlan Burstein<br />\nClive Chan<br />\nRoshan Padaki<br />\nEthan Zou<br />\n<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM this Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Arithmetic<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Algebra 1<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Geometry<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 2<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Precalculus");
INSERT INTO messages VALUES("154","21","2013-02-12 21:01:44","GBML Reminder","If you will be at the GBML meet tomorrow, please be present at the front entrance at 2:30 PM.");
INSERT INTO messages VALUES("155","21","2013-02-19 12:50:57","AMC B","If you are taking the AMC 10B or 12B at LHS on February 20th, please show up at <span style=\"font-weight: bold;\">8:30 AM tomorrow</span> in the Science Lecture Hall.<br />\n<br />\nThere is the possibility that the test isn\'t there, in which case we\'ll post something stating the actual location.");
INSERT INTO messages VALUES("156","21","2013-02-24 15:08:05","02-25-13 to 03-01-13","<span style=\"font-weight: bold;\">Monday:</span> We will be doing 4 MML rounds. The meet is on Thursday, March 7th.<br />\n<br />\n<span style=\"font-weight: bold;\">Friday:</span> The final Mandelbrot competition is after school in room 800. It lasts for about 40 minutes.");
INSERT INTO messages VALUES("157","21","2013-02-26 20:31:46","MAML Level 2 Forms","The MAML Level 2 exam will be on March 5th. For the 17 finalists listed <a href=\"http://www.lhsmath.org/Messages?View=139\" target=\"_blank\">here</a>, please find Mr. Roos this week so that permission forms can be turned in by Monday the 4th.");
INSERT INTO messages VALUES("158","21","2013-03-03 13:04:00","ARML","This is fairly important if you are interested in participating, as the information here is very different from what we stated last Monday.<br />\n<br />\nThe qualifying session will be at <span style=\"font-weight: bold;\">Philips Andover</span> on <span style=\"font-weight: bold;\">Sunday, March 10</span>. The time is probably around 1 PM, but we\'ll send something out when there\'s a definite answer.<br />\n<br />\nThe top 10 people from Lexington that make it on one of the Eastern Mass teams will have a good portion of the expenses covered. More than 10 people from Lexington can go to the competition, but those not in the top 10 will have to pay the full fee, whatever that is (in the past few years, it was $200).<br />\n<br />\nThe ARML competition will be from May 30th to June 1st.");
INSERT INTO messages VALUES("159","21","2013-03-03 13:19:36","03-04-13 to 03-08-13","<span style=\"font-weight: bold;\">Monday:</span> We will do the last 2 MML rounds. There may be some time-filling thing beforehand (e.g. the Fermat point thing from a few weeks ago), but expect the day to be fairly short overall.<br />\n<br />\n<span style=\"font-weight: bold;\">Tuesday:</span> MAML Level 2 for those who qualified. You should turn in your forms to Mr. Roos tomorrow. You will still have your first block class.<br />\n<br />\n<span style=\"font-weight: bold;\">Thursday:</span> Final MML meet at Canton.");
INSERT INTO messages VALUES("160","21","2013-03-05 13:49:16","MML Meet 03-07-13","There is a half day this Thursday, so we get out at 11:15. However, for those of you going to the meet, we are still meeting at 2:30 in front of the school, so you will have to find something to do for approximately three hours.<br />\n<br />\nThe teams for the sixth MML meet at Canton on Thursday, March 7th, are<br />\n<br />\n<span style=\"text-decoration: underline;\">Regulars</span><br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nAditya Gopalan<br />\nCelina Hsieh<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nShohini Stout<br />\nEthan Zou<br />\n<br />\n<span style=\"text-decoration: underline;\">Alternates</span><br />\nTanmay Khale<br />\nDan Kim<br />\nAlan Qiu<br />\nAlan Burstein<br />\nClive Chan<br />\nRoshan Padaki<br />\nArul Prasad<br />\nDevin Shang<br />\nDavid Tu<br />\nEric Xia<br />\n<br />\n<br />\nIf you are in the above lists, you are expected to be present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains. Alternates will be taking all six rounds.<br />\n<br />\n<span style=\"font-weight: bold;\">Round 1:</span> Algebra 2: Simultaneous Equations and Determinants<br />\n<span style=\"font-weight: bold;\">Round 2:</span> Algebra 1: Exponents and Radicals<br />\n<span style=\"font-weight: bold;\">Round 3:</span> Trigonometry: Anything<br />\n<span style=\"font-weight: bold;\">Round 4:</span> Algebra 1: Anything<br />\n<span style=\"font-weight: bold;\">Round 5:</span> Plane Geometry: Anything<br />\n<span style=\"font-weight: bold;\">Round 6:</span> Probability and Binomial Theorem");
INSERT INTO messages VALUES("161","21","2013-03-07 09:07:43","MML","<span style=\"font-weight: bold;\">MML is postponed to next week, March 14th</span><br />\n<br />\nAs of now, there are no changes to the teams posted on Tuesday. If you e-mailed us saying you could not go to the meet today, but you are able to go next Thursday, you are still on the team. If you cannot go to the meet next Thursday, let us know.");
INSERT INTO messages VALUES("162","23","2013-03-09 22:54:36","ARML Tryouts","ARML Tryouts are TOMORROW Sunday, March 10th. It is held in Morse Hall, the math building right near the flagpole just off of Salem St, at Phillips Andover Academy. <br />\n<br />\nAlternatively, there is also a location at Canton High School but most of us will be at Andover Academy. <br />\n<br />\nTime: 1:00 - show up at 12:45 to about 4:00<br />\nWhere: Morse Hall, Phillips Andover Academy<br />\nWho: You<br />\nWhy: ARML<br />\nHow: Car<br />\n");
INSERT INTO messages VALUES("163","21","2013-03-10 17:39:17","Team Contest","The following people are currently listed to take the team contest:<br />\n<br />\nAditya Gopalan<br />\nAlan Burstein<br />\nAlbert Kim<br />\nAndrew Luo<br />\nArul Prasad<br />\nBrian Wang<br />\nClive Chan<br />\nDavid Amirault<br />\nDavid Tu<br />\nDevin Shang<br />\nEric Xia<br />\nEthan Zou<br />\nHenry Li<br />\nMark Jones<br />\nMatthew Weiss<br />\nMohammed Khan<br />\nRichard Huang<br />\nRohil Prasad<br />\nRoshan Padaki<br />\nSteven Qiu<br />\nSurya Bhupatiraju<br />\nTanmay Khale<br />\nYoojin Kim<br />\nZach Polansky<br />\n<br />\nIf you are participating, we ask that you be present for pretty much the entire contest, which will last until about 4:15 or 4:30 on March 25th. It can be rather frustrating for your teammates if you are not actually available on that day.<br />\n<br />\nPlease let us know if you change your mind/you have a conflict/we made an error and you wish to participate or not participate. The teams will be finalized before the end of tomorrow\'s meeting and problems will also be available tomorrow both at the meeting and online.");
INSERT INTO messages VALUES("164","21","2013-03-11 17:41:55","03-12-13 to 03-15-13","<span style=\"font-weight: bold;\">Tuesday:</span> NEML is tomorrow after school in room 800.<br />\n<br />\n<span style=\"font-weight: bold;\">Thursday:</span> The AIME I will be from 9 to 12. If you qualified for it and do not have a permission slip yet, see Mr. Roos.<br />\n<br />\nThe MML meet is also on this day after school. See <a href=\"http://www.lhsmath.org/Messages?View=160\" target=\"_blank\">here</a> and <a href=\"http://www.lhsmath.org/Messages?View=161\" target=\"_blank\">here</a> for details.");
INSERT INTO messages VALUES("165","21","2013-03-11 17:46:24","Team Contest","<span style=\"text-decoration: underline;\">Team 1</span><br />\nAditya Gopalan<br />\nAlbert Kim<br />\nDavid Amirault<br />\nEric Xia<br />\nRoshan Padaki<br />\nSurya Bhupatiraju<br />\n<br />\n<span style=\"text-decoration: underline;\">Team 2</span><br />\nAndrew Luo<br />\nClive Chan<br />\nDavid Tu<br />\nMatthew Weiss<br />\nUma Roy<br />\nZach Polansky<br />\n<br />\n<span style=\"text-decoration: underline;\">Team 3</span><br />\nHenry Li<br />\nMohammed Khan<br />\nRichard Huang<br />\nRohil Prasad<br />\nSteven Qiu<br />\nTanmay Khale<br />\n<br />\n<br />\nThe problems are available in the Files section on the website under 2012-13 Tests.");
INSERT INTO messages VALUES("166","21","2013-03-11 17:47:31","03-12-13 to 03-15-13 Clarification","MML is this Thursday.");
INSERT INTO messages VALUES("167","21","2013-03-11 22:48:04","Team Contest Corrections (1)","<span style=\"font-weight: bold;\">2:</span> The problem now deals with an infinite sequence a0, a1, ... instead of the finite sequence a1, a2, ..., an. The problem also now asks to find all such sequences.<br />\n<span style=\"font-weight: bold;\">3:</span> Slight wording changes have been made. The question itself has not changed.<br />\n<span style=\"font-weight: bold;\">10:</span> The segment XY is equal to 61, not 67.<br />\n<br />\nThe new version of the test, with the full corrections, is <a href=\"http://www.lhsmath.org/Download?ID=85\" target=\"_blank\">here</a>.");
INSERT INTO messages VALUES("168","21","2013-03-13 20:37:10","AIME/MML Reminder","The AIME is tomorrow. You will be missing B, HR, A, G, and H blocks.<br />\n<br />\nThe MML is also tomorrow.");
INSERT INTO messages VALUES("169","21","2013-03-13 20:39:46","AIME Addition","Unlike some previous competitions, the AIME will be in the <span style=\"font-weight: bold;\">Library Media Center</span>.");
INSERT INTO messages VALUES("170","21","2013-03-20 11:11:42","Team Contest Corrections (2)","Please note the following change:<br />\n<br />\nQuestion 19: The sum terminates at 40 instead of 100.<br />\n<br />\nThe new version of the Team Contest is <a href=\"http://www.lhsmath.org/Download?ID=86\" target=\"_blank\">here</a>.");
INSERT INTO messages VALUES("171","21","2013-03-24 16:05:52","Team Contest","The Team Contest is tomorrow. If you are participating, please try to be there as soon as possible so we can start. We will probably be going until 4 or 4:30.");
INSERT INTO messages VALUES("172","21","2013-03-26 23:58:56","Team Contest: Final","Team contest solutions are now online in the Files section. They will be updated in the near future with some alternate solutions and an actually correct solution to problem 26.");
INSERT INTO messages VALUES("173","23","2013-03-28 22:17:44","LMT Volunteers ","Hi everyone,<br />\n<br />\nLMT is <span style=\"font-weight: bold;\">THIS SATURDAY</span>. With close to 170 competitors we need a lot of volunteers. Volunteers must be able to do all of the following:<br />\n1. Follow directions<br />\n2. Act maturely in front of middle schoolers.<br />\n<br />\nIf these requirements are too difficult for you, please disregard the rest of this message. <br />\n<br />\nVolunteers will be needed primarily in grading and proctoring. Volunteers must show up at 7:00 and bring $10 to buy a shirt.<br />\n<br />\nThe competition will end at roughly 4:00 PM - this includes clean up. You will get community service/NHS hours at the end. <br />\n<br />\nIf you are interested in volunteering, you <span style=\"font-weight: bold;\">must reply</span> back. A quick &quot;I will show up&quot; is sufficient. <br />\n<br />\nThanks,<br />\nCaptains ");
INSERT INTO messages VALUES("174","23","2013-03-28 22:20:08","Correction","Volunteers show up at 7:15 please. Get your extra sleep. ");
INSERT INTO messages VALUES("175","21","2013-03-29 21:00:19","LMT: Final Reminders","If you are volunteering at LMT tomorrow, please be there at <span style=\"font-weight: bold;\">7:15 AM</span>. We have a good amount of setup work to do.<br />\n<br />\nBring $10 for an LMT t-shirt. This shirt indicates that you are a staff member.<br />\n<br />\nSome important details:<br />\n<br />\n<span style=\"font-weight: bold;\">Payments are to be handled only by the treasurer (Peijin Zhang) or Mr. Roos.</span> If someone tries to give you money, politely direct them to one of those two.<br />\n<br />\n<span style=\"font-weight: bold;\">No information about results is to leave HQ until the competition is over.</span> This includes answering a competitor\'s question about results, talking about said results loudly outside of HQ, etc.<br />\n<br />\nHQ will be located in the main building teachers\' lounge. An easy way to find it is to look for the sign that says YOU SHALL NOT PASS.<br />\n<br />\nThere will be middle schoolers. Be mature.");
INSERT INTO messages VALUES("176","21","2013-03-31 17:21:14","States Rounds","If you would like to have a chance to make the team for the State Meet on April 8th and have not taken all of the rounds, please let us know as soon as possible.");
INSERT INTO messages VALUES("177","21","2013-04-01 00:26:02","04-01-13 to 04-05-13","<span style=\"font-weight: bold;\">Monday:</span> We will be doing two or three New England meet rounds. Before or after that, we may have a lecture on some to-be-determined topic.");
INSERT INTO messages VALUES("178","21","2013-04-03 20:56:58","State Meet","The team for the State Meet is<br />\n<br />\nHao Shen<br />\nPeijin Zhang<br />\nAlan Zhou<br />\nRohil Prasad<br />\nJonathan Tidor<br />\nNoah Golowich<br />\nArjun Khandelwal<br />\nClive Chan<br />\n<br />\nThe meet is on Monday, April 8th at Shrewsbury. As a result, there is no math team meeting on that day.");
INSERT INTO messages VALUES("179","21","2013-04-21 13:56:38","Extra New England Rounds","There is an additional set of New England meet rounds online in the Files section (titled New England Extra). If you would like to do them and have them scored, submit answers via email no later than <span style=\"font-weight: bold;\">Monday at 8 PM</span>. Alternatively, bring them to the meeting tomorrow.<br />\n<br />\nNote: Doing these rounds may improve your chances of being selected for the New England meet on Friday, April 26th.");
INSERT INTO messages VALUES("180","21","2013-04-21 22:13:27","04-22-13 to 04-26-13","<span style=\"font-weight: bold;\">Monday:</span> We will do the last four rounds for the New England meet.<br />\n<br />\n<span style=\"font-weight: bold;\">Friday:</span> New England meet. Blocks E, F, G, and H will be excused for the people that qualify.<br />\n<br />\n<span style=\"font-weight: bold;\">TBD (likely Wednesday):</span> Purple Comet, hopefully. Start thinking about and talking to people for teams. Teams can have up to 6 people and the competition lasts for 90 minutes. More details soon.");
INSERT INTO messages VALUES("181","21","2013-04-23 13:10:59","New England Meet Team","The team for the New England meet is<br />\n<br />\nHao Shen<br />\nAditya Gopalan<br />\nCelina Hsieh<br />\nRohil Prasad<br />\nArjun Khandelwal<br />\nZach Polansky<br />\nShohini Stout<br />\nClive Chan<br />\n<br />\nThe meet is on Friday, April 26th.");
INSERT INTO messages VALUES("182","21","2013-04-23 13:23:43","USA(J)MO Qualifiers","If you qualified to take the USA(J)MO, then you should have received an email with your student number and S-III form.<br />\n<br />\nIf you did not get said email and you are on the qualifiers list (see <a href=\"http://www.artofproblemsolving.com/Forum/viewtopic.php?f=133&amp;t=529366\" target=\"_blank\">here</a> and <a href=\"http://www.artofproblemsolving.com/Forum/viewtopic.php?f=133&amp;t=529364\" target=\"_blank\">here</a>), you will probably need to find Mr. Roos and ask him about your student number. The student letter with S-III form will be available in the Files section on the lhsmath website until the end of tomorrow, April 24th, in case you need it (it may also be on the AMC website). You will need your student number on the form.<br />\n<br />\n<span style=\"font-weight: bold;\">You should make sure your S-III form is sent on or before April 24th.</span>");
INSERT INTO messages VALUES("183","21","2013-04-24 10:23:27","Purple Comet","It will be after school today in room 800, if you want to participate. We would like to get started as soon as possible, preferably a little after 3 PM because of the AP pre-bubbling, and the competition will last for 90 minutes.<br />\n<br />\nIf you already have a team at this point, have one person respond to this email with<br />\n- Team name<br />\n- Full names of each member of the team and whether they are in grade 9/10/11/12<br />\nWe can register teams after school, but the more teams we can register beforehand, the earlier we can start.");
INSERT INTO messages VALUES("184","23","2013-04-24 10:43:10","New England Meet","Updated list of people who are going: <br />\n<br />\nClive Chan <br />\nMatthew Weiss <br />\nArjun Khandelwal <br />\nShohini Stout <br />\nAditya Gopalan <br />\nCelina Hsieh <br />\nRohil Prasad <br />\nHao Shen <br />\n<br />\nYou will be missing EFGH - the last 4 blocks of THIS FRIDAY. We will come back around 6.<br />\n<br />\nPlease send hao@lhsmath.org your round preferences <br />\nRound 1: Arithmetic and Number Theory	<br />\nRound 2: Algebra 1<br />\nRound 2: Geometry	<br />\nRound 4: Algebra 2	<br />\nRound 5: Analytic Geometry	<br />\nRound 6: Trig and Complex Numbers<br />\n<br />\nWe will be eating lunch at a McDonalds in Canton. Please bring money depending on how much you plan on eating. <br />\n<br />\n<br />\n");
INSERT INTO messages VALUES("185","23","2013-04-25 19:49:21","New England Meet","For those who are going, remember to meet at front of the school at 12! ");
INSERT INTO messages VALUES("186","23","2013-04-28 16:58:48","Math Team 4/29","Hi everyone,<br />\n<br />\nTomorrow, we will discuss the events or activities that we would like to do until the end of the year. We will also do 1 or 2 lectures. <br />\n<br />\nIf you want to give a mini lecture on an interesting topic, tell us what you want to do by tomorrow (12:00 AM). If you want to become a captain, this is highly encouraged.<br />\n<br />\nCaptains ");
INSERT INTO messages VALUES("187","34","2013-05-14 17:23:31","Webmaster","Hey everyone,<br />\n<br />\nThe math team needs a new webmaster for next year. Responsibilities are making sure the site doesn\'t break, calling Benjamin Tidor if something does break, and running the Guts round and Registration at LMT. <br />\n<br />\nRequired skills in order of importance:<br />\nAbility to follow directions and click some buttons<br />\nAbility to call a phone<br />\nWorking knowledge of MySQL, PHP, HTML, cPanel, FTP, SSH, or the ability to learn the basics<br />\n<br />\nSince this would be a great benefit to the math team you could also get community service hours for whatever time you end up putting into it.<br />\n<br />\nIf this sounds like something you\'d want to do and you feel you possess the required skillset please email me at peijin@lhsmath.org<br />\n<br />\n");
INSERT INTO messages VALUES("188","23","2013-05-20 20:03:46","Math Team NOSB Football Game","As per tradition, there will be a Math Team vs NOSB football game. <br />\n<br />\nWhen: Saturday May 25th, 3:00 PM<br />\nWhere: Field in the track at the high school. If this place is occupied we will move to the fields by Hayden. <br />\nBring: clothes, sunscreen, water, football/frisbee if you have one<br />\n<br />\nUsually we win so there is no concern about the outcome of this weekend. Even if you don\'t like football/frisbee just come hang out with people or watch math team win. We look forward to seeing people there!");
INSERT INTO messages VALUES("189","23","2013-05-24 19:07:51","Football Game Update","Hi everyone, <br />\n<br />\nWe are aware that there is a very likely chance that the weather is bad tomorrow. We will update what is going on at noon tomorrow. ");
INSERT INTO messages VALUES("190","23","2013-05-25 12:06:46","Football game postponed","Hey everyone,<br />\n<br />\nSo the fields are closed today and it\'s going to rain later. We are postponing the game to Monday. Same place, same time. ");
INSERT INTO messages VALUES("191","23","2013-05-26 23:17:33","Game Remidn","Reminder that the game is TOMORROW. Please show up at 3 at the center fields. If those are occupied we will go to the fields by Hayden. ");
INSERT INTO messages VALUES("192","23","2013-06-02 23:17:18","End of the Year Party","Hey everyone!<br />\n<br />\nThis is the last message. The end of the year party is tomorrow afterschool! Please come for awards, food, and farewell hugs!<br />\n<br />\n");
INSERT INTO messages VALUES("193","37","2013-09-05 20:32:56","First math team meeting -- next Friday","Hi everyone,<br />\n<br />\nThe first math team meeting of the year will be Friday, September 13th, and our meetings will continue to be on Fridays, not Mondays. We will meet in Room 831.<br />\n<br />\nPlease spread the word to people who were not on the math team last year. We hope to see you all there.<br />\n<br />\n-Captains");
INSERT INTO messages VALUES("194","37","2013-09-19 16:18:59","Math team meeting tomorrow","Hey everyone,<br />\n<br />\nTomorrow\'s (Friday 9/20) math team meeting will be at 3:00 in Room 831, as usual. We will be going over some of the &quot;tryout&quot; problems and then giving a lecture.<br />\n<br />\n-Captains");
INSERT INTO messages VALUES("202","37","2013-10-03 22:14:30","Math team meeting tomorrow","Hey all,<br />\n<br />\nIn tomorrow\'s (Friday) meeting, we will have a lecture on &quot;Difference Equations and Chaos&quot; and then will do a couple rounds.<br />\n<br />\nThe team contest will be the week after tomorrow, Friday, October 11th.<br />\n");
INSERT INTO messages VALUES("200","37","2013-09-28 20:31:39","Team Contest","Hey everyone,<br />\n<br />\nEmails will be sent to individual teams for the team contest shortly. Please let us know if you do not receive an email tonight but signed up to take the team contest.<br />\n<br />\nAlso, there is an error in problem 9. The first few words should read &quot;Prove that if a, b, c &gt;= 0, and 2ab^2/(b+c) + 2bc^2/(c+a) + 2ca^2/(a+b) &lt;= ab + bc + ac...&quot;.");
INSERT INTO messages VALUES("201","22","2013-10-01 00:48:04","MML Meet One Teams","The teams for the first MML meet at Weston on Thursday, October 3rd, are<br />\n<br />\nRegulars<br />\nThomas Chen<br />\nJeana Choi<br />\nJason Dimasi<br />\nNoah Golowich<br />\nArjun Khandelwal<br />\nZachary Polansky<br />\nRohil Prasad<br />\nShohini Stout<br />\nMaggie Zhang<br />\nEthan Zou<br />\n<br />\nAlternates<br />\nNirmal Balachundhar<br />\nAlan Burstein<br />\nRichard Huang<br />\nArul Prasad<br />\nAlan Qiu<br />\nSteven Qiu<br />\nBrian Wang<br />\nMatthew Weiss<br />\nEric Xia<br />\nSherry Ye<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, rank the following categories from most preferred to least preferred.  You will only take part in three categories.  Email your ranking to captains@lhsmath.org.  Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Geometry: Volumes and Surfaces<br />\nRound 2: Plane Geometry: Pythagorean relations in rectilinear figures<br />\nRound 3: Algebra 1: Linear Equations<br />\nRound 4: Algebra 1: Fractions and Mixed Numbers<br />\nRound 5: Algebra 2: Inequalities and Absolute Value<br />\nRound 6: Algebra 1: Evaluations<br />\n<br />\nFor those of you unfamiliar with the format of the competition, each round is ten minutes.  Regulars participate in three of the six rounds each, and alternates participate in all six rounds.  There is also a team round in which all ten people on a team work together.  <br />\n<br />\n~LHS Math Team Captains");
INSERT INTO messages VALUES("199","33","2013-09-27 16:50:33","MML and Team Contest","MML: If you weren\'t at math team today, but want to go to the MML, you should e-mail us so we can set up a time for you to take the tryouts.<br />\nThe MML will be on Thursday after school, we will E-mail a list of people that will go to the competition later once everyone has taken the rounds.<br />\n<br />\nTeam Contest: If you weren\'t at math team, or just didn\'t take a copy of the team contest, E-mail us TODAY OR TOMORROW so that we can assign everyone a team. We will also send out a list of teams, but until then, try to solve as many as you can :)");
INSERT INTO messages VALUES("203","37","2013-10-08 16:43:49","Teams for GBML tomorrow","Hi all,<br />\n<br />\nBelow are the teams for the GBML meet tomorrow. If you are in the below lists, please meet outside the front of the school at 2:30pm. If you will not be coming to the meet but your name is on the list below, please email us at captains@lhsmath.org as soon as possible so we can replace you.<br />\n<br />\nRegulars, please rank rounds from most preferred to least preferred and send preferences to captains@lhsmath.org.<br />\n<br />\nRegular alpha:<br />\nShohini Stout<br />\nZach Polansky<br />\nRohil Prasad<br />\nHenry Li<br />\nJason Dimasi<br />\n<br />\nRegular beta:<br />\nWilliam Zen<br />\nArul Prasad<br />\nEthan Zou<br />\nAlbert Kim<br />\nDevin Shang<br />\n<br />\nAlternates alpha:<br />\nMaggie Zhang<br />\nAlan Burstein<br />\nAlan Qiu<br />\nSabrina Zhang<br />\nSteven Qiu<br />\n<br />\nAlternates beta:<br />\nSuchith De Silva<br />\nKaushal Balagurusamy<br />\nThomas Chen<br />\nNirmal Balachundhar<br />\nKaren Zhou<br />\n<br />\nGBML is the same format as MML, except teams of 10 are broken down into 2 teams of 5. This means that there are 2 regular teams and 2 alternate teams. Also remember that rounds are 10 minutes, and the questions are worth: 1 point, 2 points, 3 points, in that order (this is different from MML). The team round is 12 minutes and has 3 problems, worth 3, 3, and 4 points, in that order.<br />\n");
INSERT INTO messages VALUES("204","37","2013-10-08 17:59:29","Addition to previous message","You may want to know the rounds for GBML, to know which ones to pick (for regulars):<br />\n<br />\nRound 1	    Arithmetic	    Open<br />\nRound 2	    Algebra 1	    Problem Solving (Word Problems)<br />\nRound 3	    Algebra 1	    Exponents and Radicals; Equations involving them<br />\nRound 4	    Algebra 2	    Factoring; Equations involving Factoring<br />\nRound 5	    Trigonometry	   Angular and Linear Velocity; Right Triangle Trigonometry");
INSERT INTO messages VALUES("205","33","2013-10-09 21:11:17","Next Math Club","Next meet will consist of the team contest. If you haven\'t done any of the problems or talked with your team, you might want to do that.<br />\n<br />\nWe also will say a couple reminders about upcoming contests.<br />\n<br />\nIf you lost your team contest and are on a team,we can e-mail you a new one.<br />\n<br />\nIf you aren\'t going to be there on Friday, we can also E-mail you the incoming contest info.<br />\n<br />\n");
INSERT INTO messages VALUES("206","33","2013-10-10 07:12:15","ERROR on problem #16","It should say &quot;No arrow points directly toward another arrow&quot;, not &quot;No two arrows may point toward each other&quot;");
INSERT INTO messages VALUES("207","37","2013-10-12 10:34:39","HMMT Information -- please respond!","The HMMT is a tournament that takes place at Harvard/MIT. There are two tournaments: one on November 9, 2013, and the other on February 22, 2014. These tournaments last much of the day.<br />\n<br />\n<span style=\"text-decoration: underline;\">Please let us know at captains@lhsmath.org <span style=\"font-weight: bold;\">as soon as possible</span> (aka in the next day/two)</span> whether or not you are available to attend either of these tournaments. We need to know how many of you are available to be able to register the proper number of teams.<br />\n<br />\nThank you.");
INSERT INTO messages VALUES("208","37","2013-10-17 22:45:11","Math team meeting tomorrow","In tomorrow\'s math team meeting, we will have a lecture, &quot;Euler\'s Magical Formula&quot;, and will do a tryout.");
INSERT INTO messages VALUES("209","37","2013-10-21 22:28:06","Club Picture Tomorrow","We have a math team club picture tomorrow (Tuesday) after school. The picture will be taken directly after school in Commons II.");
INSERT INTO messages VALUES("210","22","2013-10-23 21:54:02","MAML","Just a reminder that tomorrow is the MAML contest, held during C and B blocks (first two blocks of the day).  To know if you\'re registered, go to My Scores and look for somewhere where it says &quot;Going to MAML?&quot;  If it says &quot;Yes&quot; to the right of that, you can take the test as you are registered and are excused.  If it says &quot;No&quot; or it never says &quot;Going to MAML?&quot; you aren\'t registered and you should go to your classes.<br />\n<br />\nIf you are registered and your last name begins with A-L, go to room 801 promptly by 7:45 and if your last name begins with M-Z, go to room 828 promptly by 7:45.<br />\n<br />\nRemember -- there are no calculators permitted, and do your best because there is a second level for the top 100 students in Massachusetts.");
INSERT INTO messages VALUES("211","37","2013-10-31 23:15:14","Math team meeting tomorrow","Hey all,<br />\n<br />\nIn tomorrow\'s math team meeting, we will have a lecture on &quot;Tic-tac-toe and combinatorial games&quot;, do some MML rounds, and discuss logistics on Mandelbrot/HMNT.<br />\n<br />\nPS If you are receiving this message, then the mailing list is working again :). If not, then you are not reading this, so this sentence is useless. :(");
INSERT INTO messages VALUES("220","37","2013-11-05 15:49:29","test","This is a test of the mailing list. It is not expected to work, but I am hopeful.");
INSERT INTO messages VALUES("221","22","2013-11-06 17:19:22","MML Meet Two Teams","Here are the MML teams for the meet tomorrow (November 7th):<br />\n<br />\nRegulars:<br />\nNoah Golowich<br />\nAditya Gopalan<br />\nAlbert Kim<br />\nHenry Li<br />\nZach Polansky<br />\nArul Prasad<br />\nRohil Prasad<br />\nAlan Qiu<br />\nShohini Stout<br />\nEthan Zou<br />\n<br />\nAlternates<br />\nRahul Ahuja<br />\nNirmal Balachundhar<br />\nJeana Choi<br />\nJason Dimasi<br />\nJohn Guo<br />\nSteven Qiu<br />\nDevin Shang<br />\nMatthew Weiss<br />\nWilliam Zen<br />\nMaggie Zhang<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains at captains@lhsmath.org, or let us know that you cannot go to the meet as soon as possible. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Algebra 2: Complex Numbers (no Trig)<br />\nRound 2: Algebra 1: Anything<br />\nRound 3: Plane Geometry: Area of rectilinear figures<br />\nRound 4: Algebra 1: Factoring and its applications<br />\nRound 5: Trigonometry: Functions of 30, 45, 60 &amp; 90 and their integral multiples<br />\nRound 6: Plane Geometry: Angles about a point, triangles, and parallels<br />\n<br />\nThe meet will be held in Canton.");
INSERT INTO messages VALUES("216","37","2013-11-03 13:26:06","HMMT Teams","This information should have been sent out to you via a different email, but here it is just in case: <br />\n<br />\nBelow are the HMNT/HMMT Teams. The HMNT is on November 9, 2013. For those people on an HMNT team: We will arrive between 8-8:45am, so if you plan to take the bus from LHS, then you will have to arrive earlier (we will give specifics later this week). The tournament ends between 4:30 and 5:15. For more information, see http://web.mit.edu/hmmt/www/november/datafiles/schedules/2013-november.shtml.<br />\n<br />\nIf you are on an HMMT team, then we will send more information later, as that tournament is in February.<br />\n<br />\nIf you are on a below team and can not go to the competition you were selected for, then please let us know at captains@lhsmath.org ASAP.<br />\n<br />\nIMPORTANT: If you are attending the November Competition (that is, HMNT), please ask your parents if they can be a chaperone. All parent volunteers for chaperones must be CORI\'d.<br />\n<br />\nHMMT Team 1:<br />\nRohil Prasad<br />\nNoah Golowich<br />\nShohini Stout<br />\nZach Polansky<br />\nAlan Qiu<br />\nClive Chan<br />\nEthan Zou<br />\nSteven Qiu<br />\n<br />\nHMMT Team 2:<br />\nMatthew Weiss<br />\nArjun Khandelwal<br />\nTanmay Khale<br />\nAditya Gopalan<br />\nCelina Hsieh<br />\nSuchith De Silva<br />\nHenry Li<br />\nAlan Burstein<br />\n<br />\nHMNT Team 1:<br />\nArul Prasad<br />\nJason Dimasi<br />\nJeana Choi<br />\nMaggie Zhang<br />\nBrian Wang<br />\nDevin Shang<br />\n<br />\nHMNT Team 2:<br />\nThomas Chen<br />\nRoshan Padaki<br />\nEmily Zhang<br />\nAlbert Kim<br />\nAngela Gong<br />\nRichard Huang<br />\n<br />\nHMNT Team 3:<br />\nWilliam Zen<br />\nKara Luo<br />\nSabrina Zhang<br />\nSherry Ye<br />\nJohn Guo<br />\nNirmal Balachundhar<br />\n<br />\nHMNT Team 4:<br />\nEric Xia<br />\nKaren Zhou<br />\nMorgan Daciuk<br />\nMark Jones<br />\nUma Roy<br />\nReggie Luo");
INSERT INTO messages VALUES("217","37","2013-11-03 13:27:07","Mandelbrot","This information should have been sent out to you, but here it is just in case:<br />\n<br />\nMandelbrot #1 is next Tuesday; it is right after school in Room 831. The test lasts 40 minutes, and has 7 questions.<br />\n<br />\nThere are 2 levels: regional (easier), national (harder). There is some overlap (about 4-5 questions) between the 2 levels. For those of you who took the NEML #1 contest earlier this year, both levels of Mandelbrot are harder than the NEML.");
INSERT INTO messages VALUES("222","22","2013-11-12 19:02:05","GBML teams for 11/13","So GBML is tomorrow.  Here are the teams.<br />\n<br />\nAlpha:<br />\nNoah Golowich<br />\nHenry Li<br />\nRohil Prasad<br />\nSteven Qiu<br />\nShohini Stout<br />\n<br />\nBeta:<br />\nAlan Burstein<br />\nJohn Guo<br />\nArul Prasad<br />\nEthan Zou<br />\nMaggie Zou<br />\n<br />\nAlternates:<br />\nClive Chan<br />\nThomas Chen<br />\nJeana Choi<br />\nMorgan Daciuk<br />\nKatie Fraser<br />\nAlan Qiu<br />\nRavi Raghavan<br />\nEric Xia<br />\nWilliam Zen<br />\nSabrina Zhang<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM tomorrow. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1: Arithmetic: Open<br />\nRound 2: Simultaneous Linear Equations and Word Problems, Matrices	<br />\nRound 3: Geometry: Angles and Triangles<br />\nRound 4: Algebra 2: Quadratic Equations and problems involving them, Theory of Quadratics<br />\nRound 5: Trigonometric Equations <br />\n<br />\nPlease remember not to use a calculator.");
INSERT INTO messages VALUES("223","33","2013-11-17 16:42:00","Two announcements","1.) If you have any theme ideas for the theme round or problems for the LMT which you would like to submit, please e-mail us (at captains@lhsmath.org). <br />\n<br />\nWe will vote on the theme ideas that people send for the theme round.<br />\n<br />\n2.) If you would like take the second team contest (Has both more time and easier range of difficulty),  EVEN IF YOU SIGNED UP FOR THE FIRST ONE, you should E-mail to sign-up.<br />\n<br />\nThe problems will be handed out and E-mailed out on Friday.<br />\n<br />\n<br />\n<br />\n");
INSERT INTO messages VALUES("224","33","2013-11-17 21:54:21","Two announcements","1.) If you have any theme ideas for the theme round or problems for the LMT which you would like to submit, please e-mail us (at captains@lhsmath.org). <br />\n<br />\nWe will vote on the theme ideas that people send for the theme round.<br />\n<br />\n2.) If you would like take the second team contest (Has both more time and easier range of difficulty), EVEN IF YOU SIGNED UP FOR THE FIRST ONE, you should E-mail to sign-up.<br />\n<br />\nThe problems will be handed out and E-mailed out on Friday.");
INSERT INTO messages VALUES("225","37","2013-11-22 14:32:05","Test","This is a test of the mailing system. If you get this, then we are all happy.<br />\n<br />\nPS Happy Thanksgiving.");
INSERT INTO messages VALUES("226","37","2013-12-01 22:19:01","Mandelbrot and NEML","Hey all,<br />\n<br />\nMandelbrot #2 is tomorrow (Monday), right after school. Please arrive <span style=\"font-weight: bold;\">right after school</span> (2:25-2:30), as the we will start at 2:30 sharp.<br />\n<br />\nNEML #2 is Tuesday, also right after school. As with Mandelbrot, it will start at <span style=\"font-weight: bold;\">2:30 sharp.</span>");
INSERT INTO messages VALUES("227","22","2013-12-04 20:14:32","MML Meet Three Teams","Regulars: <br />\nJason Dimasi<br />\nHenry Li<br />\nZach Polansky<br />\nArul Prasad<br />\nAlan Qiu<br />\nSteven Qiu<br />\nShohini Stout<br />\nWilliam Zen<br />\nMaggie Zhang<br />\nEthan Zou<br />\n<br />\nAlternates:<br />\nAlan Burstein<br />\nThomas Chen<br />\nJeana Choi<br />\nAngela Gong<br />\nAlbert Kim<br />\nKara Luo<br />\nDevin Shang<br />\nMatthew Weiss<br />\nSherry Ye<br />\nSabrina Zhang<br />\n<br />\nIf you are in the above lists, you are expected to present at the front doors of the school at 2:30 PM this Thursday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\nRegulars, select the three categories you would like to do at the meet from the six below and send your preferences to the captains, again at captains@lhsmath.org. Alternates will be taking all six rounds.<br />\n<br />\nRound 1: Trigonometry: Right angle problems, Laws of Sine and Cosine<br />\nRound 2: Elementary Number Theory/Arithmetic<br />\nRound 3: Coordinate Geometry of Lines and Circles<br />\nRound 4: Algebra 2: Log &amp; Exponential Functions<br />\nRound 5: Algebra 1: Ratio, Proportion or Variation<br />\nRound 6: Plane Geometry: Polygons (no areas) ");
INSERT INTO messages VALUES("228","33","2013-12-07 17:25:11","GBML","ALPHA:<br />\nArul Prasad<br />\nJason Dimasi<br />\nNoah Golowich<br />\nRohil Prasad<br />\nZach Polansky<br />\n<br />\nBETA:<br />\nAngela Gong<br />\nBenjamin Li<br />\nHenry Li<br />\nShohini Stout<br />\nThomas Chen<br />\n<br />\nAlternates:<br />\nAlan Qiu*<br />\nAlbert Kim<br />\nDavid Amirault*<br />\nDevin Zhang<br />\nJeff Zhu<br />\nKaushal Balagurusamy*<br />\nMorgan Daciuk<br />\nRahul Ajuja<br />\nSabrina Zhang<br />\nWilliam Zen<br />\n<br />\n<br />\nIf you are named above, you are expected to be at the front doors of the school at 2:30 PM Wednesday. If you cannot go, email the captains at captains@lhsmath.org as soon as possible so that we can find a replacement.<br />\n<br />\n*You are listed as a maybe. Please check whether you can go to the MML and E-mail us. Thanks!<br />\n<br />\nRegulars (alpha and beta), pick the three categories you would like to do at the meet from the five below and send them to the captains, again at captains@lhsmath.org. Alternates will be taking all five rounds.<br />\n<br />\nRound 1	   Algebra 1	   Fractions and Word Problems<br />\nRound 2	   Coordinate Geometry of the Straight Line	   <br />\nRound 3	   Geometry	   Polygons: Area and Perimeter<br />\nRound 4	   Algebra 2	   Logs, Exponents, Radicals and equations involving them<br />\nRound 5	   Trigonometric Analysis and Complex Numbers in Trigonometric form<br />\nTeam Round	   Open<br />\n<br />\nPlease remember not to use a calculator.<br />\n<br />\n<br />\n<br />\n<br />\n<br />\n");
INSERT INTO messages VALUES("229","37","2013-12-12 21:25:39","tomorrow","Hey everyone,<br />\n<br />\nThere will be a math team meeting tomorrow. There will probably be a lecture of some sort. We will also probably talk about LMT.");
INSERT INTO messages VALUES("230","37","2013-12-18 21:21:45","Alumni Day this Friday","Hey all,<br />\n<br />\nWe are having <span style=\"font-weight: bold;\"> Alumni Day this Friday after school </span>. This is an excellent opportunity to meet LHS Math Team alumni and to ask them questions about college life, etc.");
INSERT INTO messages VALUES("231","124","2014-02-03 16:19:44","test","test");
INSERT INTO messages VALUES("232","124","2014-02-03 16:22:27","test","test");
INSERT INTO messages VALUES("233","124","2014-02-03 16:24:45","test","test");
INSERT INTO messages VALUES("234","124","2014-02-03 16:26:46","test","test");
INSERT INTO messages VALUES("235","124","2014-02-04 07:05:35","test","test");
INSERT INTO messages VALUES("236","124","2014-02-04 07:06:01","test","test");
INSERT INTO messages VALUES("237","124","2014-02-04 07:06:40","test","test");
INSERT INTO messages VALUES("238","124","2014-02-04 10:44:19","test","test");
INSERT INTO messages VALUES("239","124","2014-02-04 10:45:13","test","test");
INSERT INTO messages VALUES("240","124","2014-02-04 10:47:01","test","test");
INSERT INTO messages VALUES("241","124","2014-02-04 10:48:01","test","test");
INSERT INTO messages VALUES("242","124","2014-02-04 10:49:38","test","test");
INSERT INTO messages VALUES("243","124","2014-02-04 10:51:08","test","test");
INSERT INTO messages VALUES("244","124","2014-02-04 10:52:22","test","test");
INSERT INTO messages VALUES("245","124","2014-02-04 10:54:07","test","test");
INSERT INTO messages VALUES("246","124","2014-02-04 10:54:21","test","test");
INSERT INTO messages VALUES("247","124","2014-02-04 10:54:52","test","test");
INSERT INTO messages VALUES("248","124","2014-02-04 10:55:01","test","test");
INSERT INTO messages VALUES("249","124","2014-02-04 10:55:14","test","test");
INSERT INTO messages VALUES("250","124","2014-02-04 10:55:24","test","test");
INSERT INTO messages VALUES("251","124","2014-02-04 10:55:34","test","test");
INSERT INTO messages VALUES("252","124","2014-02-04 10:55:44","test","test");
INSERT INTO messages VALUES("253","124","2014-02-04 10:55:59","test","test");
INSERT INTO messages VALUES("254","124","2014-02-04 10:57:47","test","test");
INSERT INTO messages VALUES("255","124","2014-02-04 11:00:48","test","test");
INSERT INTO messages VALUES("256","124","2014-02-04 11:03:18","test","test");
INSERT INTO messages VALUES("257","124","2014-02-04 11:05:53","test","test");
INSERT INTO messages VALUES("258","124","2014-02-04 11:07:23","test","test");



DROP TABLE IF EXISTS test_scores;

CREATE TABLE `test_scores` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4923 DEFAULT CHARSET=latin1;

INSERT INTO test_scores VALUES("4","2","6","9");
INSERT INTO test_scores VALUES("3","2","2","16");
INSERT INTO test_scores VALUES("5","2","7","5");
INSERT INTO test_scores VALUES("6","2","28","7");
INSERT INTO test_scores VALUES("7","2","3","5");
INSERT INTO test_scores VALUES("8","2","1","5");
INSERT INTO test_scores VALUES("9","2","31","3");
INSERT INTO test_scores VALUES("10","2","30","3");
INSERT INTO test_scores VALUES("11","2","4","5");
INSERT INTO test_scores VALUES("12","2","24","3");
INSERT INTO test_scores VALUES("13","2","9","4");
INSERT INTO test_scores VALUES("14","2","5","3");
INSERT INTO test_scores VALUES("15","2","23","9");
INSERT INTO test_scores VALUES("16","2","33","15");
INSERT INTO test_scores VALUES("17","2","12","4");
INSERT INTO test_scores VALUES("18","2","22","8");
INSERT INTO test_scores VALUES("19","2","27","3");
INSERT INTO test_scores VALUES("20","2","32","9");
INSERT INTO test_scores VALUES("21","2","26","3");
INSERT INTO test_scores VALUES("22","2","37","6");
INSERT INTO test_scores VALUES("23","2","29","9");
INSERT INTO test_scores VALUES("24","7","38","6");
INSERT INTO test_scores VALUES("25","7","4","2");
INSERT INTO test_scores VALUES("26","7","28","4");
INSERT INTO test_scores VALUES("27","7","37","2");
INSERT INTO test_scores VALUES("28","7","40","6");
INSERT INTO test_scores VALUES("29","7","9","4");
INSERT INTO test_scores VALUES("30","7","35","0");
INSERT INTO test_scores VALUES("31","7","27","0");
INSERT INTO test_scores VALUES("32","7","2","6");
INSERT INTO test_scores VALUES("33","7","31","6");
INSERT INTO test_scores VALUES("34","7","33","6");
INSERT INTO test_scores VALUES("35","7","39","0");
INSERT INTO test_scores VALUES("36","7","36","4");
INSERT INTO test_scores VALUES("37","7","30","2");
INSERT INTO test_scores VALUES("38","7","3","0");
INSERT INTO test_scores VALUES("39","7","6","6");
INSERT INTO test_scores VALUES("40","7","1","6");
INSERT INTO test_scores VALUES("41","7","34","6");
INSERT INTO test_scores VALUES("42","7","5","6");
INSERT INTO test_scores VALUES("43","7","32","6");
INSERT INTO test_scores VALUES("44","7","23","4");
INSERT INTO test_scores VALUES("45","7","22","4");
INSERT INTO test_scores VALUES("1217","57","23","4");
INSERT INTO test_scores VALUES("47","6","34","4");
INSERT INTO test_scores VALUES("48","6","10","0");
INSERT INTO test_scores VALUES("49","6","3","2");
INSERT INTO test_scores VALUES("50","6","33","6");
INSERT INTO test_scores VALUES("51","6","39","2");
INSERT INTO test_scores VALUES("52","6","1","4");
INSERT INTO test_scores VALUES("53","6","42","0");
INSERT INTO test_scores VALUES("54","6","5","2");
INSERT INTO test_scores VALUES("55","6","29","4");
INSERT INTO test_scores VALUES("56","6","32","4");
INSERT INTO test_scores VALUES("57","6","23","6");
INSERT INTO test_scores VALUES("58","6","6","6");
INSERT INTO test_scores VALUES("59","6","36","6");
INSERT INTO test_scores VALUES("60","6","30","0");
INSERT INTO test_scores VALUES("61","6","2","6");
INSERT INTO test_scores VALUES("62","6","40","6");
INSERT INTO test_scores VALUES("63","6","37","4");
INSERT INTO test_scores VALUES("64","6","28","6");
INSERT INTO test_scores VALUES("65","6","9","0");
INSERT INTO test_scores VALUES("66","6","4","2");
INSERT INTO test_scores VALUES("67","6","38","2");
INSERT INTO test_scores VALUES("68","6","26","2");
INSERT INTO test_scores VALUES("69","6","35","0");
INSERT INTO test_scores VALUES("70","6","27","2");
INSERT INTO test_scores VALUES("71","6","31","4");
INSERT INTO test_scores VALUES("72","6","22","4");
INSERT INTO test_scores VALUES("73","2","55","6");
INSERT INTO test_scores VALUES("74","2","73","4");
INSERT INTO test_scores VALUES("75","2","69","0");
INSERT INTO test_scores VALUES("76","2","39","2");
INSERT INTO test_scores VALUES("77","5","6","6");
INSERT INTO test_scores VALUES("78","5","3","4");
INSERT INTO test_scores VALUES("79","5","1","2");
INSERT INTO test_scores VALUES("80","5","42","4");
INSERT INTO test_scores VALUES("81","5","33","4");
INSERT INTO test_scores VALUES("82","5","39","0");
INSERT INTO test_scores VALUES("83","5","36","4");
INSERT INTO test_scores VALUES("84","5","30","6");
INSERT INTO test_scores VALUES("290","9","39","0");
INSERT INTO test_scores VALUES("86","5","2","6");
INSERT INTO test_scores VALUES("87","5","40","4");
INSERT INTO test_scores VALUES("88","5","28","4");
INSERT INTO test_scores VALUES("89","5","37","6");
INSERT INTO test_scores VALUES("90","5","9","4");
INSERT INTO test_scores VALUES("91","5","38","2");
INSERT INTO test_scores VALUES("92","5","4","4");
INSERT INTO test_scores VALUES("93","5","73","6");
INSERT INTO test_scores VALUES("94","5","22","6");
INSERT INTO test_scores VALUES("95","5","26","4");
INSERT INTO test_scores VALUES("96","5","35","0");
INSERT INTO test_scores VALUES("97","5","27","0");
INSERT INTO test_scores VALUES("98","5","31","2");
INSERT INTO test_scores VALUES("99","5","10","2");
INSERT INTO test_scores VALUES("100","5","5","2");
INSERT INTO test_scores VALUES("101","5","34","4");
INSERT INTO test_scores VALUES("102","5","12","6");
INSERT INTO test_scores VALUES("103","5","23","6");
INSERT INTO test_scores VALUES("104","5","32","6");
INSERT INTO test_scores VALUES("105","5","29","2");
INSERT INTO test_scores VALUES("106","4","3","6");
INSERT INTO test_scores VALUES("107","4","6","6");
INSERT INTO test_scores VALUES("108","4","54","4");
INSERT INTO test_scores VALUES("109","4","42","2");
INSERT INTO test_scores VALUES("110","4","57","0");
INSERT INTO test_scores VALUES("2289","131","127","2");
INSERT INTO test_scores VALUES("112","4","1","4");
INSERT INTO test_scores VALUES("113","4","37","6");
INSERT INTO test_scores VALUES("114","4","28","4");
INSERT INTO test_scores VALUES("115","4","40","4");
INSERT INTO test_scores VALUES("116","4","2","6");
INSERT INTO test_scores VALUES("117","4","27","4");
INSERT INTO test_scores VALUES("118","4","31","4");
INSERT INTO test_scores VALUES("119","4","35","4");
INSERT INTO test_scores VALUES("120","4","38","4");
INSERT INTO test_scores VALUES("121","4","4","2");
INSERT INTO test_scores VALUES("122","4","9","4");
INSERT INTO test_scores VALUES("123","4","73","4");
INSERT INTO test_scores VALUES("124","4","26","4");
INSERT INTO test_scores VALUES("125","4","22","4");
INSERT INTO test_scores VALUES("126","4","66","2");
INSERT INTO test_scores VALUES("127","4","74","6");
INSERT INTO test_scores VALUES("128","4","30","4");
INSERT INTO test_scores VALUES("129","4","36","4");
INSERT INTO test_scores VALUES("130","4","12","6");
INSERT INTO test_scores VALUES("131","4","23","6");
INSERT INTO test_scores VALUES("132","4","34","6");
INSERT INTO test_scores VALUES("133","4","10","4");
INSERT INTO test_scores VALUES("134","4","72","4");
INSERT INTO test_scores VALUES("135","4","5","4");
INSERT INTO test_scores VALUES("136","4","32","6");
INSERT INTO test_scores VALUES("137","4","29","6");
INSERT INTO test_scores VALUES("291","11","39","1");
INSERT INTO test_scores VALUES("139","4","33","6");
INSERT INTO test_scores VALUES("140","4","39","4");
INSERT INTO test_scores VALUES("141","4","67","6");
INSERT INTO test_scores VALUES("142","4","71","4");
INSERT INTO test_scores VALUES("143","5","71","6");
INSERT INTO test_scores VALUES("144","6","71","4");
INSERT INTO test_scores VALUES("145","7","71","4");
INSERT INTO test_scores VALUES("146","8","5","4");
INSERT INTO test_scores VALUES("147","8","23","6");
INSERT INTO test_scores VALUES("148","8","31","6");
INSERT INTO test_scores VALUES("2288","131","142","6");
INSERT INTO test_scores VALUES("150","8","35","6");
INSERT INTO test_scores VALUES("151","8","27","6");
INSERT INTO test_scores VALUES("152","8","55","6");
INSERT INTO test_scores VALUES("153","8","22","6");
INSERT INTO test_scores VALUES("154","8","73","6");
INSERT INTO test_scores VALUES("155","8","4","6");
INSERT INTO test_scores VALUES("156","8","38","6");
INSERT INTO test_scores VALUES("157","8","26","6");
INSERT INTO test_scores VALUES("158","8","9","6");
INSERT INTO test_scores VALUES("159","8","40","6");
INSERT INTO test_scores VALUES("160","8","28","4");
INSERT INTO test_scores VALUES("161","8","37","6");
INSERT INTO test_scores VALUES("162","8","2","6");
INSERT INTO test_scores VALUES("163","8","36","6");
INSERT INTO test_scores VALUES("164","8","33","6");
INSERT INTO test_scores VALUES("165","8","67","6");
INSERT INTO test_scores VALUES("166","8","74","6");
INSERT INTO test_scores VALUES("167","8","66","6");
INSERT INTO test_scores VALUES("168","8","3","6");
INSERT INTO test_scores VALUES("169","8","1","6");
INSERT INTO test_scores VALUES("170","8","39","6");
INSERT INTO test_scores VALUES("171","8","7","6");
INSERT INTO test_scores VALUES("172","8","54","6");
INSERT INTO test_scores VALUES("173","8","6","6");
INSERT INTO test_scores VALUES("174","8","29","6");
INSERT INTO test_scores VALUES("175","8","42","2");
INSERT INTO test_scores VALUES("176","8","57","6");
INSERT INTO test_scores VALUES("177","8","72","6");
INSERT INTO test_scores VALUES("178","7","73","6");
INSERT INTO test_scores VALUES("179","7","67","4");
INSERT INTO test_scores VALUES("180","7","74","4");
INSERT INTO test_scores VALUES("181","7","54","6");
INSERT INTO test_scores VALUES("2287","131","135","0");
INSERT INTO test_scores VALUES("183","7","42","2");
INSERT INTO test_scores VALUES("184","7","72","2");
INSERT INTO test_scores VALUES("185","10","29","1");
INSERT INTO test_scores VALUES("186","7","66","0");
INSERT INTO test_scores VALUES("187","10","72","4");
INSERT INTO test_scores VALUES("188","10","76","6");
INSERT INTO test_scores VALUES("189","10","85","3");
INSERT INTO test_scores VALUES("190","10","23","5");
INSERT INTO test_scores VALUES("191","10","42","2");
INSERT INTO test_scores VALUES("192","10","57","2");
INSERT INTO test_scores VALUES("193","10","60","2");
INSERT INTO test_scores VALUES("194","10","5","2");
INSERT INTO test_scores VALUES("195","7","76","2");
INSERT INTO test_scores VALUES("196","10","6","3");
INSERT INTO test_scores VALUES("197","10","67","3");
INSERT INTO test_scores VALUES("198","9","37","6");
INSERT INTO test_scores VALUES("199","10","70","2");
INSERT INTO test_scores VALUES("200","9","1","2");
INSERT INTO test_scores VALUES("201","10","33","6");
INSERT INTO test_scores VALUES("202","9","67","2");
INSERT INTO test_scores VALUES("203","9","36","6");
INSERT INTO test_scores VALUES("204","10","36","3");
INSERT INTO test_scores VALUES("205","10","62","0");
INSERT INTO test_scores VALUES("206","10","1","6");
INSERT INTO test_scores VALUES("207","10","31","6");
INSERT INTO test_scores VALUES("208","10","3","3");
INSERT INTO test_scores VALUES("209","10","39","3");
INSERT INTO test_scores VALUES("210","10","66","3");
INSERT INTO test_scores VALUES("211","9","7","2");
INSERT INTO test_scores VALUES("212","10","74","2");
INSERT INTO test_scores VALUES("213","9","54","4");
INSERT INTO test_scores VALUES("214","9","6","6");
INSERT INTO test_scores VALUES("215","9","33","4");
INSERT INTO test_scores VALUES("216","10","65","6");
INSERT INTO test_scores VALUES("217","9","3","4");
INSERT INTO test_scores VALUES("218","10","54","3");
INSERT INTO test_scores VALUES("219","10","7","6");
INSERT INTO test_scores VALUES("220","9","23","0");
INSERT INTO test_scores VALUES("2286","131","147","6");
INSERT INTO test_scores VALUES("222","10","2","6");
INSERT INTO test_scores VALUES("223","9","5","4");
INSERT INTO test_scores VALUES("224","10","40","6");
INSERT INTO test_scores VALUES("225","9","60","0");
INSERT INTO test_scores VALUES("226","10","37","6");
INSERT INTO test_scores VALUES("227","9","72","4");
INSERT INTO test_scores VALUES("228","10","28","2");
INSERT INTO test_scores VALUES("229","9","29","4");
INSERT INTO test_scores VALUES("230","10","9","3");
INSERT INTO test_scores VALUES("231","9","42","0");
INSERT INTO test_scores VALUES("232","10","69","3");
INSERT INTO test_scores VALUES("233","10","38","2");
INSERT INTO test_scores VALUES("234","9","31","2");
INSERT INTO test_scores VALUES("235","10","26","3");
INSERT INTO test_scores VALUES("236","9","27","4");
INSERT INTO test_scores VALUES("237","10","4","6");
INSERT INTO test_scores VALUES("238","9","35","4");
INSERT INTO test_scores VALUES("239","10","73","6");
INSERT INTO test_scores VALUES("240","9","74","6");
INSERT INTO test_scores VALUES("241","10","22","6");
INSERT INTO test_scores VALUES("242","9","76","6");
INSERT INTO test_scores VALUES("243","10","55","3");
INSERT INTO test_scores VALUES("244","9","66","4");
INSERT INTO test_scores VALUES("245","10","27","3");
INSERT INTO test_scores VALUES("246","9","73","6");
INSERT INTO test_scores VALUES("247","10","35","2");
INSERT INTO test_scores VALUES("248","9","55","4");
INSERT INTO test_scores VALUES("249","9","22","4");
INSERT INTO test_scores VALUES("250","5","72","0");
INSERT INTO test_scores VALUES("251","9","4","4");
INSERT INTO test_scores VALUES("252","9","26","2");
INSERT INTO test_scores VALUES("253","5","66","4");
INSERT INTO test_scores VALUES("254","9","38","2");
INSERT INTO test_scores VALUES("255","5","74","4");
INSERT INTO test_scores VALUES("256","9","69","6");
INSERT INTO test_scores VALUES("257","5","67","4");
INSERT INTO test_scores VALUES("258","9","2","6");
INSERT INTO test_scores VALUES("259","5","76","4");
INSERT INTO test_scores VALUES("260","5","57","2");
INSERT INTO test_scores VALUES("261","9","40","6");
INSERT INTO test_scores VALUES("262","5","54","2");
INSERT INTO test_scores VALUES("263","9","28","6");
INSERT INTO test_scores VALUES("264","9","65","4");
INSERT INTO test_scores VALUES("265","9","9","4");
INSERT INTO test_scores VALUES("266","9","57","0");
INSERT INTO test_scores VALUES("267","7","12","2");
INSERT INTO test_scores VALUES("268","6","12","4");
INSERT INTO test_scores VALUES("269","4","85","2");
INSERT INTO test_scores VALUES("270","5","85","6");
INSERT INTO test_scores VALUES("271","6","85","4");
INSERT INTO test_scores VALUES("272","7","85","4");
INSERT INTO test_scores VALUES("273","8","12","6");
INSERT INTO test_scores VALUES("274","8","30","6");
INSERT INTO test_scores VALUES("275","10","12","3");
INSERT INTO test_scores VALUES("276","10","30","3");
INSERT INTO test_scores VALUES("277","9","12","2");
INSERT INTO test_scores VALUES("278","6","73","4");
INSERT INTO test_scores VALUES("279","6","74","6");
INSERT INTO test_scores VALUES("280","9","34","2");
INSERT INTO test_scores VALUES("281","8","34","6");
INSERT INTO test_scores VALUES("282","10","34","6");
INSERT INTO test_scores VALUES("283","6","67","6");
INSERT INTO test_scores VALUES("284","6","72","4");
INSERT INTO test_scores VALUES("285","6","76","4");
INSERT INTO test_scores VALUES("2285","131","12","6");
INSERT INTO test_scores VALUES("287","6","66","2");
INSERT INTO test_scores VALUES("288","6","54","2");
INSERT INTO test_scores VALUES("289","4","76","4");
INSERT INTO test_scores VALUES("292","11","6","4");
INSERT INTO test_scores VALUES("293","11","1","3");
INSERT INTO test_scores VALUES("1218","57","39","0");
INSERT INTO test_scores VALUES("295","11","3","4");
INSERT INTO test_scores VALUES("296","11","31","4");
INSERT INTO test_scores VALUES("297","11","76","3");
INSERT INTO test_scores VALUES("298","11","74","4");
INSERT INTO test_scores VALUES("299","11","65","0");
INSERT INTO test_scores VALUES("300","11","66","4");
INSERT INTO test_scores VALUES("301","11","2","6");
INSERT INTO test_scores VALUES("302","11","40","4");
INSERT INTO test_scores VALUES("303","11","37","6");
INSERT INTO test_scores VALUES("304","11","28","0");
INSERT INTO test_scores VALUES("305","11","9","1");
INSERT INTO test_scores VALUES("306","11","38","1");
INSERT INTO test_scores VALUES("307","11","26","0");
INSERT INTO test_scores VALUES("308","11","22","4");
INSERT INTO test_scores VALUES("309","11","73","1");
INSERT INTO test_scores VALUES("310","11","55","1");
INSERT INTO test_scores VALUES("311","11","35","0");
INSERT INTO test_scores VALUES("312","11","27","0");
INSERT INTO test_scores VALUES("313","11","54","0");
INSERT INTO test_scores VALUES("314","11","7","3");
INSERT INTO test_scores VALUES("315","11","62","0");
INSERT INTO test_scores VALUES("316","11","36","4");
INSERT INTO test_scores VALUES("317","11","33","4");
INSERT INTO test_scores VALUES("318","11","70","1");
INSERT INTO test_scores VALUES("319","11","67","4");
INSERT INTO test_scores VALUES("320","11","42","4");
INSERT INTO test_scores VALUES("321","11","60","0");
INSERT INTO test_scores VALUES("2284","131","6","6");
INSERT INTO test_scores VALUES("323","11","5","4");
INSERT INTO test_scores VALUES("324","11","85","1");
INSERT INTO test_scores VALUES("325","11","23","4");
INSERT INTO test_scores VALUES("326","11","72","0");
INSERT INTO test_scores VALUES("327","11","4","4");
INSERT INTO test_scores VALUES("328","11","69","0");
INSERT INTO test_scores VALUES("329","8","32","6");
INSERT INTO test_scores VALUES("330","11","32","6");
INSERT INTO test_scores VALUES("331","10","32","3");
INSERT INTO test_scores VALUES("332","9","32","6");
INSERT INTO test_scores VALUES("333","11","30","1");
INSERT INTO test_scores VALUES("334","9","30","4");
INSERT INTO test_scores VALUES("335","12","54","4");
INSERT INTO test_scores VALUES("336","12","4","5");
INSERT INTO test_scores VALUES("337","12","38","0");
INSERT INTO test_scores VALUES("338","12","86","2");
INSERT INTO test_scores VALUES("339","12","33","6");
INSERT INTO test_scores VALUES("340","12","84","2");
INSERT INTO test_scores VALUES("341","12","10","3");
INSERT INTO test_scores VALUES("342","12","70","3");
INSERT INTO test_scores VALUES("343","12","67","4");
INSERT INTO test_scores VALUES("344","12","6","5");
INSERT INTO test_scores VALUES("345","12","1","5");
INSERT INTO test_scores VALUES("346","12","39","6");
INSERT INTO test_scores VALUES("347","12","3","5");
INSERT INTO test_scores VALUES("348","12","83","1");
INSERT INTO test_scores VALUES("349","12","85","3");
INSERT INTO test_scores VALUES("350","12","81","3");
INSERT INTO test_scores VALUES("351","12","7","5");
INSERT INTO test_scores VALUES("352","12","30","0");
INSERT INTO test_scores VALUES("353","12","42","3");
INSERT INTO test_scores VALUES("354","12","26","2");
INSERT INTO test_scores VALUES("355","12","31","5");
INSERT INTO test_scores VALUES("356","12","23","2");
INSERT INTO test_scores VALUES("357","12","5","2");
INSERT INTO test_scores VALUES("358","12","40","5");
INSERT INTO test_scores VALUES("359","12","32","6");
INSERT INTO test_scores VALUES("360","12","34","6");
INSERT INTO test_scores VALUES("361","12","12","3");
INSERT INTO test_scores VALUES("362","12","2","6");
INSERT INTO test_scores VALUES("363","12","76","6");
INSERT INTO test_scores VALUES("364","12","36","6");
INSERT INTO test_scores VALUES("365","12","74","1");
INSERT INTO test_scores VALUES("366","12","65","3");
INSERT INTO test_scores VALUES("367","12","28","4");
INSERT INTO test_scores VALUES("368","12","37","1");
INSERT INTO test_scores VALUES("369","12","22","6");
INSERT INTO test_scores VALUES("370","12","69","5");
INSERT INTO test_scores VALUES("371","12","35","2");
INSERT INTO test_scores VALUES("372","12","27","3");
INSERT INTO test_scores VALUES("373","12","73","3");
INSERT INTO test_scores VALUES("374","12","55","5");
INSERT INTO test_scores VALUES("375","12","9","4");
INSERT INTO test_scores VALUES("376","13","2","6");
INSERT INTO test_scores VALUES("377","13","65","6");
INSERT INTO test_scores VALUES("378","13","37","3");
INSERT INTO test_scores VALUES("379","13","33","6");
INSERT INTO test_scores VALUES("380","13","67","6");
INSERT INTO test_scores VALUES("381","13","86","6");
INSERT INTO test_scores VALUES("382","13","70","0");
INSERT INTO test_scores VALUES("383","13","10","1");
INSERT INTO test_scores VALUES("384","13","4","3");
INSERT INTO test_scores VALUES("385","13","42","0");
INSERT INTO test_scores VALUES("386","13","31","4");
INSERT INTO test_scores VALUES("387","13","26","3");
INSERT INTO test_scores VALUES("388","13","30","5");
INSERT INTO test_scores VALUES("389","13","23","6");
INSERT INTO test_scores VALUES("390","13","5","1");
INSERT INTO test_scores VALUES("391","13","40","1");
INSERT INTO test_scores VALUES("392","13","34","6");
INSERT INTO test_scores VALUES("393","13","12","6");
INSERT INTO test_scores VALUES("394","13","32","6");
INSERT INTO test_scores VALUES("395","13","85","3");
INSERT INTO test_scores VALUES("396","13","6","6");
INSERT INTO test_scores VALUES("397","13","7","2");
INSERT INTO test_scores VALUES("398","13","81","1");
INSERT INTO test_scores VALUES("399","13","1","6");
INSERT INTO test_scores VALUES("400","13","83","1");
INSERT INTO test_scores VALUES("401","13","39","3");
INSERT INTO test_scores VALUES("402","13","3","6");
INSERT INTO test_scores VALUES("403","13","54","4");
INSERT INTO test_scores VALUES("404","13","74","6");
INSERT INTO test_scores VALUES("405","13","36","6");
INSERT INTO test_scores VALUES("406","13","76","6");
INSERT INTO test_scores VALUES("407","13","27","3");
INSERT INTO test_scores VALUES("408","13","35","0");
INSERT INTO test_scores VALUES("409","13","69","1");
INSERT INTO test_scores VALUES("410","13","22","6");
INSERT INTO test_scores VALUES("411","13","73","6");
INSERT INTO test_scores VALUES("412","13","38","4");
INSERT INTO test_scores VALUES("413","13","84","1");
INSERT INTO test_scores VALUES("414","13","9","4");
INSERT INTO test_scores VALUES("415","13","55","0");
INSERT INTO test_scores VALUES("416","13","28","3");
INSERT INTO test_scores VALUES("417","15","33","19");
INSERT INTO test_scores VALUES("418","15","67","13");
INSERT INTO test_scores VALUES("419","15","84","10");
INSERT INTO test_scores VALUES("420","15","70","6");
INSERT INTO test_scores VALUES("421","15","6","28");
INSERT INTO test_scores VALUES("422","15","7","7");
INSERT INTO test_scores VALUES("423","15","81","7");
INSERT INTO test_scores VALUES("424","15","85","14");
INSERT INTO test_scores VALUES("425","15","3","18");
INSERT INTO test_scores VALUES("426","15","39","10");
INSERT INTO test_scores VALUES("427","15","54","12");
INSERT INTO test_scores VALUES("428","15","83","3");
INSERT INTO test_scores VALUES("429","15","1","16");
INSERT INTO test_scores VALUES("430","15","28","7");
INSERT INTO test_scores VALUES("431","15","37","14");
INSERT INTO test_scores VALUES("432","15","2","32");
INSERT INTO test_scores VALUES("433","15","27","13");
INSERT INTO test_scores VALUES("434","15","35","3");
INSERT INTO test_scores VALUES("435","15","38","6");
INSERT INTO test_scores VALUES("436","15","9","13");
INSERT INTO test_scores VALUES("437","15","4","10");
INSERT INTO test_scores VALUES("438","15","22","15");
INSERT INTO test_scores VALUES("439","15","73","17");
INSERT INTO test_scores VALUES("440","15","36","10");
INSERT INTO test_scores VALUES("441","15","76","7");
INSERT INTO test_scores VALUES("442","15","32","18");
INSERT INTO test_scores VALUES("443","15","34","25");
INSERT INTO test_scores VALUES("444","15","12","22");
INSERT INTO test_scores VALUES("445","15","40","15");
INSERT INTO test_scores VALUES("446","15","5","12");
INSERT INTO test_scores VALUES("447","15","23","14");
INSERT INTO test_scores VALUES("448","15","31","13");
INSERT INTO test_scores VALUES("449","15","26","7");
INSERT INTO test_scores VALUES("450","15","30","7");
INSERT INTO test_scores VALUES("451","15","42","3");
INSERT INTO test_scores VALUES("452","15","10","13");
INSERT INTO test_scores VALUES("453","11","34","5");
INSERT INTO test_scores VALUES("454","14","34","6");
INSERT INTO test_scores VALUES("455","14","33","6");
INSERT INTO test_scores VALUES("456","14","67","6");
INSERT INTO test_scores VALUES("457","14","70","0");
INSERT INTO test_scores VALUES("458","14","10","6");
INSERT INTO test_scores VALUES("459","14","84","0");
INSERT INTO test_scores VALUES("460","14","86","2");
INSERT INTO test_scores VALUES("461","14","6","6");
INSERT INTO test_scores VALUES("462","14","7","6");
INSERT INTO test_scores VALUES("463","14","81","2");
INSERT INTO test_scores VALUES("464","14","85","1");
INSERT INTO test_scores VALUES("465","14","39","1");
INSERT INTO test_scores VALUES("466","14","83","1");
INSERT INTO test_scores VALUES("467","14","3","6");
INSERT INTO test_scores VALUES("468","14","1","6");
INSERT INTO test_scores VALUES("469","14","36","6");
INSERT INTO test_scores VALUES("470","14","54","1");
INSERT INTO test_scores VALUES("471","14","74","6");
INSERT INTO test_scores VALUES("472","14","76","3");
INSERT INTO test_scores VALUES("473","14","28","1");
INSERT INTO test_scores VALUES("474","14","37","6");
INSERT INTO test_scores VALUES("475","14","65","4");
INSERT INTO test_scores VALUES("476","14","2","6");
INSERT INTO test_scores VALUES("477","14","38","3");
INSERT INTO test_scores VALUES("478","14","4","0");
INSERT INTO test_scores VALUES("479","14","9","1");
INSERT INTO test_scores VALUES("480","14","55","0");
INSERT INTO test_scores VALUES("481","14","35","1");
INSERT INTO test_scores VALUES("482","14","27","3");
INSERT INTO test_scores VALUES("483","14","69","5");
INSERT INTO test_scores VALUES("484","14","22","6");
INSERT INTO test_scores VALUES("485","14","62","3");
INSERT INTO test_scores VALUES("486","14","23","6");
INSERT INTO test_scores VALUES("487","14","31","3");
INSERT INTO test_scores VALUES("488","14","40","6");
INSERT INTO test_scores VALUES("489","14","26","1");
INSERT INTO test_scores VALUES("490","14","30","3");
INSERT INTO test_scores VALUES("491","14","5","6");
INSERT INTO test_scores VALUES("492","14","12","5");
INSERT INTO test_scores VALUES("493","14","32","6");
INSERT INTO test_scores VALUES("494","14","42","4");
INSERT INTO test_scores VALUES("495","14","73","4");
INSERT INTO test_scores VALUES("496","14","66","6");
INSERT INTO test_scores VALUES("497","15","66","24");
INSERT INTO test_scores VALUES("498","12","66","6");
INSERT INTO test_scores VALUES("499","17","2","16");
INSERT INTO test_scores VALUES("504","17","23","7");
INSERT INTO test_scores VALUES("501","17","12","7");
INSERT INTO test_scores VALUES("502","17","34","11");
INSERT INTO test_scores VALUES("503","17","6","3");
INSERT INTO test_scores VALUES("505","17","33","8");
INSERT INTO test_scores VALUES("506","11","12","6");
INSERT INTO test_scores VALUES("507","18","66","1");
INSERT INTO test_scores VALUES("508","18","31","1");
INSERT INTO test_scores VALUES("509","18","23","1");
INSERT INTO test_scores VALUES("510","18","5","1");
INSERT INTO test_scores VALUES("511","18","12","1");
INSERT INTO test_scores VALUES("512","18","32","1");
INSERT INTO test_scores VALUES("513","18","36","1");
INSERT INTO test_scores VALUES("514","18","4","1");
INSERT INTO test_scores VALUES("515","18","37","1");
INSERT INTO test_scores VALUES("516","18","28","1");
INSERT INTO test_scores VALUES("517","18","83","0");
INSERT INTO test_scores VALUES("518","18","39","1");
INSERT INTO test_scores VALUES("519","18","3","1");
INSERT INTO test_scores VALUES("520","18","85","1");
INSERT INTO test_scores VALUES("521","18","6","0");
INSERT INTO test_scores VALUES("522","18","2","0");
INSERT INTO test_scores VALUES("523","16","74","16");
INSERT INTO test_scores VALUES("524","16","33","16");
INSERT INTO test_scores VALUES("525","16","11","16");
INSERT INTO test_scores VALUES("526","16","21","18");
INSERT INTO test_scores VALUES("527","16","19","18");
INSERT INTO test_scores VALUES("528","16","20","18");
INSERT INTO test_scores VALUES("529","16","2","18");
INSERT INTO test_scores VALUES("530","16","6","18");
INSERT INTO test_scores VALUES("531","16","32","18");
INSERT INTO test_scores VALUES("532","16","40","18");
INSERT INTO test_scores VALUES("2590","138","76","0");
INSERT INTO test_scores VALUES("534","18","30","0");
INSERT INTO test_scores VALUES("535","18","67","1");
INSERT INTO test_scores VALUES("536","18","65","0");
INSERT INTO test_scores VALUES("537","18","1","1");
INSERT INTO test_scores VALUES("538","18","9","1");
INSERT INTO test_scores VALUES("539","18","74","1");
INSERT INTO test_scores VALUES("540","19","19","18");
INSERT INTO test_scores VALUES("541","19","20","18");
INSERT INTO test_scores VALUES("542","19","21","15");
INSERT INTO test_scores VALUES("543","19","34","17");
INSERT INTO test_scores VALUES("544","19","2","15");
INSERT INTO test_scores VALUES("545","19","11","17");
INSERT INTO test_scores VALUES("546","19","32","15");
INSERT INTO test_scores VALUES("547","19","36","18");
INSERT INTO test_scores VALUES("548","19","22","12");
INSERT INTO test_scores VALUES("549","19","33","14");
INSERT INTO test_scores VALUES("2585","138","125","0");
INSERT INTO test_scores VALUES("2582","138","147","6");
INSERT INTO test_scores VALUES("552","18","76","1");
INSERT INTO test_scores VALUES("553","18","7","1");
INSERT INTO test_scores VALUES("554","18","24","1");
INSERT INTO test_scores VALUES("555","18","34","1");
INSERT INTO test_scores VALUES("556","18","33","1");
INSERT INTO test_scores VALUES("557","18","27","1");
INSERT INTO test_scores VALUES("558","18","84","0");
INSERT INTO test_scores VALUES("559","18","40","0");
INSERT INTO test_scores VALUES("560","18","38","1");
INSERT INTO test_scores VALUES("562","15","74","10");
INSERT INTO test_scores VALUES("563","20","2","6");
INSERT INTO test_scores VALUES("564","20","36","4");
INSERT INTO test_scores VALUES("565","20","37","6");
INSERT INTO test_scores VALUES("566","20","28","2");
INSERT INTO test_scores VALUES("567","20","26","2");
INSERT INTO test_scores VALUES("568","20","9","4");
INSERT INTO test_scores VALUES("569","20","7","6");
INSERT INTO test_scores VALUES("570","20","74","6");
INSERT INTO test_scores VALUES("571","20","6","4");
INSERT INTO test_scores VALUES("572","20","66","2");
INSERT INTO test_scores VALUES("573","20","1","6");
INSERT INTO test_scores VALUES("574","20","81","6");
INSERT INTO test_scores VALUES("575","20","76","0");
INSERT INTO test_scores VALUES("576","20","33","6");
INSERT INTO test_scores VALUES("577","20","5","6");
INSERT INTO test_scores VALUES("578","21","74","4");
INSERT INTO test_scores VALUES("579","21","6","6");
INSERT INTO test_scores VALUES("580","20","85","4");
INSERT INTO test_scores VALUES("581","21","32","6");
INSERT INTO test_scores VALUES("582","20","86","2");
INSERT INTO test_scores VALUES("583","21","67","2");
INSERT INTO test_scores VALUES("584","20","27","2");
INSERT INTO test_scores VALUES("585","21","31","0");
INSERT INTO test_scores VALUES("586","20","65","4");
INSERT INTO test_scores VALUES("587","21","30","2");
INSERT INTO test_scores VALUES("588","20","4","2");
INSERT INTO test_scores VALUES("589","21","42","2");
INSERT INTO test_scores VALUES("590","20","22","6");
INSERT INTO test_scores VALUES("591","20","73","2");
INSERT INTO test_scores VALUES("592","21","29","4");
INSERT INTO test_scores VALUES("593","20","91","0");
INSERT INTO test_scores VALUES("594","21","40","4");
INSERT INTO test_scores VALUES("595","21","27","0");
INSERT INTO test_scores VALUES("596","20","35","0");
INSERT INTO test_scores VALUES("597","21","65","4");
INSERT INTO test_scores VALUES("598","21","4","0");
INSERT INTO test_scores VALUES("599","21","22","2");
INSERT INTO test_scores VALUES("600","20","96","4");
INSERT INTO test_scores VALUES("601","21","73","4");
INSERT INTO test_scores VALUES("602","20","23","6");
INSERT INTO test_scores VALUES("603","21","35","0");
INSERT INTO test_scores VALUES("604","20","40","4");
INSERT INTO test_scores VALUES("605","20","12","4");
INSERT INTO test_scores VALUES("606","21","96","2");
INSERT INTO test_scores VALUES("607","20","29","4");
INSERT INTO test_scores VALUES("608","20","57","2");
INSERT INTO test_scores VALUES("609","20","42","0");
INSERT INTO test_scores VALUES("610","20","30","2");
INSERT INTO test_scores VALUES("611","21","9","4");
INSERT INTO test_scores VALUES("612","20","31","2");
INSERT INTO test_scores VALUES("613","20","67","6");
INSERT INTO test_scores VALUES("614","20","54","4");
INSERT INTO test_scores VALUES("615","21","91","0");
INSERT INTO test_scores VALUES("616","21","28","0");
INSERT INTO test_scores VALUES("617","20","32","6");
INSERT INTO test_scores VALUES("618","20","39","2");
INSERT INTO test_scores VALUES("619","21","37","6");
INSERT INTO test_scores VALUES("620","20","3","6");
INSERT INTO test_scores VALUES("621","21","36","2");
INSERT INTO test_scores VALUES("622","21","2","6");
INSERT INTO test_scores VALUES("623","20","95","4");
INSERT INTO test_scores VALUES("624","21","26","0");
INSERT INTO test_scores VALUES("625","21","23","4");
INSERT INTO test_scores VALUES("626","21","12","2");
INSERT INTO test_scores VALUES("627","21","54","4");
INSERT INTO test_scores VALUES("628","21","72","0");
INSERT INTO test_scores VALUES("629","21","39","0");
INSERT INTO test_scores VALUES("630","21","3","4");
INSERT INTO test_scores VALUES("631","21","95","2");
INSERT INTO test_scores VALUES("632","21","1","2");
INSERT INTO test_scores VALUES("633","21","66","2");
INSERT INTO test_scores VALUES("634","21","7","4");
INSERT INTO test_scores VALUES("635","21","81","0");
INSERT INTO test_scores VALUES("636","21","76","0");
INSERT INTO test_scores VALUES("637","21","33","4");
INSERT INTO test_scores VALUES("638","21","5","2");
INSERT INTO test_scores VALUES("639","21","85","0");
INSERT INTO test_scores VALUES("640","21","86","2");
INSERT INTO test_scores VALUES("641","22","57","2");
INSERT INTO test_scores VALUES("642","22","42","2");
INSERT INTO test_scores VALUES("643","22","76","0");
INSERT INTO test_scores VALUES("644","22","81","6");
INSERT INTO test_scores VALUES("645","22","7","2");
INSERT INTO test_scores VALUES("646","22","66","6");
INSERT INTO test_scores VALUES("647","22","1","6");
INSERT INTO test_scores VALUES("648","22","39","6");
INSERT INTO test_scores VALUES("649","22","2","6");
INSERT INTO test_scores VALUES("650","22","36","6");
INSERT INTO test_scores VALUES("651","22","37","6");
INSERT INTO test_scores VALUES("652","22","28","4");
INSERT INTO test_scores VALUES("653","22","73","6");
INSERT INTO test_scores VALUES("654","22","22","4");
INSERT INTO test_scores VALUES("655","22","4","6");
INSERT INTO test_scores VALUES("656","22","65","6");
INSERT INTO test_scores VALUES("657","22","27","2");
INSERT INTO test_scores VALUES("658","22","9","6");
INSERT INTO test_scores VALUES("659","22","86","6");
INSERT INTO test_scores VALUES("660","22","85","6");
INSERT INTO test_scores VALUES("661","22","5","4");
INSERT INTO test_scores VALUES("662","22","33","2");
INSERT INTO test_scores VALUES("663","22","31","4");
INSERT INTO test_scores VALUES("664","22","67","6");
INSERT INTO test_scores VALUES("665","22","3","6");
INSERT INTO test_scores VALUES("666","22","40","6");
INSERT INTO test_scores VALUES("667","22","32","6");
INSERT INTO test_scores VALUES("668","22","12","6");
INSERT INTO test_scores VALUES("669","22","54","6");
INSERT INTO test_scores VALUES("670","22","23","6");
INSERT INTO test_scores VALUES("671","22","30","4");
INSERT INTO test_scores VALUES("672","22","29","6");
INSERT INTO test_scores VALUES("673","22","91","0");
INSERT INTO test_scores VALUES("674","22","6","6");
INSERT INTO test_scores VALUES("675","22","72","4");
INSERT INTO test_scores VALUES("676","22","74","6");
INSERT INTO test_scores VALUES("677","22","26","4");
INSERT INTO test_scores VALUES("678","22","35","4");
INSERT INTO test_scores VALUES("679","22","96","6");
INSERT INTO test_scores VALUES("680","22","95","2");
INSERT INTO test_scores VALUES("681","22","104","0");
INSERT INTO test_scores VALUES("682","18","73","1");
INSERT INTO test_scores VALUES("683","18","22","0");
INSERT INTO test_scores VALUES("684","18","70","1");
INSERT INTO test_scores VALUES("685","26","10","1");
INSERT INTO test_scores VALUES("808","28","19","6");
INSERT INTO test_scores VALUES("687","26","81","1");
INSERT INTO test_scores VALUES("688","26","73","1");
INSERT INTO test_scores VALUES("689","26","69","1");
INSERT INTO test_scores VALUES("690","26","42","1");
INSERT INTO test_scores VALUES("691","26","55","1");
INSERT INTO test_scores VALUES("692","26","57","1");
INSERT INTO test_scores VALUES("693","26","29","1");
INSERT INTO test_scores VALUES("694","23","32","6");
INSERT INTO test_scores VALUES("695","23","34","4");
INSERT INTO test_scores VALUES("696","23","23","6");
INSERT INTO test_scores VALUES("697","23","29","2");
INSERT INTO test_scores VALUES("698","23","57","2");
INSERT INTO test_scores VALUES("699","23","42","2");
INSERT INTO test_scores VALUES("700","23","22","4");
INSERT INTO test_scores VALUES("701","23","2","6");
INSERT INTO test_scores VALUES("702","23","26","2");
INSERT INTO test_scores VALUES("703","23","36","6");
INSERT INTO test_scores VALUES("704","23","74","6");
INSERT INTO test_scores VALUES("705","23","67","2");
INSERT INTO test_scores VALUES("706","23","37","6");
INSERT INTO test_scores VALUES("707","23","31","6");
INSERT INTO test_scores VALUES("708","23","28","6");
INSERT INTO test_scores VALUES("709","23","96","2");
INSERT INTO test_scores VALUES("710","23","27","4");
INSERT INTO test_scores VALUES("711","23","65","4");
INSERT INTO test_scores VALUES("712","23","55","2");
INSERT INTO test_scores VALUES("713","23","104","0");
INSERT INTO test_scores VALUES("714","23","95","2");
INSERT INTO test_scores VALUES("715","23","4","0");
INSERT INTO test_scores VALUES("716","23","69","2");
INSERT INTO test_scores VALUES("717","23","73","4");
INSERT INTO test_scores VALUES("718","23","1","6");
INSERT INTO test_scores VALUES("719","23","3","6");
INSERT INTO test_scores VALUES("720","23","76","4");
INSERT INTO test_scores VALUES("721","23","81","2");
INSERT INTO test_scores VALUES("722","23","7","4");
INSERT INTO test_scores VALUES("723","23","5","6");
INSERT INTO test_scores VALUES("724","23","86","6");
INSERT INTO test_scores VALUES("725","23","10","6");
INSERT INTO test_scores VALUES("726","23","6","6");
INSERT INTO test_scores VALUES("727","23","33","2");
INSERT INTO test_scores VALUES("728","23","40","6");
INSERT INTO test_scores VALUES("729","24","10","6");
INSERT INTO test_scores VALUES("730","24","86","4");
INSERT INTO test_scores VALUES("731","24","6","6");
INSERT INTO test_scores VALUES("732","24","33","6");
INSERT INTO test_scores VALUES("733","24","76","6");
INSERT INTO test_scores VALUES("734","24","81","4");
INSERT INTO test_scores VALUES("735","24","7","6");
INSERT INTO test_scores VALUES("736","24","5","6");
INSERT INTO test_scores VALUES("737","24","1","6");
INSERT INTO test_scores VALUES("738","24","3","6");
INSERT INTO test_scores VALUES("739","24","67","6");
INSERT INTO test_scores VALUES("740","24","26","6");
INSERT INTO test_scores VALUES("741","24","36","4");
INSERT INTO test_scores VALUES("742","24","74","6");
INSERT INTO test_scores VALUES("743","24","40","6");
INSERT INTO test_scores VALUES("744","24","37","6");
INSERT INTO test_scores VALUES("745","24","28","6");
INSERT INTO test_scores VALUES("746","24","31","6");
INSERT INTO test_scores VALUES("747","24","2","6");
INSERT INTO test_scores VALUES("748","24","32","6");
INSERT INTO test_scores VALUES("749","24","23","6");
INSERT INTO test_scores VALUES("750","24","34","6");
INSERT INTO test_scores VALUES("751","24","42","4");
INSERT INTO test_scores VALUES("753","24","57","4");
INSERT INTO test_scores VALUES("754","24","29","6");
INSERT INTO test_scores VALUES("755","24","104","2");
INSERT INTO test_scores VALUES("756","24","4","6");
INSERT INTO test_scores VALUES("757","24","95","6");
INSERT INTO test_scores VALUES("758","24","69","0");
INSERT INTO test_scores VALUES("759","24","73","4");
INSERT INTO test_scores VALUES("760","24","55","6");
INSERT INTO test_scores VALUES("761","24","96","2");
INSERT INTO test_scores VALUES("762","24","65","6");
INSERT INTO test_scores VALUES("763","24","22","6");
INSERT INTO test_scores VALUES("764","24","27","4");
INSERT INTO test_scores VALUES("765","18","98","1");
INSERT INTO test_scores VALUES("766","23","12","6");
INSERT INTO test_scores VALUES("767","24","12","4");
INSERT INTO test_scores VALUES("768","25","12","6");
INSERT INTO test_scores VALUES("769","22","34","4");
INSERT INTO test_scores VALUES("770","21","34","6");
INSERT INTO test_scores VALUES("771","20","34","6");
INSERT INTO test_scores VALUES("772","25","96","2");
INSERT INTO test_scores VALUES("773","25","22","4");
INSERT INTO test_scores VALUES("774","25","104","0");
INSERT INTO test_scores VALUES("775","25","4","0");
INSERT INTO test_scores VALUES("776","25","55","4");
INSERT INTO test_scores VALUES("777","25","69","4");
INSERT INTO test_scores VALUES("778","25","32","6");
INSERT INTO test_scores VALUES("779","25","86","2");
INSERT INTO test_scores VALUES("780","25","5","4");
INSERT INTO test_scores VALUES("781","25","81","4");
INSERT INTO test_scores VALUES("782","25","67","6");
INSERT INTO test_scores VALUES("783","25","28","0");
INSERT INTO test_scores VALUES("784","25","37","4");
INSERT INTO test_scores VALUES("785","25","31","2");
INSERT INTO test_scores VALUES("786","25","40","6");
INSERT INTO test_scores VALUES("787","25","26","2");
INSERT INTO test_scores VALUES("788","25","36","2");
INSERT INTO test_scores VALUES("789","25","74","6");
INSERT INTO test_scores VALUES("790","25","1","4");
INSERT INTO test_scores VALUES("791","25","3","6");
INSERT INTO test_scores VALUES("792","25","7","6");
INSERT INTO test_scores VALUES("793","25","76","2");
INSERT INTO test_scores VALUES("794","25","33","6");
INSERT INTO test_scores VALUES("795","25","6","6");
INSERT INTO test_scores VALUES("796","25","34","6");
INSERT INTO test_scores VALUES("797","25","29","6");
INSERT INTO test_scores VALUES("798","25","10","0");
INSERT INTO test_scores VALUES("799","25","57","2");
INSERT INTO test_scores VALUES("800","25","23","6");
INSERT INTO test_scores VALUES("801","25","42","4");
INSERT INTO test_scores VALUES("802","25","73","6");
INSERT INTO test_scores VALUES("803","25","2","6");
INSERT INTO test_scores VALUES("804","25","95","2");
INSERT INTO test_scores VALUES("805","25","65","0");
INSERT INTO test_scores VALUES("806","25","27","2");
INSERT INTO test_scores VALUES("807","18","54","1");
INSERT INTO test_scores VALUES("809","28","20","6");
INSERT INTO test_scores VALUES("810","28","34","5");
INSERT INTO test_scores VALUES("811","28","11","6");
INSERT INTO test_scores VALUES("812","28","32","6");
INSERT INTO test_scores VALUES("813","28","22","3");
INSERT INTO test_scores VALUES("814","29","20","6");
INSERT INTO test_scores VALUES("815","29","21","6");
INSERT INTO test_scores VALUES("816","29","34","6");
INSERT INTO test_scores VALUES("817","29","32","6");
INSERT INTO test_scores VALUES("818","29","36","6");
INSERT INTO test_scores VALUES("819","29","22","3");
INSERT INTO test_scores VALUES("820","30","20","6");
INSERT INTO test_scores VALUES("821","30","34","6");
INSERT INTO test_scores VALUES("822","30","2","3");
INSERT INTO test_scores VALUES("823","30","36","6");
INSERT INTO test_scores VALUES("824","30","22","6");
INSERT INTO test_scores VALUES("825","30","33","5");
INSERT INTO test_scores VALUES("826","31","19","6");
INSERT INTO test_scores VALUES("827","31","21","3");
INSERT INTO test_scores VALUES("828","31","2","6");
INSERT INTO test_scores VALUES("829","31","33","6");
INSERT INTO test_scores VALUES("830","31","36","6");
INSERT INTO test_scores VALUES("831","31","11","6");
INSERT INTO test_scores VALUES("832","32","21","6");
INSERT INTO test_scores VALUES("833","32","2","6");
INSERT INTO test_scores VALUES("834","32","19","6");
INSERT INTO test_scores VALUES("835","32","33","3");
INSERT INTO test_scores VALUES("836","32","32","3");
INSERT INTO test_scores VALUES("837","32","11","5");
INSERT INTO test_scores VALUES("2584","138","145","2");
INSERT INTO test_scores VALUES("2581","138","165","6");
INSERT INTO test_scores VALUES("840","18","10","0");
INSERT INTO test_scores VALUES("841","18","81","0");
INSERT INTO test_scores VALUES("842","18","42","0");
INSERT INTO test_scores VALUES("843","18","35","0");
INSERT INTO test_scores VALUES("844","18","26","0");
INSERT INTO test_scores VALUES("2589","138","31","2");
INSERT INTO test_scores VALUES("846","34","32","4");
INSERT INTO test_scores VALUES("847","34","11","6");
INSERT INTO test_scores VALUES("848","34","21","6");
INSERT INTO test_scores VALUES("849","34","3","6");
INSERT INTO test_scores VALUES("850","34","2","6");
INSERT INTO test_scores VALUES("851","35","32","6");
INSERT INTO test_scores VALUES("852","35","74","4");
INSERT INTO test_scores VALUES("853","35","23","4");
INSERT INTO test_scores VALUES("854","35","3","4");
INSERT INTO test_scores VALUES("855","35","2","6");
INSERT INTO test_scores VALUES("856","36","32","6");
INSERT INTO test_scores VALUES("857","36","20","6");
INSERT INTO test_scores VALUES("858","36","74","2");
INSERT INTO test_scores VALUES("859","36","23","6");
INSERT INTO test_scores VALUES("860","36","2","6");
INSERT INTO test_scores VALUES("861","37","19","6");
INSERT INTO test_scores VALUES("862","37","20","6");
INSERT INTO test_scores VALUES("863","37","11","6");
INSERT INTO test_scores VALUES("864","37","74","6");
INSERT INTO test_scores VALUES("865","37","6","6");
INSERT INTO test_scores VALUES("866","38","19","6");
INSERT INTO test_scores VALUES("867","38","20","6");
INSERT INTO test_scores VALUES("868","38","11","4");
INSERT INTO test_scores VALUES("869","38","21","6");
INSERT INTO test_scores VALUES("870","38","6","4");
INSERT INTO test_scores VALUES("871","39","19","4");
INSERT INTO test_scores VALUES("872","39","23","2");
INSERT INTO test_scores VALUES("873","39","21","6");
INSERT INTO test_scores VALUES("874","39","3","2");
INSERT INTO test_scores VALUES("875","39","6","6");
INSERT INTO test_scores VALUES("876","18","95","1");
INSERT INTO test_scores VALUES("877","41","23","6");
INSERT INTO test_scores VALUES("878","41","30","3");
INSERT INTO test_scores VALUES("879","41","34","6");
INSERT INTO test_scores VALUES("880","41","12","6");
INSERT INTO test_scores VALUES("881","41","32","6");
INSERT INTO test_scores VALUES("882","41","6","6");
INSERT INTO test_scores VALUES("883","41","67","1");
INSERT INTO test_scores VALUES("884","41","57","1");
INSERT INTO test_scores VALUES("885","41","86","0");
INSERT INTO test_scores VALUES("886","41","10","6");
INSERT INTO test_scores VALUES("887","41","42","3");
INSERT INTO test_scores VALUES("888","41","33","6");
INSERT INTO test_scores VALUES("889","41","39","6");
INSERT INTO test_scores VALUES("890","41","26","6");
INSERT INTO test_scores VALUES("891","41","1","3");
INSERT INTO test_scores VALUES("892","41","36","6");
INSERT INTO test_scores VALUES("893","41","81","6");
INSERT INTO test_scores VALUES("894","41","5","6");
INSERT INTO test_scores VALUES("895","41","40","6");
INSERT INTO test_scores VALUES("896","41","66","6");
INSERT INTO test_scores VALUES("897","41","3","6");
INSERT INTO test_scores VALUES("898","41","85","6");
INSERT INTO test_scores VALUES("899","41","2","6");
INSERT INTO test_scores VALUES("900","41","28","6");
INSERT INTO test_scores VALUES("901","41","37","6");
INSERT INTO test_scores VALUES("902","41","76","6");
INSERT INTO test_scores VALUES("903","41","110","3");
INSERT INTO test_scores VALUES("904","41","27","0");
INSERT INTO test_scores VALUES("905","41","35","5");
INSERT INTO test_scores VALUES("906","41","31","1");
INSERT INTO test_scores VALUES("907","41","22","6");
INSERT INTO test_scores VALUES("908","41","4","5");
INSERT INTO test_scores VALUES("909","41","95","6");
INSERT INTO test_scores VALUES("910","41","9","3");
INSERT INTO test_scores VALUES("911","41","55","6");
INSERT INTO test_scores VALUES("912","42","6","6");
INSERT INTO test_scores VALUES("913","42","67","6");
INSERT INTO test_scores VALUES("914","42","42","3");
INSERT INTO test_scores VALUES("915","42","86","0");
INSERT INTO test_scores VALUES("916","42","57","0");
INSERT INTO test_scores VALUES("917","42","81","3");
INSERT INTO test_scores VALUES("918","42","5","1");
INSERT INTO test_scores VALUES("919","42","36","6");
INSERT INTO test_scores VALUES("920","42","39","3");
INSERT INTO test_scores VALUES("921","42","26","3");
INSERT INTO test_scores VALUES("922","42","33","4");
INSERT INTO test_scores VALUES("923","42","1","4");
INSERT INTO test_scores VALUES("924","42","85","6");
INSERT INTO test_scores VALUES("925","42","66","5");
INSERT INTO test_scores VALUES("926","42","3","6");
INSERT INTO test_scores VALUES("927","42","40","6");
INSERT INTO test_scores VALUES("928","42","110","1");
INSERT INTO test_scores VALUES("929","42","22","6");
INSERT INTO test_scores VALUES("930","42","31","4");
INSERT INTO test_scores VALUES("931","42","35","1");
INSERT INTO test_scores VALUES("932","42","27","1");
INSERT INTO test_scores VALUES("933","42","9","3");
INSERT INTO test_scores VALUES("934","42","4","3");
INSERT INTO test_scores VALUES("935","42","95","0");
INSERT INTO test_scores VALUES("936","42","76","2");
INSERT INTO test_scores VALUES("937","42","37","3");
INSERT INTO test_scores VALUES("938","42","28","0");
INSERT INTO test_scores VALUES("939","42","2","6");
INSERT INTO test_scores VALUES("940","42","30","2");
INSERT INTO test_scores VALUES("941","42","32","6");
INSERT INTO test_scores VALUES("942","42","72","0");
INSERT INTO test_scores VALUES("943","42","23","4");
INSERT INTO test_scores VALUES("944","42","34","4");
INSERT INTO test_scores VALUES("945","42","12","6");
INSERT INTO test_scores VALUES("946","44","37","6");
INSERT INTO test_scores VALUES("947","44","32","4");
INSERT INTO test_scores VALUES("948","44","72","3");
INSERT INTO test_scores VALUES("949","44","23","5");
INSERT INTO test_scores VALUES("950","44","34","5");
INSERT INTO test_scores VALUES("951","44","110","3");
INSERT INTO test_scores VALUES("952","44","35","0");
INSERT INTO test_scores VALUES("953","44","27","3");
INSERT INTO test_scores VALUES("954","44","31","3");
INSERT INTO test_scores VALUES("955","44","22","6");
INSERT INTO test_scores VALUES("956","44","9","5");
INSERT INTO test_scores VALUES("957","44","4","5");
INSERT INTO test_scores VALUES("958","44","95","3");
INSERT INTO test_scores VALUES("959","44","2","5");
INSERT INTO test_scores VALUES("960","44","76","3");
INSERT INTO test_scores VALUES("961","44","30","5");
INSERT INTO test_scores VALUES("962","44","28","5");
INSERT INTO test_scores VALUES("963","44","85","3");
INSERT INTO test_scores VALUES("964","44","66","4");
INSERT INTO test_scores VALUES("965","44","3","3");
INSERT INTO test_scores VALUES("966","44","40","5");
INSERT INTO test_scores VALUES("967","44","6","6");
INSERT INTO test_scores VALUES("968","44","67","5");
INSERT INTO test_scores VALUES("969","44","42","0");
INSERT INTO test_scores VALUES("970","44","86","2");
INSERT INTO test_scores VALUES("971","44","1","3");
INSERT INTO test_scores VALUES("972","44","39","3");
INSERT INTO test_scores VALUES("973","44","33","3");
INSERT INTO test_scores VALUES("974","44","26","1");
INSERT INTO test_scores VALUES("975","44","81","3");
INSERT INTO test_scores VALUES("976","44","5","2");
INSERT INTO test_scores VALUES("977","44","36","5");
INSERT INTO test_scores VALUES("978","43","26","0");
INSERT INTO test_scores VALUES("979","43","39","0");
INSERT INTO test_scores VALUES("980","43","33","3");
INSERT INTO test_scores VALUES("981","43","1","2");
INSERT INTO test_scores VALUES("982","43","81","0");
INSERT INTO test_scores VALUES("983","43","36","0");
INSERT INTO test_scores VALUES("984","43","5","0");
INSERT INTO test_scores VALUES("985","43","67","0");
INSERT INTO test_scores VALUES("986","43","6","2");
INSERT INTO test_scores VALUES("987","43","42","0");
INSERT INTO test_scores VALUES("988","43","86","0");
INSERT INTO test_scores VALUES("989","43","32","6");
INSERT INTO test_scores VALUES("990","43","34","5");
INSERT INTO test_scores VALUES("991","43","23","6");
INSERT INTO test_scores VALUES("992","43","30","0");
INSERT INTO test_scores VALUES("993","43","72","1");
INSERT INTO test_scores VALUES("994","43","2","6");
INSERT INTO test_scores VALUES("995","43","37","3");
INSERT INTO test_scores VALUES("996","43","28","0");
INSERT INTO test_scores VALUES("997","43","76","0");
INSERT INTO test_scores VALUES("998","43","66","0");
INSERT INTO test_scores VALUES("999","43","85","0");
INSERT INTO test_scores VALUES("1000","43","40","0");
INSERT INTO test_scores VALUES("1001","43","3","3");
INSERT INTO test_scores VALUES("1002","43","22","2");
INSERT INTO test_scores VALUES("1003","43","31","0");
INSERT INTO test_scores VALUES("1004","43","4","0");
INSERT INTO test_scores VALUES("1005","43","35","0");
INSERT INTO test_scores VALUES("1006","43","27","0");
INSERT INTO test_scores VALUES("1007","43","9","0");
INSERT INTO test_scores VALUES("1008","43","95","0");
INSERT INTO test_scores VALUES("1009","43","12","3");
INSERT INTO test_scores VALUES("1010","44","12","5");
INSERT INTO test_scores VALUES("1011","45","11","6");
INSERT INTO test_scores VALUES("1012","45","23","6");
INSERT INTO test_scores VALUES("1013","45","2","6");
INSERT INTO test_scores VALUES("1014","45","20","6");
INSERT INTO test_scores VALUES("1015","45","32","3");
INSERT INTO test_scores VALUES("1016","45","34","6");
INSERT INTO test_scores VALUES("1017","46","19","6");
INSERT INTO test_scores VALUES("1018","46","11","4");
INSERT INTO test_scores VALUES("1019","46","21","6");
INSERT INTO test_scores VALUES("1020","46","34","6");
INSERT INTO test_scores VALUES("1021","46","6","6");
INSERT INTO test_scores VALUES("1022","47","23","6");
INSERT INTO test_scores VALUES("1023","47","21","6");
INSERT INTO test_scores VALUES("1024","47","2","6");
INSERT INTO test_scores VALUES("1025","47","20","6");
INSERT INTO test_scores VALUES("1026","47","34","6");
INSERT INTO test_scores VALUES("1027","47","22","6");
INSERT INTO test_scores VALUES("1028","46","22","6");
INSERT INTO test_scores VALUES("1029","48","19","3");
INSERT INTO test_scores VALUES("1030","48","23","3");
INSERT INTO test_scores VALUES("1031","48","2","6");
INSERT INTO test_scores VALUES("1032","48","32","3");
INSERT INTO test_scores VALUES("1033","48","6","2");
INSERT INTO test_scores VALUES("1034","48","22","1");
INSERT INTO test_scores VALUES("1035","49","19","6");
INSERT INTO test_scores VALUES("1036","49","11","3");
INSERT INTO test_scores VALUES("1037","49","21","6");
INSERT INTO test_scores VALUES("1038","49","20","6");
INSERT INTO test_scores VALUES("1039","49","32","6");
INSERT INTO test_scores VALUES("1040","49","6","6");
INSERT INTO test_scores VALUES("1044","51","32","1");
INSERT INTO test_scores VALUES("2583","138","144","6");
INSERT INTO test_scores VALUES("2580","138","109","4");
INSERT INTO test_scores VALUES("1045","51","27","1");
INSERT INTO test_scores VALUES("1046","51","1","1");
INSERT INTO test_scores VALUES("1047","51","28","1");
INSERT INTO test_scores VALUES("1048","51","34","1");
INSERT INTO test_scores VALUES("1049","51","3","1");
INSERT INTO test_scores VALUES("1050","51","104","1");
INSERT INTO test_scores VALUES("1051","51","2","1");
INSERT INTO test_scores VALUES("1075","52","9","6");
INSERT INTO test_scores VALUES("1053","51","96","1");
INSERT INTO test_scores VALUES("1054","51","12","1");
INSERT INTO test_scores VALUES("1055","51","74","1");
INSERT INTO test_scores VALUES("1056","51","36","1");
INSERT INTO test_scores VALUES("1057","51","37","1");
INSERT INTO test_scores VALUES("1058","51","65","1");
INSERT INTO test_scores VALUES("1059","51","26","1");
INSERT INTO test_scores VALUES("1060","51","66","1");
INSERT INTO test_scores VALUES("1061","51","22","1");
INSERT INTO test_scores VALUES("1062","51","4","1");
INSERT INTO test_scores VALUES("1063","51","33","1");
INSERT INTO test_scores VALUES("1064","51","40","1");
INSERT INTO test_scores VALUES("1065","51","6","1");
INSERT INTO test_scores VALUES("1066","51","7","1");
INSERT INTO test_scores VALUES("1067","51","5","1");
INSERT INTO test_scores VALUES("1068","51","76","1");
INSERT INTO test_scores VALUES("1069","51","95","1");
INSERT INTO test_scores VALUES("1070","51","31","1");
INSERT INTO test_scores VALUES("1071","51","23","1");
INSERT INTO test_scores VALUES("1072","51","67","1");
INSERT INTO test_scores VALUES("1073","51","21","0");
INSERT INTO test_scores VALUES("1074","51","30","1");
INSERT INTO test_scores VALUES("1076","52","85","0");
INSERT INTO test_scores VALUES("1077","52","37","4");
INSERT INTO test_scores VALUES("1078","52","28","2");
INSERT INTO test_scores VALUES("1079","52","1","2");
INSERT INTO test_scores VALUES("1080","52","81","2");
INSERT INTO test_scores VALUES("1081","52","5","0");
INSERT INTO test_scores VALUES("1082","52","40","6");
INSERT INTO test_scores VALUES("1083","52","26","2");
INSERT INTO test_scores VALUES("1084","52","72","2");
INSERT INTO test_scores VALUES("1085","52","36","2");
INSERT INTO test_scores VALUES("1086","52","66","2");
INSERT INTO test_scores VALUES("1087","52","95","0");
INSERT INTO test_scores VALUES("1088","52","67","4");
INSERT INTO test_scores VALUES("1089","52","7","0");
INSERT INTO test_scores VALUES("1090","52","86","0");
INSERT INTO test_scores VALUES("1091","52","76","4");
INSERT INTO test_scores VALUES("1092","52","39","6");
INSERT INTO test_scores VALUES("1093","52","33","6");
INSERT INTO test_scores VALUES("1094","52","31","2");
INSERT INTO test_scores VALUES("1095","52","2","6");
INSERT INTO test_scores VALUES("1096","52","27","4");
INSERT INTO test_scores VALUES("1097","52","91","0");
INSERT INTO test_scores VALUES("1098","52","65","6");
INSERT INTO test_scores VALUES("1099","52","3","2");
INSERT INTO test_scores VALUES("1100","52","35","4");
INSERT INTO test_scores VALUES("1101","52","22","4");
INSERT INTO test_scores VALUES("1102","52","69","4");
INSERT INTO test_scores VALUES("1103","52","104","0");
INSERT INTO test_scores VALUES("1104","52","73","2");
INSERT INTO test_scores VALUES("1105","52","23","6");
INSERT INTO test_scores VALUES("1106","52","34","6");
INSERT INTO test_scores VALUES("1107","52","32","4");
INSERT INTO test_scores VALUES("1108","52","42","0");
INSERT INTO test_scores VALUES("1109","52","30","0");
INSERT INTO test_scores VALUES("1110","52","57","0");
INSERT INTO test_scores VALUES("1111","54","39","2");
INSERT INTO test_scores VALUES("1112","54","42","0");
INSERT INTO test_scores VALUES("1113","54","57","0");
INSERT INTO test_scores VALUES("1114","54","30","2");
INSERT INTO test_scores VALUES("1115","54","76","0");
INSERT INTO test_scores VALUES("1116","54","23","6");
INSERT INTO test_scores VALUES("1117","54","34","4");
INSERT INTO test_scores VALUES("1118","54","32","6");
INSERT INTO test_scores VALUES("1119","54","35","2");
INSERT INTO test_scores VALUES("1120","54","3","4");
INSERT INTO test_scores VALUES("1121","54","22","2");
INSERT INTO test_scores VALUES("1122","54","73","2");
INSERT INTO test_scores VALUES("1123","54","33","6");
INSERT INTO test_scores VALUES("1124","54","104","0");
INSERT INTO test_scores VALUES("1125","54","69","0");
INSERT INTO test_scores VALUES("1126","54","9","2");
INSERT INTO test_scores VALUES("1127","54","65","4");
INSERT INTO test_scores VALUES("1128","54","2","6");
INSERT INTO test_scores VALUES("1129","54","31","2");
INSERT INTO test_scores VALUES("1130","54","27","0");
INSERT INTO test_scores VALUES("1131","54","28","0");
INSERT INTO test_scores VALUES("1132","54","37","6");
INSERT INTO test_scores VALUES("1133","54","1","4");
INSERT INTO test_scores VALUES("1134","54","102","0");
INSERT INTO test_scores VALUES("1135","54","66","0");
INSERT INTO test_scores VALUES("1136","54","36","2");
INSERT INTO test_scores VALUES("1137","54","72","6");
INSERT INTO test_scores VALUES("1138","54","26","0");
INSERT INTO test_scores VALUES("1139","54","40","4");
INSERT INTO test_scores VALUES("1140","54","85","0");
INSERT INTO test_scores VALUES("1141","54","5","0");
INSERT INTO test_scores VALUES("1142","54","81","2");
INSERT INTO test_scores VALUES("1143","54","7","2");
INSERT INTO test_scores VALUES("1144","54","95","0");
INSERT INTO test_scores VALUES("1145","54","67","0");
INSERT INTO test_scores VALUES("1146","54","86","2");
INSERT INTO test_scores VALUES("1147","53","34","6");
INSERT INTO test_scores VALUES("1148","53","23","6");
INSERT INTO test_scores VALUES("1149","53","32","4");
INSERT INTO test_scores VALUES("1150","53","76","4");
INSERT INTO test_scores VALUES("1151","53","30","6");
INSERT INTO test_scores VALUES("1152","53","57","0");
INSERT INTO test_scores VALUES("1153","53","42","4");
INSERT INTO test_scores VALUES("1154","53","67","6");
INSERT INTO test_scores VALUES("1155","53","95","2");
INSERT INTO test_scores VALUES("1156","53","7","4");
INSERT INTO test_scores VALUES("1157","53","85","4");
INSERT INTO test_scores VALUES("1158","53","86","0");
INSERT INTO test_scores VALUES("1159","53","81","2");
INSERT INTO test_scores VALUES("1160","53","5","2");
INSERT INTO test_scores VALUES("1161","53","40","6");
INSERT INTO test_scores VALUES("1162","53","26","4");
INSERT INTO test_scores VALUES("1163","53","36","6");
INSERT INTO test_scores VALUES("1164","53","1","4");
INSERT INTO test_scores VALUES("1165","53","102","2");
INSERT INTO test_scores VALUES("1166","53","66","4");
INSERT INTO test_scores VALUES("1167","53","31","6");
INSERT INTO test_scores VALUES("1168","53","28","2");
INSERT INTO test_scores VALUES("1169","53","37","4");
INSERT INTO test_scores VALUES("1170","53","65","4");
INSERT INTO test_scores VALUES("1171","53","27","2");
INSERT INTO test_scores VALUES("1172","53","2","6");
INSERT INTO test_scores VALUES("1173","53","9","2");
INSERT INTO test_scores VALUES("1174","53","69","4");
INSERT INTO test_scores VALUES("1175","53","33","6");
INSERT INTO test_scores VALUES("1176","53","104","0");
INSERT INTO test_scores VALUES("1177","53","73","6");
INSERT INTO test_scores VALUES("1178","53","22","4");
INSERT INTO test_scores VALUES("1179","53","3","4");
INSERT INTO test_scores VALUES("1180","53","35","2");
INSERT INTO test_scores VALUES("1181","53","39","2");
INSERT INTO test_scores VALUES("1250","55","72","2");
INSERT INTO test_scores VALUES("1183","55","5","0");
INSERT INTO test_scores VALUES("1184","55","10","0");
INSERT INTO test_scores VALUES("1185","55","23","2");
INSERT INTO test_scores VALUES("1186","55","32","2");
INSERT INTO test_scores VALUES("1187","55","39","2");
INSERT INTO test_scores VALUES("1188","55","3","2");
INSERT INTO test_scores VALUES("1189","55","30","0");
INSERT INTO test_scores VALUES("1190","55","102","0");
INSERT INTO test_scores VALUES("1191","55","76","0");
INSERT INTO test_scores VALUES("1192","55","12","2");
INSERT INTO test_scores VALUES("1193","55","6","0");
INSERT INTO test_scores VALUES("1194","55","42","0");
INSERT INTO test_scores VALUES("1195","55","7","2");
INSERT INTO test_scores VALUES("1196","55","65","2");
INSERT INTO test_scores VALUES("1197","55","40","2");
INSERT INTO test_scores VALUES("1198","55","66","2");
INSERT INTO test_scores VALUES("1199","55","81","0");
INSERT INTO test_scores VALUES("1200","55","67","2");
INSERT INTO test_scores VALUES("1201","55","54","2");
INSERT INTO test_scores VALUES("1202","55","36","2");
INSERT INTO test_scores VALUES("1203","55","85","2");
INSERT INTO test_scores VALUES("1204","55","96","0");
INSERT INTO test_scores VALUES("1205","55","104","0");
INSERT INTO test_scores VALUES("1206","55","9","0");
INSERT INTO test_scores VALUES("1207","55","4","0");
INSERT INTO test_scores VALUES("1208","55","26","0");
INSERT INTO test_scores VALUES("1209","55","69","0");
INSERT INTO test_scores VALUES("1210","55","22","0");
INSERT INTO test_scores VALUES("1211","55","73","2");
INSERT INTO test_scores VALUES("1212","55","77","0");
INSERT INTO test_scores VALUES("1213","55","28","0");
INSERT INTO test_scores VALUES("1214","55","37","0");
INSERT INTO test_scores VALUES("1215","55","31","2");
INSERT INTO test_scores VALUES("1216","55","2","4");
INSERT INTO test_scores VALUES("1219","57","5","2");
INSERT INTO test_scores VALUES("1220","57","72","0");
INSERT INTO test_scores VALUES("1221","57","32","6");
INSERT INTO test_scores VALUES("1222","57","2","6");
INSERT INTO test_scores VALUES("1223","57","28","2");
INSERT INTO test_scores VALUES("1224","57","31","2");
INSERT INTO test_scores VALUES("1225","57","37","4");
INSERT INTO test_scores VALUES("1226","57","36","4");
INSERT INTO test_scores VALUES("1227","57","67","2");
INSERT INTO test_scores VALUES("1228","57","54","2");
INSERT INTO test_scores VALUES("1229","57","3","2");
INSERT INTO test_scores VALUES("1230","57","30","2");
INSERT INTO test_scores VALUES("1231","57","102","0");
INSERT INTO test_scores VALUES("1232","57","76","4");
INSERT INTO test_scores VALUES("1233","57","85","4");
INSERT INTO test_scores VALUES("1234","57","40","2");
INSERT INTO test_scores VALUES("1235","57","66","2");
INSERT INTO test_scores VALUES("1236","57","81","4");
INSERT INTO test_scores VALUES("1237","57","12","6");
INSERT INTO test_scores VALUES("1238","57","6","6");
INSERT INTO test_scores VALUES("1239","57","42","2");
INSERT INTO test_scores VALUES("1240","57","7","0");
INSERT INTO test_scores VALUES("1241","57","65","2");
INSERT INTO test_scores VALUES("1242","57","104","0");
INSERT INTO test_scores VALUES("1243","57","96","2");
INSERT INTO test_scores VALUES("1244","57","9","0");
INSERT INTO test_scores VALUES("1245","57","73","2");
INSERT INTO test_scores VALUES("1246","57","22","2");
INSERT INTO test_scores VALUES("1247","57","4","4");
INSERT INTO test_scores VALUES("1248","57","26","0");
INSERT INTO test_scores VALUES("1249","57","69","0");
INSERT INTO test_scores VALUES("1251","58","22","0");
INSERT INTO test_scores VALUES("1252","58","4","0");
INSERT INTO test_scores VALUES("1253","58","31","3");
INSERT INTO test_scores VALUES("1254","58","35","0");
INSERT INTO test_scores VALUES("1255","58","37","6");
INSERT INTO test_scores VALUES("1256","58","28","0");
INSERT INTO test_scores VALUES("1257","58","40","0");
INSERT INTO test_scores VALUES("1258","58","2","6");
INSERT INTO test_scores VALUES("1259","58","102","0");
INSERT INTO test_scores VALUES("1260","58","36","0");
INSERT INTO test_scores VALUES("1261","58","74","0");
INSERT INTO test_scores VALUES("1262","58","26","0");
INSERT INTO test_scores VALUES("1263","58","12","0");
INSERT INTO test_scores VALUES("1264","58","34","3");
INSERT INTO test_scores VALUES("1265","57","10","4");
INSERT INTO test_scores VALUES("1266","58","32","6");
INSERT INTO test_scores VALUES("1267","58","23","1");
INSERT INTO test_scores VALUES("1268","57","33","4");
INSERT INTO test_scores VALUES("1269","58","6","0");
INSERT INTO test_scores VALUES("1270","58","105","0");
INSERT INTO test_scores VALUES("1271","58","96","0");
INSERT INTO test_scores VALUES("1272","58","104","0");
INSERT INTO test_scores VALUES("1273","58","39","0");
INSERT INTO test_scores VALUES("1274","58","5","1");
INSERT INTO test_scores VALUES("1275","58","3","3");
INSERT INTO test_scores VALUES("1276","55","33","2");
INSERT INTO test_scores VALUES("1277","58","1","1");
INSERT INTO test_scores VALUES("1278","58","7","0");
INSERT INTO test_scores VALUES("1279","58","54","3");
INSERT INTO test_scores VALUES("1280","58","85","0");
INSERT INTO test_scores VALUES("1281","58","86","0");
INSERT INTO test_scores VALUES("1282","58","66","0");
INSERT INTO test_scores VALUES("1283","58","67","1");
INSERT INTO test_scores VALUES("1284","58","30","0");
INSERT INTO test_scores VALUES("1285","56","33","4");
INSERT INTO test_scores VALUES("1286","54","12","2");
INSERT INTO test_scores VALUES("1287","53","12","4");
INSERT INTO test_scores VALUES("1288","52","12","4");
INSERT INTO test_scores VALUES("1289","59","22","6");
INSERT INTO test_scores VALUES("1290","59","4","4");
INSERT INTO test_scores VALUES("1291","59","31","1");
INSERT INTO test_scores VALUES("1292","59","35","1");
INSERT INTO test_scores VALUES("1293","59","104","1");
INSERT INTO test_scores VALUES("1294","59","96","4");
INSERT INTO test_scores VALUES("1295","59","105","0");
INSERT INTO test_scores VALUES("1296","59","28","3");
INSERT INTO test_scores VALUES("1297","59","40","6");
INSERT INTO test_scores VALUES("1298","59","37","6");
INSERT INTO test_scores VALUES("1299","59","2","6");
INSERT INTO test_scores VALUES("1300","59","102","4");
INSERT INTO test_scores VALUES("1301","59","36","1");
INSERT INTO test_scores VALUES("1302","59","74","2");
INSERT INTO test_scores VALUES("1303","59","26","1");
INSERT INTO test_scores VALUES("1304","59","33","4");
INSERT INTO test_scores VALUES("1305","59","7","3");
INSERT INTO test_scores VALUES("1306","59","54","4");
INSERT INTO test_scores VALUES("1307","59","1","1");
INSERT INTO test_scores VALUES("1308","59","3","6");
INSERT INTO test_scores VALUES("1309","59","5","0");
INSERT INTO test_scores VALUES("1310","59","39","6");
INSERT INTO test_scores VALUES("1311","59","85","1");
INSERT INTO test_scores VALUES("1312","59","30","1");
INSERT INTO test_scores VALUES("1313","59","86","4");
INSERT INTO test_scores VALUES("1314","59","66","4");
INSERT INTO test_scores VALUES("1315","59","67","4");
INSERT INTO test_scores VALUES("1316","59","34","5");
INSERT INTO test_scores VALUES("1317","59","23","6");
INSERT INTO test_scores VALUES("1318","59","32","6");
INSERT INTO test_scores VALUES("1319","59","12","6");
INSERT INTO test_scores VALUES("1320","59","6","6");
INSERT INTO test_scores VALUES("1321","60","39","3");
INSERT INTO test_scores VALUES("1322","60","3","3");
INSERT INTO test_scores VALUES("1323","60","86","2");
INSERT INTO test_scores VALUES("1324","60","5","3");
INSERT INTO test_scores VALUES("1325","60","67","1");
INSERT INTO test_scores VALUES("1326","60","66","2");
INSERT INTO test_scores VALUES("1327","60","1","3");
INSERT INTO test_scores VALUES("1328","60","2","6");
INSERT INTO test_scores VALUES("1329","60","85","3");
INSERT INTO test_scores VALUES("1330","60","28","2");
INSERT INTO test_scores VALUES("1331","60","37","6");
INSERT INTO test_scores VALUES("1332","60","33","3");
INSERT INTO test_scores VALUES("1333","60","40","2");
INSERT INTO test_scores VALUES("1334","60","35","0");
INSERT INTO test_scores VALUES("1335","60","7","2");
INSERT INTO test_scores VALUES("1336","60","54","2");
INSERT INTO test_scores VALUES("1337","60","31","2");
INSERT INTO test_scores VALUES("1338","60","4","2");
INSERT INTO test_scores VALUES("1339","60","30","2");
INSERT INTO test_scores VALUES("1340","60","102","2");
INSERT INTO test_scores VALUES("1341","60","22","2");
INSERT INTO test_scores VALUES("1342","60","74","2");
INSERT INTO test_scores VALUES("1343","60","36","2");
INSERT INTO test_scores VALUES("1344","60","26","3");
INSERT INTO test_scores VALUES("1345","60","104","0");
INSERT INTO test_scores VALUES("1346","60","96","2");
INSERT INTO test_scores VALUES("1347","60","105","0");
INSERT INTO test_scores VALUES("1348","60","23","0");
INSERT INTO test_scores VALUES("1349","60","32","6");
INSERT INTO test_scores VALUES("1350","60","6","6");
INSERT INTO test_scores VALUES("1351","60","34","5");
INSERT INTO test_scores VALUES("1352","60","12","5");
INSERT INTO test_scores VALUES("1353","61","67","3");
INSERT INTO test_scores VALUES("1354","61","86","0");
INSERT INTO test_scores VALUES("1355","61","66","0");
INSERT INTO test_scores VALUES("1356","61","23","0");
INSERT INTO test_scores VALUES("1357","55","34","2");
INSERT INTO test_scores VALUES("1358","57","34","4");
INSERT INTO test_scores VALUES("1359","61","6","5");
INSERT INTO test_scores VALUES("1360","61","32","6");
INSERT INTO test_scores VALUES("1361","61","34","0");
INSERT INTO test_scores VALUES("1362","61","12","0");
INSERT INTO test_scores VALUES("1363","61","105","0");
INSERT INTO test_scores VALUES("1364","61","96","0");
INSERT INTO test_scores VALUES("1365","61","104","0");
INSERT INTO test_scores VALUES("1366","61","35","0");
INSERT INTO test_scores VALUES("1367","61","31","0");
INSERT INTO test_scores VALUES("1368","61","4","0");
INSERT INTO test_scores VALUES("1369","61","22","1");
INSERT INTO test_scores VALUES("1370","61","2","6");
INSERT INTO test_scores VALUES("1371","61","40","0");
INSERT INTO test_scores VALUES("1372","61","28","0");
INSERT INTO test_scores VALUES("1373","61","37","3");
INSERT INTO test_scores VALUES("1374","61","54","0");
INSERT INTO test_scores VALUES("1375","61","85","0");
INSERT INTO test_scores VALUES("1376","61","7","3");
INSERT INTO test_scores VALUES("1377","61","33","3");
INSERT INTO test_scores VALUES("1378","61","1","1");
INSERT INTO test_scores VALUES("1379","61","5","0");
INSERT INTO test_scores VALUES("1380","61","3","1");
INSERT INTO test_scores VALUES("1381","61","39","1");
INSERT INTO test_scores VALUES("1382","61","74","1");
INSERT INTO test_scores VALUES("1383","61","36","3");
INSERT INTO test_scores VALUES("1384","61","102","0");
INSERT INTO test_scores VALUES("2588","138","121","6");
INSERT INTO test_scores VALUES("1386","62","21","6");
INSERT INTO test_scores VALUES("1387","62","32","2");
INSERT INTO test_scores VALUES("1388","62","19","6");
INSERT INTO test_scores VALUES("1389","62","23","6");
INSERT INTO test_scores VALUES("1390","62","2","4");
INSERT INTO test_scores VALUES("1391","63","32","6");
INSERT INTO test_scores VALUES("1392","63","20","6");
INSERT INTO test_scores VALUES("1393","63","11","6");
INSERT INTO test_scores VALUES("1394","63","21","6");
INSERT INTO test_scores VALUES("1395","63","40","4");
INSERT INTO test_scores VALUES("1396","64","32","4");
INSERT INTO test_scores VALUES("1397","64","20","6");
INSERT INTO test_scores VALUES("1398","64","11","4");
INSERT INTO test_scores VALUES("1399","64","23","6");
INSERT INTO test_scores VALUES("1400","64","33","6");
INSERT INTO test_scores VALUES("1401","65","19","2");
INSERT INTO test_scores VALUES("1402","65","20","6");
INSERT INTO test_scores VALUES("1403","65","34","4");
INSERT INTO test_scores VALUES("1404","65","2","6");
INSERT INTO test_scores VALUES("1405","65","33","4");
INSERT INTO test_scores VALUES("1406","66","11","6");
INSERT INTO test_scores VALUES("1407","66","34","6");
INSERT INTO test_scores VALUES("1408","66","2","6");
INSERT INTO test_scores VALUES("1409","66","40","6");
INSERT INTO test_scores VALUES("1410","66","33","6");
INSERT INTO test_scores VALUES("1411","67","19","4");
INSERT INTO test_scores VALUES("1412","67","23","6");
INSERT INTO test_scores VALUES("1413","67","34","6");
INSERT INTO test_scores VALUES("1414","67","21","6");
INSERT INTO test_scores VALUES("1415","67","40","6");
INSERT INTO test_scores VALUES("1416","75","23","6");
INSERT INTO test_scores VALUES("1417","75","5","4");
INSERT INTO test_scores VALUES("1418","75","32","4");
INSERT INTO test_scores VALUES("1419","75","34","6");
INSERT INTO test_scores VALUES("1420","75","40","6");
INSERT INTO test_scores VALUES("1421","75","33","4");
INSERT INTO test_scores VALUES("1422","75","54","2");
INSERT INTO test_scores VALUES("1423","75","85","2");
INSERT INTO test_scores VALUES("1424","75","3","2");
INSERT INTO test_scores VALUES("1425","75","26","2");
INSERT INTO test_scores VALUES("1426","75","76","2");
INSERT INTO test_scores VALUES("1427","75","67","2");
INSERT INTO test_scores VALUES("1428","75","65","4");
INSERT INTO test_scores VALUES("1429","75","36","4");
INSERT INTO test_scores VALUES("1430","75","102","2");
INSERT INTO test_scores VALUES("1431","75","2","6");
INSERT INTO test_scores VALUES("1432","75","37","6");
INSERT INTO test_scores VALUES("1433","75","31","2");
INSERT INTO test_scores VALUES("1434","75","66","2");
INSERT INTO test_scores VALUES("1435","75","7","2");
INSERT INTO test_scores VALUES("1436","75","73","6");
INSERT INTO test_scores VALUES("1437","75","9","2");
INSERT INTO test_scores VALUES("1438","75","27","0");
INSERT INTO test_scores VALUES("1439","75","35","2");
INSERT INTO test_scores VALUES("1440","75","28","4");
INSERT INTO test_scores VALUES("1441","75","22","6");
INSERT INTO test_scores VALUES("1442","75","12","4");
INSERT INTO test_scores VALUES("1443","76","32","6");
INSERT INTO test_scores VALUES("1444","76","33","2");
INSERT INTO test_scores VALUES("1445","76","72","0");
INSERT INTO test_scores VALUES("1446","76","12","2");
INSERT INTO test_scores VALUES("1447","76","40","0");
INSERT INTO test_scores VALUES("1448","76","85","0");
INSERT INTO test_scores VALUES("1449","76","34","4");
INSERT INTO test_scores VALUES("1450","76","2","4");
INSERT INTO test_scores VALUES("1451","76","22","0");
INSERT INTO test_scores VALUES("1452","76","28","2");
INSERT INTO test_scores VALUES("1453","76","35","0");
INSERT INTO test_scores VALUES("1454","76","27","0");
INSERT INTO test_scores VALUES("1455","76","7","2");
INSERT INTO test_scores VALUES("1456","76","30","0");
INSERT INTO test_scores VALUES("1457","76","73","0");
INSERT INTO test_scores VALUES("1458","76","9","0");
INSERT INTO test_scores VALUES("1459","76","5","0");
INSERT INTO test_scores VALUES("1460","76","23","2");
INSERT INTO test_scores VALUES("1461","76","102","0");
INSERT INTO test_scores VALUES("1462","76","36","0");
INSERT INTO test_scores VALUES("1463","76","65","0");
INSERT INTO test_scores VALUES("1464","76","67","2");
INSERT INTO test_scores VALUES("1465","76","76","0");
INSERT INTO test_scores VALUES("1466","76","26","0");
INSERT INTO test_scores VALUES("1467","76","3","2");
INSERT INTO test_scores VALUES("1468","76","31","0");
INSERT INTO test_scores VALUES("1469","76","37","4");
INSERT INTO test_scores VALUES("1470","76","66","0");
INSERT INTO test_scores VALUES("1471","77","85","6");
INSERT INTO test_scores VALUES("1472","77","40","4");
INSERT INTO test_scores VALUES("1473","77","33","6");
INSERT INTO test_scores VALUES("1474","77","34","4");
INSERT INTO test_scores VALUES("1475","77","5","6");
INSERT INTO test_scores VALUES("1476","77","32","6");
INSERT INTO test_scores VALUES("1477","77","23","6");
INSERT INTO test_scores VALUES("1478","77","12","6");
INSERT INTO test_scores VALUES("1479","77","73","2");
INSERT INTO test_scores VALUES("1480","77","30","4");
INSERT INTO test_scores VALUES("1481","77","7","6");
INSERT INTO test_scores VALUES("1482","77","9","6");
INSERT INTO test_scores VALUES("1483","77","28","2");
INSERT INTO test_scores VALUES("1484","77","27","0");
INSERT INTO test_scores VALUES("1485","77","35","2");
INSERT INTO test_scores VALUES("1486","77","22","6");
INSERT INTO test_scores VALUES("1487","77","72","6");
INSERT INTO test_scores VALUES("1488","77","2","6");
INSERT INTO test_scores VALUES("1489","77","37","6");
INSERT INTO test_scores VALUES("1490","77","66","6");
INSERT INTO test_scores VALUES("1491","77","31","2");
INSERT INTO test_scores VALUES("1492","77","67","6");
INSERT INTO test_scores VALUES("1493","77","65","0");
INSERT INTO test_scores VALUES("1494","77","36","6");
INSERT INTO test_scores VALUES("1495","77","102","4");
INSERT INTO test_scores VALUES("1496","77","3","6");
INSERT INTO test_scores VALUES("1497","77","26","4");
INSERT INTO test_scores VALUES("1498","77","76","4");
INSERT INTO test_scores VALUES("1499","78","23","6");
INSERT INTO test_scores VALUES("1500","78","72","6");
INSERT INTO test_scores VALUES("1501","78","22","6");
INSERT INTO test_scores VALUES("1502","78","9","4");
INSERT INTO test_scores VALUES("1503","78","28","6");
INSERT INTO test_scores VALUES("1504","78","7","4");
INSERT INTO test_scores VALUES("1505","78","30","4");
INSERT INTO test_scores VALUES("1506","78","73","6");
INSERT INTO test_scores VALUES("1507","78","33","6");
INSERT INTO test_scores VALUES("1508","78","35","2");
INSERT INTO test_scores VALUES("1509","78","27","2");
INSERT INTO test_scores VALUES("1510","78","31","4");
INSERT INTO test_scores VALUES("1511","78","37","6");
INSERT INTO test_scores VALUES("1512","78","66","6");
INSERT INTO test_scores VALUES("1513","78","2","6");
INSERT INTO test_scores VALUES("1514","78","102","4");
INSERT INTO test_scores VALUES("1515","78","36","4");
INSERT INTO test_scores VALUES("1516","78","65","4");
INSERT INTO test_scores VALUES("1517","78","67","6");
INSERT INTO test_scores VALUES("1518","78","76","4");
INSERT INTO test_scores VALUES("1519","78","26","4");
INSERT INTO test_scores VALUES("1520","78","3","6");
INSERT INTO test_scores VALUES("1521","78","34","6");
INSERT INTO test_scores VALUES("1522","78","32","6");
INSERT INTO test_scores VALUES("1523","78","5","2");
INSERT INTO test_scores VALUES("1524","78","12","4");
INSERT INTO test_scores VALUES("1525","78","40","6");
INSERT INTO test_scores VALUES("1526","78","85","6");
INSERT INTO test_scores VALUES("1527","75","30","2");
INSERT INTO test_scores VALUES("1528","75","72","0");
INSERT INTO test_scores VALUES("1529","75","6","6");
INSERT INTO test_scores VALUES("1530","76","6","4");
INSERT INTO test_scores VALUES("1531","77","6","6");
INSERT INTO test_scores VALUES("1532","78","6","4");
INSERT INTO test_scores VALUES("1533","79","27","0");
INSERT INTO test_scores VALUES("1534","79","30","0");
INSERT INTO test_scores VALUES("1535","79","31","4");
INSERT INTO test_scores VALUES("1536","79","22","1");
INSERT INTO test_scores VALUES("1537","79","73","4");
INSERT INTO test_scores VALUES("1538","79","37","2");
INSERT INTO test_scores VALUES("1539","79","28","0");
INSERT INTO test_scores VALUES("1540","79","66","1");
INSERT INTO test_scores VALUES("1541","79","2","6");
INSERT INTO test_scores VALUES("1542","79","33","6");
INSERT INTO test_scores VALUES("1543","79","26","2");
INSERT INTO test_scores VALUES("1544","79","102","3");
INSERT INTO test_scores VALUES("1545","79","67","0");
INSERT INTO test_scores VALUES("1546","79","3","0");
INSERT INTO test_scores VALUES("1547","79","40","1");
INSERT INTO test_scores VALUES("1548","79","76","0");
INSERT INTO test_scores VALUES("1549","79","85","1");
INSERT INTO test_scores VALUES("1550","79","1","4");
INSERT INTO test_scores VALUES("1551","79","32","4");
INSERT INTO test_scores VALUES("1552","79","23","4");
INSERT INTO test_scores VALUES("1553","79","36","4");
INSERT INTO test_scores VALUES("1554","79","7","0");
INSERT INTO test_scores VALUES("1555","80","2","6");
INSERT INTO test_scores VALUES("1556","80","23","6");
INSERT INTO test_scores VALUES("1557","80","7","1");
INSERT INTO test_scores VALUES("1558","80","32","5");
INSERT INTO test_scores VALUES("1559","80","85","3");
INSERT INTO test_scores VALUES("1560","80","1","2");
INSERT INTO test_scores VALUES("1561","80","76","2");
INSERT INTO test_scores VALUES("1562","80","40","2");
INSERT INTO test_scores VALUES("1563","80","67","3");
INSERT INTO test_scores VALUES("1564","80","3","6");
INSERT INTO test_scores VALUES("1565","80","102","0");
INSERT INTO test_scores VALUES("1566","80","36","3");
INSERT INTO test_scores VALUES("1567","80","26","2");
INSERT INTO test_scores VALUES("1568","80","33","6");
INSERT INTO test_scores VALUES("1569","80","66","1");
INSERT INTO test_scores VALUES("1570","80","37","5");
INSERT INTO test_scores VALUES("1571","80","28","2");
INSERT INTO test_scores VALUES("1572","80","27","2");
INSERT INTO test_scores VALUES("1573","80","30","2");
INSERT INTO test_scores VALUES("1574","80","73","3");
INSERT INTO test_scores VALUES("1575","80","22","3");
INSERT INTO test_scores VALUES("1576","80","31","2");
INSERT INTO test_scores VALUES("1577","81","85","6");
INSERT INTO test_scores VALUES("1578","81","1","3");
INSERT INTO test_scores VALUES("1579","81","32","6");
INSERT INTO test_scores VALUES("1580","81","7","1");
INSERT INTO test_scores VALUES("1581","81","67","1");
INSERT INTO test_scores VALUES("1582","81","3","1");
INSERT INTO test_scores VALUES("1583","81","40","3");
INSERT INTO test_scores VALUES("1584","81","76","3");
INSERT INTO test_scores VALUES("1585","81","33","6");
INSERT INTO test_scores VALUES("1586","81","36","1");
INSERT INTO test_scores VALUES("1587","81","102","0");
INSERT INTO test_scores VALUES("1588","81","27","0");
INSERT INTO test_scores VALUES("1589","81","22","3");
INSERT INTO test_scores VALUES("1590","81","73","1");
INSERT INTO test_scores VALUES("1591","81","28","0");
INSERT INTO test_scores VALUES("1592","81","37","6");
INSERT INTO test_scores VALUES("1593","81","66","3");
INSERT INTO test_scores VALUES("1594","81","2","6");
INSERT INTO test_scores VALUES("1595","82","32","5");
INSERT INTO test_scores VALUES("1596","82","7","6");
INSERT INTO test_scores VALUES("1597","82","85","2");
INSERT INTO test_scores VALUES("1598","82","1","6");
INSERT INTO test_scores VALUES("1599","82","67","5");
INSERT INTO test_scores VALUES("1600","82","3","0");
INSERT INTO test_scores VALUES("1601","82","40","0");
INSERT INTO test_scores VALUES("1602","82","76","0");
INSERT INTO test_scores VALUES("1603","82","33","2");
INSERT INTO test_scores VALUES("1604","82","36","0");
INSERT INTO test_scores VALUES("1605","82","102","0");
INSERT INTO test_scores VALUES("1606","82","27","0");
INSERT INTO test_scores VALUES("1607","82","22","1");
INSERT INTO test_scores VALUES("1608","82","28","0");
INSERT INTO test_scores VALUES("1609","82","37","6");
INSERT INTO test_scores VALUES("1610","82","66","0");
INSERT INTO test_scores VALUES("1611","82","73","3");
INSERT INTO test_scores VALUES("1612","82","2","6");
INSERT INTO test_scores VALUES("1613","82","23","6");
INSERT INTO test_scores VALUES("1614","81","23","6");
INSERT INTO test_scores VALUES("1615","81","31","3");
INSERT INTO test_scores VALUES("1616","82","31","0");
INSERT INTO test_scores VALUES("2587","138","117","6");
INSERT INTO test_scores VALUES("1618","79","12","1");
INSERT INTO test_scores VALUES("1619","80","12","6");
INSERT INTO test_scores VALUES("1620","81","12","3");
INSERT INTO test_scores VALUES("1621","82","12","6");
INSERT INTO test_scores VALUES("1622","90","85","6");
INSERT INTO test_scores VALUES("1623","90","74","4");
INSERT INTO test_scores VALUES("1624","90","1","2");
INSERT INTO test_scores VALUES("1625","90","69","6");
INSERT INTO test_scores VALUES("1626","90","30","4");
INSERT INTO test_scores VALUES("1627","90","4","4");
INSERT INTO test_scores VALUES("1628","90","2","6");
INSERT INTO test_scores VALUES("1629","90","37","6");
INSERT INTO test_scores VALUES("1630","90","66","6");
INSERT INTO test_scores VALUES("1631","90","26","4");
INSERT INTO test_scores VALUES("1632","90","35","4");
INSERT INTO test_scores VALUES("1633","90","28","4");
INSERT INTO test_scores VALUES("1634","90","22","4");
INSERT INTO test_scores VALUES("1635","90","73","6");
INSERT INTO test_scores VALUES("1636","90","36","6");
INSERT INTO test_scores VALUES("1637","90","33","6");
INSERT INTO test_scores VALUES("1638","90","3","6");
INSERT INTO test_scores VALUES("1639","90","76","6");
INSERT INTO test_scores VALUES("1640","90","40","6");
INSERT INTO test_scores VALUES("1641","90","31","6");
INSERT INTO test_scores VALUES("1642","90","102","2");
INSERT INTO test_scores VALUES("1643","90","23","6");
INSERT INTO test_scores VALUES("1644","90","6","6");
INSERT INTO test_scores VALUES("1645","90","12","6");
INSERT INTO test_scores VALUES("1646","90","32","6");
INSERT INTO test_scores VALUES("1647","90","34","4");
INSERT INTO test_scores VALUES("1648","91","74","4");
INSERT INTO test_scores VALUES("1649","91","34","4");
INSERT INTO test_scores VALUES("1650","91","23","4");
INSERT INTO test_scores VALUES("1651","91","12","4");
INSERT INTO test_scores VALUES("1652","91","32","6");
INSERT INTO test_scores VALUES("1653","91","6","4");
INSERT INTO test_scores VALUES("1654","91","85","4");
INSERT INTO test_scores VALUES("1655","91","1","2");
INSERT INTO test_scores VALUES("1656","91","40","6");
INSERT INTO test_scores VALUES("1657","91","31","4");
INSERT INTO test_scores VALUES("1658","91","102","4");
INSERT INTO test_scores VALUES("1659","91","33","4");
INSERT INTO test_scores VALUES("1660","91","3","2");
INSERT INTO test_scores VALUES("1661","91","36","6");
INSERT INTO test_scores VALUES("1662","91","76","4");
INSERT INTO test_scores VALUES("1663","91","66","2");
INSERT INTO test_scores VALUES("1664","91","37","4");
INSERT INTO test_scores VALUES("1665","91","26","2");
INSERT INTO test_scores VALUES("1666","91","2","4");
INSERT INTO test_scores VALUES("1667","91","35","2");
INSERT INTO test_scores VALUES("1668","91","28","0");
INSERT INTO test_scores VALUES("1669","91","22","6");
INSERT INTO test_scores VALUES("1670","91","73","2");
INSERT INTO test_scores VALUES("1671","91","69","4");
INSERT INTO test_scores VALUES("1672","91","30","2");
INSERT INTO test_scores VALUES("1673","91","4","4");
INSERT INTO test_scores VALUES("1674","93","4","2");
INSERT INTO test_scores VALUES("1675","93","69","0");
INSERT INTO test_scores VALUES("1676","93","30","0");
INSERT INTO test_scores VALUES("1677","93","28","0");
INSERT INTO test_scores VALUES("1678","93","35","0");
INSERT INTO test_scores VALUES("1679","93","22","4");
INSERT INTO test_scores VALUES("1680","93","73","0");
INSERT INTO test_scores VALUES("1681","93","2","4");
INSERT INTO test_scores VALUES("1682","93","37","4");
INSERT INTO test_scores VALUES("1683","93","66","0");
INSERT INTO test_scores VALUES("1684","93","26","0");
INSERT INTO test_scores VALUES("1685","93","1","0");
INSERT INTO test_scores VALUES("1686","93","85","0");
INSERT INTO test_scores VALUES("1687","93","74","0");
INSERT INTO test_scores VALUES("1688","93","3","2");
INSERT INTO test_scores VALUES("1689","93","36","0");
INSERT INTO test_scores VALUES("1690","93","33","0");
INSERT INTO test_scores VALUES("1691","93","76","0");
INSERT INTO test_scores VALUES("1692","93","102","0");
INSERT INTO test_scores VALUES("1693","93","31","0");
INSERT INTO test_scores VALUES("1694","93","40","0");
INSERT INTO test_scores VALUES("1695","93","6","4");
INSERT INTO test_scores VALUES("1696","93","23","4");
INSERT INTO test_scores VALUES("1697","93","12","6");
INSERT INTO test_scores VALUES("1698","93","32","4");
INSERT INTO test_scores VALUES("1699","93","34","2");
INSERT INTO test_scores VALUES("1700","94","34","2");
INSERT INTO test_scores VALUES("1701","94","32","4");
INSERT INTO test_scores VALUES("1702","94","23","6");
INSERT INTO test_scores VALUES("1703","94","6","6");
INSERT INTO test_scores VALUES("1704","94","12","6");
INSERT INTO test_scores VALUES("1705","94","2","6");
INSERT INTO test_scores VALUES("1706","94","3","4");
INSERT INTO test_scores VALUES("1707","94","36","2");
INSERT INTO test_scores VALUES("1708","94","76","0");
INSERT INTO test_scores VALUES("1709","94","66","2");
INSERT INTO test_scores VALUES("1710","94","37","6");
INSERT INTO test_scores VALUES("1711","94","40","4");
INSERT INTO test_scores VALUES("1712","94","31","2");
INSERT INTO test_scores VALUES("1713","94","102","2");
INSERT INTO test_scores VALUES("1714","94","35","2");
INSERT INTO test_scores VALUES("1715","94","28","4");
INSERT INTO test_scores VALUES("1716","94","22","6");
INSERT INTO test_scores VALUES("1717","94","73","4");
INSERT INTO test_scores VALUES("1718","94","4","6");
INSERT INTO test_scores VALUES("1719","94","69","2");
INSERT INTO test_scores VALUES("1720","94","74","4");
INSERT INTO test_scores VALUES("1721","94","85","2");
INSERT INTO test_scores VALUES("1722","94","1","6");
INSERT INTO test_scores VALUES("1723","94","30","2");
INSERT INTO test_scores VALUES("1724","94","26","2");
INSERT INTO test_scores VALUES("1725","97","7","2");
INSERT INTO test_scores VALUES("1726","97","111","0");
INSERT INTO test_scores VALUES("1727","97","42","2");
INSERT INTO test_scores VALUES("1728","97","4","6");
INSERT INTO test_scores VALUES("1729","97","187","0");
INSERT INTO test_scores VALUES("1730","97","77","2");
INSERT INTO test_scores VALUES("1731","97","9","0");
INSERT INTO test_scores VALUES("1732","97","55","2");
INSERT INTO test_scores VALUES("1733","97","2","6");
INSERT INTO test_scores VALUES("1734","97","35","2");
INSERT INTO test_scores VALUES("1735","97","22","4");
INSERT INTO test_scores VALUES("1736","97","69","4");
INSERT INTO test_scores VALUES("1737","97","73","4");
INSERT INTO test_scores VALUES("1738","97","28","4");
INSERT INTO test_scores VALUES("1739","97","37","4");
INSERT INTO test_scores VALUES("1740","97","36","4");
INSERT INTO test_scores VALUES("1741","97","165","4");
INSERT INTO test_scores VALUES("1742","97","66","6");
INSERT INTO test_scores VALUES("1743","97","40","4");
INSERT INTO test_scores VALUES("1744","97","31","2");
INSERT INTO test_scores VALUES("1745","97","102","6");
INSERT INTO test_scores VALUES("1746","97","39","4");
INSERT INTO test_scores VALUES("1747","97","67","0");
INSERT INTO test_scores VALUES("1748","97","76","6");
INSERT INTO test_scores VALUES("1749","97","3","2");
INSERT INTO test_scores VALUES("1750","97","54","4");
INSERT INTO test_scores VALUES("1751","97","12","0");
INSERT INTO test_scores VALUES("1752","97","6","4");
INSERT INTO test_scores VALUES("1753","95","111","2");
INSERT INTO test_scores VALUES("1754","95","42","0");
INSERT INTO test_scores VALUES("1755","95","7","2");
INSERT INTO test_scores VALUES("1756","95","54","2");
INSERT INTO test_scores VALUES("1757","95","12","4");
INSERT INTO test_scores VALUES("1758","95","6","6");
INSERT INTO test_scores VALUES("1759","95","66","0");
INSERT INTO test_scores VALUES("1760","95","40","4");
INSERT INTO test_scores VALUES("1761","95","31","0");
INSERT INTO test_scores VALUES("1762","95","102","6");
INSERT INTO test_scores VALUES("1763","95","2","4");
INSERT INTO test_scores VALUES("1764","95","73","2");
INSERT INTO test_scores VALUES("1765","95","35","0");
INSERT INTO test_scores VALUES("1766","95","69","2");
INSERT INTO test_scores VALUES("1767","95","22","6");
INSERT INTO test_scores VALUES("1768","95","39","2");
INSERT INTO test_scores VALUES("1769","95","9","4");
INSERT INTO test_scores VALUES("1770","95","187","2");
INSERT INTO test_scores VALUES("1771","95","77","0");
INSERT INTO test_scores VALUES("1772","95","55","2");
INSERT INTO test_scores VALUES("1773","95","4","2");
INSERT INTO test_scores VALUES("1774","95","33","6");
INSERT INTO test_scores VALUES("1775","95","67","0");
INSERT INTO test_scores VALUES("1776","95","76","2");
INSERT INTO test_scores VALUES("1777","95","36","2");
INSERT INTO test_scores VALUES("1778","95","28","2");
INSERT INTO test_scores VALUES("1779","95","37","6");
INSERT INTO test_scores VALUES("1780","95","165","6");
INSERT INTO test_scores VALUES("1781","95","85","2");
INSERT INTO test_scores VALUES("1782","97","85","2");
INSERT INTO test_scores VALUES("1783","90","67","4");
INSERT INTO test_scores VALUES("1784","91","67","2");
INSERT INTO test_scores VALUES("1785","93","67","2");
INSERT INTO test_scores VALUES("1786","96","26","2");
INSERT INTO test_scores VALUES("1787","96","30","2");
INSERT INTO test_scores VALUES("1788","96","1","6");
INSERT INTO test_scores VALUES("1789","96","85","2");
INSERT INTO test_scores VALUES("1790","96","74","4");
INSERT INTO test_scores VALUES("1791","96","69","2");
INSERT INTO test_scores VALUES("1792","96","4","6");
INSERT INTO test_scores VALUES("1793","96","73","4");
INSERT INTO test_scores VALUES("1794","96","22","6");
INSERT INTO test_scores VALUES("1795","96","28","4");
INSERT INTO test_scores VALUES("1796","96","35","2");
INSERT INTO test_scores VALUES("1797","96","102","2");
INSERT INTO test_scores VALUES("1798","96","31","2");
INSERT INTO test_scores VALUES("1799","96","40","4");
INSERT INTO test_scores VALUES("1800","96","37","6");
INSERT INTO test_scores VALUES("1801","96","66","2");
INSERT INTO test_scores VALUES("1802","96","76","0");
INSERT INTO test_scores VALUES("1803","96","36","2");
INSERT INTO test_scores VALUES("1804","96","3","4");
INSERT INTO test_scores VALUES("1805","96","2","6");
INSERT INTO test_scores VALUES("1806","96","12","6");
INSERT INTO test_scores VALUES("1807","96","6","6");
INSERT INTO test_scores VALUES("1808","96","23","6");
INSERT INTO test_scores VALUES("1809","96","32","4");
INSERT INTO test_scores VALUES("1810","96","34","2");
INSERT INTO test_scores VALUES("2586","138","120","4");
INSERT INTO test_scores VALUES("1812","98","12","2");
INSERT INTO test_scores VALUES("1813","98","23","6");
INSERT INTO test_scores VALUES("1814","98","34","6");
INSERT INTO test_scores VALUES("1815","98","37","4");
INSERT INTO test_scores VALUES("1816","98","40","2");
INSERT INTO test_scores VALUES("1817","99","34","2");
INSERT INTO test_scores VALUES("1818","99","37","4");
INSERT INTO test_scores VALUES("1819","99","40","4");
INSERT INTO test_scores VALUES("1820","99","36","4");
INSERT INTO test_scores VALUES("1821","99","22","4");
INSERT INTO test_scores VALUES("1822","100","12","4");
INSERT INTO test_scores VALUES("1823","100","23","4");
INSERT INTO test_scores VALUES("1824","100","21","6");
INSERT INTO test_scores VALUES("1825","100","6","2");
INSERT INTO test_scores VALUES("1826","100","2","6");
INSERT INTO test_scores VALUES("1827","101","6","6");
INSERT INTO test_scores VALUES("1828","101","2","6");
INSERT INTO test_scores VALUES("1829","101","40","6");
INSERT INTO test_scores VALUES("1830","101","36","4");
INSERT INTO test_scores VALUES("1831","101","22","6");
INSERT INTO test_scores VALUES("1832","102","23","6");
INSERT INTO test_scores VALUES("1833","102","21","6");
INSERT INTO test_scores VALUES("1834","102","6","6");
INSERT INTO test_scores VALUES("1835","102","37","4");
INSERT INTO test_scores VALUES("1836","102","22","6");
INSERT INTO test_scores VALUES("1837","103","12","4");
INSERT INTO test_scores VALUES("1838","103","34","6");
INSERT INTO test_scores VALUES("1839","103","21","6");
INSERT INTO test_scores VALUES("1840","103","2","6");
INSERT INTO test_scores VALUES("1841","103","36","6");
INSERT INTO test_scores VALUES("1842","83","32","6");
INSERT INTO test_scores VALUES("1843","83","19","6");
INSERT INTO test_scores VALUES("1844","83","11","6");
INSERT INTO test_scores VALUES("1845","83","23","6");
INSERT INTO test_scores VALUES("1846","83","21","6");
INSERT INTO test_scores VALUES("1847","84","32","6");
INSERT INTO test_scores VALUES("1848","84","20","6");
INSERT INTO test_scores VALUES("1849","84","23","6");
INSERT INTO test_scores VALUES("1850","84","2","6");
INSERT INTO test_scores VALUES("1851","84","37","6");
INSERT INTO test_scores VALUES("1852","85","32","6");
INSERT INTO test_scores VALUES("1853","85","19","6");
INSERT INTO test_scores VALUES("1854","85","23","6");
INSERT INTO test_scores VALUES("1855","85","21","6");
INSERT INTO test_scores VALUES("1856","85","2","6");
INSERT INTO test_scores VALUES("1857","86","19","6");
INSERT INTO test_scores VALUES("1858","86","11","6");
INSERT INTO test_scores VALUES("1859","86","34","6");
INSERT INTO test_scores VALUES("1860","86","21","6");
INSERT INTO test_scores VALUES("1861","86","6","6");
INSERT INTO test_scores VALUES("1862","87","20","6");
INSERT INTO test_scores VALUES("1863","87","34","6");
INSERT INTO test_scores VALUES("1864","87","6","4");
INSERT INTO test_scores VALUES("1865","87","2","6");
INSERT INTO test_scores VALUES("1866","87","37","6");
INSERT INTO test_scores VALUES("1867","88","20","6");
INSERT INTO test_scores VALUES("1868","88","11","4");
INSERT INTO test_scores VALUES("1869","88","34","6");
INSERT INTO test_scores VALUES("1870","88","6","6");
INSERT INTO test_scores VALUES("1871","88","37","6");
INSERT INTO test_scores VALUES("1872","105","107","0");
INSERT INTO test_scores VALUES("1873","105","2","6");
INSERT INTO test_scores VALUES("1874","105","30","0");
INSERT INTO test_scores VALUES("1875","105","66","4");
INSERT INTO test_scores VALUES("1876","105","35","0");
INSERT INTO test_scores VALUES("1877","105","67","3");
INSERT INTO test_scores VALUES("1878","105","109","3");
INSERT INTO test_scores VALUES("1879","105","73","0");
INSERT INTO test_scores VALUES("1880","105","37","6");
INSERT INTO test_scores VALUES("1881","105","31","0");
INSERT INTO test_scores VALUES("1882","105","28","1");
INSERT INTO test_scores VALUES("1883","105","165","3");
INSERT INTO test_scores VALUES("1884","105","32","6");
INSERT INTO test_scores VALUES("1885","105","12","6");
INSERT INTO test_scores VALUES("1886","105","26","1");
INSERT INTO test_scores VALUES("1887","105","40","4");
INSERT INTO test_scores VALUES("1888","105","85","2");
INSERT INTO test_scores VALUES("1889","105","102","2");
INSERT INTO test_scores VALUES("1890","105","39","3");
INSERT INTO test_scores VALUES("1891","105","33","3");
INSERT INTO test_scores VALUES("1892","105","114","0");
INSERT INTO test_scores VALUES("1893","105","76","1");
INSERT INTO test_scores VALUES("1894","105","7","0");
INSERT INTO test_scores VALUES("1895","105","1","6");
INSERT INTO test_scores VALUES("1896","105","36","3");
INSERT INTO test_scores VALUES("1897","105","111","1");
INSERT INTO test_scores VALUES("1898","105","42","1");
INSERT INTO test_scores VALUES("1899","106","2","4");
INSERT INTO test_scores VALUES("1900","106","109","1");
INSERT INTO test_scores VALUES("1901","106","67","0");
INSERT INTO test_scores VALUES("1902","106","35","1");
INSERT INTO test_scores VALUES("1903","106","66","6");
INSERT INTO test_scores VALUES("1904","106","30","0");
INSERT INTO test_scores VALUES("1905","106","73","3");
INSERT INTO test_scores VALUES("1906","106","28","0");
INSERT INTO test_scores VALUES("1907","106","37","6");
INSERT INTO test_scores VALUES("1908","106","31","0");
INSERT INTO test_scores VALUES("1909","106","165","0");
INSERT INTO test_scores VALUES("1910","106","26","0");
INSERT INTO test_scores VALUES("1911","106","85","0");
INSERT INTO test_scores VALUES("1912","106","40","0");
INSERT INTO test_scores VALUES("1913","106","102","0");
INSERT INTO test_scores VALUES("1914","106","42","0");
INSERT INTO test_scores VALUES("1915","106","107","1");
INSERT INTO test_scores VALUES("1916","106","111","0");
INSERT INTO test_scores VALUES("1917","106","7","0");
INSERT INTO test_scores VALUES("1918","106","1","0");
INSERT INTO test_scores VALUES("1919","106","36","2");
INSERT INTO test_scores VALUES("1920","106","39","0");
INSERT INTO test_scores VALUES("1921","106","33","0");
INSERT INTO test_scores VALUES("1922","106","114","2");
INSERT INTO test_scores VALUES("1923","106","76","0");
INSERT INTO test_scores VALUES("1924","106","23","6");
INSERT INTO test_scores VALUES("1925","106","32","4");
INSERT INTO test_scores VALUES("1926","106","12","6");
INSERT INTO test_scores VALUES("1927","107","32","6");
INSERT INTO test_scores VALUES("1928","107","23","5");
INSERT INTO test_scores VALUES("1929","107","12","2");
INSERT INTO test_scores VALUES("1930","107","2","6");
INSERT INTO test_scores VALUES("1931","107","42","3");
INSERT INTO test_scores VALUES("1932","107","107","3");
INSERT INTO test_scores VALUES("1933","107","111","3");
INSERT INTO test_scores VALUES("1934","107","7","5");
INSERT INTO test_scores VALUES("1935","107","36","5");
INSERT INTO test_scores VALUES("1936","107","1","5");
INSERT INTO test_scores VALUES("1937","107","39","5");
INSERT INTO test_scores VALUES("1938","107","33","5");
INSERT INTO test_scores VALUES("1939","107","114","0");
INSERT INTO test_scores VALUES("1940","107","76","5");
INSERT INTO test_scores VALUES("1941","107","26","5");
INSERT INTO test_scores VALUES("1942","107","40","2");
INSERT INTO test_scores VALUES("1943","107","85","5");
INSERT INTO test_scores VALUES("1944","107","102","5");
INSERT INTO test_scores VALUES("1945","107","28","2");
INSERT INTO test_scores VALUES("1946","107","37","5");
INSERT INTO test_scores VALUES("1947","107","31","5");
INSERT INTO test_scores VALUES("1948","107","165","2");
INSERT INTO test_scores VALUES("1949","107","109","3");
INSERT INTO test_scores VALUES("1950","107","67","1");
INSERT INTO test_scores VALUES("1951","107","66","5");
INSERT INTO test_scores VALUES("1952","107","30","5");
INSERT INTO test_scores VALUES("1953","107","35","0");
INSERT INTO test_scores VALUES("1954","107","73","5");
INSERT INTO test_scores VALUES("1955","108","7","0");
INSERT INTO test_scores VALUES("1956","108","2","6");
INSERT INTO test_scores VALUES("1957","108","67","3");
INSERT INTO test_scores VALUES("1958","108","109","0");
INSERT INTO test_scores VALUES("1959","108","30","0");
INSERT INTO test_scores VALUES("1960","108","66","2");
INSERT INTO test_scores VALUES("1961","108","35","0");
INSERT INTO test_scores VALUES("1962","108","73","0");
INSERT INTO test_scores VALUES("1963","108","28","0");
INSERT INTO test_scores VALUES("1964","108","37","1");
INSERT INTO test_scores VALUES("1965","108","31","0");
INSERT INTO test_scores VALUES("1966","108","165","2");
INSERT INTO test_scores VALUES("1967","108","26","0");
INSERT INTO test_scores VALUES("1968","108","40","2");
INSERT INTO test_scores VALUES("1969","108","85","0");
INSERT INTO test_scores VALUES("1970","108","102","0");
INSERT INTO test_scores VALUES("1971","108","36","2");
INSERT INTO test_scores VALUES("1972","108","1","0");
INSERT INTO test_scores VALUES("1973","108","39","0");
INSERT INTO test_scores VALUES("1974","108","114","0");
INSERT INTO test_scores VALUES("1975","108","76","0");
INSERT INTO test_scores VALUES("1976","108","111","0");
INSERT INTO test_scores VALUES("1977","108","107","0");
INSERT INTO test_scores VALUES("1978","108","57","0");
INSERT INTO test_scores VALUES("1979","108","42","0");
INSERT INTO test_scores VALUES("1980","108","23","3");
INSERT INTO test_scores VALUES("1981","108","32","4");
INSERT INTO test_scores VALUES("1982","108","12","3");
INSERT INTO test_scores VALUES("1983","105","23","3");
INSERT INTO test_scores VALUES("1984","109","22","2");
INSERT INTO test_scores VALUES("1985","109","73","2");
INSERT INTO test_scores VALUES("1986","109","35","4");
INSERT INTO test_scores VALUES("1987","109","165","4");
INSERT INTO test_scores VALUES("1988","109","67","2");
INSERT INTO test_scores VALUES("1989","109","37","6");
INSERT INTO test_scores VALUES("1990","109","3","4");
INSERT INTO test_scores VALUES("1991","109","26","2");
INSERT INTO test_scores VALUES("1992","109","76","0");
INSERT INTO test_scores VALUES("1993","109","39","2");
INSERT INTO test_scores VALUES("1994","109","54","0");
INSERT INTO test_scores VALUES("1995","109","40","6");
INSERT INTO test_scores VALUES("1996","109","1","4");
INSERT INTO test_scores VALUES("1997","109","32","6");
INSERT INTO test_scores VALUES("1998","109","102","2");
INSERT INTO test_scores VALUES("1999","109","31","2");
INSERT INTO test_scores VALUES("2000","109","74","4");
INSERT INTO test_scores VALUES("2001","109","23","4");
INSERT INTO test_scores VALUES("2002","110","32","6");
INSERT INTO test_scores VALUES("2003","110","23","6");
INSERT INTO test_scores VALUES("2004","110","73","4");
INSERT INTO test_scores VALUES("2005","110","30","0");
INSERT INTO test_scores VALUES("2006","110","35","2");
INSERT INTO test_scores VALUES("2007","110","22","2");
INSERT INTO test_scores VALUES("2008","110","26","0");
INSERT INTO test_scores VALUES("2009","110","37","4");
INSERT INTO test_scores VALUES("2010","110","165","2");
INSERT INTO test_scores VALUES("2011","110","74","4");
INSERT INTO test_scores VALUES("2012","110","31","2");
INSERT INTO test_scores VALUES("2013","110","102","2");
INSERT INTO test_scores VALUES("2014","110","3","4");
INSERT INTO test_scores VALUES("2015","110","39","2");
INSERT INTO test_scores VALUES("2016","110","76","6");
INSERT INTO test_scores VALUES("2017","110","40","2");
INSERT INTO test_scores VALUES("2018","110","1","6");
INSERT INTO test_scores VALUES("2019","110","54","2");
INSERT INTO test_scores VALUES("2020","110","67","6");
INSERT INTO test_scores VALUES("2021","111","32","6");
INSERT INTO test_scores VALUES("2022","111","12","6");
INSERT INTO test_scores VALUES("2023","111","34","4");
INSERT INTO test_scores VALUES("2024","111","23","6");
INSERT INTO test_scores VALUES("2025","111","6","6");
INSERT INTO test_scores VALUES("2026","111","5","6");
INSERT INTO test_scores VALUES("2027","111","74","4");
INSERT INTO test_scores VALUES("2028","111","1","4");
INSERT INTO test_scores VALUES("2029","111","3","4");
INSERT INTO test_scores VALUES("2030","111","40","4");
INSERT INTO test_scores VALUES("2031","111","30","4");
INSERT INTO test_scores VALUES("2032","111","76","4");
INSERT INTO test_scores VALUES("2033","111","26","6");
INSERT INTO test_scores VALUES("2034","111","102","2");
INSERT INTO test_scores VALUES("2035","111","37","6");
INSERT INTO test_scores VALUES("2036","111","28","4");
INSERT INTO test_scores VALUES("2037","111","31","6");
INSERT INTO test_scores VALUES("2038","111","165","6");
INSERT INTO test_scores VALUES("2039","111","35","6");
INSERT INTO test_scores VALUES("2040","111","4","6");
INSERT INTO test_scores VALUES("2041","111","187","0");
INSERT INTO test_scores VALUES("2042","112","32","6");
INSERT INTO test_scores VALUES("2043","111","9","6");
INSERT INTO test_scores VALUES("2044","112","2","6");
INSERT INTO test_scores VALUES("2045","111","22","6");
INSERT INTO test_scores VALUES("2046","112","1","0");
INSERT INTO test_scores VALUES("2047","111","73","6");
INSERT INTO test_scores VALUES("2048","112","30","0");
INSERT INTO test_scores VALUES("2049","112","26","2");
INSERT INTO test_scores VALUES("2050","112","102","0");
INSERT INTO test_scores VALUES("2051","112","12","4");
INSERT INTO test_scores VALUES("2052","112","34","6");
INSERT INTO test_scores VALUES("2053","112","6","6");
INSERT INTO test_scores VALUES("2054","112","36","2");
INSERT INTO test_scores VALUES("2055","112","5","2");
INSERT INTO test_scores VALUES("2056","112","74","4");
INSERT INTO test_scores VALUES("2057","112","23","4");
INSERT INTO test_scores VALUES("2058","112","4","0");
INSERT INTO test_scores VALUES("2059","112","187","0");
INSERT INTO test_scores VALUES("2060","112","9","2");
INSERT INTO test_scores VALUES("2061","112","35","0");
INSERT INTO test_scores VALUES("2062","112","22","2");
INSERT INTO test_scores VALUES("2063","112","37","4");
INSERT INTO test_scores VALUES("2064","112","31","2");
INSERT INTO test_scores VALUES("2065","112","165","0");
INSERT INTO test_scores VALUES("2066","112","3","2");
INSERT INTO test_scores VALUES("2067","112","40","0");
INSERT INTO test_scores VALUES("2068","112","76","0");
INSERT INTO test_scores VALUES("2069","112","28","0");
INSERT INTO test_scores VALUES("2070","112","73","4");
INSERT INTO test_scores VALUES("2071","111","2","6");
INSERT INTO test_scores VALUES("2072","113","35","2");
INSERT INTO test_scores VALUES("2073","113","4","2");
INSERT INTO test_scores VALUES("2074","113","187","2");
INSERT INTO test_scores VALUES("2075","113","9","4");
INSERT INTO test_scores VALUES("2076","113","31","2");
INSERT INTO test_scores VALUES("2077","113","28","6");
INSERT INTO test_scores VALUES("2078","113","37","6");
INSERT INTO test_scores VALUES("2079","113","165","4");
INSERT INTO test_scores VALUES("2080","113","102","0");
INSERT INTO test_scores VALUES("2081","113","30","4");
INSERT INTO test_scores VALUES("2082","113","26","6");
INSERT INTO test_scores VALUES("2083","113","3","4");
INSERT INTO test_scores VALUES("2084","113","1","6");
INSERT INTO test_scores VALUES("2085","113","40","6");
INSERT INTO test_scores VALUES("2086","113","76","4");
INSERT INTO test_scores VALUES("2087","113","6","6");
INSERT INTO test_scores VALUES("2088","113","5","2");
INSERT INTO test_scores VALUES("2089","113","36","6");
INSERT INTO test_scores VALUES("2090","113","74","4");
INSERT INTO test_scores VALUES("2091","113","2","6");
INSERT INTO test_scores VALUES("2092","113","73","2");
INSERT INTO test_scores VALUES("2093","113","67","6");
INSERT INTO test_scores VALUES("2094","113","34","6");
INSERT INTO test_scores VALUES("2095","113","32","4");
INSERT INTO test_scores VALUES("2096","113","23","6");
INSERT INTO test_scores VALUES("2097","113","12","6");
INSERT INTO test_scores VALUES("2098","113","22","6");
INSERT INTO test_scores VALUES("2099","114","23","6");
INSERT INTO test_scores VALUES("2100","114","67","2");
INSERT INTO test_scores VALUES("2101","114","35","2");
INSERT INTO test_scores VALUES("2102","114","2","6");
INSERT INTO test_scores VALUES("2103","114","9","2");
INSERT INTO test_scores VALUES("2104","114","22","0");
INSERT INTO test_scores VALUES("2105","114","73","2");
INSERT INTO test_scores VALUES("2106","114","28","2");
INSERT INTO test_scores VALUES("2107","114","37","4");
INSERT INTO test_scores VALUES("2108","114","31","2");
INSERT INTO test_scores VALUES("2109","114","165","2");
INSERT INTO test_scores VALUES("2110","114","30","2");
INSERT INTO test_scores VALUES("2111","114","26","2");
INSERT INTO test_scores VALUES("2112","114","102","4");
INSERT INTO test_scores VALUES("2113","114","1","4");
INSERT INTO test_scores VALUES("2114","114","40","2");
INSERT INTO test_scores VALUES("2115","114","76","2");
INSERT INTO test_scores VALUES("2116","114","6","2");
INSERT INTO test_scores VALUES("2117","114","36","2");
INSERT INTO test_scores VALUES("2118","114","74","2");
INSERT INTO test_scores VALUES("2119","114","5","0");
INSERT INTO test_scores VALUES("2120","114","34","2");
INSERT INTO test_scores VALUES("2121","114","32","2");
INSERT INTO test_scores VALUES("2122","114","12","2");
INSERT INTO test_scores VALUES("2123","114","3","4");
INSERT INTO test_scores VALUES("2124","114","4","4");
INSERT INTO test_scores VALUES("2125","109","34","6");
INSERT INTO test_scores VALUES("2126","109","36","4");
INSERT INTO test_scores VALUES("2127","110","34","4");
INSERT INTO test_scores VALUES("2128","110","36","4");
INSERT INTO test_scores VALUES("2129","111","36","6");
INSERT INTO test_scores VALUES("2130","116","67","2");
INSERT INTO test_scores VALUES("2131","116","3","2");
INSERT INTO test_scores VALUES("2132","116","66","6");
INSERT INTO test_scores VALUES("2133","116","32","6");
INSERT INTO test_scores VALUES("2134","116","12","6");
INSERT INTO test_scores VALUES("2135","116","6","2");
INSERT INTO test_scores VALUES("2136","116","109","0");
INSERT INTO test_scores VALUES("2137","116","73","4");
INSERT INTO test_scores VALUES("2138","116","22","4");
INSERT INTO test_scores VALUES("2139","116","28","0");
INSERT INTO test_scores VALUES("2140","116","37","6");
INSERT INTO test_scores VALUES("2141","116","2","6");
INSERT INTO test_scores VALUES("2142","116","26","6");
INSERT INTO test_scores VALUES("2143","116","31","2");
INSERT INTO test_scores VALUES("2144","116","102","0");
INSERT INTO test_scores VALUES("2145","116","40","6");
INSERT INTO test_scores VALUES("2146","116","165","2");
INSERT INTO test_scores VALUES("2147","116","76","2");
INSERT INTO test_scores VALUES("2148","116","42","2");
INSERT INTO test_scores VALUES("2149","116","57","0");
INSERT INTO test_scores VALUES("2150","116","36","4");
INSERT INTO test_scores VALUES("2151","117","2","4");
INSERT INTO test_scores VALUES("2152","117","57","1");
INSERT INTO test_scores VALUES("2153","117","67","6");
INSERT INTO test_scores VALUES("2154","117","3","6");
INSERT INTO test_scores VALUES("2155","117","66","3");
INSERT INTO test_scores VALUES("2156","117","23","6");
INSERT INTO test_scores VALUES("2157","117","36","6");
INSERT INTO test_scores VALUES("2158","117","26","4");
INSERT INTO test_scores VALUES("2159","117","31","6");
INSERT INTO test_scores VALUES("2160","117","102","6");
INSERT INTO test_scores VALUES("2161","117","40","6");
INSERT INTO test_scores VALUES("2162","117","165","6");
INSERT INTO test_scores VALUES("2163","117","76","6");
INSERT INTO test_scores VALUES("2164","117","28","1");
INSERT INTO test_scores VALUES("2165","117","37","6");
INSERT INTO test_scores VALUES("2166","117","6","6");
INSERT INTO test_scores VALUES("2167","117","22","6");
INSERT INTO test_scores VALUES("2168","117","73","3");
INSERT INTO test_scores VALUES("2169","117","109","6");
INSERT INTO test_scores VALUES("2170","117","42","2");
INSERT INTO test_scores VALUES("2171","117","12","6");
INSERT INTO test_scores VALUES("2172","117","32","6");
INSERT INTO test_scores VALUES("2173","116","23","6");
INSERT INTO test_scores VALUES("2174","118","23","2");
INSERT INTO test_scores VALUES("2175","118","12","5");
INSERT INTO test_scores VALUES("2176","118","34","6");
INSERT INTO test_scores VALUES("2177","118","42","0");
INSERT INTO test_scores VALUES("2178","118","36","4");
INSERT INTO test_scores VALUES("2179","118","40","0");
INSERT INTO test_scores VALUES("2180","118","67","3");
INSERT INTO test_scores VALUES("2181","118","76","0");
INSERT INTO test_scores VALUES("2182","118","33","3");
INSERT INTO test_scores VALUES("2183","118","31","0");
INSERT INTO test_scores VALUES("2184","118","26","0");
INSERT INTO test_scores VALUES("2185","118","37","5");
INSERT INTO test_scores VALUES("2186","118","165","4");
INSERT INTO test_scores VALUES("2187","118","2","6");
INSERT INTO test_scores VALUES("2188","118","22","2");
INSERT INTO test_scores VALUES("2189","118","30","0");
INSERT INTO test_scores VALUES("2190","118","3","6");
INSERT INTO test_scores VALUES("2191","118","73","0");
INSERT INTO test_scores VALUES("2192","119","36","2");
INSERT INTO test_scores VALUES("2193","119","40","4");
INSERT INTO test_scores VALUES("2194","119","67","1");
INSERT INTO test_scores VALUES("2195","119","76","3");
INSERT INTO test_scores VALUES("2196","119","26","1");
INSERT INTO test_scores VALUES("2197","119","31","0");
INSERT INTO test_scores VALUES("2198","119","37","6");
INSERT INTO test_scores VALUES("2199","119","165","4");
INSERT INTO test_scores VALUES("2200","119","2","6");
INSERT INTO test_scores VALUES("2201","119","73","1");
INSERT INTO test_scores VALUES("2202","119","22","4");
INSERT INTO test_scores VALUES("2203","119","30","3");
INSERT INTO test_scores VALUES("2204","119","3","3");
INSERT INTO test_scores VALUES("2205","119","34","4");
INSERT INTO test_scores VALUES("2206","119","12","6");
INSERT INTO test_scores VALUES("2207","119","23","6");
INSERT INTO test_scores VALUES("2208","119","42","0");
INSERT INTO test_scores VALUES("2209","116","34","6");
INSERT INTO test_scores VALUES("2210","117","34","6");
INSERT INTO test_scores VALUES("2211","121","1","3");
INSERT INTO test_scores VALUES("2212","121","31","2");
INSERT INTO test_scores VALUES("2213","121","3","4");
INSERT INTO test_scores VALUES("2214","121","109","2");
INSERT INTO test_scores VALUES("2215","121","67","4");
INSERT INTO test_scores VALUES("2216","121","73","2");
INSERT INTO test_scores VALUES("2217","121","76","2");
INSERT INTO test_scores VALUES("2218","121","33","1");
INSERT INTO test_scores VALUES("2219","121","22","4");
INSERT INTO test_scores VALUES("2220","121","34","4");
INSERT INTO test_scores VALUES("2221","121","36","3");
INSERT INTO test_scores VALUES("2222","121","40","2");
INSERT INTO test_scores VALUES("2223","121","2","4");
INSERT INTO test_scores VALUES("2224","121","23","4");
INSERT INTO test_scores VALUES("2225","121","37","6");
INSERT INTO test_scores VALUES("2226","119","6","3");
INSERT INTO test_scores VALUES("2227","118","6","3");
INSERT INTO test_scores VALUES("2228","121","6","4");
INSERT INTO test_scores VALUES("2229","121","12","3");
INSERT INTO test_scores VALUES("2230","122","30","3");
INSERT INTO test_scores VALUES("2231","122","28","3");
INSERT INTO test_scores VALUES("2232","122","37","6");
INSERT INTO test_scores VALUES("2233","122","31","6");
INSERT INTO test_scores VALUES("2234","122","3","6");
INSERT INTO test_scores VALUES("2235","122","22","3");
INSERT INTO test_scores VALUES("2236","122","40","6");
INSERT INTO test_scores VALUES("2237","122","26","6");
INSERT INTO test_scores VALUES("2238","122","67","3");
INSERT INTO test_scores VALUES("2239","122","66","6");
INSERT INTO test_scores VALUES("2240","122","165","6");
INSERT INTO test_scores VALUES("2241","122","36","6");
INSERT INTO test_scores VALUES("2242","122","33","6");
INSERT INTO test_scores VALUES("2243","122","12","6");
INSERT INTO test_scores VALUES("2244","123","28","6");
INSERT INTO test_scores VALUES("2245","123","37","6");
INSERT INTO test_scores VALUES("2246","123","31","6");
INSERT INTO test_scores VALUES("2247","123","3","6");
INSERT INTO test_scores VALUES("2248","123","30","3");
INSERT INTO test_scores VALUES("2249","123","22","6");
INSERT INTO test_scores VALUES("2250","123","33","6");
INSERT INTO test_scores VALUES("2251","123","26","5");
INSERT INTO test_scores VALUES("2252","123","67","6");
INSERT INTO test_scores VALUES("2253","123","165","6");
INSERT INTO test_scores VALUES("2254","123","66","6");
INSERT INTO test_scores VALUES("2255","123","36","5");
INSERT INTO test_scores VALUES("2256","123","40","6");
INSERT INTO test_scores VALUES("2257","123","12","6");
INSERT INTO test_scores VALUES("2258","122","23","6");
INSERT INTO test_scores VALUES("2259","123","23","6");
INSERT INTO test_scores VALUES("2260","130","121","4");
INSERT INTO test_scores VALUES("2261","130","147","6");
INSERT INTO test_scores VALUES("2262","130","149","6");
INSERT INTO test_scores VALUES("2263","130","135","0");
INSERT INTO test_scores VALUES("2264","130","142","4");
INSERT INTO test_scores VALUES("2265","130","127","4");
INSERT INTO test_scores VALUES("2266","130","73","6");
INSERT INTO test_scores VALUES("2267","130","117","6");
INSERT INTO test_scores VALUES("2268","130","22","4");
INSERT INTO test_scores VALUES("2269","130","31","4");
INSERT INTO test_scores VALUES("2270","130","148","4");
INSERT INTO test_scores VALUES("2271","130","37","6");
INSERT INTO test_scores VALUES("2272","130","138","2");
INSERT INTO test_scores VALUES("2273","130","66","6");
INSERT INTO test_scores VALUES("2274","130","120","6");
INSERT INTO test_scores VALUES("2275","130","124","4");
INSERT INTO test_scores VALUES("2276","130","67","6");
INSERT INTO test_scores VALUES("2277","130","6","6");
INSERT INTO test_scores VALUES("2278","130","12","6");
INSERT INTO test_scores VALUES("2279","130","144","6");
INSERT INTO test_scores VALUES("2280","130","76","2");
INSERT INTO test_scores VALUES("2281","130","145","6");
INSERT INTO test_scores VALUES("2282","130","165","6");
INSERT INTO test_scores VALUES("2283","130","146","2");
INSERT INTO test_scores VALUES("2290","131","117","6");
INSERT INTO test_scores VALUES("2291","131","73","4");
INSERT INTO test_scores VALUES("2292","131","22","6");
INSERT INTO test_scores VALUES("2293","131","31","2");
INSERT INTO test_scores VALUES("2294","131","148","0");
INSERT INTO test_scores VALUES("2295","131","37","6");
INSERT INTO test_scores VALUES("2296","131","138","4");
INSERT INTO test_scores VALUES("2297","131","66","2");
INSERT INTO test_scores VALUES("2298","131","120","4");
INSERT INTO test_scores VALUES("2299","131","124","4");
INSERT INTO test_scores VALUES("2300","131","67","6");
INSERT INTO test_scores VALUES("2301","131","149","0");
INSERT INTO test_scores VALUES("2302","131","76","2");
INSERT INTO test_scores VALUES("2303","131","145","4");
INSERT INTO test_scores VALUES("2304","131","165","6");
INSERT INTO test_scores VALUES("2305","131","121","2");
INSERT INTO test_scores VALUES("2306","131","146","0");
INSERT INTO test_scores VALUES("2307","131","144","6");
INSERT INTO test_scores VALUES("2308","131","125","4");
INSERT INTO test_scores VALUES("2309","130","125","4");
INSERT INTO test_scores VALUES("2310","131","40","6");
INSERT INTO test_scores VALUES("2311","130","40","6");
INSERT INTO test_scores VALUES("2312","131","3","6");
INSERT INTO test_scores VALUES("2313","130","3","4");
INSERT INTO test_scores VALUES("2314","129","40","12");
INSERT INTO test_scores VALUES("2315","129","33","12");
INSERT INTO test_scores VALUES("2316","129","6","11");
INSERT INTO test_scores VALUES("2317","129","37","11");
INSERT INTO test_scores VALUES("2318","129","12","10");
INSERT INTO test_scores VALUES("2319","129","125","10");
INSERT INTO test_scores VALUES("2320","129","67","10");
INSERT INTO test_scores VALUES("2321","129","124","10");
INSERT INTO test_scores VALUES("2322","129","143","10");
INSERT INTO test_scores VALUES("2323","129","165","10");
INSERT INTO test_scores VALUES("2324","129","36","9");
INSERT INTO test_scores VALUES("2325","129","150","9");
INSERT INTO test_scores VALUES("2326","129","76","9");
INSERT INTO test_scores VALUES("2327","129","130","9");
INSERT INTO test_scores VALUES("2328","129","117","9");
INSERT INTO test_scores VALUES("2329","129","118","9");
INSERT INTO test_scores VALUES("2330","129","55","9");
INSERT INTO test_scores VALUES("2331","129","144","9");
INSERT INTO test_scores VALUES("2332","129","126","8");
INSERT INTO test_scores VALUES("2333","129","28","8");
INSERT INTO test_scores VALUES("2334","129","22","8");
INSERT INTO test_scores VALUES("2335","129","121","8");
INSERT INTO test_scores VALUES("2336","129","73","8");
INSERT INTO test_scores VALUES("2337","129","173","7");
INSERT INTO test_scores VALUES("2338","129","66","7");
INSERT INTO test_scores VALUES("2339","129","127","8");
INSERT INTO test_scores VALUES("2340","129","123","7");
INSERT INTO test_scores VALUES("2341","129","120","7");
INSERT INTO test_scores VALUES("2342","129","149","6");
INSERT INTO test_scores VALUES("2343","129","131","6");
INSERT INTO test_scores VALUES("2344","129","135","6");
INSERT INTO test_scores VALUES("2345","129","27","5");
INSERT INTO test_scores VALUES("2346","129","152","5");
INSERT INTO test_scores VALUES("2347","129","122","5");
INSERT INTO test_scores VALUES("2348","129","148","5");
INSERT INTO test_scores VALUES("2349","129","146","4");
INSERT INTO test_scores VALUES("2350","129","132","4");
INSERT INTO test_scores VALUES("2351","129","153","4");
INSERT INTO test_scores VALUES("2352","129","109","3");
INSERT INTO test_scores VALUES("2353","129","154","3");
INSERT INTO test_scores VALUES("2354","129","128","2");
INSERT INTO test_scores VALUES("2355","130","159","6");
INSERT INTO test_scores VALUES("2356","131","159","2");
INSERT INTO test_scores VALUES("2357","131","36","2");
INSERT INTO test_scores VALUES("2358","130","36","6");
INSERT INTO test_scores VALUES("2359","133","145","6");
INSERT INTO test_scores VALUES("2360","133","73","3");
INSERT INTO test_scores VALUES("2361","133","109","3");
INSERT INTO test_scores VALUES("2362","133","122","1");
INSERT INTO test_scores VALUES("2363","133","148","0");
INSERT INTO test_scores VALUES("2364","133","22","4");
INSERT INTO test_scores VALUES("2365","133","117","6");
INSERT INTO test_scores VALUES("2366","133","147","4");
INSERT INTO test_scores VALUES("2367","133","27","1");
INSERT INTO test_scores VALUES("2368","133","121","6");
INSERT INTO test_scores VALUES("2369","133","67","6");
INSERT INTO test_scores VALUES("2370","133","125","6");
INSERT INTO test_scores VALUES("2371","133","144","4");
INSERT INTO test_scores VALUES("2372","133","146","0");
INSERT INTO test_scores VALUES("2373","133","165","6");
INSERT INTO test_scores VALUES("2374","133","159","0");
INSERT INTO test_scores VALUES("2375","133","157","1");
INSERT INTO test_scores VALUES("2376","133","3","6");
INSERT INTO test_scores VALUES("2377","133","142","4");
INSERT INTO test_scores VALUES("2378","133","130","4");
INSERT INTO test_scores VALUES("2379","133","127","4");
INSERT INTO test_scores VALUES("2380","133","66","6");
INSERT INTO test_scores VALUES("2381","133","40","4");
INSERT INTO test_scores VALUES("2382","133","132","4");
INSERT INTO test_scores VALUES("2383","133","124","6");
INSERT INTO test_scores VALUES("2384","133","143","6");
INSERT INTO test_scores VALUES("2385","133","118","4");
INSERT INTO test_scores VALUES("2386","133","123","1");
INSERT INTO test_scores VALUES("2387","133","36","4");
INSERT INTO test_scores VALUES("2388","133","6","6");
INSERT INTO test_scores VALUES("2389","133","12","6");
INSERT INTO test_scores VALUES("2390","133","76","6");
INSERT INTO test_scores VALUES("2391","133","31","3");
INSERT INTO test_scores VALUES("2392","133","120","1");
INSERT INTO test_scores VALUES("2393","134","128","6");
INSERT INTO test_scores VALUES("2394","134","31","3");
INSERT INTO test_scores VALUES("2395","134","157","1");
INSERT INTO test_scores VALUES("2396","134","76","3");
INSERT INTO test_scores VALUES("2397","134","120","6");
INSERT INTO test_scores VALUES("2398","134","12","6");
INSERT INTO test_scores VALUES("2399","134","6","6");
INSERT INTO test_scores VALUES("2400","134","109","1");
INSERT INTO test_scores VALUES("2401","134","148","3");
INSERT INTO test_scores VALUES("2402","134","135","4");
INSERT INTO test_scores VALUES("2403","134","122","3");
INSERT INTO test_scores VALUES("2404","134","73","1");
INSERT INTO test_scores VALUES("2405","134","145","1");
INSERT INTO test_scores VALUES("2406","134","121","5");
INSERT INTO test_scores VALUES("2407","134","22","6");
INSERT INTO test_scores VALUES("2408","134","117","1");
INSERT INTO test_scores VALUES("2409","134","147","1");
INSERT INTO test_scores VALUES("2410","134","27","1");
INSERT INTO test_scores VALUES("2411","134","67","4");
INSERT INTO test_scores VALUES("2412","134","37","5");
INSERT INTO test_scores VALUES("2413","134","125","6");
INSERT INTO test_scores VALUES("2414","134","144","6");
INSERT INTO test_scores VALUES("2415","134","146","0");
INSERT INTO test_scores VALUES("2416","134","3","3");
INSERT INTO test_scores VALUES("2417","134","165","3");
INSERT INTO test_scores VALUES("2418","134","159","4");
INSERT INTO test_scores VALUES("2419","134","142","3");
INSERT INTO test_scores VALUES("2420","134","130","3");
INSERT INTO test_scores VALUES("2421","134","127","1");
INSERT INTO test_scores VALUES("2422","134","66","3");
INSERT INTO test_scores VALUES("2423","134","124","6");
INSERT INTO test_scores VALUES("2424","134","143","6");
INSERT INTO test_scores VALUES("2425","134","36","6");
INSERT INTO test_scores VALUES("2426","134","123","1");
INSERT INTO test_scores VALUES("2427","134","40","4");
INSERT INTO test_scores VALUES("2428","134","132","1");
INSERT INTO test_scores VALUES("2429","134","118","6");
INSERT INTO test_scores VALUES("2430","132","73","0");
INSERT INTO test_scores VALUES("2431","132","148","0");
INSERT INTO test_scores VALUES("2432","132","135","0");
INSERT INTO test_scores VALUES("2433","132","122","3");
INSERT INTO test_scores VALUES("2434","132","109","0");
INSERT INTO test_scores VALUES("2435","132","145","0");
INSERT INTO test_scores VALUES("2436","132","37","6");
INSERT INTO test_scores VALUES("2437","132","125","1");
INSERT INTO test_scores VALUES("2438","132","144","1");
INSERT INTO test_scores VALUES("2439","132","67","1");
INSERT INTO test_scores VALUES("2440","132","146","0");
INSERT INTO test_scores VALUES("2441","132","3","6");
INSERT INTO test_scores VALUES("2442","132","159","1");
INSERT INTO test_scores VALUES("2443","132","165","6");
INSERT INTO test_scores VALUES("2444","132","142","0");
INSERT INTO test_scores VALUES("2445","132","130","1");
INSERT INTO test_scores VALUES("2446","132","127","2");
INSERT INTO test_scores VALUES("2447","132","66","6");
INSERT INTO test_scores VALUES("2448","132","123","0");
INSERT INTO test_scores VALUES("2449","132","118","2");
INSERT INTO test_scores VALUES("2450","132","36","3");
INSERT INTO test_scores VALUES("2451","132","143","4");
INSERT INTO test_scores VALUES("2452","132","124","0");
INSERT INTO test_scores VALUES("2453","132","40","4");
INSERT INTO test_scores VALUES("2454","132","132","1");
INSERT INTO test_scores VALUES("2455","132","121","1");
INSERT INTO test_scores VALUES("2456","132","27","2");
INSERT INTO test_scores VALUES("2457","132","147","1");
INSERT INTO test_scores VALUES("2458","132","117","1");
INSERT INTO test_scores VALUES("2459","132","22","4");
INSERT INTO test_scores VALUES("2460","132","76","1");
INSERT INTO test_scores VALUES("2461","132","6","6");
INSERT INTO test_scores VALUES("2462","132","12","0");
INSERT INTO test_scores VALUES("2463","132","31","1");
INSERT INTO test_scores VALUES("2464","132","157","2");
INSERT INTO test_scores VALUES("2465","132","120","0");
INSERT INTO test_scores VALUES("2466","132","128","0");
INSERT INTO test_scores VALUES("2467","135","128","1");
INSERT INTO test_scores VALUES("2468","135","157","3");
INSERT INTO test_scores VALUES("2469","135","31","1");
INSERT INTO test_scores VALUES("2470","135","120","3");
INSERT INTO test_scores VALUES("2471","135","6","6");
INSERT INTO test_scores VALUES("2472","135","12","4");
INSERT INTO test_scores VALUES("2473","135","67","2");
INSERT INTO test_scores VALUES("2474","135","37","6");
INSERT INTO test_scores VALUES("2475","135","125","3");
INSERT INTO test_scores VALUES("2476","135","144","6");
INSERT INTO test_scores VALUES("2477","135","146","0");
INSERT INTO test_scores VALUES("2478","135","159","1");
INSERT INTO test_scores VALUES("2479","135","3","6");
INSERT INTO test_scores VALUES("2480","135","142","1");
INSERT INTO test_scores VALUES("2481","135","127","1");
INSERT INTO test_scores VALUES("2482","135","66","3");
INSERT INTO test_scores VALUES("2483","135","130","3");
INSERT INTO test_scores VALUES("2484","135","40","1");
INSERT INTO test_scores VALUES("2485","135","124","6");
INSERT INTO test_scores VALUES("2486","135","132","0");
INSERT INTO test_scores VALUES("2487","135","123","3");
INSERT INTO test_scores VALUES("2488","135","36","6");
INSERT INTO test_scores VALUES("2489","135","118","3");
INSERT INTO test_scores VALUES("2490","135","143","2");
INSERT INTO test_scores VALUES("2491","135","27","0");
INSERT INTO test_scores VALUES("2492","135","147","6");
INSERT INTO test_scores VALUES("2493","135","22","6");
INSERT INTO test_scores VALUES("2494","135","121","4");
INSERT INTO test_scores VALUES("2495","135","73","1");
INSERT INTO test_scores VALUES("2496","135","109","1");
INSERT INTO test_scores VALUES("2497","135","122","3");
INSERT INTO test_scores VALUES("2498","135","148","0");
INSERT INTO test_scores VALUES("2499","135","135","3");
INSERT INTO test_scores VALUES("2500","135","145","0");
INSERT INTO test_scores VALUES("2501","135","76","1");
INSERT INTO test_scores VALUES("2502","133","37","4");
INSERT INTO test_scores VALUES("2503","136","166","12");
INSERT INTO test_scores VALUES("2504","136","146","10");
INSERT INTO test_scores VALUES("2505","136","142","7");
INSERT INTO test_scores VALUES("2506","136","127","16");
INSERT INTO test_scores VALUES("2507","136","123","15");
INSERT INTO test_scores VALUES("2508","136","122","10");
INSERT INTO test_scores VALUES("2509","136","124","10");
INSERT INTO test_scores VALUES("2510","136","72","18");
INSERT INTO test_scores VALUES("2511","136","67","15");
INSERT INTO test_scores VALUES("2512","136","118","10");
INSERT INTO test_scores VALUES("2513","136","130","10");
INSERT INTO test_scores VALUES("2514","136","159","0");
INSERT INTO test_scores VALUES("2515","136","148","20");
INSERT INTO test_scores VALUES("2516","136","135","9");
INSERT INTO test_scores VALUES("2517","136","33","29");
INSERT INTO test_scores VALUES("2518","136","144","21");
INSERT INTO test_scores VALUES("2519","136","125","14");
INSERT INTO test_scores VALUES("2520","136","117","7");
INSERT INTO test_scores VALUES("2521","136","22","20");
INSERT INTO test_scores VALUES("2522","136","73","12");
INSERT INTO test_scores VALUES("2523","136","145","17");
INSERT INTO test_scores VALUES("2524","136","147","9");
INSERT INTO test_scores VALUES("2525","136","55","11");
INSERT INTO test_scores VALUES("2526","136","109","0");
INSERT INTO test_scores VALUES("2527","136","143","16");
INSERT INTO test_scores VALUES("2528","136","157","0");
INSERT INTO test_scores VALUES("2529","136","120","14");
INSERT INTO test_scores VALUES("2530","136","37","25");
INSERT INTO test_scores VALUES("2531","136","121","13");
INSERT INTO test_scores VALUES("2532","136","6","27");
INSERT INTO test_scores VALUES("2533","136","12","24");
INSERT INTO test_scores VALUES("2534","136","27","4");
INSERT INTO test_scores VALUES("2535","136","31","3");
INSERT INTO test_scores VALUES("2536","136","36","21");
INSERT INTO test_scores VALUES("2537","136","149","3");
INSERT INTO test_scores VALUES("2538","136","161","12");
INSERT INTO test_scores VALUES("2539","136","128","3");
INSERT INTO test_scores VALUES("2540","136","163","16");
INSERT INTO test_scores VALUES("2541","136","165","19");
INSERT INTO test_scores VALUES("2542","136","3","25");
INSERT INTO test_scores VALUES("2543","137","72","4");
INSERT INTO test_scores VALUES("2544","137","123","6");
INSERT INTO test_scores VALUES("2545","137","159","0");
INSERT INTO test_scores VALUES("2546","137","127","6");
INSERT INTO test_scores VALUES("2547","137","146","0");
INSERT INTO test_scores VALUES("2548","137","122","2");
INSERT INTO test_scores VALUES("2549","137","143","6");
INSERT INTO test_scores VALUES("2550","137","142","0");
INSERT INTO test_scores VALUES("2551","137","135","2");
INSERT INTO test_scores VALUES("2552","137","145","4");
INSERT INTO test_scores VALUES("2553","137","125","6");
INSERT INTO test_scores VALUES("2554","137","120","4");
INSERT INTO test_scores VALUES("2555","137","117","6");
INSERT INTO test_scores VALUES("2556","137","121","6");
INSERT INTO test_scores VALUES("2557","137","31","4");
INSERT INTO test_scores VALUES("2558","137","76","4");
INSERT INTO test_scores VALUES("2559","137","3","6");
INSERT INTO test_scores VALUES("2560","137","37","6");
INSERT INTO test_scores VALUES("2561","137","67","6");
INSERT INTO test_scores VALUES("2562","137","166","2");
INSERT INTO test_scores VALUES("2563","137","148","2");
INSERT INTO test_scores VALUES("2564","137","161","4");
INSERT INTO test_scores VALUES("2565","137","149","2");
INSERT INTO test_scores VALUES("2566","137","6","6");
INSERT INTO test_scores VALUES("2567","137","12","4");
INSERT INTO test_scores VALUES("2568","137","66","6");
INSERT INTO test_scores VALUES("2569","137","128","0");
INSERT INTO test_scores VALUES("2570","137","40","6");
INSERT INTO test_scores VALUES("2571","137","124","6");
INSERT INTO test_scores VALUES("2572","137","147","6");
INSERT INTO test_scores VALUES("2573","137","144","6");
INSERT INTO test_scores VALUES("2574","137","109","2");
INSERT INTO test_scores VALUES("2575","137","73","6");
INSERT INTO test_scores VALUES("2576","137","118","6");
INSERT INTO test_scores VALUES("2577","137","130","4");
INSERT INTO test_scores VALUES("2652","140","67","4");
INSERT INTO test_scores VALUES("2653","140","127","2");
INSERT INTO test_scores VALUES("2591","138","118","2");
INSERT INTO test_scores VALUES("2592","138","130","2");
INSERT INTO test_scores VALUES("2593","138","73","6");
INSERT INTO test_scores VALUES("2594","138","37","6");
INSERT INTO test_scores VALUES("2595","138","67","6");
INSERT INTO test_scores VALUES("2596","138","135","0");
INSERT INTO test_scores VALUES("2597","138","148","0");
INSERT INTO test_scores VALUES("2598","138","166","0");
INSERT INTO test_scores VALUES("2599","138","159","2");
INSERT INTO test_scores VALUES("2600","138","123","2");
INSERT INTO test_scores VALUES("2601","138","127","4");
INSERT INTO test_scores VALUES("2602","138","72","6");
INSERT INTO test_scores VALUES("2603","138","146","0");
INSERT INTO test_scores VALUES("2604","138","122","0");
INSERT INTO test_scores VALUES("2605","138","143","4");
INSERT INTO test_scores VALUES("2606","138","142","2");
INSERT INTO test_scores VALUES("2607","138","3","4");
INSERT INTO test_scores VALUES("2608","137","165","6");
INSERT INTO test_scores VALUES("2609","138","124","6");
INSERT INTO test_scores VALUES("2610","138","40","4");
INSERT INTO test_scores VALUES("2611","138","128","0");
INSERT INTO test_scores VALUES("2612","138","161","2");
INSERT INTO test_scores VALUES("2613","138","149","0");
INSERT INTO test_scores VALUES("2614","138","66","6");
INSERT INTO test_scores VALUES("2615","138","6","6");
INSERT INTO test_scores VALUES("2616","138","12","4");
INSERT INTO test_scores VALUES("2617","139","142","4");
INSERT INTO test_scores VALUES("2618","139","143","6");
INSERT INTO test_scores VALUES("2619","139","122","6");
INSERT INTO test_scores VALUES("2620","139","146","0");
INSERT INTO test_scores VALUES("2621","139","127","6");
INSERT INTO test_scores VALUES("2622","139","159","2");
INSERT INTO test_scores VALUES("2623","139","123","6");
INSERT INTO test_scores VALUES("2624","139","166","4");
INSERT INTO test_scores VALUES("2625","139","135","2");
INSERT INTO test_scores VALUES("2626","139","148","4");
INSERT INTO test_scores VALUES("2627","139","67","6");
INSERT INTO test_scores VALUES("2628","139","3","6");
INSERT INTO test_scores VALUES("2629","139","76","2");
INSERT INTO test_scores VALUES("2630","139","31","6");
INSERT INTO test_scores VALUES("2631","139","37","6");
INSERT INTO test_scores VALUES("2632","139","121","2");
INSERT INTO test_scores VALUES("2633","139","120","6");
INSERT INTO test_scores VALUES("2634","139","117","4");
INSERT INTO test_scores VALUES("2635","139","125","6");
INSERT INTO test_scores VALUES("2636","139","145","4");
INSERT INTO test_scores VALUES("2637","139","109","4");
INSERT INTO test_scores VALUES("2638","139","165","6");
INSERT INTO test_scores VALUES("2639","139","147","6");
INSERT INTO test_scores VALUES("2640","139","144","6");
INSERT INTO test_scores VALUES("2641","139","73","6");
INSERT INTO test_scores VALUES("2642","139","130","6");
INSERT INTO test_scores VALUES("2643","139","118","4");
INSERT INTO test_scores VALUES("2644","139","12","4");
INSERT INTO test_scores VALUES("2645","139","149","2");
INSERT INTO test_scores VALUES("2646","139","124","6");
INSERT INTO test_scores VALUES("2647","139","40","6");
INSERT INTO test_scores VALUES("2648","139","66","6");
INSERT INTO test_scores VALUES("2649","139","128","4");
INSERT INTO test_scores VALUES("2650","139","6","6");
INSERT INTO test_scores VALUES("2651","139","72","4");
INSERT INTO test_scores VALUES("2654","140","123","0");
INSERT INTO test_scores VALUES("2655","140","159","0");
INSERT INTO test_scores VALUES("2656","140","72","0");
INSERT INTO test_scores VALUES("2657","140","143","2");
INSERT INTO test_scores VALUES("2658","140","122","2");
INSERT INTO test_scores VALUES("2659","140","146","0");
INSERT INTO test_scores VALUES("2660","140","142","0");
INSERT INTO test_scores VALUES("2661","140","166","0");
INSERT INTO test_scores VALUES("2662","140","135","0");
INSERT INTO test_scores VALUES("2663","140","148","0");
INSERT INTO test_scores VALUES("2664","140","37","4");
INSERT INTO test_scores VALUES("2665","140","3","4");
INSERT INTO test_scores VALUES("2666","140","76","0");
INSERT INTO test_scores VALUES("2667","140","31","2");
INSERT INTO test_scores VALUES("2668","140","121","2");
INSERT INTO test_scores VALUES("2669","140","117","0");
INSERT INTO test_scores VALUES("2670","140","120","0");
INSERT INTO test_scores VALUES("2671","140","125","4");
INSERT INTO test_scores VALUES("2672","140","145","0");
INSERT INTO test_scores VALUES("2673","140","128","0");
INSERT INTO test_scores VALUES("2674","140","12","4");
INSERT INTO test_scores VALUES("2675","140","149","0");
INSERT INTO test_scores VALUES("2676","140","124","2");
INSERT INTO test_scores VALUES("2677","140","40","2");
INSERT INTO test_scores VALUES("2678","140","66","2");
INSERT INTO test_scores VALUES("2679","140","6","4");
INSERT INTO test_scores VALUES("2680","140","73","4");
INSERT INTO test_scores VALUES("2681","140","109","0");
INSERT INTO test_scores VALUES("2682","140","147","4");
INSERT INTO test_scores VALUES("2683","140","144","0");
INSERT INTO test_scores VALUES("2684","140","118","0");
INSERT INTO test_scores VALUES("2685","140","130","0");
INSERT INTO test_scores VALUES("2686","140","165","4");
INSERT INTO test_scores VALUES("2687","141","128","0");
INSERT INTO test_scores VALUES("2688","141","124","3");
INSERT INTO test_scores VALUES("2689","141","148","3");
INSERT INTO test_scores VALUES("2690","141","142","3");
INSERT INTO test_scores VALUES("2691","141","119","1");
INSERT INTO test_scores VALUES("2692","141","159","3");
INSERT INTO test_scores VALUES("2693","141","123","6");
INSERT INTO test_scores VALUES("2694","141","122","2");
INSERT INTO test_scores VALUES("2695","141","143","6");
INSERT INTO test_scores VALUES("2696","141","178","3");
INSERT INTO test_scores VALUES("2697","141","127","1");
INSERT INTO test_scores VALUES("2698","141","12","6");
INSERT INTO test_scores VALUES("2699","141","146","0");
INSERT INTO test_scores VALUES("2700","141","27","3");
INSERT INTO test_scores VALUES("2701","141","161","2");
INSERT INTO test_scores VALUES("2702","141","149","0");
INSERT INTO test_scores VALUES("2703","141","171","3");
INSERT INTO test_scores VALUES("2704","141","165","6");
INSERT INTO test_scores VALUES("2705","141","22","6");
INSERT INTO test_scores VALUES("2706","141","144","6");
INSERT INTO test_scores VALUES("2707","141","147","2");
INSERT INTO test_scores VALUES("2708","141","109","2");
INSERT INTO test_scores VALUES("2709","141","125","3");
INSERT INTO test_scores VALUES("2710","141","121","3");
INSERT INTO test_scores VALUES("2711","141","117","6");
INSERT INTO test_scores VALUES("2712","141","145","5");
INSERT INTO test_scores VALUES("2713","141","72","1");
INSERT INTO test_scores VALUES("2714","141","37","6");
INSERT INTO test_scores VALUES("2715","141","76","6");
INSERT INTO test_scores VALUES("2716","141","31","1");
INSERT INTO test_scores VALUES("2717","141","135","4");
INSERT INTO test_scores VALUES("2718","142","122","0");
INSERT INTO test_scores VALUES("2719","142","123","1");
INSERT INTO test_scores VALUES("2720","142","159","0");
INSERT INTO test_scores VALUES("2721","142","146","0");
INSERT INTO test_scores VALUES("2722","142","12","4");
INSERT INTO test_scores VALUES("2723","142","143","3");
INSERT INTO test_scores VALUES("2724","142","178","3");
INSERT INTO test_scores VALUES("2725","142","127","3");
INSERT INTO test_scores VALUES("2726","142","119","0");
INSERT INTO test_scores VALUES("2727","142","142","1");
INSERT INTO test_scores VALUES("2728","142","148","1");
INSERT INTO test_scores VALUES("2729","142","135","3");
INSERT INTO test_scores VALUES("2730","142","31","1");
INSERT INTO test_scores VALUES("2731","142","76","3");
INSERT INTO test_scores VALUES("2732","142","37","6");
INSERT INTO test_scores VALUES("2733","142","72","6");
INSERT INTO test_scores VALUES("2734","142","145","2");
INSERT INTO test_scores VALUES("2735","142","121","1");
INSERT INTO test_scores VALUES("2736","142","125","6");
INSERT INTO test_scores VALUES("2737","142","117","6");
INSERT INTO test_scores VALUES("2738","142","124","6");
INSERT INTO test_scores VALUES("2739","142","128","0");
INSERT INTO test_scores VALUES("2740","142","149","1");
INSERT INTO test_scores VALUES("2741","142","161","3");
INSERT INTO test_scores VALUES("2742","142","171","1");
INSERT INTO test_scores VALUES("2743","142","27","1");
INSERT INTO test_scores VALUES("2744","142","22","6");
INSERT INTO test_scores VALUES("2745","142","144","6");
INSERT INTO test_scores VALUES("2746","142","147","1");
INSERT INTO test_scores VALUES("2747","142","165","6");
INSERT INTO test_scores VALUES("2748","142","109","4");
INSERT INTO test_scores VALUES("2749","143","146","0");
INSERT INTO test_scores VALUES("2750","143","12","6");
INSERT INTO test_scores VALUES("2751","143","143","2");
INSERT INTO test_scores VALUES("2752","143","178","3");
INSERT INTO test_scores VALUES("2753","143","127","2");
INSERT INTO test_scores VALUES("2754","143","119","1");
INSERT INTO test_scores VALUES("2755","143","122","1");
INSERT INTO test_scores VALUES("2756","143","159","0");
INSERT INTO test_scores VALUES("2757","143","123","2");
INSERT INTO test_scores VALUES("2758","143","142","4");
INSERT INTO test_scores VALUES("2759","143","148","2");
INSERT INTO test_scores VALUES("2760","143","135","2");
INSERT INTO test_scores VALUES("2761","143","31","1");
INSERT INTO test_scores VALUES("2762","143","76","2");
INSERT INTO test_scores VALUES("2763","143","37","6");
INSERT INTO test_scores VALUES("2764","143","72","1");
INSERT INTO test_scores VALUES("2765","143","145","2");
INSERT INTO test_scores VALUES("2766","143","109","1");
INSERT INTO test_scores VALUES("2767","143","121","6");
INSERT INTO test_scores VALUES("2768","143","125","3");
INSERT INTO test_scores VALUES("2769","143","117","3");
INSERT INTO test_scores VALUES("2770","143","147","3");
INSERT INTO test_scores VALUES("2771","143","144","3");
INSERT INTO test_scores VALUES("2772","143","22","3");
INSERT INTO test_scores VALUES("2773","143","165","6");
INSERT INTO test_scores VALUES("2774","143","27","0");
INSERT INTO test_scores VALUES("2775","143","171","0");
INSERT INTO test_scores VALUES("2776","143","161","0");
INSERT INTO test_scores VALUES("2777","143","149","0");
INSERT INTO test_scores VALUES("2778","143","128","0");
INSERT INTO test_scores VALUES("2779","143","167","1");
INSERT INTO test_scores VALUES("2780","143","124","4");
INSERT INTO test_scores VALUES("2781","142","167","2");
INSERT INTO test_scores VALUES("2782","141","167","1");
INSERT INTO test_scores VALUES("2783","144","37","6");
INSERT INTO test_scores VALUES("2784","144","72","0");
INSERT INTO test_scores VALUES("2785","144","165","1");
INSERT INTO test_scores VALUES("2786","144","22","2");
INSERT INTO test_scores VALUES("2787","144","144","0");
INSERT INTO test_scores VALUES("2788","144","147","1");
INSERT INTO test_scores VALUES("2789","144","125","0");
INSERT INTO test_scores VALUES("2790","144","121","0");
INSERT INTO test_scores VALUES("2791","144","109","0");
INSERT INTO test_scores VALUES("2792","144","117","0");
INSERT INTO test_scores VALUES("2793","144","76","2");
INSERT INTO test_scores VALUES("2794","144","31","0");
INSERT INTO test_scores VALUES("2795","144","135","0");
INSERT INTO test_scores VALUES("2796","144","148","0");
INSERT INTO test_scores VALUES("2797","144","142","0");
INSERT INTO test_scores VALUES("2798","144","119","0");
INSERT INTO test_scores VALUES("2799","144","123","0");
INSERT INTO test_scores VALUES("2800","144","122","0");
INSERT INTO test_scores VALUES("2801","144","127","0");
INSERT INTO test_scores VALUES("2802","144","178","0");
INSERT INTO test_scores VALUES("2803","144","143","0");
INSERT INTO test_scores VALUES("2804","144","12","2");
INSERT INTO test_scores VALUES("2805","144","146","0");
INSERT INTO test_scores VALUES("2806","144","145","0");
INSERT INTO test_scores VALUES("2807","144","149","0");
INSERT INTO test_scores VALUES("2808","144","171","0");
INSERT INTO test_scores VALUES("2809","144","124","4");
INSERT INTO test_scores VALUES("2810","144","167","0");
INSERT INTO test_scores VALUES("2811","141","66","6");
INSERT INTO test_scores VALUES("2812","142","66","6");
INSERT INTO test_scores VALUES("2813","144","66","0");
INSERT INTO test_scores VALUES("2814","143","66","3");
INSERT INTO test_scores VALUES("2815","141","3","6");
INSERT INTO test_scores VALUES("2816","142","3","6");
INSERT INTO test_scores VALUES("2817","143","3","6");
INSERT INTO test_scores VALUES("2818","144","3","6");
INSERT INTO test_scores VALUES("2819","141","36","4");
INSERT INTO test_scores VALUES("2820","142","36","6");
INSERT INTO test_scores VALUES("2821","143","36","1");
INSERT INTO test_scores VALUES("2822","144","36","0");
INSERT INTO test_scores VALUES("2823","141","73","6");
INSERT INTO test_scores VALUES("2824","142","73","6");
INSERT INTO test_scores VALUES("2825","143","73","3");
INSERT INTO test_scores VALUES("2826","144","73","0");
INSERT INTO test_scores VALUES("2827","141","6","6");
INSERT INTO test_scores VALUES("2828","142","6","2");
INSERT INTO test_scores VALUES("2829","143","6","6");
INSERT INTO test_scores VALUES("2830","144","6","2");
INSERT INTO test_scores VALUES("2831","145","22","4");
INSERT INTO test_scores VALUES("2832","145","73","6");
INSERT INTO test_scores VALUES("2833","145","109","2");
INSERT INTO test_scores VALUES("2834","145","213","0");
INSERT INTO test_scores VALUES("2835","145","119","0");
INSERT INTO test_scores VALUES("2836","145","147","4");
INSERT INTO test_scores VALUES("2837","145","117","6");
INSERT INTO test_scores VALUES("2838","145","31","2");
INSERT INTO test_scores VALUES("2839","145","121","4");
INSERT INTO test_scores VALUES("2840","145","125","4");
INSERT INTO test_scores VALUES("2841","145","120","2");
INSERT INTO test_scores VALUES("2842","145","145","2");
INSERT INTO test_scores VALUES("2843","145","135","2");
INSERT INTO test_scores VALUES("2844","145","27","0");
INSERT INTO test_scores VALUES("2845","145","173","0");
INSERT INTO test_scores VALUES("2846","145","67","6");
INSERT INTO test_scores VALUES("2847","145","166","2");
INSERT INTO test_scores VALUES("2848","145","122","0");
INSERT INTO test_scores VALUES("2849","145","72","4");
INSERT INTO test_scores VALUES("2850","145","148","2");
INSERT INTO test_scores VALUES("2851","145","127","0");
INSERT INTO test_scores VALUES("2852","145","178","0");
INSERT INTO test_scores VALUES("2853","145","142","2");
INSERT INTO test_scores VALUES("2854","145","143","4");
INSERT INTO test_scores VALUES("2855","145","123","2");
INSERT INTO test_scores VALUES("2856","145","146","0");
INSERT INTO test_scores VALUES("2857","145","26","2");
INSERT INTO test_scores VALUES("2858","145","161","2");
INSERT INTO test_scores VALUES("2859","145","128","0");
INSERT INTO test_scores VALUES("2860","145","159","4");
INSERT INTO test_scores VALUES("2861","145","36","4");
INSERT INTO test_scores VALUES("2862","145","76","0");
INSERT INTO test_scores VALUES("2863","145","144","4");
INSERT INTO test_scores VALUES("2864","145","12","4");
INSERT INTO test_scores VALUES("2865","145","66","2");
INSERT INTO test_scores VALUES("2866","145","6","6");
INSERT INTO test_scores VALUES("2867","145","40","2");
INSERT INTO test_scores VALUES("2868","145","124","6");
INSERT INTO test_scores VALUES("2869","145","149","0");
INSERT INTO test_scores VALUES("2870","146","161","6");
INSERT INTO test_scores VALUES("2871","146","149","2");
INSERT INTO test_scores VALUES("2872","146","66","6");
INSERT INTO test_scores VALUES("2873","146","12","6");
INSERT INTO test_scores VALUES("2874","146","6","6");
INSERT INTO test_scores VALUES("2875","146","40","6");
INSERT INTO test_scores VALUES("2876","146","159","6");
INSERT INTO test_scores VALUES("2877","146","128","2");
INSERT INTO test_scores VALUES("2878","146","144","6");
INSERT INTO test_scores VALUES("2879","146","76","4");
INSERT INTO test_scores VALUES("2880","146","36","6");
INSERT INTO test_scores VALUES("2881","146","26","4");
INSERT INTO test_scores VALUES("2882","146","124","6");
INSERT INTO test_scores VALUES("2883","146","22","6");
INSERT INTO test_scores VALUES("2884","146","73","4");
INSERT INTO test_scores VALUES("2885","146","109","6");
INSERT INTO test_scores VALUES("2886","146","213","6");
INSERT INTO test_scores VALUES("2887","146","119","6");
INSERT INTO test_scores VALUES("2888","146","147","6");
INSERT INTO test_scores VALUES("2889","146","117","6");
INSERT INTO test_scores VALUES("2890","146","121","6");
INSERT INTO test_scores VALUES("2891","146","31","4");
INSERT INTO test_scores VALUES("2892","146","125","6");
INSERT INTO test_scores VALUES("2893","146","120","6");
INSERT INTO test_scores VALUES("2894","146","27","4");
INSERT INTO test_scores VALUES("2895","146","135","0");
INSERT INTO test_scores VALUES("2896","146","173","6");
INSERT INTO test_scores VALUES("2897","146","145","6");
INSERT INTO test_scores VALUES("2898","146","72","0");
INSERT INTO test_scores VALUES("2899","146","67","6");
INSERT INTO test_scores VALUES("2900","146","122","2");
INSERT INTO test_scores VALUES("2901","146","166","6");
INSERT INTO test_scores VALUES("2902","146","148","2");
INSERT INTO test_scores VALUES("2903","146","127","6");
INSERT INTO test_scores VALUES("2904","146","178","6");
INSERT INTO test_scores VALUES("2905","146","142","6");
INSERT INTO test_scores VALUES("2906","146","143","6");
INSERT INTO test_scores VALUES("2907","146","123","6");
INSERT INTO test_scores VALUES("2908","146","146","2");
INSERT INTO test_scores VALUES("2909","147","161","2");
INSERT INTO test_scores VALUES("2910","147","66","6");
INSERT INTO test_scores VALUES("2911","147","12","4");
INSERT INTO test_scores VALUES("2912","147","149","2");
INSERT INTO test_scores VALUES("2913","147","6","6");
INSERT INTO test_scores VALUES("2914","147","40","2");
INSERT INTO test_scores VALUES("2915","147","128","0");
INSERT INTO test_scores VALUES("2916","147","159","2");
INSERT INTO test_scores VALUES("2917","147","144","4");
INSERT INTO test_scores VALUES("2918","147","124","6");
INSERT INTO test_scores VALUES("2919","147","26","4");
INSERT INTO test_scores VALUES("2920","147","36","6");
INSERT INTO test_scores VALUES("2921","147","76","2");
INSERT INTO test_scores VALUES("2922","147","22","4");
INSERT INTO test_scores VALUES("2923","147","73","4");
INSERT INTO test_scores VALUES("2924","147","109","2");
INSERT INTO test_scores VALUES("2925","147","213","0");
INSERT INTO test_scores VALUES("2926","147","117","6");
INSERT INTO test_scores VALUES("2927","147","119","2");
INSERT INTO test_scores VALUES("2928","147","147","4");
INSERT INTO test_scores VALUES("2929","147","120","4");
INSERT INTO test_scores VALUES("2930","147","31","4");
INSERT INTO test_scores VALUES("2931","147","121","4");
INSERT INTO test_scores VALUES("2932","147","125","4");
INSERT INTO test_scores VALUES("2933","147","27","2");
INSERT INTO test_scores VALUES("2934","147","135","2");
INSERT INTO test_scores VALUES("2935","147","173","6");
INSERT INTO test_scores VALUES("2936","147","145","0");
INSERT INTO test_scores VALUES("2937","147","166","4");
INSERT INTO test_scores VALUES("2938","147","122","0");
INSERT INTO test_scores VALUES("2939","147","72","4");
INSERT INTO test_scores VALUES("2940","147","67","6");
INSERT INTO test_scores VALUES("2941","147","148","0");
INSERT INTO test_scores VALUES("2942","147","127","4");
INSERT INTO test_scores VALUES("2943","147","178","4");
INSERT INTO test_scores VALUES("2944","147","142","4");
INSERT INTO test_scores VALUES("2945","147","123","4");
INSERT INTO test_scores VALUES("2946","147","146","0");
INSERT INTO test_scores VALUES("2947","147","143","6");
INSERT INTO test_scores VALUES("2948","148","40","4");
INSERT INTO test_scores VALUES("2949","148","124","6");
INSERT INTO test_scores VALUES("2950","148","66","6");
INSERT INTO test_scores VALUES("2951","148","144","6");
INSERT INTO test_scores VALUES("2952","148","12","6");
INSERT INTO test_scores VALUES("2953","148","6","6");
INSERT INTO test_scores VALUES("2954","148","76","6");
INSERT INTO test_scores VALUES("2955","148","36","6");
INSERT INTO test_scores VALUES("2956","148","149","6");
INSERT INTO test_scores VALUES("2957","148","161","4");
INSERT INTO test_scores VALUES("2958","148","128","0");
INSERT INTO test_scores VALUES("2959","148","159","4");
INSERT INTO test_scores VALUES("2960","148","143","4");
INSERT INTO test_scores VALUES("2961","148","146","0");
INSERT INTO test_scores VALUES("2962","148","123","6");
INSERT INTO test_scores VALUES("2963","148","142","6");
INSERT INTO test_scores VALUES("2964","148","178","2");
INSERT INTO test_scores VALUES("2965","148","127","6");
INSERT INTO test_scores VALUES("2966","148","148","2");
INSERT INTO test_scores VALUES("2967","148","72","6");
INSERT INTO test_scores VALUES("2968","148","67","6");
INSERT INTO test_scores VALUES("2969","148","145","4");
INSERT INTO test_scores VALUES("2970","148","173","6");
INSERT INTO test_scores VALUES("2971","148","135","0");
INSERT INTO test_scores VALUES("2972","148","27","4");
INSERT INTO test_scores VALUES("2973","148","122","6");
INSERT INTO test_scores VALUES("2974","148","120","4");
INSERT INTO test_scores VALUES("2975","148","121","6");
INSERT INTO test_scores VALUES("2976","148","31","6");
INSERT INTO test_scores VALUES("2977","148","125","6");
INSERT INTO test_scores VALUES("2978","148","119","4");
INSERT INTO test_scores VALUES("2979","148","147","2");
INSERT INTO test_scores VALUES("2980","148","22","6");
INSERT INTO test_scores VALUES("2981","148","73","6");
INSERT INTO test_scores VALUES("2982","148","213","2");
INSERT INTO test_scores VALUES("2983","148","109","6");
INSERT INTO test_scores VALUES("2984","150","12","4");
INSERT INTO test_scores VALUES("2985","150","124","4");
INSERT INTO test_scores VALUES("2986","150","76","4");
INSERT INTO test_scores VALUES("2987","150","40","4");
INSERT INTO test_scores VALUES("2988","150","66","6");
INSERT INTO test_scores VALUES("2989","150","123","0");
INSERT INTO test_scores VALUES("2990","150","36","6");
INSERT INTO test_scores VALUES("2991","150","122","0");
INSERT INTO test_scores VALUES("2992","150","26","4");
INSERT INTO test_scores VALUES("2993","150","144","6");
INSERT INTO test_scores VALUES("2994","150","159","0");
INSERT INTO test_scores VALUES("2995","150","177","0");
INSERT INTO test_scores VALUES("2996","150","215","4");
INSERT INTO test_scores VALUES("2997","150","178","6");
INSERT INTO test_scores VALUES("2998","150","161","0");
INSERT INTO test_scores VALUES("2999","150","30","4");
INSERT INTO test_scores VALUES("3000","150","146","0");
INSERT INTO test_scores VALUES("3001","150","128","0");
INSERT INTO test_scores VALUES("3002","150","166","4");
INSERT INTO test_scores VALUES("3003","150","117","6");
INSERT INTO test_scores VALUES("3004","150","121","4");
INSERT INTO test_scores VALUES("3005","150","22","6");
INSERT INTO test_scores VALUES("3006","150","73","6");
INSERT INTO test_scores VALUES("3007","150","120","4");
INSERT INTO test_scores VALUES("3008","150","125","6");
INSERT INTO test_scores VALUES("3009","150","3","6");
INSERT INTO test_scores VALUES("3010","150","27","6");
INSERT INTO test_scores VALUES("3011","150","72","4");
INSERT INTO test_scores VALUES("3012","150","147","4");
INSERT INTO test_scores VALUES("3013","150","148","6");
INSERT INTO test_scores VALUES("3014","150","119","6");
INSERT INTO test_scores VALUES("3015","150","67","6");
INSERT INTO test_scores VALUES("3016","150","31","4");
INSERT INTO test_scores VALUES("3017","150","143","6");
INSERT INTO test_scores VALUES("3018","150","142","6");
INSERT INTO test_scores VALUES("3019","150","127","6");
INSERT INTO test_scores VALUES("3020","150","135","2");
INSERT INTO test_scores VALUES("3021","150","173","6");
INSERT INTO test_scores VALUES("3022","150","37","6");
INSERT INTO test_scores VALUES("3023","149","40","2");
INSERT INTO test_scores VALUES("3024","149","66","2");
INSERT INTO test_scores VALUES("3025","149","128","0");
INSERT INTO test_scores VALUES("3026","149","159","0");
INSERT INTO test_scores VALUES("3027","149","161","2");
INSERT INTO test_scores VALUES("3028","149","30","0");
INSERT INTO test_scores VALUES("3029","149","124","0");
INSERT INTO test_scores VALUES("3425","161","128","0");
INSERT INTO test_scores VALUES("3031","149","12","6");
INSERT INTO test_scores VALUES("3032","149","144","2");
INSERT INTO test_scores VALUES("3033","149","76","2");
INSERT INTO test_scores VALUES("3034","149","26","2");
INSERT INTO test_scores VALUES("3035","149","36","2");
INSERT INTO test_scores VALUES("3036","149","146","0");
INSERT INTO test_scores VALUES("3037","149","178","2");
INSERT INTO test_scores VALUES("3038","149","177","0");
INSERT INTO test_scores VALUES("3039","149","142","4");
INSERT INTO test_scores VALUES("3040","149","143","2");
INSERT INTO test_scores VALUES("3041","149","122","2");
INSERT INTO test_scores VALUES("3042","149","123","2");
INSERT INTO test_scores VALUES("3043","149","127","2");
INSERT INTO test_scores VALUES("3044","149","119","4");
INSERT INTO test_scores VALUES("3045","149","135","0");
INSERT INTO test_scores VALUES("3046","149","72","0");
INSERT INTO test_scores VALUES("3047","149","173","4");
INSERT INTO test_scores VALUES("3048","149","27","2");
INSERT INTO test_scores VALUES("3049","149","67","4");
INSERT INTO test_scores VALUES("3050","149","148","0");
INSERT INTO test_scores VALUES("3051","149","166","2");
INSERT INTO test_scores VALUES("3052","149","31","2");
INSERT INTO test_scores VALUES("3053","149","22","6");
INSERT INTO test_scores VALUES("3054","149","125","4");
INSERT INTO test_scores VALUES("3055","149","120","4");
INSERT INTO test_scores VALUES("3056","149","73","2");
INSERT INTO test_scores VALUES("3057","149","121","2");
INSERT INTO test_scores VALUES("3058","149","117","4");
INSERT INTO test_scores VALUES("3059","149","147","2");
INSERT INTO test_scores VALUES("3060","149","3","6");
INSERT INTO test_scores VALUES("3061","149","37","6");
INSERT INTO test_scores VALUES("3424","161","40","6");
INSERT INTO test_scores VALUES("3063","151","144","6");
INSERT INTO test_scores VALUES("3064","151","124","3");
INSERT INTO test_scores VALUES("3065","151","30","0");
INSERT INTO test_scores VALUES("3066","151","40","3");
INSERT INTO test_scores VALUES("3067","151","66","6");
INSERT INTO test_scores VALUES("3068","151","159","1");
INSERT INTO test_scores VALUES("3069","151","128","0");
INSERT INTO test_scores VALUES("3070","151","12","3");
INSERT INTO test_scores VALUES("3071","151","36","4");
INSERT INTO test_scores VALUES("3072","151","76","6");
INSERT INTO test_scores VALUES("3073","151","22","5");
INSERT INTO test_scores VALUES("3074","151","73","3");
INSERT INTO test_scores VALUES("3075","151","120","3");
INSERT INTO test_scores VALUES("3076","151","125","3");
INSERT INTO test_scores VALUES("3077","151","147","0");
INSERT INTO test_scores VALUES("3078","151","117","3");
INSERT INTO test_scores VALUES("3079","151","121","3");
INSERT INTO test_scores VALUES("3080","151","3","3");
INSERT INTO test_scores VALUES("3081","151","67","3");
INSERT INTO test_scores VALUES("3082","151","148","1");
INSERT INTO test_scores VALUES("3083","151","31","3");
INSERT INTO test_scores VALUES("3084","151","166","0");
INSERT INTO test_scores VALUES("3085","151","72","3");
INSERT INTO test_scores VALUES("3086","151","37","3");
INSERT INTO test_scores VALUES("3087","151","27","1");
INSERT INTO test_scores VALUES("3088","151","173","4");
INSERT INTO test_scores VALUES("3089","151","135","0");
INSERT INTO test_scores VALUES("3090","151","119","3");
INSERT INTO test_scores VALUES("3091","151","127","3");
INSERT INTO test_scores VALUES("3092","151","123","3");
INSERT INTO test_scores VALUES("3093","151","122","0");
INSERT INTO test_scores VALUES("3094","151","143","6");
INSERT INTO test_scores VALUES("3095","151","142","1");
INSERT INTO test_scores VALUES("3096","151","177","1");
INSERT INTO test_scores VALUES("3097","151","178","3");
INSERT INTO test_scores VALUES("3098","151","146","0");
INSERT INTO test_scores VALUES("3099","152","120","1");
INSERT INTO test_scores VALUES("3100","152","73","3");
INSERT INTO test_scores VALUES("3101","152","125","6");
INSERT INTO test_scores VALUES("3102","152","31","1");
INSERT INTO test_scores VALUES("3103","152","166","0");
INSERT INTO test_scores VALUES("3104","152","148","3");
INSERT INTO test_scores VALUES("3105","152","173","3");
INSERT INTO test_scores VALUES("3106","152","37","6");
INSERT INTO test_scores VALUES("3107","152","27","1");
INSERT INTO test_scores VALUES("3108","152","67","1");
INSERT INTO test_scores VALUES("3109","152","72","1");
INSERT INTO test_scores VALUES("3110","152","135","0");
INSERT INTO test_scores VALUES("3111","152","119","1");
INSERT INTO test_scores VALUES("3112","152","127","2");
INSERT INTO test_scores VALUES("3113","152","123","0");
INSERT INTO test_scores VALUES("3114","152","122","0");
INSERT INTO test_scores VALUES("3115","152","143","1");
INSERT INTO test_scores VALUES("3116","152","142","1");
INSERT INTO test_scores VALUES("3117","152","177","1");
INSERT INTO test_scores VALUES("3118","152","178","3");
INSERT INTO test_scores VALUES("3119","152","146","0");
INSERT INTO test_scores VALUES("3120","152","12","1");
INSERT INTO test_scores VALUES("3121","152","215","1");
INSERT INTO test_scores VALUES("3122","152","30","0");
INSERT INTO test_scores VALUES("3123","152","66","1");
INSERT INTO test_scores VALUES("3124","152","40","3");
INSERT INTO test_scores VALUES("3125","152","124","4");
INSERT INTO test_scores VALUES("3126","152","144","3");
INSERT INTO test_scores VALUES("3127","152","36","3");
INSERT INTO test_scores VALUES("3128","152","76","0");
INSERT INTO test_scores VALUES("3129","152","3","3");
INSERT INTO test_scores VALUES("3130","152","121","1");
INSERT INTO test_scores VALUES("3131","152","147","0");
INSERT INTO test_scores VALUES("3132","152","117","1");
INSERT INTO test_scores VALUES("3133","152","22","6");
INSERT INTO test_scores VALUES("3134","153","161","1");
INSERT INTO test_scores VALUES("3135","153","36","6");
INSERT INTO test_scores VALUES("3136","153","173","0");
INSERT INTO test_scores VALUES("3137","153","167","1");
INSERT INTO test_scores VALUES("3138","153","171","0");
INSERT INTO test_scores VALUES("3139","153","177","1");
INSERT INTO test_scores VALUES("3140","153","117","1");
INSERT INTO test_scores VALUES("3141","153","3","6");
INSERT INTO test_scores VALUES("3142","153","121","3");
INSERT INTO test_scores VALUES("3143","153","12","6");
INSERT INTO test_scores VALUES("3144","153","123","2");
INSERT INTO test_scores VALUES("3145","153","128","0");
INSERT INTO test_scores VALUES("3146","153","55","2");
INSERT INTO test_scores VALUES("3147","153","165","5");
INSERT INTO test_scores VALUES("3148","153","159","1");
INSERT INTO test_scores VALUES("3149","153","147","6");
INSERT INTO test_scores VALUES("3150","153","22","6");
INSERT INTO test_scores VALUES("3151","153","73","4");
INSERT INTO test_scores VALUES("3152","153","33","6");
INSERT INTO test_scores VALUES("3153","153","72","1");
INSERT INTO test_scores VALUES("3154","153","67","3");
INSERT INTO test_scores VALUES("3155","153","27","4");
INSERT INTO test_scores VALUES("3156","153","215","1");
INSERT INTO test_scores VALUES("3157","153","143","4");
INSERT INTO test_scores VALUES("3158","153","213","1");
INSERT INTO test_scores VALUES("3159","153","178","3");
INSERT INTO test_scores VALUES("3160","153","146","0");
INSERT INTO test_scores VALUES("3161","153","118","6");
INSERT INTO test_scores VALUES("3162","153","148","4");
INSERT INTO test_scores VALUES("3163","153","135","4");
INSERT INTO test_scores VALUES("3164","153","127","4");
INSERT INTO test_scores VALUES("3165","153","142","1");
INSERT INTO test_scores VALUES("3166","153","124","6");
INSERT INTO test_scores VALUES("3167","153","119","1");
INSERT INTO test_scores VALUES("3168","153","31","1");
INSERT INTO test_scores VALUES("3169","153","37","1");
INSERT INTO test_scores VALUES("3170","153","125","6");
INSERT INTO test_scores VALUES("3171","154","173","1");
INSERT INTO test_scores VALUES("3172","154","22","1");
INSERT INTO test_scores VALUES("3173","154","147","0");
INSERT INTO test_scores VALUES("3174","154","125","4");
INSERT INTO test_scores VALUES("4139","196","142","3");
INSERT INTO test_scores VALUES("3176","154","165","4");
INSERT INTO test_scores VALUES("3177","154","55","0");
INSERT INTO test_scores VALUES("3178","154","3","4");
INSERT INTO test_scores VALUES("3179","154","117","0");
INSERT INTO test_scores VALUES("3180","154","121","1");
INSERT INTO test_scores VALUES("3181","154","67","6");
INSERT INTO test_scores VALUES("3182","154","177","0");
INSERT INTO test_scores VALUES("3183","154","33","6");
INSERT INTO test_scores VALUES("3184","154","37","4");
INSERT INTO test_scores VALUES("3185","154","31","3");
INSERT INTO test_scores VALUES("3186","154","72","4");
INSERT INTO test_scores VALUES("3187","154","27","0");
INSERT INTO test_scores VALUES("3188","154","124","3");
INSERT INTO test_scores VALUES("3189","154","215","0");
INSERT INTO test_scores VALUES("3190","154","118","0");
INSERT INTO test_scores VALUES("3191","154","127","1");
INSERT INTO test_scores VALUES("3192","154","135","0");
INSERT INTO test_scores VALUES("3193","154","148","0");
INSERT INTO test_scores VALUES("3194","154","159","1");
INSERT INTO test_scores VALUES("3195","154","171","0");
INSERT INTO test_scores VALUES("3196","154","12","4");
INSERT INTO test_scores VALUES("3197","154","123","1");
INSERT INTO test_scores VALUES("3198","154","167","1");
INSERT INTO test_scores VALUES("3199","154","36","3");
INSERT INTO test_scores VALUES("3200","154","161","0");
INSERT INTO test_scores VALUES("3201","154","128","0");
INSERT INTO test_scores VALUES("3202","154","142","1");
INSERT INTO test_scores VALUES("3203","154","146","0");
INSERT INTO test_scores VALUES("3204","154","178","0");
INSERT INTO test_scores VALUES("3205","154","143","1");
INSERT INTO test_scores VALUES("3206","154","119","0");
INSERT INTO test_scores VALUES("3207","155","36","0");
INSERT INTO test_scores VALUES("3208","155","119","1");
INSERT INTO test_scores VALUES("3209","155","12","1");
INSERT INTO test_scores VALUES("3210","155","161","0");
INSERT INTO test_scores VALUES("3211","155","123","0");
INSERT INTO test_scores VALUES("3212","155","128","0");
INSERT INTO test_scores VALUES("3213","155","159","0");
INSERT INTO test_scores VALUES("3214","155","167","0");
INSERT INTO test_scores VALUES("3215","155","173","0");
INSERT INTO test_scores VALUES("3216","155","118","0");
INSERT INTO test_scores VALUES("3217","155","117","0");
INSERT INTO test_scores VALUES("3218","155","165","3");
INSERT INTO test_scores VALUES("3219","155","22","2");
INSERT INTO test_scores VALUES("3220","155","73","0");
INSERT INTO test_scores VALUES("3221","155","147","1");
INSERT INTO test_scores VALUES("3222","155","148","0");
INSERT INTO test_scores VALUES("3223","155","135","0");
INSERT INTO test_scores VALUES("3224","155","178","0");
INSERT INTO test_scores VALUES("3225","155","215","0");
INSERT INTO test_scores VALUES("3226","155","143","0");
INSERT INTO test_scores VALUES("3227","155","31","2");
INSERT INTO test_scores VALUES("3228","155","37","6");
INSERT INTO test_scores VALUES("3229","155","146","0");
INSERT INTO test_scores VALUES("3230","155","33","6");
INSERT INTO test_scores VALUES("3231","155","127","0");
INSERT INTO test_scores VALUES("3232","155","142","0");
INSERT INTO test_scores VALUES("3233","155","125","2");
INSERT INTO test_scores VALUES("3234","155","55","0");
INSERT INTO test_scores VALUES("3235","155","3","3");
INSERT INTO test_scores VALUES("3236","155","177","0");
INSERT INTO test_scores VALUES("3237","155","67","2");
INSERT INTO test_scores VALUES("3238","155","121","0");
INSERT INTO test_scores VALUES("3239","155","72","0");
INSERT INTO test_scores VALUES("3240","155","27","0");
INSERT INTO test_scores VALUES("3241","155","124","1");
INSERT INTO test_scores VALUES("3242","153","66","3");
INSERT INTO test_scores VALUES("3243","154","66","1");
INSERT INTO test_scores VALUES("3244","155","66","0");
INSERT INTO test_scores VALUES("3245","153","144","6");
INSERT INTO test_scores VALUES("3246","154","144","0");
INSERT INTO test_scores VALUES("3247","155","144","2");
INSERT INTO test_scores VALUES("3248","156","125","6");
INSERT INTO test_scores VALUES("3249","156","144","6");
INSERT INTO test_scores VALUES("3250","156","73","6");
INSERT INTO test_scores VALUES("3251","156","37","6");
INSERT INTO test_scores VALUES("3252","156","165","6");
INSERT INTO test_scores VALUES("3253","156","22","6");
INSERT INTO test_scores VALUES("3254","156","147","6");
INSERT INTO test_scores VALUES("3255","156","120","2");
INSERT INTO test_scores VALUES("3256","156","149","2");
INSERT INTO test_scores VALUES("3257","156","146","0");
INSERT INTO test_scores VALUES("3258","156","143","6");
INSERT INTO test_scores VALUES("3259","156","177","2");
INSERT INTO test_scores VALUES("3260","156","215","6");
INSERT INTO test_scores VALUES("3261","156","161","4");
INSERT INTO test_scores VALUES("3262","156","142","4");
INSERT INTO test_scores VALUES("3263","156","127","4");
INSERT INTO test_scores VALUES("3264","156","72","4");
INSERT INTO test_scores VALUES("3265","156","121","6");
INSERT INTO test_scores VALUES("3266","156","145","6");
INSERT INTO test_scores VALUES("3267","156","122","2");
INSERT INTO test_scores VALUES("3268","156","135","2");
INSERT INTO test_scores VALUES("3269","156","6","4");
INSERT INTO test_scores VALUES("3270","156","123","6");
INSERT INTO test_scores VALUES("3271","156","12","6");
INSERT INTO test_scores VALUES("3272","156","119","4");
INSERT INTO test_scores VALUES("3273","156","67","4");
INSERT INTO test_scores VALUES("3274","156","66","4");
INSERT INTO test_scores VALUES("3275","156","178","2");
INSERT INTO test_scores VALUES("3276","156","159","6");
INSERT INTO test_scores VALUES("3277","156","36","6");
INSERT INTO test_scores VALUES("3278","156","40","6");
INSERT INTO test_scores VALUES("3279","158","122","2");
INSERT INTO test_scores VALUES("3280","158","135","0");
INSERT INTO test_scores VALUES("3281","158","6","6");
INSERT INTO test_scores VALUES("3282","158","123","2");
INSERT INTO test_scores VALUES("3283","158","12","6");
INSERT INTO test_scores VALUES("3284","158","128","0");
INSERT INTO test_scores VALUES("3285","158","36","4");
INSERT INTO test_scores VALUES("3286","158","159","2");
INSERT INTO test_scores VALUES("3287","158","147","2");
INSERT INTO test_scores VALUES("3288","158","40","4");
INSERT INTO test_scores VALUES("3289","158","119","4");
INSERT INTO test_scores VALUES("3290","158","120","2");
INSERT INTO test_scores VALUES("3291","158","125","4");
INSERT INTO test_scores VALUES("3292","158","73","2");
INSERT INTO test_scores VALUES("3293","158","144","6");
INSERT INTO test_scores VALUES("3294","158","22","4");
INSERT INTO test_scores VALUES("3295","158","121","4");
INSERT INTO test_scores VALUES("3296","158","72","4");
INSERT INTO test_scores VALUES("3297","158","177","2");
INSERT INTO test_scores VALUES("3298","158","178","4");
INSERT INTO test_scores VALUES("3299","158","142","4");
INSERT INTO test_scores VALUES("3300","158","161","2");
INSERT INTO test_scores VALUES("3301","158","149","0");
INSERT INTO test_scores VALUES("3302","158","67","4");
INSERT INTO test_scores VALUES("3303","158","66","6");
INSERT INTO test_scores VALUES("3304","158","124","4");
INSERT INTO test_scores VALUES("3305","158","146","2");
INSERT INTO test_scores VALUES("3306","158","215","2");
INSERT INTO test_scores VALUES("3307","158","143","6");
INSERT INTO test_scores VALUES("3308","158","127","4");
INSERT INTO test_scores VALUES("3309","158","145","2");
INSERT INTO test_scores VALUES("3310","158","37","6");
INSERT INTO test_scores VALUES("3311","158","165","2");
INSERT INTO test_scores VALUES("3312","156","124","6");
INSERT INTO test_scores VALUES("3313","159","22","4");
INSERT INTO test_scores VALUES("3314","159","147","6");
INSERT INTO test_scores VALUES("3315","159","120","2");
INSERT INTO test_scores VALUES("3316","159","73","4");
INSERT INTO test_scores VALUES("3317","159","125","6");
INSERT INTO test_scores VALUES("3318","159","144","6");
INSERT INTO test_scores VALUES("3319","159","127","6");
INSERT INTO test_scores VALUES("3320","159","142","6");
INSERT INTO test_scores VALUES("3321","159","143","6");
INSERT INTO test_scores VALUES("3322","159","215","6");
INSERT INTO test_scores VALUES("3323","159","146","6");
INSERT INTO test_scores VALUES("3324","159","161","6");
INSERT INTO test_scores VALUES("3325","159","149","2");
INSERT INTO test_scores VALUES("3326","159","178","6");
INSERT INTO test_scores VALUES("3327","159","177","2");
INSERT INTO test_scores VALUES("3328","159","72","2");
INSERT INTO test_scores VALUES("3329","159","124","6");
INSERT INTO test_scores VALUES("3330","159","165","6");
INSERT INTO test_scores VALUES("3331","159","37","6");
INSERT INTO test_scores VALUES("3332","159","66","2");
INSERT INTO test_scores VALUES("3333","159","145","0");
INSERT INTO test_scores VALUES("3334","159","121","6");
INSERT INTO test_scores VALUES("3335","159","135","4");
INSERT INTO test_scores VALUES("3336","159","36","4");
INSERT INTO test_scores VALUES("3337","159","159","2");
INSERT INTO test_scores VALUES("3338","159","40","6");
INSERT INTO test_scores VALUES("3339","159","128","2");
INSERT INTO test_scores VALUES("3340","159","119","6");
INSERT INTO test_scores VALUES("3341","159","122","4");
INSERT INTO test_scores VALUES("3342","159","67","6");
INSERT INTO test_scores VALUES("3343","159","6","6");
INSERT INTO test_scores VALUES("3344","159","123","2");
INSERT INTO test_scores VALUES("3345","159","12","4");
INSERT INTO test_scores VALUES("3346","157","178","0");
INSERT INTO test_scores VALUES("3347","157","177","0");
INSERT INTO test_scores VALUES("3348","157","149","0");
INSERT INTO test_scores VALUES("3349","157","146","0");
INSERT INTO test_scores VALUES("3350","157","143","0");
INSERT INTO test_scores VALUES("3351","157","215","0");
INSERT INTO test_scores VALUES("3352","157","22","2");
INSERT INTO test_scores VALUES("3353","157","73","0");
INSERT INTO test_scores VALUES("3354","157","66","2");
INSERT INTO test_scores VALUES("3355","157","147","4");
INSERT INTO test_scores VALUES("3356","157","120","0");
INSERT INTO test_scores VALUES("3357","157","125","4");
INSERT INTO test_scores VALUES("3358","157","144","2");
INSERT INTO test_scores VALUES("3359","157","67","2");
INSERT INTO test_scores VALUES("3360","157","37","2");
INSERT INTO test_scores VALUES("3361","157","121","0");
INSERT INTO test_scores VALUES("3362","157","145","0");
INSERT INTO test_scores VALUES("3363","157","165","2");
INSERT INTO test_scores VALUES("3364","157","128","0");
INSERT INTO test_scores VALUES("3365","157","36","0");
INSERT INTO test_scores VALUES("3366","157","159","0");
INSERT INTO test_scores VALUES("3367","157","40","2");
INSERT INTO test_scores VALUES("3368","157","122","0");
INSERT INTO test_scores VALUES("3369","157","123","0");
INSERT INTO test_scores VALUES("3370","157","119","2");
INSERT INTO test_scores VALUES("3371","157","12","2");
INSERT INTO test_scores VALUES("3372","157","6","2");
INSERT INTO test_scores VALUES("3373","157","142","2");
INSERT INTO test_scores VALUES("3374","157","124","2");
INSERT INTO test_scores VALUES("3375","157","127","0");
INSERT INTO test_scores VALUES("3376","157","161","0");
INSERT INTO test_scores VALUES("3377","157","135","0");
INSERT INTO test_scores VALUES("3378","157","72","0");
INSERT INTO test_scores VALUES("3379","151","165","3");
INSERT INTO test_scores VALUES("3380","152","165","6");
INSERT INTO test_scores VALUES("3381","151","6","5");
INSERT INTO test_scores VALUES("3382","152","6","6");
INSERT INTO test_scores VALUES("3383","153","6","3");
INSERT INTO test_scores VALUES("3384","154","6","6");
INSERT INTO test_scores VALUES("3385","155","6","1");
INSERT INTO test_scores VALUES("3386","157","3","4");
INSERT INTO test_scores VALUES("3387","156","3","6");
INSERT INTO test_scores VALUES("3388","158","3","2");
INSERT INTO test_scores VALUES("3389","159","3","4");
INSERT INTO test_scores VALUES("3390","160","40","6");
INSERT INTO test_scores VALUES("3391","160","128","0");
INSERT INTO test_scores VALUES("3392","160","159","0");
INSERT INTO test_scores VALUES("3393","160","165","6");
INSERT INTO test_scores VALUES("3394","160","135","0");
INSERT INTO test_scores VALUES("3395","160","27","2");
INSERT INTO test_scores VALUES("3396","160","127","6");
INSERT INTO test_scores VALUES("3397","160","142","6");
INSERT INTO test_scores VALUES("3398","160","146","0");
INSERT INTO test_scores VALUES("3399","160","66","2");
INSERT INTO test_scores VALUES("3400","160","76","0");
INSERT INTO test_scores VALUES("3401","160","215","0");
INSERT INTO test_scores VALUES("3402","160","36","2");
INSERT INTO test_scores VALUES("3403","160","119","0");
INSERT INTO test_scores VALUES("3404","160","124","2");
INSERT INTO test_scores VALUES("3405","160","161","2");
INSERT INTO test_scores VALUES("3406","160","33","3");
INSERT INTO test_scores VALUES("3407","160","178","3");
INSERT INTO test_scores VALUES("3408","160","143","6");
INSERT INTO test_scores VALUES("3409","160","72","0");
INSERT INTO test_scores VALUES("3410","160","120","2");
INSERT INTO test_scores VALUES("3411","160","31","0");
INSERT INTO test_scores VALUES("3412","160","122","3");
INSERT INTO test_scores VALUES("3413","160","121","1");
INSERT INTO test_scores VALUES("3414","160","145","3");
INSERT INTO test_scores VALUES("3415","160","123","3");
INSERT INTO test_scores VALUES("3416","160","22","6");
INSERT INTO test_scores VALUES("3417","160","117","5");
INSERT INTO test_scores VALUES("3418","160","125","6");
INSERT INTO test_scores VALUES("3419","160","144","2");
INSERT INTO test_scores VALUES("3420","160","177","0");
INSERT INTO test_scores VALUES("3421","160","55","2");
INSERT INTO test_scores VALUES("3422","160","147","3");
INSERT INTO test_scores VALUES("3423","160","67","3");
INSERT INTO test_scores VALUES("3426","161","124","6");
INSERT INTO test_scores VALUES("3427","161","159","0");
INSERT INTO test_scores VALUES("3428","161","165","6");
INSERT INTO test_scores VALUES("3429","161","27","0");
INSERT INTO test_scores VALUES("3430","161","135","1");
INSERT INTO test_scores VALUES("3431","161","215","1");
INSERT INTO test_scores VALUES("3432","161","146","0");
INSERT INTO test_scores VALUES("3433","161","66","4");
INSERT INTO test_scores VALUES("3434","161","36","6");
INSERT INTO test_scores VALUES("3435","161","33","6");
INSERT INTO test_scores VALUES("3436","161","178","1");
INSERT INTO test_scores VALUES("3437","161","143","1");
INSERT INTO test_scores VALUES("3438","161","122","1");
INSERT INTO test_scores VALUES("3439","161","31","3");
INSERT INTO test_scores VALUES("3440","161","120","1");
INSERT INTO test_scores VALUES("3441","161","72","1");
INSERT INTO test_scores VALUES("3442","161","177","1");
INSERT INTO test_scores VALUES("3443","161","145","4");
INSERT INTO test_scores VALUES("3444","161","121","3");
INSERT INTO test_scores VALUES("3445","161","123","4");
INSERT INTO test_scores VALUES("3446","161","22","5");
INSERT INTO test_scores VALUES("3447","161","117","1");
INSERT INTO test_scores VALUES("3448","161","125","6");
INSERT INTO test_scores VALUES("3449","161","144","6");
INSERT INTO test_scores VALUES("3450","161","55","3");
INSERT INTO test_scores VALUES("3451","161","147","6");
INSERT INTO test_scores VALUES("3452","161","142","1");
INSERT INTO test_scores VALUES("3453","161","67","3");
INSERT INTO test_scores VALUES("3454","161","127","6");
INSERT INTO test_scores VALUES("3455","161","119","1");
INSERT INTO test_scores VALUES("3456","161","76","1");
INSERT INTO test_scores VALUES("3457","161","161","0");
INSERT INTO test_scores VALUES("3458","162","147","1");
INSERT INTO test_scores VALUES("3459","162","67","5");
INSERT INTO test_scores VALUES("3460","162","22","1");
INSERT INTO test_scores VALUES("3461","162","125","1");
INSERT INTO test_scores VALUES("3462","162","144","1");
INSERT INTO test_scores VALUES("3463","162","177","0");
INSERT INTO test_scores VALUES("3464","162","117","1");
INSERT INTO test_scores VALUES("3465","162","121","0");
INSERT INTO test_scores VALUES("3466","162","72","1");
INSERT INTO test_scores VALUES("3467","162","120","1");
INSERT INTO test_scores VALUES("3468","162","122","1");
INSERT INTO test_scores VALUES("3469","162","66","1");
INSERT INTO test_scores VALUES("3470","162","31","1");
INSERT INTO test_scores VALUES("3471","162","36","1");
INSERT INTO test_scores VALUES("3472","162","33","0");
INSERT INTO test_scores VALUES("3473","162","123","1");
INSERT INTO test_scores VALUES("3474","162","178","1");
INSERT INTO test_scores VALUES("3475","162","145","1");
INSERT INTO test_scores VALUES("3476","162","119","1");
INSERT INTO test_scores VALUES("3477","162","143","1");
INSERT INTO test_scores VALUES("3478","162","127","0");
INSERT INTO test_scores VALUES("3479","162","27","1");
INSERT INTO test_scores VALUES("3480","162","165","4");
INSERT INTO test_scores VALUES("3481","162","159","1");
INSERT INTO test_scores VALUES("3482","162","128","0");
INSERT INTO test_scores VALUES("3483","162","135","0");
INSERT INTO test_scores VALUES("3484","162","215","1");
INSERT INTO test_scores VALUES("3485","162","76","1");
INSERT INTO test_scores VALUES("3486","162","124","4");
INSERT INTO test_scores VALUES("3487","162","161","0");
INSERT INTO test_scores VALUES("3488","162","40","3");
INSERT INTO test_scores VALUES("3489","162","146","0");
INSERT INTO test_scores VALUES("3491","163","159","0");
INSERT INTO test_scores VALUES("3492","163","124","6");
INSERT INTO test_scores VALUES("3493","163","67","6");
INSERT INTO test_scores VALUES("3494","163","40","4");
INSERT INTO test_scores VALUES("3495","163","76","0");
INSERT INTO test_scores VALUES("3496","163","6","6");
INSERT INTO test_scores VALUES("3497","163","36","2");
INSERT INTO test_scores VALUES("3498","163","128","0");
INSERT INTO test_scores VALUES("3499","163","147","2");
INSERT INTO test_scores VALUES("3500","163","165","6");
INSERT INTO test_scores VALUES("3501","163","144","2");
INSERT INTO test_scores VALUES("3502","163","117","4");
INSERT INTO test_scores VALUES("3503","163","121","4");
INSERT INTO test_scores VALUES("3504","163","177","0");
INSERT INTO test_scores VALUES("3505","163","179","6");
INSERT INTO test_scores VALUES("3506","163","73","0");
INSERT INTO test_scores VALUES("3507","163","72","6");
INSERT INTO test_scores VALUES("3508","163","122","0");
INSERT INTO test_scores VALUES("3509","163","119","4");
INSERT INTO test_scores VALUES("3510","163","215","0");
INSERT INTO test_scores VALUES("3511","163","135","0");
INSERT INTO test_scores VALUES("3512","163","178","0");
INSERT INTO test_scores VALUES("3513","163","142","0");
INSERT INTO test_scores VALUES("3514","163","166","0");
INSERT INTO test_scores VALUES("3515","163","127","0");
INSERT INTO test_scores VALUES("3516","163","123","0");
INSERT INTO test_scores VALUES("3517","163","22","4");
INSERT INTO test_scores VALUES("3518","163","143","0");
INSERT INTO test_scores VALUES("3519","163","37","6");
INSERT INTO test_scores VALUES("3520","163","145","0");
INSERT INTO test_scores VALUES("3521","163","180","0");
INSERT INTO test_scores VALUES("3522","163","125","2");
INSERT INTO test_scores VALUES("3523","163","120","0");
INSERT INTO test_scores VALUES("3524","163","33","6");
INSERT INTO test_scores VALUES("3525","164","67","2");
INSERT INTO test_scores VALUES("3526","164","40","4");
INSERT INTO test_scores VALUES("3527","164","128","0");
INSERT INTO test_scores VALUES("3528","164","159","0");
INSERT INTO test_scores VALUES("3529","164","124","4");
INSERT INTO test_scores VALUES("3530","164","76","2");
INSERT INTO test_scores VALUES("3531","164","6","4");
INSERT INTO test_scores VALUES("3532","164","36","6");
INSERT INTO test_scores VALUES("3533","164","165","4");
INSERT INTO test_scores VALUES("3534","164","120","2");
INSERT INTO test_scores VALUES("3535","164","147","6");
INSERT INTO test_scores VALUES("3536","164","143","2");
INSERT INTO test_scores VALUES("3537","164","127","6");
INSERT INTO test_scores VALUES("3538","164","135","4");
INSERT INTO test_scores VALUES("3539","164","178","2");
INSERT INTO test_scores VALUES("3540","164","166","2");
INSERT INTO test_scores VALUES("3541","164","122","2");
INSERT INTO test_scores VALUES("3542","164","119","0");
INSERT INTO test_scores VALUES("3543","164","215","4");
INSERT INTO test_scores VALUES("3544","164","72","4");
INSERT INTO test_scores VALUES("3545","164","145","4");
INSERT INTO test_scores VALUES("3546","164","180","4");
INSERT INTO test_scores VALUES("3547","164","37","4");
INSERT INTO test_scores VALUES("3548","164","177","2");
INSERT INTO test_scores VALUES("3549","164","33","6");
INSERT INTO test_scores VALUES("3550","164","181","6");
INSERT INTO test_scores VALUES("3551","164","73","6");
INSERT INTO test_scores VALUES("3552","164","22","4");
INSERT INTO test_scores VALUES("3553","164","125","6");
INSERT INTO test_scores VALUES("3554","164","144","6");
INSERT INTO test_scores VALUES("3555","164","117","4");
INSERT INTO test_scores VALUES("3556","164","121","4");
INSERT INTO test_scores VALUES("3557","165","22","4");
INSERT INTO test_scores VALUES("3558","165","125","6");
INSERT INTO test_scores VALUES("3559","165","117","4");
INSERT INTO test_scores VALUES("3560","165","121","0");
INSERT INTO test_scores VALUES("3561","165","144","6");
INSERT INTO test_scores VALUES("3562","165","33","6");
INSERT INTO test_scores VALUES("3563","165","73","0");
INSERT INTO test_scores VALUES("3564","165","177","0");
INSERT INTO test_scores VALUES("3565","165","145","0");
INSERT INTO test_scores VALUES("3566","165","37","2");
INSERT INTO test_scores VALUES("3567","165","72","4");
INSERT INTO test_scores VALUES("3568","165","122","0");
INSERT INTO test_scores VALUES("3569","165","119","4");
INSERT INTO test_scores VALUES("3570","165","215","2");
INSERT INTO test_scores VALUES("3571","165","178","2");
INSERT INTO test_scores VALUES("3572","165","142","2");
INSERT INTO test_scores VALUES("3573","165","135","2");
INSERT INTO test_scores VALUES("3574","165","166","4");
INSERT INTO test_scores VALUES("3575","165","123","2");
INSERT INTO test_scores VALUES("3576","165","127","4");
INSERT INTO test_scores VALUES("3577","165","213","0");
INSERT INTO test_scores VALUES("3578","165","143","4");
INSERT INTO test_scores VALUES("3579","165","165","6");
INSERT INTO test_scores VALUES("3580","165","120","4");
INSERT INTO test_scores VALUES("3581","165","147","2");
INSERT INTO test_scores VALUES("3582","165","159","0");
INSERT INTO test_scores VALUES("3583","165","124","6");
INSERT INTO test_scores VALUES("3584","165","67","4");
INSERT INTO test_scores VALUES("3585","165","76","4");
INSERT INTO test_scores VALUES("3586","165","40","2");
INSERT INTO test_scores VALUES("3587","165","6","6");
INSERT INTO test_scores VALUES("3588","165","36","6");
INSERT INTO test_scores VALUES("3589","165","128","0");
INSERT INTO test_scores VALUES("3590","166","40","4");
INSERT INTO test_scores VALUES("3591","166","124","6");
INSERT INTO test_scores VALUES("3592","166","159","2");
INSERT INTO test_scores VALUES("3593","166","67","6");
INSERT INTO test_scores VALUES("3594","166","128","0");
INSERT INTO test_scores VALUES("3595","166","36","4");
INSERT INTO test_scores VALUES("3596","166","76","4");
INSERT INTO test_scores VALUES("3597","166","6","6");
INSERT INTO test_scores VALUES("3598","166","120","4");
INSERT INTO test_scores VALUES("3599","166","147","6");
INSERT INTO test_scores VALUES("3600","166","165","6");
INSERT INTO test_scores VALUES("3601","166","144","4");
INSERT INTO test_scores VALUES("3602","166","22","4");
INSERT INTO test_scores VALUES("3603","166","117","6");
INSERT INTO test_scores VALUES("3604","166","125","6");
INSERT INTO test_scores VALUES("3605","166","121","0");
INSERT INTO test_scores VALUES("3606","166","73","2");
INSERT INTO test_scores VALUES("3607","166","33","6");
INSERT INTO test_scores VALUES("3608","166","177","4");
INSERT INTO test_scores VALUES("3609","166","127","4");
INSERT INTO test_scores VALUES("3610","166","123","4");
INSERT INTO test_scores VALUES("3611","166","213","0");
INSERT INTO test_scores VALUES("3612","166","143","4");
INSERT INTO test_scores VALUES("3613","166","122","2");
INSERT INTO test_scores VALUES("3614","166","119","4");
INSERT INTO test_scores VALUES("3615","166","215","0");
INSERT INTO test_scores VALUES("3616","166","178","2");
INSERT INTO test_scores VALUES("3617","166","135","2");
INSERT INTO test_scores VALUES("3618","166","142","4");
INSERT INTO test_scores VALUES("3619","166","166","6");
INSERT INTO test_scores VALUES("3620","166","72","6");
INSERT INTO test_scores VALUES("3621","166","66","0");
INSERT INTO test_scores VALUES("3622","166","37","6");
INSERT INTO test_scores VALUES("3623","166","145","2");
INSERT INTO test_scores VALUES("3624","163","3","6");
INSERT INTO test_scores VALUES("3625","164","3","6");
INSERT INTO test_scores VALUES("3626","165","3","6");
INSERT INTO test_scores VALUES("3627","166","3","6");
INSERT INTO test_scores VALUES("3628","167","36","3");
INSERT INTO test_scores VALUES("3629","167","12","4");
INSERT INTO test_scores VALUES("3630","167","161","1");
INSERT INTO test_scores VALUES("3631","167","171","3");
INSERT INTO test_scores VALUES("3632","167","143","3");
INSERT INTO test_scores VALUES("3633","167","178","3");
INSERT INTO test_scores VALUES("3634","167","159","2");
INSERT INTO test_scores VALUES("3635","167","146","0");
INSERT INTO test_scores VALUES("3636","167","73","6");
INSERT INTO test_scores VALUES("3637","167","124","2");
INSERT INTO test_scores VALUES("3638","167","147","4");
INSERT INTO test_scores VALUES("3639","167","144","6");
INSERT INTO test_scores VALUES("3640","167","145","2");
INSERT INTO test_scores VALUES("3641","167","125","6");
INSERT INTO test_scores VALUES("3642","167","117","6");
INSERT INTO test_scores VALUES("3643","167","121","6");
INSERT INTO test_scores VALUES("3644","167","177","2");
INSERT INTO test_scores VALUES("3645","167","72","2");
INSERT INTO test_scores VALUES("3646","167","37","6");
INSERT INTO test_scores VALUES("3647","167","40","6");
INSERT INTO test_scores VALUES("3648","167","122","3");
INSERT INTO test_scores VALUES("3649","167","119","2");
INSERT INTO test_scores VALUES("3650","167","213","0");
INSERT INTO test_scores VALUES("3651","167","215","3");
INSERT INTO test_scores VALUES("3652","167","123","2");
INSERT INTO test_scores VALUES("3653","167","135","3");
INSERT INTO test_scores VALUES("3654","167","127","6");
INSERT INTO test_scores VALUES("3655","167","142","3");
INSERT INTO test_scores VALUES("3656","168","161","0");
INSERT INTO test_scores VALUES("3657","168","171","0");
INSERT INTO test_scores VALUES("3658","168","12","4");
INSERT INTO test_scores VALUES("3659","168","36","6");
INSERT INTO test_scores VALUES("3660","168","143","0");
INSERT INTO test_scores VALUES("3661","168","178","6");
INSERT INTO test_scores VALUES("3662","168","146","0");
INSERT INTO test_scores VALUES("3663","168","159","0");
INSERT INTO test_scores VALUES("3664","168","135","0");
INSERT INTO test_scores VALUES("3665","168","123","5");
INSERT INTO test_scores VALUES("3666","168","127","1");
INSERT INTO test_scores VALUES("3667","168","142","6");
INSERT INTO test_scores VALUES("3668","168","122","3");
INSERT INTO test_scores VALUES("3669","168","213","0");
INSERT INTO test_scores VALUES("3670","168","215","2");
INSERT INTO test_scores VALUES("3671","168","73","6");
INSERT INTO test_scores VALUES("3672","168","40","6");
INSERT INTO test_scores VALUES("3673","168","37","3");
INSERT INTO test_scores VALUES("3674","168","72","0");
INSERT INTO test_scores VALUES("3675","168","125","6");
INSERT INTO test_scores VALUES("3676","168","117","5");
INSERT INTO test_scores VALUES("3677","168","124","4");
INSERT INTO test_scores VALUES("3678","168","177","1");
INSERT INTO test_scores VALUES("3679","168","121","5");
INSERT INTO test_scores VALUES("3680","168","144","6");
INSERT INTO test_scores VALUES("3681","168","147","4");
INSERT INTO test_scores VALUES("3682","168","145","0");
INSERT INTO test_scores VALUES("3683","169","12","6");
INSERT INTO test_scores VALUES("3684","169","36","4");
INSERT INTO test_scores VALUES("3685","169","146","0");
INSERT INTO test_scores VALUES("3686","169","143","4");
INSERT INTO test_scores VALUES("3687","169","178","6");
INSERT INTO test_scores VALUES("3688","169","159","0");
INSERT INTO test_scores VALUES("3689","169","135","3");
INSERT INTO test_scores VALUES("3690","169","123","6");
INSERT INTO test_scores VALUES("3691","169","142","6");
INSERT INTO test_scores VALUES("3692","169","127","5");
INSERT INTO test_scores VALUES("3693","169","73","6");
INSERT INTO test_scores VALUES("3694","169","40","6");
INSERT INTO test_scores VALUES("3695","169","37","6");
INSERT INTO test_scores VALUES("3696","169","72","6");
INSERT INTO test_scores VALUES("3697","169","177","0");
INSERT INTO test_scores VALUES("3698","169","147","4");
INSERT INTO test_scores VALUES("3699","169","144","6");
INSERT INTO test_scores VALUES("3700","169","145","3");
INSERT INTO test_scores VALUES("3701","169","124","6");
INSERT INTO test_scores VALUES("3702","169","125","4");
INSERT INTO test_scores VALUES("3703","169","117","4");
INSERT INTO test_scores VALUES("3704","169","121","6");
INSERT INTO test_scores VALUES("3705","169","119","6");
INSERT INTO test_scores VALUES("3706","169","122","4");
INSERT INTO test_scores VALUES("3707","169","213","0");
INSERT INTO test_scores VALUES("3708","169","215","3");
INSERT INTO test_scores VALUES("3709","170","12","3");
INSERT INTO test_scores VALUES("3710","170","36","1");
INSERT INTO test_scores VALUES("3711","170","72","2");
INSERT INTO test_scores VALUES("3712","170","37","3");
INSERT INTO test_scores VALUES("3713","170","73","1");
INSERT INTO test_scores VALUES("3714","170","40","2");
INSERT INTO test_scores VALUES("3715","170","146","0");
INSERT INTO test_scores VALUES("3716","170","159","0");
INSERT INTO test_scores VALUES("3717","170","143","0");
INSERT INTO test_scores VALUES("3718","170","178","0");
INSERT INTO test_scores VALUES("3719","170","135","0");
INSERT INTO test_scores VALUES("3720","170","123","1");
INSERT INTO test_scores VALUES("3721","170","127","0");
INSERT INTO test_scores VALUES("3722","170","142","0");
INSERT INTO test_scores VALUES("3723","170","122","0");
INSERT INTO test_scores VALUES("3724","170","119","1");
INSERT INTO test_scores VALUES("3725","170","213","0");
INSERT INTO test_scores VALUES("3726","170","215","1");
INSERT INTO test_scores VALUES("3727","170","125","1");
INSERT INTO test_scores VALUES("3728","170","124","1");
INSERT INTO test_scores VALUES("3729","170","177","0");
INSERT INTO test_scores VALUES("3730","170","117","1");
INSERT INTO test_scores VALUES("3731","170","121","3");
INSERT INTO test_scores VALUES("3732","170","147","1");
INSERT INTO test_scores VALUES("3733","170","144","2");
INSERT INTO test_scores VALUES("3734","170","145","0");
INSERT INTO test_scores VALUES("3735","167","3","6");
INSERT INTO test_scores VALUES("3736","168","3","6");
INSERT INTO test_scores VALUES("3737","169","3","6");
INSERT INTO test_scores VALUES("3738","170","3","6");
INSERT INTO test_scores VALUES("3739","167","6","6");
INSERT INTO test_scores VALUES("3740","168","6","6");
INSERT INTO test_scores VALUES("3741","169","6","6");
INSERT INTO test_scores VALUES("3742","170","6","3");
INSERT INTO test_scores VALUES("3743","167","22","6");
INSERT INTO test_scores VALUES("3744","168","22","6");
INSERT INTO test_scores VALUES("3745","169","22","6");
INSERT INTO test_scores VALUES("3746","170","22","3");
INSERT INTO test_scores VALUES("3747","172","37","6");
INSERT INTO test_scores VALUES("3748","172","161","2");
INSERT INTO test_scores VALUES("3749","172","149","2");
INSERT INTO test_scores VALUES("3750","172","40","4");
INSERT INTO test_scores VALUES("3751","172","67","6");
INSERT INTO test_scores VALUES("3752","172","159","4");
INSERT INTO test_scores VALUES("3753","172","128","2");
INSERT INTO test_scores VALUES("3754","172","124","6");
INSERT INTO test_scores VALUES("3755","172","31","6");
INSERT INTO test_scores VALUES("3756","172","127","6");
INSERT INTO test_scores VALUES("3757","172","215","2");
INSERT INTO test_scores VALUES("3758","172","123","2");
INSERT INTO test_scores VALUES("3759","172","135","4");
INSERT INTO test_scores VALUES("3760","172","142","6");
INSERT INTO test_scores VALUES("3761","172","119","4");
INSERT INTO test_scores VALUES("3762","172","178","2");
INSERT INTO test_scores VALUES("3763","172","122","4");
INSERT INTO test_scores VALUES("3764","172","55","4");
INSERT INTO test_scores VALUES("3765","172","147","6");
INSERT INTO test_scores VALUES("3766","172","144","6");
INSERT INTO test_scores VALUES("3767","172","145","4");
INSERT INTO test_scores VALUES("3768","172","177","6");
INSERT INTO test_scores VALUES("3769","172","117","6");
INSERT INTO test_scores VALUES("3770","172","125","6");
INSERT INTO test_scores VALUES("3771","172","73","6");
INSERT INTO test_scores VALUES("3772","172","120","6");
INSERT INTO test_scores VALUES("3773","172","121","6");
INSERT INTO test_scores VALUES("3774","172","22","6");
INSERT INTO test_scores VALUES("3775","172","72","4");
INSERT INTO test_scores VALUES("3776","172","146","2");
INSERT INTO test_scores VALUES("3777","172","66","6");
INSERT INTO test_scores VALUES("3778","171","146","0");
INSERT INTO test_scores VALUES("3779","171","72","1");
INSERT INTO test_scores VALUES("3780","171","22","0");
INSERT INTO test_scores VALUES("3781","171","121","1");
INSERT INTO test_scores VALUES("3782","171","120","1");
INSERT INTO test_scores VALUES("3783","171","73","0");
INSERT INTO test_scores VALUES("3784","171","125","1");
INSERT INTO test_scores VALUES("3785","171","117","1");
INSERT INTO test_scores VALUES("3786","171","177","0");
INSERT INTO test_scores VALUES("3787","171","145","1");
INSERT INTO test_scores VALUES("3788","171","144","1");
INSERT INTO test_scores VALUES("3789","171","147","1");
INSERT INTO test_scores VALUES("3790","171","55","0");
INSERT INTO test_scores VALUES("3791","171","122","0");
INSERT INTO test_scores VALUES("3792","171","178","1");
INSERT INTO test_scores VALUES("3793","171","119","1");
INSERT INTO test_scores VALUES("3794","171","142","1");
INSERT INTO test_scores VALUES("3795","171","135","0");
INSERT INTO test_scores VALUES("3796","171","123","1");
INSERT INTO test_scores VALUES("3797","171","215","0");
INSERT INTO test_scores VALUES("3798","171","127","1");
INSERT INTO test_scores VALUES("3799","171","31","0");
INSERT INTO test_scores VALUES("3800","171","124","1");
INSERT INTO test_scores VALUES("3801","171","128","1");
INSERT INTO test_scores VALUES("3802","171","159","0");
INSERT INTO test_scores VALUES("3803","171","67","1");
INSERT INTO test_scores VALUES("3804","171","40","0");
INSERT INTO test_scores VALUES("3805","171","149","1");
INSERT INTO test_scores VALUES("3806","171","161","0");
INSERT INTO test_scores VALUES("3807","171","37","0");
INSERT INTO test_scores VALUES("3808","171","66","0");
INSERT INTO test_scores VALUES("3809","173","122","2");
INSERT INTO test_scores VALUES("3810","173","178","6");
INSERT INTO test_scores VALUES("3811","173","119","2");
INSERT INTO test_scores VALUES("3812","173","142","4");
INSERT INTO test_scores VALUES("3813","173","123","4");
INSERT INTO test_scores VALUES("3814","173","135","4");
INSERT INTO test_scores VALUES("3815","173","31","2");
INSERT INTO test_scores VALUES("3816","173","127","4");
INSERT INTO test_scores VALUES("3817","173","215","2");
INSERT INTO test_scores VALUES("3818","173","72","2");
INSERT INTO test_scores VALUES("3819","173","146","2");
INSERT INTO test_scores VALUES("3820","173","66","6");
INSERT INTO test_scores VALUES("3821","173","37","4");
INSERT INTO test_scores VALUES("3822","173","73","4");
INSERT INTO test_scores VALUES("3823","173","120","4");
INSERT INTO test_scores VALUES("3824","173","121","6");
INSERT INTO test_scores VALUES("3825","173","22","4");
INSERT INTO test_scores VALUES("3826","173","125","6");
INSERT INTO test_scores VALUES("3827","173","117","4");
INSERT INTO test_scores VALUES("3828","173","177","2");
INSERT INTO test_scores VALUES("3829","173","55","6");
INSERT INTO test_scores VALUES("3830","173","147","4");
INSERT INTO test_scores VALUES("3831","173","144","6");
INSERT INTO test_scores VALUES("3832","173","145","2");
INSERT INTO test_scores VALUES("3833","173","149","4");
INSERT INTO test_scores VALUES("3834","173","161","2");
INSERT INTO test_scores VALUES("3835","173","124","4");
INSERT INTO test_scores VALUES("3836","173","40","6");
INSERT INTO test_scores VALUES("3837","173","128","0");
INSERT INTO test_scores VALUES("3838","173","67","6");
INSERT INTO test_scores VALUES("3839","173","159","2");
INSERT INTO test_scores VALUES("3840","174","119","4");
INSERT INTO test_scores VALUES("3841","174","122","2");
INSERT INTO test_scores VALUES("3842","174","123","2");
INSERT INTO test_scores VALUES("3843","174","135","0");
INSERT INTO test_scores VALUES("3844","174","142","2");
INSERT INTO test_scores VALUES("3845","174","31","0");
INSERT INTO test_scores VALUES("3846","174","127","4");
INSERT INTO test_scores VALUES("3847","174","215","0");
INSERT INTO test_scores VALUES("3848","174","146","0");
INSERT INTO test_scores VALUES("3849","174","66","2");
INSERT INTO test_scores VALUES("3850","174","37","6");
INSERT INTO test_scores VALUES("3851","174","72","4");
INSERT INTO test_scores VALUES("3852","174","73","6");
INSERT INTO test_scores VALUES("3853","174","120","4");
INSERT INTO test_scores VALUES("3854","174","121","4");
INSERT INTO test_scores VALUES("3855","174","55","2");
INSERT INTO test_scores VALUES("3856","174","147","4");
INSERT INTO test_scores VALUES("3857","174","144","4");
INSERT INTO test_scores VALUES("3858","174","145","2");
INSERT INTO test_scores VALUES("3859","174","177","0");
INSERT INTO test_scores VALUES("3860","174","125","6");
INSERT INTO test_scores VALUES("3861","174","22","6");
INSERT INTO test_scores VALUES("3862","174","117","6");
INSERT INTO test_scores VALUES("3863","174","67","4");
INSERT INTO test_scores VALUES("3864","174","124","4");
INSERT INTO test_scores VALUES("3865","174","109","0");
INSERT INTO test_scores VALUES("3866","174","161","0");
INSERT INTO test_scores VALUES("3867","174","40","6");
INSERT INTO test_scores VALUES("3868","174","128","0");
INSERT INTO test_scores VALUES("3869","174","159","0");
INSERT INTO test_scores VALUES("3870","174","149","0");
INSERT INTO test_scores VALUES("3871","174","178","2");
INSERT INTO test_scores VALUES("3872","175","125","6");
INSERT INTO test_scores VALUES("3873","175","22","6");
INSERT INTO test_scores VALUES("3874","175","178","4");
INSERT INTO test_scores VALUES("3875","175","122","0");
INSERT INTO test_scores VALUES("3876","175","135","0");
INSERT INTO test_scores VALUES("3877","175","123","0");
INSERT INTO test_scores VALUES("3878","175","142","4");
INSERT INTO test_scores VALUES("3879","175","31","2");
INSERT INTO test_scores VALUES("3880","175","127","6");
INSERT INTO test_scores VALUES("3881","175","215","4");
INSERT INTO test_scores VALUES("3882","175","72","2");
INSERT INTO test_scores VALUES("3883","175","37","6");
INSERT INTO test_scores VALUES("3884","175","66","6");
INSERT INTO test_scores VALUES("3885","175","146","0");
INSERT INTO test_scores VALUES("3886","175","73","4");
INSERT INTO test_scores VALUES("3887","175","120","6");
INSERT INTO test_scores VALUES("3888","175","121","4");
INSERT INTO test_scores VALUES("3889","175","117","6");
INSERT INTO test_scores VALUES("3890","175","177","0");
INSERT INTO test_scores VALUES("3891","175","144","6");
INSERT INTO test_scores VALUES("3892","175","55","6");
INSERT INTO test_scores VALUES("3893","175","147","6");
INSERT INTO test_scores VALUES("3894","175","145","2");
INSERT INTO test_scores VALUES("3895","175","67","6");
INSERT INTO test_scores VALUES("3896","175","124","6");
INSERT INTO test_scores VALUES("3897","175","149","0");
INSERT INTO test_scores VALUES("3898","175","161","0");
INSERT INTO test_scores VALUES("3899","175","40","6");
INSERT INTO test_scores VALUES("3900","175","128","0");
INSERT INTO test_scores VALUES("3901","175","159","2");
INSERT INTO test_scores VALUES("3902","175","119","6");
INSERT INTO test_scores VALUES("3903","171","143","1");
INSERT INTO test_scores VALUES("3904","171","213","1");
INSERT INTO test_scores VALUES("3905","172","6","6");
INSERT INTO test_scores VALUES("3906","172","3","6");
INSERT INTO test_scores VALUES("3907","173","6","4");
INSERT INTO test_scores VALUES("3908","173","3","4");
INSERT INTO test_scores VALUES("3909","174","6","4");
INSERT INTO test_scores VALUES("3910","174","3","6");
INSERT INTO test_scores VALUES("3911","175","3","4");
INSERT INTO test_scores VALUES("3912","175","6","6");
INSERT INTO test_scores VALUES("3913","171","6","1");
INSERT INTO test_scores VALUES("3914","171","12","1");
INSERT INTO test_scores VALUES("3915","171","3","1");
INSERT INTO test_scores VALUES("3916","171","33","1");
INSERT INTO test_scores VALUES("3917","171","36","1");
INSERT INTO test_scores VALUES("3918","176","145","2");
INSERT INTO test_scores VALUES("3919","176","121","4");
INSERT INTO test_scores VALUES("3920","176","22","2");
INSERT INTO test_scores VALUES("3921","176","177","2");
INSERT INTO test_scores VALUES("3922","176","117","2");
INSERT INTO test_scores VALUES("3923","176","125","4");
INSERT INTO test_scores VALUES("3924","176","147","2");
INSERT INTO test_scores VALUES("3925","176","144","4");
INSERT INTO test_scores VALUES("3926","176","73","4");
INSERT INTO test_scores VALUES("3927","176","72","2");
INSERT INTO test_scores VALUES("3928","176","127","4");
INSERT INTO test_scores VALUES("3929","176","31","4");
INSERT INTO test_scores VALUES("3930","176","37","6");
INSERT INTO test_scores VALUES("3931","176","122","4");
INSERT INTO test_scores VALUES("3932","176","123","4");
INSERT INTO test_scores VALUES("3933","176","166","4");
INSERT INTO test_scores VALUES("3934","176","142","4");
INSERT INTO test_scores VALUES("3935","176","143","4");
INSERT INTO test_scores VALUES("3936","176","159","2");
INSERT INTO test_scores VALUES("3937","176","178","0");
INSERT INTO test_scores VALUES("3938","176","66","2");
INSERT INTO test_scores VALUES("3939","176","124","2");
INSERT INTO test_scores VALUES("3940","176","149","0");
INSERT INTO test_scores VALUES("3941","176","215","2");
INSERT INTO test_scores VALUES("3942","176","40","4");
INSERT INTO test_scores VALUES("3943","176","128","0");
INSERT INTO test_scores VALUES("3944","176","6","6");
INSERT INTO test_scores VALUES("3945","177","6","2");
INSERT INTO test_scores VALUES("3946","177","215","0");
INSERT INTO test_scores VALUES("3947","177","40","0");
INSERT INTO test_scores VALUES("3948","177","149","0");
INSERT INTO test_scores VALUES("3949","177","128","0");
INSERT INTO test_scores VALUES("3950","177","31","0");
INSERT INTO test_scores VALUES("3951","177","213","0");
INSERT INTO test_scores VALUES("3952","177","143","0");
INSERT INTO test_scores VALUES("3953","177","159","0");
INSERT INTO test_scores VALUES("3954","177","178","0");
INSERT INTO test_scores VALUES("3955","177","123","0");
INSERT INTO test_scores VALUES("3956","177","166","0");
INSERT INTO test_scores VALUES("3957","177","122","0");
INSERT INTO test_scores VALUES("3958","177","142","0");
INSERT INTO test_scores VALUES("3959","177","72","4");
INSERT INTO test_scores VALUES("3960","177","66","2");
INSERT INTO test_scores VALUES("3961","177","127","0");
INSERT INTO test_scores VALUES("3962","177","33","2");
INSERT INTO test_scores VALUES("3963","177","145","0");
INSERT INTO test_scores VALUES("3964","177","37","2");
INSERT INTO test_scores VALUES("3965","177","22","2");
INSERT INTO test_scores VALUES("3966","177","124","2");
INSERT INTO test_scores VALUES("3967","177","121","0");
INSERT INTO test_scores VALUES("3968","177","125","0");
INSERT INTO test_scores VALUES("3969","177","177","0");
INSERT INTO test_scores VALUES("3970","177","117","0");
INSERT INTO test_scores VALUES("3971","177","73","4");
INSERT INTO test_scores VALUES("3972","177","147","2");
INSERT INTO test_scores VALUES("3973","177","144","0");
INSERT INTO test_scores VALUES("3974","176","3","6");
INSERT INTO test_scores VALUES("3975","177","3","2");
INSERT INTO test_scores VALUES("3976","181","149","6");
INSERT INTO test_scores VALUES("3977","181","161","2");
INSERT INTO test_scores VALUES("3978","181","6","3");
INSERT INTO test_scores VALUES("3979","181","118","1");
INSERT INTO test_scores VALUES("3980","181","122","3");
INSERT INTO test_scores VALUES("3981","181","213","3");
INSERT INTO test_scores VALUES("3982","181","143","3");
INSERT INTO test_scores VALUES("3983","181","123","1");
INSERT INTO test_scores VALUES("3984","181","135","1");
INSERT INTO test_scores VALUES("3985","181","127","3");
INSERT INTO test_scores VALUES("3986","181","142","1");
INSERT INTO test_scores VALUES("3987","181","72","3");
INSERT INTO test_scores VALUES("3988","181","66","3");
INSERT INTO test_scores VALUES("3989","181","33","3");
INSERT INTO test_scores VALUES("3990","181","31","3");
INSERT INTO test_scores VALUES("3991","181","37","3");
INSERT INTO test_scores VALUES("3992","181","121","3");
INSERT INTO test_scores VALUES("3993","181","124","3");
INSERT INTO test_scores VALUES("3994","181","145","3");
INSERT INTO test_scores VALUES("3995","181","73","3");
INSERT INTO test_scores VALUES("3996","181","177","1");
INSERT INTO test_scores VALUES("3997","181","125","3");
INSERT INTO test_scores VALUES("3998","181","144","3");
INSERT INTO test_scores VALUES("3999","181","22","1");
INSERT INTO test_scores VALUES("4000","181","147","3");
INSERT INTO test_scores VALUES("4001","182","118","1");
INSERT INTO test_scores VALUES("4002","182","213","2");
INSERT INTO test_scores VALUES("4003","182","143","2");
INSERT INTO test_scores VALUES("4004","182","122","2");
INSERT INTO test_scores VALUES("4005","182","123","3");
INSERT INTO test_scores VALUES("4006","182","135","0");
INSERT INTO test_scores VALUES("4007","182","127","4");
INSERT INTO test_scores VALUES("4008","182","142","2");
INSERT INTO test_scores VALUES("4098","188","12","6");
INSERT INTO test_scores VALUES("4010","182","145","2");
INSERT INTO test_scores VALUES("4011","182","124","6");
INSERT INTO test_scores VALUES("4012","182","31","1");
INSERT INTO test_scores VALUES("4013","182","33","6");
INSERT INTO test_scores VALUES("4097","188","146","0");
INSERT INTO test_scores VALUES("4015","182","66","2");
INSERT INTO test_scores VALUES("4016","182","72","2");
INSERT INTO test_scores VALUES("4017","182","37","6");
INSERT INTO test_scores VALUES("4018","182","121","0");
INSERT INTO test_scores VALUES("4019","182","22","3");
INSERT INTO test_scores VALUES("4020","182","144","6");
INSERT INTO test_scores VALUES("4021","182","117","5");
INSERT INTO test_scores VALUES("4022","182","147","3");
INSERT INTO test_scores VALUES("4023","182","73","6");
INSERT INTO test_scores VALUES("4024","182","177","0");
INSERT INTO test_scores VALUES("4025","182","125","6");
INSERT INTO test_scores VALUES("4026","182","6","6");
INSERT INTO test_scores VALUES("4027","182","161","0");
INSERT INTO test_scores VALUES("4028","182","149","0");
INSERT INTO test_scores VALUES("4029","184","6","4");
INSERT INTO test_scores VALUES("4030","184","149","0");
INSERT INTO test_scores VALUES("4031","184","22","3");
INSERT INTO test_scores VALUES("4032","184","73","2");
INSERT INTO test_scores VALUES("4033","184","125","0");
INSERT INTO test_scores VALUES("4034","184","177","0");
INSERT INTO test_scores VALUES("4035","184","117","1");
INSERT INTO test_scores VALUES("4036","184","147","0");
INSERT INTO test_scores VALUES("4037","184","144","2");
INSERT INTO test_scores VALUES("4038","184","124","3");
INSERT INTO test_scores VALUES("4039","184","145","0");
INSERT INTO test_scores VALUES("4040","184","121","1");
INSERT INTO test_scores VALUES("4041","184","72","2");
INSERT INTO test_scores VALUES("4042","184","33","3");
INSERT INTO test_scores VALUES("4043","184","37","5");
INSERT INTO test_scores VALUES("4044","184","66","2");
INSERT INTO test_scores VALUES("4045","184","142","0");
INSERT INTO test_scores VALUES("4046","184","123","1");
INSERT INTO test_scores VALUES("4047","184","135","0");
INSERT INTO test_scores VALUES("4048","184","127","1");
INSERT INTO test_scores VALUES("4049","184","122","0");
INSERT INTO test_scores VALUES("4050","184","213","1");
INSERT INTO test_scores VALUES("4051","184","143","5");
INSERT INTO test_scores VALUES("4052","185","67","3");
INSERT INTO test_scores VALUES("4053","187","73","0");
INSERT INTO test_scores VALUES("4054","187","143","0");
INSERT INTO test_scores VALUES("4055","187","165","5");
INSERT INTO test_scores VALUES("4056","187","22","5");
INSERT INTO test_scores VALUES("4057","187","147","1");
INSERT INTO test_scores VALUES("4058","187","121","3");
INSERT INTO test_scores VALUES("4059","187","72","3");
INSERT INTO test_scores VALUES("4060","187","124","3");
INSERT INTO test_scores VALUES("4061","187","142","0");
INSERT INTO test_scores VALUES("4062","187","122","0");
INSERT INTO test_scores VALUES("4063","187","215","0");
INSERT INTO test_scores VALUES("4064","187","123","0");
INSERT INTO test_scores VALUES("4065","187","127","0");
INSERT INTO test_scores VALUES("4066","187","67","3");
INSERT INTO test_scores VALUES("4067","185","72","6");
INSERT INTO test_scores VALUES("4068","185","165","6");
INSERT INTO test_scores VALUES("4069","185","73","6");
INSERT INTO test_scores VALUES("4070","185","147","6");
INSERT INTO test_scores VALUES("4071","185","22","6");
INSERT INTO test_scores VALUES("4072","185","124","6");
INSERT INTO test_scores VALUES("4073","185","121","6");
INSERT INTO test_scores VALUES("4074","185","215","3");
INSERT INTO test_scores VALUES("4075","185","143","4");
INSERT INTO test_scores VALUES("4076","185","123","3");
INSERT INTO test_scores VALUES("4077","185","127","4");
INSERT INTO test_scores VALUES("4078","185","142","6");
INSERT INTO test_scores VALUES("4079","185","122","3");
INSERT INTO test_scores VALUES("4080","186","22","2");
INSERT INTO test_scores VALUES("4081","186","147","0");
INSERT INTO test_scores VALUES("4082","186","73","6");
INSERT INTO test_scores VALUES("4083","186","165","3");
INSERT INTO test_scores VALUES("4084","186","67","1");
INSERT INTO test_scores VALUES("4085","186","121","3");
INSERT INTO test_scores VALUES("4086","186","124","4");
INSERT INTO test_scores VALUES("4087","186","72","1");
INSERT INTO test_scores VALUES("4088","186","215","0");
INSERT INTO test_scores VALUES("4089","186","122","2");
INSERT INTO test_scores VALUES("4090","186","142","2");
INSERT INTO test_scores VALUES("4091","186","127","0");
INSERT INTO test_scores VALUES("4092","186","123","2");
INSERT INTO test_scores VALUES("4093","186","143","0");
INSERT INTO test_scores VALUES("4094","187","37","4");
INSERT INTO test_scores VALUES("4095","186","37","6");
INSERT INTO test_scores VALUES("4096","185","37","6");
INSERT INTO test_scores VALUES("4099","188","215","5");
INSERT INTO test_scores VALUES("4100","188","143","6");
INSERT INTO test_scores VALUES("4101","188","135","0");
INSERT INTO test_scores VALUES("4102","188","122","5");
INSERT INTO test_scores VALUES("4103","188","127","1");
INSERT INTO test_scores VALUES("4104","188","142","5");
INSERT INTO test_scores VALUES("4105","188","31","1");
INSERT INTO test_scores VALUES("4106","188","119","5");
INSERT INTO test_scores VALUES("4107","188","117","4");
INSERT INTO test_scores VALUES("4108","188","124","1");
INSERT INTO test_scores VALUES("4109","188","147","4");
INSERT INTO test_scores VALUES("4110","188","72","4");
INSERT INTO test_scores VALUES("4111","188","121","3");
INSERT INTO test_scores VALUES("4112","188","177","5");
INSERT INTO test_scores VALUES("4113","188","165","4");
INSERT INTO test_scores VALUES("4114","189","72","6");
INSERT INTO test_scores VALUES("4115","189","165","3");
INSERT INTO test_scores VALUES("4116","189","147","5");
INSERT INTO test_scores VALUES("4117","189","124","4");
INSERT INTO test_scores VALUES("4118","189","12","6");
INSERT INTO test_scores VALUES("4119","189","146","0");
INSERT INTO test_scores VALUES("4120","189","215","1");
INSERT INTO test_scores VALUES("4121","189","143","1");
INSERT INTO test_scores VALUES("4122","189","135","0");
INSERT INTO test_scores VALUES("4123","189","122","4");
INSERT INTO test_scores VALUES("4124","189","127","4");
INSERT INTO test_scores VALUES("4125","189","142","0");
INSERT INTO test_scores VALUES("4126","189","31","4");
INSERT INTO test_scores VALUES("4127","189","119","0");
INSERT INTO test_scores VALUES("4128","189","117","4");
INSERT INTO test_scores VALUES("4129","189","121","1");
INSERT INTO test_scores VALUES("4130","189","177","1");
INSERT INTO test_scores VALUES("4131","185","6","6");
INSERT INTO test_scores VALUES("4132","186","6","3");
INSERT INTO test_scores VALUES("4133","187","6","6");
INSERT INTO test_scores VALUES("4134","188","22","3");
INSERT INTO test_scores VALUES("4135","189","22","0");
INSERT INTO test_scores VALUES("4136","181","165","3");
INSERT INTO test_scores VALUES("4137","182","165","6");
INSERT INTO test_scores VALUES("4138","184","165","1");
INSERT INTO test_scores VALUES("4140","196","122","6");
INSERT INTO test_scores VALUES("4141","196","119","3");
INSERT INTO test_scores VALUES("4142","196","215","3");
INSERT INTO test_scores VALUES("4143","196","127","6");
INSERT INTO test_scores VALUES("4144","196","143","6");
INSERT INTO test_scores VALUES("4145","196","72","6");
INSERT INTO test_scores VALUES("4146","196","146","1");
INSERT INTO test_scores VALUES("4147","196","36","3");
INSERT INTO test_scores VALUES("4148","196","121","3");
INSERT INTO test_scores VALUES("4149","196","124","5");
INSERT INTO test_scores VALUES("4150","196","177","3");
INSERT INTO test_scores VALUES("4151","196","22","6");
INSERT INTO test_scores VALUES("4152","196","3","6");
INSERT INTO test_scores VALUES("4153","196","73","6");
INSERT INTO test_scores VALUES("4154","197","215","1");
INSERT INTO test_scores VALUES("4155","197","127","3");
INSERT INTO test_scores VALUES("4156","197","143","3");
INSERT INTO test_scores VALUES("4157","197","119","1");
INSERT INTO test_scores VALUES("4158","197","122","1");
INSERT INTO test_scores VALUES("4159","197","142","1");
INSERT INTO test_scores VALUES("4160","197","146","0");
INSERT INTO test_scores VALUES("4161","197","36","3");
INSERT INTO test_scores VALUES("4162","197","72","1");
INSERT INTO test_scores VALUES("4163","197","124","6");
INSERT INTO test_scores VALUES("4164","197","121","6");
INSERT INTO test_scores VALUES("4165","197","177","1");
INSERT INTO test_scores VALUES("4166","197","22","4");
INSERT INTO test_scores VALUES("4167","197","73","6");
INSERT INTO test_scores VALUES("4168","197","3","6");
INSERT INTO test_scores VALUES("4169","198","73","4");
INSERT INTO test_scores VALUES("4170","198","177","0");
INSERT INTO test_scores VALUES("4171","198","22","6");
INSERT INTO test_scores VALUES("4172","198","146","0");
INSERT INTO test_scores VALUES("4173","198","36","1");
INSERT INTO test_scores VALUES("4174","198","119","0");
INSERT INTO test_scores VALUES("4175","198","142","1");
INSERT INTO test_scores VALUES("4176","198","122","0");
INSERT INTO test_scores VALUES("4177","198","215","0");
INSERT INTO test_scores VALUES("4178","198","127","1");
INSERT INTO test_scores VALUES("4179","198","143","0");
INSERT INTO test_scores VALUES("4180","198","124","6");
INSERT INTO test_scores VALUES("4181","198","121","2");
INSERT INTO test_scores VALUES("4182","198","3","0");
INSERT INTO test_scores VALUES("4183","198","72","0");
INSERT INTO test_scores VALUES("4184","199","215","0");
INSERT INTO test_scores VALUES("4185","199","127","0");
INSERT INTO test_scores VALUES("4186","199","143","0");
INSERT INTO test_scores VALUES("4187","199","142","3");
INSERT INTO test_scores VALUES("4188","199","119","4");
INSERT INTO test_scores VALUES("4189","199","122","0");
INSERT INTO test_scores VALUES("4190","199","146","0");
INSERT INTO test_scores VALUES("4191","199","36","0");
INSERT INTO test_scores VALUES("4192","199","177","0");
INSERT INTO test_scores VALUES("4193","199","124","6");
INSERT INTO test_scores VALUES("4194","199","72","5");
INSERT INTO test_scores VALUES("4195","199","121","2");
INSERT INTO test_scores VALUES("4196","199","22","2");
INSERT INTO test_scores VALUES("4197","199","3","1");
INSERT INTO test_scores VALUES("4198","199","73","1");
INSERT INTO test_scores VALUES("4199","200","33","20");
INSERT INTO test_scores VALUES("4200","201","33","1");
INSERT INTO test_scores VALUES("4201","201","22","1");
INSERT INTO test_scores VALUES("4202","201","37","1");
INSERT INTO test_scores VALUES("4204","200","199","7");
INSERT INTO test_scores VALUES("4205","200","196","4");
INSERT INTO test_scores VALUES("4206","200","143","10");
INSERT INTO test_scores VALUES("4207","200","200","0");
INSERT INTO test_scores VALUES("4208","200","73","6");
INSERT INTO test_scores VALUES("4209","200","122","3");
INSERT INTO test_scores VALUES("4210","200","72","8");
INSERT INTO test_scores VALUES("4211","200","36","9");
INSERT INTO test_scores VALUES("4212","200","117","4");
INSERT INTO test_scores VALUES("4213","200","201","3");
INSERT INTO test_scores VALUES("4214","200","202","4");
INSERT INTO test_scores VALUES("4215","200","203","4");
INSERT INTO test_scores VALUES("4216","200","206","7");
INSERT INTO test_scores VALUES("4217","201","203","1");
INSERT INTO test_scores VALUES("4218","201","202","1");
INSERT INTO test_scores VALUES("4219","201","201","1");
INSERT INTO test_scores VALUES("4220","201","117","1");
INSERT INTO test_scores VALUES("4221","201","36","1");
INSERT INTO test_scores VALUES("4222","201","72","1");
INSERT INTO test_scores VALUES("4223","201","122","1");
INSERT INTO test_scores VALUES("4224","201","73","1");
INSERT INTO test_scores VALUES("4225","201","200","1");
INSERT INTO test_scores VALUES("4226","201","143","1");
INSERT INTO test_scores VALUES("4227","201","196","1");
INSERT INTO test_scores VALUES("4228","201","199","1");
INSERT INTO test_scores VALUES("4230","201","211","1");
INSERT INTO test_scores VALUES("4231","201","212","1");
INSERT INTO test_scores VALUES("4232","201","216","1");
INSERT INTO test_scores VALUES("4233","200","216","6");
INSERT INTO test_scores VALUES("4234","200","212","5");
INSERT INTO test_scores VALUES("4235","200","211","6");
INSERT INTO test_scores VALUES("4236","200","67","8");
INSERT INTO test_scores VALUES("4237","200","204","8");
INSERT INTO test_scores VALUES("4238","200","119","7");
INSERT INTO test_scores VALUES("4239","200","124","8");
INSERT INTO test_scores VALUES("4240","200","205","8");
INSERT INTO test_scores VALUES("4241","200","159","0");
INSERT INTO test_scores VALUES("4242","200","125","6");
INSERT INTO test_scores VALUES("4243","200","177","1");
INSERT INTO test_scores VALUES("4244","200","142","3");
INSERT INTO test_scores VALUES("4245","200","215","1");
INSERT INTO test_scores VALUES("4246","200","213","2");
INSERT INTO test_scores VALUES("4247","200","197","2");
INSERT INTO test_scores VALUES("4248","200","147","8");
INSERT INTO test_scores VALUES("4249","200","145","4");
INSERT INTO test_scores VALUES("4250","200","121","8");
INSERT INTO test_scores VALUES("4251","200","66","6");
INSERT INTO test_scores VALUES("4252","200","120","8");
INSERT INTO test_scores VALUES("4253","201","120","1");
INSERT INTO test_scores VALUES("4254","201","66","1");
INSERT INTO test_scores VALUES("4255","200","210","3");
INSERT INTO test_scores VALUES("4256","201","210","0");
INSERT INTO test_scores VALUES("4257","201","121","1");
INSERT INTO test_scores VALUES("4258","201","145","1");
INSERT INTO test_scores VALUES("4259","201","147","1");
INSERT INTO test_scores VALUES("4260","201","197","1");
INSERT INTO test_scores VALUES("4261","201","213","1");
INSERT INTO test_scores VALUES("4262","201","142","1");
INSERT INTO test_scores VALUES("4263","201","125","1");
INSERT INTO test_scores VALUES("4264","201","159","1");
INSERT INTO test_scores VALUES("4265","201","205","1");
INSERT INTO test_scores VALUES("4266","201","119","1");
INSERT INTO test_scores VALUES("4267","201","67","1");
INSERT INTO test_scores VALUES("4268","201","118","1");
INSERT INTO test_scores VALUES("4269","201","6","1");
INSERT INTO test_scores VALUES("4270","201","206","1");
INSERT INTO test_scores VALUES("4271","200","217","7");
INSERT INTO test_scores VALUES("4272","201","217","1");
INSERT INTO test_scores VALUES("4273","202","73","2");
INSERT INTO test_scores VALUES("4274","202","122","2");
INSERT INTO test_scores VALUES("4275","202","121","2");
INSERT INTO test_scores VALUES("4276","202","202","4");
INSERT INTO test_scores VALUES("4277","202","213","2");
INSERT INTO test_scores VALUES("4278","202","215","2");
INSERT INTO test_scores VALUES("4279","202","145","2");
INSERT INTO test_scores VALUES("4280","202","119","2");
INSERT INTO test_scores VALUES("4281","202","118","2");
INSERT INTO test_scores VALUES("4282","202","143","4");
INSERT INTO test_scores VALUES("4283","202","197","2");
INSERT INTO test_scores VALUES("4392","205","222","0");
INSERT INTO test_scores VALUES("4285","202","196","2");
INSERT INTO test_scores VALUES("4286","202","120","2");
INSERT INTO test_scores VALUES("4287","202","205","4");
INSERT INTO test_scores VALUES("4288","202","147","2");
INSERT INTO test_scores VALUES("4289","202","217","4");
INSERT INTO test_scores VALUES("4290","202","125","4");
INSERT INTO test_scores VALUES("4291","202","204","4");
INSERT INTO test_scores VALUES("4292","202","199","2");
INSERT INTO test_scores VALUES("4293","202","216","4");
INSERT INTO test_scores VALUES("4294","202","72","2");
INSERT INTO test_scores VALUES("4295","202","55","2");
INSERT INTO test_scores VALUES("4296","202","206","0");
INSERT INTO test_scores VALUES("4297","203","143","6");
INSERT INTO test_scores VALUES("4391","202","221","0");
INSERT INTO test_scores VALUES("4299","203","55","6");
INSERT INTO test_scores VALUES("4300","203","73","6");
INSERT INTO test_scores VALUES("4301","203","122","6");
INSERT INTO test_scores VALUES("4302","203","200","2");
INSERT INTO test_scores VALUES("4303","203","219","0");
INSERT INTO test_scores VALUES("4304","203","204","6");
INSERT INTO test_scores VALUES("4305","203","216","6");
INSERT INTO test_scores VALUES("4306","203","197","4");
INSERT INTO test_scores VALUES("4307","203","217","6");
INSERT INTO test_scores VALUES("4308","203","125","6");
INSERT INTO test_scores VALUES("4309","203","205","6");
INSERT INTO test_scores VALUES("4310","203","196","6");
INSERT INTO test_scores VALUES("4311","203","199","6");
INSERT INTO test_scores VALUES("4312","203","147","6");
INSERT INTO test_scores VALUES("4313","203","119","6");
INSERT INTO test_scores VALUES("4314","203","118","4");
INSERT INTO test_scores VALUES("4315","203","120","6");
INSERT INTO test_scores VALUES("4316","203","145","6");
INSERT INTO test_scores VALUES("4317","203","202","6");
INSERT INTO test_scores VALUES("4318","203","121","6");
INSERT INTO test_scores VALUES("4319","203","72","6");
INSERT INTO test_scores VALUES("4320","203","213","6");
INSERT INTO test_scores VALUES("4321","203","215","6");
INSERT INTO test_scores VALUES("4322","204","120","4");
INSERT INTO test_scores VALUES("4323","204","72","6");
INSERT INTO test_scores VALUES("4324","204","206","2");
INSERT INTO test_scores VALUES("4325","204","143","4");
INSERT INTO test_scores VALUES("4326","204","119","4");
INSERT INTO test_scores VALUES("4327","204","145","4");
INSERT INTO test_scores VALUES("4328","204","219","0");
INSERT INTO test_scores VALUES("4329","204","215","2");
INSERT INTO test_scores VALUES("4330","204","213","0");
INSERT INTO test_scores VALUES("4331","204","121","6");
INSERT INTO test_scores VALUES("4332","204","202","2");
INSERT INTO test_scores VALUES("4333","204","147","4");
INSERT INTO test_scores VALUES("4334","204","196","4");
INSERT INTO test_scores VALUES("4335","204","205","6");
INSERT INTO test_scores VALUES("4336","204","199","4");
INSERT INTO test_scores VALUES("4337","204","125","6");
INSERT INTO test_scores VALUES("4338","204","217","6");
INSERT INTO test_scores VALUES("4339","204","197","4");
INSERT INTO test_scores VALUES("4340","204","204","6");
INSERT INTO test_scores VALUES("4341","204","122","2");
INSERT INTO test_scores VALUES("4342","204","55","6");
INSERT INTO test_scores VALUES("4343","204","73","6");
INSERT INTO test_scores VALUES("4344","204","216","6");
INSERT INTO test_scores VALUES("4345","205","119","6");
INSERT INTO test_scores VALUES("4346","205","125","6");
INSERT INTO test_scores VALUES("4347","205","72","6");
INSERT INTO test_scores VALUES("4348","205","145","4");
INSERT INTO test_scores VALUES("4349","205","147","6");
INSERT INTO test_scores VALUES("4350","205","120","6");
INSERT INTO test_scores VALUES("4351","205","196","6");
INSERT INTO test_scores VALUES("4352","205","197","4");
INSERT INTO test_scores VALUES("4353","205","205","6");
INSERT INTO test_scores VALUES("4354","205","73","6");
INSERT INTO test_scores VALUES("4355","205","121","6");
INSERT INTO test_scores VALUES("4356","205","213","6");
INSERT INTO test_scores VALUES("4357","205","217","6");
INSERT INTO test_scores VALUES("4358","205","122","6");
INSERT INTO test_scores VALUES("4359","205","204","6");
INSERT INTO test_scores VALUES("4360","205","216","6");
INSERT INTO test_scores VALUES("4361","205","199","4");
INSERT INTO test_scores VALUES("4362","205","202","4");
INSERT INTO test_scores VALUES("4363","205","200","2");
INSERT INTO test_scores VALUES("4364","205","215","6");
INSERT INTO test_scores VALUES("4365","205","143","6");
INSERT INTO test_scores VALUES("4366","205","206","6");
INSERT INTO test_scores VALUES("4367","205","219","0");
INSERT INTO test_scores VALUES("4368","206","55","0");
INSERT INTO test_scores VALUES("4369","206","206","2");
INSERT INTO test_scores VALUES("4370","206","216","2");
INSERT INTO test_scores VALUES("4371","206","204","2");
INSERT INTO test_scores VALUES("4372","206","125","2");
INSERT INTO test_scores VALUES("4373","206","217","2");
INSERT INTO test_scores VALUES("4374","206","147","2");
INSERT INTO test_scores VALUES("4375","206","205","2");
INSERT INTO test_scores VALUES("4376","206","120","2");
INSERT INTO test_scores VALUES("4377","206","196","2");
INSERT INTO test_scores VALUES("4378","206","197","2");
INSERT INTO test_scores VALUES("4379","206","143","2");
INSERT INTO test_scores VALUES("4380","206","118","1");
INSERT INTO test_scores VALUES("4381","206","119","2");
INSERT INTO test_scores VALUES("4382","206","145","2");
INSERT INTO test_scores VALUES("4383","206","215","2");
INSERT INTO test_scores VALUES("4384","206","213","1");
INSERT INTO test_scores VALUES("4385","206","202","2");
INSERT INTO test_scores VALUES("4386","206","121","2");
INSERT INTO test_scores VALUES("4387","206","122","2");
INSERT INTO test_scores VALUES("4388","206","73","0");
INSERT INTO test_scores VALUES("4389","206","72","2");
INSERT INTO test_scores VALUES("4530","211","36","10");
INSERT INTO test_scores VALUES("4393","203","222","4");
INSERT INTO test_scores VALUES("4394","202","222","0");
INSERT INTO test_scores VALUES("4395","204","222","0");
INSERT INTO test_scores VALUES("4396","202","223","0");
INSERT INTO test_scores VALUES("4397","203","223","4");
INSERT INTO test_scores VALUES("4398","205","223","6");
INSERT INTO test_scores VALUES("4399","206","223","0");
INSERT INTO test_scores VALUES("4400","206","222","2");
INSERT INTO test_scores VALUES("4401","206","221","0");
INSERT INTO test_scores VALUES("4402","204","224","2");
INSERT INTO test_scores VALUES("4403","202","224","0");
INSERT INTO test_scores VALUES("4404","203","224","4");
INSERT INTO test_scores VALUES("4405","202","226","6");
INSERT INTO test_scores VALUES("4406","203","226","4");
INSERT INTO test_scores VALUES("4407","204","226","4");
INSERT INTO test_scores VALUES("4408","205","226","6");
INSERT INTO test_scores VALUES("4409","206","226","2");
INSERT INTO test_scores VALUES("4410","202","36","4");
INSERT INTO test_scores VALUES("4411","203","36","6");
INSERT INTO test_scores VALUES("4412","204","36","6");
INSERT INTO test_scores VALUES("4413","205","36","4");
INSERT INTO test_scores VALUES("4425","206","36","0");
INSERT INTO test_scores VALUES("4415","202","165","6");
INSERT INTO test_scores VALUES("4416","203","165","6");
INSERT INTO test_scores VALUES("4417","204","165","6");
INSERT INTO test_scores VALUES("4418","205","165","6");
INSERT INTO test_scores VALUES("4419","206","165","2");
INSERT INTO test_scores VALUES("4420","202","144","4");
INSERT INTO test_scores VALUES("4421","203","144","6");
INSERT INTO test_scores VALUES("4422","204","144","6");
INSERT INTO test_scores VALUES("4423","205","144","4");
INSERT INTO test_scores VALUES("4424","206","144","2");
INSERT INTO test_scores VALUES("4426","202","66","2");
INSERT INTO test_scores VALUES("4427","203","66","6");
INSERT INTO test_scores VALUES("4428","204","66","6");
INSERT INTO test_scores VALUES("4429","205","66","4");
INSERT INTO test_scores VALUES("4430","206","66","2");
INSERT INTO test_scores VALUES("4431","202","117","2");
INSERT INTO test_scores VALUES("4432","203","117","6");
INSERT INTO test_scores VALUES("4433","204","117","6");
INSERT INTO test_scores VALUES("4434","205","117","4");
INSERT INTO test_scores VALUES("4435","206","117","1");
INSERT INTO test_scores VALUES("4436","202","212","2");
INSERT INTO test_scores VALUES("4437","203","212","6");
INSERT INTO test_scores VALUES("4438","204","212","2");
INSERT INTO test_scores VALUES("4439","205","212","6");
INSERT INTO test_scores VALUES("4440","206","212","2");
INSERT INTO test_scores VALUES("4441","206","30","0");
INSERT INTO test_scores VALUES("4442","211","219","0");
INSERT INTO test_scores VALUES("4443","211","121","3");
INSERT INTO test_scores VALUES("4444","211","226","3");
INSERT INTO test_scores VALUES("4445","211","212","0");
INSERT INTO test_scores VALUES("4446","211","203","0");
INSERT INTO test_scores VALUES("4447","211","216","3");
INSERT INTO test_scores VALUES("4448","211","147","3");
INSERT INTO test_scores VALUES("4449","211","125","6");
INSERT INTO test_scores VALUES("4450","211","144","6");
INSERT INTO test_scores VALUES("4451","211","122","0");
INSERT INTO test_scores VALUES("4452","211","217","3");
INSERT INTO test_scores VALUES("4453","211","117","3");
INSERT INTO test_scores VALUES("4454","211","196","0");
INSERT INTO test_scores VALUES("4455","211","211","0");
INSERT INTO test_scores VALUES("4456","211","204","0");
INSERT INTO test_scores VALUES("4457","211","202","4");
INSERT INTO test_scores VALUES("4458","211","177","0");
INSERT INTO test_scores VALUES("4459","211","72","0");
INSERT INTO test_scores VALUES("4460","211","206","0");
INSERT INTO test_scores VALUES("4461","211","3","3");
INSERT INTO test_scores VALUES("4462","211","145","3");
INSERT INTO test_scores VALUES("4463","211","66","0");
INSERT INTO test_scores VALUES("4464","211","31","0");
INSERT INTO test_scores VALUES("4466","208","66","6");
INSERT INTO test_scores VALUES("4467","208","31","6");
INSERT INTO test_scores VALUES("4468","208","145","6");
INSERT INTO test_scores VALUES("4469","208","117","6");
INSERT INTO test_scores VALUES("4470","208","203","1");
INSERT INTO test_scores VALUES("4471","208","211","6");
INSERT INTO test_scores VALUES("4472","208","122","4");
INSERT INTO test_scores VALUES("4473","208","72","5");
INSERT INTO test_scores VALUES("4474","208","219","0");
INSERT INTO test_scores VALUES("4475","208","229","0");
INSERT INTO test_scores VALUES("4476","208","197","5");
INSERT INTO test_scores VALUES("4477","211","197","0");
INSERT INTO test_scores VALUES("4478","211","229","0");
INSERT INTO test_scores VALUES("4479","208","226","6");
INSERT INTO test_scores VALUES("4480","208","125","6");
INSERT INTO test_scores VALUES("4481","208","202","6");
INSERT INTO test_scores VALUES("4482","208","144","6");
INSERT INTO test_scores VALUES("4483","208","9","0");
INSERT INTO test_scores VALUES("4484","209","117","3");
INSERT INTO test_scores VALUES("4485","209","31","3");
INSERT INTO test_scores VALUES("4486","209","145","3");
INSERT INTO test_scores VALUES("4487","209","66","3");
INSERT INTO test_scores VALUES("4488","208","206","6");
INSERT INTO test_scores VALUES("4489","208","216","6");
INSERT INTO test_scores VALUES("4490","208","212","6");
INSERT INTO test_scores VALUES("4491","208","217","2");
INSERT INTO test_scores VALUES("4492","208","196","3");
INSERT INTO test_scores VALUES("4493","208","147","6");
INSERT INTO test_scores VALUES("4494","209","217","2");
INSERT INTO test_scores VALUES("4495","209","226","3");
INSERT INTO test_scores VALUES("4496","209","122","1");
INSERT INTO test_scores VALUES("4497","209","197","3");
INSERT INTO test_scores VALUES("4498","209","211","0");
INSERT INTO test_scores VALUES("4499","209","196","3");
INSERT INTO test_scores VALUES("4500","209","147","1");
INSERT INTO test_scores VALUES("4501","209","125","3");
INSERT INTO test_scores VALUES("4502","209","203","0");
INSERT INTO test_scores VALUES("4503","209","206","3");
INSERT INTO test_scores VALUES("4504","209","219","0");
INSERT INTO test_scores VALUES("4505","209","144","3");
INSERT INTO test_scores VALUES("4506","209","72","4");
INSERT INTO test_scores VALUES("4507","209","202","6");
INSERT INTO test_scores VALUES("4508","209","212","3");
INSERT INTO test_scores VALUES("4509","209","216","3");
INSERT INTO test_scores VALUES("4510","210","206","2");
INSERT INTO test_scores VALUES("4511","210","72","2");
INSERT INTO test_scores VALUES("4512","210","177","1");
INSERT INTO test_scores VALUES("4513","210","122","2");
INSERT INTO test_scores VALUES("4514","210","212","0");
INSERT INTO test_scores VALUES("4515","210","229","0");
INSERT INTO test_scores VALUES("4516","210","197","2");
INSERT INTO test_scores VALUES("4517","210","202","0");
INSERT INTO test_scores VALUES("4518","210","204","0");
INSERT INTO test_scores VALUES("4519","210","211","0");
INSERT INTO test_scores VALUES("4520","210","196","2");
INSERT INTO test_scores VALUES("4521","210","217","2");
INSERT INTO test_scores VALUES("4522","210","144","2");
INSERT INTO test_scores VALUES("4523","210","125","1");
INSERT INTO test_scores VALUES("4524","210","147","1");
INSERT INTO test_scores VALUES("4525","210","216","2");
INSERT INTO test_scores VALUES("4526","210","203","2");
INSERT INTO test_scores VALUES("4527","210","226","0");
INSERT INTO test_scores VALUES("4528","210","121","0");
INSERT INTO test_scores VALUES("4529","210","219","2");
INSERT INTO test_scores VALUES("4531","211","205","7");
INSERT INTO test_scores VALUES("4532","208","36","4");
INSERT INTO test_scores VALUES("4533","208","205","5");
INSERT INTO test_scores VALUES("4534","209","36","4");
INSERT INTO test_scores VALUES("4535","209","205","4");
INSERT INTO test_scores VALUES("4536","212","226","3");
INSERT INTO test_scores VALUES("4537","212","145","3");
INSERT INTO test_scores VALUES("4538","212","36","3");
INSERT INTO test_scores VALUES("4539","212","3","2");
INSERT INTO test_scores VALUES("4540","212","177","3");
INSERT INTO test_scores VALUES("4541","212","66","3");
INSERT INTO test_scores VALUES("4542","212","30","3");
INSERT INTO test_scores VALUES("4543","212","214","3");
INSERT INTO test_scores VALUES("4544","212","197","3");
INSERT INTO test_scores VALUES("4545","212","147","3");
INSERT INTO test_scores VALUES("4546","212","212","2");
INSERT INTO test_scores VALUES("4547","212","196","3");
INSERT INTO test_scores VALUES("4548","212","122","1");
INSERT INTO test_scores VALUES("4549","212","205","3");
INSERT INTO test_scores VALUES("4550","212","117","3");
INSERT INTO test_scores VALUES("4551","212","219","2");
INSERT INTO test_scores VALUES("4552","212","211","3");
INSERT INTO test_scores VALUES("4553","212","121","3");
INSERT INTO test_scores VALUES("4554","212","206","3");
INSERT INTO test_scores VALUES("4555","212","204","3");
INSERT INTO test_scores VALUES("4556","212","217","3");
INSERT INTO test_scores VALUES("4557","212","142","3");
INSERT INTO test_scores VALUES("4558","212","143","3");
INSERT INTO test_scores VALUES("4559","212","124","3");
INSERT INTO test_scores VALUES("4560","212","73","2");
INSERT INTO test_scores VALUES("4561","212","203","0");
INSERT INTO test_scores VALUES("4562","212","118","3");
INSERT INTO test_scores VALUES("4563","212","125","3");
INSERT INTO test_scores VALUES("4564","212","216","1");
INSERT INTO test_scores VALUES("4565","213","73","14");
INSERT INTO test_scores VALUES("4566","213","199","6");
INSERT INTO test_scores VALUES("4567","213","222","0");
INSERT INTO test_scores VALUES("4568","213","122","11");
INSERT INTO test_scores VALUES("4569","213","213","7");
INSERT INTO test_scores VALUES("4570","213","215","4");
INSERT INTO test_scores VALUES("4571","213","145","11");
INSERT INTO test_scores VALUES("4572","213","166","7");
INSERT INTO test_scores VALUES("4573","213","205","17");
INSERT INTO test_scores VALUES("4574","213","147","24");
INSERT INTO test_scores VALUES("4575","213","202","11");
INSERT INTO test_scores VALUES("4576","213","143","17");
INSERT INTO test_scores VALUES("4577","213","125","30");
INSERT INTO test_scores VALUES("4578","213","117","20");
INSERT INTO test_scores VALUES("4579","213","203","7");
INSERT INTO test_scores VALUES("4580","213","196","9");
INSERT INTO test_scores VALUES("4581","213","31","24");
INSERT INTO test_scores VALUES("4582","213","206","7");
INSERT INTO test_scores VALUES("4583","213","219","0");
INSERT INTO test_scores VALUES("4584","213","217","11");
INSERT INTO test_scores VALUES("4585","213","72","28");
INSERT INTO test_scores VALUES("4586","213","197","4");
INSERT INTO test_scores VALUES("4587","213","3","21");
INSERT INTO test_scores VALUES("4588","213","204","17");
INSERT INTO test_scores VALUES("4589","213","165","32");
INSERT INTO test_scores VALUES("4590","213","212","10");
INSERT INTO test_scores VALUES("4591","213","214","11");
INSERT INTO test_scores VALUES("4592","213","124","29");
INSERT INTO test_scores VALUES("4593","213","216","17");
INSERT INTO test_scores VALUES("4594","213","121","3");
INSERT INTO test_scores VALUES("4595","213","226","14");
INSERT INTO test_scores VALUES("4596","213","67","18");
INSERT INTO test_scores VALUES("4597","213","30","0");
INSERT INTO test_scores VALUES("4598","213","36","11");
INSERT INTO test_scores VALUES("4599","213","66","38");
INSERT INTO test_scores VALUES("4600","213","118","7");
INSERT INTO test_scores VALUES("4601","213","144","15");
INSERT INTO test_scores VALUES("4602","213","142","14");
INSERT INTO test_scores VALUES("4603","213","211","10");
INSERT INTO test_scores VALUES("4604","213","119","8");
INSERT INTO test_scores VALUES("4605","213","120","12");
INSERT INTO test_scores VALUES("4606","214","144","3");
INSERT INTO test_scores VALUES("4607","214","222","0");
INSERT INTO test_scores VALUES("4608","214","213","0");
INSERT INTO test_scores VALUES("4609","214","125","6");
INSERT INTO test_scores VALUES("4610","214","196","3");
INSERT INTO test_scores VALUES("4611","214","202","3");
INSERT INTO test_scores VALUES("4612","214","199","6");
INSERT INTO test_scores VALUES("4613","214","203","0");
INSERT INTO test_scores VALUES("4614","214","122","3");
INSERT INTO test_scores VALUES("4615","214","72","3");
INSERT INTO test_scores VALUES("4616","214","66","3");
INSERT INTO test_scores VALUES("4617","214","143","3");
INSERT INTO test_scores VALUES("4618","214","177","3");
INSERT INTO test_scores VALUES("4619","214","205","3");
INSERT INTO test_scores VALUES("4620","214","217","0");
INSERT INTO test_scores VALUES("4621","214","197","3");
INSERT INTO test_scores VALUES("4622","214","206","0");
INSERT INTO test_scores VALUES("4623","214","204","3");
INSERT INTO test_scores VALUES("4624","214","212","0");
INSERT INTO test_scores VALUES("4625","214","216","6");
INSERT INTO test_scores VALUES("4626","214","219","0");
INSERT INTO test_scores VALUES("4627","214","215","0");
INSERT INTO test_scores VALUES("4628","214","55","0");
INSERT INTO test_scores VALUES("4629","214","31","0");
INSERT INTO test_scores VALUES("4630","215","177","2");
INSERT INTO test_scores VALUES("4631","215","143","2");
INSERT INTO test_scores VALUES("4632","215","215","0");
INSERT INTO test_scores VALUES("4633","215","213","0");
INSERT INTO test_scores VALUES("4634","215","125","0");
INSERT INTO test_scores VALUES("4635","215","144","4");
INSERT INTO test_scores VALUES("4636","215","222","0");
INSERT INTO test_scores VALUES("4637","215","217","0");
INSERT INTO test_scores VALUES("4638","215","199","0");
INSERT INTO test_scores VALUES("4639","215","196","2");
INSERT INTO test_scores VALUES("4640","215","202","2");
INSERT INTO test_scores VALUES("4641","215","197","0");
INSERT INTO test_scores VALUES("4642","215","216","0");
INSERT INTO test_scores VALUES("4643","215","212","0");
INSERT INTO test_scores VALUES("4644","215","204","0");
INSERT INTO test_scores VALUES("4645","215","122","0");
INSERT INTO test_scores VALUES("4646","215","203","0");
INSERT INTO test_scores VALUES("4647","215","206","2");
INSERT INTO test_scores VALUES("4648","215","66","4");
INSERT INTO test_scores VALUES("4649","215","72","2");
INSERT INTO test_scores VALUES("4650","214","145","3");
INSERT INTO test_scores VALUES("4651","215","145","4");
INSERT INTO test_scores VALUES("4652","215","205","2");
INSERT INTO test_scores VALUES("4653","215","117","2");
INSERT INTO test_scores VALUES("4654","215","142","2");
INSERT INTO test_scores VALUES("4655","215","36","2");
INSERT INTO test_scores VALUES("4656","215","3","2");
INSERT INTO test_scores VALUES("4657","214","142","0");
INSERT INTO test_scores VALUES("4658","214","214","3");
INSERT INTO test_scores VALUES("4659","214","36","6");
INSERT INTO test_scores VALUES("4660","214","117","3");
INSERT INTO test_scores VALUES("4661","214","3","6");
INSERT INTO test_scores VALUES("4662","216","117","6");
INSERT INTO test_scores VALUES("4663","216","125","3");
INSERT INTO test_scores VALUES("4664","216","199","6");
INSERT INTO test_scores VALUES("4665","216","202","6");
INSERT INTO test_scores VALUES("4666","216","36","6");
INSERT INTO test_scores VALUES("4667","216","145","2");
INSERT INTO test_scores VALUES("4668","216","177","6");
INSERT INTO test_scores VALUES("4669","216","124","6");
INSERT INTO test_scores VALUES("4670","216","147","6");
INSERT INTO test_scores VALUES("4671","216","216","6");
INSERT INTO test_scores VALUES("4672","216","205","3");
INSERT INTO test_scores VALUES("4673","216","211","0");
INSERT INTO test_scores VALUES("4674","216","72","6");
INSERT INTO test_scores VALUES("4675","216","219","0");
INSERT INTO test_scores VALUES("4676","216","66","3");
INSERT INTO test_scores VALUES("4677","216","206","6");
INSERT INTO test_scores VALUES("4678","216","233","6");
INSERT INTO test_scores VALUES("4679","216","55","2");
INSERT INTO test_scores VALUES("4680","216","203","1");
INSERT INTO test_scores VALUES("4681","216","226","4");
INSERT INTO test_scores VALUES("4682","216","122","1");
INSERT INTO test_scores VALUES("4683","216","204","6");
INSERT INTO test_scores VALUES("4684","216","222","2");
INSERT INTO test_scores VALUES("4685","216","217","3");
INSERT INTO test_scores VALUES("4686","216","31","3");
INSERT INTO test_scores VALUES("4687","216","121","3");
INSERT INTO test_scores VALUES("4688","218","222","3");
INSERT INTO test_scores VALUES("4689","218","217","3");
INSERT INTO test_scores VALUES("4690","218","204","3");
INSERT INTO test_scores VALUES("4691","218","117","2");
INSERT INTO test_scores VALUES("4692","218","121","6");
INSERT INTO test_scores VALUES("4693","218","125","5");
INSERT INTO test_scores VALUES("4694","218","216","5");
INSERT INTO test_scores VALUES("4695","218","147","3");
INSERT INTO test_scores VALUES("4696","218","205","3");
INSERT INTO test_scores VALUES("4697","218","124","5");
INSERT INTO test_scores VALUES("4698","218","206","3");
INSERT INTO test_scores VALUES("4699","218","177","0");
INSERT INTO test_scores VALUES("4700","218","233","4");
INSERT INTO test_scores VALUES("4701","218","199","2");
INSERT INTO test_scores VALUES("4702","218","66","4");
INSERT INTO test_scores VALUES("4703","218","202","3");
INSERT INTO test_scores VALUES("4704","218","214","0");
INSERT INTO test_scores VALUES("4705","218","55","3");
INSERT INTO test_scores VALUES("4706","218","31","0");
INSERT INTO test_scores VALUES("4707","218","203","2");
INSERT INTO test_scores VALUES("4708","218","226","0");
INSERT INTO test_scores VALUES("4709","218","211","0");
INSERT INTO test_scores VALUES("4710","218","72","6");
INSERT INTO test_scores VALUES("4711","218","219","0");
INSERT INTO test_scores VALUES("4712","218","122","0");
INSERT INTO test_scores VALUES("4713","218","36","5");
INSERT INTO test_scores VALUES("4714","218","145","2");
INSERT INTO test_scores VALUES("4715","217","145","3");
INSERT INTO test_scores VALUES("4716","217","36","6");
INSERT INTO test_scores VALUES("4717","217","122","1");
INSERT INTO test_scores VALUES("4718","217","124","2");
INSERT INTO test_scores VALUES("4719","217","219","0");
INSERT INTO test_scores VALUES("4720","217","205","1");
INSERT INTO test_scores VALUES("4721","217","177","0");
INSERT INTO test_scores VALUES("4722","217","72","3");
INSERT INTO test_scores VALUES("4723","217","216","3");
INSERT INTO test_scores VALUES("4724","217","211","4");
INSERT INTO test_scores VALUES("4725","217","233","4");
INSERT INTO test_scores VALUES("4726","217","199","6");
INSERT INTO test_scores VALUES("4727","217","204","4");
INSERT INTO test_scores VALUES("4728","217","202","4");
INSERT INTO test_scores VALUES("4729","217","125","6");
INSERT INTO test_scores VALUES("4730","217","117","1");
INSERT INTO test_scores VALUES("4731","217","222","0");
INSERT INTO test_scores VALUES("4732","217","217","4");
INSERT INTO test_scores VALUES("4733","217","55","6");
INSERT INTO test_scores VALUES("4734","217","206","1");
INSERT INTO test_scores VALUES("4735","217","214","6");
INSERT INTO test_scores VALUES("4736","217","31","3");
INSERT INTO test_scores VALUES("4737","217","203","1");
INSERT INTO test_scores VALUES("4738","217","226","1");
INSERT INTO test_scores VALUES("4739","217","66","6");
INSERT INTO test_scores VALUES("4740","217","147","5");
INSERT INTO test_scores VALUES("4741","217","121","3");
INSERT INTO test_scores VALUES("4742","216","214","6");
INSERT INTO test_scores VALUES("4743","218","144","6");
INSERT INTO test_scores VALUES("4744","217","144","6");
INSERT INTO test_scores VALUES("4745","216","144","6");
INSERT INTO test_scores VALUES("4746","219","201","2");
INSERT INTO test_scores VALUES("4747","219","3","4");
INSERT INTO test_scores VALUES("4748","219","125","6");
INSERT INTO test_scores VALUES("4749","219","36","6");
INSERT INTO test_scores VALUES("4750","219","147","6");
INSERT INTO test_scores VALUES("4751","219","72","2");
INSERT INTO test_scores VALUES("4752","219","215","6");
INSERT INTO test_scores VALUES("4753","219","213","4");
INSERT INTO test_scores VALUES("4754","219","144","6");
INSERT INTO test_scores VALUES("4755","219","202","6");
INSERT INTO test_scores VALUES("4756","219","143","6");
INSERT INTO test_scores VALUES("4757","219","117","6");
INSERT INTO test_scores VALUES("4758","219","200","0");
INSERT INTO test_scores VALUES("4759","219","216","6");
INSERT INTO test_scores VALUES("4760","219","205","6");
INSERT INTO test_scores VALUES("4761","219","234","6");
INSERT INTO test_scores VALUES("4762","219","217","4");
INSERT INTO test_scores VALUES("4763","219","214","4");
INSERT INTO test_scores VALUES("4764","219","66","6");
INSERT INTO test_scores VALUES("4765","219","73","4");
INSERT INTO test_scores VALUES("4766","219","122","6");
INSERT INTO test_scores VALUES("4767","219","219","0");
INSERT INTO test_scores VALUES("4768","219","212","6");
INSERT INTO test_scores VALUES("4769","219","206","4");
INSERT INTO test_scores VALUES("4770","219","203","0");
INSERT INTO test_scores VALUES("4771","220","36","6");
INSERT INTO test_scores VALUES("4772","220","3","4");
INSERT INTO test_scores VALUES("4773","220","212","6");
INSERT INTO test_scores VALUES("4774","220","217","6");
INSERT INTO test_scores VALUES("4775","220","200","4");
INSERT INTO test_scores VALUES("4776","220","202","6");
INSERT INTO test_scores VALUES("4777","220","234","4");
INSERT INTO test_scores VALUES("4778","220","216","6");
INSERT INTO test_scores VALUES("4779","220","122","6");
INSERT INTO test_scores VALUES("4780","220","219","6");
INSERT INTO test_scores VALUES("4781","220","203","6");
INSERT INTO test_scores VALUES("4782","220","125","6");
INSERT INTO test_scores VALUES("4783","220","147","6");
INSERT INTO test_scores VALUES("4784","220","201","6");
INSERT INTO test_scores VALUES("4785","220","143","6");
INSERT INTO test_scores VALUES("4786","220","66","6");
INSERT INTO test_scores VALUES("4787","220","144","6");
INSERT INTO test_scores VALUES("4788","220","205","6");
INSERT INTO test_scores VALUES("4789","220","117","6");
INSERT INTO test_scores VALUES("4790","220","72","6");
INSERT INTO test_scores VALUES("4791","220","214","6");
INSERT INTO test_scores VALUES("4792","220","73","4");
INSERT INTO test_scores VALUES("4793","220","206","6");
INSERT INTO test_scores VALUES("4794","220","213","4");
INSERT INTO test_scores VALUES("4795","220","215","6");
INSERT INTO test_scores VALUES("4796","221","217","3");
INSERT INTO test_scores VALUES("4797","221","201","5");
INSERT INTO test_scores VALUES("4798","221","177","6");
INSERT INTO test_scores VALUES("4799","221","66","6");
INSERT INTO test_scores VALUES("4800","221","202","5");
INSERT INTO test_scores VALUES("4801","221","197","3");
INSERT INTO test_scores VALUES("4802","221","144","5");
INSERT INTO test_scores VALUES("4803","221","143","3");
INSERT INTO test_scores VALUES("4804","221","206","1");
INSERT INTO test_scores VALUES("4805","221","212","5");
INSERT INTO test_scores VALUES("4806","221","125","6");
INSERT INTO test_scores VALUES("4807","221","203","2");
INSERT INTO test_scores VALUES("4808","221","3","3");
INSERT INTO test_scores VALUES("4809","221","72","5");
INSERT INTO test_scores VALUES("4810","221","124","1");
INSERT INTO test_scores VALUES("4811","221","117","2");
INSERT INTO test_scores VALUES("4812","221","178","3");
INSERT INTO test_scores VALUES("4813","221","205","5");
INSERT INTO test_scores VALUES("4814","221","213","0");
INSERT INTO test_scores VALUES("4815","221","234","3");
INSERT INTO test_scores VALUES("4816","221","215","5");
INSERT INTO test_scores VALUES("4817","222","216","6");
INSERT INTO test_scores VALUES("4818","222","72","6");
INSERT INTO test_scores VALUES("4819","222","197","1");
INSERT INTO test_scores VALUES("4820","222","144","6");
INSERT INTO test_scores VALUES("4821","222","117","4");
INSERT INTO test_scores VALUES("4822","222","125","6");
INSERT INTO test_scores VALUES("4823","222","213","0");
INSERT INTO test_scores VALUES("4824","222","215","6");
INSERT INTO test_scores VALUES("4825","222","143","6");
INSERT INTO test_scores VALUES("4826","222","201","1");
INSERT INTO test_scores VALUES("4827","222","202","3");
INSERT INTO test_scores VALUES("4828","222","217","6");
INSERT INTO test_scores VALUES("4829","222","177","1");
INSERT INTO test_scores VALUES("4830","222","66","3");
INSERT INTO test_scores VALUES("4831","222","204","1");
INSERT INTO test_scores VALUES("4832","222","145","2");
INSERT INTO test_scores VALUES("4833","222","203","0");
INSERT INTO test_scores VALUES("4834","222","124","6");
INSERT INTO test_scores VALUES("4835","222","178","3");
INSERT INTO test_scores VALUES("4836","222","205","6");
INSERT INTO test_scores VALUES("4837","222","234","6");
INSERT INTO test_scores VALUES("4838","222","3","6");
INSERT INTO test_scores VALUES("4839","222","206","6");
INSERT INTO test_scores VALUES("4840","222","212","4");
INSERT INTO test_scores VALUES("4841","221","214","2");
INSERT INTO test_scores VALUES("4842","221","216","6");
INSERT INTO test_scores VALUES("4843","221","145","1");
INSERT INTO test_scores VALUES("4844","221","204","4");
INSERT INTO test_scores VALUES("4845","222","214","0");
INSERT INTO test_scores VALUES("4846","222","147","5");
INSERT INTO test_scores VALUES("4847","221","147","3");
INSERT INTO test_scores VALUES("4848","223","214","2");
INSERT INTO test_scores VALUES("4849","223","216","0");
INSERT INTO test_scores VALUES("4850","223","212","2");
INSERT INTO test_scores VALUES("4851","223","206","2");
INSERT INTO test_scores VALUES("4852","223","3","0");
INSERT INTO test_scores VALUES("4853","223","178","1");
INSERT INTO test_scores VALUES("4854","223","234","2");
INSERT INTO test_scores VALUES("4855","223","124","0");
INSERT INTO test_scores VALUES("4856","223","203","0");
INSERT INTO test_scores VALUES("4857","223","145","2");
INSERT INTO test_scores VALUES("4858","223","204","0");
INSERT INTO test_scores VALUES("4859","223","66","1");
INSERT INTO test_scores VALUES("4860","223","177","2");
INSERT INTO test_scores VALUES("4861","223","217","2");
INSERT INTO test_scores VALUES("4862","223","202","2");
INSERT INTO test_scores VALUES("4863","223","201","2");
INSERT INTO test_scores VALUES("4864","223","143","0");
INSERT INTO test_scores VALUES("4865","223","215","0");
INSERT INTO test_scores VALUES("4866","223","213","0");
INSERT INTO test_scores VALUES("4867","223","125","0");
INSERT INTO test_scores VALUES("4868","223","117","2");
INSERT INTO test_scores VALUES("4869","223","144","2");
INSERT INTO test_scores VALUES("4870","223","197","1");
INSERT INTO test_scores VALUES("4871","223","205","2");
INSERT INTO test_scores VALUES("4872","222","36","6");
INSERT INTO test_scores VALUES("4873","221","36","3");
INSERT INTO test_scores VALUES("4874","224","6","6");
INSERT INTO test_scores VALUES("4875","224","36","6");
INSERT INTO test_scores VALUES("4876","224","124","6");
INSERT INTO test_scores VALUES("4877","224","205","6");
INSERT INTO test_scores VALUES("4878","224","217","6");
INSERT INTO test_scores VALUES("4879","224","66","5");
INSERT INTO test_scores VALUES("4880","224","37","5");
INSERT INTO test_scores VALUES("4881","225","6","6");
INSERT INTO test_scores VALUES("4882","225","66","6");
INSERT INTO test_scores VALUES("4883","225","217","6");
INSERT INTO test_scores VALUES("4884","225","117","5");
INSERT INTO test_scores VALUES("4885","225","233","5");
INSERT INTO test_scores VALUES("4886","225","199","4");
INSERT INTO test_scores VALUES("4887","225","205","3");
INSERT INTO test_scores VALUES("4888","226","143","6");
INSERT INTO test_scores VALUES("4889","226","124","6");
INSERT INTO test_scores VALUES("4890","226","216","6");
INSERT INTO test_scores VALUES("4891","226","6","5");
INSERT INTO test_scores VALUES("4892","226","66","5");
INSERT INTO test_scores VALUES("4893","226","144","5");
INSERT INTO test_scores VALUES("4894","226","205","5");
INSERT INTO test_scores VALUES("4895","226","217","5");
INSERT INTO test_scores VALUES("4896","226","214","5");
INSERT INTO test_scores VALUES("4897","226","212","3");
INSERT INTO test_scores VALUES("4898","227","205","10");
INSERT INTO test_scores VALUES("4899","227","217","8");
INSERT INTO test_scores VALUES("4900","227","197","8");
INSERT INTO test_scores VALUES("4901","227","124","6");
INSERT INTO test_scores VALUES("4902","227","117","6");
INSERT INTO test_scores VALUES("4903","227","36","7");
INSERT INTO test_scores VALUES("4904","227","66","8");
INSERT INTO test_scores VALUES("4905","227","125","6");
INSERT INTO test_scores VALUES("4906","227","33","14");
INSERT INTO test_scores VALUES("4907","227","6","11");
INSERT INTO test_scores VALUES("4908","227","37","8");
INSERT INTO test_scores VALUES("4909","227","144","6");
INSERT INTO test_scores VALUES("4910","228","205","9");
INSERT INTO test_scores VALUES("4911","228","214","11");
INSERT INTO test_scores VALUES("4912","228","216","11");
INSERT INTO test_scores VALUES("4913","228","217","4");
INSERT INTO test_scores VALUES("4914","228","33","9");
INSERT INTO test_scores VALUES("4915","228","66","6");
INSERT INTO test_scores VALUES("4916","228","37","11");
INSERT INTO test_scores VALUES("4917","228","121","1");
INSERT INTO test_scores VALUES("4918","228","6","9");
INSERT INTO test_scores VALUES("4919","228","125","8");
INSERT INTO test_scores VALUES("4920","228","144","6");
INSERT INTO test_scores VALUES("4921","228","117","6");
INSERT INTO test_scores VALUES("4922","223","36","2");



DROP TABLE IF EXISTS tests;

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `total_points` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;

INSERT INTO tests VALUES("2","Tryout","2011-09-12","20","1");
INSERT INTO tests VALUES("4","MML 1.2","2011-09-19","6","1");
INSERT INTO tests VALUES("5","MML 1.3","2011-09-19","6","1");
INSERT INTO tests VALUES("6","MML 1.4","2011-09-19","6","1");
INSERT INTO tests VALUES("7","MML 1.5","2011-09-19","6","1");
INSERT INTO tests VALUES("8","MML 1.6","2011-09-26","6","1");
INSERT INTO tests VALUES("9","MML 1.1","2011-09-26","6","1");
INSERT INTO tests VALUES("10","GBML 1.1","2011-09-26","6","1");
INSERT INTO tests VALUES("11","GBML 1.5","2011-09-26","6","1");
INSERT INTO tests VALUES("12","GBML 1.2","2011-10-03","6","1");
INSERT INTO tests VALUES("13","GBML 1.3","2011-10-03","6","1");
INSERT INTO tests VALUES("14","GBML 1.4","2011-10-03","6","1");
INSERT INTO tests VALUES("15","HMNT Tryout","2011-10-03","50","1");
INSERT INTO tests VALUES("16","MML Meet 1","2011-10-06","18","1");
INSERT INTO tests VALUES("134","GBML 1.4","2012-10-01","6","1");
INSERT INTO tests VALUES("55","MML 3.1","2011-11-21","4","1");
INSERT INTO tests VALUES("34","MML M2.1","2011-11-03","6","1");
INSERT INTO tests VALUES("20","MML 2.4","2011-10-17","6","1");
INSERT INTO tests VALUES("21","MML 2.5","2011-10-17","6","1");
INSERT INTO tests VALUES("22","MML 2.6","2011-10-17","6","1");
INSERT INTO tests VALUES("23","MML 2.1","2011-10-24","6","1");
INSERT INTO tests VALUES("24","MML 2.2","2011-10-24","6","1");
INSERT INTO tests VALUES("25","MML 2.3","2011-10-24","6","1");
INSERT INTO tests VALUES("62","MML M3.1","2011-12-01","6","1");
INSERT INTO tests VALUES("29","GBML M1.2","2011-10-12","6","1");
INSERT INTO tests VALUES("28","GBML M1.1","2011-10-12","6","1");
INSERT INTO tests VALUES("30","GBML M1.3","2011-10-12","6","1");
INSERT INTO tests VALUES("31","GBML M1.4","2011-10-12","6","1");
INSERT INTO tests VALUES("32","GBML M1.5","2011-10-12","6","1");
INSERT INTO tests VALUES("33","GBML M1.T","2011-10-12","10","1");
INSERT INTO tests VALUES("35","MML M2.2","2011-11-03","6","1");
INSERT INTO tests VALUES("36","MML M2.3","2011-11-03","6","1");
INSERT INTO tests VALUES("37","MML M2.4","2011-11-03","6","1");
INSERT INTO tests VALUES("38","MML M2.5","2011-11-03","6","1");
INSERT INTO tests VALUES("39","MML M2.6","2011-11-03","6","1");
INSERT INTO tests VALUES("40","MML M2.T","2011-11-03","18","1");
INSERT INTO tests VALUES("41","GBML 2.2","2011-11-07","6","1");
INSERT INTO tests VALUES("42","GBML 2.3","2011-11-07","6","1");
INSERT INTO tests VALUES("43","GBML 2.5","2011-11-07","6","1");
INSERT INTO tests VALUES("44","GBML 2.4","2011-11-07","6","1");
INSERT INTO tests VALUES("45","GBML M2.1","2011-11-09","6","1");
INSERT INTO tests VALUES("46","GBML M2.2","2011-11-09","6","1");
INSERT INTO tests VALUES("47","GBML M2.3","2011-11-09","6","1");
INSERT INTO tests VALUES("48","GBML M2.4","2011-11-09","6","1");
INSERT INTO tests VALUES("49","GBML M2.5","2011-11-09","6","1");
INSERT INTO tests VALUES("50","GBML M2.T","2011-11-09","10","1");
INSERT INTO tests VALUES("133","GBML 1.1","2012-10-01","6","1");
INSERT INTO tests VALUES("52","MML 3.5 Tryout","2011-11-14","6","1");
INSERT INTO tests VALUES("53","MML 3.6","2011-11-14","6","1");
INSERT INTO tests VALUES("54","MML 3.4","2011-11-14","6","1");
INSERT INTO tests VALUES("57","MML 3.3","2011-11-21","6","1");
INSERT INTO tests VALUES("58","GBML 3.2","2011-11-28","6","1");
INSERT INTO tests VALUES("59","GBML 3.3","2011-11-28","6","1");
INSERT INTO tests VALUES("60","GBML 3.4","2011-11-28","6","1");
INSERT INTO tests VALUES("61","GBML 3.5","2011-11-28","6","1");
INSERT INTO tests VALUES("63","MML M3.2","2011-12-01","6","1");
INSERT INTO tests VALUES("64","MML M3.3","2011-12-01","6","1");
INSERT INTO tests VALUES("65","MML M3.4","2011-12-01","6","1");
INSERT INTO tests VALUES("66","MML M3.5","2011-12-01","6","1");
INSERT INTO tests VALUES("67","MML M3.6","2011-12-01","6","1");
INSERT INTO tests VALUES("68","MML M3.T","2011-12-01","18","1");
INSERT INTO tests VALUES("69","GBML M3.1","2011-12-07","6","1");
INSERT INTO tests VALUES("70","GBML M3.2","2011-12-07","6","1");
INSERT INTO tests VALUES("71","GBML M3.3","2011-12-07","6","1");
INSERT INTO tests VALUES("72","GBML M3.4","2011-12-07","6","1");
INSERT INTO tests VALUES("73","GBML M3.5","2011-12-07","6","1");
INSERT INTO tests VALUES("74","GBML M3.T","2011-12-07","10","1");
INSERT INTO tests VALUES("75","MML 4.1","2011-12-12","6","1");
INSERT INTO tests VALUES("76","MML 4.3","2011-12-12","6","1");
INSERT INTO tests VALUES("77","MML 4.4","2011-12-12","6","1");
INSERT INTO tests VALUES("78","MML 4.5","2011-12-12","6","1");
INSERT INTO tests VALUES("79","GBML 4.2","2012-01-09","6","1");
INSERT INTO tests VALUES("80","GBML 4.3","2012-01-09","6","1");
INSERT INTO tests VALUES("81","GBML 4.4","2012-01-09","6","1");
INSERT INTO tests VALUES("82","GBML 4.5","2012-01-09","6","1");
INSERT INTO tests VALUES("83","MML M4.1","2012-01-05","6","1");
INSERT INTO tests VALUES("84","MML M4.2","2012-01-05","6","1");
INSERT INTO tests VALUES("85","MML M4.3","2012-01-05","6","1");
INSERT INTO tests VALUES("86","MML M4.4","2012-01-05","6","1");
INSERT INTO tests VALUES("87","MML M4.5","2012-01-05","6","1");
INSERT INTO tests VALUES("88","MML M4.6","2012-01-05","6","1");
INSERT INTO tests VALUES("89","MML M4.T","2012-01-05","18","1");
INSERT INTO tests VALUES("90","MML 5.1","2012-01-23","6","1");
INSERT INTO tests VALUES("91","MML 5.2","2012-01-23","6","1");
INSERT INTO tests VALUES("93","MML 5.3","2012-01-23","6","1");
INSERT INTO tests VALUES("98","MML M5.1","2012-02-02","6","1");
INSERT INTO tests VALUES("95","MML 5.6","2012-01-30","6","1");
INSERT INTO tests VALUES("96","MML 5.5","2012-01-30","6","1");
INSERT INTO tests VALUES("97","MML 5.4","2012-01-30","6","1");
INSERT INTO tests VALUES("99","MML M5.2","2012-02-02","6","1");
INSERT INTO tests VALUES("100","MML M5.3","2012-02-02","6","1");
INSERT INTO tests VALUES("101","MML M5.4","2012-02-02","6","1");
INSERT INTO tests VALUES("102","MML M5.5","2012-02-02","6","1");
INSERT INTO tests VALUES("103","MML M5.6","2012-02-02","6","1");
INSERT INTO tests VALUES("104","MML M5.T","2012-02-02","18","1");
INSERT INTO tests VALUES("105","GBML 5.2","2012-02-06","6","1");
INSERT INTO tests VALUES("106","GBML 5.3","2012-02-06","6","1");
INSERT INTO tests VALUES("107","GBML 5.4","2012-02-06","6","1");
INSERT INTO tests VALUES("108","GBML 5.5","2012-02-06","6","1");
INSERT INTO tests VALUES("109","MML 6.1","2012-02-13","6","1");
INSERT INTO tests VALUES("110","MML 6.4","2012-02-13","6","1");
INSERT INTO tests VALUES("111","MML 6.2","2012-02-27","6","1");
INSERT INTO tests VALUES("112","MML 6.3","2012-02-27","6","1");
INSERT INTO tests VALUES("113","MML 6.5","2012-02-27","6","1");
INSERT INTO tests VALUES("114","MML 6.6","2012-02-27","6","1");
INSERT INTO tests VALUES("116","State 1","2012-03-05","6","1");
INSERT INTO tests VALUES("117","State 2","2012-03-05","6","1");
INSERT INTO tests VALUES("118","State 5","2012-03-12","6","1");
INSERT INTO tests VALUES("119","State 4","2012-03-12","6","1");
INSERT INTO tests VALUES("120","State 3","2012-03-12","6","1");
INSERT INTO tests VALUES("121","State 6","2012-03-19","6","1");
INSERT INTO tests VALUES("132","MML 1.5","2012-10-01","6","1");
INSERT INTO tests VALUES("129","Tryout","2012-09-10","20","1");
INSERT INTO tests VALUES("130","MML 1.3","2012-09-24","6","1");
INSERT INTO tests VALUES("131","MML 1.1","2012-09-24","6","1");
INSERT INTO tests VALUES("135","GBML 1.5","2012-10-01","6","1");
INSERT INTO tests VALUES("136","HMNT","2012-10-15","50","1");
INSERT INTO tests VALUES("137","MML 2.3","2012-10-23","6","1");
INSERT INTO tests VALUES("138","MML 2.4","2012-10-22","6","1");
INSERT INTO tests VALUES("139","MML 2.6","2012-10-22","6","1");
INSERT INTO tests VALUES("140","MML 2.5","2012-10-23","6","1");
INSERT INTO tests VALUES("141","GBML 2.2","2012-11-05","6","1");
INSERT INTO tests VALUES("142","GBML 2.3","2012-11-05","6","1");
INSERT INTO tests VALUES("143","GBML 2.4","2012-11-05","6","1");
INSERT INTO tests VALUES("144","GBML 2.5","2012-11-05","6","1");
INSERT INTO tests VALUES("145","MML 3.3","2012-11-19","6","1");
INSERT INTO tests VALUES("146","MML 3.5","2012-11-19","6","1");
INSERT INTO tests VALUES("147","MML 3.6","2012-11-19","6","1");
INSERT INTO tests VALUES("148","MML 3.4","2012-11-19","6","1");
INSERT INTO tests VALUES("149","MML 3.1","2012-11-26","6","1");
INSERT INTO tests VALUES("150","MML 3.2","2012-11-26","6","1");
INSERT INTO tests VALUES("151","GBML 3.1","2012-11-26","6","1");
INSERT INTO tests VALUES("152","GBML 3.2","2012-11-26","6","1");
INSERT INTO tests VALUES("153","GBML 3.3","2012-12-03","6","1");
INSERT INTO tests VALUES("154","GBML 3.4","2012-12-03","6","1");
INSERT INTO tests VALUES("155","GBML 3.5","2012-12-03","6","1");
INSERT INTO tests VALUES("156","MML 4.4","2012-12-10","6","1");
INSERT INTO tests VALUES("157","MML 4.3","2012-12-10","6","1");
INSERT INTO tests VALUES("158","MML 4.5","2012-12-10","6","1");
INSERT INTO tests VALUES("159","MML 4.6","2012-12-10","6","1");
INSERT INTO tests VALUES("160","GBML 4.3","2013-01-14","6","1");
INSERT INTO tests VALUES("161","GBML 4.4","2013-01-14","6","1");
INSERT INTO tests VALUES("162","GBML 4.5","2013-01-14","6","1");
INSERT INTO tests VALUES("163","MML 5.3","2013-01-28","6","1");
INSERT INTO tests VALUES("164","MML 5.4","2013-01-28","6","1");
INSERT INTO tests VALUES("165","MML 5.5","2013-01-28","6","1");
INSERT INTO tests VALUES("166","MML 5.6","2013-01-28","6","1");
INSERT INTO tests VALUES("167","GBML 5.2 ","2013-02-11","6","1");
INSERT INTO tests VALUES("168","GBML 5.3","2013-02-11","6","1");
INSERT INTO tests VALUES("169","GBML 5.4","2013-02-11","6","1");
INSERT INTO tests VALUES("170","GBML 5.5","2013-02-11","6","1");
INSERT INTO tests VALUES("171","Team Contest Y/N","2013-02-25","1","1");
INSERT INTO tests VALUES("172","MML 6.2","2013-02-25","6","1");
INSERT INTO tests VALUES("173","MML 6.4","2013-02-25","6","1");
INSERT INTO tests VALUES("174","MML 6.5","2013-02-25","6","1");
INSERT INTO tests VALUES("175","MML 6.6","2013-02-25","6","1");
INSERT INTO tests VALUES("176","MML 6.1","2013-03-04","6","1");
INSERT INTO tests VALUES("177","MML 6.3","2013-03-04","6","1");
INSERT INTO tests VALUES("185","State 2","2013-03-18","6","1");
INSERT INTO tests VALUES("181","State 1","2013-03-11","6","1");
INSERT INTO tests VALUES("182","State 3","2013-03-11","6","1");
INSERT INTO tests VALUES("186","State 4","2013-03-18","6","1");
INSERT INTO tests VALUES("184","State 5","2013-03-11","6","1");
INSERT INTO tests VALUES("187","State 6","2013-03-18","6","1");
INSERT INTO tests VALUES("188","NE 1","2013-04-01","6","1");
INSERT INTO tests VALUES("189","NE 4","2013-04-01","6","1");
INSERT INTO tests VALUES("190","NE x1","2013-04-22","6","1");
INSERT INTO tests VALUES("191","NE x2","2013-04-22","6","1");
INSERT INTO tests VALUES("192","NE x3","2013-04-22","6","1");
INSERT INTO tests VALUES("193","NE x4","2013-04-22","6","1");
INSERT INTO tests VALUES("194","NE x5","2013-04-22","6","1");
INSERT INTO tests VALUES("195","NE x6","2013-04-22","6","1");
INSERT INTO tests VALUES("196","NE 2","2013-04-22","6","1");
INSERT INTO tests VALUES("197","NE 3","2013-04-22","6","1");
INSERT INTO tests VALUES("198","NE 5","2013-04-22","6","1");
INSERT INTO tests VALUES("199","NE 6","2013-04-22","6","1");
INSERT INTO tests VALUES("200","Tryout 2013","2013-09-13","20","0");
INSERT INTO tests VALUES("201","Going to MAML?","2013-09-13","1","0");
INSERT INTO tests VALUES("202","MML Meet One Round 1","2013-09-27","6","0");
INSERT INTO tests VALUES("203","MML Meet One Round 2","2013-09-27","6","0");
INSERT INTO tests VALUES("204","MML Meet One Round 3","2013-09-27","6","0");
INSERT INTO tests VALUES("205","MML Meet One Round 4","2013-09-27","6","0");
INSERT INTO tests VALUES("206","Going to MML Meet 1","2013-09-27","2","0");
INSERT INTO tests VALUES("211","GBML Meet1 TeamRound","2013-10-04","10","0");
INSERT INTO tests VALUES("208","GBML Meet 1 Round 3","2013-10-04","6","0");
INSERT INTO tests VALUES("209","GBML Meet 1 Round 4","2013-10-04","6","0");
INSERT INTO tests VALUES("210","Going to GBML","2013-10-04","2","0");
INSERT INTO tests VALUES("212","Going to HMMT/NT","2013-10-12","3","0");
INSERT INTO tests VALUES("213","HM?T Tryout","2013-10-18","50","0");
INSERT INTO tests VALUES("214","MML 2004 Team","2013-11-01","18","0");
INSERT INTO tests VALUES("215","MML Meet 2 Trig","2013-11-01","6","0");
INSERT INTO tests VALUES("216","GBML 2.4","2013-11-08","6","0");
INSERT INTO tests VALUES("217","GBML 2.2","2013-11-08","6","0");
INSERT INTO tests VALUES("218","GBML 2.3","2013-11-08","6","0");
INSERT INTO tests VALUES("219","GBML 3.5","2013-11-22","6","0");
INSERT INTO tests VALUES("220","GBML 3.6","2013-11-22","6","0");
INSERT INTO tests VALUES("221","GBML 3.1","2013-12-06","6","0");
INSERT INTO tests VALUES("222","GBML 3.5","2013-12-06","6","0");
INSERT INTO tests VALUES("223","Going to GBML 3","2013-12-06","2","0");
INSERT INTO tests VALUES("224","NEML 1","2013-10-15","6","0");
INSERT INTO tests VALUES("225","NEML 2","2013-11-12","6","0");
INSERT INTO tests VALUES("226","NEML 3","2013-12-03","6","0");
INSERT INTO tests VALUES("227","Mandlebrot 1","2013-11-12","14","0");
INSERT INTO tests VALUES("228","Mandlebrot 2","2013-12-02","14","0");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `email` varchar(320) NOT NULL,
  `passhash` varchar(128) NOT NULL,
  `cell` varchar(10) NOT NULL DEFAULT 'None',
  `yog` int(11) NOT NULL,
  `mailings` tinyint(1) NOT NULL,
  `permissions` char(1) NOT NULL DEFAULT 'R',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `email_verification` varchar(20) NOT NULL,
  `password_reset_code` varchar(20) NOT NULL DEFAULT '0',
  `registration_ip` varchar(39) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","Benjamin Tidor","benjamin@tidor.net","03168ec0d604bb995fdd945b1a19a61d3147372f13b07d945b24d7639a25ce9bb86f4634685e3d3dd7317254e4c9c4a2e6f636a3b2040fc0ff777c63b369b090","6174601451","2012","0","A","1","1","0","209.6.250.84","2011-01-17 01:40:42");
INSERT INTO users VALUES("2","Jonathan Tidor","jonathan.tidor@gmail.com","03bf8aefc5690271a6bef56bbf84edb580b4dec459291cecc8c6194a2035ce898ec6ab8cc59d0907a30c6459a623e1bdde8cfd761a7b3bd3cf15f3da5fa39338","None","2014","1","L","1","1","0","209.6.250.84","2011-01-24 17:02:58");
INSERT INTO users VALUES("3","Aditya Gopalan","aditya@gopalans.net","716a9da0441868569c2ae45356f9444923af0cf87fe66a8b88d263e827a0ab3c3e229402208e5d3126f98ef725ee0b099fdb65be1f35bee6be73fc02dae54416","None","2014","1","R","1","1","0","98.229.125.88","2011-01-24 18:07:30");
INSERT INTO users VALUES("4","David Papp","david__papp@hotmail.com","af6c665e1c0cce80883be5e27a33f096185266f363d8beea855eadcb0f2b573e34623edac3b602dc9e8c34c64db7a230ac9acc6845fd565ad866ffc0e1faa49a","6179811905","2014","1","R","1","1","0","98.229.125.189","2011-01-24 18:22:56");
INSERT INTO users VALUES("5","Eugenia Kim","eugenia.was.here@gmail.com","959325018df4b37aab456e1dec2f3b27b81455cd344e6f27acee944180a7c29d18e41ecace0a7b9349bc80f96ec2f16ec2c1360df0c47324d96aefa6780cf70f","6175866983","2013","0","L","1","1","0","108.20.119.225","2011-01-25 00:45:52");
INSERT INTO users VALUES("6","Rohil Prasad","r0hil.pras4d@gmail.com","f0e107e5f997e84121d178f9373c4f8b1809b07e62199082dc1b2e59acd26fbf5aef59157d57f664c8dbf5d049f20b61a388070847797394a041f66025419b30","None","2014","1","C","1","1","0","96.237.236.90","2011-01-25 19:33:59");
INSERT INTO users VALUES("7","Clark Ikezu","tcikezu@yahoo.com","7c4e967d1981ed28845fe760d76c0c5409615a7486bf3ffe779b72aa8b003530eb4e3d506607b4e7199d869cc6be58325bbd4daa58b5b7244151b329ad759254","None","2013","0","L","1","1","0","209.122.160.124","2011-01-26 14:35:36");
INSERT INTO users VALUES("8","Carl Lian","forgetfulfunctor1@gmail.com","f980f0a9d985eec4ebe51247f51e69d9d41d8886486b72b01c51c79a9728d660b1a00fcd096defe0f1aab1b939177d944dfa41117224aa6579b2f286b0fb0713","7813542056","2011","1","L","1","1","0","98.229.127.6","2011-01-26 19:43:37");
INSERT INTO users VALUES("9","Julia Sun","julia.sun1@gmail.com","cfc5d8bfc6bdc437adb9ab85b26134b281956380dc28ab7d0619765678b0c66c266f8f791f954679e0b894c90871468c0f889aa272f3519c739385b6e3e387de","7818792574","2014","0","R","1","1","0","50.10.146.47","2011-01-28 19:09:13");
INSERT INTO users VALUES("10","Lauren Ransohoff","lauren.ransohoff@gmail.com","6cfcdf9a454896bc1c48d8a78fe34d29c19384c29f75b09164b99b3aa2a115c520146a48b7454a7001a723b1a10d041b75233d043611688bf7302701082bfc46","None","2012","0","L","1","1","0","108.7.203.220","2011-03-19 18:07:07");
INSERT INTO users VALUES("11","Amy Zhang","zhang.a182@gmail.com","7db215e6b2acce7c4d38c08bad043621284ca5ca3840a6e7d8e70a664a947adb1735fa8b7ecd4442f92c363e81ef58774b43019a1a1c98f5ac1a795a8d65e01a","7815410085","2012","1","L","1","1","0","209.122.160.124","2011-03-24 14:22:42");
INSERT INTO users VALUES("12","Surya Bhupatiraju","surya95@gmail.com","738e42a7ca0ee939ab5e8e834c857fbdb256df0c889e34bcc8d3e8906b13cbdad6a179a7e302117727f047d9f35d2ae1f80d856e69b02a09cb0525a0a9b4253f","None","2013","0","L","1","1","0","24.218.242.117","2011-03-27 19:34:54");
INSERT INTO users VALUES("13","Andrew Mendelsohn","weehood@rcn.com","e4a70832622aae0b4e01c7a36ea56d3e14615e59259c75ac263f15bc132f14fc89d32596036c2c2b852a830672f8826b80360bcf451260fddcecba640dee1435","None","2011","0","L","1","1","0","209.6.134.110","2011-03-28 16:23:10");
INSERT INTO users VALUES("14","Alison Stein","alisonamstein@gmail.com","8fbdcd2177b93b69c40e3263465aea6aac03e4661c2404ecf37e319ae96a8feb86054888138034404f0d7bc078bdb18b116c5f0afc769d9ce6239b34d3bca912","3392230255","2012","0","L","1","1","0","24.218.240.157","2011-03-28 22:25:47");
INSERT INTO users VALUES("15","Harrison Jia","hjia1@yahoo.com","5f2e4f72ddf67473e0e00ca73802f287bcd9bdb3d846795538ac4208b0451b0cdad24495aba6c3231330781034e1fb69fc1ab08a1db69224d0385816fc073065","None","2011","0","L","-1","1","0","166.44.161.34","2011-04-06 10:38:46");
INSERT INTO users VALUES("16","Chelhuy","chelhuy@yahoo.com.vn","4f999e53c03ea183ed5ea86856147c55cc524ec757ba3a74fe1d4a5f2ffeec74182033df91fee6e3c4778d2009ceb3277927c0306dd34a1e85afd6f8d848935a","2072560421","2014","1","R","-1","1","0","208.105.164.250","2011-04-27 14:35:15");
INSERT INTO users VALUES("17","Ted Zhu","tedz2usa@gmail.com","79808d1b0b2127b1afa79df3749e0accdfafc81709bb92223e628c9e7a1e45b76507a52743ad0de49ed8ae3d7b0231023b59049f7f4eeaf1b9f227333505d947","3392237461","2012","0","L","1","1","0","209.122.160.124","2011-05-05 13:23:43");
INSERT INTO users VALUES("18","Ha Young Kang","jennifer-k92@hotmail.com","bb5b5c6a9d5019b3a45e291b957d97428e32d6f998b9cff884cd3d864e1c5972dee6d3e30512057b8b24e6d246bea8e8392a490ea9af84f445ed95465c35e76f","6179999091","2011","0","L","1","1","0","209.122.160.124","2011-05-23 15:00:10");
INSERT INTO users VALUES("19","Jason Li","jasonmli02@gmail.com","4c73fddecb0f6616b94169af2bd130cdd4c7f04afe9e29f707c2149f85143948b5bfbc13f99bc4a1310005f572999a49d5c6bb95d16bdb456072f3cc71584f4d","7816985528","2012","0","L","1","1","0","108.7.207.80","2011-06-01 22:37:43");
INSERT INTO users VALUES("20","Kevin Wen","kevinwen94@gmail.com","282e5d0401e401e6baeeb9e2192822d323d3a03673954a4c829d285b38096a095a269adbaa9b820d5e07b8ec795d18a819dbcb614a9da9a56651c42efb65bd8a","7815071832","2012","1","L","1","1","0","209.6.250.230","2011-06-02 16:24:43");
INSERT INTO users VALUES("21","Alan Zhou","5849206328x@gmail.com","18ae174f2a77d007d73af021764320eabfed7aa034f3becf20a7cc2c78a37f79db2d90706a01ed0b914448d5c3c8159ac980c8e103ea17fa55932a1d2b6f707e","7812667522","2013","1","L","1","1","0","173.145.22.192","2011-06-04 17:02:27");
INSERT INTO users VALUES("22","Shohini Stout","shohinistout@gmail.com","8f5ce435cf8422f71b6f3b8fd21836232ed5333620b2e1919e5beb7469c09e2430f9f11fd63de4bc14f7e9c9638448b3033485115d685146015e617704b0ef03","7818793917","2015","1","C","1","1","0","173.76.25.53","2011-06-24 13:28:59");
INSERT INTO users VALUES("23","Hao Shen","shenhao95@gmail.com","da7a8bd985d9d5163d6696cf02508eb44c0a2ce8efd699e5ea006e66e6f9f002a1eeb4c697102a9ded31da93b01d49d2725b2000b10458900be52cf32d648595","None","2013","0","L","1","1","0","146.115.68.95","2011-08-22 00:21:10");
INSERT INTO users VALUES("24","Darwin Ding","pancakes.own.u@gmail.com","789afa37fcac762bc6ae109d423d9387b4d35dde3e789de8c0697a0da6736535f73d8d917d774d73fdf8cde50c8d3128b5aad940ada53cb0261790bbd674bd94","None","2013","0","L","1","1","0","108.7.207.109","2011-08-22 12:25:08");
INSERT INTO users VALUES("25","Renaud LeDonne","carmen_ledonne@yahoo.com","bb162197b485e2030442a14337ffd24bb3128ff37c7fc787ee3b3a6325623ca3ae40e83715e999be4546463d08ce7d05edd0815d0dc714f9634200d6fbab22c8","6172335287","2014","1","R","-1","1","0","74.104.155.237","2011-08-25 06:37:26");
INSERT INTO users VALUES("26","Eric Hsu","3rich326@gmail.com","d9e554baba28f0ef3846093c8e78a3cc876cdadc32f4384484c12e23f0a4b99c1d08b875b68f0e931b76fd6b4d1aaca72ff93197c1762473b0249b4e3174b6c3","None","2015","1","R","1","1","0","96.237.189.9","2011-09-12 16:47:34");
INSERT INTO users VALUES("27","Victor Zhang","vzczhang.97@gmail.com","3332c890e31371ccbea1aeb914bdc3d86d10fed97526166b78e75072f1413490cc87a07585a49eb1ef809fad8de068b44f8775fce0e21273efdadbf18c480df5","None","2015","0","R","1","1","0","173.76.25.57","2011-09-12 17:14:43");
INSERT INTO users VALUES("28","Daehyun Kim","daehyun97@gmail.com","149a54b9faebb724ed5780a229ca665610f72afb8c32bef0b61c0a3b59fe021057f60e7361abcbe59d63e061c1a04810a8da06089361476f7752046173829667","None","2015","1","R","1","1","0","146.115.73.114","2011-09-12 17:17:54");
INSERT INTO users VALUES("29","Matthew Arbesfeld","arbesfeld@gmail.com","08f09b7576543b9e3938e3c9ae66c95322f5deea202c8378d95269a1283f7586b13dbb12973a202782b47becab56fd21282441f8af1a2b94b97c0858d29204ab","None","2012","0","L","1","1","0","98.229.161.137","2011-09-12 22:46:15");
INSERT INTO users VALUES("30","Jongwon Kim","jwdkim@gmail.com","a70cd18945f4a5a64d9a726f0d23a70a94a8e6a3f549cda9546f56d2be327907aad6941d1b9365562457d522819da0d0fe30a2324131ccb1ba8b662803f1af09","7816402975","2015","1","R","1","1","0","96.237.146.254","2011-09-13 20:43:05");
INSERT INTO users VALUES("31","Suchith De Silva","suchithde@gmail.com","6531d595760573b99d157aef0c28bb0af71a3e893226e834eb4bddb4ecd73307ddcd737d4f4820f7e4a1a31af7b6d542d8fcb157eb23048c48beb71b1a4088ca","7818359737","2015","1","R","1","1","0","98.229.121.162","2011-09-13 20:47:55");
INSERT INTO users VALUES("32","Andrew Kuida","andrewkuida@gmail.com","759458aa200eb28d88ed895b59335e08272a2bbb35343b7315268c011062398ed90f615041f571b3c8e4a32c3060c86c2cb6b5e02935afd05e35825f1d50cb34","7813256541","2012","0","L","1","1","0","173.76.202.61","2011-09-13 21:28:04");
INSERT INTO users VALUES("33","Zach Polansky","zacharypolansky@gmail.com","06a18b7289b52a7f8b53b04256b2623adb6a1d073478703e411d1a98d6e33f0f122bcaaa454ccd34e87e3478bfc5dbdc2f373cd4675231f47d0f1dec67ac807c","None","2015","1","C","1","1","0","98.229.177.224","2011-09-13 21:32:14");
INSERT INTO users VALUES("34","Peijin Zhang","xzhangpeijin@gmail.com","473c222bfda83e0336f94d7f5875acdcbf56c6706394abdba9e349f24f012ddf6f05e616a13cb9fcb19ce0d3be305e49080481763ac83be6e8cbfe6fe2334eee","None","2013","0","L","1","1","0","146.115.67.130","2011-09-13 22:55:05");
INSERT INTO users VALUES("35","Ray Wu","raywukungfu@gmail.com","1b6fdcbd9a615e452f3d5fd48a04837d610a61dc431e6017421c0a8ac7990608c046b0287d499bd4cf78432a02d39a1e6e202ca58f2eb788c008da373655353b","8583361819","2015","1","R","1","1","0","76.119.105.131","2011-09-14 00:46:14");
INSERT INTO users VALUES("36","Henry Li","henryli78@gmail.com","7e54ceb31901e85b3a4f73e6013a3aa8996e4d0b9d8a6129848d1b323c95499759c19ee4b4e5c2ee1b639c037042eabea63b72bc4df474bc842b391ce0a0d97d","6178339757","2015","1","R","1","1","0","146.115.72.98","2011-09-14 07:14:26");
INSERT INTO users VALUES("37","Noah Golowich","noah_g@verizon.net","4858a7205bb4bbfa5d8919a6fdb9dacd6bfdd5fe8b2c106ae0a9ab5a8af308c92aefcb08ab7fce97e42427a4fd1fc8710ad1503d026fd16064928d8612cdc8f0","None","2015","1","C","1","1","0","173.48.165.171","2011-09-14 19:43:23");
INSERT INTO users VALUES("38","Nikhil Bajaj","nikhilbajaj27@gmail.com","43cd2404e9a080059d3bbf61cc2fb9243ecbd2f33c5da91d35eb01f0b4e38625ed9f40f95962074f692e67f2cba76a3db20968595142f328e51a86d33efe9bae","None","2014","1","R","1","1","0","96.237.236.189","2011-09-14 20:04:00");
INSERT INTO users VALUES("39","Charles Li","chuckli670@gmail.com","9c95edb5a7ed3f27807691dbdede39295d0fed70c6a2cd30423abd0a489788a950f8cda6ee292e736e6cef44039835a756662d59347f73308761cc82890c3ed5","6176336799","2015","1","R","1","1","0","146.115.66.157","2011-09-15 17:17:27");
INSERT INTO users VALUES("40","Dan Kim","dankim3965@gmail.com","52c9eeb07dadd4076e0acd2ba16f8ef57e0c355f8174f21c91866aa94dabbafb7e0d75949cbae6d5dd1154277ed07954d488e4212f5c3c1c6436054ade08c850","None","2015","1","R","1","1","0","209.122.160.124","2011-09-19 14:40:45");
INSERT INTO users VALUES("42","Allen Li","roflcopterx1@gmail.com","7ed143bb04411ca53b7749e9e341b30bd2f34be79ed90b122e739e15bd3b5f76730d2d60812535d2356045ebff7b799fbe861c52bc1a9ab44ccf23dc1fa49533","None","2014","0","R","1","1","0","76.119.104.50","2011-09-19 18:04:09");
INSERT INTO users VALUES("76","Daniel Wang","daniel08854@gmail.com","3077720209f3315c2cbf80349564fe68dca968ec58600ff335082558271ddc0b57cad871aade4f70c0f73130909c127e6574f211c19bd6f25d6c7177644eedc5","None","2015","0","R","1","1","0","71.245.236.94","2011-10-02 20:31:43");
INSERT INTO users VALUES("55","Katie Fraser","mathclub10@aim.com","cd32c9ed26471becd73169f24bc56af62ab168d6a6a7eb1a524744d728017e719ac7a5b53612246bef2d4d9454c1d6d873b13aea5b1e0e8aaaf8c646387ddc55","None","2014","1","R","1","1","0","209.122.160.124","2011-09-26 14:48:26");
INSERT INTO users VALUES("142","Roshan Padaki","falseinfinities@gmail.com","158548ee701595eae876da4a1ec71f3aed918308e41315645aee1d883c8e4de55369da3c7292e59507f6a72a038125e153dd95bc0c87c65c555a9f022f3de912","None","2016","1","R","1","1","0","108.7.207.44","2012-09-24 16:58:38");
INSERT INTO users VALUES("67","Tanmay Khale","tnkhale@gmail.com","abec03a0cea9c570929075b79294acc157c891aeb9f4ddfda3688c5eb8eb168dc253e8d3e73493ac74549718e369e9c50634c13855dd3472e0288f1df2005692","None","2015","1","R","1","1","0","76.119.104.85","2011-09-26 20:32:06");
INSERT INTO users VALUES("54","David Yuan","dxyuan@gmail.com","936997519dfd00db5b87c89860cab43363dd3a8ae5ad6809e35ff2a42c917d09505f8334be5b3f52b1174c1b9c281632765f3b94a16358e7985fc06404dc7891","None","2014","1","R","1","1","0","96.237.181.188","2011-09-24 10:06:48");
INSERT INTO users VALUES("57","Tim Lung","timothylung1996@gmail.com","73cde3499c9b3247e7ae9f9cfe51cf1f6fe534c8b31e8dcd80d6c0d305818bfdd5c63af4c5ef9236540825f436088fe48b1d542ffc3cff528d9e2725ec95b018","3392230201","2014","1","R","1","1","0","209.122.160.124","2011-09-26 16:03:23");
INSERT INTO users VALUES("77","Alice Ren","alice.xy.ren@gmail.com","cacd30e61372fa5164ad275b438ceeb35e8c4b2124a1c0c4acd722c5c12560a0c753a43018e99ecdde48bbe4cb74feafa197f35604a870a41f1fd1f5f9bb5aec","None","2014","0","R","1","1","0","209.122.160.124","2011-10-03 14:27:57");
INSERT INTO users VALUES("60","Matthew He","","","None","0","0","T","1","","4cc103e27f07536d1542","","2011-09-26 16:26:14");
INSERT INTO users VALUES("73","Celina Hsieh","ctthsieh@gmail.com","fe2a315e6b1ca7b3565aadce1084e14642196b6e6facb0fe4ef155c6f73c3ec09d9826963052fb7d5b87023bc7962f4f05827897544ceb8776eb966ee2dccc0b","None","2014","1","R","1","1","0","173.76.25.12","2011-10-01 20:09:21");
INSERT INTO users VALUES("62","Chunyi Ye","","","None","0","0","T","1","","0","","2011-09-26 16:27:29");
INSERT INTO users VALUES("70","Huixin Zhang","huixinzhang2011@gmail.com","5cdc0826acb363fda186e82428f2f5d66dd8c25e6ffc5b352d8955a66350f5109d05d28673beebf963780c54dd068e72303da9b129b6d3ed4befe7cfc129db34","7817384928","2013","0","L","1","1","0","72.93.83.102","2011-09-29 22:35:57");
INSERT INTO users VALUES("65","Alex Sekula","sekulaalex@gmail.com","9d3d54b2784db755f438360b7eaf10de7995797b06fe8502545586805480102aeaabb69e555aebcad8f7eb4dfa081bddbd6d01297adcba4cf56b4a0a997c68f0","7818793202","2015","0","R","1","1","0","71.245.236.216","2011-09-26 16:37:19");
INSERT INTO users VALUES("66","Alan Qiu","aqiu19@hotmail.com","532b00228d939ce415142f2809c28c445fee36b952c0ea62d8a49fa4addcd413164508cd134a02358670c26d81ea003d741512a5926e339d2187c34a1e4cc86b","None","2015","1","R","1","1","0","173.76.25.242","2011-09-26 19:12:50");
INSERT INTO users VALUES("68","Tadafumi Ikezu","tcikezu@gmail.com","18cfeea858a5edfc2b58cdb69a3401b2180b2c43083e9847971579759cae63682ee1cb4b215aafd5584978a7beae4c9c6994c4f51bf735b66354c347acc4fa01","None","2013","0","L","1","1","0","108.49.114.126","2011-09-26 23:58:18");
INSERT INTO users VALUES("69","Diana Kim","kimyoonji@sch.ci.lexington.ma.us","0465ef8d214df14bf9f34d5656f8ab42f9f1c0030086db8a04a30137eb681c9d84f9170c5c6654c347a31e95d2bc38a53e5e2a9c94316ac4786f6957fb4462a1","7818506070","2014","1","R","1","8575e50d3562c254bfaa","0","71.174.188.16","2011-09-27 21:29:59");
INSERT INTO users VALUES("71","Anindita Chanda","jchanda2009@gmail.com","4d302634ad36b62478fe6ceaf155dc4bdcfb3452d6446ed54fcdec7ba26df5548b1e105f7bed8d80711b4d30b7532943526a61b5c3513a651f40ecda025d33a8","None","2014","1","R","1","1","0","108.7.203.183","2011-09-30 15:45:45");
INSERT INTO users VALUES("72","Steven Qiu","flymousechiu@gmail.com","c1c96642c0713ef0b6666a5a1b1fba7f03d960391ceda49fa4820d34603bc6d5ee455997006765d8a8a567d85738b180e24ea2274b2cccf5a504134f3632b269","5082715555","2015","1","R","1","1","0","108.121.150.120","2011-09-30 22:05:51");
INSERT INTO users VALUES("74","Kyuil Lee","asokyuil@gmail.com","76eb84169b0348f45eefd7cc19460da22c55a1d2dca9e17d0fc486ead629f8afa1e98cced807b468243928ad2d02c4bbc95404d2879451f0ce562bd33ec28bd7","3392231084","2013","0","L","1","1","0","96.237.189.243","2011-10-01 23:35:14");
INSERT INTO users VALUES("85","Nick Zhang","nicholaslzhang57@gmail.com","8cca888bacd9f6627371d8e5daae670aacda50ef01070f2fd852e1e8ad048f2ae37f61545b25a9f15f92cf2859e9f3de2bf2af7b08b0fc584b872a950b259b70","7817102300","2015","0","R","1","1","0","72.93.83.102","2011-10-04 19:12:09");
INSERT INTO users VALUES("81","Aaron Thiagalingam","","","None","0","0","T","1","","0","","2011-10-03 15:20:29");
INSERT INTO users VALUES("83","Eric Xu","randomdragon@gmail.com","5b1852d44ca223a82a98724f8351aea3a7166f66ade8bdc6c8e2a20514ea0902ea5beb49bcdcccad130ef335cd556ab972eeb09b68995fdccd71df8183eac0c7","None","2014","1","R","1","1","0","173.48.165.105","2011-10-03 21:13:18");
INSERT INTO users VALUES("84","Anna Papp","p.panka@hotmail.com","c55a2ebb5260d84dfec6674402d81e2f1f9f251f303e4470dac1b79f888626401438a6ad9e33fdd86f63131e1a107253e165c3ee7488111a61038d8e31dc8383","None","2012","0","L","1","1","0","96.237.189.209","2011-10-03 21:16:44");
INSERT INTO users VALUES("86","James Lung","jameslung1995@gmail.com","0b800c2eca71dcda6de6004d45c4bea7963cef27db403a8f4630704a5f7e764beeb5f3136ee175feef13ab6d1a5b79decbef75803a3d7a083e910a591f5df8ae","None","2013","0","L","1","1","0","74.104.155.162","2011-10-04 20:04:31");
INSERT INTO users VALUES("102","Jack Deschler","jdsoccernut@yahoo.com","94d95cab2ecaea55fdef6b617d93fc6bd1720be622fa3d79e138236d66a9734c9a14df59eac4dfcb6a610da3cd5b4e9642a2ec50b8ad91a979ad44f1203b13e6","None","2015","1","R","1","1","0","146.115.68.19","2011-11-14 17:31:24");
INSERT INTO users VALUES("91","Bharath Chari","","","None","0","0","T","1","","0","","2011-10-17 15:46:28");
INSERT INTO users VALUES("109","Yoonji Kim","artemis11011@gmail.com","6a4e5545a95799a3be69793f61b68b23f007c5a9c581cfcaa0ab178b33a56a8c6f1e5ec68fd7afb693bef4586b446fc982a7286dbf60b07ef28dc6a4a6c49db9","7818506071","2014","1","R","1","1","0","209.122.160.124","2012-01-23 16:22:09");
INSERT INTO users VALUES("95","Shashwat Patel","shashwatjay@gmail.com","d9ba02d8b32ad4fc4d69d72f38308fdb6957d7039fca92a45cb4f179210c0f774d8820f3dd3345cfb22c162d6fc9bea580c03c03937f6f0ef0b2dfa6473b2e28","7816971109","2014","0","R","1","1","0","173.76.253.104","2011-10-17 18:51:49");
INSERT INTO users VALUES("96","Mayukha Karnam","m.karnam15@gmail.com","62d255105be3850a73166a66e8347eea1f376c424c4b666d8f57e0a246722b4f80215d54672050a1196b7c553a128de483729c0afe6c0a1d61ee2cbad4d47212","None","2015","1","R","1","1","0","74.104.168.131","2011-10-17 20:37:08");
INSERT INTO users VALUES("104","Aushee Khamesra","aushee900@yahoo.com","b627c508ce56cf4beef50b218a387edab499e2063a818c39b1128b8391ee7f62b9f8a2db50826a2146e96b14efd1a51282f46d2963a80864f39b9492de481f88","None","2015","1","R","1","1","0","209.122.160.124","2011-11-28 14:40:58");
INSERT INTO users VALUES("98","Timothy Zhu","tim7zhu@gmail.com","849cbc9d06e521d459609b8d15de83030b4a576aa4c0a932d9afe394a973e562295a4688ebc4891337bfbdb04bcd9a11f3f4b8215e08eac9a9c8e81671ffe55f","7818167073","2012","0","L","1","1","0","98.229.178.108","2011-10-25 17:24:57");
INSERT INTO users VALUES("114","Jerrick Chen","","","None","0","0","T","1","","0","","2012-02-06 15:12:52");
INSERT INTO users VALUES("105","Annie Ma","","","None","0","0","T","1","","0","","2011-11-28 15:47:15");
INSERT INTO users VALUES("106","Albert Roos","aroos@sch.ci.lexington.ma.us","c2090b94e6cdf0dc970a4fc3765f3fd5c7f5c98cacc0b5df9fb748a0cf28c0b3ea14623207c64f097fa2cb371a42b20ab784844f29c9c43a53dd7a052c156648","None","2015","1","R","1","1","0","209.122.160.124","2011-12-19 14:39:41");
INSERT INTO users VALUES("107","Albert Kung","superazn99@gmail.com","8d35dd80f32786e972f5ccbaad72970e0c32b7538c3276116f55885ae235bf791635549cdb40af038f677dc579d67d8258de50ef45aeff18a2701e5f8dc133b0","None","2014","1","R","1","1","0","96.237.236.240","2011-12-19 21:25:20");
INSERT INTO users VALUES("110","Alice Zhao","aliz6271@gmail.com","eebf51c6bc9111903e5a76b0db60a39a4efcd9db70e1d1df87eae1d3c68b6e4efa3b2cc8d2938bdf2f74009f050e3c8f97f2ef9c9a8bf6e5227cb58c55baa528","None","2015","1","R","1","1","0","146.115.66.164","2012-01-29 19:43:01");
INSERT INTO users VALUES("111","Hanson Duay","","","None","0","0","T","1","","0","","2012-01-30 15:17:03");
INSERT INTO users VALUES("115","Zaroug Jaleel","zarougj@gmail.com","bf9b78f7e08c758ad4db25e3c206bd83fae97257d82f4163a31e573361908942c582008e8230b9e48e7c811c3bcb0e3831912c750665e9404a6d6cadb7f59ccb","None","2013","0","L","1","1","0","209.122.160.124","2012-05-02 16:22:05");
INSERT INTO users VALUES("116","Frank Wan","frankwan27@gmail.com","4efc60d18b2e39e951ad0cc3f3049459445231cfee47020a7184051e76bc3334fb29e7602113b9e3338db7992cea7326ebf70cf09f9ca32b8dd2cb26b29cfa07","None","2015","0","R","1","1","0","209.122.160.124","2012-05-05 09:35:47");
INSERT INTO users VALUES("117","Devin Shang","shangdevin@gmail.com","35434286f43f2e45ac7aecb8f7e6dd208ea523bdef9d6d6b449e0a1c67044949eb9da682071b0e19e13dbdadcb2ac5c45ba63beb0c5b24a8f697a9b6649166ee","3399278372","2016","1","R","1","1","0","24.62.126.68","2012-09-04 22:22:53");
INSERT INTO users VALUES("118","Uma Roy","uma.roy.us@gmail.com","9bd6a939011113c1579a3fdcd114849561130921d13b220c39d07999ba20f4638cb8f02f112e06778db1d272f22ed444b5567fbc4b5bd79baf83203ab7f548be","9784296615","2016","1","R","1","1","0","71.192.8.122","2012-09-10 17:02:55");
INSERT INTO users VALUES("119","Richard Huang","richard_calgary@hotmail.com","2c042e470cf0db4005e54e5972bd26193123b95025c664d9e94e90d8114d648fe2eb0f3b12f3dd140bf1164527da75fb635f3de098c1593a204393cb865070ad","None","2016","1","R","1","1","0","173.76.253.218","2012-09-10 18:32:09");
INSERT INTO users VALUES("120","Brian Wang","brbwang@yahoo.com","d7e49829d2af5ebc212bd54b325b7c0b945e6df2d43a7fdb7cb403afd4eb2717a409571b4c229d2ea25cca8c6e165c2a363d94a5e5c301d595e5e9b58d330201","9788469701","2016","1","R","1","1","0","173.48.164.127","2012-09-10 18:41:27");
INSERT INTO users VALUES("121","Eric Xia","ericzxia@gmail.com","cf441ddac76e3cf0c1f8218fc219996b04ca4588145a4874b8e0fdd8a1fa3dfac69c7108bb4808c3a23b5e3f75bf60f4a1a2287ac2dbd47859cc0c0f4b776130","None","2016","1","R","1","1","0","98.229.164.109","2012-09-10 18:48:25");
INSERT INTO users VALUES("122","Kara Luo","kara_luo@yahoo.com","0c7575bbbfacbcac7d68bd5ab51736322bd7720c0bb5ba735357fe05bd8dc16c2ce043edb2498c6805b34fc5bdaf57bf65652bcd9a7b81d6c12120d3229beec9","None","2016","1","R","1","1","0","146.115.70.205","2012-09-14 19:39:32");
INSERT INTO users VALUES("123","Andrew Luo","luo_andrew@yahoo.com","729dac2b5ab838fc519f86acc6d6f1606231f4033b29b5372e8d2f6e3d9cd330c36a2d435e359ac3be1a4fef02424c6a0651cce0b2e562b2bd15d7626ad673b7","None","2015","1","R","1","1","0","146.115.70.205","2012-09-14 19:41:43");
INSERT INTO users VALUES("124","Clive Chan","doobahead@gmail.com","cb7c0adb170bb5d6c38601366bc438975e0d2d27fe768b8dcbf7acc7399b2d22f444f364f6b79483c29c5d94db4aadfb707d1ece944549b3929599d1a4ec3bcc","None","2016","1","A","1","1","0","24.128.1.168","2012-09-20 17:35:16");
INSERT INTO users VALUES("125","Ethan Zou","eazy975@gmail.com","ad256de6f68ca4bed46cb96b71dad61780271e44c7329171b74bc52ab855869ffbd8fc0aeacf108207ffe2e1e6b01dc2659a8b00cde9e21c9edc83874491bb48","None","2016","1","R","1","1","0","173.76.202.148","2012-09-21 16:50:30");
INSERT INTO users VALUES("126","Tanya Sinha","tanyasinha23@gmail.com","7aec8b61e9547c1d6b4ac1287db6d5b55215c7df4d33eb112f7da46f8db375cc165cad5e89881db155e56a332537f14a4763485f1ff43e620ef5ccb23afaf997","7816986306","2015","1","R","1","1","0","24.91.156.18","2012-09-23 19:29:58");
INSERT INTO users VALUES("127","David Tu","ssd20000@gmail.com","a83eb613a1781c34a7199f3415afec5a05aa9a55b1dcc51b985cd1d84c60ef9f4e5cd063f0b0fc99a4b5bb830a7f52e795117f1e0488a7fd694649a73ff02f32","6036615481","2016","1","R","1","1","0","146.115.72.15","2012-09-23 19:31:18");
INSERT INTO users VALUES("128","Mohammed Khan","bazil0117@gmail.com","1ea324bd06209a4d792c34b8ba6190a3078a00b7e436d4ac7e71ec649c06805d47dc101dd55d73095f5214544bf55b6a1da0f864428d6c600c8bbf332ac6ac78","None","2014","1","R","1","1","0","74.104.168.8","2012-09-23 19:46:15");
INSERT INTO users VALUES("129","Eula Zhong","eula1998@gmail.com","425bf3a8b3f2707896efa5644e3e80ff85fa2bc0f545a9091905702269e16f97b074b21c0cef845ee197ffa2a64c4a1f4f01959230a17bb3843cba32c35ab383","None","2016","1","R","1","1","0","96.237.181.33","2012-09-23 20:15:43");
INSERT INTO users VALUES("130","Lalita Devadas","lalita.devadas@gmail.com","b6c519834888ab687bb80cccfa5118d7ff63a92e7ea266de2d2f99871caa20a77466dd1b9c70e80c8d6d9ffa39f1f77138219d92d88974d94ee86b64c52861fb","None","2016","0","R","1","1","0","146.115.75.22","2012-09-23 21:56:59");
INSERT INTO users VALUES("131","Yihang Li","alignihy@gmail.com","01adb6cd681edc54bc490da236ab64e0144b8b3e57a19450c9c5787bcb0bb0f31aa2c4f7ea6e674807cfb243985f2323249c042686bfacd622a7ded97dd91652","None","2015","0","R","1","1","0","173.76.204.219","2012-09-23 23:14:57");
INSERT INTO users VALUES("132","Soumya Ram","soumya1910@gmail.com","011590f3ff239a3181e464f03c050ecd36f32fad7f39b8913583e9578f3d350494754b249f9fbea0b83334e32ff5965c4001485be98999bf51bc61bf8a1e2d07","3399701272","2016","0","R","1","1","0","24.128.0.81","2012-09-24 07:32:09");
INSERT INTO users VALUES("152","Sriramani Sivapurapu","","","None","0","0","T","1","","0","","2012-09-26 11:43:56");
INSERT INTO users VALUES("178","David Amirault","david.amirault10@gmail.com","d10f6b302af3d08b31ecc6e1d18cb248b784d4eb65ae8631a7fc10b6d266dd980d4032a30459a43585abdbebfa6ee9a36a1aec7e5ad0bb24c257e855d269757d","None","2016","1","R","1","1","0","24.147.16.53","2012-12-12 21:27:49");
INSERT INTO users VALUES("135","Lingrui Zhong","","","None","0","0","T","1","","0","","2012-09-24 16:24:43");
INSERT INTO users VALUES("150","Paul Kim","","","None","0","0","T","1","","0","","2012-09-26 11:41:03");
INSERT INTO users VALUES("138","Andrew Wang","","","None","0","0","T","1","","0","","2012-09-24 16:26:52");
INSERT INTO users VALUES("147","Alan Burstein","burstein.alan@gmail.com","be9df2daa5fada606db6843fc9534461f8f88ffef9fb19a28992df694b6227982b61e13db54d2d1b2e9c66c7b754b8c811378c97597e82f390d70338905baf6f","None","2016","1","R","1","1","0","146.115.73.3","2012-09-24 19:45:44");
INSERT INTO users VALUES("143","Matthew Weiss","weiss_matthew1@yahoo.com","2074673f3e24032d24f966396b2e951962db3787ed60bc727a1955b1d00481a82ce6c5bec5248bf7509fb77743698e262e6260981c7e0e3119c140664ba961e4","None","2016","1","R","1","1","0","24.62.100.121","2012-09-24 17:24:44");
INSERT INTO users VALUES("144","Arul Prasad","arulpras4d@gmail.com","80003bba5d1a82890e872097276837303fc4f841944dfca6a136858a6de69da3175e56bff0f8c595d958aa431132e78a124825e3cd125a2a2328481f7ee46ec4","None","2016","1","R","1","1","0","173.76.205.132","2012-09-24 17:32:36");
INSERT INTO users VALUES("145","Albert Kim","albigator@gmail.com","c0e5934fc3beba4b378658506c99f4a8e207356109b18eeb136d19eb853d36a4b7042afd653f8f090b22876eb2327b9f0d3863d35c2903e9f05f373ff78f020c","7818795676","2016","1","R","1","1","0","24.63.191.224","2012-09-24 18:23:47");
INSERT INTO users VALUES("146","Haochen Wang","miyokoichiro@gmail.com","1660bf4635c4ed571d62686d3d68f4cee30c9974ff2079eaafcf4042f84b58502dd197bbe3b2dedb5fa55fb5bd0960655fae07dafe695fe6bc3ea1b2ae6e99db","None","2016","1","R","1","1","0","146.115.73.104","2012-09-24 18:47:38");
INSERT INTO users VALUES("148","Yoonji Choi","yoonji.choi25@gmail.com","09ffd6ca89eedb31bb40dd65680e32a75ef10e05e5b9bf19cb71bbee0c05c458ec5f297f49e16210494358c3a0d32806a8316f0e2d04b5ef575df580f2c1532c","None","2016","1","R","1","1","0","24.63.190.33","2012-09-24 22:13:56");
INSERT INTO users VALUES("149","Yoojin Kim","kim.yoojin97@gmail.com","15ba783039185ca92645cd5a69117bd763f29db7e4d5e9f486a3352b1c37000a11a9f20f1c4890145b90e9bdec24b18d38ee8c78228a0cca4dd80c5e5eb8e5cb","None","2015","1","R","1","1","0","108.49.139.85","2012-09-24 23:36:53");
INSERT INTO users VALUES("153","Esther Shin","","","None","0","0","T","1","","0","","2012-09-26 11:44:31");
INSERT INTO users VALUES("154","Jueun Lee","","","None","0","0","T","1","","0","","2012-09-26 11:44:48");
INSERT INTO users VALUES("161","Janey Lee","","","None","0","0","T","1","","0","","2012-10-15 16:30:29");
INSERT INTO users VALUES("168","Andre Verner","averner@sch.ci.lexington.ma.us","ceee0b6459e8e62bf2eb35c20e9826c39f2f755542a2c44eb3610306e33af878c139e471244a129e2e86eae9561813199d2ce66d65e651cfedf388ccb43d00b9","None","2016","1","L","1","1","0","209.122.160.124","2012-10-31 14:20:14");
INSERT INTO users VALUES("157","Zhiping Wang","","","None","0","0","T","1","","0","","2012-10-01 15:30:25");
INSERT INTO users VALUES("159","Bharat Srirangam","bharatsrirangam@gmail.com","e134144b9cf15a5c6a1e6fcc8e02216ea16dc738d736a7c474053148cbb965254506b5bb581c05ddd7befcf917cb5f7cedbfcd1ce16000bfefe9d961d8bb0061","3179027190","2016","1","R","1","1","0","98.229.178.154","2012-10-02 18:53:12");
INSERT INTO users VALUES("185","Christine Kim","christinekm22@gmail.com","4973efa713a0986c29cced9b61e3355fc3f465fdc74422144d4c94819390f5c5ebc4cfd32bfbdcef1b34781120fcd40f03757ab460e9bc4279ac8c8b57f12fd8","None","2014","1","R","1","1","0","71.245.236.58","2013-03-12 21:56:06");
INSERT INTO users VALUES("165","Arjun Khandelwal","arjnk1@gmail.com","305526f0cc56eb0165c16bae2e60654fb76e2379be79ab46fcc5124aa5c2cb8c0a04063ba0b92cb175f16e9b5b16f9935b96c05dbc9c69dc87f6cd7f1199cbf8","None","2015","1","R","1","1","0","24.128.1.196","2012-10-22 17:29:15");
INSERT INTO users VALUES("163","William Kuszmaul","william.kuszmaul@gmail.com","3056f7ce6a74926b1f5ef54218841c69de5390bf3fb2990333d3bf9fbcabddb9ad047fb246d65d5fe5590c38f647aa84b35393f696e507aee5e14a6ff2855a18","None","2014","1","R","1","1","0","209.122.160.124","2012-10-15 16:32:07");
INSERT INTO users VALUES("166","Reggie Luo","reggieluo@yahoo.com","2643b7844dbfd2c5ebfb8d516281003453e250d22e10e7c8c2135dc0930e48ccd4173b9792daff1f446e398813c51983331c593df0ee1ce33ce7a9000a8cfd01","None","2016","1","R","1","1","0","173.76.205.167","2012-10-22 19:25:59");
INSERT INTO users VALUES("167","David Cherepov","aliasup@yahoo.com","93066bc0149f613d2a1c2cf01db1d68d5b17a78c7e32cc27c03857e78a5399607c8de53b12248ab58e20a6090700b031ef87fe7b745f11cc075d24266c0fc8c4","None","2014","0","R","1","1","0","173.48.139.97","2012-10-24 22:00:16");
INSERT INTO users VALUES("169","Diana Kim","yoojm@yahoo.com","9f77d4db12835a8d5f1329fe9c26570c2bcb0921af8687917d541278308f51d98a7d225aef42ff5c3321ab7331d62bca178fde78cd39364ac83fe6db97f10695","None","2015","1","R","1","1","0","24.63.191.224","2012-11-03 23:47:30");
INSERT INTO users VALUES("179","Daniel Li","","","None","0","0","T","1","","0","","2013-01-28 15:10:32");
INSERT INTO users VALUES("171","Alice Chiu","","","None","0","0","T","1","","0","","2012-11-05 15:48:29");
INSERT INTO users VALUES("221","Rachel Zhang","","","None","0","0","T","1","","0","","2013-09-27 17:10:29");
INSERT INTO users VALUES("173","Audrey Li","audrey.y.li@gmail.com","cf7589dd326fdf50cd20e4458d9be083b199b878b5f72bac85246ac8d83a1870b2f9822bf6689c447f93fd25c7c6eee7ca26915a2c26d9fbcd5188b08de5c304","7818649122","2015","1","R","1","1","0","98.229.161.123","2012-11-19 19:35:01");
INSERT INTO users VALUES("180","George Chang","","","None","0","0","T","1","","0","","2013-01-28 15:12:29");
INSERT INTO users VALUES("177","Rahul Ahuja","rahul.ahuja.raa@gmail.com","83f5c9b498189f0a0b5363753d2939319c21fee9976f113b05231e8fccc6958a50e2722ce34c7dd3b80b0905c47c171dff662a317ad8e6cf652759c8cb6d65d4","None","2016","1","R","1","1","0","209.122.160.124","2012-11-28 07:24:30");
INSERT INTO users VALUES("181","Kevin Adams","","","None","0","0","T","1","","0","","2013-01-28 15:24:15");
INSERT INTO users VALUES("182","Jessica Zhu","mengyazhu96@gmail.com","8536f573dbe76a21f2ace48be1e86a49135f0471887ca479c1b18a4c5604d4fa4018a77740d955583c9f409fd7f75e28698d800baeb6d38424be5a92805b70f7","None","2014","0","R","1","1","0","209.122.160.124","2013-02-25 10:52:53");
INSERT INTO users VALUES("183","Filip Bystricky","filipbys@gmail.com","f88d15a564aea28d186d956f1824a594f5314c8d82dd4c11bf17e02a1aecca445484becd2799cf14d753b66e7ba1a30ca69893584711a9692e3173a51fe2ad51","7817750475","2014","0","R","1","1","0","146.115.68.151","2013-02-26 19:12:22");
INSERT INTO users VALUES("184","Mike Amirault","michael.amirault90@gmail.com","f93c0504b206f01de7949cf2fbb07eb85a00d526edb99e27fc74c3d92b7c5b0b6b4a856e479b2b62ac22898672c268f97de8148737be335768a1a8082794d58f","None","2014","1","R","1","1","0","24.147.16.53","2013-02-27 00:04:53");
INSERT INTO users VALUES("186","Anna Birna Turner","annabturner@gmail.com","c95a6e63140ce1d333ff98cd92a655ab84ca293ac4d71ea32e62cd4355cc93d098a3a06395d12ea45d3d127db84dbf45fbb983a58e20c319f7d1c430beac91d3","7812497761","2014","0","R","1","1","0","72.74.50.172","2013-03-16 16:20:38");
INSERT INTO users VALUES("187","Divya Dharmaraj","divyadharm.11@gmail.com","a332c78d0ac1c31ced8ef677f3a308cab91b275c001358ae4fccdbad6d0fd597a10773c9d85be249ba45475cb35a8e644e482dbdb812cd6e8f795352f358009a","3399278999","2014","1","R","1","1","0","98.229.162.126","2013-03-28 22:50:41");
INSERT INTO users VALUES("188","Anish Kt","akanesathasan@gmail.com","4e8395f50d2f0ef28016c63e2df56878f7e1cfed834f06cdb5f111687acff01dad2dc503552ad2a9b1010ed0c381997741cfef6f245537d67bc1a0f88557aeed","None","2013","0","L","1","1","0","173.76.253.6","2013-03-28 22:59:40");
INSERT INTO users VALUES("189","Brandon Nguyen","brandon.luo.nguyen@gmail.com","40c2b62b252947fc44755e27045976ca9a50ad80d9c2740198276cf9e54ac459a880dfc2b611c6430d174ae8e2c8aa2a2ef1d1c436f9962671ff9f645de955b3","6178947366","2016","0","R","1","1","0","71.245.236.251","2013-03-28 23:36:44");
INSERT INTO users VALUES("190","Claire Huang","lulu_claire@hotmail.com","9873d6a829ee82b457194c47ff1ade8b3dd194f48ca0bbeceb6ca3b9d457ee88eb7a225263038de41862a1e990e57b2010de4ee730dc604836dd2500897a6454","None","2013","0","L","1","1","0","96.237.181.217","2013-03-29 00:01:55");
INSERT INTO users VALUES("191","Vikas Shiva","shivavikas1995@gmail.com","91122177ebb0f6d4f297e699e4222e7194c4251b8be65915eff59472fc80d90e7c08bf43d89ce5b8e8299fd13fa076960f131c660aacc91e68e1780396639f8c","None","2013","0","L","1","1","0","173.48.139.239","2013-03-29 02:03:09");
INSERT INTO users VALUES("192","Natalie Tsvetkova","natykot@gmail.com","796d188c796548977f28c2c1e483b1e0bb30bb11a61d47b1def69b5aabf9b733931866e5c24f6f6bc714bc747d5a369cefaf3de3c5b5c77cb7da4fdd9d91e11a","None","2014","1","R","1","1","0","173.48.165.56","2013-03-29 21:57:52");
INSERT INTO users VALUES("193","Josh Karnofsky","joshkarnofsky@gmail.com","ee5df13519a4e8f7bd7f9aa8c6536a66a704e7ea24a829152cf32e0be947dde7b164b4b43104a0600b655d8cd59023fbb6a3c6546d0fbed5c0c1b65f3598be00","None","2013","0","L","1","1","0","72.74.255.232","2013-03-30 07:09:42");
INSERT INTO users VALUES("194","A Aaaaaaa","nothing@yahoo.com","2c9aa4707356e4766555b79a025118b55dcb1aa38a73026d5c6414c7f3c50938cbc74eb51a20872e9333ea221e5ee3dbe731493e763da938032443aff4eec40d","None","2016","0","R","-1","d7e05d5617fd63f8dacb","0","67.174.155.20","2013-04-22 02:40:51");
INSERT INTO users VALUES("195","Wendy Cordero","cordero@sch.ci.lexington.ma.us","c3d284d255e6fc9967950244cbc02500ea329966227aadc9bd5b0fa87fa4fd5f728c9be484da2d9402ae57c691c9325c7ae3b1c8596bab1acbe83425f4806df1","None","2017","1","A","1","1","0","209.122.160.124","2013-09-04 15:52:01");
INSERT INTO users VALUES("196","Nirmal Balachundhar","nbalachundhar@gmail.com","97b2b8c7ad2e666a9fb592ac3d22daeb13f832babb39e848d9052aee7185cb130b859f9ee8f924789a3d60eed383d25728dc8bf0187ee910c7555d2fb5854e7f","7818641811","2017","1","R","1","1","0","173.48.165.233","2013-09-11 16:03:47");
INSERT INTO users VALUES("197","Kaushal Balagurusamy","kblusterpurge@gmail.com","6b23321f82307178c23d07fdca70d3e0412ad9153f456213599e62fdff5d3507a9992eddb502fa5810950edcb28ca17aaac36d22e815f269faa3fb0a1ea6d8b4","None","2017","1","R","1","1","0","72.74.255.229","2013-09-11 16:13:23");
INSERT INTO users VALUES("230","Afareen Jaleel","afareenj@gmail.com","0bde88520337d1fd7491dd7005c540521c1bbc2681532dc3f4b2524a6495ed67f378aeda7fba6671da672d392d71d4ed79aab8ba63c2d0aea943388f90b843d2","None","2017","1","R","1","1","0","96.237.189.188","2013-10-24 15:47:47");
INSERT INTO users VALUES("219","Julie Suh","juliebean1999@gmail.com","12ad6a426bee759b34739be1664948c42d86b4890e87d3e964d9b7e212e3697085517a891fc14ef0d6b812e7aad0346a4fe37b97e46b280e900cf1b957c78d33","2147992553","2017","1","R","1","1","0","198.228.200.168","2013-09-21 17:02:19");
INSERT INTO users VALUES("199","John Guo","johnguolex@gmail.com","3cd1fa584ab01ff9b0499c8ce3f0ceef4d025205ad101cb1767ffa41b61530b88dc6bffd560d28149e8f7258107aa63dd3465e969b0923d8b94ef636ab4186fe","7813252787","2017","1","R","1","1","0","146.115.72.108","2013-09-12 21:53:59");
INSERT INTO users VALUES("200","James Liu","jamsliu11@gmail.com","66eed28b773f424d0320c956ce0e5befddc9bf95383a0dfc1654b8fab0eeda4b2ebf96b93432b7f30f58e06cafcd4d5831fc4632dfa8d0904e15404f2412bdbd","None","2016","1","R","1","1","0","146.115.69.125","2013-09-13 16:56:57");
INSERT INTO users VALUES("201","Jeff Zhu","jeffreyzhu1999@yahoo.com","3816707f0f633f07823e9f302a79a2974dce69142553f16acd155185d7668875e2c7389925528c28b5a5282b5d52ad76d263aafb670bce9726a2b8bec13b458a","None","2017","1","R","1","1","0","50.164.156.247","2013-09-13 17:57:00");
INSERT INTO users VALUES("202","William Zen","wzen67@gmail.com","bba34a0d900a0348a2fe2d39672caf8f4fe2642ab58f7277b0055a59c4eb4c7e20b2fd3d4320d0df691cf990218c4abbc6e860f5eb74a9821da0392b982b99d1","7813255816","2017","1","R","1","1","0","146.115.73.119","2013-09-13 18:19:03");
INSERT INTO users VALUES("203","Karen Zhou","karenz12321@gmail.com","10eb123a1912add5a71f7d7cf1e478c962ddebe73a70a032862fc7e86636b1843ec8967b96a065f7274e4a7007b0be9ea85d64c71cefbea0dea9e312aedd5b14","None","2017","1","R","1","1","0","146.115.68.31","2013-09-13 18:35:09");
INSERT INTO users VALUES("204","Jeana Choi","jeanachoi@gmail.com","69e5dcb0544d076133782a463d704f2d59aee8976cf0cc30e0e495ed9d5d14aac747cf8e65fe3f474a982de699621aab0d8dba776c558b827055cbc04567a3f9","3392236338","2017","1","R","1","1","0","96.237.181.192","2013-09-13 18:39:36");
INSERT INTO users VALUES("205","Jason Dimasi","notjasonderulo99@gmail.com","e2a9cd5b42b673f0afa1ac923532fa2615d8d21c3629c5623ef5315ef8236cf186ac3812f0e16b5bc7632d0e3953ae433395cd8d5e47daa5cfd9784cdfc60198","None","2017","1","R","1","1","0","108.7.203.231","2013-09-13 20:44:38");
INSERT INTO users VALUES("206","Sabrina Zhang","winterhollytree@gmail.com","f3e53ddc02e83c44616c91df761c307725033d5a1f43794bfabf9b315108efb42d7c0de1097c62900c86d2658d802176708836b5ee6de83703ce70298f4922d7","None","2017","1","R","1","1","0","173.48.139.11","2013-09-13 20:45:48");
INSERT INTO users VALUES("212","Angela Gong","blueberryswim17@gmail.com","0bf8bcf9bfcb83cf98c309c3c8698a035cd35f22c5c789cba6b82a3e92fd30a3439d77a728fd6e3f9b88f282088d459818b6c52db3e6524cfbd68a01c65f4543","7812668028","2017","1","R","1","1","0","75.69.221.111","2013-09-17 20:40:13");
INSERT INTO users VALUES("210","Hanson Duan","","","None","0","0","T","1","","0","","2013-09-14 11:37:16");
INSERT INTO users VALUES("211","Emily Zhang","ezmay15@gmail.com","4f8e0c9bf751750c12c34512a9e91b4f62d25f932062ae67d8f2222d7dd19dd2bb19861abfa12984a07ff02f13469b1a105040b8dbc3796e8715708c91efada1","7818794036","2017","1","R","1","1","0","71.192.9.6","2013-09-14 17:22:25");
INSERT INTO users VALUES("213","Mark Jones","mjdadog7@yahoo.com","952336aee6d13829956d74389f213f32423e324ab4bff2066e48a3f1dafbd48c536e70048c2724e06afb9e7028eeb22227038cbc9d32a74375f002120057d770","None","2016","1","R","1","1","0","209.122.160.124","2013-09-20 14:33:24");
INSERT INTO users VALUES("214","Morgan Daciuk","morgandaciuk@gmail.com","67015d035e6e881171c10d2e3a14b9eb2ffbb6176710f82658f2dde00224084bfc2e85e3e67e46201e29fe51c86b49b21b1335a826072ccb94c06311c4c5087b","7818014364","2017","1","R","1","1","0","209.122.160.124","2013-09-20 14:42:23");
INSERT INTO users VALUES("215","Isaac Benghiat","ibenghiat@gmail.com","c2117c3f769d18eb80aef5549f69730b17a5bf43cd5558451d17cd453b4ef54395f78b4d16f53a288e3a7cc17a4bb457e79e73051c6d08271b283efb7e801408","None","2016","1","R","1","1","65f802b4d0b4b384c5a8","209.122.160.124","2013-09-20 14:52:28");
INSERT INTO users VALUES("216","Maggie Zhang","maggiezh741999@gmail.com","bbbaa11016f7d6d5f259998c7f4e9065d021bef28c428ccde0d633f60a56a32c0c4c43965e6df3d45f15b6db28adf937ae110da7bb85daaa03da1feb4f3f4168","None","2017","1","R","1","1","0","209.122.160.124","2013-09-20 14:53:07");
INSERT INTO users VALUES("217","Thomas Chen","tchen1337@gmail.com","0c1b2e89349eb2e9f2b20d2c8cb63fc4ac64b08e6052692483cd274769dcc2079d96e4e37db3a2e73a89e30c9dd97b5c8557778507597042cf6f8db348e6292e","None","2017","1","R","1","1","0","209.122.160.124","2013-09-20 14:54:57");
INSERT INTO users VALUES("222","Tadeh Derstepanian","","","None","0","0","T","1","","0","","2013-09-27 17:10:56");
INSERT INTO users VALUES("223","Krishna Suraj","","","None","0","0","T","1","","0","","2013-09-27 17:13:02");
INSERT INTO users VALUES("224","Vineetha Bheemarasetty","","","None","0","0","T","1","","0","","2013-09-27 17:15:27");
INSERT INTO users VALUES("226","Sherry Ye","ssherry@163.com","91bd8e7541af0e3c58bfcdd20c0818500f7573b419fb85bc1a28ca765999123252f9ef1470be1257489a3cfc6b41656b2872081a18375100b86f806d56da063d","6178031861","2014","1","R","1","1","0","24.218.241.153","2013-09-27 18:45:03");
INSERT INTO users VALUES("229","Jessica Sun","","","None","0","0","T","1","","0","","2013-10-04 16:15:42");
INSERT INTO users VALUES("228","Danny Lu","ludannyhongyu@gmail.com","63eaf24f86ce294caf1b742ca19d76da288fcd1712e718812a24e86a62b673e5b1fe97553f01f8129f8d07fbbe572699f93eef850a6165ad37a3c08a8d8f7675","7818796668","2016","1","R","1","1","0","72.74.248.187","2013-10-03 20:04:09");
INSERT INTO users VALUES("231","Shravya Suddala","suddala.shravya@gmail.com","6be2d70df11a586e86244f53d97dbfef0ac91ad05e976ac58ef2e52db37f09931717823ff843eaac381ec575ef054a420cb3e6bab3bb931d644b4c3cff49d231","None","2015","1","R","1","1","0","146.115.66.230","2013-10-31 22:19:28");
INSERT INTO users VALUES("234","Benjamin Li","","","None","0","0","T","1","","0","","2013-11-22 15:07:34");
INSERT INTO users VALUES("233","Ravi Raghavan","ravi1998@gmail.com","e96dc065e9334ddf8df6d864166422bd7c34c7d8bdaa1b719b00a70000aceb199652e351975b0a451555d9b2cf447a8b8cc9f722aa24ec966d5cfe542d0a080e","7819969824","2017","1","R","1","1","0","209.122.160.124","2013-11-08 15:50:57");
INSERT INTO users VALUES("235","Videh Seksaria","01vssv10@gmail.com","fd36535abafa9a05e50940d97c38b8e660349e84eb450d376a38d97b018b203c2a9bb7cb926df4f78b1936b336e71eedb0d55d3697489e1eb6d81dc5616f36c6","None","2015","1","R","0","4f34f4ec78a63b2e4cba","0","50.177.253.62","2013-12-18 20:06:13");



CREATE DATABASE `lmt-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lmt-bak`;


DROP TABLE IF EXISTS guts;

CREATE TABLE `guts` (
  `team` int(11) NOT NULL,
  `problem_set` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS individuals;

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `grade` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `attendance` tinyint(1) NOT NULL DEFAULT '0',
  `score_individual` int(11) DEFAULT NULL,
  `score_theme` int(11) DEFAULT NULL,
  `email` varchar(320) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO individuals VALUES("1","Test","6","-1","0","0","","","doobahead@gmail.com","0");



DROP TABLE IF EXISTS map;

CREATE TABLE `map` (
  `map_key` varchar(25) NOT NULL,
  `map_value` varchar(2000) NOT NULL,
  PRIMARY KEY (`map_key`),
  UNIQUE KEY `map_key` (`map_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO map VALUES("date","TBD");
INSERT INTO map VALUES("year","2016");
INSERT INTO map VALUES("indiv_cost","$6");
INSERT INTO map VALUES("team_cost","$6 per person");
INSERT INTO map VALUES("backstage_message","      <div class=\"text-centered\">\n        Use the links on the side to access LMT registration and scoring.<br />\n        <span class=\"b\">LMT Staff Only!</span><br />\n      </div>");
INSERT INTO map VALUES("scoring","0");
INSERT INTO map VALUES("registration","1");
INSERT INTO map VALUES("backstage","0");



DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `content` varchar(20000) NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO pages VALUES("-1","Registration","","2");
INSERT INTO pages VALUES("2","About","<div class=\"text-centered\"><img src=\"../res/lmt/header.png\" alt=\"Lexington Math Tournament\" class=\"lmt-logo\"/></div>\n\n<p>The <strong>Lexington Mathematics Tournament</strong> (LMT) is an annual math tournament for middle school students, held at Lexington High School in Lexington,\nMassachusetts. It is run by the Lexington High School Math Club.</p>\n\n<p>In high school, there is an overwhelming number of opportunities from various\nmath leagues to contests and competitions, whereas there are very few in middle school (such as regional leagues and <a href=\"https://mathcounts.org/\" rel=\"external\">MATHCOUNTS</a>). We also realize that the transition from\nmiddle to high school math can be difficult. Inspired by tournaments such as <a href=\"http://web.mit.edu/hmmt/www/\" rel=\"external\">HMMT</a> that provide\nchallenging problems to high schoolers, it is our goal to offer middle-school students similar engaging opportunities and to encourage them to continue their pursuit of mathematics.</p>\n\n<p><span class=\"b\">Registration for the fourth annual Lexington Math Tournament is now closed. The competition will be on April 12, 2014.</span> Check out the links to the left to learn more about the tournament. We hope you consider participating in the LMT!</p>","0");
INSERT INTO pages VALUES("8","Rules","<h1>Rules</h1>\n\n<h3>General Information</h3>\n<p>The Lexington Mathematical Tournament is a middle school mathematics competition\nmodeled on the <a href=\"http://web.mit.edu/hmmt/www/\" rel=\"external\">Harvard-MIT Mathematics Tournament</a>. It is sponsored by the Lexington High School Math Club.</p>\n<p>The competition is open to 6th, 7th and 8th grade students from within a 200 mile radius of Lexington High School.\nPart of the competition takes place in teams of 4 to 6 students that are somehow associated with each other\n(through school or other math programs), but the competition is also open to individuals without teams. On competition day,\nwe will place individuals on unofficial teams so they can participate in the team aspects of the competition.</p>\n<p class=\"b\">This is the final version of the rules.</p>\n\n<h3>Test Information</h3>\n<p>The competition consists of four rounds: the Individual, Theme, Team, and Guts Rounds. Computational aids,\nincluding but not limited to: calculators, calculator wrist watches, and computers are prohibited, as are drawing aids\nincluding but not limited to: rulers, compasses, and protractors on all parts of the competition. Communication of any form\nbetween students on the individual and theme rounds is strictly prohibited, and any student caught either giving or receiving\nan unfair advantage over other competitors will immediately be disqualified. Communication between teams on the team and guts\nround is similarly prohibited, and any teams caught either giving or receiving an unfair advantage over other competitors will\nalso be disqualified. What constitutes cheating will be up to the final discretion of the head proctor.</p>\n<p>The <strong>individual round</strong> is a test taken by individual competitors that consists of 20 short answer problems to be done in 30 minutes.\nEach problem is worth three points. Problems are arranged in order of approximately increasing difficulty.</p>\n<p>The <strong>theme round</strong> is a test taken by individual competitors that consists of 15 short answer problems to be done in 35 minutes.\nEach problem is worth four points, and the problems are divided into three \'themes\' of five problems, each given to the competitor\nsimultaneously. Within each theme, problems are arranged in order of approximately increasing difficulty.</p>\n<p>The <strong>team round</strong> is a test taken by teams working together, that consists of 10 short answer problems and one section of long answer\nproblems to be done in 60 minutes. The short answer problems are arranged in order of approximately increasing difficulty. The long\nanswer problems revolve around a few themes, and require that students submit fully-explained solutions. Partial credit is\nawarded on long answer problems for significant progress made. Each short answer problem is worth seven points, and long answer problems\nare worth a variable number of points noted next to each problem. The long answer section will be worth a total of 130 points.</p>\n<p>The <strong>guts round</strong> is a test taken by teams working together, that consists of 36 short answer problems given in sets of three.\nThe guts round is an exciting, fast-paced round in which teams solve problems as quickly as possible, then submit answers\nfor real-time grading. When a team is ready to submit answers to a set of three problems, a \'runner\' trades these answers for the next\nset of problems. The number of points per problem increases from five to twenty-five with later sets of problems, and accordingly, problems\nare arranged in approximate order of increasing difficulty. The maximum number of points awarded in the guts round is 300. Teams are given 75 minutes to solve as many problems as they can, and real-time scores of all\nteams will be displayed at the front of the auditorium.</p>\n\n\n<h3>Forms of Answers</h3>\n<p>On all short answer problems, there is no restriction on forms of answers so long as a final answer is exact and simplified.\nThis means that approximate or rounded answers are not acceptable. What constitutes simplified is explained below:</p>\n<ul>\n  <li>All integers must be written out as integers in their full base 10 form, making answers such as 2^12 and 3.0 unacceptable.</li>\n  <li>All rational fractions must be reduced and written either as an improper fraction or a mixed number whose fractional part is less than 1.</li>\n  <li>All decimal answers must correctly use bar notation for repeating decimals.</li>\n  <li>All \'square root\' symbols (radicals) must have only integers underneath, not fractions or decimals. The integers under \'square root\'\n  symbols cannot be divisible by the square of any prime (and similarly, integers under \'cube root\' symbols cannot be divisible by the cube of any\n  prime, etc.), and radicals cannot appear in the denominator of any fraction.</li>\n  <li>Approximations for &pi; may not be used; any answer involving pi should be written using &pi;, such as 2&pi; or &pi;&#8730;2/3.</li>\n</ul>\n<p>The acceptability of an answer not described explicitly above is left to the discretion of the head grader.</p>\n\n<h3>Protests</h3>\n<p>An individual, theme, or team round problem may be protested before the guts round begins by giving a sheet of paper with a clearly\nwritten reason as to why the problem or answer is incorrect to a proctor. The validity of all protests is left to the discretion of the head\ngrader, whose decision is final. Guts round problems may not be protested, and accordingly, extra care will be taken by the Problem Czar to\nensure that there are no errors in the guts round.</p>\n\n<h3>Scoring and Prizes</h3>\n<p>Point values of problems are noted in the previous section. An individual\'s aggregate score is the sum of his or her scores on the\nindividual round and theme round, for a maximum of 120 points. The top scorers in the individual and theme rounds will be recognized,\nand the top ten overall scorers will receive prizes.</p>\n<p>The top three teams in the team and guts rounds will be recognized. In addition, the top five overall teams will be recognized, whose aggregate scores will be calculated in the following way: The top four scores among team members on <span class=\"b\">each</span> of the individual and theme rounds will be added, and multiplied by 1.25. This will be added to the team\'s guts round score and 1.5 times the team round score, for a maximum of 1200 points. Note that prize distribution is subject to change and will be finalized closer to the day of the competition</p>\n\n<h3>Tiebreakers</h3>\n<p>In general, ties will not be broken. In the case of a tie that affects the distribution of prizes, one party will receive the prize and the other will receive an equivalent prize by mail after the competition.</p>","6");
INSERT INTO pages VALUES("27","2012 Archive","<h1>2012 Archive</h1>\n\n<p><strong>Date: </strong>Saturday, May 5</p>\n<p><strong>View photos of the event </strong><a href=\"http://www.flickr.com/photos/78272374@N05/sets/72157629673653832/\" rel=\"external\">on Flickr</a>.</p><br/>\n\n<h3>Problems and Solutions</h3>\nAll archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1\">this Dropbox folder</a>.\n<!--table class=\"contrasting\">\n  <tr>\n    <td class=\"b\">Individual Round</td>\n    <td><a href=\"../res/lmt/2012 Individual Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2012 Individual Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Theme Round</td>\n    <td><a href=\"../res/lmt/2012 Theme Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2012 Theme Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Team Round</td>\n    <td><a href=\"../res/lmt/2012 Team Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2012 Team Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Guts Round</td>\n    <td><a href=\"../res/lmt/2012 Guts Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2012 Guts Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b i\">All Files</td>\n    <td class=\"i\"><a href=\"../res/lmt/2012 All Files.zip\">Download</a></td>\n    <td></td>\n  </tr>\n</table-->\n<br/>\n\n<h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Matthew Lipman</td>\n    <td>Meadowbrook</td>\n    <td>18</td>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>18</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Alec Sun</td>\n    <td>Clarke Middle School</td>\n    <td>15</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Matthew Weiss</td>\n    <td>Diamond Middle School</td>\n    <td>14</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Anthony Bau</td>\n    <td>Lincoln</td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Ravi Raghavan</td>\n    <td>Clarke Middle School</td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Michael Ren</td>\n    <td><span class=\"i\">None</span></td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Ethan Zou</td>\n    <td>Clarke Middle School</td>\n    <td>13</td>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Alec Sun</td>\n    <td>Clarke Middle School</td>\n    <td>10</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Arul Prasad</td>\n    <td>Clarke Middle School</td>\n    <td>9</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Uma Roy</td>\n    <td>Diamond Middle School</td>\n    <td>9</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Matthew Weiss</td>\n    <td>Diamond Middle School</td>\n    <td>9</td>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>106</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Alec Sun</td>\n    <td>Clarke Middle School</td>\n    <td>85</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Matthew Lipman</td>\n    <td>Meadowbrook</td>\n    <td>82</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Matthew Weiss</td>\n    <td>Diamond Middle School</td>\n    <td>78</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Arul Prasad</td>\n    <td>Clarke Middle School</td>\n    <td>72</td>\n  </tr>\n  <tr>\n    <td>6</td>\n    <td>Anthony Bau</td>\n    <td>Lincoln</td>\n    <td>71</td>\n  </tr>\n  <tr>\n    <td>7</td>\n    <td>Uma Roy</td>\n    <td>Diamond Middle School</td>\n    <td>69</td>\n  </tr>\n  <tr>\n    <td>8</td>\n    <td>Ethan Zou</td>\n    <td>Clarke Middle School</td>\n    <td>67</td>\n  </tr>\n  <tr>\n    <td>8</td>\n    <td>Ravi Raghavan</td>\n    <td>Clarke Middle School</td>\n    <td>67</td>\n  </tr>\n  <tr>\n    <td>10</td>\n    <td>Kenny Wang</td>\n    <td><span class=\"i\">None</span></td>\n    <td>65</td>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Clarke A</td>\n    <td>Clarke Middle School</td>\n    <td>183</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>McCall</td>\n    <td>McCall Middle School</td>\n    <td>125</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Infinite Improbability</td>\n    <td>Meadowbrook</td>\n    <td>124</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Team David and Friends</td>\n    <td>Diamond Middle School</td>\n    <td>112</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Clarke C</td>\n    <td>Clarke Middle School</td>\n    <td>90</td>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>McCall</td>\n    <td>McCall Middle School</td>\n    <td>163</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Clarke A</td>\n    <td>Clarke Middle School</td>\n    <td>148</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Infinite Improbability</td>\n    <td>Meadowbrook</td>\n    <td>113</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Team David and Friends</td>\n    <td>Diamond Middle School</td>\n    <td>110</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Individuals</td>\n    <td></td>\n    <td>106</td>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Clarke A</td>\n    <td>Clarke Middle School</td>\n    <td>786.25</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>McCall</td>\n    <td>McCall Middle School</td>\n    <td>641.75</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Team David and Friends</td>\n    <td>Diamond Middle School</td>\n    <td>608.00</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Infinite Improbability</td>\n    <td>Meadowbrook</td>\n    <td>581.50</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Individuals</td>\n    <td></td>\n    <td>525.75</td>\n  </tr>\n</table>","988");
INSERT INTO pages VALUES("9","Schedule","<h1>Schedule</h1>\n\n<p>LMT will run from about 8 in the morning to about 3 in the afternoon. Lunch will be provided, but students may also bring their own lunch or go to Lexington Center, which is within walking distance, to eat.</p>\n\n<h3>Detailed Schedule</h3>\n<table>\n  <tr>\n    <th>Time</th>\n    <th>Event</th>\n    <th>Location</th>\n  </tr>\n  <tr>\n    <td>8:00 to 8:45</td>\n    <td>Registration</td>\n    <td>Main Hallway</td>\n  </tr>\n  <tr>\n    <td>8:45 to 9:00</td>\n    <td>Welcome and Instructions</td>\n    <td>Auditorium</td>\n  </tr>\n  <tr>\n    <td>9:00 to 9:30</td>\n    <td>Individual Round</td>\n    <td>Commons</td>\n  </tr>\n  <tr>\n    <td>9:50 to 10:25</td>\n    <td>Theme Round</td>\n    <td>Commons</td>\n  </tr>\n  <tr class=\"i\">\n    <td>10:10 to 10:25&nbsp;&nbsp;</td>\n    <td>Proctor Meeting for Coaches&nbsp;&nbsp;</td>\n    <td>Auditorium</td>\n  </tr>\n  <tr>\n    <td>10:40 to 11:40</td>\n    <td>Team Round</td>\n    <td>Commons</td>\n  </tr>\n  <tr>\n    <td>11:40 to 1:00</td>\n    <td>Lunch</td>\n    <td></td>\n  </tr>\n  <tr>\n    <td>1:00 to 2:30</td>\n    <td>Guts Round</td>\n    <td>Auditorium</td>\n  </tr>\n  <tr>\n    <td>2:30 to 3:00</td>\n    <td>Awards Ceremony</td>\n    <td>Quad*</td>\n  </tr>\n</table>\n\n* Weather permitting, otherwise will be in the Auditorium\n\n\n<h3>LHS Campus Map</h3>\n<img src=\"../res/lmt/campusmap.png\" alt=\"Map not available\" style=\"width: 725px;\"/>\n<div class=\"halfbreak\"></div>\n<div class=\"right small b\"><a href=\"../res/lmt/LHS Campus Map.pdf\">Download as a PDF</a></div>","7");
INSERT INTO pages VALUES("11","Location","<h1>Location</h1>\n\n<p>Lexington High School is located at <strong>251 Waltham Street, Lexington MA</strong>.</p>\n\n<object id=\"googlemap\" data=\"http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;t=h&amp;msa=0&amp;msid=103805382755556619338.000470cc06aadbe416c6b&amp;ll=42.443475,-71.233721&amp;spn=0.011084,0.018239&amp;z=15&amp;output=embed\" type=\"text/html\"></object>\n<div class=\"halfbreak\"></div>\n<div class=\"right small b\"><a href=\"http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;t=h&amp;msa=0&amp;msid=103805382755556619338.000470cc06aadbe416c6b&amp;ll=42.443475,-71.233721&amp;spn=0.011084,0.018239&amp;z=15&amp;source=embed\" rel=\"external\">View Full-Size Map</a></div>\n\n<form action=\"http://maps.google.com/maps\" method=\"get\"><div>\n  Get directions from: <input type=\"text\" name=\"saddr\" size=\"50\"/>\n  <input type=\"hidden\" name=\"daddr\" value=\"251 Waltham Street, Lexington MA, 02421\"/>\n  <input type=\"submit\" value=\"Go!\"/>\n</div></form>\n\n<h3>About Lexington</h3>\n<p>The Town of Lexington is an affluent community that prides itself on the beauty of town land, the safety of its\nresidents and the excellence of its public school system. The town has numerous parks, conservation lands, museums\nand libraries that provide exceptional opportunities for recreational and cultural activities. Residents feel the\ntown\'s physical location is ideal, allowing easy access to Boston, the Atlantic Ocean, the White Mountains and many\nimportant historical sites in the state. For more information about Lexington, visit the\n<a href=\"http://ci.lexington.ma.us/portal/visitors.cfm\" rel=\"external\">town website</a>.</p>","8");
INSERT INTO pages VALUES("12","2010 Archive","<h1>2010 Archive</h1>\n\n<p><strong>Date: </strong>Saturday, April 3</p>\n<p><strong>View photos of the event </strong><a href=\"http://www.flickr.com/photos/lexingtonmathtournament/sets/72157623849613046/\" rel=\"external\">on Flickr</a>.</p><br/>\n\n<h3>Problems and Solutions</h3>\nAll archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1\">this Dropbox folder</a>.\n<!--table class=\"contrasting\">\n  <tr>\n    <td class=\"b\">Individual Round</td>\n    <td><a href=\"../res/lmt/2010 Individual Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2010 Individual Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Theme Round</td>\n    <td><a href=\"../res/lmt/2010 Theme Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2010 Theme Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Team Round</td>\n    <td><a href=\"../res/lmt/2010 Team Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2010 Team Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Guts Round</td>\n    <td><a href=\"../res/lmt/2010 Guts Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2010 Guts Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b i\">All Files</td>\n    <td class=\"i\"><a href=\"../res/lmt/2010 All Files.zip\">Download</a></td>\n    <td></td>\n  </tr>\n</table-->\n<br/>\n\n<h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>Team</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>Jonathan Tidor</td>\n    <td>Old Clarke</td>\n    <td>54</td>\n  </tr><tr>\n    <td>2</td>\n    <td>Zachary Polansky</td>\n    <td>The Sage School</td>\n    <td>48</td>\n  </tr><tr>\n    <td>3 (Tie)</td>\n    <td>Ying Gao</td>\n    <td>Bigelow</td>\n    <td>45</td>\n  </tr><tr>\n    <td>3 (Tie)</td>\n    <td>Zach Lowry</td>\n    <td>Old Clarke</td>\n    <td>45</td>\n  </tr>\n</table>\n\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>Team</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>Jonathan Tidor</td>\n    <td>Old Clarke</td>\n    <td>56</td>\n  </tr><tr>\n    <td>2 (Tie)</td>\n    <td>Anna Ellison</td>\n    <td>Bigelow</td>\n    <td>48</td>\n  </tr><tr>\n    <td>2 (Tie)</td>\n    <td>Noah Golowich</td>\n    <td>Diamond Team 1</td>\n    <td>48</td>\n  </tr><tr>\n    <td>2 (Tie)</td>\n    <td>Shohini Stout</td>\n    <td>Diamond\'s BFFL</td>\n    <td>48</td>\n  </tr>\n</table>\n\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>Team</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>Jonathan Tidor</td>\n    <td>Old Clarke</td>\n    <td>110</td>\n  </tr><tr>\n    <td>2</td>\n    <td>Zachary Polansky</td>\n    <td>The Sage School</td>\n    <td>92</td>\n  </tr><tr>\n    <td>3</td>\n    <td>Anna Ellison</td>\n    <td>Bigelow</td>\n    <td>90</td>\n  </tr><tr>\n    <td>4 (Tie)</td>\n    <td>Ying Gao</td>\n    <td>Bigelow</td>\n    <td>89</td>\n  </tr><tr>\n    <td>4 (Tie)</td>\n    <td>Zach Lowry</td>\n    <td>Old Clarke</td>\n    <td>89</td>\n  </tr><tr>\n    <td>6</td>\n    <td>Rohil Prasad</td>\n    <td>Old Clarke</td>\n    <td>86</td>\n  </tr><tr>\n    <td>7</td>\n    <td>Arthemy Lugin</td>\n    <td>AMSA</td>\n    <td>83</td>\n  </tr><tr>\n    <td>8</td>\n    <td>Katie Fraser</td>\n    <td>Old Clarke</td>\n    <td>82</td>\n  </tr><tr>\n    <td>9 (Tie)</td>\n    <td>Noah Golowich</td>\n    <td>Diamond Team 1</td>\n    <td>81</td>\n  </tr><tr>\n    <td>9 (Tie)</td>\n    <td>Shohini Stout</td>\n    <td>Diamond\'s BFFL</td>\n    <td>81</td>\n  </tr>\n</table>\n\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>The Sage School</td>\n    <td>The Sage School</td>\n    <td>190</td>\n  </tr><tr>\n    <td>2</td>\n    <td>Old Clarke</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>187</td>\n  </tr><tr>\n    <td>3</td>\n    <td>Bigelow</td>\n    <td>Bigelow Middle School</td>\n    <td>175</td>\n  </tr><tr>\n    <td>4</td>\n    <td>Individual 1</td>\n    <td>None</td>\n    <td>174</td>\n  </tr>\n</table>\n\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>Old Clarke</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>252</td>\n  </tr><tr>\n    <td>2</td>\n    <td>Clockers</td>\n    <td>Ashland Middle School</td>\n    <td>204</td>\n  </tr><tr>\n    <td>3</td>\n    <td>Bigelow</td>\n    <td>Bigelow Middle School</td>\n    <td>196</td>\n  </tr>\n</table>\n\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr><tr>\n    <td>1</td>\n    <td>Old Clarke</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>957.5</td>\n  </tr><tr>\n    <td>2</td>\n    <td>Bigelow</td>\n    <td>Bigelow Middle School</td>\n    <td>779.3</td>\n  </tr><tr>\n    <td>3</td>\n    <td>The Sage School</td>\n    <td>The Sage School</td>\n    <td>756.0</td>\n  </tr><tr>\n    <td>4</td>\n    <td>Diamond Team 1</td>\n    <td>William Diamond Middle School</td>\n    <td>703.3</td>\n  </tr><tr>\n    <td>5</td>\n    <td>New Clarke</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>702.5</td>\n  </tr><tr>\n    <td>6</td>\n    <td>AMSA</td>\n    <td>Advanced Math &amp; Science Academy</td>\n    <td>646.2</td>\n  </tr>\n</table>","990");
INSERT INTO pages VALUES("13","Contact","<h1>Contact Us</h1>\n\n<p>LMT is by no means set in stone. We believe that what makes successful math competitions is\ntheir ability to evolve, and are constantly looking to improve in any ways that we can, especially\nwith LMT in its early years.  We would appreciate any questions, comments, or concerns regarding all aspects\nof the competition (food, website, problems, etc.) Thank you for your interest in LMT.</p>\n\n{CONTACT_LINK}","1001");
INSERT INTO pages VALUES("20","","","10");
INSERT INTO pages VALUES("23","","","1000");
INSERT INTO pages VALUES("25","2011 Archive","<h1>2011 Archive</h1>\n\n<p><strong>Date: </strong>Saturday, April 2</p>\n<p><strong>View photos of the event </strong><a href=\"http://www.flickr.com/photos/lexingtonmathtournament/sets/72157626420324046/\" rel=\"external\">on Flickr</a>.</p><br/>\n\n<h3>Problems and Solutions</h3>\nAll archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1\">this Dropbox folder</a>.\n<!--table class=\"contrasting\">\n  <tr>\n    <td class=\"b\">Individual Round</td>\n    <td><a href=\"../res/lmt/2011 Individual Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2011 Individual Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Theme Round</td>\n    <td><a href=\"../res/lmt/2011 Theme Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2011 Theme Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Team Round</td>\n    <td><a href=\"../res/lmt/2011 Team Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2011 Team Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Guts Round</td>\n    <td><a href=\"../res/lmt/2011 Guts Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2011 Guts Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b i\">All Files</td>\n    <td class=\"i\"><a href=\"../res/lmt/2011 All Files.zip\">Download</a></td>\n    <td></td>\n  </tr>\n</table-->\n<br/>\n\n<h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Zachary Polansky</td>\n    <td>The Sage School</td>\n    <td>57</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Alan Qiu</td>\n    <td>Wm Diamond Middle</td>\n    <td>54</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>54</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Noah Golowich</td>\n    <td>Wm Diamond Middle</td>\n    <td>51</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Albert Zhang</td>\n    <td>RJ Grey Junior High School</td>\n    <td>48</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Joshua Xiong</td>\n    <td>RJ Grey Junior High School</td>\n    <td>48</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Bary Lisak</td>\n    <td>The Sage School</td>\n    <td>48</td>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>56</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Anna Ellison</td>\n    <td>Bigelow</td>\n    <td>44</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Bary Lisak</td>\n    <td>The Sage School</td>\n    <td>44</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Shohini Stout</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>44</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Matt Lipman</td>\n    <td>Meadowbrook</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Akshay Karthik</td>\n    <td>RJ Grey Junior High School</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Noah Golowich</td>\n    <td>Wm Diamond Middle</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Richard Zhu</td>\n    <td>Century Chinese Language School</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Zachary Polansky</td>\n    <td>The Sage School</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Harris Desrosier</td>\n    <td>The Sage School</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Joshua Xiong</td>\n    <td>RJ Grey Junior High School</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Kevin Cai</td>\n    <td>Advanced Math and Science Academy</td>\n    <td>40</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Victor Zhang</td>\n    <td>Wm Diamond Middle</td>\n    <td>40</td>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>110</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Zachary Polansky</td>\n    <td>The Sage School</td>\n    <td>97</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Bary Lisak</td>\n    <td>The Sage School</td>\n    <td>92</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Noah Golowich</td>\n    <td>Wm Diamond Middle</td>\n    <td>91</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Joshua Xiong</td>\n    <td>RJ Grey Junior High School</td>\n    <td>88</td>\n  </tr>\n  <tr>\n    <td>6</td>\n    <td>Shohini Stout</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>86</td>\n  </tr>\n  <tr>\n    <td>6</td>\n    <td>Anna Ellison</td>\n    <td>Bigelow</td>\n    <td>86</td>\n  </tr>\n  <tr>\n    <td>8</td>\n    <td>Matt Lipman</td>\n    <td>Meadowbrook</td>\n    <td>85</td>\n  </tr>\n  <tr>\n    <td>9</td>\n    <td>Albert Zhang</td>\n    <td>RJ Grey Junior High School</td>\n    <td>84</td>\n  </tr>\n  <tr>\n    <td>10</td>\n    <td>Alan Qiu</td>\n    <td>Wm Diamond Middle</td>\n    <td>82</td>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Bigelow A</td>\n    <td>Bigelow</td>\n    <td>183</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Kim Chi Iguanas</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>182</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Monty Pi thons</td>\n    <td>The Sage School</td>\n    <td>177</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Pi Cubed</td>\n    <td>Wm Diamond Middle</td>\n    <td>168</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Meadowbrook</td>\n    <td>Meadowbrook</td>\n    <td>144</td>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Kim Chi Iguanas</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>249</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Monty Pi thons</td>\n    <td>The Sage School</td>\n    <td>223</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Pi Cubed</td>\n    <td>Wm Diamond Middle</td>\n    <td>219</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Meadowbrook</td>\n    <td>Meadowbrook</td>\n    <td>213</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Bigelow A</td>\n    <td>Bigelow</td>\n    <td>209</td>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Kim Chi Iguanas</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>959.50</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Monty Pi thons</td>\n    <td>The Sage School</td>\n    <td>901.00</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Pi Cubed</td>\n    <td>Wm Diamond Middle</td>\n    <td>843.50</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Bigelow A</td>\n    <td>Bigelow</td>\n    <td>838.50</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>RJ Grey</td>\n    <td>RJ Grey Junior High School</td>\n    <td>794.00</td>\n  </tr>\n</table>","989");
INSERT INTO pages VALUES("28","2013 Archive","<h1>2013 Archive</h1>\n\n<p><strong>Date: </strong>Saturday, March 30</p>\n<p><strong>View photos of the event </strong><a href=\"http://www.flickr.com/photos/lexingtonmathtournament/sets/72157633128098911/\" rel=\"external\">on Flickr</a>.</p><br/>\n\n\n<h3>Problems and Solutions</h3>\nAll archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1\">this Dropbox folder</a>.\n<!--table class=\"contrasting\">\n  <tr>\n    <td class=\"b\">Individual Round</td>\n    <td><a href=\"../res/lmt/2013 Individual Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2013 Individual Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Theme Round</td>\n    <td><a href=\"../res/lmt/2013 Theme Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2013 Theme Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Team Round</td>\n    <td><a href=\"../res/lmt/2013 Team Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2013 Team Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b\">Guts Round</td>\n    <td><a href=\"../res/lmt/2013 Guts Problems.pdf\">Problems</a></td>\n    <td><a href=\"../res/lmt/2013 Guts Solutions.pdf\">Solutions</a></td>\n  </tr><tr>\n    <td class=\"b i\">All Files</td>\n    <td class=\"i\"><a href=\"../res/lmt/2013 All Files.zip\">Download</a></td>\n    <td></td>\n  </tr>\n</table-->\n<br/>\n\n<h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>18</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>17</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Felix Wang</td>\n    <td>The Roxbury Latin School</td>\n    <td>14</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>John Guo</td>\n    <td>Diamond Middle School</td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Ravi Raghavan</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>13</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Matthew Lipman</td>\n    <td>Meadowbrook School</td>\n    <td>13</td>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>14</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Matthew Lipman</td>\n    <td>Meadowbrook School</td>\n    <td>12</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Jeffrey Chang</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>12</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Michael Ren</td>\n    <td><span class=\"i\">None</span></td>\n    <td>12</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>12</td>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Alec Sun</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>107</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>James Lin</td>\n    <td>McCall Middle School</td>\n    <td>102</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>Matthew Lipman</td>\n    <td>Meadowbrook School</td>\n    <td>87</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Michael Ren</td>\n    <td><span class=\"i\">None</span></td>\n    <td>84</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Jeffrey Chang</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>81</td>\n  </tr>\n  <tr>\n    <td>6</td>\n    <td>Albert Xu</td>\n    <td>Oak and Worcester Academy</td>\n    <td>77</td>\n  </tr>\n  <tr>\n    <td>7</td>\n    <td>Jeremy Chen</td>\n    <td>The Sage School</td>\n    <td>76</td>\n  </tr>\n  <tr>\n    <td>8</td>\n    <td>Ravi Raghavan</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>75</td>\n  </tr>\n  <tr>\n    <td>9</td>\n    <td>Felix Wang</td>\n    <td>The Roxbury Latin School</td>\n    <td>74</td>\n  </tr>\n  <tr>\n    <td>10</td>\n    <td>Peter Rowley</td>\n    <td>Diamond Middle School</td>\n    <td>73</td>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Clarke B</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>169</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>A Blurry Toxin</td>\n    <td>The Roxbury Latin School</td>\n    <td>155</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>ZhuHoulinWang</td>\n    <td>McCall Middle School</td>\n    <td>129</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>TCWOEGALP</td>\n    <td>Meadowbrook School</td>\n    <td>122</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Individuals 3</td>\n    <td></td>\n    <td>116</td>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Clarke B</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>232</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>Individuals 3</td>\n    <td></td>\n    <td>187</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>ZhuHoulinWang</td>\n    <td>McCall Middle School</td>\n    <td>179</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Clarke C</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>142</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>TCWOEGALP</td>\n    <td>Meadowbrook School</td>\n    <td>142</td>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n  <tr>\n    <td>1</td>\n    <td>Clarke B</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>869.25</td>\n  </tr>\n  <tr>\n    <td>2</td>\n    <td>ZhuHoulinWang</td>\n    <td>McCall Middle School</td>\n    <td>690.00</td>\n  </tr>\n  <tr>\n    <td>3</td>\n    <td>A Blurry Toxin</td>\n    <td>The Roxbury Latin School</td>\n    <td>667.25</td>\n  </tr>\n  <tr>\n    <td>4</td>\n    <td>Individuals 3</td>\n    <td></td>\n    <td>621.00</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>TCWOEGALP</td>\n    <td>Meadowbrook School</td>\n    <td>613.75</td>\n  </tr>\n  <tr>\n    <td>5</td>\n    <td>Clarke C</td>\n    <td>Jonas Clarke Middle School</td>\n    <td>613.75</td>\n  </tr>\n</table>","987");
INSERT INTO pages VALUES("29","2014 Archive","<h1>2014 Archive</h1>\n\n<p><strong>Date: </strong>Saturday, April 12</p>\n\n\n\n<h3>Problems and Solutions</h3>\nWe\'re not posting the problems or solutions until <i>after</i> the competition, of course! You can find past years\' problems at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1\">this Dropbox folder</a>.\n\n<!--note to webmaster: after the competition, go to Export tab for the results html export, and copy it here.-->","986");
INSERT INTO pages VALUES("30","2013 Archive","<h1>2013 Archive</h1>\n<p><strong>Date: </strong>Saturday, April 12</p>\n<!--<p><strong>View photos of the event </strong><a href=\"??\" rel=\"external\">on Flickr</a>.</p><br/>-->\n<h3>Problems and Solutions</h3>All archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/q8Vv_FHnxM/LMT\" rel=\"external\">this Dropbox folder</a>.<br/><h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n","987");
INSERT INTO pages VALUES("31","2013 Archive","<h1>2013 Archive</h1>\n<p><strong>Date: </strong>Saturday, April 12</p>\n<!--<p><strong>View photos of the event </strong><a href=\"??\" rel=\"external\">on Flickr</a>.</p><br/>-->\n<h3>Problems and Solutions</h3>All archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/q8Vv_FHnxM/LMT\" rel=\"external\">this Dropbox folder</a>.<br/><h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n","987");
INSERT INTO pages VALUES("32","2014 Archive","<h1>2014 Archive</h1>\n<p><strong>Date: </strong>TBD</p>\n<!--<p><strong>View photos of the event </strong><a href=\"??\" rel=\"external\">on Flickr</a>.</p><br/>-->\n<h3>Problems and Solutions</h3>All archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/q8Vv_FHnxM/LMT\" rel=\"external\">this Dropbox folder</a>.<br/><h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n","986");
INSERT INTO pages VALUES("33","2015 Archive","<h1>2015 Archive</h1>\n<p><strong>Date: </strong>TBD</p>\n<!--<p><strong>View photos of the event </strong><a href=\"??\" rel=\"external\">on Flickr</a>.</p><br/>-->\n<h3>Problems and Solutions</h3>All archived problems and solutions can be found at <a href=\"https://www.dropbox.com/sh/6wo6f5i8il42m1c/q8Vv_FHnxM/LMT\" rel=\"external\">this Dropbox folder</a>.<br/><h3>Results</h3>\n<h4>Top Individuals in Individual Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals in Theme Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Individuals Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Name</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Team Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams in Guts Round</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n<h4>Top Teams Overall</h4>\n<table class=\"contrasting\">\n  <tr>\n    <th>Place</th>\n    <th>Team</th>\n    <th>School</th>\n    <th>Score</th>\n  </tr>\n</table>\n","985");



DROP TABLE IF EXISTS schools;

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `coach_email` varchar(320) NOT NULL,
  `access_code` char(18) NOT NULL,
  `teams_paid` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO schools VALUES("1","haecoa","Awexhxfaqoeai@asfowa.com","63487d6d3ad83f3243","0","0");
INSERT INTO schools VALUES("2","asdfghj","dfghjkhgfdsdfghjk@rtyfubyvrcgsvfbjyugfercbnjymtgbvhgtchdfvg.com","9dc4b46cde4f24ff63","0","0");
INSERT INTO schools VALUES("3","ewhxfiqwefhnx","doobahead@gmail.com","914f86310d5f41f69a","0","0");
INSERT INTO schools VALUES("4","oink","jfweqgq@asdfewhuifgxdhwec.coafjoweqqwh.com","86dff","0","0");
INSERT INTO schools VALUES("5","fhaqc","ifgowequfhygiwq@eajiwmlfqawefa.com","39de1","0","0");
INSERT INTO schools VALUES("6","fweifguiqwfgoweq","hello@hellofawefhacohjoaskfas.com","e328a","0","0");
INSERT INTO schools VALUES("7","jfbiweqafch","fnueihwqxgwq@hefiuaqxc.com","980ba","0","0");
INSERT INTO schools VALUES("8","jfbiweqafch","fhuiwachf@aociwfawx.com","57bbf","0","0");
INSERT INTO schools VALUES("9","sfhjkoq","jhjcgweiqgoweqmfc@wnfohjmow.com","927d5","0","0");
INSERT INTO schools VALUES("10","sdfhoiagaq","feuigoywqeocmifg@fwiqofacq.com","ff19b","0","0");



DROP TABLE IF EXISTS teams;

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `school` int(11) NOT NULL,
  `score_team_short` int(11) DEFAULT NULL,
  `score_team_long` int(11) DEFAULT NULL,
  `guts_ans_a` varchar(100) DEFAULT NULL,
  `guts_ans_b` varchar(100) DEFAULT NULL,
  `guts_ans_c` varchar(100) DEFAULT NULL,
  `score_guts` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




