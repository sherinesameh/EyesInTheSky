import os
from requests import get

# Return Public IP
def getPublicIP():
    return get('https://api.ipify.org').text

# Return Private IP
def getPrivateIP():
    return os.popen('hostname -I').read().replace('"','')

# Return Mac address over eth0
def getMac():
    return open('/sys/class/net/eth0/address').read().replace('\n','')

# Return OS Specifications
def getOsImage():
    os = open('/etc/os-release').read()
    imageName = os.split('\n')
    return imageName[0].replace('PRETTY_NAME=','').replace('"','')

# Return CPU temperature
def getCPUtemperature():
    res = os.popen('vcgencmd measure_temp').readline()
    return res.replace("temp=","").replace("'C\n","")

# Return % of CPU used by user as a character string
def getCPUuse():
    return str(os.popen("top -n1 | awk '/Cpu\(s\):/ {print $2}'").readline().strip(\
    ))

# Return RAM information (unit=kb) in a list
# Index[0: total RAM, 1: used RAM, 2: free RAM]
def getRAMinfo():
    p = os.popen('free')
    i = 0
    while 1:
        i = i + 1
        line = p.readline()
        if i==2:
            return line.split()[1:4]

# Return information about disk space as a list (unit included)
# Index[0: total disk space, 1: used disk space, 2: remaining disk space, 3: percentage of disk used]
def getDiskSpace():
    p = os.popen("df -h /")
    i = 0
    while 1:
        i = i +1
        line = p.readline()
        if i==2:
            return line.split()[1:5]


def StaticSpecs():
    PublicIP = getPublicIP()
    MAC = getMac()
    RAM_stats = getRAMinfo()
    RAM_total = round(int(RAM_stats[0]) / 1000,1)
    DISK_stats = getDiskSpace()
    DISK_total = DISK_stats[0]
    OS = getOsImage()
    return (PublicIP + '\n' + MAC + '\n' + OS +'\n' + str(RAM_total) + '\n' + str(DISK_total))

def CurrentSpecs():
    CPU_temp = getCPUtemperature()
    CPU_usage = getCPUuse()
    RAM_stats = getRAMinfo()
    RAM_used = round(int(RAM_stats[1]) / 1000,1)
    RAM_free = round(int(RAM_stats[2]) / 1000,1)
    DISK_stats = getDiskSpace()
    DISK_free = DISK_stats[1]
    DISK_used = DISK_stats[2]
    DISK_perc = DISK_stats[3]
    PrivateIP = getPrivateIP()
    return (CPU_temp + '\n' + CPU_usage + '\n' + str(RAM_used) + '\n' + str(DISK_perc) + '\n' + PrivateIP)

# def main():
#     StaticSpecs()
#     CurrentSpecs()
#
# if __name__ == '__main__':
#     main()
