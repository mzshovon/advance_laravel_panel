FROM php:8.0-fpm

RUN apt-get update && apt-get install -y libpq-dev libldap2-dev locales libzip-dev zip cron \
    && pecl install redis && docker-php-ext-enable redis \
    && docker-php-ext-install gettext pdo pdo_mysql pdo_pgsql mysqli bcmath zip

# For Mattweb
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd

RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/bin/ --filename=composer

# RUN apt-get update && apt-get install -y supervisor

# COPY laravel-worker.conf  /etc/supervisor/conf.d

# # Create cron_job_laravel scheduler in cron
# RUN echo "* * * * * /usr/local/bin/php /app/artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/cron.d/cron_job_laravel

# # Give execution rights on the cron job
# RUN chmod 0644 /etc/cron.d/cron_job_laravel

# # Apply cron job
# RUN crontab /etc/cron.d/cron_job_laravel

# # Create the log file to be able to run tail
# RUN touch /var/log/cron.log

# Point the local storage to api
#RUN ln -s /app/storage/company /app/api/company
