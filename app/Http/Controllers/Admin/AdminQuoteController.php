<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\QuoteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuoteController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $quotes = Quote::query()
            ->when(in_array($status, ['pending', 'responded', 'cancelled'], true), fn ($q) => $q->where('status', $status))
            ->withCount(['items', 'logos'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.quotes.index', compact('quotes', 'status'));
    }

    public function show(Quote $quote)
    {
        $quote->load(['items', 'logos']);
        return view('admin.quotes.show', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,responded,cancelled'],
        ]);

        $quote->update(['status' => $data['status']]);

        return back()->with('status', 'Status atualizado.');
    }

    public function destroy(Quote $quote)
    {
        $quote->load('logos');

        DB::transaction(function () use ($quote) {
            foreach ($quote->logos as $logo) {
                $this->deleteLogoFile($logo);
            }
            $quote->delete();
        });

        return redirect()->route('admin.quotes.index')->with('status', 'Orçamento removido.');
    }

    private function deleteLogoFile(QuoteLogo $logo): void
    {
        $fullPath = public_path($logo->file_path);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
