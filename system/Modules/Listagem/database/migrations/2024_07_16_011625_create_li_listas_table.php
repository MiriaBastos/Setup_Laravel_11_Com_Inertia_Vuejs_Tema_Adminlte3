<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('li_listas', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->index();
            $table->string('nome');
            $table->text('conteudo_json')->nullable();
            $table->string('situacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('li_listas');
    }
};
