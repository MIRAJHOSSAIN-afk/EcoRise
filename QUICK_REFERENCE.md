# Git Quick Reference - EcoRise Team 🚀

> **Print this or keep it open while working!**

---

## 📋 Daily Workflow (Copy-Paste Ready)

### Morning - Before Starting Work
```bash
cd c:\xampp\htdocs\EcoRise-main
git pull origin main
```

### During Work - Save Your Changes
```bash
git add .
git commit -m "Brief description of what you did"
```

### End of Day - Share Your Work
```bash
git pull origin main
git push origin main
```

---

## 🆘 Quick Fixes

### "I forgot to pull before making changes!"
```bash
git stash                    # Save your work temporarily
git pull origin main         # Get latest code
git stash pop                # Restore your work
```

### "I want to undo my last commit"
```bash
git reset --soft HEAD~1      # Undo commit but keep changes
```

### "I want to discard all my changes"
```bash
git restore .                # CAREFUL: This deletes your uncommitted changes!
```

### "I want to see what changed"
```bash
git diff                     # See changes before staging
git diff --staged            # See staged changes
git log                      # See commit history
```

---

## ✅ Commit Message Examples

**Good:**
- "Add user registration validation"
- "Fix campaign image upload bug"
- "Update homepage hero section styling"
- "Remove unused CSS files"

**Bad:**
- "changes"
- "stuff"
- "asdfasdf"
- "fix"

---

## 🔥 Merge Conflict Resolution

1. Open the conflicting file
2. Find the markers:
   ```
   <<<<<<< HEAD
   Your changes
   =======
   Their changes
   >>>>>>> origin/main
   ```
3. Edit to keep what you want
4. Remove the `<<<<<<<`, `=======`, `>>>>>>>` lines
5. Save the file
6. Run:
   ```bash
   git add .
   git commit -m "Resolve merge conflict"
   git push origin main
   ```

---

## 📞 Team Contact

**Repository:** https://github.com/MIRAJHOSSAIN-afk/EcoRise

**Before Editing a File:** Check team chat if someone else is working on it!

---

## 🎯 Work Division Template

| File/Feature | Person | Status |
|-------------|--------|--------|
| Database setup | Person A | ✅ Done |
| User authentication | Person B | 🔄 In Progress |
| Campaign UI | Person C | ⏳ Todo |

---

## ⚡ Super Quick Commands

```bash
git status              # What changed?
git pull origin main    # Get latest code
git add .               # Stage everything
git commit -m "msg"     # Save changes
git push origin main    # Upload to GitHub
git log --oneline       # Short commit history
```

---

## 🚨 NEVER DO THIS

❌ `git push -f` (force push) - Destroys team's work!  
❌ Push without pulling first  
❌ Commit passwords or sensitive data  
❌ Delete files without telling team  

---

**Need help?** Check [TEAM_WORKFLOW_DIAGRAM.md](TEAM_WORKFLOW_DIAGRAM.md) or [GIT_WORKFLOW_GUIDE.md](GIT_WORKFLOW_GUIDE.md)
