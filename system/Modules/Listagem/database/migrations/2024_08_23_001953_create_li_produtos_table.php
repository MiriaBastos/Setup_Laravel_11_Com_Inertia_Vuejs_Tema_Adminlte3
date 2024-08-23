<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('li_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('lista_id')->unsigned()->nullable()->index();
            $table->string('nome');
            $table->integer('quantidade');
            $table->decimal('valor', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('li_produtos');
    }
};
