FROM ubuntu:18.04

# Working Directory
WORKDIR /app
ENV DEBIAN_FRONTEND=noninteractive
# hadolint ignore=DL3013
RUN apt update 
RUN apt upgrade -y
RUN apt install apache2 -y
RUN apt install php libapache2-mod-php -y
RUN apt install php-mysql -y
RUN apt install nano -y
RUN apt install unzip -y
# RUN service apache2 restart

COPY app/Cameleon2.zip /app/

#Copy mysql initialization


RUN unzip /app/Cameleon2 -do /var/www/html

#ENTRYPOINT [ "start apache2" "-D" "FOREGROUND" ]

# Expose port 80
EXPOSE 80

# start the mysqlservice
CMD ["apachectl", "-D", "FOREGROUND"]