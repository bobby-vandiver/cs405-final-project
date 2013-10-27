exec { "apt-get update":
    command => "/usr/bin/apt-get update",
}

package { "php5":
    require => Exec["apt-get update"],
}

file { "/var/www":
    ensure => link,
    target => "/vagrant",
    force => true,
    recurse => true,
}

file { "/usr/local/bin/phpunit":
    ensure => link,
    target => "/vagrant/lib/phpunit.phar",
    force => true,
}
