# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "alpine/alpine64"

  config.vm.network "forwarded_port", guest: 80, host: 8082, host_ip: "127.0.0.1"

  config.vm.synced_folder "www", "/usr/share/nginx/html"

  config.vm.provision "shell", inline: <<-SHELL
    apk update
    apk add nginx

    sed -i "s/sendfile.*/sendfile off;/g" /etc/nginx/nginx.conf

    cp /vagrant/nginx.conf /etc/nginx/conf.d/default.conf

    rc-service nginx restart
    rc-update add nginx default
  SHELL
end
