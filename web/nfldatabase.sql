DROP DATABASE IF EXISTS student;
CREATE DATABASE student;
USE student;

CREATE TABLE Admin (
	username CHARACTER VARYING (20),
	password_hash CHARACTER VARYING (60)
);

CREATE TABLE Player (
	player_id INTEGER,
	nfl_rank INTEGER,
	player_last CHARACTER VARYING (15),
	player_first CHARACTER VARYING (15),
	team CHARACTER VARYING (20),
	touchdowns INTEGER,
	receiving_yardage INTEGER,
	catches INTEGER,
	PRIMARY KEY (player_id)
);

CREATE TABLE Team (
	name CHARACTER VARYING (20),
	year_founded INTEGER,
	num_wins INTEGER,
	num_widereceivers INTEGER,
	PRIMARY KEY (name)
);

CREATE TABLE History (
	player_id INTEGER,
	career_touchdowns INTEGER,
	career_receiving_yardage INTEGER,
	career_catches INTEGER,
	years_played INTEGER,
	current_team CHARACTER VARYING (20),
	previous_team CHARACTER VARYING (20),
	PRIMARY KEY(player_id),
	FOREIGN KEY (player_id) REFERENCES Player(player_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (current_team) REFERENCES Team(name) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Coach (
	coach_id INTEGER UNIQUE,
	team CHARACTER VARYING (20),
	first_name CHARACTER VARYING (15),
	last_name CHARACTER VARYING (15),
	PRIMARY KEY (coach_id),
	FOREIGN KEY (team) REFERENCES Team(name) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Experience (
	coach_id INTEGER UNIQUE,
	team CHARACTER VARYING (20),
	first_name CHARACTER VARYING (15),
	last_name CHARACTER VARYING (15),
	years_coached INTEGER,
	coach_type CHARACTER VARYING (15),
	PRIMARY KEY (coach_id),
	FOREIGN KEY (coach_id) REFERENCES Coach(coach_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO Player (player_id, nfl_rank, player_first, player_last, team, touchdowns, receiving_yardage, catches)
VALUES (01, 1, 'Justin', 'Jefferson', 'Vikings', 5, 1074, 68),
(02, 20, 'T.J.', 'Hockenson', 'Vikings', 5, 960, 95),
(03, 4, 'Jordan', 'Addison', 'Vikings', 10, 911, 70),
(04, 2, 'Ja''Marr', 'Chase', 'Bengals', 7, 1216, 100),
(05, 8, 'Tyler', 'Boyd', 'Bengals', 2, 667, 67),
(06, 14, 'Tee', 'Higgins', 'Bengals', 5, 656, 42),
(07, 3, 'Garret', 'Wilson', 'Jets', 3, 1042, 95),
(08, 29, 'Tyler', 'Conklin', 'Jets', 0, 621, 61),
(09, 30, 'Allen', 'Lazard', 'Jets', 1, 311, 23),
(10, 5, 'Davante', 'Adams', 'Raiders', 8, 1144, 103),
(11, 22, 'Jakobi', 'Myers', 'Raiders', 8, 807, 71),
(12, 23, 'Tre', 'Tucker', 'Raiders', 2, 331, 19),
(13, 13, 'Drake', 'London', 'Falcons', 2, 905, 69),
(14, 12, 'Kyle', 'Pitts', 'Falcons', 3, 667, 53),
(15, 24, 'Jonnu', 'Smith', 'Falcons', 3, 582, 50),
(16, 7, 'Amari', 'Cooper', 'Browns', 5, 1250, 72),
(17, 15, 'David', 'Njoku', 'Browns', 6, 882, 81),
(18, 17, 'Elijah', 'Moore', 'Browns', 2, 640, 59),
(19, 16, 'Nico', 'Collins', 'Texans', 8, 1297, 80),
(20, 6, 'Tank', 'Dell', 'Texans', 7, 709, 47),
(21, 25, 'Dalton', 'Schultz', 'Texans', 5, 635, 59),
(22, 18, 'Adam', 'Thielen', 'Panthers', 4, 1014, 103),
(23, 19, 'DJ', 'Chark', 'Panthers', 5, 525, 35),
(24, 26, 'Jonathan', 'Mingo', 'Panthers', 0, 418, 43),
(25, 9, 'George', 'Pickens', 'Steelers', 5, 1140, 63),
(26, 10, 'Diontae', 'Johnson', 'Steelers', 5, 717, 51),
(27, 27, 'Pat', 'Freiermuth', 'Steelers', 2, 308, 32),
(28, 21, 'Darius', 'Slayton', 'Giants', 4, 770, 50),
(29, 11, 'Darren', 'Waller', 'Giants', 1, 552, 52),
(30, 28, 'Wan''Dale', 'Robinson', 'Giants', 1, 525, 60);

INSERT INTO Team (name, year_founded, num_wins, num_widereceivers)
VALUES ('Falcons', 1965, 390, 11),
('Vikings', 1961, 523, 12),
('Texans', 2002, 152, 10),
('Panthers', 1993, 223, 10),
('Giants', 1925, 721, 11),
('Raiders', 1960, 505, 9),
('Bengals', 1968, 394, 8),
('Browns', 1944, 512, 9),
('Steelers', 1933, 688, 10),
('Jets', 1959, 428, 11);

INSERT INTO History (player_id, career_touchdowns, career_receiving_yardage, career_catches, years_played, current_team, previous_team)
VALUES (1, 30, 1074, 392, 4, 'Vikings', 'None'),
(2, 23, 31547, 341, 6, 'Vikings', 'Lions'),
(3, 10, 911, 70, 1, 'Vikings', 'None'),
(4, 29, 3717, 268, 3, 'Bengals', 'None'),
(5, 31, 6000, 513, 8, 'Bengals', 'None'),
(6, 24, 3684, 257, 4, 'Bengals', 'None'),
(7, 7, 2145, 178, 2, 'Jets', 'None'),
(8,7, 2095, 212, 6,'Jets', 'Vikings'),
(9, 21, 2547, 192, 6, 'Jets', 'Packers'),
(10, 85, 10781, 872, 10, 'Raiders', 'Packers'),
(11, 16, 3565, 306, 5, 'Raiders', 'Patriots'),
(12, 2, 331, 19, 1, 'Raiders', 'None'),
(13, 6, 1771, 141, 2, 'Falcons', 'None'),
(14, 6, 2049, 149, 3, 'Falcons', 'None'),
(15, 20, 2423, 219, 7, 'Falcons', 'Patriots'),
(16, 60, 9486, 667, 10, 'Browns', 'Cowboys'),
(17, 25, 3264, 287, 7, 'Browns', 'None'),
(18, 8, 1624, 139, 3, 'Browns', 'Jets'),
(19, 11, 2224, 150, 3, 'Texans', 'None'),
(20, 7, 709, 47, 1, 'Texans', 'None'),
(21, 22, 2757, 270, 6, 'Texans', 'Cowboys'),
(22, 59, 7696, 637, 10, 'Panthers', 'Vikings'),
(23, 23, 3069, 212, 6, 'Panthers', 'Lions'),
(24, 0, 418, 43, 1, 'Panthers', 'None'),
(25, 9, 1941, 115, 2, 'Steelers', 'None'),
(26, 25, 4363, 391, 5, 'Steelers', 'None'),
(27, 11, 1537, 155, 3, 'Steelers', 'None'),
(28, 19, 3324, 220, 5, 'Giants', 'None'),
(29, 20, 4124, 350, 8, 'Giants', 'Raiders'),
(30, 2, 752, 83, 2, 'Giants', 'None');

INSERT INTO Coach (coach_id, team, first_name, last_name)
VALUES (01, 'Falcons', 'Raheem', 'Morris'),
(02, 'Vikings', 'Kevin', 'O''Connell'),
(03, 'Texans', 'DeMeco', 'Ryans'),
(04, 'Panthers', 'Dave', 'Canales'),
(05, 'Giants', 'Brian', 'Daboll'),
(06, 'Raiders', 'Antonio', 'Pierce'),
(07, 'Bengals', 'Zac', 'Taylor'),
(08, 'Browns', 'Kevin', 'Stefanski'),
(09, 'Steelers', 'Mike', 'Tomlin'),
(10, 'Jets', 'Robert', 'Saleh');

INSERT INTO Experience (coach_id, team, first_name, last_name, years_coached, coach_type)
VALUES (01, 'Falcons', 'Raheem', 'Morris', 7, 'Head Coach'),
(02, 'Vikings', 'Kevin', 'O''Connell', 2, 'Head Coach'),
(03, 'Texans', 'DeMeco', 'Ryans', 2, 'Head Coach'),
(04, 'Panthers', 'Dave', 'Canales', 1, 'Head Coach'),
(05, 'Giants', 'Brian', 'Daboll', 2, 'Head Coach'),
(06, 'Raiders', 'Antonio', 'Pierce', 1, 'Head Coach'),
(07, 'Bengals', 'Zac', 'Taylor', 5, 'Head Coach'),
(08, 'Browns', 'Kevin', 'Stefanski', 4, 'Head Coach'),
(09, 'Steelers', 'Mike', 'Tomlin', 17, 'Head Coach'),
(10, 'Jets', 'Robert', 'Saleh', 3, 'Head Coach');

INSERT INTO Admin (username, password_hash)
VALUES ('admin', '$2y$10$Vmi4XUjpIzukbIQb/UQsru03q0NP2ejzyFfRiJD7zOieXwpWcMaH2');
