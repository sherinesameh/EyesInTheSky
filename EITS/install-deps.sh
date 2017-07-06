#!/bin/bash

echo "==============================="
echo "checking python denpendecies.."
echo "==============================="
      sudo apt-get install python-dev 
      sudo apt-get install python-pip
      sudo pip install requests

echo "============================"
echo "Installing psutil"
echo "============================" 
      sudo pip install psutil
echo "============================"
echo "Installing pymysql"
echo "============================" 
      sudo pip install pymysql
echo "============================"
echo "Installing Numpy and Scipy"
echo "============================" 
      sudo pip install numpy scipy
echo "============================"
echo "Installing pandas"
echo "============================" 
      sudo pip install pandas
echo "============================"
echo "Installing SKlearn"
echo "============================" 
      sudo pip install -U scikit-learn
echo "============================"
echo "Installing SKlearn-image"
echo "============================" 
      sudo pip install scikit-image
echo "============================"
 



echo "Dependencies has been installed.."  
SOMEVAR='text stuff'  
echo "$SOMEVAR"
