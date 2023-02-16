#!/bin/bash

# Instalar gerador de pdfs
sudo apt-get install wkhtmltopdf

# Criar diretório para armazenamento e ajustar permissão
sudo mkdir /opt/pdfs/
sudo chmod 770 /opt/pdfs
sudo chown root:www-data /opt/pdfs

# Instalar redis
sudo apt-get install redis-server php-redis

# Configure redis credentials
echo "requirepass 8a7b86a2cd89d96dfcc125ebcc0535e6" | sudo tee -a /etc/redis/redis.conf
sudo systemctl restart redis
