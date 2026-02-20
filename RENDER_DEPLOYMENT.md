# 🚀 MovieHub - Render.com Deployment Guide

## Prerequisites
- GitHub account with MovieHub repository
- Render account (sign up with GitHub at https://render.com)

## Quick Deploy

### Option 1: Blueprint (Easiest - One Click!)

1. Go to Render Dashboard: https://dashboard.render.com
2. Click **"New"** → **"Blueprint"**
3. Connect your GitHub repository: `rens12c/MovieHub`
4. Render will auto-detect `render.yaml`
5. Click **"Apply"**
6. Done! ✅

Render will automatically:
- Create PostgreSQL database
- Deploy web service
- Set environment variables
- Run migrations & seeders

### Option 2: Manual Setup

#### Step 1: Create PostgreSQL Database

1. Render Dashboard → **"New"** → **"PostgreSQL"**
2. Name: `moviehub-db`
3. Database: `moviehub`
4. User: `moviehub`
5. Region: Oregon (US West)
6. Plan: **Free**
7. Click **"Create Database"**

#### Step 2: Create Web Service

1. Render Dashboard → **"New"** → **"Web Service"**
2. Connect repository: `rens12c/MovieHub`
3. Configure:

**Runtime:**
- Environment: **Docker**

**Build & Deploy:**
- Branch: `main`
- Root Directory: (leave empty)

**Instance Type:**
- Plan: **Free** ($0/month)

#### Step 3: Environment Variables

Add these in **Environment** tab:

```env
APP_NAME=MovieHub
APP_ENV=production
APP_DEBUG=false
APP_URL=https://YOUR-APP.onrender.com

OMDB_API_KEY=72af6cc3
OMDB_API_URL=http://www.omdbapi.com/

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

DATABASE_URL=${postgres://...}
```

**Important:**
- `DATABASE_URL` → Add from database (Render provides this automatically)
- Generate `APP_KEY`: Run `php artisan key:generate --show` locally, copy output

#### Step 4: Deploy!

1. Click **"Create Web Service"**
2. Render will:
   - Build Docker image
   - Install dependencies
   - Run migrations
   - Deploy application

**Your app will be live at:** `https://moviehub-XXXX.onrender.com`

## Configuration Details

### Language Settings
- **Runtime:** Docker
- **PHP Version:** 8.2
- **Database:** PostgreSQL (free tier)

### Build Process
Dockerfile handles:
1. Install PHP 8.2 + extensions (pdo_pgsql, pgsql, etc.)
2. Install Composer dependencies
3. Install Node dependencies
4. Build assets (npm run build)
5. Set permissions
6. Run migrations & seeders on start

### Database
- **Type:** PostgreSQL 14
- **Plan:** Free (256MB storage, 1GB data transfer)
- **Connection:** Auto-configured via `DATABASE_URL`

### Instance
- **Type:** Free tier
- **RAM:** 512MB
- **CPU:** Shared
- **Note:** Spins down after 15 min inactivity (wakes up on request)

## Post-Deployment

### Access Your App
Visit: `https://YOUR-APP-NAME.onrender.com`

### Default Login
```
Username: aldmic
Password: 123abc123
```

### Custom Domain (Optional)
1. Go to **Settings** → **Custom Domains**
2. Add your domain
3. Configure DNS as instructed

## Troubleshooting

### Build Fails
- Check **Logs** tab in Render dashboard
- Verify Dockerfile is correct
- Check composer/npm dependencies

### Database Connection Error
- Verify `DATABASE_URL` is set in environment variables
- Check database is running (free tier can sleep)

### Migration Errors
- Database might be sleeping (free tier)
- Check logs for specific error
- Verify PostgreSQL connection

### Assets Not Loading
- Check `npm run build` completed
- Verify public/build directory exists
- Check storage permissions

## Update/Redeploy

### Auto Deploy
Just push to GitHub:
```bash
git add .
git commit -m "Update: your changes"
git push origin main
```

Render auto-deploys on push! 🚀

### Manual Deploy
Render Dashboard → Your service → **Manual Deploy** → **Deploy latest commit**

## Free Tier Limitations

⚠️ **Render Free Tier:**
- Spins down after 15 minutes of inactivity
- First request after spin-down takes ~30 seconds
- 750 hours/month (enough for demo/interview)
- No custom metrics/alerts

💡 **Upgrade to Starter ($7/mo) for:**
- Always-on service
- No spin-down
- Better performance

## Features Deployed

✅ Dark cinematic theme  
✅ OMDb API integration  
✅ PostgreSQL database  
✅ Movie search & favorites  
✅ Multi-language (EN/ID)  
✅ Responsive design  
✅ Lazy loading & infinite scroll  

## Environment

- **PHP:** 8.2
- **Laravel:** 12
- **Database:** PostgreSQL 14
- **Node:** Latest LTS
- **Platform:** Render.com

---

**Deployment Time:** ~5-7 minutes  
**Cost:** FREE  
**URL:** Auto-generated (can add custom domain)

Good luck with your interview! 🎬🍿
