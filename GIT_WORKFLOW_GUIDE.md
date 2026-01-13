# Git Workflow Guide for EcoRise Project

## Repository Status
✅ Git repository initialized
✅ All branches created: `main`, `dev`, `stage`
✅ Initial commits completed
✅ Project files committed

## Current Branch Structure
```
main (production-ready)
├── dev (development/integration)
└── stage (pre-production/staging)
```

## Next Steps for Team Setup

### Step 1: Create Remote Repository (Team Lead)

1. **Go to GitHub/GitLab**
   - Log in to your account
   - Click "New repository"
   - Name: `EcoRise` or `project-simulator-EcoRise`
   - Description: "Environmental Crowdfunding Platform - Git Workflow Simulation"
   - Set to **Public**
   - **DO NOT** initialize with README (we already have one)
   - Click "Create repository"

2. **Link Local to Remote**
```bash
# Add remote repository (replace with your URL)
git remote add origin https://github.com/your-username/EcoRise.git

# Push main branch
git push -u origin main

# Push dev branch
git push -u origin dev

# Push stage branch
git push -u origin stage
```

3. **Verify on GitHub/GitLab**
   - Refresh your repository page
   - You should see: README.md, CHANGELOG.md, PROJECT_FEATURES.md, and all project files
   - Check branches dropdown: should show main, dev, stage

### Step 2: Team Members Clone Repository

Each team member should:

```bash
# 1. Clone the repository
git clone https://github.com/your-username/EcoRise.git
cd EcoRise

# 2. Configure Git identity
git config user.name "Your Name"
git config user.email "your@email.edu"

# 3. Verify all branches exist
git branch -a

# 4. Update all branches
git checkout main
git pull origin main

git checkout dev
git pull origin dev

git checkout stage
git pull origin stage

# 5. Start working from dev branch
git checkout dev
```

---

## Feature Development Workflow

### Claiming and Starting a Task

1. **Go to Trello Board**
   - Find an unassigned task (e.g., "T-01: Add email notification system")
   - Assign it to yourself
   - Move to "In Progress"

2. **Create Feature Branch**
```bash
# Always start from updated dev branch
git checkout dev
git pull origin dev

# Create feature branch (use task ID)
git checkout -b feature/T-01
```

### Working on the Feature

**For this simulation, we're adding to PROJECT_FEATURES.md:**

```bash
# Edit PROJECT_FEATURES.md
echo "" >> PROJECT_FEATURES.md
echo "## T-01: Email Notification System" >> PROJECT_FEATURES.md
echo "**Status: Implemented**" >> PROJECT_FEATURES.md
echo "This feature sends email notifications to users when:" >> PROJECT_FEATURES.md
echo "- New campaign is created" >> PROJECT_FEATURES.md
echo "- Donation is received" >> PROJECT_FEATURES.md
echo "- Campaign reaches goal" >> PROJECT_FEATURES.md
echo "" >> PROJECT_FEATURES.md

# Stage and commit
git add PROJECT_FEATURES.md
git commit -m "feat: implement email notification system (T-01)

- Created email service class
- Added notification triggers for campaigns
- Implemented donation confirmation emails
- Added campaign success notifications
- Configured SMTP settings"
```

### Commit Message Convention

**Format:**
```
<type>: <subject> (T-XX)

<body>

<footer>
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation only
- `style`: Code style changes (formatting)
- `refactor`: Code restructuring
- `test`: Adding tests
- `chore`: Maintenance tasks

**Examples:**
```bash
# Feature
git commit -m "feat: add user profile image upload (T-05)

- Created image upload component
- Added validation for file types
- Implemented image resizing
- Updated user model with avatar field"

# Bug Fix
git commit -m "fix: resolve campaign progress bar calculation error (T-12)

- Fixed percentage calculation overflow
- Added boundary checks for raised amount
- Updated progress bar CSS for edge cases"

# Documentation
git commit -m "docs: update installation instructions in README (T-20)

- Added XAMPP setup steps
- Included database import instructions
- Added troubleshooting section"
```

### Pushing and Creating Pull Request

```bash
# Push feature branch to remote
git push -u origin feature/T-01
```

**On GitHub/GitLab:**

1. You'll see "Compare & pull request" button - click it
2. **Base:** `dev` ← **Compare:** `feature/T-01`
3. **Title:** `feat: implement email notification system (T-01)`
4. **Description:** Copy your commit message body
5. **Assign reviewer:** Choose a teammate
6. **Create Pull Request**
7. **Update Trello:** Move card to "In Review"

---

## Code Review Process (Reviewer)

### Reviewing a Pull Request

1. **Go to PR on GitHub/GitLab**
2. **Check:**
   - ✅ Branch name matches task ID
   - ✅ Commit message follows convention
   - ✅ Changes are in PROJECT_FEATURES.md (for simulation)
   - ✅ Description is clear
   - ✅ No conflicts with dev branch

3. **Actions:**
   - **Approve:** If everything looks good
   - **Request Changes:** If issues found
   - **Comment:** Add feedback

4. **Merge (if approved):**
   - Use "Squash and Merge" button
   - Keeps history clean
   - Delete the feature branch after merge

### After Merge (Everyone Updates)

```bash
# Switch to dev branch
git checkout dev

# Pull latest changes
git pull origin dev

# Delete your local feature branch
git branch -d feature/T-01

