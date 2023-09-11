# Use the official PHP image from the dockerhub
FROM php:7.4-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y git zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /app

