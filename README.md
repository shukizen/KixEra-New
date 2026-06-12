# KixEra 👟✨

KixEra is a premium, multi-role Point of Sale (POS) and Management Platform tailored specifically for shoe laundry businesses. Built on top of **CodeIgniter 3** (PHP), it leverages modern frontend UI elements using **Tailwind CSS**, interactive charts via **Chart.js** (supporting real-time dark/light mode switches), and integrated payment processing with **Midtrans Snap**.

---

## 🚀 Key Features

KixEra provides a highly customized workspace for three core user roles:

### 1. 👑 Super Administrator (Admin)
*   **System Health & Monitoring**: Real-time server and database monitoring logs.
*   **User Management**: Complete CRUD operations, role assignment (Owner, Employee, Admin), and account activation/deactivation.
*   **Subscription & Billing**: Package tier configurations (*Paket Langganan*) for business owners and integrated billing/invoicing systems.
*   **System Backup & Restore**: One-click database backup and restore functionalities.
*   **Helpdesk Ticket Manager**: Customer support ticket tracking and resolution dashboard.

### 2. 💼 Outlet Owner (Pemilik)
*   **Interactive Dashboard**: Dynamic analytics tracking daily orders, monthly revenues (with growth percentage), active customers, pending pickups, and branch-by-branch performance.
*   **KixEra AI Insights**: Automated business recommendations pointing out customer retention strategies, reminder recommendations for long-pending pickups, and optimal service promotions.
*   **Order & POS Tracking**: Comprehensive overview of orders, pricing, payment status, branches, and shoe conditions. Includes image upload logs for documenting *Before & After* wash pictures.
*   **Staff & Employee Registry**: Register and manage employees, tracking assignments across multiple branches.
*   **Financial Reports**: Input and track revenue/expenses, and export monthly statements to Excel (via PhpSpreadsheet) or PDF (via TCPDF/Mpdf).
*   **Layanan & Services Configuration**: Customize prices, categories, and duration of shoe wash services.

### 3. 🧑‍🔧 Outlet Employee (Karyawan)
*   **Employee POS Dashboard**: Simplified screen tracking work queue and daily targets.
*   **Order Processing**: Create new walk-in orders, assign customers, update wash process status (*Diterima*, *Dalam Proses*, *Selesai*, *Siap Diambil*, *Sudah Diambil*, *Dibatalkan*).
*   **Photo Documentation**: Take and upload photos of shoes before wash and after completion using camera integration.
*   **Supplies & Inventory Tracker**: Keep track of laundry liquid, brushes, and auxiliary supplies usage.

---

## 🛠️ Technology Stack

*   **Backend Framework**: [CodeIgniter 3.1.x](https://codeigniter.com/) (PHP >= 7.4 / 8.0 compatible)
*   **Frontend**: HTML5, Vanilla JavaScript, and [Tailwind CSS CDN](https://tailwindcss.com/)
*   **Icons**: [FontAwesome 6.4.2](https://fontawesome.com/)
*   **Charts**: [Chart.js 4.4.0](https://www.chartjs.org/) (Custom dark mode listeners built-in)
*   **Payment Gateway**: [Midtrans Snap API](https://midtrans.com/)
*   **Document Exports**:
    *   [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) (Excel sheet exports)
    *   [TCPDF](https://github.com/tecnickcom/TCPDF) & [Mpdf](https://github.com/mpdf/mpdf) (PDF receipt and invoice exports)
*   **Authentication**: Integrated Session-based Auth with **Google OAuth 2.0** support and **Two-Factor OTP Verification**.

---

## 📦 Installation Guide

### Prerequisites
*   Web server (e.g., Apache via XAMPP)
*   PHP >= 7.4 (Up to PHP 8.1 supported)
*   MySQL Database Server
*   Composer (for dependency management)

### Step 1: Clone and Extract
Clone or extract the repository directly into your local webroot folder (e.g., `C:/xampp/htdocs/kixera`).

### Step 2: Install Composer Dependencies
Open your terminal in the project root folder and execute:
```bash
composer install
```

### Step 3: Database Setup
1.  Open your MySQL manager (e.g., phpMyAdmin) and create a database named `kixera`.
2.  Import the initial SQL files located in `database/migrations/` (start with core schema migrations followed by seeds like `seed_admin_user.sql`, etc.).

### Step 4: CodeIgniter Configurations
Create or update files in `application/config/`:

*   **Database Config (`application/config/database.php`)**:
    ```php
    $db['default'] = array(
        'dsn'   => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'kixera',
        'dbdriver' => 'mysqli',
        ...
    );
    ```
*   **Base URL Config (`application/config/config.php`)**:
    ```php
    $config['base_url'] = 'http://localhost/kixera/';
    ```

### Step 5: Configure Midtrans Snap (Sandbox Testing)
For customizing checkout/payment gateway styles:
1.  Read the guide in [MIDTRANS_CUSTOMIZATION_GUIDE.md](file:///c:/xampp/htdocs/kixera/MIDTRANS_CUSTOMIZATION_GUIDE.md).
2.  Add your Sandbox API Keys inside the payment configuration file (`application/config/midtrans.php` or `Midtrans_lib.php`).

---

## 🤝 Contribution & Support
For bugs, system logs, or feature requests, contact system administrators or open a ticket in the Admin Helpdesk Dashboard.

*KixEra is designed for shoe enthusiasts and outlet owners to deliver premium quality laundry operations.* 🧼👞
