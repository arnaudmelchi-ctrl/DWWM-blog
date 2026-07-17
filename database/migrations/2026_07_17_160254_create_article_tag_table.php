<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('articles_tags', function (Blueprint $table) {
        // id_article fait référence à l'id de la table articles (avec suppression en cascade)[cite: 1]
        $table->foreignId('id_article')
              ->constrained('articles')
              ->onDelete('cascade');

        // id_tag fait référence à l'id de la table tags (avec suppression en cascade)[cite: 1]
        $table->foreignId('id_tag')
              ->constrained('tags')
              ->onDelete('cascade');

        // On définit la clé primaire composée sur les deux colonnes[cite: 1]
        $table->primary(['id_article', 'id_tag']);
    });
}
  public function down(): void{Schema::dropIfExists('articles_tags');}
};