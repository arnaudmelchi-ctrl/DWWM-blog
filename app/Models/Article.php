<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model 
{
    protected $table = 'articles';
    
    // Ajout indispensable pour autoriser la création d'articles via le formulaire
    protected $fillable = ['title', 'slug', 'content', 'status', 'id_category'];

    public function category(): BelongsTo
    {
        // Si ta colonne en BDD s'appelle category_id, laisse comme ça. 
        // Si elle s'appelle id_category, change pour : return $this->belongsTo(Category::class, 'id_category');
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        // Même logique : configuré pour la colonne 'user_id'
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les tags (Many-to-Many) configurée sur ta table personnalisée
     */
    public function tags(): BelongsToMany
    {
        // On force Laravel à utiliser ta table et tes clés personnalisées
        return $this->belongsToMany(Tag::class, 'articles_tags', 'id_article', 'id_tag');
    }
}