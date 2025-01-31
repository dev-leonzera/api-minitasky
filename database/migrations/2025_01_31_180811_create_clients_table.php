<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('fone');
            $table->date('data_contrato');
            $table->integer('dia_vencimento');
            $table->boolean('ativo')->default(false);
            $table->boolean('mensalista')->default(false);
            $table->enum('tipo', ['pf', 'pj']);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
