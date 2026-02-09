<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('code');
            });
        }
        
        // Adicionar foreign key e índice apenas se a tabela categories existir
        if (Schema::hasTable('categories')) {
            try {
                Schema::table('products', function (Blueprint $table) {
                    $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                    $table->index('category_id');
                });
            } catch (\Exception $e) {
                // Se houver erro na foreign key, apenas criar o índice
                try {
                    Schema::table('products', function (Blueprint $table) {
                        $table->index('category_id');
                    });
                } catch (\Exception $e2) {
                    // Ignorar se o índice já existir
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropIndex(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
