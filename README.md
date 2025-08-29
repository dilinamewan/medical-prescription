# Medical Prescription System

A comprehensive web-based medical prescription management system built with PHP, MySQL, and Bootstrap 5. This system allows patients to upload prescription images and receive quotations from pharmacies.

## 🚀 Features

### For Patients
- **User Registration & Login** - Secure account creation and authentication
- **Prescription Upload** - Upload prescription images with automatic storage
- **Quotation Management** - View and respond to pharmacy quotations
- **Status Tracking** - Track prescription status (pending, quoted, accepted, rejected)
- **Email Notifications** - Get notified when quotations are ready

### For Pharmacies
- **Pharmacy Dashboard** - Manage all prescription requests
- **Prescription Review** - View uploaded prescription images
- **Quotation Creation** - Create detailed quotations with multiple items
- **Real-time Calculations** - Automatic line total and grand total calculations
- **Quotation Management** - Update existing quotations when needed

### System Features
- **Responsive Design** - Bootstrap 5 powered UI that works on all devices
- **Security** - CSRF protection, password hashing, session management
- **Image Upload** - Secure file upload with validation
- **Email Integration** - Automated email notifications
- **Professional UI** - Modern, clean interface with intuitive navigation

## 🛠️ Technologies Used

- **Backend**: PHP 8.2+
- **Database**: MySQL 8.0+
- **Frontend**: HTML5, CSS3, JavaScript ES6
- **Framework**: Bootstrap 5.3
- **Icons**: Bootstrap Icons
- **Server**: Apache (XAMPP)

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
