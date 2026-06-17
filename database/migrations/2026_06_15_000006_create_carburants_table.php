<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carburants', function (Blueprint $table) {
            $table->bigIncrements('id_carburant');
            $table->unsignedBigInteger('id_vehicule');
            $table->unsignedBigInteger('id_conducteur');
            $table->date('date_plein');
            $table->decimal('quantite_litres', 8, 2);
            $table->decimal('cout_total', 12, 2);
            $table->decimal('prix_litre', 8, 2);
            $table->unsignedInteger('kilometrage');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_vehicule')
                  ->references('id_vehicule')
                  ->on('vehicules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_conducteur')
                  ->references('id_conducteur')
                  ->on('conducteurs')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->index('date_plein');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carburants');
    }
};
