<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->decimal('price_wl', 28, 8)->change();
        });

        if (! Schema::hasColumn('listings', 'price_wl_raw')) {
            Schema::table('listings', function (Blueprint $table) {
                $table->string('price_wl_raw', 64)->nullable()->after('price_wl');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('listings', 'price_wl_raw')) {
            Schema::table('listings', function (Blueprint $table) {
                $table->dropColumn('price_wl_raw');
            });
        }

        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('price_wl')->change();
        });
    }
};
