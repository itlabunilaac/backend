@echo off
echo Setting up Laravel project...
cd /d "c:\laragon\www\backend-1\e-journal"

REM Add Laragon paths to current session
set PATH=c:\laragon\bin\composer;c:\laragon\bin\php;%PATH%

echo Installing Composer dependencies...
composer install --no-dev --optimize-autoloader

echo Generating application key...
php artisan key:generate

echo Setup completed!
pause
