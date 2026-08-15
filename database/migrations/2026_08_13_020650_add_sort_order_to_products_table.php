<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('is_featured');
        });

        // Abafadores (categoria Proteção Auditiva) antes dos tampões (subcategoria Auriculares).
        $hearingRootId = DB::table('categories')->where('slug', 'protecao-auditiva')->value('id');
        $earplugsId = DB::table('categories')->where('slug', 'auriculares')->value('id');

        if ($hearingRootId) {
            $earmuffs = DB::table('products')
                ->where('category_id', $hearingRootId)
                ->orderBy('id')
                ->pluck('id');

            foreach ($earmuffs as $index => $productId) {
                DB::table('products')->where('id', $productId)->update([
                    'sort_order' => $index + 1,
                ]);
            }
        }

        if ($earplugsId) {
            $earplugs = DB::table('products')
                ->where('category_id', $earplugsId)
                ->orderBy('id')
                ->pluck('id');

            foreach ($earplugs as $index => $productId) {
                DB::table('products')->where('id', $productId)->update([
                    'sort_order' => 100 + $index + 1,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
