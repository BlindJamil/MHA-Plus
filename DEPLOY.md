# Deployment Instructions for Hostinger

## To see your changes on mhaplus.com, you need to pull the latest code on your server:

### Method 1: Using File Manager (Easiest)
1. Log into Hostinger File Manager
2. Delete the old `public/images/logo-new.png` file
3. Upload the new logo from: `/Users/blindjamil/Documents/MHA/MHA-Latest-Logo-no-backgroud.png`
4. Rename it to `logo-new.png`
5. Clear your browser cache (Cmd + Shift + R)

### Method 2: Using SSH (Recommended)
```bash
# SSH into your Hostinger server
ssh your-username@your-server

# Navigate to your website directory
cd domains/mhaplus.com/public_html
# OR
cd public_html

# Pull the latest changes from GitHub
git pull origin main
# OR if origin doesn't work
git pull mha_plus_https main

# Clear Laravel caches
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# Exit SSH
exit
```

### Method 3: Using Hostinger Git Deployment
1. Go to Hostinger Control Panel
2. Navigate to Advanced → Git
3. Click "Pull" to update from GitHub
4. Clear browser cache

## After deployment:
1. Open mhaplus.com in your browser
2. Hard refresh: **Cmd + Shift + R** (Mac) or **Ctrl + Shift + R** (Windows)
3. Or clear browser cache completely

## Current Status:
- ✅ Logo is updated in GitHub repository (commit: bef690f)
- ✅ Logo is correct locally (MD5: a1b2bb3fbd78310e7b5ac9436dc708dc)
- ⏳ Waiting to be pulled on Hostinger server
- ⏳ Browser cache needs to be cleared

## All Recent Commits Ready to Deploy:
- bef690f - Update logo to transparent background version
- 337f231 - Redesign footers with modern premium aesthetic
- 4c94349 - Fix active filter button hover
- 7f4f7d8 - Fix filter button state management
- 7417663 - Rebrand portfolio and project views
- 7eaca6b - Fix View Portfolio button hover
