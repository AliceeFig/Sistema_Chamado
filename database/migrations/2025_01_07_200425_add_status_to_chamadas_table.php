<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chamadas', function (Blueprint $table) {
            //$table->enum('status', ['pendente', 'em andamento', 'concluida'])->default('pendente');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chamadas', function (Blueprint $table) {
            //
        });
    }
};
