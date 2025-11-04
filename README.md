## Установка

Для полноценной работы необходим Task (https://taskfile.dev/)

Необходимо выполнить несколько действий для развертывания
1. Создать .env из .env.example

Выполнить следующие команды

2. task bcw(для Windows) или task bc(для Linux/macOS)
3. task up
4. task install_deps
5. task migrate
6. task seed

### Получение bearer token
Необходимо сделать post запрос и в теле запроса указать пользователя
```php
    {
        "email":"test@example.com",
        "password":"password"
    }
```

### Swagger
http://localhost/api/documentation#/

### Проверка и установка postgis для работы запросов по области:
```sql
    CREATE EXTENSION IF NOT EXISTS postgis;
```
