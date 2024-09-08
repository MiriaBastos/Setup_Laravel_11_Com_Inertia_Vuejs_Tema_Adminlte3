<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lis_produtos', function (Blueprint $table) {
            $table->boolean('check_item')->after('valor')->nullable()->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('lis_produtos', function (Blueprint $table) {
            $table->dropColumn('check_item');
        });
    }
};
