import socket
import threading
import utilities
import sys
import datetime
import os
from sys import exit
from dbHandler import dbHandler
import subprocess
import datetime

NUMBEROFTHREADS = 10
TASKNUMBER = [1, 2]

allConnections = []
allAddresses = []
RpConnections = {}

host = ''
port = 5555
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

def setupConnection():
    try:
        s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        s.bind((host, port))
        s.listen(NUMBEROFTHREADS)
    except socket.error as errorMsg:
        print(errorMsg)
        setupConnection()

def acceptConnections():
    RpConnections.clear()
    while True:
        try:
            connection, address = s.accept()
            connection.setblocking(1)
        except Exception as e:
            print(e)
            continue
        type = str(connection.recv(5))
        if type == '40307':
            thread = threading.Thread(target = checkType , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        elif type == '90901':
            thread = threading.Thread(target = checkType , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        elif type == '90201':
            thread = threading.Thread(target = connectRP , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        elif type == '80702':
            thread = threading.Thread(target = govCommands , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        else :
            continue
        print("Connections has been established | IP: " + address[0] + " | Port: " + str(address[1]))

def connectRP(s):
    connection = s
    result = str(connection.recv(80))
    print(result)
    specs = result.split("\n")
    ip = specs[0]
    mac = specs[1]
    print("RP Mac "+mac)
    RpConnections[mac] = connection

def sendcmd(connection):
    while True:
        cmd = raw_input()
        connection.send(str.encode(cmd))
        response = str(connection.recv(1024))
        print(response + "")

def checkType(s):
    connection = s
    type = connection.recv(1024)
    print(type.decode('utf-8'))
    if type.decode('utf-8') == "user":
        userCommands(connection)
    else:
        adminCommands(connection)

def adminCommands(c):
    connection = c;
    while True:
        data = connection.recv(1024);
        if not data:
            break
        command = data.decode('utf-8')
        # if 'close' in command :
            # hanshof han7ot eh hena
        # else:
            # print('Indefined command!')

def sendFile(connection,path , filename):
    connection.send("upload")
    filename2 = os.path.join(path,filename)
    filesize = os.path.getsize(filename2)
    print("file size is "+str(filesize))
    filesize = bin(filesize)[2:].zfill(32) # encode filesize as 32 bit binary
    connection.send(filesize)

    file_to_send = open(path+'/'+ filename, 'rb')
    l = file_to_send.read()
    connection.sendall(l)
    file_to_send.close()
    print 'Done Sending'


def govCommands(s):
    connection = s
    #train the set producing the 2 files
    os.system('python ~/Desktop/RemoteShell/retrain.py')
    # cmd = connection.recv(1024)
    print('hello')

    db = dbHandler()
    # mac = db.getMac()
    mac = 'b8:27:eb:d8:71:d5'
    # target = db.getSpecs(mac)
    Rp_connection = RpConnections[mac]
    # results = target.split(":")
    # print(results)

    directory = "/opt/lampp/htdocs/sherif/TF_FILES"


    sendFile(Rp_connection , directory , 'output_labels.txt' )
    print("jdowjdow")
    response = Rp_connection.recv(4)

    if response == 'done':
        sendFile(Rp_connection , directory , 'output_graph.pb')
        response = Rp_connection.recv(4)
        if response == 'done':
            result = str(Rp_connection.recv(1024)).decode('utf-8')
            print("result "+ result)


def userCommands(c):
    connection = c
    cmd = connection.recv(1024)
    path = cmd.decode('utf-8')

    db = dbHandler()
    # mac = db.getMac()
    mac = 'b8:27:eb:f5:d6:1c'
    Rp_connection = RpConnections[mac]

    directory = path

    sendFile(Rp_connection , directory ,'Dockerfile')
    response = Rp_connection.recv(11)
    if response == 'filecreated':
        print(response)
        Rp_connection.send('rundocker')
        result = str(Rp_connection.recv(1024)).decode('utf-8')
        connection.send(result)

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
