<h1 align="center" style="color:#2c3e50; font-weight:bold;">
  Police Department Hardware Inventory Management System
</h1>

<p align="center">
  <em>A comprehensive web and mobile-based system for managing police hardware assets with real-time updates, automated reporting, and secure access.</em>
</p>

---

## 🚀 Features

- **Real-Time Inventory Management** – Track hardware allocation, updates, and disposal.  
- **Role-Based Authentication** – Secure login for admins and department staff.  
- **Automated Reports** – Generate PDF and Excel reports for audits.  
- **Email Notifications** – Integrated with PhpMailer for instant updates.  
- **Search & Filter** – Quickly retrieve equipment details.  
- **Responsive UI** – Optimized for both desktop and mobile devices.  

---

## 🛠 Tech Stack

<div style="display:flex; gap:10px; flex-wrap:wrap;">
  <img src="https://img.shields.io/badge/Frontend-HTML%2FCSS%2FJS-blue" />
  <img src="https://img.shields.io/badge/Backend-PHP-green" />
  <img src="https://img.shields.io/badge/Database-MySQL-orange" />
  <img src="https://img.shields.io/badge/Email-PHPMailer-purple" />
</div>

---

## 📂 Project Structure

inventory-management/<br>
│── assets/ # CSS, JS, images<br>
│── config/ # Database configuration<br>
│── modules/ # Core inventory modules<br>
│── reports/ # PDF/Excel report generation<br>
│── index.php # Landing page<br>
│── login.php # Authentication<br>
│── README.md # Project documentation<br>

---

## ⚙️ Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/police-inventory-management.git
```
### 2. Import the Database
Import inventory_db.sql into MySQL using phpMyAdmin or MySQL CLI.

### 3. Configure Database
Open config.php and set your database credentials:<br>
$host = 'localhost';<br>
$user = 'root';<br>
$password = '';<br>
$database = 'inventory_db';<br>

### 4. Run the Project
Start XAMPP/LAMP server and open:<br>
http://localhost/inventory-management

