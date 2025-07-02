@echo off
echo Installing Laravel dependencies...
cd /d "c:\laragon\www\backend-1\e-journal"

REM Try different Laragon composer paths
if exist "c:\laragon\bin\composer\composer.bat" (
    echo Using composer.bat...
    c:\laragon\bin\composer\composer.bat install
    goto :end
)

if exist "c:\laragon\bin\composer\composer.phar" (
    echo Using composer.phar with PHP...
    c:\laragon\bin\php\php.exe c:\laragon\bin\composer\composer.phar install
    goto :end
)

if exist "c:\laragon\bin\composer\composer" (
    echo Using composer directly...
    c:\laragon\bin\composer\composer install
    goto :end
)

REM Try using PATH
echo Trying composer from PATH...
composer install

:end
echo Done!
pause
