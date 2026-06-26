# Pendências — Essencial Pro

Checklist do que **ainda falta fazer** para o site ficar pronto para vender com pagamento via [Easypay](https://www.easypay.pt/).

> O que já está no projeto: carrinho, login/cadastro, checkout, integração base com Easypay (`EasypayService`, webhook, páginas de retorno), campos de pagamento na tabela `orders`, merge do carrinho no registro e verificação de e-mail ativada no model `User`.

---

## 1. Configuração do Easypay (obrigatório)

### 1.1 Criar conta e obter credenciais
- [ ] Criar conta no Easypay (começar pelo **Sandbox** para testes)
- [ ] Obter `AccountId` e `ApiKey` no painel do Easypay
- [ ] Documentação: [Developers — Easypay](https://www.easypay.pt/)

### 1.2 Preencher o `.env`
No notebook, após clonar o repositório, configurar:

```env
APP_URL=https://seu-dominio.pt

EASYPAY_BASE_URL=https://api.easypay.pt/2.0
EASYPAY_ACCOUNT_ID=seu_account_id
EASYPAY_API_KEY=sua_api_key
EASYPAY_METHODS=cc,mb,mbw
```

> Em sandbox, confirmar na documentação se a URL base é a mesma ou se existe endpoint específico de testes.

### 1.3 Registrar o webhook no painel Easypay
- [ ] URL de notificação: `https://seu-dominio.pt/webhook/easypay`
- [ ] O site precisa estar acessível pela internet (não funciona só em `localhost`)
- [ ] Para testes locais, usar ferramenta como **ngrok** ou deploy temporário

### 1.4 Validar payload da API
- [ ] Conferir na documentação oficial do **Checkout** se o payload em `app/Services/EasypayService.php` está correto
- [ ] Confirmar nomes dos campos de resposta (`url`, `id`, etc.)
- [ ] Testar criação de checkout no sandbox com um pedido real

---

## 2. E-mail (obrigatório para cadastro)

A verificação de e-mail já está ativa no `User`, mas o envio ainda depende de configuração.

### 2.1 Configurar SMTP no `.env`
```env
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=587
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seu-dominio.pt
MAIL_FROM_NAME="Essencial Pro"
```

- [ ] Configurar servidor de e-mail (Gmail, SendGrid, Mailgun, etc.)
- [ ] Testar cadastro e recebimento do link de verificação

### 2.2 Exigir e-mail verificado para comprar (recomendado)
Hoje o checkout só exige `auth`, **não** exige e-mail verificado.

- [ ] Adicionar middleware `verified` nas rotas de checkout em `routes/web.php`
- [ ] Testar fluxo: cadastro → verificar e-mail → só então conseguir finalizar compra

---

## 3. Fluxo de pagamento — ajustes pendentes

### 3.1 Retentar pagamento em pedidos falhados/cancelados
Hoje, se o pagamento falhar, o pedido fica guardado mas **não há botão que gere um novo checkout Easypay** para o mesmo pedido.

- [ ] Criar ação "Pagar novamente" na área do cliente (`/minha-conta/pedidos/{order}`)
- [ ] Reutilizar `EasypayService::createCheckout()` para pedidos com `payment_status` = `pending` ou `failed`

### 3.2 Confirmar mapeamento do webhook
O webhook está em `app/Http/Controllers/EasypayWebhookController.php`.

- [ ] Validar com a documentação Easypay os campos reais do POST (`key`, `type`, `status`, etc.)
- [ ] Testar eventos: pagamento aprovado, falhado e cancelado
- [ ] Verificar se `transaction_key` enviado no checkout corresponde ao `order_number` recebido no webhook

### 3.3 E-mail de confirmação de pedido (opcional mas recomendado)
- [ ] Enviar e-mail ao cliente quando `payment_status` mudar para `paid`
- [ ] Pode ser feito no webhook ou via evento/listener Laravel

---

## 4. Painel admin — informações de pagamento

O admin já gere pedidos, mas **não mostra** os novos campos de pagamento.

- [ ] Exibir em `resources/views/admin/orders/show.blade.php`:
  - `payment_status`
  - `payment_method`
  - `payment_id`
  - `paid_at`
- [ ] (Opcional) Filtrar pedidos por status de pagamento em `admin/orders/index`

---

## 5. Funcionalidades do site ainda em placeholder

Estas rotas existem mas mostram página genérica (`pages.placeholder`):

| Rota | Nome | O que falta |
|------|------|-------------|
| `/procurar` | Busca de produtos | Implementar pesquisa por título, código, categoria |
| `/lista-de-desejos` | Lista de desejos | Model, favoritos por usuário, botão no produto |
| `/acompanhar-pedido` | Acompanhar pedido | Consulta por número do pedido + e-mail (guest) ou redirecionar para área logada |
| `/pedir-orcamento` | Pedir orçamento | Página dedicada ou redirecionar para `/contact` |
| `/categoria-placeholder/{slug}` | Categorias no menu | Substituir links do navbar por rotas reais `/categoria/{slug}` |

---

## 6. Outros ajustes recomendados

### 6.1 Frete e descontos
- [ ] `shipping_total` e `discount_total` estão fixos em `0` no checkout
- [ ] Definir regra de cálculo de envio (por CEP, peso, valor mínimo, etc.)

### 6.2 Estoque
- [ ] Não há controle de stock nos produtos
- [ ] Decidir se vai validar quantidade disponível ao adicionar ao carrinho e no checkout

### 6.3 Moeda e mercado
- [ ] Checkout envia `EUR` para o Easypay (adequado para Portugal)
- [ ] Confirmar se todos os preços dos produtos estão em euros

### 6.4 Segurança do webhook (recomendado)
- [ ] Verificar na documentação Easypay se existe assinatura/validação do webhook
- [ ] Implementar validação antes de atualizar o pedido

---

## 7. Testes antes de ir para produção

- [ ] `php artisan migrate` no ambiente de casa/servidor
- [ ] Cadastro + verificação de e-mail
- [ ] Adicionar produto ao carrinho (logado e como convidado → login → merge do carrinho)
- [ ] Checkout completo no sandbox Easypay
- [ ] Webhook recebido e pedido atualizado para `paid`
- [ ] Páginas de retorno: sucesso, falha e cancelamento
- [ ] Admin consegue ver e atualizar o pedido

---

## 8. Arquivos principais da integração (referência rápida)

| Arquivo | Função |
|---------|--------|
| `app/Services/EasypayService.php` | Cria sessão de checkout na API |
| `app/Http/Controllers/CheckoutController.php` | Cria pedido e redireciona para Easypay |
| `app/Http/Controllers/EasypayWebhookController.php` | Recebe confirmação de pagamento |
| `config/easypay.php` | Configuração centralizada |
| `routes/web.php` | Rotas de checkout e webhook |
| `bootstrap/app.php` | Webhook excluído do CSRF |
| `.env.example` | Variáveis de ambiente necessárias |

---

## Ordem sugerida para continuar em casa

1. Clonar o repo e rodar `composer install` + `php artisan migrate`
2. Configurar `.env` (APP_URL, DB, Easypay sandbox, e-mail)
3. Testar checkout no sandbox
4. Ajustar webhook conforme documentação real do Easypay
5. Exigir e-mail verificado no checkout
6. Implementar "pagar novamente" e campos de pagamento no admin
7. Depois: busca, wishlist e demais placeholders
