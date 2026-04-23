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
    <title>Restaurant - Laravel Edition</title>
    <style>
        body { background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px; }
        .section { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .btn { display: inline-block; padding: 10px 20px; border: 1px solid #ccc; text-decoration: none; color: inherit; border-radius: 4px; background: rgba(0,0,0,0.05); margin: 5px; }
        .charts { display: flex; flex-wrap: wrap; gap: 20px; }
        .chart-box { text-align: center; } img { border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>{{ $language == 'ru' ? 'Ресторан (Работа №8 - Laravel)' : 'Restaurant (Work 8 - Laravel)' }}</h1>
    <p>{{ $language == 'ru' ? 'Добро пожаловать, ' : 'Welcome, ' }} {{ session('user_login', 'Guest') }}!</p>

    <div class="section">
        <h3>{{ $language == 'ru' ? 'Разделы' : 'Sections' }}</h3>
        <a href="/menu" class="btn">→ {{ $language == 'ru' ? 'Меню' : 'Menu' }}</a>
        <a href="/admin" class="btn">→ {{ $language == 'ru' ? 'Админка' : 'Admin' }}</a>
        <a href="/fixtures" class="btn" style="background: #ffc107; color: black;">⚡ {{ $language == 'ru' ? 'Генерировать данные' : 'Generate Data' }}</a>
        <a href="/api/dishes" class="btn" target="_blank">→ JSON API</a>
    </div>

    <div class="section">
        <h3>{{ $language == 'ru' ? 'Статистика (JpGraph)' : 'Statistics' }}</h3>
        <div class="charts">
            <div class="chart-box"><h4>{{ $language == 'ru' ? 'Рейтинги' : 'Ratings' }}</h4><img src="/charts/pie" width="300"></div>
            <div class="chart-box"><h4>{{ $language == 'ru' ? 'Цены' : 'Prices' }}</h4><img src="/charts/line" width="300"></div>
            <div class="chart-box"><h4>{{ $language == 'ru' ? 'Категории' : 'Categories' }}</h4><img src="/charts/bar" width="300"></div>
        </div>
    </div>

    <div class="section">
        <a href="/about" class="btn">{{ $language == 'ru' ? 'О нас' : 'About' }}</a>
        <a href="/contacts" class="btn">{{ $language == 'ru' ? 'Контакты' : 'Contacts' }}</a>
        <a href="/files" class="btn">{{ $language == 'ru' ? 'Файлы' : 'Files' }}</a>
        <a href="/settings" class="btn">{{ $language == 'ru' ? 'Настройки' : 'Settings' }}</a>
    </div>
</body>
</html>
