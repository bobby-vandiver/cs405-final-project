cs405-final-project
===================

Local deployment
----------------

For local development, we will be using Vagrant.
Vagrant works in conjunction with VirtualBox to
allow you to deploy and configure a virtual machine (VM).

Multilab deployment
-------------------

To deploy this app to the multilab, two files need
to be modified.

1. mysql-bootstrap.sh

   Change test to your database name.

   This only applies if you want to use this
   script to create and populate the tables.

   If you want to do that by hand, you don't
   need to worry about this.

2. app/database.ini

   Update the information here to match your database.


Setting up Vagrant
------------------

1. Install VirtualBox 4.2.0
   https://www.virtualbox.org/

2. Install Vagrant version 1.3.5
   http://www.vagrantup.com/

Using Vagrant
-------------

Run the command `vagrant up` in the root directory of
this project (where the the Vagrantfile exists). The
first time you do this, a Vagrant .box file will be
downloaded from the internet. This .box file is a
VirtualBox Ubuntu 12.04 LTS VM image that has been
configured to work with Vagrant.

Once the .box has downloaded, Vagrant will begin
configuring the VM so that it has the latest version
of PHP 5.x installed. Additionally, it will link
Apache's www directory to the local directory.

This means you can edit files in the project on your
host machine with the tools you are comfortable with
and the changes will be automatically reflected in
the files that Apache serves.

The VM is configured on a private network to be
accessible by the host machine only.

To verify that the VM was deployed and local project
files are being synched correctly, visit the following
url in a browser:

http://192.168.33.10/test-page.php

If everything is up you should see a simple page with
the message "vagrant up yours" displayed on it.

Errors
------
If you receive an error like the following:

```
[default] The guest additions on this VM do not match the installed version of
VirtualBox! In most cases this is fine, but in rare cases it can
cause things such as shared folders to not work properly. If you see
shared folder errors, please update the guest additions within the
virtual machine and reload your VM.

Guest Additions Version: 4.2.0
VirtualBox Version: 4.1
```

Execute the following command `vagrant plugin install vagrant-vbguest`
This will synch the version of Guest Additions on the VM to match
the version of VirtualBox installed on your host machine.

Connecting to the Database
--------------------------

The database provided by the Vagrant box can be accessed via
localhost (127.0.0.1) on port 33066. The user name is 'root'
and the password is 'mysql'. The default database that is
created is named 'test'.

Debuggging Tips
---------------

If you're PHP script is not executing and you have no idea
why, ssh into the Vagrant box by executing `vagrant ssh`.

Once inside view the error log for Apache at:
`/var/log/apache2/error.log`
