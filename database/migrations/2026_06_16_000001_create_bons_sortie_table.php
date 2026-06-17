<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bons_sortie', function (Blueprint $table) {
            $table->bigIncrements('id_bon_sortie');
            $table->unsignedBigInteger('id_mission')->nullable();
            $table->unsignedBigInteger('id_vehicule');
            $table->unsignedBigInteger('id_conducteur');
            $table->unsignedBigInteger('id_utilisateur');
            $table->string('numero', 40)->unique();
            $table->string('destination', 100);
            $table->dateTime('date_sortie');
            $table->dateTime('date_retour_prevue');
            $table->dateTime('date_retour_reelle')->nullable();
            $table->unsignedInteger('km_depart');
            $table->unsignedInteger('km_retour')->nullable();
            $table->string('motif', 255);
            $table->enum('statut', ['brouillon', 'valide', 'en_cours', 'cloture', 'annule'])->default('valide');
            $table->text('observations')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_mission')
                ->references('id_mission')
                ->on('missions')
                ->onDelete('set null')
                ->onUpdate('cascade');

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

            $table->index(['date_sortie', 'statut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bons_sortie');
    }
};
