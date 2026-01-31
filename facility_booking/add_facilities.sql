-- Add New Facilities
-- Run this SQL in your database (phpMyAdmin or command line)

INSERT INTO facilities (name, description, capacity, location, department_id, created, modified) VALUES
('Bilik Mesyuarat', 'Professional meeting room equipped with modern facilities for corporate meetings and discussions', 20, 'Block A, Level 2', 1, NOW(), NOW()),
('Padang Bola', 'Full-size football field with quality grass surface, perfect for sports activities and tournaments', 50, 'Sports Complex Area', 2, NOW(), NOW()),
('Gelanggang Futsal', 'Indoor futsal court with professional flooring and lighting system', 30, 'Sports Complex Building', 2, NOW(), NOW());

-- Note: Make sure department_id matches existing departments in your database
-- department_id 1 = First department (e.g., Faculty of Electrical Engineering)
-- department_id 2 = Second department (e.g., Faculty of Information Science)
-- Adjust the department_id values based on your actual departments
