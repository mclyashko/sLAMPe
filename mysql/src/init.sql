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

INSERT INTO users (login, password)
SELECT *
FROM (SELECT 'login', 'password') AS tmp
WHERE NOT EXISTS(
        SELECT login FROM users WHERE login = 'login' AND password = 'password'
    )
LIMIT 1;