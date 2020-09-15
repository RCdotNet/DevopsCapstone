FROM mysql:5.7

# Working Directory
WORKDIR /app

# hadolint ignore=DL3013

#Copy mysql initialization

COPY Cameleon.sql /docker-entrypoint-initdb.d
EXPOSE 3306

