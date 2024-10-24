#!/bin/bash
sudo yum update -y
sudo amazon-linux-extras enable php8.0
sudo yum clean metadata
sudo yum install php php-cli php-common php-mysqlnd php-json php-fpm php-mbstring -y
sudo yum install git -y
sudo yum install httpd -y
sudo systemctl start httpd
sudo systemctl enable httpd
sudo git clone <>

sudo systemctl restart httpd


mysql -h <Your RDS Endpoint> -u <Your Username> -p





curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/local/bin/composer
composer --version
composer require aws/aws-sdk-php
