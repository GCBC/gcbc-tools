-- Create database

DROP DATABASE IF EXISTS gcbc_tools;
CREATE DATABASE gcbc_tools;
USE gcbc_tools;

-- Define structure

CREATE TABLE BillItem (
    BillItemID INTEGER PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Description VARCHAR(200),
    Cost DECIMAL(6,2), -- -9999.99 to 9999.99
    Date DATE
);

CREATE TABLE Team (
    Deleted BOOLEAN DEFAULT FALSE,
    TeamID INTEGER PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(30)
);

CREATE TABLE Participant (
    Deleted BOOLEAN DEFAULT FALSE,
    ParticipantID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TeamID INTEGER,
    Name VARCHAR(30)
);

CREATE TABLE Leg (
    Deleted BOOLEAN DEFAULT FALSE,
    LegID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ParticipantID INTEGER,
    Start INTEGER, -- s
    Finish INTEGER, -- s
    Duration INTEGER, -- s
    Distance INTEGER -- m
);

-- CodeIgniter sessions table
-- http://codeigniter.com/user_guide/libraries/sessions.html

CREATE TABLE `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(16) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);
