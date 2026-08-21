<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PromoCampaignController;
use App\Models\User;
use App\Support\CartService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $verificationMailFailed = false;

        try {
            event(new Registered($user));
        } catch (\Throwable $e) {
            report($e);
            $verificationMailFailed = true;
        }

        $guestSessionId = $request->session()->getId();

        Auth::login($user);

        // Associar carrinho de convidado ao novo utilizador (antes de regenerar a sessão)
        app(CartService::class)->mergeGuestCartIntoUser($request, $user, $guestSessionId);
        $request->session()->regenerate();
        PromoCampaignController::promotePendingNotice($request);

        if ($verificationMailFailed) {
            $request->session()->flash(
                'status',
                'Conta criada com sucesso. Não foi possível enviar o e-mail de verificação agora — pode reenviar mais tarde.'
            );
        }

        if (! $user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
