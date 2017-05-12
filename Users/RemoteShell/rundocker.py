import utilities
import sys

def dockerLogin():
    try:
        hubusername = 'sherinesameh'
        hubpassword = 's14175276'
        utilities.bashCommand('docker login --username=' + hubusername + ' --password=' + hubpassword)
    except Exception as e:
        print e

def buildDocker(dockerfile, repo):
    try:
        utilities.changeDir(dockerfile)
        dockerImg = utilities.bashCommand('docker build .')
        imgID = utilities.bashCommand('docker image ls -q').split('\n')[0]
        utilities.bashCommand('docker tag '+ imgID + ' ' + repo)
        dockerLogin()
        push = utilities.bashCommand('docker push '+ repo)
        return True
    except Exception as e:
        print e
        return False

def runDocker(hostname, username, password, repo):
    try:
        pullCommand = 'docker pull ' + repo
        utilities.sshCommand(hostname, username, password, pullCommand)
        runCommand = 'docker run ' + repo
        result = utilities.sshCommand(hostname, username, password, runCommand)
        return result
    except Exception as e:
        print ("error");

def main():

    # hostname = str(sys.argv[1])
    # username = str(sys.argv[2])
    # password = str(sys.argv[3])
    # repo = str(sys.argv[5])
    print("hello")
    hostname = '46.101.180.169'
    username = 'sherine'
    password = '$He27$iX199treizE'
    repo = 'sherinesameh/hubtest166'
    dockerfile = str(sys.argv[0])
    # dockerfile = '/opt/lampp/htdocs/test/uploads'

    isbuilt = buildDocker(dockerfile, repo)
    if isbuilt:
        result = runDocker(hostname, username, password, repo)
        print result

if __name__ == '__main__':
    main()
