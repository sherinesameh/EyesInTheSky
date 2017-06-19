from pexpect import pxssh
import getpass
import sys
import os
import subprocess
import pysftp
import datetime

def createPiDir():
    directory = '/home/pi/Desktop/' + datetime.datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
    return directory

def changeDir(newDir):
    try:
        os.chdir(newDir)
    except Exception as e:
        print (e)

def keyValidation(hostname):
    subprocess.Popen('ssh-keygen -R' + hostname, shell = True, stdout = subprocess.PIPE,
    stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    print('Invalid key has been deleted\n')

def sshCommand(hostname, username, password, command):
    try:
        keyValidation(hostname)
        connection = pxssh.pxssh()
        connection.login(hostname, username, password)
        connection.sendline(command)
        connection.prompt()
        output = connection.before
        connection.logout()
        return str(output.decode('utf-8'))
    except Exception as e:
        print (e)
        return None

def bashCommand(command):
    try:
        cmd = subprocess.Popen(command.decode('utf-8'), shell = True, stdout = subprocess.PIPE,
        stderr = subprocess.PIPE, stdin = subprocess.PIPE)
        output = cmd.stdout.read() + cmd.stderr.read()
        return str(output.decode('utf-8'))
    except Exception as e:
        print (e)
        return None

def put(hostname, username, password, localPath, remotePath):
    try:
        keyValidation(hostname)
        cnopts = pysftp.CnOpts(knownhosts=None)
        cnopts.hostkeys = None
        sftp = pysftp.Connection(host = hostname, username = username, password = password, cnopts=cnopts)
        print('SFTP connection to: ' + hostname + ' has been established\n')
        try:
            sftp.chdir(remotePath)
        except IOError:
            sftp.mkdir(remotePath)
            sftp.chdir(remotePath)
        sftp.put(localPath)
        print('LocalFile: <' + localPath + '> has been transferred correctly to <' + remotePath + '>\n')
        sftp.close()
        print('Connection to ' + hostname + ' closed')
        return True
    except Exception as e:
        print(e)
        return False

def buildAndRunDocker(hostname, username, password, directory):
    changeDir = 'cd ' + directory +' ; '
    buildDocker = utilities.sshCommand(hostname, username, password, changeDir+'docker build .')
    print(buildDocker)
    words = buildDocker.split('Successfully built')
    imgID = words[1].strip()
    print('Image ID: ' + imgID)
    runDocker = utilities.sshCommand(hostname, username, password, 'docker run ' + imgID)
    return runDocker


def sendFile(connection, path, processName , filename):
    processNameSize = len(processName)
    processNameSize = bin(processNameSize)[2:].zfill(32)
    connection.send(processNameSize)
    print("process size is "+str(processNameSize))
    connection.send(processName)
    filename2 = os.path.join(path,filename)
    filesize = os.path.getsize(filename2)
    print("file size is "+str(filesize))
    filesize2 = bin(filesize)[2:].zfill(32) # encode filesize as 32 bit binary
    connection.send(filesize2)
    file_to_send = open(path+'/'+ filename, 'rb')

    chunksize = 40960

    while filesize > 0:
        if filesize < chunksize:
            chunksize = filesize
        data = file_to_send.read(chunksize)
        connection.send(data)
        filesize -= chunksize
        print(str(filesize))
    file_to_send.close()
    print 'Done Sending'