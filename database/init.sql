CREATE DATABASE IF NOT EXISTS sqli_demo;

USE sqli_demo;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50)
);

INSERT INTO users (first_name, last_name) VALUES
('admin', 'admin'),
('Gordon', 'Brown'),
('Hack', 'Me'),
('Pablo', 'Picasso'),
('Bob', 'Smith');