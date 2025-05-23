DROP DATABASE IF EXISTS recrute_DB;
CREATE DATABASE recrute_DB;
USE recrute_DB;


CREATE TABLE Candidat (
    idCandidat INT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    tel VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    CONSTRAINT Candidat_PK PRIMARY KEY (idCandidat)
) ENGINE=InnoDB;

CREATE TABLE Manager (
    idManager INT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    tel VARCHAR(50) NOT NULL,
    CONSTRAINT Manager_PK PRIMARY KEY (idManager)
) ENGINE=InnoDB;

CREATE TABLE Annonce (
    idAnnonce INT AUTO_INCREMENT NOT NULL,
    titre VARCHAR(50) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    typeCon VARCHAR(50) NOT NULL,
    description VARCHAR(5000) NOT NULL,
    salaire FLOAT NOT NULL,
    duree VARCHAR(50) NOT NULL,
    dateAnn VARCHAR(50) NOT NULL, -- Type VARCHAR(50) pour la date
    idManager INT NOT NULL,
    CONSTRAINT Annonce_PK PRIMARY KEY (idAnnonce),
    CONSTRAINT Annonce_Manager_FK FOREIGN KEY (idManager) REFERENCES Manager(idManager)
) ENGINE=InnoDB;

CREATE TABLE Candidature (
    idCandidature INT AUTO_INCREMENT NOT NULL,
    cv LONGBLOB NOT NULL,
    motivation LONGBLOB NULL, -- Type VARCHAR(50) pour la date
    extraDoc LONGBLOB NULL,
    statut VARCHAR(50) NOT NULL,
    idCandidat INT NOT NULL,
    idAnnonce int not null,
    dateCand VARCHAR(50) NOT NULL,
    CONSTRAINT Candidature_PK PRIMARY KEY (idCandidature),
    CONSTRAINT Candidature_Candidat_FK FOREIGN KEY (idCandidat) REFERENCES Candidat(idCandidat),
    CONSTRAINT Candidature_Annonce_FK FOREIGN KEY (idAnnonce) REFERENCES Annonce(idAnnonce)
) ENGINE=InnoDB;

CREATE TABLE Spontanee (
    idSpontanee INT AUTO_INCREMENT NOT NULL,
    cv LONGBLOB NOT NULL,
    motivation LONGBLOB NULL, -- Type VARCHAR(50) pour la date
    extraDoc LONGBLOB NULL,
    statut VARCHAR(50) NOT NULL,
    idCandidat INT NOT NULL,
    dateCand VARCHAR(50) NOT NULL,
    CONSTRAINT Spontanee_PK PRIMARY KEY (idSpontanee),
    CONSTRAINT Spontanee_Candidat_FK FOREIGN KEY (idCandidat) REFERENCES Candidat(idCandidat)
) ENGINE=InnoDB;

CREATE TABLE Postuler (
    idCandidature INT NOT NULL,
    idCandidat INT NOT NULL,
    CONSTRAINT Postuler_PK PRIMARY KEY (idCandidature, idCandidat),
    CONSTRAINT Postuler_Candidature_FK FOREIGN KEY (idCandidature) REFERENCES Candidature(idCandidature),
    CONSTRAINT Postuler_Candidat_FK FOREIGN KEY (idCandidat) REFERENCES Candidat(idCandidat)
) ENGINE=InnoDB;

-- Insertion des valeurs

