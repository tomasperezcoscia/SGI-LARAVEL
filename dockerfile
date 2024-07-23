# Utilizar una imagen base que contenga PHP y MySQL
FROM php:7.4-apache

# Instalar dependencias de sistema
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . .

# Instalar dependencias de PHP y Node.js
RUN composer install && npm install && npm run build

# Optimizar Laravel
RUN php artisan optimize && php artisan config:cache && php artisan route:cache && php artisan view:cache

# Ejecutar migraciones
RUN php artisan migrate --force

# Exponer el puerto 80
EXPOSE 80

CMD ["apache2-foreground"]
