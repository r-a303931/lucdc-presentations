FROM php:7.4-apache-buster

ENV DEBIAN_FRONTEND=noninteractive
RUN apt update && apt install -y --force-yes host

COPY index.php /var/www/html
COPY ui.php /var/www/html
