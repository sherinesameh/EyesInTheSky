import socket
import threading
import utilities
import sys
from sys import exit
from dbHandler import dbHandler

NUMBEROFTHREADS = 10
TASKNUMBER = [1, 2]
# queue = Queue()
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
            print("ana raspberry pi")
        print("Connections has been established | IP: " + address[0] + " | Port: " + str(address[1]))

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
        data = conn.recv(1024);
        if not data:
            break
        command = data.decode('utf-8')
        if 'close' in command :
            x = 5
            #hanshof han7ot eh hena
        else:
            print('Indefined command!')


def userCommands(c):
    connection = c
    cmd = connection.recv(1024)
    path = cmd.decode('utf-8')
    db = dbHandler()
    target = db.getMac()
    print(target)
    initDocker('192.168.8.100', 'pi', '123123', path, 'sherinesameh/user01', target)


def initDocker(hostname,username,password,dockerfile,repo,Mac):
    isbuilt = buildDocker(dockerfile, repo)
    if isbuilt:
        result = runDocker(hostname, username, password, repo)
        print(result)

def startCmd():
    while True:
        cmd = input('server > ')
        if cmd == 'list':
            listConnections()
        elif 'select' in cmd:
            target, connection = getTarget(cmd)
            if connection is not None:
                sendCommand(target, connection)
        elif cmd == 'broadcast':
            sendBroadcast()
        elif cmd == 'quit':
            exit(0)
        else:
            print('Indefined command!')


def listConnections():
    results = ''
    for i, connection in enumerate(allConnections):
        try:
            connection.send(str.encode('here?'))
            check = connection.recv(1024)
            if check.decode('utf-8') == 'yes':
                results += str(i) + ' | ' + str(allAddresses[i][0]) + ' | ' + str(allAddresses[i][1]) + '\n'
        except Exception as e:
            del allConnections[i]
            del allAddresses[i]
            continue

    print('Connected Clients:\n' + '#   |  IP Address  |   Port number\n' +results)

def getTarget(cmd):
    try:
        target = int(cmd.split(' ')[1])
        connection = allConnections[target]
        print("you are now connected to " + str(allAddresses[target][0]))
        print(str(allAddresses[target][0]) + '> ')
        return target, connection
    except Exception as e:
        print(e)
        return None, None

def sendCommand(target, connection):
    while True:
        cmd = input()
        if cmd == 'quit':
            break
        if cmd == ':wq':
            connection.close()
            s.close()
            del allConnections[target]
            del allAddresses[target]
            break
        if len(str.encode(cmd)) > 0:
            connection.send(str.encode(cmd))
            response = str(connection.recv(1024).decode('utf-8'))
            print(response)

def sendBroadcast():
    while True:
        cmd = input('Broadcast message > ')
        if cmd == 'quit':
            break
        for i, connection in enumerate(allConnections):
            if len(str.encode(cmd)) > 0:
                connection.send(str.encode(cmd))
                response = str(connection.recv(1024).decode('utf-8'))
                print(response)

def dockerLogin():
    try:
        hubusername = ''
        hubpassword = ''
        utilities.bashCommand('docker login --username=' + hubusername + ' --password=' + hubpassword)
    except Exception as e:
        print(e)

def buildDocker(dockerfile, repo):
    try:
        utilities.changeDir(dockerfile)
        utilities.bashCommand('docker build .')
        imgID = utilities.bashCommand('docker image ls -q').split('\n')[0]
        utilities.bashCommand('docker tag '+ imgID + ' ' + repo)
        dockerLogin()
        utilities.bashCommand('docker push '+ repo)
        return True
    except Exception as e:
        print(e)
        return False

def runDocker(hostname, username, password, repo):
    try:
        utilities.sshCommand(hostname, username, password, 'docker pull ' + repo)
        result = utilities.sshCommand(hostname, username, password, 'docker run ' + repo)
        return result
    except Exception as e:
        print(e)


def createThreads():
    for _ in range(NUMBEROFTHREADS):
        thread = threading.Thread(target = task)
        thread.daemon = True
        thread.start()

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
