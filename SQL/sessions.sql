CREATE TABLE IF NOT EXISTS sessions (
  session_id INT AUTO_INCREMENT PRIMARY KEY,
  sid VARCHAR(64) NOT NULL,
  user_id INT NOT NULL,
  date_created TIMESTAMP DEFAULT current_timestamp,
  date_last_activity TIMESTAMP DEFAULT current_timestamp
) ENGINE=InnoDB;