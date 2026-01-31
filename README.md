# Facilities Booking System

## 🎯 Project Overview  

CakePHP 5.x web application for **facility booking management** at an educational institution (e.g., UiTM). Supports user bookings, admin approvals, and role-based access with a 5-table MySQL schema.

- default admin account = admin2@example.com password = 12345

**Key Features:**  
- User registration/login and facility booking  
- Admin dashboard for pending approval/rejection  
- Department-based facility organization  
- Time-slot conflict detection  
- Responsive UI with Bootstrap  

## 🛠 Tech Stack  

| Component | Technology |  
|-----------|------------|  
| Framework | CakePHP 5.0 |  
| Database | MySQL |  
| Auth | CakePHP Authentication 3.3 |  
| Quality | Psalm, PHPCS, PHPUnit |  
| Mobile | MobileDetectLib |  

## 📦 Prerequisites  

- PHP 8.1+  
- MySQL 8.0+  
- Composer  
- Apache/Nginx with mod_rewrite  

## 🚀 Quick Start  

### 1. Clone & Install  
```bash  
git clone <your-repo> facilities-booking  
cd facilities-booking  
composer install  
2. Database Setup
Import the schema:

bash
mysql -u root -p facilities_booking < schema.sql  
Add sample facilities:

sql
-- Run add_facilities.sql for Meeting Room, Football Field, Futsal Court  
3. Environment Config
Copy .env.example to .env:

bash
cp config/.env.example config/.env  
Edit config/app_local.php:

php
'Datasources' => [  
    'default' => [  
        'host' => 'localhost',  
        'database' => 'facilities_booking',  
        'username' => 'root',  
        'password' => 'your_password',  
    ],  
],  
4. Create Admin User
bash
# Debug users first  
bin/cake.php console -f debug_users.php  

# Or manually:  
UPDATE users SET role='admin' WHERE email='admin@facilities.com';  
5. Run Server
bash
bin/cake server -p 8765  
Visit http://localhost:8765

🔧 Development
Migrations
bash
bin/cake migrations create InitialSchema  
bin/cake migrations run  
Code Quality
bash
# Code style  
composer cs-check  
composer cs-fix  

# Static analysis  
composer stan  

# Tests  
composer test  
Debug Tools
debug_users.php: Check users/roles

CakePHP DebugKit (dev mode)

📱 Features Demo
User Flow: Register → Login → Browse Facilities → Book Slot

Admin Flow: Login (admin role) → Dashboard → Approve/Reject Bookings

Conflict Check: Prevents double-booking same facility/time

🐛 Troubleshooting
Issue	Solution
"No admin found"	Run debug_users.php → Update role manually
DB connection error	Check config/app_local.php credentials
500 errors	Enable debug => true in app_local.php
Facilities empty	Run add_facilities.sql
📈 Sample Data
Default Login:

Admin: admin@facilities.com / password

Users: john@test.com / password

Facilities Added (via add_facilities.sql):

Bilik Mesyuarat (capacity 20)

Padang Bola (capacity 50)

Gelanggang Futsal (capacity 30)

🤝 Contributing
Fork repo

Create feature branch

Run composer cs-check & tests

Submit PR

📄 License
MIT License (CakePHP standard)

🙌 Support
CakePHP Docs: https://book.cakephp.org/5/en/

