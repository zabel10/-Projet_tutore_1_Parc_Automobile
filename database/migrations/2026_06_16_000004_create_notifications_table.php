<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id_notification');
            $table->unsignedBigInteger('id_utilisateur')->nullable();
            $table->unsignedBigInteger('id_conducteur')->nullable();
            $table->unsignedBigInteger('id_vehicule')->nullable();
            $table->enum('type_notification', ['info', 'alerte', 'maintenance', 'ravitaillement', 'bon_sortie', 'demande'])->default('info');
            $table->string('titre', 120);
            $table->text('message');
            $table->boolean('lu')->default(false);
            $table->dateTime('date_notification');
            $table->string('lien_url', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_utilisateur')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_conducteur')
                ->references('id_conducteur')
                ->on('conducteurs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_vehicule')
                ->references('id_vehicule')
                ->on('vehicules')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['date_notification', 'lu']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
