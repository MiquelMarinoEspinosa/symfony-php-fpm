FROM nginx:latest

ADD conf/nginx.conf /etc/nginx
ADD conf/sites-enabled/localhost.conf /etc/nginx/sites-enabled/localhost.conf
RUN mkdir -p /var/www

WORKDIR /var/www/

EXPOSE 80