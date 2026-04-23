@php
    $theme = session('theme', 'light');
    $language = session('language', 'ru');
    $bg_color = ($theme === 'dark') ? '#333' : '#fff';
    $text_color = ($theme === 'dark') ? '#fff' : '#000';
@endphp
<!DOCTYPE html>
<html lang="{{ $language }}">
<head><meta charset="UTF-8"><title>Settings</title></head>
<body style="background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px;">
    <h1>{{ $language == 'ru' ? 'Настройки' : 'Settings' }}</h1>
    <form action="/settings" method="POST">
        @csrf
        {{ $language == 'ru' ? 'Логин' : 'Login' }}: 
        <input type="text" name="login" value="{{ session('user_login', 'Guest') }}"><br><br>
        
        {{ $language == 'ru' ? 'Тема' : 'Theme' }}: 
        <select name="theme">
            <option value="light" {{ $theme=='light'?'selected':'' }}>{{ $language == 'ru' ? 'Светлая' : 'Light' }}</option>
            <option value="dark" {{ $theme=='dark'?'selected':'' }}>{{ $language == 'ru' ? 'Темная' : 'Dark' }}</option>
        </select><br><br>
        
        {{ $language == 'ru' ? 'Язык' : 'Language' }}: 
        <select name="language">
            <option value="ru" {{ $language=='ru'?'selected':'' }}>RU</option>
            <option value="en" {{ $language=='en'?'selected':'' }}>EN</option>
        </select><br><br>
        
        <button type="submit">{{ $language == 'ru' ? 'Сохранить' : 'Save' }}</button>
    </form>
    <br><a href="/" style="color: {{ $text_color }}">{{ $language == 'ru' ? 'Назад' : 'Back' }}</a>
</body>
</html>
