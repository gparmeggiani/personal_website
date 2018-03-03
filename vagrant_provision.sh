#!/bin/bash

# Update the server
apt-get update
apt-get -y upgrade

# --- Apache ---
apt-get -y install apache2
a2enmod rewrite

# --- PHP ---
apt-get -y install php libapache2-mod-php

# Restart Services
service apache2 restart