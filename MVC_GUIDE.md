# MVC Implementation Guide for EcoRise

## Overview
Your EcoRise project has been set up with MVC (Model-View-Controller) architecture. This document explains how to use it.

## Folder Structure
```
EcoRise-main/
├── app/
│   ├── core/
│   │   ├── Database.php      # Singleton database connection
│   │   └── Controller.php    # Base controller class
│   ├── models/
│   │   ├── User.php          # User model
│   │   └── Campaign.php      # Campaign model
│   ├── controllers/
│   │   ├── AuthController.php     # Authentication
│   │   ├── CampaignController.php # Campaign management
│   │   └── UserController.php     # User dashboard
│   └── views/
│       ├── auth/
│       │   ├── signin.php
│       │   └── signup.php
│       ├── campaigns/
│       └── user/
├── assets/
└── [your existing PHP files]
```

## How MVC Works

### 1. **Model** (Data Layer)
- Located in `app/models/`
- Handles all database operations
- Example: `User.php`, `Campaign.php`

**User.php Example:**
```php
$userModel = new User();
$user = $userModel->findByEmail('email@example.com');
$userModel->create('John Doe', 'john@example.com', 'password');
```

### 2. **View** (Presentation Layer)
- Located in `app/views/`
- Contains only HTML/CSS/JavaScript
- Receives data from controllers
- No direct database queries

### 3. **Controller** (Logic Layer)
- Located in `app/controllers/`
- Processes requests
- Interacts with models
- Loads views with data

## Migration Steps

### Step 1: Update Your Existing Files

**Replace signin.php:**
```php
<?php
require_once 'app/controllers/AuthController.php';
$controller = new AuthController();
$controller->signin();
```

**Replace signup.php:**
```php
<?php
require_once 'app/controllers/AuthController.php';
$controller = new AuthController();
$controller->signup();
```

**Replace logout.php:**
```php
<?php
require_once 'app/controllers/AuthController.php';
$controller = new AuthController();
$controller->logout();
```

**Replace getCampaigns.php:**
```php
<?php
require_once 'app/controllers/CampaignController.php';
$controller = new CampaignController();
$controller->getAllJson();
```

**Replace dashboard.php:**
```php
<?php
require_once 'app/controllers/UserController.php';
$controller = new UserController();
$controller->dashboard();
```

### Step 2: Move View Files

Move your HTML/CSS content from existing PHP files to view files:

**Example - Moving signin.php HTML:**
1. Copy HTML from current `signin.php` (lines after PHP processing)
2. Paste into `app/views/auth/signin.php`
3. Replace `signin.php` with controller call

### Step 3: Test Each Component

1. **Test Authentication:**
   - Visit `signin.php` - should work with new MVC structure
   - Try signup, signin, logout

2. **Test Campaigns:**
   - Test `getCampaigns.php` - should return JSON
   - Test adding/editing campaigns

3. **Test Dashboard:**
   - Visit dashboard - should show user info
   - Test profile updates

## Benefits of MVC

✅ **Separation of Concerns**: Code is organized by responsibility
✅ **Reusability**: Models can be reused across controllers
✅ **Testability**: Each component can be tested independently
✅ **Maintainability**: Easier to find and fix bugs
✅ **Scalability**: Easy to add new features
✅ **Team Collaboration**: Multiple developers can work on different layers

## Example Usage

### Creating a New Feature

**1. Create Model** (`app/models/Donation.php`):
```php
class Donation {
    public function create($user_id, $campaign_id, $amount) {
        // Database logic
    }
    
    public function getUserDonations($user_id) {
        // Get donations
    }
}
```

**2. Create Controller** (`app/controllers/DonationController.php`):
```php
class DonationController extends Controller {
    public function process() {
        $this->requireAuth();
        $donationModel = new Donation();
        // Process donation
        $this->view('donations/thank_you', $data);
    }
}
```

**3. Create View** (`app/views/donations/thank_you.php`):
```php
<!DOCTYPE html>
<html>
<body>
    <h1>Thank you for your donation!</h1>
    <p>Amount: $<?php echo $amount; ?></p>
</body>
</html>
```

**4. Create Entry Point** (`process_donation.php`):
```php
<?php
require_once 'app/controllers/DonationController.php';
$controller = new DonationController();
$controller->process();
```

## Key Classes Reference

### Database.php
```php
$db = Database::getInstance();
$conn = $db->getConnection();
```

### Controller.php (Base Class)
```php
$this->model('User');           // Load model
$this->view('auth/signin', $data);  // Load view
$this->redirect('homepage.php');    // Redirect
$this->requireAuth();           // Check login
$this->isAdmin();              // Check admin
```

### Models
```php
// User Model
$user->findByEmail($email);
$user->findById($id);
$user->create($name, $email, $password);
$user->update($id, $name, $address, $contact);

// Campaign Model
$campaign->getAll();
$campaign->findById($id);
$campaign->create($title, $goal, $target, $location, $image);
$campaign->update($id, $title, $goal, $target);
$campaign->delete($id);
```

## Next Steps

1. ✅ MVC structure created
2. ⏳ Migrate remaining files (homepage.php, support.php, etc.)
3. ⏳ Move all views to `app/views/`
4. ⏳ Create controllers for remaining features
5. ⏳ Add routing system (optional)
6. ⏳ Test thoroughly

## Questions?

- Models = Database operations
- Views = HTML/CSS display
- Controllers = Business logic + connect models & views

Your project now has a solid MVC foundation! 🎉
