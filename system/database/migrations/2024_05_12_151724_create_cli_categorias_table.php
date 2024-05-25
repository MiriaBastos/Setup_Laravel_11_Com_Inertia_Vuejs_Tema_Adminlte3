<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cat_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nome', 200);
            $table->string('status', 200);

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cat_categorias');
    }
};
