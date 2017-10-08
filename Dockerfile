FROM php:7.0-apache

RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

RUN apt-get update -y && \
    apt-get install -y build-essential \
                       git \
                       ruby-full \
                       nodejs \
                       npm

RUN ln -s /usr/bin/nodejs /usr/bin/node

RUN gem install compass
RUN npm install -g grunt-cli bower

RUN mkdir /dist
WORKDIR /dist

COPY package.json /dist
RUN npm install node-sass request@2.81.0

RUN npm install

RUN echo '{ "allow_root": true }' > /root/.bowerrc
COPY bower.json /dist
RUN bower install

COPY . /dist
RUN grunt build

WORKDIR /var/www/html/
