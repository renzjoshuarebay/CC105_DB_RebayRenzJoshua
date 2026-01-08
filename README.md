1. System Overview and Purpose
System Overview

The Student Information System (SIS) is a relational database system designed to manage and organize student-related information efficiently. The system stores data about students, departments, instructors, courses, and student enrollments.

It demonstrates the use of:

Relational database design

Normalization (up to Third Normal Form)

Primary and foreign key relationships

SQL operations such as CREATE, INSERT, SELECT, UPDATE, DELETE, and JOIN

System Purpose

The main purpose of the system is to:

Store student records in a structured manner

Track student enrollments in courses

Manage departments, instructors, and course assignments

Retrieve meaningful information using SQL queries

This system is suitable for educational institutions to manage academic records efficiently.

2. Table Descriptions and Relationships
Tables Used

The system consists of five (5) related tables.

2.1 Departments Table

Purpose: Stores department information.

Field Name	Data Type	Description
department_id	INT (PK)	Unique identifier of the department
department_name	VARCHAR(100)	Name of the department

Relationship:

One department can have many students

One department can have many courses

2.2 Students Table

Purpose: Stores student information.

Field Name	Data Type	Description
student_id	INT (PK)	Unique student ID
student_no	VARCHAR(20)	Student number
first_name	VARCHAR(50)	Student first name
last_name	VARCHAR(50)	Student last name
email	VARCHAR(100)	Student email
department_id	INT (FK)	Linked department

Relationship:

Each student belongs to one department

A student can have many enrollments

2.3 Instructors Table

Purpose: Stores instructor information.

Field Name	Data Type	Description
instructor_id	INT (PK)	Instructor ID
instructor_name	VARCHAR(100)	Instructor full name
email	VARCHAR(100)	Instructor email

Relationship:

One instructor can teach many courses

2.4 Courses Table

Purpose: Stores course details.

Field Name	Data Type	Description
course_id	INT (PK)	Course ID
course_code	VARCHAR(20)	Course code
course_title	VARCHAR(100)	Course title
department_id	INT (FK)	Department offering the course
instructor_id	INT (FK)	Assigned instructor

Relationship:

Each course belongs to one department

Each course is handled by one instructor

One course can have many enrollments

2.5 Enrollments Table

Purpose: Links students and courses.

Field Name	Data Type	Description
enrollment_id	INT (PK)	Enrollment ID
student_id	INT (FK)	Student enrolled
course_id	INT (FK)	Course enrolled
enrollment_date	DATE	Date of enrollment
grade	DECIMAL(3,2)	Student grade

Relationship:

Represents a many-to-many relationship between students and courses

3. Sample Outputs / Query Results
3.1 Display All Students
SELECT * FROM students;


Sample Output:

student_no	first_name	last_name	email
2023-001	John	Doe	john@school.edu

2023-002	Jane	Smith	jane@school.edu
3.2 Students per Department (GROUP BY)
SELECT department_id, COUNT(*) AS total_students
FROM students
GROUP BY department_id;


Sample Output:

department_id	total_students
1	2
2	1
3	1
3.3 Student Enrollment Details (JOIN)
SELECT s.student_no, s.first_name, s.last_name,
       c.course_title, e.grade
FROM enrollments e
JOIN students s ON e.student_id = s.student_id
JOIN courses c ON e.course_id = c.course_id;


Sample Output:

student_no	Name	course_title	grade
2023-001	John Doe	Introduction to Programming	1.75
2023-002	Jane Smith	Database Systems	2.00
3.4 Update Query
UPDATE enrollments
SET grade = 1.25
WHERE enrollment_id = 1;


Successfully updated student grade.

3.5 Delete Query
DELETE FROM enrollments
WHERE enrollment_id = 5;


Enrollment record deleted successfully.
