# Team Member Onboarding Guide

## Welcome to the EcoRise Team! 🌱

This guide will help you get started with the project.

## Prerequisites
- Git installed on your computer
- GitHub account
- XAMPP installed
- Access to the team's GitHub repository

## Step 1: Clone the Repository

Once the team lead shares the repository URL with you:

```bash
# Clone the repository
git clone https://github.com/YOUR-TEAM/EcoRise.git

# Navigate into the project directory
cd EcoRise
```

## Step 2: Configure Your Git Identity

```bash
# Set your name (use your real name)
git config user.name "Your Full Name"

# Set your email (use your university/college email)
git config user.email "your.email@university.edu"

# Verify configuration
git config --list
```

## Step 3: Verify All Branches

```bash
# View all branches
git branch -a

# You should see:
# * main
#   dev
#   stage
#   remotes/origin/main
#   remotes/origin/dev
#   remotes/origin/stage
```

## Step 4: Update All Branches

```bash
# Update main branch
git checkout main
git pull origin main

# Update dev branch
git checkout dev
git pull origin dev

# Update stage branch
git checkout stage
git pull origin stage

# Return to dev (your working branch)
git checkout dev
```

## Step 5: Set Up Local Environment

### Database Setup

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start Apache
   - Start MySQL

2. **Create Database**
   - Open browser: `http://localhost/phpmyadmin`
   - Click "New" to create database
   - Database name: `ecorise`
   - Collation: `utf8mb4_general_ci`
   - Click "Create"

3. **Import Database Schema**
   - Select `ecorise` database
   - Click "Import" tab
   - Choose file: `assets/db/ecorise.sql`
   - Click "Go"

4. **Configure Database Connection**
   - Open `config.php` in your code editor
   - Verify settings (default should work):
   ```php
   $servername = "localhost";
   $username = "root";
   $pass = "";
   $dbname = "ecorise";
   ```

### Test the Application

1. Open browser: `http://localhost/EcoRise/index.php`
2. You should see the EcoRise homepage
3. Try signing up with a test account
4. Verify you can sign in

## Step 6: Claim Your First Task

### On Trello Board

1. Go to the team's Trello board
2. Find a task in "To Do" column
3. Assign it to yourself
4. Move it to "In Progress"
5. Note the task ID (e.g., T-05)

### Create Feature Branch

```bash
# Make sure you're on dev and it's up to date
git checkout dev
git pull origin dev

# Create your feature branch (use the task ID from Trello)
git checkout -b feature/T-05
```

## Step 7: Work on Your Feature

### Simulate the Development

For this workflow simulation, add your feature to `PROJECT_FEATURES.md`:

```bash
# Open PROJECT_FEATURES.md in your editor
# Add at the end:

## T-05: Your Feature Name
**Status: Implemented**
Description of what you implemented
- Detail 1
- Detail 2
- Detail 3
```

### Commit Your Changes

```bash
# Stage the file
git add PROJECT_FEATURES.md

# Commit with proper message format
git commit -m "feat: implement your feature name (T-05)

- Implemented detail 1
- Added detail 2
- Created detail 3"
```

### Push to Remote

```bash
# Push your feature branch
git push -u origin feature/T-05
```

## Step 8: Create Pull Request

1. Go to GitHub repository
2. Click "Compare & pull request" button (appears after push)
3. **Base:** `dev` ← **Compare:** `feature/T-05`
4. **Title:** `feat: implement your feature name (T-05)`
5. **Description:** Copy your commit message body
6. **Assign reviewer:** Choose a teammate
7. Click "Create pull request"
8. Update Trello: Move card to "In Review"

## Step 9: After PR is Merged

Once your PR is reviewed and merged:

```bash
# Switch to dev branch
git checkout dev

# Pull the latest changes (includes your merged feature)
git pull origin dev

# Delete your local feature branch (no longer needed)
git branch -d feature/T-05

# Start working on next task!
```

---

## Daily Workflow Reminder

```bash
# Morning routine
git checkout dev
git pull origin dev

# Start new feature
git checkout -b feature/T-XX

# Make changes...

# Commit and push
git add .
git commit -m "feat: description (T-XX)"
git push -u origin feature/T-XX

# Create PR on GitHub

# After merge
git checkout dev
git pull origin dev
git branch -d feature/T-XX
```

---

## Common Commands Reference

```bash
# Check which branch you're on
git branch

# Check status of files
git status

# View commit history
git log --oneline

# Discard changes to a file
git checkout -- filename

# View differences
git diff

# Stash changes temporarily
git stash
git stash pop

# View remote repositories
git remote -v
```

---

## Commit Message Format

**Template:**
```
<type>: <description> (T-XX)

- Detail 1
- Detail 2
- Detail 3
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Formatting
- `refactor`: Code restructuring
- `test`: Adding tests
- `chore`: Maintenance

**Examples:**

```bash
# Feature
git commit -m "feat: add email notifications (T-10)

- Created email service class
- Added SMTP configuration
- Implemented notification triggers"

# Bug Fix
git commit -m "fix: resolve login validation error (T-15)

- Fixed password verification logic
- Added error message display
- Updated session handling"

# Documentation
git commit -m "docs: update README installation steps (T-20)

- Added XAMPP setup instructions
- Included database import guide
- Added troubleshooting section"
```

---

## Troubleshooting

### "fatal: remote origin already exists"
```bash
git remote remove origin
git remote add origin <new-url>
```

### "Your branch is behind"
```bash
git pull origin dev
```

### "Merge conflict"
```bash
# Open conflicted files
# Look for <<<<<<< markers
# Resolve conflicts manually
git add resolved-file.php
git commit -m "resolve: merge conflict"
```

### "Permission denied"
```bash
# Set up SSH key or use HTTPS with credentials
# See GitHub documentation
```

---

## Best Practices

✅ **Always pull before starting work**
✅ **Commit often with clear messages**
✅ **Test your code before pushing**
✅ **Keep feature branches short-lived**
✅ **Review code thoroughly**
✅ **Communicate with your team**
✅ **Update Trello cards**
✅ **Ask questions when stuck**

---

## Need Help?

- **Git Issues:** Check GIT_WORKFLOW_GUIDE.md
- **Project Setup:** Check README.md
- **Feature Questions:** Ask on team chat/Trello
- **Merge Conflicts:** Ask teammate for help
- **Stuck:** Don't hesitate to reach out!

---

## Team Communication

- **Daily Standup:** Share what you're working on
- **Code Reviews:** Be constructive and helpful
- **Questions:** No question is too small
- **Blockers:** Communicate immediately

---

**Welcome aboard! Let's build something amazing together! 🚀**
