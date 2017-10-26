-- ceate database project_esi
CREATE DATABASE if not exists project_esi;
use project_esi;


-- create table soutenance
CREATE TABLE if not exists soutenance(
	id_soutenance int(25) AUTO_INCREMENT NOT NULL,
	nom_soute varchar(25),
	date_soute datetime,
	status_soute varchar(25),
	numsalle_soute int(25),
	PRIMARY KEY(id_soutenance)
);

-- create table groupe
CREATE TABLE if not exists groupe(
	id_groupe int(25) AUTO_INCREMENT NOT NULL,
	id_soutenance int(25),
	PRIMARY KEY(id_groupe),
	FOREIGN KEY(id_soutenance) REFERENCES soutenance(id_soutenance)
);

-- create table compte
CREATE TABLE if not exists compte(
	id_compte int(25) AUTO_INCREMENT NOT NULL,
	mail varchar(50) NOT NULL,
	passwd varchar(60) NOT NULL,
	PRIMARY KEY(id_compte)
);
INSERT INTO compte VALUE (null,'yja8534786@gmail.com','167b6c4a4e415fdfc65024a01a1d46b38344ab1b');


-- create table enseignant
CREATE TABLE if not exists enseignant(
	id_ensei int(25) AUTO_INCREMENT NOT NULL,
	nom_ensei varchar(25) NOT NULL,
	prenom_ensei varchar(25) NOT NULL,
	identity varchar(25) NOT NULL,
	id_compte int(25),
	PRIMARY KEY(id_ensei),
	FOREIGN KEY(id_compte) REFERENCES compte(id_compte)
);


-- create table eleves
CREATE TABLE if not exists eleve(
	id_eleve int(25) AUTO_INCREMENT NOT NULL,
	nom_eleve varchar(25) NOT NULL,
	prenom_eleve varchar(25) NOT NULL,
	identity varchar(25) NOT NULL,
	id_compte int(25),
	id_groupe int(25),
	PRIMARY KEY(id_eleve),
	FOREIGN KEY(id_compte) REFERENCES compte(id_compte),
	FOREIGN KEY(id_groupe) REFERENCES groupe(id_groupe)
);

