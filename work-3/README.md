# Практические работы №3 и №4 (Вариант 7: Ресторан)

Комплексная серверная конфигурация: Nginx (прокси) + Apache (PHP) + MySQL.

## Структура (Работа №3)
- **Nginx (порт 8083)**: Слушает внешние запросы. Отдает статические файлы напрямую и проксирует PHP на Apache.
- **Apache**: Обрабатывает динамический контент. Корневая папка изменена на `/app`.
- **MySQL**: Хранит данные меню и пользователей.

### Страницы
- **Главная:** [http://localhost:8083/index.php](http://localhost:8083/index.php)
- **Статика (О нас):** [http://localhost:8083/static1.html](http://localhost:8083/static1.html)
- **Динамика (Меню):** [http://localhost:8083/dynamic1.php](http://localhost:8083/dynamic1.php)
- **Админка (с авторизацией в БД):** [http://localhost:8083/dynamic2.php](http://localhost:8083/dynamic2.php)
  - Логин: `admin`
  - Пароль: `admin`

## REST API (Работа №4)
API реализовано в файле `api.php` и поддерживает CRUD операции для сущностей `categories` и `dishes`.

### Примеры запросов (через Postman или cURL)

#### Получение списка блюд:
`GET http://localhost:8083/api.php?entity=dishes`

#### Добавление нового блюда:
- **Метод:** `POST`
- **URL:** `http://localhost:8083/api.php?entity=dishes`
- **Тело (JSON):**
```json
{
    "category_id": 1,
    "name": "Солянка",
    "price": 7.50
}
```

#### Обновление блюда:
- **Метод:** `PUT`
- **URL:** `http://localhost:8083/api.php?entity=dishes&id=1`
- **Тело (JSON):**
```json
{
    "category_id": 1,
    "name": "Борщ классический",
    "price": 5.50
}
```

#### Удаление блюда:
- **Метод:** `DELETE`
- **URL:** `http://localhost:8083/api.php?entity=dishes&id=1`
