#!/bin/sh

mysqladmin -u root password 'mysql'
mysql --user=root --password=mysql --host=localhost --port=3306 < /vagrant/grant-remote-access.sql
