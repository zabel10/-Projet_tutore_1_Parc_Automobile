<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id_document');
            $table->unsignedBigInteger('id_conducteur');
            $table->unsignedBigInteger('id_vehicule')->nullable();
            $table->unsignedBigInteger('id_utilisateur')->nullable();
            $table->enum('type_document', ['permis', 'carte_grise', 'assurance', 'visite_technique', 'autre'])->default('autre');
            $table->string('numero_document', 80)->nullable();
            $table->string('fichier_path', 255)->nullable();
            $table->date('date_expiration')->nullable();
            $table->enum('statut', ['actif', 'expire', 'en_attente_validation'])->default('actif');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_conducteur')
                ->references('id_conducteur')
                ->on('conducteurs')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_vehicule')
                ->references('id_vehicule')
                ->on('vehicules')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('id_utilisateur')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->index(['type_document', 'statut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
