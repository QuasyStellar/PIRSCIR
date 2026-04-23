@php
    $theme = session('theme', 'light');
    $language = session('language', 'ru');
    $bg_color = ($theme === 'dark') ? '#333' : '#fff';
    $text_color = ($theme === 'dark') ? '#fff' : '#000';
@endphp
<!DOCTYPE html>
<html lang="{{ $language }}">
<head><meta charset="UTF-8"><title>Files</title></head>
<body style="background: {{ $bg_color }}; color: {{ $text_color }}; font-family: sans-serif; padding: 20px;">
    <h1>{{ $language == 'ru' ? 'Управление файлами (PDF)' : 'File Management' }}</h1>
    
    @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif

    <form action="/files/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf_file" required>
        <button type="submit">{{ $language == 'ru' ? 'Загрузить' : 'Upload' }}</button>
    </form>

    <h3>{{ $language == 'ru' ? 'Список файлов' : 'File List' }}</h3>
    <ul>
        @foreach($files as $file)
            @php $name = basename($file); @endphp
            <li>
                {{ $name }} 
                (<a href="/files/download/{{ $name }}" style="color: {{ $text_color }}">Download</a> | 
                 <a href="/files/delete/{{ $name }}" style="color: red;">Delete</a>)
            </li>
        @endforeach
    </ul>
    <br><a href="/" style="color: {{ $text_color }}">{{ $language == 'ru' ? 'Назад' : 'Back' }}</a>
</body></html>
