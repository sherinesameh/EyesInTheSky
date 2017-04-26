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
    specs = str(connection.recv(1024))
    print(specs)

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

def sendFile(connection,path):
    f = open(path,'rb')
    while True:
        reading = f.read(1024)
        if not reading:
            break
        connection.send(str.encode(reading))  
        # print(connection.recv(1024)).decode('utf-8')
    f.close()
    print 'Done Sending'

def createDir():
    directory = '/home/yamen/Desktop/' + datetime.datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    return directory

def userCommands(c):
    connection = c
    cmd = connection.recv(1024)
    path = cmd.decode('utf-8')
    
    db = dbHandler()
    mac = db.getMac()
    target = db.getSpecs(mac)
    results = target.split(":")
    print(results)

    username = results[0]
    password = results[1]
    hostname = results[2]

    print(username)
    print(password)
    print(hostname)

    directory = path
    print("el patj is "+directory)
    # os.mkdir(directory, 0755);
    os.chdir(directory)
    if str(os.getcwd()) == directory:
        cmd = 'docker build .' 
        try:
            execute = subprocess.Popen(cmd, shell = True, stdout = subprocess.PIPE,
            stderr = subprocess.PIPE, stdin = subprocess.PIPE)
            outputBytes = execute.stdout.read() + execute.stderr.read()
            output = str.encode(outputBytes)
        except Exception as e:
            output = e
        print(output) 
        connection.send(output)
        print("done")
 
    # add the user username to the directory name??
    #Create a new directory for each new job
    # directory = '~/Desktop/' + datetime.datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    # utilities.sshCommand(hostname, username, password, 'mkdir ' + directory)

    # #Copy the docker file on RP
    # utilities.bashCommand('cat ' + path + '/Dockerfile | sshpass -p ' + password + ' ssh ' + username + '@' + hostname + ' "cat >> '+ directory +'/Dockerfile"')

    # # Must display result on web instead of printing??
    # #Build and run the docker file
    # result = buildAndRunDocker(hostname, username, password, directory)
    # connection.send(result)


def buildAndRunDocker(hostname, username, password, directory):
    changeDir   = 'cd ' + directory +' ; '
    buildDocker = utilities.sshCommand(hostname, username, password, changeDir+'docker build .')
    p  = str(buildDocker)
    words = buildDocker.split('Successfully built')
    imgID = words[1].strip()
    print("my id is "+imgID)
    

    imgID = utilities.sshCommand(hostname, username, password, 'docker image ls -q').split('\n')[1]


    print(imgID)

    runDocker = utilities.sshCommand(hostname, username, password, 'docker run ' + imgID)
    return runDocker

def main():
    setupConnection()
    acceptConnections()

if __name__ == '__main__':
    main()
