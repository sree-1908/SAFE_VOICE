CREATE DATABASE safvoice;

USE safvoice;

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    criticality INT NOT NULL,
    report_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

