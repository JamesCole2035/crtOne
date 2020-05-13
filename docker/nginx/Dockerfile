FROM nginx:alpine

COPY ./docker/nginx/example.conf /etc/nginx/conf.d/default.conf
COPY . /var/www/app

ENV NGINX_HOST=docker-class.localhost

WORKDIR /var/www/app
