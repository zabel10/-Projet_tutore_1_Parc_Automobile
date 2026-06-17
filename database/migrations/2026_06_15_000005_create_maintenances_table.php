<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->bigIncrements('id_maintenance');
            $table->unsignedBigInteger('id_vehicule');
            $table->enum('type_maintenance', ['vidange', 'revision_complete', 'reparation', 'controle_technique', 'autre']);
            $table->date('date_maintenance');
            $table->decimal('cout', 12, 2);
            $table->text('description')->nullable();
            $table->string('prestataire', 100)->nullable();
            $table->unsignedInteger('km_au_moment');
            $table->date('prochaine_echeance')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_vehicule')
                  ->references('id_vehicule')
                  ->on('vehicules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->index('date_maintenance');
            $table->index('prochaine_echeance');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
