{{-- resources/views/components/article-card.blade.php --}}
<style>
.articles-container {
        max-width: 800px;
        margin: 20px auto; /* Centre la liste */
    }

    .article-card {
        border: 1px solid #ccc; /* La bordure grise */
        padding: 20px;          /* Espace intérieur */
        margin-bottom: 20px;    /* Espace entre les rectangles */
        border-radius: 8px;     /* Coins arrondis */
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Petite ombre sympa */
    }

    .article-header {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #888;
        margin-bottom: 10px;
    }

    .read-more {
        display: inline-block;
        margin-top: 10px;
        color: blue;
        text-decoration: none;
    }
    </style>
@props(['article'])

<div class="article-card">
    <div class="article-header">
        <span>[ {{ $article->category->name }} ] [ Tag 1 ]</span>
        <span>{{ $article->created_at->format('d M. Y') }}</span>
    </div>
    
    <h3>{{ $article->title }}</h3>
    <p>{{ Str::limit($article->excerpt, 150) }}</p>
    
    <a href="#" class="read-more">Lire →</a>
</div>

<div class="article-card">
                <div class="article-header">
                    <span class="article-tags">[ {{ $article->category->name }} ] [ Tag 1 ]</span>
                    <span class="article-date">{{ $article->created_at->format('d M. Y') }}</span>
                </div>

                <h2>{{ $article->title }}</h2>

                <p class="article-excerpt">{{ $article->content }}</p>

                <div class="article-footer">
                    <a href="{{ route('articles.show', $article->id) }}" class="read-more">Lire →</a>
                </div>
            </div>