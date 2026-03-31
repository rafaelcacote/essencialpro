<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('category_product')) {
            Schema::create('category_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->foreignId('category_id')->constrained()->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['product_id', 'category_id']);
                $table->index('category_id');
            });
        }

        // Backfill da categoria primaria antiga para a tabela pivot.
        if (Schema::hasColumn('products', 'category_id')) {
            DB::statement("
                INSERT INTO category_product (product_id, category_id, created_at, updated_at)
                SELECT p.id, p.category_id, NOW(), NOW()
                FROM products p
                WHERE p.category_id IS NOT NULL
                ON DUPLICATE KEY UPDATE updated_at = VALUES(updated_at)
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};

