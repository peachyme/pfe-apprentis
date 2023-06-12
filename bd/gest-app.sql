CREATE DATABASE IF NOT EXISTS ges_app;
use ges_app;

CREATE TABLE utilisateurs (
	id int(4) AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(100) NOT NULL,
	pwd VARCHAR(255) NOT NULL,
	role VARCHAR(50),
	email VARCHAR(255),
	etat INT(1)); 
    
INSERT INTO utilisateurs VALUES 
	(1,'admin',md5('0000'),'ADMIN','hadjer.messaoudene18@gmail.com',1),
	(2,'user1',md5('1234'),'VISITEUR','hadjer.messaoudene19@gmail.com',0);
    
    
    
    
	INSERT INTO utilisateurs VALUES (3,'user2',md5('5555'),'VISITEUR','fenexo249@gmail.com',1);	