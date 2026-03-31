<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configurar paginação para usar Bootstrap 5
        Paginator::useBootstrapFive();

        // Compartilhar categorias com todas as views para o menu (árvore completa)
        View::composer('components.navbar', function ($view) {
            $withNestedChildren = function ($query) use (&$withNestedChildren) {
                $query->where('is_active', true)->orderBy('sort_order')
                    ->with(['children' => $withNestedChildren]);
            };
            $categories = Category::query()
                ->where('is_active', true)
                ->whereNull('parent_id')
                ->with(['children' => $withNestedChildren])
                ->orderBy('sort_order')
                ->get();

            $cartCount = 0;
            $sessionId = session()->getId();
            $userId = auth()->id();
            if ($sessionId) {
                $cart = Cart::query()
                    ->where('status', 'active')
                    ->when($userId, fn ($q) => $q->where('user_id', $userId), fn ($q) => $q->where('session_id', $sessionId))
                    ->with('items')
                    ->latest('id')
                    ->first();

                if ($cart) {
                    $cartCount = (int) $cart->items->sum('quantity');
                }
            }

            $view->with('menuCategories', $categories)
                ->with('cartCount', $cartCount);
        });
    }
}
