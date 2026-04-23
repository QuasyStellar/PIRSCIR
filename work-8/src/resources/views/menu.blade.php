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
    <title>Menu</title>
    <style>
        body { background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; color: {{ $text_color }}; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>{{ $language == 'ru' ? 'Меню ресторана' : 'Restaurant Menu' }}</h1>
    <table>
        <tr>
            <th>{{ $language == 'ru' ? 'Категория' : 'Category' }}</th>
            <th>{{ $language == 'ru' ? 'Название' : 'Name' }}</th>
            <th>{{ $language == 'ru' ? 'Цена' : 'Price' }}</th>
        </tr>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{ $dish->category->name ?? '---' }}</td>
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->price }}$</td>
            </tr>
        @endforeach
    </table>
    <br><a href="/" style="color: inherit;">{{ $language == 'ru' ? 'Назад' : 'Back' }}</a>
</body>
</html>
