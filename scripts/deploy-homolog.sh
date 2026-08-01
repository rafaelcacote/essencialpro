#!/usr/bin/env bash
set -euo pipefail

# Deploy Homolog — branch develop
# Corre no servidor Hostinger (via SSH / GitHub Actions).

APP_DIR="${HOME}/domains/essencialprotection.com/apps/homolog"
BRANCH="develop"

if [[ ! -d "${APP_DIR}/.git" ]]; then
  echo "ERRO: ${APP_DIR} não existe ou não é um repositório git."
  echo "Faz primeiro o clone (uma vez):"
  echo "  git clone -b develop <URL_DO_REPO> ~/domains/essencialprotection.com/apps/homolog"
  exit 1
fi

cd "${APP_DIR}"

echo "==> Manutenção ON"
php artisan down --retry=60 || true

echo "==> Atualizar código (${BRANCH})"
git fetch origin
git checkout "${BRANCH}"
git reset --hard "origin/${BRANCH}"

echo "==> Composer"
# --no-scripts: no Hostinger o Composer falha em scripts porque usa proc_open.
# Corremos package:discover via php artisan em seguida.
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
php artisan package:discover --ansi

echo "==> Migrations"
php artisan migrate --force

echo "==> Storage link"
php artisan storage:link 2>/dev/null || true

echo "==> Caches"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Manutenção OFF"
php artisan up

echo "==> Deploy homolog concluído."
