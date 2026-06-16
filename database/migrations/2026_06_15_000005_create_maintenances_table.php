<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('id_maintenance');
            $table->foreignId('id_vehicule')
                ->constrained('vehicules', 'id_vehicule')
                ->onDelete('cascade');
            $table->enum('type_maintenance', [
                'vidange', 'revision_complete', 'reparation', 'controle_technique', 'autre'
            ]);
            $table->date('date_maintenance');
            $table->decimal('cout', 12, 2);
            $table->text('description')->nullable();
            $table->string('prestataire', 100)->nullable();
            $table->unsignedInteger('km_au_moment');
            $table->date('prochaine_echeance')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
