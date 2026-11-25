#!/usr/bin/env bash
# Update the live site from GitHub and apply database/cache changes.
# Usage on the server:  bash ~/public_html/deploy.sh
set -euo pipefail
cd "$(dirname "$0")"

echo "==> Pulling latest code from GitHub (main)"
git pull --ff-only origin main

echo "==> Pending migrations (if any):"
php artisan migrate:status | grep -i pending || echo "   none"

echo "==> Applying migrations"
php artisan migrate --force

echo "==> Refreshing caches"
php artisan optimize:clear
php artisan config:cache

echo "==> DEPLOY DONE: $(git log --oneline -1)"
