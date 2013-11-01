#!/bin/sh

mysqladmin -u root password 'mysql'
mysql --user=root --password=mysql --host=localhost --port=3306 < /vagrant/grant-remote-access.sql

#sudo cp /vagrant/my.cnf /etc/mysql/

#sudo /etc/init.d/mysql restart
