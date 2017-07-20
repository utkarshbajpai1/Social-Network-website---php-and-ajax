<?php 
	include_once("php_includes/db_conx.php");

	$tbl_users = " CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	gender ENUM('m','f') NOT NULL,
	website VARCHAR(255) NULL,
	country VARCHAR(255) NULL,
	userlevel ENUM('a','b','c','d') NOT NULL DEFAULT 'a',
	avatar VARCHAR(255) NULL,
	ip VARCHAR(255) NOT NULL,
	signup DATETIME NOT NULL,
	lastlogin DATETIME NOT NULL,
	notescheck DATETIME NOT NULL,
	activated ENUM('0','1') NOT NULL DEFAULT '0',
	PRIMARY KEY (id),
	UNIQUE KEY username (username,email)
	
	)";
?>