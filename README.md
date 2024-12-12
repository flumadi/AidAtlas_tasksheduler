# AidAtlas Application

AidAtlas is a web application designed to manage resources efficiently. Users can register, log in, save data, delete data, and search for data. This README file provides a brief overview of the application's functionality and structure.

## Features

- **User Registration (Sign Up)**: Allows new users to create an account.
- **User Login**: Allows registered users to log in to the application.
- **Save Data**: Enables logged-in users to save new resources.
- **Delete Data**: Allows users to delete existing resources.
- **Search Data**: Provides a search functionality to find resources based on title or content.

## File Structure

- **index.php**: The main page of the application. Displays a welcome message and navigation links. Shows user records if logged in.
- **signup.php**: Handles user registration (sign up).
- **login.php**: Manages user login.
- **save_data.php**: Allows users to save new resources.
- **delete.php**: Provides functionality to delete existing resources.
- **search.php**: Enables users to search for resources.
- **db.php**: Contains the database connection details.
- **styles/forms.css**: Defines the styling for the forms.
- **styles.css**: Contains the main styling for the application.

## Setup

1. Ensure you have [XAMPP](https://www.apachefriends.org/index.html) installed and running on your machine.
2. Place the AidAtlas project folder in the `htdocs` directory of your XAMPP installation.
3. Start Apache and MySQL from the XAMPP Control Panel.
4. Create the database and tables using the following SQL:

```sql
CREATE DATABASE aidatlas;
USE aidatlas;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
# AidAtlas_tasksheduler
