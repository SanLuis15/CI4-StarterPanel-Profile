CI4 CRUD EXAM - README
======================

DATABASE SETUP
--------------
Database Name: project
Username: root
Password: (empty)
Host: localhost
Port: 3306

INSTALLATION STEPS
------------------

OPTION 1: Import SQL File (Recommended)
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create database named 'project'
3. Click on 'project' database
4. Click 'Import' tab
5. Choose 'project.sql' file
6. Click 'Go'

OPTION 2: Use Migrations
1. cd CI4-StarterPanel-master
2. php spark migrate
3. php spark db:seed SystemSeeder

3. Start the development server:
   php spark serve

4. Access the application:
   http://localhost:8080

5. Register a new account at /register

TEST CREDENTIALS
----------------
After importing SQL or running migrations, register a new account to test.

FEATURES IMPLEMENTED
--------------------
✓ User Authentication (Login/Register/Logout)
✓ Password hashing with PASSWORD_BCRYPT
✓ Session management
✓ Route protection with Authentication filter
✓ Complete CRUD for Students module
✓ Complete CRUD for Records module
✓ Server-side validation
✓ Flash messages for success/error
✓ Bootstrap 5 UI
✓ Responsive design
✓ Pagination support

MODULES
-------
1. Authentication System
   - Register: /register
   - Login: /login
   - Logout: /logout
   - Dashboard: /dashboard

2. Students CRUD
   - List: /students
   - Create: /students (POST to /students/store)
   - View: /students/show/{id}
   - Edit: /students/edit/{id}
   - Update: POST to /students/update/{id}
   - Delete: POST to /students/delete/{id}

3. Records CRUD
   - List: /records
   - Create: /records/create
   - Store: POST to /records/store
   - View: /records/show/{id}
   - Edit: /records/edit/{id}
   - Update: POST to /records/update/{id}
   - Delete: POST to /records/delete/{id}

DATABASE TABLES
---------------
1. users - Authentication
   - id, fullname, username (email), password, role, created_at, updated_at

2. students - CRUD operations
   - id, name, email, course, created_at

3. records - CRUD operations
   - id, title, description, category, status, created_at, updated_at

NOTES
-----
- All passwords are hashed using password_hash() with PASSWORD_BCRYPT
- Email validation ensures unique emails in registration
- All CRUD pages are protected by authentication filter
- Hard delete is implemented for both Students and Records
- Bootstrap 5 is used for UI styling
- Flash messages display success/error notifications
- Form validation with error display

TROUBLESHOOTING
---------------
If you encounter issues:
1. Make sure XAMPP Apache and MySQL are running
2. Check database credentials in .env file
3. Ensure database 'project' exists
4. Run migrations: php spark migrate
5. Clear cache if needed: php spark cache:clear
