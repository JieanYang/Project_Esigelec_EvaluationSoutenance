-- ceate database project_esi
CREATE DATABASE if not exists project_esi;
use project_esi;


-- create table soutenance
CREATE TABLE if not exists soutenance(
	id_soutenance int(25) AUTO_INCREMENT NOT NULL,
	nom_soute varchar(25),
	date_soute datetime,
	status_soute varchar(25),
	numsalle_soute varchar(25),
	PRIMARY KEY(id_soutenance)
);

-- create table groupe
CREATE TABLE if not exists groupe(
	id_groupe int(25) NOT NULL,
	id_soutenance int(25),
	FOREIGN KEY(id_soutenance) REFERENCES soutenance(id_soutenance)
);

-- create table compte
CREATE TABLE if not exists compte(
	id_compte int(25) AUTO_INCREMENT NOT NULL,
	mail varchar(50) NOT NULL,
	passwd varchar(60) NOT NULL,
	identity varchar(25) NOT NULL,
	PRIMARY KEY(id_compte)
);

-- create table enseignant
CREATE TABLE if not exists enseignant(
	id_ensei int(25) AUTO_INCREMENT NOT NULL,
	nom_ensei varchar(25) NOT NULL,
	prenom_ensei varchar(25) NOT NULL,
	id_compte int(25),
	PRIMARY KEY(id_ensei),
	FOREIGN KEY(id_compte) REFERENCES compte(id_compte)
);


-- create table eleves
CREATE TABLE if not exists eleve(
	id_eleve int(25) AUTO_INCREMENT NOT NULL,
	nom_eleve varchar(25) NOT NULL,
	prenom_eleve varchar(25) NOT NULL,
	id_compte int(25),
	id_groupe int(25),
	PRIMARY KEY(id_eleve),
	FOREIGN KEY(id_compte) REFERENCES compte(id_compte),
	FOREIGN KEY(id_groupe) REFERENCES groupe(id_groupe)
);


-- Des donnees de simulation
INSERT INTO compte (mail, passwd, identity) VALUES ('yja8534786@gmail.com','167b6c4a4e415fdfc65024a01a1d46b38344ab1b', 'enseignant');
INSERT INTO enseignant (nom_ensei, prenom_ensei, id_compte) VALUES ('yang', 'master', 1);

INSERT INTO soutenance (nom_soute, date_soute, status_soute, numsalle_soute) VALUES ('math', '2017-10-26T15:00', 'dispinible', 'b233');
INSERT INTO groupe (id_groupe, id_soutenance) VALUES ('5', '1');
INSERT INTO soutenance (nom_soute, date_soute, status_soute, numsalle_soute) VALUES ('english', '2017-10-26T16:00', 'dispinible', 'b256');
INSERT INTO groupe (id_groupe, id_soutenance) VALUES ('8', '2');

INSERT INTO compte (mail, passwd, identity) VALUES ('a@gmail.com','167b6c4a4e415fdfc65024a01a1d46b38344ab1b', 'eleve');
INSERT INTO eleve(nom_eleve, prenom_eleve, id_groupe, id_compte) 
VALUES ('yang', 'jiean', '5', 2);
INSERT INTO compte (mail, passwd, identity) VALUES ('b@gmail.com','167b6c4a4e415fdfc65024a01a1d46b38344ab1b', 'eleve');
INSERT INTO eleve(nom_eleve, prenom_eleve, id_groupe, id_compte) 
VALUES ('liang', 'feifan', '4', 3);


