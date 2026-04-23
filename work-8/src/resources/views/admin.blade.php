@php
    $theme = session('theme', 'light');
    $language = session('language', 'ru');
    $bg_color = ($theme === 'dark') ? '#333' : '#fff';
    $text_color = ($theme === 'dark') ? '#fff' : '#000';
@endphp
<!DOCTYPE html>
<html lang="{{ $language }}">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        body { background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px; }
        .form { border: 1px solid #ddd; padding: 15px; max-width: 400px; margin-bottom: 20px; background: rgba(255,255,255,0.1); }
        table { border-collapse: collapse; width: 100%; color: {{ $text_color }}; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        input, select, button { padding: 8px; margin: 5px 0; }
    </style>
</head>
<body>
    <h1>{{ $language == 'ru' ? 'Управление меню' : 'Admin Panel' }}</h1>
    
    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif

    <div class="form">
        <form action="/admin" method="POST">
            @csrf
            <input type="text" name="name" placeholder="{{ $language == 'ru' ? 'Название' : 'Name' }}" required><br>
            <input type="number" step="0.01" name="price" placeholder="{{ $language == 'ru' ? 'Цена' : 'Price' }}" required><br>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select><br>
            <button type="submit">{{ $language == 'ru' ? 'Добавить' : 'Add' }}</button>
        </form>
    </div>

    <table>
        <tr><th>ID</th><th>{{ $language == 'ru' ? 'Название' : 'Name' }}</th><th>{{ $language == 'ru' ? 'Цена' : 'Price' }}</th></tr>
        @foreach($dishes as $dish)
            <tr><td>{{ $dish->id }}</td><td>{{ $dish->name }}</td><td>{{ $dish->price }}$</td></tr>
        @endforeach
    </table>
    <br><a href="/" style="color: inherit;">{{ $language == 'ru' ? 'На главную' : 'Back' }}</a>
</body>
</html>
