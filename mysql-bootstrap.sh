#!/bin/sh

mysql --user=root --password=mysql --host=localhost --port=3306 < /vagrant/sql-queries/create-tables.sql

#TODO: Reneable once script has been written
#mysql --user=root --password=mysql --host=localhost --port=3306 < /vagrant/sql-queries/populate-tables.sql
