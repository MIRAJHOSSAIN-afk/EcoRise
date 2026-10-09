<div align="center">

<!-- ══════════════ MAIN TITLE ══════════════ -->
<h1 style="
  font-family: 'Futura', 'Eurostile', 'Arial Black', sans-serif;
  font-weight: 900;
  font-stretch: expanded;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 72px;
  line-height: 1;
  margin: 0 0 4px 0;
  color: #0B3D2E;">
  ECO<span style="color:#2ECC71;">RISE</span>
</h1>

<!-- ══════════════ SUBTITLE / F1 STYLE ══════════════ -->
<p style="
  font-family: 'Formula 1', 'Titillium Web', sans-serif;
  font-weight: 700;
  font-style: italic;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 22px;
  margin: 0 0 18px 0;
  color: #1B1B1B;">
  Environmental Crowdfunding Platform
</p>

<!-- ══════════════ SMALL LABEL / DIN NEXT STYLE ══════════════ -->
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;
  margin: 0;">
  Plant &nbsp;·&nbsp; Fund &nbsp;·&nbsp; Restore
</p>

<br>

<!-- ══════════════ BADGES ══════════════ -->
<img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL">
<img src="https://img.shields.io/badge/Apache-XAMPP-D22128?style=flat-square&logo=apache&logoColor=white" alt="XAMPP">
<img src="https://img.shields.io/badge/Architecture-MVC-2ECC71?style=flat-square" alt="MVC">
<img src="https://img.shields.io/badge/License-Academic-0B3D2E?style=flat-square" alt="License">

</div>

---

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Project Overview
</p>
</div>

**EcoRise** is a crowdfunding platform dedicated to environmental revival through greenery and reforestation initiatives. The system is designed to facilitate donations and campaign management through a structured, multi-user environment.

<br>

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Key Features by User Type
</p>
</div>

### 🌱 For Users

| # | Feature | Description |
|:-:|:--------|:------------|
| 1 | **Sign Up** | Create a new account |
| 2 | **Sign In** | Log in with credentials |
| 3 | **Browse Campaigns** | View active environmental campaigns |
| 4 | **Support Campaigns** | Make donations to campaigns |
| 5 | **Dashboard** | Manage your profile and view donation history |

<br>

### 🛡️ For Admins

1. Sign in with admin credentials
2. Access admin panel
3. Manage campaigns **(add, edit, delete)**
4. View users and manage platform

> **Admin** — Responsible for high-level oversight, including adding, editing, or removing campaigns. Admins also manage user and staff accounts and monitor platform performance through donation and campaign statistics graphs.

<br>

### 👤 User

> Can browse and search for specific campaigns, make donations using multiple payment options, and receive donation receipts. They can also view their donation history and leave reviews on campaigns they have supported.

<br>

### 🧑‍💼 Staff

> Acts as an intermediary role focused on operational tasks such as viewing campaign and user details and sending out official notices to the community.

<br>

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Common Functionalities
</p>
</div>

All registered users have access to essential account management tools, including:

- 🔐 **Secure authentication** — login / logout / registration
- 🪪 **Profile management** — view / edit / delete
- 📊 **Personalized dashboard** — track your activities

<br>

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Key Features
</p>
</div>

- ✅ User authentication and authorization
- ✅ Campaign management system
- ✅ Donation / support system
- ✅ User dashboard and profile management
- ✅ Admin panel for platform management
- ✅ Real-time campaign tracking with progress bars
- ✅ Responsive design with modern UI/UX

<br>

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Technology Stack
</p>
</div>

| Layer | Technology |
|:------|:-----------|
| **Frontend** | HTML5, CSS3, JavaScript |
| **Backend** | PHP |
| **Database** | MySQL |
| **Server** | XAMPP (Apache + MySQL) |
| **Version Control** | Git |

<br>

<div align="center">
<p style="
  font-family: 'DIN Next', 'Roboto Mono', 'Courier New', monospace;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 12px;
  color: #6B7280;">
  Project Structure
</p>
</div>

```text
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
