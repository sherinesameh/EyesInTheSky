import socket
import threading
import utilities
import sys
from sys import exit
from dbHandler import dbHandler

NUMBEROFTHREADS = 10
TASKNUMBER = [1, 2]

allConnections = []
allAddresses = []
RpConnections = {}

host = ''
port = 8080
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
        if str(address[0]) == "127.0.0.1": #user or admin is establishing the connection
            thread = threading.Thread(target = checkType , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        else : #raspberry pi is establishing the connection
            thread = threading.Thread(target = connectRP , kwargs={'s': connection})
            thread.daemon = True
            thread.start()
        print("Connections has been established | IP: " + address[0] + " | Port: " + str(address[1]))

def connectRP(s):
    connection = s
    specs = connection.recv(1024)
    print(specs.decode('utf-8'))

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
            #hanshof han7ot eh hena
        # else:
            # print('Indefined command!')

def userCommands(c):
    connection = c
    cmd = connection.recv(1024)
    path = cmd.decode('utf-8')
    print('get Mac address and send docker file')
    # db = dbHandler()
    # target = db.getMac()
    # print(target)
    hostname = '192.168.1.38'
    username = 'pi'
    password = 'pi123123'
    command = 'ls'
    print (utilities.sshCommand(hostname,username,password,command))
    # send docker file, run it and get result
    # initDocker('192.168.1.38', 'pi', 'raspberry', path, 'sherinesameh/user01', target)

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
