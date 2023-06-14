<!-- resources/views/berita.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Berita</title>
</head>
<body>
    <div style="text-align: center">
        <h1>List news</h1>
    </div>
    

    <ul>
        @foreach ($sentiments as $article)
            <li>
                <h2>{{ $article['title'] }}</h2>
                <p>{{ $article['description']}}</p>
                <p>Sentiment Score = {{$article['score']}}</p>
                <a href="{{ $article['url'] }}">Read More</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
