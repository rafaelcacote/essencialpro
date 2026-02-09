<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::query()
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(20);

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePartner($request);

        $logoPath = $this->storeLogo($request);
        $partner = Partner::create([
            'name' => $validated['name'],
            'logo_path' => $logoPath,
            'website_url' => $validated['website_url'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()
            ->route('admin.partners.edit', $partner)
            ->with('status', 'Parceiro criado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $this->validatePartner($request, true);

        if ($request->hasFile('logo')) {
            $this->deleteLogoFile($partner->logo_path);
            $partner->logo_path = $this->storeLogo($request);
        }

        $partner->fill([
            'name' => $validated['name'],
            'website_url' => $validated['website_url'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ])->save();

        return back()->with('status', 'Parceiro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->deleteLogoFile($partner->logo_path);
        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('status', 'Parceiro removido.');
    }

    private function validatePartner(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
            'logo' => array_merge(
                $isUpdate ? ['nullable'] : ['required'],
                ['file', 'image', 'max:4096']
            ),
        ]);
    }

    private function storeLogo(Request $request): string
    {
        $file = $request->file('logo');
        $dir = public_path('uploads/partners');
        File::ensureDirectoryExists($dir);

        $filename = uniqid('partner-', true) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/partners/' . $filename;
    }

    private function deleteLogoFile(string $path): void
    {
        $fullPath = public_path($path);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
