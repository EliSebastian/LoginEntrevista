CREATE DATABASE login

CREATE TABLE users(
  userid BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(50) UNSIGNED,
  user VARCHAR(50) UNSIGNED,
  password VARCHAR(20) UNSIGNED
);

INSERT INTO users (email,user,password) VALUES ('prueba@gmail.com','Usuario Prueba','12345');
