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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->date('date_de_demande');
            $table->string('type_de_demande');
            $table->string('motif');
            $table->date('date_de_debut');  // date
            $table->date('date_de_fin');  // date
            $table->enum('status', ['accorde', 'rejete', 'encours'])->default('encours');
            $table->enum('action',['planifier','envoyer'])->default('envoyer');
            $table->foreignId('employe_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
