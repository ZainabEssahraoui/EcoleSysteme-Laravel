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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('prof_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade'); // Clé étrangère vers la table module
            $table->decimal('grade', 5, 2); // Note de l'étudiant (ex: 15.50)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
