<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation');
            $table->foreignId('id_utilisateur')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('id_vehicule')->constrained('vehicules', 'id_vehicule')->cascadeOnDelete();
            $table->foreignId('id_conducteur')->nullable()->constrained('conducteurs', 'id_conducteur')->nullOnDelete();
            $table->date('date_reservation');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('motif')->nullable();
            $table->enum('statut', ['confirmee', 'en_cours', 'terminee', 'annulee'])->default('confirmee');
            $table->integer('km_depart')->nullable();
            $table->integer('km_retour')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
