FROM mariadb:10.9.2-jammy
ENV MARIADB_ROOT_PASSWORD=root
WORKDIR /var/sql/init/
COPY . .
ADD init.sql /docker-entrypoint-initdb.d