exec { 'apt-get update':
    command => '/usr/bin/apt-get update',
}

Exec['apt-get update'] -> Package <| |>

package { 'vim':
    ensure => installed,
}

package { 'php5':
    ensure => installed,
}

package { 'php5-xdebug':
    ensure => installed,
}

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

file { '/vagrant':
    ensure => 'directory',
}

file { '/var/www':
    ensure => link,
    target => '/vagrant',
    force => true,
    recurse => true,
    subscribe => File['/vagrant'],
}

file { '/usr/local/bin/phpunit':
    ensure => link,
    target => '/vagrant/lib/phpunit.phar',
    force => true,
}
