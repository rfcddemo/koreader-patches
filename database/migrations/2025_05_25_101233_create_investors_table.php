<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->enum('categorie', ['Institutionnel', 'Analyste', 'Particulier', 'Fonds', 'Banque'])->default('Institutionnel');
            $table->string('pays');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('organisation');
            $table->string('fonction')->nullable();
            $table->enum('langue_preferee', ['Français', 'Anglais', 'Arabe'])->default('Français');
            $table->text('remarques')->nullable();
            $table->timestamp('derniere_interaction')->nullable();
            $table->timestamps();

            // Index pour améliorer les performances de recherche
            $table->index(['nom_complet', 'email', 'organisation']);
            $table->index('categorie');
            $table->index('pays');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
