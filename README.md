This repository contains a simple user management system built with PHP. It handles user registration, login, and contact message submission with JSON responses. Below is a brief overview of each component.

Features
User Registration: Allows users to register by providing a username and password.
User Login: Validates user credentials and generates a session token upon successful login.
Contact Form: Enables users to submit contact messages, which are stored in the database.
File Upload: Handles file uploads and saves them to a designated directory.
Project Structure
index.php: Main entry point of the application.
register.php: Handles user registration.
login.php: Manages user login.
logout.php: Ends the user session.
api/: Contains the API endpoints for user actions.
loginapi.php: Processes login requests and returns JSON responses.
registerapi.php: Processes registration requests and returns JSON responses.
Database/: Contains database connection and CRUD operations.
CrudProccessor.php: Defines functions for database interactions.
uploads/: Directory for storing uploaded files.

Installation

Clone the repository to your local machine.

git clone https://github.com/yourusername/repository-name.git
Navigate to the project directory.

cd repository-name
Set up the database:

Import the CarDealDB database.
Ensure the database credentials in CrudProccessor.php match your local setup.

Run the application on a local server using tools like XAMPP or MAMP.

Usage
Registration: Users can register by filling out the form at register.php.
Login: Users can log in using their credentials at login.php. Successful login returns a JSON token.
Logout: Users can log out by triggering the logout endpoint.
Contact Form: Users can submit contact messages, which are stored in the database.
File Upload: Users can upload files, which are stored in the uploads directory.
