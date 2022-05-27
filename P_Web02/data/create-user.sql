--
-- Création de l'utilisateur
--
DROP USER IF EXISTS 'userBooks'@'localhost';
CREATE USER 'userBooks'@'localhost' IDENTIFIED BY '.Etml-';
GRANT SELECT, INSERT, UPDATE, DELETE ON `db_books`.* TO 'userBooks'@'localhost';