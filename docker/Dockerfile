# Use webdevops/php-nginx as the base image
FROM webdevops/php-nginx:8.2

# Web Document Root
ENV WEB_DOCUMENT_ROOT=/app/public

# Disabled PHP Extensions
ENV PHP_DISMOD=calendar,exiif,ffi,ldap,mysqli,imap,sockets,sysvmsg,sysvsm,sysvshm,shmop,zip,gd,apcu,vips,imagick,amqp

# Workdir
WORKDIR /app/

# Install dependencies with apt-get and Composer
RUN apt-get update && apt-get install -y --no-install-recommends

# Copy all files to the container
COPY . /app/.

# Create nginx log and cache directories
RUN mkdir -p /var/log/nginx && mkdir -p /var/cache/nginx

# Install dependencies by running Composer
RUN composer install --optimize-autoloader --ignore-platform-reqs

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get update && apt-get install -y nodejs

# Install Yarn
RUN npm install -g yarn

# Run Yarn install and production build
RUN yarn install
RUN yarn build

# Copy Laravel Horizon configuration to the appropriate location
# COPY /docker/horizon.conf /opt/docker/etc/supervisor.d/horizon.conf

# Copy Laravel Schedule configuration to the appropriate location
# COPY /docker/schedule.conf /opt/docker/etc/supervisor.d/schedule.conf

# Change ownership to 'application' user
RUN chown -R application:application .

# Specify the required port
EXPOSE 80

# Start Supervisor when the container runs
CMD ["supervisord", "--nodaemon", "--configuration", "/etc/supervisor/supervisord.conf"]