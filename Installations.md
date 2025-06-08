📌 Requirements
Hardware:
Raspberry Pi Zero 2 W

MicroSD Card (min. 8GB, flashed with DietPi OS)

USB Data Cable

Wi-Fi access (Eduroam or personal hotspot)

Software:
Apache2

PHP

MariaDB

Git

🛠 Installation Instructions
1. Flash DietPi OS
Download: https://dietpi.com

Flash using Balena Etcher or Raspberry Pi Imager

Insert SD card into Pi and boot up

2. Set Up Wi-Fi

On first boot, configure dietpi-wifi.txt:
AUTO_SETUP_NET_WIFI_ENABLED=1  
AUTO_SETUP_NET_WIFI_SSID=YourSSID  
AUTO_SETUP_NET_WIFI_KEY=YourPassword

3. SSH into the Pi
bash
ssh root@<PI_IP_ADDRESS>

4. Install Required Packages
bash
sudo apt update
sudo apt install apache2 php mariadb-server git unzip -y

5. Clone This Repository
bash
cd /var/www
sudo git clone https://github.com/MyDistance45/Raspberry-Pi-OSP.git html
6. Set File Permissions

bash
sudo chown -R www-data:www-data /var/www/html
7. Restart Apache2

bash
sudo systemctl restart apache2
🔍 Verification
To verify that the installation is successful:

Ensure Apache is running:
bash

sudo systemctl status apache2
Visit the Pi’s IP from a browser on the same network:
http://<PI_IP_ADDRESS>
You should see the OrderTrack homepage.

Navigate through:

Submit Order

Track Order

Admin Login

Confirm the database is operational using:
sudo mariadb
SHOW DATABASES;
