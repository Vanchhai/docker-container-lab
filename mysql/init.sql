CREATE DATABASE IF NOT EXISTS labdb;
USE labdb;

CREATE TABLE users (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100)
);

INSERT INTO users (name, email) VALUES
  ('Alice',   'alice@lab.dev'),
  ('Bob',     'bob@lab.dev'),
  ('Charlie', 'charlie@lab.dev');
