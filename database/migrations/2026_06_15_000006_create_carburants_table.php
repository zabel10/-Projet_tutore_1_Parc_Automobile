<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carburants', function (Blueprint $table) {
            $table->id('id_carburant');
            $table->foreignId('id_vehicule')
                ->constrained('vehicules', 'id_vehicule')
                ->onDelete('cascade');
            $table->foreignId('id_conducteur')
                ->constrained('conducteurs', 'id_conducteur')
                ->onDelete('restrict');
            $table->date('date_plein');
            $table->decimal('quantite_litres', 8, 2);
            $table->decimal('cout_total', 12, 2);
            $table->decimal('prix_litre', 8, 2);
            $table->unsignedInteger('kilometrage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carburants');
    }
};
