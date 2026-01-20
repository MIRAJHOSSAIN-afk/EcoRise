# EcoRise Project - Task Division (3 Members)

**Project:** EcoRise Environmental Crowdfunding Platform  
**Team Size:** 3 Members  
**Repository:** https://github.com/MIRAJHOSSAIN-afk/EcoRise

---

## 👥 Team Member Roles & Responsibilities

### 🟢 PERSON A (You - Team Lead & Backend Developer)
**Primary Focus:** Database, Authentication, Admin Features

#### Your Tasks:

**1. Database & Configuration (HIGH PRIORITY)**
- [ ] Ensure database is properly set up and optimized
- [ ] Add missing database tables if needed
- [ ] Create database backup system
- [ ] Update [config.php](config.php) with proper error handling
- [ ] Test all database connections

**2. Admin Panel Enhancement**
- [ ] Improve [admin_homepage.php](admin_homepage.php)
- [ ] Add admin analytics/dashboard (total campaigns, users, donations)
- [ ] Enhance [manage_campaigns.php](manage_campaigns.php) with filters
- [ ] Improve [view_users.php](view_users.php) - add user status management
- [ ] Add export functionality (CSV for campaigns/users)

**3. User Management System**
- [ ] Enhance user authentication security
- [ ] Add email verification feature
- [ ] Improve [change_password.php](change_password.php) - add password strength meter
- [ ] Add forgot password functionality
- [ ] Create user role management (admin/user permissions)

**4. Backend API Development**
- [ ] Create API endpoints in `app/controllers/`
- [ ] Improve [CampaignController.php](app/controllers/CampaignController.php)
- [ ] Improve [UserController.php](app/controllers/UserController.php)
- [ ] Add validation and error handling
- [ ] Document API endpoints

**Files You'll Work On:**
- `config.php`
- `admin_homepage.php`
- `manage_campaigns.php`
- `view_users.php`
- `change_password.php`
- `app/controllers/AuthController.php`
- `app/controllers/UserController.php`
- `app/models/User.php`
- `assets/db/ecorise.sql`

---

### 🔵 PERSON B (Frontend Developer)
**Primary Focus:** User Interface, Styling, User Experience

#### Tasks for Person B:

**1. Homepage & Landing Page (HIGH PRIORITY)**
- [ ] Redesign [homepage.php](homepage.php) - make it more attractive
- [ ] Improve [index.php](index.php) landing page
- [ ] Add hero section with call-to-action
- [ ] Add testimonials/success stories section
- [ ] Create "How It Works" section
- [ ] Add footer with social media links

**2. Campaign Display & UI**
- [ ] Enhance campaign cards design
- [ ] Improve [champ.php](champ.php) campaign details page
- [ ] Add campaign filtering (by category, location, goal amount)
- [ ] Add search functionality for campaigns
- [ ] Create campaign category badges/tags
- [ ] Add image carousel for campaign images

**3. User Dashboard & Profile**
- [ ] Redesign [dashboard.php](dashboard.php)
- [ ] Add user donation history display
- [ ] Create profile picture upload feature
- [ ] Add user statistics (total donated, campaigns supported)
- [ ] Improve navigation menu

**4. Styling & Responsiveness**
- [ ] Update all CSS files in `assets/css/`
- [ ] Make entire site mobile-responsive
- [ ] Add animations and transitions
- [ ] Create consistent color scheme
- [ ] Improve button styles and forms
- [ ] Add loading spinners/progress indicators

**5. Support/Donation Page**
- [ ] Enhance [support.php](support.php) design
- [ ] Add payment gateway UI (even if mock)
- [ ] Create [thank_you.html](thank_you.html) better design
- [ ] Add donation amount quick-select buttons
- [ ] Create donation summary before confirmation

**Files Person B Will Work On:**
- `homepage.php`
- `index.php`
- `dashboard.php`
- `champ.php`
- `support.php`
- `thank_you.html`
- All files in `assets/css/` folder
- `app/views/` folder (if creating new views)

---

### 🟡 PERSON C (Full-Stack Developer)
**Primary Focus:** Campaign System, Donations, Integration

#### Tasks for Person C:

