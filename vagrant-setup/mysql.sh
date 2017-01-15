# Edit the following to change the name of the database user that will be created:
APP_DB_USER=vagrant
APP_DB_PASS=vagrant

# Edit the following to change the name of the database that is created (defaults to the user name)
APP_DB_NAME=blog

# Installing locale packages
sudo apt-get install -y language-pack-ru
sudo apt-get install -y language-pack-en

#####################################
## Next better to be done manually ##
#####################################

 # sudo apt-get update
 # sudo apt-get install -y mysql-server

 # sudo service mysql restart

 # sudo su
 # mysql -e "CREATE USER $APP_DB_USER IDENTIFIED BY '$APP_DB_PASS'" -p$APP_DB_PASS

 # mysql -e "CREATE DATABASE $APP_DB_NAME CHARACTER SET utf8 COLLATE utf8_general_ci" -p$APP_DB_PASS
 # mysql -e "GRANT ALL PRIVILEGES ON $APP_DB_NAME.* to $APP_DB_USER" -p$APP_DB_PASS

 # mysql -h 127.0.0.1 -u vagrant -pvagrant

 #echo "Successfully installed MySQL"
