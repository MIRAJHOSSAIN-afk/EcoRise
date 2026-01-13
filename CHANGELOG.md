# Changelog

All notable changes to the EcoRise project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- MVC architecture implementation
  - Core framework with Database and Controller classes
  - User model with authentication methods
  - Campaign model with CRUD operations
  - AuthController for signin/signup/logout
  - CampaignController for campaign management
  - UserController for dashboard and profile

## [1.0.0] - 2026-01-13

### Added
- Initial project setup
- User authentication system (signin/signup)
- Campaign management (create, read, update, delete)
- Donation/support functionality
- User dashboard with profile management
- Admin panel
- Password change functionality
- Session-based authentication
- Campaign image upload system
- Real-time campaign data loading with AJAX
- Responsive UI with modern CSS styling
- Database schema with users, campaigns, and donations tables

### Security
- Password hashing with bcrypt
- SQL injection prevention with prepared statements
- XSS protection with htmlspecialchars
- Input validation (client-side and server-side)
- Session management
- File upload validation

### Database
- Users table with role-based access control
- Campaigns table with target and raised amounts
- Support for campaign images
- Proper relationships and constraints

### UI/UX
- Modern responsive design
- Gradient buttons with hover effects
- Campaign cards with progress bars
- Navigation system
- Form validation feedback
- Error and success messages
- Professional color scheme

## Version History

### Version Numbering
- **Major**: Breaking changes or significant new features
- **Minor**: New features, backward-compatible
- **Patch**: Bug fixes and minor improvements

## Notes
- Project started: September 2025
- Current version: 1.0.0
- Last updated: January 13, 2026
