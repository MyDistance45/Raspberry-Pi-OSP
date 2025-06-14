# Installation Guide for Order Track Application on Raspberry Pi (DietPi)

##  Prerequisites

- Raspberry Pi Zero 2 W (or compatible)
- SD card (minimum 8GB recommended)
- Power supply
- HDMI cable + USB keyboard (optional for debugging)
- Another computer for flashing and remote access
- Access to Wi-Fi with MAC address registration (e.g., TKU WiFi)

---

##  1. Flash DietPi OS onto SD Card

- Download **Balena Etcher** from: [https://www.balena.io/etcher/](https://www.balena.io/etcher/)
- Download the **DietPi image** from: [https://dietpi.com/](https://dietpi.com/)
  - Choose: **Raspberry Pi 2/3/4/Zero 2**\
    **BCM2710/2711 | 4 Cores | ARMv8**
- Flash DietPi image to your SD card using Balena Etcher

---

##  2. Configure Wi-Fi (for DietPi)

Edit the `dietpi-wifi.txt` file on the flashed SD card:

```bash
aWIFI_SSID[0]='<YOUR_HOME_SSID>'
aWIFI_KEY[0]='<YOUR_HOME_PASSWORD>'
aWIFI_KEYMGR[0]='WPA-PSK'

aWIFI_SSID[1]='<YOUR_PHONE_HOTSPOT>'
aWIFI_KEY[1]='<HOTSPOT_PASSWORD>'
aWIFI_KEYMGR[1]='WPA-PSK'
```

💡 **If using TKU WiFi**, register the Pi's MAC address at: [https://macauth.tku.edu.tw/](https://macauth.tku.edu.tw/)\
Use `ip link` to get the MAC address of `wlan0`, then add the following entry to `/etc/wpa_supplicant/wpa_supplicant.conf`:

```bash
network={
    ssid="tku"
    key_mgmt=NONE
}
```

---

##  3. Boot Raspberry Pi

- Insert SD card into Pi and power it on
- It will auto-configure and reboot itself on first boot
- Use a monitor or find its IP address via router or `Advanced IP Scanner`
- **If IP cannot be found**, connect using serial mode in PuTTY:
  - Check COM port in **Device Manager**
  - Open PuTTY in **Serial mode**, set baud rate to `115200`
  - Run `hostname -I` to get the Pi’s IP address

---

##  4. Connect via SSH

Use **PuTTY** (Windows) or `ssh` (Linux/macOS):

```bash
ssh root@<Pi_IP_address>
# Default password: dietpi
```

---

##  5. Initial Configuration and Updates

Let DietPi finish its setup process. If stuck, wait until it's done and auto-reboots.

---

##  6. Install Required Packages

Install Apache2, MariaDB, PHP, and Git:

```bash
sudo apt update
sudo apt install apache2 mariadb-server php php-mysql git -y
```

(Press `Y` if it asks for more space or confirmation)

Secure MariaDB:

```bash
sudo mysql_secure_installation
# Enter through prompts:
# - Switch to unix_socket: Y
# - Change root password: N
# - Remove anonymous users: Y
# - Disallow remote root login: Y
# - Remove test DB: Y
# - Reload privileges: Y
```

---

##  7. Configure Database

Log into MariaDB:

```bash
sudo mariadb
```

Create database and tables manually:

```sql
CREATE DATABASE ordertrack;
USE ordertrack;

CREATE TABLE orders (
  order_id VARCHAR(50) PRIMARY KEY,
  email VARCHAR(100) NOT NULL,
  customer_name VARCHAR(100),
  status VARCHAR(20),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO orders (order_id, email, customer_name, status)
VALUES ('ORD001', 'test@example.com', 'Test User', 'waiting');

CREATE TABLE admin (
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password)
VALUES ('admin', 'admin123'), ('Distance', 'distance45');
```

Then exit:

```sql
EXIT;
```

---

##  8. Clone Your Project to Web Directory

Remove default index files:

```bash
sudo rm -rf /var/www/html/*
```

Clone your repository:

```bash
cd /var/www/html
sudo git clone https://github.com/MyDistance45/Raspberry-Pi-OSP.git .
```

---

##  9. Important Apache & PHP Configuration

Ensure PHP is installed and working:

```bash
php -v
```

If index is showing directory, remove `index.html` or set `index.php` as default:

```bash
sudo rm /var/www/html/index.html
```

Then restart Apache:

```bash
sudo systemctl restart apache2
```

---

Perfect. Below is a **complete Troubleshooting Section** with all key issues you faced — now ready to be **added to the bottom** of your `Installations.md`:

---

##  Troubleshooting & Known Issues

These are real problems encountered during setup and how to fix them:

---

### 1. `index.php` not loading by default

**Symptom:** Browser displays file directory instead of your web app.

**Fix:**
Option 1: Delete `index.html` which has higher priority:

```bash
sudo rm /var/www/html/index.html
```

Option 2: Change Apache’s default page order:

```bash
sudo nano /etc/apache2/mods-enabled/dir.conf
```

Make sure the line looks like this:

```apacheconf
DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
```

Make sure index.php is in the front

Then restart Apache:

```bash
sudo systemctl restart apache2
```

---

### 2. PHP not working or shows raw code

**Symptom:** PHP code not executing on browser.

**Fix:**
Install PHP and required modules:

```bash
sudo apt install php libapache2-mod-php php-mysql -y
sudo systemctl restart apache2
```

---

### 3. `mysqli` class not found

**Symptom:** `Class 'mysqli' not found` error.

**Fix:**

```bash
sudo apt install php-mysql
sudo systemctl restart apache2
```

---

### 4. Database connection error - `Access denied for user 'root'@'localhost'`

**Symptom:** Website can't connect to MariaDB.

**Cause:** MariaDB uses `unix_socket` authentication by default.

**Fix:** Switch to password-based login:

```bash
sudo mariadb

ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');
FLUSH PRIVILEGES;
EXIT;
```

---

### 5. `HTTP ERROR 500` (Internal Server Error)

**Symptom:** Blank screen or 500 error on `login.php` or other pages.

**Fix:**

* Make sure PHP is installed
* Check `error.log` in `/var/log/apache2/`
* Ensure database credentials in PHP are correct
* Restart Apache:

```bash
sudo systemctl restart apache2
```

---

Would you like me to now **append this directly** to the Installations file in canvas?


---

🧾 Confirm Web Access

Visit: `http://<Pi_IP_address>`

- Home: `index.php`
- Submit Order: `submit_order.php`
- Track Order: `track.php`
- Admin: `admin/login.php`
- login admin using 'admin' as user and 'admin123' as password

---

You’re done! System is ready.

