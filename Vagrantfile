# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/xenial32"

  # Forward ports
  config.vm.network "forwarded_port", guest: 80, host: 8082

  # Share the www folder
  config.vm.synced_folder "./www", "/var/www/html"

  # Run provisioning script
  config.vm.provision "shell", path: "./vagrant_provision.sh"
end
