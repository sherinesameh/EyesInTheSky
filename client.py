import socket
import sys
import os
import subprocess
import datetime
import specs
import utilities
from dbHandler import dbHandler
from threading import Thread
from time      import sleep

HOST = '46.101.180.169'
PORT   = 8080
SOCKET = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
DB     = dbHandler('pi')

def establishConnection():
    try:
        SOCKET.connect((HOST, PORT))
        SOCKET.send('90201')
    except socket.error as errorMsg:
        print(errorMsg)

def updateSpecs():
    SOCKET.send(specs.StaticSpecs())
    while(True):
        mac = specs.getMac()
        currentSpecs = specs.CurrentSpecs().split(':_:')
        print(currentSpecs)
        DB.updateSpecs(mac, currentSpecs[0], currentSpecs[1], currentSpecs[2], currentSpecs[3])
        sleep(30)

def executeCommands():
  while True:
    cmd = SOCKET.recv(6)
    if cmd == 'upload' :
       processSize = SOCKET.recv(32)
       processSize = int(processSize, 2)
       userID , processName = str(SOCKET.recv(processSize)).decode('utf-8').split(":_:")
       directory = utilities.createPiDir(processName)
       utilities.receiveFile(directory)
       SOCKET.send('filecreated')
       if SOCKET.recv(9) == 'rundocker':
          try:
              build = 'docker build .'
              buildDocker = subprocess.Popen(build, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)

              words = buildDocker.split('Successfully built')
              imgID = words[1].strip()

              run = 'docker run ' + imgID
              runDocker = subprocess.Popen(run, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)

              outputBytes = runDocker.stdout.read() + runDocker.stderr.read()
              output = str.encode(outputBytes)

              inspect = 'docker ps -a --filter ancestor=' + imgID
              inspectDocker = subprocess.Popen(inspect, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              out , err = inspectDocker.communicate()

              header = str(out).splitlines()
              splitHeader = header[1].split(' ')
              containerID = splitHeader[0]

              IPAddressCMD = 'docker inspect --format ={{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' + containerID
              addressDocker = subprocess.Popen(IPAddressCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              out , err = addressDocker.communicate()
              IPAddress = str(out)

              PortCMD = 'docker inspect --format ={{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' + containerID
              portDocker = subprocess.Popen(PortCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              out , err = portDocker.communicate()
              port = str(out)

              DB.addProcess(containerID , imgID , IPAddress , port, userID ,processName , specs.getMac())

          except Exception as e:
              output = e
          print(output)
          SOCKET.send(str.encode(output))
    if cmd == 'killer':
       filesize = SOCKET.recv(32)
       filesize = int(filesize, 2)
       msg = SOCKET.recv(filesize)
       containerID = msg
       PortCMD = 'docker kill ' + containerID
       killDocker = subprocess.Popen(PortCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
       out , err = killDocker.communicate()
    if cmd == 'shutdw':
       shutCMD = 'sudo shutdown -r now'
       killDocker = subprocess.Popen(shutCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)

    if cmd == 'restrt':
       shutCMD = 'sudo reboot'
       killDocker = subprocess.Popen(shutCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)

    if cmd == 'finish':
       break;
    SOCKET.close()

def main():
    establishConnection()

    excuteCmdThread   = Thread(target = executeCommands)
    excuteCmdThread.start()

    updateSpecsThread = Thread(target = updateSpecs)
    updateSpecsThread.start()

    excuteCmdThread.join()
    updateSpecsThread.join()

if __name__ == '__main__':
    main()
