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

import datetime
import os
import socket
import subprocess
import sys
import threading

from EITS.dbHandler import dbHandler
from EITS import utilities

HOST = ''
PORT = config.PORT
SOCKET = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
NUMBEROFTHREADS = 10
CONNECTIONS = {}
DB = dbHandler()

def setupConnection():
    try:
        SOCKET.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        SOCKET.bind((HOST, PORT))
        SOCKET.listen(NUMBEROFTHREADS)
    except socket.error as errorMsg:
        print(errorMsg)
        setupConnection()

def acceptConnections():
    CONNECTIONS.clear()
    TYPES = {
        '40307': userCommands,
        '90901': adminCommands,
        '80702': govCommands,
        '90201': connectRP
    }
    while True:
        try:
            connection, address = SOCKET.accept()
            connection.setblocking(1)
        except Exception as e:
            print(e)
            continue
        type = str(connection.recv(5))
        thread = threading.Thread(target = TYPES[type] , kwargs={'connection': connection})
        thread.daemon = True
        thread.start()
        print('====================================================================================\n')
        print('Connections has been established | IP: ' + address[0] + ' | Port: ' + str(address[1]) + '\n')
        print('====================================================================================\n')        

def connectRP(connection):
    handshakePck = str(connection.recv(90))
    print('Handshaking Packet: \n' + handshakePck + '\n')
    print('====================================================================================\n')
    specs = handshakePck.split(':_:')
    DB.addPi(specs[0],specs[1],specs[2],specs[3],specs[4],specs[5])
    mac = specs[1]
    CONNECTIONS[mac] = connection

def adminCommands(connection):
    AdminID = str(connection.recv(5)).decode("utf-8")
    cmd = str(connection.recv(2048)).decode("utf-8")
    cmd = cmd.split(":_:")
    if cmd[0] == "15151":
        mac = cmd[1]
        connectionRP = CONNECTIONS[mac]
        connection.send('killer')
        container = cmd[2]
        processNameSize = len(container)
        processNameSize = bin(processNameSize)[2:].zfill(32)
        connection.send(processNameSize)
        connection.send(container)
    if cmd[0] == "27351":
       mac = cmd[1]
       connectionRP = CONNECTIONS[mac]
       connectionRP.send('shutdw')
       DB.shutPi(AdminID, mac )
    if cmd[0] == "87452":
       mac = cmd[1]
       connectionRP = CONNECTIONS[mac]
       connectionRP.send('restrt')
       DB.restartPi(AdminID, mac )           

def userCommands(connection):

    print('A user upload a new Dokerfile\n')
    print('====================================================================================\n')    
    mac = DB.getBestPi()
    data = str(connection.recv(1024))
    print("data is "+data)
    path , processName , userID = data.split(":_:")
    print("path "+path + " ,processName "+processName)
    connectionRP = CONNECTIONS[mac]
    connectionRP.send('docker')
    utilities.sendFile(connectionRP, path, processName, userID , 'Dockerfile')
    response = str(connectionRP.recv(11)).decode('utf-8')
    print('\nResponse: ' + response)

    if response == 'filecreated':
        connectionRP.send('rundocker')
    results = str(connectionRP.recv(1024)).decode('utf-8')
    print('\nDocker Results: ' + results)
    print('====================================================================================\n')
    DB.updateResults(userID , processName , results)


def govCommands(connection):

    print('An employee upload a new criminal\n')
    print('====================================================================================\n')
    type = str(connection.recv(1)).strip()
    #train the set producing the 2 files
    os.system('cd ~/Desktop/TF_FILES; python train.py')

    if type == "1":
    # general --> send to all pi-s with camera
        print('\nClassifier.pkl is send to all the RPs connected with a camera') 
        macs = DB.getCameraPis()
        for x in macs:
            print("el mac "+x)
            connectionRP = CONNECTIONS[x]
            sendToCamera(connectionRP)
        
    if type == "2":
    #specific to pi-s in specific locations    
        locations = str(connection.recv(1024)).strip().split(":_:")
        print('\nClassifier.pkl is send to the RPs connected with a camera at those locations only: \n' + locations)
        macs = DB.getLocatedPis(locations)
        for x in macs:
            connectionRP = CONNECTIONS[x]
            sendToCamera(connectionRP)

    
def sendToCamera(connection):
    directory = "/home/yamen/Desktop/TF_FILES/generated-embeddings"
    connection.send("upload")
    utilities.sendFileCamera(connection , directory , 'classifier.pkl' )
    response = connection.recv(4)

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
