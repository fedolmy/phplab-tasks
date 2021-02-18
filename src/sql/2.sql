SELECT first_name, last_name, birth_date
FROM employee
WHERE department_ID = 5
ORDER BY birth_date ASC;

SELECT CONCAT (first_name, ' ', last_name) AS Fullname,
    (
        (YEAR(CURRENT_DATE) - YEAR(birth_date)) - (
            DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(birth_date, '%m%d')
        )
    ) AS age
FROM employee
ORDER BY age DESC;

SELECT COUNT(ID) AS Employees
FROM employee;

SELECT first_name, last_name, role_title
FROM employee e
    JOIN employee_project ep ON e.ID = ep.employee_ID
    JOIN project p ON p.ID = ep.project_ID
    JOIN `role` r ON r.ID = e.role_ID
WHERE project_title = 'BMW';

SELECT CONCAT (first_name, ' ', last_name) AS Fullname, department_title AS Department, role_title AS Job
FROM department d
    JOIN employee e ON d.ID = e.department_ID
    JOIN `role` r ON r.ID = e.role_ID
WHERE first_name LIKE 'o%';

SELECT e.ID, first_name, last_name, birth_date, role_title, department_title, project_title
FROM employee e
    JOIN `role` r ON r.ID = e.role_ID
    JOIN department d ON d.ID = e.department_ID
    JOIN employee_project ep ON ep.employee_ID = e.ID
    JOIN project p ON p.ID = ep.project_ID;

SELECT
    e.ID,
    first_name,
    last_name,
    birth_date,
    role_title,
    department_title,
    project_title
FROM employee e
    JOIN `role` r ON r.ID = e.role_ID
    JOIN department d ON d.ID = e.department_ID
    JOIN employee_project ep ON ep.employee_ID = e.ID
    JOIN project p ON p.ID = ep.project_ID
WHERE department_title = 'Engeneering'
GROUP BY e.ID
LIMIT 5;

SELECT ID, first_name, last_name, birth_date
FROM employee
WHERE role_ID = (SELECT ID FROM `role` WHERE role_title = 'back-end developer' );