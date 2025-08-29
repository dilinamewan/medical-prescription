# Medical Prescription System - Practical Task Submission

A comprehensive web-based medical prescription management system built with PHP, MySQL, and Bootstrap 5. This system allows patients to upload prescription images and receive quotations from pharmacies.

## � Task Completion Details

**Time Spent**: 8 hours
**Completion Date**: August 29, 2025
**Developer**: Medical Prescription System Team

### Time Breakdown:
- **Database Design & Setup**: 1.5 hours
- **Backend Development (PHP/MVC)**: 3 hours  
- **Frontend Development (Bootstrap 5 UI)**: 2.5 hours
- **Testing & Bug Fixes**: 1 hour

## 🔐 Login Credentials

### Patient Account
- **Email**: `user@gmail.com`
- **Password**: `123456`
- **Role**: Patient/User

### Pharmacy Account  
- **Email**: `pharmacy@test.com`
- **Password**: `Pharmacy@123`
- **Role**: Pharmacy

### Admin/Database Access
- **Database**: `medical_prescription`
- **Username**: `root`
- **Password**: *(empty for XAMPP default)*
- **Host**: `localhost`
- **Port**: `3306`

## 🚀 Quick Setup Instructions

### Prerequisites
- XAMPP (Apache + MySQL + PHP 8.2+)
- Web browser (Chrome, Firefox, Safari)
- Text editor (optional, for code review)

### Installation Steps

1. **Start XAMPP Services**
   ```bash
   # Start Apache and MySQL from XAMPP Control Panel
   ```

2. **Extract Project Files**
   - Extract the ZIP file to `C:\xampp\htdocs\medical-prescription`

3. **Database Setup**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create database: `medical_prescription`
   - Import: `database/medical_prescription.sql`

4. **Configuration Check**
   - Verify `config/config.php` database settings
   - Ensure `public/uploads/` folder has write permissions

5. **Access Application**
   - Main URL: `http://localhost/medical-prescription`
   - Login Page: `http://localhost/medical-prescription/?action=login`

## 🎯 Implemented Features

### Core Functionality ✅

#### Patient Features
- [x] **User Registration** - Secure account creation
- [x] **User Login/Logout** - Session-based authentication  
- [x] **Prescription Upload** - Multiple image upload with validation
- [x] **View Prescriptions** - List all uploaded prescriptions
- [x] **View Quotations** - Review pharmacy quotations
- [x] **Accept/Reject Quotations** - Decision making on quotes
- [x] **Dashboard** - Overview of prescription status

#### Pharmacy Features  
- [x] **Pharmacy Login** - Role-based access
- [x] **View Prescriptions** - List of pending prescriptions
- [x] **Create Quotations** - Detailed pricing with multiple items
- [x] **Update Quotations** - Modify existing quotations
- [x] **View Quotation Status** - Track user responses
- [x] **Dashboard** - Pharmacy management overview

#### System Features
- [x] **Responsive Design** - Bootstrap 5 mobile-first UI
- [x] **Security** - CSRF protection, password hashing
- [x] **File Management** - Secure image upload and storage
- [x] **Email Notifications** - Automated user notifications
- [x] **Status Tracking** - Real-time prescription status updates
- [x] **Data Validation** - Form validation and sanitization

### Technical Implementation ✅

#### Architecture
- [x] **MVC Pattern** - Clean separation of concerns
- [x] **Object-Oriented PHP** - Modern PHP 8.2 features
- [x] **Prepared Statements** - SQL injection prevention
- [x] **Session Management** - Secure user sessions
- [x] **Error Handling** - Graceful error management

#### Database Design
- [x] **Normalized Schema** - Efficient relational design
- [x] **Foreign Key Constraints** - Data integrity
- [x] **Status Enums** - Controlled status values
- [x] **Audit Fields** - Created/updated timestamps

#### Frontend
- [x] **Bootstrap 5** - Modern responsive framework
- [x] **Bootstrap Icons** - Consistent iconography
- [x] **Interactive Forms** - Dynamic quotation creation
- [x] **Modal Dialogs** - Image viewing and confirmations
- [x] **Real-time Calculations** - JavaScript-powered totals

## 📁 Project Structure

