set -e

echo "Deploying application ..."
# Install dependencies based on lock file
composer install --no-interaction --prefer-dist --optimize-autoloader

# Enter maintenance mode
(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git fetch origin master
    git reset --hard origin/master

    # Migrate database
    #php artisan migrate --force

    # Note: If you're using queue workers, this is the place to restart them.
    # ...

    # Clear cache
    php artisan cache:clear
    php artisan route:cache
    php artisan optimize

    # Reload PHP to update opcache
    echo "" | sudo -S service php7.4-fpm reload

    sudo chown -R $USER:www-data storage
    sudo chown -R $USER:www-data bootstrap/cache

    sudo chmod -R 775 storage
    sudo chmod -R 775 bootstrap/cache

# Exit maintenance mode
php artisan up

echo "Application deployed!"
