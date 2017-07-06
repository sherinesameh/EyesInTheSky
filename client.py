import socket
import sys
import os
import subprocess
import datetime
import specs
import threading
import time
from dbHandler import dbHandler

# host = '46.101.180.16'
host = '192.168.43.114'
port = 8080
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
db = dbHandler()

def establishConnection():
    try:
        s.connect((host, port))
        s.send('90201')
    except socket.error as errorMsg:
        print(errorMsg)

def updateSpecs():
  sendSpecs()
  while(True):
    currentSpecs = specs.CurrentSpecs().split(':_:')
    mac = specs.getMac()
    db.updateCurrentSpecs(mac, currentSpecs[0], currentSpecs[1], currentSpecs[2], currentSpecs[3], currentSpecs[4])
    time.sleep(30)
    
def createDir(processName):
    directory = '/home/pi/Desktop/'+processName
    return directory

def receiveFile(directory):
    try:

        filesize = s.recv(32)
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
                data = s.recv(chunksize)
                f.write(data)
                filesize -= chunksize
            f.close()
            print 'File received successfully'
    except IOError as e:
        print e

def sendSpecs():
    s.send(specs.StaticSpecs())


def receiveFileCamera(directory,filename):
    try:
        filesize = s.recv(32)
        filesize = int(filesize, 2)
        print('file size '+str(filesize)) 

        os.chdir(directory)
        if str(os.getcwd()) == directory:
            f = open(filename,'w')
            chunksize = 1000
            
            while filesize > 0:
                if filesize < chunksize:
                    chunksize = filesize
                data = s.recv(chunksize)
                f.write(data)
                f.close()
                s.send(str(1))
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
    cmd = s.recv(6)
    print("el command eli galy "+cmd)
    if cmd == 'upload' :  
       directory = "/home/pi/Desktop/server_current/generated-embeddings" 
       receiveFileCamera(directory , 'classifier.pkl')
       s.send('done')
       command = 'cd /home/pi/Desktop/server_current; python classifier.py'
       os.system(command)
    
    if cmd == 'docker' :
       processSize = s.recv(32)
       processSize = int(processSize, 2)
       data = str(s.recv(processSize)).decode('utf-8')
       processName , userID = data.split(":_:")
       directory = createDir(processName)        
       receiveFile(directory)
       s.send('filecreated')
       if s.recv(9) == 'rundocker':
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

              PortCMD = "docker inspect -f '{{range $p, $conf := .NetworkSettings.Ports}} {{$p}} -> {{(index $conf 0).HostPort}} {{end}}' " + containerID
              portDocker = subprocess.Popen(PortCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
              out , err = portDocker.communicate()
              port = str(out)

              db = dbHandler()
              db.addProcess(containerID , imgID , IPAddress , port, userID ,processName , specs.getMac())

          except Exception as e:
              output = e
          print(output)
          s.send(str.encode(output))
    if cmd == 'killer':
       filesize = s.recv(32)
       filesize = int(filesize, 2)
       msg = s.recv(filesize)
       containerID = msg
       PortCMD = 'docker kill ' + containerID
       killDocker = subprocess.Popen(PortCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
       out , err = killDocker.communicate()
    if cmd == 'shutdw':
       shutCMD = ' shutdown -r now '
       killDocker = subprocess.Popen(shutCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    
    if cmd == 'restrt':
       shutCMD = ' reboot '
       killDocker = subprocess.Popen(shutCMD, shell = True, stdout = subprocess.PIPE, stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    
    if cmd == 'finish':
       break;      
  s.close()

def main():
    establishConnection()
    thread1 = threading.Thread(target = executeCommand)
    thread1.daemon = True
    thread1.start()
    updateSpecs()
    
if __name__ == '__main__':
    main()
