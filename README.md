# 📝 Online Feedback Creation and Collection System

A web-based Feedback Management System developed using **PHP**, **MySQL**, **HTML**, **CSS**, **Bootstrap**, and **JavaScript**. The system allows administrators to create and manage feedback forms while enabling users (students) to submit feedback securely through an interactive interface.

---

## 📌 Features

### 👨‍💼 Admin Module
- Secure Admin Login
- Admin Dashboard
- Create Feedback Forms
- Add Custom Questions
- Manage Existing Forms
- View Submitted Responses
- Export Feedback Data
- Analytics Dashboard
- Delete Forms and Feedback
- Update Feedback Status

### 👨‍🎓 User Module
- User Registration
- Secure Login
- User Dashboard
- View Available Feedback Forms
- Fill and Submit Feedback Forms
- View Submission History
- Logout Functionality

---

## 🛠️ Technologies Used

- **Frontend**
  - HTML5
  - CSS3
  - Bootstrap 5
  - JavaScript
  - Bootstrap Icons

- **Backend**
  - PHP

- **Database**
  - MySQL

- **Server**
  - XAMPP (Apache + MySQL)

---

## 📂 Project Structure

```
Online-Feedback-Creation-and-Collection-System/
│
├── admin_dashboard.php
├── admin_login.php
├── analytics.php
├── available_forms.php
├── create_form.php
├── add_question.php
├── manage_forms.php
├── view_responses.php
├── export.php
├── login.php
├── register.php
├── user_dashboard.php
├── user_history.php
├── submit_form.php
├── fill_form.php
├── logout.php
├── db.php
└── ...
```

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/Online-Feedback-Creation-and-Collection-System.git
```

### 2. Move Project

Copy the project folder into your **XAMPP htdocs** directory.

Example:

```
C:\xampp\htdocs\Online-Feedback-Creation-and-Collection-System
```

### 3. Start XAMPP

Start:

- Apache
- MySQL

### 4. Create Database

Open **phpMyAdmin**

Create a database named

```
feedback_system
```

Import the SQL file (if available).

### 5. Configure Database Connection

Open

```
db.php
```

Update the credentials if required.

Example:

```php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "feedback_system",
    3307
);
```

Change the port if your MySQL is running on a different port.

### 6. Run the Project

Open your browser:

```
http://localhost/Online-Feedback-Creation-and-Collection-System/
```

---

## 📷 Screens

- Admin Login
- Admin Dashboard
- User Login
- User Dashboard
- Feedback Form Creation
- Feedback Submission
- Analytics Dashboard
- Response Management

*(Add screenshots here after uploading them.)*

---

## 🔒 Authentication

The system provides separate authentication for:

- Administrator
- Student/User

Sessions are used to protect pages from unauthorized access.

---

## 📊 Main Functionalities

- Dynamic Feedback Form Creation
- Custom Questions
- Response Collection
- Response History
- Feedback Analytics
- Data Export
- Form Management
- Secure Login System

---

## 🚀 Future Improvements

- Email Notifications
- OTP Verification
- Password Reset
- Role-Based Access Control
- Charts & Graphs
- PDF Report Generation
- Mobile Responsive Improvements
- Search and Filter Feedback
- Feedback Deadline Management

---

## 🎯 Learning Outcomes

This project demonstrates:

- PHP CRUD Operations
- MySQL Database Integration
- Session Management
- Authentication System
- Bootstrap UI Design
- Form Validation
- Dynamic Form Handling
- Data Management

---

## 👨‍💻 Author

**Krishna Pandey**

B.Tech CSE (Artificial Intelligence & Machine Learning)

Noida Institute of Engineering and Technology (NIET)

GitHub: https://github.com/1233-kp

---

## 📜 License

This project is developed for educational and learning purposes.