```
medical-prescription/
├── 📄 README.md                    # This documentation
├── 📄 database/
│   └── medical_prescription.sql    # Complete database dump
├── 📁 app/
│   ├── 📁 controllers/            # MVC Controllers
│   ├── 📁 models/                 # Data Models  
│   └── 📁 views/                  # UI Templates
├── 📁 config/
│   └── config.php                 # Application settings
├── 📁 helpers/                    # Utility functions
├── 📁 public/
│   ├── index.php                  # Entry point
│   ├── 📁 assets/                 # CSS/JS files
│   └── 📁 uploads/                # User uploads
└── 📄 .htaccess                   # Apache configuration
```

## 🎥 Demonstration Video

*A demonstration video showing all implemented features is included in the submission package.*

**Video Contents:**
1. **Setup Process** (2 minutes)
   - Database import
   - Application access
   
2. **Patient Workflow** (5 minutes)
   - Registration and login
   - Prescription upload
   - Quotation review
   - Accept/reject functionality

3. **Pharmacy Workflow** (5 minutes)  
   - Pharmacy login
   - Prescription review
   - Quotation creation
   - Status management

4. **UI/UX Showcase** (3 minutes)
   - Responsive design
   - Mobile compatibility
   - Professional interface

## 🔧 Technical Specifications

### System Requirements
- **PHP**: 8.2 or higher
- **MySQL**: 8.0 or higher  
- **Apache**: 2.4 or higher
- **Browser**: Chrome 90+, Firefox 88+, Safari 14+

### Dependencies
- **Bootstrap**: 5.3.0 (CDN)
- **Bootstrap Icons**: 1.10.0 (CDN)
- **PDO**: PHP Data Objects for database
- **GD Extension**: Image processing
- **Sessions**: PHP session management

### Security Features
- Password hashing with `PASSWORD_BCRYPT`
- CSRF token protection on all forms
- SQL injection prevention via prepared statements
- File upload validation and sanitization
- Session-based authentication
- Role-based access control

## 🚀 Production Deployment

### Server Requirements
- Linux/Windows server with PHP 8.2+
- MySQL 8.0+ database
- Apache/Nginx web server
- SSL certificate (recommended)

### Environment Configuration
```bash
# Update config/config.php for production
DB_HOST=your_production_host
DB_NAME=medical_prescription
DB_USER=your_db_user  
DB_PASS=your_secure_password
```

## 🐛 Known Issues & Limitations

### Minor Issues
- Email functionality requires SMTP configuration
- File upload size limited by PHP settings
- Session timeout set to default PHP values

### Future Enhancements
- Payment integration for accepted quotations
- SMS notifications alongside email
- Advanced prescription OCR/text recognition
- Multi-language support
- API endpoints for mobile apps

## 📊 Testing Completed

### Manual Testing ✅
- [x] User registration with validation
- [x] Login/logout functionality  
- [x] File upload with multiple images
- [x] Quotation creation and calculation
- [x] Status updates and notifications
- [x] Responsive design on multiple devices
- [x] Browser compatibility testing
- [x] Security testing (CSRF, XSS prevention)

### Test Data
- Sample prescription images included
- Test user accounts pre-configured
- Sample quotations for demonstration

## 📞 Support & Contact

For any setup issues or questions:
- **Technical Support**: Check the troubleshooting section below
- **Code Review**: All source code included with comments
- **Database Issues**: SQL file provided with complete schema

## 🔧 Troubleshooting

### Common Setup Issues

**Database Connection Error:**
```php
// Verify config/config.php settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'medical_prescription');
define('DB_USER', 'root');
define('DB_PASS', ''); // Empty for XAMPP
```

**Upload Permission Error:**
```bash
# Set folder permissions (Windows)
Right-click public/uploads → Properties → Security → Edit → Full Control

# Or create folder manually if missing
mkdir public/uploads
```

**Apache Rewrite Issues:**
```apache
# Ensure .htaccess is present and mod_rewrite enabled
# Check XAMPP Apache httpd.conf for AllowOverride All
```

---

**✅ Task Completed Successfully**
**📦 All files included in submission ZIP**
**🎯 Ready for evaluation**

## 📋 Requirements

- PHP 8.2 or higher
- MySQL 8.0 or higher
- Apache Web Server
- XAMPP (recommended for local development)

