# Input Sanitization: Preventing SQL Injection

Proper input sanitization and the use of prepared statements are essential to protect your application from SQL injection attacks. Below you'll find a direct comparison of vulnerable code vs. secure code.

---

## 🚫 Vulnerable Example (Unsafe - No Sanitization)

```php
<?php
// BAD: Vulnerable to SQL Injection!
$plate = $_POST['license_plate'];
$sql = "INSERT INTO cars (license_plate) VALUES ('$plate')";
$conn->query($sql);
?>
```

If a malicious user submits a license plate like:
```
ZU 0666', 0, 0); DROP DATABASE TABLICE--
```
the resulting SQL would be:
```sql
INSERT INTO cars (license_plate) VALUES ('ZU 0666', 0, 0); DROP DATABASE TABLICE--')
```
This can execute unwanted SQL commands and cause severe damage.

---

## ✅ Secure Example (With Input Sanitization & Prepared Statements)

```php
<?php
// GOOD: Safe from SQL Injection
$plate = $_POST['license_plate'];
$stmt = $conn->prepare("INSERT INTO cars (license_plate) VALUES (?)");
$stmt->bind_param("s", $plate);
$stmt->execute();
?>
```
Here, the user input is never directly embedded into the SQL query string. Instead, a prepared statement is used, and the input is safely parameterized. No matter what is entered as the license plate, it will only ever be treated as a string value in the database.

---

## 🛡️ Summary Table

| Approach              | Vulnerable to SQL Injection? | Code Example        |
|-----------------------|:---------------------------:|--------------------|
| String interpolation  |            Yes              | ❌ See above       |
| Prepared statements   |            No               | ✅ See above       |

---

## 📝 Best Practices

- **Always use prepared statements** (with parameterized queries).
- **Never trust user input.** Even for fields like license plates!
- **Validate and sanitize** inputs as a second layer of defense.
