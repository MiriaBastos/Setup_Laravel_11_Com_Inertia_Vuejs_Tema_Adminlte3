<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cli_despesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categoria_id');
            $table->text('descricao');
            $table->string('dt_dia', 2);
            $table->string('dt_mes', 20);
            $table->string('dt_ano', 10);
            $table->decimal('valor_despesa', 10, 2);
            $table->boolean('despesa_recorrente')->default(0);

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('categoria_id')
                ->references('id')
                ->on('cat_categorias');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_despesas');
    }
};
