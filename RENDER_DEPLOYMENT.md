# 🚀 Render Deployment Guide

## 📋 Prerequisites

- GitHub repository with your Laravel project
- Render account (free tier available)
- Git knowledge

## 🔧 Render Deployment Steps

### 1. Prepare Your Repository

Make sure your repository is ready:
```bash
# Your repository should be on GitHub with:
# - All Laravel files
# - Proper .gitignore
# - README.md
# - composer.json and composer.lock
```

### 2. Create Render Account

1. Go to [render.com](https://render.com)
2. Sign up with GitHub account
3. Connect your GitHub account

### 3. Create New Web Service

1. **Click "New +"** in Render dashboard
2. **Select "Web Service"**
3. **Connect your GitHub repository:**
   - Choose your `laravel-ecommerce-cart` repository
   - Render will auto-detect it's a PHP/Laravel application

### 4. Configure Web Service

**Basic Settings:**
- **Name:** `laravel-ecommerce-cart` (or your preferred name)
- **Environment:** `Docker` (Render will auto-detect PHP)
- **Region:** Choose closest to your users
- **Branch:** `main` (or your default branch)
- **Root Directory:** Leave empty (if repo is at root)

**Build Settings:**
- **Build Command:** `composer install --no-dev --optimize-autoloader`
- **Start Command:** `php artisan serve --host 0.0.0.0 --port $PORT`

**Environment Variables:**
Add these environment variables in Render dashboard:

```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=sqlite
DB_DATABASE=/opt/render/project/src/database/database.sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false

CACHE_STORE=file
QUEUE_CONNECTION=sync

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
```

### 5. Alternative: Use render.yaml (Recommended)

Instead of manual configuration, you can use the `render.yaml` file in your repository:

1. **Make sure `render.yaml` exists** in your repository root
2. **Render will automatically detect** and use the configuration
3. **No manual environment variable setup** needed

### 6. Generate Application Key

**Option 1: Generate locally and add to Render**
```bash
# In your local project
php artisan key:generate --show
# Copy the generated key and add to APP_KEY in Render
```

**Option 2: Use a default key**
```
APP_KEY=base64:Ho+ZlL1ca2ws5/WF6CbYEstv7QkGZcb2se8hk/u539M=
```

### 7. Deploy

1. **Click "Create Web Service"**
2. **Wait for deployment** (usually 2-5 minutes)
3. **Check deployment logs** for any errors

### 8. Post-Deployment Setup

After successful deployment:

1. **Access your app:** `https://your-app-name.onrender.com`
2. **Test all functionality:**
   - View products
   - Add to cart
   - View cart
   - Update quantities
   - Remove items
   - Clear cart
   - Checkout

## 🔧 Advanced Configuration

### Custom Domain (Optional)

1. **Add custom domain** in Render dashboard
2. **Update APP_URL** environment variable
3. **Configure DNS** with your domain provider

### Environment-Specific Settings

**For Production:**
```
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

**For Development:**
```
APP_ENV=local
APP_DEBUG=true
LOG_LEVEL=debug
```

## 🛠️ Troubleshooting

### Common Issues:

**1. Build Fails**
- Check if `composer.json` exists
- Verify PHP version compatibility
- Check build logs for errors

**2. Application Key Error**
- Generate new key: `php artisan key:generate --show`
- Update `APP_KEY` in Render environment variables

**3. Session Issues**
- Ensure `SESSION_DRIVER=file` is set
- Check storage permissions

**4. 500 Error**
- Check application logs in Render dashboard
- Verify all environment variables are set
- Ensure `.env` file is not uploaded to Git

### Debug Commands:

**Check Render logs:**
- Go to your service in Render dashboard
- Click "Logs" tab
- Check for error messages

**Test locally with production settings:**
```bash
APP_ENV=production APP_DEBUG=false php artisan serve
```

## 📊 Monitoring

### Render Dashboard Features:
- **Real-time logs**
- **Deployment history**
- **Performance metrics**
- **Auto-scaling** (if needed)

### Health Checks:
- Render automatically checks your app health
- Returns 200 status for healthy app
- Monitors response times

## 🔄 Continuous Deployment

**Automatic Deployments:**
- Render automatically deploys on Git push
- No manual intervention needed
- Rollback to previous version if needed

**Manual Deployments:**
- Go to Render dashboard
- Click "Manual Deploy"
- Choose branch to deploy

## 💰 Cost Optimization

**Free Tier Limits:**
- 750 hours/month
- 512 MB RAM
- Shared CPU
- Sleeps after 15 minutes of inactivity

**Upgrade Options:**
- Starter: $7/month
- Standard: $25/month
- Professional: $100/month

## 🎯 Final Checklist

### Before Deployment:
- [x] Repository is on GitHub
- [x] All files committed and pushed
- [x] `.env` file is NOT in repository
- [x] `composer.json` and `composer.lock` exist
- [x] `README.md` is updated
- [x] `render.yaml` is in repository

### After Deployment:
- [x] App is accessible via URL
- [x] Products page loads correctly
- [x] Cart functionality works
- [x] Session storage works
- [x] All features tested
- [x] Custom domain configured (if needed)

## 📝 Environment Variables Summary

**Required for Render:**
```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:YOUR_KEY
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
SESSION_DRIVER=file
```

**Optional but Recommended:**
```
LOG_CHANNEL=stack
LOG_LEVEL=error
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

---

**Your Laravel ECommerce Cart is now live on Render! 🚀**

**Live URL:** `https://your-app-name.onrender.com` 