CREATE TABLE reaction_type(
   id VARCHAR(15) NOT NULL,
   reaction_name VARCHAR(10),
   reaction_content VARCHAR(255),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE apparence(
   id VARCHAR(15) NOT NULL,
   apparence_name VARCHAR(10),
   apparence_content VARCHAR(50),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE profil_image(
   id VARCHAR(15) NOT NULL,
   image_name VARCHAR(10),
   image_content VARCHAR(255),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE background_image(
   id VARCHAR(15) NOT NULL,
   background_name VARCHAR(10),
   background_content VARCHAR(255),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE langage(
   id VARCHAR(15) NOT NULL,
   langage_name VARCHAR(10),
   langage_content VARCHAR(50),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE mode(
   id VARCHAR(15) NOT NULL,
   mode_content VARCHAR(50),
   mode_name VARCHAR(10),
   PRIMARY KEY(id)
)ENGINE INNODB;

CREATE TABLE utilisateur(
   id VARCHAR(15) NOT NULL,
   pass VARCHAR(255),
   email VARCHAR(255),
   profil_image VARCHAR(255) NOT NULL,
   apparence VARCHAR(15) NOT NULL,
   mode VARCHAR(15) NOT NULL,
   langage VARCHAR(15) NOT NULL,
   creation_date DATETIME,
   statut VARCHAR(10),
   remember_token VARCHAR(70),
   reset_token VARCHAR(70),
   PRIMARY KEY(id),
   FOREIGN KEY(apparence) REFERENCES apparence(id),
   FOREIGN KEY(mode) REFERENCES mode(id),
   FOREIGN KEY(profil_image) REFERENCES profil_image(id),
   FOREIGN KEY(langage) REFERENCES langage(id)
)ENGINE INNODB;

CREATE TABLE publication(
   id VARCHAR(15) NOT NULL,
   publication_content VARCHAR(255),
   publication_date DATETIME,
   background_image VARCHAR(15) NOT NULL,
   id_user VARCHAR (15) NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(background_image) REFERENCES background(id),
   FOREIGN KEY(id_user) REFERENCES utilisateur(id)
)ENGINE INNODB;

CREATE TABLE reaction(
   id VARCHAR(15) NOT NULL,
   reaction_type VARCHAR(15) NOT NULL,
   reaction_date DATETIME,
   PRIMARY KEY(id),
   FOREIGN KEY(reaction_type) REFERENCES reaction_type(id)
)ENGINE INNODB;

CREATE TABLE ajouter(
   id VARCHAR(15) NOT NULL,
   id_user1 VARCHAR(15) NOT NULL,
   id_user2 VARCHAR(15) NOT NULL,
   ajout_date DATETIME,
   PRIMARY KEY(id),
   FOREIGN KEY(id_user1) REFERENCES utilisateur(id),
   FOREIGN KEY(id_user2) REFERENCES utilisateur(id)
)ENGINE INNODB;

CREATE TABLE avoir(
   id VARCHAR(15) NOT NULL,
   publication_id VARCHAR(15) NOT NULL,
   reaction_id VARCHAR(15) NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(publication_id) REFERENCES publication(id),
   FOREIGN KEY(reaction_id) REFERENCES reaction(id)
)ENGINE INNODB;
