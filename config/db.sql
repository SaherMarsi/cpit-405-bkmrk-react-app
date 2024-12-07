CREATE DATABASE bkmrk_db;
USE bkmrk_db;
CREATE TABLE bookmarks(
    id MEDIUMINT NOT NULL AUTO_INCREMENT,
    urls VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    date_added DATETIME NOT NULL,
    PRIMARY KEY(id)
);
INSERT INTO bookmarks(urls,title,date_added) VALUES ('https://github.com/','GitHub',NOW());