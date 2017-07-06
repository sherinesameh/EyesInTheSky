[logo]: https://github.com/SherineSameh/EyesInTheSky/blob/Users/public/assets/img/icon.png
# EyesInTheSky [EITS]
## Description:

>EITS is a mobile adhoc cloud system that serves the government since it provides an affordable tool that helps in detecting criminals and their location as fast as possible.
>Website: MVC Model - No Framework - Angular JS - Material Design.
>Back-End: PHP and Python

## Table of Contents:
1. Installation
      * Server Side
      * Client Side
2. Source Code
3. Configurations and Running
4. Support
5. License


## Installation:
### 1. Server Side:
1. **Create new Cloud Server (droplet) with minimum specifications**
    * 512 MB/ 1CPU
    * 20 GB SSD DISK
    * 1000 GB transfer
    * ubuntu 16.04.5x64 distribution
2. [**Install Apache, MySQL, PHP (LAMP) stack**](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)
3. **Install Git**
      ```bash
      $ sudo apt-get update
      $ sudo apt-get install git
      ```
4. **Import EITS Database**
     1. Download EITS.sql
    ```bash
    $ wget https://github.com/SherineSameh/EyesInTheSky/blob/master/EITS.sql
    ```
      2. Open http://hostname/phpmyadmin/
      3. Create new database and Import EITS.sql
5. Add firewall rules to allow traffic on port **3306** and **8080**
      ```bash
      $ iptables -A INPUT -i eth0 -p tcp --dport 8080 -j ACCEPT
      $ iptables -A INPUT -i eth0 -p tcp --dport 3306 -j ACCEPT
      ```  
6. **Install Dependencies:**
    **i. bash.sh**
    ```bash
    $ wget https://github.com/SherineSameh/EyesInTheSky/blob/master/bash.sh
    $ sh bash.sh
    ```
    **ii. EITS Package**
    ```bash
    $ wget https://github.com/SherineSameh/EyesInTheSky/blob/master/setup.py
    $ python setup.py install
    ```
### 2. Client Side:
1. Preparing the SD card by downloading [the latest Raspbian Jessie image](https://www.raspberrypi.org/downloads/raspbian/)
2. **Install Dependencies:**   
  **i.** [Docker](https://blog.alexellis.io/getting-started-with-docker-on-raspberry-pi/)
  **ii. OpenCV**
      ```bash
      $ [compiler] sudo apt-get install build-essential
      $ [required] sudo apt-get install cmake git libgtk2.0-dev pkg-config libavcodec-dev libavformat-dev libswscale-dev
      $ [optional] sudo apt-get install python-dev python-numpy libtbb2 libtbb-dev libjpeg-dev libpng-dev libtiff-dev libjasper-dev libdc1394-22-dev
      $ make dir opncv
      $ Download and extact opencv and opencv contrib in opencv directory:
        *opencv: https://github.com/opencv/opencv
        *opencv-contrib: https://github.com/opencv/opencv_contrib
      $ cd opencv-maser
      $ make dir build
      $ open terminal-->cd opencv/opencv-master/build
      $ cmake -D CMAKE_BUILD_TYPE=RELEASE -D CMAKE_INSTALL_PREFIX=/usr/local -D INSTALL_C_EXAMPLES=OFF -D INSTALL_PYTHON_EXAMPLES=ON -D BUILD_EXAMPLES=ON -D OPENCV_EXTRA_MODULES_PATH=/home/sherif/opencv/opencv_contrib-master /modules /home/sherif/opencv/opencv-master/modules
      $ make -j2
      $ sudo make install
      ```
 **iii. dlib**
      ```bash
      $ sudo apt-get install build-essential cmake
      $ sudo apt-get install libgtk-3-dev
      $ sudo apt-get install libboost-all-dev
      $ pip install numpy
      $ pip install scipy
      $ pip install scikit-image
      $ pip install dlib
      ```
      *Check That Dlib Is Correctly Linked To Python2*
      
  **iv. Torch**
      ```bash
      $ git clone https://github.com/torch/distro.git ~/torch --recursive
      $ cd ~/torch
      $ bash install-deps
      $ ./install.sh
      $ source ~/.bashrc
      $ for NAME in dpnn nn optim optnet csvigo cutorch cunn fblualib torchx tds; do luarocks install $NAME; done
      ```
      *Check That Torch Is Correctly Installed By Typing 'th' In Terminal*
      
   **v. bash.sh**
      ```bash
      $ wget https://github.com/SherineSameh/EyesInTheSky/blob/master/bash.sh
      $ sh bash.sh
      ```
      
      **vi. EITS Package**
      ```bash
      $ wget https://github.com/SherineSameh/EyesInTheSky/blob/master/setup.py
      $ python setup.py install
      ```
3. [Connect 3G modem stick](https://www.thefanclub.co.za/how-to/how-setup-usb-3g-modem-raspberry-pi-using-usbmodeswitch-and-wvdial)
4. Add firewall rules to allow traffic on port **3306** and **8080**
      ```bash
      $ iptables -A INPUT -i eth0 -p tcp --dport 8080 -j ACCEPT
      $ iptables -A INPUT -i eth0 -p tcp --dport 3306 -j ACCEPT
      ```  
## Source Code:
>EITS is actively developed on **GitHub**, where the code is always available.
>You can either clone the public repository or download it as a zip file.

>Source Code: https://github.com/SherineSameh/EyesInTheSky.git

## Configurations and Running:
1. Clone master branch on the Rasbperry pi(s) and the server at /home/_username_
    ```bash
    $ cd /home/username
    $ git clone https://github.com/SherineSameh/EyesInTheSky.git EITS
    ```
2. Clone the 3 portals: Users,Government and Administartion at: /var/www/html
    ```bash
    $ cd /var/www/html
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Users EyesInTheSky
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Administartion eits-administration
    $ git clone  https://github.com/SherineSameh/EyesInTheSky.git -b Government eits-government
    ```
3. Set SQL Server Config at **EITS/dbHandler.py (line 8)**
4. Set Web Server Config at **/var/www/html/_PortalName_/app/helpers/config.py**
5. SSH on the server and run **server.py** script
6. Connect RP with a power Source add the 3G modem stick and run **client.py**
7. Open any portal, login and start enjoying it's functionalities

## Support:
>If you are having issues, please let us know.

>**Issue Tracker:** https://github.com/SherineSameh/EyesInTheSky/issues
>**Mailbox:** eits@gmail.com

## License:
>The Project is licensed under [Apache License 2.0](http://www.apache.org/licenses/)
