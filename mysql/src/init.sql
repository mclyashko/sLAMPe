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

CREATE TABLE IF NOT EXISTS weather_report
(
    ID          INT(11)                                                                             NOT NULL AUTO_INCREMENT,
    day         ENUM ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL UNIQUE,
    temperature SMALLINT                                                                            NOT NULL,
    about       ENUM ('good', 'normal', 'bad')                                                      NOT NULL,
    PRIMARY KEY (ID)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = latin1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Monday', 20, 'good') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Monday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Tuesday', 19, 'normal') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Tuesday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Wednesday', 18, 'bad') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Wednesday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Thursday', 17, 'good') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Thursday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Friday', 16, 'normal') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Friday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Saturday', 15, 'bad') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Saturday'
    )
LIMIT 1;

INSERT INTO weather_report (day, temperature, about)
SELECT *
FROM (SELECT 'Sunday', 14, 'good') AS tmp
WHERE NOT EXISTS(
        SELECT day FROM weather_report WHERE day = 'Sunday'
    )
LIMIT 1;