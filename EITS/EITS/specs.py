# Developed By 2017 Computer and Communication Department-Alexandria University graduation project team
#
# Email: EITS@gmail.com
#
# Authors: MOHAMED SHERIF,YAMEN EMAD, SHERINE SAMEH
#
# Copyright (c) EITS TEAM 2017 
# 
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# 
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
# 
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.
#=================================================================================

import os
import threading
from requests import get
import psutil
import re
import subprocess

Camera_Types = {"Creative":'0458:707e'}

def getPublicIP():
    # Return Public IP
    return get('https://api.ipify.org').text

def getPrivateIP():
    # Return Private IP
    ip = os.popen('hostname -I').read().replace('"','')
    return ip.replace('\n','')

def getMac():
    # Return Mac address over eth0
    return open('/sys/class/net/eth0/address').read().replace('\n','')

def getOsImage():
    # Return OS Specifications
    os = open('/etc/os-release').read()
    imageName = os.split('\n')
    return imageName[0].replace('PRETTY_NAME=','').replace('"','')

def getCPUtemperature():
    # Return CPU temperature in celsius
    res = os.popen('vcgencmd measure_temp').readline()
    return res.replace("temp=","").replace("'C\n","")

def getCPUusage():
    # Return % of CPU used by user as a character string
    return str(os.popen("top -n1 | awk '/Cpu\(s\):/ {print $2}'").readline().strip(\
    ))

def getRAMinfo():
    # Return RAM information (unit=kb) in a list
    # Index[0: total RAM, 1: used RAM, 2: free RAM]
    p = os.popen('free')
    i = 0
    while 1:
        i = i + 1
        line = p.readline()
        if i==2:
            return line.split()[1:4]

def getDiskSpace():
    # Return information about disk space as a list (unit included)
    # Index[0: total disk space, 1: used disk space, 2: remaining disk space, 3: percen$
    p = os.popen("df -h /")
    i = 0
    while 1:
        i = i +1
        line = p.readline()
        if i==2:
            return line.split()[1:5]

def hasCamera():

    device_re = re.compile("Bus\s+(?P<bus>\d+)\s+Device\s+(?P<device>\d+).+ID\s(?P<id>\w+:\w+)\s(?P<tag>.+)$", re.I)
    df = subprocess.check_output("lsusb")
    
    for i in df.split('\n'):
        if i:
            info = device_re.match(i)

            if info:
                dinfo = info.groupdict()
                if dinfo['id'] in Camera_Types.values():
                    return 1
    return 0

def StaticSpecs():
    PublicIP = getPublicIP()
    MAC = getMac()
    OS = getOsImage()
    RAM = psutil.phymem_usage()
    RAM_total = RAM.total / 2**20       # MiB.
    DISK = psutil.disk_usage('/')
    DISK_total = DISK.total / 2**30     # GiB.
    Camera = hasCamera()
    #RAM_stats = getRAMinfo()
    #RAM = round(int(RAM_stats[0]) / 1000,1)
    #DISK_stats = getDiskSpace()
    #DISK = DISK_stats[0]
    return (PublicIP + ':_:' + MAC + ':_:' + OS +':_:' + str(RAM_total) + ':_:' + str(DISK_total)+ ':_:' + str(Camera))


def CurrentSpecs():
    PrivateIP = getPrivateIP()
    CPU_temp = getCPUtemperature()
    CPU_usage = getCPUusage()
    RAM = psutil.phymem_usage()
    RAM_usage = RAM.percent
    disk = psutil.disk_usage('/')
    DISK_usage = disk.percent
    # RAM_stats = getRAMinfo()
    # RAM_total = round(int(RAM_stats[0]) / 1000,1)
    # RAM_used = round(int(RAM_stats[1]) / 1000,1)
    # RAM_free = round(int(RAM_stats[2]) / 1000,1)
    # RAM_perc = ((RAM_total - RAM_free)/RAM_total)*100
    # DISK_stats = getDiskSpace()
    # DISK_free = DISK_stats[1]
    # DISK_used = DISK_stats[2]
    # DISK_perc = DISK_stats[3]
    return(PrivateIP +':_:'+ CPU_temp +':_:'+ CPU_usage +':_:'+ str(DISK_usage) +':_:'+ str(RAM_usage))

