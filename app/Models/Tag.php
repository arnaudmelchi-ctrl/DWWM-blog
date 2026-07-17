<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    // On autorise le remplissage de "name" et "slug" en masse
    protected $fillable = ['name', 'slug'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'articles_tags', 'id_tag', 'id_article');
    }
}