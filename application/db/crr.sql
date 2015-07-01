--
-- File generated with SQLiteStudio v3.0.6 on Wed Jun 17 12:41:31 2015
--
-- Text encoding used: windows-1252
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: reserver
CREATE TABLE reserver (userID VARCHAR (255) PRIMARY KEY NOT NULL UNIQUE, email VARCHAR (255) UNIQUE, studFac varchar (255));
INSERT INTO reserver (userID, email, studFac) VALUES ('123', 'stephen@marist.edu', 'stud');

-- Table: reservations
CREATE TABLE reservations (resID VARCHAR (255) PRIMARY KEY UNIQUE NOT NULL, resDate DATE, startTime TIME, endTime TIME, resEmail varchar (255) REFERENCES reserver (email), resType varchar (255), roomNum VARCHAR (255) REFERENCES rooms (roomNum) NOT NULL, status VARCHAR (255), isFinals BOOLEAN, FOREIGN KEY (roomNum) REFERENCES rooms (roomNum));
INSERT INTO reservations (resID, resDate, startTime, endTime, resEmail, resType, roomNum, status, isFinals) VALUES ('123', '2015-06-18', '10:00AM', '12:00PM', 'stephen@marist.edu', 'person', '110', 'reserved', 'false');
INSERT INTO reservations (resID, resDate, startTime, endTime, resEmail, resType, roomNum, status, isFinals) VALUES ('144', '2015-01-17', '10:00AM', '1:00PM', 'stephen@marist.edu', 'person', '300A', 'reserved', 'false');
INSERT INTO reservations (resID, resDate, startTime, endTime, resEmail, resType, roomNum, status, isFinals) VALUES ('2020', '2015-01-17', '1:00PM', '3:00PM', 'stephen@marist.edu', 'person', '112', 'unverified', 'false');

-- Table: rooms
CREATE TABLE rooms(
    roomNum varchar(255) NOT NULL,
    seats int(2),
    computers int(2),
    printers int(2),
    scanners int(2),
    whiteboards int(2),
    Primary key (roomNum)
);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('110', 5, 1, 0, 0, 1);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('111', 4, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('112', 7, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('300A', 8, 0, 0, 0, 1);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('300B', 6, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('300C', 6, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('300D', 5, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('306', 5, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('312', 2, 2, 0, 1, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('313', 3, 1, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('314', 5, 4, 0, 2, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('315', 3, 2, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('316', 3, 4, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('317', 2, 2, 0, 0, 0);
INSERT INTO rooms (roomNum, seats, computers, printers, scanners, whiteboards) VALUES ('318', 3, 3, 0, 0, 1);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
