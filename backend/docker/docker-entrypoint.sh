#!/bin/sh

# Generate application key (--force is needed in production to bypass the confirmation)
php artisan key:generate --force

# Execute the specified command in the Dockerfile (CMD ["command"])
exec "$@"