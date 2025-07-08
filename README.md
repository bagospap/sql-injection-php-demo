# sql-injection-php-demo
Sql injection v.1

# SQL Injection in PHP: An Educational Overview

This project demonstrates different types of SQL Injection vulnerabilities using PHP scripts, with explanations and code examples.

## ⚠️ Disclaimer

These examples are for educational purposes only. Do **NOT** use vulnerable code in production.

## Contents

- [What is SQL Injection?](#what-is-sql-injection)
- [Classic SQL Injection](#classic-sql-injection)
- [UNION-Based SQL Injection](#union-based-sql-injection)
- [Boolean-Based Blind SQL Injection](#boolean-based-blind-sql-injection)
- [Time-Based Blind SQL Injection](#time-based-blind-sql-injection)
- [How to Prevent SQL Injection](#how-to-prevent-sql-injection)
- [Mutation Techniques](#mutation-techniques)
- [Famous/Funny Examples](#famousfunny-examples)
- [Input Sanitization Explained](#input-sanitization-explained)

---

## What is SQL Injection?

SQL Injection is a security vulnerability that allows an attacker to interfere with the queries that an application makes to its database. It can allow attackers to view data they are not supposed to access, modify or delete data, and sometimes even execute administrative operations on the database.

---

## Classic SQL Injection

- **File:** [`classic_injection.php`](classic_injection.php)
- **Description:** Demonstrates how unsanitized user input can allow attackers to bypass authentication.

---

## UNION-Based SQL Injection

- **File:** [`union_injection.php`](union_injection.php)
- **Description:** Shows how attackers can use the `UNION` SQL operator to extract data from other tables.

---

## Boolean-Based Blind SQL Injection

- **File:** [`boolean_injection.php`](boolean_injection.php)
- **Description:** Demonstrates how attackers can infer information by manipulating queries that return true/false conditions.

---

## Time-Based Blind SQL Injection

- **File:** [`time_based_injection.php`](time_based_injection.php)
- **Description:** Shows how attackers can use time delays to extract information from the database when no output is returned.

---

## How to Prevent SQL Injection

- **File:** [`secure_example.php`](secure_example.php)
- **Description:** Shows how to securely handle user input using prepared statements.

---

## Mutation Techniques

- **File:** [`payload_mutator.php`](payload_mutator.php)
- **Description:** Utility to mutate payloads to bypass weak input filters. Includes removing spaces/numbers, encoding, obfuscation, and more. Can be used standalone or included in other scripts.

---

## Famous/Funny Examples

- **File:** [`funny_sql_injection.md`](funny_sql_injection.md)
- **Description:** Real-world-inspired anecdotes and photos, including the "SQL Injection Car Plate."

---

## Input Sanitization Explained

- **File:** [`input_sanitization_example.md`](input_sanitization_example.md)
- **Description:** Clear comparison of vulnerable vs. secure code, and best practices for input sanitization.

---

## Setup

1. Set up a MySQL database called `testdb` with a `users` table (see below).
2. Update the database connection credentials in each PHP script.
3. Run the scripts on a local web server (e.g., XAMPP, MAMP, or PHP’s built-in server).

### Example Users Table

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'adminpass'), ('user', 'userpass');
```

---
