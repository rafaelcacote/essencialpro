<?php

return [
    'array' => 'O campo :attribute tem de ser uma lista.',
    'boolean' => 'O campo :attribute tem de ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação do campo :attribute não corresponde.',
    'current_password' => 'A palavra-passe está incorreta.',
    'email' => 'O campo :attribute tem de ser um endereço de e-mail válido.',
    'exists' => 'O valor selecionado para :attribute é inválido.',
    'file' => 'O campo :attribute tem de ser um ficheiro.',
    'image' => 'O campo :attribute tem de ser uma imagem.',
    'in' => 'O valor selecionado para :attribute é inválido.',
    'integer' => 'O campo :attribute tem de ser um número inteiro.',
    'lowercase' => 'O campo :attribute tem de estar em letras minúsculas.',
    'max' => [
        'array' => 'O campo :attribute não pode ter mais de :max elementos.',
        'file' => 'O campo :attribute não pode ter mais de :max kilobytes.',
        'numeric' => 'O campo :attribute não pode ser superior a :max.',
        'string' => 'O campo :attribute não pode ter mais de :max caracteres.',
    ],
    'min' => [
        'array' => 'O campo :attribute tem de ter pelo menos :min elementos.',
        'file' => 'O campo :attribute tem de ter pelo menos :min kilobytes.',
        'numeric' => 'O campo :attribute tem de ser pelo menos :min.',
        'string' => 'O campo :attribute tem de ter pelo menos :min caracteres.',
    ],
    'numeric' => 'O campo :attribute tem de ser um número.',
    'password' => [
        'letters' => 'O campo :attribute tem de conter pelo menos uma letra.',
        'mixed' => 'O campo :attribute tem de conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers' => 'O campo :attribute tem de conter pelo menos um número.',
        'symbols' => 'O campo :attribute tem de conter pelo menos um símbolo.',
        'uncompromised' => 'A :attribute indicada surgiu numa fuga de dados. Escolha outra.',
    ],
    'regex' => 'O formato do campo :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other tem o valor :value.',
    'string' => 'O campo :attribute tem de ser texto.',
    'unique' => 'Este valor de :attribute já está a ser utilizado.',
    'url' => 'O campo :attribute tem de ser um endereço válido.',

    'attributes' => [
        'email' => 'e-mail',
        'name' => 'nome',
        'password' => 'palavra-passe',
        'password_confirmation' => 'confirmação da palavra-passe',
    ],
];
