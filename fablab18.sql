CREATE TABLE Membre(
   id_membre INT,
   nom_membre VARCHAR(50),
   prenom_membre VARCHAR(50),
   email_membre VARCHAR(50),
   PRIMARY KEY(id_membre)
);

CREATE TABLE Commentaire(
   id_commentaire VARCHAR(250),
   commentaire VARCHAR(250),
   id_membre INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_membre) REFERENCES Membre(id_membre)
);

CREATE TABLE Formation(
   id_formation INT,
   libel_formation VARCHAR(50),
   id_membre INT NOT NULL,
   PRIMARY KEY(id_formation),
   FOREIGN KEY(id_membre) REFERENCES Membre(id_membre)
);

CREATE TABLE Outil(
   id_outil INT,
   libel_outil VARCHAR(50),
   photo_outil VARCHAR(50),
   description_outil VARCHAR(150),
   id_membre INT NOT NULL,
   PRIMARY KEY(id_outil),
   FOREIGN KEY(id_membre) REFERENCES Membre(id_membre)
);

CREATE TABLE Realisation(
   id_realisation INT,
   libel_realisation VARCHAR(50),
   description_realisation VARCHAR(150),
   photo_realisation VARCHAR(50),
   id_outil INT NOT NULL,
   PRIMARY KEY(id_realisation),
   FOREIGN KEY(id_outil) REFERENCES Outil(id_outil)
);

CREATE TABLE Administrateur (
  id_admin int(11),
  nom_admin varchar(50),
  prenom_admin varchar(50),
  password varchar(100),
  PRIMARY KEY(id_admin)
)