@php
    $theme = session('theme', 'light');
    $language = session('language', 'ru');
    $bg_color = ($theme === 'dark') ? '#333' : '#fff';
    $text_color = ($theme === 'dark') ? '#fff' : '#000';
@endphp
<!DOCTYPE html>
<html lang="{{ $language }}">
<head><meta charset="UTF-8"><title>About</title></head>
<body style="background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px;">
    <h1>{{ ($language=='ru'?'О нашем ресторане':'About Our Restaurant') }}</h1>
    <p>{{ ($language=='ru'?'Мы готовим с любовью с 1998 года.':'Cooking with love since 1998.') }}</p>
    <a href="/" style="color: {{ $text_color }}">{{ ($language=='ru'?'Назад':'Back') }}</a>
</body></html>
