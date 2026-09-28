<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku', 100)->unique()->after('name');
            }

            if (!Schema::hasColumn('products', 'cost_price')) {
                $table->decimal('cost_price', 10, 2)->after('sku');
            }

            if (!Schema::hasColumn('products', 'selling_price')) {
                $table->decimal('selling_price', 10, 2)->after('cost_price');
            }

            if (!Schema::hasColumn('products', 'low_stock_limit')) {
                $table->unsignedInteger('low_stock_limit')->default(5)->after('stock');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'sku')) {
                $table->dropColumn('sku');
            }

            if (Schema::hasColumn('products', 'cost_price')) {
                $table->dropColumn('cost_price');
            }

            if (Schema::hasColumn('products', 'selling_price')) {
                $table->dropColumn('selling_price');
            }

            if (Schema::hasColumn('products', 'low_stock_limit')) {
                $table->dropColumn('low_stock_limit');
            }
        });
    }
};