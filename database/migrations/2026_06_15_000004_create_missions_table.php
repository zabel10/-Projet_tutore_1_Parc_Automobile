<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id('id_mission');
            $table->foreignId('id_vehicule')
                ->constrained('vehicules', 'id_vehicule')
                ->onDelete('restrict');
            $table->foreignId('id_conducteur')
                ->constrained('conducteurs', 'id_conducteur')
                ->onDelete('restrict');
            $table->foreignId('id_utilisateur')
                ->constrained('utilisateurs')
                ->onDelete('restrict');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->string('destination', 100);
            $table->string('motif', 255);
            $table->enum('statut', ['planifiee', 'en_cours', 'terminee', 'annulee'])
                ->default('planifiee');
            $table->unsignedInteger('km_depart');
            $table->unsignedInteger('km_retour')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
