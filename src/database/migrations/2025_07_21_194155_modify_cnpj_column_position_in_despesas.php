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
        Schema::table('despesas', function (Blueprint $table) {
            $table->dropColumn('cnpj_cpf_fornecedor');
        });

        Schema::table('despesas', function (Blueprint $table) {
            $table->string('cnpj_cpf_fornecedor')->nullable()->after('nome_fornecedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            $table->dropColumn('cnpj_cpf_fornecedor');
        });
    }
};
