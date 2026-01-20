# 3-Person GitHub Collaboration Workflow

## Visual Workflow Diagram

```
┌─────────────────────────────────────────────────────────────────────┐
│                         GITHUB REPOSITORY                           │
│                   https://github.com/MIRAJHOSSAIN-afk/EcoRise       │
│                                                                     │
│  Branches:  main (production) | dev (development) | stage (testing) │
└─────────────────────────────────────────────────────────────────────┘
                    ▲                ▲                ▲
                    │                │                │
         git push   │     git push   │     git push   │
                    │                │                │
                    │                │                │
         git pull   │     git pull   │     git pull   │
                    ▼                ▼                ▼
    ┌───────────────────┐  ┌───────────────────┐  ┌───────────────────┐
    │   PERSON A        │  │   PERSON B        │  │   PERSON C        │
    │   (Team Lead)     │  │   (Developer)     │  │   (Developer)     │
    ├───────────────────┤  ├───────────────────┤  ├───────────────────┤
    │ Local Repository  │  │ Local Repository  │  │ Local Repository  │
    │                   │  │                   │  │                   │
    │ Working on:       │  │ Working on:       │  │ Working on:       │
    │ • Database setup  │  │ • User auth       │  │ • Campaign UI     │
    │ • Admin features  │  │ • Login/Signup    │  │ • Homepage design │
    └───────────────────┘  └───────────────────┘  └───────────────────┘
```

---

## Daily Workflow for Each Team Member

### 🌅 Morning Routine (Before Starting Work)

```bash
# 1. Navigate to project folder
cd c:\xampp\htdocs\EcoRise-main

# 2. Pull latest changes from GitHub
git pull origin main

# 3. Check what's changed
git status
```

**Why?** This ensures you have the latest code your teammates pushed.

---

### 💻 During Work (Making Changes)

```bash
# 1. Make your code changes in VS Code

# 2. Check what you changed
git status

# 3. Stage your changes
git add .

# 4. Commit with a clear message
git commit -m "Add user registration form validation"
```

**Pro Tip:** Commit often with clear messages like:
- ✅ "Fix login button alignment"
- ✅ "Add campaign image upload feature"
- ❌ "stuff" or "changes"

---

### 🌙 End of Day (Sharing Your Work)

```bash
# 1. Pull first (in case someone pushed while you worked)
git pull origin main

# 2. Push your commits
git push origin main
```

**Why pull first?** Prevents merge conflicts and ensures smooth collaboration.

---

## Handling Merge Conflicts 🔥

If you see a merge conflict message:

```
CONFLICT (content): Merge conflict in homepage.php
```

**Don't panic! Here's what to do:**

1. **Open the conflicting file** (e.g., homepage.php)
2. **Look for conflict markers:**
   ```php
   <<<<<<< HEAD
   Your code here
   =======
   Their code here
   >>>>>>> origin/main
   ```
3. **Decide which code to keep** (or combine both)
4. **Remove the conflict markers** (`<<<<<<<`, `=======`, `>>>>>>>`)
5. **Save the file**
6. **Then run:**
   ```bash
   git add homepage.php
   git commit -m "Resolve merge conflict in homepage"
   git push origin main
   ```

---

## Branch Workflow (Advanced - Optional)

For safer collaboration, use branches:

```
                main (production code)
                 │
                 │
        ┌────────┴────────┐
        │                 │
    dev branch      stage branch
        │                 │
        │                 │
   ┌────┴────┐           │
   │         │           │
Person A  Person B   Person C
feature/  feature/   feature/
login     payment    dashboard
```

### Creating a Feature Branch

```bash
# 1. Create and switch to a new branch
git checkout -b feature/login

# 2. Make your changes

# 3. Commit changes
git add .
git commit -m "Add login functionality"

# 4. Push your branch
git push origin feature/login

# 5. Create Pull Request on GitHub
# 6. Team reviews and merges
```

---

## Team Communication Rules 📢

### ✅ DO:
- **Communicate** before working on the same file
- **Pull before pushing** every time
- **Write clear commit messages**
- **Test your code** before pushing
- **Push daily** so others can see progress

### ❌ DON'T:
- Push broken code
- Work on the same file simultaneously without communication
- Delete files without telling the team
- Force push (`git push -f`) - very dangerous!

---

## Common Commands Cheat Sheet

| Command | What It Does |
|---------|-------------|
| `git status` | See what files changed |
| `git pull origin main` | Get latest code from GitHub |
| `git add .` | Stage all changes |
| `git commit -m "message"` | Save changes locally |
| `git push origin main` | Upload to GitHub |
| `git log` | See commit history |
| `git checkout -b branch-name` | Create new branch |
| `git branch` | List all branches |

---

## Task Assignment System

Use this format to avoid overlapping work:

**Trello/Google Sheets Example:**

| Task | Assigned To | Status | Due Date |
|------|-------------|--------|----------|
| User Login | Person B | In Progress | Jan 25 |
| Campaign CRUD | Person A | Completed | Jan 23 |
| Homepage Design | Person C | Not Started | Jan 27 |

---

## Emergency Contacts 🆘

If you're stuck:

1. **Check the docs:** [GIT_WORKFLOW_GUIDE.md](GIT_WORKFLOW_GUIDE.md)
2. **Ask in your team group chat**
3. **Google the error message**
4. **Use:** `git status` to understand what's happening

---

## Repository URL

**Clone Command for New Team Members:**
```bash
git clone https://github.com/MIRAJHOSSAIN-afk/EcoRise.git
cd EcoRise
```

---

## Success Checklist ✅

- [ ] All 3 members have GitHub accounts
- [ ] All 3 members are added as collaborators
- [ ] Everyone has cloned the repository
- [ ] Everyone can pull and push successfully
- [ ] Team communication channel set up (WhatsApp/Discord/Slack)
- [ ] Task assignment system in place
- [ ] Everyone understands the daily workflow

---

**Remember:** Communication is key! When in doubt, ask your teammates. 🚀
