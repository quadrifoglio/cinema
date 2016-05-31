CREATE TABLE room (
	RoomID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	RoomCap INTEGER NOT NULL
);

CREATE TABLE film (
	FilmID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	FilmTitle VARCHAR(50) NOT NULL,
	FilmRelease DATE NOT NULL,
	FilmDesc TEXT
);

CREATE TABLE role (
	RoleID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	RoleName VARCHAR(50) NOT NULL
);

CREATE TABLE person (
	PersonID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	PersonFirstName VARCHAR(50) NOT NULL,
	PersonLastName VARCHAR(50) NOT NULL
);

CREATE TABLE client (
	ClientID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	ClientMail VARCHAR(255) NOT NULL,
	ClientPass CHAR(40) NOT NULL,
	ClientFirstName VARCHAR(50) NOT NULL,
	ClientLastName VARCHAR(50) NOT NULL,
	ClientAge INTEGER NOT NULL,
	ClientCity VARCHAR(50)
);

CREATE TABLE session (
	SessionID CHAR(64) NOT NULL UNIQUE PRIMARY KEY,
	SessionClientRef INTEGER NOT NULL REFERENCES client ON UPDATE CASCADE ON DELETE RESTRICT,
	SessionExpiration INTEGER NOT NULL
);

CREATE TABLE screening (
	ScreeningID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	ScreeningRoom INTEGER NOT NULL REFERENCES room ON UPDATE CASCADE ON DELETE CASCADE,
	ScreeningFilm  INTEGER NOT NULL REFERENCES film ON UPDATE CASCADE ON DELETE CASCADE,
	ScreeningDate DATE NOT NULL,
	ScreeningTime TIME NOT NULL
);

CREATE TABLE staff (
	FilmIdRef INTEGER NOT NULL REFERENCES film ON UPDATE CASCADE ON DELETE CASCADE,
	RoleIdRef INTEGER NOT NULL REFERENCES role ON UPDATE CASCADE ON DELETE RESTRICT,
	PersonIdRef INTEGER NOT NULL REFERENCES person ON UPDATE CASCADE ON DELETE RESTRICT,
	PRIMARY KEY (FilmIdRef, RoleIdRef, PersonIdRef)
);

CREATE TABLE booking (
	BookingID SERIAL UNIQUE NOT NULL PRIMARY KEY,
	ClientRef INTEGER NOT NULL REFERENCES client ON UPDATE CASCADE ON DELETE RESTRICT,
	ScreeningRef INTEGER NOT NULL REFERENCES screening ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO client VALUES (1, 'william@peal.com', '20f98f1d16f1c4805849e57c7bb00c578003fea6', 'William', 'Peal', 42, 'Annecy');

INSERT INTO room VALUES (1, 100), (2, 200);
INSERT INTO role VALUES (1, 'director'), (2, 'actor');

INSERT INTO film VALUES (1, 'Cloud Atlas', '2013-03-13', 'An exploration of how the actions of individual lives impact one another in the past, present and future, as one soul is shaped from a killer into a hero, and an act of kindness ripples across centuries to inspire a revolution.');
INSERT INTO person VALUES (1, 'Lana', 'Wachowski'), (2, 'Lilly', 'Wachowski'), (3, 'Tom', 'Tykwer'), (4, 'Tom', 'Hanks');
INSERT INTO staff VALUES (1, 1, 1), (1, 1, 2), (1, 1, 3), (1, 2, 4);
INSERT INTO screening VALUES (1, 2, 1, '2016-05-28', '13:00:00'), (2, 2, 1, '2016-05-28', '23:00:00'), (3, 2, 1, '2016-05-30', '09:00:00'), (4, 2, 1, '2016-05-30', '18:00:00');

INSERT INTO film VALUES (2, 'Bienvenue à Zombieland', '2009-11-25', 'A shy student trying to reach his family in Ohio, a gun-toting tough guy trying to find the last Twinkie, and a pair of sisters trying to get to an amusement park join forces to travel across a zombie-filled America.');
INSERT INTO person VALUES (5, 'Ruben', 'Fleischer'), (6, 'Jesse', 'Eisenberg'), (7, 'Emma', 'Stone'), (8, 'Woody', 'Harrelson');
INSERT INTO staff VALUES (2, 1, 5), (2, 2, 6), (2, 2, 7), (2, 2, 8);
INSERT INTO screening VALUES (5, 2, 2, '2016-06-01', '13:00:00'), (6, 2, 2, '2016-06-01', '16:00:00'), (7, 2, 2, '2016-06-05', '09:00:00'), (8, 2, 2, '2016-06-10', '18:00:00');
