@echo off
REM Run Laravel scheduler every minute via Windows Task Scheduler.
REM Action: start this bat every 1 minute, or use:
REM   php artisan schedule:work
cd /d "%~dp0"
php artisan schedule:run
