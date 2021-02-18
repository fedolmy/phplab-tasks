CREATE DATABASE IF NOT EXISTS employees;

USE employees;

CREATE TABLE IF NOT EXISTS department (
    ID INT NOT NULL AUTO_INCREMENT,
    department_title VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
    PRIMARY KEY (ID),
    UNIQUE INDEX (department_title ASC)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `role` (
    ID INT NOT NULL AUTO_INCREMENT,
    role_title VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
    PRIMARY KEY (ID)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS employee (
    ID INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
    last_name VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
    birth_date DATE,
    role_ID INT NOT NULL,
    department_ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (role_ID) REFERENCES `role` (ID),
    FOREIGN KEY (department_ID) REFERENCES department (ID)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS project (
    ID INT NOT NULL AUTO_INCREMENT,
    project_title VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
    PRIMARY KEY (ID),
    UNIQUE INDEX (project_title ASC)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS employee_project (
    employee_ID INT NOT NULL,
    project_ID INT NOT NULL,
    UNIQUE KEY (employee_ID, project_ID),
    FOREIGN KEY (project_ID) REFERENCES project (ID),
    FOREIGN KEY (employee_ID) REFERENCES employee (ID)
) ENGINE = InnoDB;

INSERT INTO
    employee(
        first_name,
        last_name,
        birth_date,
        role_ID,
        department_ID
    )
VALUES
    ('John', 'Taylor', '1987-10-15', '7', '4');

INSERT INTO
    employee(
        first_name,
        last_name,
        birth_date,
        role_ID,
        department_ID
    )
VALUES
    ('Gary', 'Peay', '1999-01-02', '1', '2'),
    ('Olexandr', 'Fedorenko', '1981-12-29', '3', '5');

INSERT INTO
    department (department_title)
VALUES
    ('Engeneering'),
    ('Human Resources');

INSERT INTO
    `role`(role_title)
VALUES
    ('back-end developer'),
    ('hr manager');

INSERT INTO
    project(project_title)
VALUES
    ('Adidas'),
    ('Coca-Cola');

INSERT INTO
    employee_project(employee_ID, project_ID)
VALUES
    ('7', '3'),
    ('10', '3');