## ⚡ Quick Start

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/medical-prescription-system.git
cd medical-prescription-system
```

### 2. Setup XAMPP
- Install [XAMPP](https://www.apachefriends.org/download.html)
- Start Apache and MySQL services
- Place project in `C:\xampp\htdocs\medical-prescription`

### 3. Database Setup
```sql
-- Create database
CREATE DATABASE medical_prescription;

-- Import the schema
mysql -u root -p medical_prescription < database/schema.sql
```

Or use phpMyAdmin:
1. Open http://localhost/phpmyadmin
2. Create database `medical_prescription`
3. Import `database/schema.sql`

### 4. Configuration
Update database credentials in `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'medical_prescription');
define('DB_USER', 'root');
define('DB_PASS', ''); // Your MySQL password
```

### 5. Access the Application
- **Main Application**: http://localhost/medical-prescription
- **Patient Registration**: http://localhost/medical-prescription/?action=register
- **Login**: http://localhost/medical-prescription/?action=login

## 👥 Default Users

### Patient Account
- **Email**: `patient@test.com`
- **Password**: `Patient@123`

### Pharmacy Account
- **Email**: `pharmacy@test.com`
- **Password**: `Pharmacy@123`

## 📁 Project Structure

```
medical-prescription/
├── app/
│   ├── controllers/          # MVC Controllers
│   │   ├── AuthController.php
│   │   ├── PharmacyController.php
│   │   ├── PrescriptionController.php
│   │   └── QuotationController.php
│   ├── models/              # Data Models
│   │   ├── BaseModel.php
│   │   ├── Prescription.php
│   │   ├── PrescriptionImage.php
│   │   ├── Quotation.php
│   │   ├── QuotationItem.php
│   │   └── User.php
│   └── views/               # View Templates
│       ├── auth/            # Authentication views
│       ├── partials/        # Shared components
│       ├── pharmacy/        # Pharmacy dashboard
│       └── user/            # Patient dashboard
├── config/
│   └── config.php           # Application configuration
├── database/
│   └── schema.sql           # Database structure
├── helpers/                 # Helper functions
│   ├── auth.php
│   ├── csrf.php
│   └── mailer.php
├── public/
│   ├── index.php            # Application entry point
│   ├── assets/              # CSS, JS, Images
│   └── uploads/             # Uploaded files
└── README.md
```

## 🔒 Security Features

- **CSRF Protection** - All forms protected against CSRF attacks
- **Password Hashing** - Secure bcrypt password hashing
- **Session Management** - Secure session handling
- **File Upload Security** - Validated file uploads with type checking
- **SQL Injection Protection** - Prepared statements throughout
- **Access Control** - Role-based access control

## 📱 Responsive Design

The application is fully responsive and works seamlessly on:
- 📱 Mobile phones (320px and up)
- 📱 Tablets (768px and up)  
- 💻 Desktops (992px and up)
- 🖥️ Large screens (1200px and up)

## 🚀 Deployment

### Production Deployment
1. Upload files to your web server
2. Create MySQL database and import schema
3. Update `config/config.php` with production database credentials
4. Set proper file permissions for uploads directory
5. Configure your web server (Apache/Nginx)

### Environment Variables (Recommended)
```bash
DB_HOST=localhost
DB_NAME=medical_prescription
DB_USER=your_db_user
DB_PASS=your_secure_password
SMTP_HOST=your_smtp_server
SMTP_USER=your_email
SMTP_PASS=your_email_password
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🐛 Issue Reporting

If you find any bugs or have feature requests, please create an issue on GitHub with:
- Clear description of the problem
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)

## 📧 Support

For support and questions:
- Create an issue on GitHub
- Email: support@yourcompany.com

## 🙏 Acknowledgments

- Bootstrap team for the excellent CSS framework
- PHP community for comprehensive documentation
- Contributors and testers

## 📊 Screenshots

### Patient Dashboard
![Patient Dashboard](screenshots/patient-dashboard.png)

### Pharmacy Dashboard  
![Pharmacy Dashboard](screenshots/pharmacy-dashboard.png)

### Quotation Creation
![Quotation Creation](screenshots/create-quotation.png)

---

**Made with ❤️ for better healthcare management**
