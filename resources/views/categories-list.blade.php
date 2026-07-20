<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Articles</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->articles->count() }}</td>
            <td>{{ $category->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}">
                    ✏️ </a>
                
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="border:none; background:none; cursor:pointer;">
                        ❌ </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>