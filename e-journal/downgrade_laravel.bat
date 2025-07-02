@echo off
echo ========================================
echo    DOWNGRADE LARAVEL 12 to 10
echo ========================================
echo.

cd /d "c:\laragon\www\backend-1\e-journal"

echo 1. Backup Laravel 12 files...
if not exist "backup_laravel12" mkdir backup_laravel12
copy composer.lock backup_laravel12\ 2>nul
xcopy vendor backup_laravel12\vendor\ /E /I /Q 2>nul

echo.
echo 2. Remove Laravel 12 dependencies...
if exist vendor rmdir /S /Q vendor
if exist composer.lock del composer.lock

echo.
echo 3. Install Laravel 10...
echo Installing Laravel 10 dependencies...
composer install

echo.
echo 4. Clear all caches...
php artisan config:clear
php artisan route:clear  
php artisan view:clear
php artisan cache:clear

echo.
echo 5. Re-generate key if needed...
php artisan key:generate

echo.
echo ========================================
echo    DOWNGRADE COMPLETED!
echo ========================================
echo.
echo Laravel version sekarang:
php artisan --version
echo.
echo Silakan test di: http://localhost/backend-1/e-journal/public
echo.
pause
