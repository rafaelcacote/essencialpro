<?php

namespace App\Providers;

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
            $view->with('menuCategories', $categories);
        });
    }
}
