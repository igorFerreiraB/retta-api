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
        Schema::create('deputados', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id')->unique();
            $table->string('nome');
            $table->string('sigla_partido')->nullable();
            $table->string('sigla_uf')->nullable();
            $table->string('email')->nullable();
            $table->string('uri_foto')->nullable();
            $table->integer('id_legislatura')->nullable();
            $table->json('dados_completos')->nullable();
            $table->timestamp('ultima_atualizacao')->nullable();
            $table->timestamps();
        });

        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->integer('deputado_api_id');
            
            $table->integer('ano')->nullable();
            $table->integer('mes')->nullable();
            $table->string('tipo_despesa')->nullable();
            $table->bigInteger('cod_documento')->nullable()->unique();
            $table->string('tipo_documento')->nullable();
            $table->integer('cod_tipo_documento')->nullable();
            $table->date('data_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->decimal('valor_documento', 15, 2)->nullable();
            $table->string('url_documento')->nullable();
            $table->string('nome_fornecedor')->nullable();
            $table->decimal('valor_liquido', 15, 2)->nullable();
            $table->decimal('valor_glosa', 15, 2)->nullable();
            $table->string('num_ressarcimento')->nullable();
            $table->bigInteger('cod_lote')->nullable();
            $table->integer('parcela')->nullable();

            $table->json('dados_completos')->nullable();

            $table->timestamps();

            $table->foreign('deputado_api_id')->references('api_id')->on('deputados')->onDelete('cascade');
        });

        Schema::create('orgaos', function (Blueprint $table) {
            $table->id();
            $table->integer('deputado_api_id');
            $table->bigInteger('id_orgao')->nullable()->unique();
            $table->string('uri_orgao')->nullable();
            $table->string('sigla_orgao')->nullable();
            $table->string('nome_orgao')->nullable();
            $table->string('nome_publicacao')->nullable();
            $table->string('titulo')->nullable();
            $table->string('cod_titulo')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();

            $table->json('dados_completos')->nullable();

            $table->timestamps();

            $table->foreign('deputado_api_id')->references('api_id')->on('deputados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgaos');
        Schema::dropIfExists('despesas');
        Schema::dropIfExists('deputados');
    }
};