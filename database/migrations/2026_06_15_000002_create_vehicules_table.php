<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id('id_vehicule');
            $table->string('immatriculation', 20)->unique();
            $table->string('marque', 50);
            $table->string('modele', 50);
            $table->year('annee');
            $table->enum('statut', ['disponible', 'en_mission', 'en_maintenance', 'hors_service'])
                ->default('disponible');
            $table->unsignedInteger('kilometrage')->default(0);
            $table->enum('carburant', ['diesel', 'essence', 'hybride', 'electrique']);
            $table->string('couleur', 30)->nullable();
            $table->date('date_acquisition')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
