
#!/usr/bin/env bash

set -eux

cd /var/www/app

# Cache/compile Laravel structs
/usr/local/bin/php artisan config:cache
/usr/local/bin/php artisan event:cache
# Re-enable once route files are all fixed up
#/usr/local/bin/php artisan route:cache
/usr/local/bin/php artisan view:cache
/bin/chown -R unit:unit bootstrap/cache storage/framework/views