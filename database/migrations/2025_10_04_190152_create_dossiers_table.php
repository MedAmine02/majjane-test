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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique(); // Numéro de référence unique
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('type_procedure', ['civile', 'penale', 'commerciale', 'administrative', 'familiale']);
            $table->enum('statut', ['en_cours', 'cloture', 'suspendu'])->default('en_cours');
            $table->date('date_ouverture');
            $table->date('date_cloture')->nullable();
            
            // Relations
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Juriste responsable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
