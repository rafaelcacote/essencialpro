<?php

use App\Models\User;

test('guest is redirected to admin login when visiting customers', function () {
    $this->get(route('admin.customers.index'))
        ->assertRedirect(route('admin.login'));
});

test('non admin cannot list customers', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.customers.index'))
        ->assertForbidden();
});

test('admin can list registered customers', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->create(['name' => 'Maria Silva', 'email' => 'maria@example.com']);
    User::factory()->admin()->create(['name' => 'Outro Admin']);

    $response = $this->actingAs($admin)->get(route('admin.customers.index'));

    $response->assertOk()
        ->assertSee('Maria Silva')
        ->assertSee('maria@example.com')
        ->assertDontSee('Outro Admin');
});

test('admin can search customers by name or email', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->create(['name' => 'Ana Costa', 'email' => 'ana@example.com']);
    User::factory()->create(['name' => 'Bruno Dias', 'email' => 'bruno@example.com']);

    $this->actingAs($admin)
        ->get(route('admin.customers.index', ['q' => 'Ana']))
        ->assertOk()
        ->assertSee('Ana Costa')
        ->assertDontSee('Bruno Dias');

    $this->actingAs($admin)
        ->get(route('admin.customers.index', ['q' => 'bruno@example.com']))
        ->assertOk()
        ->assertSee('Bruno Dias')
        ->assertDontSee('Ana Costa');
});

test('admin can view a customer profile', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->create([
        'name' => 'João Pereira',
        'email' => 'joao@example.com',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.customers.show', $customer))
        ->assertOk()
        ->assertSee('João Pereira')
        ->assertSee('joao@example.com')
        ->assertSee('Dados da conta');
});

test('admin cannot view another admin as a customer', function () {
    $admin = User::factory()->admin()->create();
    $otherAdmin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.customers.show', $otherAdmin))
        ->assertNotFound();
});
