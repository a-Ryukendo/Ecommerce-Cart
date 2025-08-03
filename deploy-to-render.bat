@echo off
echo ========================================
echo   Preparing Laravel ECommerce Cart
echo   for Render Deployment
echo ========================================
echo.

echo [1/6] Checking repository status...
git status
echo.

echo [2/6] Checking if all required files exist...
if exist composer.json (
    echo ✅ composer.json found
) else (
    echo ❌ composer.json not found
    pause
    exit /b 1
)

if exist composer.lock (
    echo ✅ composer.lock found
) else (
    echo ⚠️  composer.lock not found - run 'composer install' first
)

if exist README.md (
    echo ✅ README.md found
) else (
    echo ❌ README.md not found
)

if exist render.yaml (
    echo ✅ render.yaml found - Render will auto-configure!
) else (
    echo ❌ render.yaml not found
)

echo.
echo [3/6] Checking .env file is NOT in repository...
git ls-files | findstr .env >nul
if %errorlevel% equ 0 (
    echo ❌ .env file is tracked in Git - remove it!
    echo Run: git rm --cached .env
    pause
    exit /b 1
) else (
    echo ✅ .env file is properly ignored
)

echo.
echo [4/6] Checking vendor directory is ignored...
git ls-files | findstr vendor >nul
if %errorlevel% equ 0 (
    echo ❌ vendor directory is tracked in Git - remove it!
    echo Run: git rm -r --cached vendor
    pause
    exit /b 1
) else (
    echo ✅ vendor directory is properly ignored
)

echo.
echo [5/6] Checking for uncommitted changes...
git diff --quiet
if %errorlevel% neq 0 (
    echo ⚠️  You have uncommitted changes
    echo Consider committing them before deployment
    echo.
    git status --porcelain
    echo.
) else (
    echo ✅ All changes are committed
)

echo.
echo [6/6] Repository is ready for Render deployment!
echo.
echo Next steps:
echo 1. Push to GitHub: git push origin main
echo 2. Go to render.com and sign up
echo 3. Connect your GitHub account
echo 4. Create new Web Service
echo 5. Select your repository
echo 6. Render will auto-detect PHP/Laravel
echo 7. Deploy!
echo.
echo NOTE: Render will use render.yaml for configuration
echo No manual environment variable setup needed!
echo.
echo See RENDER_DEPLOYMENT.md for detailed instructions.
echo.
pause
