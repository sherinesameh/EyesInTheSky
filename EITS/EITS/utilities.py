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

from pexpect import pxssh
import getpass
import sys
import os
import subprocess
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


def sendFile(connection, path, processName ,userID, filename):
    data = processName + ":_:" + userID
    processNameSize = len(data)
    processNameSize = bin(data)[2:].zfill(32)
    connection.send(processNameSize)
    print("process size is "+str(processNameSize))
    connection.send(data)
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



def sendFileCamera(connection, path , filename):
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