# You can now start a new feature!
```

**Update Trello:** Move card to "Done"

---

## Example Task Workflow

### Task: "T-14: Implement User Login Page"

```bash
# 1. Start from dev
git checkout dev
git pull origin dev

# 2. Create feature branch
git checkout -b feature/T-14

# 3. Simulate development
echo "" >> PROJECT_FEATURES.md
echo "## T-14: Implement User Login Page" >> PROJECT_FEATURES.md
echo "**Status: Implemented**" >> PROJECT_FEATURES.md
echo "Created login form with email and password fields." >> PROJECT_FEATURES.md
echo "Added validation and error handling." >> PROJECT_FEATURES.md
echo "" >> PROJECT_FEATURES.md

# 4. Commit
git add PROJECT_FEATURES.md
git commit -m "feat: implement user login page (T-14)

- Created login form component
- Added input validation
- Implemented error handling
- Added session management"

# 5. Push
git push -u origin feature/T-14

# 6. Create PR on GitHub/GitLab
# 7. Wait for review
# 8. After merge, update local dev
git checkout dev
git pull origin dev
git branch -d feature/T-14
```

---

## Branch Workflow Summary

```
feature/T-XX → dev → stage → main
```

### Branch Purposes

- **`main`**: Production code only. Never commit directly.
- **`stage`**: Pre-production testing. Merges from dev before release.
- **`dev`**: Integration branch. All features merge here first.
- **`feature/*`**: Individual features. Created from dev, merged back to dev.
- **`hotfix/*`**: Critical fixes. Created from main, merged to main and dev.

---

## Hotfix Workflow (Emergency Bug Fix)

```bash
# 1. Start from main
git checkout main
git pull origin main

# 2. Create hotfix branch
git checkout -b hotfix/critical-security-patch

# 3. Make fix and commit
git commit -m "fix: patch critical security vulnerability

- Fixed SQL injection in campaign search
- Updated input validation
- Added prepared statements"

# 4. Push and create PR to main
git push -u origin hotfix/critical-security-patch

# 5. After merging to main, also merge to dev
git checkout dev
git merge hotfix/critical-security-patch
git push origin dev
```

---

## Release Workflow (Moving to Production)

```bash
# 1. Merge dev to stage for testing
git checkout stage
git merge dev
git push origin stage

# 2. Test on staging environment

# 3. If tests pass, merge stage to main
git checkout main
git merge stage
git push origin main

# 4. Tag the release
git tag -a v1.1.0 -m "Release version 1.1.0"
git push origin v1.1.0
```

---

## Common Commands Reference

```bash
# Check current branch
git branch

# Check status
git status

# View commit history
git log --oneline --graph

# Discard local changes
git checkout -- filename

# Update from remote
git pull origin branch-name

# View remote repositories
git remote -v

# View all branches (local and remote)
git branch -a

# Delete local branch
git branch -d feature/T-XX

# Delete remote branch
git push origin --delete feature/T-XX
```

---

## Troubleshooting

### Merge Conflicts

```bash
# If you get conflicts
git status  # Shows conflicted files

# Open conflicted files and resolve manually
# Look for <<<<<<< HEAD markers

# After resolving
git add conflicted-file.php
git commit -m "resolve: merge conflict in conflicted-file.php"
```

### Accidentally Committed to Wrong Branch

```bash
# If you committed to main instead of feature branch
git reset --soft HEAD~1  # Undo commit, keep changes
git checkout -b feature/T-XX  # Create correct branch
git add .
git commit -m "your message"
```

### Forgot to Pull Before Starting

```bash
# If you started work without pulling
git stash  # Save your work
git pull origin dev  # Update
git stash pop  # Restore your work
```

---

## Project-Specific Guidelines

### For EcoRise Features

When adding features to PROJECT_FEATURES.md:

1. **Format:**
```markdown
## T-XX: Feature Name
**Status: Implemented**
Description of what was implemented
- Bullet point 1
- Bullet point 2
```

2. **Commit Message:**
   - First line: `type: short description (T-XX)`
   - Body: Detailed bullet points

3. **Always update CHANGELOG.md** for significant features

---

## Team Collaboration Tips

1. **Pull before starting work** - Always `git pull origin dev`
2. **Commit often** - Small, logical commits
3. **Write clear messages** - Future you will thank you
4. **Review thoroughly** - Take code review seriously
5. **Communicate** - Use PR comments and Trello
6. **Keep branches short-lived** - Merge and delete frequently
7. **Test before PR** - Make sure code works
8. **Resolve conflicts promptly** - Don't let them pile up

---

## Success Criteria for Evaluation

Your project will be checked for:

✅ **Branch Structure:** main, dev, stage exist
✅ **Commit Messages:** Follow convention
✅ **Feature Branches:** Named correctly (feature/T-XX)
✅ **Pull Requests:** Properly created and reviewed
✅ **Merge Strategy:** Squash and merge used
✅ **Documentation:** README, CHANGELOG, PROJECT_FEATURES updated
✅ **Git History:** Clean, logical commit history
✅ **Team Collaboration:** Multiple contributors visible

---

## Quick Start Checklist

- [ ] Repository created on GitHub/GitLab
- [ ] All branches pushed (main, dev, stage)
- [ ] Team members added as collaborators
- [ ] Everyone has cloned the repository
- [ ] Trello board set up with tasks
- [ ] First feature branch created
- [ ] First PR created and merged
- [ ] Everyone understands the workflow

---

**Happy Coding! Remember: When in doubt, ask your team! 🚀**
