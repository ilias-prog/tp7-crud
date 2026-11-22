CREATE DATABASE IF NOT EXISTS tp7_crud
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tp7_crud;

CREATE TABLE IF NOT EXISTS formations (
    id_formation INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(120) NOT NULL,
    description TEXT NOT NULL,
    duree_heures SMALLINT UNSIGNED NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(80) NOT NULL,
    prenom VARCHAR(80) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    date_inscription DATE NOT NULL,
    formation_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_etudiants_formation
        FOREIGN KEY (formation_id) REFERENCES formations (id_formation)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS modules (
    id_module INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(120) NOT NULL,
    description TEXT NOT NULL,
    volume_horaire SMALLINT UNSIGNED NOT NULL,
    formation_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_modules_formation
        FOREIGN KEY (formation_id) REFERENCES formations (id_formation)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT IGNORE INTO formations (id_formation, nom, description, duree_heures) VALUES
    (1, 'Développement Web', 'Créer des sites et applications Web.', 420),
    (2, 'Administration réseau', 'Installer et administrer des réseaux informatiques.', 360);

INSERT IGNORE INTO etudiants
    (id_etudiant, nom, prenom, email, date_inscription, formation_id) VALUES
    (1, 'Martin', 'Lina', 'lina.martin@example.test', '2026-09-01', 1),
    (2, 'Diallo', 'Sami', 'sami.diallo@example.test', '2026-09-03', 2);

INSERT IGNORE INTO modules
    (id_module, nom, description, volume_horaire, formation_id) VALUES
    (1, 'Bases de données', 'Modélisation relationnelle et SQL.', 48, 1),
    (2, 'Réseaux locaux', 'Adressage IP et configuration de réseau local.', 54, 2);
