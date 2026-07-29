{{-- resources/views/components/article-card.blade.php --}}
@props(['article'])

<style>
    .article-card {
        border: 1px solid #e5e7eb;
        padding: 24px;
        margin-bottom: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
    }

    .article-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .article-meta {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .category-badge {
        font-weight: 600;
        color: #1e40af;
    }

    .tag-item {
        background-color: #f3f4f6;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.75rem;
        color: #4b5563;
    }

    .status-badge {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 9999px;
        text-transform: uppercase;
    }

    .status-published {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-draft {
        background-color: #fef3c7;
        color: #92400e;
    }

    .article-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #111827;
        margin: 8px 0;
    }

    .article-excerpt {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .read-more {
        display: inline-block;
        margin-top: 12px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
    }

    .read-more:hover {
        text-decoration: underline;
    }
</style>

<div class="article-card">
    <div class="article-header">
        <div class="article-meta">
            @if($article->category)
                <span class="category-badge">[{{ $article->category->name }}]</span>
            @endif
            
            {{-- Boucle pour afficher les tags de l'article --}}
            @foreach($article->tags as $tag)
                <span class="tag-item">#{{ $tag->name }}</span>
            @endforeach
        </div>
        
        <span class="article-date">{{ $article->created_at?->format('d M. Y') }}</span>
    </div>
    
    <h2 class="article-title">{{ $article->title }}</h2>
    
    <p class="article-excerpt">{{ Str::limit($article->content, 150) }}</p>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
        <a href="{{ route('articles.show', $article->slug) }}" class="read-more">Lire →</a>
        
        {{-- Vérification du statut (insensible à la casse) --}}
        @if(strtolower($article->status) === 'published')
            <span class="status-badge status-published">Publié</span>
        @else
            <span class="status-badge status-draft">Brouillon</span>
        @endif
    </div>
</div>