<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\QuoteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_type' => ['required', 'in:company,individual'],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:client_type,company'],

            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'tax_id' => ['required', 'string', 'max:50'],

            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],

            'notes' => ['nullable', 'string', 'max:5000'],

            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string', 'max:255'],
            'products.*.reference' => ['nullable', 'string', 'max:255'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.color' => ['nullable', 'string', 'max:255'],

            'logos' => ['nullable', 'array'],
            'logos.*.file' => ['nullable', 'file', 'image', 'max:6144'],
            'logos.*.location' => ['nullable', 'string', 'max:255'],
            'logos.*.pieces' => ['nullable', 'string', 'max:255'],
        ]);

        $quote = DB::transaction(function () use ($request, $validated) {
            $quote = Quote::create([
                'client_type' => $validated['client_type'],
                'company_name' => $validated['client_type'] === 'company' ? ($validated['company_name'] ?? null) : null,
                'contact_name' => $validated['contact_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'tax_id' => $validated['tax_id'],
                'address' => $validated['address'],
                'postal_code' => $validated['postal_code'],
                'city' => $validated['city'],
                'country' => $validated['country'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
            ]);

            foreach ($validated['products'] as $p) {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_name' => $p['name'],
                    'reference' => $p['reference'] ?? null,
                    'quantity' => (int) $p['quantity'],
                    'color' => $p['color'] ?? null,
                ]);
            }

            $logos = $request->file('logos', []);
            if (is_array($logos) && count($logos) > 0) {
                $dir = public_path('uploads/quotes/logos');
                File::ensureDirectoryExists($dir);

                foreach ($logos as $idx => $logoRow) {
                    if (!is_array($logoRow) || empty($logoRow['file'])) {
                        continue;
                    }
                    $file = $logoRow['file'];
                    $filename = 'quote-' . $quote->id . '-' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
                    $file->move($dir, $filename);

                    QuoteLogo::create([
                        'quote_id' => $quote->id,
                        'file_path' => 'uploads/quotes/logos/' . $filename,
                        'location' => $request->input("logos.$idx.location") ?: null,
                        'pieces' => $request->input("logos.$idx.pieces") ?: null,
                    ]);
                }
            }

            return $quote;
        });

        return redirect()
            ->route('contact')
            ->with('status', 'Pedido de orçamento enviado com sucesso! Responderemos por email entre 24h a 48h.');
    }
}