INSERT INTO Candidat (nom, prenom, adresse, tel, email, mdp) VALUES ('test', 'test', 'test', 'test', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
INSERT INTO Manager (nom, prenom, email, mdp, tel) VALUES ('test1', 'test1', 'test1', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'test1');
INSERT INTO Annonce (titre, adresse, typeCon, description, salaire, duree, dateAnn, idManager) VALUES ('test', 'test', 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In blandit vulputate urna. Donec et tortor vitae turpis commodo varius et vitae augue. Nulla augue arcu, facilisis in aliquam quis, sagittis in diam. Pellentesque lobortis dictum nisi ut pharetra. Aenean vitae tellus fringilla, cursus diam vitae, porttitor magna. Nunc eget efficitur eros, id pellentesque magna. Suspendisse sit amet lacus ipsum. Suspendisse laoreet libero id magna fermentum tempor.

Sed sapien nulla, semper nec lacus nec, porttitor finibus enim. Nullam vulputate vulputate felis id venenatis. Donec in lacus tincidunt, auctor ante sit amet, gravida diam. Mauris at vestibulum enim, non scelerisque tellus. In eleifend urna erat, ultrices luctus velit pulvinar et. Sed est est, scelerisque venenatis elit vel, congue porta augue. Vivamus aliquam purus est, id porttitor eros molestie in. Etiam auctor tellus risus, sed dapibus ligula laoreet sed. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse cursus quis nisi consequat facilisis. Quisque blandit nisi arcu, eget blandit tortor maximus non. Cras mollis posuere blandit. Suspendisse gravida varius mi, ut placerat ante consectetur cursus.

Ut in convallis nisl, a porttitor turpis. Fusce diam sapien, convallis ac consectetur quis, facilisis ut lacus. Aenean malesuada commodo nulla, ac venenatis lorem accumsan in. Donec sapien justo, interdum ut lectus sit amet, cursus bibendum velit. Phasellus nisi leo, pretium quis nisl vel, luctus eleifend risus. Aenean a elit quis enim volutpat semper quis et ligula. Sed eget nunc felis. Sed tincidunt sagittis justo, volutpat fermentum metus lobortis vitae. Suspendisse potenti. Quisque consectetur, dui ac pretium egestas, lorem velit molestie ligula, at congue arcu augue sed massa. Phasellus lacus lectus, semper ut ligula vitae, faucibus fermentum orci. Phasellus at vestibulum sapien, in luctus risus. Vestibulum ac sem nec urna tincidunt dapibus. Nulla eleifend sed augue eu elementum. Quisque porttitor, erat ut pretium feugiat, dui purus mollis nibh, et tincidunt velit arcu at nisi. Pellentesque non imperdiet magna, sed lacinia felis.

Sed sit amet est volutpat, posuere magna non, venenatis lorem. Sed et sollicitudin eros. Sed leo erat, aliquet a orci eget, tincidunt fermentum lacus. Curabitur blandit ultricies nibh a vehicula. Curabitur molestie massa ac ex mattis, quis ultrices velit scelerisque. Sed vitae est nisl. Ut porta eleifend purus tincidunt venenatis. Sed velit odio, rhoncus vitae mauris ut, rhoncus pellentesque urna. Aenean rutrum, arcu eu suscipit dictum, odio lacus consectetur arcu, ut tristique velit nulla sed urna. Donec at libero eget quam gravida consectetur efficitur vel orci. Morbi felis quam, porta id erat a, laoreet faucibus erat. Vestibulum at enim et nibh sagittis maximus. Suspendisse rutrum aliquet lobortis. Nunc quis suscipit nisl. Vestibulum fringilla urna sit amet tortor mollis efficitur.

Aliquam bibendum, elit lacinia porttitor dignissim, justo sapien aliquam mi, sed porta nunc eros id eros. Aenean ante lorem, dignissim vitae rhoncus ut, molestie eu dui. Cras eleifend aliquam scelerisque. Cras consectetur, enim in aliquam consectetur, enim nulla dapibus dolor, et posuere magna risus a est. In vestibulum, quam eu placerat mollis, orci ligula condimentum augue, a porta odio augue et mi. Donec aliquam lobortis dolor, at consectetur dolor sodales ut. Curabitur tempor pulvinar diam at venenatis. Aliquam ultrices nibh ac nulla molestie, vel accumsan justo vulputate. Nunc bibendum ultricies quam, eu tempus nunc suscipit non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur non magna ultricies, placerat leo ut, lobortis ipsum. Etiam mattis ullamcorper diam, sed convallis purus malesuada vitae. Integer placerat cursus lorem eu varius.', 0, 'test', '2024-11-23', 1);
