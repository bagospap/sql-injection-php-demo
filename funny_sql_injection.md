# The "SQL Injection Car Plate" in Real Life

While the legendary Bobby Tables XKCD comic is the most famous SQL injection story, there have also been real-life-inspired stunts where someone used a car plate or a banner to mimic an SQL injection attack.

Below is a photo of a car with a spoofed "license plate" containing an SQL injection attempt:

![SQL Injection Car Plate Example]([image1](https://i.imgur.com/DHJMh2P.jpeg))

The "plate" reads:
```
ZU 0666', 0, 0); DROP DATABASE TABLICE--
```
This is a playful take on what might happen if a vulnerable database-backed system processed such an input without sanitization. The SQL command attempts to terminate any running statement and then execute `DROP DATABASE TABLICE`, which (if "tablice" means "tables" in Polish) would delete a database!

## What Could Go Wrong?

If a vehicle registration system were insecure and constructed SQL like this:

```php
$plate = $_POST['license_plate'];
$sql = "INSERT INTO cars (license_plate) VALUES ('$plate')";
$conn->query($sql);
```

and someone entered the injection above, the resulting query would be:

```sql
INSERT INTO cars (license_plate) VALUES ('ZU 0666', 0, 0); DROP DATABASE TABLICE--')
```

Depending on the database, this could result in a catastrophic data loss.

---

## Lesson

Modern vehicle registration and parking systems must always sanitize and parameterize all user inputs—including those that come from something as unexpected as a license plate!

---

*Photo credit: Unknown original source. This image is often shared in security communities as a humorous but insightful demonstration of SQL injection awareness.*
