import datetime
import os
import socket
import subprocess
import sys
import threading

from EITS import config
from EITS import utilities
from EITS.dbHandler import dbHandler

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
    AdminID = str(connection.recv(5)).decode('utf-8')
    cmd = str(connection.recv(2048)).decode('utf-8')
    cmd = cmd.split(':_:')
    if cmd[0] == '15151':
        mac = cmd[1]
        connectionRP = CONNECTIONS[mac]
        connection.send('killer')
        container = cmd[2]
        processNameSize = len(container)
        processNameSize = bin(processNameSize)[2:].zfill(32)
        connection.send(processNameSize)
        connection.send(container)
    if cmd[0] == '27351':
       mac = cmd[1]
       connectionRP = CONNECTIONS[mac]
       print('el mac eli ray7lo '+mac)
       connectionRP.send('shutdw')
       DB.shutPi(AdminID, mac )
    if cmd[0] == '87452':
       mac = cmd[1]
       connectionRP = CONNECTIONS[mac]
       connectionRP.send('restrt')
       DB.restartPi(AdminID, mac )

def userCommands(connection):
    print('A user upload a new Dokerfile\n')
    print('====================================================================================\n')
    mac = DB.getBestPi()
    data = str(connection.recv(1024))
    path , processName , userID = data.split(':_:')
    print('Submitted Process Name: '+ processName + '\nPath of the submitted Process: '+ path)
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
    os.system('cd' + config.DIRECTORY + '; python train.py')
    if type == '1':
        print('\nClassifier.pkl is send to all the RPs connected with a camera')
        macs = DB.getCameraPis()
        for x in macs:
            print('el mac '+x)
            connectionRP = CONNECTIONS[x]
            sendToCamera(connectionRP)

    if type == '2':
        locations = str(connection.recv(1024)).strip().split(':_:')
        print('\nClassifier.pkl is send to the RPs connected with a camera at those locations only: \n' + locations)
        macs = DB.getLocatedPis(locations)
        for x in macs:
            connectionRP = CONNECTIONS[x]
            sendToCamera(connectionRP)


def sendToCamera(connection):
    def sendToCamera(macs):
        for index, mac in enumerate(macs):
            print('\nRP['+ index +']: ' + mac)
            connectionRP = CONNECTIONS[mac]
            connectionRP.send('upload')
            directory =  config.DIRECTORY +'/generated-embeddings'
            utilities.sendFileCamera(connectionRP,directory, 'classifier.pkl')
            response = connectionRP.recv(4)
            print('\nRP['+ index +'] response: ' + response)

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
