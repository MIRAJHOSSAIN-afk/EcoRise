# EcoRise - Environmental Crowdfunding Platform

## Project Overview
EcoRise is a web-based crowdfunding platform dedicated to supporting environmental initiatives and promoting a sustainable future. Our mission is to empower individuals, communities, and organizations to create and fund impactful eco-projects that make a difference in the world.

## Features
- User authentication and authorization
- Campaign management system
- Donation/support system
- User dashboard and profile management
- Admin panel for platform management
- Real-time campaign tracking with progress bars
- Responsive design with modern UI/UX

## Technology Stack
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP (Apache + MySQL)
- **Version Control**: Git

## Project Structure
```
EcoRise-main/
├── app/                    # MVC Architecture
│   ├── core/              # Core framework files
│   ├── models/            # Database models
│   ├── controllers/       # Business logic controllers
│   └── views/             # Presentation layer
├── assets/                # Static assets
│   ├── css/              # Stylesheets
│   ├── campaigns/        # Campaign images
│   └── logo/             # Brand assets
├── config.php            # Database configuration
└── [application files]   # Main application files
```

## Installation

### Prerequisites
- XAMPP (or any Apache + MySQL + PHP environment)
- Git
- Modern web browser

### Setup Steps
1. Clone the repository
```bash
git clone <repository-url>
cd EcoRise-main
```

2. Start XAMPP
   - Start Apache server
   - Start MySQL server

3. Create Database
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Import `assets/db/ecorise.sql`

4. Configure Database
   - Update `config.php` with your database credentials if needed

5. Access the Application
   - Open browser: http://localhost/EcoRise-main/

## Usage

### For Users
1. **Sign Up**: Create a new account
2. **Sign In**: Log in with credentials
3. **Browse Campaigns**: View active environmental campaigns
4. **Support Campaigns**: Make donations to campaigns
5. **Dashboard**: Manage your profile and view donation history

### For Admins
1. Sign in with admin credentials
2. Access admin panel
3. Manage campaigns (add, edit, delete)
4. View users and manage platform

## Development Workflow

### Branch Strategy (Gitflow)
- `main`: Production-ready code
- `stage`: Pre-production staging
- `dev`: Integration branch for features
- `feature/*`: Individual feature development
- `hotfix/*`: Critical bug fixes

### Commit Message Convention
```
<type>: <subject>

<body>

<footer>
```

**Types**: feat, fix, docs, style, refactor, test, chore

**Example**:
```
feat: implement user login page (T-14)

- Created login form component
- Added input validation
- Implemented error handling
```

## Team Members
- [Member 1 Name] - Role
- [Member 2 Name] - Role
- [Member 3 Name] - Role
- [Member 4 Name] - Role

## Project Management
- **Task Board**: [Trello Board Link]
- **Repository**: [GitHub/GitLab Link]

## Security Features
- Password hashing (bcrypt)
- Prepared statements (SQL injection prevention)
- XSS protection with htmlspecialchars
- Session management
- Input validation (client-side and server-side)

## Contributing
1. Claim a task from Trello board
2. Create feature branch from `dev`
3. Implement changes
4. Push and create Pull Request
5. Request code review
6. Merge after approval

## License
[Specify License]

## Contact
- Email: support@ecorise.com
- Phone: 01813609364

## Acknowledgments
- Course Instructor: [Name]
- Institution: [University/College Name]
- Course: [Course Code and Name]
