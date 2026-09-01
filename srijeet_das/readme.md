# Srijeet Das — CodeIgniter 3 User Management System

## Project Overview

This project is a web-based user and account management application developed using CodeIgniter 3 and MySQL.

The application provides authentication, user registration, user management, account/permission management, application settings, password recovery, profile management and dashboard statistics.

## Technology Stack

- PHP
- CodeIgniter 3.1.10
- MySQL
- Apache
- Bootstrap 5.3.3
- jQuery
- Font Awesome
- TinyMCE

## Features

- User login/logout
- User registration
- Password recovery
- Password reset
- User management
- Account/role management
- Permission management
- User profile management
- Dashboard
- Application settings
- Profile image upload
- Application logging

## Requirements

- PHP
- MySQL
- Apache
- PHP mysqli extension
- PHP GD extension

## Installation

1. Clone the repository.
2. Create a MySQL database.
3. Import the database schema from `sql/`.
4. Configure the database connection.
5. Configure the CodeIgniter base URL.
6. Configure Apache URL rewriting.
7. Open the application in a browser.

## Running Locally

For example, with XAMPP:

1. Copy the project into the Apache `htdocs` directory.
2. Start Apache and MySQL.
3. Create the database.
4. Import the SQL file.
5. Configure the database credentials.
6. Open the configured application URL.

## Difficulties / Challenges

One of the main challenges was designing the application around CodeIgniter 3's MVC structure while maintaining reusable user, account and settings functionality.

Another challenge was implementing permission-based access control for different user account types.

## What I Would Improve

If developing the project again, I would improve the security architecture by using modern password hashing, stronger session and CSRF protection, environment-based configuration and a normalized role/permission database design.

I would also add automated tests and further separate application configuration from database-backed settings.

## Project Documentation

Detailed technical documentation is available in the `documentation/` directory.