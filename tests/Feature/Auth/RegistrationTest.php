<?php

use Illuminate\Support\Facades\Http;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('registration screen includes the turnstile widget when configured', function () {
    config([
        'services.turnstile.site_key' => '0xTestSiteKey',
        'services.turnstile.secret_key' => '0xTestSecretKey',
    ]);

    $response = $this->get('/register');

    $response->assertOk();
    $response->assertSee('cf-turnstile', false);
    $response->assertSee('0xTestSiteKey', false);
    $response->assertSee('challenges.cloudflare.com/turnstile', false);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('verification.notice', absolute: false));
});

test('registration requires turnstile when configured', function () {
    config([
        'services.turnstile.site_key' => '0xTestSiteKey',
        'services.turnstile.secret_key' => '0xTestSecretKey',
    ]);

    $response = $this->from('/register')->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/register');
    $response->assertSessionHasErrors('cf-turnstile-response');
});

test('new users can register with a valid turnstile token', function () {
    config([
        'services.turnstile.site_key' => '0xTestSiteKey',
        'services.turnstile.secret_key' => '0xTestSecretKey',
    ]);

    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
        ]),
    ]);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'cf-turnstile-response' => 'valid-token',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('verification.notice', absolute: false));

    Http::assertSent(function ($request) {
        return $request->url() === 'https://challenges.cloudflare.com/turnstile/v0/siteverify'
            && $request['secret'] === '0xTestSecretKey'
            && $request['response'] === 'valid-token';
    });
});

test('registration is rejected when the turnstile token is invalid', function () {
    config([
        'services.turnstile.site_key' => '0xTestSiteKey',
        'services.turnstile.secret_key' => '0xTestSecretKey',
    ]);

    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => false,
            'error-codes' => ['invalid-input-response'],
        ]),
    ]);

    $response = $this->from('/register')->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'cf-turnstile-response' => 'invalid-token',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/register');
    $response->assertSessionHasErrors('cf-turnstile-response');
});
