<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->bigIncrements('id_alerte');
            $table->unsignedBigInteger('id_vehicule')->nullable();
            $table->enum('type_alerte', ['revision', 'assurance', 'visite_technique', 'permis', 'autre']);
            $table->string('message', 255);
            $table->date('date_echeance');
            $table->enum('statut', ['active', 'resolue', 'ignoree'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_vehicule')
                  ->references('id_vehicule')
                  ->on('vehicules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->index('statut');
            $table->index('date_echeance');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertes');
    }
};
