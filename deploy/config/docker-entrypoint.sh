#!/bin/bash

set -e

PARAMETER="test-env"
REGION="ap-northeast-2"
WEB_DIR="/var/www"
WEB_USER="www-data"

# Get parameters and put it into .env file inside application root
aws ssm get-parameter --with-decryption --name $PARAMETER --region $REGION --query Parameter.Value | sed -e 's/^"//' -e 's/"$//' -e 's/\\n/\n/g' -e 's/\\//g' > $WEB_DIR/.env

# Clear laravel configuration cache
cd $WEB_DIR
chown $WEB_USER. .env

supervisord -c /supervisord.conf
