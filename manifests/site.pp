exec { "apt-get update":
    command => "/usr/bin/apt-get update",
}

package { "php5":
    require => Exec["apt-get update"],
}

package { "php5-xdebug":
    require => Package["php5"]
}

file { "/vagrant":
    ensure => "directory",
}

file { "/var/www":
    ensure => link,
    target => "/vagrant",
    force => true,
    recurse => true,
    subscribe => File["/vagrant"],
}

file { "/usr/local/bin/phpunit":
    ensure => link,
    target => "/vagrant/lib/phpunit.phar",
    force => true,
}
