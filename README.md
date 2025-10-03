8th November 2024

# 📚 Library Management System (Engineering Books)

A web-based Library Management System designed for managing engineering-related books.
Built with HTML, CSS, and JavaScript, and powered by XAMPP (PHP + MySQL) for backend and database.
The system allows students, staff, and admins to efficiently manage book loans, returns, and library records.

# Features

## Student
- Sign up with email verification (Google SMTP).
- Browse books by categories.
- View book details: description, author, ISBN, and cover image.
- Loan books (maximum of 2 books at a time).
- Return date is automatically calculated (2 weeks from loan date).

## Staff
- View all student records and loan records.
- Verify book returns.
- Manage and check overdue fees.
- Add new books including cover images.
- Dashboard with statistics

## Admin
- Full access to all data (students, staff, books, loans).
- Manage staff and student accounts.
- Dashboard with extended library statistics.

# Tech Stack
Frontend: HTML, CSS, JavaScript
Backend: PHP (via XAMPP)
Database: MySQL
Email Service: Google SMTP (for signup verification)
