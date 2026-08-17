<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\QuoteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $isPersonalization = $request->input('form_origin') === 'personalization';

        $validated = $request->validate([
            'client_type' => ['required', 'in:company,individual'],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:client_type,company'],

            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'tax_id' => ['nullable', 'string', 'max:50'],

            'address' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],

            'notes' => ['nullable', 'string', 'max:5000'],
            'form_origin' => ['nullable', 'in:personalization,quote'],
            'product_slug' => ['nullable', 'string', 'max:255'],
            'metodo' => ['nullable', 'string', 'in:DTF,Bordado,Aconselhamento'],
            'local' => ['nullable', 'array'],
            'local.*' => ['nullable', 'string', 'in:Peito esquerdo,Costas,Manga'],
            'logo_x' => ['nullable', 'numeric', 'between:0,100'],
            'logo_y' => ['nullable', 'numeric', 'between:0,100'],
            'logo_scale' => ['nullable', 'numeric', 'between:5,50'],
            'mockup_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,webp', 'max:8192'],

            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string', 'max:255'],
            'products.*.reference' => ['nullable', 'string', 'max:255'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.color' => ['nullable', 'string', 'max:255'],

            'logos' => ['nullable', 'array'],
            'logos.*.file' => [
                Rule::requiredIf($isPersonalization),
                'nullable',
                'file',
                'mimes:jpeg,jpg,png,gif,webp,pdf',
                'max:6144',
            ],
            'logos.*.location' => ['nullable', 'string', 'max:255'],
            'logos.*.pieces' => ['nullable', 'string', 'max:255'],
        ], [
            'logos.*.file.required' => 'Anexe o logótipo para personalizar o produto.',
            'logos.*.file.mimes' => 'O logótipo deve ser PNG, JPG, WEBP ou PDF.',
            'logos.*.file.max' => 'O logótipo não pode ultrapassar 6 MB.',
        ]);

        $storedLogos = [];

        $quote = DB::transaction(function () use ($request, $validated, &$storedLogos) {
            $quote = Quote::create([
                'client_type' => $validated['client_type'],
                'company_name' => $validated['client_type'] === 'company' ? ($validated['company_name'] ?? null) : null,
                'contact_name' => $validated['contact_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'tax_id' => $validated['tax_id'] ?? '',
                'address' => $validated['address'] ?? '',
                'postal_code' => $validated['postal_code'] ?? '',
                'city' => $validated['city'] ?? '',
                'country' => $validated['country'] ?? '',
                'notes' => $this->composeNotes($request, $validated['notes'] ?? null),
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

            $storedLogos = $this->storeLogos($request, $quote, $validated['products'][0]['name'] ?? null);
            $quote->mockup_path = $this->storeMockup($request, $quote);
            if ($quote->mockup_path) {
                $quote->save();
            }

            return $quote;
        });

        if ($isPersonalization) {
            $params = [];
            if ($slug = $request->input('product_slug')) {
                $params['produto'] = $slug;
            }

            $redirect = redirect()
                ->route('personalization', $params)
                ->with('personalization_success', true);

            $storedLogo = $storedLogos[0] ?? null;
            if ($storedLogo) {
                $redirect->with('submitted_logo', [
                    'url' => asset($storedLogo['logo']->file_path),
                    'is_image' => $storedLogo['logo']->isImage(),
                    'name' => $storedLogo['original_name'],
                    'location' => $storedLogo['logo']->location,
                    'x' => $request->input('logo_x'),
                    'y' => $request->input('logo_y'),
                    'scale' => $request->input('logo_scale'),
                ]);
            }

            return $redirect;
        }

        return redirect()
            ->route('quote')
            ->with('status', 'Pedido de orçamento enviado com sucesso! Responderemos por email entre 24h a 48h.');
    }

    private function composeNotes(Request $request, ?string $notes): ?string
    {
        $parts = [];

        if (filled($notes)) {
            $parts[] = $notes;
        }

        if ($request->input('form_origin') !== 'personalization') {
            return $parts[0] ?? null;
        }

        if ($metodo = $request->input('metodo')) {
            $parts[] = 'Método de personalização: ' . $metodo;
        }

        $locals = array_filter((array) $request->input('local', []));
        if ($locals) {
            $parts[] = 'Local da personalização: ' . implode(', ', $locals);
        }

        return $parts ? implode("\n", $parts) : null;
    }

    private function storeLogos(Request $request, Quote $quote, ?string $productName): array
    {
        $stored = [];
        $logos = $request->file('logos', []);
        if (! is_array($logos) || count($logos) === 0) {
            return $stored;
        }

        $dir = public_path('uploads/quotes/logos');
        File::ensureDirectoryExists($dir);

        $sharedLocation = implode(', ', array_filter((array) $request->input('local', []))) ?: null;

        foreach ($logos as $idx => $logoRow) {
            if (! is_array($logoRow) || empty($logoRow['file'])) {
                continue;
            }

            $file = $logoRow['file'];
            $originalName = $file->getClientOriginalName();
            $filename = 'quote-' . $quote->id . '-' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);

            $logo = QuoteLogo::create([
                'quote_id' => $quote->id,
                'file_path' => 'uploads/quotes/logos/' . $filename,
                'location' => $request->input("logos.$idx.location") ?: $sharedLocation,
                'pieces' => $request->input("logos.$idx.pieces") ?: $productName,
            ]);

            $stored[] = [
                'logo' => $logo,
                'original_name' => $originalName,
            ];
        }

        return $stored;
    }

    private function storeMockup(Request $request, Quote $quote): ?string
    {
        $dir = public_path('uploads/quotes/mockups');
        File::ensureDirectoryExists($dir);
        $filename = 'quote-' . $quote->id . '-mockup.png';
        $relative = 'uploads/quotes/mockups/' . $filename;

        if ($request->hasFile('mockup_image')) {
            $request->file('mockup_image')->move($dir, $filename);

            return $relative;
        }

        if ($this->composeMockupOnServer($request, $quote, $dir . DIRECTORY_SEPARATOR . $filename)) {
            return $relative;
        }

        return null;
    }

    private function composeMockupOnServer(Request $request, Quote $quote, string $outputPath): bool
    {
        if (! function_exists('imagecreatetruecolor')) {
            return false;
        }

        $slug = $request->input('product_slug');
        if (! filled($slug)) {
            return false;
        }

        $product = Product::query()->where('slug', $slug)->with('images')->first();
        $coverPath = $product?->images->first()?->path;
        if (! $coverPath || ! is_file(public_path($coverPath))) {
            return false;
        }

        $logo = $quote->logos()->first();
        if (! $logo || ! $logo->isImage() || ! is_file(public_path($logo->file_path))) {
            return false;
        }

        $productImage = $this->loadGdImage(public_path($coverPath));
        $logoImage = $this->loadGdImage(public_path($logo->file_path));
        if (! $productImage || ! $logoImage) {
            return false;
        }

        $srcW = imagesx($productImage);
        $srcH = imagesy($productImage);
        $maxW = 1200;
        $width = $srcW > $maxW ? $maxW : $srcW;
        $height = (int) round($srcH * ($width / $srcW));

        $canvas = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $white);
        imagealphablending($canvas, true);
        imagecopyresampled($canvas, $productImage, 0, 0, 0, 0, $width, $height, $srcW, $srcH);

        $scale = max(5, min(50, (float) $request->input('logo_scale', 16)));
        $centerX = ((float) $request->input('logo_x', 38)) / 100 * $width;
        $centerY = ((float) $request->input('logo_y', 36)) / 100 * $height;
        $logoW = (int) round(($scale / 100) * $width);
        $logoH = (int) round($logoW * (imagesy($logoImage) / max(1, imagesx($logoImage))));
        $destX = (int) round($centerX - ($logoW / 2));
        $destY = (int) round($centerY - ($logoH / 2));

        imagecopyresampled(
            $canvas,
            $logoImage,
            $destX,
            $destY,
            0,
            0,
            $logoW,
            $logoH,
            imagesx($logoImage),
            imagesy($logoImage)
        );

        $saved = imagepng($canvas, $outputPath, 6);
        imagedestroy($canvas);
        imagedestroy($productImage);
        imagedestroy($logoImage);

        return $saved;
    }

    private function loadGdImage(string $path)
    {
        $info = @getimagesize($path);
        if (! $info) {
            return null;
        }

        return match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
            IMAGETYPE_PNG => @imagecreatefrompng($path),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            IMAGETYPE_GIF => @imagecreatefromgif($path),
            default => null,
        };
    }
}
