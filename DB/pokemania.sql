CREATE TABLE Owns
(
	idU                  INTEGER NOT NULL,
	idO                  INTEGER NOT NULL,
	idP                  INTEGER NOT NULL,
	xp                   INTEGER NOT NULL,
	level                INTEGER NOT NULL
);

ALTER TABLE Owns
ADD CONSTRAINT XPKOwns PRIMARY KEY (idO);

CREATE TABLE Participates
(
	cntWin               INTEGER NOT NULL DEFAULT 0,
	idU                  INTEGER NOT NULL,
	idT                  INTEGER NOT NULL
);

ALTER TABLE Participates
ADD CONSTRAINT XPKParticipates PRIMARY KEY (idU,idT);

CREATE TABLE Registered
(
	idU                  INTEGER NOT NULL,
	idT                  INTEGER NOT NULL
);

ALTER TABLE Registered
ADD CONSTRAINT XPKRegistered PRIMARY KEY (idU,idT);

CREATE TABLE Tournament
(
	idT                  INTEGER NOT NULL,
	name                 VARCHAR(40) NOT NULL,
	prize                INTEGER NOT NULL,
	minLevel             INTEGER NOT NULL,
	maxLevel             INTEGER NOT NULL,
	endDate              TIMESTAMP NOT NULL,
	entryFee             INTEGER NOT NULL
);

ALTER TABLE Tournament
ADD CONSTRAINT XPKTournament PRIMARY KEY (idT);

CREATE UNIQUE INDEX uniqueName ON Tournament
(
	name ASC
);

CREATE TABLE User
(
	idU                  INTEGER NOT NULL,
	email                VARCHAR(64) NOT NULL,
	nickname             VARCHAR(64) NOT NULL,
	password             VARCHAR(64) NOT NULL,
	bAdmin               boolean NOT NULL DEFAULT 0,
	cntPokemons          INTEGER NOT NULL DEFAULT 1,
	cntCash              INTEGER NOT NULL DEFAULT 500,
	cntBalls             INTEGER NOT NULL DEFAULT 3,
	cntFruits            INTEGER NOT NULL DEFAULT 0,
	trainer              INTEGER NOT NULL DEFAULT 1
);

ALTER TABLE User
ADD CONSTRAINT XPKUser PRIMARY KEY (idU);

CREATE UNIQUE INDEX uniqueEmail ON User
(
	email ASC
);

ALTER TABLE Owns
ADD CONSTRAINT R_5 FOREIGN KEY (idU) REFERENCES User (idU);

ALTER TABLE Participates
ADD CONSTRAINT R_1 FOREIGN KEY (idU) REFERENCES User (idU);

ALTER TABLE Participates
ADD CONSTRAINT R_2 FOREIGN KEY (idT) REFERENCES Tournament (idT);

ALTER TABLE Registered
ADD CONSTRAINT R_3 FOREIGN KEY (idU) REFERENCES User (idU);

ALTER TABLE Registered
ADD CONSTRAINT R_4 FOREIGN KEY (idT) REFERENCES Tournament (idT);
