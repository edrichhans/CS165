
CREATE TABLE User(
	userID 		INT 		NOT NULL,
	username	VARCHAR(10) NOT NULL,
	name		VARCHAR(50)	NOT NULL,
	password 	VARCHAR(10) NOT NULL,
	email		VARCHAR(20),
	phone		VARCHAR(20),
	PRIMARY KEY(userID)
);

CREATE TABLE Event(
	eventID 	INT			NOT NULL,
	eventName	VARCHAR(50)	NOT NULL,
	actors		VARCHAR(100),
	synopsis	VARCHAR(200),
	PRIMARY KEY(eventID)
);

CREATE TABLE Theater(
	theaterID	INT			NOT NULL,
	theatername	VARCHAR(50) NOT NULL,
	noOfSeats	INT 		NOT NULL,
	location	VARCHAR(100) NOT NULL,
	PRIMARY KEY(theaterID)
);


CREATE TABLE Created(
	userID 		INT		NOT NULL,
	eventID		INT		NOT NULL,
	dateCreated	DATE 	NOT NULL,
	PRIMARY KEY(userID,eventID)
);

CREATE TABLE Shows(
	showID		INT		NOT NULL,
	eventID		INT 	NOT NULL,
	theaterID	INT 	NOT NULL,
	showDate	DATE 	NOT NULL,
	startTime	TIME 	NOT NULL,
	endTime		TIME 	NOT NULL,
	PRIMARY KEY(showID)
);

CREATE TABLE Tickets(
	ticketNo	INT		NOT NULL,
	showID		INT		NOT NULL,
	isReserved	INT		NOT NULL,
	PRIMARY KEY(ticketNo)
);

CREATE TABLE Reserved(
	ticketNo 	INT 	NOT NULL,
	userID 		INT 	NOT NULL,
	dateReserved	DATETIME NOT NULL,
	PRIMARY KEY (ticketNo,userID)
);
