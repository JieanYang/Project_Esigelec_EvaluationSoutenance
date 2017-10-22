-- ceate database project_esi
CREATE DATABASE if not exists project_esi;
use project_esi;


-- create table compte
CREATE TABLE if not exists compte(
	id_compte int(25) AUTO_INCREMENT NOT NULL,
	mail varchar(50) NOT NULL,
	passwd varchar(30) NOT NULL,
	PRIMARY KEY(id_compte)
);
INSERT INTO compte VALUE (null,'yja8534786@gmail.com','yang');


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


-- create table groupe
CREATE TABLE if not exists groupe(
	id_groupe int(25) AUTO_INCREMENT NOT NULL,
	id_soutenance int(25),
	PRIMARY KEY(id_groupe),
	FOREIGN KEY(id_soutenance) REFERENCES soutenance(id_soutenance)
);


-- create table soutenance
CREATE TABLE if not exists soutenance(
	id_soutenance int(25) AUTO_INCREMENT NOT NULL,
	nom_soute varchar(25),
	data_soute date,
	status_soute varchar(25),
	numsalle_soute int(25),
	PRIMARY KEY(id_soutenance)
);