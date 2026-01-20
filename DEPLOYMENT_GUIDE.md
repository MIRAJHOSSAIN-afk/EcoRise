# Deploying EcoRise to InfinityFree (Free Hosting)

## Why InfinityFree?
- ✅ Free PHP hosting
- ✅ Free MySQL database
- ✅ No credit card required
- ✅ Good for student projects
- ✅ Custom domain support

## Step-by-Step Deployment

### Step 1: Sign Up for InfinityFree

1. Go to: https://infinityfree.net
2. Click "Sign Up"
3. Choose a subdomain (e.g., ecorise.infinityfreeapp.com)
4. Complete registration

### Step 2: Get Your Hosting Details

After signup, note these details from your control panel:
- FTP hostname
- FTP username
- FTP password
- MySQL hostname
- MySQL database name
- MySQL username
- MySQL password

### Step 3: Create MySQL Database

1. Log in to InfinityFree control panel
2. Go to "MySQL Databases"
3. Create new database (e.g., ecorise)
4. Note the database credentials

### Step 4: Update config.php

Update your `config.php` with the hosting details:

```php
<?php
// InfinityFree Database Configuration
$servername = "sqlXXX.infinityfree.com"; // Your MySQL hostname
$username = "epiz_XXXXXXXX";             // Your MySQL username
$pass = "your_mysql_password";           // Your MySQL password
$dbname = "epiz_XXXXXXXX_ecorise";      // Your database name

$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### Step 5: Upload Files via FTP

#### Option A: FileZilla (Recommended)

1. Download FileZilla: https://filezilla-project.org
2. Install and open FileZilla
3. Enter your FTP credentials:
   - Host: ftpupload.net (or your FTP hostname)
   - Username: Your FTP username
   - Password: Your FTP password
   - Port: 21
4. Click "Quickconnect"
5. Navigate to `htdocs` folder on remote
6. Upload ALL your project files to `htdocs`

#### Option B: File Manager (via Control Panel)

1. Log in to InfinityFree control panel
2. Go to "File Manager"
3. Navigate to `htdocs` folder
4. Upload all project files

### Step 6: Import Database

1. Go to phpMyAdmin from control panel
2. Select your database
3. Click "Import" tab
4. Upload `assets/db/ecorise.sql`
5. Click "Go"

### Step 7: Test Your Website

Visit: https://ecorise.infinityfreeapp.com (or your chosen subdomain)

---

## Alternative: Railway.app (Better, but requires GitHub)

### Features:
- ✅ Supports PHP
- ✅ MySQL database included
- ✅ $5 free credit
- ✅ Deploys directly from GitHub

### Steps:

1. Go to: https://railway.app
2. Sign up with GitHub
3. Click "New Project"
4. Select "Deploy from GitHub repo"
5. Choose your EcoRise repository
6. Railway will auto-detect PHP
7. Add MySQL database from Railway dashboard
8. Set environment variables for database connection

---

## Alternative: 000webhost (Free)

### Features:
- ✅ 1 GB storage
- ✅ PHP & MySQL
- ✅ Free subdomain
- ✅ No ads

### Steps:

1. Go to: https://www.000webhost.com
2. Sign up for free account
3. Create new website
4. Upload files via File Manager or FTP
5. Create MySQL database
6. Import ecorise.sql
7. Update config.php

---

## Important Notes

### Files to Update After Deployment:

1. **config.php** - Update with production database credentials
2. **Image paths** - Verify all paths are correct
3. **Base URLs** - Update any hardcoded localhost URLs

### Security Recommendations:

1. **Change default passwords** in database
2. **Add .htaccess** for security:

```apache
# Prevent directory browsing
Options -Indexes

# Protect config file
<Files "config.php">
    Order allow,deny
    Deny from all
</Files>

# Enable HTTPS redirect (if SSL available)
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

3. **Remove update_image.php** if no longer needed

---

## Testing Checklist

After deployment, test:
- [ ] Homepage loads
- [ ] User signup works
- [ ] User signin works
- [ ] Campaigns display
- [ ] Support/donation works
- [ ] Dashboard loads
- [ ] Admin panel accessible
- [ ] Images display correctly
- [ ] Database connections work

---

## Troubleshooting

### "Connection failed" error
- Verify database credentials in config.php
- Ensure database exists on hosting
- Check MySQL hostname is correct

### Images not showing
- Verify `assets/` folder uploaded
- Check file permissions (755 for folders, 644 for files)
- Verify image paths in database

### Pages showing blank
- Enable error reporting temporarily in PHP
- Check PHP version compatibility
- Review hosting error logs

---

## Free Hosting Comparison

| Feature | InfinityFree | 000webhost | Railway.app |
|---------|--------------|------------|-------------|
| PHP Support | ✅ | ✅ | ✅ |
| MySQL | ✅ | ✅ | ✅ |
| Storage | Unlimited | 1 GB | Limited |
| Bandwidth | Unlimited | 10 GB | Limited |
| Custom Domain | ✅ | ✅ | ✅ |
| SSL/HTTPS | ✅ | ✅ | ✅ |
| Ads | No | No | No |
| Best For | Student Projects | Small Sites | GitHub Projects |

---

## Recommendation

**For EcoRise project, I recommend InfinityFree** because:
1. Completely free
2. Unlimited bandwidth
3. No credit card needed
4. Good for academic projects
5. Easy setup

---

Would you like help with any of these deployment options?
