# 🚀 MovieHub - Railway Deployment Guide

## Prerequisites
- GitHub account
- Railway account (sign up with GitHub)
- Git installed locally

## Step 1: Push to GitHub

```bash
# Initialize git (if not already done)
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit - MovieHub Laravel App"

# Create repository on GitHub (https://github.com/new)
# Then add remote and push:
git remote add origin https://github.com/YOUR_USERNAME/moviehub.git
git branch -M main
git push -u origin main
```

## Step 2: Deploy to Railway

1. Go to https://railway.app
2. Click **"Login"** → Sign in with GitHub
3. Click **"New Project"**
4. Select **"Deploy from GitHub repo"**
5. Choose your `moviehub` repository
6. Railway will auto-detect Laravel ✅

## Step 3: Add MySQL Database

1. In your Railway project dashboard, click **"New"**
2. Select **"Database"** → **"Add MySQL"**
3. Railway will automatically:
   - Create MySQL instance
   - Set environment variables (`MYSQL_URL`, `MYSQLHOST`, `MYSQLPORT`, etc.)
   - Connect to your app

**Note:** Railway automatically provides MySQL credentials. Your app is configured to use MySQL by default.

## Step 4: Configure Environment Variables

In Railway dashboard → Your service → **"Variables"** tab:

Add these variables:

```env
APP_NAME=MovieHub
APP_ENV=production
APP_DEBUG=false
APP_URL=https://YOUR-APP.up.railway.app

OMDB_API_KEY=72af6cc3
OMDB_API_URL=http://www.omdbapi.com/
```

**Important:** Railway auto-sets these from MySQL:
- `DATABASE_URL`
- `MYSQL_URL`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

## Step 5: Generate APP_KEY

Run locally:
```bash
php artisan key:generate --show
```

Copy the output and add to Railway variables:
```
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
```

## Step 6: Deploy!

Railway will automatically:
1. ✅ Build your app
2. ✅ Install dependencies
3. ✅ Run migrations
4. ✅ Seed database
5. ✅ Generate public URL

Your app will be live at: `https://YOUR-PROJECT-NAME.up.railway.app`

## Step 7: Custom Domain (Optional)

1. Go to **Settings** → **Networking**
2. Click **"Generate Domain"** for free Railway subdomain
3. Or add your own custom domain

## Troubleshooting

### Build fails?
Check Railway logs in **"Deployments"** tab

### Database connection error?
Verify `DATABASE_URL` is set by Railway MySQL

### Assets not loading?
Make sure `npm run build` completed successfully

### Migration errors?
Check database credentials in Railway variables

## Post-Deployment

### Default Login Credentials
```
Username: aldmic
Password: 123abc123
```

### Test Your App
1. Visit your Railway URL
2. Login with credentials above
3. Search for movies
4. Add to favorites
5. Test language switcher (EN/ID)

## Update/Redeploy

Just push to GitHub:
```bash
git add .
git commit -m "Update: description of changes"
git push
```

Railway will auto-deploy! 🚀

## Features Deployed
✅ Dark cinematic theme
✅ OMDb API integration
✅ Movie search with infinite scroll
✅ Favorites management
✅ Multi-language (EN/ID)
✅ Responsive design
✅ Glassmorphism UI

## Support

If deployment fails:
1. Check Railway deployment logs
2. Verify all environment variables
3. Check database connection
4. Review build output

---

**Deployment Time:** ~3-5 minutes
**Cost:** FREE (Railway free tier)
**URL:** Auto-generated or custom domain

Good luck with your interview! 🎬🍿