**1. Campaign Management System (HIGH PRIORITY)**
- [ ] Enhance [add_campaign.php](add_campaign.php)
- [ ] Add campaign categories/tags feature
- [ ] Create campaign deadline/end date functionality
- [ ] Add multiple image upload for campaigns
- [ ] Create campaign update/news feature (admins post updates)
- [ ] Add campaign status (active/completed/cancelled)

**2. Donation/Support System**
- [ ] Improve [process_support.php](process_support.php)
- [ ] Create donation tracking system
- [ ] Add donation history for users
- [ ] Create donation receipts/confirmation emails
- [ ] Add anonymous donation option
- [ ] Create donation leaderboard (top donors)

**3. Campaign Data & Analytics**
- [ ] Improve [getCampaigns.php](getCampaigns.php) with filtering
- [ ] Add campaign statistics (total donors, average donation)
- [ ] Create trending campaigns feature
- [ ] Add "featured campaigns" functionality
- [ ] Create campaign progress tracking
- [ ] Add campaign sharing (social media integration)

**4. Image & Media Management**
- [ ] Improve [update_image.php](update_image.php)
- [ ] Add image compression/optimization
- [ ] Create image gallery for campaigns
- [ ] Add image validation and security
- [ ] Create thumbnail generation

**5. Integration & Testing**
- [ ] Integrate frontend (Person B) with backend (Person A)
- [ ] Test all features across the platform
- [ ] Fix bugs and cross-browser issues
- [ ] Add form validations (client & server-side)
- [ ] Create error handling system

**Files Person C Will Work On:**
- `add_campaign.php`
- `getCampaigns.php`
- `process_support.php`
- `update_image.php`
- `app/controllers/CampaignController.php`
- `app/models/Campaign.php`
- Campaign-related CSS files
- JavaScript files for AJAX/interactivity

---

## 📋 Shared Responsibilities (All Members)

- **Documentation:** Update README.md as you add features
- **Testing:** Test your own code before pushing
- **Communication:** Notify team before working on shared files
- **Code Quality:** Write clean, commented code
- **Git Commits:** Clear commit messages

---

## 🗓️ Development Timeline

### Week 1 (Jan 20-26)
- **Person A:** Database setup + Admin panel basics
- **Person B:** Homepage redesign + CSS framework
- **Person C:** Campaign system enhancement

### Week 2 (Jan 27 - Feb 2)
- **Person A:** User authentication improvements
- **Person B:** Dashboard + User profile UI
- **Person C:** Donation system + Integration

### Week 3 (Feb 3-9)
- **All:** Testing, bug fixes, final touches
- **All:** Prepare presentation/documentation

---

## 🚨 Important Rules

### Before Starting Work:
```bash
git pull origin main
```

### Avoid File Conflicts:
**Shared Files (coordinate before editing):**
- `config.php`
- `homepage.php`
- Database files

**Person A mostly edits:** Backend PHP files, Admin pages  
**Person B mostly edits:** CSS files, Frontend HTML  
**Person C mostly edits:** Campaign files, AJAX scripts

### After Completing a Task:
```bash
git add .
git commit -m "Add [feature name] - Person A/B/C"
git pull origin main
git push origin main
```

---

## 📞 Communication Protocol

1. **Daily Updates:** Share progress in group chat
2. **Conflicts:** If 2 people need same file, coordinate time
3. **Blockers:** Ask for help immediately
4. **Testing:** Test locally before pushing

---

## ✅ Success Metrics

- [ ] All features implemented and working
- [ ] No merge conflicts
- [ ] Mobile-responsive design
- [ ] Clean, documented code
- [ ] All team members contributed equally
- [ ] Project runs without errors

---

## 🎯 Your Next Steps (PERSON A)

1. Read this document thoroughly
2. Share with teammates
3. Assign roles (who is Person B and C)
4. Start with your HIGH PRIORITY tasks
5. Set up team communication (WhatsApp/Discord)
6. Create a shared checklist (Google Sheets/Trello)

**Your first task:** Focus on database optimization and admin panel!

---

**Questions?** Check [QUICK_REFERENCE.md](QUICK_REFERENCE.md) or [TEAM_WORKFLOW_DIAGRAM.md](TEAM_WORKFLOW_DIAGRAM.md)
