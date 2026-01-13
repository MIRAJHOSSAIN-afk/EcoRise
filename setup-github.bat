@echo off
echo ========================================
echo GitHub Repository Setup Script
echo ========================================
echo.
echo This script will help you push your EcoRise project to GitHub
echo.
echo BEFORE RUNNING THIS SCRIPT:
echo 1. Go to https://github.com
echo 2. Click "New repository"
echo 3. Name: EcoRise
echo 4. Description: Environmental Crowdfunding Platform
echo 5. Keep it PUBLIC
echo 6. DO NOT initialize with README
echo 7. Click "Create repository"
echo.
set /p REPO_URL="Enter your GitHub repository URL (e.g., https://github.com/username/EcoRise.git): "

echo.
echo Adding remote repository...
git remote add origin %REPO_URL%

echo.
echo Pushing main branch...
git push -u origin main

echo.
echo Pushing dev branch...
git push -u origin dev

echo.
echo Pushing stage branch...
git push -u origin stage

echo.
echo ========================================
echo SUCCESS! All branches pushed to GitHub
echo ========================================
echo.
echo Next steps:
echo 1. Go to your GitHub repository
echo 2. Verify all three branches are there (main, dev, stage)
echo 3. Add team members as collaborators:
echo    - Settings ^> Collaborators ^> Add people
echo 4. Share the repository URL with your team
echo.
echo Team members can clone with:
echo git clone %REPO_URL%
echo.
pause
