@echo off
echo Sedang Menjalankan Laravel... Tunggu
start php -S localhost:8000 -t public
timeout /t 5
echo Sedang Membuka browser... Tunggu
start http://localhost:8000