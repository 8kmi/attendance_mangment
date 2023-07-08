CREATE DATABASE presence_manag;

USE presence_manag;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `teacher`(
    `id` int(11) NOT NULL,
    `matricule` VARCHAR(16) NOT NULL,
    `nom` varchar(32) NOT NULL,
    `prenoms` varchar(54) NOT NULL,
    `email` varchar(60) NOT NULL,
    `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `nce` varchar(20) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenoms` varchar(54) NOT NULL,
  `date2naissance` date DEFAULT NULL,
  `lieu2naissance` varchar(32) DEFAULT NULL,
  `modifie_le` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ajoute_le` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `ue` (
    `id` int(11) NOT NULL,
    `libelle` varchar(50) NOT NULL,
    `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `absence`(
    `id` int(11) NOT NULL,
    `isPresent` tinyint(1) NOT NULL,
    `seance_id` int(11) NOT NULL,
    `student_id` int(11) NOT NULL,
    `ajoute_le` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `seance` (
  `id` int(11) NOT NULL ,
  `seance_date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `ue_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `type_seance` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nce` (`nce`);

ALTER TABLE `ue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher_id`);

ALTER TABLE `seance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ue` (`ue_id`),
  ADD KEY `teacher` (`teacher_id`);

ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seance` (`seance_id`),
  ADD KEY `student` (`student_id`);


ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `seance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seance_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)  ON DELETE CASCADE ON UPDATE CASCADE;

-- ALTER TABLE `absence`
--   ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)  ON DELETE CASCADE ON UPDATE CASCADE;


INSERT INTO `teacher`(`matricule`,`nom`,`prenoms`,`email`,`mdp`) VALUES
    ('45B','ZEZE','Sylvain','sylvain@gmail.com','451451'),
    ('55C','KONE', 'Oumar','oumar@gmail.com','22222'),
    ('65D','TCHIMOU','Tchimou','tchimou@gmail.com','33333'),
    ('75E','SORO','Soro','soro@gmail.com','abcdef'),
    ('85F','KRAMOH','Kramoh','tchimou@gmail.com','55555'),
    ('95G','TRAORE','Traore','traore@gmail.com','123123');

INSERT INTO `ue`(`libelle`,`teacher_id`) VALUES
  ('Programmation Web',1),
  ('Programmation Orienté Objet',2),
  ('Merise',3),
  ('CPU',3),
  ('Intelligence Artificielle',4),
  ('Theorie des graphes',2),
  ('Reseaux Informatiques',6),
  ('Traitement du Signal',5);


INSERT INTO `student`(`nce`,`nom`,`prenoms`,`date2naissance`,`lieu2naissance`) VALUES
  ('CIO22145670','Ouattara','Khader', '1999-07-13','Bouaké'),
  ('CIO22342621','Yao','Emmanuel','2001-07-13','Abidjan'),
  ('CIO22335352','Kouassi','Ebenezer','1998-04-21','Bondoukou'),
  ('CIO22933371','Yeo','Nanoung','2002-10-11','Bouaké'),
  ('CIO22531863','Bamba','Youssouf','2002-03-01','Abidjan'),
  ('CIO22779210','Sacko','Alassane','2001-07-13','Kokoumbo'),
  ('CIO22343186','Adopo','Freddy','2001-12-03','Abidjan');

COMMIT;