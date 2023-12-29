# Приложение для дисплея логов SQL и Apache через React/XAMPP

Это приложение состоит из двух основных частей: frontend (React) и backend (XAMPP).

## Использование:

### Backend:

1. Установите XAMPP и запустите MySQL и Apache серверы.

2. Переместите папку 'backend' в папку 'htdocs'(там, где установлен XAMPP).

3. Поместите файлы логов Apache в папку 'apache' и SQL в папку 'sql'.

4. Откройте phpMyAdmin и создайте базу данных с именем 'aero' (если она еще не создана).

### Frontend:

1. Откройте командную строку и перейдите в папку 'frontend' с помощью `cd frontend`.

2. Установите все необходимые зависимости с помощью команды:

   `
   npm install
   `

3. Запустите фронтенд командой:

   `
   npm start
   `

Приложение должно запуститься в вашем браузере.

## Возможности приложения:

1. Чтобы просмотреть данные таблицы 'wp_s3cu_form_on_landing', нажмите 'Show WP_s3cu_form_on_landing'.

2. Чтобы просмотреть apache logs, нажмите 'Show Apache Logs'.

3. Для загрузки следующей страницы нажмите кнопку 'Load More'.
