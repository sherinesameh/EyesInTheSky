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

import socket
import sys
import os
import subprocess
import datetime
import threading
import time

from EITS import specs
from EITS.dbHandler import dbHandler


# HOST = '46.101.180.16'
HOST   = config.HOSTNAME
PORT   = config.PORT
SOCKET = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
DB     = dbHandler()

def establishConnection():
    try:
        SOCKET.connect((HOST, PORT))
        SOCKET.send('90201')
    except socket.error as errorMsg:
        print(errorMsg)

def updateSpecs():
*  sendSpecs()
  while(True):
    currentSpecs = specs.CurrentSpecs().split(':_:')
    print('Current Specs Updated:\n' + str(currentSpecs))
    mac = specs.getMac()
    DB.updateCurrentSpecs(mac, currentSpecs[0], currentSpecs[1], currentSpecs[2], currentSpecs[3], currentSpecs[4])
    time.sleep(30)
    
def createDir(processName):
    directory = '/home/pi/Desktop/'+processName+"_"+datetime.datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    return directory

def receiveFile(directory):

    print('Receiving Dockerfile:\n')
    print('====================================================================================\n')  
    try:

        filesize = SOCKET.recv(32)
        filesize = int(filesize, 2)
        print('file size '+str(filesize)) 

        os.mkdir(directory, 0755);
        os.chdir(directory)
        
        if str(os.getcwd()) == directory:
            f = open('Dockerfile','wb')
            chunksize = 4096
            
            while filesize > 0:
                if filesize < chunksize:
                    chunksize = filesize
                data = SOCKET.recv(chunksize)
                f.write(data)
                filesize -= chunksize
            f.close()
            print 'File received successfully'
    except IOError as e:
        print e

def sendSpecs():
    SOCKET.send(specs.StaticSpecs())


def receiveFileCamera(directory,filename):

    print('Receiving Classifier.pkl:\n')
    print('====================================================================================\n')  
    try:
        filesize = SOCKET.recv(32)
        filesize = int(filesize, 2)
        print('file size '+str(filesize)) 

        os.chdir(directory)
        if str(os.getcwd()) == directory:
            f = open(filename,'w')
            chunksize = 1000
            
            while filesize > 0:
                if filesize < chunksize:
                    chunksize = filesize
                data = SOCKET.recv(chunksize)
                f.write(data)
                f.close()
                SOCKET.send(str(1))
                filesize -= chunksize
                filename2Test = os.path.join(directory,filename)
                filesizeTest = os.path.getsize(filename2Test)
                f = open(filename,'a')  
            f.close()
            print 'File received successfully'  
    except IOError as e:
        print e


def executeCommand():
  while True:
    cmd = SOCKET.recv(6)
    if cmd == 'upload' :  
       directory = "/home/pi/Desktop/Pi_Server/generated-embeddings" 
       receiveFileCamera(directory , 'classifier.pkl')
       SOCKET.send('done')
       command = 'cd /home/pi/Desktop/Pi_Server; python classifier.py'
       os.system(command)
    
    if cmd == 'docker' :
       processSize = s.recv(32)
       processSize = int(processSize, 2)
       data = str(s.recv(processSize)).decode('utf-8')
       processName , userID = data.split(":_:")
       directory = createDir(processName)        
       receiveFile(directory)
       SOCKET.send('filecreated')
       if SOCKET.recv(9) == 'rundocker':
          try:
              build = 'docker build .' 
              buildDocker = subprocess.Popen(build, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              
              buildDockeroutput , err = buildDocker.communicate()

              words = buildDockeroutput.split('Successfully built')
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

              IPAddressCMD = "docker inspect --format '{{ .NetworkSettings.IPAddress }}' " + containerID
              addressDocker = subprocess.Popen(IPAddressCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              out , err = addressDocker.communicate()
              IPAddress = str(out)

              PortCMD = "docker inspect -f '{{range $p, $conf := .NetworkSettings.Ports}} {{$p}} -> {{(index $conf 0).HOSTPort}} {{end}}' " + containerID
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
       shutCMD = ' shutdown -r now '
       killDocker = subprocess.Popen(shutCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    
    if cmd == 'restrt':
       rebootCMD = ' reboot '
       killDocker = subprocess.Popen(rebootCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    
    if cmd == 'finish':
       break;      
  SOCKET.close()

def main():
    establishConnection()
    thread1 = threading.Thread(target = executeCommand)
    thread1.daemon = True
    thread1.start()
    updateSpecs()
    
if __name__ == '__main__':
    main()