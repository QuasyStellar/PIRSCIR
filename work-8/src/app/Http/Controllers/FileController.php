<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    public function index() {
        $files = Storage::disk('public')->files('uploads');
        return view('files', compact('files'));
    }

    public function upload(Request $request) {
        $request->validate(['pdf_file' => 'required|mimes:pdf|max:5120']);
        $request->file('pdf_file')->storeAs('uploads', $request->file('pdf_file')->getClientOriginalName(), 'public');
        return redirect()->back()->with('success', session('language', 'ru') == 'ru' ? 'Файл загружен!' : 'File uploaded!');
    }

    public function download($name) {
        return Storage::disk('public')->download('uploads/' . $name);
    }

    public function delete($name) {
        Storage::disk('public')->delete('uploads/' . $name);
        return redirect()->back()->with('success', session('language', 'ru') == 'ru' ? 'Файл удален!' : 'File deleted!');
    }
}
