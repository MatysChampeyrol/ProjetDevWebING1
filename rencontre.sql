DROP DATABASE IF EXISTS rencontre;
CREATE DATABASE rencontre;
USE rencontre;


CREATE TABLE Usager (
    login VARCHAR(100) PRIMARY KEY NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    sexe ENUM('homme', 'femme', 'autre') DEFAULT 'autre' NOT NULL,
    date_inscription DATE DEFAULT '1000-01-01' NOT NULL,
    date_fin_abonnement DATE,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    age INT,
    ddn DATE,
    ville VARCHAR(100),
    profession VARCHAR(100),
    situation ENUM('celibataire', 'divorce', 'veuf'),
    description TEXT,
    informations TEXT,
    profil ENUM('utilisateur', 'abonne', 'admin') DEFAULT 'utilisateur' NOT NULL,
    photo_profil VARCHAR(255),
    adresse_complete TEXT,
    image1 VARCHAR(255),
    image2 VARCHAR(255),
    image3 VARCHAR(255)
);






    -- CREATE TABLE Discussion (
    --     id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    --     id_expediteur VARCHAR(100) NOT NULL,
    --     id_receveur VARCHAR(100),
    --     horaire DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    --     contenu VARCHAR(100),
    --     FOREIGN KEY (id_expediteur) REFERENCES Usager(login),
    --     FOREIGN KEY (id_receveur) REFERENCES Usager(login)
    -- );

    CREATE TABLE Messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expediteur VARCHAR(100) NOT NULL,
    destinataire VARCHAR(100) NOT NULL,
    contenu TEXT NOT NULL,
    horaire DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE Signalements (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	id_signaleur VARCHAR(100) NOT NULL,
	id_signalee VARCHAR(100),
	motif VARCHAR(255),
	FOREIGN KEY (id_signaleur) REFERENCES Usager(login),
	FOREIGN KEY (id_signalee) REFERENCES Usager(login)
);


/*


CREATE TABLE Conversation (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    date_dernier_message DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    login1 VARCHAR(100) NOT NULL,
    login2 VARCHAR(100) NOT NULL,
    FOREIGN KEY (login1) REFERENCES Usager(login),
    FOREIGN KEY (login2) REFERENCES Usager(login)
);

CREATE TABLE Message (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    contenu TEXT NOT NULL,
    expediteur VARCHAR(100) NOT NULL,
    receveur VARCHAR(100) NOT NULL,
    conversation INT NOT NULL,
    FOREIGN KEY (expediteur) REFERENCES Usager(login),
    FOREIGN KEY (receveur) REFERENCES Usager(login),
    FOREIGN KEY (conversation) REFERENCES Conversation(id)
);
*/

INSERT INTO Usager (login, mdp, profil,photo_profil) VALUES ('admin', 'oui', 'admin','Image/defaut.png');
INSERT INTO Usager (login, mdp, sexe, date_inscription, profil, photo_profil) VALUES ('Matt', 'non', 'homme', CURDATE(), 'abonne','Image/defaut.png');
INSERT INTO Usager (login, mdp, sexe, date_inscription, date_fin_abonnement, profil,photo_profil) VALUES ('Jules', 'jsp', 'homme', CURDATE(), '2024-12-31', 'abonne','Image/defaut.png');
INSERT INTO Usager (login, mdp, sexe, date_inscription, date_fin_abonnement, profil,photo_profil) VALUES ('Mehdi', 'bg', 'homme', CURDATE(), '2024-12-31', 'abonne','Image/defaut.png');


-- INSERT INTO Discussion (id_expediteur,id_receveur,contenu) VALUES ('Matt', 'Jules', 'salut bg');
-- INSERT INTO Discussion (id_expediteur,id_receveur,contenu) VALUES ('Jules', 'Matt', 'ça va?');
-- INSERT INTO Discussion (id_expediteur,id_receveur,contenu) VALUES ('Jules', 'Matt', 'on sort cet aprem?');
-- INSERT INTO Discussion (id_expediteur,id_receveur,contenu) VALUES ('Matt', 'Mehdi', 'salut beau brun');

INSERT INTO Signalements (id_signaleur,id_signalee,motif) VALUES ('Matt', 'Mehdi', 'comportement inaproprié');
