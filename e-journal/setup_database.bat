@echo off
echo ========================================
echo    SETUP DATABASE E-JOURNAL
echo ========================================
echo.

cd /d "c:\laragon\www\backend-1\e-journal"

echo 1. Creating database if not exists...
echo Creating database 'e_journal' in MySQL...

echo 2. Running migrations...
php artisan migrate --force

echo.
echo 3. Seeding database with sample data...
php artisan db:seed --force

echo.
echo 4. Creating storage link...
php artisan storage:link

echo.
echo 5. Clearing caches...
php artisan config:clear
php artisan route:clear
php artisan cache:clear

echo.
echo ========================================
echo    DATABASE SETUP COMPLETED!
echo ========================================
echo.
echo Database: e_journal
echo Host: 127.0.0.1:3306
echo Username: root
echo Password: (empty)
echo.
echo Test API: http://localhost/backend-1/e-journal/public/api/test
echo Demo: http://localhost/backend-1/e-journal/public/demo
echo.
pause
