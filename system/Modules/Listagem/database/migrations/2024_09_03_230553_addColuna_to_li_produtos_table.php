<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lis_produtos', function (Blueprint $table) {
            $table->integer('setor_id')->after('lista_id')->unsigned()->nullable();

            $table->foreign('setor_id')
                    ->references('id')
                    ->on('lis_setores');
        });
    }

    public function down(): void
    {
        Schema::table('lis_produtos', function (Blueprint $table) {
            $table->dropForeign(['setor_id']);
            $table->dropColumn('setor_id');
        });
    }
};
