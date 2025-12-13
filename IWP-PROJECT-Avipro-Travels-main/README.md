# IWP-PROJECT-Avipro-Travels
A travel website that lets you seemlessly navigate through options and lets you choose your travel based on your personal preferences.

## Key Features & Benefits

*   **Seamless Navigation:** Easily browse through various travel options.
*   **Personalized Recommendations:** Find travel packages tailored to your preferences.
*   **User-Friendly Interface:** Intuitive design for a smooth user experience.
*   **Admin Panel:** Manage bookings and website content efficiently.

## Technologies

# 💻 Tech Stack:
![Apache Groovy](https://img.shields.io/badge/Apache%20Groovy-4298B8.svg?style=for-the-badge&logo=Apache+Groovy&logoColor=white) ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Project Structure
```
📦 IWP-PROJECT-Avipro-Travels
├─ .gitattributes
├─ README.md
├─ about.html
├─ admin-login.php
├─ admin
│  ├─ admin-panel.php
│  ├─ bookings.html
│  └─ packages.php
├─ assets
│  └─ images
├─ contact.html
├─ css
│  ├─ admin.css
│  └─ style.css
├─ database
│  ├─ avipro_travels.sql
│  └─ bookings.sql
├─ gallery.html
├─ images
├─ index.html
├─ js
│  ├─ admin.js
│  ├─ forms.js
│  └─ main.js
├─ package-details.html
├─ packages.html
└─ php
   ├─ auth.php
   ├─ bookings.php
   ├─ config.php
   ├─ logout.php
   └─ packages.php
```

## Prerequisites & Dependencies

*   Web server (e.g., Apache, Nginx)
*   PHP (version 7.0 or higher)
*   MySQL or MariaDB database

## Installation & Setup Instructions

 **Avipro Travels - Installation Guide**

*Step-by-Step Installation Process*

Step 1: Download and Install XAMPP

Download XAMPP

1.  Visit: https://www.apachefriends.org/

2.  Download the version for your operating system

Install XAMPP

1.  Run the installer

2.  Select components: Apache, MySQL, PHP, phpMyAdmin

3.  Choose installation directory (default: C:\xampp)

4.  Complete installation

Start Services

1.  Open XAMPP Control Panel

2.  Start Apache and MySQL

3.  You should see green indicators

________________________________________

Step 2: Setup Project Files

Extract Project Files

bash

-Extract the avipro-travels.zip to:

      C:\xampp\htdocs\avipro-travels

Folder Structure

C:\xampp\htdocs\avipro-travels

├── index.html

├── about.html

├── packages.html

├── package-details.html

├── contact.html

├── admin-login.html

├── admin/

├── css/

├── js/

├── php/

├── database/

└── assets/

Verify File Structure

-  Ensure all folders are properly extracted

-  Check that php/ and database/ folders exist

________________________________________

Step 3: Database Setup

Access phpMyAdmin

1.  Open web browser

        2.  Go to: http://localhost/phpmyadmin

Create Database


-- In phpMyAdmin:

-- 1. Click "New" in left sidebar

-- 2. Enter database name: "avipro_travels"

-- 3. Click "Create"

Import Database Schema

1.  Click on avipro_travels database

2.  Go to Import tab

3.  Click Choose File

4.  Select: avipro-travels/database/avipro_travels.sql

5.  Click Go

Verify Database Import

You should see these tables:

-  admin_users

-  packages

-  bookings

-  enquiries

-  site_content

________________________________________

Step 4: Configuration

Edit Database Configuration

    Open file: avipro-travels/php/config.php

Update database credentials if different:

// In config.php - Update if your setup is different

    define('DB_HOST', 'localhost');

    define('DB_NAME', 'avipro_travels');

    define('DB_USER', 'root');      // Default XAMPP username

    define('DB_PASS', '');          // Default XAMPP password (empty)

Configure File Uploads

1.  Create uploads directory:

bash

-Create folder if it doesn't exist

mkdir C:\xampp\htdocs\avipro-travels\assets\uploads

2.  Set folder permissions:

bash

-Right-click on 'uploads' folder

-Properties → Security → Edit permissions

-Allow "Write" permissions for Apache user

________________________________________

Step 5: Test Installation

Start Local Server

-  Ensure XAMPP Apache and MySQL are running

-  Green indicators in XAMPP control panel

Access Website

1.  Open web browser

2.  Go to: http://localhost/avipro-travels

Verify Frontend

-  Homepage should load with travel packages

-  Navigation should work between pages

-  Images should display properly

________________________________________

🚀 Execution & Usage

Accessing the Website

*Frontend Access*

URL: http://localhost/avipro-travels

*Admin Panel Access*

URL: http://localhost/avipro-travels/admin-login.html

*Default Credentials:*

    Username: admin
    Password: admin123

## Usage Examples & API Documentation

*   **User Interface:**  Browse available travel packages on the homepage, filter by destination, and view detailed itineraries.
*   **Admin Panel:** Log in to the admin panel (likely via `/admin-login.php`) to manage bookings, update packages, and administer the website.
*   (Further API Documentation would be required based on the functional codebase).

## Configuration Options

*   **Database Configuration:**  Modify database credentials in the configuration file.
*   **Website Appearance:** Edit CSS files in the `css/` directory to customize the website's look and feel.
*   **Admin Panel Security:** Consider adding stronger authentication measures for the admin panel.

## Contributing Guidelines

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix.
3.  Implement your changes and write appropriate tests.
4.  Submit a pull request with a clear description of your changes.

