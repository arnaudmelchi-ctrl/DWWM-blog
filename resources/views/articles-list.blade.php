<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Articles List !</h1>

    @foreach ($articles as $article)
        <div>
            <h2>{{ $article->title }}</h2>
            <p>{{ $article->content }}</p>
        </div>
        
    @endforeach
</body>
</html>