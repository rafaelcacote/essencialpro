#!/usr/bin/env bash
set -euo pipefail

# Deploy Produção — branch main
# Corre no servidor Hostinger via SSH (manual).
# NÃO corre migrations (protege dados). Corre migrate à mão quando precisares.

APP_DIR="${HOME}/domains/essencialprotection.com/apps/production"
BRANCH="main"

if [[ ! -d "${APP_DIR}/.git" ]]; then
  echo "ERRO: ${APP_DIR} não existe ou não é um repositório git."
  echo "Corre primeiro o setup: bash scripts/setup-production.sh"
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
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
php artisan package:discover --ansi

# Migrations NÃO correm no deploy. Quando precisares de schema novo:
#   cd ~/domains/essencialprotection.com/apps/production
#   php artisan migrate --force

echo "==> Storage link"
php artisan storage:link 2>/dev/null || true

echo "==> Caches"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Manutenção OFF"
php artisan up

echo "==> Deploy produção concluído."
echo "    Site: https://essencialprotection.com/"
echo "    Se houve migration nova, corre manualmente: php artisan migrate --force"
