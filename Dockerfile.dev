

FROM php:7.0-apache

RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

RUN apt-get update -y
RUN apt-get install -y build-essential
RUN apt-get install -y ruby-full
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN ln -s /usr/bin/nodejs /usr/bin/node

RUN gem install compass

COPY . /var/www/html/
WORKDIR /var/www/html/

RUN npm install -g grunt-cli
RUN npm install

RUN grunt
