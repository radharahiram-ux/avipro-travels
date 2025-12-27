# ✈️ Avipro Travels

<div align="center">

![Avipro Travels](https://img.shields.io/badge/Travel-Website-blue?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

*A comprehensive travel booking platform that lets you seamlessly navigate through destinations and choose your perfect journey based on personal preferences.**

[View Demo](#) • [Report Bug](#) • [Request Feature](#)

</div>

---

## 📋 Table of Contents

- [About The Project](#-about-the-project)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Database Setup](#database-setup)
- [Usage](#-usage)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## 🌟 About The Project

Avipro Travels is a modern, full-stack travel booking website designed to provide users with an intuitive platform for exploring and booking their dream vacations. With a powerful admin panel and seamless user experience, managing travel packages has never been easier.

### Why Avipro Travels?

- 🎯 **User-Centric Design**: Clean, intuitive interface for effortless browsing
- 🔐 **Secure Admin Panel**: Robust backend for managing bookings and content
- 📱 **Responsive Layout**: Perfect experience across all devices
- ⚡ **Fast Performance**: Optimized for quick loading and smooth navigation
- 🎨 **Customizable**: Easy to modify and extend functionality

---

## ✨ Key Features

## 🌐 Frontend Features

- **Seamless Navigation**: Easily browse through various travel destinations and packages
- **Package Gallery**: Visual showcase of available travel options with detailed descriptions
- **Advanced Filtering**: Find packages based on destination, duration, and price
- **Contact Forms**: Quick enquiry system for customer support
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices

## 🛠️ Admin Features

- **Dashboard Analytics**: Overview of bookings, revenue, and customer insights
- **Package Management**: Add, edit, or remove travel packages with ease
- **Booking Management**: View and manage customer bookings in real-time
- **Content Management**: Update website content without touching code
- **User Authentication**: Secure login system for admin access

---

## 💻 Tech Stack

<table>
  <tr>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="48" height="48" alt="HTML5" />
      <br>HTML5
    </td>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="48" height="48" alt="CSS3" />
      <br>CSS3
    </td>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="48" height="48" alt="JavaScript" />
      <br>JavaScript
    </td>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="48" height="48" alt="PHP" />
      <br>PHP
    </td>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="48" height="48" alt="MySQL" />
      <br>MySQL
    </td>
    <td align="center" width="96">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apache/apache-original.svg" width="48" height="48" alt="Apache" />
      <br>Apache
    </td>
  </tr>
</table>

**Backend**: PHP 7.0+, Apache Groovy  
**Frontend**: HTML5, CSS3, JavaScript  
**Database**: MySQL / MariaDB  
**Server**: Apache / Nginx

---

## 📁 Project Structure

```
📦 IWP-PROJECT-Avipro-Travels
├─ 📄 .gitattributes
├─ 📄 README.md
├─ 📄 index.html                    # Homepage
├─ 📄 about.html                    # About Us page
├─ 📄 packages.html                 # Travel packages listing
├─ 📄 package-details.html          # Individual package details
├─ 📄 contact.html                  # Contact page
├─ 📄 gallery.html                  # Image gallery
├─ 📄 admin-login.php               # Admin authentication
│
├─ 📁 admin/                        # Admin panel
│  ├─ admin-panel.php               # Main admin dashboard
│  ├─ bookings.html                 # Booking management
│  └─ packages.php                  # Package management
│
├─ 📁 css/                          # Stylesheets
│  ├─ style.css                     # Main stylesheet
│  └─ admin.css                     # Admin panel styles
│
├─ 📁 js/                           # JavaScript files
│  ├─ main.js                       # Main JS functionality
│  ├─ forms.js                      # Form validation
│  └─ admin.js                      # Admin panel scripts
│
├─ 📁 php/                          # Backend logic
│  ├─ config.php                    # Database configuration
│  ├─ auth.php                      # Authentication handler
│  ├─ bookings.php                  # Booking operations
│  ├─ packages.php                  # Package operations
│  └─ logout.php                    # Logout handler
│
├─ 📁 database/                     # Database files
│  ├─ avipro_travels.sql            # Main database schema
│  └─ bookings.sql                  # Bookings table schema
│
├─ 📁 assets/                       # Static assets
│  └─ images/                       # Image files
│
└─ 📁 images/                       # Additional images
```

---

## 🚀 Getting Started

Follow these steps to set up Avipro Travels on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:

- **Web Server**: Apache or Nginx
- **PHP**: Version 7.0 or higher
- **Database**: MySQL or MariaDB
- **XAMPP/WAMP/MAMP**: (Recommended for local development)

### Installation

#### Step 1: Install XAMPP

1. **Download XAMPP**
   ```
   Visit: https://www.apachefriends.org/
   ```

2. **Install Components**
   - Select: Apache, MySQL, PHP, phpMyAdmin
   - Installation directory: `C:\xampp` (Windows) or `/Applications/XAMPP` (Mac)

3. **Start Services**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**
   - Verify green indicators are showing

#### Step 2: Setup Project Files

1. **Extract Project**
   ```bash
   # Extract to XAMPP htdocs folder
   C:\xampp\htdocs\avipro-travels\
   ```

2. **Verify Folder Structure**
   ```
   C:\xampp\htdocs\avipro-travels\
   ├── index.html
   ├── admin/
   ├── css/
   ├── js/
   ├── php/
   ├── database/
   └── assets/
   ```

#### Step 3: Database Setup

1. **Access phpMyAdmin**
   ```
   Open browser: http://localhost/phpmyadmin
   ```

2. **Create Database**
   ```sql
   -- Click "New" in left sidebar
   -- Database name: avipro_travels
   -- Click "Create"
   ```

3. **Import Schema**
   - Select `avipro_travels` database
   - Go to **Import** tab
   - Choose file: `database/avipro_travels.sql`
   - Click **Go**

4. **Verify Tables**
   ```
   ✓ admin_users
   ✓ packages
   ✓ bookings
   ✓ enquiries
   ✓ site_content
   ```

#### Step 4: Configuration

1. **Update Database Config**
   
   Edit `php/config.php`:
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'avipro_travels');
   define('DB_USER', 'root');          // Your MySQL username
   define('DB_PASS', '');              // Your MySQL password
   ?>
   ```

2. **Create Upload Directory**
   ```bash
   # Create uploads folder
   mkdir assets/uploads
   
   # Set permissions (Windows: Right-click → Properties → Security)
   chmod 755 assets/uploads
   ```

#### Step 5: Launch Application

1. **Start XAMPP Services**
   - Ensure Apache and MySQL are running (green indicators)

2. **Access Website**
   ```
   Frontend: http://localhost/avipro-travels
   Admin Panel: http://localhost/avipro-travels/admin-login.php
   ```

3. **Test Installation**
   - Homepage loads correctly ✓
   - Navigation works ✓
   - Images display ✓
   - Database connection successful ✓

---

## 📖 Usage

### 🌐 Frontend Access

```
URL: http://localhost/avipro-travels
```

**User Features:**
- Browse travel packages on homepage
- Filter packages by destination and price
- View detailed package information
- Submit enquiries through contact form
- Explore travel gallery

### 🔐 Admin Panel Access

```
URL: http://localhost/avipro-travels/admin-login.php
```

**Default Credentials:**
```
Username: admin
Password: admin123
```

> ⚠️ **Security Warning**: Change default credentials immediately in production!

**Admin Capabilities:**
- Dashboard with analytics overview
- Add/Edit/Delete travel packages
- Manage customer bookings
- View and respond to enquiries
- Update website content
- Upload package images

---

## 📸 Screenshots

### Homepage
*Beautiful landing page showcasing featured destinations*

### Package Listing
*Browse through curated travel packages*

### Admin Dashboard
*Comprehensive admin panel for managing bookings*

### Booking Management
*Track and manage customer reservations*

---

## 🎨 Customization

### Styling
Edit `css/style.css` to customize:
- Color schemes
- Typography
- Layout spacing
- Responsive breakpoints

### Database
Modify database schema in `database/avipro_travels.sql` for:
- Additional fields
- New tables
- Custom relationships

### Functionality
Extend features by editing:
- `js/main.js` - Frontend functionality
- `php/*.php` - Backend logic
- `admin/*.php` - Admin panel features

---

## 🤝 Contributing

Contributions make the open-source community an amazing place to learn and create. Any contributions are **greatly appreciated**!

### How to Contribute

1. **Fork the Project**
   ```bash
   git clone https://github.com/yourusername/avipro-travels.git
   ```

2. **Create Feature Branch**
   ```bash
   git checkout -b feature/AmazingFeature
   ```

3. **Commit Changes**
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```

4. **Push to Branch**
   ```bash
   git push origin feature/AmazingFeature
   ```

5. **Open Pull Request**
   - Provide clear description of changes
   - Include screenshots if applicable
   - Reference any related issues

### Development Guidelines

- Follow existing code style and conventions
- Write clear, commented code
- Test thoroughly before submitting
- Update documentation as needed

---

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

---

## 📞 Contact

**Project Maintainer**: Kavyansh Krishan

- Email: kavyansh.krishan@email.com
- GitHub: [@your-github-username](https://github.com/your-github-username)
- Project Link: [https://github.com/your-username/avipro-travels](https://github.com/your-username/avipro-travels)

---

## 🙏 Acknowledgments

- [Apache Friends](https://www.apachefriends.org/) - XAMPP Development Environment
- [Font Awesome](https://fontawesome.com) - Icons
- [Unsplash](https://unsplash.com) - Stock Images
- All contributors who helped build this project

---

<div align="center">

### ⭐ Star this repository if you found it helpful!

Made with ❤️ by Kavyansh Krishan

[Back to Top ↑](#-avipro-travels)

</div>
