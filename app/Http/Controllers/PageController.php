<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with('images')
            ->latest()
            ->limit(12)
            ->get();

        return view('pages.index', compact('featuredProducts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function quemSomos()
    {
        return view('pages.quem-somos');
    }

    public function service()
    {
        return view('pages.service');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function shippingPolicy()
    {
        return view('pages.shipping-policy');
    }

    public function returnsPolicy()
    {
        return view('pages.returns-policy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function personalization(Request $request)
    {
        $product = null;
        $slug = $request->query('produto');

        if (filled($slug)) {
            $product = Product::query()
                ->where('is_active', true)
                ->where('slug', $slug)
                ->with('images')
                ->first();
        }

        return view('pages.personalization', compact('product'));
    }

    public function support()
    {
        return view('pages.support');
    }

    public function project()
    {
        return view('pages.project');
    }

    public function feature()
    {
        return view('pages.feature');
    }

    public function team()
    {
        return view('pages.team');
    }

    public function testimonial()
    {
        return view('pages.testimonial');
    }

    public function product()
    {
        return view('pages.product');
    }

    public function scanfit()
    {
        return view('pages.scanfit');
    }

    public function notFound()
    {
        return view('pages.404');
    }

    public function quote()
    {
        return view('pages.placeholder', ['title' => 'Pedir Orçamento']);
    }

    public function search()
    {
        return view('pages.placeholder', ['title' => 'Procurar']);
    }

    public function trackOrder()
    {
        return view('pages.placeholder', ['title' => 'Acompanhar Pedido']);
    }

    public function wishlist()
    {
        return view('pages.placeholder', ['title' => 'Lista de Desejos']);
    }

    public function categoryPlaceholder(string $slug)
    {
        $titles = [
            'epis' => 'EPIs',
            'vestuario' => 'Vestuário',
            'calcado' => 'Calçado',
            'acessorios' => 'Acessórios',
        ];

        return view('pages.placeholder', [
            'title' => $titles[$slug] ?? ucfirst(str_replace('-', ' ', $slug)),
        ]);
    }
}



