# EyesInTheSky [EITS]
## Description:
>EITS is a mobile adhoc cloud system that serves the government since it provides an affordable tool that helps in detecting criminals and their location as fast as possible.

## Table of Contents:
1. Installation
      * Server Side
      * Client Side
2. Source Code
3. Configurations and Running
      * Server Side
      * Client Side
      * Auto run Configurations
4. Support
5. License

## Installation:
### 1. Server Side:
1. **Create new Cloud Server (Droplet) with minimum specifications**
    * 512 MB/ 1CPU
    * 20 GB SSD DISK
    * 1000 GB transfer
    * ubuntu 16.04.5x64 distribution
2. [**Install Apache, MySQL, PHP (LAMP) stack**](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)
3. **Install Git**
      ```bash
      $ sudo apt-get install git
      ```
4. Add firewall rules to allow traffic on port **3306** and **8080**
      ```bash
      $ iptables -A INPUT -i eth0 -p tcp --dport 8080 -j ACCEPT
      $ iptables -A INPUT -i eth0 -p tcp --dport 3306 -j ACCEPT
      ```  

### 2. Client Side:
1. Preparing the SD card by downloading [the latest Raspbian Jessie image](https://www.raspberrypi.org/downloads/raspbian/)
2. **Install Dependencies:**
       - **[Docker](https://blog.alexellis.io/getting-started-with-docker-on-raspberry-pi/)**
       - **[OpenCV](http://www.pyimagesearch.com/2015/07/27/installing-opencv-3-0-for-both-python-2-7-and-python-3-on-your-raspberry-pi-2/)**
       - **[dlib](http://www.pyimagesearch.com/2017/03/27/how-to-install-dlib/)**
       - **[Torch](http://torch.ch/docs/getting-started.html#_)**
3. **Install Git**
      ```bash
      $ sudo apt-get install git
      ```
4. Add firewall rules to allow traffic on port **3306** and **8080**
      ```bash
      $ iptables -A INPUT -i eth0 -p tcp --dport 8080 -j ACCEPT
      $ iptables -A INPUT -i eth0 -p tcp --dport 3306 -j ACCEPT
      ```  
5. [Connect 3G modem stick](https://www.thefanclub.co.za/how-to/how-setup-usb-3g-modem-raspberry-pi-using-usbmodeswitch-and-wvdial)

## Source Code:
>EITS is actively developed on **GitHub**, where the code is always available.
You can either clone the public repository or download it as a zip file.
> - Source Code: https://github.com/SherineSameh/EyesInTheSky.git
> - Logo: https://www.behance.net/gallery/52558675/Eyes-In-The-Sky-Logo

## Configurations and Running:
### 1. Server Side:
1. Clone **master branch** on the server
    ```bash
    $ git clone https://github.com/SherineSameh/EyesInTheSky.git
    ```
2. Create new **Database** on http://hostname/phpmyadmin/ and Import [EITS.sql](https://github.com/SherineSameh/EyesInTheSky/blob/master/EITS.sql)
3. **Install Python Dependencies:**
    ```bash
    $ sh EITS/install-deps.sh
    ```
4. **Set Server Configurations, Install EITS and NUBES Packages**
    ```bash
    $ cd EITS
    $ nano EITS/config.py
    $ python setup.py install
    $ cd ../NUBES
    $ python setup.py install
    ```
5. Clone the portals at **/var/www/html** or **/opt/lampp/htdocs**
    ```bash
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Users
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Administration
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Government
    ```
6. Set SQL Server Configurations at each portal
    ```bash
    $ cd [PortalName]
    $ nano app/helpers/config.php
    ```
7. Run server script
    ```bash
    $ cd [MasterBranchDirectory]
    $ python server.py
    ```
### 2. Client Side:
1. Connect Raspberry Pi with the **3G modem 'ZTE WCDMA Technologies MSM'** and a **5V** power source
    ```bash
    $ sudo wvdial 3gconnect
    ```
2. Clone **master branch** on the Raspberry Pi
    ```bash
    $ git clone https://github.com/SherineSameh/EyesInTheSky.git
    ```
2. **Install Python Dependencies:**
    ```bash
    $ sh EITS/install-deps.sh
    ```
3. **Set Server Configurations, Install EITS and NUBES Packages**
    ```bash
    $ cd EITS
    $ nano EITS/config.py
    $ sudo python setup.py install
    $ cd ../NUBES
    $ sudo python setup.py install
    ```
4. Run client script
    ```bash
    $ cd [MasterBranchDirectory]
    $ python client.py
    ```
### 3. Auto run Configurations:
  - **Client Side**
    ```bash  
    $ cd /etc/init.d
    $ sudo wget https://github.com/SherineSameh/EyesInTheSky/blob/master/clientautoconnect
    $ sudo chmod 755 /etc/init.d/clientautoconnect
    $ sudo update-rc.d clientautoconnect defaults
    ```
     *If you wish to remove the script from the startup sequence in the future run:*

    ```bash
    $ /etc/rc2.d# update-rc.d -f clientautoconnect remove
    ```
  - [**Server Side**](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-screen-on-an-ubuntu-cloud-server)
 

## Support:
>If you are having issues, please let us know.
> - **Issue Tracker:** https://github.com/SherineSameh/EyesInTheSky/issues
> - **Mailbox:** eits@gmail.com

## License:
> All Rights Reserved © 2017 EITS TEAM. 
> Licensed under [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0).
