<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->bigIncrements('id_conducteur');
            $table->unsignedBigInteger('id_utilisateur');
            $table->string('num_permis', 30)->unique();
            $table->date('date_expiration_permis');
            $table->enum('categorie_permis', ['A', 'B', 'C', 'D', 'BE', 'CE']);
            $table->date('date_naissance')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_utilisateur')
                  ->references('id')
                  ->on('utilisateurs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->index('date_expiration_permis');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conducteurs');
    }
};
