<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\PromoCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AdminPromoCampaignController extends Controller
{
    public function index()
    {
        $campaigns = PromoCampaign::query()
            ->with('coupon')
            ->latest('id')
            ->paginate(20);

        return view('admin.promo-campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $coupons = Coupon::query()->orderBy('code')->get();

        return view('admin.promo-campaigns.create', compact('coupons'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCampaign($request);
        $imagePath = $this->storeImage($request);

        $campaign = PromoCampaign::create([
            ...$this->payload($validated),
            'image_path' => $imagePath,
        ]);

        if ($campaign->is_active) {
            $this->deactivateOthers($campaign);
        }

        return redirect()
            ->route('admin.promo-campaigns.edit', $campaign)
            ->with('status', 'Campanha criada com sucesso.');
    }

    public function edit(PromoCampaign $promoCampaign)
    {
        $coupons = Coupon::query()->orderBy('code')->get();

        return view('admin.promo-campaigns.edit', [
            'campaign' => $promoCampaign,
            'coupons' => $coupons,
        ]);
    }

    public function update(Request $request, PromoCampaign $promoCampaign)
    {
        $validated = $this->validateCampaign($request, true);

        if ($request->hasFile('image')) {
            $this->deleteImageFile($promoCampaign->image_path);
            $promoCampaign->image_path = $this->storeImage($request);
        }

        $promoCampaign->fill($this->payload($validated))->save();

        if ($promoCampaign->is_active) {
            $this->deactivateOthers($promoCampaign);
        }

        return back()->with('status', 'Campanha atualizada com sucesso.');
    }

    public function destroy(PromoCampaign $promoCampaign)
    {
        $this->deleteImageFile($promoCampaign->image_path);
        $promoCampaign->delete();

        return redirect()
            ->route('admin.promo-campaigns.index')
            ->with('status', 'Campanha removida.');
    }

    private function validateCampaign(Request $request, bool $isUpdate = false): array
    {
        $request->merge([
            'coupon_id' => $request->filled('coupon_id') ? $request->input('coupon_id') : null,
            'starts_at' => $request->filled('starts_at') ? $request->input('starts_at') : null,
            'ends_at' => $request->filled('ends_at') ? $request->input('ends_at') : null,
        ]);

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'button_text' => ['required', 'string', 'max:120'],
            'button_url' => ['required', 'string', 'max:255'],
            'audience' => ['required', Rule::in([
                PromoCampaign::AUDIENCE_GUESTS,
                PromoCampaign::AUDIENCE_ALL,
                PromoCampaign::AUDIENCE_FIRST_PURCHASE,
            ])],
            'coupon_id' => ['nullable', 'exists:coupons,id'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'image' => array_merge(
                $isUpdate ? ['nullable'] : ['required'],
                ['file', 'image', 'max:8192']
            ),
        ]);
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payload(array $validated): array
    {
        return [
            'title' => $validated['title'],
            'button_text' => $validated['button_text'],
            'button_url' => $validated['button_url'],
            'audience' => $validated['audience'],
            'coupon_id' => $validated['coupon_id'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
            'starts_at' => $validated['starts_at'] ?? null,
            'ends_at' => $validated['ends_at'] ?? null,
        ];
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $dir = public_path('uploads/campaigns');
        File::ensureDirectoryExists($dir);

        $filename = uniqid('campaign-', true) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/campaigns/' . $filename;
    }

    private function deleteImageFile(string $path): void
    {
        // Não apagar assets estáticos em img/
        if (str_starts_with($path, 'img/')) {
            return;
        }

        $fullPath = public_path($path);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function deactivateOthers(PromoCampaign $campaign): void
    {
        PromoCampaign::query()
            ->where('id', '!=', $campaign->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);
    }
}
