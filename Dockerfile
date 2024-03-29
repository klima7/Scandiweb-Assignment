FROM php:7.4.33-apache as base
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
WORKDIR /var/www/html/
COPY . /var/www/html
RUN composer dump-autoload -o 
RUN echo "LogLevel alert rewrite:trace6" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo pdo_mysql
