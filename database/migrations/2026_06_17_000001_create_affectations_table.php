<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->bigIncrements('id_affectation');
            $table->unsignedBigInteger('id_vehicule');
            $table->unsignedBigInteger('id_conducteur');
            $table->unsignedBigInteger('id_mission')->nullable();
            $table->date('date_debut');
            $table->date('date_fin_prevue')->nullable();
            $table->date('date_fin_reelle')->nullable();
            $table->enum('statut', ['planifiee', 'en_cours', 'terminee', 'annulee'])->default('planifiee');
            $table->text('observations')->nullable();
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

            $table->foreign('id_mission')
                ->references('id_mission')
                ->on('missions')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->index(['date_debut', 'date_fin_prevue']);
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
