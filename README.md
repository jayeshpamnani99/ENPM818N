#!/bin/bash
sudo yum update -y
sudo amazon-linux-extras enable php8.0
sudo yum clean metadata
sudo yum install php php-cli php-common php-mysqlnd php-json php-fpm php-mbstring -y
sudo yum install git -y
sudo yum install httpd -y
sudo yum install jq
sudo systemctl start httpd
sudo systemctl enable httpd
sudo yum install mysql -y
cd /var/www/html
sudo git clone https://github.com/jayeshpamnani99/ENPM818N.git
sudo mv ENPM818N/* .
sudo rm CLIAccess.pem
sudo rm networking.yaml
sudo rm README.md
sudo rm SSHAccess.pem
sudo rm waf.yaml
sudo rm ec2.yaml
sudo rm rds.yaml
sudo rm security-groups.yaml
sudo rm -rf ENPM818N
sudo mv ecommerceAPP/* .
sudo rm -rf ecommerceAPP
AWS_REGION="us-east-1"
SECRET=$(aws secretsmanager get-secret-value --secret-id "ecommerce/rds/credentials2" --query SecretString --output text --region $AWS_REGION)
RDS_HOST=$(echo $SECRET | jq -r .RDS_HOST)
RDS_USER=$(echo $SECRET | jq -r .RDS_USER)
RDS_PASSWORD=$(echo $SECRET | jq -r .RDS_PASSWORD)
RDS_DBNAME=$(echo $SECRET | jq -r .RDS_DBNAME)
sudo sed -i "s/\$servername =.*/\$servername = '${RDS_HOST}';/" /var/www/html/includes/connect.php
sudo sed -i "s/\$username =.*/\$username = '${RDS_USER}';/" /var/www/html/includes/connect.php
sudo sed -i "s/\$password =.*/\$password = '${RDS_PASSWORD}';/" /var/www/html/includes/connect.php
sudo sed -i "s/\$dbname =.*/\$dbname = '${RDS_DBNAME}';/" /var/www/html/includes/connect.php
sudo systemctl restart httpd














mysql -h <Your RDS Endpoint> -u <Your Username> -p
mysql -h ecommerce-db-instance.czg8cso4sgh8.us-east-1.rds.amazonaws.com --ssl-ca=us-east-1-bundle.pem --ssl-mode=REQUIRED -P 3306 -u admin -p


