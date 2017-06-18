import datetime
from   dbHandler import dbHandler
import os
import socket
import subprocess
import sys
import threading
import utilities

HOST = ''
PORT = 8080
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
        print("Connections has been established | IP: " + address[0] + " | Port: " + str(address[1]))

def connectRP(connection):
    handshakePck = str(connection.recv(80))
    specs = handshakePck.split('\n')
    mac = specs[1]
    CONNECTIONS[mac] = specs[0]

def adminCommands(connection):
    while True:
        cmd = str(connection.recv(1024)).decode('utf-8')
        if not cmd:
            break

def userCommands(connection):
    mac = DB.getBestPi()
    path = str(connection.recv(1024)).decode('utf-8')
    connectionRP = CONNECTIONS[mac]
    connectionRP.send('docker')
    utilities.sendFile(connectionRP, path, 'Dockerfile')
    response = str(connectionRP.recv(11)).decode('utf-8')
    if response == 'filecreated':
        connectionRP.send('rundocker')
        connection.send(str(connectionRP.recv(1024)).decode('utf-8'))

# def userCommands(connection):
    # bestPi = dbHandler()
    # mac = bestPi.getBestPi()
    # hostname = CONNECTIONS[mac]
    # specs = str(bestPi.getSpecs(mac)).split(':')
    # username = specs[0]
    # password = specs[1]
    # localPath = str(connection.recv(1024)).decode('utf-8')
    # remotePath = utilities.createPiDir()
    # sftp = utilities.put(hostname, username, password, localPath, remotePath)
    # if sftp:
    #     connection.send(utilities.buildAndRunDocker(hostname, username, password, remotePath))

def govCommands(connection):
    #train the set producing the 2 files
    os.system('python ~/Desktop/RemoteShell/Trainer.py')
    # cmd = connection.recv(1024)
    mac = DB.getBestPi()
    # mac = 'b8:27:eb:f5:d6:1c'
    # target = DB.getSpecs(mac)
    mac = 'b8:27:eb:a0:83:49'
    connectionRP = CONNECTIONS[mac]
    # results = target.split(":")
    # print(results)
    directory = "/opt/lampp/htdocs/sherif/TF_FILES"

    connectionRP.send("upload")
    utilities.sendFile(connectionRP , directory , 'Graph.npy' )
    response = connectionRP.recv(4)

    if response == 'done':
        utilities.sendFile(connectionRP , directory , 'Labels.npy')
        response = connectionRP.recv(4)
        if response == 'done':
            result = str(connectionRP.recv(1024)).decode('utf-8')
            print("result "+ result)

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
