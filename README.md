###ASAN Website Administration

Welcome to the ASAN Website Administration repository! 
This document provides an overview of the project, including its purpose, features, technologies used, and instructions for setting up and using the application.

Repository: [ASAN Website Administration](https://github.com/seanrnp0530/ASAN)

Project Overview

Website Name: ASAN Website Administration

### Purpose

The ASAN Website Administration is a web-based platform designed to manage user accounts and administrative functions for the ASAN mobile application. The ASAN mobile application is a scrap stock warehouse management system intended for scrapyard owners and company buyers.

### Features

- **User Management**: Reactivate or deactivate user accounts, approve or decline user applications for account verification.
- **Admin Security**: Change the admin password using bcrypt hashing for enhanced security.
- **Audit Logs**: View audit logs to monitor activities and track user interactions.
- **User Tracking**: Track user activities and manage their profiles.

## Technologies Used

- **Frontend**: 
  - Tailwind CSS
  - HTML
  - CSS
- **Backend**: 
  - PHP
  - SQL
- **Security**: 
  - bcrypt hashing

## Project Setup

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP (version 7.4 or higher)
- MySQL (or any SQL compatible database)
- A web server (e.g., Apache or Nginx)
- Composer (for PHP dependencies)

### Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/seanrnp0530/ASAN.git
   cd ASAN
   ```

2. **Install Dependencies**

   Run the following command to install PHP dependencies:

   ```bash
   composer install
   ```

3. **Database Setup**

   - Create a database for the project.
   - Import the provided SQL file to set up the necessary tables.

   ```sql
   CREATE DATABASE asan_admin;
   USE asan_admin;
   SOURCE path/to/database.sql;
   ```

4. **Configuration**

   - Rename the `.env.example` file to `.env`.
   - Update the `.env` file with your database credentials and other configuration settings.

   ```env
   DB_HOST=your_database_host
   DB_DATABASE=asan_admin
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

5. **Run the Application**

   Ensure your web server is configured to serve the application. Navigate to the project directory in your web browser.

## Usage

### Managing Users

- **Reactivating/Deactivating Users**: Navigate to the user management section to change the status of user accounts.
- **Approving/Declining Applications**: Review and manage user applications for account verification.

### Changing Admin Password

- Go to the admin settings page and follow the prompts to change the admin password. The new password will be securely hashed using bcrypt.

### Viewing Audit Logs

- Access the audit logs section to monitor user activities and administrative actions.

### Tracking Users

- Use the tracking feature to view and manage user profiles and activities.

## Contribution

As this is a private repository for a thesis project, contributions are not open to the public. If you have access to this repository and wish to contribute, please follow the standard Git workflow for creating and reviewing pull requests.

## License

This project is not open source and is intended for educational purposes as part of a thesis project.

## Contact

For any questions or issues, please contact the repository owner or the project supervisor.

---

Thank you for using the ASAN Website Administration platform!
