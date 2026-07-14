# Checkout EuPago

O checkout aceita Multibanco, MB WAY e cartão, sempre em EUR.

## Configuração

No `.env`, configure as credenciais do ambiente escolhido:

```dotenv
APP_URL=https://loja.exemplo.pt
EUPAGO_BASE_URL=https://sandbox.eupago.pt
EUPAGO_API_KEY=sua-chave-de-sandbox
EUPAGO_WEBHOOK_SECRET=chave-secreta-do-webhook
```

Em produção, substitua `sandbox` por `clientes` na URL e use a chave do canal de produção.

Execute a migration:

```bash
php artisan migrate
```

## Webhook

No Backoffice EuPago, configure o Realtime Webhook 2.0:

- Endpoint: `https://loja.exemplo.pt/webhook/eupago`
- Método: `POST`
- Encriptação: desativada
- Eventos: pelo menos `PAID`, `ERROR`, `CANCELED` e `EXPIRED`

Defina em `EUPAGO_WEBHOOK_SECRET` a mesma chave usada para assinar o webhook. A aplicação rejeita notificações sem uma assinatura `X-Signature` HMAC SHA-256 válida.

O retorno visual do cartão, MB WAY ou Multibanco não confirma um pedido. Apenas a notificação assinada da EuPago marca o pagamento como pago.
