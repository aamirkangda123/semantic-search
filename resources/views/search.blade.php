<!DOCTYPE html>
<html>
<head>
    <title>Semantic Search</title>
</head>
<body>
    <h1>Semantic Keyword Search</h1>
    <form method="POST" action="/search">
        @csrf
        <input type="text" name="q" value="{{ old('q', $query ?? '') }}" placeholder="Search something...">
        <button type="submit">Search</button>
    </form>

    @if(isset($result))
        <h3>Best Match (Score: {{ $score }}):</h3>
        <p><strong>Keyword:</strong> {{ $result->keyword }}</p>
        <p><strong>Category:</strong> {{ $result->category }}</p>
        <p><strong>Subcategory:</strong> {{ $result->subcategory }}</p>
    @elseif(isset($query))
        <p>No results found for: <em>{{ $query }}</em></p>
    @endif
</body>
</html>
