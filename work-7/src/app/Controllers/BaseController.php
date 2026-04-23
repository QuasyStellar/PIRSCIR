<?php
namespace App\Controllers;

class BaseController {
    protected $language;
    protected $bg_color;
    protected $text_color;
    protected $theme;
    protected $user_login;
    protected $labels;

    public function __construct() {
        $this->initPersonalization();
    }

    private function initPersonalization() {
        $user_login = $_COOKIE['user_login'] ?? 'Guest';
        $theme = $_COOKIE['theme'] ?? 'light';
        $language = $_COOKIE['language'] ?? 'ru';
        
        $this->user_login = $user_login;
        $this->theme = $theme;
        $this->language = $language;
        $this->bg_color = ($theme === 'dark') ? '#333' : '#fff';
        $this->text_color = ($theme === 'dark') ? '#fff' : '#000';

        $this->labels = [
            'ru' => [
                'title' => 'Настройки',
                'login' => 'Логин',
                'theme' => 'Тема',
                'theme_light' => 'Светлая',
                'theme_dark' => 'Темная',
                'lang' => 'Язык',
                'save' => 'Сохранить',
                'cancel' => 'Отмена'
            ],
            'en' => [
                'title' => 'Settings',
                'login' => 'Login',
                'theme' => 'Theme',
                'theme_light' => 'Light',
                'theme_dark' => 'Dark',
                'lang' => 'Language',
                'save' => 'Save',
                'cancel' => 'Cancel'
            ]
        ];
    }

    protected function render($view, $data = []) {
        // Extract data to make it available as variables in the view
        extract($data);
        
        // Make common variables available
        $language = $this->language;
        $bg_color = $this->bg_color;
        $text_color = $this->text_color;
        $theme = $this->theme;
        $user_login = $this->user_login;
        $l = $this->labels[$language] ?? $this->labels['en'];

        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view not found at $viewPath");
        }
    }
}
