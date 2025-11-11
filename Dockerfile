# PHP + Apache for the merch store
FROM php:8.2-apache

# Install mysqli extension for MySQL connections
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Enable Apache mods if needed (optional)
RUN a2enmod rewrite

# Set working dir and copy default Apache docroot mapping
WORKDIR /var/www/html

# The app code will be mounted via docker-compose volume for live reload
# Expose port 80 (done by the base image)
