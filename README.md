# Employee Management System (PHP + MySQL)

This is a simple yet functional Employee Management System built using PHP and MySQL, designed to perform essential CRUD operations (Create, Read, Update, Delete) on employee data. It also includes leave management, data export, and a responsive UI with dark/light mode support.

---

🚀 Features

- Employee Registration & Management
- Leave Application and Tracking
- Export Employee Details to PDF/Excel
- Search and Filter Employees
- Light/Dark Theme Toggle
- Responsive Interface using HTML/CSS/JS
- MySQL Database Integration

---

🛠️ Tech Stack

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL (via phpMyAdmin)
- Environment: XAMPP (Apache + MySQL)

---

📂 Folder Structure

myp/  
├── Employee.php  
├── Form.php  
├── dashboard.php  
├── auth.php  
├── logout.php  
├── leave_apply.php  
├── leave_submit.php  
├── leave_view.php  
├── export_pdf.php / export_excel.php  
├── Successful_Registration.php  
├── design.css / style.css / Emp.css  
├── theme-toggle.js  
├── logo.png / gate.avif  
└── emp_details.sql

---

🧑‍💻 How to Run the Project

1. Clone the Repository  
   `git clone https://github.com/atithiraghuvanshi/myp-employee-management.git`

2. Move to XAMPP htdocs  
   Copy the cloned folder into: `C:/xampp/htdocs/`

3. Start XAMPP  
   Start **Apache** and **MySQL** from the XAMPP Control Panel

4. Import the Database  
   - Open `http://localhost/phpmyadmin`  
   - Create a new database (e.g., `employee_mgmt`)  
   - Import `emp_details.sql` located in the project folder

5. Update Database Config (If Needed)  
   Open your DB config file (e.g., `auth.php` or `db.php`)  
   Set:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "employee_mgmt";

6. Run the Project
Open your browser and go to:
 `http://localhost/phpmyadmin`

---

📝 Notes
Make sure the images (e.g., gate.avif, logo.png) and stylesheets are correctly linked in your PHP files.

You can add validation, authentication improvements, and admin panels as enhancements.

---

📄 License
This project is open-source and free to use for educational and non-commercial purposes.



