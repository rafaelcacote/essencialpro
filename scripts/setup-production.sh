#!/usr/bin/env bash
set -euo pipefail

# Setup único do ambiente de produção na Hostinger.
# Estrutura (boa prática Laravel em shared hosting):
#
#   ~/domains/essencialprotection.com/
#     apps/homolog/      → homologação (já existe)
#     apps/production/   → produção (branch main)
#     public_html/       → symlink → apps/production/public
#
# Domínio https://essencialprotection.com/ continua a usar public_html,
# mas public_html passa a ser o document root real do Laravel (pasta public/).

DOMAIN_DIR="${HOME}/domains/essencialprotection.com"
APP_DIR="${DOMAIN_DIR}/apps/production"
PUBLIC_HTML="${DOMAIN_DIR}/public_html"
BRANCH="main"
REPO_URL="${REPO_URL:-git@github.com:rafaelcacote/essencialpro.git}"

echo "==> Domínio: ${DOMAIN_DIR}"
echo "==> App produção: ${APP_DIR}"
echo "==> Repo: ${REPO_URL} (${BRANCH})"
echo

if [[ ! -d "${DOMAIN_DIR}" ]]; then
  echo "ERRO: ${DOMAIN_DIR} não existe."
  exit 1
fi

mkdir -p "${DOMAIN_DIR}/apps"

if [[ -d "${APP_DIR}/.git" ]]; then
  echo "==> App já existe em ${APP_DIR} — a atualizar ${BRANCH}"
  cd "${APP_DIR}"
  git fetch origin
  git checkout "${BRANCH}"
  git reset --hard "origin/${BRANCH}"
else
  if [[ -e "${APP_DIR}" ]]; then
    echo "ERRO: ${APP_DIR} existe mas não é um repositório git. Resolve manualmente."
    exit 1
  fi
  echo "==> Clonar repositório (branch ${BRANCH})"
  git clone -b "${BRANCH}" "${REPO_URL}" "${APP_DIR}"
  cd "${APP_DIR}"
fi

echo "==> Composer"
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
php artisan package:discover --ansi || true

if [[ ! -f "${APP_DIR}/.env" ]]; then
  echo "==> Criar .env a partir de .env.example"
  cp .env.example .env
  php artisan key:generate --force
  echo
  echo "IMPORTANTE: edita o .env de produção agora:"
  echo "  nano ${APP_DIR}/.env"
  echo
  echo "Valores mínimos:"
  echo "  APP_ENV=production"
  echo "  APP_DEBUG=false"
  echo "  APP_URL=https://essencialprotection.com"
  echo "  DB_*  → base de dados DE PRODUÇÃO (não uses a do homolog)"
  echo "  EUPAGO_BASE_URL=https://clientes.eupago.pt"
  echo "  MAIL_*, ADMIN_PASSWORD, EUPAGO_*"
  echo
  echo "Depois de gravar o .env, volta a correr este script (ou só a parte do public_html)."
fi

echo "==> Storage link"
php artisan storage:link 2>/dev/null || true

# Ligar public_html → apps/production/public
TARGET_PUBLIC="${APP_DIR}/public"

if [[ -L "${PUBLIC_HTML}" ]]; then
  CURRENT="$(readlink -f "${PUBLIC_HTML}" || true)"
  if [[ "${CURRENT}" == "$(readlink -f "${TARGET_PUBLIC}")" ]]; then
    echo "==> public_html já aponta para apps/production/public"
  else
    echo "==> public_html é symlink para outro sítio (${CURRENT})"
    echo "    A reapontar para ${TARGET_PUBLIC}"
    rm "${PUBLIC_HTML}"
    ln -s "${TARGET_PUBLIC}" "${PUBLIC_HTML}"
  fi
elif [[ -d "${PUBLIC_HTML}" ]]; then
  BACKUP="${DOMAIN_DIR}/public_html.bak-$(date +%Y%m%d-%H%M%S)"
  echo "==> public_html é uma pasta (página padrão Hostinger)."
  echo "    Backup → ${BACKUP}"
  mv "${PUBLIC_HTML}" "${BACKUP}"
  ln -s "${TARGET_PUBLIC}" "${PUBLIC_HTML}"
  echo "==> public_html → ${TARGET_PUBLIC}"
else
  echo "==> Criar symlink public_html → ${TARGET_PUBLIC}"
  ln -s "${TARGET_PUBLIC}" "${PUBLIC_HTML}"
fi

echo
echo "==> Setup produção concluído (estrutura)."
echo
echo "Checklist:"
echo "  [ ] .env com APP_ENV=production, APP_DEBUG=false, DB de produção"
echo "  [ ] php artisan migrate --force   (SÓ na 1ª vez / quando houver schema novo)"
echo "  [ ] Assets: se usares Vite, faz 'npm run build' e envia public/build"
echo "  [ ] Testar https://essencialprotection.com/"
echo
echo "Deploys seguintes:"
echo "  cd ${APP_DIR} && bash scripts/deploy-production.sh"
