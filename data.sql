INSERT INTO Client (Email, Name, PhoneNumber, BirthDate) VALUES
('admin01@example.com', 'Nguyen Van Admin', '0123456789', '1980-01-01'),
('guider01@example.com', 'Tran Thi Guider', '0987654321', '1990-02-02'),
('visitor01@example.com', 'Le Van Visitor', '0911222333', '2000-03-03'),
('visitor02@example.com', 'Pham Thi Visitor', '0933444555', '2001-04-04'),
('guider02@example.com', 'Hoang Guider 2', '0966778899', '1985-05-05');

INSERT INTO Account (Username, Email, Password, ActivateCode, IsActive) VALUES
('admin01', 'admin01@example.com', 'hashedpassword1', 'ACT001', TRUE),
('guider01', 'guider01@example.com', 'hashedpassword2', 'ACT002', TRUE),
('visitor01', 'visitor01@example.com', 'hashedpassword3', 'ACT003', TRUE),
('visitor02', 'visitor02@example.com', 'hashedpassword4', 'ACT004', TRUE),
('guider02', 'guider02@example.com', 'hashedpassword5', 'ACT005', TRUE);

UPDATE Client SET Username = 'admin01' WHERE Email = 'admin01@example.com';
UPDATE Client SET Username = 'guider01' WHERE Email = 'guider01@example.com';
UPDATE Client SET Username = 'visitor01' WHERE Email = 'visitor01@example.com';
UPDATE Client SET Username = 'visitor02' WHERE Email = 'visitor02@example.com';
UPDATE Client SET Username = 'guider02' WHERE Email = 'guider02@example.com';

UPDATE `Account` SET `Password`='123'
