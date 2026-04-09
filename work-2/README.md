# Практическая работа №2 - Основы PHP

Этот проект состоит из трех независимых PHP сервисов, запущенных через Docker Compose.

## Структура проекта

- **task-1-drawer/**: Сервис для рисования SVG фигур.
- **task-2-sorting/**: Сервис сортировки массива чисел алгоритмом Quick Sort.
- **task-3-server-info/**: Страница с информацией о сервере (используя команды Unix).

## Запуск

1. Перейдите в папку `work-2`.
2. Выполните команду: `docker compose up -d`
3. Откройте главную страницу: http://localhost:8082/index.php

## Ссылки на задания

- **Главная:** http://localhost:8082/index.php
- **Задание 1 (Рисование):** http://localhost:8082/task-1-drawer/drawer.php?num=2
- **Задание 2 (Сортировка):** http://localhost:8082/task-2-sorting/index.php?array=5,2,8,1,9,4
- **Задание 3 (Информация):** http://localhost:8082/task-3-server-info/index.php
