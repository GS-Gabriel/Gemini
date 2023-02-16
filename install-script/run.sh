#!/bin/bash

# Instalar utilitarios básicos
apt-get install net-tools sudo bash-completion unzip git

# Instalar editor de texto
apt install vim -y

# Instalar LAMP
sudo apt install mariadb-server php libapache2-mod-php php-zip php-mbstring php-cli php-common php-curl php-xml php-mysql

# Configurar MYSQL
sudo mysql_secure_installation

# Instalar Apache2
sudo apt install apache2

# Update index
echo "<IfModule mod_dir.c>
	DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>
# vim: syntax=apache ts=4 sw=4 sts=4 sr noet" | sudo tee /etc/apache2/mods-enabled/dir.conf
sudo systemctl restart apache2
