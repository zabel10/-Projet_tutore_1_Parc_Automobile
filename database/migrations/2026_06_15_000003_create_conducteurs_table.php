<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id('id_conducteur');
            $table->foreignId('id_utilisateur')
                ->constrained('utilisateurs')
                ->onDelete('cascade');
            $table->string('num_permis', 30)->unique();
            $table->date('date_expiration_permis');
            $table->enum('categorie_permis', ['A', 'B', 'C', 'D', 'BE', 'CE']);
            $table->date('date_naissance')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conducteurs');
    }
};
