DROP DATABASE IF EXISTS teamup_fullstackexception;
CREATE DATABASE  teamup_fullstackexception;
CREATE USER 'admin_fse' @'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON teamup_fullstackexception.* to 'admin_fse'@'localhost';
FLUSH PRIVILEGES; 


