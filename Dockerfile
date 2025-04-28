FROM php:8.3-fpm

# Define user name and ID
ARG user=carlos
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    default-mysql-client \
    software-properties-common \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Install redis extension
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy application code and install Composer dependencies
COPY . /var/www
RUN composer install --no-interaction --prefer-dist

# Fix permissions for storage and public
RUN chmod -R 775 /var/www/storage /var/www/public

# Create symbolic link for storage
RUN php artisan storage:link

# Set timezone
RUN ln -sf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime

# Fix permissions for application
RUN chown -R www-data:www-data /var/www

# Switch to the defined user
USER $user
