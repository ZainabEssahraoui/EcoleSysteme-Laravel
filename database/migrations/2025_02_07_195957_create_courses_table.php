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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre du cours
            $table->text('description'); 
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade'); // Clé étrangère vers la table modules
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table users (étudiant)
            $table->string('file_path'); // Chemin du fichier de support de cours
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};