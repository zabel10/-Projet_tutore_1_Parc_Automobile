<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assurances', function (Blueprint $table) {
            $table->id('id_assurance');
            $table->foreignId('id_vehicule')
                ->constrained('vehicules', 'id_vehicule')
                ->onDelete('cascade');
            $table->string('compagnie', 100);
            $table->string('numero_contrat', 50)->unique();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('cout', 12, 2);
            $table->enum('type_assurance', ['tous_risques', 'tiers', 'tiers_plus'])->default('tous_risques');
            $table->timestamps();

            $table->index(['date_debut', 'date_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assurances');
    }
};