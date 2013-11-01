exec { 'apt-get update':
    command => '/usr/bin/apt-get update',
}

Exec['apt-get update'] -> Package <| |>

package { 'vim':
    ensure => installed,
}

########################
# Apache configuration #
########################

package { 'apache2':
    ensure => installed,
}

service { 'apache2':
    ensure => running,
    enable => true,
    require => Package['apache2'],
}

########################
# PHP configuration    #
########################

package { 'php5':
    ensure => installed,
    require => Package['apache2'],
}

package { 'libapache2-mod-php5':
    ensure => installed,
    notify => Service['apache2'],
    require => [
        Package['apache2'],
        Package['php5'],
    ],
}

package { 'php5-xdebug':
    ensure => installed,
}

##########################
# Database configuration #
##########################

package { 'mysql-server':
    ensure => installed,
}

service { 'mysql':
    ensure => 'running',
    enable => true,
    require => Package['mysql-server'],
}

file { '/vagrant/mysql-config.sh':
    ensure => present,
}

exec { '/vagrant/mysql-config.sh':
    require => [
            File['/vagrant/mysql-config.sh'],
            Package['mysql-server'],
        ],
}

file { '/etc/mysql/my.cnf':
    notify => Service['mysql'],
    mode => 644,
    owner => 'root',
    group => 'root',
    require => Exec['/vagrant/mysql-config.sh'],
    source => 'file:///vagrant/my.cnf',
}

#########################
# Interop dependencies  #
#########################

package { 'libapache2-mod-auth-mysql':
    ensure => installed,
    require => [
        Package['apache2'],
        Package['mysql-server'],
    ],
}

package { 'php5-mysql':
    ensure => installed,
    require => [
        Package['php5'],
        Package['mysql-server'],
    ],
}

