CREATE DATABASE IF NOT EXISTS FraudCoinDB;
USE FraudCoinDB;
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(32) NOT NULL,
    user_password VARCHAR(256) NOT NULL,
    user_email VARCHAR(256) NOT NULL,
    user_birthday DATE NOT NULL,
    user_cash INT NOT NULL,
    user_rank INT,
    UNIQUE (user_name, user_email)
);

CREATE TABLE coin (
    coin_id INT PRIMARY KEY AUTO_INCREMENT,
    coin_name VARCHAR(64) NOT NULL,
    coin_value INT NOT NULL,
    coin_creation_date DATE DEFAULT(NOW()),
    coin_num_circulating INT,

    UNIQUE (coin_name)
);

CREATE TABLE coin_history (
    ch_id INT PRIMARY KEY AUTO_INCREMENT,
    percent_change FLOAT(16) NOT NULL,
    change_time DATETIME DEFAULT(NOW()),
    coin_id INT NOT NULL,
    FOREIGN KEY (coin_id) REFERENCES coin (coin_id)
);

CREATE TABLE user_coins (
    purchase_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    coin_id INT NOT NULL,
    purchase_time DATETIME DEFAULT(NOW()),
    purchase_value FLOAT(32) NOT NULL,
    purchase_amount INT NOT NULL,
    FOREIGN KEY (coin_id) REFERENCES coin (coin_id),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE transaction_history (
    transaction_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    coin_id INT NOT NULL,
    transaction_time DATETIME DEFAULT(NOW()),
    transaction_type ENUM('buy', 'sell') NOT NULL,
    transaction_amount INT NOT NULL,
    transaction_value FLOAT(32) NOT NULL,
    transaction_change FLOAT(16),
    FOREIGN KEY (coin_id) REFERENCES coin (coin_id),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);