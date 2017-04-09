import utilities
import sys

def dockerLogin():
    try:
        hubusername = ''
        hubpassword = ''
        utilities.bashCommand('docker login --username=' + hubusername + ' --password=' + hubpassword)
    except Exception as e:
        print e

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
        print e
        return False

def runDocker(hostname, username, password, repo):
    try:
        utilities.sshCommand(hostname, username, password, 'docker pull ' + repo)
        result = utilities.sshCommand(hostname, username, password, 'docker run ' + repo)
        return result
    except Exception as e:
        print e

def main():

    # hostname = str(sys.argv[1])
    # username = str(sys.argv[2])
    # password = str(sys.argv[3])
    # dockerfile = str(sys.argv[4])
    # repo = str(sys.argv[5])

    hostname = ''
    username = ''
    password = ''
    dockerfile = '/opt/lampp/htdocs/test/uploads'
    repo = 'hubusername/clientusernametasknum'

    isbuilt = buildDocker(dockerfile, repo)
    if isbuilt:
        result = runDocker(hostname, username, password, repo)
        print result

if __name__ == '__main__':
    main()
