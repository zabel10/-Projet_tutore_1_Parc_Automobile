<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->id('id_alerte');
            $table->foreignId('id_vehicule')
                ->nullable()
                ->constrained('vehicules', 'id_vehicule')
                ->onDelete('cascade');
            $table->enum('type_alerte', [
                'revision', 'assurance', 'visite_technique', 'permis', 'autre'
            ]);
            $table->string('message', 255);
            $table->date('date_echeance');
            $table->enum('statut', ['active', 'resolue', 'ignoree'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertes');
    }
};
