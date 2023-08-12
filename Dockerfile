FROM aguedomeza/centos7:php-apache-openssl
WORKDIR /var/www/html
COPY *.json ./
COPY artisan ./
COPY . .
RUN composer install
RUN composer require symfony/psr-http-message-bridge
RUN composer require nyholm/psr7
RUN composer req firebase/php-jwt:6.4.0
RUN composer require barryvdh/laravel-dompdf
# Agrega el proveedor de servicios en config/app.php
RUN sed -i '/App\\Providers\\RouteServiceProvider::class,/a \
    Barryvdh\\DomPDF\\ServiceProvider::class,' config/app.php

# Publica los archivos de configuración y vistas de Dompdf.
RUN php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
RUN composer require laravel/telescope
RUN cp .env.example .env
RUN php artisan key:generate
RUN chown -R 775 public
RUN chown -R apache.apache public
RUN chown -R $USER:apache public
RUN chmod -R 775 storage
RUN chmod -R ugo+rw storage
RUN chmod -R ugo+rw bootstrap
RUN chmod -R 777 bootstrap
EXPOSE 80
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]