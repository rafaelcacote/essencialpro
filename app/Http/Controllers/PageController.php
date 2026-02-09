<?php

namespace App\Http\Controllers;

use App\Models\Partner;
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

        $partners = Partner::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(12)
            ->get();

        return view('pages.index', compact('featuredProducts', 'partners'));
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
}



