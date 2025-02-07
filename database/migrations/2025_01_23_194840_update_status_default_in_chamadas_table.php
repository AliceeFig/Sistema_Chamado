<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chamadas', function (Blueprint $table) {
            $table->string('status')->default('pendente')->change();
        });
    }

    public function down()
    {
        Schema::table('chamadas', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
        });
    }
};
