FROM php:8.3-fpm

# Define user name and ID
ARG user=carlos
ARG uid=1000

# Instala dependências do sistema
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

# Instala extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria usuário do sistema
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Instala extensão Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Define pasta de trabalho
WORKDIR /var/www

# Copia projeto
COPY . /var/www

# Copia script de entrada
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Instala dependências do Laravel
RUN composer install --no-interaction --prefer-dist

# Corrige permissões
RUN chmod -R 775 /var/www/storage /var/www/public \
    && chown -R www-data:www-data /var/www

# Define timezone
RUN ln -sf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime

# Define entrada padrão
ENTRYPOINT ["/entrypoint.sh"]

# Troca para o usuário criado
USER $user
