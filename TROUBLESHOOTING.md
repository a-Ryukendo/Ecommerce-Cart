# 🔧 Troubleshooting Guide

## HTTP 500 Error Solutions

### 1. Check Application Logs
- Go to your Render dashboard
- Click on your service
- Go to "Logs" tab
- Look for error messages

### 2. Test Health Check Endpoint
After deployment, try accessing:
```
https://your-app-name.onrender.com/health
```
This should return a JSON response if the app is working.

### 3. Common Issues and Solutions

#### Issue: Application Key Error
**Solution:** The APP_KEY is already set in render.yaml, but if you still get key errors:
```bash
# In your local project
php artisan key:generate --show
# Copy the key and update APP_KEY in Render environment variables
```

#### Issue: Storage Permissions
**Solution:** The Dockerfile now sets proper permissions, but if needed:
```bash
# In the container
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

#### Issue: Session Storage
**Solution:** Ensure these directories exist:
```bash
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
```

#### Issue: Database Connection
**Solution:** The app uses SQLite for sessions, but if you get database errors:
```bash
# Create SQLite database
touch database/database.sqlite
chmod 666 database/database.sqlite
```

### 4. Debug Steps

1. **Check if app is starting:**
   - Look for "Detected a new open port HTTP:8000" in logs
   - This means the container is running

2. **Check Laravel logs:**
   - The startup script clears caches
   - Look for any Laravel-specific errors

3. **Test locally with Docker:**
   ```bash
   docker build -t laravel-cart .
   docker run -p 8000:8000 laravel-cart
   ```

4. **Check environment variables:**
   - Ensure all variables in render.yaml are set
   - Verify APP_URL matches your Render URL

### 5. Manual Debug Commands

If you can access the container:
```bash
# Check PHP version
php --version

# Check Laravel installation
php artisan --version

# Check storage permissions
ls -la storage/

# Check if sessions directory exists
ls -la storage/framework/sessions/
```

### 6. Quick Fixes

#### If the app still doesn't work:
1. **Redeploy with manual deploy** in Render dashboard
2. **Check the logs** immediately after deployment
3. **Try the health endpoint** first: `/health`
4. **Then try the main page:** `/`

#### If you see "This page isn't working":
1. **Wait 1-2 minutes** after deployment
2. **Check if the container is healthy** in Render dashboard
3. **Look for any error messages** in the logs
4. **Try accessing the health endpoint** to isolate the issue

### 7. Environment Variables Checklist

Make sure these are set in Render:
- ✅ `APP_NAME=Laravel`
- ✅ `APP_ENV=production`
- ✅ `APP_KEY=base64:Ho+ZlL1ca2ws5/WF6CbYEstv7QkGZcb2se8hk/u539M=`
- ✅ `APP_DEBUG=false`
- ✅ `SESSION_DRIVER=file`
- ✅ `PORT=8000`

### 8. Contact Support

If the issue persists:
1. **Share the Render logs** with the error
2. **Try the health endpoint** and share the response
3. **Check if the container is building successfully**

---

**Most common solution:** The startup script should fix most issues automatically! 🚀 