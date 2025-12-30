# Hospital-Appointment-Management-System
Hospital Appointment Management System (HAMS) PBL Project | Software Engineering (CS24-B) ### 1. Project Overview HAMS is a web-based solution designed to digitize manual medical scheduling. It applies the full Software Development Life Cycle (SDLC) to streamline interactions between patients and medical specialists while providing administrators with a robust management dashboard.
2. Core Features * Role-Based Access: Secure login/registration for Administrators and Patients.
Specialist Management: Admin can add, edit, and delete doctor profiles, including specialties and experience.

Appointment Booking: Patients select doctors and dates through a dynamic date-picker system.

Status Lifecycle: Admin manages the queue by marking appointments as "Completed" or "Cancelled".

Responsive UI: Developed using Bootstrap 5 for seamless mobile and desktop accessibility.

3. Technology Stack * Backend: PHP (8.0+)
Database: MySQL (MariaDB)

Frontend: HTML5, CSS3, JavaScript, Bootstrap 5

Server: Apache (via XAMPP)

4. Installation & Setup 1. Clone Repository: git clone https://github.com/YourUsername/HAMS-Project.git
Move to Web Directory: Move the folder into your local server's root (e.g., C:/xampp/htdocs/).

Database Configuration: * Open phpMyAdmin.

Create a database named hospital_db.

Import the provided database.sql file.

Connect Files: Verify the credentials in db.php match your local MySQL settings.

5. Testing Procedures * Authentication Testing: Verified login redirects for both Admin and Patient roles.
Functional Testing: Confirmed that "Cancel" operations correctly remove records from the appointments table.

Validation Testing: Ensured the system blocks booking attempts for past dates.

UI/UX Testing: Verified the dashboard responsiveness across different screen resolutions.

6. Team Members (CS24-B) * Muhammad Subhan (083) * Abdullah Aqil (095) * Ahmad Butt (085) * Raza Ahmad (090) Submitted To: Ms. Saima Yasmeen, Department of Computer Science, NUTECH.
