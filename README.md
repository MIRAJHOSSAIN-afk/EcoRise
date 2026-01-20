# EcoRise - Environmental Crowdfunding Platform

Project Overview

EcoRise is a crowdfunding platform dedicated to environmental revival through greenery and reforestation initiatives. The system is designed to facilitate donations and campaign management through a structured, multi-user environment
Key Features by User Type

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
Admin: Responsible for high-level oversight, including adding, editing, or removing campaigns. Admins also manage user and staff accounts and monitor platform performance through donation and campaign statistics graphs.


User: Can browse and search for specific campaigns, make donations using multiple payment options, and receive donation receipts. They can also view their donation history and leave reviews on campaigns they have supported.


Staff: Acts as an intermediary role focused on operational tasks such as viewing campaign and user details and sending out official notices to the community.

Common Functionalities
All registered users have access to essential account management tools, including secure authentication (login/logout/registration), profile management (view/edit/delete), and a personalized dashboard to track their activities.

## Key Features
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


## Installation

### Prerequisites
- XAMPP (or any Apache + MySQL + PHP environment)
- Git
- Modern web browser

### Setup Steps
1. Clone the repository
bash
git clone <repository-url>
cd EcoRise-main


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


## Team Members:
- Miraj  Hossain 
- Reza 
- Ahnaf  Ayub

## Contact
- Email: mirajh324@gmail.com
- Phone: 0181......

## Acknowledgments
- Course Instructor:MIRZA ASIF MAHMUD
- Institution: American International Univeresity Bangladesh
- Course: WEB TECHNOLOGIES [P]
