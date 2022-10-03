CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users
(
    ID       INT(11)     NOT NULL AUTO_INCREMENT,
    login    VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (ID)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = latin1;

# login password
INSERT INTO users (login, password)
SELECT *
FROM (SELECT 'login', '{SHA}W6ph5Mm5Pz8GgiULbPgzG37mj9g=') AS tmp
WHERE NOT EXISTS(
        SELECT login FROM users WHERE login = 'login' AND password = '{SHA}W6ph5Mm5Pz8GgiULbPgzG37mj9g='
    )
LIMIT 1;

# admin admin
INSERT INTO users (login, password)
SELECT *
FROM (SELECT 'admin', '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc=') AS tmp
WHERE NOT EXISTS(
        SELECT login FROM users WHERE login = 'admin' AND password = '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc='
    )
LIMIT 1;

# user 1234567890
INSERT INTO users (login, password)
SELECT *
FROM (SELECT 'user', '{SHA}AbMHrLpPVPVar8M7sGu79sqAPpo=') AS tmp
WHERE NOT EXISTS(
        SELECT login FROM users WHERE login = 'admin' AND password = '{SHA}AbMHrLpPVPVar8M7sGu79sqAPpo='
    )
LIMIT 1;