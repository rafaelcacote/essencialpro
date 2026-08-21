<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\PromoCampaign;
use Illuminate\Database\Seeder;

class FirstPurchasePromoSeeder extends Seeder
{
    public function run(): void
    {
        $coupon = Coupon::query()->updateOrCreate(
            ['code' => 'BEMVINDO10'],
            [
                'name' => 'Desconto primeira compra',
                'type' => 'percent',
                'value' => 10,
                'min_subtotal' => null,
                'usage_limit' => null,
                'usage_limit_per_user' => 1,
                'first_order_only' => true,
                'is_active' => true,
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()->setDate(2026, 9, 30)->endOfDay(),
            ]
        );

        $imagePath = 'img/promocoes/promocao_primeira_compra.jpeg';
        if (! is_file(public_path($imagePath))) {
            $this->command?->warn("Imagem não encontrada: public/{$imagePath}. Crie a campanha manualmente no admin.");

            return;
        }

        PromoCampaign::query()->where('is_active', true)->update(['is_active' => false]);

        PromoCampaign::query()->updateOrCreate(
            ['title' => 'Primeira compra - 10%'],
            [
                'image_path' => $imagePath,
                'button_text' => 'DESBLOQUEIE O SEU DESCONTO',
                'button_url' => '/register',
                'audience' => PromoCampaign::AUDIENCE_GUESTS,
                'coupon_id' => $coupon->id,
                'is_active' => true,
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()->setDate(2026, 9, 30)->endOfDay(),
            ]
        );
    }
}
