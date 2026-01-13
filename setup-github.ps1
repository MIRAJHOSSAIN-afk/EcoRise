# GitHub Repository Setup Script for PowerShell
Write-Host "========================================" -ForegroundColor Green
Write-Host "GitHub Repository Setup Script" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""

Write-Host "BEFORE RUNNING THIS SCRIPT:" -ForegroundColor Yellow
Write-Host "1. Go to https://github.com" -ForegroundColor White
Write-Host "2. Click 'New repository'" -ForegroundColor White
Write-Host "3. Name: EcoRise" -ForegroundColor White
Write-Host "4. Description: Environmental Crowdfunding Platform" -ForegroundColor White
Write-Host "5. Keep it PUBLIC" -ForegroundColor White
Write-Host "6. DO NOT initialize with README" -ForegroundColor White
Write-Host "7. Click 'Create repository'" -ForegroundColor White
Write-Host ""

$repoUrl = Read-Host "Enter your GitHub repository URL (e.g., https://github.com/username/EcoRise.git)"

Write-Host ""
Write-Host "Adding remote repository..." -ForegroundColor Cyan
git remote add origin $repoUrl

Write-Host ""
Write-Host "Pushing main branch..." -ForegroundColor Cyan
git push -u origin main

Write-Host ""
Write-Host "Pushing dev branch..." -ForegroundColor Cyan
git push -u origin dev

Write-Host ""
Write-Host "Pushing stage branch..." -ForegroundColor Cyan
git push -u origin stage

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "SUCCESS! All branches pushed to GitHub" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""

Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Go to your GitHub repository" -ForegroundColor White
Write-Host "2. Verify all three branches are there (main, dev, stage)" -ForegroundColor White
Write-Host "3. Add team members as collaborators:" -ForegroundColor White
Write-Host "   - Settings > Collaborators > Add people" -ForegroundColor White
Write-Host "4. Share the repository URL with your team" -ForegroundColor White
Write-Host ""
Write-Host "Team members can clone with:" -ForegroundColor Yellow
Write-Host "git clone $repoUrl" -ForegroundColor Cyan
Write-Host ""

Read-Host "Press Enter to continue"
