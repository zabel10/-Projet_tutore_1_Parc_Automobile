<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id_mission');
            $table->unsignedBigInteger('id_vehicule');
            $table->unsignedBigInteger('id_conducteur');
            $table->unsignedBigInteger('id_utilisateur');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->string('destination', 100);
            $table->string('motif', 255);
            $table->enum('statut', ['planifiee', 'en_cours', 'terminee', 'annulee'])->default('planifiee');
            $table->unsignedInteger('km_depart');
            $table->unsignedInteger('km_retour')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_vehicule')
                  ->references('id_vehicule')
                  ->on('vehicules')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_conducteur')
                  ->references('id_conducteur')
                  ->on('conducteurs')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_utilisateur')
                  ->references('id')
                  ->on('utilisateurs')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->index(['date_depart', 'date_retour']);
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
