DROP USER '----'@'localhost';
CREATE USER '----'@'localhost' IDENTIFIED by '****';

GRANT SELECT, INSERT, UPDATE, DELETE ON gcbc_tools.* TO '----'@'localhost';
