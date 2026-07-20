<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {Schema::create('tags', function (Blueprint $table) {
    $table->id(); // clé primaire (id)
    $table->string('name'); // Nom du tag (ex: Développement, Design, PHP)
    $table->string('slug')->unique(); // Slug pour des URLs propres si besoin
    $table->timestamps();});}

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};