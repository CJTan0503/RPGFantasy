#RPGFantasy
This is a turn-based RPG Game created using RPG Maker MV. 

## Login System

This project is a simple login system that allows users to register and log in. It includes user authentication features and is built using PHP and MySQL.

## Project Structure

```
login-system
├── src
│   ├── index.php          # Main entry point for the application
│   ├── register.php       # Handles user registration
│   ├── login.php          # Manages user login
│   ├── config
│   │   └── database.php   # Database connection settings
│   └── includes
│       └── functions.php   # Utility functions for the application
├── sql
│   └── rpgproject.sql     # SQL statements for database setup
├── css
│   └── styles.css         # Styles for the application
├── js
│   └── scripts.js         # JavaScript for client-side validation
├── .env                   # Environment variables for sensitive information
└── README.md              # Documentation for the project
```

## Features

- User registration with username, password, and email.
- User login with username and password.
- Secure password storage using hashing.
- Input validation for registration and login forms.

## Setup Instructions

1. Clone the repository to your local machine.
2. Create a database in PHPMyAdmin named `rpgproject`.
3. Import the `sql/rpgproject.sql` file to set up the necessary tables.
4. Configure your database connection in the `.env` file.
5. Open `http://localhost/RPGProject/Project1/login.php` in your web browser to access the application.

## Usage Guidelines

- New users must register before logging in.
- Existing users can log in using their credentials.
- Ensure that the server has PHP and MySQL installed.

## Contributing

Feel free to submit issues or pull requests for improvements or bug fixes.

##
