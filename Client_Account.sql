INSERT INTO Client (Email, Username, Name, PhoneNumber, BirthDate, Avatar) VALUES
('client1@example.com', NULL, 'Nguyen Van A', '0901234567', '1990-01-01', NULL),
('client2@example.com', NULL, 'Tran Thi B', '0902345678', '1992-02-02', NULL),
('client3@example.com', NULL, 'Le Van C', '0903456789', '1994-03-03', NULL),
('client4@example.com', NULL, 'Pham Thi D', '0904567890', '1996-04-04', NULL),
('client5@example.com', NULL, 'Hoang Van E', '0905678901', '1998-05-05', NULL);

INSERT INTO Account (Username, Email, Password, ActivateCode, IsActive) VALUES
('user1', 'client1@example.com', '123', NULL, TRUE),
('user2', 'client2@example.com', '123', NULL, TRUE),
('user3', 'client3@example.com', '123', NULL, TRUE),
('user4', 'client4@example.com', '123', NULL, TRUE),
('user5', 'client5@example.com', '123', NULL, TRUE);

UPDATE Client SET Username = 'user1' WHERE Email = 'client1@example.com';
UPDATE Client SET Username = 'user2' WHERE Email = 'client2@example.com';
UPDATE Client SET Username = 'user3' WHERE Email = 'client3@example.com';
UPDATE Client SET Username = 'user4' WHERE Email = 'client4@example.com';
UPDATE Client SET Username = 'user5' WHERE Email = 'client5@example.com';