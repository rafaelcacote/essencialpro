#!/usr/bin/env bash
set -euo pipefail

# Deploy Homolog — branch develop
# Corre no servidor Hostinger (via SSH / GitHub Actions).

APP_DIR="${HOME}/apps/homologacao"
BRANCH="develop"

if [[ ! -d "${APP_DIR}/.git" ]]; then
  echo "ERRO: ${APP_DIR} não existe ou não é um repositório git."
  echo "Faz primeiro o clone (uma vez):"
  echo "  mkdir -p ~/apps && git clone -b develop <URL_DO_REPO> ~/apps/homologacao"
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
composer install --no-dev --optimize-autoloader --no-interaction

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
