from pexpect import pxssh
import getpass
import sys
import subprocess
import os

def sshCommand(hostname, username, password, command):
    try:
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

def changeDir(newDir):
    try:
        os.chdir(newDir)
    except Exception as e:
        print (e)
