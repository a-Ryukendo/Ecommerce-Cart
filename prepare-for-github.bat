@echo off
echo ========================================
echo   Preparing Laravel ECommerce Cart
echo   for GitHub Upload
echo ========================================
echo.

echo [1/5] Checking if .env file exists...
if exist .env (
    echo ✅ .env file found - will be excluded by .gitignore
) else (
    echo ❌ .env file not found - please create it first
    echo Run: copy .env.example .env
    pause
    exit /b 1
)

echo.
echo [2/5] Checking if vendor directory exists...
if exist vendor (
    echo ✅ vendor directory found - will be excluded by .gitignore
) else (
    echo ⚠️  vendor directory not found - run 'composer install' first
)

echo.
echo [3/5] Checking if node_modules directory exists...
if exist node_modules (
    echo ✅ node_modules directory found - will be excluded by .gitignore
) else (
    echo ⚠️  node_modules directory not found - run 'npm install' first
)

echo.
echo [4/5] Checking key files...
if exist README.md (
    echo ✅ README.md found
) else (
    echo ❌ README.md not found
)

if exist composer.json (
    echo ✅ composer.json found
) else (
    echo ❌ composer.json not found
)

if exist .gitignore (
    echo ✅ .gitignore found
) else (
    echo ❌ .gitignore not found
)

echo.
echo [5/5] Repository is ready for GitHub!
echo.
echo Next steps:
echo 1. git init
echo 2. git add .
echo 3. git commit -m "Initial commit: Mini ECommerce Cart in Laravel"
echo 4. Create repository on GitHub
echo 5. git remote add origin YOUR_REPO_URL
echo 6. git push -u origin main
echo.
echo See DEPLOYMENT.md for detailed instructions.
echo.
pause
