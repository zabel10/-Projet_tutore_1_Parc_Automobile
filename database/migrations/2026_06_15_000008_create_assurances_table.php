<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assurances', function (Blueprint $table) {
            $table->bigIncrements('id_assurance');
            $table->unsignedBigInteger('id_vehicule');
            $table->string('compagnie', 100);
            $table->string('numero_contrat', 50)->unique();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('cout', 12, 2);
            $table->enum('type_assurance', ['tous_risques', 'tiers', 'tiers_plus'])->default('tous_risques');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_vehicule')
                  ->references('id_vehicule')
                  ->on('vehicules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->index(['date_debut', 'date_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assurances');
    }
};
